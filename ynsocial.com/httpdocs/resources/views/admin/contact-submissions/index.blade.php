@extends('layouts.admin')

@section('title', 'Contact Submissions')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Form Submissions</h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-download"></i> Export
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ route('admin.contact-submissions.export', ['format' => 'csv'] + request()->query()) }}" class="dropdown-item">
                                    <i class="fas fa-file-csv"></i> Export as CSV
                                </a>
                                <a href="{{ route('admin.contact-submissions.export', ['format' => 'excel'] + request()->query()) }}" class="dropdown-item">
                                    <i class="fas fa-file-excel"></i> Export as Excel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <form action="{{ route('admin.contact-submissions.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search</label>
                                    <input type="text" name="search" class="form-control" placeholder="Search by name, email, or subject..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="all">All Status</option>
                                        @foreach($statusOptions as $value => $label)
                                            <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Submissions Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{ route('admin.contact-submissions.index', ['sort' => 'created_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Date
                                            @if(request('sort') === 'created_at')
                                                <i class="fas fa-sort-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.contact-submissions.index', ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'] + request()->except(['sort', 'direction'])) }}">
                                            Name
                                            @if(request('sort') === 'name')
                                                <i class="fas fa-sort-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                    <th>Respond</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($submissions as $submission)
                                    <tr>
                                        <td>{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                                        <td>{{ $submission->name }}</td>
                                        <td>
                                            <a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a>
                                        </td>
                                        <td>{{ $submission->phone }}</td>
                                        <td>{{ $submission->subject }}</td>
                                        <td>
                                            <select class="form-control form-control-sm status-select" 
                                                    data-submission-id="{{ $submission->id }}"
                                                    data-original-status="{{ $submission->status }}">
                                                @foreach($statusOptions as $value => $label)
                                                    <option value="{{ $value }}" {{ $submission->status === $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#messageModal{{ $submission->id }}">
                                                View Message
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailsModal{{ $submission->id }}">
                                                Details
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" onclick="openResponseModal('{{ $submission->id }}')">
                                                <i class="fas fa-reply"></i> Respond
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Message Modal -->
                                    <div class="modal fade" id="messageModal{{ $submission->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Message from {{ $submission->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $submission->message }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Details Modal -->
                                    <div class="modal fade" id="detailsModal{{ $submission->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Submission Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Submission ID</dt>
                                                        <dd class="col-sm-8">{{ $submission->id }}</dd>

                                                        <dt class="col-sm-4">Date & Time</dt>
                                                        <dd class="col-sm-8">{{ $submission->created_at->format('Y-m-d H:i:s') }}</dd>

                                                        <dt class="col-sm-4">Status</dt>
                                                        <dd class="col-sm-8">
                                                            <span class="badge badge-{{ $submission->status === 'new' ? 'primary' : ($submission->status === 'reviewed' ? 'warning' : 'success') }}">
                                                                {{ $statusOptions[$submission->status] }}
                                                            </span>
                                                        </dd>

                                                        <dt class="col-sm-4">Last Updated</dt>
                                                        <dd class="col-sm-8">
                                                            {{ $submission->status_updated_at ? $submission->status_updated_at->format('Y-m-d H:i:s') : 'Never' }}
                                                            @if($submission->statusUpdatedBy)
                                                                by {{ $submission->statusUpdatedBy->name }}
                                                            @endif
                                                        </dd>

                                                        <dt class="col-sm-4">Admin Notes</dt>
                                                        <dd class="col-sm-8">
                                                            <textarea class="form-control admin-notes" 
                                                                    data-submission-id="{{ $submission->id }}"
                                                                    rows="3">{{ $submission->admin_notes }}</textarea>
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary save-notes" data-submission-id="{{ $submission->id }}">
                                                        Save Notes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No submissions found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $submissions->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this modal for email responses -->
<div class="modal fade" id="responseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Response</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="responseForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="templateSelect" class="form-label">Email Template</label>
                        <select class="form-select" id="templateSelect" name="template_id">
                            <option value="">Custom Response</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="responseMessage" class="form-label">Response Message</label>
                        <textarea class="form-control" id="responseMessage" name="message" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="attachments" class="form-label">Attachments (optional)</label>
                        <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                        <small class="text-muted">Max 10MB per file</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send Response</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .table th a {
        color: inherit;
        text-decoration: none;
    }
    .table th a:hover {
        color: var(--primary);
    }
    .status-select {
        min-width: 100px;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Status change handler
    $('.status-select').on('change', function() {
        var select = $(this);
        var submissionId = select.data('submission-id');
        var originalStatus = select.data('original-status');
        var newStatus = select.val();
        
        $.ajax({
            url: `/admin/contact-submissions/${submissionId}/status`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Status updated successfully');
                    select.data('original-status', newStatus);
                } else {
                    toastr.error('Failed to update status');
                    select.val(originalStatus);
                }
            },
            error: function() {
                toastr.error('Failed to update status');
                select.val(originalStatus);
            }
        });
    });

    // Save notes handler
    $('.save-notes').on('click', function() {
        var submissionId = $(this).data('submission-id');
        var notes = $(`textarea[data-submission-id="${submissionId}"]`).val();
        var status = $(`.status-select[data-submission-id="${submissionId}"]`).val();
        
        $.ajax({
            url: `/admin/contact-submissions/${submissionId}/status`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status,
                notes: notes
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Notes saved successfully');
                    $(`#detailsModal${submissionId}`).modal('hide');
                } else {
                    toastr.error('Failed to save notes');
                }
            },
            error: function() {
                toastr.error('Failed to save notes');
            }
        });
    });

    // Add this to your existing JavaScript
    let currentSubmissionId = null;

    function openResponseModal(submissionId) {
        currentSubmissionId = submissionId;
        $('#responseModal').modal('show');
    }

    $('#responseForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: `/admin/contact-submissions/${currentSubmissionId}/respond`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#responseModal').modal('hide');
                toastr.success('Response sent successfully');
                // Refresh the submission data
                loadSubmissions();
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Failed to send response');
            }
        });
    });

    let templates = [];

    function loadTemplates() {
        $.get('/admin/contact-submissions/templates', function(data) {
            templates = data;
            const select = $('#templateSelect');
            select.empty();
            select.append('<option value="">Custom Response</option>');
            
            templates.forEach(template => {
                select.append(`<option value="${template.id}">${template.name}</option>`);
            });
        });
    }

    $('#templateSelect').change(function() {
        const templateId = $(this).val();
        if (templateId) {
            const template = templates.find(t => t.id == templateId);
            if (template) {
                $('#responseMessage').val(template.content);
            }
        } else {
            $('#responseMessage').val('');
        }
    });

    // Load templates when the page loads
    $(document).ready(function() {
        loadTemplates();
    });
});
</script>
@endpush
