
function valid_name() {
    var value = this.value;
    var rep = /[^A-Za-zА-Яа-пр-яЁё\s]/;
    if (rep.test(value)) {
        value = value.replace(rep, '');
        this.value = value;
    }
}
function valid_email() {
    var value = this.value;
    var rep = /[^A-Za-z0-9\.\-_@]/;
    if (rep.test(value)) {
        value = value.replace(rep, '');
        this.value = value;
    }
}

jQuery(document).ready(function($){
    $('.read_more_toggle').on('click', function () {
            if ($(this).prev('.read_more').css('height') == '78px') {
                $(this).prev('.read_more').animate({
                    'height': $(this).prev('.read_more').get(0).scrollHeight
                }, 500);
                $(this).html('Свернуть');
            } else {
                $(this).prev('.read_more').animate({
                    'height': '78px'
                }, 500);
                $(this).html('Читать далее');
            }
        });
    jQuery(".yakor").on("click","a", function (event) {
        event.preventDefault();
        var id  = jQuery(this).attr('href');
        var    top = jQuery(id).offset().top-50;
        jQuery('body,html').animate({scrollTop: top}, 300);
    });

    jQuery("#edit-submitted-vashe-imya--2").on("keyup", valid_name);
    jQuery("#edit-submitted-vashe-imya").on("keyup", valid_name);
    jQuery("#edit-submitted-name").on("keyup", valid_name);
    jQuery("#edit-submitted-fio").on("keyup", valid_name);
    jQuery("#edit-submitted-e-mail").on("keyup", valid_email);
    jQuery("#edit-submitted-vash-e-mail").on("keyup", valid_email);
    jQuery(document).on("keyup","#edit-submitted-fio", valid_name);
    jQuery(document).on("keyup","#edit-submitted-e-mail", valid_email);
    jQuery(document).on("click","#edit-submitted-kontaktnyy-telefon", function(){
        jQuery(this).mask("8(999)9999999");
    });


    jQuery( function($){
        $("#edit-submitted-kontaktnyy-telefon").mask("8(999)9999999");
        $("#edit-submitted-vash-telefon").mask("8(999)9999999");
        $("#edit-submitted-vash-telefon--2").mask("8(999)9999999");
        $("#edit-submitted-phone").mask("8(999)9999999");
    });
});
