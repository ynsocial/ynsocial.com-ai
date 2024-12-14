@extends('montoya.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="page-hero bg-dark text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 mb-3">Privacy Policy</h1>
                    <p class="lead mb-4">Last updated: {{ now()->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="privacy-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Table of Contents -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="h5 mb-3">Table of Contents</h2>
                            <ol class="toc-list mb-0">
                                <li><a href="#information-collection">Information Collection</a></li>
                                <li><a href="#information-usage">Information Usage</a></li>
                                <li><a href="#information-protection">Information Protection</a></li>
                                <li><a href="#information-sharing">Information Sharing</a></li>
                                <li><a href="#cookies">Cookies and Tracking</a></li>
                                <li><a href="#third-party">Third-Party Services</a></li>
                                <li><a href="#user-rights">Your Rights</a></li>
                                <li><a href="#updates">Policy Updates</a></li>
                                <li><a href="#contact">Contact Information</a></li>
                            </ol>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="privacy-sections">
                        <!-- Information Collection -->
                        <section id="information-collection" class="mb-5">
                            <h2 class="h3 mb-4">Information Collection</h2>
                            <p>We collect information that you provide directly to us, including:</p>
                            <ul class="mb-4">
                                <li>Name and contact information</li>
                                <li>Account credentials</li>
                                <li>Payment information</li>
                                <li>Communication preferences</li>
                                <li>Service usage data</li>
                            </ul>
                            <p>We also automatically collect certain information when you use our services, including:</p>
                            <ul>
                                <li>Device information</li>
                                <li>Log data</li>
                                <li>Location information</li>
                                <li>Usage patterns</li>
                            </ul>
                        </section>

                        <!-- Information Usage -->
                        <section id="information-usage" class="mb-5">
                            <h2 class="h3 mb-4">Information Usage</h2>
                            <p>We use the collected information for various purposes:</p>
                            <ul>
                                <li>Providing and maintaining our services</li>
                                <li>Processing your transactions</li>
                                <li>Sending you marketing communications</li>
                                <li>Improving our services</li>
                                <li>Detecting and preventing fraud</li>
                                <li>Complying with legal obligations</li>
                            </ul>
                        </section>

                        <!-- Information Protection -->
                        <section id="information-protection" class="mb-5">
                            <h2 class="h3 mb-4">Information Protection</h2>
                            <p>We implement appropriate security measures to protect your information:</p>
                            <ul>
                                <li>Encryption of sensitive data</li>
                                <li>Regular security assessments</li>
                                <li>Access controls and authentication</li>
                                <li>Secure data storage</li>
                                <li>Employee training on privacy practices</li>
                            </ul>
                        </section>

                        <!-- Information Sharing -->
                        <section id="information-sharing" class="mb-5">
                            <h2 class="h3 mb-4">Information Sharing</h2>
                            <p>We may share your information with:</p>
                            <ul>
                                <li>Service providers and partners</li>
                                <li>Legal authorities when required</li>
                                <li>Business transferees in case of sale or merger</li>
                            </ul>
                            <p>We do not sell your personal information to third parties.</p>
                        </section>

                        <!-- Cookies -->
                        <section id="cookies" class="mb-5">
                            <h2 class="h3 mb-4">Cookies and Tracking</h2>
                            <p>We use cookies and similar technologies to:</p>
                            <ul>
                                <li>Remember your preferences</li>
                                <li>Analyze website traffic</li>
                                <li>Personalize content</li>
                                <li>Improve user experience</li>
                            </ul>
                            <p>You can control cookie settings through your browser preferences.</p>
                        </section>

                        <!-- Third-Party Services -->
                        <section id="third-party" class="mb-5">
                            <h2 class="h3 mb-4">Third-Party Services</h2>
                            <p>Our services may include links to third-party websites and services. We are not responsible for their privacy practices.</p>
                            <p>We recommend reviewing the privacy policies of these third parties.</p>
                        </section>

                        <!-- User Rights -->
                        <section id="user-rights" class="mb-5">
                            <h2 class="h3 mb-4">Your Rights</h2>
                            <p>You have the right to:</p>
                            <ul>
                                <li>Access your personal information</li>
                                <li>Correct inaccurate data</li>
                                <li>Request deletion of your data</li>
                                <li>Object to data processing</li>
                                <li>Data portability</li>
                                <li>Withdraw consent</li>
                            </ul>
                        </section>

                        <!-- Policy Updates -->
                        <section id="updates" class="mb-5">
                            <h2 class="h3 mb-4">Policy Updates</h2>
                            <p>We may update this privacy policy from time to time. We will notify you of any significant changes through:</p>
                            <ul>
                                <li>Email notifications</li>
                                <li>Website announcements</li>
                                <li>Service notifications</li>
                            </ul>
                        </section>

                        <!-- Contact Information -->
                        <section id="contact" class="mb-5">
                            <h2 class="h3 mb-4">Contact Information</h2>
                            <p>If you have questions about this privacy policy, please contact us:</p>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Email:</strong> privacy@ynsocial.com</li>
                                        <li><strong>Phone:</strong> +1 (234) 567-890</li>
                                        <li><strong>Address:</strong> 123 Business Street, San Francisco, CA 94111</li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .page-hero {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/assets/montoya/images/privacy/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }

    .toc-list {
        list-style-type: none;
        padding-left: 0;
    }

    .toc-list li {
        margin-bottom: 0.5rem;
    }

    .toc-list a {
        color: var(--bs-primary);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .toc-list a:hover {
        color: var(--bs-primary-dark);
        text-decoration: underline;
    }

    .privacy-sections section {
        scroll-margin-top: 100px;
    }

    .privacy-sections h2 {
        color: var(--bs-primary);
        margin-bottom: 1.5rem;
    }

    .privacy-sections ul {
        padding-left: 1.5rem;
    }

    .privacy-sections ul li {
        margin-bottom: 0.5rem;
    }

    @media (min-width: 992px) {
        .privacy-sections {
            font-size: 1.1rem;
            line-height: 1.8;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Highlight current section in TOC
    const sections = document.querySelectorAll('.privacy-sections section');
    const tocLinks = document.querySelectorAll('.toc-list a');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (window.pageYOffset >= sectionTop - 150) {
                current = section.getAttribute('id');
            }
        });

        tocLinks.forEach(link => {
            link.classList.remove('fw-bold');
            if (link.getAttribute('href').substring(1) === current) {
                link.classList.add('fw-bold');
            }
        });
    });
</script>
@endpush 