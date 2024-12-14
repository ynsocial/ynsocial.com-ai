@extends('admin.layout.master')

@section('content')
    <!-- start:PageHeader -->
    @include('admin.components.asides.page-heading', ["title" => $module->module_title, "breadcrumb" => $module->breadcrumb])
    <!-- end:PageHeader -->

@endsection
