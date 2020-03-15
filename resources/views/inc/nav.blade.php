<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container">
        <span style="font-size: 2rem;" class="text-center title">
            <a href="/" target="_blank">
                <span style="color:#404346;">Chicken</span><span style="color:#ef145b;">Poll</span>
            </a>
        </span>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            @if(Route::currentRouteNamed('blog.show'))
                <a class="nav-link" href="{{ route('index') }}">Create a poll</a>
            @endif
        </li>
        </ul>
    </div>
</nav>
