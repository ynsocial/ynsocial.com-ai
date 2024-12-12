@extends('admin.layouts.app')

@section('title', $category->name . ' - Portfolio Entries')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        {{ $category->name }}
                        <small class="text-muted">Portfolio Entries</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.portfolio.categories.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active">{{ $category->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Action Buttons -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <!-- Bulk Actions -->
                    <form id="bulk-action-form" class="form-inline" method="POST" action="{{ route('admin.portfolio.entries.bulk-action') }}">
                        @csrf
                        <div class="input-group">
                            <select class="form-control" name="bulk_action" id="bulk_action">
                                <option value="">Bulk Actions</option>
                                <option value="publish">Publish Selected</option>
                                <option value="unpublish">Unpublish Selected</option>
                                <option value="delete">Delete Selected</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" id="apply-bulk-action" disabled>
                                    Apply
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('admin.portfolio.entries.create', ['category' => $category->id]) }}" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i> Add New Entry
                    </a>
                </div>
            </div>

            <!-- Advanced Filters -->
            <div class="card card-outline card-info mb-4">
                <div class="card-header">
                    <h3 class="card-title">Advanced Filters</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.portfolio.category.entries', $category) }}" method="GET" id="filter-form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="search">Search</label>
                                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search entries...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">All Status</option>
                                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date_range">Date Range</label>
                                    <input type="text" class="form-control" id="date_range" name="date_range" value="{{ request('date_range') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sort">Sort By</label>
                                    <select class="form-control" id="sort" name="sort">
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                                        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Category-specific filters -->
                        @switch($category->type)
                            @case('social-media')
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="platform">Platform</label>
                                            <select class="form-control" id="platform" name="platform">
                                                <option value="">All Platforms</option>
                                                <option value="instagram" {{ request('platform') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                                <option value="facebook" {{ request('platform') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                                <option value="tiktok" {{ request('platform') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="post_type">Post Type</label>
                                            <select class="form-control" id="post_type" name="post_type">
                                                <option value="">All Types</option>
                                                <option value="carousel" {{ request('post_type') == 'carousel' ? 'selected' : '' }}>Carousel</option>
                                                <option value="story" {{ request('post_type') == 'story' ? 'selected' : '' }}>Story</option>
                                                <option value="reel" {{ request('post_type') == 'reel' ? 'selected' : '' }}>Reel</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @break

                            @case('video')
                            @case('film')
                            @case('reels')
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="video_type">Video Type</label>
                                            <select class="form-control" id="video_type" name="video_type">
                                                <option value="">All Types</option>
                                                <option value="youtube" {{ request('video_type') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                                <option value="vimeo" {{ request('video_type') == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                                <option value="custom" {{ request('video_type') == 'custom' ? 'selected' : '' }}>Custom Upload</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="duration">Duration</label>
                                            <select class="form-control" id="duration" name="duration">
                                                <option value="">All Durations</option>
                                                <option value="short" {{ request('duration') == 'short' ? 'selected' : '' }}>Short (< 1 min)</option>
                                                <option value="medium" {{ request('duration') == 'medium' ? 'selected' : '' }}>Medium (1-5 mins)</option>
                                                <option value="long" {{ request('duration') == 'long' ? 'selected' : '' }}>Long (> 5 mins)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @break

                            @case('graphic-design')
                            @case('printed-materials')
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="design_type">Design Type</label>
                                            <select class="form-control" id="design_type" name="design_type">
                                                <option value="">All Types</option>
                                                <option value="logo" {{ request('design_type') == 'logo' ? 'selected' : '' }}>Logo</option>
                                                <option value="brochure" {{ request('design_type') == 'brochure' ? 'selected' : '' }}>Brochure</option>
                                                <option value="poster" {{ request('design_type') == 'poster' ? 'selected' : '' }}>Poster</option>
                                                <option value="business-card" {{ request('design_type') == 'business-card' ? 'selected' : '' }}>Business Card</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @break
                        @endswitch

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Apply Filters
                                </button>
                                <a href="{{ route('admin.portfolio.category.entries', $category) }}" class="btn btn-default">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Entries Grid -->
            <form id="entries-form">
                <div class="row">
                    @forelse($entries as $entry)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="entry-select">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input entry-checkbox" id="entry-{{ $entry->id }}" name="entries[]" value="{{ $entry->id }}">
                                        <label class="custom-control-label" for="entry-{{ $entry->id }}"></label>
                                    </div>
                                </div>

                                <!-- Preview Section -->
                                <div class="entry-preview">
                                    @switch($category->type)
                                        @case('website')
                                            <img src="{{ asset($entry->mockup_image) }}" class="card-img-top lazy" alt="{{ $entry->title }}">
                                            @break

                                        @case('social-media')
                                            <div class="social-media-preview">
                                                @if($entry->media_files && count($entry->media_files) > 0)
                                                    <img src="{{ asset($entry->media_files[0]) }}" class="card-img-top lazy" alt="{{ $entry->title }}">
                                                    @if(count($entry->media_files) > 1)
                                                        <span class="badge badge-info position-absolute" style="right: 10px; top: 10px;">
                                                            +{{ count($entry->media_files) - 1 }} more
                                                        </span>
                                                    @endif
                                                @endif
                                                <div class="platform-badge">
                                                    <i class="fab fa-{{ strtolower($entry->platform) }}"></i>
                                                    {{ $entry->post_type }}
                                                </div>
                                            </div>
                                            @break

                                        @case('video')
                                        @case('film')
                                        @case('reels')
                                            <div class="video-preview">
                                                @if($entry->thumbnail)
                                                    <img src="{{ asset($entry->thumbnail) }}" class="card-img-top lazy" alt="{{ $entry->title }}">
                                                    <div class="play-button" data-video-url="{{ $entry->video_url }}">
                                                        <i class="fas fa-play"></i>
                                                    </div>
                                                @else
                                                    <div class="embed-responsive embed-responsive-16by9">
                                                        <iframe class="embed-responsive-item lazy" data-src="{{ $entry->video_url }}" allowfullscreen></iframe>
                                                    </div>
                                                @endif
                                                @if($entry->duration)
                                                    <span class="badge badge-dark position-absolute" style="right: 10px; bottom: 10px;">
                                                        {{ $entry->duration }}
                                                    </span>
                                                @endif
                                            </div>
                                            @break

                                        @case('photography')
                                            <div class="gallery-preview">
                                                @if($entry->gallery && count($entry->gallery) > 0)
                                                    <img src="{{ asset($entry->gallery[0]) }}" class="card-img-top lazy" alt="{{ $entry->title }}">
                                                    @if(count($entry->gallery) > 1)
                                                        <span class="badge badge-info position-absolute" style="right: 10px; top: 10px;">
                                                            +{{ count($entry->gallery) - 1 }} photos
                                                        </span>
                                                    @endif
                                                @endif
                                            </div>
                                            @break

                                        @case('graphic-design')
                                        @case('printed-materials')
                                            <div class="design-preview">
                                                <img src="{{ asset($entry->preview_image) }}" class="card-img-top lazy" alt="{{ $entry->title }}">
                                                @if($entry->file_type)
                                                    <span class="badge badge-info position-absolute" style="right: 10px; top: 10px;">
                                                        {{ strtoupper($entry->file_type) }}
                                                    </span>
                                                @endif
                                            </div>
                                            @break

                                        @case('corporate-identity')
                                            <div class="corporate-preview">
                                                <div class="corporate-grid">
                                                    @if($entry->logo)
                                                        <img src="{{ asset($entry->logo) }}" class="logo lazy" alt="Logo">
                                                    @endif
                                                    @if($entry->business_card)
                                                        <img src="{{ asset($entry->business_card) }}" class="business-card lazy" alt="Business Card">
                                                    @endif
                                                </div>
                                                @if($entry->guidelines_pdf)
                                                    <span class="badge badge-info position-absolute" style="right: 10px; top: 10px;">
                                                        <i class="fas fa-file-pdf"></i> Guidelines
                                                    </span>
                                                @endif
                                            </div>
                                            @break

                                        @default
                                            @if($entry->thumbnail)
                                                <img src="{{ asset($entry->thumbnail) }}" class="card-img-top lazy" alt="{{ $entry->title }}">
                                            @endif
                                    @endswitch
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">{{ $entry->title }}</h5>
                                    <p class="card-text text-muted">
                                        {{ Str::limit($entry->description, 100) }}
                                    </p>

                                    <!-- Entry Meta -->
                                    <div class="entry-meta">
                                        <span class="badge {{ $entry->status == 'published' ? 'badge-success' : 'badge-warning' }}">
                                            {{ ucfirst($entry->status) }}
                                        </span>
                                        <small class="text-muted">
                                            Created: {{ $entry->created_at->format('M d, Y') }}
                                        </small>
                                    </div>

                                    <!-- Category-specific Meta -->
                                    @include('admin.portfolio.entries.partials.meta-' . $category->type, ['entry' => $entry])
                                </div>

                                <div class="card-footer">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.portfolio.entries.edit', $entry) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.portfolio.entries.preview', $entry) }}" class="btn btn-sm btn-primary" target="_blank">
                                            <i class="fas fa-eye"></i> Preview
                                        </a>
                                        <button type="button" class="btn btn-sm btn-success share-entry" data-entry="{{ $entry->id }}">
                                            <i class="fas fa-share-alt"></i> Share
                                        </button>
                                        <form action="{{ route('admin.portfolio.entries.destroy', $entry) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this entry?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                No entries found for this category. 
                                <a href="{{ route('admin.portfolio.entries.create', ['category' => $category->id]) }}" class="alert-link">Create your first entry</a>.
                            </div>
                        </div>
                    @endforelse
                </div>
            </form>

            <!-- Pagination -->
            @if($entries->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        {{ $entries->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Share Modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share Entry</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Share Link</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="shareLink" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary copy-link">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="social-share-buttons">
                        <a href="#" class="btn btn-primary share-facebook">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="#" class="btn btn-info share-twitter">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="#" class="btn btn-success share-whatsapp">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">
<style>
    .entry-preview {
        position: relative;
        height: 200px;
        overflow: hidden;
        background: #f8f9fa;
    }
    .entry-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .entry-select {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 10;
    }
    .platform-badge {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
    }
    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: rgba(0,0,0,0.7);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .play-button:hover {
        background: rgba(0,0,0,0.9);
        transform: translate(-50%, -50%) scale(1.1);
    }
    .corporate-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        padding: 10px;
    }
    .corporate-grid img {
        width: 100%;
        height: 90px;
        object-fit: contain;
    }
    .social-share-buttons {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/lazysizes/lazysizes.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Initialize date range picker
        $('#date_range').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#date_range').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        // Handle bulk actions
        $('.entry-checkbox').change(function() {
            updateBulkActionButton();
        });

        $('#bulk_action').change(function() {
            updateBulkActionButton();
        });

        function updateBulkActionButton() {
            let checkedEntries = $('.entry-checkbox:checked').length;
            let selectedAction = $('#bulk_action').val();
            $('#apply-bulk-action').prop('disabled', checkedEntries === 0 || !selectedAction);
        }

        // Handle video previews
        $('.play-button').click(function() {
            let videoUrl = $(this).data('video-url');
            let preview = $(this).closest('.video-preview');
            preview.html(`
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="${videoUrl}" allowfullscreen></iframe>
                </div>
            `);
        });

        // Handle sharing
        $('.share-entry').click(function() {
            let entryId = $(this).data('entry');
            let shareUrl = `{{ url('portfolio') }}/${entryId}`;
            $('#shareLink').val(shareUrl);
            $('#shareModal').modal('show');
        });

        $('.copy-link').click(function() {
            let shareLink = $('#shareLink');
            shareLink.select();
            document.execCommand('copy');
            alert('Link copied to clipboard!');
        });

        // Social sharing
        $('.share-facebook').click(function(e) {
            e.preventDefault();
            let url = $('#shareLink').val();
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, 'facebook-share', 'width=580,height=296');
        });

        $('.share-twitter').click(function(e) {
            e.preventDefault();
            let url = $('#shareLink').val();
            window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}`, 'twitter-share', 'width=580,height=296');
        });

        $('.share-whatsapp').click(function(e) {
            e.preventDefault();
            let url = $('#shareLink').val();
            window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(url)}`, 'whatsapp-share', 'width=580,height=296');
        });
    });
</script>
@endpush 