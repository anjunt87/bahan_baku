<?php foreach ($items as $item) : ?>
    <div class="col-md-4 mb-4">
        <div class="product card h-100">
            <img src="<?= base_url('uploads/' . $item['image']); ?>" class="card-img-top" alt="<?= $item['name_items']; ?>">
            <div class="card-body">
                <h2 class="card-title"><?= $item['name_items']; ?></h2>
                <p class="card-text">Harga: Rp <?= number_format($item['price'], 2, ',', '.'); ?></p>
                <p class="card-text"><?= $item['description']; ?></p>
                <form action="/cart/add" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="item_id" value="<?= $item['id_items']; ?>">
                    <div class="form-group">
                        <label for="quantity">Jumlah:</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" min="1" max="<?= $item['stock_items']; ?>" value="1">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Tambah ke Keranjang</button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>