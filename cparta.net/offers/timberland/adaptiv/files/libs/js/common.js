$(document).ready(function() {
	$(".container").on("click", ".scroll", function(event) {
		event.preventDefault();
		var id = $(this).attr('href'),
		top = $(id).offset().top;
		$('body,html').animate({
			scrollTop: top
		}, 1500);
	});
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
			.parents('div.section').find('div.box').hide().eq($(this).index()).fadeIn(500);
		})

	})
})(jQuery);

$('.slider-for').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	fade: true,
	asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
	slidesToShow: 3,
	vertical: true,
	slidesToScroll: 1,
	asNavFor: '.slider-for',
	focusOnSelect: true,
	prevArrow: '<button type="button"><img src="files/down.png"></button>',
	nextArrow: '<button type="button"><img src="files/up.png"></button>'
});

$('.slider_mob').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	prevArrow: '<button type="button"><img src="files/prev.png"></button>',
	nextArrow: '<button type="button"><img src="files/next.png"></button>'
});





$('.slider-for2').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	fade: true,
	asNavFor: '.slider-nav2'
});
$('.slider-nav2').slick({
	slidesToShow: 3,
	vertical: true,
	slidesToScroll: 1,
	asNavFor: '.slider-for2',
	focusOnSelect: true,
	prevArrow: '<button type="button"><img src="files/down.png"></button>',
	nextArrow: '<button type="button"><img src="files/up.png"></button>'
});



$('.slider-for3').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	fade: true,
	asNavFor: '.slider-nav3'
});
$('.slider-nav3').slick({
	slidesToShow: 3,
	vertical: true,
	slidesToScroll: 1,
	asNavFor: '.slider-for3',
	focusOnSelect: true,
	prevArrow: '<button type="button"><img src="files/down.png"></button>',
	nextArrow: '<button type="button"><img src="files/up.png"></button>'
});

