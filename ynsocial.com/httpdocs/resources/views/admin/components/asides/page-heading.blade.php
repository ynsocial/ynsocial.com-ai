<div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
    <div>
        <nav>
            <ol class="breadcrumb mb-1">
                @foreach($breadcrumb as $item)

                    @if(isset($item->link))
                        <li class="breadcrumb-item">
                            <a href="{{$item->link}}" title="{{$item->title}}">
                                {{$item->title}}
                            </a>
                        </li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{$item->title}}</li>
                    @endif

                @endforeach

            </ol>
        </nav>
        <h1 class="page-title fw-medium fs-18 mb-0">{{$title}}</h1>
    </div>
</div>

