@component('mail::message')
# Quote Status Update

The quote **#{{ $quote->quote_number }}** for **{{ $quote->customer->name }}** has been {{ $statusMessage }}.

@if($status === 'accepted')
Great news! The customer has approved the quote.

@component('mail::button', ['url' => route('admin.quotes.show', $quote->id)])
View Quote Details
@endcomponent

@elseif($status === 'rejected')
The customer has declined the quote with the following reason:
> {{ $quote->activities->where('activity_type', 'rejected')->first()->activity_data['reason'] }}

@component('mail::button', ['url' => route('admin.quotes.edit', $quote->id)])
Review and Update Quote
@endcomponent

@else
The customer has requested the following changes:
> {{ $quote->activities->where('activity_type', 'changes_requested')->first()->activity_data['comment'] }}

@component('mail::button', ['url' => route('admin.quotes.edit', $quote->id)])
Make Requested Changes
@endcomponent

@endif

**Quote Summary:**
- Total Amount: {{ number_format($quote->total_amount, 2) }} {{ $quote->currency }}
@if($quote->discount_amount > 0)
- Discount: {{ number_format($quote->discount_amount, 2) }} {{ $quote->currency }}
@endif
- Final Total: {{ number_format($quote->final_total, 2) }} {{ $quote->currency }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
