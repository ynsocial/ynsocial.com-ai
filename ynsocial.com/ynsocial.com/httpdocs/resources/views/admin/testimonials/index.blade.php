@extends('admin.layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Testimonials Management</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Testimonials</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Add New Testimonial
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Grid -->
        <div class="row">
            @foreach($testimonials as $testimonial)
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                @if($testimonial->client_image)
                                    <img src="{{ asset($testimonial->client_image) }}" 
                                         alt="{{ $testimonial->client_name }}"
                                         class="rounded-circle avatar-lg">
                                @else
                                    <div class="avatar-lg rounded-circle bg-soft-primary">
                                        <span class="font-size-24 p-2">
                                            {{ substr($testimonial->client_name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="font-size-16 mb-1">{{ $testimonial->client_name }}</h5>
                                <p class="text-muted mb-0">
                                    {{ $testimonial->position }}, {{ $testimonial->company_name }}
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('admin.testimonials.edit', $testimonial->id) }}">
                                            <i class="fas fa-edit me-2"></i> Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash me-2"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                        </div>

                        <div class="mt-3">
                            <p class="text-muted mb-0">{{ $testimonial->testimonial }}</p>
                        </div>

                        <div class="mt-3">
                            <div class="row">
                                <div class="col">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" 
                                               class="form-check-input featured-toggle"
                                               data-url="{{ route('admin.testimonials.toggle-featured', $testimonial->id) }}"
                                               {{ $testimonial->is_featured ? 'checked' : '' }}>
                                        <label class="form-check-label">Featured</label>
                                    </div>
                                </div>
                                <div class="col text-end">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" 
                                               class="form-check-input status-toggle"
                                               data-url="{{ route('admin.testimonials.toggle-status', $testimonial->id) }}"
                                               {{ $testimonial->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-12">
                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle featured status
    $('.featured-toggle').change(function() {
        var url = $(this).data('url');
        $.post(url, {
            _token: '{{ csrf_token() }}'
        });
    });

    // Toggle active status
    $('.status-toggle').change(function() {
        var url = $(this).data('url');
        $.post(url, {
            _token: '{{ csrf_token() }}'
        });
    });
});
</script>
@endpush
