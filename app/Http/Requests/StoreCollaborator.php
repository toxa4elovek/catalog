<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreCollaborator
 * @package App\Http\Requests
 */
class StoreCollaborator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'position_id' => 'required',
            'boss_id' => 'required',
            'pay' => 'required',
        ];
    }

    /**
     * Сообщения ошибок валидации
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'ФИО должно быть заполнено',
            'position_id.required'  => 'Сотрудник не может быть добавлен без должности',
            'boss_id.required'  => 'Сотрудник не может быть добавлен без начальника',
            'pay.required'  => 'Сотрудник не может быть добавлен без зарплаты',
        ];
    }
}
