<!-- Delete Role Modal -->
<div class="modal fade" id="delete-role" tabindex="-1" role="dialog" aria-labelledby="delete-roleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteRoleForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-roleLabel">Delete Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="role_id_delete" name="role_id">
                    <p>Are you sure you want to delete this role?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Delete Role
        $('.delete-button').click(function() {
            var id = $(this).data('id');
            $('#role_id_delete').val(id);
            $('#delete-role').modal('show');
        });

        // Confirm Delete Role
        $('#deleteRoleForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url('/admin/roles/delete') ?>',
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