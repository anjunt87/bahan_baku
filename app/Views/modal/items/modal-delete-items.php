<!-- Modal Delete Supplier -->
<div class="modal fade" id="delete-items" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalTitle"><i class="la la-trash"></i> Delete Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this supplier?</p>
                <form id="DeleteItemsForm" method="POST">
                    <input type="hidden" id="deleteSupplierId" name="id_items">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
                <div id="deleteResponseMessage" style="margin-top: 10px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Set ID Supplier untuk Dihapus
        $(document).on('click', '.delete-button', function() {
            const id = $(this).data('id');
            $('#deleteSupplierId').val(id);
            $('#delete-items').modal('show');
        });

        // Handle Form Submission untuk Hapus Supplier
        $('#DeleteItemsForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#deleteSupplierId').val();
            $.ajax({
                url: '<?= site_url('admin/listitems/delete') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#deleteResponseMessage').html('');
                    if (response.success) {
                        $('#deleteResponseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#delete-items').modal('hide');
                        // Reload halaman untuk update data
                        alert('Delete success');
                        location.reload();
                    } else {
                        $('#deleteResponseMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#deleteResponseMessage').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                }
            });
        });
    });
</script>