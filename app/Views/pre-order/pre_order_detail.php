<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .order-summary {
            margin-top: 20px;
        }

        .order-item-table th,
        .order-item-table td {
            text-align: center;
        }

        @media print {
            .no-print {
                display: none;
            }

            .print-only {
                display: block;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .main-panel,
            .content,
            .container-fluid,
            .card,
            .card-body,
            .row,
            .col-md-6,
            .col-md-12 {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .page-title,
            .btn {
                display: none;
            }
        }

        .print-only {
            display: none;
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
                        <h4 class="page-title"><?= $title; ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <?php if ($pre_order) : ?>
                                    <div class="order-summary mb-4">
                                        <h4 class="mb-3">Pre-Order Information</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>ID Pre-Order :</strong> <?= $pre_order['id']; ?></p>
                                                <p><strong>Order Date :</strong> <?= date('d M Y H:i', strtotime($pre_order['order_date'])); ?></p>
                                                <p><strong>Noted By :</strong> <?= $pre_order['noted_by']; ?></p>
                                                <p><strong>Received By :</strong> <?= $pre_order['received_by']; ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Status :</strong>
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
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="order-items mt-4">
                                        <h4 class="mb-3">Requested Items</h4>
                                        <table class="table table-striped order-item-table">
                                            <thead>
                                                <tr>
                                                    <th>ID Item</th>
                                                    <th>Item Name</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pre_order_items as $item) : ?>
                                                    <tr>
                                                        <td><?= $item['item_id']; ?></td>
                                                        <td><?= $item['name']; ?></td>
                                                        <td><?= $item['quantity']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else : ?>
                                    <div class="alert alert-warning" role="alert">
                                        Pre-order not found.
                                    </div>
                                <?php endif; ?>
                                <div class="no-print">
                                    <a href="/preorder" class="btn btn-danger mt-4">Return to Pre-Order History</a>
                                    <a href="/preorder/print/<?= $pre_order['id']; ?>" class="btn btn-primary mt-4">Print</a>
                                </div>
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