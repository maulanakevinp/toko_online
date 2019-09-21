$(function() {
    $('.form-check-input').on('click', function() {

        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');
        console.log('tes');

        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        });

    });
});