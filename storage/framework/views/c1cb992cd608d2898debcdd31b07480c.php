<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo e(url('home')); ?>">
                <img src="<?php echo e(asset('img/logo2.png')); ?>" alt="logo" width="75" class="shadow-light rounded-circle">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo e(url('home')); ?>"><img src="<?php echo e(asset('img/logo2.png')); ?>" alt="logo" width="40" class="shadow-light rounded-circle"></a>
        </div>
        <ul class="sidebar-menu" style="padding-top: 50px;">
            <ul class="sidebar-menu">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Gestion utilisateurs</span></a>
                    <ul class="dropdown-menu">
                        <li class=''>
                            <a class="nav-link" href="<?php echo e(route('user.index')); ?>">Utilisateurs</a>
                        </li>

                    </ul>
                    <ul class="dropdown-menu">
                        <li class=''>
                            <a class="nav-link" href="
                            <?php echo e(route('employee.index')); ?>

                            ">Employés</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="sidebar-menu">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Entrepot</span></a>
                    <ul class="dropdown-menu">
                        <li class=''>
                            <a class="nav-link" href="
                            <?php echo e(route('inventory.index')); ?>

                            ">Inventaire</a>
                        </li>

                    </ul>
                    <ul class="dropdown-menu">
                        <li class=''>
                            <a class="nav-link" href="
                            <?php echo e(route('supplier.index')); ?>

                            ">Fournisseurs</a>
                        </li>
                    </ul>
                </li>
            </ul>

            

            <li>
                <a href="<?php echo e(route('category.index')); ?>" class="nav-link"><i class="fas fa-box"></i><span>Catégories</span></a>
            </li>

            <li>
                <a href="<?php echo e(route('product.index')); ?>" class="nav-link"><i class="fas fa-shopping-cart"></i><span>Produits</span></a>
            </li>
            <li>
                <a href="
                <?php echo e(route('discount.index')); ?>

                " class="nav-link"><i class="fas fa-tags"></i><span>Réductions</span></a>
            </li>

            <li>
                <a href="<?php echo e(route('order.index')); ?>" class="nav-link"><i class="fas fa-list-alt"></i><span>Commandes</span></a>

            </li>

            <li>
                <a href="<?php echo e(route('customer.index')); ?>" class="nav-link"><i class="fas fa-user"></i><span>Clients</span></a>
            </li>

            <li>
                <a href="<?php echo e(route('reservation.index')); ?>" class="nav-link"><i class="fas fa-calendar-alt"></i><span>Réservations</span></a>
            </li>

    </aside>
</div>
<?php /**PATH /Users/fustimolnarpatrick/laravel-coffeshop/resources/views/components/sidebar.blade.php ENDPATH**/ ?>