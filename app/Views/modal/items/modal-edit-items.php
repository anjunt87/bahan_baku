<div class="modal fade" id="edit-items" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title" id="modal-title"><i class="la la-edit"></i> Edit Items</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditItemsForm">
                    <div class="form-group">
                        <input type="hidden" id="id_items" name="id_items">
                        <label for="name">Name Items Edit</label>
                        <input type="text" class="form-control" id="nameItemsEdit" name="nameItemsEdit" required>
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
            url: '<?= site_url('admin/listitems/edit/') ?>' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#id_items').val(response.data.id_items);
                    $('#nameItemsEdit').val(response.data.name_items);
                    $('#edit-items .modal-title').text('Edit Items');
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
        $('#EditItemsForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#id_items').val();
            const url = id ? '<?= site_url('admin/listitems/update') ?>' : '<?= site_url('admin/listitems/save') ?>';
            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#responseMessage').html('');
                    if (response.success) {
                        $('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#edit-items').modal('hide');
                        $('#EditItemsForm')[0].reset();
                        alert('Data berhasil di edit');
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
        $('#edit-items').on('hidden.bs.modal', function() {
            $('#supplierForm')[0].reset();
            $('#id_items').val('');
            $('#edit-items .modal-title').text('Add Supplier');
            $('#submitButton').text('Save');
        });

    });
</script>