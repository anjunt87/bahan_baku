<!-- Template Navbar -->
<?= $this->include('template/header') ?>
<!-- Template Navbar -->
<?= $this->include('template/navbar') ?>
<!-- Template SideBar -->
<?= $this->include('template/sidebar') ?>
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4 class="page-title"><?= $title; ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (empty($pre_orders)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    No Outbound Records Found
                                </div>
                                <a href="<?= site_url('pre-order/create') ?>">Create New Pre Order</a>
                            <?php else : ?>
                                <a href="<?= site_url('pre-order/create') ?>">Create New Pre Order</a>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer Name</th>
                                            <th>Contact Info</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pre_orders as $pre_order) : ?>
                                            <tr>
                                                <td><?= $pre_order['id'] ?></td>
                                                <td><?= $pre_order['customer_name'] ?></td>
                                                <td><?= $pre_order['contact_info'] ?></td>
                                                <td><?= $pre_order['status'] ?></td>
                                                <td>
                                                    <a href="<?= site_url('pre-order/show/' . $pre_order['id']) ?>">View</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template SideBar -->
<?= $this->include('template/footer') ?>
</div>
</div>
</div>
</div>
</body>
<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>