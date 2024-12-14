@extends('admin.layouts.app')

@section('content')
<div class="container-fluid" x-data="quoteBuilder">
    <form action="{{ isset($quote) ? route('admin.quotes.update', $quote) : route('admin.quotes.store') }}" 
          method="POST" 
          @submit.prevent="submitForm">
        @csrf
        @if(isset($quote))
            @method('PUT')
        @endif

        <div class="row">
            <!-- Quote Builder -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($quote) ? 'Edit Quote' : 'Create Quote' }}</h3>
                    </div>
                    <div class="card-body">
                        <!-- Customer Selection -->
                        <div class="form-group">
                            <label>Customer</label>
                            <select name="customer_id" class="form-control select2" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" 
                                            {{ (isset($quote) && $quote->customer_id == $customer->id) ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->company_name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Services Builder -->
                        <div class="services-builder mt-4">
                            <h5>Services</h5>
                            <div class="services-list" 
                                 x-ref="servicesList"
                                 @drop="drop"
                                 @dragover.prevent>
                                <template x-for="(item, index) in items" :key="index">
                                    <div class="service-item card mb-3" 
                                         draggable="true"
                                         @dragstart="dragStart($event, index)"
                                         @dragend="dragEnd">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select x-model="item.service_id" 
                                                            class="form-control"
                                                            @change="updateServiceDetails(index)">
                                                        <option value="">Select Service</option>
                                                        @foreach($services as $service)
                                                            <option value="{{ $service->id }}"
                                                                    data-price="{{ $service->base_price }}"
                                                                    data-description="{{ $service->description }}">
                                                                {{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" 
                                                           x-model="item.quantity" 
                                                           class="form-control" 
                                                           min="1" 
                                                           placeholder="Qty">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" 
                                                           x-model="item.price" 
                                                           class="form-control" 
                                                           step="0.01" 
                                                           placeholder="Price">
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" 
                                                            class="btn btn-danger btn-sm"
                                                            @click="removeItem(index)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <textarea x-model="item.description" 
                                                              class="form-control" 
                                                              rows="2" 
                                                              placeholder="Description"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div x-show="item.custom_features" 
                                                         class="custom-features">
                                                        <template x-for="(feature, featureIndex) in item.custom_features" 
                                                                  :key="featureIndex">
                                                            <div class="feature-item mb-2">
                                                                <div class="input-group">
                                                                    <input type="text" 
                                                                           x-model="feature.text" 
                                                                           class="form-control" 
                                                                           placeholder="Feature">
                                                                    <div class="input-group-append">
                                                                        <button type="button" 
                                                                                class="btn btn-danger"
                                                                                @click="removeFeature(index, featureIndex)">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-primary"
                                                            @click="addFeature(index)">
                                                        <i class="fas fa-plus"></i> Add Feature
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <button type="button" 
                                    class="btn btn-success mt-3"
                                    @click="addItem">
                                <i class="fas fa-plus"></i> Add Service
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quote Settings -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quote Settings</h3>
                    </div>
                    <div class="card-body">
                        <!-- Template Selection -->
                        <div class="form-group">
                            <label>Template</label>
                            <select name="template" 
                                    x-model="template" 
                                    class="form-control">
                                @foreach($templates as $key => $template)
                                    <option value="{{ $key }}">{{ $template['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Branding Options -->
                        <div class="form-group">
                            <label>Primary Color</label>
                            <input type="color" 
                                   x-model="brandingOptions.primary_color" 
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Secondary Color</label>
                            <input type="color" 
                                   x-model="brandingOptions.secondary_color" 
                                   class="form-control">
                        </div>

                        <!-- Valid Until -->
                        <div class="form-group">
                            <label>Valid Until</label>
                            <input type="date" 
                                   name="valid_until" 
                                   class="form-control"
                                   :min="today"
                                   value="{{ isset($quote) ? $quote->valid_until?->format('Y-m-d') : '' }}">
                        </div>

                        <!-- Notes -->
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="notes" 
                                      class="form-control" 
                                      rows="3">{{ isset($quote) ? $quote->notes : '' }}</textarea>
                        </div>

                        <!-- Terms -->
                        <div class="form-group">
                            <label>Terms</label>
                            <textarea name="terms" 
                                      class="form-control" 
                                      rows="3">{{ isset($quote) ? $quote->terms : '' }}</textarea>
                        </div>

                        @if(isset($quote))
                        <!-- Status -->
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="draft" {{ $quote->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="sent" {{ $quote->status === 'sent' ? 'selected' : '' }}>Sent</option>
                                <option value="accepted" {{ $quote->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $quote->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        @endif

                        <!-- Summary -->
                        <div class="quote-summary mt-4">
                            <h5>Summary</h5>
                            <table class="table">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td x-text="formatCurrency(subtotal)"></td>
                                </tr>
                                <tr>
                                    <th>Discount:</th>
                                    <td>
                                        <input type="number" 
                                               x-model="discount" 
                                               class="form-control form-control-sm" 
                                               step="0.01" 
                                               min="0">
                                    </td>
                                </tr>
                                <tr class="font-weight-bold">
                                    <th>Total:</th>
                                    <td x-text="formatCurrency(total)"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card mt-3">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> {{ isset($quote) ? 'Update' : 'Create' }} Quote
                        </button>
                        @if(isset($quote))
                            <a href="{{ route('admin.quotes.preview', $quote) }}" 
                               class="btn btn-secondary btn-block mt-2" 
                               target="_blank">
                                <i class="fas fa-eye"></i> Preview PDF
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .service-item {
        cursor: move;
    }
    .service-item.dragging {
        opacity: 0.5;
    }
    .custom-features {
        margin-top: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 4px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('quoteBuilder', () => ({
        items: @json(isset($quote) ? $quote->items : []),
        template: @json(isset($quote) ? $quote->template : 'default'),
        brandingOptions: @json(isset($quote) ? $quote->branding_options : $brandingDefaults),
        discount: @json(isset($quote) ? $quote->discount_amount : 0),
        draggingIndex: null,

        init() {
            this.initializeSelect2();
            if (!this.items.length) {
                this.addItem();
            }
        },

        addItem() {
            this.items.push({
                service_id: '',
                quantity: 1,
                price: 0,
                description: '',
                custom_features: [],
                sort_order: this.items.length
            });
        },

        removeItem(index) {
            this.items.splice(index, 1);
        },

        addFeature(itemIndex) {
            if (!this.items[itemIndex].custom_features) {
                this.items[itemIndex].custom_features = [];
            }
            this.items[itemIndex].custom_features.push({ text: '' });
        },

        removeFeature(itemIndex, featureIndex) {
            this.items[itemIndex].custom_features.splice(featureIndex, 1);
        },

        updateServiceDetails(index) {
            const serviceId = this.items[index].service_id;
            const option = document.querySelector(`option[value="${serviceId}"]`);
            if (option) {
                this.items[index].price = parseFloat(option.dataset.price);
                this.items[index].description = option.dataset.description;
            }
        },

        dragStart(event, index) {
            this.draggingIndex = index;
            event.target.classList.add('dragging');
        },

        dragEnd(event) {
            event.target.classList.remove('dragging');
            this.draggingIndex = null;
        },

        drop(event) {
            event.preventDefault();
            const dropIndex = [...this.$refs.servicesList.children].indexOf(event.target.closest('.service-item'));
            if (dropIndex !== -1 && this.draggingIndex !== null) {
                const item = this.items[this.draggingIndex];
                this.items.splice(this.draggingIndex, 1);
                this.items.splice(dropIndex, 0, item);
                this.updateSortOrder();
            }
        },

        updateSortOrder() {
            this.items.forEach((item, index) => {
                item.sort_order = index;
            });
        },

        get subtotal() {
            return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        },

        get total() {
            return this.subtotal - this.discount;
        },

        formatCurrency(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(amount);
        },

        get today() {
            return new Date().toISOString().split('T')[0];
        },

        initializeSelect2() {
            $(document).ready(() => {
                $('.select2').select2();
            });
        },

        async submitForm(event) {
            const form = event.target;
            const formData = new FormData(form);
            
            // Add items data
            formData.append('items', JSON.stringify(this.items));
            formData.append('branding_options', JSON.stringify(this.brandingOptions));
            
            try {
                const response = await fetch(form.action, {
                    method: form.method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    window.location.href = response.url;
                } else {
                    const data = await response.json();
                    alert(data.message || 'An error occurred while saving the quote.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while saving the quote.');
            }
        }
    }));
});
</script>
@endpush
