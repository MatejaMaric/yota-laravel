<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
    <a href="{{ route('home') }}" class="navbar-brand">YOTA</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('news') }}" class="nav-item nav-link {{ request()->routeIs('news') ? 'active' : '' }}">News</a>
            <a href="{{ route('gallery') }}" class="nav-item nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
            <a href="{{ route('sponsoring') }}" class="nav-item nav-link {{ request()->routeIs('sponsoring') ? 'active' : '' }}">Sponsoring</a>
          <div class="nav-item dropdown">
            <span class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Special Calls
            </span>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a href="{{ route('activities') }}" class="dropdown-item {{ request()->routeIs('activities') ? 'active' : '' }}">Activities</a>
                <a href="{{ route('reserve') }}" class="dropdown-item {{ request()->routeIs('reserve') ? 'active' : '' }}">Make reservation</a>
            </div>
          </div>
        </div>
        <div class="navbar-nav ml-auto">
        @if (Auth::check())
          <div class="nav-item dropdown">
            <span class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Administration
            </span>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item {{ request()->routeIs('newsAdd') ? 'active' : '' }}" href="{{ route('newsAdd') }}">News</a>
              <a class="dropdown-item {{ request()->routeIs('galleryAdd') ? 'active' : '' }}" href="{{ route('galleryAdd') }}">Gallery</a>
              <a class="dropdown-item {{ request()->routeIs('addSign') ? 'active' : '' }}" href="{{ route('addSign') }}">Callsigns</a>
              <a class="dropdown-item {{ request()->routeIs('reservations') ? 'active' : '' }}" href="{{ route('reservations') }}">Reservations</a>
            </div>
          </div>
          <a href="{{ route('logout') }}" class="nav-item nav-link">Logout</a>
        @else
          <a href="{{ route('login') }}" class="nav-item nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
        @endif
        </div>
    </div>
    </div>
</nav>
