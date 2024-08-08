<!-- Add Role Modal -->
<div class="modal fade" id="add-role" tabindex="-1" role="dialog" aria-labelledby="add-roleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addRoleForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-roleLabel">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="roleNameInput">Role Name</label>
                        <input type="text" class="form-control" id="roleNameInput" name="roleNameInput" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Save Role
        $('#addRoleForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url('/admin/roles/save') ?>',
                method: 'post',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>