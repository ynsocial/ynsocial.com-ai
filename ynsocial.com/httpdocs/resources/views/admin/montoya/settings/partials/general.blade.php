<div class="card">
    <div class="card-header">
        <h5 class="mb-0">General Settings</h5>
    </div>
    <div class="card-body">
        <!-- Site Identity -->
        <div class="mb-4">
            <h6 class="mb-3">Site Identity</h6>
            
            <div class="mb-3">
                <label class="form-label">Site Title</label>
                <input type="text" 
                       class="form-control" 
                       name="general[site_title]" 
                       value="{{ $settings->general['site_title'] ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tagline</label>
                <input type="text" 
                       class="form-control" 
                       name="general[tagline]" 
                       value="{{ $settings->general['tagline'] ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Site Icon</label>
                <div class="d-flex align-items-center">
                    @if(!empty($settings->general['site_icon']))
                        <img src="{{ $settings->general['site_icon'] }}" 
                             alt="Site Icon" 
                             class="me-3" 
                             style="width: 32px; height: 32px;">
                    @endif
                    <input type="file" 
                           class="form-control" 
                           name="general[site_icon]" 
                           accept="image/*">
                </div>
            </div>
        </div>

        <!-- Maintenance Mode -->
        <div class="mb-4">
            <h6 class="mb-3">Maintenance Mode</h6>
            
            <div class="form-check form-switch mb-3">
                <input type="checkbox" 
                       class="form-check-input" 
                       name="general[maintenance_mode]" 
                       id="maintenanceMode"
                       {{ !empty($settings->general['maintenance_mode']) ? 'checked' : '' }}>
                <label class="form-check-label" for="maintenanceMode">
                    Enable Maintenance Mode
                </label>
            </div>

            <div class="mb-3">
                <label class="form-label">Maintenance Message</label>
                <textarea class="form-control" 
                          name="general[maintenance_message]" 
                          rows="3">{{ $settings->general['maintenance_message'] ?? '' }}</textarea>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="mb-4">
            <h6 class="mb-3">Contact Information</h6>
            
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" 
                       class="form-control" 
                       name="general[contact_email]" 
                       value="{{ $settings->general['contact_email'] ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="tel" 
                       class="form-control" 
                       name="general[contact_phone]" 
                       value="{{ $settings->general['contact_phone'] ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control" 
                          name="general[contact_address]" 
                          rows="3">{{ $settings->general['contact_address'] ?? '' }}</textarea>
            </div>
        </div>

        <!-- Date and Time -->
        <div class="mb-4">
            <h6 class="mb-3">Date and Time</h6>
            
            <div class="mb-3">
                <label class="form-label">Timezone</label>
                <select class="form-select" name="general[timezone]">
                    @foreach(timezone_identifiers_list() as $timezone)
                        <option value="{{ $timezone }}" 
                                {{ ($settings->general['timezone'] ?? '') == $timezone ? 'selected' : '' }}>
                            {{ $timezone }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Date Format</label>
                <select class="form-select" name="general[date_format]">
                    <option value="F j, Y" {{ ($settings->general['date_format'] ?? '') == 'F j, Y' ? 'selected' : '' }}>
                        {{ date('F j, Y') }} (F j, Y)
                    </option>
                    <option value="Y-m-d" {{ ($settings->general['date_format'] ?? '') == 'Y-m-d' ? 'selected' : '' }}>
                        {{ date('Y-m-d') }} (Y-m-d)
                    </option>
                    <option value="m/d/Y" {{ ($settings->general['date_format'] ?? '') == 'm/d/Y' ? 'selected' : '' }}>
                        {{ date('m/d/Y') }} (m/d/Y)
                    </option>
                    <option value="d/m/Y" {{ ($settings->general['date_format'] ?? '') == 'd/m/Y' ? 'selected' : '' }}>
                        {{ date('d/m/Y') }} (d/m/Y)
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Time Format</label>
                <select class="form-select" name="general[time_format]">
                    <option value="g:i a" {{ ($settings->general['time_format'] ?? '') == 'g:i a' ? 'selected' : '' }}>
                        {{ date('g:i a') }} (g:i a)
                    </option>
                    <option value="g:i A" {{ ($settings->general['time_format'] ?? '') == 'g:i A' ? 'selected' : '' }}>
                        {{ date('g:i A') }} (g:i A)
                    </option>
                    <option value="H:i" {{ ($settings->general['time_format'] ?? '') == 'H:i' ? 'selected' : '' }}>
                        {{ date('H:i') }} (H:i)
                    </option>
                </select>
            </div>
        </div>

        <!-- Comments -->
        <div class="mb-4">
            <h6 class="mb-3">Comments</h6>
            
            <div class="form-check form-switch mb-3">
                <input type="checkbox" 
                       class="form-check-input" 
                       name="general[enable_comments]" 
                       id="enableComments"
                       {{ !empty($settings->general['enable_comments']) ? 'checked' : '' }}>
                <label class="form-check-label" for="enableComments">
                    Enable Comments
                </label>
            </div>

            <div class="mb-3">
                <label class="form-label">Comments Moderation</label>
                <select class="form-select" name="general[comments_moderation]">
                    <option value="none" 
                            {{ ($settings->general['comments_moderation'] ?? '') == 'none' ? 'selected' : '' }}>
                        No moderation
                    </option>
                    <option value="first" 
                            {{ ($settings->general['comments_moderation'] ?? '') == 'first' ? 'selected' : '' }}>
                        Moderate first comment
                    </option>
                    <option value="all" 
                            {{ ($settings->general['comments_moderation'] ?? '') == 'all' ? 'selected' : '' }}>
                        Moderate all comments
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>
