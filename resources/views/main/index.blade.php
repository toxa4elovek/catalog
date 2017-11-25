@extends('layouts.main')
@section('content')
    <div class="container">
        {{--<table class="table table-striped">

            <thead>
            <caption><h3>Каталог сотрудников</h3></caption>
            <tr>
                <td>Номер</td>
                <td>ФИО</td>
                <td>Должность</td>
                <td>Дата приёма на работу</td>
                <td>Размер з/п</td>
            </tr>
            </thead>
            @foreach($collaborators as $collaborator)
            <tr>
                <td>{{ $collaborator->id }}</td>
                <td>{{ $collaborator->name }}</td>
                <td>{{ $collaborator->position->name }}</td>
                <td>{{ $collaborator->created_at }}</td>
                <td>{{ $collaborator->pay }}</td>
            </tr>
            @endforeach
        </table>--}}
        <h2>Каталог сотрутников</h2>
        @include('main.partials.items', $collaborators)

    </div>
@endsection