@extends('montoya.layouts.app')

@section('content')
    <!-- Error Section -->
    <section class="error-page py-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="error-content">
                        <!-- Error Image -->
                        <div class="error-image mb-4">
                            <img src="/assets/montoya/images/errors/404.svg" alt="404 Error" class="img-fluid" style="max-width: 400px;">
                        </div>

                        <!-- Error Message -->
                        <h1 class="display-1 fw-bold text-primary mb-3">404</h1>
                        <h2 class="h3 mb-4">Page Not Found</h2>
                        <p class="lead text-muted mb-5">
                            Oops! The page you're looking for doesn't exist or has been moved.
                        </p>

                        <!-- Action Buttons -->
                        <div class="error-actions">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-home me-2"></i>
                                Back to Home
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-envelope me-2"></i>
                                Contact Support
                            </a>
                        </div>

                        <!-- Helpful Links -->
                        <div class="helpful-links mt-5">
                            <h3 class="h5 mb-4">You might find these links helpful:</h3>
                            <div class="row g-4 justify-content-center">
                                <div class="col-md-4">
                                    <a href="{{ route('services') }}" class="text-decoration-none">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body text-center">
                                                <i class="fas fa-cogs fa-2x text-primary mb-3"></i>
                                                <h4 class="h6 mb-2">Our Services</h4>
                                                <p class="small text-muted mb-0">Explore our digital marketing solutions</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('portfolio.index') }}" class="text-decoration-none">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body text-center">
                                                <i class="fas fa-briefcase fa-2x text-primary mb-3"></i>
                                                <h4 class="h6 mb-2">Portfolio</h4>
                                                <p class="small text-muted mb-0">View our successful projects</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('blog.index') }}" class="text-decoration-none">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body text-center">
                                                <i class="fas fa-blog fa-2x text-primary mb-3"></i>
                                                <h4 class="h6 mb-2">Blog</h4>
                                                <p class="small text-muted mb-0">Read our latest articles</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .error-page {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .error-content {
        padding: 3rem 0;
    }

    .error-image img {
        animation: float 6s ease-in-out infinite;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    .helpful-links .card {
        background: rgba(255, 255, 255, 0.9);
    }

    .helpful-links .card:hover {
        background: #fff;
    }

    .error-actions .btn {
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
    }
</style>
@endpush 