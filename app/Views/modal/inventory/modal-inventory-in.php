<!-- Modal -->
<div class="modal fade" id="inventory-in" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">Add Stock In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="InventoryInForm">
                    <div class="form-group">
                        <label for="itemSelectIn">Items</label>
                        <select class="form-control" id="itemSelectIn" name="nameItemsInput">
                            <option value="">Select Item</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supplierSelectIn">Suppliers</label>
                        <select class="form-control" id="supplierSelectIn" name="nameSuppliersInput">
                            <option value="">Select Suppliers</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="qcSelectIn">Quality Control</label>
                        <select class="form-control" id="qcSelectIn" name="nameQCInput">
                            <option value="">Select QC</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stockIn">Stock In</label>
                        <input type="text" class="form-control" id="stockIn" name="stockIn" placeholder="Stock In" required>
                    </div>
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <div id="responseMessageIn" style="margin-top: 10px;"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // AJAX form submission
        $('#InventoryInForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: 'inventory/instock', // URL to submit to
                type: 'POST', // HTTP method (POST recommended for form submission)
                data: formData, // Form data to submit
                success: function(response) {
                    // Handle success response (if any)
                    if (response.success) {
                        $('#responseMessageIn').html('<div class="alert alert-success">Data saved successfully!</div>');
                        $('#InventoryInForm')[0].reset(); // Clear form fields
                        alert('Data entered successfully');
                        location.reload();
                    } else {
                        $('#responseMessageIn').html('<div class="alert alert-danger">Error: ' + response.errors.join(', ') + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response (if any)
                    $('#responseMessageIn').html('<div class="alert alert-danger">Error: ' + error + '</div>');
                }
            });
        });

        $('#inventory-in').on('show.bs.modal', function(e) {
            // Fetch items
            $.ajax({
                url: '<?= site_url('inventory/getItems') ?>',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#itemSelectIn').empty().append('<option value="">Select Item</option>');
                    $.each(data, function(index, item) {
                        $('#itemSelectIn').append('<option value="' + item.id_items + '">' + item.name_items + '</option>');
                    });
                }
            });

            // Fetch suppliers
            $.ajax({
                url: '<?= site_url('inventory/getSuppliers') ?>',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#supplierSelectIn').empty().append('<option value="">Select Suppliers</option>');
                    $.each(data, function(index, supplier) {
                        $('#supplierSelectIn').append('<option value="' + supplier.id_suppliers + '">' + supplier.name_suppliers + '</option>');
                    });
                }
            });

            // Fetch users
            $.ajax({
                url: '<?= site_url('inventory/getQc') ?>',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#qcSelectIn').empty().append('<option value="">Select QC</option>');
                    $.each(data, function(index, users) {
                        $('#qcSelectIn').append('<option value="' + users.user_id + '">' + users.user_name + '</option>');
                    });
                }
            });

        });
    });
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>