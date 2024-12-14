@extends('admin.layout.master')

@push('meta_title')
    {{$module->module_title}}
@endpush

@section('content')
    <!-- start:PageHeader -->
    @include('admin.components.asides.page-heading', ["title" => $module->module_title, "breadcrumb" => $module->breadcrumb])
    <!-- end:PageHeader -->

    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="col-xl-12">
                        <label id="input-language" class="form-label">@lang('admin/inputs.language')</label>
                        <select class="form-select language-selector" name="language">
                            <option class="d-none" value="">@lang('admin/inputs.select')</option>
                            @foreach(config('languages') as $item)
                                <option value="{{route("admin.".$module->type.".index")}}?language={{$item["code"]}}" @if(request()->get("language") == $item["code"]) selected @endif >{{$item["native"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.components.alert-session', ['message' => session()->has('message'), 'type' => session()->get('message.type'), 'text' => session()->get('message.text')])


    @if(request()->get("language"))
        <!-- Start::row-1 -->
        <form action="{{route("admin.".$module->type.".update", request()->get("language"))}}" method="post" enctype="multipart/form-data">
            @csrf

            @foreach($module->translations as $file_name => $item)
                <div class="row">
                    <div class="col-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <div class="alert alert-info mb-4" role="alert">
                                            (<strong>{{ $file_name }}.php</strong>) - @lang('admin/components.keywords_list')
                                        </div>
                                    </div>
                                    @include('admin.components.asides.keywords', ['translations' => $item, 'parent' => $file_name])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-3">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success-light btn-wave mb-4 w-100">@lang('admin/inputs.update_button')</button>
                    </div>
                </div>
            </div>
        </form>
        <!--End::row-1 -->
    @endif
@endsection
