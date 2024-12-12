<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --header-bg: {{ $header->style['background_color'] ?? '#ffffff' }};
            --header-text: {{ $header->style['text_color'] ?? '#000000' }};
        }
        
        .header {
            background-color: var(--header-bg);
            color: var(--header-text);
            padding: 1rem 0;
        }
        
        .header a {
            color: var(--header-text);
            text-decoration: none;
        }
        
        .header .logo img {
            max-height: 50px;
        }
        
        .header .contact-info {
            font-size: 0.9rem;
        }
        
        .header .social-links a {
            margin-left: 1rem;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-md-3">
                    <div class="logo">
                        <img src="{{ $header->content['logo'] ?? asset('images/default-logo.png') }}" 
                             alt="Logo">
                    </div>
                </div>

                <!-- Contact Info -->
                @if($header->visibility['contact_info'] ?? true)
                <div class="col-md-6">
                    <div class="contact-info">
                        @if(!empty($header->content['contact_info']['phone']))
                        <div class="mb-1">
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:{{ $header->content['contact_info']['phone'] }}">
                                {{ $header->content['contact_info']['phone'] }}
                            </a>
                        </div>
                        @endif
                        
                        @if(!empty($header->content['contact_info']['email']))
                        <div>
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:{{ $header->content['contact_info']['email'] }}">
                                {{ $header->content['contact_info']['email'] }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Social Links -->
                @if($header->visibility['social_links'] ?? true)
                <div class="col-md-3 text-end">
                    <div class="social-links">
                        @foreach($header->content['social_links'] ?? [] as $platform => $url)
                        <a href="{{ $url }}" target="_blank">
                            <i class="fab fa-{{ $platform }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </header>
</body>
</html>
