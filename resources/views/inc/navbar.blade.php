<nav class="navbar navbar-expand-md navbar-light bg-light">
    <span class="navbar-brand">YOTA</span>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('news') }}" class="nav-item nav-link {{ request()->routeIs('news') ? 'active' : '' }}">News</a>
            <a href="{{ route('gallery') }}" class="nav-item nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
            <a href="{{ route('sponsoring') }}" class="nav-item nav-link {{ request()->routeIs('sponsoring') ? 'active' : '' }}">Sponsoring</a>
        </div>
        <div class="navbar-nav ml-auto">
            <a href="{{ route('login') }}" class="nav-item nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
        </div>
    </div>
</nav>
