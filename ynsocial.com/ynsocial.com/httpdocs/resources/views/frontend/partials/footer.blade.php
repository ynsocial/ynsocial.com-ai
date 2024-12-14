<!-- Footer Area -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/frontend/images/white-logo.png') }}" alt="{{ config('app.name') }}">
                        </a>
                    </div>
                    <p>{{ config('app.name') }} is a full-service digital marketing agency helping businesses grow their online presence through strategic marketing solutions.</p>
                    <ul class="social-link">
                        <li>
                            <a href="#" class="d-block" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="d-block" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="d-block" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="d-block" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget pl-5">
                    <h3>Explore</h3>
                    <ul class="footer-links-list">
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}">About</a>
                        </li>
                        <li>
                            <a href="{{ route('portfolio') }}">Portfolio</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Services</h3>
                    <ul class="footer-links-list">
                        @foreach(config('theme.demo.services') as $service)
                            <li>
                                <a href="{{ route('services.show', Str::slug($service['title'])) }}">
                                    {{ $service['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Contact</h3>
                    <ul class="footer-contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            123 Business Street<br>
                            New York, NY 10001
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <a href="tel:+1234567890">+1 (234) 567-890</a>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:hello@ynsocial.com">hello@ynsocial.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <p>© {{ date('Y') }} <strong>{{ config('app.name') }}</strong> - All rights reserved.</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <ul>
                        <li>
                            <a href="{{ route('privacy') }}">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}">Terms & Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="shape16">
        <img src="{{ asset('assets/frontend/images/shape/shape16.png') }}" alt="shape">
    </div>
</footer>
