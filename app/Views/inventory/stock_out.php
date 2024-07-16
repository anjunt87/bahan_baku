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
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Stock Out</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Item</th>
                                            <th>Suppliers</th>
                                            <th>Taking</th>
                                            <th>Taken by</th>
                                            <th>Noted by</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($stockOut as $stock) : ?>
                                            <tr>
                                                <!-- <td><? //= $stock['id_inventory']
                                                            ?></td> -->
                                                <td><?= $i++; ?></td>
                                                <td><?= $stock['name_items'] ?></td>
                                                <td><?= $stock['name_suppliers'] ?></td>
                                                <td><?= str_replace('-', '', $stock['stock_items']); ?></td>
                                                <td><?= $stock['taken_by'] ?></td>
                                                <td><?= $stock['noted_by'] ?></td>
                                                <td><?= $stock['date_update'] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning edit-button" data-toggle="modal" data-target="#edit-items"><i class="la la-file-text"></i> Details</button>
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
</body>
<!-- Template Script -->
<?= $this->include('template/script') ?>

</html>