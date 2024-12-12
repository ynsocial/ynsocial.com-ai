@extends('admin.layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">{{ isset($testimonial) ? 'Edit Testimonial' : 'Create Testimonial' }}</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
                        <li class="breadcrumb-item active">{{ isset($testimonial) ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @if(isset($testimonial))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Client Name</label>
                                        <input type="text" 
                                               class="form-control @error('client_name') is-invalid @enderror"
                                               name="client_name"
                                               value="{{ old('client_name', $testimonial->client_name ?? '') }}"
                                               required>
                                        @error('client_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" 
                                               class="form-control @error('company_name') is-invalid @enderror"
                                               name="company_name"
                                               value="{{ old('company_name', $testimonial->company_name ?? '') }}">
                                        @error('company_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Position</label>
                                        <input type="text" 
                                               class="form-control @error('position') is-invalid @enderror"
                                               name="position"
                                               value="{{ old('position', $testimonial->position ?? '') }}">
                                        @error('position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Rating</label>
                                        <select class="form-select @error('rating') is-invalid @enderror"
                                                name="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}"
                                                        {{ old('rating', $testimonial->rating ?? '') == $i ? 'selected' : '' }}>
                                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('rating')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Testimonial</label>
                                <textarea class="form-control @error('testimonial') is-invalid @enderror"
                                          name="testimonial"
                                          rows="4"
                                          required>{{ old('testimonial', $testimonial->testimonial ?? '') }}</textarea>
                                @error('testimonial')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Client Image</label>
                                        <input type="file" 
                                               class="form-control @error('client_image') is-invalid @enderror"
                                               name="client_image"
                                               accept="image/*">
                                        @error('client_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(isset($testimonial) && $testimonial->client_image)
                                            <div class="mt-2">
                                                <img src="{{ asset($testimonial->client_image) }}" 
                                                     alt="Current Image"
                                                     class="img-thumbnail"
                                                     style="max-width: 150px">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Logo</label>
                                        <input type="file" 
                                               class="form-control @error('company_logo') is-invalid @enderror"
                                               name="company_logo"
                                               accept="image/*">
                                        @error('company_logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(isset($testimonial) && $testimonial->company_logo)
                                            <div class="mt-2">
                                                <img src="{{ asset($testimonial->company_logo) }}" 
                                                     alt="Current Logo"
                                                     class="img-thumbnail"
                                                     style="max-width: 150px">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input type="checkbox"
                                                   class="form-check-input"
                                                   name="is_featured"
                                                   value="1"
                                                   {{ old('is_featured', $testimonial->is_featured ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label">Featured Testimonial</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input type="checkbox"
                                                   class="form-check-input"
                                                   name="is_active"
                                                   value="1"
                                                   {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($testimonial) ? 'Update Testimonial' : 'Create Testimonial' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Preview uploaded images
    $('input[type="file"]').change(function(e) {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(input).next('.invalid-feedback').next('div').find('img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
});
</script>
@endpush
