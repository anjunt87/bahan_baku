 <!-- Template Navbar -->
 <?= $this->include('template/header') ?>
 <!-- Template Navbar -->
 <?= $this->include('template/navbar') ?>
 <!-- Template SideBar -->
 <?= $this->include('template/sidebar') ?>
 <div class="main-panel">
     <div class="content">
         <div class="container-fluid">
             <div class="row mb-4">
                 <div class="col-md-6">
                     <h4 class="page-title"><?= $title; ?></h4>
                 </div>
             </div>
             <div id="responseMessageIn"></div>
             <div class="row">
                 <div class="col-md-12">
                     <div class="card">
                         <div class="card-body">
                             <h2 class="card-title">Bundle Details</h2>
                             <?php if ($bundledItems) : ?>
                                 <div class="order-summary mb-4">
                                     <div class="row">
                                         <div class="col-md-6">
                                             <p><strong>Bundle Name:</strong> <?= $bundle['bundle_name']; ?></p>
                                             <p><strong>Date Created:</strong> <?= $bundle['created_at']; ?></p>
                                         </div>
                                         <div class="col-md-6">
                                             <p><strong>Status :</strong>
                                                 <span id="statusBadge" class="badge">
                                                     <?php
                                                        $statusBadge = match ($bundle['status']) {
                                                            'approve' => '<span class="badge badge-success">Approve</span>',
                                                            'rejected' => '<span class="badge badge-danger">Rejected</span>',
                                                            default => '<span class="badge badge-secondary">Pending</span>',
                                                        };
                                                        echo $statusBadge;
                                                        ?>
                                                 </span>
                                             </p>
                                             <strong>Update Status :</strong>
                                             <?php
                                                // Mengatur warna toggle berdasarkan status dari server
                                                $toggleState = 'neutral'; // Default state

                                                if ($bundle['status'] === 'approve') {
                                                    $toggleState = 'on'; // Hijau jika statusnya approve
                                                } elseif ($bundle['status'] === 'rejected') {
                                                    $toggleState = 'off'; // Merah jika statusnya rejected
                                                }
                                                ?>
                                             <div class="toggle-button" id="toggleButton" data-id="<?= $bundle['id']; ?>" data-state="<?= $toggleState; ?>">
                                                 <div class="toggle-knob"></div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                                 <div class="order-items mt-4">
                                     <h4 class="mb-3">list item</h4>
                                     <!-- Items Table -->
                                     <table class="table table-bordered table-striped">
                                         <thead class="thead-dark">
                                             <tr>
                                                 <th>Item Name</th>
                                                 <th>Quantity Need</th>
                                                 <th>Status</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php foreach ($bundledItems as $item) : ?>
                                                 <tr>
                                                     <td><?= htmlspecialchars($item['item_name']) ?></td>
                                                     <td><?= htmlspecialchars($item['quantity']) ?></td>
                                                     <td id="statusBadge_<?= $item['id']; ?>">
                                                         <?php
                                                            $statusBadge = match ($item['status']) {
                                                                'stock_available' => '<span class="badge badge-success">Stock Available</span>',
                                                                'stock_not_available' => '<span class="badge badge-danger">Stock Not Available</span>',
                                                                default => '<span class="badge badge-secondary">Stock Needed</span>',
                                                            };
                                                            echo $statusBadge;
                                                            ?>
                                                     </td>
                                                     <td>
                                                         <button class="btn btn-xs btn-success" onclick="updateStatus(<?= $item['id']; ?>, 'stock_available')">Mark as Available</button>
                                                         <button class="btn btn-xs btn-danger" onclick="updateStatus(<?= $item['id']; ?>, 'stock_not_available')">Mark as Not Available</button>
                                                     </td>
                                                 </tr>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             <?php else : ?>
                                 <div class="alert alert-warning" role="alert">
                                     Item not found.
                                 </div>
                             <?php endif; ?>
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
 <script>
     function updateStatus(id, status) {
         $.ajax({
             url: '<?= base_url('/needitems/updateStatus'); ?>',
             type: 'POST',
             data: {
                 id: id,
                 status: status,
                 <?= csrf_token() ?>: '<?= csrf_hash() ?>'
             },
             success: function(response) {
                 $('#responseMessageIn').html('<div class="alert alert-success">Data updated successfully!</div>');

                 // Update status badge in the table
                 let badgeHtml;
                 if (status === 'stock_available') {
                     badgeHtml = '<span class="badge badge-success">Stock Available</span>';
                 } else if (status === 'stock_not_available') {
                     badgeHtml = '<span class="badge badge-danger">Stock Not Available</span>';
                 } else {
                     badgeHtml = '<span class="badge badge-secondary">Stock Needed</span>';
                 }

                 $('#statusBadge_' + id).html(badgeHtml);

                 console.log('Status updated successfully');
             },
             error: function(xhr, status, error) {
                 $('#responseMessageIn').html('<div class="alert alert-danger">Error: ' + error + '</div>');
                 console.error('Error updating status:', error);
             }
         });
     }
 </script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
     document.getElementById('toggleButton').addEventListener('click', function() {
         const toggleButton = this;
         const currentState = toggleButton.getAttribute('data-state');
         const id = toggleButton.getAttribute('data-id');

         let nextState;

         if (currentState === 'neutral') {
             nextState = 'on';
         } else if (currentState === 'on') {
             nextState = 'off';
         } else {
             nextState = 'neutral';
         }

         toggleButton.setAttribute('data-state', nextState);

         // Tentukan status yang akan dikirim ke server
         let status;
         if (nextState === 'on') {
             status = 'approve';
         } else if (nextState === 'off') {
             status = 'rejected';
         } else {
             status = 'pending';
         }

         // Kirim permintaan AJAX ke controller
         fetch('<?= base_url('/needitems/updateStatusBundles'); ?>', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json'
                 },
                 body: JSON.stringify({
                     id: id,
                     status: status
                 })
             })
             .then(response => response.json())
             .then(data => {
                 if (data.status === 'success') {
                     console.log('Status updated successfully');

                     // Update badge status
                     const statusBadge = document.getElementById('statusBadge');
                     let badgeHtml;

                     if (status === 'approve') {
                         badgeHtml = '<span class="badge badge-success">Approve</span>';
                     } else if (status === 'rejected') {
                         badgeHtml = '<span class="badge badge-danger">Rejected</span>';
                     } else {
                         badgeHtml = '<span class="badge badge-secondary">Pending</span>';
                     }

                     statusBadge.innerHTML = badgeHtml;

                 } else {
                     console.error('Failed to update status:', data.message || 'Unknown error');
                 }
             })
             .catch(error => console.error('Error:', error));
     });
 </script>


 <!-- Template Script 
    -->
 <?= $this->include('template/script') ?>

 </html>