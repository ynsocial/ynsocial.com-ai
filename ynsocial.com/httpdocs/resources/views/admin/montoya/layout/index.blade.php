@extends('admin.layouts.app')

@section('title', 'Layout Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Header Settings -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Header Settings</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="saveHeader">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <button type="button" class="btn btn-info" id="previewHeader">
                            <i class="fas fa-eye"></i> Preview
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="headerForm">
                        <!-- Logo -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Logo</h6>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="{{ $header->content['logo'] ?? asset('images/default-logo.png') }}" 
                                         alt="Logo" 
                                         class="img-thumbnail"
                                         style="max-height: 50px;">
                                </div>
                                <div class="col">
                                    <input type="file" 
                                           class="form-control" 
                                           name="logo" 
                                           accept="image/*">
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Contact Information</h6>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" 
                                       class="form-control" 
                                       name="content[contact_info][phone]"
                                       value="{{ $header->content['contact_info']['phone'] ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" 
                                       class="form-control" 
                                       name="content[contact_info][email]"
                                       value="{{ $header->content['contact_info']['email'] ?? '' }}">
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Social Links</h6>
                            <div id="socialLinks">
                                @foreach($header->content['social_links'] ?? [] as $platform => $url)
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fab fa-{{ $platform }}"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control" 
                                           name="content[social_links][{{ $platform }}]"
                                           value="{{ $url }}"
                                           placeholder="{{ ucfirst($platform) }} URL">
                                    <button type="button" class="btn btn-danger remove-social">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" id="addSocialLink">
                                <i class="fas fa-plus"></i> Add Social Link
                            </button>
                        </div>

                        <!-- Styles -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Styles</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Background Color</label>
                                    <input type="color" 
                                           class="form-control form-control-color" 
                                           name="style[background_color]"
                                           value="{{ $header->style['background_color'] ?? '#ffffff' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Text Color</label>
                                    <input type="color" 
                                           class="form-control form-control-color" 
                                           name="style[text_color]"
                                           value="{{ $header->style['text_color'] ?? '#000000' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Visibility -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Visibility</h6>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="visibility[contact_info]"
                                       {{ ($header->visibility['contact_info'] ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label">Show Contact Information</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="visibility[social_links]"
                                       {{ ($header->visibility['social_links'] ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label">Show Social Links</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer Settings -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Footer Settings</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" id="saveFooter">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <button type="button" class="btn btn-info" id="previewFooter">
                            <i class="fas fa-eye"></i> Preview
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="footerForm">
                        <!-- Logo -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Logo</h6>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img src="{{ $footer->content['logo'] ?? asset('images/default-logo.png') }}" 
                                         alt="Logo" 
                                         class="img-thumbnail"
                                         style="max-height: 50px;">
                                </div>
                                <div class="col">
                                    <input type="file" 
                                           class="form-control" 
                                           name="logo" 
                                           accept="image/*">
                                </div>
                            </div>
                        </div>

                        <!-- Footer Columns -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Footer Columns</h6>
                            <div id="footerColumns">
                                @foreach($footer->content['columns'] ?? [] as $index => $column)
                                <div class="card mb-3 footer-column">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="mb-0">Column {{ $index + 1 }}</h6>
                                            <button type="button" class="btn btn-danger btn-sm remove-column">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   name="content[columns][{{ $index }}][title]"
                                                   value="{{ $column['title'] }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Content</label>
                                            <textarea class="form-control" 
                                                      name="content[columns][{{ $index }}][content]"
                                                      rows="3">{{ $column['content'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" id="addFooterColumn">
                                <i class="fas fa-plus"></i> Add Column
                            </button>
                        </div>

                        <!-- Copyright -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Copyright</h6>
                            <textarea class="form-control" 
                                      name="content[copyright]"
                                      rows="2">{{ $footer->content['copyright'] ?? '' }}</textarea>
                            <small class="text-muted">Use {year} for dynamic year</small>
                        </div>

                        <!-- Styles -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Styles</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Background Color</label>
                                    <input type="color" 
                                           class="form-control form-control-color" 
                                           name="style[background_color]"
                                           value="{{ $footer->style['background_color'] ?? '#000000' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Text Color</label>
                                    <input type="color" 
                                           class="form-control form-control-color" 
                                           name="style[text_color]"
                                           value="{{ $footer->style['text_color'] ?? '#ffffff' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Visibility -->
                        <div class="mb-4">
                            <h6 class="fw-bold">Visibility</h6>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="visibility[logo]"
                                       {{ ($footer->visibility['logo'] ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label">Show Logo</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="visibility[social_links]"
                                       {{ ($footer->visibility['social_links'] ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label">Show Social Links</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="visibility[copyright]"
                                       {{ ($footer->visibility['copyright'] ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label">Show Copyright</label>
                            </div>
                        </div>
                    </form>
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
                <h5 class="modal-title">Layout Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="previewFrame" style="width: 100%; height: 80vh; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    const headerForm = document.getElementById('headerForm');
    const footerForm = document.getElementById('footerForm');

    // Save header settings
    document.getElementById('saveHeader').addEventListener('click', async function() {
        const formData = new FormData(headerForm);
        
        try {
            const response = await fetch('/admin/montoya/layout/header', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            if (!response.ok) throw new Error('Failed to save header settings');
            
            alert('Header settings saved successfully');
        } catch (error) {
            console.error('Error:', error);
            alert('Error saving header settings');
        }
    });

    // Save footer settings
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

    // Preview header
    document.getElementById('previewHeader').addEventListener('click', function() {
        const previewFrame = document.getElementById('previewFrame');
        previewFrame.src = '/admin/montoya/layout/preview/header';
        previewModal.show();
    });

    // Preview footer
    document.getElementById('previewFooter').addEventListener('click', function() {
        const previewFrame = document.getElementById('previewFrame');
        previewFrame.src = '/admin/montoya/layout/preview/footer';
        previewModal.show();
    });

    // Add social link
    document.getElementById('addSocialLink').addEventListener('click', function() {
        const socialLinks = document.getElementById('socialLinks');
        const platforms = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube'];
        const index = socialLinks.children.length;
        
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <select class="form-select" style="max-width: 120px;" onchange="this.nextElementSibling.name = 'content[social_links][' + this.value + ']'">
                ${platforms.map(platform => `
                    <option value="${platform}">${platform.charAt(0).toUpperCase() + platform.slice(1)}</option>
                `).join('')}
            </select>
            <input type="text" 
                   class="form-control" 
                   name="content[social_links][${platforms[0]}]"
                   placeholder="URL">
            <button type="button" class="btn btn-danger remove-social">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        socialLinks.appendChild(div);
    });

    // Remove social link
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-social')) {
            e.target.closest('.input-group').remove();
        }
    });

    // Add footer column
    document.getElementById('addFooterColumn').addEventListener('click', function() {
        const footerColumns = document.getElementById('footerColumns');
        const index = footerColumns.children.length;
        
        const div = document.createElement('div');
        div.className = 'card mb-3 footer-column';
        div.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Column ${index + 1}</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-column">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" 
                           class="form-control" 
                           name="content[columns][${index}][title]">
                </div>
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea class="form-control" 
                              name="content[columns][${index}][content]"
                              rows="3"></textarea>
                </div>
            </div>
        `;
        
        footerColumns.appendChild(div);
    });

    // Remove footer column
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-column')) {
            e.target.closest('.footer-column').remove();
            updateColumnNumbers();
        }
    });

    function updateColumnNumbers() {
        const columns = document.querySelectorAll('.footer-column');
        columns.forEach((column, index) => {
            column.querySelector('h6').textContent = `Column ${index + 1}`;
            column.querySelectorAll('[name^="content[columns]"]').forEach(input => {
                input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
            });
        });
    }
});
</script>
@endpush
