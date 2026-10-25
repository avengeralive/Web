$(document).ready(function() {
    $('a[href^="#"]').click(function (){
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        jQuery("html:not(:animated), body:not(:animated)").animate({scrollTop: destination}, 800);
        return false;
    });
    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        nav:true,
        margin:10,
    });

    // var date = new Date(year, month, date[hours, minutes, seconds, ms] )

    // var den=date.getDate();
    // alert(den);
    var myDate = new Date();

//add a day to the date

    // alert(myDate.setDate(myDate.getDate() + 1));
});