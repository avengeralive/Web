$(function () {

    sliderHomepage();
    sliders();
    fullScreenContainer();
    menuSliding();
    
    $('.button-s').click(function () {
        $(".popup").fadeIn(500);
        $("body").append("<div id='overlay'></div>");
        $('#overlay').show().css('opacity','0.8');                         
        $('a.close, #overlay').click(function () {
            $('.popup').fadeOut(100);
            $('#overlay').remove();
            return false;
        });
        $('.popup').click(function(e){
            e.stopPropagation();    
        });
        return false;                
    });

});

/* for demo purpose only - can be deleted */


/* slider homepage */

function sliderHomepage() {
    if ($('#slider').length) {
	var owl = $("#slider");

	$("#slider").owlCarousel({
	    autoPlay: 3000,
	    items: 2,
	    itemsDesktopSmall: [900, 3],
	    itemsTablet: [600, 3],
	    itemsMobile: [500, 2]
	});
    }

}
/* sliders */

function sliders() {
    if ($('.owl-carousel').length) {

	$(".customers").owlCarousel({
	    items: 6,
	    itemsDesktopSmall: [990, 4],
	    itemsTablet: [768, 2],
	    itemsMobile: [480, 1]
	});

	$(".testimonials").owlCarousel({
	    items: 2,
        itemsDesktop: [1200, 2],
        itemsDesktopSmall: [990, 2],
	    itemsTablet: [768, 2],
	    itemsMobile: [480, 1]
	});

	$('.project').owlCarousel({
	    navigation: true, // Show next and prev buttons
	    navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
	    slideSpeed: 300,
	    paginationSpeed: 400,
	    autoPlay: true,
	    stopOnHover: true,
	    singleItem: true,
	    afterInit: '',
	    lazyLoad: true
	});

	$('.homepage').owlCarousel({
	    navigation: false, // Show next and prev buttons
	    navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
	    slideSpeed: 2000,
	    paginationSpeed: 1000,
	    autoPlay: true,
	    stopOnHover: true,
	    singleItem: true,
	    lazyLoad: false,
	    addClassActive: true,
	    afterInit: function () {
		//animationsSlider();
	    },
	    afterMove: function () {
		//animationsSlider();
	    }
	});
    }

}



/* menu sliding */

function menuSliding() {


    $('.dropdown').on('show.bs.dropdown', function (e) {

	if ($(window).width() > 750) {
	    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();

	}
	else {
	    $(this).find('.dropdown-menu').first().stop(true, true).show();
	}
    }

    );
    $('.dropdown').on('hide.bs.dropdown', function (e) {
	if ($(window).width() > 750) {
	    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
	}
	else {
	    $(this).find('.dropdown-menu').first().stop(true, true).hide();
	}
    });

}

/* animations */



function animationsSlider() {

    var delayTimeSlider = 400;

    $('.owl-item:not(.active) [data-animate-always]').each(function () {

	$(this).removeClass('animated');
	$(this).removeClass($(this).data('animate-always'));
	$(this).stop(true, true, true).css({opacity: 0});

    });

    $('.owl-item.active [data-animate-always]').each(function () {
	delayTimeSlider += 500;

	$(this).delay(delayTimeSlider).queue(function (next) {
	    $(this).addClass('animated');
	    $(this).addClass($(this).data('animate-always'));

	    console.log($(this).data('animate-always'));

	});
    });



}




/* picture zoom */


/* full screen intro */

function fullScreenContainer() {

    var screenWidth = $(window).width() + "px";

    if ($(window).height() > 500) {
	var screenHeight = $(window).height() + "px";
    }
    else {
	var screenHeight = "500px";
    }


    $("#intro, #intro .item").css({
	width: screenWidth,
	height: screenHeight
    });
}

/* product detail gallery */



/* product detail sizes */



$.fn.alignElementsSameHeight = function () {
    $('.same-height-row').each(function () {

	var maxHeight = 0;
	var children = $(this).find('.same-height');
	children.height('auto');
	if ($(window).width() > 768) {
	    children.each(function () {
		if ($(this).innerHeight() > maxHeight) {
		    maxHeight = $(this).innerHeight();
		}
	    });
	    children.innerHeight(maxHeight);
	}

	maxHeight = 0;
	children = $(this).find('.same-height-always');
	children.height('auto');
	children.each(function () {
	    if ($(this).height() > maxHeight) {
		maxHeight = $(this).innerHeight();
	    }
	});
	children.innerHeight(maxHeight);

    });
}

