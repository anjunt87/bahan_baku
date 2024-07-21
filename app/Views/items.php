<!-- Template Navbar -->
<?= $this->include('template/header') ?>
<!-- Template Navbar -->
<?= $this->include('template/navbar') ?>
<!-- Template SideBar -->
<?= $this->include('template/sidebar') ?>
<style>
    .products {
        display: flex;
        flex-wrap: wrap;
    }

    .product {
        border: 1px solid #ddd;
        border-radius: 10px;
        margin: 10px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        background-color: #f9f9f9;
    }

    .product:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .product img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .product h2 {
        font-size: 1.8em;
        margin-bottom: 15px;
        color: #333;
    }

    .product p {
        margin-bottom: 15px;
        color: #666;
    }

    .product form .form-group {
        margin-bottom: 15px;
    }

    .product form input[type="number"] {
        padding: 10px;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
    }

    .product form button {
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .product form button:hover {
        background-color: #218838;
    }
</style>
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
                                                <form action="/cart/add" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="item_id" value="<?php echo $item['id_items']; ?>">
                                                    <div class="form-group">
                                                        <label for="quantity">Amount :</label>
                                                        <input type="number" class="form-control" name="quantity" id="quantity" min="1" max="<?php echo $item['stock_items']; ?>" value="1">
                                                    </div>
                                                    <button type="submit" class="btn btn-success btn-block">Add to Cart</button>
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