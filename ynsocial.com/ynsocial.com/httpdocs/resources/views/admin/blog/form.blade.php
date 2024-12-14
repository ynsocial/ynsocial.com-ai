@extends('admin.layouts.app')

@section('title', isset($post) ? 'Edit Post: ' . $post->title : 'Create New Post')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ isset($post) ? 'Edit Post' : 'Create New Post' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog Posts</a></li>
                        <li class="breadcrumb-item active">{{ isset($post) ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ isset($post) ? route('admin.blog.update', $post->id) : route('admin.blog.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif

                <div class="row">
                    <!-- Main Post Content -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <!-- Title -->
                                <div class="form-group">
                                    <label for="title">Post Title</label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $post->title ?? '') }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" 
                                           class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" 
                                           name="slug" 
                                           value="{{ old('slug', $post->slug ?? '') }}">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Excerpt -->
                                <div class="form-group">
                                    <label for="excerpt">Excerpt</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                              id="excerpt" 
                                              name="excerpt" 
                                              rows="3">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Content -->
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" 
                                              name="content" 
                                              rows="20">{{ old('content', $post->content ?? '') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SEO Settings -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3 class="card-title">SEO Settings</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="meta_title" 
                                           name="meta_title" 
                                           value="{{ old('meta_title', $post->meta_title ?? '') }}">
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea class="form-control" 
                                              id="meta_description" 
                                              name="meta_description" 
                                              rows="3">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="meta_keywords" 
                                           name="meta_keywords" 
                                           value="{{ old('meta_keywords', $post->meta_keywords ?? '') }}">
                                    <small class="form-text text-muted">Separate keywords with commas</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <!-- Publishing Options -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Publishing</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="draft" {{ old('status', $post->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $post->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="scheduled" {{ old('status', $post->status ?? '') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="published_at">Publish Date</label>
                                    <input type="datetime-local" 
                                           class="form-control" 
                                           id="published_at" 
                                           name="published_at" 
                                           value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                                </div>

                                <div class="form-check mb-3">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="featured" 
                                           name="featured" 
                                           value="1" 
                                           {{ old('featured', $post->featured ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">Featured Post</label>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ isset($post) ? 'Update Post' : 'Create Post' }}
                                    </button>
                                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary btn-block">Cancel</a>
                                </div>
                            </div>
                        </div>

                        <!-- Categories and Tags -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Categories & Tags</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" 
                                            id="category_id" 
                                            name="category_id" 
                                            required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <select class="form-control select2" 
                                            id="tags" 
                                            name="tags[]" 
                                            multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" 
                                                    {{ in_array($tag->id, old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Featured Image</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" 
                                               class="custom-file-input @error('featured_image') is-invalid @enderror" 
                                               id="featured_image" 
                                               name="featured_image" 
                                               accept="image/*">
                                        <label class="custom-file-label" for="featured_image">Choose file</label>
                                    </div>
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if(isset($post) && $post->featured_image)
                                    <div class="current-image mt-3">
                                        <img src="{{ asset($post->featured_image) }}" 
                                             alt="Current featured image" 
                                             class="img-fluid rounded">
                                        <div class="form-check mt-2">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   id="remove_image" 
                                                   name="remove_image" 
                                                   value="1">
                                            <label class="form-check-label" for="remove_image">Remove current image</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<style>
    .ck-editor__editable {
        min-height: 400px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Browse";
    }
    .current-image img {
        max-height: 200px;
        width: auto;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/ckeditor5/ckeditor.js') }}"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            tags: true,
            tokenSeparators: [',', ' '],
            placeholder: 'Select or type new tags'
        });

        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'mediaEmbed', '|', 'undo', 'redo'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });

        // Auto-generate slug from title
        $('#title').on('keyup', function() {
            if (!$('#slug').val()) {
                let slug = $(this).val()
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                $('#slug').val(slug);
            }
        });

        // Show selected image name
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        // Handle scheduled status
        $('#status').on('change', function() {
            if ($(this).val() === 'scheduled') {
                $('#published_at').prop('required', true);
            } else {
                $('#published_at').prop('required', false);
            }
        });

        // Initialize status check
        if ($('#status').val() === 'scheduled') {
            $('#published_at').prop('required', true);
        }
    });
</script>
@endpush 