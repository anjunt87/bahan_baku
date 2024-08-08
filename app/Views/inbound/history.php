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
                            <?php if (empty($inboundItems)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    No Pre Order Records Found
                                </div>
                            <?php else : ?>
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID Pre Order</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($inboundItems as $inbound) : ?>
                                            <tr>
                                                <td><?= $inbound['id']; ?></td>
                                                <td><?= date('d M Y', strtotime($inbound['pre_order_date'])); ?></td>
                                                <td>
                                                    <?php
                                                    switch ($inbound['status']) {
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
                                                <td><a href="/inbound/detail_history/<?= $inbound['id']; ?>" class="btn btn-info btn-sm">Detail</a></td>
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