<div class="modal fade" id="edit-division" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="post" id="editDivisionForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Division</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editDivisionId" name="id">
                    <div class="form-group">
                        <label for="editDepartmentId">Department</label>
                        <select class="form-control" id="editDepartmentId" name="department_id" required>
                            <?php foreach ($departments as $department) : ?>
                                <option value="<?= esc($department['id']) ?>"><?= esc($department['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editDivisionName">Division Name</label>
                        <input type="text" class="form-control" id="editDivisionName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editDivisionDescription">Description</label>
                        <textarea class="form-control" id="editDivisionDescription" name="description" required></textarea>
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