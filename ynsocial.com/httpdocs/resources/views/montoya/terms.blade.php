@extends('montoya.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="page-hero bg-dark text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 mb-3">Terms of Service</h1>
                    <p class="lead mb-4">Last updated: {{ now()->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="terms-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Table of Contents -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="h5 mb-3">Table of Contents</h2>
                            <ol class="toc-list mb-0">
                                <li><a href="#acceptance">Acceptance of Terms</a></li>
                                <li><a href="#services">Description of Services</a></li>
                                <li><a href="#eligibility">Eligibility</a></li>
                                <li><a href="#accounts">User Accounts</a></li>
                                <li><a href="#content">User Content</a></li>
                                <li><a href="#prohibited">Prohibited Activities</a></li>
                                <li><a href="#intellectual-property">Intellectual Property</a></li>
                                <li><a href="#termination">Termination</a></li>
                                <li><a href="#disclaimer">Disclaimers</a></li>
                                <li><a href="#limitation">Limitation of Liability</a></li>
                                <li><a href="#indemnification">Indemnification</a></li>
                                <li><a href="#governing-law">Governing Law</a></li>
                                <li><a href="#changes">Changes to Terms</a></li>
                                <li><a href="#contact">Contact Information</a></li>
                            </ol>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="terms-sections">
                        <!-- Acceptance -->
                        <section id="acceptance" class="mb-5">
                            <h2 class="h3 mb-4">Acceptance of Terms</h2>
                            <p>By accessing or using YN Social's services, you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our services.</p>
                            <p>These terms constitute a legally binding agreement between you and YN Social regarding your use of our services.</p>
                        </section>

                        <!-- Services -->
                        <section id="services" class="mb-5">
                            <h2 class="h3 mb-4">Description of Services</h2>
                            <p>YN Social provides digital marketing and social media management services, including but not limited to:</p>
                            <ul>
                                <li>Social media strategy development</li>
                                <li>Content creation and management</li>
                                <li>Analytics and reporting</li>
                                <li>Campaign management</li>
                                <li>Consultation services</li>
                            </ul>
                        </section>

                        <!-- Eligibility -->
                        <section id="eligibility" class="mb-5">
                            <h2 class="h3 mb-4">Eligibility</h2>
                            <p>To use our services, you must:</p>
                            <ul>
                                <li>Be at least 18 years old</li>
                                <li>Have the legal capacity to enter into contracts</li>
                                <li>Comply with these terms and all applicable laws</li>
                            </ul>
                        </section>

                        <!-- User Accounts -->
                        <section id="accounts" class="mb-5">
                            <h2 class="h3 mb-4">User Accounts</h2>
                            <p>When creating an account, you agree to:</p>
                            <ul>
                                <li>Provide accurate and complete information</li>
                                <li>Maintain the security of your account</li>
                                <li>Promptly update any changes to your information</li>
                                <li>Accept responsibility for all activities under your account</li>
                            </ul>
                        </section>

                        <!-- User Content -->
                        <section id="content" class="mb-5">
                            <h2 class="h3 mb-4">User Content</h2>
                            <p>By submitting content to our services, you:</p>
                            <ul>
                                <li>Grant us a worldwide, non-exclusive license to use the content</li>
                                <li>Represent that you own or have rights to the content</li>
                                <li>Accept responsibility for any third-party claims</li>
                            </ul>
                        </section>

                        <!-- Prohibited Activities -->
                        <section id="prohibited" class="mb-5">
                            <h2 class="h3 mb-4">Prohibited Activities</h2>
                            <p>You agree not to:</p>
                            <ul>
                                <li>Violate any laws or regulations</li>
                                <li>Infringe on intellectual property rights</li>
                                <li>Transmit harmful code or content</li>
                                <li>Impersonate others</li>
                                <li>Interfere with service operation</li>
                            </ul>
                        </section>

                        <!-- Intellectual Property -->
                        <section id="intellectual-property" class="mb-5">
                            <h2 class="h3 mb-4">Intellectual Property</h2>
                            <p>All content and materials available through our services are protected by intellectual property rights. You may not:</p>
                            <ul>
                                <li>Copy or reproduce any content without permission</li>
                                <li>Modify or create derivative works</li>
                                <li>Use our trademarks without authorization</li>
                            </ul>
                        </section>

                        <!-- Termination -->
                        <section id="termination" class="mb-5">
                            <h2 class="h3 mb-4">Termination</h2>
                            <p>We may terminate or suspend your access to our services:</p>
                            <ul>
                                <li>For violations of these terms</li>
                                <li>At our sole discretion</li>
                                <li>Without prior notice</li>
                            </ul>
                        </section>

                        <!-- Disclaimers -->
                        <section id="disclaimer" class="mb-5">
                            <h2 class="h3 mb-4">Disclaimers</h2>
                            <p>Our services are provided "as is" and "as available" without warranties of any kind, either express or implied.</p>
                            <p>We do not guarantee that our services will be uninterrupted, secure, or error-free.</p>
                        </section>

                        <!-- Limitation of Liability -->
                        <section id="limitation" class="mb-5">
                            <h2 class="h3 mb-4">Limitation of Liability</h2>
                            <p>To the maximum extent permitted by law, YN Social shall not be liable for:</p>
                            <ul>
                                <li>Direct, indirect, or consequential damages</li>
                                <li>Lost profits or revenue</li>
                                <li>Data loss or corruption</li>
                                <li>Service interruptions</li>
                            </ul>
                        </section>

                        <!-- Indemnification -->
                        <section id="indemnification" class="mb-5">
                            <h2 class="h3 mb-4">Indemnification</h2>
                            <p>You agree to indemnify and hold YN Social harmless from any claims arising from:</p>
                            <ul>
                                <li>Your use of our services</li>
                                <li>Your violation of these terms</li>
                                <li>Your violation of third-party rights</li>
                            </ul>
                        </section>

                        <!-- Governing Law -->
                        <section id="governing-law" class="mb-5">
                            <h2 class="h3 mb-4">Governing Law</h2>
                            <p>These terms shall be governed by and construed in accordance with the laws of [Jurisdiction], without regard to its conflict of law provisions.</p>
                        </section>

                        <!-- Changes -->
                        <section id="changes" class="mb-5">
                            <h2 class="h3 mb-4">Changes to Terms</h2>
                            <p>We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting to our website.</p>
                            <p>Your continued use of our services constitutes acceptance of any changes.</p>
                        </section>

                        <!-- Contact -->
                        <section id="contact" class="mb-5">
                            <h2 class="h3 mb-4">Contact Information</h2>
                            <p>For questions about these terms, please contact us:</p>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Email:</strong> legal@ynsocial.com</li>
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
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/assets/montoya/images/terms/hero-bg.jpg');
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

    .terms-sections section {
        scroll-margin-top: 100px;
    }

    .terms-sections h2 {
        color: var(--bs-primary);
        margin-bottom: 1.5rem;
    }

    .terms-sections ul {
        padding-left: 1.5rem;
    }

    .terms-sections ul li {
        margin-bottom: 0.5rem;
    }

    @media (min-width: 992px) {
        .terms-sections {
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
    const sections = document.querySelectorAll('.terms-sections section');
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