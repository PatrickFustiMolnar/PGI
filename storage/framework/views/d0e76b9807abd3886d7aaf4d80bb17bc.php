<?php $__env->startSection('title', 'Nouvelle Commande'); ?>

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
                <h1>Nouvelle Commande</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="<?php echo e(route('order.index')); ?>">Commandes</a></div>
                    <div class="breadcrumb-item">Ajouter</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                <div class="card">
                    <form action="<?php echo e(route('order.store')); ?>" method="POST" id="orderForm">
                        <?php echo csrf_field(); ?>
                        <div class="card-header">
                            <h4>Ajouter une commande</h4>
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
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?> (<?php echo e($customer->phone_number ?? 'N/A'); ?>)</option>
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
                                    <option value="dinein">Sur place</option>
                                    <option value="takeaway">À emporter</option>
                                    <option value="reservation">Réservation</option>
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

                            <!-- Articles -->
                            <div class="form-group">
                                <label>Articles</label>
                                <div id="items-container">
                                    <div class="item-row row">
                                        <div class="col-md-6">
                                            <select name="items[0][id_product]" class="form-control select2 product-select" onchange="updatePrice(this)">
                                                <option value="">-- Sélectionnez un produit --</option>
                                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($product->id); ?>" data-price="<?php echo e($product->price); ?>"><?php echo e($product->name); ?> (<?php echo e($product->price); ?> €)</option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <select name="payment_method" class="form-control selectric <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="1">Espèces</option>
                                    <option value="2">Carte</option>
                                    <option value="3">Mobile</option>
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
                            <button type="submit" class="btn btn-primary">Créer la commande</button>
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
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($product->id); ?>" data-price="<?php echo e($product->price); ?>"><?php echo e($product->name); ?> (<?php echo e($product->price); ?> €)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fustimolnarpatrick/laravel-coffeshop/resources/views/pages/order/create.blade.php ENDPATH**/ ?>