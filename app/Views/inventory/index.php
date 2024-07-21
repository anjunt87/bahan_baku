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
                <div class="col-md-9">
                    <h4 class="page-title"><?= $title; ?></h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success px-4 float-end" data-toggle="modal" data-target="#inventory-in"> <i class="la la-chevron-down"></i> Stock In</button>
                        <button class="btn btn-danger px-4 float-end" data-toggle="modal" data-target="#inventory-out"> <i class="la la-chevron-up"></i> Stock Out</button>
                    </div>
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
                                            <th>No</th>
                                            <th>Items</th>
                                            <th>Total Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($totalStock as $item) : ?>
                                            <tr>
                                                <!-- <td><? //= $item['id_items'] 
                                                            ?></td> -->
                                                <td><?= $i++; ?></td>
                                                <td><?= $item['name_items'] ?></td>
                                                <td><?= $item['total_stock'] ?></td>
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
<?= $this->include('modal/inventory/modal-inventory-in') ?>
<?= $this->include('modal/inventory/modal-inventory-out') ?>
</body>
<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>