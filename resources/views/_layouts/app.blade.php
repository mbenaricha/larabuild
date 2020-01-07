<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('styles')
</head>
<body data-js-require="@yield('js-require')">
<div id="app">
    @include('_partials.nav')

    <main class="container-fluid px-5 mt-5">
        @yield('content')
    </main>
</div>

@stack('scripts')
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
