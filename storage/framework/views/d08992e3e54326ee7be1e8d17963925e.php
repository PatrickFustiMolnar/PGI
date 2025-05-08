<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('library/jqvmap/dist/jqvmap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/summernote/dist/summernote-bs4.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tableau de bord</h1>
            </div>

            <!-- Filtres -->
            <div class="row mb-4">
                <div class="col-12">
                    <form method="GET" action="<?php echo e(route('dashboard')); ?>">
                        <div class="input-group w-25">
                            <select class="form-control" name="period">
                                <option value="today" <?php echo e(request('period') == 'today' ? 'selected' : ''); ?>>Aujourd'hui</option>
                                <option value="7days" <?php echo e(request('period') == '7days' ? 'selected' : ''); ?>>7 Jours</option>
                                <option value="30days" <?php echo e(request('period') == '30days' ? 'selected' : ''); ?>>30 Jours</option>
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
                        <a href="<?php echo e(route('customer.index')); ?>">
                            <div class="card-icon bg-primary"><i class="far fa-user"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Total Clients</h4></div>
                                <div class="card-body"><?php echo e($totalCustomers); ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="<?php echo e(route('order.index')); ?>">
                            <div class="card-icon bg-danger"><i class="fas fa-shopping-cart"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Commandes Aujourd'hui</h4></div>
                                <div class="card-body"><?php echo e($ordersToday); ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="<?php echo e(route('order.index')); ?>">
                            <div class="card-icon bg-warning"><i class="fas fa-dollar-sign"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Chiffre d'Affaires Aujourd'hui</h4></div>
                                <div class="card-body"><?php echo e(number_format($revenueToday, 2)); ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="<?php echo e(route('reservation.index')); ?>">
                            <div class="card-icon bg-success"><i class="fas fa-calendar"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Réservations à Venir</h4></div>
                                <div class="card-body"><?php echo e($upcomingReservations); ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="<?php echo e(route('inventory.index')); ?>">
                            <div class="card-icon bg-info"><i class="fas fa-box"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Stock Bas</h4></div>
                                <div class="card-body"><?php echo e($lowStockItems->count()); ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <a href="<?php echo e(route('discount.index')); ?>">
                            <div class="card-icon bg-secondary"><i class="fas fa-tag"></i></div>
                            <div class="card-wrap">
                                <div class="card-header"><h4>Réductions Actives</h4></div>
                                <div class="card-body"><?php echo e($activeDiscounts); ?></div>
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
                                <?php $__empty_1 = true; $__currentLoopData = $lastOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="float-right"><?php echo e($order->transaction_time); ?></div> <!-- transaction_time est varchar -->
                                            <div class="media-title"><?php echo e($order->customer->name ?? 'Client non enregistré'); ?></div>
                                            <span class="text-small text-muted">Total: <?php echo e(number_format($order->payment_amount, 2)); ?></span>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li>Aucune commande récente.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header"><h4>Réservations à Venir</h4></div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                <?php $__empty_1 = true; $__currentLoopData = $upcomingReservationsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="float-right"><?php echo e($reservation->reservation_date->format('Y-m-d H:i')); ?></div>
                                            <div class="media-title"><?php echo e($reservation->customer_name ?? 'N/A'); ?></div>
                                            <span class="text-small text-muted">Table: <?php echo e($reservation->table_number ?? 'N/A'); ?></span>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li>Aucune réservation à venir.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alertes -->
            <div class="row">
                <div class="col-12">
                    <?php if($readyOrders->count() > 0): ?>
                        <div class="alert alert-success">
                            Il y a <?php echo e($readyOrders->count()); ?> commande(s) prête(s).
                        </div>
                    <?php endif; ?>
                    <?php if($lowStockItems->count() > 0): ?>
                        <div class="alert alert-danger">
                            Il y a <?php echo e($lowStockItems->count()); ?> article(s) avec un stock bas.
                        </div>
                    <?php endif; ?>
                    <?php if($expiringDiscounts > 0): ?>
                        <div class="alert alert-info">
                            Il y a <?php echo e($expiringDiscounts); ?> réduction(s) expirant dans les 7 jours.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('library/chart.js/dist/Chart.min.js')); ?>"></script>
    <script>
        // Graphique des ventes
        var salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($salesDates, 15, 512) ?>,
                datasets: [{
                    label: 'Ventes Quotidiennes',
                    data: <?php echo json_encode($salesTotals, 15, 512) ?>,
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
                labels: <?php echo json_encode($orderStatusLabels, 15, 512) ?>,
                datasets: [{
                    data: <?php echo json_encode($orderStatusCounts, 15, 512) ?>,
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
                labels: <?php echo json_encode($inventoryNames, 15, 512) ?>,
                datasets: [{
                    label: 'Stock',
                    data: <?php echo json_encode($inventoryStocks, 15, 512) ?>,
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
                labels: <?php echo json_encode($reservationDates, 15, 512) ?>,
                datasets: [{
                    label: 'Réservations',
                    data: <?php echo json_encode($reservationCounts, 15, 512) ?>,
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fustimolnarpatrick/laravel-coffeshop/resources/views/pages/dashboard.blade.php ENDPATH**/ ?>