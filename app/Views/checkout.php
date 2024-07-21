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
                    <?php if (empty($cartItems)) : ?>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <!-- Button to trigger modal for adding items -->
                                <a href="<?= base_url('/items') ?>" class="btn btn-success mb-2">
                                    <i class="bi bi-plus"></i> Add Items
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-warning" role="alert">
                                    Your item is empty.
                                </div>
                            <?php else : ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="mb-4">Checkout</h1>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Image</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($cartItems as $cartItem) : ?>
                                                            <tr>
                                                                <td><?= $cartItem['item']['name_items']; ?></td>
                                                                <td><img src="<?= base_url('uploads/' . $cartItem['item']['image']); ?>" alt="<?= $cartItem['item']['name_items']; ?>" class="img-thumbnail" style="width: 80px; height: 80px;"></td>
                                                                <td><?= $cartItem['quantity']; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <form action="/checkout/process" method="post">
                                                    <div class="form-group">
                                                        <label for="usersSelectIn">Recipient Name</label>
                                                        <select class="form-control" id="usersSelectIn" name="recipient_name" required>
                                                            <option value="">Select Users</option>
                                                        </select>
                                                    </div>
                                                    <a href="/cart" class="btn btn-danger me-2">Back</a>
                                                    <button type="submit" class="btn btn-primary me-2">Pickup Item</button>
                                                </form>
                                            </div>
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

<script>
    $(document).ready(function() {
        // Fetch users
        $.ajax({
            url: '<?= site_url('/CheckoutController/getUsers') ?>',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#usersSelectIn').empty().append('<option value="">Select Users</option>');
                $.each(data, function(index, users) {
                    $('#usersSelectIn').append('<option value="' + users.user_id + '">' + users.user_name + '</option>');
                });
            }
        });
    });
</script>

</html>