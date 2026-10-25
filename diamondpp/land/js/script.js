$(function() {
    var win_w = $(document).width();
    var win_h = $(window).height();

		if($(".slider-items .slide").length>0) {
			$('.slider-items .slider').slick({
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 3,
				responsive:[
					{
						breakpoint: 824,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
							adaptiveHeight: true
						}
					},
					{
						breakpoint: 554,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							adaptiveHeight: true
						}
					},
				]
			});
		}
	$(".js-tgl-reg").on("click", function() {
		$(".form-reg, .mobile-form-reg").addClass("active");
		$(".form-login, .mobile-form-login").hide(0).removeClass("active");
		return false
	});
	$(".js-tgl-login").on("click", function() {
		$(".form-login, .mobile-form-login").addClass("active");
		$(".form-reg, .mobile-form-reg").hide(0).removeClass("active");
		return false
	});
	$(".js-pop-reg").on("click", function() {
		$(".form-request-float").addClass("show-reg");
		$(".form-request-float").removeClass("show-login");
		$(".popup-request").show();
		return false
	});
	$(".js-pop-login").on("click", function() {
		$(".form-request-float").addClass("show-login");
		$(".form-request-float").removeClass("show-reg");
		$(".popup-request").show();
		return false
	});
	$(document).click( function(e){
		if ( $(e.target).closest('.form-request-float').length ) {
			// клик внутри элемента
			return;
		}
		// клик снаружи элемента
		$('.popup-request').fadeOut();
	});
	$("#hamburger-icon").on("click", function() {
		$("body").toggleClass("active_m");
		$(".mobile-menu-toggle").slideToggle();
	});
	$(".my-select .select-value").on("click", function() {
		$(this).next(".select-list").toggleClass("open");
	});
	$(".my-select .select-list li").on("click", function() {
		var sel_val = $(this).attr("class")
		$(this).next(".select-list").toggleClass("open");
		$(".mess-type").text(sel_val);
		$(this).closest(".my-select").find(".select-value").text(sel_val);
		$(this).closest(".my-select").find(".select-list").removeClass("open");
	});





    if ($('.phone_mask').length) {
        $(".phone_mask").mask("+7 (999) 999-9999");
    }
	if ($('select').length) {
		$('select').ikSelect({
			autoWidth: false,
			dynamicWidth: false
		});
	}

});



