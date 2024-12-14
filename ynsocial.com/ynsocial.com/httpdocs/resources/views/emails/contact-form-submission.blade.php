@component('mail::message')
# New Contact Form Submission

You have received a new contact form submission from your website.

**Name:** {{ $name }}  
**Email:** {{ $email }}  
**Phone:** {{ $phone }}  
**Subject:** {{ $subject }}

**Message:**  
{{ $messageContent }}

@component('mail::button', ['url' => config('app.url')])
Visit Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
