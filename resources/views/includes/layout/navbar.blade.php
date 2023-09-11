<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar Left Side -->
            <ul class="navbar-nav me-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('admin.home')) active @endif"
                            href="{{ route('admin.home') }}">All Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('admin.projects*')) active @endif"
                            href="{{ route('admin.projects.index') }}">My Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('admin.types*')) active @endif"
                            href="{{ route('admin.types.index') }}">Types</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('admin.technologies*')) active @endif"
                            href="{{ route('admin.technologies.index') }}">Technologies</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('guests.home')) active @endif"
                            href="{{ route('guests.home') }}">Home</a>
                    </li>
                @endauth
            </ul>

            <!-- Navbar Right Side -->
            @include('includes.generics.authLinks')
        </div>
    </div>
</nav>
