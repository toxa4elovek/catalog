@extends('layouts.main')
@section('content')
    <h2 class="text-center">Информация о сотруднике</h2>

    <div class="container">

        <div class="center-block">
            <table class="table">
                <tr>
                    <td class="text-right name-column">
                        Имя сотрудника
                    </td>
                    <td class="value-column">
                        {{ $collaborator->name }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right name-column">
                        Должность
                    </td>
                    <td class="value-column">
                        {{ $collaborator->position->name }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right name-column">
                        Начальник
                    </td>
                    <td class="value-column">
                        {{(isset($collaborator->boss->name)) ? $collaborator->boss->name . '(' . $collaborator->boss->position->name . ')' : 'Нет' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right name-column">
                        Дата приёма на работу
                    </td>
                    <td class="value-column">
                        {{ $collaborator->created_at }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right name-column">
                        Заработная плата
                    </td>
                    <td class="value-column">
                        {{ $collaborator->pay }} руб
                    </td>
                </tr>
                <tr>
                    <td class="text-right name-column">
                        Фото
                    </td>
                    <td>
                        <img src="{{ ($collaborator->img !== '') ? $collaborator->img : '/no-image.png'}}" class="img-thumbnail img-collaborator" alt="">
                    </td>
                </tr>
            </table>

        </div>
        <div class="col-md-9"> </div>
        <a href="{{ route('collaborator-update', ['id' => $collaborator->id]) }}" class="btn btn-success col-md-2">Редактировать</a>
    </div>


@endsection