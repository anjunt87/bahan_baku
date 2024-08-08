<!-- Template Navbar -->
<?= $this->include('template/header') ?>
<!-- Template Navbar -->
<?= $this->include('template/navbar') ?>
<!-- Template SideBar -->
<?= $this->include('template/sidebar') ?>
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-6">
                <h4 class="page-title"><?= $title; ?></h4>
                <!-- Button to trigger modal for adding items -->
                <a href="<?= base_url('/cart') ?>" class="btn btn-success mb-2">
                    <i class="bi bi-plus"></i> Cart
                </a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row products">
                                <?php foreach ($items as $item) : ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="product card h-100">
                                            <img src="<?= base_url('uploads/' . $item['image']); ?>" class="card-img-top" alt="<?php echo $item['name_items']; ?>">
                                            <div class="card-body">
                                                <h2 class="card-title"><?php echo $item['name_items']; ?></h2>
                                                <!-- <p class="card-text">Harga: Rp <? //php echo number_format($item['price'], 2, ',', '.'); 
                                                                                    ?></p> -->
                                                <p class="card-text"><?php echo $item['description']; ?></p>
                                                <!-- Add to Cart Form Outbound -->
                                                <form class="add-to-cart-form-outbound" action="/cart/add" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="item_id" value="<?= $item['id_items']; ?>">
                                                    <div class="form-group">
                                                        <label for="quantity">Amount :</label>
                                                        <input type="number" class="form-control" name="quantity" id="quantity" min="1" max="<?= $item['stock_items']; ?>" value="1" oninput="updateTotalPrice()">
                                                    </div>
                                                    <button type="submit" class="btn btn-success btn-block add-to-cart-button">Add to Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
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