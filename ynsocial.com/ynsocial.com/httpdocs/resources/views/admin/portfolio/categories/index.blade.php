@extends('admin.layouts.app')

@section('title', 'Portfolio Categories')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Portfolio Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Portfolio Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Action Buttons -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#categoryModal">
                        <i class="fas fa-plus"></i> Add New Category
                    </button>
                </div>
            </div>

            <!-- Categories Grid -->
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $category->name }}</h3>
                                <div class="card-tools">
                                    <span class="badge badge-info">{{ $category->entries_count }} entries</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="category-structure">
                                    <h5>Structure Fields:</h5>
                                    <ul class="list-unstyled">
                                        @foreach($category->structure as $field)
                                            <li>
                                                <i class="fas fa-check-circle text-success"></i>
                                                {{ $field['label'] }}
                                                <small class="text-muted">({{ $field['type'] }})</small>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="category-actions mt-3">
                                    <button type="button" class="btn btn-sm btn-info edit-category" 
                                            data-category="{{ $category->toJson() }}"
                                            data-toggle="modal" 
                                            data-target="#categoryModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="{{ route('admin.portfolio.category.entries', $category) }}" 
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-folder-open"></i> View Entries
                                    </a>
                                    <form action="{{ route('admin.portfolio.categories.destroy', $category) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure? This will delete all entries in this category.')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="categoryForm" method="POST" action="{{ route('admin.portfolio.categories.store') }}">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="id" id="categoryId">

                    <div class="modal-header">
                        <h5 class="modal-title">Add/Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Basic Info -->
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <!-- Structure Builder -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Category Structure</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="addField">
                                        <i class="fas fa-plus"></i> Add Field
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="structureFields">
                                    <!-- Dynamic fields will be added here -->
                                </div>
                            </div>
                        </div>

                        <!-- Predefined Templates -->
                        <div class="form-group">
                            <label>Quick Templates</label>
                            <div class="btn-group d-flex flex-wrap">
                                <button type="button" class="btn btn-outline-secondary m-1" data-template="website">
                                    Website Template
                                </button>
                                <button type="button" class="btn btn-outline-secondary m-1" data-template="social-media">
                                    Social Media Template
                                </button>
                                <button type="button" class="btn btn-outline-secondary m-1" data-template="video">
                                    Video Template
                                </button>
                                <!-- Add more template buttons as needed -->
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .category-structure {
        font-size: 0.9rem;
    }
    .category-structure ul li {
        margin-bottom: 0.5rem;
    }
    .category-actions {
        display: flex;
        gap: 0.5rem;
    }
    #structureFields .field-row {
        background: #f8f9fa;
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 4px;
    }
    .btn-tool {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Field type templates
        const fieldTemplates = {
            text: { label: 'Text Input', type: 'text' },
            textarea: { label: 'Text Area', type: 'textarea' },
            image: { label: 'Image Upload', type: 'image' },
            gallery: { label: 'Image Gallery', type: 'gallery' },
            video: { label: 'Video Upload', type: 'video' },
            embed: { label: 'Video Embed', type: 'embed' },
            select: { label: 'Dropdown', type: 'select' },
            file: { label: 'File Upload', type: 'file' }
        };

        // Category templates
        const categoryTemplates = {
            website: [
                { label: 'Title', type: 'text', required: true },
                { label: 'Description', type: 'textarea', required: true },
                { label: 'Mockup Image', type: 'image', required: true },
                { label: 'Website URL', type: 'text', required: true }
            ],
            'social-media': [
                { label: 'Title', type: 'text', required: true },
                { label: 'Platform', type: 'select', options: ['Instagram', 'Facebook', 'TikTok'], required: true },
                { label: 'Post Type', type: 'select', options: ['Carousel', 'Story', 'Reel'], required: true },
                { label: 'Description', type: 'textarea', required: true },
                { label: 'Media Files', type: 'gallery', required: true }
            ],
            video: [
                { label: 'Title', type: 'text', required: true },
                { label: 'Video URL', type: 'embed', required: true },
                { label: 'Description', type: 'textarea', required: true },
                { label: 'Tags', type: 'text', required: false }
            ]
        };

        // Add new field
        $('#addField').click(function() {
            addFieldRow();
        });

        // Load template
        $('[data-template]').click(function() {
            const template = $(this).data('template');
            loadTemplate(template);
        });

        // Edit category
        $('.edit-category').click(function() {
            const category = $(this).data('category');
            loadCategory(category);
        });

        // Helper functions
        function addFieldRow(field = null) {
            const fieldRow = $('<div>').addClass('field-row');
            // ... field row HTML structure
            $('#structureFields').append(fieldRow);
        }

        function loadTemplate(templateName) {
            $('#structureFields').empty();
            categoryTemplates[templateName].forEach(field => {
                addFieldRow(field);
            });
        }

        function loadCategory(category) {
            $('#categoryId').val(category.id);
            $('#name').val(category.name);
            $('#description').val(category.description);
            $('#structureFields').empty();
            category.structure.forEach(field => {
                addFieldRow(field);
            });
            $('#categoryForm').attr('action', `/admin/portfolio/categories/${category.id}`);
            $('input[name="_method"]').val('PUT');
        }
    });
</script>
@endpush 