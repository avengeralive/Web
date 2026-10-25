$(document).ready(function() {

$('.owl-carousel').owlCarousel({

    responsive: {
    	0: {
    		items: 1
    	},

        767: {
        	items: 2
        }
    },

     loop: true


});

$(".owl-prev").empty();
$(".owl-next").empty();

$(".item_btn a").click(function() {
    var elementClick = $(this).attr("href")
    var destination = $(elementClick).offset().top - 0 + 'px';
    jQuery("html:not(:animated),body:not(:animated)").animate({
        scrollTop: destination
    }, 1000);
    return false;
});


$(window).resize(function() {
    if ($(window).width() <= '480') {
        $('.desktop footer .form').removeAttr("id");
        $('.mobile footer .form').attr("id", 'form');
    } else {
        $('.mobile footer .form').removeAttr("id");
        $('.desktop footer .form').attr("id", 'form');
    }

});

if ($(window).width() <= '480') {
    $('.desktop footer .form').removeAttr("id");
    $('.mobile footer .form').attr("id", 'form');
} else {
    $('.mobile footer .form').removeAttr("id");
    $('.desktop footer .form').attr("id", 'form');
}

wow = new WOW({
        mobile: false,
    })
    wow.init();

});


