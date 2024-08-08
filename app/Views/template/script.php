<!-- <script src="<?= base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script> -->
<script src="<?= base_url() ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/chartist/chartist.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/js/ready.min.js"></script>
<!-- <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="<? //= base_url('assets/js/custom.js') 
                    ?>"></script> -->

<!-- Notif -->
<script src="https://cdn.rawgit.com/mouse0270/bootstrap-notify/3.1.3/bootstrap-notify.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchNotifications() {
            $.ajax({
                url: '<?= base_url('notifications/getLowStockNotifications'); ?>',
                method: 'GET',
                success: function(response) {
                    var notifCenter = $('#notif-center');
                    var notificationCount = $('#notification-count');
                    notifCenter.empty();

                    if (response.length > 0) {
                        notificationCount.text(response.length);
                        response.forEach(function(item) {
                            var notificationItem = `
                                    <a href="#" class="bg-danger text-white">
                                        <img src="<?= base_url('uploads/'); ?>/${item.image}" class="notif-icon" alt="${item.name_items}">
                                        <div class="notif-content">
                                            <span class="block">${item.name_items}</span>
                                            <span class="time text-white">Now only ${item.stock_items} pcs left</span>
                                        </div>
                                    </a>`;
                            notifCenter.append(notificationItem);
                        });
                    } else {
                        notificationCount.text('0');
                        notifCenter.append('<p class="text-center">No notifications</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching notifications:', error);
                }
            });
        }

        // Polling setiap 10 detik
        setInterval(fetchNotifications, 10000);
        fetchNotifications();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltip = document.getElementById('tooltip');
        if (tooltip) {
            const icons = document.querySelectorAll('.icon');

            icons.forEach(icon => {
                icon.addEventListener('mouseover', function(event) {
                    tooltip.innerText = icon.getAttribute('data-tooltip');
                    tooltip.style.display = 'block';
                    tooltip.style.left = event.pageX + 'px';
                    tooltip.style.top = event.pageY + 'px';
                });

                icon.addEventListener('mousemove', function(event) {
                    tooltip.style.left = event.pageX + 'px';
                    tooltip.style.top = event.pageY + 'px';
                });

                icon.addEventListener('mouseout', function() {
                    tooltip.style.display = 'none';
                });
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cartItems = []; // Array to store item IDs in the cart

        $(document).on('submit', '.add-to-cart-form-outbound', function(event) {
            event.preventDefault();

            var form = $(this);
            var formData = form.serialize();
            var itemId = form.find('input[name="item_id"]').val();

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        return;
                    }

                    // Tampilkan pesan sukses atau animasi
                    form.find('.add-to-cart-button').addClass('cart-animation-outbound');
                    $('#cart-icon-outbound').addClass('cart-animation-outbound');

                    setTimeout(function() {
                        form.find('.add-to-cart-button').removeClass('cart-animation-outbound');
                        $('#cart-icon-outbound').removeClass('cart-animation-outbound');
                    }, 500);

                    // Check if item is already in cart
                    if (!cartItems.includes(itemId)) {
                        // Update cart count only if item is not in cart
                        cartItems.push(itemId);
                        var cartCountElement = $('#cart-count-outbound');
                        if (cartCountElement.length) {
                            var newCartCount = parseInt(cartCountElement.text()) + 1;
                            cartCountElement.text(newCartCount).addClass('cart-count-update-outbound');

                            setTimeout(function() {
                                cartCountElement.removeClass('cart-count-update-outbound');
                            }, 500);
                        } else {
                            console.error("Cart count element not found");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan error
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cartItems = []; // Array to store item IDs in the cart

        $(document).on('submit', '.add-to-cart-form-preorder', function(event) {
            event.preventDefault();

            var form = $(this);
            var formData = form.serialize();
            var itemId = form.find('input[name="item_id"]').val();

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        return;
                    }

                    // Tampilkan pesan sukses atau animasi
                    form.find('.add-to-cart-button').addClass('cart-animation-preorder');
                    $('#cart-icon-preorder').addClass('cart-animation-preorder');

                    setTimeout(function() {
                        form.find('.add-to-cart-button').removeClass('cart-animation-preorder');
                        $('#cart-icon-preorder').removeClass('cart-animation-preorder');
                    }, 500);

                    // Check if item is already in cart
                    if (!cartItems.includes(itemId)) {
                        // Update cart count only if item is not in cart
                        cartItems.push(itemId);
                        var cartCountElement = $('#cart-count-preorder');
                        if (cartCountElement.length) {
                            var newCartCount = parseInt(cartCountElement.text()) + 1;
                            cartCountElement.text(newCartCount).addClass('cart-count-update-preorder');

                            setTimeout(function() {
                                cartCountElement.removeClass('cart-count-update-preorder');
                            }, 500);
                        } else {
                            console.error("Cart count element not found");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan error
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.edit-button').click(function() {
            const id = $(this).data('id');
            $.get('<?= base_url('admin/department/edit'); ?>/' + id, function(data) {
                $('#editDepartmentId').val(data.id);
                $('#editDepartmentName').val(data.name);
                $('#editDepartmentDescription').val(data.description);
                $('#editDepartmentForm').attr('action', '<?= base_url('admin/department/update'); ?>/' + id);
            });
        });

        $('.delete-button').click(function() {
            const id = $(this).data('id');
            $('#deleteDepartmentId').val(id);
            $('#deleteDepartmentForm').attr('action', '<?= base_url('admin/department/delete'); ?>/' + id);
        });

        // Similar scripts for divisions
        $('.edit-button').click(function() {
            const id = $(this).data('id');
            $.get('<?= base_url('admin/division/edit'); ?>/' + id, function(data) {
                $('#editDivisionId').val(data.id);
                $('#editDepartmentId').val(data.department_id);
                $('#editDivisionName').val(data.name);
                $('#editDivisionDescription').val(data.description);
                $('#editDivisionForm').attr('action', '<?= base_url('admin/division/update'); ?>/' + id);
            });
        });

        $('.delete-button').click(function() {
            const id = $(this).data('id');
            $('#deleteDivisionId').val(id);
            $('#deleteDivisionForm').attr('action', '<?= base_url('admin/division/delete'); ?>/' + id);
        });
    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>