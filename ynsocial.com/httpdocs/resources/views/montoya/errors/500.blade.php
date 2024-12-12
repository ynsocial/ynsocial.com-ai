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
                            <img src="/assets/montoya/images/errors/500.svg" alt="500 Error" class="img-fluid" style="max-width: 400px;">
                        </div>

                        <!-- Error Message -->
                        <h1 class="display-1 fw-bold text-primary mb-3">500</h1>
                        <h2 class="h3 mb-4">Internal Server Error</h2>
                        <p class="lead text-muted mb-4">
                            Oops! Something went wrong on our servers. We're working to fix the issue.
                        </p>
                        <p class="text-muted mb-5">
                            Please try again later or contact our support team if the problem persists.
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

                        <!-- Status Updates -->
                        <div class="status-updates mt-5">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <h3 class="h5 mb-4">System Status</h3>
                                    <div class="status-items">
                                        <div class="status-item d-flex align-items-center justify-content-between mb-3">
                                            <span class="status-label">Website</span>
                                            <span class="status-badge badge bg-warning">
                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                Investigating
                                            </span>
                                        </div>
                                        <div class="status-item d-flex align-items-center justify-content-between mb-3">
                                            <span class="status-label">API Services</span>
                                            <span class="status-badge badge bg-success">
                                                <i class="fas fa-check me-1"></i>
                                                Operational
                                            </span>
                                        </div>
                                        <div class="status-item d-flex align-items-center justify-content-between">
                                            <span class="status-label">Database</span>
                                            <span class="status-badge badge bg-success">
                                                <i class="fas fa-check me-1"></i>
                                                Operational
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Troubleshooting Tips -->
                        <div class="troubleshooting-tips mt-5">
                            <h3 class="h5 mb-4">While you wait, you can try:</h3>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center">
                                            <i class="fas fa-sync-alt fa-2x text-primary mb-3"></i>
                                            <h4 class="h6 mb-2">Refresh the Page</h4>
                                            <p class="small text-muted mb-0">Sometimes a simple refresh can fix the issue</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center">
                                            <i class="fas fa-trash-alt fa-2x text-primary mb-3"></i>
                                            <h4 class="h6 mb-2">Clear Cache</h4>
                                            <p class="small text-muted mb-0">Clear your browser cache and cookies</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center">
                                            <i class="fas fa-clock fa-2x text-primary mb-3"></i>
                                            <h4 class="h6 mb-2">Try Later</h4>
                                            <p class="small text-muted mb-0">Come back in a few minutes</p>
                                        </div>
                                    </div>
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

    .status-updates .card {
        background: rgba(255, 255, 255, 0.9);
    }

    .status-item {
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .status-item:last-child {
        border-bottom: none;
    }

    .status-badge {
        font-size: 0.8rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
    }

    .error-actions .btn {
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
    }

    .troubleshooting-tips .card {
        background: rgba(255, 255, 255, 0.9);
    }

    .troubleshooting-tips .card:hover {
        background: #fff;
    }
</style>
@endpush

@push('scripts')
<script>
    // Simulate status updates
    setInterval(() => {
        const statuses = ['Investigating', 'Identified', 'Monitoring', 'Resolved'];
        const badges = ['bg-warning', 'bg-info', 'bg-primary', 'bg-success'];
        const icons = ['exclamation-triangle', 'search', 'eye', 'check'];
        
        const websiteStatus = document.querySelector('.status-items .status-item:first-child .status-badge');
        if (websiteStatus) {
            const currentIndex = statuses.indexOf(websiteStatus.textContent.trim().split(' ')[1]);
            const nextIndex = (currentIndex + 1) % statuses.length;
            
            websiteStatus.className = `status-badge badge ${badges[nextIndex]}`;
            websiteStatus.innerHTML = `<i class="fas fa-${icons[nextIndex]} me-1"></i> ${statuses[nextIndex]}`;
        }
    }, 5000);
</script>
@endpush 