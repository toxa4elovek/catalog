<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель сотрудника
 * Class Collaborator
 * @package App\Models
 */
class Collaborator extends Model
{
    //поля для массового заполнения
    protected $fillable = ['name', 'boss_id', 'position_id', 'pay', 'img'];

    /**
     * Связь сотрудников с должностями
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo('App\Models\Position');
    }

    /**
     * Получение начальника сотрудника
     * @return Model|null|static
     */
    public function getBoss()
    {
        if($this->boss_id !== 0) {
            return $this->with('position')->where('id', $this->boss_id)->first();
        }else return null;
    }

    /**
     * Построение дерева сотрудников в завимимости от начальника
     * @param $collaborators
     * @param int $boss_id
     * @return array
     */
    public static function getTree($collaborators, $boss_id = 0)
    {
        $result = [];

        foreach ($collaborators as $key => $collaborator) {


            if ((int)$collaborator['boss_id'] === $boss_id) {
                $id = $collaborator['id'];
                $result[$id] = $collaborator;
                unset($collaborators[$key]);
                $result[$id]['child'] = self::getTree($collaborators, $id);
            }
        }

        return $result;
    }

    /**
     * Подготовка данных к записи в базу
     * @param $data
     * @return array
     */
    public static function prepareData($data) {
        $data = array_filter($data, function ($item) {
            if($item !== null){
                return true;
            }return false;
        });

        if (isset($data['name'])) {
            $data[] = ['name', 'like', "%{$data['name']}%"];
            unset($data['name']);
        }

        if (isset($data['sort'])) {
            $data['sort'] = explode('By', $data['sort']);
        }

        if (isset($data['page'])) {
            unset($data['page']);
        }

        if (isset($data['created_at'])) {
            $data['created_at'] = [
                date('Y-m-d 00:00:00', strtotime($data['created_at'])),
                date('Y-m-d 23:59:59', strtotime($data['created_at'])),
            ];
        }

        return $data;
    }
}
