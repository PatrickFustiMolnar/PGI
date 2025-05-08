<?php $__env->startSection('title', 'Edit Discount'); ?>

<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('library/bootstrap-daterangepicker/daterangepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/select2/dist/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/selectric/public/selectric.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Mettre à jour</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="<?php echo e(route('discount.index')); ?>">Réductions</a></div>
                    <div class="breadcrumb-item">Modifier une réduction</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Réduction</h2>

                <form action="<?php echo e(route('discount.update', $discount->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($discount->name); ?>">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"><?php echo e($discount->description); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="fixed" <?php echo e($discount->type == 'fixed' ? 'selected' : ''); ?>>Fixe</option>
                            <option value="percentage" <?php echo e($discount->type == 'percentage' ? 'selected' : ''); ?>>Pourcentage</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="value">Valeur</label>
                        <input type="text" class="form-control" id="value" name="value" value="<?php echo e($discount->value); ?>">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" <?php echo e($discount->status == 'active' ? 'selected' : ''); ?>>Active</option>
                            <option value="inactive" <?php echo e($discount->status == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="expired_date">Date d'expiration</label>
                        <input type="date" class="form-control" id="expired_date" name="expired_date" value="<?php echo e($discount->expired_date); ?>">
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo e(url()->previous()); ?>'">Annuler</button>
                        <button class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fustimolnarpatrick/laravel-coffeshop/resources/views/pages/discount/edit.blade.php ENDPATH**/ ?>