<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title', 'Digital Marketing Agency')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ AssetHelper::montoya('favicon/favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ AssetHelper::montoya('favicon/favicon.ico') }}">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Montoya Theme Styles -->
    <link rel="stylesheet" href="{{ AssetHelper::montoya('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ AssetHelper::montoya('css/assets.css') }}">
    <link rel="stylesheet" href="{{ AssetHelper::montoya('css/content.css') }}">
    <link rel="stylesheet" href="{{ AssetHelper::montoya('css/shortcodes.css') }}">
    <link rel="stylesheet" href="{{ AssetHelper::montoya('css/showcase.css') }}">
    @stack('styles')
    
    <!-- Theme Settings -->
    <style id="theme-dynamic-styles">
        :root {
            /* Colors will be injected dynamically */
            @foreach($themeSettings['colors'] ?? [] as $key => $value)
                --color-{{ $key }}: {{ $value }};
            @endforeach
            
            /* Typography */
            @foreach($themeSettings['typography'] ?? [] as $key => $value)
                --font-{{ $key }}: {{ $value }};
            @endforeach

            /* Custom Settings */
            @foreach($themeSettings['custom'] ?? [] as $key => $value)
                --{{ $key }}: {{ $value }};
            @endforeach
        }
    </style>
</head>
<body class="montoya-theme {{ $bodyClass ?? '' }}">
    <!-- Preloader -->
    @include('montoya.partials.preloader')
    
    <!-- Navigation -->
    @include('montoya.partials.navigation')
    
    <!-- Main Content -->
    <main id="main-content">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('montoya.partials.footer')
    
    <!-- Scripts -->
    <script src="{{ AssetHelper::montoya('js/jquery.min.js') }}"></script>
    <script src="{{ AssetHelper::montoya('js/plugins.js') }}"></script>
    <script src="{{ AssetHelper::montoya('js/common.js') }}"></script>
    <script src="{{ AssetHelper::montoya('js/scripts.js') }}"></script>
    <script src="{{ AssetHelper::montoya('js/clapat.js') }}"></script>
    
    <!-- Theme Settings -->
    <script>
        window.themeSettings = @json($themeSettings ?? []);
        window.routes = {
            'contact': '{{ route('contact.submit') }}',
            'newsletter': '{{ route('newsletter.subscribe') }}',
        };
    </script>
    
    @stack('scripts')
    
    <!-- Contact Form -->
    @if(Route::currentRouteName() === 'contact')
        <script src="{{ AssetHelper::montoya('js/contact.js') }}"></script>
    @endif
</body>
</html>
