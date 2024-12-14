@extends('montoya.layouts.app')

@section('title', 'Blog')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Search Bar -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('blog.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control" placeholder="Search posts..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary ms-2">Search</button>
                    </form>
                </div>
            </div>

            <!-- Blog Posts -->
            <div class="row">
                @forelse($posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ $post->getFeaturedImageUrl() }}" class="card-img-top" alt="{{ $post->title }}">
                            <div class="card-body">
                                <div class="small text-muted mb-1">
                                    {{ $post->published_at->format('M d, Y') }} • {{ $post->read_time }} min read
                                </div>
                                <h5 class="card-title">
                                    <a href="{{ $post->getUrl() }}" class="text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="card-text">{{ $post->excerpt }}</p>
                                
                                <!-- Category -->
                                @if($post->category)
                                    <a href="{{ $post->getCategoryUrl() }}" class="badge bg-primary text-decoration-none">
                                        {{ $post->category->name }}
                                    </a>
                                @endif

                                <!-- Tags -->
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('blog.tag', $tag->slug) }}" class="badge bg-secondary text-decoration-none">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="{{ $post->getUrl() }}" class="btn btn-link p-0">Read More →</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No posts found. {{ request('search') ? 'Try different search terms.' : '' }}
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
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
                            <a href="{{ route('blog.category', $category->slug) }}" 
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $category->name }}
                                <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Popular Tags -->
            <div class="card">
                <div class="card-header">Popular Tags</div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($popularTags as $tag)
                            <a href="{{ route('blog.tag', $tag->slug) }}" 
                               class="badge bg-secondary text-decoration-none"
                               style="font-size: {{ 12 + ($tag->posts_count * 0.5) }}px">
                                {{ $tag->name }}
                                <span class="badge bg-light text-dark">{{ $tag->posts_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 