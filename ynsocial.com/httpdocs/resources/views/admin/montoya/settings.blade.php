@extends('admin.layouts.app')

@section('title', 'Montoya Theme Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Theme Settings -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Theme Settings</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success" id="saveSettings">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <button type="button" class="btn btn-info" id="previewTheme">
                            <i class="fas fa-eye"></i> Preview
                        </button>
                        <button type="button" class="btn btn-warning" id="exportTheme">
                            <i class="fas fa-file-export"></i> Export
                        </button>
                        <button type="button" class="btn btn-primary" id="importTheme">
                            <i class="fas fa-file-import"></i> Import
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="settingsForm">
                        <!-- Color Scheme -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Color Scheme</h6>
                            <div class="row">
                                @foreach($settings['colors'] as $color => $value)
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">{{ ucfirst(str_replace('-', ' ', $color)) }}</label>
                                    <div class="input-group">
                                        <input type="color" 
                                               class="form-control form-control-color" 
                                               name="colors[{{ $color }}]"
                                               value="{{ $value }}">
                                        <input type="text" 
                                               class="form-control color-hex" 
                                               value="{{ $value }}"
                                               data-color="{{ $color }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Typography -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Typography</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Primary Font</label>
                                    <select class="form-select" name="typography[primary_font]">
                                        @foreach($fonts as $font)
                                        <option value="{{ $font }}"
                                                {{ $font === $settings['typography']['primary_font'] ? 'selected' : '' }}>
                                            {{ $font }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Secondary Font</label>
                                    <select class="form-select" name="typography[secondary_font]">
                                        @foreach($fonts as $font)
                                        <option value="{{ $font }}"
                                                {{ $font === $settings['typography']['secondary_font'] ? 'selected' : '' }}>
                                            {{ $font }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Base Font Size</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control" 
                                               name="typography[base_size]"
                                               value="{{ $settings['typography']['base_size'] }}"
                                               step="0.1">
                                        <span class="input-group-text">rem</span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Line Height</label>
                                    <input type="number" 
                                           class="form-control" 
                                           name="typography[line_height]"
                                           value="{{ $settings['typography']['line_height'] }}"
                                           step="0.1">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Font Weight</label>
                                    <select class="form-select" name="typography[font_weight]">
                                        @foreach([300, 400, 500, 600, 700] as $weight)
                                        <option value="{{ $weight }}"
                                                {{ $weight === $settings['typography']['font_weight'] ? 'selected' : '' }}>
                                            {{ $weight }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Layout -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Layout</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Container Width</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control" 
                                               name="layout[container_width]"
                                               value="{{ $settings['layout']['container_width'] }}">
                                        <span class="input-group-text">px</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Grid Columns</label>
                                    <input type="number" 
                                           class="form-control" 
                                           name="layout[grid_columns]"
                                           value="{{ $settings['layout']['grid_columns'] }}"
                                           min="1" 
                                           max="12">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Spacing Unit</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control" 
                                               name="layout[spacing_unit]"
                                               value="{{ $settings['layout']['spacing_unit'] }}"
                                               step="0.25">
                                        <span class="input-group-text">rem</span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Border Radius</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control" 
                                               name="layout[border_radius]"
                                               value="{{ $settings['layout']['border_radius'] }}"
                                               step="0.25">
                                        <span class="input-group-text">rem</span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Box Shadow</label>
                                    <select class="form-select" name="layout[box_shadow]">
                                        @foreach(['none', 'sm', 'md', 'lg'] as $shadow)
                                        <option value="{{ $shadow }}"
                                                {{ $shadow === $settings['layout']['box_shadow'] ? 'selected' : '' }}>
                                            {{ ucfirst($shadow) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Animations -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Animations</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Default Animation</label>
                                    <select class="form-select" name="animations[default]">
                                        @foreach($animations as $animation)
                                        <option value="{{ $animation }}"
                                                {{ $animation === $settings['animations']['default'] ? 'selected' : '' }}>
                                            {{ ucfirst($animation) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Animation Speed</label>
                                    <select class="form-select" name="animations[speed]">
                                        @foreach(['slow', 'normal', 'fast'] as $speed)
                                        <option value="{{ $speed }}"
                                                {{ $speed === $settings['animations']['speed'] ? 'selected' : '' }}>
                                            {{ ucfirst($speed) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" 
                                               class="form-check-input" 
                                               name="animations[enabled]"
                                               {{ $settings['animations']['enabled'] ? 'checked' : '' }}>
                                        <label class="form-check-label">Enable Animations</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview Panel -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Live Preview</h5>
                </div>
                <div class="card-body p-0">
                    <iframe id="previewFrame" 
                            style="width: 100%; height: 600px; border: none;"
                            src="{{ route('admin.montoya.preview') }}">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Full Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="fullPreviewFrame" style="width: 100%; height: 80vh; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Theme Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Settings File</label>
                    <input type="file" 
                           class="form-control" 
                           id="importFile" 
                           accept=".json">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmImport">Import</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .color-hex {
        text-transform: uppercase;
    }
    
    #previewFrame {
        background: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('settingsForm');
    const previewFrame = document.getElementById('previewFrame');
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    const importModal = new bootstrap.Modal(document.getElementById('importModal'));
    
    // Save settings
    document.getElementById('saveSettings').addEventListener('click', async function() {
        const formData = new FormData(form);
        
        try {
            const response = await fetch('/admin/montoya/settings/update', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            if (!response.ok) throw new Error('Failed to save settings');
            
            alert('Settings saved successfully');
            updatePreview();
        } catch (error) {
            console.error('Error:', error);
            alert('Error saving settings');
        }
    });

    // Preview theme
    document.getElementById('previewTheme').addEventListener('click', function() {
        const fullPreviewFrame = document.getElementById('fullPreviewFrame');
        fullPreviewFrame.src = '/admin/montoya/preview?full=1';
        previewModal.show();
    });

    // Export theme
    document.getElementById('exportTheme').addEventListener('click', async function() {
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

    // Import theme
    document.getElementById('importTheme').addEventListener('click', function() {
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

    // Color hex input sync
    document.querySelectorAll('.color-hex').forEach(input => {
        input.addEventListener('input', function() {
            const color = this.dataset.color;
            const colorInput = document.querySelector(`[name="colors[${color}]"]`);
            colorInput.value = this.value;
            updatePreview();
        });
    });

    document.querySelectorAll('[name^="colors["]').forEach(input => {
        input.addEventListener('input', function() {
            const color = this.name.match(/colors\[(.*?)\]/)[1];
            const hexInput = document.querySelector(`[data-color="${color}"]`);
            hexInput.value = this.value.toUpperCase();
            updatePreview();
        });
    });

    // Live preview update
    let previewTimeout;
    form.addEventListener('input', function() {
        clearTimeout(previewTimeout);
        previewTimeout = setTimeout(updatePreview, 500);
    });

    function updatePreview() {
        const formData = new FormData(form);
        previewFrame.contentWindow.postMessage({
            type: 'updatePreview',
            data: Object.fromEntries(formData)
        }, '*');
    }
});
</script>
@endpush
