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
                    <a href="<?= base_url('/pre_order') ?>" class="btn btn-success mb-2">
                        <i class="bi bi-plus"></i> Add Items
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="cart-content">
                                <?php if (empty($preOrderCartItems)) : ?>
                                    <div class="alert alert-warning" role="alert">
                                        Your cart item is empty.
                                    </div>
                                    <?php else : ?>
                                        <ul class="list-group">
                                            <?php foreach ($preOrderCartItems as $item) : ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center" id="item-<?= $item['id']; ?>">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h5 class="mb-1"><?= $item['item']['name_items']; ?></h5>
                                                            <p class="mb-1">Amount: <span id="quantity-<?= $item['id']; ?>"><?= $item['quantity']; ?></span></p>
                                                            <!-- Tombol Tambah dan Kurang -->
                                                            <button class="btn btn-primary btn-sm btn-decrease" data-id="<?= $item['id']; ?>">-</button>
                                                            <button class="btn btn-primary btn-sm btn-increase" data-id="<?= $item['id']; ?>">+</button>
                                                        </div>
                                                    </div>
                                                    <a href="#" data-id="<?= $item['id']; ?>" class="btn btn-danger btn-sm btn-remove">Remove</a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <div class="mt-3 me-2 text-end">
                                            <a href="/pre_order" class="btn btn-danger me-2">Back</a>
                                            <a href="/pre_order/checkout" class="btn btn-primary">Proceed to Pickup</a>
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
<!-- Include jQuery -->
<script>
    $(document).ready(function() {
        // Event untuk menambah jumlah item
        $('.btn-increase').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            updateQuantity(id, 1);
        });

        // Event untuk mengurangi jumlah item
        $('.btn-decrease').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            updateQuantity(id, -1);
        });

        // Event untuk menghapus item dari keranjang
        $('.btn-remove').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            removeItem(id);
        });

        function updateQuantity(id, delta) {
            $.ajax({
                url: '<?= base_url('/pre_order/cart/update_quantity'); ?>', // Ganti dengan URL endpoint yang sesuai
                type: 'POST',
                data: {
                    id: id,
                    delta: delta
                },
                success: function(response) {
                    if (response.success) {
                        var newQuantity = response.new_quantity;
                        $('#quantity-' + id).text(newQuantity);
                        if (newQuantity === 0) {
                            $('#item-' + id).remove();
                        }
                        updateCartCount();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error updating quantity');
                }
            });
        }

        function removeItem(id) {
            $.ajax({
                url: '<?= base_url('/pre_order/cart/remove/'); ?>' + id,
                type: 'POST',
                success: function(response) {
                    if (response.success) {
                        $('#item-' + id).remove();
                        updateCartCount();
                        checkEmptyCart();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error removing item');
                }
            });
        }

        function updateCartCount() {
            var count = $('.list-group-item').length;
            $('#cart-count-preorder').text(count);
        }

        function checkEmptyCart() {
            if ($('.list-group-item').length === 0) {
                $('.cart-content').html('<div class="alert alert-warning" role="alert">Your cart item is empty.</div>');
                $('#cart-count-preorder').text('0');
            }
        }
    });
</script>


<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>