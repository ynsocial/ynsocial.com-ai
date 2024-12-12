@extends('layouts.app')

@section('content')
<div class="container" x-data="quoteViewer">
    <!-- Quote Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-4">Quote #{{ $quote->quote_number }}</h1>
            <p class="text-muted">
                Created on {{ $quote->created_at->format('F j, Y') }}
                @if($quote->valid_until)
                    · Valid until {{ $quote->valid_until->format('F j, Y') }}
                @endif
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            <div class="btn-group">
                <a href="{{ route('quotes.download', $quote->unique_url) }}" 
                   class="btn btn-outline-primary">
                    <i class="fas fa-download"></i> Download PDF
                </a>
                <button class="btn btn-outline-secondary" 
                        @click="showActivity = !showActivity">
                    <i class="fas fa-history"></i> Activity Log
                </button>
            </div>
        </div>
    </div>

    <!-- Quote Status -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-{{ $quote->status === 'accepted' ? 'success' : ($quote->status === 'sent' ? 'info' : 'secondary') }}">
                <h4 class="alert-heading">
                    Status: {{ ucfirst($quote->status) }}
                </h4>
                <p class="mb-0">
                    @switch($quote->status)
                        @case('draft')
                            This quote is currently in draft status.
                            @break
                        @case('sent')
                            Please review this quote and provide your feedback.
                            @break
                        @case('accepted')
                            Quote has been approved on {{ $quote->activities->where('activity_type', 'accepted')->first()->created_at->format('F j, Y') }}.
                            @break
                        @case('rejected')
                            Quote was declined on {{ $quote->activities->where('activity_type', 'rejected')->first()->created_at->format('F j, Y') }}.
                            @break
                        @default
                            Current status: {{ ucfirst($quote->status) }}
                    @endswitch
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Quote Details -->
        <div class="col-md-8">
            <!-- Services -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Services</h3>
                </div>
                <div class="card-body p-0">
                    @foreach($quote->items as $item)
                        <div class="service-item p-4 border-bottom">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h4>{{ $item->name }}</h4>
                                    <p class="text-muted">{{ $item->description }}</p>
                                </div>
                                <div class="text-end">
                                    <h4 class="text-primary">{{ number_format($item->price, 2) }} {{ $quote->currency }}</h4>
                                    <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                </div>
                            </div>
                            @if($item->custom_features)
                                <div class="mt-3">
                                    <ul class="list-unstyled">
                                        @foreach($item->custom_features as $feature)
                                            <li>
                                                <i class="fas fa-check text-success me-2"></i>
                                                {{ $feature['text'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Notes & Terms -->
            @if($quote->notes || $quote->terms)
                <div class="card mb-4">
                    @if($quote->notes)
                        <div class="card-body">
                            <h5>Notes</h5>
                            <p>{{ $quote->notes }}</p>
                        </div>
                    @endif
                    @if($quote->terms)
                        <div class="card-body border-top">
                            <h5>Terms & Conditions</h5>
                            <p>{{ $quote->terms }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Total Summary -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Summary</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>{{ number_format($quote->total_amount, 2) }} {{ $quote->currency }}</span>
                    </div>
                    @if($quote->discount_amount > 0)
                        <div class="d-flex justify-content-between mb-2">
                            <span>Discount:</span>
                            <span class="text-success">
                                -{{ number_format($quote->discount_amount, 2) }} {{ $quote->currency }}
                            </span>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between border-top pt-2 mt-2">
                        <strong>Total:</strong>
                        <strong class="text-primary">
                            {{ number_format($quote->final_total, 2) }} {{ $quote->currency }}
                        </strong>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            @if($quote->status === 'sent')
                <div class="card mb-4">
                    <div class="card-body">
                        <button class="btn btn-success btn-lg w-100 mb-3" 
                                @click="showApproveModal = true">
                            <i class="fas fa-check"></i> Approve Quote
                        </button>
                        <button class="btn btn-warning btn-lg w-100 mb-3" 
                                @click="showChangeRequestModal = true">
                            <i class="fas fa-edit"></i> Request Changes
                        </button>
                        <button class="btn btn-danger btn-lg w-100" 
                                @click="showDeclineModal = true">
                            <i class="fas fa-times"></i> Decline Quote
                        </button>
                    </div>
                </div>
            @endif

            <!-- Activity Log -->
            <div class="card" 
                 x-show="showActivity" 
                 x-transition>
                <div class="card-header">
                    <h3 class="card-title">Activity Log</h3>
                </div>
                <div class="card-body p-0">
                    <template x-for="activity in activities" :key="activity.id">
                        <div class="p-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <span x-text="activity.description"></span>
                                <small class="text-muted" x-text="activity.time"></small>
                            </div>
                            <template x-if="activity.data && activity.data.comment">
                                <p class="text-muted mb-0 mt-1" x-text="activity.data.comment"></p>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Approve Modal -->
    <div class="modal fade" 
         id="approveModal" 
         tabindex="-1" 
         x-show="showApproveModal" 
         @click.away="showApproveModal = false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('quotes.approve', $quote->unique_url) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Approve Quote</h5>
                        <button type="button" class="btn-close" @click="showApproveModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Additional Comments (Optional)</label>
                            <textarea name="comment" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showApproveModal = false">Cancel</button>
                        <button type="submit" class="btn btn-success">Approve Quote</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Request Modal -->
    <div class="modal fade" 
         id="changeRequestModal" 
         tabindex="-1" 
         x-show="showChangeRequestModal" 
         @click.away="showChangeRequestModal = false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('quotes.request-changes', $quote->unique_url) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Request Changes</h5>
                        <button type="button" class="btn-close" @click="showChangeRequestModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Please describe the changes you'd like to request</label>
                            <textarea name="change_request" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showChangeRequestModal = false">Cancel</button>
                        <button type="submit" class="btn btn-warning">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Decline Modal -->
    <div class="modal fade" 
         id="declineModal" 
         tabindex="-1" 
         x-show="showDeclineModal" 
         @click.away="showDeclineModal = false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('quotes.decline', $quote->unique_url) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Decline Quote</h5>
                        <button type="button" class="btn-close" @click="showDeclineModal = false"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Please provide a reason for declining</label>
                            <textarea name="reason" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showDeclineModal = false">Cancel</button>
                        <button type="submit" class="btn btn-danger">Decline Quote</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('quoteViewer', () => ({
        showActivity: false,
        showApproveModal: false,
        showChangeRequestModal: false,
        showDeclineModal: false,
        activities: [],

        init() {
            this.loadActivities();
        },

        async loadActivities() {
            try {
                const response = await fetch('{{ route("quotes.activity", $quote->unique_url) }}');
                const data = await response.json();
                this.activities = data.activities;
            } catch (error) {
                console.error('Error loading activities:', error);
            }
        }
    }));
});
</script>
@endpush

@push('styles')
<style>
.service-item:last-child {
    border-bottom: none !important;
}
.activity-log {
    max-height: 400px;
    overflow-y: auto;
}
</style>
@endpush
