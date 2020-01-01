<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">New poll</a>
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