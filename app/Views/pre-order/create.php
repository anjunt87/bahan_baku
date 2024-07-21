<!-- Template Navbar -->
<?= $this->include('template/header') ?>
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
                            <form action="<?= site_url('pre-order/store') ?>" method="post" class="container mt-5">
                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Customer Name:</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="contact_info" class="form-label">Contact Info:</label>
                                    <input type="text" class="form-control" id="contact_info" name="contact_info" required>
                                </div>
                                <h3 class="mb-3">Items</h3>
                                <?php foreach ($items as $item) : ?>
                                    <div class="mb-3">
                                        <label class="form-label"><?= $item['name_items'] ?> (<?//= $item['price'] ?>)</label>
                                        <input type="hidden" name="items[<?= $item['id_items'] ?>][id_items]" value="<?= $item['id_items'] ?>">
                                        <input type="number" class="form-control" name="items[<?= $item['id_items'] ?>][quantity]" placeholder="Quantity" required>
                                    </div>
                                <?php endforeach; ?>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

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