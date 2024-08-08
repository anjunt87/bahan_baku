 <!-- Delete Item Modal -->
 <div class="modal fade" id="delete-items" tabindex="-1" role="dialog" aria-labelledby="delete-itemsLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <form id="deleteItemForm">
                 <div class="modal-header">
                     <h5 class="modal-title" id="delete-itemsLabel">Delete Item</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <p>Are you sure you want to delete this item?</p>
                     <input type="hidden" id="id_items_delete" name="id_items_delete">
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-danger">Delete</button>
                 </div>
             </form>
         </div>
     </div>
 </div>


 <script>
     $(document).ready(function() {
         // Delete Role
         $('.delete-button').click(function() {
             var id = $(this).data('id');
             $('#id_items_delete').val(id);
             $('#delete-items').modal('show');
         });

         // Confirm Delete Role
         $('#deleteItemForm').submit(function(e) {
             e.preventDefault();
             $.ajax({
                 url: '<?= base_url('/admin/listitems/delete') ?>',
                 method: 'post',
                 data: $(this).serialize(),
                 success: function(response) {
                     if (response.success) {
                         location.reload();
                     } else {
                         alert(response.message);
                     }
                 }
             });
         });
     });
 </script>