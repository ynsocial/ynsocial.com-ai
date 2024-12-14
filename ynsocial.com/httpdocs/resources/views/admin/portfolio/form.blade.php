@extends('admin.layouts.app')

@section('title', isset($portfolio) ? 'Edit Project: ' . $portfolio->title : 'Create New Project')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ isset($portfolio) ? 'Edit Project' : 'Create New Project' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.portfolio.index') }}">Portfolio</a></li>
                        <li class="breadcrumb-item active">{{ isset($portfolio) ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Project Details</h3>
                        </div>
                        
                        <form method="POST" action="{{ isset($portfolio) ? route('admin.portfolio.update', $portfolio) : route('admin.portfolio.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($portfolio))
                                @method('PUT')
                            @endif

                            <div class="card-body">
                                <!-- Title -->
                                <div class="form-group">
                                    <label for="title">Project Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $portfolio->title ?? '') }}" required>
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $portfolio->slug ?? '') }}">
                                    @error('slug')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (old('category_id', $portfolio->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $portfolio->description ?? '') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Content -->
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control tinymce @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', $portfolio->content ?? '') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Thumbnail -->
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                                        <label class="custom-file-label" for="thumbnail">Choose file</label>
                                    </div>
                                    @if(isset($portfolio) && $portfolio->thumbnail)
                                        <div class="mt-2">
                                            <img src="{{ asset($portfolio->thumbnail) }}" alt="Current Thumbnail" class="img-thumbnail" width="200">
                                        </div>
                                    @endif
                                    @error('thumbnail')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Gallery Images -->
                                <div class="form-group">
                                    <label for="gallery">Gallery Images</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('gallery') is-invalid @enderror" id="gallery" name="gallery[]" accept="image/*" multiple>
                                        <label class="custom-file-label" for="gallery">Choose files</label>
                                    </div>
                                    @if(isset($portfolio) && $portfolio->gallery)
                                        <div class="row mt-2">
                                            @foreach($portfolio->gallery as $image)
                                                <div class="col-md-2 mb-2">
                                                    <img src="{{ asset($image) }}" alt="Gallery Image" class="img-thumbnail">
                                                    <button type="button" class="btn btn-sm btn-danger mt-1 remove-gallery-image" data-image="{{ $image }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @error('gallery')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Client Name -->
                                <div class="form-group">
                                    <label for="client_name">Client Name</label>
                                    <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" name="client_name" value="{{ old('client_name', $portfolio->client_name ?? '') }}">
                                    @error('client_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Project URL -->
                                <div class="form-group">
                                    <label for="project_url">Project URL</label>
                                    <input type="url" class="form-control @error('project_url') is-invalid @enderror" id="project_url" name="project_url" value="{{ old('project_url', $portfolio->project_url ?? '') }}">
                                    @error('project_url')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Completion Date -->
                                <div class="form-group">
                                    <label for="completion_date">Completion Date</label>
                                    <input type="date" class="form-control @error('completion_date') is-invalid @enderror" id="completion_date" name="completion_date" value="{{ old('completion_date', isset($portfolio) ? $portfolio->completion_date->format('Y-m-d') : '') }}">
                                    @error('completion_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="is_published">Status</label>
                                    <select class="form-control @error('is_published') is-invalid @enderror" id="is_published" name="is_published">
                                        <option value="1" {{ old('is_published', $portfolio->is_published ?? '') ? 'selected' : '' }}>Published</option>
                                        <option value="0" {{ old('is_published', $portfolio->is_published ?? '1') ? '' : 'selected' }}>Draft</option>
                                    </select>
                                    @error('is_published')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ isset($portfolio) ? 'Update Project' : 'Create Project' }}</button>
                                <a href="{{ route('admin.portfolio.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();

            // Initialize TinyMCE
            tinymce.init({
                selector: '.tinymce',
                height: 400,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | bold italic backcolor | \
                    alignleft aligncenter alignright alignjustify | \
                    bullist numlist outdent indent | removeformat | help'
            });

            // Auto-generate slug from title
            $('#title').on('keyup', function() {
                let slug = $(this).val()
                    .toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
                $('#slug').val(slug);
            });

            // Custom file input
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // Remove gallery image
            $('.remove-gallery-image').on('click', function() {
                if (confirm('Are you sure you want to remove this image?')) {
                    let image = $(this).data('image');
                    // Add the image to a hidden input to be processed on form submission
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'remove_gallery[]',
                        value: image
                    }).appendTo('form');
                    $(this).closest('.col-md-2').remove();
                }
            });
        });
    </script>
@endpush 