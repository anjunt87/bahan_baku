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
                    <button class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#add-suppliers"> <i class="la la-plus"></i>Add Suppliers</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Table Suppliers</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name Suppliers</th>
                                            <th>Production</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="suppliersTableBody">
                                        <?php if (!empty($suppliers)) : ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($suppliers as $supplier) : ?>
                                                <tr>
                                                    <th><?= $i++; ?></th>
                                                    <td><?= esc($supplier['name_suppliers']) ?></td>
                                                    <td><?= esc($supplier['production_suppliers']) ?></td>
                                                    <td><?= esc($supplier['contact_suppliers']) ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary edit-button" data-id="<?= esc($supplier['id_suppliers']) ?>" data-toggle="modal" data-target="#edit-suppliers"><i class="la la-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-danger delete-button" data-id="<?= esc($supplier['id_suppliers']) ?>" data-toggle="modal" data-target="#delete-suppliers"><i class="la la-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5">No suppliers available</td>
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
<?= $this->include('modal/suppliers/modal-add-suppliers') ?>
<?= $this->include('modal/suppliers/modal-edit-suppliers') ?>
<?= $this->include('modal/suppliers/modal-delete-suppliers') ?>
</body>
<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>