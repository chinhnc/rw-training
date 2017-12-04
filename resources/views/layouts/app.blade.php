<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle')</title>

    @include('layouts.stylesheet')
    @yield('stylesheet')
</head>
<body>
    @include('layouts.header')

    <div id="app">
        @yield('content')
    </div>

    @include('layouts.footer')

    @include('layouts.javascript')
    @yield('javascript')
    @yield('categories-bar-js')
</body>
</html>
