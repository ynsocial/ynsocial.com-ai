@extends('admin.layouts.app')

@section('title', 'Theme Settings')

@section('content')
<div class="container-fluid">
    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" id="saveSettings">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <button type="button" class="btn btn-info" id="previewTheme">
                                <i class="fas fa-eye"></i> Preview
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success" id="exportSettings">
                                <i class="fas fa-file-export"></i> Export Settings
                            </button>
                            <button type="button" class="btn btn-warning" id="importSettings">
                                <i class="fas fa-file-import"></i> Import Settings
                            </button>
                            <button type="button" class="btn btn-danger" id="resetSettings">
                                <i class="fas fa-undo"></i> Reset to Default
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Settings Navigation -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" 
                           data-bs-toggle="list" 
                           href="#general" 
                           role="tab">
                            <i class="fas fa-cog fa-fw me-2"></i> General
                        </a>
                        <a class="list-group-item list-group-item-action" 
                           data-bs-toggle="list" 
                           href="#colors" 
                           role="tab">
                            <i class="fas fa-palette fa-fw me-2"></i> Colors
                        </a>
                        <a class="list-group-item list-group-item-action" 
                           data-bs-toggle="list" 
                           href="#typography" 
                           role="tab">
                            <i class="fas fa-font fa-fw me-2"></i> Typography
                        </a>
                        <a class="list-group-item list-group-item-action" 
                           data-bs-toggle="list" 
                           href="#components" 
                           role="tab">
                            <i class="fas fa-puzzle-piece fa-fw me-2"></i> Components
                        </a>
                        <a class="list-group-item list-group-item-action" 
                           data-bs-toggle="list" 
                           href="#seo" 
                           role="tab">
                            <i class="fas fa-search fa-fw me-2"></i> SEO
                        </a>
                        <a class="list-group-item list-group-item-action" 
                           data-bs-toggle="list" 
                           href="#social" 
                           role="tab">
                            <i class="fas fa-share-alt fa-fw me-2"></i> Social Media
                        </a>
                        <a class="list-group-item list-group-item-action" 
                           data-bs-toggle="list" 
                           href="#analytics" 
                           role="tab">
                            <i class="fas fa-chart-line fa-fw me-2"></i> Analytics
                        </a>
                        <a class="list-group-item list-group-item-action" 
                           data-bs-toggle="list" 
                           href="#advanced" 
                           role="tab">
                            <i class="fas fa-tools fa-fw me-2"></i> Advanced
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="col-md-9">
            <form id="settingsForm">
                <div class="tab-content">
                    <!-- General Settings -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        @include('admin.montoya.settings.partials.general')
                    </div>

                    <!-- Color Settings -->
                    <div class="tab-pane fade" id="colors" role="tabpanel">
                        @include('admin.montoya.settings.partials.colors')
                    </div>

                    <!-- Typography Settings -->
                    <div class="tab-pane fade" id="typography" role="tabpanel">
                        @include('admin.montoya.settings.partials.typography')
                    </div>

                    <!-- Component Settings -->
                    <div class="tab-pane fade" id="components" role="tabpanel">
                        @include('admin.montoya.settings.partials.components')
                    </div>

                    <!-- SEO Settings -->
                    <div class="tab-pane fade" id="seo" role="tabpanel">
                        @include('admin.montoya.settings.partials.seo')
                    </div>

                    <!-- Social Media Settings -->
                    <div class="tab-pane fade" id="social" role="tabpanel">
                        @include('admin.montoya.settings.partials.social')
                    </div>

                    <!-- Analytics Settings -->
                    <div class="tab-pane fade" id="analytics" role="tabpanel">
                        @include('admin.montoya.settings.partials.analytics')
                    </div>

                    <!-- Advanced Settings -->
                    <div class="tab-pane fade" id="advanced" role="tabpanel">
                        @include('admin.montoya.settings.partials.advanced')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Theme Preview</h5>
                <div class="btn-group ms-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary preview-device" data-device="desktop">
                        <i class="fas fa-desktop"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary preview-device" data-device="tablet">
                        <i class="fas fa-tablet-alt"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary preview-device" data-device="mobile">
                        <i class="fas fa-mobile-alt"></i>
                    </button>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="previewFrame" style="width: 100%; height: 80vh; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Importing settings will override your current theme configuration.
                </div>
                <div class="mb-3">
                    <label class="form-label">Settings File</label>
                    <input type="file" class="form-control" id="importFile" accept=".json">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmImport">Import</button>
            </div>
        </div>
    </div>
