@extends('admin.layouts.app')

@section('title', isset($seoSetting) ? 'Edit SEO Settings' : 'Create SEO Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ isset($seoSetting) ? 'Edit SEO Settings' : 'Create SEO Settings' }}</h3>
                </div>
                
                <div class="card-body">
                    <form action="{{ isset($seoSetting) ? route('admin.seo.update', $seoSetting) : route('admin.seo.store') }}"
                          method="POST"
                          id="seoForm">
                        @csrf
                        @if(isset($seoSetting))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <!-- Basic SEO Settings -->
                            <div class="col-md-6">
                                <h5 class="mb-4">Basic SEO Settings</h5>
                                
                                <div class="mb-3">
                                    <label for="page_type" class="form-label">Page Type</label>
                                    <select class="form-select @error('page_type') is-invalid @enderror"
                                            id="page_type"
                                            name="page_type"
                                            required>
                                        <option value="">Select Page Type</option>
                                        <option value="page" {{ old('page_type', $seoSetting->page_type ?? '') == 'page' ? 'selected' : '' }}>Page</option>
                                        <option value="post" {{ old('page_type', $seoSetting->page_type ?? '') == 'post' ? 'selected' : '' }}>Post</option>
                                        <option value="component" {{ old('page_type', $seoSetting->page_type ?? '') == 'component' ? 'selected' : '' }}>Component</option>
                                    </select>
                                    @error('page_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="page_identifier" class="form-label">Page Identifier (URL/Slug)</label>
                                    <input type="text"
                                           class="form-control @error('page_identifier') is-invalid @enderror"
                                           id="page_identifier"
                                           name="page_identifier"
                                           value="{{ old('page_identifier', $seoSetting->page_identifier ?? '') }}"
                                           required>
                                    @error('page_identifier')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Meta Title</label>
                                    <input type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           name="title"
                                           value="{{ old('title', $seoSetting->title ?? '') }}"
                                           maxlength="60">
                                    <small class="text-muted">Characters: <span id="titleCount">0</span>/60</small>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description"
                                              name="description"
                                              rows="3"
                                              maxlength="160">{{ old('description', $seoSetting->description ?? '') }}</textarea>
                                    <small class="text-muted">Characters: <span id="descriptionCount">0</span>/160</small>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="keywords" class="form-label">Meta Keywords</label>
                                    <input type="text"
                                           class="form-control @error('keywords') is-invalid @enderror"
                                           id="keywords"
                                           name="keywords"
                                           value="{{ old('keywords', $seoSetting->keywords ?? '') }}">
                                    <small class="text-muted">Separate keywords with commas</small>
                                    @error('keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="canonical_url" class="form-label">Canonical URL</label>
                                    <input type="url"
                                           class="form-control @error('canonical_url') is-invalid @enderror"
                                           id="canonical_url"
                                           name="canonical_url"
                                           value="{{ old('canonical_url', $seoSetting->canonical_url ?? '') }}">
                                    @error('canonical_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="robots" class="form-label">Robots</label>
                                    <select class="form-select @error('robots') is-invalid @enderror"
                                            id="robots"
                                            name="robots">
                                        <option value="index,follow" {{ old('robots', $seoSetting->robots ?? '') == 'index,follow' ? 'selected' : '' }}>Index, Follow</option>
                                        <option value="noindex,follow" {{ old('robots', $seoSetting->robots ?? '') == 'noindex,follow' ? 'selected' : '' }}>No Index, Follow</option>
                                        <option value="index,nofollow" {{ old('robots', $seoSetting->robots ?? '') == 'index,nofollow' ? 'selected' : '' }}>Index, No Follow</option>
                                        <option value="noindex,nofollow" {{ old('robots', $seoSetting->robots ?? '') == 'noindex,nofollow' ? 'selected' : '' }}>No Index, No Follow</option>
                                    </select>
                                    @error('robots')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Social Media Settings -->
                            <div class="col-md-6">
                                <h5 class="mb-4">Social Media Settings</h5>

                                <!-- OpenGraph -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Facebook/OpenGraph</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="og_title" class="form-label">OG Title</label>
                                            <input type="text"
                                                   class="form-control @error('og_title') is-invalid @enderror"
                                                   id="og_title"
                                                   name="og_title"
                                                   value="{{ old('og_title', $seoSetting->og_title ?? '') }}"
                                                   maxlength="60">
                                            @error('og_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="og_description" class="form-label">OG Description</label>
                                            <textarea class="form-control @error('og_description') is-invalid @enderror"
                                                      id="og_description"
                                                      name="og_description"
                                                      rows="3"
                                                      maxlength="160">{{ old('og_description', $seoSetting->og_description ?? '') }}</textarea>
                                            @error('og_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="og_image" class="form-label">OG Image URL</label>
                                            <input type="url"
                                                   class="form-control @error('og_image') is-invalid @enderror"
                                                   id="og_image"
                                                   name="og_image"
                                                   value="{{ old('og_image', $seoSetting->og_image ?? '') }}">
                                            @error('og_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Twitter Card -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Twitter Card</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="twitter_card" class="form-label">Card Type</label>
                                            <select class="form-select @error('twitter_card') is-invalid @enderror"
                                                    id="twitter_card"
                                                    name="twitter_card">
                                                <option value="summary" {{ old('twitter_card', $seoSetting->twitter_card ?? '') == 'summary' ? 'selected' : '' }}>Summary</option>
                                                <option value="summary_large_image" {{ old('twitter_card', $seoSetting->twitter_card ?? '') == 'summary_large_image' ? 'selected' : '' }}>Summary Large Image</option>
                                            </select>
                                            @error('twitter_card')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="twitter_title" class="form-label">Twitter Title</label>
                                            <input type="text"
                                                   class="form-control @error('twitter_title') is-invalid @enderror"
                                                   id="twitter_title"
                                                   name="twitter_title"
                                                   value="{{ old('twitter_title', $seoSetting->twitter_title ?? '') }}"
                                                   maxlength="60">
                                            @error('twitter_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="twitter_description" class="form-label">Twitter Description</label>
                                            <textarea class="form-control @error('twitter_description') is-invalid @enderror"
                                                      id="twitter_description"
                                                      name="twitter_description"
                                                      rows="3"
                                                      maxlength="160">{{ old('twitter_description', $seoSetting->twitter_description ?? '') }}</textarea>
                                            @error('twitter_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="twitter_image" class="form-label">Twitter Image URL</label>
                                            <input type="url"
                                                   class="form-control @error('twitter_image') is-invalid @enderror"
                                                   id="twitter_image"
                                                   name="twitter_image"
                                                   value="{{ old('twitter_image', $seoSetting->twitter_image ?? '') }}">
                                            @error('twitter_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Schema Markup -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Schema Markup</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="schema_type" class="form-label">Schema Type</label>
                                            <select class="form-select" id="schema_type">
                                                <option value="">Select Schema Type</option>
                                                <option value="Organization">Organization</option>
                                                <option value="LocalBusiness">Local Business</option>
                                                <option value="Article">Article</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="schema_markup" class="form-label">Schema JSON</label>
                                            <textarea class="form-control @error('schema_markup') is-invalid @enderror"
                                                      id="schema_markup"
                                                      name="schema_markup"
                                                      rows="5">{{ old('schema_markup', $seoSetting->schema_markup ? json_encode($seoSetting->schema_markup, JSON_PRETTY_PRINT) : '') }}</textarea>
                                            @error('schema_markup')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="button" 
                                                class="btn btn-secondary"
                                                id="generateSchema">
                                            Generate Schema
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($seoSetting) ? 'Update' : 'Create' }} SEO Settings
                                </button>
                                <a href="{{ route('admin.seo.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counters
    const title = document.getElementById('title');
    const titleCount = document.getElementById('titleCount');
    const description = document.getElementById('description');
    const descriptionCount = document.getElementById('descriptionCount');
    
    function updateCount(element, counter) {
        counter.textContent = element.value.length;
        if (element.value.length > element.maxLength) {
            counter.classList.add('text-danger');
        } else {
            counter.classList.remove('text-danger');
        }
    }
    
    title.addEventListener('input', () => updateCount(title, titleCount));
    description.addEventListener('input', () => updateCount(description, descriptionCount));
    
    // Initial count update
    updateCount(title, titleCount);
    updateCount(description, descriptionCount);
    
    // Schema Generator
    const schemaType = document.getElementById('schema_type');
    const schemaMarkup = document.getElementById('schema_markup');
    const generateSchemaBtn = document.getElementById('generateSchema');
    
    generateSchemaBtn.addEventListener('click', async function() {
        const type = schemaType.value;
        if (!type) {
            alert('Please select a schema type');
            return;
        }
        
        try {
            // Collect data based on schema type
            let data = {};
            switch (type) {
                case 'Organization':
                    data = {
                        name: prompt('Organization Name:'),
                        url: prompt('Website URL:'),
                        logo: prompt('Logo URL:'),
                        phone: prompt('Phone Number:')
                    };
                    break;
                    
                case 'LocalBusiness':
                    data = {
                        name: prompt('Business Name:'),
                        image: prompt('Business Image URL:'),
                        street: prompt('Street Address:'),
                        city: prompt('City:'),
                        region: prompt('State/Region:'),
                        postal: prompt('Postal Code:'),
                        country: prompt('Country:'),
                        lat: prompt('Latitude:'),
                        lng: prompt('Longitude:'),
                        url: prompt('Website URL:'),
                        phone: prompt('Phone Number:')
                    };
                    break;
                    
                case 'Article':
                    data = {
                        headline: prompt('Article Headline:'),
                        image: prompt('Article Image URL:'),
                        author: prompt('Author Name:'),
                        publisher: prompt('Publisher Name:'),
                        publisher_logo: prompt('Publisher Logo URL:'),
                        date_published: prompt('Date Published (YYYY-MM-DD):'),
                        date_modified: prompt('Date Modified (YYYY-MM-DD):')
                    };
                    break;
            }
            
            const response = await fetch('/admin/seo/generate-schema', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ type, data })
            });
            
            const result = await response.json();
            if (result.schema) {
                schemaMarkup.value = JSON.stringify(result.schema, null, 2);
            } else {
                throw new Error('Failed to generate schema');
            }
        } catch (error) {
            console.error('Error generating schema:', error);
            alert('Error generating schema markup');
        }
    });
    
    // Form Validation
    const form = document.getElementById('seoForm');
    form.addEventListener('submit', function(e) {
        if (schemaMarkup.value) {
            try {
                JSON.parse(schemaMarkup.value);
            } catch (error) {
                e.preventDefault();
                alert('Invalid JSON in Schema Markup');
            }
        }
    });
});
</script>
@endpush
