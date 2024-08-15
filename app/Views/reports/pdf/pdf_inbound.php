<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1><?= $title ?></h1>
    <p><?= date('d M Y', strtotime($startdate)) . ' to ' . date('d M Y', strtotime($enddate)) ?></p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>ID Pre Order</th>
                <th>Suppliers</th>
                <th>Amount Item</th>
                <th>Noted By</th>
                <th>Checked By</th>
                <th>Delivery Note</th>
                <th>Order Date</th>
                <th>Check Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($reports as $report): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $report['status'] ?></td>
                    <td><?= $report['id'] ?></td>
                    <td><?= $report['name_suppliers'] ?></td>
                    <td><?= $report['amount_item'] ?> Item</td>
                    <td><?= $report['created_by_username'] ?></td>
                    <td><?= $report['checked_by_username'] ?></td>
                    <td><?= $report['delivery_note'] ?></td>
                    <td><?= date('d M Y', strtotime($report['pre_order_date'])) ?></td>
                    <td><?= date('d M Y', strtotime($report['check_date'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>