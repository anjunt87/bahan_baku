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
                    <button class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#add-role"> <i class="la la-plus"></i> Add Role</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Table Roles</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Role Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rolesTableBody">
                                        <?php if (!empty($roles)) : ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($roles as $role) : ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= esc($role['role_id']) ?></td>
                                                    <td><?= esc($role['role_name']) ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary edit-button" data-id="<?= esc($role['role_id']) ?>" data-toggle="modal" data-target="#edit-role"><i class="la la-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-danger delete-button" data-id="<?= esc($role['role_id']) ?>" data-toggle="modal" data-target="#delete-role"><i class="la la-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4">No roles available</td>
                                            </tr>
                                        <?php endif; ?>
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
<!-- Template SideBar -->
<?= $this->include('template/footer') ?>
</div>
</div>
</div>
</div>
<!-- Modal Pop Up-->
<?= $this->include('modal/roles/modal-add-role') ?>
<?= $this->include('modal/roles/modal-edit-role') ?>
<?= $this->include('modal/roles/modal-delete-role') ?>
</body>
<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>