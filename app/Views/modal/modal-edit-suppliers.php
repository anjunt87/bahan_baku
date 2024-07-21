<div class="modal fade" id="edit-suppliers" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title" id="modal-title"><i class="la la-edit"></i> Edit Suppliers</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditSuppliersForm">
                    <div class="form-group">
                        <input type="hidden" id="id_suppliers" name="id_suppliers">
                        <label for="name">Name Suppliers Edit</label>
                        <input type="text" class="form-control" id="nameSuppliersEdit" name="nameSuppliersEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="production">Production Edit</label>
                        <input type="text" class="form-control" id="productionEdit" name="productionEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Edit</label>
                        <input type="text" class="form-control" id="contactEdit" name="contactEdit" required>
                    </div>
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
                </form>
                <div id="responseMessage" style="margin-top: 10px;"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.edit-button', function() {
        const id = $(this).data('id'); // Pastikan Anda mengambil data-id yang benar
        $.ajax({
            url: '<?= site_url('admin/suppliers/edit/') ?>' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#id_suppliers').val(response.data.id_suppliers);
                    $('#nameSuppliersEdit').val(response.data.name_suppliers);
                    $('#productionEdit').val(response.data.production_suppliers);
                    $('#contactEdit').val(response.data.contact_suppliers);
                    $('#edit-suppliers .modal-title').text('Edit Supplier');
                    $('#submitButton').text('Update');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });


        // Handle Form Submission
        $('#EditSuppliersForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#id_suppliers').val();
            const url = id ? '<?= site_url('admin/suppliers/update') ?>' : '<?= site_url('admin/suppliers/save') ?>';
            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#responseMessage').html('');
                    if (response.success) {
                        $('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#edit-suppliers').modal('hide');
                        $('#EditSuppliersForm')[0].reset();
                        location.reload();
                    } else {
                        $('#responseMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#responseMessage').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                }
            });
        });

        // Reset Modal when closed
        $('#edit-suppliers').on('hidden.bs.modal', function() {
            $('#supplierForm')[0].reset();
            $('#id_suppliers').val('');
            $('#edit-suppliers .modal-title').text('Add Supplier');
            $('#submitButton').text('Save');
        });

    });
</script>