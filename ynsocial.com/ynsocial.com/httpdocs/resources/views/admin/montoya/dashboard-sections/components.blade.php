<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="card-title mb-0">Theme Components</h6>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addComponentModal">
            <i class="fas fa-plus me-2"></i>Add Component
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Component</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Last Modified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['components'] as $component)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-light">
                                    <i class="fas {{ $component->icon ?? 'fa-cube' }}"></i>
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-0">{{ $component->name }}</h6>
                                    <small class="text-muted">{{ $component->description }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $component->category->name }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input component-status" type="checkbox" 
                                    data-id="{{ $component->id }}"
                                    {{ $component->active ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>{{ $component->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary edit-component" 
                                    data-id="{{ $component->id }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editComponentModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger delete-component" 
                                    data-id="{{ $component->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Component Modal -->
<div class="modal fade" id="addComponentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Component</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addComponentForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Component Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category_id" required>
                            @foreach($data['categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome)</label>
                        <input type="text" class="form-control" name="icon" placeholder="fa-cube">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Component</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Component Modal -->
<div class="modal fade" id="editComponentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Component</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editComponentForm">
                <input type="hidden" name="component_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Component Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category_id" required>
                            @foreach($data['categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome)</label>
                        <input type="text" class="form-control" name="icon" placeholder="fa-cube">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Handle component status toggle
    $('.component-status').change(function() {
        const componentId = $(this).data('id');
        const active = $(this).prop('checked');
        
        $.ajax({
            url: '{{ route("admin.dashboard.components.toggle") }}',
            type: 'POST',
            data: {
                component_id: componentId,
                active: active,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success('Component status updated successfully');
            },
            error: function() {
                toastr.error('Error updating component status');
            }
        });
    });

    // Handle add component form submission
    $('#addComponentForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.dashboard.components.store") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#addComponentModal').modal('hide');
                toastr.success('Component added successfully');
                location.reload();
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON.message || 'Error adding component');
            }
        });
    });

    // Handle edit component button click
    $('.edit-component').click(function() {
        const componentId = $(this).data('id');
        
        $.ajax({
            url: '{{ route("admin.dashboard.components.get") }}',
            type: 'GET',
            data: { component_id: componentId },
            success: function(response) {
                const form = $('#editComponentForm');
                form.find('[name="component_id"]').val(response.id);
                form.find('[name="name"]').val(response.name);
                form.find('[name="description"]').val(response.description);
                form.find('[name="category_id"]').val(response.category_id);
                form.find('[name="icon"]').val(response.icon);
            }
        });
    });

    // Handle edit component form submission
    $('#editComponentForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.dashboard.components.update") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#editComponentModal').modal('hide');
                toastr.success('Component updated successfully');
                location.reload();
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON.message || 'Error updating component');
            }
        });
    });

    // Handle delete component button click
    $('.delete-component').click(function() {
        const componentId = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this component?')) {
            $.ajax({
                url: '{{ route("admin.dashboard.components.delete") }}',
                type: 'POST',
                data: {
                    component_id: componentId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success('Component deleted successfully');
                    location.reload();
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message || 'Error deleting component');
                }
            });
        }
    });
});
</script>
@endpush
