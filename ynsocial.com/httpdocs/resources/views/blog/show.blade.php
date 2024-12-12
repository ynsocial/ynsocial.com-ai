@extends('layouts.app')

@section('title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('meta')
    <meta name="keywords" content="{{ $post->keywords }}">
    @if($post->canonical_url)
        <link rel="canonical" href="{{ $post->canonical_url }}">
    @endif

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $post->og_title ?? $post->title }}">
    <meta property="og:description" content="{{ $post->og_description ?? $post->excerpt }}">
    <meta property="og:image" content="{{ $post->social_image ? Storage::url($post->social_image) : Storage::url($post->featured_image) }}">
    <meta property="og:url" content="{{ route('blog.show', $post) }}">
    <meta property="og:type" content="article">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->twitter_title ?? $post->title }}">
    <meta name="twitter:description" content="{{ $post->twitter_description ?? $post->excerpt }}">
    <meta name="twitter:image" content="{{ $post->social_image ? Storage::url($post->social_image) : Storage::url($post->featured_image) }}">

    <!-- Article Schema -->
    <script type="application/ld+json">
        {!! json_encode($post->getJsonLd()) !!}
    </script>
@endsection

@section('content')
<article class="blog-post">
    <!-- Featured Image -->
    @if($post->featured_image)
        <div class="blog-featured-image">
            <img src="{{ Storage::url($post->featured_image) }}" 
                 alt="{{ $post->title }}"
                 class="img-fluid w-100"
                 style="max-height: 500px; object-fit: cover;">
        </div>
    @endif

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Header -->
                <header class="blog-post-header mb-4">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @foreach($post->categories as $category)
                            <a href="{{ route('blog.category', $category) }}" 
                               class="badge bg-primary text-decoration-none">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                    <h1>{{ $post->title }}</h1>
                    @if($post->subtitle)
                        <h2 class="h4 text-muted">{{ $post->subtitle }}</h2>
                    @endif
                    <div class="blog-post-meta mt-3">
                        <div class="d-flex align-items-center gap-3">
                            @if($post->author_image)
                                <img src="{{ Storage::url($post->author_image) }}" 
                                     alt="{{ $post->author_name }}"
                                     class="rounded-circle"
                                     width="40"
                                     height="40">
                            @endif
                            <div>
                                <div class="fw-bold">{{ $post->author_name ?? $post->user->name }}</div>
                                <div class="text-muted">
                                    {{ $post->published_at->format('F d, Y') }} • 
                                    {{ number_format($post->view_count) }} views
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Content -->
                <div class="blog-post-content mb-5">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if($post->tags->isNotEmpty())
                    <div class="blog-post-tags mb-5">
                        <h3 class="h5 mb-3">Tags</h3>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.tag', $tag) }}" 
                                   class="btn btn-sm btn-outline-secondary">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Author Bio -->
                @if($post->author_bio)
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                @if($post->author_image)
                                    <img src="{{ Storage::url($post->author_image) }}" 
                                         alt="{{ $post->author_name }}"
                                         class="rounded-circle"
                                         width="60"
                                         height="60">
                                @endif
                                <div>
                                    <h3 class="h5 mb-1">About {{ $post->author_name ?? $post->user->name }}</h3>
                                    <div class="text-muted">Author</div>
                                </div>
                            </div>
                            <p class="mb-0">{{ $post->author_bio }}</p>
                        </div>
                    </div>
                @endif

                <!-- Social Share -->
                <div class="blog-post-share mb-5">
                    <h3 class="h5 mb-3">Share this article</h3>
                    <div class="d-flex gap-2">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post)) }}&text={{ urlencode($post->title) }}" 
                           class="btn btn-outline-primary"
                           target="_blank"
                           rel="noopener">
                            <i class="fab fa-twitter"></i> Tweet
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" 
                           class="btn btn-outline-primary"
                           target="_blank"
                           rel="noopener">
                            <i class="fab fa-facebook"></i> Share
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post)) }}&title={{ urlencode($post->title) }}" 
                           class="btn btn-outline-primary"
                           target="_blank"
                           rel="noopener">
                            <i class="fab fa-linkedin"></i> Share
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Related Posts -->
                @if($relatedPosts->isNotEmpty())
                    <div class="card mb-4">
                        <div class="card-header">Related Articles</div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @foreach($relatedPosts as $relatedPost)
                                    <a href="{{ route('blog.show', $relatedPost) }}" 
                                       class="list-group-item list-group-item-action">
                                        <div class="d-flex gap-3">
                                            @if($relatedPost->featured_image)
                                                <img src="{{ Storage::url($relatedPost->featured_image) }}" 
                                                     alt="{{ $relatedPost->title }}"
                                                     width="80"
                                                     height="80"
                                                     class="object-fit-cover">
                                            @endif
                                            <div>
                                                <h4 class="h6 mb-1">{{ $relatedPost->title }}</h4>
                                                <div class="small text-muted">
                                                    {{ $relatedPost->published_at->format('M d, Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Categories -->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($post->categories as $category)
                                <a href="{{ route('blog.category', $category) }}" 
                                   class="list-group-item list-group-item-action">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection

@push('styles')
<style>
    .blog-post-content {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .blog-post-content h2 {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .blog-post-content p {
        margin-bottom: 1.5rem;
    }

    .blog-post-content img {
        max-width: 100%;
        height: auto;
        margin: 2rem 0;
    }

    .blog-post-content blockquote {
        border-left: 4px solid #007bff;
        padding-left: 1rem;
        margin: 2rem 0;
        font-style: italic;
    }
</style>
@endpush
