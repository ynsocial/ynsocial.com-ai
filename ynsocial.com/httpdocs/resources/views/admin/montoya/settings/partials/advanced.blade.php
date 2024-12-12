<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Advanced Settings</h5>
    </div>
    <div class="card-body">
        <!-- Performance -->
        <div class="mb-4">
            <h6 class="mb-3">Performance</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="advanced[cache][enabled]" 
                           id="enableCache" {{ !empty($settings->advanced['cache']['enabled']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableCache">Enable Page Caching</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Cache Duration</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="advanced[cache][duration]" 
                           value="{{ $settings->advanced['cache']['duration'] ?? '1440' }}"
                           min="1" step="1">
                    <span class="input-group-text">minutes</span>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="advanced[minify][enabled]" 
                           id="enableMinification" {{ !empty($settings->advanced['minify']['enabled']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableMinification">Enable Asset Minification</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Minification Options</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="advanced[minify][css]" 
                           id="minifyCSS" {{ !empty($settings->advanced['minify']['css']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="minifyCSS">Minify CSS</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="advanced[minify][js]" 
                           id="minifyJS" {{ !empty($settings->advanced['minify']['js']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="minifyJS">Minify JavaScript</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="advanced[minify][html]" 
                           id="minifyHTML" {{ !empty($settings->advanced['minify']['html']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="minifyHTML">Minify HTML</label>
                </div>
            </div>
        </div>

        <!-- Image Optimization -->
        <div class="mb-4">
            <h6 class="mb-3">Image Optimization</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="advanced[images][optimization]" 
                           id="enableImageOptimization" {{ !empty($settings->advanced['images']['optimization']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableImageOptimization">Enable Image Optimization</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Image Quality</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="advanced[images][quality]" 
                           value="{{ $settings->advanced['images']['quality'] ?? '85' }}"
                           min="1" max="100" step="1">
                    <span class="input-group-text">%</span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Maximum Dimensions</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-2">
                            <span class="input-group-text">Width</span>
                            <input type="number" class="form-control" name="advanced[images][max_width]" 
                                   value="{{ $settings->advanced['images']['max_width'] ?? '2000' }}"
                                   min="100" step="100">
                            <span class="input-group-text">px</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-2">
                            <span class="input-group-text">Height</span>
                            <input type="number" class="form-control" name="advanced[images][max_height]" 
                                   value="{{ $settings->advanced['images']['max_height'] ?? '2000' }}"
                                   min="100" step="100">
                            <span class="input-group-text">px</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="advanced[images][webp]" 
                           id="enableWebP" {{ !empty($settings->advanced['images']['webp']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableWebP">Generate WebP Format</label>
                </div>
            </div>
        </div>

        <!-- Security -->
        <div class="mb-4">
            <h6 class="mb-3">Security</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="advanced[security][force_ssl]" 
                           id="forceSSL" {{ !empty($settings->advanced['security']['force_ssl']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="forceSSL">Force SSL</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Content Security Policy</label>
                <textarea class="form-control font-monospace" name="advanced[security][csp]" 
                          rows="4" placeholder="default-src 'self'; script-src 'self' 'unsafe-inline';">{{ $settings->advanced['security']['csp'] ?? '' }}</textarea>
                <small class="text-muted">Enter your Content Security Policy directives</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Allowed File Types</label>
                <input type="text" class="form-control" name="advanced[security][allowed_files]" 
                       value="{{ $settings->advanced['security']['allowed_files'] ?? 'jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx' }}"
                       placeholder="jpg,jpeg,png,gif,pdf">
                <small class="text-muted">Comma-separated list of allowed file extensions</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Maximum Upload Size</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="advanced[security][max_upload]" 
                           value="{{ $settings->advanced['security']['max_upload'] ?? '10' }}"
                           min="1" step="1">
                    <span class="input-group-text">MB</span>
                </div>
            </div>
        </div>

        <!-- API Integration -->
        <div class="mb-4">
            <h6 class="mb-3">API Integration</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="advanced[api][enabled]" 
                           id="enableAPI" {{ !empty($settings->advanced['api']['enabled']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableAPI">Enable API Access</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">API Key</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ $settings->advanced['api']['key'] ?? '' }}" readonly>
                    <button type="button" class="btn btn-outline-primary" id="generateAPIKey">
                        Generate New Key
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Allowed Origins</label>
                <textarea class="form-control" name="advanced[api][allowed_origins]" 
                          rows="3" placeholder="https://example.com">{{ $settings->advanced['api']['allowed_origins'] ?? '' }}</textarea>
                <small class="text-muted">One origin per line</small>
            </div>
        </div>

        <!-- Custom Code -->
        <div class="mb-4">
            <h6 class="mb-3">Custom Code</h6>
            
            <div class="mb-3">
                <label class="form-label">Custom CSS</label>
                <textarea class="form-control font-monospace" name="advanced[custom][css]" 
                          rows="4" placeholder="/* Add your custom CSS here */">{{ $settings->advanced['custom']['css'] ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Custom JavaScript</label>
                <textarea class="form-control font-monospace" name="advanced[custom][js]" 
                          rows="4" placeholder="// Add your custom JavaScript here">{{ $settings->advanced['custom']['js'] ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Custom PHP</label>
                <textarea class="form-control font-monospace" name="advanced[custom][php]" 
                          rows="4" placeholder="<?php // Add your custom PHP code here ?>">{{ $settings->advanced['custom']['php'] ?? '' }}</textarea>
                <small class="text-warning">Warning: Be careful when adding custom PHP code as it can affect site security and stability.</small>
            </div>
        </div>

        <!-- Backup -->
        <div class="mb-4">
            <h6 class="mb-3">Backup Settings</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="advanced[backup][enabled]" 
                           id="enableBackup" {{ !empty($settings->advanced['backup']['enabled']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableBackup">Enable Automatic Backups</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Backup Frequency</label>
                <select class="form-select" name="advanced[backup][frequency]">
                    <option value="daily" {{ ($settings->advanced['backup']['frequency'] ?? '') == 'daily' ? 'selected' : '' }}>
                        Daily
                    </option>
                    <option value="weekly" {{ ($settings->advanced['backup']['frequency'] ?? '') == 'weekly' ? 'selected' : '' }}>
                        Weekly
                    </option>
                    <option value="monthly" {{ ($settings->advanced['backup']['frequency'] ?? '') == 'monthly' ? 'selected' : '' }}>
                        Monthly
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Retention Period</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="advanced[backup][retention]" 
                           value="{{ $settings->advanced['backup']['retention'] ?? '30' }}"
                           min="1" step="1">
                    <span class="input-group-text">days</span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Backup Storage</label>
                <select class="form-select" name="advanced[backup][storage]">
                    <option value="local" {{ ($settings->advanced['backup']['storage'] ?? '') == 'local' ? 'selected' : '' }}>
                        Local Storage
                    </option>
                    <option value="s3" {{ ($settings->advanced['backup']['storage'] ?? '') == 's3' ? 'selected' : '' }}>
                        Amazon S3
                    </option>
                    <option value="dropbox" {{ ($settings->advanced['backup']['storage'] ?? '') == 'dropbox' ? 'selected' : '' }}>
                        Dropbox
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Generate API Key
    document.getElementById('generateAPIKey').addEventListener('click', async function() {
        try {
            const response = await fetch('/admin/montoya/settings/generate-api-key', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            if (!response.ok) throw new Error('Failed to generate API key');
            
            const data = await response.json();
            this.previousElementSibling.value = data.key;
        } catch (error) {
            console.error('Error:', error);
            alert('Error generating API key');
        }
    });
});
</script>
@endpush
