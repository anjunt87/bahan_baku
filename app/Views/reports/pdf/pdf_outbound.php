<!DOCTYPE html>
<html>

<head>
    <title>Outbound Report</title>
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
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Outbound Report from <?= date('d M Y', strtotime($startdate)) ?> to <?= date('d M Y', strtotime($enddate)) ?></h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>ID Outbound</th>
                <th>Noted By</th>
                <th>Recipient By</th>
                <th>Amount Item</th>
                <th>Outbound Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($reports as $report) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= ucfirst($report['status']); ?></td>
                    <td><?= $report['id']; ?></td>
                    <td><?= $report['noted_by_username']; ?></td>
                    <td><?= $report['recipient_username']; ?></td>
                    <td><?= $report['amount_item']; ?> Item</td>
                    <td><?= date('d M Y', strtotime($report['outbound_date'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>