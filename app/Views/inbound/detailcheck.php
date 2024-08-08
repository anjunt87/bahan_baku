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
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if ($preorder) : ?>
                                <div class="order-summary mt-4">
                                    <h4 class="mb-3">Pre Order Information</h4>
                                    <?php if (session()->has('errors')) : ?>
                                        <div class="alert alert-danger">
                                            <ul>
                                                <?php foreach (session('errors') as $error) : ?>
                                                    <li><?= $error; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>ID Pre Order :</strong> <?= $preorder['id']; ?></p>
                                            <p><strong>Supplier Name :</strong> <?= $suppliersname; ?></p>
                                            <p><strong>Pre Order Date :</strong> <?= date('d M Y H:i', strtotime($preorder['pre_order_date'])); ?></p>

                                            <p class="mt-4"><strong>Check_By :</strong> <?= $checkByUsername; ?></p>
                                            <p><strong>Check Date :</strong> <?= date('d M Y H:i', strtotime($preorder['check_date'])); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Status :</strong>
                                                <?php
                                                switch ($preorder['status']) {
                                                    case 'process':
                                                        echo '<span class="badge badge-warning">Process</span>';
                                                        break;
                                                    case 'checked':
                                                        echo '<span class="badge badge-info">Checked</span>';
                                                        break;
                                                    case 'completed':
                                                        echo '<span class="badge badge-success">Completed</span>';
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
                                    <form action="<?= base_url('inbound/checkitems'); ?>" method="post">
                                        <table class="table table-bordered table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Status</th>
                                                    <th>ID Items</th>
                                                    <th>Item Name</th>
                                                    <th>Amount PO</th>
                                                    <th>Actual</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($preorderItems)): ?>
                                                    <?php foreach ($preorderItems as $item): ?>
                                                        <tr>
                                                            <td id="statusBadge_<?= esc($item['id']); ?>">
                                                                <?php
                                                                $statusBadge = match ($item['status']) {
                                                                    'suitable' => '<span class="badge badge-success">Suitable</span>',
                                                                    'not_suitable' => '<span class="badge badge-danger">Not Suitable</span>',
                                                                    default => '<span class="badge badge-secondary">Unknown</span>',
                                                                };
                                                                echo $statusBadge;
                                                                ?>
                                                            </td>
                                                            <td><?= esc($item['item_id']); ?></td>
                                                            <td><?= esc($item['name_items']); ?></td>
                                                            <td><?= esc($item['quantity']); ?></td>
                                                            <td>
                                                                <input class="form-control" type="text" name="preorderItems[<?= esc($item['id']); ?>][actual]" value="<?= esc($item['actual']); ?>">
                                                                <input type="hidden" name="preorderItems[<?= esc($item['id']); ?>][id]" value="<?= esc($item['id']); ?>">
                                                                <input type="hidden" name="preorderItems[<?= esc($item['id']); ?>][quantity]" value="<?= esc($item['quantity']); ?>">
                                                                <input type="hidden" name="preorderItems[<?= esc($item['id']); ?>][item_id]" value="<?= esc($item['item_id']); ?>">
                                                                <input type="hidden" name="preorder_id" value="<?= esc($item['preorder_id']); ?>">
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5">No items found.</td>
                                                    </tr>
                                                <?php endif; ?>

                                            </tbody>
                                        </table>
                                        <p>
                                            <strong>Noted</strong>
                                            <textarea class="form-control" id="comment" name="comment" rows="5"><?= $preorder['delivery_note']; ?></textarea>
                                        </p>
                                        <button type="submit" class="btn btn-primary">Update Status</button>
                                    </form>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-warning" role="alert">
                                    Item not found.
                                </div>
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
<script>
    $(document).ready(function() {
        $('#updateStatusForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally

            $.ajax({
                url: '<?= site_url('inbound/updateStatus'); ?>',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Handle the response from the server
                    alert('Status updated successfully');
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
</script>
<script>
    document.getElementById('checkitemsForm').addEventListener('submit', function(event) {
        let isValid = true;
        document.querySelectorAll('.actual-input').forEach(function(input) {
            let actual = parseFloat(input.value);
            let quantity = parseFloat(input.getAttribute('data-quantity'));
            if (actual > quantity) {
                alert('Actual value cannot exceed Amount PO.');
                isValid = false;
                return false;
            }
        });
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>

<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>