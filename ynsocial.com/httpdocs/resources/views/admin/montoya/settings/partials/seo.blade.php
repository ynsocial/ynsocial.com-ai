<div class="card">
    <div class="card-header">
        <h5 class="mb-0">SEO Settings</h5>
    </div>
    <div class="card-body">
        <!-- Meta Information -->
        <div class="mb-4">
            <h6 class="mb-3">Meta Information</h6>
            
            <div class="mb-3">
                <label class="form-label">Meta Title Template</label>
                <input type="text" class="form-control" name="seo[meta_title_template]" 
                       value="{{ $settings->seo['meta_title_template'] ?? '{title} | {site_name}' }}"
                       placeholder="{title} | {site_name}">
                <small class="text-muted">Available variables: {title}, {site_name}, {separator}, {page}</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Description Template</label>
                <textarea class="form-control" name="seo[meta_description_template]" rows="3"
                          placeholder="Welcome to {site_name}. {description}">{{ $settings->seo['meta_description_template'] ?? '' }}</textarea>
                <small class="text-muted">Available variables: {site_name}, {description}, {keywords}</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Default Keywords</label>
                <input type="text" class="form-control" name="seo[default_keywords]" 
                       value="{{ $settings->seo['default_keywords'] ?? '' }}"
                       placeholder="keyword1, keyword2, keyword3">
                <small class="text-muted">Comma-separated list of keywords</small>
            </div>
        </div>

        <!-- Open Graph -->
        <div class="mb-4">
            <h6 class="mb-3">Open Graph Settings</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="seo[enable_open_graph]" 
                           id="enableOpenGraph" {{ !empty($settings->seo['enable_open_graph']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableOpenGraph">Enable Open Graph Tags</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Default OG Image</label>
                <div class="d-flex align-items-center">
                    @if(!empty($settings->seo['default_og_image']))
                        <img src="{{ $settings->seo['default_og_image'] }}" 
                             alt="OG Image" 
                             class="me-3" 
                             style="max-height: 50px;">
                    @endif
                    <input type="file" class="form-control" name="seo[default_og_image]" accept="image/*">
                </div>
                <small class="text-muted">Recommended size: 1200x630 pixels</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Facebook App ID</label>
                <input type="text" class="form-control" name="seo[facebook_app_id]" 
                       value="{{ $settings->seo['facebook_app_id'] ?? '' }}">
            </div>
        </div>

        <!-- Twitter Cards -->
        <div class="mb-4">
            <h6 class="mb-3">Twitter Card Settings</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="seo[enable_twitter_cards]" 
                           id="enableTwitterCards" {{ !empty($settings->seo['enable_twitter_cards']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableTwitterCards">Enable Twitter Cards</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Twitter Card Type</label>
                <select class="form-select" name="seo[twitter_card_type]">
                    <option value="summary" {{ ($settings->seo['twitter_card_type'] ?? '') == 'summary' ? 'selected' : '' }}>
                        Summary Card
                    </option>
                    <option value="summary_large_image" {{ ($settings->seo['twitter_card_type'] ?? '') == 'summary_large_image' ? 'selected' : '' }}>
                        Summary Card with Large Image
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Twitter Username</label>
                <div class="input-group">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" name="seo[twitter_username]" 
                           value="{{ $settings->seo['twitter_username'] ?? '' }}"
                           placeholder="username">
                </div>
            </div>
        </div>

        <!-- Robots -->
        <div class="mb-4">
            <h6 class="mb-3">Robots Settings</h6>
            
            <div class="mb-3">
                <label class="form-label">Robots.txt Content</label>
                <textarea class="form-control font-monospace" name="seo[robots_txt]" rows="5">{{ $settings->seo['robots_txt'] ?? "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /private/" }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Default Robots Meta</label>
                <select class="form-select" name="seo[default_robots_meta]">
                    <option value="index,follow" {{ ($settings->seo['default_robots_meta'] ?? '') == 'index,follow' ? 'selected' : '' }}>
                        Index, Follow
                    </option>
                    <option value="noindex,follow" {{ ($settings->seo['default_robots_meta'] ?? '') == 'noindex,follow' ? 'selected' : '' }}>
                        No Index, Follow
                    </option>
                    <option value="index,nofollow" {{ ($settings->seo['default_robots_meta'] ?? '') == 'index,nofollow' ? 'selected' : '' }}>
                        Index, No Follow
                    </option>
                    <option value="noindex,nofollow" {{ ($settings->seo['default_robots_meta'] ?? '') == 'noindex,nofollow' ? 'selected' : '' }}>
                        No Index, No Follow
                    </option>
                </select>
            </div>
        </div>

        <!-- Structured Data -->
        <div class="mb-4">
            <h6 class="mb-3">Structured Data</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="seo[enable_structured_data]" 
                           id="enableStructuredData" {{ !empty($settings->seo['enable_structured_data']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableStructuredData">Enable Structured Data</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Organization Information</label>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Organization Name</label>
                            <input type="text" class="form-control" name="seo[organization_name]" 
                                   value="{{ $settings->seo['organization_name'] ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Logo URL</label>
                            <input type="url" class="form-control" name="seo[organization_logo]" 
                                   value="{{ $settings->seo['organization_logo'] ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Social Profiles</label>
                            <div id="socialProfiles">
                                @foreach($settings->seo['social_profiles'] ?? [] as $profile)
                                <div class="input-group mb-2">
                                    <input type="url" class="form-control" name="seo[social_profiles][]" 
                                           value="{{ $profile }}">
                                    <button type="button" class="btn btn-outline-danger remove-profile">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="addSocialProfile">
                                <i class="fas fa-plus"></i> Add Social Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sitemap -->
        <div class="mb-4">
            <h6 class="mb-3">Sitemap Settings</h6>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="seo[enable_sitemap]" 
                           id="enableSitemap" {{ !empty($settings->seo['enable_sitemap']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enableSitemap">Enable XML Sitemap</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Update Frequency</label>
                <select class="form-select" name="seo[sitemap_frequency]">
                    <option value="always" {{ ($settings->seo['sitemap_frequency'] ?? '') == 'always' ? 'selected' : '' }}>
                        Always
                    </option>
                    <option value="hourly" {{ ($settings->seo['sitemap_frequency'] ?? '') == 'hourly' ? 'selected' : '' }}>
                        Hourly
                    </option>
                    <option value="daily" {{ ($settings->seo['sitemap_frequency'] ?? '') == 'daily' ? 'selected' : '' }}>
                        Daily
                    </option>
                    <option value="weekly" {{ ($settings->seo['sitemap_frequency'] ?? '') == 'weekly' ? 'selected' : '' }}>
                        Weekly
                    </option>
                    <option value="monthly" {{ ($settings->seo['sitemap_frequency'] ?? '') == 'monthly' ? 'selected' : '' }}>
                        Monthly
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Priority Settings</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-2">
                            <span class="input-group-text">Homepage</span>
                            <input type="number" class="form-control" name="seo[sitemap_priority_home]" 
                                   value="{{ $settings->seo['sitemap_priority_home'] ?? '1.0' }}"
                                   min="0.1" max="1.0" step="0.1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-2">
                            <span class="input-group-text">Posts</span>
                            <input type="number" class="form-control" name="seo[sitemap_priority_posts]" 
                                   value="{{ $settings->seo['sitemap_priority_posts'] ?? '0.8' }}"
                                   min="0.1" max="1.0" step="0.1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add Social Profile
    document.getElementById('addSocialProfile').addEventListener('click', function() {
        const container = document.getElementById('socialProfiles');
        const template = `
            <div class="input-group mb-2">
                <input type="url" class="form-control" name="seo[social_profiles][]" placeholder="https://">
                <button type="button" class="btn btn-outline-danger remove-profile">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
    });

    // Remove Social Profile
    document.getElementById('socialProfiles').addEventListener('click', function(e) {
        if (e.target.closest('.remove-profile')) {
            e.target.closest('.input-group').remove();
        }
    });
});
</script>
@endpush
