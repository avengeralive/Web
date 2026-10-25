$(function () {
    $(document).on('click', '.delete_group', function () {
        if (!confirm("Удалить группу? ")) {
            return false;
        }
    })
    $(document).on('keyup', '#search', function () {

        $('#users tbody tr').show();

        var key = $(this).val();
        $('#users tbody tr').each(function () {
            var email = $(this).find('td:eq(1)').text();
            if (!email.match(key)) {
                $(this).hide();
            }

        })
    })
})