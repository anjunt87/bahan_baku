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
                    <button class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#add-division"> <i class="la la-plus"></i>Add Division</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Table Divisions</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Department Name</th>
                                            <th>Division Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="divisionTableBody">
                                        <?php $i = 1 ?>
                                        <?php if (!empty($divisions)) : ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($divisions as $division) : ?>
                                                <tr>
                                                    <th><?= $i++; ?></th>
                                                    <td><?= esc($division['department_name']) ?></td>
                                                    <td><?= esc($division['name']) ?></td>
                                                    <td><?= esc($division['description']) ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary edit-button" data-id="<?= esc($division['id']) ?>" data-toggle="modal" data-target="#edit-division"><i class="la la-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-danger delete-button" data-id="<?= esc($division['id']) ?>" data-toggle="modal" data-target="#delete-division"><i class="la la-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5">No divisions available</td>
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
<?= $this->include('modal/division/modal-add-division') ?>
<?= $this->include('modal/division/modal-edit-division') ?>
<?= $this->include('modal/division/modal-delete-division') ?>
<!-- Template Script -->
<?= $this->include('template/script') ?>