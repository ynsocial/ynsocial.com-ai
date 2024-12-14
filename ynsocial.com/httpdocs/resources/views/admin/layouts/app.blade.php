<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Admin Panel</title>
    
    <!-- Montaya Theme CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/global/plugins.bundle.css') }}">
    
    @stack('styles')
</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <!-- Sidebar -->
            @include('admin.layouts.partials.sidebar')

            <!-- Main Content -->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('admin.layouts.partials.header')
                
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-xxl">
                            @yield('content')
                        </div>
                    </div>
                </div>
                
                @include('admin.layouts.partials.footer')
            </div>
        </div>
    </div>

    <!-- Montaya Theme JS -->
    <script src="{{ asset('admin/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/scripts.bundle.js') }}"></script>
    
    @stack('scripts')
</body>
</html>