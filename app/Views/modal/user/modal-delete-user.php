<!-- Modal -->
<div class="modal fade" id="delete-user" tabindex="-1" role="dialog" aria-labelledby="modalDeleteUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
                <input type="hidden" id="userIdDelete" name="userIdDelete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="deleteUserBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var userId = $(this).data('id');
            $('#userIdDelete').val(userId);
            $('#delete-user').modal('show');
        });

        $('#deleteUserBtn').click(function() {
            var userId = $('#userIdDelete').val();
            console.log("Deleting user with ID:", userId); // Tambahkan ini untuk debugging
            $.ajax({
                url: '<?= base_url('/admin/users/delete') ?>',
                type: 'POST',
                data: {
                    userId: userId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#delete-user').modal('hide');
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>