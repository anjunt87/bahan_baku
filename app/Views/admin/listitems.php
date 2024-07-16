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
                    <!-- <button class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#add-items"> <i class="la la-plus"></i> Add Items</button> -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Table Items</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name Items</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemsTableBody">
                                        <?php $i = 1 ?>
                                        <?php foreach ($listitems as $l) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= esc($l['name_items']) ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary edit-button" data-id="<?= esc($l['id_items']) ?>" data-toggle="modal" data-target="#edit-items"><i class="la la-edit"></i></button>
                                                    <button type="button" class="btn btn-sm btn-danger delete-button" data-id="<?= esc($l['id_items']) ?>" data-toggle="modal" data-target="#delete-items"><i class="la la-trash"></i></button>
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
<!-- Template SideBar -->
<?= $this->include('template/footer') ?>
</div>
</div>
</div>
</div>
<!-- Modal Pop Up-->
<?= $this->include('modal/items/modal-add-items') ?>
<?= $this->include('modal/items/modal-edit-items') ?>
<?= $this->include('modal/items/modal-delete-items') ?>
</body>
<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>