<div class="footer-content">
    <div class="container">
        <div class="row">
            <!-- Column 1: About -->
            <div class="col-lg-{{ 12 / $theme->footer['columns'] }}">
                <div class="footer-widget">
                    <h4>About Us</h4>
                    <p>We are a creative agency focused on growing brands through innovative digital solutions.</p>
                    @if($theme->footer['show_social'])
                        <div class="social-icons">
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

            <!-- Column 2: Quick Links -->
            <div class="col-lg-{{ 12 / $theme->footer['columns'] }}">
                <div class="footer-widget">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>

            <!-- Column 3: Services -->
            @if($theme->footer['columns'] >= 3)
                <div class="col-lg-{{ 12 / $theme->footer['columns'] }}">
                    <div class="footer-widget">
                        <h4>Services</h4>
                        <ul class="footer-links">
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">Web Development</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                            <li><a href="#">SEO Optimization</a></li>
                            <li><a href="#">Content Creation</a></li>
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Column 4: Newsletter -->
            @if($theme->footer['columns'] >= 4 && $theme->footer['show_newsletter'])
                <div class="col-lg-{{ 12 / $theme->footer['columns'] }}">
                    <div class="footer-widget">
                        <h4>Newsletter</h4>
                        <p>Subscribe to our newsletter for updates and insights.</p>
                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form">
                            @csrf
                            <div class="input-group">
                                <input type="email" class="form-control" name="email" placeholder="Your email" required>
                                <button class="btn btn-primary" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Legal Links -->
<div class="footer-legal mt-4">
    <ul class="list-inline mb-0">
        <li class="list-inline-item">
            <a href="{{ route('privacy') }}" class="text-muted">Privacy Policy</a>
        </li>
        <li class="list-inline-item">•</li>
        <li class="list-inline-item">
            <a href="{{ route('terms') }}" class="text-muted">Terms of Service</a>
        </li>
    </ul>
</div>

<!-- Copyright -->
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-end">
                <p>Designed with <i class="fas fa-heart text-danger"></i> by YN Social</p>
            </div>
        </div>
    </div>
</div> 