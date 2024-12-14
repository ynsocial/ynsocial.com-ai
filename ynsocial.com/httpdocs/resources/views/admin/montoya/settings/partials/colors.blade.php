<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Color Settings</h5>
    </div>
    <div class="card-body">
        <!-- Primary Colors -->
        <div class="mb-4">
            <h6 class="mb-3">Primary Colors</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Primary Color</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['primary'] ?? '#007bff' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[primary]" 
                           value="{{ $settings->colors['primary'] ?? '#007bff' }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Secondary Color</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['secondary'] ?? '#6c757d' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[secondary]" 
                           value="{{ $settings->colors['secondary'] ?? '#6c757d' }}">
                </div>
            </div>
        </div>

        <!-- Text Colors -->
        <div class="mb-4">
            <h6 class="mb-3">Text Colors</h6>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Body Text</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['text'] ?? '#212529' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[text]" 
                           value="{{ $settings->colors['text'] ?? '#212529' }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Heading Text</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['heading'] ?? '#000000' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[heading]" 
                           value="{{ $settings->colors['heading'] ?? '#000000' }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Link Text</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['link'] ?? '#007bff' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[link]" 
                           value="{{ $settings->colors['link'] ?? '#007bff' }}">
                </div>
            </div>
        </div>

        <!-- Background Colors -->
        <div class="mb-4">
            <h6 class="mb-3">Background Colors</h6>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Body Background</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['background'] ?? '#ffffff' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[background]" 
                           value="{{ $settings->colors['background'] ?? '#ffffff' }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Section Background</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['section_bg'] ?? '#f8f9fa' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[section_bg]" 
                           value="{{ $settings->colors['section_bg'] ?? '#f8f9fa' }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Card Background</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['card_bg'] ?? '#ffffff' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[card_bg]" 
                           value="{{ $settings->colors['card_bg'] ?? '#ffffff' }}">
                </div>
            </div>
        </div>

        <!-- Button Colors -->
        <div class="mb-4">
            <h6 class="mb-3">Button Colors</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Primary Button</label>
                    <div class="input-group">
                        <span class="input-group-text">Background</span>
                        <input type="color" 
                               class="form-control form-control-color" 
                               name="colors[btn_primary_bg]" 
                               value="{{ $settings->colors['btn_primary_bg'] ?? '#007bff' }}">
                        <span class="input-group-text">Text</span>
                        <input type="color" 
                               class="form-control form-control-color" 
                               name="colors[btn_primary_text]" 
                               value="{{ $settings->colors['btn_primary_text'] ?? '#ffffff' }}">
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Secondary Button</label>
                    <div class="input-group">
                        <span class="input-group-text">Background</span>
                        <input type="color" 
                               class="form-control form-control-color" 
                               name="colors[btn_secondary_bg]" 
                               value="{{ $settings->colors['btn_secondary_bg'] ?? '#6c757d' }}">
                        <span class="input-group-text">Text</span>
                        <input type="color" 
                               class="form-control form-control-color" 
                               name="colors[btn_secondary_text]" 
                               value="{{ $settings->colors['btn_secondary_text'] ?? '#ffffff' }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Colors -->
        <div class="mb-4">
            <h6 class="mb-3">Form Colors</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Input Background</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['input_bg'] ?? '#ffffff' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[input_bg]" 
                           value="{{ $settings->colors['input_bg'] ?? '#ffffff' }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Input Border</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['input_border'] ?? '#ced4da' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[input_border]" 
                           value="{{ $settings->colors['input_border'] ?? '#ced4da' }}">
                </div>
            </div>
        </div>

        <!-- Footer Colors -->
        <div class="mb-4">
            <h6 class="mb-3">Footer Colors</h6>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Footer Background</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['footer_bg'] ?? '#343a40' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[footer_bg]" 
                           value="{{ $settings->colors['footer_bg'] ?? '#343a40' }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Footer Text</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['footer_text'] ?? '#ffffff' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[footer_text]" 
                           value="{{ $settings->colors['footer_text'] ?? '#ffffff' }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Footer Link</label>
                    <div class="color-preview" style="background-color: {{ $settings->colors['footer_link'] ?? '#ffffff' }}"></div>
                    <input type="color" 
                           class="form-control form-control-color w-100" 
                           name="colors[footer_link]" 
                           value="{{ $settings->colors['footer_link'] ?? '#ffffff' }}">
                </div>
            </div>
        </div>
    </div>
</div>
