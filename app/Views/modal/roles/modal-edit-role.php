<!-- Edit Role Modal -->
<div class="modal fade" id="edit-role" tabindex="-1" role="dialog" aria-labelledby="edit-roleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editRoleForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-roleLabel">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="role_id" name="role_id">
                    <div class="form-group">
                        <label for="roleNameEdit">Role Name</label>
                        <input type="text" class="form-control" id="roleNameEdit" name="roleNameEdit" required>
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
        // Edit Role
        $('.edit-button').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '<?= base_url('admin/roles/edit') ?>/' + id,
                method: 'get',
                success: function(response) {
                    if (response.success) {
                        $('#role_id').val(response.data.role_id);
                        $('#roleNameEdit').val(response.data.role_name);
                        $('#edit-role').modal('show');
                    } else {
                        alert(response.message);
                    }
                }
            });
        });

        // Update Role
        $('#editRoleForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url('admin/roles/update') ?>',
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