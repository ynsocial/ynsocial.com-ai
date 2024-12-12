<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">Menu Locations</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addLocationModal">
                    <i class="fas fa-plus me-1"></i>Add
                </button>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush" id="menuLocations">
                    @foreach($data['menuLocations'] as $location)
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center menu-location" 
                        data-id="{{ $location->id }}">
                        {{ $location->name }}
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary edit-location" 
                                data-id="{{ $location->id }}"
                                data-name="{{ $location->name }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#editLocationModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger delete-location" data-id="{{ $location->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
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
                <h6 class="card-title mb-0">Menu Items</h6>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMenuItemModal">
                    <i class="fas fa-plus me-1"></i>Add Item
                </button>
            </div>
            <div class="card-body">
                <div id="menuItemsContainer">
                    <div class="dd" id="menuItems">
                        <ol class="dd-list">
                            @foreach($data['menuItems'] as $item)
                            <li class="dd-item" data-id="{{ $item->id }}">
                                <div class="dd-handle">
                                    <i class="fas {{ $item->icon }}"></i>
                                    <span class="ms-2">{{ $item->label }}</span>
                                    <small class="text-muted ms-2">{{ $item->url }}</small>
                                </div>
                                <div class="dd-actions">
                                    <button class="btn btn-sm btn-outline-primary edit-menu-item" 
                                        data-id="{{ $item->id }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editMenuItemModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-menu-item" 
                                        data-id="{{ $item->id }}">
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
    </div>
</div>

<!-- Add Location Modal -->
<div class="modal fade" id="addLocationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Menu Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addLocationForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Location Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Location</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Location Modal -->
<div class="modal fade" id="editLocationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Menu Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editLocationForm">
                <input type="hidden" name="location_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Location Name</label>
                        <input type="text" class="form-control" name="name" required>
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

<!-- Add Menu Item Modal -->
<div class="modal fade" id="addMenuItemModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addMenuItemForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Label</label>
                        <input type="text" class="form-control" name="label" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome)</label>
                        <input type="text" class="form-control" name="icon" placeholder="fa-home">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Target</label>
                        <select class="form-select" name="target">
                            <option value="_self">Same Window</option>
                            <option value="_blank">New Window</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Menu Item Modal -->
<div class="modal fade" id="editMenuItemModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editMenuItemForm">
                <input type="hidden" name="item_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Label</label>
                        <input type="text" class="form-control" name="label" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (FontAwesome)</label>
                        <input type="text" class="form-control" name="icon" placeholder="fa-home">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Target</label>
                        <select class="form-select" name="target">
                            <option value="_self">Same Window</option>
                            <option value="_blank">New Window</option>
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
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Nestable
    $('#menuItems').nestable({
        group: 1,
        maxDepth: 3
    }).on('change', function() {
        const data = $('#menuItems').nestable('serialize');
        $.ajax({
            url: '{{ route("admin.dashboard.menus.reorder") }}',
            type: 'POST',
            data: {
                items: data,
                _token: '{{ csrf_token() }}'
            },
            success: function() {
                toastr.success('Menu order updated');
            }
        });
    });

    // Handle location selection
    $('.menu-location').click(function(e) {
        e.preventDefault();
        const locationId = $(this).data('id');
        
        $('.menu-location').removeClass('active');
        $(this).addClass('active');
        
        $.ajax({
            url: '{{ route("admin.dashboard.menus.items") }}',
            type: 'GET',
            data: { location_id: locationId },
            success: function(response) {
                // Update menu items
                $('#menuItemsContainer').html(response);
                
                // Reinitialize Nestable
                $('#menuItems').nestable({
                    group: 1,
                    maxDepth: 3
                });
            }
        });
    });

    // Handle add location form
    $('#addLocationForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.dashboard.menus.locations.store") }}',
            type: 'POST',
            data: formData,
            success: function() {
                $('#addLocationModal').modal('hide');
                toastr.success('Location added successfully');
                location.reload();
            }
        });
    });

    // Handle edit location
    $('.edit-location').click(function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        
        const form = $('#editLocationForm');
        form.find('[name="location_id"]').val(id);
        form.find('[name="name"]').val(name);
    });

    // Handle edit location form
    $('#editLocationForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.dashboard.menus.locations.update") }}',
            type: 'POST',
            data: formData,
            success: function() {
                $('#editLocationModal').modal('hide');
                toastr.success('Location updated successfully');
                location.reload();
            }
        });
    });

    // Handle delete location
    $('.delete-location').click(function() {
        const id = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this location?')) {
            $.ajax({
                url: '{{ route("admin.dashboard.menus.locations.delete") }}',
                type: 'POST',
                data: {
                    location_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    toastr.success('Location deleted successfully');
                    location.reload();
                }
            });
        }
    });

    // Handle add menu item form
    $('#addMenuItemForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.dashboard.menus.items.store") }}',
            type: 'POST',
            data: formData,
            success: function() {
                $('#addMenuItemModal').modal('hide');
                toastr.success('Menu item added successfully');
                location.reload();
            }
        });
    });

    // Handle edit menu item
    $('.edit-menu-item').click(function() {
        const id = $(this).data('id');
        
        $.ajax({
            url: '{{ route("admin.dashboard.menus.items.get") }}',
            type: 'GET',
            data: { item_id: id },
            success: function(response) {
                const form = $('#editMenuItemForm');
                form.find('[name="item_id"]').val(response.id);
                form.find('[name="label"]').val(response.label);
                form.find('[name="url"]').val(response.url);
                form.find('[name="icon"]').val(response.icon);
                form.find('[name="target"]').val(response.target);
            }
        });
    });

    // Handle edit menu item form
    $('#editMenuItemForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("admin.dashboard.menus.items.update") }}',
            type: 'POST',
            data: formData,
            success: function() {
                $('#editMenuItemModal').modal('hide');
                toastr.success('Menu item updated successfully');
                location.reload();
            }
        });
    });

    // Handle delete menu item
    $('.delete-menu-item').click(function() {
        const id = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this menu item?')) {
            $.ajax({
                url: '{{ route("admin.dashboard.menus.items.delete") }}',
                type: 'POST',
                data: {
                    item_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    toastr.success('Menu item deleted successfully');
                    location.reload();
                }
            });
        }
    });
});
</script>
@endpush
