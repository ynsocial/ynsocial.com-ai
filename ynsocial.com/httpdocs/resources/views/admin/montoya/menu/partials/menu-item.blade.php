<div class="menu-item" data-id="{{ $menu->id }}">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-grip-vertical handle me-2"></i>
            <span class="menu-name">{{ $menu->name }}</span>
            @if($menu->type === 'dropdown')
                <span class="badge bg-info ms-2">Dropdown</span>
            @endif
            @if(!$menu->active)
                <span class="badge bg-warning ms-2">Inactive</span>
            @endif
        </div>
        <div class="actions">
            <button type="button" 
                    class="btn btn-sm btn-primary edit-menu" 
                    data-id="{{ $menu->id }}">
                <i class="fas fa-edit"></i>
            </button>
            <button type="button" 
                    class="btn btn-sm btn-{{ $menu->active ? 'warning' : 'success' }} toggle-active"
                    data-id="{{ $menu->id }}">
                <i class="fas fa-{{ $menu->active ? 'eye-slash' : 'eye' }}"></i>
            </button>
        </div>
    </div>
    @if($menu->children->count() > 0)
        <div class="menu-children mt-2">
            @foreach($menu->children as $child)
                @include('admin.montoya.menu.partials.menu-item', ['menu' => $child])
            @endforeach
        </div>
    @endif
</div>
