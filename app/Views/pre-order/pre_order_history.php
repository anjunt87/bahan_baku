<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .order-table th,
        .order-table td {
            text-align: center;
        }
    </style>
</head>

<body>
    <?= $this->include('template/header') ?>
    <?= $this->include('template/navbar') ?>
    <?= $this->include('template/sidebar') ?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <?php if (empty($pre_orders)) : ?>
                                    <div class="alert alert-warning" role="alert">
                                        No pre-orders found.
                                    </div>
                                <?php else : ?>
                                    <table class="table table-striped order-table">
                                        <thead>
                                            <tr>
                                                <th>ID Pre-Order</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pre_orders as $pre_order) : ?>
                                                <tr>
                                                    <td><?= $pre_order['id']; ?></td>
                                                    <td><?= date('d M Y', strtotime($pre_order['order_date'])); ?></td>
                                                    <td>
                                                        <?php
                                                        switch ($pre_order['status']) {
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
                                                    <td><a href="/preorder/detail/<?= $pre_order['id']; ?>" class="btn btn-info btn-sm">Detail</a></td>
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
    <?= $this->include('template/footer') ?>
    <?= $this->include('template/script') ?>
</body>

</html>