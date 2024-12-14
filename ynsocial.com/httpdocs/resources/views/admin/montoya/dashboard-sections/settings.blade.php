<div class="card">
    <div class="card-header">
        <h6 class="card-title mb-0">Theme Settings</h6>
    </div>
    <div class="card-body">
        <form id="themeSettingsForm">
            @foreach($data['settingCategories'] as $category)
            <div class="settings-section mb-4">
                <h5 class="settings-category mb-3">{{ $category->name }}</h5>
                <div class="row g-3">
                    @foreach($category->settings as $setting)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label">{{ $setting->label }}</label>
                                @switch($setting->type)
                                    @case('text')
                                        <input type="text" 
                                            class="form-control" 
                                            name="settings[{{ $setting->key }}]" 
                                            value="{{ $setting->value }}"
                                            placeholder="{{ $setting->placeholder }}">
                                        @break

                                    @case('textarea')
                                        <textarea class="form-control" 
                                            name="settings[{{ $setting->key }}]" 
                                            rows="3"
                                            placeholder="{{ $setting->placeholder }}">{{ $setting->value }}</textarea>
                                        @break

                                    @case('select')
                                        <select class="form-select" name="settings[{{ $setting->key }}]">
                                            @foreach(json_decode($setting->options) as $option)
                                            <option value="{{ $option->value }}" 
                                                {{ $setting->value == $option->value ? 'selected' : '' }}>
                                                {{ $option->label }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @break

                                    @case('color')
                                        <input type="color" 
                                            class="form-control form-control-color" 
                                            name="settings[{{ $setting->key }}]" 
                                            value="{{ $setting->value }}"
                                            title="Choose color">
                                        @break

                                    @case('boolean')
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" 
                                                type="checkbox" 
                                                name="settings[{{ $setting->key }}]" 
                                                value="1"
                                                {{ $setting->value ? 'checked' : '' }}>
                                        </div>
                                        @break

                                    @case('number')
                                        <input type="number" 
                                            class="form-control" 
                                            name="settings[{{ $setting->key }}]" 
                                            value="{{ $setting->value }}"
                                            min="{{ $setting->min }}"
                                            max="{{ $setting->max }}"
                                            step="{{ $setting->step }}">
                                        @break

                                    @case('file')
                                        <div class="input-group">
                                            <input type="file" 
                                                class="form-control" 
                                                name="settings[{{ $setting->key }}]"
                                                accept="{{ $setting->accept }}">
                                            @if($setting->value)
                                            <button class="btn btn-outline-secondary preview-file" 
                                                type="button"
                                                data-url="{{ asset($setting->value) }}">
                                                Preview
                                            </button>
                                            @endif
                                        </div>
                                        @break

                                    @default
                                        <input type="text" 
                                            class="form-control" 
                                            name="settings[{{ $setting->key }}]" 
                                            value="{{ $setting->value }}">
                                @endswitch

                                @if($setting->description)
                                <div class="form-text">{{ $setting->description }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Settings
                </button>
            </div>
        </form>
    </div>
</div>

<!-- File Preview Modal -->
<div class="modal fade" id="filePreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">File Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" alt="Preview" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Handle settings form submission
    $('#themeSettingsForm').submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: '{{ route("admin.dashboard.settings.update") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success('Settings updated successfully');
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON.message || 'Error updating settings');
            }
        });
    });

    // Handle file preview
    $('.preview-file').click(function() {
        const url = $(this).data('url');
        $('#filePreviewModal img').attr('src', url);
        $('#filePreviewModal').modal('show');
    });
});
</script>
@endpush
