@extends('layouts.app')

@section('title', 'Blog')
@section('meta_description', 'Read our latest articles about video production, social media marketing, and web design.')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <h1 class="mb-4">Blog</h1>

            <!-- Search Form -->
            <form action="{{ route('blog.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search articles..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>

            <!-- Blog Posts -->
            <div class="row">
                @forelse($posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            @if($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $post->title }}"
                                     style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="small text-muted">
                                        {{ $post->published_at->format('M d, Y') }}
                                    </div>
                                    @if($post->categories->isNotEmpty())
                                        <a href="{{ route('blog.category', $post->categories->first()) }}" 
                                           class="badge bg-primary text-decoration-none">
                                            {{ $post->categories->first()->name }}
                                        </a>
                                    @endif
                                </div>
                                <h2 class="card-title h5">
                                    <a href="{{ route('blog.show', $post) }}" class="text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <p class="card-text">{{ Str::limit($post->excerpt, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('blog.show', $post) }}" class="btn btn-sm btn-outline-primary">
                                        Read More
                                    </a>
                                    <div class="small text-muted">
                                        {{ number_format($post->view_count) }} views
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="alert alert-info">
                            No blog posts found.
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Categories -->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <a href="{{ route('blog.category', $category) }}" 
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $category->name }}
                                <span class="badge bg-primary rounded-pill">
                                    {{ $category->blog_posts_count }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tags -->
            <div class="card">
                <div class="card-header">Tags</div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ route('blog.tag', $tag) }}" 
                               class="btn btn-sm btn-outline-secondary">
                                {{ $tag->name }}
                                <span class="badge bg-secondary">{{ $tag->blog_posts_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
