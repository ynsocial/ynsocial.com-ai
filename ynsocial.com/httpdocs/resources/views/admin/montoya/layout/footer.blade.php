@extends('admin.layouts.app')

@section('title', 'Footer Management')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Footer Settings</h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" id="saveFooter">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <button type="button" class="btn btn-info" id="previewFooter">
                                <i class="fas fa-eye"></i> Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="footerForm">
        <div class="row">
            <!-- Settings -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Footer Layout</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Layout Style</label>
                            <select class="form-select" name="layout_style">
                                <option value="4-columns" {{ ($footer->layout_style ?? '') == '4-columns' ? 'selected' : '' }}>
                                    4 Columns
                                </option>
                                <option value="3-columns" {{ ($footer->layout_style ?? '') == '3-columns' ? 'selected' : '' }}>
                                    3 Columns
                                </option>
                                <option value="2-columns" {{ ($footer->layout_style ?? '') == '2-columns' ? 'selected' : '' }}>
                                    2 Columns
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="show_logo" id="showLogo"
                                       {{ !empty($footer->show_logo) ? 'checked' : '' }}>
                                <label class="form-check-label" for="showLogo">Show Logo in Footer</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Footer Columns</h6>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="addColumn">
                            <i class="fas fa-plus"></i> Add Column
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="footerColumns">
                            @foreach($footer->columns ?? [] as $index => $column)
                            <div class="footer-column card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Column {{ $index + 1 }}</h6>
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-column">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="columns[{{ $index }}][title]" 
                                               value="{{ $column['title'] }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Content Type</label>
                                        <select class="form-select content-type" name="columns[{{ $index }}][type]">
                                            <option value="text" {{ $column['type'] == 'text' ? 'selected' : '' }}>
                                                Text
                                            </option>
                                            <option value="menu" {{ $column['type'] == 'menu' ? 'selected' : '' }}>
                                                Menu
                                            </option>
                                            <option value="recent_posts" {{ $column['type'] == 'recent_posts' ? 'selected' : '' }}>
                                                Recent Posts
                                            </option>
                                        </select>
                                    </div>

                                    <div class="content-wrapper">
                                        <!-- Text Content -->
                                        <div class="content-text {{ $column['type'] == 'text' ? '' : 'd-none' }}">
                                            <div class="mb-3">
                                                <label class="form-label">Text Content</label>
                                                <textarea class="form-control" name="columns[{{ $index }}][content]" 
                                                          rows="4">{{ $column['content'] }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Menu Content -->
                                        <div class="content-menu {{ $column['type'] == 'menu' ? '' : 'd-none' }}">
                                            <div class="mb-3">
                                                <label class="form-label">Select Menu</label>
                                                <select class="form-select" name="columns[{{ $index }}][menu_id]">
                                                    @foreach($menus ?? [] as $menu)
                                                    <option value="{{ $menu->id }}" 
                                                            {{ ($column['menu_id'] ?? '') == $menu->id ? 'selected' : '' }}>
                                                        {{ $menu->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Recent Posts Content -->
                                        <div class="content-recent-posts {{ $column['type'] == 'recent_posts' ? '' : 'd-none' }}">
                                            <div class="mb-3">
                                                <label class="form-label">Number of Posts</label>
                                                <input type="number" class="form-control" 
                                                       name="columns[{{ $index }}][posts_count]"
                                                       value="{{ $column['posts_count'] ?? 5 }}" min="1" max="10">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Bottom Bar</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="show_bottom_bar" id="showBottomBar"
                                       {{ !empty($footer->show_bottom_bar) ? 'checked' : '' }}>
                                <label class="form-check-label" for="showBottomBar">Show Bottom Bar</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Copyright Text</label>
                            <input type="text" class="form-control" name="copyright_text" 
                                   value="{{ $footer->copyright_text ?? '© {year} Your Company. All rights reserved.' }}"
                                   placeholder="© {year} Your Company. All rights reserved.">
                            <small class="text-muted">Use {year} to display the current year automatically.</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="show_social_icons" id="showSocialIcons"
                                       {{ !empty($footer->show_social_icons) ? 'checked' : '' }}>
                                <label class="form-check-label" for="showSocialIcons">Show Social Icons</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview -->
            <div class="col-md-4">
                <div class="card mb-4 sticky-top" style="top: 1rem;">
                    <div class="card-header">
                        <h6 class="mb-0">Live Preview</h6>
                    </div>
                    <div class="card-body p-0">
                        <iframe id="previewFrame" src="{{ route('admin.montoya.layout.preview-footer') }}" 
                                style="width: 100%; height: 500px; border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Footer Column Template -->
<template id="footerColumnTemplate">
    <div class="footer-column card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">New Column</h6>
                <button type="button" class="btn btn-sm btn-outline-danger remove-column">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="columns[{index}][title]">
            </div>

            <div class="mb-3">
                <label class="form-label">Content Type</label>
                <select class="form-select content-type" name="columns[{index}][type]">
                    <option value="text">Text</option>
                    <option value="menu">Menu</option>
                    <option value="recent_posts">Recent Posts</option>
                </select>
            </div>

            <div class="content-wrapper">
                <!-- Text Content -->
                <div class="content-text">
                    <div class="mb-3">
                        <label class="form-label">Text Content</label>
                        <textarea class="form-control" name="columns[{index}][content]" rows="4"></textarea>
                    </div>
                </div>

                <!-- Menu Content -->
                <div class="content-menu d-none">
                    <div class="mb-3">
                        <label class="form-label">Select Menu</label>
                        <select class="form-select" name="columns[{index}][menu_id]">
                            @foreach($menus ?? [] as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Recent Posts Content -->
                <div class="content-recent-posts d-none">
                    <div class="mb-3">
                        <label class="form-label">Number of Posts</label>
                        <input type="number" class="form-control" name="columns[{index}][posts_count]"
                               value="5" min="1" max="10">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const footerForm = document.getElementById('footerForm');
    const previewFrame = document.getElementById('previewFrame');
    let columnCount = document.querySelectorAll('.footer-column').length;
    
    // Add Footer Column
    document.getElementById('addColumn').addEventListener('click', function() {
        const template = document.getElementById('footerColumnTemplate');
        const clone = template.content.cloneNode(true);
        
        // Replace {index} placeholder with actual index
        const elements = clone.querySelectorAll('[name*="{index}"]');
        elements.forEach(element => {
            element.name = element.name.replace('{index}', columnCount);
        });
        
        document.getElementById('footerColumns').appendChild(clone);
        columnCount++;
        
        // Initialize new column
        const newColumn = document.getElementById('footerColumns').lastElementChild;
        initColumn(newColumn);
        updatePreview();
    });

    // Initialize Column
    function initColumn(column) {
        const contentType = column.querySelector('.content-type');
        const contentWrapper = column.querySelector('.content-wrapper');
        const removeBtn = column.querySelector('.remove-column');
        
        contentType.addEventListener('change', function() {
            const contents = contentWrapper.children;
            Array.from(contents).forEach(content => {
                content.classList.add('d-none');
            });
            
            contentWrapper.querySelector(`.content-${this.value}`).classList.remove('d-none');
            updatePreview();
        });
        
        removeBtn.addEventListener('click', function() {
            column.remove();
            updateColumnIndexes();
            updatePreview();
        });
    }

    // Initialize existing columns
    document.querySelectorAll('.footer-column').forEach(initColumn);

    // Update column indexes
    function updateColumnIndexes() {
        const columns = document.querySelectorAll('.footer-column');
        columns.forEach((column, index) => {
            const inputs = column.querySelectorAll('[name*="columns["]');
            inputs.forEach(input => {
                input.name = input.name.replace(/columns\[\d+\]/, `columns[${index}]`);
            });
        });
    }

    // Live Preview Update
    let previewTimeout;
    footerForm.addEventListener('input', function() {
        clearTimeout(previewTimeout);
        previewTimeout = setTimeout(updatePreview, 500);
    });

    function updatePreview() {
        const formData = new FormData(footerForm);
        if (previewFrame.contentWindow) {
            previewFrame.contentWindow.postMessage({
                type: 'updatePreview',
                data: Object.fromEntries(formData)
            }, '*');
        }
    }

    // Save Footer Settings
    document.getElementById('saveFooter').addEventListener('click', async function() {
        const formData = new FormData(footerForm);
        
        try {
            const response = await fetch('/admin/montoya/layout/footer', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            if (!response.ok) throw new Error('Failed to save footer settings');
            
            alert('Footer settings saved successfully');
        } catch (error) {
            console.error('Error:', error);
            alert('Error saving footer settings');
        }
    });

    // Preview in New Window
    document.getElementById('previewFooter').addEventListener('click', function() {
        window.open('/admin/montoya/layout/preview-footer', '_blank');
    });
});
</script>
@endpush
