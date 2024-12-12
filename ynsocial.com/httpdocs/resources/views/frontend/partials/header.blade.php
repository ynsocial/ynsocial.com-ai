<!-- Header Area -->
<header class="header-area">
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <ul class="top-header-contact-info">
                        <li><i class="fas fa-phone-volume"></i> <a href="tel:+1234567890">+1 (234) 567-890</a></li>
                        <li><i class="fas fa-envelope"></i> <a href="mailto:hello@ynsocial.com">hello@ynsocial.com</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <ul class="top-header-social">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Navbar -->
    <div class="navbar-area">
        <div class="montoya-responsive-nav">
            <div class="container">
                <div class="montoya-responsive-menu">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="{{ config('app.name') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="montoya-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="{{ config('app.name') }}">
                    </a>

                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                                    About Us
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Services <i class="fas fa-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach(config('theme.demo.services') as $service)
                                        <li class="nav-item">
                                            <a href="{{ route('services.show', Str::slug($service['title'])) }}" class="nav-link">
                                                {{ $service['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('portfolio') }}" class="nav-link {{ request()->routeIs('portfolio') ? 'active' : '' }}">
                                    Portfolio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                                    Contact
                                </a>
                            </li>
                        </ul>

                        <div class="others-options">
                            <div class="option-item">
                                <i class="search-btn fas fa-search"></i>
                                <i class="close-btn fas fa-times"></i>
                                <div class="search-overlay search-popup">
                                    <div class='search-box'>
                                        <form class="search-form">
                                            <input class="search-input" name="search" placeholder="Search" type="text">
                                            <button class="search-button" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="option-item">
                                <a href="{{ route('quote.request') }}" class="default-btn">
                                    Get Quote <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- Search Overlay -->
<div class="search-overlay"></div>
