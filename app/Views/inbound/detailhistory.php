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
                                <div class="order-summary">
                                    <h4 class="mb-3">Information</h4>
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
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p>
                                <strong>Noted : </strong>
                            <p><?= $preorder['delivery_note']; ?></p>
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="order-items">
                                <h4 class="mb-3">Requested item</h4>
                                <form action="<?= base_url('inbound/checkitems'); ?>" method="post">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Status</th>
                                                <th>Item Name</th>
                                                <th>Amount PO</th>
                                                <th>Actual</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($preorderItems)): ?>
                                                <?php foreach ($preorderItems as $item) : ?>
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
                                                        <td><?= esc($item['name_items']); ?></td>
                                                        <td><?= esc($item['quantity']); ?></td>
                                                        <td><?= esc($item['actual']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4">No items found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <!-- <button type="submit" class="btn btn-primary">Update Status</button> -->
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
<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>