@extends('montoya.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="page-hero bg-dark text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 mb-3">Search Results</h1>
                    <p class="lead mb-4">Results for: "{{ $query }}"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Results Section -->
    <section class="search-results py-5">
        <div class="container">
            <!-- Search Form -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6">
                    <form action="{{ route('search') }}" method="GET" class="search-form">
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control form-control-lg" 
                                   name="q" 
                                   value="{{ $query }}" 
                                   placeholder="Search again...">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Count -->
            <div class="row mb-4">
                <div class="col-12">
                    <p class="text-muted">
                        Found {{ $results->total() }} results ({{ number_format($searchTime, 3) }} seconds)
                    </p>
                </div>
            </div>

            <!-- Results Grid -->
            <div class="row g-4">
                @forelse($results as $result)
                    <div class="col-md-6">
                        <div class="search-result-card h-100">
                            <div class="card">
                                <div class="card-body">
                                    <div class="search-result-type mb-2">
                                        <span class="badge bg-{{ $result->type_color }}">
                                            {{ ucfirst($result->type) }}
                                        </span>
                                    </div>
                                    <h3 class="h5 mb-3">
                                        <a href="{{ $result->url }}" class="text-dark text-decoration-none">
                                            {{ $result->title }}
                                        </a>
                                    </h3>
                                    <p class="text-muted mb-3">
                                        {!! $result->highlight !!}
                                    </p>
                                    <div class="search-result-meta">
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i>
                                            {{ $result->created_at->format('M d, Y') }}
                                            @if($result->category)
                                                <span class="mx-2">|</span>
                                                <i class="far fa-folder me-1"></i>
                                                {{ $result->category }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h3 class="h4 mb-3">No Results Found</h3>
                            <p class="text-muted mb-4">
                                We couldn't find any results for "{{ $query }}". Please try another search.
                            </p>
                            <div class="suggestions">
                                <h4 class="h6 mb-3">Suggestions:</h4>
                                <ul class="list-unstyled">
                                    <li>Check your spelling</li>
                                    <li>Try more general keywords</li>
                                    <li>Try different keywords</li>
                                    <li>Try fewer keywords</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($results->hasPages())
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="pagination justify-content-center">
                            {{ $results->appends(['q' => $query])->links() }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Search Tips -->
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h4 class="h5 mb-3">Search Tips</h4>
                            <ul class="mb-0">
                                <li>Use quotation marks for exact phrase matches (e.g., "digital marketing")</li>
                                <li>Use + symbol to make a word or phrase required</li>
                                <li>Use - symbol to exclude words (e.g., marketing -social)</li>
                                <li>Search is not case-sensitive</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .page-hero {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/assets/montoya/images/search/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }

    .search-result-card {
        transition: all 0.3s ease;
    }

    .search-result-card:hover {
        transform: translateY(-5px);
    }

    .search-result-card .card {
        border: 1px solid rgba(0,0,0,.1);
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
    }

    .search-result-card:hover .card {
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
    }

    .search-form .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
    }

    .highlight {
        background-color: rgba(var(--bs-warning-rgb), 0.2);
        padding: 0.1rem 0.2rem;
        border-radius: 0.2rem;
    }
</style>
@endpush 