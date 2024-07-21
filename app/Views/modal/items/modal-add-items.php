<!-- Modal -->
<div class="modal fade" id="add-items" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">Add Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="AddItemsForm">
                    <div class="form-group">
                        <label for="name">Name Items Input</label>
                        <input type="text" class="form-control" id="nameItemsInput" name="nameItemsInput" required>
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
        $('#AddItemsForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?= site_url('admin/listitems/save') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#responseMessage').html('');
                    if (response.success) {
                        $('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#add-modal').modal('hide');
                        $('#AddItemsForm')[0].reset();
                        alert('Data entered successfully');
                        location.reload();
                        // Add new row to the table
                        var newRow = '<tr>' +
                            '<td>' + response.supplier.name_items + '</td>' +
                            '</tr>';
                        $('#itemsTableBody').append(newRow);
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