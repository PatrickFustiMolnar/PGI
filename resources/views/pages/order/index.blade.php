@extends('layouts.app')

@section('title', 'Commandes')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        .modal-body ul { list-style: none; padding: 0; }
        .modal-body ul li { margin-bottom: 10px; }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Commandes</h1>
                <div class="section-header-button">
                    <a href="{{ route('order.create') }}" class="btn btn-primary">Nouvelle Commande</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('order.index') }}">Commandes</a></div>
                    <div class="breadcrumb-item">Toutes les commandes</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Toutes les commandes</h4>
                            </div>
                            <div class="card-body">
                                <!-- Filtres -->
                                <div class="float-right mb-3">
                                    <form method="GET" action="{{ route('order.index') }}" class="form-inline">
                                        <select name="type" class="form-control selectric mr-2">
                                            <option value="">Tous les types</option>
                                            <option value="dinein" {{ request('type') == 'dinein' ? 'selected' : '' }}>Sur place</option>
                                            <option value="reservation" {{ request('type') == 'reservation' ? 'selected' : '' }}>Réservation</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select-all"></th>
                                                <th>Date de transaction</th>
                                                <th>Type</th>
                                                <th>Sous-total</th>
                                                <th>Taxe</th>
                                                <th>Réduction</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $order)
                                                <tr>
                                                    <td><input type="checkbox" name="selected[]" value="{{ $order->id }}"></td>
                                                    <td>{{ \Carbon\Carbon::parse($order->transaction_time)->format('Y-m-d H:i') }}</td>
                                                    <td>{{ ucfirst($order->order_type ?? 'N/A') }}</td>
                                                    <td>{{ number_format($order->sub_total, 2) }}</td>
                                                    <td>{{ number_format($order->tax, 2) }}</td>
                                                    <td>{{ number_format($order->discount, 2) }}</td>
                                                    <td>{{ number_format($order->payment_amount, 2) }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <button class="btn btn-sm btn-info btn-icon mr-1" data-toggle="modal" data-target="#orderModal{{ $order->id }}">
                                                                <i class="fas fa-eye"></i> Détails
                                                            </button>
                                                            <a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-warning btn-icon mr-1">
                                                                <i class="fas fa-edit"></i> Modifier
                                                            </a>
                                                            <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                    <i class="fas fa-times"></i> Supprimer
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modal pour les détails -->
                                                <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Détails de la commande #{{ $order->id }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Date:</strong> {{ $order->transaction_time }}</p>
                                                                <p><strong>Type:</strong> {{ ucfirst($order->order_type ?? 'N/A') }}</p>
                                                                <p><strong>Sous-total:</strong> {{ number_format($order->sub_total, 2) }}</p>
                                                                <p><strong>Taxe:</strong> {{ number_format($order->tax, 2) }}</p>
                                                                <p><strong>Réduction:</strong> {{ number_format($order->discount, 2) }}</p>
                                                                <p><strong>Total:</strong> {{ number_format($order->payment_amount, 2) }}</p>
                                                                <!-- Placeholder pour les items, à activer une fois la table order_items ajoutée -->
                                                                <!-- <h6>Articles :</h6><ul><li>Non disponible pour l'instant</li></ul> -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Aucune commande trouvée.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $orders->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>

    <!-- Script pour sélectionner tout -->
    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            let checkboxes = document.querySelectorAll('input[name="selected[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
@endpush