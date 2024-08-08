<!-- Template Navbar -->
<?= $this->include('template/header') ?>
<!-- Template Navbar -->
<?= $this->include('template/navbar') ?>
<!-- Template SideBar -->
<?= $this->include('template/sidebar') ?>

<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="page-title"><?= $title; ?></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <button class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#add-user"> <i class="la la-plus"></i>Add User</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Table Users</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Department</th>
                                            <th>Division</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTableBody">
                                        <?php $i = 1 ?>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <th><?= $i++; ?></th>
                                                <td><?= esc($user['user_name']) ?></td>
                                                <td><?= esc($user['user_email']) ?></td>
                                                <td><?= esc($user['role_id']) ?></td>
                                                <td><?= esc($user['department_id']) ?></td>
                                                <td><?= esc($user['division_id']) ?></td>
                                                <td><?= esc($user['user_created_at']) ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-button" data-id="<?= esc($user['user_id'])?>" data-toggle="modal" data-target="#edit-user"><i class="la la-edit"></i></button>
                                                    <button type="button" class="btn btn-sm btn-danger delete-button" data-id="<?= esc($user['user_id']) ?>" data-toggle="modal" data-target="#delete-user"><i class="la la-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Template Footer -->
<?= $this->include('template/footer') ?>
<!-- Modals -->
<?= $this->include('modal/user/modal-add-user') ?>
<?= $this->include('modal/user/modal-edit-user') ?>
<?= $this->include('modal/user/modal-delete-user') ?>
<!-- Template Script -->
<?= $this->include('template/script') ?>