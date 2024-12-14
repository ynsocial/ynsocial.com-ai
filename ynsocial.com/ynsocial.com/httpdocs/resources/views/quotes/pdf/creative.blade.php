<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quote #{{ $quote->quote_number }}</title>
    <style>
        @page {
            margin: 0;
            background: linear-gradient(135deg, {{ $branding['primary_color'] ?? '#FF5733' }}22 0%, {{ $branding['secondary_color'] ?? '#33FF57' }}22 100%);
        }
        body {
            font-family: 'Montserrat', 'Helvetica', sans-serif;
            margin: 0;
            padding: 40px;
            color: #2c3e50;
        }
        .header {
            position: relative;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }
        .quote-badge {
            position: absolute;
            top: -15px;
            right: 30px;
            background: {{ $branding['primary_color'] ?? '#FF5733' }};
            color: white;
            padding: 10px 30px;
            border-radius: 25px;
            font-size: 1.2em;
            transform: rotate(2deg);
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
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 40px 0;
        }
        .service-item {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        .service-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: {{ $branding['primary_color'] ?? '#FF5733' }};
        }
        .service-header {
            margin-bottom: 20px;
        }
        .service-price {
            float: right;
            font-size: 1.4em;
            color: {{ $branding['primary_color'] ?? '#FF5733' }};
            font-weight: bold;
        }
        .features {
            list-style-type: none;
            padding-left: 0;
            margin-top: 15px;
        }
        .features li {
            padding: 8px 0;
            position: relative;
            padding-left: 30px;
        }
        .features li::before {
            content: '★';
            position: absolute;
            left: 0;
            color: {{ $branding['secondary_color'] ?? '#33FF57' }};
        }
        .total-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 1.1em;
        }
        .grand-total {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px dashed {{ $branding['primary_color'] ?? '#FF5733' }};
            font-size: 1.6em;
            font-weight: bold;
            color: {{ $branding['primary_color'] ?? '#FF5733' }};
        }
        .notes-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-top: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .footer {
            text-align: center;
            margin-top: 60px;
            padding: 20px;
            background: white;
            border-radius: 15px;
            font-size: 0.9em;
            color: #666;
        }
        .logo {
            max-width: 200px;
            height: auto;
        }
        .accent-text {
            color: {{ $branding['primary_color'] ?? '#FF5733' }};
        }
        .customer-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-top: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="quote-badge">QUOTE</div>
        <div class="company-info">
            @if(isset($branding['logo']))
                <img src="{{ $branding['logo'] }}" class="logo" alt="Company Logo">
            @endif
            <h2>{{ config('app.name') }}</h2>
        </div>
        <div class="quote-info">
            <p><strong>Quote #:</strong> {{ $quote->quote_number }}</p>
            <p><strong>Date:</strong> {{ $quote->created_at->format('F j, Y') }}</p>
            <p><strong>Valid Until:</strong> {{ $quote->valid_until?->format('F j, Y') ?? 'N/A' }}</p>
        </div>
        <div class="clear"></div>
    </div>

    <div class="customer-section">
        <h3 class="accent-text">Prepared For:</h3>
        <p>
            <strong>{{ $quote->customer->name }}</strong><br>
            {{ $quote->customer->company_name }}<br>
            {{ $quote->customer->email }}
        </p>
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

    @if($quote->notes || $quote->terms)
        <div class="notes-section">
            @if($quote->notes)
                <h3 class="accent-text">Notes</h3>
                <p>{{ $quote->notes }}</p>
            @endif

            @if($quote->terms)
                <h3 class="accent-text">Terms & Conditions</h3>
                <p>{{ $quote->terms }}</p>
            @endif
        </div>
    @endif

    <div class="footer">
        <p>{{ $branding['footer_text'] ?? 'Thank you for considering our creative solutions!' }}</p>
    </div>
</body>
</html>
