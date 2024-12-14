@extends('admin.layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">{{ isset($service) ? 'Edit Service' : 'Create Service' }}</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
                        <li class="breadcrumb-item active">{{ isset($service) ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @if(isset($service))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" 
                                               class="form-control @error('title') is-invalid @enderror"
                                               name="title"
                                               value="{{ old('title', $service->title ?? '') }}"
                                               required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Icon</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="{{ old('icon', $service->icon ?? '') }}"></i>
                                            </span>
                                            <input type="text" 
                                                   class="form-control @error('icon') is-invalid @enderror"
                                                   name="icon"
                                                   value="{{ old('icon', $service->icon ?? '') }}"
                                                   placeholder="fas fa-icon-name">
                                        </div>
                                        @error('icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          name="description"
                                          rows="4"
                                          required>{{ old('description', $service->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" 
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   name="price"
                                                   value="{{ old('price', $service->price ?? '') }}"
                                                   step="0.01">
                                        </div>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input type="checkbox"
                                                   class="form-check-input"
                                                   name="is_active"
                                                   value="1"
                                                   {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Features</label>
                                <div class="feature-list">
                                    @if(isset($service) && $service->features)
                                        @foreach($service->features as $index => $feature)
                                            <div class="input-group mb-2">
                                                <input type="text"
                                                       class="form-control"
                                                       name="features[]"
                                                       value="{{ $feature }}">
                                                <button type="button" class="btn btn-danger remove-feature">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="input-group mb-2">
                                        <input type="text"
                                               class="form-control"
                                               name="features[]"
                                               placeholder="Add a feature">
                                        <button type="button" class="btn btn-success add-feature">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pricing Details</label>
                                <div class="pricing-details">
                                    @if(isset($service) && $service->pricing_details)
                                        @foreach($service->pricing_details as $key => $value)
                                            <div class="input-group mb-2">
                                                <input type="text"
                                                       class="form-control"
                                                       name="pricing_keys[]"
                                                       value="{{ $key }}"
                                                       placeholder="Detail name">
                                                <input type="text"
                                                       class="form-control"
                                                       name="pricing_values[]"
                                                       value="{{ $value }}"
                                                       placeholder="Detail value">
                                                <button type="button" class="btn btn-danger remove-pricing">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="input-group mb-2">
                                        <input type="text"
                                               class="form-control"
                                               name="pricing_keys[]"
                                               placeholder="Detail name">
                                        <input type="text"
                                               class="form-control"
                                               name="pricing_values[]"
                                               placeholder="Detail value">
                                        <button type="button" class="btn btn-success add-pricing">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($service) ? 'Update Service' : 'Create Service' }}
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
    // Add feature
    $('.add-feature').click(function() {
        var template = `
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="features[]" placeholder="Add a feature">
                <button type="button" class="btn btn-danger remove-feature">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        $(this).closest('.input-group').before(template);
    });

    // Remove feature
    $(document).on('click', '.remove-feature', function() {
        $(this).closest('.input-group').remove();
    });

    // Add pricing detail
    $('.add-pricing').click(function() {
        var template = `
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="pricing_keys[]" placeholder="Detail name">
                <input type="text" class="form-control" name="pricing_values[]" placeholder="Detail value">
                <button type="button" class="btn btn-danger remove-pricing">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        $(this).closest('.input-group').before(template);
    });

    // Remove pricing detail
    $(document).on('click', '.remove-pricing', function() {
        $(this).closest('.input-group').remove();
    });

    // Icon preview
    $('input[name="icon"]').on('input', function() {
        $(this).prev('.input-group-text').find('i').attr('class', $(this).val());
    });
});
</script>
@endpush
