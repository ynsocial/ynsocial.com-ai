<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">Categories</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="fas fa-plus me-1"></i>Add
                </button>
            </div>
            <div class="card-body">
                <div class="dd" id="categoryList">
                    <ol class="dd-list">
                        @foreach($data['categories'] as $category)
                        <li class="dd-item" data-id="{{ $category->id }}">
                            <div class="dd-handle">
                                <i class="fas {{ $category->icon }}"></i>
                                <span class="ms-2">{{ $category->name }}</span>
                                <small class="text-muted">({{ $category->components_count }})</small>
                            </div>
                            <div class="dd-actions">
                                <button class="btn btn-sm btn-outline-primary edit-category" 
                                    data-id="{{ $category->id }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editCategoryModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger delete-category" 
                                    data-id="{{ $category->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Category Components</h6>
            </div>
            <div class="card-body">
                <div id="categoryComponentsContainer">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Component</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Last Modified</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['components'] as $component)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-light">
                                                <i class="fas {{ $component->icon }}"></i>
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0">{{ $component->name }}</h6>
                                                <small class="text-muted">{{ $component->description }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $component->type }}</td>
                                    <td>
                                        <span class="badge bg-{{ $component->active ? 'success' : 'danger' }}">
                                            {{ $component->active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $component->updated_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addCategoryForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome)</label>
                        <input type="text" class="form-control" name="icon" placeholder="fa-folder">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parent Category</label>
                        <select class="form-select" name="parent_id">
                            <option value="">None</option>
                            @foreach($data['categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCategoryForm">
                <input type="hidden" name="category_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome)</label>
                        <input type="text" class="form-control" name="icon" placeholder="fa-folder">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parent Category</label>
                        <select class="form-select" name="parent_id">
                            <option value="">None</option>
                            @foreach($data['categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css" rel="stylesheet">
<style>
.dd-actions {
    position: absolute;
    right: 5px;
    top: 5px;
    display: none;
}
.dd-item:hover .dd-actions {
    display: block;
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Nestable
    $('#categoryList').nestable({
        group: 1,
        maxDepth: 3
    }).on('change', function() {
        const data = $('#categoryList').nestable('serialize');
        $.ajax({
            url: '{{ route("admin.dashboard.categories.reorder") }}',
            type: 'POST',
            data: {
                categories: data,
                _token: '{{ csrf_token() }}'
            },
            success: function() {
                toastr.success('Category order updated');
            }
        });
    });

    // Handle category selection
    $('.dd-handle').click(function() {
        const categoryId = $(this).parent().data('id');
        
        $.ajax({
            url: '{{ route("admin.dashboard.categories.components") }}',
            type: 'GET',
            data: { category_id: categoryId },
            success: function(response) {
                $('#categoryComponentsContainer').html(response);
            }
        });
    });

    // Handle add category form
    $('#addCategoryForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.dashboard.categories.store") }}',
            type: 'POST',
            data: formData,
            success: function() {
                $('#addCategoryModal').modal('hide');
                toastr.success('Category added successfully');
                location.reload();
            }
        });
    });

    // Handle edit category
    $('.edit-category').click(function() {
        const id = $(this).data('id');
        
        $.ajax({
            url: '{{ route("admin.dashboard.categories.get") }}',
            type: 'GET',
            data: { category_id: id },
            success: function(response) {
                const form = $('#editCategoryForm');
                form.find('[name="category_id"]').val(response.id);
                form.find('[name="name"]').val(response.name);
                form.find('[name="description"]').val(response.description);
                form.find('[name="icon"]').val(response.icon);
                form.find('[name="parent_id"]').val(response.parent_id);
            }
        });
    });

    // Handle edit category form
    $('#editCategoryForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.dashboard.categories.update") }}',
            type: 'POST',
            data: formData,
            success: function() {
                $('#editCategoryModal').modal('hide');
                toastr.success('Category updated successfully');
                location.reload();
            }
        });
    });

    // Handle delete category
    $('.delete-category').click(function() {
        const id = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this category? This will also delete all components in this category.')) {
            $.ajax({
                url: '{{ route("admin.dashboard.categories.delete") }}',
                type: 'POST',
                data: {
                    category_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    toastr.success('Category deleted successfully');
                    location.reload();
                }
            });
        }
    });
});
</script>
@endpush
