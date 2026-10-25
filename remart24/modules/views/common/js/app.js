/**
 * Created on 28/11/2017.
 */

$(function () {
    if ($('.qbit_custom_ajax_form').length > 0) {
        $("button[data-form-request=ajax]").on("click", function (e) {
            e.preventDefault();
            var temp_this = this
            $(temp_this).prop('disabled', true);
            var form = $(this).parents("form:first");
            var postData = form.serializeArray();
            var formURL = form.attr("action");
            var formMethod = form.attr("method");
            var formCallback = form.attr("data-callback");
            $.ajax({
                url: formURL,
                type: formMethod,
                data: postData,
                dataType: 'json',
                success: function (result) {
                    window[formCallback](result);
                },
                error: function (error) {
                    console.log(error);
                },
                complete: function(){
                    $(temp_this).prop('disabled', false);
                }
            });
        });
    }
});
