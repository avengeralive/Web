$(document).ready(function() {
    $('.widget-contact').on('click', function(e) {
        e.preventDefault();

        $('.contact-backdrop').show();
        $('.contact-popup[data-widget-id="' + $(this).attr('id') + '"]').show();
        $('.contact-error-tooltip[data-uid="' + $(this).attr('id') + '"]').show();
    });

    $('.contact-close, .contact-backdrop').on('click', function() {
        $('.contact-backdrop').hide();
        $('.contact-popup').hide();
        $('.contact-error-tooltip').hide();
    });
});