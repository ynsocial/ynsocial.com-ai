<li>
    @if($menu->type === 'dropdown')
        <span class="dropdown-toggle">{{ $menu->name }}</span>
        @if($menu->children->count() > 0)
            <ul class="preview-submenu">
                @foreach($menu->children as $child)
                    @include('admin.montoya.menu.partials.preview-item', ['menu' => $child])
                @endforeach
            </ul>
        @endif
    @else
        <a href="{{ $menu->url }}" 
           {{ $menu->new_tab ? 'target="_blank"' : '' }}
           class="{{ !$menu->active ? 'text-muted' : '' }}">
            {{ $menu->name }}
        </a>
    @endif
</li>
