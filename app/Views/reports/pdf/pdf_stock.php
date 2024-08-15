<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Stock Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h4 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
    <h4>Stock Report from <?= date('d M Y', strtotime($startdate)) . ' to ' . date('d M Y', strtotime($enddate)) ?></h4>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Previous Stock</th>
                <th>Stock</th>
                <th>Last Updated</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reports as $report) : ?>
                <tr>
                    <td><?= $report['name_items'] ?></td>
                    <td><?= $report['previous_stock'] ?></td>
                    <td><?= $report['stock_items'] ?></td>
                    <td><?= date('d M Y', strtotime($report['updated_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>