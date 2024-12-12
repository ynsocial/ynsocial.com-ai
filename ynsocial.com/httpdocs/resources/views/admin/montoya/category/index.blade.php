@extends('admin.layouts.app')

@section('title', ucfirst($type) . ' Categories')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Category List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">{{ ucfirst($type) }} Categories</h5>
                        <div class="btn-group mt-2">
                            <a href="{{ route('admin.montoya.categories', ['type' => 'blog']) }}" 
                               class="btn btn-sm btn-{{ $type === 'blog' ? 'primary' : 'outline-primary' }}">
                                Blog
                            </a>
                            <a href="{{ route('admin.montoya.categories', ['type' => 'portfolio']) }}"
                               class="btn btn-sm btn-{{ $type === 'portfolio' ? 'primary' : 'outline-primary' }}">
                                Portfolio
                            </a>
                            <a href="{{ route('admin.montoya.categories', ['type' => 'testimonial']) }}"
                               class="btn btn-sm btn-{{ $type === 'testimonial' ? 'primary' : 'outline-primary' }}">
                                Testimonials
                            </a>
                        </div>
                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        Drag and drop categories to reorder them. Click on a category to edit its properties.
                    </div>
                    <div id="categoryStructure" class="category-structure">
                        @foreach($categories as $category)
                            @include('admin.montoya.category.partials.category-item', ['category' => $category])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="col-md-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Categories</h5>
                            <h2 class="mb-0">{{ $categories->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Category Usage</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                @foreach($categories as $category)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $category->name }}
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $category->items_count ?? 0 }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm">
                    <input type="hidden" name="id">
                    <input type="hidden" name="type" value="{{ $type }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" placeholder="Auto-generated if left empty">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Parent Category</label>
                        <select class="form-select" name="parent_id">
                            <option value="">None</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="active" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Meta Title</label>
                        <input type="text" class="form-control" name="meta[title]">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Meta Description</label>
                        <textarea class="form-control" name="meta[description]" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" class="form-control" name="meta[keywords]" placeholder="Comma separated keywords">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="deleteCategory" style="display: none;">Delete</button>
                <button type="button" class="btn btn-primary" id="saveCategory">Save</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .category-structure {
        min-height: 200px;
        padding: 1rem;
    }
    
    .category-item {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 0.5rem;
        padding: 0.5rem 1rem;
        cursor: move;
    }
    
    .category-item .handle {
        cursor: move;
        color: #999;
    }
    
    .category-item .actions {
        visibility: hidden;
    }
    
    .category-item:hover .actions {
        visibility: visible;
    }
    
    .category-children {
        margin-left: 2rem;
        padding-left: 1rem;
        border-left: 2px solid #eee;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryModal = new bootstrap.Modal(document.getElementById('categoryModal'));
    const categoryForm = document.getElementById('categoryForm');
    let currentCategoryId = null;

    // Initialize Sortable
    const sortable = new Sortable(document.getElementById('categoryStructure'), {
        animation: 150,
        handle: '.handle',
        group: 'category',
        onEnd: function() {
            updateCategoryOrder();
        }
    });

    // Initialize nested Sortable instances
    document.querySelectorAll('.category-children').forEach(el => {
        new Sortable(el, {
            animation: 150,
            handle: '.handle',
            group: 'category',
            onEnd: function() {
                updateCategoryOrder();
            }
        });
    });

    // Auto-generate slug from name
    categoryForm.elements['name'].addEventListener('input', function() {
        if (!categoryForm.elements['slug'].value) {
            categoryForm.elements['slug'].value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
        }
    });

    // Add category button
    document.querySelector('[data-bs-target="#categoryModal"]').addEventListener('click', function() {
        currentCategoryId = null;
        categoryForm.reset();
        categoryForm.elements['type'].value = @json($type);
        document.getElementById('deleteCategory').style.display = 'none';
        categoryModal.show();
    });

    // Edit category button
    document.querySelectorAll('.edit-category').forEach(button => {
        button.addEventListener('click', async function() {
            const categoryId = this.dataset.id;
            currentCategoryId = categoryId;
            
            try {
                const response = await fetch(`/admin/montoya/categories/${categoryId}`);
                const category = await response.json();
                
                categoryForm.elements['name'].value = category.name;
                categoryForm.elements['slug'].value = category.slug;
                categoryForm.elements['description'].value = category.description;
                categoryForm.elements['parent_id'].value = category.parent_id || '';
                categoryForm.elements['active'].checked = category.active;
                
                if (category.meta) {
                    categoryForm.elements['meta[title]'].value = category.meta.title || '';
                    categoryForm.elements['meta[description]'].value = category.meta.description || '';
                    categoryForm.elements['meta[keywords]'].value = category.meta.keywords || '';
                }
                
                document.getElementById('deleteCategory').style.display = 'block';
                categoryModal.show();
            } catch (error) {
                console.error('Error:', error);
                alert('Error loading category');
            }
        });
    });

    // Save category
    document.getElementById('saveCategory').addEventListener('click', async function() {
        const formData = new FormData(categoryForm);
        const url = currentCategoryId ? 
            `/admin/montoya/categories/${currentCategoryId}` : 
            '/admin/montoya/categories';
        
        try {
            const response = await fetch(url, {
                method: currentCategoryId ? 'PUT' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            
            if (!response.ok) throw new Error('Failed to save category');
            
            categoryModal.hide();
            location.reload();
        } catch (error) {
            console.error('Error:', error);
            alert('Error saving category');
        }
    });

    // Delete category
    document.getElementById('deleteCategory').addEventListener('click', async function() {
        if (!currentCategoryId || !confirm('Are you sure you want to delete this category?')) return;
        
        try {
            const response = await fetch(`/admin/montoya/categories/${currentCategoryId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            if (!response.ok) throw new Error('Failed to delete category');
            
            categoryModal.hide();
            location.reload();
        } catch (error) {
            console.error('Error:', error);
            alert('Error deleting category');
        }
    });

    // Toggle active status
    document.querySelectorAll('.toggle-active').forEach(button => {
        button.addEventListener('click', async function() {
            const categoryId = this.dataset.id;
            
            try {
                const response = await fetch(`/admin/montoya/categories/${categoryId}/toggle-active`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                if (!response.ok) throw new Error('Failed to toggle category');
                
                location.reload();
            } catch (error) {
                console.error('Error:', error);
                alert('Error toggling category');
            }
        });
    });

    async function updateCategoryOrder() {
        const items = [];
        let order = 0;
        
        function processItem(el, parentId = null) {
            const id = el.dataset.id;
            items.push({
                id: parseInt(id),
                order: order++,
                parent_id: parentId
            });
            
            const children = el.querySelector('.category-children');
            if (children) {
                children.querySelectorAll(':scope > .category-item').forEach(child => {
                    processItem(child, parseInt(id));
                });
            }
        }
        
        document.querySelectorAll('#categoryStructure > .category-item').forEach(el => {
            processItem(el);
        });
        
        try {
            const response = await fetch('/admin/montoya/categories/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ items })
            });
            
            if (!response.ok) throw new Error('Failed to update category order');
        } catch (error) {
            console.error('Error:', error);
            alert('Error updating category order');
        }
    }
});
</script>
@endpush
