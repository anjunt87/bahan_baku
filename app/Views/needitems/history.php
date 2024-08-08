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
                            <div class="table-responsive bundle-table">
                                <table class="table table-bordered table-striped">
                                    <h4>Bundle Items Approve</h4>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Bundle Item Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($bundledItemsApprove as $item) : ?>
                                            <tr>
                                                <td><?= $item['bundle_name'] ?></td>
                                                <td><?= $item['created_at'] ?></td>
                                                <td>
                                                    <?php
                                                    $statusBadge = match ($item['status']) {
                                                        'approve' => '<span class="badge badge-success">Approve</span>',
                                                        'rejected' => '<span class="badge badge-danger">Rejected</span>',
                                                        default => '<span class="badge badge-secondary">Pending</span>',
                                                    };
                                                    echo $statusBadge;
                                                    ?>
                                                </td>
                                                <td><a href="/needitems/detail/<?= $item['id']; ?>" class="btn btn-info btn-sm">Detail</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive bundle-table">
                                <table class="table table-bordered table-striped">
                                    <h4>Bundle Items Rejected</h4>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Bundle Item Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($bundledItemsRejected as $item) : ?>
                                            <tr>
                                                <td><?= $item['bundle_name'] ?></td>
                                                <td><?= $item['created_at'] ?></td>
                                                <td>
                                                    <?php
                                                    $statusBadge = match ($item['status']) {
                                                        'approve' => '<span class="badge badge-success">Approve</span>',
                                                        'rejected' => '<span class="badge badge-danger">Rejected</span>',
                                                        default => '<span class="badge badge-secondary">Pending</span>',
                                                    };
                                                    echo $statusBadge;
                                                    ?>
                                                </td>
                                                <td><a href="/needitems/detail/<?= $item['id']; ?>" class="btn btn-info btn-sm">Detail</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
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
<!-- Template Script -->
<?= $this->include('template/script') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleTable(element) {
        $(element).next('.bundle-table').slideToggle();
    }
</script>

</html>