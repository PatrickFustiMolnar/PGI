<?php $__env->startSection('title', 'Commandes'); ?>

<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('library/selectric/public/selectric.css')); ?>">
    <style>
        .modal-body ul { list-style: none; padding: 0; }
        .modal-body ul li { margin-bottom: 10px; }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Commandes</h1>
                <div class="section-header-button">
                    <a href="<?php echo e(route('order.create')); ?>" class="btn btn-primary">Nouvelle Commande</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="<?php echo e(route('order.index')); ?>">Commandes</a></div>
                    <div class="breadcrumb-item">Toutes les commandes</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                    <form method="GET" action="<?php echo e(route('order.index')); ?>" class="form-inline">
                                        <select name="type" class="form-control selectric mr-2">
                                            <option value="">Tous les types</option>
                                            <option value="dinein" <?php echo e(request('type') == 'dinein' ? 'selected' : ''); ?>>Sur place</option>
                                            <option value="reservation" <?php echo e(request('type') == 'reservation' ? 'selected' : ''); ?>>Réservation</option>
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
                                            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><input type="checkbox" name="selected[]" value="<?php echo e($order->id); ?>"></td>
                                                    <td><?php echo e(\Carbon\Carbon::parse($order->transaction_time)->format('Y-m-d H:i')); ?></td>
                                                    <td><?php echo e(ucfirst($order->order_type ?? 'N/A')); ?></td>
                                                    <td><?php echo e(number_format($order->sub_total, 2)); ?></td>
                                                    <td><?php echo e(number_format($order->tax, 2)); ?></td>
                                                    <td><?php echo e(number_format($order->discount, 2)); ?></td>
                                                    <td><?php echo e(number_format($order->payment_amount, 2)); ?></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <button class="btn btn-sm btn-info btn-icon mr-1" data-toggle="modal" data-target="#orderModal<?php echo e($order->id); ?>">
                                                                <i class="fas fa-eye"></i> Détails
                                                            </button>
                                                            <a href="<?php echo e(route('order.edit', $order->id)); ?>" class="btn btn-sm btn-warning btn-icon mr-1">
                                                                <i class="fas fa-edit"></i> Modifier
                                                            </a>
                                                            <form action="<?php echo e(route('order.destroy', $order->id)); ?>" method="POST" class="d-inline">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                    <i class="fas fa-times"></i> Supprimer
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modal pour les détails -->
                                                <div class="modal fade" id="orderModal<?php echo e($order->id); ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Détails de la commande #<?php echo e($order->id); ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Date:</strong> <?php echo e($order->transaction_time); ?></p>
                                                                <p><strong>Type:</strong> <?php echo e(ucfirst($order->order_type ?? 'N/A')); ?></p>
                                                                <p><strong>Sous-total:</strong> <?php echo e(number_format($order->sub_total, 2)); ?></p>
                                                                <p><strong>Taxe:</strong> <?php echo e(number_format($order->tax, 2)); ?></p>
                                                                <p><strong>Réduction:</strong> <?php echo e(number_format($order->discount, 2)); ?></p>
                                                                <p><strong>Total:</strong> <?php echo e(number_format($order->payment_amount, 2)); ?></p>
                                                                <!-- Placeholder pour les items, à activer une fois la table order_items ajoutée -->
                                                                <!-- <h6>Articles :</h6><ul><li>Non disponible pour l'instant</li></ul> -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">Aucune commande trouvée.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    <?php echo e($orders->withQueryString()->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <!-- JS Libraries -->
    <script src="<?php echo e(asset('library/selectric/public/jquery.selectric.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/page/features-posts.js')); ?>"></script>

    <!-- Script pour sélectionner tout -->
    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            let checkboxes = document.querySelectorAll('input[name="selected[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fustimolnarpatrick/laravel-coffeshop/resources/views/pages/order/index.blade.php ENDPATH**/ ?>