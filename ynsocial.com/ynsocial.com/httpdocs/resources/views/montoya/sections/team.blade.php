@php
    $style = $content['style'] ?? 'grid';
    $title = $content['title'] ?? '';
    $subtitle = $content['subtitle'] ?? '';
    $description = $content['description'] ?? '';
    $showSocialLinks = $content['show_social_links'] ?? true;
    $showPosition = $content['show_position'] ?? true;
    $showBio = $content['show_bio'] ?? true;
    $members = $content['members'] ?? [];
@endphp

<section class="team-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                @if($subtitle)
                    <h5 class="text-primary text-uppercase mb-3">{{ $subtitle }}</h5>
                @endif
                @if($title)
                    <h2 class="display-5 mb-4">{{ $title }}</h2>
                @endif
                @if($description)
                    <p class="lead text-muted">{{ $description }}</p>
                @endif
            </div>
        </div>

        <div class="row g-4">
            @foreach($members as $member)
                <div class="col-md-6 col-lg-3">
                    <div class="team-member-card h-100 bg-white rounded-3 overflow-hidden">
                        <div class="member-image position-relative">
                            @if(isset($member['photo']))
                                <img src="{{ $member['photo'] }}" alt="{{ $member['name'] ?? 'Team Member' }}" class="img-fluid w-100">
                            @endif
                            @if($showSocialLinks && isset($member['social']))
                                <div class="social-links-overlay">
                                    <div class="social-icons d-flex gap-2 justify-content-center">
                                        @if(isset($member['social']['linkedin']))
                                            <a href="{{ $member['social']['linkedin'] }}" class="social-icon" target="_blank">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        @endif
                                        @if(isset($member['social']['twitter']))
                                            <a href="{{ $member['social']['twitter'] }}" class="social-icon" target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        @endif
                                        @if(isset($member['social']['facebook']))
                                            <a href="{{ $member['social']['facebook'] }}" class="social-icon" target="_blank">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        @endif
                                        @if(isset($member['social']['instagram']))
                                            <a href="{{ $member['social']['instagram'] }}" class="social-icon" target="_blank">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="member-info p-4 text-center">
                            <h4 class="member-name h5 mb-2">{{ $member['name'] ?? '' }}</h4>
                            @if($showPosition && isset($member['position']))
                                <p class="member-position text-primary mb-3">{{ $member['position'] }}</p>
                            @endif
                            @if($showBio && isset($member['bio']))
                                <p class="member-bio text-muted mb-0">{{ $member['bio'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
<style>
    .team-section {
        background-color: #f8f9fa;
    }
    
    .team-member-card {
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        transition: all 0.3s ease;
    }
    
    .team-member-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    }
    
    .member-image {
        overflow: hidden;
    }
    
    .member-image img {
        transition: transform 0.3s ease;
        aspect-ratio: 1;
        object-fit: cover;
    }
    
    .team-member-card:hover .member-image img {
        transform: scale(1.1);
    }
    
    .social-links-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .team-member-card:hover .social-links-overlay {
        opacity: 1;
    }
    
    .social-icon {
        width: 36px;
        height: 36px;
        background: var(--bs-primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .social-icon:hover {
        background: white;
        color: var(--bs-primary);
        transform: translateY(-3px);
    }
    
    .member-position {
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .member-bio {
        font-size: 0.9rem;
        line-height: 1.5;
    }
</style>
@endpush 