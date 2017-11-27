@extends('layouts.main')
@section('content')

    @if(!empty($collaborator))
    <h3>Редактировать сотрудника</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ Form::open(['action' => 'CollaboratorsController@save', 'enctype' => 'multipart/form-data']) }}
    {{ Form::model($collaborator) }}
    {{ Form::hidden('id') }}
    <div class="form-group">
        {{ Form::label('name', 'ФИО сотрудника') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        <label for="position">Должность</label>
        <select name="position_id" id="positions" class="form-control">
            <option value="{{$collaborator->position_id}}" selected="selected">{{ $collaborator->position->name }}</option>
        </select>
    </div>

    <div class="form-group">
        <label for="boss_id">Начальник</label>
        <select name="boss_id" id="boss" class="form-control">
            @if($collaborator->boss !== null || $collaborator->boss_id == 0 )
                <option value="{{($collaborator->boss !== null) ? $collaborator->boss->id : 0}}" selected="selected">
                    {{ ($collaborator->boss !== null) ? $collaborator->boss->name .' ('. $collaborator->boss->position->name.')' : 'Нет начальника'}}
                </option>
            @endif
        </select>
    </div>

    <div class="form-group">
        {{ Form::label('pay', 'Заработная плата') }}
        {{ Form::text('pay', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('img', 'Изображение') }}
        {{ Form::file('img', ['class' => 'form-control', 'id' => 'avatar'] )}}
    </div>

    <div class="form-group">
        <input type="submit" value="Сохранить" class="btn btn-success">
    </div>

    {{ Form::close() }}
    @else
        <h3>Такого сотрудника не найдено</h3>
    @endif

@endsection