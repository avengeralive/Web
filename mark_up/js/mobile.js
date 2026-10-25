$(document).ready(function(){
	var ipod= "<style>.portfolio-carousel .header-carousel-text{padding-top:90px;}.header-img{margin-top:0px!important;width:100%}</style>";

	if( navigator.userAgent.match(/Android/i)
	 || navigator.userAgent.match(/webOS/i)
	 || navigator.userAgent.match(/iPhone/i)
	 || navigator.userAgent.match(/BlackBerry/i)
	 || navigator.userAgent.match(/Windows Phone/i)){
		$('head').append('<link rel="stylesheet" href="http://new.infoshell.ru/test/wp-content/themes/mark_up/css/mobile.css?v5" type="text/css" />');
        //$(window).resize();
        setTimeout(function(){
            $(window).resize();
        }, 1000);

        setTimeout(function(){
            $(window).resize();
        }, 2000);


        $(".main-menu").click(function(){
            $('.main-menu').hide();
        });

        setTimeout(function(){
            $(window).resize();
        }, 3000);
	}else{
		if(
			navigator.userAgent.match(/iPod/i) ||
			navigator.userAgent.match(/iPad/i) ||
			navigator.userAgent.match(/safari/i)
		){
			var gdgf = $(document).width();
			$('.img-title').css("width", gdgf+"px");
			$("body").append(ipod);
		}
	}
	
	$(".menu_left").click(function(e){
		$('.phone-block').css('display', 'none');
		$('.main-menu').toggle();
		return false;
	});




	$(".menu_right").click(function(e){
		$('.main-menu').css('display', 'none');
		$('.phone-block').toggle();
		return false;
	});


});