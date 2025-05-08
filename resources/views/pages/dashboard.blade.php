@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tableau de bord</h1>
            </div>

            <!-- Filtres -->
            <div class="row mb-4">
                <div class="col-12">
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="input-group w-25">
                            <select class="form-control" name="period">
                                <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>Aujourd'hui</option>
                                <option value="7days" {{ request('period') == '7days' ? 'selected' : '' }}>7 Jours</option>
                                <option value="30days" {{ request('period') == '30days' ? 'selected' : '' }}>30 Jours</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary">Filtrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cartes de statistiques -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="{{ route('customer.index') }}">
                            <div class="card-icon bg-primary"><i class="far fa-user"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Total Clients</h4></div>
                                <div class="card-body">{{ $totalCustomers }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="{{ route('order.index') }}">
                            <div class="card-icon bg-danger"><i class="fas fa-shopping-cart"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Commandes Aujourd'hui</h4></div>
                                <div class="card-body">{{ $ordersToday }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="{{ route('order.index') }}">
                            <div class="card-icon bg-warning"><i class="fas fa-dollar-sign"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Chiffre d'Affaires Aujourd'hui</h4></div>
                                <div class="card-body">{{ number_format($revenueToday, 2) }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="{{ route('reservation.index') }}">
                            <div class="card-icon bg-success"><i class="fas fa-calendar"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Réservations à Venir</h4></div>
                                <div class="card-body">{{ $upcomingReservations }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="{{ route('inventory.index') }}">
                            <div class="card-icon bg-info"><i class="fas fa-box"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Stock Bas</h4></div>
                                <div class="card-body">{{ $lowStockItems->count() }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="{{ route('discount.index') }}">
                            <div class="card-icon bg-secondary"><i class="fas fa-tag"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Réductions Actives</h4></div>
                                <div class="card-body">{{ $activeDiscounts }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header"><h4>Ventes</h4></div>
                        <div class="card-body"><canvas id="salesChart" height="200"></canvas></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header"><h4>Répartition des Commandes</h4></div>
                        <div class="card-body"><canvas id="orderStatusChart" height="200"></canvas></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header"><h4>État de l'Inventaire</h4></div>
                        <div class="card-body"><canvas id="inventoryChart" height="200"></canvas></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header"><h4>Réservations par Période</h4></div>
                        <div class="card-body"><canvas id="reservationChart" height="200"></canvas></div>
                    </div>
                </div>
            </div>

            <!-- Activités récentes -->
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header"><h4>Dernières Commandes</h4></div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @forelse($lastOrders as $order)
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="float-right">{{ $order->transaction_time }}</div> <!-- transaction_time est varchar -->
                                            <div class="media-title">{{ $order->customer->name ?? 'Client non enregistré' }}</div>
                                            <span class="text-small text-muted">Total: {{ number_format($order->payment_amount, 2) }}</span>
                                        </div>
                                    </li>
                                @empty
                                    <li>Aucune commande récente.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header"><h4>Réservations à Venir</h4></div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @forelse($upcomingReservationsList as $reservation)
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="float-right">{{ $reservation->reservation_date->format('Y-m-d H:i') }}</div>
                                            <div class="media-title">{{ $reservation->customer_name ?? 'N/A' }}</div>
                                            <span class="text-small text-muted">Table: {{ $reservation->table_number ?? 'N/A' }}</span>
                                        </div>
                                    </li>
                                @empty
                                    <li>Aucune réservation à venir.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alertes -->
            <div class="row">
                <div class="col-12">
                    @if($readyOrders->count() > 0)
                        <div class="alert alert-success">
                            Il y a {{ $readyOrders->count() }} commande(s) prête(s).
                        </div>
                    @endif
                    @if($lowStockItems->count() > 0)
                        <div class="alert alert-danger">
                            Il y a {{ $lowStockItems->count() }} article(s) avec un stock bas.
                        </div>
                    @endif
                    @if($expiringDiscounts > 0)
                        <div class="alert alert-info">
                            Il y a {{ $expiringDiscounts }} réduction(s) expirant dans les 7 jours.
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script>
        // Graphique des ventes
        var salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: @json($salesDates),
                datasets: [{
                    label: 'Ventes Quotidiennes',
                    data: @json($salesTotals),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true },
                    x: { ticks: { autoSkip: true, maxTicksLimit: 10 } }
                }
            }
        });

        // Graphique de répartition des commandes
        var orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
        new Chart(orderStatusCtx, {
            type: 'doughnut',
            data: {
                labels: @json($orderStatusLabels),
                datasets: [{
                    data: @json($orderStatusCounts),
                    backgroundColor: ['#36b9cc', '#f6c23e'] // 2 couleurs pour ready/preparation
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Graphique de l'inventaire
        var inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
        new Chart(inventoryCtx, {
            type: 'bar',
            data: {
                labels: @json($inventoryNames),
                datasets: [{
                    label: 'Stock',
                    data: @json($inventoryStocks),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: { x: { beginAtZero: true } }
            }
        });

        // Graphique des réservations
        var reservationCtx = document.getElementById('reservationChart').getContext('2d');
        new Chart(reservationCtx, {
            type: 'bar',
            data: {
                labels: @json($reservationDates),
                datasets: [{
                    label: 'Réservations',
                    data: @json($reservationCounts),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true },
                    x: { ticks: { autoSkip: true, maxTicksLimit: 10 } }
                }
            }
        });
    </script>
@endpush