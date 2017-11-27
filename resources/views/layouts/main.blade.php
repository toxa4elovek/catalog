<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    @include('blocks.styles')
    <title>Каталог</title>
</head>
<body>
@include('blocks.navbar')
<div class="container-fluid">
    @yield('content')
</div>
@include('blocks.scripts')
</body>
@include('blocks.footer')
</html>