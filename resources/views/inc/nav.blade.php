<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container">
        <span style="font-size: 2rem;" class="text-center title">
            <a href="/" target="_blank">
                <span style="color:#404346;">Chicken</span><span style="color:#ef145b;">Poll</span>
            </a>
        </span>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('polls') ? 'active' : '' }}" href="{{ route('polls') }}">List of polls</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('blog.index') ? 'active' : '' }}" href="{{ route('blog.index') }}">Posts</a>
        </li>
        </ul>
    </div>
</nav>
