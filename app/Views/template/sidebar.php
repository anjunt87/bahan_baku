<div class="sidebar">
    <div class="scrollbar-inner1 sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item">
                <?php
                $session = session();
                $role = $session->get('role_name');
                $homeUrl = '#'; // Default URL jika role tidak dikenali

                switch ($role) {
                    case 'admin':
                        $homeUrl = '/admin';
                        break;
                    case 'manager':
                        $homeUrl = '/manager';
                        break;
                    case 'user':
                        $homeUrl = '/staff';
                        break;
                }
                ?>
                <a href="<?= $homeUrl ?>">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <?php if ($role == 'admin' || $role == 'manager' || $role == 'staff') : ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#collapseSItems" aria-expanded="true" aria-controls="collapseSItems">
                        <i class="la la-cubes"></i>
                        <p>Inventory</p>
                    </a>
                    <div class="collapse" id="collapseSItems">
                        <ul class="nav">
                            <?php if ($role == 'admin' || $role == 'staff') : ?>
                                <li class="nav-item">
                                    <a href="<?= base_url('/inbound') ?>">
                                        <i class="la la-chevron-down"></i>
                                        <p>Inbound</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('/items') ?>">
                                        <i class="la la-chevron-up"></i>
                                        <p>Outbound</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a href="<?= base_url('/inbound/history') ?>">
                                    <i class="la la-sign-in"></i>
                                    <p>Inbound History</p>
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
                <?php if ($role == 'admin' || $role == 'manager') : ?>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapseNeed" aria-expanded="true" aria-controls="collapseNeed">
                            <i class="la la-list-ul"></i>
                            <p>Items Need</p>
                        </a>
                        <div class="collapse" id="collapseNeed">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="<?= base_url('/needitems') ?>">
                                        <p>List Need Items</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('/needitems/history') ?>">
                                        <p>Need Items History</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if ($role == 'admin' || $role == 'manager') : ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#collapsePO" aria-expanded="true" aria-controls="collapsePO">
                            <i class="la la-shopping-cart"></i>
                            <p>Pre Order</p>
                        </a>
                        <div class="collapse" id="collapsePO">
                            <ul class="nav">
                                <?php if ($role == 'admin') : ?>
                                    <li class="nav-item">
                                        <a href="<?= base_url('/pre_order') ?>">
                                            <p>New Pre Order</p>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li class="nav-item">
                                    <a href="<?= base_url('/pre_order/history') ?>">
                                        <p>Pre Order History</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#collapseReport" aria-expanded="true" aria-controls="collapseReport">
                        <i class="la la-newspaper-o"></i>
                        <p>Report</p>
                    </a>
                    <div class="collapse" id="collapseReport">
                        <ul class="nav">
                            <li class="nav-item">
                                <a href="<?= base_url('/report/stock') ?>">
                                    <p>Stok</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('/report/pre_order') ?>">
                                    <p>Pre Order</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('/report/outbound') ?>">
                                    <p>Outbound</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('/report/inbound') ?>">
                                    <p>Inbound</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if ($role == 'admin') : ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
                        <i class="la la-gear"></i>
                        <p>Setting</p>
                    </a>
                    <div class="collapse" id="collapseSetting">
                        <ul class="nav">
                            <li class="nav-item">
                                <a href="<?= base_url('/admin/users') ?>">
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/roles') ?>">
                                    <p>Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/department') ?>">
                                    <p>Department</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('/admin/division') ?>">
                                    <p>Division</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/suppliers') ?>">
                                    <p>Suppliers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/listitems') ?>">
                                    <p>List items</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>