@extends('layouts.main')
@section('content')



    <div class="container">
        <div class="row">


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
            {{ Form::hidden('id', '0') }}

            <div class="col-md-7">
                <h3>Добавить нового сотрудника</h3>
                <div class="form-group">
                    {{ Form::label('name', 'ФИО сотрудника') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="position">Должность</label>
                    <select name="position_id" id="positions" class="form-control">

                    </select>
                </div>

                <div class="form-group">
                    <label for="boss_id">Начальник</label>
                    <select name="boss_id" id="boss" class="form-control">

                    </select>
                </div>

                <div class="form-group">
                    {{ Form::label('pay', 'Заработная плата') }}
                    {{ Form::text('pay', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('img', 'Изображение') }}
                    {{ Form::file('img', ['class' => 'form-control', 'id' => 'avatar']) }}
                </div>

                <div class="form-group">
                    <input type="submit" value="Сохранить" class="btn btn-success">
                </div>
            </div>


            {{ Form::close() }}
        </div>
    </div>

@endsection