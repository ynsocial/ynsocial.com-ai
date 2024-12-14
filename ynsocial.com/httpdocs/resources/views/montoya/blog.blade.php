@extends('montoya.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="page-hero bg-dark text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 mb-3">Our Blog</h1>
                    <p class="lead mb-4">Stay updated with the latest insights, trends, and news in digital marketing.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Grid Section -->
    <section class="blog-section py-5">
        <div class="container">
            <!-- Category Filter -->
            <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="blog-categories">
                        <a href="{{ route('blog.index') }}" class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }} me-2 mb-2">
                            All Posts
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('blog.index', ['category' => $category->slug]) }}" 
                               class="btn {{ request('category') == $category->slug ? 'btn-primary' : 'btn-outline-primary' }} me-2 mb-2">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                    <form action="{{ route('blog.index') }}" method="GET" class="search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search posts..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Blog Posts Grid -->
            <div class="row g-4">
                @forelse($posts as $post)
                    <div class="col-md-6 col-lg-4">
                        <article class="blog-card h-100">
                            <div class="blog-card-img">
                                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid">
                                <div class="blog-card-date">
                                    <span class="day">{{ $post->created_at->format('d') }}</span>
                                    <span class="month">{{ $post->created_at->format('M') }}</span>
                                </div>
                            </div>
                            <div class="blog-card-body p-4">
                                <div class="blog-card-meta mb-3">
                                    <span class="meta-item">
                                        <i class="fas fa-folder me-2"></i>
                                        {{ $post->category->name }}
                                    </span>
                                    <span class="meta-item">
                                        <i class="fas fa-user me-2"></i>
                                        {{ $post->author->name }}
                                    </span>
                                </div>
                                <h3 class="blog-card-title h5 mb-3">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="blog-card-excerpt text-muted mb-3">
                                    {{ Str::limit($post->excerpt, 120) }}
                                </p>
                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-link text-primary p-0">
                                    Read More <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No blog posts found.
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="pagination justify-content-center">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2 class="h3 mb-4">Subscribe to Our Newsletter</h2>
                    <p class="text-muted mb-4">Get the latest insights and trends delivered straight to your inbox.</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form">
                        @csrf
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                        @if(session('newsletter_success'))
                            <div class="alert alert-success mt-3">
                                {{ session('newsletter_success') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Tags -->
    <section class="tags-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h3 class="mb-4">Popular Topics</h3>
                    <div class="tags-cloud">
                        @foreach($tags as $tag)
                            <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" 
                               class="btn btn-outline-primary btn-sm m-1">
                                {{ $tag->name }}
                                <span class="badge bg-primary ms-2">{{ $tag->posts_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .page-hero {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/assets/montoya/images/blog/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }

    .blog-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,.1);
    }

    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
    }

    .blog-card-img {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .blog-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .blog-card:hover .blog-card-img img {
        transform: scale(1.1);
    }

    .blog-card-date {
        position: absolute;
        top: 20px;
        left: 20px;
        background: var(--bs-primary);
        color: white;
        padding: 10px 15px;
        border-radius: 8px;
        text-align: center;
        line-height: 1;
    }

    .blog-card-date .day {
        display: block;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .blog-card-date .month {
        display: block;
        font-size: 0.875rem;
        text-transform: uppercase;
    }

    .blog-card-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.875rem;
        color: var(--bs-gray-600);
    }

    .blog-card-title a:hover {
        color: var(--bs-primary) !important;
    }

    .newsletter-section {
        background: linear-gradient(45deg, rgba(var(--bs-primary-rgb), 0.1), rgba(var(--bs-primary-rgb), 0.05));
    }

    .tags-cloud {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
    }

    .search-form .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
    }
</style>
@endpush 