</div>

<!-- Reset Modal -->
<div class="modal fade" id="resetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This will reset all theme settings to their default values. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmReset">Reset</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .preview-frame-desktop {
        width: 100% !important;
    }
    
    .preview-frame-tablet {
        width: 768px !important;
        margin: 0 auto;
    }
    
    .preview-frame-mobile {
        width: 375px !important;
        margin: 0 auto;
    }
    
    .color-preview {
        width: 100%;
        height: 80px;
        border-radius: 4px;
        margin-bottom: 0.5rem;
    }
    
    .font-preview {
        font-size: 1.2rem;
        margin: 1rem 0;
        padding: 1rem;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const settingsForm = document.getElementById('settingsForm');
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    const importModal = new bootstrap.Modal(document.getElementById('importModal'));
    const resetModal = new bootstrap.Modal(document.getElementById('resetModal'));
    let currentPreviewDevice = 'desktop';

    // Save settings
    document.getElementById('saveSettings').addEventListener('click', async function() {
        const formData = new FormData(settingsForm);
        
        try {
            const response = await fetch('/admin/montoya/settings', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            if (!response.ok) throw new Error('Failed to save settings');
            
            alert('Settings saved successfully');
        } catch (error) {
            console.error('Error:', error);
            alert('Error saving settings');
        }
    });

    // Preview theme
    document.getElementById('previewTheme').addEventListener('click', function() {
        const previewFrame = document.getElementById('previewFrame');
        previewFrame.src = '/admin/montoya/preview';
        previewFrame.className = `preview-frame-${currentPreviewDevice}`;
        previewModal.show();
    });

    // Device preview buttons
    document.querySelectorAll('.preview-device').forEach(button => {
        button.addEventListener('click', function() {
            const device = this.dataset.device;
            currentPreviewDevice = device;
            const previewFrame = document.getElementById('previewFrame');
            previewFrame.className = `preview-frame-${device}`;
            
            document.querySelectorAll('.preview-device').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    // Export settings
    document.getElementById('exportSettings').addEventListener('click', async function() {
        try {
            const response = await fetch('/admin/montoya/settings/export');
            const blob = await response.blob();
            
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'montoya-settings.json';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        } catch (error) {
            console.error('Error:', error);
            alert('Error exporting settings');
        }
    });

    // Import settings
    document.getElementById('importSettings').addEventListener('click', function() {
        importModal.show();
    });

    document.getElementById('confirmImport').addEventListener('click', async function() {
        const file = document.getElementById('importFile').files[0];
        if (!file) return;
        
        const formData = new FormData();
        formData.append('settings', file);
        
        try {
            const response = await fetch('/admin/montoya/settings/import', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            if (!response.ok) throw new Error('Failed to import settings');
            
            alert('Settings imported successfully');
            location.reload();
        } catch (error) {
            console.error('Error:', error);
            alert('Error importing settings');
        }
    });

    // Reset settings
    document.getElementById('resetSettings').addEventListener('click', function() {
        resetModal.show();
    });

    document.getElementById('confirmReset').addEventListener('click', async function() {
        try {
            const response = await fetch('/admin/montoya/settings/reset', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            if (!response.ok) throw new Error('Failed to reset settings');
            
            alert('Settings reset successfully');
            location.reload();
        } catch (error) {
            console.error('Error:', error);
            alert('Error resetting settings');
        }
    });

    // Live preview updates
    let previewTimeout;
    settingsForm.addEventListener('input', function() {
        clearTimeout(previewTimeout);
        previewTimeout = setTimeout(updatePreview, 500);
    });

    function updatePreview() {
        const formData = new FormData(settingsForm);
        const previewFrame = document.getElementById('previewFrame');
        if (previewFrame.contentWindow) {
            previewFrame.contentWindow.postMessage({
                type: 'updatePreview',
                data: Object.fromEntries(formData)
            }, '*');
        }
    }
});
</script>
@endpush
