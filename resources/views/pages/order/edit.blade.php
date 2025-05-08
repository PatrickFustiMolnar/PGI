@extends('layouts.app')

@section('title', 'Modifier la Commande')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        .item-row { margin-bottom: 15px; }
        .select2-container { width: 100% !important; }
        .total-amount { font-size: 1.2em; font-weight: bold; }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Modifier la Commande #{{ $order->id }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('order.index') }}">Commandes</a></div>
                    <div class="breadcrumb-item">Modifier</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="card">
                    <form action="{{ route('order.update', $order->id) }}" method="POST" id="orderForm">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Modifier la commande</h4>
                        </div>
                        <div class="card-body">
                            <!-- Client -->
                            <div class="form-group">
                                <label>Client</label>
                                <select name="id_customer" class="form-control select2 @error('id_customer') is-invalid @enderror">
                                    <option value="">-- Sélectionnez un client --</option>
                                    @foreach (\App\Models\Customer::all() as $customer)
                                        <option value="{{ $customer->id }}" {{ $order->id_customer == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} ({{ $customer->phone_number ?? 'N/A' }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_customer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Type de commande -->
                            <div class="form-group">
                                <label>Type de commande</label>
                                <select name="order_type" class="form-control selectric @error('order_type') is-invalid @enderror">
                                    <option value="dinein" {{ $order->order_type == 'dinein' ? 'selected' : '' }}>Sur place</option>
                                    <option value="takeaway" {{ $order->order_type == 'takeaway' ? 'selected' : '' }}>À emporter</option>
                                    <option value="reservation" {{ $order->order_type == 'reservation' ? 'selected' : '' }}>Réservation</option>
                                </select>
                                @error('order_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Statut -->
                            <div class="form-group">
                                <label>Statut</label>
                                <select name="status" class="form-control selectric @error('status') is-invalid @enderror">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Terminée</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Montants -->
                            <div class="form-group">
                                <label>Sous-total</label>
                                <input type="number" name="sub_total" class="form-control" id="sub_total" value="{{ $order->sub_total }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Taxe</label>
                                <input type="number" name="tax" class="form-control" value="{{ $order->tax }}" onchange="calculateTotal()">
                            </div>
                            <div class="form-group">
                                <label>Réduction</label>
                                <input type="number" name="discount" class="form-control" value="{{ $order->discount }}" onchange="calculateTotal()">
                            </div>
                            <div class="form-group">
                                <label>Frais de service</label>
                                <input type="number" name="service_charge" class="form-control" value="{{ $order->service_charge }}" onchange="calculateTotal()">
                            </div>
                            <div class="form-group">
                                <label>Total</label>
                                <input type="number" name="payment_amount" class="form-control total-amount" id="payment_amount" value="{{ $order->payment_amount }}" readonly>
                            </div>

                            <!-- Méthode de paiement -->
                            <div class="form-group">
                                <label>Méthode de paiement</label>
                                <select name="payment_method" class="form-control selectric @error('payment_method') is-invalid @enderror">
                                    <option value="especes" {{ $order->payment_method == 1 ? 'selected' : '' }}>Espèces</option>
                                    <option value="carte" {{ $order->payment_method == 2 ? 'selected' : '' }}>Carte</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('order.index') }}'">Annuler</button>
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            calculateTotal();
        });

        function calculateTotal() {
            const subTotal = parseFloat(document.getElementById('sub_total').value) || 0;
            const tax = parseFloat(document.querySelector('input[name="tax"]').value) || 0;
            const discount = parseFloat(document.querySelector('input[name="discount"]').value) || 0;
            const serviceCharge = parseFloat(document.querySelector('input[name="service_charge"]').value) || 0;

            const total = subTotal + tax + serviceCharge - discount;
            document.getElementById('payment_amount').value = total.toFixed(2);
        }
    </script>
@endpush