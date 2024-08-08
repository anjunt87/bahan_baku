<!-- Modal -->
<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="modalEditUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditUserForm">
                    <input type="hidden" id="userId" name="userId">
                    <div class="form-group">
                        <label for="userNameEdit">User Name</label>
                        <input type="text" class="form-control" id="userNameEdit" name="userNameEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="userEmailEdit">User Email</label>
                        <input type="email" class="form-control" id="userEmailEdit" name="userEmailEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="roleIdEdit">Role ID</label>
                        <input type="number" class="form-control" id="roleIdEdit" name="roleIdEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="departmentIdEdit">Department</label>
                        <select class="form-control" id="departmentIdEdit" name="departmentIdEdit" required>
                            <option value="">Select Department</option>
                            <!-- Options will be loaded here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="divisionIdEdit">Division</label>
                        <select class="form-control" id="divisionIdEdit" name="divisionIdEdit" required>
                            <option value="">Select Division</option>
                            <!-- Options will be loaded here based on selected department -->
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Function to load departments into the select
        function loadDepartments() {
            $.ajax({
                url: '<?= base_url('/divisioncontroller/getDivisions') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var departmentSelect = $('#departmentIdEdit');
                    var divisions = response;
                    var departments = [];

                    departmentSelect.empty().append('<option value="">Select Department</option>');

                    divisions.forEach(function(item) {
                        if (!departments[item.department_id]) {
                            departments[item.department_id] = item.department_name;
                            departmentSelect.append(`<option value="${item.department_id}">${item.department_name}</option>`);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching departments:', error);
                }
            });
        }

        // Function to load divisions based on selected department
        function loadDivisions(departmentId) {
            $.ajax({
                url: `/divisioncontroller/getDivisionsByDepartment/${departmentId}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var divisionSelect = $('#divisionIdEdit');
                    divisionSelect.empty().append('<option value="">Select Division</option>');

                    response.forEach(function(item) {
                        divisionSelect.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching divisions:', error);
                }
            });
        }

        // Load departments when the page is ready
        loadDepartments();

        // Load division options based on department selection
        $('#departmentIdEdit').change(function() {
            var departmentId = $(this).val();
            if (departmentId) {
                loadDivisions(departmentId);
            } else {
                $('#divisionIdEdit').empty().append('<option value="">Select Division</option>');
            }
        });

        // Populate form fields when edit button is clicked
        $('.edit-button').click(function() {
            var userId = $(this).data('id');
            $.ajax({
                url: '<?= base_url('/admin/users/edit') ?>/' + userId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#userId').val(response.data.user_id);
                        $('#userNameEdit').val(response.data.user_name);
                        $('#userEmailEdit').val(response.data.user_email);
                        $('#roleIdEdit').val(response.data.role_id);
                        $('#departmentIdEdit').val(response.data.department_id).trigger('change'); // Trigger change to update divisions
                        $('#divisionIdEdit').val(response.data.division_id);
                    } else {
                        alert(response.message);
                    }
                }
            });
        });

        // Handle form submission
        $('#EditUserForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url('/admin/users/update') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#edit-user').modal('hide');
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while processing your request.');
                }
            });
        });
    });
</script>