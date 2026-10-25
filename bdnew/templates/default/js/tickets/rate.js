$(function () {

    $(document).on('click', '.js-rate-ticket', function () {
        var req = $(this).data();
        var that = this;
        $.post('?', req, function () {
            $(that).parent().html('<b>Спасибо, ваш голос учтен!');
        })

        return false;
    })
});