<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Layout Sections</h6>
            </div>
            <div class="card-body">
                <div class="list-group" id="layoutSections">
                    @foreach($data['layoutSections'] as $section)
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center layout-section" 
                        data-id="{{ $section->id }}">
                        <div>
                            <h6 class="mb-1">{{ $section->name }}</h6>
                            <small class="text-muted">{{ $section->description }}</small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input section-status" 
                                type="checkbox" 
                                data-id="{{ $section->id }}"
                                {{ $section->active ? 'checked' : '' }}>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">Section Components</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSectionComponentModal">
                    <i class="fas fa-plus me-1"></i>Add Component
                </button>
            </div>
            <div class="card-body">
                <div id="sectionComponentsContainer">
                    <div class="dd" id="sectionComponents">
                        <ol class="dd-list">
                            @foreach($data['sectionComponents'] as $component)
                            <li class="dd-item" data-id="{{ $component->id }}">
                                <div class="dd-handle">
                                    <i class="fas {{ $component->icon }}"></i>
                                    <span class="ms-2">{{ $component->name }}</span>
                                    <small class="text-muted ms-2">{{ $component->type }}</small>
                                </div>
                                <div class="dd-actions">
                                    <button class="btn btn-sm btn-outline-primary edit-section-component" 
                                        data-id="{{ $component->id }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editSectionComponentModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-section-component" 
                                        data-id="{{ $component->id }}">
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

        <div class="card mt-4">
            <div class="card-header">
                <h6 class="card-title mb-0">Layout Preview</h6>
            </div>
            <div class="card-body">
                <div class="layout-preview border rounded p-3">
                    @foreach($data['layoutSections'] as $section)
                    <div class="layout-section-preview mb-3 {{ $section->active ? '' : 'disabled' }}" 
                        data-section-id="{{ $section->id }}">
                        <div class="section-header bg-light p-2 rounded">
                            <h6 class="mb-0">{{ $section->name }}</h6>
                        </div>
                        <div class="section-content p-2">
                            @foreach($section->components as $component)
                            <div class="component-preview bg-white border rounded p-2 mb-2">
                                <i class="fas {{ $component->icon }}"></i>
                                <span class="ms-2">{{ $component->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Section Component Modal -->
<div class="modal fade" id="addSectionComponentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Section Component</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addSectionComponentForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Component Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Component Type</label>
                        <select class="form-select" name="type" required>
                            <option value="widget">Widget</option>
                            <option value="module">Module</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome)</label>
                        <input type="text" class="form-control" name="icon" placeholder="fa-puzzle-piece">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" name="content" rows="3"></textarea>
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

<!-- Edit Section Component Modal -->
<div class="modal fade" id="editSectionComponentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Section Component</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editSectionComponentForm">
                <input type="hidden" name="component_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Component Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Component Type</label>
                        <select class="form-select" name="type" required>
                            <option value="widget">Widget</option>
                            <option value="module">Module</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome)</label>
                        <input type="text" class="form-control" name="icon" placeholder="fa-puzzle-piece">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" name="content" rows="3"></textarea>
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
.layout-section-preview.disabled {
    opacity: 0.5;
    pointer-events: none;
}
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
    $('#sectionComponents').nestable({
        group: 1,
        maxDepth: 2
    }).on('change', function() {
        const data = $('#sectionComponents').nestable('serialize');
        $.ajax({
            url: '{{ route("admin.dashboard.layout.components.reorder") }}',
            type: 'POST',
            data: {
                components: data,
                _token: '{{ csrf_token() }}'
            },
            success: function() {
                toastr.success('Component order updated');
                updateLayoutPreview();
            }
        });
    });

    // Handle section selection
    $('.layout-section').click(function(e) {
        e.preventDefault();
        const sectionId = $(this).data('id');
        
        $('.layout-section').removeClass('active');
        $(this).addClass('active');
        
        $.ajax({
            url: '{{ route("admin.dashboard.layout.components") }}',
            type: 'GET',
            data: { section_id: sectionId },
            success: function(response) {
                $('#sectionComponentsContainer').html(response);
                
                // Reinitialize Nestable
                $('#sectionComponents').nestable({
                    group: 1,
                    maxDepth: 2
                });
            }
        });
    });

    // Handle section status toggle
    $('.section-status').change(function() {
        const sectionId = $(this).data('id');
        const active = $(this).prop('checked');
        
        $.ajax({
            url: '{{ route("admin.dashboard.layout.sections.toggle") }}',
            type: 'POST',
            data: {
                section_id: sectionId,
                active: active,
                _token: '{{ csrf_token() }}'
            },
            success: function() {
                toastr.success('Section status updated');
                updateLayoutPreview();
            }
        });
    });

    // Handle add section component form
    $('#addSectionComponentForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.dashboard.layout.components.store") }}',
            type: 'POST',
            data: formData,
            success: function() {
                $('#addSectionComponentModal').modal('hide');
                toastr.success('Component added successfully');
                updateLayoutPreview();
            }
        });
    });

    // Handle edit section component
    $('.edit-section-component').click(function() {
        const id = $(this).data('id');
        
        $.ajax({
            url: '{{ route("admin.dashboard.layout.components.get") }}',
            type: 'GET',
            data: { component_id: id },
            success: function(response) {
                const form = $('#editSectionComponentForm');
                form.find('[name="component_id"]').val(response.id);
                form.find('[name="name"]').val(response.name);
                form.find('[name="type"]').val(response.type);
                form.find('[name="icon"]').val(response.icon);
                form.find('[name="content"]').val(response.content);
            }
        });
    });

    // Handle edit section component form
    $('#editSectionComponentForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.dashboard.layout.components.update") }}',
            type: 'POST',
            data: formData,
            success: function() {
                $('#editSectionComponentModal').modal('hide');
                toastr.success('Component updated successfully');
                updateLayoutPreview();
            }
        });
    });

    // Handle delete section component
    $('.delete-section-component').click(function() {
        const id = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this component?')) {
            $.ajax({
                url: '{{ route("admin.dashboard.layout.components.delete") }}',
                type: 'POST',
                data: {
                    component_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    toastr.success('Component deleted successfully');
                    updateLayoutPreview();
                }
            });
        }
    });

    // Update layout preview
    function updateLayoutPreview() {
        $.ajax({
            url: '{{ route("admin.dashboard.layout.preview") }}',
            type: 'GET',
            success: function(response) {
                $('.layout-preview').html(response);
            }
        });
    }
});
</script>
@endpush
