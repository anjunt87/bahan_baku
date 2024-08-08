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
                            <?php if (empty($preorders)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    No Pre Order Records Found
                                </div>
                            <?php else : ?>
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>ID Pre Order</th>
                                            <th>Suppliers</th>
                                            <th>Amount Item</th>
                                            <th>Delivery Note</th>
                                            <th>Order Date</th>
                                            <th>Check Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($preorders as $report) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td>
                                                    <?php
                                                    switch ($report['status']) {
                                                        case 'process':
                                                            echo '<span class="badge badge-warning">Process</span>';
                                                            break;
                                                        case 'completed':
                                                            echo '<span class="badge badge-success">Completed</span>';
                                                            break;
                                                        case 'canceled':
                                                            echo '<span class="badge badge-danger">Canceled</span>';
                                                            break;
                                                        default:
                                                            echo '<span class="badge badge-secondary">Unknown</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $report['id'] ?></td>
                                                <td><?= $report['name_suppliers'] ?></td>
                                                <td><?= $report['amount_item'] ?> Item</td>
                                                <td><?= $report['delivery_note'] ?></td>
                                                <td><?= date('d M Y', strtotime($report['pre_order_date'])) ?></td>
                                                <td><?= date('d M Y', strtotime($report['check_date'])) ?></td>
                                                <td><a href="/pre_order/detail/<?= $report['id']; ?>" class="btn btn-info btn-sm">Detail</a></td>
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