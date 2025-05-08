<?php $__env->startSection('title', 'Modifier la Commande'); ?>

<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('library/select2/dist/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/selectric/public/selectric.css')); ?>">
    <style>
        .item-row { margin-bottom: 15px; }
        .select2-container { width: 100% !important; }
        .total-amount { font-size: 1.2em; font-weight: bold; }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Modifier la Commande #<?php echo e($order->id); ?></h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="<?php echo e(route('order.index')); ?>">Commandes</a></div>
                    <div class="breadcrumb-item">Modifier</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                <div class="card">
                    <form action="<?php echo e(route('order.update', $order->id)); ?>" method="POST" id="orderForm">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="card-header">
                            <h4>Modifier la commande</h4>
                        </div>
                        <div class="card-body">
                            <!-- Client -->
                            <div class="form-group">
                                <label>Client</label>
                                <select name="id_customer" class="form-control select2 <?php $__errorArgs = ['id_customer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Sélectionnez un client --</option>
                                    <?php $__currentLoopData = \App\Models\Customer::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($customer->id); ?>" <?php echo e($order->id_customer == $customer->id ? 'selected' : ''); ?>>
                                            <?php echo e($customer->name); ?> (<?php echo e($customer->phone_number ?? 'N/A'); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['id_customer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Type de commande -->
                            <div class="form-group">
                                <label>Type de commande</label>
                                <select name="order_type" class="form-control selectric <?php $__errorArgs = ['order_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="dinein" <?php echo e($order->order_type == 'dinein' ? 'selected' : ''); ?>>Sur place</option>
                                    <option value="takeaway" <?php echo e($order->order_type == 'takeaway' ? 'selected' : ''); ?>>À emporter</option>
                                    <option value="reservation" <?php echo e($order->order_type == 'reservation' ? 'selected' : ''); ?>>Réservation</option>
                                </select>
                                <?php $__errorArgs = ['order_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Statut -->
                            <div class="form-group">
                                <label>Statut</label>
                                <select name="status" class="form-control selectric <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>En attente</option>
                                    <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>Terminée</option>
                                    <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Annulée</option>
                                </select>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Montants -->
                            <div class="form-group">
                                <label>Sous-total</label>
                                <input type="number" name="sub_total" class="form-control" id="sub_total" value="<?php echo e($order->sub_total); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Taxe</label>
                                <input type="number" name="tax" class="form-control" value="<?php echo e($order->tax); ?>" onchange="calculateTotal()">
                            </div>
                            <div class="form-group">
                                <label>Réduction</label>
                                <input type="number" name="discount" class="form-control" value="<?php echo e($order->discount); ?>" onchange="calculateTotal()">
                            </div>
                            <div class="form-group">
                                <label>Frais de service</label>
                                <input type="number" name="service_charge" class="form-control" value="<?php echo e($order->service_charge); ?>" onchange="calculateTotal()">
                            </div>
                            <div class="form-group">
                                <label>Total</label>
                                <input type="number" name="payment_amount" class="form-control total-amount" id="payment_amount" value="<?php echo e($order->payment_amount); ?>" readonly>
                            </div>

                            <!-- Méthode de paiement -->
                            <div class="form-group">
                                <label>Méthode de paiement</label>
                                <select name="payment_method" class="form-control selectric <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="especes" <?php echo e($order->payment_method == 1 ? 'selected' : ''); ?>>Espèces</option>
                                    <option value="carte" <?php echo e($order->payment_method == 2 ? 'selected' : ''); ?>>Carte</option>
                                </select>
                                <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo e(route('order.index')); ?>'">Annuler</button>
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <!-- JS Libraries -->
    <script src="<?php echo e(asset('library/select2/dist/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/selectric/public/jquery.selectric.min.js')); ?>"></script>

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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fustimolnarpatrick/laravel-coffeshop/resources/views/pages/order/edit.blade.php ENDPATH**/ ?>