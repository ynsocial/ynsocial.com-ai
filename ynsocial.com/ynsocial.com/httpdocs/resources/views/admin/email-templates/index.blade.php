@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Email Templates</h1>
        <a href="{{ route('admin.email-templates.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Template
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($templates as $template)
                            <tr>
                                <td>{{ $template->name }}</td>
                                <td>{{ $template->subject }}</td>
                                <td>{{ $template->description }}</td>
                                <td>
                                    <span class="badge badge-{{ $template->is_active ? 'success' : 'danger' }}">
                                        {{ $template->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    {{ $template->updated_at->format('Y-m-d H:i') }}
                                    @if($template->updatedBy)
                                        by {{ $template->updatedBy->name }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.email-templates.edit', $template) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-info preview-template" 
                                                data-template-id="{{ $template->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <form action="{{ route('admin.email-templates.destroy', $template) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No templates found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{ $templates->links() }}
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Template Preview</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" class="form-control" id="previewSubject" readonly>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <div class="border p-3 bg-light" id="previewContent"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.preview-template').click(function() {
        const templateId = $(this).data('template-id');
        
        $.get(`/admin/email-templates/${templateId}/preview`, function(template) {
            $('#previewSubject').val(template.subject);
            $('#previewContent').html(template.content);
            $('#previewModal').modal('show');
        });
    });
});
</script>
@endpush
