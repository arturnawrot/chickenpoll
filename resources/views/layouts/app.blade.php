<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body>
    @include('inc.nav')
    <div id="app">
    <div class="container justify-content-center">
        <div class="row align-items-center">
            <div class="w-100">
                <h1 class="text-center title"><a href="/" target="_blank">
                <span style="color:#404346;">Chicken</span><span style="color:#ef145b;">Poll</span>
                </a></h1>
                <div class="mt-3 col-lg-10">
                    <h2 class="display">@yield('title-display')</h2>
                    <p class="lead">@yield('description-display')</p>
                    @include('inc.alert')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

    @include('inc.footer')

    @yield('body-bottom')
    <script src="{{ asset('js/app.js') }}" defer></script>
@include('inc.google')
</body>
</html>
