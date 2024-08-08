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
                            <?php if ($preorder) : ?>
                                <div id="reportTable">
                                    <div class="order-summary mb-4">
                                        <h4 class="mb-3">Pre Order Information</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>ID Pre Order :</strong> <?= $preorder['id']; ?></p>
                                                <p><strong>Pre Order Date :</strong> <?= date('d M Y H:i', strtotime($preorder['pre_order_date'])); ?></p>
                                                <p><strong>Noted By :</strong> <?= $notedByUsername; ?></p>
                                                <p><strong>Supplier Name :</strong> <?= $suppliersname; ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Status :</strong>
                                                    <?php
                                                    switch ($preorder['status']) {
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
                                                <?php foreach ($preorderItems as $item) : ?>
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
                    </div>
                    <div class="no-print">
                        <a href="/pre_order/history" class="btn btn-danger mt-2">Return to Pre Order History</a>
                        <button class="btn btn-primary mt-2" onclick="printReport()">Print</button>
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
<script>
    function printReport() {
        var printContents = document.getElementById('reportTable').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
<?= $this->include('template/script') ?>

</html>