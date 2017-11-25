<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    public function position()
    {
        return $this->belongsTo('App\Models\Position');
    }

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

    public static function makeTree(&$users, int $bossId = null): array
    {
        $result = [];

        foreach ($users as $key => &$user) {
            if ($bossId !== null and $user['boss_id'] !== $bossId) {
                continue;
            }

            $result[$user['id']] = &$user;
            $user['slaves'] = self::makeTree($users, $user['id']);

            unset($users[$key]);
        }

        return $result;
    }
}
