@php
    $content = $section->pivot->content ?? $section->content ?? [];
    $style = $content['style'] ?? 'main';
@endphp

<div class="section-content">
    <!-- Style Selection -->
    <div class="mb-4">
        <label class="form-label">Hero Style</label>
        <select class="form-select" name="sections[{{ $section->id }}][content][style]">
            <option value="main" {{ $style === 'main' ? 'selected' : '' }}>Main Hero with CTA</option>
            <option value="video" {{ $style === 'video' ? 'selected' : '' }}>Video Hero</option>
            <option value="image" {{ $style === 'image' ? 'selected' : '' }}>Image Hero</option>
            <option value="simple" {{ $style === 'simple' ? 'selected' : '' }}>Simple Hero</option>
        </select>
    </div>

    <!-- Basic Content -->
    <div class="mb-4">
        <label class="form-label">Title</label>
        <input type="text" 
               class="form-control" 
               name="sections[{{ $section->id }}][content][title]"
               value="{{ $content['title'] ?? '' }}"
               placeholder="Enter hero title">
    </div>

    <div class="mb-4">
        <label class="form-label">Subtitle</label>
        <input type="text" 
               class="form-control" 
               name="sections[{{ $section->id }}][content][subtitle]"
               value="{{ $content['subtitle'] ?? '' }}"
               placeholder="Enter subtitle">
    </div>

    <div class="mb-4">
        <label class="form-label">Description</label>
        <textarea class="form-control" 
                  name="sections[{{ $section->id }}][content][description]"
                  rows="3"
                  placeholder="Enter description">{{ $content['description'] ?? '' }}</textarea>
    </div>

    <!-- Buttons -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h6>Primary Button</h6>
            <div class="mb-3">
                <label class="form-label">Text</label>
                <input type="text" 
                       class="form-control" 
                       name="sections[{{ $section->id }}][content][primary_button][text]"
                       value="{{ $content['primary_button']['text'] ?? '' }}"
                       placeholder="Button text">
            </div>
            <div class="mb-3">
                <label class="form-label">URL</label>
                <input type="text" 
                       class="form-control" 
                       name="sections[{{ $section->id }}][content][primary_button][url]"
                       value="{{ $content['primary_button']['url'] ?? '' }}"
                       placeholder="/contact">
            </div>
        </div>
        <div class="col-md-6">
            <h6>Secondary Button</h6>
            <div class="mb-3">
                <label class="form-label">Text</label>
                <input type="text" 
                       class="form-control" 
                       name="sections[{{ $section->id }}][content][secondary_button][text]"
                       value="{{ $content['secondary_button']['text'] ?? '' }}"
                       placeholder="Button text">
            </div>
            <div class="mb-3">
                <label class="form-label">URL</label>
                <input type="text" 
                       class="form-control" 
                       name="sections[{{ $section->id }}][content][secondary_button][url]"
                       value="{{ $content['secondary_button']['url'] ?? '' }}"
                       placeholder="/portfolio">
            </div>
        </div>
    </div>

    <!-- Background Settings -->
    <div class="mb-4">
        <h6>Background Settings</h6>
        <div class="mb-3">
            <label class="form-label">Background Type</label>
            <select class="form-select" 
                    name="sections[{{ $section->id }}][content][background_type]"
                    data-toggle="background-type">
                <option value="gradient" {{ ($content['background_type'] ?? '') === 'gradient' ? 'selected' : '' }}>Gradient</option>
                <option value="image" {{ ($content['background_type'] ?? '') === 'image' ? 'selected' : '' }}>Image</option>
                <option value="video" {{ ($content['background_type'] ?? '') === 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <!-- Image Background -->
        <div class="background-settings" data-type="image" style="display: none;">
            <div class="mb-3">
                <label class="form-label">Background Image</label>
                <div class="input-group">
                    <input type="text" 
                           class="form-control" 
                           name="sections[{{ $section->id }}][content][background_image]"
                           value="{{ $content['background_image'] ?? '' }}"
                           placeholder="/images/hero-bg.jpg">
                    <button type="button" class="btn btn-outline-primary media-browser">
                        <i class="fas fa-image"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Video Background -->
        <div class="background-settings" data-type="video" style="display: none;">
            <div class="mb-3">
                <label class="form-label">Video URL</label>
                <input type="text" 
                       class="form-control" 
                       name="sections[{{ $section->id }}][content][video_url]"
                       value="{{ $content['video_url'] ?? '' }}"
                       placeholder="https://example.com/video.mp4">
            </div>
            <div class="mb-3">
                <label class="form-label">Video Poster</label>
                <div class="input-group">
                    <input type="text" 
                           class="form-control" 
                           name="sections[{{ $section->id }}][content][video_poster]"
                           value="{{ $content['video_poster'] ?? '' }}"
                           placeholder="/images/video-poster.jpg">
                    <button type="button" class="btn btn-outline-primary media-browser">
                        <i class="fas fa-image"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Gradient Background -->
        <div class="background-settings" data-type="gradient" style="display: none;">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Start Color</label>
                        <input type="color" 
                               class="form-control" 
                               name="sections[{{ $section->id }}][content][gradient_start]"
                               value="{{ $content['gradient_start'] ?? '#4a90e2' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">End Color</label>
                        <input type="color" 
                               class="form-control" 
                               name="sections[{{ $section->id }}][content][gradient_end]"
                               value="{{ $content['gradient_end'] ?? '#7c4dff' }}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Gradient Direction</label>
                <select class="form-select" 
                        name="sections[{{ $section->id }}][content][gradient_direction]">
                    <option value="45deg" {{ ($content['gradient_direction'] ?? '') === '45deg' ? 'selected' : '' }}>45° Diagonal</option>
                    <option value="90deg" {{ ($content['gradient_direction'] ?? '') === '90deg' ? 'selected' : '' }}>Horizontal</option>
                    <option value="180deg" {{ ($content['gradient_direction'] ?? '') === '180deg' ? 'selected' : '' }}>Vertical</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <div class="form-check form-switch">
                <input type="checkbox" 
                       class="form-check-input" 
                       name="sections[{{ $section->id }}][content][background_overlay]"
                       value="1"
                       {{ ($content['background_overlay'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label">Add Dark Overlay</label>
            </div>
        </div>
    </div>

    <!-- Additional Settings -->
    <div class="mb-4">
        <h6>Additional Settings</h6>
        <div class="form-check form-switch mb-2">
            <input type="checkbox" 
                   class="form-check-input" 
                   name="sections[{{ $section->id }}][content][animate]"
                   value="1"
                   {{ ($content['animate'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Enable Animations</label>
        </div>
        <div class="form-check form-switch">
            <input type="checkbox" 
                   class="form-check-input" 
                   name="sections[{{ $section->id }}][content][full_height]"
                   value="1"
                   {{ ($content['full_height'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Full Height Hero</label>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle background type toggle
    const backgroundTypeSelect = document.querySelector('[data-toggle="background-type"]');
    const backgroundSettings = document.querySelectorAll('.background-settings');

    function toggleBackgroundSettings() {
        const selectedType = backgroundTypeSelect.value;
        backgroundSettings.forEach(setting => {
            if (setting.dataset.type === selectedType) {
                setting.style.display = 'block';
            } else {
                setting.style.display = 'none';
            }
        });
    }

    backgroundTypeSelect.addEventListener('change', toggleBackgroundSettings);
    toggleBackgroundSettings(); // Initial state

    // Handle media browser
    document.querySelectorAll('.media-browser').forEach(button => {
        button.addEventListener('click', function() {
            // Implement media browser functionality
            // This could open a modal with media library
            console.log('Open media browser');
        });
    });
});
</script>
@endpush 