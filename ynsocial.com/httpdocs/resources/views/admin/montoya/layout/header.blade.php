@extends('admin.layouts.app')

@section('title', 'Header Management')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Header Settings</h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" id="saveHeader">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <button type="button" class="btn btn-info" id="previewHeader">
                                <i class="fas fa-eye"></i> Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="headerForm">
        <div class="row">
            <!-- Settings -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Logo Settings</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Logo Type</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="logo_type" id="logoText" value="text" 
                                       {{ ($header->logo_type ?? '') == 'text' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="logoText">Text</label>

                                <input type="radio" class="btn-check" name="logo_type" id="logoImage" value="image"
                                       {{ ($header->logo_type ?? '') == 'image' ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="logoImage">Image</label>
                            </div>
                        </div>

                        <div id="textLogoSettings" class="mb-3 {{ ($header->logo_type ?? '') == 'text' ? '' : 'd-none' }}">
                            <label class="form-label">Logo Text</label>
                            <input type="text" class="form-control" name="logo_text" 
                                   value="{{ $header->logo_text ?? '' }}">
                        </div>

                        <div id="imageLogoSettings" class="mb-3 {{ ($header->logo_type ?? '') == 'image' ? '' : 'd-none' }}">
                            <label class="form-label">Logo Image</label>
                            <div class="d-flex align-items-center">
                                @if(!empty($header->logo_image))
                                    <img src="{{ $header->logo_image }}" alt="Logo" class="me-3" style="max-height: 50px;">
                                @endif
                                <input type="file" class="form-control" name="logo_image" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Navigation Settings</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Navigation Style</label>
                            <select class="form-select" name="nav_style">
                                <option value="default" {{ ($header->nav_style ?? '') == 'default' ? 'selected' : '' }}>
                                    Default
                                </option>
                                <option value="centered" {{ ($header->nav_style ?? '') == 'centered' ? 'selected' : '' }}>
                                    Centered
                                </option>
                                <option value="split" {{ ($header->nav_style ?? '') == 'split' ? 'selected' : '' }}>
                                    Split
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="sticky_header" id="stickyHeader"
                                       {{ !empty($header->sticky_header) ? 'checked' : '' }}>
                                <label class="form-check-label" for="stickyHeader">Enable Sticky Header</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Contact Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="contact_phone" 
                                   value="{{ $header->contact_phone ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="contact_email" 
                                   value="{{ $header->contact_email ?? '' }}">
                        </div>

                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="show_contact_info" id="showContactInfo"
                                   {{ !empty($header->show_contact_info) ? 'checked' : '' }}>
                            <label class="form-check-label" for="showContactInfo">Show Contact Information</label>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Social Media Links</h6>
                    </div>
                    <div class="card-body">
                        <div id="socialLinks">
                            @foreach($header->social_links ?? [] as $platform => $url)
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="fab fa-{{ $platform }}"></i>
                                </span>
                                <input type="text" class="form-control" name="social_links[{{ $platform }}]" 
                                       value="{{ $url }}" placeholder="{{ ucfirst($platform) }} URL">
                                <button type="button" class="btn btn-outline-danger remove-social">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-outline-primary" id="addSocial">
                            <i class="fas fa-plus"></i> Add Social Link
                        </button>
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
                        <iframe id="previewFrame" src="{{ route('admin.montoya.layout.preview-header') }}" 
                                style="width: 100%; height: 300px; border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Social Link Template -->
<template id="socialLinkTemplate">
    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fab fa-{platform}"></i>
        </span>
        <select class="form-select social-platform" style="max-width: 150px;">
            <option value="">Select Platform</option>
            <option value="facebook">Facebook</option>
            <option value="twitter">Twitter</option>
            <option value="instagram">Instagram</option>
            <option value="linkedin">LinkedIn</option>
            <option value="youtube">YouTube</option>
            <option value="pinterest">Pinterest</option>
        </select>
        <input type="text" class="form-control" placeholder="URL">
        <button type="button" class="btn btn-outline-danger remove-social">
            <i class="fas fa-times"></i>
        </button>
    </div>
</template>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const headerForm = document.getElementById('headerForm');
    const previewFrame = document.getElementById('previewFrame');
    
    // Logo Type Toggle
    document.querySelectorAll('input[name="logo_type"]').forEach(input => {
        input.addEventListener('change', function() {
            document.getElementById('textLogoSettings').classList.toggle('d-none', this.value !== 'text');
            document.getElementById('imageLogoSettings').classList.toggle('d-none', this.value !== 'image');
            updatePreview();
        });
    });

    // Social Links
    document.getElementById('addSocial').addEventListener('click', function() {
        const template = document.getElementById('socialLinkTemplate');
        const clone = template.content.cloneNode(true);
        document.getElementById('socialLinks').appendChild(clone);
        
        // Add event listeners to new elements
        const newGroup = document.getElementById('socialLinks').lastElementChild;
        initSocialGroup(newGroup);
    });

    function initSocialGroup(group) {
        const platformSelect = group.querySelector('.social-platform');
        const urlInput = group.querySelector('input[type="text"]');
        const removeBtn = group.querySelector('.remove-social');
        
        platformSelect.addEventListener('change', function() {
            const icon = group.querySelector('.input-group-text i');
            icon.className = `fab fa-${this.value}`;
            urlInput.name = `social_links[${this.value}]`;
            updatePreview();
        });
        
        urlInput.addEventListener('input', updatePreview);
        
        removeBtn.addEventListener('click', function() {
            group.remove();
            updatePreview();
        });
    }

    // Initialize existing social groups
    document.querySelectorAll('#socialLinks .input-group').forEach(initSocialGroup);

    // Live Preview Update
    let previewTimeout;
    headerForm.addEventListener('input', function() {
        clearTimeout(previewTimeout);
        previewTimeout = setTimeout(updatePreview, 500);
    });

    function updatePreview() {
        const formData = new FormData(headerForm);
        if (previewFrame.contentWindow) {
            previewFrame.contentWindow.postMessage({
                type: 'updatePreview',
                data: Object.fromEntries(formData)
            }, '*');
        }
    }

    // Save Header Settings
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

    // Preview in New Window
    document.getElementById('previewHeader').addEventListener('click', function() {
        window.open('/admin/montoya/layout/preview-header', '_blank');
    });
});
</script>
@endpush
