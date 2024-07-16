$(document).ready(function() {
    $('#saveSuppliers').click(function() {
        var formData = $('#suppliersForm').serialize();

        $.ajax({
            // url: '<?= site_url('admin/suppliers/add') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.success);
                    $('#suppliersModal').modal('hide');
                    $('#suppliersForm')[0].reset();
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});
