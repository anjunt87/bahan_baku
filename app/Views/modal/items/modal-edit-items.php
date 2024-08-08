<!-- Edit Item Modal -->
<div class="modal fade" id="edit-items" tabindex="-1" role="dialog" aria-labelledby="edit-itemsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editItemForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-itemsLabel">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_items" name="id_items">
                    <div class="form-group">
                        <label for="nameItemsEdit">Name</label>
                        <input type="text" class="form-control" id="nameItemsEdit" name="nameItemsEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="previousStockEdit">Previous Stock</label>
                        <input type="number" class="form-control" id="previousStockEdit" name="previousStockEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="stockItemsEdit">Stock</label>
                        <input type="number" class="form-control" id="stockItemsEdit" name="stockItemsEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="descriptionEdit">Description</label>
                        <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imageEdit">Image</label>
                        <input type="file" class="form-control" id="imageEdit" name="imageEdit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Edit Item
        $('.edit-button').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '<?= base_url('/admin/listitems/edit') ?>/' + id,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        if (response.data) {
                            $('#id_items').val(response.data.id_items);
                            $('#nameItemsEdit').val(response.data.name_items);
                            $('#previousStockEdit').val(response.data.previous_stock);
                            $('#stockItemsEdit').val(response.data.stock_items);
                            $('#descriptionEdit').val(response.data.description);
                            $('#edit-items').modal('show'); // Ensure ID is correct
                        } else {
                            alert('No data received from server.');
                        }
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error: ', status, error);
                }
            });
        });

        $('#editItemForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url('admin/listitems/update') ?>',
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error: ', status, error);
                }
            });
        });
    });
</script>