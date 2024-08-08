<!-- Add Item Modal -->
<div class="modal fade" id="add-items" tabindex="-1" role="dialog" aria-labelledby="add-itemsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addItemForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-itemsLabel">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nameItemsInput">Name</label>
                        <input type="text" class="form-control" id="nameItemsInput" name="nameItemsInput" required>
                    </div>
                    <div class="form-group">
                        <label for="previousStockInput">Previous Stock</label>
                        <input type="number" class="form-control" id="previousStockInput" name="previousStockInput" required>
                    </div>
                    <div class="form-group">
                        <label for="stockItemsInput">Stock</label>
                        <input type="number" class="form-control" id="stockItemsInput" name="stockItemsInput" required>
                    </div>
                    <div class="form-group">
                        <label for="descriptionInput">Description</label>
                        <textarea class="form-control" id="descriptionInput" name="descriptionInput" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imageInput">Image</label>
                        <input type="file" class="form-control" id="imageInput" name="imageInput">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addItemForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?= base_url('/admin/listitems/save') ?>',
                type: 'POST',
                data: formData,
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
                    console.error('AJAX Error:', status, error);
                    console.error('Response Text:', xhr.responseText);
                    alert('An error occurred while processing your request.');
                }
            });
        });
    });
</script>