@extends('admin.layouts.app')

@section('title', isset($entry) ? 'Edit Portfolio Entry' : 'Create Portfolio Entry')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        {{ isset($entry) ? 'Edit Portfolio Entry' : 'Create Portfolio Entry' }}
                        <small class="text-muted">{{ $category->name }}</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.portfolio.index') }}">Portfolio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.portfolio.category.entries', $category) }}">{{ $category->name }}</a></li>
                        <li class="breadcrumb-item active">{{ isset($entry) ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="entryForm" method="POST" 
                  action="{{ isset($entry) ? route('admin.portfolio.entries.update', $entry) : route('admin.portfolio.entries.store') }}" 
                  enctype="multipart/form-data">
                @csrf
                @if(isset($entry))
                    @method('PUT')
                @endif
                <input type="hidden" name="category_id" value="{{ $category->id }}">

                <div class="row">
                    <!-- Main Entry Form -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Entry Details</h3>
                            </div>
                            <div class="card-body">
                                <!-- Dynamic Fields Based on Category Structure -->
                                @foreach($category->structure as $field)
                                    <div class="form-group">
                                        <label for="{{ $field['name'] }}">
                                            {{ $field['label'] }}
                                            @if($field['required'])
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>

                                        @switch($field['type'])
                                            @case('text')
                                                <input type="text" 
                                                       class="form-control @error($field['name']) is-invalid @enderror" 
                                                       id="{{ $field['name'] }}" 
                                                       name="{{ $field['name'] }}" 
                                                       value="{{ old($field['name'], $entry->{$field['name']} ?? '') }}"
                                                       {{ $field['required'] ? 'required' : '' }}>
                                                @break

                                            @case('textarea')
                                                <textarea class="form-control @error($field['name']) is-invalid @enderror" 
                                                          id="{{ $field['name'] }}" 
                                                          name="{{ $field['name'] }}" 
                                                          rows="4"
                                                          {{ $field['required'] ? 'required' : '' }}>{{ old($field['name'], $entry->{$field['name']} ?? '') }}</textarea>
                                                @break

                                            @case('image')
                                                <div class="custom-file">
                                                    <input type="file" 
                                                           class="custom-file-input @error($field['name']) is-invalid @enderror" 
                                                           id="{{ $field['name'] }}" 
                                                           name="{{ $field['name'] }}" 
                                                           accept="image/*"
                                                           {{ $field['required'] && !isset($entry) ? 'required' : '' }}>
                                                    <label class="custom-file-label" for="{{ $field['name'] }}">Choose file</label>
                                                </div>
                                                @if(isset($entry) && $entry->{$field['name']})
                                                    <div class="mt-2">
                                                        <img src="{{ asset($entry->{$field['name']}) }}" 
                                                             alt="Current Image" 
                                                             class="img-thumbnail" 
                                                             width="200">
                                                    </div>
                                                @endif
                                                @break

                                            @case('gallery')
                                                <div class="dropzone" id="{{ $field['name'] }}Dropzone"></div>
                                                @if(isset($entry) && $entry->{$field['name']})
                                                    <div class="row mt-2">
                                                        @foreach($entry->{$field['name']} as $image)
                                                            <div class="col-md-3 mb-2">
                                                                <div class="position-relative">
                                                                    <img src="{{ asset($image) }}" 
                                                                         alt="Gallery Image" 
                                                                         class="img-thumbnail">
                                                                    <button type="button" 
                                                                            class="btn btn-danger btn-sm position-absolute" 
                                                                            style="top: 5px; right: 5px;"
                                                                            onclick="removeGalleryImage(this, '{{ $image }}')">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                @break

                                            @case('embed')
                                                <input type="text" 
                                                       class="form-control @error($field['name']) is-invalid @enderror" 
                                                       id="{{ $field['name'] }}" 
                                                       name="{{ $field['name'] }}" 
                                                       value="{{ old($field['name'], $entry->{$field['name']} ?? '') }}"
                                                       placeholder="Enter video URL (YouTube/Vimeo)"
                                                       {{ $field['required'] ? 'required' : '' }}>
                                                @if(isset($entry) && $entry->{$field['name']})
                                                    <div class="mt-2 embed-responsive embed-responsive-16by9">
                                                        <iframe class="embed-responsive-item" 
                                                                src="{{ $entry->{$field['name']} }}" 
                                                                allowfullscreen></iframe>
                                                    </div>
                                                @endif
                                                @break

                                            @case('select')
                                                <select class="form-control @error($field['name']) is-invalid @enderror" 
                                                        id="{{ $field['name'] }}" 
                                                        name="{{ $field['name'] }}"
                                                        {{ $field['required'] ? 'required' : '' }}>
                                                    <option value="">Select {{ $field['label'] }}</option>
                                                    @foreach($field['options'] as $option)
                                                        <option value="{{ $option }}" 
                                                                {{ old($field['name'], $entry->{$field['name']} ?? '') == $option ? 'selected' : '' }}>
                                                            {{ $option }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @break

                                            @case('file')
                                                <div class="custom-file">
                                                    <input type="file" 
                                                           class="custom-file-input @error($field['name']) is-invalid @enderror" 
                                                           id="{{ $field['name'] }}" 
                                                           name="{{ $field['name'] }}"
                                                           {{ $field['required'] && !isset($entry) ? 'required' : '' }}>
                                                    <label class="custom-file-label" for="{{ $field['name'] }}">Choose file</label>
                                                </div>
                                                @if(isset($entry) && $entry->{$field['name']})
                                                    <div class="mt-2">
                                                        <a href="{{ asset($entry->{$field['name']}) }}" 
                                                           class="btn btn-sm btn-info" 
                                                           target="_blank">
                                                            <i class="fas fa-download"></i> Current File
                                                        </a>
                                                    </div>
                                                @endif
                                                @break
                                        @endswitch

                                        @error($field['name'])
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <!-- Status Card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Publishing</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="draft" {{ old('status', $entry->status ?? 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $entry->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="publish_date">Publish Date</label>
                                    <input type="datetime-local" 
                                           class="form-control" 
                                           id="publish_date" 
                                           name="publish_date"
                                           value="{{ old('publish_date', isset($entry) ? $entry->publish_date->format('Y-m-d\TH:i') : '') }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($entry) ? 'Update Entry' : 'Create Entry' }}
                                </button>
                                <a href="{{ route('admin.portfolio.category.entries', $category) }}" class="btn btn-default">
                                    Cancel
                                </a>
                            </div>
                        </div>

                        <!-- SEO Card -->
                        <div class="card">
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
                                           value="{{ old('meta_title', $entry->meta_title ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea class="form-control" 
                                              id="meta_description" 
                                              name="meta_description" 
                                              rows="3">{{ old('meta_description', $entry->meta_description ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/dropzone/min/dropzone.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/admin/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize custom file inputs
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // Initialize Dropzone for gallery uploads
            Dropzone.autoDiscover = false;
            $('.dropzone').each(function() {
                let fieldName = $(this).attr('id').replace('Dropzone', '');
                new Dropzone('#' + $(this).attr('id'), {
                    url: "{{ route('admin.portfolio.entries.upload-gallery') }}",
                    paramName: "file",
                    maxFilesize: 5,
                    acceptedFiles: "image/*",
                    addRemoveLinks: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(file, response) {
                        let input = $('<input>', {
                            type: 'hidden',
                            name: fieldName + '[]',
                            value: response.path
                        }).appendTo('#entryForm');
                        file.previewElement.querySelector(".dz-remove").addEventListener("click", function() {
                            input.remove();
                        });
                    }
                });
            });

            // Handle video embed preview
            $('input[type="text"][name$="embed"]').on('change', function() {
                let url = $(this).val();
                if (url) {
                    let embedUrl = getEmbedUrl(url);
                    if (embedUrl) {
                        $(this).next('.embed-responsive').remove();
                        $(this).after(`
                            <div class="mt-2 embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="${embedUrl}" allowfullscreen></iframe>
                            </div>
                        `);
                    }
                }
            });
        });

        // Helper function to convert video URLs to embed URLs
        function getEmbedUrl(url) {
            let youtubeMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
            if (youtubeMatch) {
                return `https://www.youtube.com/embed/${youtubeMatch[1]}`;
            }

            let vimeoMatch = url.match(/vimeo\.com\/(?:.*#|.*)\/?([\d]+)/);
            if (vimeoMatch) {
                return `https://player.vimeo.com/video/${vimeoMatch[1]}`;
            }

            return null;
        }

        // Remove gallery image
        function removeGalleryImage(button, imagePath) {
            if (confirm('Are you sure you want to remove this image?')) {
                $(button).closest('.col-md-3').remove();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'remove_gallery[]',
                    value: imagePath
                }).appendTo('#entryForm');
            }
        }
    </script>
@endpush 