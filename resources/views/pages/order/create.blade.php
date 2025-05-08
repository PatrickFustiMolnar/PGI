@extends('layouts.app')

@section('title', 'Nouvelle Commande')

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
                <h1>Nouvelle Commande</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('order.index') }}">Commandes</a></div>
                    <div class="breadcrumb-item">Ajouter</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="card">
                    <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                        @csrf
                        <div class="card-header">
                            <h4>Ajouter une commande</h4>
                        </div>
                        <div class="card-body">
                            <!-- Client -->
                            <div class="form-group">
                                <label>Client</label>
                                <select name="id_customer" class="form-control select2 @error('id_customer') is-invalid @enderror">
                                    <option value="">-- Sélectionnez un client --</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->phone_number ?? 'N/A' }})</option>
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
                                    <option value="dinein">Sur place</option>
                                    <option value="takeaway">À emporter</option>
                                    <option value="reservation">Réservation</option>
                                </select>
                                @error('order_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Articles -->
                            <div class="form-group">
                                <label>Articles</label>
                                <div id="items-container">
                                    <div class="item-row row">
                                        <div class="col-md-6">
                                            <select name="items[0][id_product]" class="form-control select2 product-select" onchange="updatePrice(this)">
                                                <option value="">-- Sélectionnez un produit --</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} ({{ $product->price }} €)</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" name="items[0][quantity]" class="form-control quantity" min="1" value="1" onchange="calculateTotal()">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" name="items[0][price]" class="form-control price" readonly>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" onclick="addItem()">Ajouter un article</button>
                            </div>

                            <!-- Montants -->
                            <div class="form-group">
                                <label>Sous-total</label>
                                <input type="number" name="sub_total" class="form-control" id="sub_total" readonly>
                            </div>
                            <div class="form-group">
                                <label>Taxe</label>
                                <input type="number" name="tax" class="form-control" value="0" onchange="calculateTotal()">
                            </div>
                            <div class="form-group">
                                <label>Réduction</label>
                                <input type="number" name="discount" class="form-control" value="0" onchange="calculateTotal()">
                            </div>
                            <div class="form-group">
                                <label>Frais de service</label>
                                <input type="number" name="service_charge" class="form-control" value="0" onchange="calculateTotal()">
                            </div>
                            <div class="form-group">
                                <label>Total</label>
                                <input type="number" name="payment_amount" class="form-control total-amount" id="payment_amount" readonly>
                            </div>

                            <!-- Méthode de paiement -->
                            <div class="form-group">
                                <label>Méthode de paiement</label>
                                <select name="payment_method" class="form-control selectric @error('payment_method') is-invalid @enderror">
                                    <option value="1">Espèces</option>
                                    <option value="2">Carte</option>
                                    <option value="3">Mobile</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('order.index') }}'">Annuler</button>
                            <button type="submit" class="btn btn-primary">Créer la commande</button>
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
        let itemCount = 1;

        // Initialisation de Select2
        $(document).ready(function() {
            $('.select2').select2();
            calculateTotal();
        });

        // Ajouter un nouvel article
        function addItem() {
            const container = document.getElementById('items-container');
            const newRow = `
                <div class="item-row row" id="item-${itemCount}">
                    <div class="col-md-6">
                        <select name="items[${itemCount}][id_product]" class="form-control select2 product-select" onchange="updatePrice(this)">
                            <option value="">-- Sélectionnez un produit --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} ({{ $product->price }} €)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="items[${itemCount}][quantity]" class="form-control quantity" min="1" value="1" onchange="calculateTotal()">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="items[${itemCount}][price]" class="form-control price" readonly>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger" onclick="removeItem(${itemCount})"><i class="fas fa-trash"></i></button>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', newRow);
            $(`#item-${itemCount} .select2`).select2();
            itemCount++;
        }

        // Supprimer un article
        function removeItem(index) {
            document.getElementById(`item-${index}`).remove();
            calculateTotal();
        }

        // Mettre à jour le prix d’un article
        function updatePrice(select) {
            const price = select.options[select.selectedIndex].getAttribute('data-price') || 0;
            const row = select.closest('.item-row');
            const quantity = row.querySelector('.quantity').value;
            row.querySelector('.price').value = price * quantity;
            calculateTotal();
        }

        // Calculer le total
        function calculateTotal() {
            let subTotal = 0;
            document.querySelectorAll('.price').forEach(input => {
                subTotal += parseFloat(input.value) || 0;
            });

            const tax = parseFloat(document.querySelector('input[name="tax"]').value) || 0;
            const discount = parseFloat(document.querySelector('input[name="discount"]').value) || 0;
            const serviceCharge = parseFloat(document.querySelector('input[name="service_charge"]').value) || 0;

            document.getElementById('sub_total').value = subTotal;
            const total = subTotal + tax + serviceCharge - discount;
            document.getElementById('payment_amount').value = total.toFixed(2);
        }
    </script>
@endpush