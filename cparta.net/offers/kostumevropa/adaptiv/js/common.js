$(function() {

	//SVG Fallback
	if(!Modernizr.svg) {
		$("img[src*='svg']").attr("src", function() {
			return $(this).attr("src").replace(".svg", ".png");
		});
	};


	//Chrome Smooth Scroll
	try {
		$.browserSelector();
		if($("html").hasClass("chrome")) {
			$.smoothScroll();
		}
	} catch(err) {

	};

	$("img, a").on("dragstart", function(event) { event.preventDefault(); });
	
});

$(window).load(function() {

	$(".loader_inner").fadeOut();
	$(".loader").delay(400).fadeOut("slow");

});

$('.slider-for').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	fade: true,
	asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
	slidesToShow: 4,
	vertical: true,
	arrows: false,
	slidesToScroll: 1,
	asNavFor: '.slider-for',
	focusOnSelect: true,
	responsive: [
    {
      breakpoint: 1170,
      settings: {
      	vertical: false,
        slidesToShow: 3
      }
    }
  ]
});

$('.slider-for-1').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	fade: true,
	asNavFor: '.slider-nav-1'
});
$('.slider-nav-1').slick({
	slidesToShow: 4,
	vertical: true,
	arrows: false,
	slidesToScroll: 1,
	asNavFor: '.slider-for-1',
	focusOnSelect: true,
	responsive: [
    {
      breakpoint: 1170,
      settings: {
      	vertical: false,
        slidesToShow: 3
      }
    }
  ]
});

jQuery(document).ready(function($){

	/* prepend menu icon */
	$('#nav-wrap').prepend('<div id="menu-icon"></div>');
	/* toggle nav */
	$("#menu-icon").on("click", function(){
		$("#nav").slideToggle();
		$(this).toggleClass("active");
	});

});

(function($) {
	$(function() {

		$('ul.tabs').delegate('li:not(.current)', 'click', function() {
			$(this).addClass('current').siblings().removeClass('current')
			.parents('div.section').find('div.box').hide().eq($(this).index()).fadeIn(400);
		})

	})
})(jQuery);

$(document).ready(function() {
	$("body").on("click", "a.scroll", function(event) {
		event.preventDefault();
		var id = $(this).attr('href'),
		top = $(id).offset().top;
		$('body,html').animate({
			scrollTop: top
		}, 1500);
	});
});