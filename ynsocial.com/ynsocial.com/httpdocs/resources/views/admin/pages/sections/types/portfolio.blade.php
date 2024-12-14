@php
    $content = $section->content ?? [];
    $style = $content['style'] ?? 'grid';
    $title = $content['title'] ?? '';
    $subtitle = $content['subtitle'] ?? '';
    $description = $content['description'] ?? '';
    $itemsPerRow = $content['items_per_row'] ?? 3;
    $maxItems = $content['max_items'] ?? 6;
    $showFilters = $content['show_filters'] ?? true;
    $showCategories = $content['show_categories'] ?? true;
    $selectedCategories = $content['categories'] ?? [];
    $layout = $content['layout'] ?? 'masonry';
    $showPagination = $content['show_pagination'] ?? true;
@endphp

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Portfolio Showcase Settings</h5>
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

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Layout Style</label>
                    <select class="form-select" name="content[layout]">
                        <option value="masonry" {{ $layout == 'masonry' ? 'selected' : '' }}>Masonry Grid</option>
                        <option value="grid" {{ $layout == 'grid' ? 'selected' : '' }}>Regular Grid</option>
                        <option value="carousel" {{ $layout == 'carousel' ? 'selected' : '' }}>Carousel</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Items per Row</label>
                    <select class="form-select" name="content[items_per_row]">
                        <option value="2" {{ $itemsPerRow == 2 ? 'selected' : '' }}>2 Items</option>
                        <option value="3" {{ $itemsPerRow == 3 ? 'selected' : '' }}>3 Items</option>
                        <option value="4" {{ $itemsPerRow == 4 ? 'selected' : '' }}>4 Items</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Maximum Items to Show</label>
                    <input type="number" class="form-control" name="content[max_items]" value="{{ $maxItems }}" min="1" max="24">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Display Options</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="content[show_filters]" value="1" {{ $showFilters ? 'checked' : '' }}>
                        <label class="form-check-label">Show Category Filters</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="content[show_categories]" value="1" {{ $showCategories ? 'checked' : '' }}>
                        <label class="form-check-label">Show Category Labels</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="content[show_pagination]" value="1" {{ $showPagination ? 'checked' : '' }}>
                        <label class="form-check-label">Show Pagination</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Filter Categories</label>
            <div class="categories-selection">
                @php
                    $allCategories = \App\Models\Category::where('type', 'portfolio')->get();
                @endphp
                @foreach($allCategories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                               name="content[categories][]" 
                               value="{{ $category->id }}"
                               {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
            <small class="text-muted">Select categories to include in this portfolio section</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Animation Settings</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Animation Effect</label>
                        <select class="form-select" name="content[animation][effect]">
                            <option value="fade" {{ ($content['animation']['effect'] ?? '') == 'fade' ? 'selected' : '' }}>Fade</option>
                            <option value="slide" {{ ($content['animation']['effect'] ?? '') == 'slide' ? 'selected' : '' }}>Slide</option>
                            <option value="zoom" {{ ($content['animation']['effect'] ?? '') == 'zoom' ? 'selected' : '' }}>Zoom</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Animation Duration (ms)</label>
                        <input type="number" class="form-control" name="content[animation][duration]" 
                               value="{{ $content['animation']['duration'] ?? 300 }}" min="100" max="1000" step="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle layout change
        $('select[name="content[layout]"]').change(function() {
            const layout = $(this).val();
            if (layout === 'carousel') {
                $('.carousel-settings').removeClass('d-none');
            } else {
                $('.carousel-settings').addClass('d-none');
            }
        });

        // Initialize layout state
        $('select[name="content[layout]"]').trigger('change');
    });
</script>
@endpush 