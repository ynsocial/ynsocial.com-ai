@extends('admin.layout.master')

@push('meta_title')
    {{$module->module_title}}
@endpush

@section('content')
    <!-- start:PageHeader -->
    @include('admin.components.asides.page-heading', ["title" => $module->module_title, "breadcrumb" => $module->breadcrumb])
    <!-- end:PageHeader -->

    <!-- Start::row-1 -->
    <form action="{{route("admin.".$module->type.".store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-xl-6">
                                <label for="input-source" class="form-label">@lang('admin/inputs.source')</label>
                                <input type="text" name="source" class="form-control slug-type" id="input-source" placeholder="@lang('admin/inputs.source')" value="{{old('source')}}">
                                @error("source")
                                <small class="d-block text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="input-target" class="form-label">@lang('admin/inputs.target')</label>
                                <input type="text" name="target" class="form-control slug-type" id="input-target" placeholder="@lang('admin/inputs.target')" value="{{old('target')}}">
                                @error("target")
                                <small class="d-block text-danger mt-2">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4 justify-content-center">
                            <div class="col-md-4 col-lg-3">
                                <button type="submit" class="btn btn-success-light btn-wave mb-4 w-100">@lang('admin/inputs.create_button')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--End::row-1 -->

@endsection
