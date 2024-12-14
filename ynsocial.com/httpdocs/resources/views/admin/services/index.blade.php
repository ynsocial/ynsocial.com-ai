@extends('admin.layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Services Management</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Services</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Add New Service
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services List -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Features</th>
                                        <th>Status</th>
                                        <th>Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="sortable" data-url="{{ route('admin.services.reorder') }}">
                                    @foreach($services as $service)
                                    <tr data-id="{{ $service->id }}">
                                        <td>
                                            <i class="{{ $service->icon }} fa-2x"></i>
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 mb-1">{{ $service->title }}</h5>
                                            <p class="text-muted mb-0">{{ Str::limit($service->description, 50) }}</p>
                                        </td>
                                        <td>${{ number_format($service->price, 2) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#featuresModal{{ $service->id }}">
                                                View Features
                                            </button>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input status-toggle"
                                                    data-url="{{ route('admin.services.toggle-status', $service->id) }}"
                                                    {{ $service->is_active ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="fas fa-grip-vertical handle"></i>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.services.edit', $service->id) }}" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.services.destroy', $service->id) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Features Modal -->
                                    <div class="modal fade" id="featuresModal{{ $service->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $service->title }} - Features</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        @foreach($service->features as $feature)
                                                        <li class="list-group-item">{{ $feature }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('admin/libs/dragula/dragula.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('admin/libs/dragula/dragula.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize drag and drop
    var drake = dragula([document.querySelector('.sortable tbody')], {
        moves: function(el, container, handle) {
            return handle.classList.contains('handle');
        }
    });

    // Update order after drag
    drake.on('drop', function() {
        var order = [];
        $('.sortable tbody tr').each(function(index) {
            order.push({
                id: $(this).data('id'),
                position: index + 1
            });
        });

        $.ajax({
            url: $('.sortable').data('url'),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                order: order
            }
        });
    });

    // Toggle status
    $('.status-toggle').change(function() {
        var url = $(this).data('url');
        $.post(url, {
            _token: '{{ csrf_token() }}'
        });
    });
});
</script>
@endpush
