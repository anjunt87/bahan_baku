<title><?= $title ?></title>
<style>
    .order-summary {
        margin-top: 20px;
        font-family: Arial, sans-serif;
    }

    .order-item-table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-item-table th,
    .order-item-table td {
        text-align: left;
        border: 1px solid #ddd;
        padding: 8px;
    }

    .order-item-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .no-print {
        margin-top: 20px;
        text-align: center;
    }

    .no-print .btn {
        margin: 5px;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        display: inline-block;
    }

    .no-print .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .no-print .btn-danger:hover {
        background-color: #c82333;
    }

    .no-print .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .no-print .btn-primary:hover {
        background-color: #0056b3;
    }

    @media print {
        .no-print {
            display: none;
        }
    }

    .print-only {
        display: block;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
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

    .order-summary h4,
    .order-items h4 {
        margin-bottom: 15px;
        font-size: 18px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
    }

    .order-summary p {
        margin: 5px 0;
    }

    .print-only {
        display: none;
    }
</style>

<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if ($outbound) : ?>
                                <div class="order-summary mb-4">
                                    <h4 class="mb-3"><?= $title; ?></h4>
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
                                                    <td><?= $item['quantity']; ?> Pcs</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-warning" role="alert">
                                    Outbound not found.
                                </div>
                            <?php endif; ?>
                            <div class="no-print">
                                <a href="/outbound/detail/<?= $outbound['id']; ?>" class="btn btn-danger mt-4">Back to Outbound Detail</a>
                                <button class="btn btn-primary mt-4" onclick="window.print()">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>