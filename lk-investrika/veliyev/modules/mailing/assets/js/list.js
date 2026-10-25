$(function () {
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.height = 600;
    CKEDITOR.replace('mailBody')
    
    $(document).on('click', '.new-mailing button[type="button"]', function () {
        $('.new-mailing').find('[name="save"]').val($(this).attr('value'));
        $('.new-mailing').submit();
    });
    $(document).on('submit', '.new-mailing', function () {
        if ($(this).find('[name="save"]').val() == 'db') {
            return true;
        }
        var body = CKEDITOR.instances.mailBody.getData();
        $(this).find('[name="body"]').val(body);
        $(this).ajaxSubmit({
            dataType: 'json',
            success: function (res) {
                debugger;
                if (res.status == 1) {
                    $('#status').html('Отослано').fadeIn();
                    setTimeout(function () {
                        $('#status').fadeOut();
                    }, 3000);
                }
            }
        })
        return false;
    })
})