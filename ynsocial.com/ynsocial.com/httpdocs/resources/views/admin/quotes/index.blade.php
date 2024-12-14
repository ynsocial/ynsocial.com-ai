@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quotes</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.quotes.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create New Quote
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Quote #</th>
                                    <th>Customer</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Valid Until</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($quotes as $quote)
                                <tr>
                                    <td>{{ $quote->quote_number }}</td>
                                    <td>
                                        {{ $quote->customer->name }}
                                        <small class="d-block text-muted">{{ $quote->customer->company_name }}</small>
                                    </td>
                                    <td>{{ $quote->formatted_total }}</td>
                                    <td>
                                        <span class="badge badge-{{ $quote->status === 'accepted' ? 'success' : ($quote->status === 'sent' ? 'info' : 'secondary') }}">
                                            {{ ucfirst($quote->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $quote->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $quote->valid_until?->format('Y-m-d') ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.quotes.edit', $quote) }}" 
                                               class="btn btn-sm btn-info" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.quotes.preview', $quote) }}" 
                                               class="btn btn-sm btn-secondary" 
                                               title="Preview PDF" 
                                               target="_blank">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                            @if($quote->status === 'draft')
                                            <a href="{{ route('admin.quotes.send', $quote) }}" 
                                               class="btn btn-sm btn-success" 
                                               title="Send to Customer"
                                               onclick="return confirm('Are you sure you want to send this quote to the customer?')">
                                                <i class="fas fa-paper-plane"></i>
                                            </a>
                                            @endif
                                            <a href="{{ route('admin.quotes.duplicate', $quote) }}" 
                                               class="btn btn-sm btn-warning" 
                                               title="Duplicate">
                                                <i class="fas fa-copy"></i>
                                            </a>
                                            <form action="{{ route('admin.quotes.destroy', $quote) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger" 
                                                        title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this quote?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No quotes found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $quotes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table td {
        vertical-align: middle;
    }
    .btn-group {
        gap: 5px;
    }
</style>
@endpush
