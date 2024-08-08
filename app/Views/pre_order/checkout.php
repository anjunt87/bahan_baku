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
                                <a href="<?= base_url('/pre_order') ?>" class="btn btn-success mb-2">
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
                                        <h1 class="mb-4">Checkout Pre Order</h1>
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
                                                            <tr data-item-id="<?= $cartItem['item']['id_items']; ?>">
                                                                <td><?= $cartItem['item']['name_items']; ?></td>
                                                                <td><img src="<?= base_url('uploads/' . $cartItem['item']['image']); ?>" alt="<?= $cartItem['item']['name_items']; ?>" class="img-thumbnail" style="width: 80px; height: 80px;"></td>
                                                                <td><?= $cartItem['quantity']; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <form id="orderForm">
                                                    <div class="form-group">
                                                        <label for="supplierSelectIn">Suppliers Name</label>
                                                        <select class="form-control" id="supplierSelectIn" name="recipient_name" required>
                                                            <option value="">Select Suppliers</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="supplierContactIn">Supplier Contact</label>
                                                        <input type="text" class="form-control" id="supplierContactIn" name="supplier_contact" readonly />
                                                    </div>
                                                    <a href="/pre_order/cart" class="btn btn-danger me-2">Back</a>
                                                    <button type="button" class="btn btn-success me-2" onclick="sendWhatsAppOrder()"><i class="fa fa-whatsapp"></i> Order Items</button>
                                                    <button type="button" class="btn btn-primary me-2" onclick="saveOrder()">Save Order</button>
                                                </form>
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
        // Fetch suppliers
        $.ajax({
            url: '<?= site_url('/pre_order/CheckoutController/getSuppliers') ?>',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#supplierSelectIn').empty().append('<option value="">Select Suppliers</option>');

                $.each(data, function(index, supplier) {
                    $('#supplierSelectIn').append('<option value="' + supplier.id_suppliers + '">' + supplier.name_suppliers + '</option>');
                });
            }
        });

        // Handle supplier selection
        $('#supplierSelectIn').change(function() {
            var supplierId = $(this).val();

            if (supplierId) {
                $.ajax({
                    url: '<?= site_url('/pre_order/CheckoutController/getSupplierContact') ?>',
                    method: 'GET',
                    data: {
                        supplier_id: supplierId
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#supplierContactIn').val(data.contact_suppliers);
                    }
                });
            } else {
                $('#supplierContactIn').val('');
            }
        });
    });

    function saveOrder() {
        var supplierId = $('#supplierSelectIn').val();
        var supplierName = $('#supplierSelectIn option:selected').text();
        var supplierContact = $('#supplierContactIn').val();

        if (supplierId === "" || supplierName === "" || supplierContact === "") {
            alert("Please select a supplier and ensure contact is filled.");
            return;
        }

        var items = [];
        $('#orderForm').siblings('table').find('tbody tr').each(function() {
            var itemId = $(this).data('item-id'); // Pastikan mengambil data-item-id
            var productName = $(this).find('td').eq(0).text();
            var productAmount = $(this).find('td').eq(2).text();

            items.push({
                id: itemId,
                name: productName,
                amount: productAmount
            });
        });

        var orderData = {
            supplier_id: supplierId,
            supplier_name: supplierName,
            supplier_contact: supplierContact,
            items: items
        };

        console.log(orderData); // Debugging: Lihat data yang dikirim

        $.ajax({
            url: '<?= site_url('/pre_order/CheckoutController/saveOrder') ?>',
            method: 'POST',
            data: JSON.stringify(orderData),
            contentType: 'application/json',
            success: function(response) {
                console.log(response); // Debugging: Lihat respons dari server
                if (response.success) {
                    alert("Order saved successfully.");
                    window.location.href = '<?= site_url('/pre_order/history') ?>'; // Ganti URL ini dengan URL history pre-order
                } else {
                    alert("Failed to save order. Please try again.");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Debugging: Lihat pesan error dari server
                alert("Failed to save order. Please try again.");
            }
        });
    }

    function sendWhatsAppOrder() {
        var supplierName = $('#supplierSelectIn option:selected').text();
        var supplierContact = $('#supplierContactIn').val();

        if (supplierName === "" || supplierContact === "") {
            alert("Please select a supplier and ensure contact is filled.");
            return;
        }

        var items = [];
        $('#orderForm').siblings('table').find('tbody tr').each(function() {
            var productName = $(this).find('td').eq(0).text();
            var productAmount = $(this).find('td').eq(2).text();
            items.push({
                name: productName,
                amount: productAmount
            });
        });

        var message = "Hello " + supplierName + ", I would like to place an order. \n\nItems:\n";

        items.forEach(function(item) {
            message += item.name + " - Quantity: " + item.amount + "\n";
        });

        var whatsappUrl = "https://wa.me/" + supplierContact + "?text=" + encodeURIComponent(message);
        window.open(whatsappUrl, '_blank');
    }
</script>

</html>