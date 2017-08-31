<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TestTask</title>
        <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
    </head>
    <body>
        <section>
            <div id="app">
                <vue-menu></vue-menu>
                <router-view></router-view>
            </div>
        </section>
        <script src="{{ asset(mix('js/app.js')) }}"></script>
    </body>
</html>
