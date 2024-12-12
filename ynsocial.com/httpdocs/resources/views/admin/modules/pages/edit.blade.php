@extends('admin.layout.master')

@push('meta_title')
    {{$page->title." (".$module->module_title.")"}}
@endpush

@section('content')
    <!-- start:PageHeader -->
    @include('admin.components.asides.page-heading', ["title" => $module->module_title, "breadcrumb" => $module->breadcrumb])
    <!-- end:PageHeader -->

    <!-- Start::row-1 -->
    <form action="{{route("admin.".$module->type.".update", $page->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <input type="hidden" name="current_image" value="{{$page->featured_image}}">

        <div class="row">
            <div class="col-lg-8 col-xl-9">
                @include('admin.components.alert-session', ['message' => session()->has('message'), 'type' => session()->get('message.type'), 'text' => session()->get('message.text')])

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">
                                    {{$page->title}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label for="input-label" class="form-label">@lang('admin/inputs.page_title')</label>
                                        <input type="text" name="title" class="form-control" id="input-label" placeholder="@lang('admin/inputs.enter_page_title')" value="{{$page->title}}">
                                        @error('title')
                                        <small class="d-block text-danger mt-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-xl-12">
                                        <label class="form-label">@lang('admin/inputs.content')</label>
                                        <textarea name="content" class="d-none quill-content">{!! $page->content !!}</textarea>
                                        <div id="project-descriptioin-editor">
                                            {!! $page->content !!}
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <label for="input-url" class="form-label">@lang('admin/inputs.slug')</label>
                                        <input type="text" name="slug" class="form-control" id="input-url" placeholder="@lang('admin/inputs.enter_slug')" value="{{$page->slug->slug}}">
                                        @error('slug')
                                        <small class="d-block text-danger mt-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">
                                    @lang('admin/inputs.seo_title')
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label for="input-meta-title" class="form-label">@lang('admin/inputs.meta_title')</label>
                                        <input type="text" name="meta_title" class="form-control" id="input-meta-title" placeholder="@lang('admin/inputs.enter_meta_title')" value="{{$page->meta_title}}">
                                    </div>
                                    <div class="col-xl-12">
                                        <label for="input-meta-description" class="form-label">@lang('admin/inputs.meta_description')</label>
                                        <input type="text" name="meta_description" class="form-control" id="input-meta-description" placeholder="@lang('admin/inputs.enter_meta_description')" value="{{$page->meta_description}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <button type="submit" class="btn btn-success-light btn-wave mb-4 w-100">@lang('admin/inputs.update_button')</button>
                <div class="card custom-card">
                    <div class="card-header mb-0">
                        <label for="input-image" class="card-title mb-0">
                            @lang('admin/inputs.featured_image')
                        </label>
                    </div>
                    <div class="card-body pt-0">
                        @if($page->featured_image)
                            <div class="featured-image-box position-relative">
                                <i class="las la-times featured-image-toggler"></i>
                                <label for="input-image" style="cursor: pointer">
                                    <img src="{{asset($page->featured_image)}}" id="featured-image" class="img-fluid rounded mb-3" alt="{{$page->title}}">
                                </label>
                            </div>
                        @endif
                        <input class="form-control" name="featured_image" type="file" id="input-image">
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="col-xl-12">
                            <label id="input-status" class="form-label">@lang('admin/inputs.status')</label>
                            <select class="form-select" name="is_active" id="input-status">
                                <option value="1" @if($page->is_active) selected @endif >@lang('admin/inputs.status_active')</option>
                                <option value="0" @if(!$page->is_active) selected @endif >@lang('admin/inputs.status_passive')</option>
                            </select>
                        </div>
                        <div class="col-xl-12 mt-3">
                            <label id="input-indexable" class="form-label">@lang('admin/inputs.indexable')</label>
                            <select class="form-select" name="is_indexable" id="input-indexable">
                                <option value="1" @if($page->is_indexable) selected @endif >@lang('admin/inputs.indexable_yes')</option>
                                <option value="0" @if(!$page->is_indexable) selected @endif >@lang('admin/inputs.indexable_no')</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="col-xl-12">
                            <label id="input-template" class="form-label">@lang('admin/inputs.template')</label>
                            <input class="form-control" name="template" type="text" id="input-template" value="{{$page->template}}">
                        </div>
                        <div class="col-xl-12 mt-3">
                            <label id="input-controller" class="form-label">@lang('admin/inputs.controller')</label>
                            <input class="form-control" name="controller" type="text" id="input-controller" value="{{$page->slug->method}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--End::row-1 -->

@endsection

@push("styles")
    <link rel="stylesheet" href="{{env("APP_URL")}}/admin/libs/quill/quill.snow.css">
    <link rel="stylesheet" href="{{env("APP_URL")}}/admin/libs/quill/quill.bubble.css">
@endpush

@push("scripts")
    <!-- Quill Editor JS -->
    <script src="{{env("APP_URL")}}/admin/libs/quill/quill.js"></script>
    <!-- Flat Picker JS -->
    <script src="{{env("APP_URL")}}/admin/libs/flatpickr/flatpickr.min.js"></script>
    <!-- Create Project JS -->
    <script src="{{env("APP_URL")}}/admin/js/create-project.js"></script>
@endpush
