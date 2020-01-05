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
    @include('inc.ads')
</head>
<body>
@include('inc.nav')
<div id="app" class="justify-content-center">
    <div class="container">
        <div class="row">
            <div style="width: 97%">
                <div class="mt-3 col-lg-10">
                    @include('inc.banners.banner')
                    <h2 class="display">@yield('title-display')</h2>
                    <p class="lead">@yield('description-display')</p>
                    @include('inc.alert')
                    <div class="shadow mb-5 bg-white rounded poll">
                        @yield('content')
                    </div>
                    <div class="mt-4">
                        @include('inc.banners.2')
                    </div>
                    <div class="mt-5 share">
                        <div class="row">
                            <div class="col-md-6">
                                @include('bitly.url')
                                <div class="form-group">
                                    <label for="link">Link with a friendly slug</label>
                                    <input id="link" class="col-md-10 form-control" type="text" value="{{ route('polls.show', $poll->slug) }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    @include('inc.social-icons')
                                </div>
                            </div>
                        </div>
                    </div>
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
