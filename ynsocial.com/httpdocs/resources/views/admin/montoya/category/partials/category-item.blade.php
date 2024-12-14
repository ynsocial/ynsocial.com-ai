<div class="category-item" data-id="{{ $category->id }}">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-grip-vertical handle me-2"></i>
            <span class="category-name">{{ $category->name }}</span>
            <small class="text-muted ms-2">/{{ $category->slug }}</small>
            @if(!$category->active)
                <span class="badge bg-warning ms-2">Inactive</span>
            @endif
            @if($category->items_count)
                <span class="badge bg-info ms-2">{{ $category->items_count }} items</span>
            @endif
        </div>
        <div class="actions">
            <button type="button" 
                    class="btn btn-sm btn-primary edit-category" 
                    data-id="{{ $category->id }}">
                <i class="fas fa-edit"></i>
            </button>
            <button type="button" 
                    class="btn btn-sm btn-{{ $category->active ? 'warning' : 'success' }} toggle-active"
                    data-id="{{ $category->id }}">
                <i class="fas fa-{{ $category->active ? 'eye-slash' : 'eye' }}"></i>
            </button>
        </div>
    </div>
    @if($category->children->count() > 0)
        <div class="category-children mt-2">
            @foreach($category->children as $child)
                @include('admin.montoya.category.partials.category-item', ['category' => $child])
            @endforeach
        </div>
    @endif
</div>
