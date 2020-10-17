<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a href="http://yota.yu1srs.org.rs" class="navbar-brand">YOTA</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('sponsoring') }}" class="nav-item nav-link {{ request()->routeIs('sponsoring') ? 'active' : '' }}">Sponsoring</a>
        </div>
        <div class="navbar-nav ml-auto">
            <a href="#" class="nav-item nav-link">Login</a>
        </div>
    </div>
</nav>
