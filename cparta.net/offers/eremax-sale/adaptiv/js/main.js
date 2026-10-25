$(document).ready(function() {
    $('.answert_btn').click(function() {
        $('.question_field').fadeOut(300);
        setTimeout(() => {     
            $('.result_field').fadeIn(300);
        }, 300);
    });
    $("a").click(function() {
        $("html, body").animate({
           scrollTop: $($(this).attr("href")).offset().top + "px"
        }, {
           duration: 500,
           easing: "swing"
        });
        return false;
     });
});