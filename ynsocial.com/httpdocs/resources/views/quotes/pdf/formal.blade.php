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
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 40px;
            color: #000;
            line-height: 1.6;
        }
        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 30px;
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
        .customer-section {
            margin: 40px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th {
            background: #f5f5f5;
            border-bottom: 2px solid #000;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .amount-column {
            text-align: right;
        }
        .total-section {
            margin-top: 30px;
            float: right;
            width: 300px;
        }
        .total-row {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }
        .total-row.grand-total {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            font-weight: bold;
            font-size: 1.1em;
        }
        .terms-section {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #000;
        }
        .footer {
            position: fixed;
            bottom: 40px;
            left: 40px;
            right: 40px;
            text-align: center;
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
            <h1>QUOTATION</h1>
            <p>Reference: {{ $quote->quote_number }}</p>
            <p>Date: {{ $quote->created_at->format('F j, Y') }}</p>
            <p>Valid Until: {{ $quote->valid_until?->format('F j, Y') ?? 'N/A' }}</p>
        </div>
        <div class="clear"></div>
    </div>

    <div class="customer-section">
        <strong>TO:</strong><br>
        {{ $quote->customer->name }}<br>
        {{ $quote->customer->company_name }}<br>
        {{ $quote->customer->email }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th class="amount-column">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quote->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->name }}</strong><br>
                        {{ $item->description }}
                        @if($item->custom_features)
                            <ul>
                                @foreach($item->custom_features as $feature)
                                    <li>{{ $feature['text'] }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }} {{ $quote->currency }}</td>
                    <td class="amount-column">{{ number_format($item->total, 2) }} {{ $quote->currency }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td class="amount-column">{{ number_format($quote->total_amount, 2) }} {{ $quote->currency }}</td>
                </tr>
                @if($quote->discount_amount > 0)
                    <tr>
                        <td>Discount:</td>
                        <td class="amount-column">-{{ number_format($quote->discount_amount, 2) }} {{ $quote->currency }}</td>
                    </tr>
                @endif
                <tr class="grand-total">
                    <td>Total:</td>
                    <td class="amount-column">{{ number_format($quote->final_total, 2) }} {{ $quote->currency }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="clear"></div>

    @if($quote->notes)
        <div class="terms-section">
            <h3>Notes</h3>
            <p>{{ $quote->notes }}</p>
        </div>
    @endif

    @if($quote->terms)
        <div class="terms-section">
            <h3>Terms & Conditions</h3>
            <p>{{ $quote->terms }}</p>
        </div>
    @endif

    <div class="footer">
        {{ $branding['footer_text'] ?? 'Thank you for considering our services.' }}
    </div>
</body>
</html>
