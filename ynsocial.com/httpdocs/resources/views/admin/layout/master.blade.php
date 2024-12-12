<!DOCTYPE html>
<html lang="{{env("APP_LANG")}}" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@stack('meta_title') - {{env("APP_NAME")}}</title>
    <meta name="Description" content="@stack('meta_description')">
    <meta name="Author" content="Ynsocial">

    <!-- Favicon -->
    <link rel="icon" href="{{env("APP_URL")}}/admin/images/logos/icon.svg">

    <!-- start:Styles -->
    @include("admin.components.partials.styles")
    @stack('styles')
    <!-- end:Styles -->

</head>

<body>

    <!-- start:Switcher -->
    @include('admin.components.partials.switcher')
    <!-- end:Switcher -->

    <!-- start:Header -->
    @include('admin.components.partials.loader')
    <!-- end:Header -->

    <div class="page">

        <!-- start:Header -->
        @include('admin.components.partials.header')
        <!-- end:Header -->

        <!-- start:Sidebar -->
        @include('admin.components.partials.sidebar')
        <!-- end:Sidebar -->

        <!-- start:Content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
        <!-- end:Content -->

        <!-- start:Footer -->
        @include('admin.components.partials.footer')
        <!-- end:Footer -->


        <!-- start:Modal -->
        @include('admin.components.partials.search-modal')
        <!-- end:Modal -->

    </div>


    <!-- start:Scroll -->
    @include('admin.components.partials.scroll')
    <!-- end:Scroll -->

    <!-- start:Scripts -->
    @include('admin.components.partials.scripts')

    <script>
        CKFinder.config({
            connectorPath: @json(route('ckfinder.connector')),
            language: '{{env("APP_LANG")}}'
        })
    </script>

    @stack('scripts')
    <!-- end:Scripts -->


</body>

</html>
