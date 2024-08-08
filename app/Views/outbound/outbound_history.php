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
                            <?php if (empty($outbounds)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    No Outbound Records Found
                                </div>
                            <?php else : ?>
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID Outbound</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($outbounds as $outbound) : ?>
                                            <tr>
                                                <td><?= $outbound['id']; ?></td>
                                                <td><?= date('d M Y', strtotime($outbound['outbound_date'])); ?></td>
                                                <td>
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
                                                </td>
                                                <td><a href="/outbound/detail/<?= $outbound['id']; ?>" class="btn btn-info btn-sm">Detail</a></td>
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