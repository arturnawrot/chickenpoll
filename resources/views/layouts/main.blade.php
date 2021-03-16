<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ChickenPoll.com</title>

        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/app.css" type="text/css">  
    </head>
    <body>
        @include('inc.nav')
        <div class="container">
            <div class="row">
                <div style="width: 97%">
                    <div class="mx-auto mt-3 col-lg-10">
                        @include('inc.alert')
                        <div class="shadow mb-5 bg-white rounded poll">
                            <h1 class="display">@yield('display-title', 'Create a poll')</h1>
                            <p class="lead">@yield('display-description', 'No registration required. Real-time, instant and simple surveys for free.')</p>
                            @yield('content')
                        </div>
                        @yield('content-bottom')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>