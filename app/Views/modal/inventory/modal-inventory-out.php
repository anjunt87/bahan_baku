<!-- Modal -->
<div class="modal fade" id="inventory-out" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Add Stock Out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="InventoryOutForm">
                    <div class="form-group">
                        <label for="itemSelectOut">Items</label>
                        <select class="form-control" id="itemSelectOut" name="nameItemsInput">
                            <option value="">Select Item</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supplierSelectOut">Suppliers</label>
                        <select class="form-control" id="supplierSelectOut" name="nameSuppliersInput">
                            <option value="">Select Supplier</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="usersSelectIn">Users Taken</label>
                        <select class="form-control" id="usersSelectIn" name="nameUsersInput">
                            <option value="">Select Users</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stockOut">Stock Out</label>
                        <!-- <input type="hidden" name="minus"> -->
                        <input type="text" class="form-control" id="stockOut" name="stockOut" placeholder="Stock Out" required>
                    </div>
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <div id="responseMessageOut" style="margin-top: 10px;"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // AJAX form submission
        $('#InventoryOutForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: 'inventory/outstock', // URL to submit to
                type: 'POST', // HTTP method (POST recommended for form submission)
                data: formData, // Form data to submit
                success: function(response) {
                    // Handle success response (if any)
                    if (response.success) {
                        $('#responseMessageOut').html('<div class="alert alert-success">Data saved successfully!</div>');
                        $('#InventoryOutForm')[0].reset(); // Clear form fields
                        alert('Data entered successfully');
                        location.reload();
                    } else {
                        $('#responseMessageOut').html('<div class="alert alert-danger">Error: ' + response.errors.join(', ') + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response (if any)
                    $('#responseMessageOut').html('<div class="alert alert-danger">Error: ' + error + '</div>');
                }
            });
        });

        $('#inventory-out').on('show.bs.modal', function(e) {
            // Fetch items
            $.ajax({
                url: '<?= site_url('inventory/getItems') ?>',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#itemSelectOut').empty().append('<option value="">Select Item</option>');
                    $.each(data, function(index, item) {
                        $('#itemSelectOut').append('<option value="' + item.id_items + '">' + item.name_items + '</option>');
                    });
                }
            });

            // Fetch suppliers
            $.ajax({
                url: '<?= site_url('inventory/getSuppliers') ?>',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#supplierSelectOut').empty().append('<option value="">Select Suppliers</option>');
                    $.each(data, function(index, supplier) {
                        $('#supplierSelectOut').append('<option value="' + supplier.id_suppliers + '">' + supplier.name_suppliers + '</option>');
                    });
                }
            });

            // Fetch users
            $.ajax({
                url: '<?= site_url('inventory/getUsers') ?>',
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
    });
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>