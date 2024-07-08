<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="<?= base_url()?>assets/img/profile.jpg">
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
        </div>
        <ul class="nav">
            <li class="nav-item">
                <a href="<?= base_url('admin') ?>">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
                    <!-- <span class="badge badge-count">5</span> -->
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
                    <i class="la la-shopping-cart"></i>
                    <p>Pre Order</p>
                    <!-- <span class="badge badge-count">5</span> -->
                </a>
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
        </ul>
    </div>
</div>