@component('mail::message')
# Hello {{ $name }},

{!! nl2br(e($message)) !!}

@if(isset($originalMessage))
@component('mail::panel')
**Your original message:**
{!! nl2br(e($originalMessage)) !!}
@endcomponent
@endif

Best regards,<br>
{{ config('app.name') }} Team
@endcomponent
