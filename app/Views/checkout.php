<!-- Template Navbar -->
<?= $this->include('template/header') ?>
<!-- Template Navbar -->
<?= $this->include('template/navbar') ?>
<!-- Template SideBar -->
<?= $this->include('template/sidebar') ?>
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4 class="page-title"><?= $title; ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (empty($cartItems)) : ?>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <!-- Button to trigger modal for adding items -->
                                <a href="<?= base_url('/items') ?>" class="btn btn-success mb-2">
                                    <i class="bi bi-plus"></i> Add Items
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-warning" role="alert">
                                    Your item is empty.
                                </div>
                            <?php else : ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="mb-4">Checkout</h1>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Image</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($cartItems as $cartItem) : ?>
                                                            <tr>
                                                                <td><?= $cartItem['item']['name_items']; ?></td>
                                                                <td><img src="<?= base_url('uploads/' . $cartItem['item']['image']); ?>" alt="<?= $cartItem['item']['name_items']; ?>" class="img-thumbnail" style="width: 80px; height: 80px;"></td>
                                                                <td><?= $cartItem['quantity']; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <form action="/checkout/process" method="post">
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

                                                    <div class="form-group">
                                                        <label for="usersSelectIn">Recipient Name</label>
                                                        <select class="form-control" id="usersSelectIn" name="recipient_name" required>
                                                            <option value="">Select Users</option>
                                                            <!-- Options will be loaded here based on selected division -->
                                                        </select>
                                                    </div>

                                                    <a href="/cart" class="btn btn-danger me-2">Back</a>
                                                    <button type="submit" class="btn btn-primary me-2">Pickup Item</button>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template SideBar -->
<?= $this->include('template/footer') ?>
</div>
</div>
</div>
</div>
</body>
<!-- Template Script -->
<?= $this->include('template/script') ?>
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

                        // Clear users select
                        $('#usersSelectIn').empty().append('<option value="">Select Users</option>');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching divisions:', error);
                    }
                });
            } else {
                // Clear division select if no department is selected
                $('#divisionId').empty().append('<option value="">Select Division</option>');
                // Clear users select
                $('#usersSelectIn').empty().append('<option value="">Select Users</option>');
            }
        });

        // Fetch users based on selected division
        $('#divisionId').change(function() {
            var divisionId = $(this).val();
            if (divisionId) {
                $.ajax({
                    url: `/divisioncontroller/getUsersByDivision/${divisionId}`, // URL to fetch users by division
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var usersSelect = $('#usersSelectIn');
                        usersSelect.empty().append('<option value="">Select Users</option>');

                        response.forEach(function(item) {
                            usersSelect.append(`<option value="${item.user_id}">${item.user_name}</option>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching users:', error);
                    }
                });
            } else {
                // Clear users select if no division is selected
                $('#usersSelectIn').empty().append('<option value="">Select Users MO</option>');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Fetch users
        $.ajax({
            url: '<?= base_url('/checkout/getUsers') ?>',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#usersSelectIn').empty().append('<option value="">Select Users</option>');
                $.each(data, function(index, users) {
                    $('#usersSelectIn').append('<option value="' + users.user_id + '">' + users.user_name + ' (' + users.role_id + ')' + '</option>');
                });
            }
        });
    });
</script>

</html>