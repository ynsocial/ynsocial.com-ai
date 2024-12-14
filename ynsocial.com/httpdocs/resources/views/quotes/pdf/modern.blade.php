<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quote #{{ $quote->quote_number }}</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 40px;
            color: #333;
        }
        .header {
            padding: 20px;
            background: {{ $branding['primary_color'] ?? '#FF5733' }};
            color: white;
            border-radius: 8px;
        }
        .company-info {
            float: left;
        }
        .quote-info {
            float: right;
            text-align: right;
        }
        .clear {
            clear: both;
        }
        .services {
            margin-top: 40px;
        }
        .service-item {
            background: #f8f9fa;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .service-header {
            border-bottom: 2px solid {{ $branding['secondary_color'] ?? '#33FF57' }};
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .service-price {
            float: right;
            font-size: 1.2em;
            color: {{ $branding['primary_color'] ?? '#FF5733' }};
        }
        .features {
            list-style-type: none;
            padding-left: 0;
        }
        .features li {
            padding: 5px 0;
            position: relative;
            padding-left: 25px;
        }
        .features li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: {{ $branding['primary_color'] ?? '#FF5733' }};
        }
        .total-section {
            margin-top: 40px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 4px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }
        .grand-total {
            font-size: 1.4em;
            font-weight: bold;
            color: {{ $branding['primary_color'] ?? '#FF5733' }};
            border-top: 2px solid #ddd;
            padding-top: 15px;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 0.9em;
            color: #666;
        }
        .logo {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            @if(isset($branding['logo']))
                <img src="{{ $branding['logo'] }}" class="logo" alt="Company Logo">
            @endif
            <h2>{{ config('app.name') }}</h2>
        </div>
        <div class="quote-info">
            <h1>QUOTE</h1>
            <p>Quote #: {{ $quote->quote_number }}</p>
            <p>Date: {{ $quote->created_at->format('F j, Y') }}</p>
            <p>Valid Until: {{ $quote->valid_until?->format('F j, Y') ?? 'N/A' }}</p>
        </div>
        <div class="clear"></div>
    </div>

    <div class="customer-section">
        <h3>Prepared For:</h3>
        <p>{{ $quote->customer->name }}<br>
           {{ $quote->customer->company_name }}<br>
           {{ $quote->customer->email }}</p>
    </div>

    <div class="services">
        @foreach($quote->items as $item)
            <div class="service-item">
                <div class="service-header">
                    <span class="service-price">{{ number_format($item->price, 2) }} {{ $quote->currency }}</span>
                    <h3>{{ $item->name }}</h3>
                </div>
                <p>{{ $item->description }}</p>
                @if($item->custom_features)
                    <ul class="features">
                        @foreach($item->custom_features as $feature)
                            <li>{{ $feature['text'] }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>

    <div class="total-section">
        <div class="total-row">
            <span>Subtotal:</span>
            <span>{{ number_format($quote->total_amount, 2) }} {{ $quote->currency }}</span>
        </div>
        @if($quote->discount_amount > 0)
            <div class="total-row">
                <span>Discount:</span>
                <span>-{{ number_format($quote->discount_amount, 2) }} {{ $quote->currency }}</span>
            </div>
        @endif
        <div class="total-row grand-total">
            <span>Total:</span>
            <span>{{ number_format($quote->final_total, 2) }} {{ $quote->currency }}</span>
        </div>
    </div>

    @if($quote->notes)
        <div class="notes">
            <h3>Notes</h3>
            <p>{{ $quote->notes }}</p>
        </div>
    @endif

    @if($quote->terms)
        <div class="terms">
            <h3>Terms & Conditions</h3>
            <p>{{ $quote->terms }}</p>
        </div>
    @endif

    <div class="footer">
        <p>{{ $branding['footer_text'] ?? 'Thank you for your business!' }}</p>
    </div>
</body>
</html>
