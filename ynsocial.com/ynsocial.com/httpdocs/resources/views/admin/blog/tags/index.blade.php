@extends('admin.layouts.app')

@section('title', 'Blog Tags')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blog Tags</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog</a></li>
                        <li class="breadcrumb-item active">Tags</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Tag Form Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Tag</h3>
                        </div>
                        <div class="card-body">
                            <form id="tagForm" action="{{ route('admin.blog.tags.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="tagId">
                                
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Auto-generated if left empty">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="active" name="active" value="1" checked>
                                        <label class="custom-control-label" for="active">Active</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Tag</button>
                                    <button type="button" class="btn btn-secondary" id="resetForm">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tag Statistics Card -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h3 class="card-title">Tag Statistics</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>{{ $totalTags }}</h3>
                                            <p>Total Tags</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{ $activeTags }}</h3>
                                            <p>Active Tags</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Tags List Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tags</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" class="form-control" placeholder="Search tags..." id="searchTags">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Posts</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tagsTable">
                                    @foreach($tags as $tag)
                                        <tr data-tag-id="{{ $tag->id }}">
                                            <td>
                                                <input type="checkbox" class="tag-checkbox" value="{{ $tag->id }}">
                                            </td>
                                            <td>{{ $tag->name }}</td>
                                            <td>{{ $tag->slug }}</td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $tag->posts_count }} posts
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $tag->active ? 'success' : 'danger' }}">
                                                    {{ $tag->active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-info edit-tag" 
                                                            data-tag="{{ json_encode($tag) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger delete-tag" 
                                                            data-tag-id="{{ $tag->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <div class="float-left">
                                <button type="button" class="btn btn-danger" id="bulkDelete" disabled>
                                    Delete Selected
                                </button>
                                <button type="button" class="btn btn-warning" id="bulkDeactivate" disabled>
                                    Deactivate Selected
                                </button>
                                <button type="button" class="btn btn-success" id="bulkActivate" disabled>
                                    Activate Selected
                                </button>
                            </div>
                            <div class="float-right">
                                {{ $tags->links() }}
                            </div>
                        </div>
                    </div>

                    <!-- Popular Tags Card -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h3 class="card-title">Popular Tags</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($popularTags as $tag)
                                    <span class="badge bg-primary" style="font-size: {{ 12 + ($tag->posts_count * 0.5) }}px">
                                        {{ $tag->name }}
                                        <span class="badge bg-light text-dark">{{ $tag->posts_count }}</span>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .edit-tag:hover {
        cursor: pointer;
    }
    .tag-checkbox:checked + label {
        background-color: #f8f9fa;
    }
    .gap-2 {
        gap: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form handling
    const tagForm = document.getElementById('tagForm');
    const resetFormButton = document.getElementById('resetForm');
    
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value) {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
        }
    });

    // Reset form
    resetFormButton.addEventListener('click', function() {
        tagForm.reset();
        document.getElementById('tagId').value = '';
        document.querySelector('button[type="submit"]').textContent = 'Save Tag';
    });

    // Edit tag
    document.querySelectorAll('.edit-tag').forEach(button => {
        button.addEventListener('click', function() {
            const tag = JSON.parse(this.dataset.tag);
            
            document.getElementById('tagId').value = tag.id;
            document.getElementById('name').value = tag.name;
            document.getElementById('slug').value = tag.slug;
            document.getElementById('description').value = tag.description;
            document.getElementById('active').checked = tag.active;
            
            document.querySelector('button[type="submit"]').textContent = 'Update Tag';
        });
    });

    // Delete tag
    document.querySelectorAll('.delete-tag').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this tag?')) {
                const tagId = this.dataset.tagId;
                // Add delete logic here
            }
        });
    });

    // Bulk actions
    const selectAll = document.getElementById('selectAll');
    const tagCheckboxes = document.querySelectorAll('.tag-checkbox');
    const bulkActionButtons = document.querySelectorAll('#bulkDelete, #bulkDeactivate, #bulkActivate');

    selectAll.addEventListener('change', function() {
        tagCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActionButtons();
    });

    tagCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActionButtons);
    });

    function updateBulkActionButtons() {
        const checkedCount = document.querySelectorAll('.tag-checkbox:checked').length;
        bulkActionButtons.forEach(button => {
            button.disabled = checkedCount === 0;
        });
    }

    // Search tags
    document.getElementById('searchTags').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('#tagsTable tr').forEach(row => {
            const tagName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = tagName.includes(searchTerm) ? '' : 'none';
        });
    });
});
</script>
@endpush 