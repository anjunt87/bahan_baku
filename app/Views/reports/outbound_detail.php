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
                    <div id="reportTable">
                        <div class="card">
                            <div class="card-body">
                                <?php if ($outbound) : ?>
                                    <div id="reportTable">
                                        <div class="order-summary mb-4">
                                            <h4 class="mb-3">Information Outbound</h4>
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
                                                        <th>#</th>
                                                        <th>Item Name</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1 ?>
                                                    <?php foreach ($outboundItems as $item) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
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
                        </div>
                        <div class="d-flex mb-2">
                            <button class="btn btn-success" onclick="printReport()">Print Report</button>
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