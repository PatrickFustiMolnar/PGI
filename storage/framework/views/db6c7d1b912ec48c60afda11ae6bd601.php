<?php $__env->startSection('title', 'Customers'); ?>

<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('library/selectric/public/selectric.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Clients</h1>
                <div class="section-header-button">
                    <a href="<?php echo e(route('customer.create')); ?>" class="btn btn-primary">Ajouter</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="<?php echo e(route('customer.index')); ?>">Clients</a></div>
                    <div class="breadcrumb-item">Tous les clients</div>
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
                                <h4>Tous les clients</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="<?php echo e(route('customer.index')); ?>">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Rechercher" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($customer->name); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($customer->email); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($customer->phone_number); ?>

                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='<?php echo e(route('customer.edit', $customer->id)); ?>'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Modifier
                                                        </a>

                                                        <form action="<?php echo e(route('customer.destroy', $customer->id)); ?>"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="<?php echo e(csrf_token()); ?>" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Supprimer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    </table>
                                </div>
                                <div class="float-right">
                                    <?php echo e($customers->withQueryString()->links()); ?>

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
    <!-- JS Libraies -->
    <script src="<?php echo e(asset('library/selectric/public/jquery.selectric.min.js')); ?>"></script>

    <!-- Page Specific JS File -->
    <script src="<?php echo e(asset('js/page/features-posts.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fustimolnarpatrick/laravel-coffeshop/resources/views/pages/customer/index.blade.php ENDPATH**/ ?>