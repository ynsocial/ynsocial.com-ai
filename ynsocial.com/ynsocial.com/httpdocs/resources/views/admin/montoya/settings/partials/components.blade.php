<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Component Settings</h5>
    </div>
    <div class="card-body">
        <!-- Buttons -->
        <div class="mb-4">
            <h6 class="mb-3">Buttons</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Button Style</label>
                    <select class="form-select" name="components[button_style]">
                        <option value="default" {{ ($settings->components['button_style'] ?? '') == 'default' ? 'selected' : '' }}>
                            Default
                        </option>
                        <option value="rounded" {{ ($settings->components['button_style'] ?? '') == 'rounded' ? 'selected' : '' }}>
                            Rounded
                        </option>
                        <option value="pill" {{ ($settings->components['button_style'] ?? '') == 'pill' ? 'selected' : '' }}>
                            Pill
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Button Size</label>
                    <select class="form-select" name="components[button_size]">
                        <option value="sm" {{ ($settings->components['button_size'] ?? '') == 'sm' ? 'selected' : '' }}>
                            Small
                        </option>
                        <option value="md" {{ ($settings->components['button_size'] ?? '') == 'md' ? 'selected' : '' }}>
                            Medium
                        </option>
                        <option value="lg" {{ ($settings->components['button_size'] ?? '') == 'lg' ? 'selected' : '' }}>
                            Large
                        </option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="components[button_hover_effect]" 
                           id="buttonHoverEffect" {{ !empty($settings->components['button_hover_effect']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="buttonHoverEffect">Enable Hover Effect</label>
                </div>
            </div>
        </div>

        <!-- Cards -->
        <div class="mb-4">
            <h6 class="mb-3">Cards</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Card Style</label>
                    <select class="form-select" name="components[card_style]">
                        <option value="default" {{ ($settings->components['card_style'] ?? '') == 'default' ? 'selected' : '' }}>
                            Default
                        </option>
                        <option value="flat" {{ ($settings->components['card_style'] ?? '') == 'flat' ? 'selected' : '' }}>
                            Flat
                        </option>
                        <option value="raised" {{ ($settings->components['card_style'] ?? '') == 'raised' ? 'selected' : '' }}>
                            Raised
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Border Radius</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="components[card_radius]" 
                               value="{{ $settings->components['card_radius'] ?? '4' }}" min="0" max="20">
                        <span class="input-group-text">px</span>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="components[card_hover_effect]" 
                           id="cardHoverEffect" {{ !empty($settings->components['card_hover_effect']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="cardHoverEffect">Enable Hover Effect</label>
                </div>
            </div>
        </div>

        <!-- Forms -->
        <div class="mb-4">
            <h6 class="mb-3">Forms</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Input Style</label>
                    <select class="form-select" name="components[input_style]">
                        <option value="default" {{ ($settings->components['input_style'] ?? '') == 'default' ? 'selected' : '' }}>
                            Default
                        </option>
                        <option value="floating" {{ ($settings->components['input_style'] ?? '') == 'floating' ? 'selected' : '' }}>
                            Floating Label
                        </option>
                        <option value="minimal" {{ ($settings->components['input_style'] ?? '') == 'minimal' ? 'selected' : '' }}>
                            Minimal
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Input Size</label>
                    <select class="form-select" name="components[input_size]">
                        <option value="sm" {{ ($settings->components['input_size'] ?? '') == 'sm' ? 'selected' : '' }}>
                            Small
                        </option>
                        <option value="md" {{ ($settings->components['input_size'] ?? '') == 'md' ? 'selected' : '' }}>
                            Medium
                        </option>
                        <option value="lg" {{ ($settings->components['input_size'] ?? '') == 'lg' ? 'selected' : '' }}>
                            Large
                        </option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="components[input_focus_effect]" 
                           id="inputFocusEffect" {{ !empty($settings->components['input_focus_effect']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="inputFocusEffect">Enable Focus Effect</label>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="mb-4">
            <h6 class="mb-3">Navigation</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Menu Style</label>
                    <select class="form-select" name="components[menu_style]">
                        <option value="default" {{ ($settings->components['menu_style'] ?? '') == 'default' ? 'selected' : '' }}>
                            Default
                        </option>
                        <option value="underline" {{ ($settings->components['menu_style'] ?? '') == 'underline' ? 'selected' : '' }}>
                            Underline
                        </option>
                        <option value="highlight" {{ ($settings->components['menu_style'] ?? '') == 'highlight' ? 'selected' : '' }}>
                            Highlight
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Dropdown Style</label>
                    <select class="form-select" name="components[dropdown_style]">
                        <option value="default" {{ ($settings->components['dropdown_style'] ?? '') == 'default' ? 'selected' : '' }}>
                            Default
                        </option>
                        <option value="fade" {{ ($settings->components['dropdown_style'] ?? '') == 'fade' ? 'selected' : '' }}>
                            Fade
                        </option>
                        <option value="slide" {{ ($settings->components['dropdown_style'] ?? '') == 'slide' ? 'selected' : '' }}>
                            Slide
                        </option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="components[menu_hover_effect]" 
                           id="menuHoverEffect" {{ !empty($settings->components['menu_hover_effect']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="menuHoverEffect">Enable Hover Effect</label>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        <div class="mb-4">
            <h6 class="mb-3">Alerts</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Alert Style</label>
                    <select class="form-select" name="components[alert_style]">
                        <option value="default" {{ ($settings->components['alert_style'] ?? '') == 'default' ? 'selected' : '' }}>
                            Default
                        </option>
                        <option value="modern" {{ ($settings->components['alert_style'] ?? '') == 'modern' ? 'selected' : '' }}>
                            Modern
                        </option>
                        <option value="minimal" {{ ($settings->components['alert_style'] ?? '') == 'minimal' ? 'selected' : '' }}>
                            Minimal
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Animation</label>
                    <select class="form-select" name="components[alert_animation]">
                        <option value="none" {{ ($settings->components['alert_animation'] ?? '') == 'none' ? 'selected' : '' }}>
                            None
                        </option>
                        <option value="fade" {{ ($settings->components['alert_animation'] ?? '') == 'fade' ? 'selected' : '' }}>
                            Fade
                        </option>
                        <option value="slide" {{ ($settings->components['alert_animation'] ?? '') == 'slide' ? 'selected' : '' }}>
                            Slide
                        </option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="components[alert_dismissible]" 
                           id="alertDismissible" {{ !empty($settings->components['alert_dismissible']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="alertDismissible">Enable Dismiss Button</label>
                </div>
            </div>
        </div>

        <!-- Modals -->
        <div class="mb-4">
            <h6 class="mb-3">Modals</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Modal Style</label>
                    <select class="form-select" name="components[modal_style]">
                        <option value="default" {{ ($settings->components['modal_style'] ?? '') == 'default' ? 'selected' : '' }}>
                            Default
                        </option>
                        <option value="centered" {{ ($settings->components['modal_style'] ?? '') == 'centered' ? 'selected' : '' }}>
                            Centered
                        </option>
                        <option value="side" {{ ($settings->components['modal_style'] ?? '') == 'side' ? 'selected' : '' }}>
                            Side Panel
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Animation</label>
                    <select class="form-select" name="components[modal_animation]">
                        <option value="fade" {{ ($settings->components['modal_animation'] ?? '') == 'fade' ? 'selected' : '' }}>
                            Fade
                        </option>
                        <option value="slide" {{ ($settings->components['modal_animation'] ?? '') == 'slide' ? 'selected' : '' }}>
                            Slide
                        </option>
                        <option value="zoom" {{ ($settings->components['modal_animation'] ?? '') == 'zoom' ? 'selected' : '' }}>
                            Zoom
                        </option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="components[modal_backdrop_blur]" 
                           id="modalBackdropBlur" {{ !empty($settings->components['modal_backdrop_blur']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="modalBackdropBlur">Enable Backdrop Blur</label>
                </div>
            </div>
        </div>
    </div>
</div>
