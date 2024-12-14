<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Social Media Settings</h5>
    </div>
    <div class="card-body">
        <!-- Social Profiles -->
        <div class="mb-4">
            <h6 class="mb-3">Social Media Profiles</h6>
            
            <div id="socialProfiles">
                <!-- Facebook -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fab fa-facebook text-primary"></i> Facebook
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">URL</span>
                        <input type="url" class="form-control" name="social[facebook][url]" 
                               value="{{ $settings->social['facebook']['url'] ?? '' }}"
                               placeholder="https://facebook.com/your-page">
                    </div>
                </div>

                <!-- Twitter -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fab fa-twitter text-info"></i> Twitter
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">URL</span>
                        <input type="url" class="form-control" name="social[twitter][url]" 
                               value="{{ $settings->social['twitter']['url'] ?? '' }}"
                               placeholder="https://twitter.com/your-handle">
                    </div>
                </div>

                <!-- Instagram -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fab fa-instagram text-danger"></i> Instagram
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">URL</span>
                        <input type="url" class="form-control" name="social[instagram][url]" 
                               value="{{ $settings->social['instagram']['url'] ?? '' }}"
                               placeholder="https://instagram.com/your-profile">
                    </div>
                </div>

                <!-- LinkedIn -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fab fa-linkedin text-primary"></i> LinkedIn
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">URL</span>
                        <input type="url" class="form-control" name="social[linkedin][url]" 
                               value="{{ $settings->social['linkedin']['url'] ?? '' }}"
                               placeholder="https://linkedin.com/company/your-company">
                    </div>
                </div>

                <!-- YouTube -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fab fa-youtube text-danger"></i> YouTube
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">URL</span>
                        <input type="url" class="form-control" name="social[youtube][url]" 
                               value="{{ $settings->social['youtube']['url'] ?? '' }}"
                               placeholder="https://youtube.com/your-channel">
                    </div>
                </div>

                <!-- Pinterest -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fab fa-pinterest text-danger"></i> Pinterest
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">URL</span>
                        <input type="url" class="form-control" name="social[pinterest][url]" 
                               value="{{ $settings->social['pinterest']['url'] ?? '' }}"
                               placeholder="https://pinterest.com/your-profile">
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-outline-primary" id="addCustomSocial">
                <i class="fas fa-plus"></i> Add Custom Social Profile
            </button>
        </div>

        <!-- Social Sharing -->
        <div class="mb-4">
            <h6 class="mb-3">Social Sharing</h6>
            
            <div class="mb-3">
                <label class="form-label">Share Buttons Position</label>
                <select class="form-select" name="social[share_position]">
                    <option value="top" {{ ($settings->social['share_position'] ?? '') == 'top' ? 'selected' : '' }}>
                        Top of Content
                    </option>
                    <option value="bottom" {{ ($settings->social['share_position'] ?? '') == 'bottom' ? 'selected' : '' }}>
                        Bottom of Content
                    </option>
                    <option value="both" {{ ($settings->social['share_position'] ?? '') == 'both' ? 'selected' : '' }}>
                        Both Top and Bottom
                    </option>
                    <option value="floating" {{ ($settings->social['share_position'] ?? '') == 'floating' ? 'selected' : '' }}>
                        Floating Sidebar
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Share Buttons Style</label>
                <select class="form-select" name="social[share_style]">
                    <option value="icons" {{ ($settings->social['share_style'] ?? '') == 'icons' ? 'selected' : '' }}>
                        Icons Only
                    </option>
                    <option value="buttons" {{ ($settings->social['share_style'] ?? '') == 'buttons' ? 'selected' : '' }}>
                        Full Buttons
                    </option>
                    <option value="minimal" {{ ($settings->social['share_style'] ?? '') == 'minimal' ? 'selected' : '' }}>
                        Minimal
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Enabled Share Buttons</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="social[share_buttons][facebook]" 
                                   id="shareFacebook" {{ !empty($settings->social['share_buttons']['facebook']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="shareFacebook">Facebook</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="social[share_buttons][twitter]" 
                                   id="shareTwitter" {{ !empty($settings->social['share_buttons']['twitter']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="shareTwitter">Twitter</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="social[share_buttons][linkedin]" 
                                   id="shareLinkedIn" {{ !empty($settings->social['share_buttons']['linkedin']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="shareLinkedIn">LinkedIn</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="social[share_buttons][pinterest]" 
                                   id="sharePinterest" {{ !empty($settings->social['share_buttons']['pinterest']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="sharePinterest">Pinterest</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="social[share_buttons][whatsapp]" 
                                   id="shareWhatsApp" {{ !empty($settings->social['share_buttons']['whatsapp']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="shareWhatsApp">WhatsApp</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="social[share_buttons][email]" 
                                   id="shareEmail" {{ !empty($settings->social['share_buttons']['email']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="shareEmail">Email</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Feed -->
        <div class="mb-4">
            <h6 class="mb-3">Social Feed Integration</h6>
            
            <!-- Instagram Feed -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Instagram Feed</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="social[instagram_feed][enabled]" 
                                   id="enableInstagramFeed" {{ !empty($settings->social['instagram_feed']['enabled']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="enableInstagramFeed">Enable Instagram Feed</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Access Token</label>
                        <input type="text" class="form-control" name="social[instagram_feed][access_token]" 
                               value="{{ $settings->social['instagram_feed']['access_token'] ?? '' }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Number of Posts</label>
                                <input type="number" class="form-control" name="social[instagram_feed][post_count]" 
                                       value="{{ $settings->social['instagram_feed']['post_count'] ?? '6' }}"
                                       min="1" max="12">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Layout</label>
                                <select class="form-select" name="social[instagram_feed][layout]">
                                    <option value="grid" {{ ($settings->social['instagram_feed']['layout'] ?? '') == 'grid' ? 'selected' : '' }}>
                                        Grid
                                    </option>
                                    <option value="carousel" {{ ($settings->social['instagram_feed']['layout'] ?? '') == 'carousel' ? 'selected' : '' }}>
                                        Carousel
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Twitter Feed -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Twitter Feed</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="social[twitter_feed][enabled]" 
                                   id="enableTwitterFeed" {{ !empty($settings->social['twitter_feed']['enabled']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="enableTwitterFeed">Enable Twitter Feed</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Widget ID</label>
                        <input type="text" class="form-control" name="social[twitter_feed][widget_id]" 
                               value="{{ $settings->social['twitter_feed']['widget_id'] ?? '' }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Number of Tweets</label>
                                <input type="number" class="form-control" name="social[twitter_feed][tweet_count]" 
                                       value="{{ $settings->social['twitter_feed']['tweet_count'] ?? '3' }}"
                                       min="1" max="10">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Theme</label>
                                <select class="form-select" name="social[twitter_feed][theme]">
                                    <option value="light" {{ ($settings->social['twitter_feed']['theme'] ?? '') == 'light' ? 'selected' : '' }}>
                                        Light
                                    </option>
                                    <option value="dark" {{ ($settings->social['twitter_feed']['theme'] ?? '') == 'dark' ? 'selected' : '' }}>
                                        Dark
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Social Profile Template -->
<template id="customSocialTemplate">
    <div class="mb-3 custom-social-profile">
        <div class="d-flex align-items-center mb-2">
            <label class="form-label mb-0 me-2">Custom Profile</label>
            <button type="button" class="btn btn-outline-danger btn-sm remove-social">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-2">
                    <span class="input-group-text">Name</span>
                    <input type="text" class="form-control" name="social[custom][][name]" placeholder="Platform Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-2">
                    <span class="input-group-text">Icon</span>
                    <input type="text" class="form-control" name="social[custom][][icon]" placeholder="fab fa-icon-name">
                </div>
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-text">URL</span>
            <input type="url" class="form-control" name="social[custom][][url]" placeholder="https://">
        </div>
    </div>
</template>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add Custom Social Profile
    document.getElementById('addCustomSocial').addEventListener('click', function() {
        const template = document.getElementById('customSocialTemplate');
        const clone = template.content.cloneNode(true);
        
        // Update indices in name attributes
        const customCount = document.querySelectorAll('.custom-social-profile').length;
        clone.querySelectorAll('[name*="social[custom][]"]').forEach(input => {
            input.name = input.name.replace('[]', `[${customCount}]`);
        });
        
        document.getElementById('socialProfiles').appendChild(clone);
    });

    // Remove Custom Social Profile
    document.getElementById('socialProfiles').addEventListener('click', function(e) {
        if (e.target.closest('.remove-social')) {
            e.target.closest('.custom-social-profile').remove();
            updateCustomSocialIndices();
        }
    });

    // Update indices when removing custom social profiles
    function updateCustomSocialIndices() {
        document.querySelectorAll('.custom-social-profile').forEach((profile, index) => {
            profile.querySelectorAll('[name*="social[custom]"]').forEach(input => {
                input.name = input.name.replace(/social\[custom\]\[\d+\]/, `social[custom][${index}]`);
            });
        });
    }
});
</script>
@endpush
