@extends('admin.layout.master')

@push('meta_title')
    {{$module->module_title}}
@endpush

@section('content')
    <!-- start:PageHeader -->
    @include('admin.components.asides.page-heading', ["title" => $module->module_title, "breadcrumb" => $module->breadcrumb])
    <!-- end:PageHeader -->


    <!-- Start::row-1 -->
    <div class="row justify-content-center">
        <div class="col-12">
            <ul class="list-group list-group-flush">

                <li class="list-group-item fw-medium">
                    <i class="ri-home-2-line fs-15 lh-1 align-center me-2 text-muted"></i>
                    @lang('admin/components.table.sender')
                    <span class="ms-1 text-muted fw-normal d-inline-block">
                        {{$envelope->name}}
                    </span>
                </li>

                <li class="list-group-item fw-medium">
                    <i class="ri-cloud-line fs-15 lh-1 align-center me-2 text-muted"></i>
                    @lang('admin/components.table.email')
                    <span class="ms-1 text-muted fw-normal d-inline-block">
                        {{$envelope->email}}
                    </span>
                </li>

                <li class="list-group-item fw-medium">
                    <i class="ri-global-line fs-15 lh-1 align-center me-2 text-muted"></i>
                    @lang('admin/components.table.phone')
                    <span class="ms-1 text-muted fw-normal d-inline-block">
                        {{$envelope->phone ?? "-"}}
                    </span>
                </li>


                <li class="list-group-item fw-medium">
                    <i class="ri-stack-line fs-15 lh-1 align-center me-2 text-muted"></i>
                    @lang('admin/components.table.subject')
                    <span class="ms-1 text-muted fw-normal d-inline-block">
                        {{$envelope->subject ?? "-"}}
                    </span>
                </li>

                <li class="list-group-item fw-medium">
                    <i class="ri-gift-2-line fs-15 lh-1 align-center me-2 text-muted"></i>
                    @lang('admin/components.table.message')
                    <span class="ms-1 text-muted fw-normal d-inline-block">
                        {{$envelope->message ?? "-"}}
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <!--End::row-1 -->

@endsection
