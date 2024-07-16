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
                <!-- <div class="col-md-4"></div> -->
                <!-- <div class="col-md-2"> -->
                <div class="row">
                    <button class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#inventory-in"> <i class="la la-chevron-down"></i> Stock In</button>
                    <button class="btn btn-danger mb-2 ml-2" data-toggle="modal" data-target="#inventory-out"> <i class="la la-chevron-up"></i> Stock Out</button>
                    <!-- <a class="btn btn-success mb-2 ml-2" href="inventory/stockIn"> <i class="la la-plus"></i> View Stock In</a>
                    <a class="btn btn-danger mb-2 ml-2" href="inventory/stockOut"> <i class="la la-plus"></i> View Stock In</a> -->
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