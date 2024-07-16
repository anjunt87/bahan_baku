<<<<<<< HEAD
<style>
    .scrollbar-inner1 {
        height: 100%;
        overflow-y: auto;
        /* Enable vertical scroll; */
        padding: 10px;
        /* background: #f0f0f0; */
    }
</style>
<div class="sidebar">
    <div class="scrollbar-inner1 sidebar-wrapper">
        <!-- <div class="user">
            <div class="photo">
                <img src="<?= base_url() ?>assets/img/profile.jpg">
=======
<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="<?= base_url()?>assets/img/profile.jpg">
>>>>>>> a1db0e873e44bc891e2523d379275f537bf08e83
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        Anjunt
                        <span class="user-level">Administrator</span>
                        <span class="caret"></span>
                    </span>
                </a>
                <div class="clearfix"></div>

                <div class="collapse in" id="collapseExample" aria-expanded="true">
                    <ul class="nav">
                        <li>
                            <a href="#profile">
                                <span class="link-collapse">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#edit">
                                <span class="link-collapse">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="link-collapse">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
<<<<<<< HEAD
        </div> -->
=======
        </div>
>>>>>>> a1db0e873e44bc891e2523d379275f537bf08e83
        <ul class="nav">
            <li class="nav-item">
                <a href="<?= base_url('admin') ?>">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
            </li>
            <li class="nav-item">
<<<<<<< HEAD
                <a class="" data-toggle="collapse" href="#collapseSItems" aria-expanded="true">
                    <i class="la la-cubes"></i>
                    <p>Inventory</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
                <div class="collapse in" id="collapseSItems" aria-expanded="true">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="<?= base_url('inventory') ?>">
                                <i class="la la-file-text"></i>
                                <p>Inventory Stock</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('inventory/stockIn') ?>">
                                <i class="la la-chevron-down"></i>
                                <p>Inventory In</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('inventory/stockOut') ?>">
                                <i class="la la-chevron-up"></i>
                                <p>Inventory Out</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- <li class="nav-item">
                <a class="" data-toggle="collapse" href="#collapseItems" aria-expanded="true">
                    <i class="la la-list"></i>
                    <p>List of items</p>
                </a>
                <div class="collapse in" id="collapseItems" aria-expanded="true">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/items/category1') ?>">
                                <p>Category 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/items/category2') ?>">
                                <p>Category 2</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->
            <li class="nav-item">
                <a class="" data-toggle="collapse" href="#collapsePO" aria-expanded="true">
=======
                <a href="<?= base_url('admin/suppliers') ?>">
                    <i class="la la-university"></i>
                    <p>Suppliers</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="la la-cubes"></i>
                    <p>Supervision of goods</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="la la-list"></i>
                    <p>List of items</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
>>>>>>> a1db0e873e44bc891e2523d379275f537bf08e83
                    <i class="la la-shopping-cart"></i>
                    <p>Pre Order</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
<<<<<<< HEAD
                <div class="collapse in" id="collapsePO" aria-expanded="true">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/preorder/new') ?>">
                                <p>New Pre Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/preorder/history') ?>">
                                <p>Order History</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="" data-toggle="collapse" href="#collapseReport" aria-expanded="true">
                    <i class="la la-newspaper-o"></i>
                    <p>Report</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
                <div class="collapse in" id="collapseReport" aria-expanded="true">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/supervision/overview') ?>">
                                <p>Stok</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/supervision/details') ?>">
                                <p>Pre Order</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="" data-toggle="collapse" href="#collapseSetting" aria-expanded="true">
                    <i class="la la-gear"></i>
                    <p>Setting</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
                <div class="collapse in" id="collapseSetting" aria-expanded="true">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/preorder/new') ?>">
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/preorder/history') ?>">
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('') ?>">
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/suppliers') ?>">
                                <i class="la la-university"></i>
                                <p>Suppliers</p>
                                <!-- <span class="badge badge-count">5</span> -->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/listitems') ?>">
                                <i class="la la-list"></i>
                                <p>List items</p>
                                <!-- <span class="badge badge-count">5</span> -->
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
=======
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="la la-users"></i>
                    <p>Users</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="la la-gear"></i>
                    <p>Settings</p>
                    <!-- <span class="badge badge-count">14</span> -->
                </a>
            </li>
            <!-- <li class="nav-item update-pro">
                <button data-toggle="modal" data-target="#modalUpdate">
                    <i class="la la-hand-pointer-o"></i>
                    <p>Update To Pro</p>
                </button>
            </li> -->
>>>>>>> a1db0e873e44bc891e2523d379275f537bf08e83
        </ul>
    </div>
</div>