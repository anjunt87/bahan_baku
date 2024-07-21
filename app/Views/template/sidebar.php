<style>
    .scrollbar-inner1 {
        height: 100%;
        overflow-y: auto;
        /* Enable vertical scroll; */
        padding: 10px;
        /* background: #f0f0f0; */
    }

    .sidebar .nav-item a {
        color: #c2c7d0;
        padding: 10px 15px;
        display: block;
        transition: all 0.3s;
    }

    .sidebar .nav-item a:hover {
        background-color: #495057;
        color: #000435;
    }

    .sidebar .nav-item .collapse .nav-item a {
        padding-left: 30px;
    }
</style>
<div class="sidebar">
    <div class="scrollbar-inner1 sidebar-wrapper">

        <ul class="nav">
            <li class="nav-item">
                <a href="<?= base_url('admin') ?>">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
            </li>
            <li class="nav-item">
                <a class="" data-toggle="collapse" href="#collapseSItems" aria-expanded="true">
                    <i class="la la-cubes"></i>
                    <p>Inventory</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
                <div class="collapse in" id="collapseSItems" aria-expanded="true">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="<?//= base_url('/items')?>">
                                <i class="la la-chevron-down"></i>
                                <p>Inbound</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/items')?>">
                                <i class="la la-chevron-up"></i>
                                <p>Outbound</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/outbound/history') ?>">
                                <i class="la la-sign-in"></i>
                                <p>inbound History</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/outbound/history') ?>">
                                <i class="la la-sign-out"></i>
                                <p>Outbound History</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="" data-toggle="collapse" href="#collapsePO" aria-expanded="true">
                    <i class="la la-shopping-cart"></i>
                    <p>Pre Order</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
                <div class="collapse in" id="collapsePO" aria-expanded="true">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="<?= base_url('/pre-order') ?>">
                                <p>New Pre Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/pre-order/history') ?>">
                                <p>Pre Order History</p>
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
        </ul>
    </div>
</div>