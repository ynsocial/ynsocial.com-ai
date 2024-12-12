@extends('admin.layouts.app')

@section('title', 'Montoya Theme Management')

@section('content')
<div class="container-fluid">
    <!-- Theme Status Overview -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Active Components</h5>
                    <h2 class="mb-0">{{ $activeComponents }}/{{ $totalComponents }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Theme Version</h5>
                    <h2 class="mb-0">{{ $themeVersion }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Last Updated</h5>
                    <h2 class="mb-0">{{ $lastUpdated->diffForHumans() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Cache Status</h5>
                    <h2 class="mb-0">{{ $cacheStatus }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="btn-group">
                        <a href="{{ route('admin.montoya.components') }}" class="btn btn-primary">
                            <i class="fas fa-puzzle-piece"></i> Manage Components
                        </a>
                        <a href="{{ route('admin.montoya.settings') }}" class="btn btn-info">
                            <i class="fas fa-cog"></i> Theme Settings
                        </a>
                        <a href="{{ route('admin.montoya.preview') }}" class="btn btn-success">
                            <i class="fas fa-eye"></i> Live Preview
                        </a>
                        <button type="button" class="btn btn-warning" id="clearCache">
                            <i class="fas fa-broom"></i> Clear Cache
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Components Overview -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Components Overview</h5>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#reorderModal">
                        <i class="fas fa-sort"></i> Reorder Components
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Component</th>
                                    <th>Status</th>
                                    <th>Last Modified</th>
                                    <th>Cache</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($components as $component)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/components/' . $component['key'] . '.png') }}" 
                                                 alt="{{ $component['name'] }}"
                                                 class="component-icon me-2"
                                                 width="30">
                                            {{ $component['name'] }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" 
                                                   class="form-check-input component-toggle" 
                                                   data-component="{{ $component['key'] }}"
                                                   {{ $component['enabled'] ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>{{ $component['updated_at']->diffForHumans() }}</td>
                                    <td>
                                        @if($component['cached'])
                                            <span class="badge bg-success">Cached</span>
                                        @else
                                            <span class="badge bg-warning">Not Cached</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.montoya.components.edit', $component['key']) }}" 
                                               class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-info preview-component"
                                                    data-component="{{ $component['key'] }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" 
                                                    class="btn btn-warning clear-cache"
                                                    data-component="{{ $component['key'] }}">
                                                <i class="fas fa-sync"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="activity-feed">
                        @foreach($recentActivity as $activity)
                        <div class="activity-item">
                            <div class="activity-content">
                                <div class="activity-header">
                                    <span class="activity-type badge bg-{{ $activity['type'] }}">
                                        {{ ucfirst($activity['type']) }}
                                    </span>
                                    <span class="activity-time">
                                        {{ $activity['created_at']->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="activity-text">{{ $activity['description'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reorder Modal -->
<div class="modal fade" id="reorderModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reorder Components</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    Drag and drop components to reorder them on your website.
                </div>
                <ul class="list-group" id="componentSortable">
                    @foreach($components as $component)
                    <li class="list-group-item" data-component="{{ $component['key'] }}">
                        <i class="fas fa-grip-vertical me-2"></i>
                        {{ $component['name'] }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveOrder">Save Order</button>
            </div>
        </div>
    </div>
</div>

<!-- Component Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Component Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="previewFrame" style="width: 100%; height: 600px; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .component-icon {
        border-radius: 4px;
        padding: 2px;
        background: #f8f9fa;
    }
    
    .activity-feed {
        max-height: 500px;
        overflow-y: auto;
    }
    
    .activity-item {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .activity-time {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .activity-text {
        margin: 0;
        font-size: 0.9rem;
    }
    
    #componentSortable .list-group-item {
        cursor: move;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize component sorting
    new Sortable(document.getElementById('componentSortable'), {
        animation: 150,
        handle: '.fa-grip-vertical'
    });

    // Component toggle switches
    document.querySelectorAll('.component-toggle').forEach(toggle => {
        toggle.addEventListener('change', async function() {
            const component = this.dataset.component;
            const enabled = this.checked;
            
            try {
                const response = await fetch(`/admin/montoya/components/${component}/toggle`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ enabled })
                });
                
                if (!response.ok) throw new Error('Failed to toggle component');
                
                // Show success message
                alert(`Component ${enabled ? 'enabled' : 'disabled'} successfully`);
            } catch (error) {
                console.error('Error:', error);
                this.checked = !enabled; // Revert the toggle
                alert('Error updating component status');
            }
        });
    });

    // Save component order
    document.getElementById('saveOrder').addEventListener('click', async function() {
        const components = Array.from(document.getElementById('componentSortable').children)
            .map((item, index) => ({
                key: item.dataset.component,
                order: index
            }));
        
        try {
            const response = await fetch('/admin/montoya/components/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ components })
            });
            
            if (!response.ok) throw new Error('Failed to update order');
            
            // Close modal and show success message
            bootstrap.Modal.getInstance(document.getElementById('reorderModal')).hide();
            alert('Component order updated successfully');
        } catch (error) {
            console.error('Error:', error);
            alert('Error updating component order');
        }
    });

    // Component preview
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    
    document.querySelectorAll('.preview-component').forEach(button => {
        button.addEventListener('click', function() {
            const component = this.dataset.component;
            const frame = document.getElementById('previewFrame');
            frame.src = `/admin/montoya/components/${component}/preview`;
            previewModal.show();
        });
    });

    // Clear cache
    document.querySelectorAll('.clear-cache').forEach(button => {
        button.addEventListener('click', async function() {
            const component = this.dataset.component;
            
            try {
                const response = await fetch(`/admin/montoya/cache/clear/${component}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                if (!response.ok) throw new Error('Failed to clear cache');
                
                alert('Cache cleared successfully');
                location.reload();
            } catch (error) {
                console.error('Error:', error);
                alert('Error clearing cache');
            }
        });
    });

    // Clear all cache
    document.getElementById('clearCache').addEventListener('click', async function() {
        if (!confirm('Are you sure you want to clear all theme cache?')) return;
        
        try {
            const response = await fetch('/admin/montoya/cache/clear-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            if (!response.ok) throw new Error('Failed to clear cache');
            
            alert('All cache cleared successfully');
            location.reload();
        } catch (error) {
            console.error('Error:', error);
            alert('Error clearing cache');
        }
    });
});
</script>
@endpush
