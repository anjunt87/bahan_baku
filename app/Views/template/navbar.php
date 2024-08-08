<?php
$session = session();
$role = $session->get('role_name');
?>
<nav class="navbar navbar-header navbar-expand-lg">
    <div class="container-fluid">

        <!-- <form class="navbar-left navbar-form nav-search mr-md-3" action="">
            <div class="input-group">
                <input type="text" placeholder="Search ..." class="form-control">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="la la-search search-icon"></i>
                    </span>
                </div>
            </div>
        </form> -->
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <!-- <li class="nav-item dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="la la-envelope"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->
            <!-- Cart Icon Outbound -->

            <?php if ($role == 'admin' || $role == 'staff') : ?>
                <li class="nav-item dropdown hidden-caret" id="cart-icon-outbound">
                    <a class="nav-link dropdown-toggle" href="<?= base_url('/cart') ?>" role="button">
                        <i class="la la-shopping-cart icon" data-tooltip="Cart Outbound"></i>
                        <span class="notification" id="cart-count-outbound"><?= $cartcount; ?></span>
                    </a>
                </li>
                <?php if ($role == 'admin') : ?>
                    <!-- Cart Icon Preorder -->
                    <li class="nav-item dropdown hidden-caret" id="cart-icon-preorder">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('/pre_order/cart') ?>" role="button">
                            <i class="la la-shopping-cart icon" data-tooltip="Cart PreOrder"></i>
                            <span class="notification" id="cart-count-preorder"><?= $pocount; ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <li class="nav-item dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="la la-bell icon" data-tooltip="Notification"></i>
                    <span class="notification" id="notification-count">0</span>
                </a>
                <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown" id="notification-list">
                    <li>
                        <div class="dropdown-title">Notifications</div>
                    </li>
                    <li>
                        <div class="notif-center" id="notif-center">
                            <p class="text-center">No notifications</p>
                        </div>
                    </li>
                    <li>
                        <a class="see-all" href="javascript:void(0);"><strong>See all notifications</strong> <i class="la la-angle-right"></i></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="<?= base_url() ?>assets/img/profile.jpg" alt="user-img" width="36" class="img-circle"><span><?= $username ?></span></span> </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <div class="user-box">
                            <div class="u-img"><img src="<?= base_url() ?>assets/img/profile.jpg" alt="user"></div>
                            <div class="u-text">
                                <h4><?= $username ?></h4>
                                <p class="text-muted"><?= $user_email ?></p>
                                <!-- <a href="#" class="btn btn-rounded btn-danger btn-sm">View Profile</a> -->
                            </div>
                        </div>
                    </li>
                    <!-- <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
                    <a class="dropdown-item" href="#"></i> My Balance</a>
                    <a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="ti-settings"></i> Account Setting</a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('/logout') ?>"><i class="fa fa-power-off"></i> Logout</a>
                </ul>
                <!-- /.dropdown-user -->
            </li>
        </ul>
    </div>
</nav>
</div>