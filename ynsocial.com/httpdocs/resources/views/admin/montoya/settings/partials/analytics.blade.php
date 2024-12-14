<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Analytics Settings</h5>
    </div>
    <div class="card-body">
        <!-- Google Analytics -->
        <div class="mb-4">
            <h6 class="mb-3">Google Analytics</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="analytics[google][enabled]" 
                           id="enableGoogleAnalytics" {{ !empty($settings->analytics['google']['enabled']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableGoogleAnalytics">Enable Google Analytics</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Measurement ID (GA4)</label>
                <div class="input-group">
                    <span class="input-group-text">G-</span>
                    <input type="text" class="form-control" name="analytics[google][measurement_id]" 
                           value="{{ $settings->analytics['google']['measurement_id'] ?? '' }}"
                           placeholder="XXXXXXXXXX">
                </div>
                <small class="text-muted">Enter your Google Analytics 4 Measurement ID (e.g., G-XXXXXXXXXX)</small>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="analytics[google][anonymize_ip]" 
                           id="anonymizeIP" {{ !empty($settings->analytics['google']['anonymize_ip']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="anonymizeIP">Anonymize IP addresses</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Custom Dimensions</label>
                <div id="customDimensions">
                    @foreach($settings->analytics['google']['custom_dimensions'] ?? [] as $dimension)
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="analytics[google][custom_dimensions][]" 
                               value="{{ $dimension }}" placeholder="dimension_name=value">
                        <button type="button" class="btn btn-outline-danger remove-dimension">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm" id="addCustomDimension">
                    <i class="fas fa-plus"></i> Add Custom Dimension
                </button>
            </div>
        </div>

        <!-- Facebook Pixel -->
        <div class="mb-4">
            <h6 class="mb-3">Facebook Pixel</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="analytics[facebook][enabled]" 
                           id="enableFacebookPixel" {{ !empty($settings->analytics['facebook']['enabled']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableFacebookPixel">Enable Facebook Pixel</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Pixel ID</label>
                <input type="text" class="form-control" name="analytics[facebook][pixel_id]" 
                       value="{{ $settings->analytics['facebook']['pixel_id'] ?? '' }}"
                       placeholder="XXXXXXXXXXXXXXXX">
            </div>

            <div class="mb-3">
                <label class="form-label">Custom Events</label>
                <div id="customEvents">
                    @foreach($settings->analytics['facebook']['custom_events'] ?? [] as $event)
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="analytics[facebook][custom_events][]" 
                               value="{{ $event }}" placeholder="event_name">
                        <button type="button" class="btn btn-outline-danger remove-event">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm" id="addCustomEvent">
                    <i class="fas fa-plus"></i> Add Custom Event
                </button>
            </div>
        </div>

        <!-- Google Tag Manager -->
        <div class="mb-4">
            <h6 class="mb-3">Google Tag Manager</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="analytics[gtm][enabled]" 
                           id="enableGTM" {{ !empty($settings->analytics['gtm']['enabled']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableGTM">Enable Google Tag Manager</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Container ID</label>
                <div class="input-group">
                    <span class="input-group-text">GTM-</span>
                    <input type="text" class="form-control" name="analytics[gtm][container_id]" 
                           value="{{ $settings->analytics['gtm']['container_id'] ?? '' }}"
                           placeholder="XXXXXXX">
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="analytics[gtm][dataLayer]" 
                           id="enableDataLayer" {{ !empty($settings->analytics['gtm']['dataLayer']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableDataLayer">Initialize dataLayer</label>
                </div>
            </div>
        </div>

        <!-- Custom Tracking Scripts -->
        <div class="mb-4">
            <h6 class="mb-3">Custom Tracking Scripts</h6>
            
            <div class="mb-3">
                <label class="form-label">Header Scripts</label>
                <textarea class="form-control font-monospace" name="analytics[custom][header]" 
                          rows="4" placeholder="<!-- Add your custom header scripts here -->">{{ $settings->analytics['custom']['header'] ?? '' }}</textarea>
                <small class="text-muted">These scripts will be added to the &lt;head&gt; section</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Body Scripts</label>
                <textarea class="form-control font-monospace" name="analytics[custom][body]" 
                          rows="4" placeholder="<!-- Add your custom body scripts here -->">{{ $settings->analytics['custom']['body'] ?? '' }}</textarea>
                <small class="text-muted">These scripts will be added before the closing &lt;/body&gt; tag</small>
            </div>
        </div>

        <!-- Cookie Consent -->
        <div class="mb-4">
            <h6 class="mb-3">Cookie Consent</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="analytics[cookie_consent][enabled]" 
                           id="enableCookieConsent" {{ !empty($settings->analytics['cookie_consent']['enabled']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableCookieConsent">Enable Cookie Consent Banner</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Banner Style</label>
                <select class="form-select" name="analytics[cookie_consent][style]">
                    <option value="banner" {{ ($settings->analytics['cookie_consent']['style'] ?? '') == 'banner' ? 'selected' : '' }}>
                        Banner Bottom
                    </option>
                    <option value="popup" {{ ($settings->analytics['cookie_consent']['style'] ?? '') == 'popup' ? 'selected' : '' }}>
                        Popup
                    </option>
                    <option value="floating" {{ ($settings->analytics['cookie_consent']['style'] ?? '') == 'floating' ? 'selected' : '' }}>
                        Floating Box
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Consent Message</label>
                <textarea class="form-control" name="analytics[cookie_consent][message]" 
                          rows="3">{{ $settings->analytics['cookie_consent']['message'] ?? 'This website uses cookies to ensure you get the best experience on our website.' }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Accept Button Text</label>
                        <input type="text" class="form-control" name="analytics[cookie_consent][accept_text]" 
                               value="{{ $settings->analytics['cookie_consent']['accept_text'] ?? 'Accept' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Decline Button Text</label>
                        <input type="text" class="form-control" name="analytics[cookie_consent][decline_text]" 
                               value="{{ $settings->analytics['cookie_consent']['decline_text'] ?? 'Decline' }}">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Privacy Policy Link</label>
                <input type="url" class="form-control" name="analytics[cookie_consent][privacy_link]" 
                       value="{{ $settings->analytics['cookie_consent']['privacy_link'] ?? '' }}"
                       placeholder="https://example.com/privacy-policy">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add Custom Dimension
    document.getElementById('addCustomDimension').addEventListener('click', function() {
        const container = document.getElementById('customDimensions');
        const template = `
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="analytics[google][custom_dimensions][]" 
                       placeholder="dimension_name=value">
                <button type="button" class="btn btn-outline-danger remove-dimension">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
    });

    // Remove Custom Dimension
    document.getElementById('customDimensions').addEventListener('click', function(e) {
        if (e.target.closest('.remove-dimension')) {
            e.target.closest('.input-group').remove();
        }
    });

    // Add Custom Event
    document.getElementById('addCustomEvent').addEventListener('click', function() {
        const container = document.getElementById('customEvents');
        const template = `
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="analytics[facebook][custom_events][]" 
                       placeholder="event_name">
                <button type="button" class="btn btn-outline-danger remove-event">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
    });

    // Remove Custom Event
    document.getElementById('customEvents').addEventListener('click', function(e) {
        if (e.target.closest('.remove-event')) {
            e.target.closest('.input-group').remove();
        }
    });
});
</script>
@endpush
