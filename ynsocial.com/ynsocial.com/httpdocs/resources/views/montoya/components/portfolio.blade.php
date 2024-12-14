@php
$content = $component->content ?? [
    'title' => 'Our Portfolio',
    'subtitle' => 'Showcasing Our Success Stories',
    'categories' => [
        'all' => 'All Projects',
        'social-media' => 'Social Media',
        'seo' => 'SEO',
        'content' => 'Content Marketing',
        'branding' => 'Branding'
    ],
    'projects' => [
        [
            'title' => 'Social Media Growth Campaign',
            'category' => 'social-media',
            'image' => '/images/portfolio/social-media-1.jpg',
            'client' => 'Tech Innovators Inc.',
            'description' => 'Increased social media engagement by 300% through strategic content and community management.',
            'tags' => ['Instagram', 'Facebook', 'LinkedIn']
        ],
        [
            'title' => 'SEO Optimization Project',
            'category' => 'seo',
            'image' => '/images/portfolio/seo-1.jpg',
            'client' => 'Global Solutions Ltd.',
            'description' => 'Achieved top 3 rankings for key industry terms through comprehensive SEO strategy.',
            'tags' => ['Technical SEO', 'Content Strategy', 'Link Building']
        ],
        [
            'title' => 'Content Marketing Strategy',
            'category' => 'content',
            'image' => '/images/portfolio/content-1.jpg',
            'client' => 'Creative Studios',
            'description' => 'Developed and executed a content strategy that doubled website traffic.',
            'tags' => ['Blog Posts', 'Infographics', 'Video Content']
        ],
        [
            'title' => 'Brand Identity Design',
            'category' => 'branding',
            'image' => '/images/portfolio/branding-1.jpg',
            'client' => 'StartUp Vision',
            'description' => 'Created a cohesive brand identity that resonates with the target audience.',
            'tags' => ['Logo Design', 'Brand Guidelines', 'Visual Identity']
        ]
    ]
];

$animations = $component->animations ?? [
    'title' => 'fade-up',
    'filters' => 'fade-down',
    'projects' => 'fade-up'
];

$styles = $component->styles ?? [
    'background' => '#ffffff',
    'text_color' => '#333333',
    'accent_color' => '#007bff'
];
@endphp

<section id="portfolio" class="portfolio-section py-5" style="background-color: {{ $styles['background'] }}; color: {{ $styles['text_color'] }}">
    <div class="container">
        <!-- Header -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title" 
                    data-animation="{{ $animations['title'] }}"
                    data-animation-delay="200">
                    {{ $content['title'] }}
                </h2>
                <p class="section-subtitle" 
                   data-animation="{{ $animations['title'] }}"
                   data-animation-delay="400">
                    {{ $content['subtitle'] }}
                </p>
            </div>
        </div>

        <!-- Portfolio Filters -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="portfolio-filters"
                     data-animation="{{ $animations['filters'] }}"
                     data-animation-delay="600">
                    @foreach($content['categories'] as $key => $label)
                    <button class="filter-btn {{ $key === 'all' ? 'active' : '' }}"
                            data-filter="{{ $key }}"
                            style="color: {{ $styles['text_color'] }}">
                        {{ $label }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Portfolio Grid -->
        <div class="row portfolio-grid">
            @foreach($content['projects'] as $index => $project)
            <div class="col-lg-4 col-md-6 mb-4 portfolio-item {{ $project['category'] }}"
                 data-animation="{{ $animations['projects'] }}"
                 data-animation-delay="{{ 200 + ($index * 200) }}">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <img src="{{ $project['image'] }}" 
                             alt="{{ $project['title'] }}" 
                             class="img-fluid">
                        <div class="portfolio-overlay">
                            <div class="overlay-content">
                                <h4>{{ $project['title'] }}</h4>
                                <p class="client">{{ $project['client'] }}</p>
                                <button class="btn btn-light btn-sm view-project"
                                        data-project="{{ json_encode($project) }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Project Modal -->
<div class="modal fade" id="projectModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="" alt="" class="img-fluid project-image mb-3">
                    </div>
                    <div class="col-md-6">
                        <h6>Client</h6>
                        <p class="project-client"></p>
                        <h6>Description</h6>
                        <p class="project-description"></p>
                        <h6>Tags</h6>
                        <div class="project-tags"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .portfolio-section {
        position: relative;
    }
    
    .portfolio-filters {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .filter-btn {
        background: none;
        border: none;
        padding: 0.5rem 1rem;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .filter-btn::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background-color: {{ $styles['accent_color'] }};
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }
    
    .filter-btn.active::after,
    .filter-btn:hover::after {
        width: 80%;
    }
    
    .portfolio-card {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .portfolio-image {
        position: relative;
        overflow: hidden;
    }
    
    .portfolio-image img {
        transition: transform 0.5s ease;
    }
    
    .portfolio-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .portfolio-card:hover .portfolio-image img {
        transform: scale(1.1);
    }
    
    .portfolio-card:hover .portfolio-overlay {
        opacity: 1;
    }
    
    .overlay-content {
        text-align: center;
        color: #ffffff;
        padding: 1rem;
    }
    
    .overlay-content h4 {
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }
    
    .overlay-content .client {
        font-size: 0.9rem;
        opacity: 0.8;
        margin-bottom: 1rem;
    }
    
    .project-tags .tag {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        margin: 0.25rem;
        background-color: {{ $styles['accent_color'] }};
        color: #ffffff;
        border-radius: 50px;
        font-size: 0.8rem;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    const portfolioSection = document.querySelector('#portfolio');
    initializeAnimations(portfolioSection);
    
    // Portfolio filtering
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items
            portfolioItems.forEach(item => {
                if (filter === 'all' || item.classList.contains(filter)) {
                    item.style.display = 'block';
                    setTimeout(() => item.style.opacity = '1', 50);
                } else {
                    item.style.opacity = '0';
                    setTimeout(() => item.style.display = 'none', 500);
                }
            });
        });
    });
    
    // Project modal
    const projectModal = new bootstrap.Modal(document.getElementById('projectModal'));
    const viewButtons = document.querySelectorAll('.view-project');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const project = JSON.parse(this.dataset.project);
            const modal = document.getElementById('projectModal');
            
            modal.querySelector('.modal-title').textContent = project.title;
            modal.querySelector('.project-image').src = project.image;
            modal.querySelector('.project-client').textContent = project.client;
            modal.querySelector('.project-description').textContent = project.description;
            
            const tagsContainer = modal.querySelector('.project-tags');
            tagsContainer.innerHTML = project.tags
                .map(tag => `<span class="tag">${tag}</span>`)
                .join('');
            
            projectModal.show();
        });
    });
});
</script>
@endpush
