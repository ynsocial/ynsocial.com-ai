@php
    $content = $section->content ?? [];
    $style = $content['style'] ?? 'grid';
    $title = $content['title'] ?? '';
    $subtitle = $content['subtitle'] ?? '';
    $description = $content['description'] ?? '';
    $columns = $content['columns'] ?? 3;
    $showIcons = $content['show_icons'] ?? true;
    $showDescription = $content['show_description'] ?? true;
    $showLink = $content['show_link'] ?? true;
@endphp

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Services Grid Settings</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Section Title</label>
                    <input type="text" class="form-control" name="content[title]" value="{{ $title }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" class="form-control" name="content[subtitle]" value="{{ $subtitle }}">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="content[description]" rows="3">{{ $description }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Columns</label>
                    <select class="form-select" name="content[columns]">
                        <option value="2" {{ $columns == 2 ? 'selected' : '' }}>2 Columns</option>
                        <option value="3" {{ $columns == 3 ? 'selected' : '' }}>3 Columns</option>
                        <option value="4" {{ $columns == 4 ? 'selected' : '' }}>4 Columns</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="content[show_icons]" value="1" {{ $showIcons ? 'checked' : '' }}>
                        <label class="form-check-label">Show Icons</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="content[show_description]" value="1" {{ $showDescription ? 'checked' : '' }}>
                        <label class="form-check-label">Show Description</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="content[show_link]" value="1" {{ $showLink ? 'checked' : '' }}>
                        <label class="form-check-label">Show Link</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="services-list">
            @php
                $services = $content['services'] ?? [];
            @endphp
            
            <div class="mb-3">
                <label class="form-label">Services</label>
                <div class="services-items" data-items="{{ json_encode($services) }}">
                    @foreach($services as $index => $service)
                        <div class="service-item card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Service Title</label>
                                            <input type="text" class="form-control" name="content[services][{{ $index }}][title]" value="{{ $service['title'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Icon (FontAwesome Class)</label>
                                            <input type="text" class="form-control" name="content[services][{{ $index }}][icon]" value="{{ $service['icon'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="content[services][{{ $index }}][description]" rows="2">{{ $service['description'] ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Link URL</label>
                                    <input type="text" class="form-control" name="content[services][{{ $index }}][link]" value="{{ $service['link'] ?? '' }}">
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-service">Remove Service</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-primary add-service mt-2">Add New Service</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        let serviceIndex = $('.service-item').length;

        $('.add-service').click(function() {
            const template = `
                <div class="service-item card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Service Title</label>
                                    <input type="text" class="form-control" name="content[services][${serviceIndex}][title]">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Icon (FontAwesome Class)</label>
                                    <input type="text" class="form-control" name="content[services][${serviceIndex}][icon]">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="content[services][${serviceIndex}][description]" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link URL</label>
                            <input type="text" class="form-control" name="content[services][${serviceIndex}][link]">
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-service">Remove Service</button>
                    </div>
                </div>
            `;
            $('.services-items').append(template);
            serviceIndex++;
        });

        $(document).on('click', '.remove-service', function() {
            $(this).closest('.service-item').remove();
        });
    });
</script>
@endpush 