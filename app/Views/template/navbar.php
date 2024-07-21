<style>
    .notif-img {
        width: 50px;
        /* Atur lebar gambar sesuai kebutuhan */
        height: auto;
        /* Biarkan tinggi menyesuaikan secara otomatis */
        margin-right: 10px;
        /* Beri jarak antara gambar dan konten */
        border-radius: 5px;
        /* Opsional: Buat gambar dengan sudut membulat */
    }
</style>
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
            <li class="nav-item dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="<?= base_url('/cart') ?>" role="button">
                    <i class="la la-cart-arrow-down"></i>
                    <span class="notification"><?= $cartcount; ?></span>
                </a>
            </li>
            <li class="nav-item dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="la la-bell"></i>
                    <span class="notification">
                        <?php $i = 1; ?>
                        <?php foreach ($lowStockItems as $item) : ?>
                            <?= $i++ ?>
                        <?php endforeach; ?>
                    </span>
                </a>
                <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                    <li>
                        <div class="dropdown-title"></div>
                        <!-- <div class="dropdown-title">You have 4 new notification</div> -->
                    </li>
                    <li>
                        <div class="notif-center">
                            <!-- Notifikasi Item dengan Stok Rendah -->
                            <?php if (!empty($lowStockItems)) : ?>
                                <?php foreach ($lowStockItems as $item) : ?>
                                    <a href="#">
                                        <img src="<?= base_url('uploads/' . $item['image']); ?>" class="notif-icon notif-img" alt="<?php echo $item['name_items']; ?>">
                                        <div class="notif-content">
                                            <span class="block">
                                                <?= $item['name_items'] ?>
                                            </span>
                                            <span class="time">Now only <?= $item['stock_items'] ?>pcs left</span>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li>
                        <a class="see-all" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="la la-angle-right"></i> </a>
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