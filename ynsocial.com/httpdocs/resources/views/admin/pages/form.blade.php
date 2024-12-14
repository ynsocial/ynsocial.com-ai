@extends('admin.layouts.app')

@section('title', isset($page) ? 'Edit Page: ' . $page->title : 'Create New Page')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ isset($page) ? 'Edit Page: ' . $page->title : 'Create New Page' }}</h1>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Pages
        </a>
    </div>

    <!-- Form -->
    <form action="{{ isset($page) ? route('admin.pages.update', $page) : route('admin.pages.store') }}" 
          method="POST" 
          id="pageForm">
        @csrf
        @if(isset($page))
            @method('PUT')
        @endif

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h5 class="card-title">Basic Information</h5>
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Page Title</label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $page->title ?? '') }}" 
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" 
                                       class="form-control @error('slug') is-invalid @enderror" 
                                       id="slug" 
                                       name="slug" 
                                       value="{{ old('slug', $page->slug ?? '') }}"
                                       placeholder="Auto-generated if left empty">
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3">{{ old('description', $page->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sections -->
                        <div class="mb-4">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                Page Sections
                                <button type="button" class="btn btn-sm btn-primary" id="addSection">
                                    <i class="fas fa-plus"></i> Add Section
                                </button>
                            </h5>
                            
                            <div id="sectionsContainer">
                                @if(isset($page))
                                    @foreach($page->sections as $section)
                                        <div class="card mb-3 section-item" data-section-id="{{ $section->id }}">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">{{ $section->name }}</h6>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary move-section">
                                                        <i class="fas fa-arrows-alt"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-section">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @include('admin.pages.sections.types.' . $section->type, [
                                                    'section' => $section,
                                                    'content' => $section->pivot->content
                                                ])
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Settings -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Page Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       id="active" 
                                       name="active" 
                                       value="1" 
                                       {{ old('active', $page->active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <small class="text-muted">Only active pages are visible on the frontend</small>
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" 
                                   class="form-control" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', $page->order ?? 0) }}">
                        </div>
                    </div>
                </div>

                <!-- Meta Information -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Meta Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="meta_title" 
                                   name="meta[title]" 
                                   value="{{ old('meta.title', $page->getMetaValue('title') ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control" 
                                      id="meta_description" 
                                      name="meta[description]" 
                                      rows="3">{{ old('meta.description', $page->getMetaValue('description') ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="meta_keywords" 
                                   name="meta[keywords]" 
                                   value="{{ old('meta.keywords', $page->getMetaValue('keywords') ?? '') }}">
                            <small class="text-muted">Separate keywords with commas</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> 
                            {{ isset($page) ? 'Update Page' : 'Create Page' }}
                        </button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Section Template Modal -->
<div class="modal fade" id="sectionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    @foreach($sections as $section)
                        <button type="button" 
                                class="list-group-item list-group-item-action select-section"
                                data-section-id="{{ $section->id }}"
                                data-section-type="{{ $section->type }}">
                            <h6 class="mb-1">{{ $section->name }}</h6>
                            <small class="text-muted">{{ ucfirst($section->type) }} Section</small>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .section-item {
        cursor: move;
    }
    .section-item.dragging {
        opacity: 0.5;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sectionModal = new bootstrap.Modal(document.getElementById('sectionModal'));
    const sectionsContainer = document.getElementById('sectionsContainer');

    // Initialize Sortable
    new Sortable(sectionsContainer, {
        animation: 150,
        handle: '.move-section',
        onEnd: updateSectionOrder
    });

    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value) {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
        }
    });

    // Add Section Button
    document.getElementById('addSection').addEventListener('click', function() {
        sectionModal.show();
    });

    // Select Section
    document.querySelectorAll('.select-section').forEach(button => {
        button.addEventListener('click', function() {
            const sectionId = this.dataset.sectionId;
            const sectionType = this.dataset.sectionType;
            
            // Add AJAX call here to get section template
            fetch(`/admin/pages/sections/${sectionId}/template`)
                .then(response => response.text())
                .then(html => {
                    const wrapper = document.createElement('div');
                    wrapper.innerHTML = html;
                    sectionsContainer.appendChild(wrapper.firstElementChild);
                    sectionModal.hide();
                    updateSectionOrder();
                });
        });
    });

    // Remove Section
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-section')) {
            if (confirm('Are you sure you want to remove this section?')) {
                e.target.closest('.section-item').remove();
                updateSectionOrder();
            }
        }
    });

    // Update section order
    function updateSectionOrder() {
        document.querySelectorAll('.section-item').forEach((item, index) => {
            const orderInput = item.querySelector('input[name$="[order]"]');
            if (orderInput) {
                orderInput.value = index;
            }
        });
    }
});
</script>
@endpush 