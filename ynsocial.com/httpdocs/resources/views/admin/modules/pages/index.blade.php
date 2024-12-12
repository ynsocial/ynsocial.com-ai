@extends('admin.layout.master')

@push('meta_title')
    {{$module->module_title}}
@endpush

@section('content')
    <!-- start:PageHeader -->
    @include('admin.components.asides.page-heading', ["title" => $module->module_title, "breadcrumb" => $module->breadcrumb])
    <!-- end:PageHeader -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

                        <form action="{{route('admin.'.$module->type.'.index')}}" method="get" class="d-flex" role="search">
                            <input class="form-control me-2" name="keyword" type="search" placeholder="@lang('admin/components.search_text')" aria-label="@lang('admin/components.component_search_button')" value="{{request()->get('keyword')}}">
                            <button class="btn btn-primary" type="submit">@lang('admin/components.component_search_button')</button>
                        </form>
                        <div class="d-flex flex-wrap gap-1 project-list-main">
                            <a href="javascript:void(0);" data-url="{{route("admin.bulk.delete", ["table" => $module->type])}}" class="btn btn-danger me-2 bulk-delete" style="display: none;"><i class="ti ti-trash me-1 fw-medium align-middle"></i>@lang('admin/components.delete_selecteds')</a>
                            <a href="{{route("admin.".$module->type.".create")}}" class="btn btn-primary me-2"><i class="ri-add-line me-1 fw-medium align-middle"></i>@lang('admin/components.add_new')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End::row-1 -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        @lang('admin/components.pages_list')
                    </div>
                </div>
                <div class="card-body">

                    @include('admin.components.alert-session', ['message' => session()->has('message'), 'type' => session()->get('message.type'), 'text' => session()->get('message.text')])

                    <div class="table-responsive">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <input class="form-check-input check-all" type="checkbox" id="all-products" value="" aria-label="...">
                                </th>
                                <th scope="col">@lang('admin/components.table.id')</th>
                                <th scope="col">@lang('admin/components.table.name')</th>
                                <th scope="col">@lang('admin/components.table.created_date')</th>
                                <th scope="col">@lang('admin/components.table.modified_date')</th>
                                <th scope="col">@lang('admin/components.table.author')</th>
                                <th scope="col">@lang('admin/components.table.status')</th>
                                <th scope="col">@lang('admin/components.table.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($module->items as $item)
                                <tr class="product-list">
                                    <td class="product-checkbox"><input class="form-check-input" type="checkbox" id="product{{$item->id}}" value="{{$item->id}}" aria-label="..."></td>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="ms-2">
                                                <p class="fw-semibold mb-0 d-flex align-items-center">
                                                    <a href="{{route("admin.".$module->type.".edit",$item->id)}}" title="{{$item->title}}"> {{$item->title}}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{date('d-m-Y H:i:s', strtotime($item->created_at))}}</td>
                                    <td>{{$item->updated_at ? date('d-m-Y H:i:s', strtotime($item->updated_at)) : "-"}}</td>
                                    <td>
                                        @php($author = \App\Models\User::find($item->author_id))
                                        <div class="d-flex align-items-center fw-semibold">
                                            <a href="javascript:void(0);">{{$author->name}}</a>
                                        </div>
                                    </td>
                                    @if($item->is_active)
                                        <td><span class="badge bg-success-transparent">@lang('admin/components.table.status_active')</span></td>
                                    @else
                                        <td><span class="badge bg-danger-transparent">@lang('admin/components.table.status_passive')</span></td>
                                    @endif
                                    <td>
                                        <div class="hstack gap-2 fs-15">
                                            <a href="#" class="btn btn-icon btn-sm btn-primary3-light"><i class="ri-eye-line"></i></a>
                                            <a href="{{route("admin.".$module->type.".edit",$item->id)}}" class="btn btn-icon btn-sm btn-primary-light"><i class="ri-edit-line"></i></a>
                                            <a href="{{route("admin.".$module->type.".language",$item->id)}}" class="btn btn-icon btn-sm btn-success-light"><i class="ri-translate"></i></a>
                                            <a href="{{route("admin.".$module->type.".destroy",$item->id)}}" class="btn btn-icon btn-sm btn-danger-light product-btn alert-destroy "><i class="ri-delete-bin-line"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if(count($module->items) == 0)
                                @include('admin.components.asides.no-result', ["colspan" => 8])
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(request()->get("keyword") == "")
                <div class="card-footer">
                    <div class="d-flex align-items-center flex-wrap overflow-auto">
                        <div class="mb-2 mb-sm-0">
                            @lang('admin/components.table.counter', ['total' => $module->module_total_items]) <i class="bi bi-arrow-right ms-2 fw-semibold"></i>
                        </div>
                        <div class="ms-auto">
                            @include('admin.components.asides.pagination', ['module' => $module])
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!--End::row-1 -->

@endsection
