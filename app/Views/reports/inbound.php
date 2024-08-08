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
                    <p><?= $subtitle; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('/report/inbound') ?>" method="post" class="row g-3">
                                <div class="col-md-5">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">Generate Report</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (empty($startdate)) : ?>
                        <!-- Biarkan kosong -->
                    <?php else : ?>
                        <div class="d-flex justify-content-end mb-4">
                            <button class="btn btn-success" onclick="printReport()">Print Report</button>
                        </div>
                        <div class="card" id="reportTable">
                            <div class="card-body">
                                <h4><?= $titledate; ?> <?= date('d M Y', strtotime($startdate)) . ' to ' ?> <?= date('d M Y', strtotime($enddate)) ?></h4>
                                <div class="table-responsive bundle-table mt-4">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Status</th>
                                                <th>ID Inbound</th>
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
                                            <?php foreach ($reports as $report) : ?>
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
                                                    <td><a href="/report/inboundDetail/<?= $report['id']; ?>" class="btn btn-info btn-sm">Detail</a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
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