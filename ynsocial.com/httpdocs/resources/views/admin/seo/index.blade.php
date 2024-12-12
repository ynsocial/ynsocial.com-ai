@extends('admin.layouts.app')

@section('title', 'SEO Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO Settings</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.seo.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Filters -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <select class="form-select" id="pageTypeFilter">
                                <option value="">All Page Types</option>
                                <option value="page">Pages</option>
                                <option value="post">Posts</option>
                                <option value="component">Components</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="searchFilter" placeholder="Search by title or identifier...">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-secondary w-100" id="analyzeAll">
                                <i class="fas fa-chart-line"></i> Analyze All
                            </button>
                        </div>
                    </div>

                    <!-- SEO Settings Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Page Type</th>
                                    <th>Identifier</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seoSettings as $setting)
                                <tr>
                                    <td>{{ ucfirst($setting->page_type) }}</td>
                                    <td>{{ $setting->page_identifier }}</td>
                                    <td>
                                        <div class="seo-preview">
                                            <div class="preview-title">{{ $setting->title }}</div>
                                            <div class="preview-url">{{ url($setting->page_identifier) }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 300px;">
                                            {{ $setting->description }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success seo-status">
                                            <i class="fas fa-check"></i> Optimized
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-sm preview-btn"
                                                    data-id="{{ $setting->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('admin.seo.edit', $setting) }}" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                    data-id="{{ $setting->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $seoSettings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SEO Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="preview-sections">
                    <!-- Google Preview -->
                    <div class="preview-section mb-4">
                        <h6>Google Search Preview</h6>
                        <div class="google-preview border p-3 rounded">
                            <div class="preview-title text-primary"></div>
                            <div class="preview-url text-success"></div>
                            <div class="preview-description"></div>
                        </div>
                    </div>

                    <!-- Meta Tags -->
                    <div class="preview-section mb-4">
                        <h6>Meta Tags</h6>
                        <pre class="meta-tags bg-light p-3 rounded"></pre>
                    </div>

                    <!-- Social Media Preview -->
                    <div class="preview-section">
                        <h6>Social Media Preview</h6>
                        <div class="social-preview border p-3 rounded">
                            <div class="og-preview mb-3">
                                <h6>Facebook/OpenGraph</h6>
                                <div class="og-card border rounded p-2">
                                    <img src="" class="og-image img-fluid mb-2" alt="">
                                    <div class="og-title fw-bold"></div>
                                    <div class="og-description text-muted"></div>
                                </div>
                            </div>
                            <div class="twitter-preview">
                                <h6>Twitter Card</h6>
                                <div class="twitter-card border rounded p-2">
                                    <img src="" class="twitter-image img-fluid mb-2" alt="">
                                    <div class="twitter-title fw-bold"></div>
                                    <div class="twitter-description text-muted"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete these SEO settings?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .seo-preview {
        font-family: Arial, sans-serif;
    }
    
    .preview-title {
        color: #1a0dab;
        font-size: 18px;
        margin-bottom: 3px;
    }
    
    .preview-url {
        color: #006621;
        font-size: 14px;
        margin-bottom: 3px;
    }
    
    .preview-description {
        color: #545454;
        font-size: 14px;
        line-height: 1.4;
    }
    
    .meta-tags {
        font-family: monospace;
        white-space: pre-wrap;
        max-height: 200px;
        overflow-y: auto;
    }
    
    .social-preview img {
        max-height: 200px;
        object-fit: cover;
        width: 100%;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Preview Modal
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    const previewButtons = document.querySelectorAll('.preview-btn');
    
    previewButtons.forEach(button => {
        button.addEventListener('click', async function() {
            const id = this.dataset.id;
            try {
                const response = await fetch(`/admin/seo/${id}/preview`);
                const data = await response.json();
                
                // Update modal content
                const modal = document.getElementById('previewModal');
                
                // Google preview
                modal.querySelector('.google-preview .preview-title').textContent = data.title;
                modal.querySelector('.google-preview .preview-url').textContent = data.url;
                modal.querySelector('.google-preview .preview-description').textContent = data.description;
                
                // Meta tags
                modal.querySelector('.meta-tags').textContent = data.html;
                
                // Social preview
                modal.querySelector('.og-image').src = data.og_image || '';
                modal.querySelector('.og-title').textContent = data.og_title;
                modal.querySelector('.og-description').textContent = data.og_description;
                
                modal.querySelector('.twitter-image').src = data.twitter_image || '';
                modal.querySelector('.twitter-title').textContent = data.twitter_title;
                modal.querySelector('.twitter-description').textContent = data.twitter_description;
                
                previewModal.show();
            } catch (error) {
                console.error('Error fetching preview:', error);
                alert('Error loading preview');
            }
        });
    });

    // Delete Modal
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const form = document.getElementById('deleteForm');
            form.action = `/admin/seo/${id}`;
            deleteModal.show();
        });
    });

    // Filters
    const pageTypeFilter = document.getElementById('pageTypeFilter');
    const searchFilter = document.getElementById('searchFilter');
    
    function applyFilters() {
        const pageType = pageTypeFilter.value;
        const search = searchFilter.value.toLowerCase();
        
        document.querySelectorAll('tbody tr').forEach(row => {
            const rowPageType = row.cells[0].textContent.toLowerCase();
            const rowIdentifier = row.cells[1].textContent.toLowerCase();
            const rowTitle = row.cells[2].textContent.toLowerCase();
            
            const matchesPageType = !pageType || rowPageType === pageType;
            const matchesSearch = !search || 
                                rowIdentifier.includes(search) || 
                                rowTitle.includes(search);
            
            row.style.display = matchesPageType && matchesSearch ? '' : 'none';
        });
    }
    
    pageTypeFilter.addEventListener('change', applyFilters);
    searchFilter.addEventListener('input', applyFilters);

    // Analyze All
    document.getElementById('analyzeAll').addEventListener('click', async function() {
        this.disabled = true;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Analyzing...';
        
        try {
            const response = await fetch('/admin/seo/analyze-all');
            const data = await response.json();
            
            // Update status badges
            document.querySelectorAll('.seo-status').forEach((badge, index) => {
                const status = data.results[index].status;
                badge.className = `badge bg-${status === 'optimized' ? 'success' : 'warning'} seo-status`;
                badge.innerHTML = `<i class="fas fa-${status === 'optimized' ? 'check' : 'exclamation-triangle'}"></i> ${status}`;
            });
            
            alert('Analysis complete!');
        } catch (error) {
            console.error('Error during analysis:', error);
            alert('Error during analysis');
        } finally {
            this.disabled = false;
            this.innerHTML = '<i class="fas fa-chart-line"></i> Analyze All';
        }
    });
});
</script>
@endpush
