<!-- Template Navbar -->
<?= $this->include('template/header') ?>
<!-- Template Style -->
<?= $this->include('style/detail') ?>
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
                            <?php if ($outbound) : ?>
                                <div class="order-summary mb-4">
                                    <h4 class="mb-3">Outbound Information</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>ID Outbound :</strong> <?= $outbound['id']; ?></p>
                                            <p><strong>Pick up Date :</strong> <?= date('d M Y H:i', strtotime($outbound['outbound_date'])); ?></p>
                                            <p><strong>Noted By :</strong> <?= $notedByUsername; ?></p>
                                            <p><strong>Received by :</strong> <?= $receivedByUsername; ?></p>

                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Status :</strong>
                                                <?php
                                                switch ($outbound['status']) {
                                                    case 'pending':
                                                        echo '<span class="badge badge-warning">Pending</span>';
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
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="order-items mt-4">
                                    <h4 class="mb-3">Requested item</h4>
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID Item</th>
                                                <th>Item Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($outboundItems as $item) : ?>
                                                <tr>
                                                    <td><?= $item['item_id']; ?></td>
                                                    <td><?= $item['name_items']; ?></td>
                                                    <td><?= $item['quantity']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-warning" role="alert">
                                    Item not found.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                            <a href="/outbound/history" class="btn btn-danger mt-4">Return to Outbound History</a>
                            <a href="/outbound/print/<?= $outbound['id']; ?>" class="btn btn-primary ml-2 mt-4">Print</a>
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