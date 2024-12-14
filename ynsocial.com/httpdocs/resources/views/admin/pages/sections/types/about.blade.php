@php
    $content = $section->content ?? [];
    $style = $content['style'] ?? 'with_stats';
    $title = $content['title'] ?? '';
    $subtitle = $content['subtitle'] ?? '';
    $description = $content['description'] ?? '';
    $image = $content['image'] ?? '';
    $stats = $content['stats'] ?? [];
@endphp

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">About Section Settings</h5>
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
            <textarea class="form-control" name="content[description]" rows="4">{{ $description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="text" class="form-control" name="content[image]" value="{{ $image }}">
            <small class="text-muted">Enter the URL of the about section image</small>
        </div>

        <div class="stats-section mb-3">
            <label class="form-label">Statistics</label>
            <div class="stats-items" data-items="{{ json_encode($stats) }}">
                @foreach($stats as $index => $stat)
                    <div class="stat-item card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Label</label>
                                        <input type="text" class="form-control" name="content[stats][{{ $index }}][label]" value="{{ $stat['label'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Value</label>
                                        <input type="text" class="form-control" name="content[stats][{{ $index }}][value]" value="{{ $stat['value'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-stat">Remove Stat</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-primary add-stat">Add New Statistic</button>
        </div>

        <div class="mb-3">
            <label class="form-label">Additional Content</label>
            <div class="additional-content">
                <div class="mb-3">
                    <label class="form-label">Mission Statement</label>
                    <textarea class="form-control" name="content[mission]" rows="3">{{ $content['mission'] ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Vision Statement</label>
                    <textarea class="form-control" name="content[vision]" rows="3">{{ $content['vision'] ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Core Values</label>
                    <textarea class="form-control" name="content[values]" rows="3" placeholder="Enter values separated by commas">{{ $content['values'] ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        let statIndex = $('.stat-item').length;

        $('.add-stat').click(function() {
            const template = `
                <div class="stat-item card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Label</label>
                                    <input type="text" class="form-control" name="content[stats][${statIndex}][label]">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Value</label>
                                    <input type="text" class="form-control" name="content[stats][${statIndex}][value]">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-stat">Remove Stat</button>
                    </div>
                </div>
            `;
            $('.stats-items').append(template);
            statIndex++;
        });

        $(document).on('click', '.remove-stat', function() {
            $(this).closest('.stat-item').remove();
        });
    });
</script>
@endpush 