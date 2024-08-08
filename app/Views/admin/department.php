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
                    <button class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#add-department"> <i class="la la-plus"></i>Add Department</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Table Departments</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Department Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="departmentTableBody">
                                        <?php if (!empty($departments)) : ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($departments as $department) : ?>
                                                <tr>
                                                    <th><?= $i++; ?></th>
                                                    <td><?= esc($department['name']) ?></td>
                                                    <td><?= esc($department['description']) ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary edit-button" data-id="<?= esc($department['id']) ?>" data-toggle="modal" data-target="#edit-department"><i class="la la-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-danger delete-button" data-id="<?= esc($department['id']) ?>" data-toggle="modal" data-target="#delete-department"><i class="la la-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4">No departments available</td>
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
<!-- Template Footer -->
<?= $this->include('template/footer') ?>
<!-- Modals -->
<?= $this->include('modal/department/modal-add-department') ?>
<?= $this->include('modal/department/modal-edit-department') ?>
<?= $this->include('modal/department/modal-delete-department') ?>
<!-- Template Script -->
<?= $this->include('template/script') ?>