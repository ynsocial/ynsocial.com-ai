@extends('montoya.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="page-hero bg-dark text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 mb-3">Contact Us</h1>
                    <p class="lead mb-4">Get in touch with us to start your next project.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-section py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-4">
                    <div class="contact-info bg-light p-4 rounded-3 h-100">
                        <h3 class="h4 mb-4">Get in Touch</h3>
                        
                        <div class="contact-item mb-4">
                            <div class="icon-wrapper mb-3">
                                <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                            </div>
                            <h4 class="h6 mb-2">Our Location</h4>
                            <p class="text-muted mb-0">123 Business Street<br>San Francisco, CA 94111</p>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="icon-wrapper mb-3">
                                <i class="fas fa-phone fa-2x text-primary"></i>
                            </div>
                            <h4 class="h6 mb-2">Phone Number</h4>
                            <p class="text-muted mb-0">
                                <a href="tel:+1234567890" class="text-muted">+1 (234) 567-890</a>
                            </p>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="icon-wrapper mb-3">
                                <i class="fas fa-envelope fa-2x text-primary"></i>
                            </div>
                            <h4 class="h6 mb-2">Email Address</h4>
                            <p class="text-muted mb-0">
                                <a href="mailto:info@ynsocial.com" class="text-muted">info@ynsocial.com</a>
                            </p>
                        </div>

                        <div class="contact-item">
                            <div class="icon-wrapper mb-3">
                                <i class="fas fa-clock fa-2x text-primary"></i>
                            </div>
                            <h4 class="h6 mb-2">Working Hours</h4>
                            <p class="text-muted mb-0">
                                Monday - Friday: 9:00 AM - 6:00 PM<br>
                                Saturday: 10:00 AM - 4:00 PM<br>
                                Sunday: Closed
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="contact-form-wrapper bg-white p-4 rounded-3 shadow-sm">
                        <h3 class="h4 mb-4">Send Us a Message</h3>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Your Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="message" class="form-label">Your Message</label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required></textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="map-wrapper rounded-3 overflow-hidden">
                        <div class="ratio ratio-21x9">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0673758805384!2d-122.4194!3d37.7749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858085a4e6ac8f%3A0x7c7f44f4c7c1d22!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1625097337012!5m2!1sen!2sus" 
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 mb-4">Frequently Asked Questions</h2>
                    <p class="lead text-muted">Find answers to common questions about our services</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        @php
                            $faqs = [
                                [
                                    'question' => 'What services do you offer?',
                                    'answer' => 'We offer a comprehensive range of digital services including web design and development, digital marketing, SEO optimization, social media management, and brand strategy development.'
                                ],
                                [
                                    'question' => 'How long does a typical project take?',
                                    'answer' => 'Project timelines vary depending on the scope and complexity. A typical website project takes 4-8 weeks, while marketing campaigns can range from 1-3 months for initial implementation.'
                                ],
                                [
                                    'question' => 'What is your pricing structure?',
                                    'answer' => 'We offer customized pricing based on your specific needs and project requirements. Contact us for a detailed quote tailored to your business.'
                                ],
                                [
                                    'question' => 'Do you offer ongoing support?',
                                    'answer' => 'Yes, we provide ongoing support and maintenance services to ensure your digital assets continue to perform optimally after launch.'
                                ]
                            ];
                        @endphp

                        @foreach($faqs as $index => $faq)
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                        {{ $faq['question'] }}
                                    </button>
                                </h3>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-muted">
                                        {{ $faq['answer'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .page-hero {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/assets/montoya/images/contact/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }

    .contact-info {
        border: 1px solid rgba(0,0,0,.1);
    }

    .icon-wrapper {
        width: 60px;
        height: 60px;
        background: rgba(var(--bs-primary-rgb), 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .contact-form-wrapper {
        border: 1px solid rgba(0,0,0,.1);
    }

    .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
    }

    .map-wrapper {
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
    }

    .accordion-button:not(.collapsed) {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
        color: var(--bs-primary);
    }

    .accordion-button:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
    }
</style>
@endpush 