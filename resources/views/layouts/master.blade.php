<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @yield('page-style')
    </head>
    <body>
        @yield('content')

        <script src="{{ asset('js/vendor/jquery.js') }}"></script>
        @stack('scripts')
    </body>
</html>
