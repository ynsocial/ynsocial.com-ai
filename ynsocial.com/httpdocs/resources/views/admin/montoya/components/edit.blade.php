@extends('admin.layouts.app')

@section('title', 'Edit Component - ' . $component['name'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Component Editor -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Edit {{ $component['name'] }}</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success" id="saveComponent">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <button type="button" class="btn btn-info" id="previewComponent">
                            <i class="fas fa-eye"></i> Preview
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="componentForm">
                        <!-- Basic Settings -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Basic Settings</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Component Title</label>
                                        <input type="text" 
                                               class="form-control" 
                                               name="title" 
                                               value="{{ $component['title'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Component ID</label>
                                        <input type="text" 
                                               class="form-control" 
                                               name="id" 
                                               value="{{ $component['id'] }}"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Editor -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Content</h6>
                            <div id="contentEditor">
                                @foreach($component['content'] as $section => $content)
                                <div class="content-section mb-3">
                                    <label class="form-label">{{ ucfirst($section) }}</label>
                                    @if(is_array($content))
                                        <div class="repeatable-content" data-section="{{ $section }}">
                                            @foreach($content as $index => $item)
                                            <div class="repeatable-item card mb-2">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-end mb-2">
                                                        <button type="button" 
                                                                class="btn btn-danger btn-sm remove-item">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    @foreach($item as $field => $value)
                                                    <div class="mb-2">
                                                        <label class="form-label">{{ ucfirst($field) }}</label>
                                                        @if(is_string($value))
                                                            <input type="text" 
                                                                   class="form-control"
                                                                   name="content[{{ $section }}][{{ $index }}][{{ $field }}]"
                                                                   value="{{ $value }}">
                                                        @elseif(is_array($value))
                                                            <select class="form-select"
                                                                    name="content[{{ $section }}][{{ $index }}][{{ $field }}]">
                                                                @foreach($value as $option)
                                                                <option value="{{ $option }}"
                                                                        {{ $option === $value ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                            <button type="button" 
                                                    class="btn btn-primary btn-sm add-item"
                                                    data-section="{{ $section }}">
                                                <i class="fas fa-plus"></i> Add Item
                                            </button>
                                        </div>
                                    @else
                                        <textarea class="form-control" 
                                                  name="content[{{ $section }}]" 
                                                  rows="3">{{ $content }}</textarea>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Style Settings -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Style Settings</h6>
                            <div class="row">
                                @foreach($component['styles'] as $style => $value)
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">{{ ucfirst(str_replace('_', ' ', $style)) }}</label>
                                    @if(strpos($style, 'color') !== false)
                                        <input type="color" 
                                               class="form-control form-control-color" 
                                               name="styles[{{ $style }}]"
                                               value="{{ $value }}">
                                    @elseif(is_array($value))
                                        <select class="form-select" name="styles[{{ $style }}]">
                                            @foreach($value as $option)
                                            <option value="{{ $option }}"
                                                    {{ $option === $value ? 'selected' : '' }}>
                                                {{ ucfirst($option) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="text" 
                                               class="form-control" 
                                               name="styles[{{ $style }}]"
                                               value="{{ $value }}">
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Animation Settings -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Animation Settings</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Animation Type</label>
                                        <select class="form-select" name="animation[type]">
                                            @foreach($animationTypes as $type)
                                            <option value="{{ $type }}"
                                                    {{ $type === $component['animation']['type'] ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Duration (ms)</label>
                                        <input type="number" 
                                               class="form-control" 
                                               name="animation[duration]"
                                               value="{{ $component['animation']['duration'] }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Delay (ms)</label>
                                        <input type="number" 
                                               class="form-control" 
                                               name="animation[delay]"
                                               value="{{ $component['animation']['delay'] }}">
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
                            src="{{ route('admin.montoya.components.preview', $component['id']) }}">
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

@push('styles')
<style>
    .repeatable-item {
        position: relative;
    }
    
    .remove-item {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    
    #previewFrame {
        background: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('componentForm');
    const previewFrame = document.getElementById('previewFrame');
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    
    // Save component changes
    document.getElementById('saveComponent').addEventListener('click', async function() {
        const formData = new FormData(form);
        
        try {
            const response = await fetch(`/admin/montoya/components/${@json($component['id'])}/update`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            if (!response.ok) throw new Error('Failed to save changes');
            
            alert('Changes saved successfully');
            updatePreview();
        } catch (error) {
            console.error('Error:', error);
            alert('Error saving changes');
        }
    });

    // Preview component
    document.getElementById('previewComponent').addEventListener('click', function() {
        const fullPreviewFrame = document.getElementById('fullPreviewFrame');
        fullPreviewFrame.src = `/admin/montoya/components/${@json($component['id'])}/preview?full=1`;
        previewModal.show();
    });

    // Add repeatable item
    document.querySelectorAll('.add-item').forEach(button => {
        button.addEventListener('click', function() {
            const section = this.dataset.section;
            const container = document.querySelector(`[data-section="${section}"]`);
            const template = container.querySelector('.repeatable-item').cloneNode(true);
            
            // Clear values
            template.querySelectorAll('input, select').forEach(input => {
                input.value = '';
            });
            
            // Update names
            const newIndex = container.querySelectorAll('.repeatable-item').length;
            template.querySelectorAll('[name]').forEach(input => {
                input.name = input.name.replace(/\[\d+\]/, `[${newIndex}]`);
            });
            
            // Add remove button listener
            template.querySelector('.remove-item').addEventListener('click', function() {
                template.remove();
            });
            
            // Insert before add button
            this.before(template);
        });
    });

    // Remove repeatable item
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.repeatable-item').remove();
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
