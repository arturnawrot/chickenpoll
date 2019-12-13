<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <div class="container h-100">
        <div class="row align-items-center">
            <div class="w-100 mt-5 pt-5">
                <h1 class="text-center title">
                <span style="color:#404346;">Easy</span><span style="color:#ef145b;">Poll</span>
                </h1>
                <div class="mt-5 col-lg-10">
                    <h2 class="display">@yield('title')</h2>
                    <p class="lead">@yield('description')</p>
                    @include('inc.alert')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

    @yield('body-bottom')
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
