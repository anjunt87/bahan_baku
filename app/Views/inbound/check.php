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
                                    <?php if (session()->has('error')) : ?>
                                        <div class="alert alert-danger">
                                            <?= session('error'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>ID Pre Order :</strong> <?= $preorder['id']; ?></p>
                                            <p><strong>Supplier Name :</strong> <?= $suppliersname; ?></p>
                                            <p><strong>Pre Order Date :</strong> <?= date('d M Y H:i', strtotime($preorder['pre_order_date'])); ?></p>
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
                            <?php else : ?>
                                <div class="alert alert-warning" role="alert">
                                    Item not found.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('inbound/saveUpdatedPreOrder'); ?>" method="post">
                                <input type="hidden" name="preorder_id" value="<?= $preorder['id']; ?>">
                                <div class="order-summary mt-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Noted By :</strong> <input class="form-control" type="text" value="<?= $notedByUsername; ?>" disabled></p>
                                            <p><strong>QC By :</strong>
                                                <select class="form-control" name="checked_by">
                                                    <?php if (!empty($qcusers)): ?>
                                                        <?php foreach ($qcusers as $user) : ?>
                                                            <option value="<?= esc($user['user_id']); ?>" <?= esc($user['user_id']) == esc($preorder['checked_by']) ? 'selected' : ''; ?>>
                                                                <?= esc($user['user_name']); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <option value="">No users available</option>
                                                    <?php endif; ?>
                                                </select>
                                            </p>
                                            <!-- <p>
                                                <strong>Noted</strong>
                                                <textarea class="form-control" id="comment" name="comment" rows="5"><?= $preorder['delivery_note']; ?></textarea>
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="no-print">
                                    <a href="/inbound" class="btn btn-danger mt-4">Return to Pre Order History</a>
                                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                </div>
                            </form>
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


<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>