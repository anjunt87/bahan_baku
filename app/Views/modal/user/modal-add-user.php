<!-- Modal -->
<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="modalAddUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="AddUserForm">
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" class="form-control" id="userName" name="userName" required>
                    </div>
                    <div class="form-group">
                        <label for="userEmail">User Email</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="userPassword">User Password</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="roleId">Role ID</label>
                        <input type="number" class="form-control" id="roleId" name="roleId" required>
                    </div>
                    <div class="form-group">
                        <label for="departmentId">Department</label>
                        <select class="form-control" id="departmentId" name="departmentId" required>
                            <option value="">Select Department</option>
                            <!-- Options will be loaded here -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="divisionId">Division</label>
                        <select class="form-control" id="divisionId" name="divisionId" required>
                            <option value="">Select Division</option>
                            <!-- Options will be loaded here based on selected department -->
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#AddUserForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url('/admin/users/save') ?>', // Pastikan base_url sudah benar
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#add-user').modal('hide');
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
<script>
    $(document).ready(function() {
        // Fetch departments
        $.ajax({
            url: '/divisioncontroller/getDivisions', // URL to fetch all divisions with departments
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var departmentSelect = $('#departmentId');
                var divisions = response;
                var departments = [];

                // Populate department select
                divisions.forEach(function(item) {
                    if (!departments[item.department_id]) {
                        departments[item.department_id] = item.department_name;
                        departmentSelect.append(`<option value="${item.department_id}">${item.department_name}</option>`);
                    }
                });

                // Populate initial division select
                updateDivisionSelect(departments);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching departments and divisions:', error);
            }
        });

        // Fetch divisions based on selected department
        $('#departmentId').change(function() {
            var departmentId = $(this).val();
            if (departmentId) {
                $.ajax({
                    url: `/divisioncontroller/getDivisionsByDepartment/${departmentId}`, // URL to fetch divisions by department
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var divisionSelect = $('#divisionId');
                        divisionSelect.empty().append('<option value="">Select Division</option>');

                        response.forEach(function(item) {
                            divisionSelect.append(`<option value="${item.id}">${item.name}</option>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching divisions:', error);
                    }
                });
            } else {
                // Clear division select if no department is selected
                $('#divisionId').empty().append('<option value="">Select Division</option>');
            }
        });
    });
</script>