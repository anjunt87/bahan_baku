<div class="modal fade" id="edit-department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="post" id="editDepartmentForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editDepartmentId" name="id">
                    <div class="form-group">
                        <label for="editDepartmentName">Department Name</label>
                        <input type="text" class="form-control" id="editDepartmentName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editDepartmentDescription">Description</label>
                        <textarea class="form-control" id="editDepartmentDescription" name="description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>