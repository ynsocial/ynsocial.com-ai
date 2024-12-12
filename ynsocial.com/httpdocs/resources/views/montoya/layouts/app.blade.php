<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    @if($googleFontsUrl = \App\Helpers\ThemeHelper::getGoogleFontsUrl($theme))
        <link href="{{ $googleFontsUrl }}" rel="stylesheet">
    @endif

    <!-- Theme CSS -->
    <link href="{{ \App\Helpers\ThemeHelper::asset('css/style.css') }}" rel="stylesheet">
    
    <!-- Dynamic Theme CSS -->
    <style>
        {!! \App\Helpers\ThemeHelper::generateCustomCSS($theme) !!}
    </style>

    @stack('styles')
</head>
<body class="theme-{{ $theme->layout }}">
    <div id="app">
        <!-- Header -->
        <header class="site-header">
            @include('montoya.partials.navigation')
        </header>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="site-footer">
            @include('montoya.partials.footer')
        </footer>

        @if($theme->footer['show_back_to_top'])
            <button class="back-to-top">
                <i class="fas fa-arrow-up"></i>
            </button>
        @endif
    </div>

    <!-- Theme JavaScript -->
    <script src="{{ \App\Helpers\ThemeHelper::asset('js/theme.js') }}"></script>
    
    <!-- Dynamic Theme JavaScript -->
    <script>
        {!! \App\Helpers\ThemeHelper::generateCustomJS($theme) !!}
    </script>

    @stack('scripts')
</body>
</html> 