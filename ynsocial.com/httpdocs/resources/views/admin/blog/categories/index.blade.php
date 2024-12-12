@extends('admin.layouts.app')

@section('title', 'Blog Categories')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blog Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Categories List -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Categories List</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" class="form-control float-right" placeholder="Search..." id="searchInput">
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Posts</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $category->posts_count }}</span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" 
                                                            class="btn btn-sm btn-info edit-category" 
                                                            data-id="{{ $category->id }}"
                                                            data-name="{{ $category->name }}"
                                                            data-slug="{{ $category->slug }}"
                                                            data-description="{{ $category->description }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.blog.categories.destroy', $category->id) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-danger" 
                                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-folder-open fa-2x mb-3"></i>
                                                    <p class="mb-0">No categories found.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($categories->hasPages())
                            <div class="card-footer clearfix">
                                {{ $categories->links() }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Add/Edit Category Form -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" id="formTitle">Add New Category</h3>
                        </div>
                        <form id="categoryForm" action="{{ route('admin.blog.categories.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="id" id="categoryId">
                            
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" 
                                           class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" 
                                           name="slug">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" 
                                              id="description" 
                                              name="description" 
                                              rows="3"></textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save Category</button>
                                <button type="button" class="btn btn-secondary" id="resetForm">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .table td, .table th {
        vertical-align: middle;
    }
    .btn-group {
        display: flex;
        gap: 5px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Generate slug from name
        $('#name').on('keyup', function() {
            if (!$('#slug').val()) {
                let slug = $(this).val()
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                $('#slug').val(slug);
            }
        });

        // Edit category
        $('.edit-category').on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let slug = $(this).data('slug');
            let description = $(this).data('description');

            $('#categoryId').val(id);
            $('#name').val(name);
            $('#slug').val(slug);
            $('#description').val(description);

            $('#formTitle').text('Edit Category');
            $('#categoryForm').attr('action', `/admin/blog/categories/${id}`);
            $('input[name="_method"]').val('PUT');
        });

        // Reset form
        $('#resetForm').on('click', function() {
            $('#categoryForm')[0].reset();
            $('#categoryId').val('');
            $('#formTitle').text('Add New Category');
            $('#categoryForm').attr('action', '{{ route('admin.blog.categories.store') }}');
            $('input[name="_method"]').val('POST');
        });

        // Search functionality
        $('#searchInput').on('keyup', function() {
            let value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>
@endpush 