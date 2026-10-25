$(document).ready(function() {
				
				$('.iosSlider1').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					keyboardControls: false,
					onSlideComplete: slideComplete1,
					navNextSelector: $('.next1'),
				  navPrevSelector: $('.prev1'),
				});
				
				$('.iosSlider2').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					keyboardControls: false,
					onSlideComplete: slideComplete2,
					navNextSelector: $('.next2'),
				  navPrevSelector: $('.prev2'),
				});
				
				$('.iosSlider3').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					keyboardControls: false,
					onSlideComplete: slideComplete3,
					navNextSelector: $('.next3'),
				  navPrevSelector: $('.prev3'),
				});
				
				$('.iosSlider4').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					keyboardControls: false,
					onSlideComplete: slideComplete4,
					navNextSelector: $('.next4'),
				  navPrevSelector: $('.prev4'),
				});
				
				$('.iosSlider_balkon').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					keyboardControls: false,
					onSlideComplete: slideComplete_balkon,
					navNextSelector: $('.es3balkon .next4'),
				  navPrevSelector: $('.es3balkon .prev4'),
				});
				
				$('.iosSlider_allcolors').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					keyboardControls: false,
					onSlideComplete: slideComplete_allcolors,
					navNextSelector: $('.next1'),
				  navPrevSelector: $('.prev1'),
				});
				
				$('.iosslider_2').iosSlider({
					snapToChildren: true,
					scrollbar: true,
					scrollbarHide: false,
					desktopClickDrag: true,
					scrollbarLocation: 'bottom',
					scrollbarHeight: '13px',
					scrollbarBackground: '#02bbcf',
					scrollbarBorder: '1px solid #000',
					scrollbarMargin: '10px 30px 16px 30px',
					scrollbarOpacity: '0.75',
					scrollbarDrag: true,
				});
				

	$('.top_block')
		.waypoint( function(dir) {
			if (dir === 'down')
			$('.fly_girl').addClass('animated').removeClass('bounceOutRight').toggleClass('bounceInRight');
			$('.toptop').addClass('animated').removeClass('fadeOut').toggleClass('fadeIn');
            $('.gk-menu').addClass('animated').removeClass('fadeOut').toggleClass('fadeIn');
            
		},{
			offset:-400
		})
		.waypoint( function(dir) {
			if (dir === 'up')
			$('.fly_girl').addClass('animated').removeClass('bounceInRight').toggleClass('bounceOutRight');
			$('.toptop').addClass('animated').removeClass('fadeIn').toggleClass('fadeOut');
            $('.gk-menu').addClass('animated').removeClass('fadeIn').toggleClass('fadeOut');
		},{
			offset:-399
		});

		$('.es19_bg')
		.waypoint( function(dirbot) {
			if (dirbot === 'down')
			$('.fly_girl').addClass('animated').removeClass('bounceInRight').toggleClass('bounceOutRight');
			$('.toptop').addClass('animated').removeClass('fadeOut').toggleClass('fadeIn');
		},{
			offset:1000
		})
		.waypoint( function(dirbot) {
			if (dirbot === 'up')
			$('.fly_girl').addClass('animated').removeClass('bounceOutRight').toggleClass('bounceInRight');
			$('.toptop').addClass('animated').removeClass('fadeIn').toggleClass('fadeOut');
		},{
			offset:999
		});
		
		
		$(".toptop").click(function () 
		{	
			$("body,html").animate({	
			scrollTop: 0	}, 100);	
			return false	
		});	
		
		$(".phonemask").mask("8 (999) 999-99-99");
		
		
		//want_zamer
