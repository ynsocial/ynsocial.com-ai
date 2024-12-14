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
                <div class="card-body">
                    <div id="ckfinder-widget">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->


@endsection

@push('scripts')
    <script>
        CKFinder.widget( 'ckfinder-widget', {
            width: '100%',
            height: 700
        } );
    </script>
@endpush
