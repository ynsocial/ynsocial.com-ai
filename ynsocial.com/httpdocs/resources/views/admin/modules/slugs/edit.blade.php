@extends('admin.layout.master')

@push('meta_title')
    {{$module->module_title}}
@endpush

@section('content')
    <!-- start:PageHeader -->
    @include('admin.components.asides.page-heading', ["title" => $module->module_title, "breadcrumb" => $module->breadcrumb])
    <!-- end:PageHeader -->

    <!-- Start::row-1 -->
    <form action="{{route("admin.".$module->type.".update", $slug->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-xl-6">
                                <label id="input-alias" class="form-label">@lang('admin/inputs.alias')</label>
                                <select class="form-select" name="alias" id="input-alias">
                                    <option value="" class="d-none" @if(!(old("alias") ?? $slug->alias)) selected @endif >@lang('admin/inputs.select')</option>
                                    @foreach(config("modules") as $item)
                                        @foreach($item["subs"] ?? [] as $child)
                                            @if($child["alias"] ?? "")
                                                <option value="{{$child["name"]}}" @if((old("alias") ?? $slug->alias) and (old("alias") ?? $slug->alias) == $child["name"]) selected @endif >@lang($child["title"])</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('alias')
                                <small class="d-block text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label id="input-method" class="form-label">@lang('admin/inputs.method')</label>
                                <input type="text" name="method" class="form-control" id="input-method" placeholder="@lang('admin/inputs.method')" value="{{old("method") ?? $slug->method}}">
                                @error('method')
                                <small class="d-block text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>
                            @foreach(config("languages") as $item)
                                @php($group_item = $slug->group->where('language', $item['code'])->first())
                                <div class="col-xl-12">
                                    <label for="input-url-{{$item["code"]}}" class="form-label">({{$item["native"]}}) - @lang('admin/inputs.slug')</label>
                                    <input type="text" name="slugs[{{$item["code"]}}]" class="form-control slug-type" id="input-url-{{$item["code"]}}" placeholder="@lang('admin/inputs.enter_slug')" value="{{old('slugs.'.$item["code"]) ?? ($group_item->slug ?? "")}}">
                                    @error('slugs.'.$item["code"])
                                    <small class="d-block text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach
                            <div class="row mt-4 justify-content-center">
                                <div class="col-md-4 col-lg-3">
                                    <button type="submit" class="btn btn-success-light btn-wave mb-4 w-100">@lang('admin/inputs.update_button')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--End::row-1 -->

@endsection
