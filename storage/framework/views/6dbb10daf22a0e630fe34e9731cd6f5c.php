<?php $__env->startSection('title', 'Reservations'); ?>

<?php $__env->startPush('style'); ?>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('library/selectric/public/selectric.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Réservations</h1>
                <div class="section-header-button">
                    <a href="<?php echo e(route('reservation.create')); ?>" class="btn btn-primary">Ajouter</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="<?php echo e(route('reservation.index')); ?>">Réservations</a></div>
                    <div class="breadcrumb-item">Tous les réservations</div>
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
                                <h4>Tous les réservations</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="<?php echo e(route('reservation.index')); ?>">
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
                                           <th></th>
                                            <th>Client</th>
                                            <th>Code réservation</th>
                                            <th>Date de réservation</th>
                                            <th>Status</th>
                                            <th>Notes</th>
                                            <th>Numéro de table</th>
                                        </tr>
                                        <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>

                                                <td></td>
                                                <td><?php echo e($reservations->customer_name); ?>

                                                </td>

                                                <td><?php echo e($reservations->reservation_code); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($reservations->status); ?>

                                                </td>

                                                <td>
                                                    <?php echo e($reservations->notes); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($reservations->table_number); ?>

                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='<?php echo e(route('reservation.edit', $reservations->id)); ?>'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Modifier
                                                        </a>

                                                        <form action="<?php echo e(route('reservation.destroy', $reservations->id)); ?>" method="POST"
                                                            class="ml-2">
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fustimolnarpatrick/laravel-coffeshop/resources/views/pages/reservation/index.blade.php ENDPATH**/ ?>