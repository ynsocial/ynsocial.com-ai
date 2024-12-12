@extends('layouts.frontend')

@section('title', 'Contact Us - ' . config('app.name'))
@section('meta_description', 'Get in touch with our digital marketing experts. We\'re here to help you grow your business online.')

@section('content')
    <!-- Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Contact Us</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Contact</li>
                </ul>
            </div>
        </div>

        <div class="shape2"><img src="{{ asset('assets/frontend/images/shape/shape2.png') }}" alt="shape"></div>
        <div class="shape3"><img src="{{ asset('assets/frontend/images/shape/shape3.png') }}" alt="shape"></div>
        <div class="shape4"><img src="{{ asset('assets/frontend/images/shape/shape4.png') }}" alt="shape"></div>
        <div class="shape5"><img src="{{ asset('assets/frontend/images/shape/shape5.png') }}" alt="shape"></div>
        <div class="shape6"><img src="{{ asset('assets/frontend/images/shape/shape6.png') }}" alt="shape"></div>
        <div class="shape7"><img src="{{ asset('assets/frontend/images/shape/shape7.png') }}" alt="shape"></div>
        <div class="shape8"><img src="{{ asset('assets/frontend/images/shape/shape8.png') }}" alt="shape"></div>
    </div>

    <!-- Contact Info -->
    <section class="contact-info-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="contact-info-box">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Our Address</h3>
                        <p>123 Business Street<br>New York, NY 10001</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="contact-info-box">
                        <div class="icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <h3>Contact</h3>
                        <p>Mobile: <a href="tel:+1234567890">+1 (234) 567-890</a></p>
                        <p>E-mail: <a href="mailto:hello@ynsocial.com">hello@ynsocial.com</a></p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="contact-info-box">
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Hours of Operation</h3>
                        <p>Monday - Friday: 09:00 - 20:00</p>
                        <p>Sunday & Saturday: 10:30 - 22:00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Area -->
    <section class="contact-area pb-100">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">Get in Touch</span>
                <h2>Ready to Get Started?</h2>
                <p>Your email address will not be published. Required fields are marked *</p>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="contact-form">
                        <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required placeholder="Your name">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required placeholder="Your email address">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" required placeholder="Your phone number">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required placeholder="Your subject">
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" cols="30" rows="5" required placeholder="Write your message..."></textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 mb-3">
                                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                    <div class="invalid-feedback d-none" id="captcha-error">
                                        Please complete the CAPTCHA verification.
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn">
                                        Send Message <span></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="contact-image">
                        <img src="{{ asset('assets/frontend/images/contact.png') }}" alt="contact">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map -->
    <div class="contact-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.9476519598093!2d-73.98268858459418!3d40.74844797932881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1638120689161!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
@endsection

@push('styles')
<style>
    .contact-info-box {
        text-align: center;
        padding: 30px 25px;
        border-radius: 5px;
        margin-bottom: 30px;
        border: 1px solid #eeeeee;
        transition: all 0.3s ease;
    }
    .contact-info-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
    }
    .contact-info-box .icon {
        display: inline-block;
        width: 70px;
        height: 70px;
        line-height: 70px;
        background-color: #f5f5f5;
        border-radius: 50%;
        font-size: 35px;
        color: var(--primary-color);
        transition: all 0.3s ease;
        margin-bottom: 25px;
    }
    .contact-info-box:hover .icon {
        background-color: var(--primary-color);
        color: #ffffff;
    }
    .contact-info-box h3 {
        margin-bottom: 10px;
        font-size: 24px;
    }
    .contact-info-box p {
        margin-bottom: 5px;
    }
    .contact-info-box p a {
        display: inline-block;
        color: var(--paragraph-color);
    }
    .contact-info-box p a:hover {
        color: var(--primary-color);
    }
    .contact-form {
        padding-right: 15px;
    }
    .contact-form .form-group {
        margin-bottom: 20px;
    }
    .contact-form .form-control {
        height: 48px;
        padding: 0 15px;
        line-height: 48px;
        background-color: #f5f5f5;
        border: 1px solid #f5f5f5;
        border-radius: 5px;
        color: var(--paragraph-color);
        font-size: 15px;
        font-weight: 400;
        transition: all 0.3s ease;
    }
    .contact-form textarea.form-control {
        height: auto;
        padding-top: 15px;
        line-height: 1.5;
    }
    .contact-form .form-control:focus {
        background-color: transparent;
        border-color: var(--primary-color);
    }
    .contact-form .default-btn {
        margin-top: 5px;
        padding: 12px 30px;
    }
    .contact-image {
        text-align: center;
        position: relative;
        margin-top: 20px;
    }
    .contact-image img {
        max-width: 100%;
    }
    .contact-map iframe {
        margin-bottom: -7px;
    }
</style>
@endpush

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
$(document).ready(function() {
    // Initialize WOW.js
    new WOW().init();

    // Form validation and submission
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        var originalBtnText = submitBtn.html();
        
        // Clear previous error messages
        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');
        $('#captcha-error').addClass('d-none');
        
        // Verify reCAPTCHA
        var captchaResponse = grecaptcha.getResponse();
        if (!captchaResponse) {
            $('#captcha-error').removeClass('d-none');
            return false;
        }
        
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Sending...').prop('disabled', true);

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    // Show success modal
                    $('#successModal').modal('show');
                    form[0].reset();
                    grecaptcha.reset();
                } else {
                    toastr.error(response.message || 'An error occurred. Please try again.');
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        var input = form.find('[name="' + key + '"]');
                        input.addClass('is-invalid');
                        input.after('<div class="invalid-feedback">' + errors[key][0] + '</div>');
                        toastr.error(errors[key][0]);
                    });
                } else if (xhr.status === 429) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error('An error occurred. Please try again later.');
                }
                grecaptcha.reset();
            },
            complete: function() {
                submitBtn.html(originalBtnText).prop('disabled', false);
            }
        });
    });

    // Reset form on modal close
    $('#successModal').on('hidden.bs.modal', function () {
        $('#contactForm')[0].reset();
        grecaptcha.reset();
    });
});
</script>
@endpush
