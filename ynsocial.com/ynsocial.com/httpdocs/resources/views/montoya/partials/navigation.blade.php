<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            @if($theme->logo)
                <img src="{{ asset('storage/' . $theme->logo) }}" alt="{{ config('app.name') }}" class="logo">
            @else
                {{ config('app.name') }}
            @endif
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('portfolio.*') ? 'active' : '' }}" href="{{ route('portfolio.index') }}">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>

            @if($theme->header['show_search'])
                <form class="d-flex ms-3" action="{{ route('search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            @endif

            @if($theme->header['show_social'])
                <div class="social-icons ms-3">
                    @foreach($theme->social_media as $platform => $url)
                        @if($url)
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="social-icon">
                                <i class="fab fa-{{ $platform }}"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</nav> 