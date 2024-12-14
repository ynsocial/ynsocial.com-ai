@extends('admin.layouts.app')

@section('title', 'Theme Settings')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/codemirror@5.65.2/lib/codemirror.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/codemirror@5.65.2/theme/monokai.css" rel="stylesheet">
<style>
    .theme-preview {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 1rem;
        margin-bottom: 1rem;
        height: calc(100vh - 300px);
        overflow: hidden;
    }
    .preview-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0.5rem;
        background: #f8f9fa;
        border-radius: 4px;
    }
    .device-selector button {
        padding: 0.5rem 1rem;
        margin-right: 0.5rem;
    }
    .page-selector select {
        min-width: 200px;
    }
    .preview-frame-container {
        display: flex;
        justify-content: center;
        height: calc(100% - 50px);
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    .color-picker {
        width: 100%;
        height: 40px;
        padding: 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
    }
    .layout-option {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 1rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .layout-option:hover {
        border-color: #4a5568;
        transform: translateY(-2px);
    }
    .layout-option.active {
        border-color: #4299e1;
        background-color: #ebf8ff;
    }
    .CodeMirror {
        height: 300px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .animation-settings {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1rem;
    }
    .section-settings {
        background: #fff;
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Theme Settings</h1>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right">
                    <button type="button" class="btn btn-info" id="previewTheme">
                        <i class="fas fa-eye mr-1"></i> Preview
                    </button>
                    <button type="button" class="btn btn-secondary" id="exportSettings">
                        <i class="fas fa-download mr-1"></i> Export
                    </button>
                    <button type="button" class="btn btn-warning" id="resetDefault">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <form action="{{ route('admin.theme.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <!-- Global Settings -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Global Settings</h3>
                        </div>
                        <div class="card-body">
                            <!-- Logo -->
                            <div class="form-group">
                                <label>Site Logo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="logo" accept="image/*">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                @if($settings->logo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="Site Logo" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>

                            <!-- Colors -->
                            <div class="form-group">
                                <label>Color Scheme</label>
                                <div class="row">
                                    @foreach($config['settings']['colors'] as $key => $default)
                                        <div class="col-md-3">
                                            <label>{{ ucfirst($key) }}</label>
                                            <input type="color" class="color-picker" name="colors[{{ $key }}]" 
                                                value="{{ $settings->colors[$key] ?? $default }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Typography -->
                            <div class="form-group">
                                <label>Typography</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Heading Font</label>
                                        <select class="form-control" name="typography[heading_font]">
                                            @foreach($config['settings']['typography']['heading_fonts'] as $value => $label)
                                                <option value="{{ $value }}" {{ ($settings->typography['heading_font'] ?? '') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Body Font</label>
                                        <select class="form-control" name="typography[body_font]">
                                            @foreach($config['settings']['typography']['body_fonts'] as $value => $label)
                                                <option value="{{ $value }}" {{ ($settings->typography['body_font'] ?? '') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Animations -->
                            <div class="animation-settings">
                                <label>Animation Settings</label>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="animations_enabled" 
                                            name="animations[enabled]" {{ ($settings->animations['enabled'] ?? false) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="animations_enabled">Enable Animations</label>
                                    </div>
                                </div>

                                <div class="animation-options" id="animationOptions">
                                    <!-- Scroll Reveal -->
                                    <div class="section-settings">
                                        <h5>Scroll Reveal</h5>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="scroll_reveal_enabled" 
                                                    name="animations[scroll_reveal][enabled]" 
                                                    {{ ($settings->animations['scroll_reveal']['enabled'] ?? false) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="scroll_reveal_enabled">Enable Scroll Reveal</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Duration (ms)</label>
                                                <input type="number" class="form-control" name="animations[scroll_reveal][duration]" 
                                                    value="{{ $settings->animations['scroll_reveal']['duration'] ?? 800 }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Distance</label>
                                                <input type="text" class="form-control" name="animations[scroll_reveal][distance]" 
                                                    value="{{ $settings->animations['scroll_reveal']['distance'] ?? '50px' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hover Effects -->
                                    <div class="section-settings">
                                        <h5>Hover Effects</h5>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="hover_effects_enabled" 
                                                    name="animations[hover_effects][enabled]" 
                                                    {{ ($settings->animations['hover_effects']['enabled'] ?? false) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="hover_effects_enabled">Enable Hover Effects</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Duration (ms)</label>
                                            <input type="number" class="form-control" name="animations[hover_effects][duration]" 
                                                value="{{ $settings->animations['hover_effects']['duration'] ?? 300 }}">
                                        </div>
                                    </div>

                                    <!-- Page Transitions -->
                                    <div class="section-settings">
                                        <h5>Page Transitions</h5>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="page_transitions_enabled" 
                                                    name="animations[page_transitions][enabled]" 
                                                    {{ ($settings->animations['page_transitions']['enabled'] ?? false) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="page_transitions_enabled">Enable Page Transitions</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Transition Type</label>
                                            <select class="form-control" name="animations[page_transitions][type]">
                                                @foreach(['fade', 'slide', 'zoom'] as $type)
                                                    <option value="{{ $type }}" 
                                                        {{ ($settings->animations['page_transitions']['type'] ?? '') == $type ? 'selected' : '' }}>
                                                        {{ ucfirst($type) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Layout Settings -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Layout Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($config['layouts'] as $key => $layout)
                                    <div class="col-md-4">
                                        <div class="layout-option {{ ($settings->layout ?? 'default') == $key ? 'active' : '' }}"
                                             data-layout="{{ $key }}">
                                            <h5>{{ $layout['name'] }}</h5>
                                            <div class="mt-2">
                                                <small class="text-muted">
                                                    @if(isset($layout['sections']))
                                                        Sections: {{ count($layout['sections']) }}<br>
                                                    @endif
                                                    @if(isset($layout['styles']))
                                                        Styles: {{ count($layout['styles']) }}
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="layout" id="selectedLayout" value="{{ $settings->layout ?? 'default' }}">
                        </div>
                    </div>

                    <!-- Custom Code -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Custom Code</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Custom CSS</label>
                                <textarea id="customCSS" name="custom_css" class="form-control">{{ $settings->custom_css }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Custom JavaScript</label>
                                <textarea id="customJS" name="custom_js" class="form-control">{{ $settings->custom_js }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Preview -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Live Preview</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="preview-toolbar">
                                <div class="device-selector">
                                    <button type="button" class="btn btn-sm btn-outline-secondary active" data-device="desktop">
                                        <i class="fas fa-desktop"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-device="tablet">
                                        <i class="fas fa-tablet-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-device="mobile">
                                        <i class="fas fa-mobile-alt"></i>
                                    </button>
                                </div>
                                <div class="page-selector">
                                    <select class="form-control form-control-sm" id="previewPage">
                                        <option value="{{ route('home') }}">Home</option>
                                        <option value="{{ route('about') }}">About</option>
                                        <option value="{{ route('portfolio.index') }}">Portfolio</option>
                                        <option value="{{ route('blog.index') }}">Blog</option>
                                        <option value="{{ route('contact') }}">Contact</option>
                                    </select>
                                </div>
                            </div>
                            <div class="preview-frame-container">
                                <iframe src="{{ route('home') }}" class="preview-frame desktop" id="previewFrame"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Actions</h3>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save mr-1"></i> Save Changes
                            </button>
                            <div class="mt-3">
                                <label>Import Settings</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="importSettings" accept=".json">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.2/lib/codemirror.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.2/mode/css/css.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.2/mode/javascript/javascript.js"></script>
<script>
$(document).ready(function() {
    // Initialize CodeMirror for CSS
    var cssEditor = CodeMirror.fromTextArea(document.getElementById('customCSS'), {
        mode: 'css',
        theme: 'monokai',
        lineNumbers: true,
        autoCloseBrackets: true
    });

    // Initialize CodeMirror for JavaScript
    var jsEditor = CodeMirror.fromTextArea(document.getElementById('customJS'), {
        mode: 'javascript',
        theme: 'monokai',
        lineNumbers: true,
        autoCloseBrackets: true
    });

    // Layout Selection
    $('.layout-option').click(function() {
        $('.layout-option').removeClass('active');
        $(this).addClass('active');
        $('#selectedLayout').val($(this).data('layout'));
        updatePreview();
    });

    // Device Preview
    $('.device-selector button').click(function() {
        $('.device-selector button').removeClass('active');
        $(this).addClass('active');
        $('#previewFrame').attr('class', 'preview-frame ' + $(this).data('device'));
    });

    // Page Preview
    $('#previewPage').change(function() {
        $('#previewFrame').attr('src', $(this).val());
    });

    // Animation Settings Toggle
    $('#animations_enabled').change(function() {
        $('#animationOptions').toggle(this.checked);
    });

    // Preview Theme
    $('#previewTheme').click(function() {
        window.open($('#previewPage').val(), '_blank');
    });

    // Export Settings
    $('#exportSettings').click(function() {
        window.location.href = '{{ route('admin.theme.export') }}';
    });

    // Import Settings
    $('#importSettings').change(function() {
        var file = this.files[0];
        var formData = new FormData();
        formData.append('settings_file', file);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: '{{ route('admin.theme.import') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function() {
                window.location.reload();
            }
        });
    });

    // Reset to Default
    $('#resetDefault').click(function() {
        if (confirm('Are you sure you want to reset all theme settings to default?')) {
            $.post('{{ route('admin.theme.reset') }}', {
                _token: '{{ csrf_token() }}'
            }).done(function() {
                window.location.reload();
            });
        }
    });

    // Live Preview Updates
    function updatePreview() {
        var previewFrame = document.getElementById('previewFrame');
        if (previewFrame.contentWindow.location.href === 'about:blank') {
            previewFrame.src = $('#previewPage').val();
        } else {
            previewFrame.contentWindow.location.reload();
        }
    }

    // Update preview on any change
    $('input, select').on('change', _.debounce(updatePreview, 500));
    cssEditor.on('change', _.debounce(updatePreview, 500));
    jsEditor.on('change', _.debounce(updatePreview, 500));

    // Initial setup
    $('#animationOptions').toggle($('#animations_enabled').is(':checked'));
    updatePreview();
});
</script>
@endpush 