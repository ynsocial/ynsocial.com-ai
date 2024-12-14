<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --footer-bg: {{ $footer->style['background_color'] ?? '#000000' }};
            --footer-text: {{ $footer->style['text_color'] ?? '#ffffff' }};
        }
        
        .footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 3rem 0 1rem;
        }
        
        .footer a {
            color: var(--footer-text);
            text-decoration: none;
        }
        
        .footer .logo img {
            max-height: 50px;
            margin-bottom: 1rem;
        }
        
        .footer h5 {
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .footer .social-links {
            margin-top: 2rem;
        }
        
        .footer .social-links a {
            margin-right: 1rem;
            font-size: 1.2rem;
        }
        
        .footer .copyright {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 0.9rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Logo -->
                @if($footer->visibility['logo'] ?? true)
                <div class="col-md-3 mb-4">
                    <div class="logo">
                        <img src="{{ $footer->content['logo'] ?? asset('images/default-logo.png') }}" 
                             alt="Logo">
                    </div>
                </div>
                @endif

                <!-- Footer Columns -->
                @foreach($footer->content['columns'] ?? [] as $column)
                <div class="col-md-3 mb-4">
                    <h5>{{ $column['title'] }}</h5>
                    <div>{!! nl2br(e($column['content'])) !!}</div>
                </div>
                @endforeach

                <!-- Social Links -->
                @if($footer->visibility['social_links'] ?? true)
                <div class="col-md-12">
                    <div class="social-links text-center">
                        @foreach($footer->content['social_links'] ?? [] as $platform => $url)
                        <a href="{{ $url }}" target="_blank">
                            <i class="fab fa-{{ $platform }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Copyright -->
            @if($footer->visibility['copyright'] ?? true)
            <div class="copyright">
                {!! str_replace('{year}', date('Y'), $footer->content['copyright'] ?? '') !!}
            </div>
            @endif
        </div>
    </footer>
</body>
</html>
