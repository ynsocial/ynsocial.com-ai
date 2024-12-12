@php
    $items_per_page = 10;
    $total_items = $module->module_total_items;
    $total_pages = ceil($total_items / $items_per_page);
    $module_current_page = $module->module_current_page;
@endphp

<ul class="pagination mb-0 overflow-auto">
    {{-- Previous Button --}}
    @if($module_current_page > 1)
        <li class="page-item">
            <a class="page-link" href="{{route('admin.'.$module->type.'.index')}}{{$module_current_page - 1 > 1 ? "?page".$module_current_page - 1 : ""}}"><i class="las la-arrow-left"></i></a>
        </li>
    @else
        <li class="page-item disabled">
            <a class="page-link" href="javascript:void(0);"><i class="las la-arrow-left"></i></a>
        </li>
    @endif

    {{-- Page Numbers --}}
    @for ($i = 1; $i <= $total_pages; $i++)
        <li class="page-item {{ $i == $module_current_page ? 'active' : '' }}">
            <a class="page-link" href="{{route('admin.'.$module->type.'.index')}}{{$i > 1 ? "?page=".$i : ""}}">{{ $i }}</a>
        </li>
    @endfor

    {{-- Next Button --}}
    @if($module_current_page < $total_pages)
        <li class="page-item">
            <a class="page-link" href="{{route('admin.'.$module->type.'.index')}}?page={{$module_current_page + 1}}"><i class="las la-arrow-right"></i></a>
        </li>
    @else
        <li class="page-item disabled">
            <a class="page-link" href="javascript:void(0);"><i class="las la-arrow-right"></i></a>
        </li>
    @endif
</ul>
