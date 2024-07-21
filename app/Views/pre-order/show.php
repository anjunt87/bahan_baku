<!DOCTYPE html>
<html>

<head>
    <title>Pre Order Details</title>
</head>

<body>
    <h1>Pre Order Details</h1>
    <p><strong>Customer Name:</strong> <?= $pre_order['customer_name'] ?></p>
    <p><strong>Contact Info:</strong> <?= $pre_order['contact_info'] ?></p>
    <p><strong>Status:</strong> <?= $pre_order['status'] ?></p>
    <h3>Items</h3>
    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><?= $item['item_id'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= site_url('pre-order') ?>">Back to List</a>
</body>

</html>