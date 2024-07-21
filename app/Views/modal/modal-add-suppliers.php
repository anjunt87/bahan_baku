<!-- Modal -->
<div class="modal fade" id="add-suppliers" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="AddSuppliersForm">
                    <div class="form-group">
                        <label for="name">Name Suppliers Input</label>
                        <input type="text" class="form-control" id="nameSuppliersInput" name="nameSuppliersInput" required>
                    </div>
                    <div class="form-group">
                        <label for="production">Production Input</label>
                        <input type="text" class="form-control" id="productionInput" name="productionInput" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Input</label>
                        <input type="text" class="form-control" id="contactInput" name="contactInput" required>
                    </div>
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <div id="responseMessage" style="margin-top: 10px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#AddSuppliersForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?= site_url('admin/suppliers/save') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#responseMessage').html('');
                    if (response.success) {
                        $('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#add-modal').modal('hide');
                        $('#AddSuppliersForm')[0].reset();
                        location.reload();
                        // Add new row to the table
                        var newRow = '<tr>' +
                            '<td>' + response.supplier.name_suppliers + '</td>' +
                            '<td>' + response.supplier.production_suppliers + '</td>' +
                            '<td>' + response.supplier.contact_suppliers + '</td>' +
                            '</tr>';
                        $('#suppliersTableBody').append(newRow);
                    } else {
                        $('#responseMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#responseMessage').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                }
            });
        });
    });
</script>