@extends('admin.layouts.app')

@section('title', 'Menu Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Menu List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Menu Structure</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                        <i class="fas fa-plus"></i> Add Menu Item
                    </button>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        Drag and drop menu items to reorder them. Click on an item to edit its properties.
                    </div>
                    <div id="menuStructure" class="menu-structure">
                        @foreach($menus as $menu)
                            @include('admin.montoya.menu.partials.menu-item', ['menu' => $menu])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Live Preview</h5>
                </div>
                <div class="card-body">
                    <div class="preview-wrapper">
                        <nav class="preview-nav">
                            <ul class="preview-menu">
                                @foreach($menus as $menu)
                                    @include('admin.montoya.menu.partials.preview-item', ['menu' => $menu])
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Menu Modal -->
<div class="modal fade" id="menuModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="menuForm">
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-select" name="type" required>
                            <option value="link">External Link</option>
                            <option value="internal">Internal Page</option>
                            <option value="dropdown">Dropdown Menu</option>
                        </select>
                    </div>
                    <div class="mb-3 url-field">
                        <label class="form-label">URL</label>
                        <input type="text" class="form-control" name="url">
                    </div>
                    <div class="mb-3 internal-page-field" style="display: none;">
                        <label class="form-label">Select Page</label>
                        <select class="form-select" name="internal_page">
                            @foreach($pages ?? [] as $page)
                                <option value="{{ $page->slug }}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parent Menu</label>
                        <select class="form-select" name="parent_id">
                            <option value="">None</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="new_tab" value="1">
                            <label class="form-check-label">Open in New Tab</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="active" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="deleteMenu" style="display: none;">Delete</button>
                <button type="button" class="btn btn-primary" id="saveMenu">Save</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .menu-structure {
        min-height: 200px;
        padding: 1rem;
    }
    
    .menu-item {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 0.5rem;
        padding: 0.5rem 1rem;
        cursor: move;
    }
    
    .menu-item .handle {
        cursor: move;
        color: #999;
    }
    
    .menu-item .actions {
        visibility: hidden;
    }
    
    .menu-item:hover .actions {
        visibility: visible;
    }
    
    .menu-children {
        margin-left: 2rem;
        padding-left: 1rem;
        border-left: 2px solid #eee;
    }
    
    .preview-wrapper {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 4px;
    }
    
    .preview-nav {
        background: #fff;
        padding: 1rem;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .preview-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .preview-menu li {
        margin: 0.5rem 0;
    }
    
    .preview-menu a {
        color: #333;
        text-decoration: none;
    }
    
    .preview-submenu {
        list-style: none;
        padding-left: 1.5rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuModal = new bootstrap.Modal(document.getElementById('menuModal'));
    const menuForm = document.getElementById('menuForm');
    let currentMenuId = null;

    // Initialize Sortable
    const sortable = new Sortable(document.getElementById('menuStructure'), {
        animation: 150,
        handle: '.handle',
        group: 'menu',
        onEnd: function() {
            updateMenuOrder();
        }
    });

    // Initialize nested Sortable instances
    document.querySelectorAll('.menu-children').forEach(el => {
        new Sortable(el, {
            animation: 150,
            handle: '.handle',
            group: 'menu',
            onEnd: function() {
                updateMenuOrder();
            }
        });
    });

    // Type change handler
    document.querySelector('[name="type"]').addEventListener('change', function() {
        const urlField = document.querySelector('.url-field');
        const internalPageField = document.querySelector('.internal-page-field');
        
        if (this.value === 'internal') {
            urlField.style.display = 'none';
            internalPageField.style.display = 'block';
        } else if (this.value === 'dropdown') {
            urlField.style.display = 'none';
            internalPageField.style.display = 'none';
        } else {
            urlField.style.display = 'block';
            internalPageField.style.display = 'none';
        }
    });

    // Add menu button
    document.querySelector('[data-bs-target="#addMenuModal"]').addEventListener('click', function() {
        currentMenuId = null;
        menuForm.reset();
        document.getElementById('deleteMenu').style.display = 'none';
        menuModal.show();
    });

    // Edit menu button
    document.querySelectorAll('.edit-menu').forEach(button => {
        button.addEventListener('click', async function() {
            const menuId = this.dataset.id;
            currentMenuId = menuId;
            
            try {
                const response = await fetch(`/admin/montoya/menu/${menuId}`);
                const menu = await response.json();
                
                menuForm.elements['name'].value = menu.name;
                menuForm.elements['type'].value = menu.type;
                menuForm.elements['url'].value = menu.url;
                menuForm.elements['parent_id'].value = menu.parent_id || '';
                menuForm.elements['new_tab'].checked = menu.new_tab;
                menuForm.elements['active'].checked = menu.active;
                
                if (menu.type === 'internal') {
                    menuForm.elements['internal_page'].value = menu.url;
                }
                
                document.getElementById('deleteMenu').style.display = 'block';
                menuModal.show();
            } catch (error) {
                console.error('Error:', error);
                alert('Error loading menu item');
            }
        });
    });

    // Save menu
    document.getElementById('saveMenu').addEventListener('click', async function() {
        const formData = new FormData(menuForm);
        const url = currentMenuId ? 
            `/admin/montoya/menu/${currentMenuId}` : 
            '/admin/montoya/menu';
        
        try {
            const response = await fetch(url, {
                method: currentMenuId ? 'PUT' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            
            if (!response.ok) throw new Error('Failed to save menu item');
            
            menuModal.hide();
            location.reload();
        } catch (error) {
            console.error('Error:', error);
            alert('Error saving menu item');
        }
    });

    // Delete menu
    document.getElementById('deleteMenu').addEventListener('click', async function() {
        if (!currentMenuId || !confirm('Are you sure you want to delete this menu item?')) return;
        
        try {
            const response = await fetch(`/admin/montoya/menu/${currentMenuId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            if (!response.ok) throw new Error('Failed to delete menu item');
            
            menuModal.hide();
            location.reload();
        } catch (error) {
            console.error('Error:', error);
            alert('Error deleting menu item');
        }
    });

    // Toggle active status
    document.querySelectorAll('.toggle-active').forEach(button => {
        button.addEventListener('click', async function() {
            const menuId = this.dataset.id;
            
            try {
                const response = await fetch(`/admin/montoya/menu/${menuId}/toggle-active`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                if (!response.ok) throw new Error('Failed to toggle menu item');
                
                location.reload();
            } catch (error) {
                console.error('Error:', error);
                alert('Error toggling menu item');
            }
        });
    });

    async function updateMenuOrder() {
        const items = [];
        let order = 0;
        
        function processItem(el, parentId = null) {
            const id = el.dataset.id;
            items.push({
                id: parseInt(id),
                order: order++,
                parent_id: parentId
            });
            
            const children = el.querySelector('.menu-children');
            if (children) {
                children.querySelectorAll(':scope > .menu-item').forEach(child => {
                    processItem(child, parseInt(id));
                });
            }
        }
        
        document.querySelectorAll('#menuStructure > .menu-item').forEach(el => {
            processItem(el);
        });
        
        try {
            const response = await fetch('/admin/montoya/menu/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ items })
            });
            
            if (!response.ok) throw new Error('Failed to update menu order');
        } catch (error) {
            console.error('Error:', error);
            alert('Error updating menu order');
        }
    }
});
</script>
@endpush
