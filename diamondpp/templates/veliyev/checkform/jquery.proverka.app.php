<script>
$(document).ready(function(){
    $('.header_lang_current').on('click', function(e) {
        e.preventDefault();
        $(this).closest('.header_lang').toggleClass('opened');
    });
    $(document).on('click', function(e) {
        var $target = $(e.target);

        if ($target.closest('.header_lang').length) {
            return true;
        } else {
            $('.header_lang').removeClass('opened');
            return true;
        }
    });
});
</script>