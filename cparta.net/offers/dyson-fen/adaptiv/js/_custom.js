document.addEventListener("DOMContentLoaded", function() {

	$(function(){

		// $(".btn a").mPageScroll2id({ offset: 70, autoScrollSpeed: true });
		// $(".btn a").mPageScroll2id({ offset: 7170, autoScrollSpeed: true });
		// $(".btn a").mPageScroll2id({ offset: 7170, autoScrollSpeed: true });
		// $(".btn a").mPageScroll2id({ offset: 7170, autoScrollSpeed: true });


		var d = new Date();
		var time_zone = d.getTimezoneOffset();
		var year_user = d.getFullYear();
		var month_user = d.getMonth()+1;
		var day_user = d.getDate();
		var hrs_user = 24+(time_zone / 60);//d.getHours() + 1;
		var min_user = d.getMinutes();
		var sec_user = d.getSeconds();
		var str_user = year_user + "-" + month_user + "-" + day_user + " " + hrs_user + ":" + "00";
		console.log(str_user);
    function timer(settings){
        var config = {
            endDate: str_user,
            // timeZone: 'Europe/Kiev',
            hours: $('#hours'),
            minutes: $('#minutes'),
						seconds: $('#seconds'),
						
						hours2: $('#hours2'),
            minutes2: $('#minutes2'),
						seconds2: $('#seconds2'),

            newSubMessage: 'and should be back online in a few minutes...'
        };
        function prependZero(number){
            return number < 10 ? '0' + number : number;
        }
        $.extend(true, config, settings || {});
        var currentTime = moment();
        var endDate = moment.tz(config.endDate, config.timeZone);
        var diffTime = endDate.valueOf() - currentTime.valueOf();
        var duration = moment.duration(diffTime, 'milliseconds');
        var days = duration.days();
        var interval = 1000;
        var subMessage = $('.sub-message');
        var clock = $('.clock');
        if(diffTime < 0){
            endEvent(subMessage, config.newSubMessage, clock);
            return;
        }
        if(days > 0){
            $('#days').text(prependZero(days));
            $('.days').css('display', 'inline-block');
        }
        var intervalID = setInterval(function(){
            duration = moment.duration(duration - interval, 'milliseconds');
            var hours = duration.hours(),
                minutes = duration.minutes(),
                seconds = duration.seconds();
            days = duration.days();
            if(hours  <= 0 && minutes <= 0 && seconds  <= 0 && days <= 0){
                clearInterval(intervalID);
                endEvent(subMessage, config.newSubMessage, clock);
                window.location.reload();
            }
            if(days === 0){
                $('.days').hide();
            }
            $('#days').text(prependZero(days));
						
						config.hours.text(prependZero(hours));
            config.minutes.text(prependZero(minutes));
						config.seconds.text(prependZero(seconds));
						
						config.hours2.text(prependZero(hours));
            config.minutes2.text(prependZero(minutes));
						config.seconds2.text(prependZero(seconds));
        }, interval);
			}

			timer();

			// $( ".color-2" ).hover(function(){ 
			// 	$( "#el-5, #el-6, #el-7, #el-8").css("display", "none"); 
			// 	}, function(){ 
			// 		$( "#el-5, #el-6, #el-7, #el-8" ).css("display", "block"); 
				
			// });

			// $( ".color-3" ).hover(function(){ 
			// 	$( "#el-6, #el-7, #el-8").css("display", "none"); 
			// 	}, function(){ 
			// 		$( "#el-6, #el-7, #el-8" ).css("display", "block"); 
				
			// });
			$(".color-1" ).click(function(){ 
				$(".fourth-section").find("p.title").text("С набором фирменных расчесок");
				$(".fourth-section").find("p.subdescr-top").html("<p class='subdescr subdescr-top'>Dyson Supersonic<sup>TM</sup> С набором фирменных расчесок</p>");
				$(".item-color").attr("src", "img/@2x/choice/1-color/1-img.png")
				//$( "#el-5, #el-6, #el-7, #el-8" ).css("display", "block");
			});

			$(".color-2" ).click(function(){ 
				$(".fourth-section").find("p.title").text("Фен для волос (пурпурный)");
				$(".fourth-section").find("p.subdescr-top").html("<p class='subdescr subdescr-top'>Dyson Supersonic<sup>TM</sup> Фен для волос (пурпурный)</p>");
				$(".item-color").attr("src", "img/@2x/choice/2-color/2-img.png")
				//$( "#el-5, #el-6, #el-7, #el-8" ).css("display", "block");
				//$("#el-5, #el-6, #el-7, #el-8").css("display", "none");
			});

			$(".color-3" ).click(function(){
				$(".fourth-section").find("p.title").text("Фен (черный/серебристый)");
				$(".fourth-section").find("p.subdescr-top").html("<p class='subdescr subdescr-top'>Dyson Supersonic<sup>TM</sup> Фен (черный/серебристый)</p>");
				$(".item-color").attr("src", "img/@2x/choice/3-color/3-img.png")
				//$( "#el-5, #el-6, #el-7, #el-8" ).css("display", "block");
				//$("#el-6, #el-7, #el-8").css("display", "none");
			});



			$(".more").click(function() {
				$(".descr_text").css('height', '100%');
				$(".descr_text").css('overflow-y', 'visible');
				$(".more").css('display', 'none');
			});
	
			// var swiper = new Swiper('.swiper-container', {
			//   // slidesPerView: 'auto',
			//   // centeredSlides: true,
			//   spaceBetween: -12,
			//   pagination: {
			//     el: '.swiper-pagination',
			//     clickable: true,
			//   },
			// });
			


			// var $button = $("button");
			// var $modal = $(".modal");

			var swiper = new Swiper('.swiper-container', {
				nextButton: '.swiper-button-next',
				prevButton: '.swiper-button-prev',
				spaceBetween: 30,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
			});

			$(".swiper-button-next").click(function(e){
				e.preventDefault();
				swiper.slideNext();
			});

			$(".swiper-button-prev").click(function(e){
				e.preventDefault();
				swiper.slidePrev();
			});

	
			// $button.on("click", function (event) {
			// 	var index = $(this).index();
			// 	var swiper;
				
			// 	$.magnificPopup.open({
			// 		items: {
			// 			src: $modal
			// 		},
			// 		callbacks: {
			// 			open: function () {
			// 				swiper = this.content.swiper({
			// 					spaceBetween: 12,
			// 					initialSlide: index,
			// 					// simulateTouch: false,
			// 					slidesPerView: "auto",
			// 					// nextButton: ".swiper-button-next",
			// 					// prevButton: ".swiper-button-prev",
			// 					a11y: true
			// 				});
			// 				//alert('123');
			// 				console.log(swiper);
			// 			},
			// 			afterClose: function () {
			// 				swiper.destroy(false, true);
			// 				console.log(swiper);
			// 			}
			// 		}
			// 	});
				
			// 	event.preventDefault();
			// });
	


			// var $images = $(".images");
			// var images = $images.swiper({
			// 	spaceBetween: 0,
			// 	noSwiping: true
			// });
			// var $thumbs = $(".thumbs");
			// var thumbs = $thumbs.swiper({
			// 	slidesPerView: "auto",
			// 	centredSlides: true,

			// 	navigation: {
			// 		nextEl: '.swiper-button-next',
			// 		prevEl: '.swiper-button-prev',
			// 	},
			// 	pagination: {
			// 		el: '.swiper-pagination'
			// 	},
			// 	// slideToClickedSlide: true
			// });
	


			// $thumbs.on("click", ".swiper-slide", function (event) {
			// 	//alert('hi');
			// 	var index = $(this).index();
			// 	var swiper;
				
			// 	$.magnificPopup.open({
			// 		items: {
			// 			src: $modal
			// 		},
			// 		callbacks: {
			// 			open: function () {
			// 				swiper = this.content.swiper({
			// 					spaceBetween: 0,
			// 					initialSlide: index,
			// 					centeredSlides: true,
			// 					// simulateTouch: false,
			// 					slidesPerView: "auto",
			// 					// navigation: false,
			// 					// nextButton: ".swiper-button-next",
			// 					// prevButton: ".swiper-button-prev",
								
			// 					a11y: true
			// 					// cssMode: true,
			// 					// navigation: {
			// 					// 	nextEl: '.swiper-button-next',
			// 					// 	prevEl: '.swiper-button-prev',
			// 					// },
			// 					// pagination: {
			// 					// 	el: '.swiper-pagination'
			// 					// },
			// 					// mousewheel: true,
			// 					// keyboard: true,
							
			// 				});
			// 				//alert('123');
			// 				// $("body").addClass("hide");
			// 				// $("html").addClass("hide");
			// 				// $('.mfp-close').text('Done');
			// 				$('touchmove',function(e){
			// 					e.preventDefault();
			// 				});
			// 				//console.log(swiper);
			// 			},
			// 			afterClose: function () {
			// 				swiper.destroy(false, true);
			// 				$("body").removeClass("hide");
			// 				$("html").removeClass("hide");
			// 				//console.log(swiper);
			// 			}
			// 		}
					
			// 	});
			// 	$('.swiper-button-next').click(function(){swiper.swipeNext()})
			// 	//"Prev" button - some HTML element with "button-prev" class
			// 	$('.swiper-button-prev').click(function(){swiper.swipePrev()})
			// 	event.preventDefault();
			// });

			$(".btn a").mPageScroll2id({ offset: 70, autoScrollSpeed: true })

			$(".btn-menu-1 a").mPageScroll2id({ offset: 170, autoScrollSpeed: true });
			$(".btn-menu-2 a").mPageScroll2id({ offset: 170, autoScrollSpeed: true });
			$(".btn-menu-3 a").mPageScroll2id({ offset: 280, autoScrollSpeed: true });
			$(".btn-menu-4 a").mPageScroll2id({ offset: 170, autoScrollSpeed: true });
	});


});
