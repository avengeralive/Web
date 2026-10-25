$(document).ready(function() {
	
	/* scroll */
	$("a[href^='#']").click(function(){
		var _href = $(this).attr("href");
		$("html, body").animate({scrollTop: $(_href).offset().top+"px"});
		return false;
	});

	
	$("img.panorama").panorama();
});





$(window).on("load", function(){

	$('.reviews1').owlCarousel({
		loop:true,
		nav:true,
		margin:10,
		autoHeight: true,
		navText: "",
		responsive:{
			0:{
				items:1
			},
			659:{
				items:1
			},
			960:{
				items:2
			}
		}
	});
	$('.reviews2').owlCarousel({
		items:1,
		loop:true,
		nav:true,
		dots: true,
		margin:10,
		autoHeight: true,
		navText: ""
	});
	var i = 0;
	while (i<=16) {
		$('.op'+i).owlCarousel({
			items:1,
			loop:true,
			nav:true,
			dots: true,
			margin:10,
			autoHeight: true,
			navText: ""
		});
		i++;
	}

});


