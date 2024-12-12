<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Typography Settings</h5>
    </div>
    <div class="card-body">
        <!-- Body Typography -->
        <div class="mb-4">
            <h6 class="mb-3">Body Typography</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Body Font Family</label>
                    <select class="form-select" name="typography[body_font]">
                        <option value="Inter" {{ ($settings->typography['body_font'] ?? '') == 'Inter' ? 'selected' : '' }}>
                            Inter
                        </option>
                        <option value="Roboto" {{ ($settings->typography['body_font'] ?? '') == 'Roboto' ? 'selected' : '' }}>
                            Roboto
                        </option>
                        <option value="Open Sans" {{ ($settings->typography['body_font'] ?? '') == 'Open Sans' ? 'selected' : '' }}>
                            Open Sans
                        </option>
                        <option value="Lato" {{ ($settings->typography['body_font'] ?? '') == 'Lato' ? 'selected' : '' }}>
                            Lato
                        </option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Font Size</label>
                    <div class="input-group">
                        <input type="number" 
                               class="form-control" 
                               name="typography[body_font_size]" 
                               value="{{ $settings->typography['body_font_size'] ?? '16' }}"
                               min="12"
                               max="24"
                               step="1">
                        <span class="input-group-text">px</span>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Line Height</label>
                    <div class="input-group">
                        <input type="number" 
                               class="form-control" 
                               name="typography[body_line_height]" 
                               value="{{ $settings->typography['body_line_height'] ?? '1.5' }}"
                               min="1"
                               max="2"
                               step="0.1">
                        <span class="input-group-text">em</span>
                    </div>
                </div>
            </div>

            <div class="font-preview" style="font-family: {{ $settings->typography['body_font'] ?? 'Inter' }}; font-size: {{ $settings->typography['body_font_size'] ?? '16' }}px; line-height: {{ $settings->typography['body_line_height'] ?? '1.5' }};">
                The quick brown fox jumps over the lazy dog.
            </div>
        </div>

        <!-- Heading Typography -->
        <div class="mb-4">
            <h6 class="mb-3">Heading Typography</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Heading Font Family</label>
                    <select class="form-select" name="typography[heading_font]">
                        <option value="Poppins" {{ ($settings->typography['heading_font'] ?? '') == 'Poppins' ? 'selected' : '' }}>
                            Poppins
                        </option>
                        <option value="Montserrat" {{ ($settings->typography['heading_font'] ?? '') == 'Montserrat' ? 'selected' : '' }}>
                            Montserrat
                        </option>
                        <option value="Playfair Display" {{ ($settings->typography['heading_font'] ?? '') == 'Playfair Display' ? 'selected' : '' }}>
                            Playfair Display
                        </option>
                        <option value="Merriweather" {{ ($settings->typography['heading_font'] ?? '') == 'Merriweather' ? 'selected' : '' }}>
                            Merriweather
                        </option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Font Weight</label>
                    <select class="form-select" name="typography[heading_weight]">
                        <option value="400" {{ ($settings->typography['heading_weight'] ?? '') == '400' ? 'selected' : '' }}>
                            Regular (400)
                        </option>
                        <option value="500" {{ ($settings->typography['heading_weight'] ?? '') == '500' ? 'selected' : '' }}>
                            Medium (500)
                        </option>
                        <option value="600" {{ ($settings->typography['heading_weight'] ?? '') == '600' ? 'selected' : '' }}>
                            Semi Bold (600)
                        </option>
                        <option value="700" {{ ($settings->typography['heading_weight'] ?? '') == '700' ? 'selected' : '' }}>
                            Bold (700)
                        </option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Line Height</label>
                    <div class="input-group">
                        <input type="number" 
                               class="form-control" 
                               name="typography[heading_line_height]" 
                               value="{{ $settings->typography['heading_line_height'] ?? '1.2' }}"
                               min="1"
                               max="2"
                               step="0.1">
                        <span class="input-group-text">em</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">H1 Size</label>
                    <div class="input-group">
                        <input type="number" 
                               class="form-control" 
                               name="typography[h1_size]" 
                               value="{{ $settings->typography['h1_size'] ?? '36' }}"
                               min="24"
                               max="72"
                               step="1">
                        <span class="input-group-text">px</span>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">H2 Size</label>
                    <div class="input-group">
                        <input type="number" 
                               class="form-control" 
                               name="typography[h2_size]" 
                               value="{{ $settings->typography['h2_size'] ?? '30' }}"
                               min="20"
                               max="60"
                               step="1">
                        <span class="input-group-text">px</span>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">H3 Size</label>
                    <div class="input-group">
                        <input type="number" 
                               class="form-control" 
                               name="typography[h3_size]" 
                               value="{{ $settings->typography['h3_size'] ?? '24' }}"
                               min="16"
                               max="48"
                               step="1">
                        <span class="input-group-text">px</span>
                    </div>
                </div>
            </div>

            <div class="font-preview" style="font-family: {{ $settings->typography['heading_font'] ?? 'Poppins' }}; font-weight: {{ $settings->typography['heading_weight'] ?? '600' }}; line-height: {{ $settings->typography['heading_line_height'] ?? '1.2' }};">
                <div style="font-size: {{ $settings->typography['h1_size'] ?? '36' }}px;">Heading 1</div>
                <div style="font-size: {{ $settings->typography['h2_size'] ?? '30' }}px;">Heading 2</div>
                <div style="font-size: {{ $settings->typography['h3_size'] ?? '24' }}px;">Heading 3</div>
            </div>
        </div>

        <!-- Font Weights -->
        <div class="mb-4">
            <h6 class="mb-3">Font Weights</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Body Font Weight</label>
                    <select class="form-select" name="typography[body_weight]">
                        <option value="300" {{ ($settings->typography['body_weight'] ?? '') == '300' ? 'selected' : '' }}>
                            Light (300)
                        </option>
                        <option value="400" {{ ($settings->typography['body_weight'] ?? '') == '400' ? 'selected' : '' }}>
                            Regular (400)
                        </option>
                        <option value="500" {{ ($settings->typography['body_weight'] ?? '') == '500' ? 'selected' : '' }}>
                            Medium (500)
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Link Font Weight</label>
                    <select class="form-select" name="typography[link_weight]">
                        <option value="400" {{ ($settings->typography['link_weight'] ?? '') == '400' ? 'selected' : '' }}>
                            Regular (400)
                        </option>
                        <option value="500" {{ ($settings->typography['link_weight'] ?? '') == '500' ? 'selected' : '' }}>
                            Medium (500)
                        </option>
                        <option value="600" {{ ($settings->typography['link_weight'] ?? '') == '600' ? 'selected' : '' }}>
                            Semi Bold (600)
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Text Transform -->
        <div class="mb-4">
            <h6 class="mb-3">Text Transform</h6>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Heading Transform</label>
                    <select class="form-select" name="typography[heading_transform]">
                        <option value="none" {{ ($settings->typography['heading_transform'] ?? '') == 'none' ? 'selected' : '' }}>
                            None
                        </option>
                        <option value="uppercase" {{ ($settings->typography['heading_transform'] ?? '') == 'uppercase' ? 'selected' : '' }}>
                            Uppercase
                        </option>
                        <option value="capitalize" {{ ($settings->typography['heading_transform'] ?? '') == 'capitalize' ? 'selected' : '' }}>
                            Capitalize
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Button Transform</label>
                    <select class="form-select" name="typography[button_transform]">
                        <option value="none" {{ ($settings->typography['button_transform'] ?? '') == 'none' ? 'selected' : '' }}>
                            None
                        </option>
                        <option value="uppercase" {{ ($settings->typography['button_transform'] ?? '') == 'uppercase' ? 'selected' : '' }}>
                            Uppercase
                        </option>
                        <option value="capitalize" {{ ($settings->typography['button_transform'] ?? '') == 'capitalize' ? 'selected' : '' }}>
                            Capitalize
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