/*
		$(".t1_1").click(function () 
		{	
			$('.t1_1').addClass('act');
			$('.t1_2').removeClass('act');
			$('.t1_3').removeClass('act');
			$('.t2_yest').css("display","block");
			$('.t2_today').css("display","none");
			$('.t2_tomorrow').css("display","none");

		});
		
		$(".t1_2").click(function () 
		{	
			$('.t1_1').removeClass('act');
			$('.t1_2').addClass('act');
			$('.t1_3').removeClass('act');
			$('.t2_yest').css("display","none");
			$('.t2_today').css("display","block");
			$('.t2_tomorrow').css("display","none");
		});
		
		$(".t1_3").click(function () 
		{	
			$('.t1_1').removeClass('act');
			$('.t1_2').removeClass('act');
			$('.t1_3').addClass('act');
			$('.t2_yest').css("display","none");
			$('.t2_today').css("display","none");
			$('.t2_tomorrow').css("display","block");
		});
*/
		
		
		
			
		//срабатывание ссылки в главном меню если есть подменю
    $('.navbar .dropdown-toggle').click(function() {
			if ($(this).next('.dropdown-menu').is(':visible')) {
				window.location = $(this).attr('href');
			}
		});
		
		

		
		//поле когда может приехать замерщик

		//press button		
		$('.b_contact_but_city').click(function() {		
				$(".b_contact_zhdu_bg_no").slideUp("fast");
				$(".b_contact_zhdu_bg").slideUp("fast");
				
				if (anyCityInInput == "no") {
					
					
					lowcitytozamerinput = $('.b_contact_input_city input').val().toLowerCase();
					for (var i = 0; i < citytozamer.length; i++) {
						lowcitytozamer = citytozamer[i].toLowerCase();
												
						
						if (lowcitytozamer == lowcitytozamerinput) {
							var espopadanie = 1;
							$(".b_contact_zhdu_bg").slideDown("slow");
							var dzhdu = new Date();
							var hourszhdu = dzhdu.getHours();
							if (hourszhdu < 19)	{
								$(".b_contact_zhdu_t1").html("Выезд замерщика на Ваш адрес возможен сегодня до 21:00");
							}
							else {
								$(".b_contact_zhdu_t1").html("Выезд замерщика на Ваш адрес возможен завтра до 21:00");
							} 
					  	}				  
					}
					if (espopadanie != 1) {
						$(".b_contact_zhdu_bg_no").slideDown("slow");
					}
					
					
					
					
					
				} else if (anyCityInInput == "yes") {
					$(".b_contact_zhdu_bg").slideDown("slow");
					var dzhdu = new Date();
					var hourszhdu = dzhdu.getHours();
					if (hourszhdu < 19)	{
						$(".b_contact_zhdu_t1").html("Выезд замерщика на Ваш адрес возможен сегодня до 21:00");
					}
					else {
						$(".b_contact_zhdu_t1").html("Выезд замерщика на Ваш адрес возможен завтра до 21:00");
					} 
					
				}
				
				
				
				
		});
		//press enter
		$(".b_contact_input_city input").keypress(function(e){
   	    if(e.keyCode==13){	
	   	    $(".b_contact_zhdu_bg_no").slideUp("fast");
		 	$(".b_contact_zhdu_bg").slideUp("fast");
		 			
		 	if (anyCityInInput == "no") {		
		 					
					lowcitytozamerinput = $('.b_contact_input_city input').val().toLowerCase();
					for (var i = 0; i < citytozamer.length; i++) {
						lowcitytozamer = citytozamer[i].toLowerCase();
					  if (lowcitytozamer == lowcitytozamerinput ) {
						  var espopadanieenter = 1;
							$(".b_contact_zhdu_bg").slideDown("slow");
							var dzhdu = new Date();
							var hourszhdu = dzhdu.getHours();
							if (hourszhdu < 19)	{
								$(".b_contact_zhdu_t1").html("Выезд замерщика на Ваш адрес возможен сегодня до 21:00");
							}
							else {
								$(".b_contact_zhdu_t1").html("Выезд замерщика на Ваш адрес возможен завтра до 21:00");
							} 
					  }
					}		
					if (espopadanieenter != 1) {
						$(".b_contact_zhdu_bg_no").slideDown("slow");
					}
			
			} else if (anyCityInInput == "yes") {
				$(".b_contact_zhdu_bg").slideDown("slow");
				var dzhdu = new Date();
				var hourszhdu = dzhdu.getHours();
				if (hourszhdu < 19)	{
					$(".b_contact_zhdu_t1").html("Выезд замерщика на Ваш адрес возможен сегодня до 21:00");
				}
				else {
					$(".b_contact_zhdu_t1").html("Выезд замерщика на Ваш адрес возможен завтра до 21:00");
				} 
					
			}
			
					
   	    }
   	});

			
		//Работа с ползунком на туч устройствах
		//$('#slider').draggable();
		//$('#sliderhor').draggable();
		//$('#sliderver').draggable();
				
});
			
			
			
			function slideComplete1(args) {
				$('.next1, .prev1').removeClass('unselectable');
			    if(args.currentSlideNumber == 1) {
			        $('.prev1').addClass('unselectable');
			    } else if(args.currentSliderOffset == args.data.sliderMax) {
			        $('.next1').addClass('unselectable');
			    }
			}
			
			function slideComplete2(args) {
				$('.next2, .prev2').removeClass('unselectable');
			    if(args.currentSlideNumber == 1) {
			        $('.prev2').addClass('unselectable');
			    } else if(args.currentSliderOffset == args.data.sliderMax) {
			        $('.next2').addClass('unselectable');
			    }
			}
			
			function slideComplete3(args) {
				$('.next3, .prev3').removeClass('unselectable');
			    if(args.currentSlideNumber == 1) {
			        $('.prev3').addClass('unselectable');
			    } else if(args.currentSliderOffset == args.data.sliderMax) {
			        $('.next3').addClass('unselectable');
			    }
			}
			
			function slideComplete4(args) {
				$('.next4, .prev4').removeClass('unselectable');
			    if(args.currentSlideNumber == 1) {
			        $('.prev4').addClass('unselectable');
			    } else if(args.currentSliderOffset == args.data.sliderMax) {
			        $('.next4').addClass('unselectable');
			    }
			}
			
			function slideComplete_balkon(args) {
				$('.next4, .prev4').removeClass('unselectable');
			    if(args.currentSlideNumber == 1) {
			        $('.prev4').addClass('unselectable');
			    } else if(args.currentSliderOffset == args.data.sliderMax) {
			        $('.next4').addClass('unselectable');
			    }
			}
			
			function slideComplete_allcolors(args) {
				$('.next1, .prev1').removeClass('unselectable');
			    if(args.currentSlideNumber == 1) {
			        $('.prev1').addClass('unselectable');
			    } else if(args.currentSliderOffset == args.data.sliderMax) {
			        $('.next1').addClass('unselectable');
			    }
			}
			
			
			
			if ($(window).width() >= 900) {
				var zoomShowcaseSettings = {
					imageWidth: 511,
					imageHeight: 335,
					bannerWidth: 900,
					animationSpeed: 750,
					easing: "easeOutQuint",
					sideOpacity: 0.5,
					autoPlay: true,
					autoPlayDelay: 4000,
					randomizeItems: false,
					linkTarget: "_parent.",
					sideZoom: 0.75,
					backZoom: 0.5
				}
			}
			else {
				var zoomShowcaseSettings = {
					imageWidth: 210,
					imageHeight: 140,
					bannerWidth: 320,
					animationSpeed: 750,
					easing: "easeOutQuint",
					sideOpacity: 0.5,
					autoPlay: true,
					autoPlayDelay: 4000,
					randomizeItems: false,
					linkTarget: "_parent.",
					sideZoom: 0.75,
					backZoom: 0.5
				}
			}
			
						
			jQuery(document).ready(function() {
				jQuery(".zoom-gallery").zoomShowcase(zoomShowcaseSettings);
				var isRunning = false, iVal;
				jQuery("#thanky-left-button").click(goLeft);
				jQuery("#thanky-right-button").click(goRight);
				function goLeft(event) {
					event.stopPropagation();
					event.preventDefault();
					if(!isRunning) {
						isRunning = true;
						jQuery("#zoom-instance-1")[0].goLeft();
						setTimeout(animationDone, zoomShowcaseSettings.animationSpeed + 100);
					}
				}
				function goRight(event) {
					event.stopPropagation();
					event.preventDefault();
					if(!isRunning) {
						isRunning = true;
						jQuery("#zoom-instance-1")[0].goRight();
						setTimeout(animationDone, zoomShowcaseSettings.animationSpeed + 100);
					}
				}
				function animationDone() {
					if(jQuery("#zoom-instance-1")[0].isReady()) {
						isRunning = false;	
					}
					else {
						setTimeout(animationDone, 100);
					}
				}
			});



$(function(e) {

    $('.gk-menu__block').on('click', function() {
        $(".gk-menu__block").fadeOut();
        $(".gk-menu__blockopen").fadeIn();
        return false;
    });

    $(document).on('click', function(){
        $(".gk-menu__block").fadeIn();
        $(".gk-menu__blockopen").fadeOut();
    });




});

$(function() {


  $('.fancybox-frame').fancybox(
            {
                apectRatio: true,
                width: 1200,
                height: 800
            }
        );

});
	
	
	
		
			