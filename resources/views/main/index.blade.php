@extends('layouts.main')
@section('content')
    <div class="container">

        <h2>Каталог сотрутников</h2>
        @include('main.partials.items', $collaborators)

    </div>
@endsection