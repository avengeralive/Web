$(function () {
    $(document).on('blur', 'textarea.js-admin-comments', function () {
        var that = this;
        $.post('?', {
            action: 'save_admin_comments',
            text: $(this).val(),
            id: $(this).data('id')
        }, function () {
            $(that).css('background', '#eeffee');
            setTimeout(function () {
                $(that).css('background', 'white');
            }, 500);
        })
    })
})