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
                    <!-- Button to trigger modal for adding items -->
                    <a href="<?= base_url('/items') ?>" class="btn btn-success mb-2">
                        <i class="bi bi-plus"></i> Add Items
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (empty($cartItems)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    Your cart item is empty.
                                </div>
                            <?php else : ?>
                                <ul class="list-group">
                                    <?php foreach ($cartItems as $cartItem) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="mb-1"><?= $cartItem['item']['name_items']; ?></h5>
                                                    <p class="mb-1">Amount : <?= $cartItem['quantity']; ?></p>
                                                </div>
                                            </div>
                                            <a href="/cart/remove/<?= $cartItem['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="mt-3 me-2 text-end">
                                    <a href="/items" class="btn btn-danger me-2">Back</a>
                                    <a href="/checkout" class="btn btn-primary">Proceed to Pickup</a>
                                </div>
                            <?php endif; ?>
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