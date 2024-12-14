@extends('montoya.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="page-hero bg-dark text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="post-meta mb-3">
                        <span class="meta-item">
                            <i class="fas fa-calendar me-2"></i>
                            {{ $post->created_at->format('F d, Y') }}
                        </span>
                        <span class="meta-item mx-3">
                            <i class="fas fa-folder me-2"></i>
                            {{ $post->category->name }}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-user me-2"></i>
                            {{ $post->author->name }}
                        </span>
                    </div>
                    <h1 class="display-4 mb-3">{{ $post->title }}</h1>
                    <p class="lead mb-0">{{ $post->excerpt }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content Section -->
    <section class="blog-content py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <article class="blog-post">
                        @if($post->featured_image)
                            <div class="featured-image mb-4">
                                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid rounded">
                            </div>
                        @endif

                        <div class="post-content">
                            {!! $post->content !!}
                        </div>

                        <!-- Tags -->
                        @if($post->tags->count() > 0)
                            <div class="post-tags mt-4">
                                <h5 class="mb-3">Tags:</h5>
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <!-- Share Buttons -->
                        <div class="post-share mt-4">
                            <h5 class="mb-3">Share This Post:</h5>
                            <div class="share-buttons">
                                <a href="https://facebook.com/share.php?u={{ urlencode(request()->url()) }}" class="btn btn-primary me-2" target="_blank">
                                    <i class="fab fa-facebook-f me-2"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" class="btn btn-info me-2" target="_blank">
                                    <i class="fab fa-twitter me-2"></i> Twitter
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" class="btn btn-secondary me-2" target="_blank">
                                    <i class="fab fa-linkedin-in me-2"></i> LinkedIn
                                </a>
                            </div>
                        </div>

                        <!-- Author Bio -->
                        <div class="author-bio mt-5 p-4 bg-light rounded">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="{{ asset($post->author->avatar) }}" alt="{{ $post->author->name }}" class="img-fluid rounded-circle">
                                </div>
                                <div class="col-md-10">
                                    <h5 class="mb-2">{{ $post->author->name }}</h5>
                                    <p class="mb-2">{{ $post->author->bio }}</p>
                                    <div class="social-links">
                                        @if($post->author->twitter)
                                            <a href="{{ $post->author->twitter }}" class="text-primary me-3" target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        @endif
                                        @if($post->author->linkedin)
                                            <a href="{{ $post->author->linkedin }}" class="text-primary me-3" target="_blank">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Related Posts -->
                        @if($relatedPosts->count() > 0)
                            <div class="related-posts mt-5">
                                <h3 class="mb-4">Related Posts</h3>
                                <div class="row g-4">
                                    @foreach($relatedPosts as $relatedPost)
                                        <div class="col-md-6">
                                            <article class="blog-card h-100">
                                                <div class="blog-card-img">
                                                    <img src="{{ asset($relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}">
                                                </div>
                                                <div class="blog-card-body p-4">
                                                    <h4 class="blog-card-title h6 mb-3">
                                                        <a href="{{ route('blog.show', $relatedPost->slug) }}" class="text-dark text-decoration-none">
                                                            {{ $relatedPost->title }}
                                                        </a>
                                                    </h4>
                                                    <p class="blog-card-excerpt text-muted mb-3">
                                                        {{ Str::limit($relatedPost->excerpt, 80) }}
                                                    </p>
                                                    <a href="{{ route('blog.show', $relatedPost->slug) }}" class="btn btn-link text-primary p-0">
                                                        Read More <i class="fas fa-arrow-right ms-2"></i>
                                                    </a>
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Comments Section -->
                        <div class="comments-section mt-5">
                            <h3 class="mb-4">Comments</h3>
                            
                            <!-- Comment Form -->
                            <div class="comment-form mb-5">
                                <form action="{{ route('blog.comment.store', $post->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Leave a Comment</label>
                                        <textarea class="form-control" id="comment" name="content" rows="4" required></textarea>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </form>
                            </div>

                            <!-- Comments List -->
                            @if($post->comments->count() > 0)
                                <div class="comments-list">
                                    @foreach($post->comments as $comment)
                                        <div class="comment mb-4">
                                            <div class="comment-body p-4 bg-light rounded">
                                                <div class="comment-meta mb-2">
                                                    <h5 class="comment-author mb-1">{{ $comment->name }}</h5>
                                                    <small class="text-muted">
                                                        {{ $comment->created_at->format('F d, Y \a\t h:i A') }}
                                                    </small>
                                                </div>
                                                <div class="comment-content">
                                                    <p class="mb-0">{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">No comments yet. Be the first to comment!</p>
                            @endif
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Search Widget -->
                    <div class="sidebar-widget mb-4">
                        <div class="widget-content p-4 bg-light rounded">
                            <h4 class="widget-title mb-3">Search</h4>
                            <form action="{{ route('blog.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search posts...">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <div class="sidebar-widget mb-4">
                        <div class="widget-content p-4 bg-light rounded">
                            <h4 class="widget-title mb-3">Categories</h4>
                            <ul class="list-unstyled categories-list mb-0">
                                @foreach($categories as $category)
                                    <li class="mb-2">
                                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}" class="d-flex justify-content-between align-items-center text-dark text-decoration-none">
                                            {{ $category->name }}
                                            <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Recent Posts Widget -->
                    <div class="sidebar-widget mb-4">
                        <div class="widget-content p-4 bg-light rounded">
                            <h4 class="widget-title mb-3">Recent Posts</h4>
                            @foreach($recentPosts as $recentPost)
                                <div class="recent-post mb-3">
                                    <div class="row g-0">
                                        <div class="col-3">
                                            <img src="{{ asset($recentPost->featured_image) }}" alt="{{ $recentPost->title }}" class="img-fluid rounded">
                                        </div>
                                        <div class="col-9 ps-3">
                                            <h6 class="mb-1">
                                                <a href="{{ route('blog.show', $recentPost->slug) }}" class="text-dark text-decoration-none">
                                                    {{ Str::limit($recentPost->title, 50) }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">
                                                {{ $recentPost->created_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tags Widget -->
                    <div class="sidebar-widget">
                        <div class="widget-content p-4 bg-light rounded">
                            <h4 class="widget-title mb-3">Tags</h4>
                            <div class="tags-cloud">
                                @foreach($tags as $tag)
                                    <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="btn btn-outline-primary btn-sm m-1">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
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
    .page-hero {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/assets/montoya/images/blog/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }

    .meta-item {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .post-content {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 2rem 0;
    }

    .post-content h2, .post-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .post-content blockquote {
        border-left: 4px solid var(--bs-primary);
        padding-left: 1rem;
        margin: 2rem 0;
        font-style: italic;
        color: var(--bs-gray-700);
    }

    .author-bio img {
        width: 100px;
        height: 100px;
        object-fit: cover;
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

    .comment {
        transition: all 0.3s ease;
    }

    .comment:hover {
        transform: translateX(10px);
    }

    .categories-list li a:hover {
        color: var(--bs-primary) !important;
    }

    .recent-post img {
        width: 70px;
        height: 70px;
        object-fit: cover;
    }

    .tags-cloud {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .share-buttons .btn {
        transition: all 0.3s ease;
    }

    .share-buttons .btn:hover {
        transform: translateY(-3px);
    }
</style>
@endpush 