@extends('layouts.main')

@section('content')
    <a href="{{ route('collaborators-add') }}" class="btn btn-success add-collaborator">Добавить сотрудника</a>
    <h3 class="text-center">Каталог сотрудников</h3>
    <table class="table table-striped table-collaborators">

            <thead class="collaborator-head">
            <tr>
                <th>Номер
                    <span class="glyphicon glyphicon-chevron-up sort-collaborators" data-sort="desc" data-name="id"></span>
                </th>
                <th>ФИО
                    <span class="glyphicon glyphicon-chevron-up sort-collaborators" data-sort="desc" data-name="name"></span>
                </th>
                <th>Должность
                    <span class="glyphicon glyphicon-chevron-up sort-collaborators" data-sort="desc" data-name="position_id"></span>
                </th>
                <th>Дата приёма на работу
                    <span class="glyphicon glyphicon-chevron-up sort-collaborators" data-sort="desc" data-name="created_at"></span>
                </th>
                <th>Размер з/п
                    <span class="glyphicon glyphicon-chevron-up sort-collaborators" data-sort="desc" data-name="pay"></span>
                </th>
            </tr>
            <tr>
                <form id="search">
                    <td><input type="text" name="id" class="search-query form-control"></td>
                    <td><input type="text" name="name" class="search-query form-control"></td>
                    <td>

                        <div class="form-group">

                            <select name="position_id" id="positions" class="form-control search-query">


                            </select>
                            <span class="glyphicon glyphicon-remove reset-select"></span>
                        </div>

                    </td>
                    <td> <input id="date" type="text" name="created_at" class="search-query form-control"> </td>
                    <td><input type="text" name="pay" class="search-query form-control"></td>
                </form>
            </tr>
            </thead>

            @include('collaborators.partials.collaborators_table', $collaborators)

        </table>
            <div id="pagination">
                @include('collaborators.partials.pagination', ['pagination' => $pagination])
            </div>

@endsection