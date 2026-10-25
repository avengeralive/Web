$(document).ready(function() {
	
	/* scroll */
	
	$("a[href^='#']").click(function(){
		var target = $(this).attr("href");
		var product = $(this).parent().parent().find("h4 span").text();
		$(".order_form select[name='comment'] option[value='"+product+"']").prop("selected", true);
		$("html, body").animate({scrollTop: $(target).offset().top+"px"});
		return false;
	});

	/* sliders */

	$(".owl1").owlCarousel({
		items: 1,
		loop: true,
		smartSpeed: 300,
		mouseDrag: false,
		pullDrag: false,
		dots: false,
		nav: true,
		navText: ""
	});



	$(".owl2").owlCarousel({
		items: 1,
		loop: true,
		autoplay:true,
		autoplayTimeout:2000,
    	autoplayHoverPause:true,		
		smartSpeed: 300,
		mouseDrag: false,
		pullDrag: false,		
		dots: false,
		nav: true,
		navText: ""		
	});

	/* validate form */

	$(".order_form").submit(function(){
		if ($(this).find("input[name='name']").val() == "" && $(this).find("input[name='phone']").val() == "") {
			alert("Введите Ваши имя и телефон");
			$(this).find("input[name='name']").focus();
			return false;
		}
		else if ($(this).find("input[name='name']").val() == "") {
			alert("Введите Ваше имя");
			$(this).find("input[name='name']").focus();
			return false;
		}
		else if ($(this).find("input[name='phone']").val() == "") {
			alert("Введите Ваш телефон");
			$(this).find("input[name='phone']").focus();
			return false;
		}
		return true;
	});

});