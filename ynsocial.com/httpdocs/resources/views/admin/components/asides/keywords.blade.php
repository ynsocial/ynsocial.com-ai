@foreach($translations as $key => $value)

    @if(is_array($value))

        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body">
                    <span class="badge bg-success">{{ $key }}</span>
                    <div class="row">
                        @include('admin.components.asides.keywords', ['translations' => $value, 'parent' => $parent . "[$key]"])
                    </div>
                </div>
            </div>
        </div>


    @else
        <div class="col-xl-12 mt-0 mb-2">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <label id="input-{{ $parent }}_{{ $key }}" class="form-label">{{ $key }}</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="{{ $parent }}[{{ $key }}]" class="form-control" id="input-{{ $parent }}_{{ $key }}" value="{{ $value }}">
                </div>
            </div>
        </div>
    @endif
@endforeach
