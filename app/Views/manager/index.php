 <!-- Template Navbar -->
 <?= $this->include('template/header') ?>
 <!-- Template Navbar -->
 <?= $this->include('template/navbar') ?>
 <!-- Template SideBar -->
 <?= $this->include('template/sidebar') ?>
 <div class="main-panel">
     <div class="content">
         <div class="container-fluid">
             <h4 class="page-title">Dashboard</h4>
             <div class="row">
                 <div class="col-md-3">
                     <div class="card card-stats card-warning">
                         <div class="card-body ">
                             <div class="row">
                                 <div class="col-5">
                                     <div class="icon-big text-center">
                                         <i class="la la-users"></i>
                                     </div>
                                 </div>
                                 <div class="col-7 d-flex align-items-center">
                                     <div class="numbers">
                                         <p class="card-category">Users</p>
                                         <h4 class="card-title"><?= $users; ?></h4>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="card card-stats card-success">
                         <div class="card-body ">
                             <div class="row">
                                 <div class="col-5">
                                     <div class="icon-big text-center">
                                         <i class="la la-plus-circle"></i>
                                     </div>
                                 </div>
                                 <div class="col-7 d-flex align-items-center">
                                     <div class="numbers">
                                         <p class="card-category">In</p>
                                         <h4 class="card-title"><?= $totalInboundItems; ?></h4>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="card card-stats card-danger">
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-5">
                                     <div class="icon-big text-center">
                                         <i class="la la-minus-circle"></i>
                                     </div>
                                 </div>
                                 <div class="col-7 d-flex align-items-center">
                                     <div class="numbers">
                                         <p class="card-category">Out</p>
                                         <h4 class="card-title"><?= $out; ?></h4>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="card card-stats card-primary">
                         <div class="card-body ">
                             <div class="row">
                                 <div class="col-5">
                                     <div class="icon-big text-center">
                                         <i class="la la-check-circle"></i>
                                     </div>
                                 </div>
                                 <div class="col-7 d-flex align-items-center">
                                     <div class="numbers">
                                         <p class="card-category">Pre Order</p>
                                         <h4 class="card-title"><?= $po; ?></h4>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-6">
                     <div class="card">
                         <div class="card-header ">
                             <h4 class="card-title">Bundle Items Approve</h4>
                         </div>
                         <div class="card-body">
                             <table class="table table-head-bg-success table-striped table-hover">
                                 <thead class="thead-dark">
                                     <tr>
                                         <th>Bundle Item Name</th>
                                         <th>Date</th>
                                         <th>Status</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php foreach ($bundledItemsApprove as $item) : ?>
                                         <tr>
                                             <td><?= $item['bundle_name'] ?></td>
                                             <td><?= $item['created_at'] ?></td>
                                             <td>
                                                 <?php
                                                    $statusBadge = match ($item['status']) {
                                                        'approve' => '<span class="badge badge-success">Approve</span>',
                                                        'rejected' => '<span class="badge badge-danger">Rejected</span>',
                                                        default => '<span class="badge badge-secondary">Pending</span>',
                                                    };
                                                    echo $statusBadge;
                                                    ?>
                                             </td>
                                             <td><a href="/needitems/detail/<?= $item['id']; ?>" class="btn btn-info btn-sm">Detail</a></td>
                                         </tr>
                                     <?php endforeach; ?>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="card">
                         <div class="card-header ">
                             <h4 class="card-title">Bundle Items Rejected</h4>
                         </div>
                         <div class="card-body">
                             <table class="table table-head-bg-danger table-striped table-hover">
                                 <thead class="thead-dark">
                                     <tr>
                                         <th>Bundle Item Name</th>
                                         <th>Date</th>
                                         <th>Status</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php foreach ($bundledItemsRejected as $item) : ?>
                                         <tr>
                                             <td><?= $item['bundle_name'] ?></td>
                                             <td><?= $item['created_at'] ?></td>
                                             <td>
                                                 <?php
                                                    $statusBadge = match ($item['status']) {
                                                        'approve' => '<span class="badge badge-success">Approve</span>',
                                                        'rejected' => '<span class="badge badge-danger">Rejected</span>',
                                                        default => '<span class="badge badge-secondary">Pending</span>',
                                                    };
                                                    echo $statusBadge;
                                                    ?>
                                             </td>
                                             <td><a href="/needitems/detail/<?= $item['id']; ?>" class="btn btn-info btn-sm">Detail</a></td>
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
 </div>
 </div>
 </div>

 </body>
 <!-- Template Script -->
 <?= $this->include('template/script') ?>

 </html>