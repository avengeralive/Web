$(document).ready(function() {
	$(".button-main-mnu").click(function() {
		$(".nav-ios nav").slideToggle();
	});
	//Таймер обратного отсчета
	//Документация: http://keith-wood.name/countdown.html
	//<div class="countdown" date-time="2015-01-07"></div>
	var austDay = new Date($(".countdown").attr("date-time"));
	$(".countdown").countdown({until: austDay, format: 'yowdHMS'});

	//Попап менеджер FancyBox
	//Документация: http://fancybox.net/howto
	//<a class="fancybox"><img src="image.jpg" /></a>
	//<a class="fancybox" data-fancybox-group="group"><img src="image.jpg" /></a>
	$(".fancybox").fancybox();

	//Навигация по Landing Page
	//$(".top_mnu") - это верхняя панель со ссылками.
	//Ссылки вида <a href="#contacts">Контакты</a>
	$(".top_mnu").navigation();

	//Добавляет классы дочерним блокам .block для анимации
	//Документация: http://imakewebthings.com/jquery-waypoints/
	$(".block").waypoint(function(direction) {
		if (direction === "down") {
			$(".class").addClass("active");
		} else if (direction === "up") {
			$(".class").removeClass("deactive");
		};
	}, {offset: 100});

	//Плавный скролл до блока .div по клику на .scroll
	//Документация: https://github.com/flesler/jquery.scrollTo
	$("a.scroll").click(function() {
		$.scrollTo($(".div"), 800, {
			offset: -90
		});
	});






(function(){
		//Каруселька
	//Документация: http://owlgraphic.com/owlcarousel/
	var owl = $("#owl-job");
	owl.owlCarousel({
		items : 3,
		itemsTablet: [768,2],
		itemsTabletSmall: false,
		itemsMobile : [480,1]
	});
	$(".next_button").click(function(){
		owl.trigger("owl.next");
	});
	$(".prev_button").click(function(){
		owl.trigger("owl.prev");
	});
})();
(function(){
	//Каруселька
	//Документация: http://owlgraphic.com/owlcarousel/
	var owl = $("#owl-reviews");
	owl.owlCarousel({
		items : 5,
		itemsTablet: [768,2],
		itemsTabletSmall: false,
		itemsMobile : [480,1]
	});
	$(".next_button2").click(function(){
		owl.trigger("owl.next");
	});
	$(".prev_button2").click(function(){
		owl.trigger("owl.prev");
	});
})();
	//Каруселька
	//Документация: http://owlgraphic.com/owlcarousel/
	var owl = $("#owl-news");
	owl.owlCarousel({
		items : 3,
		itemsTablet: [768,2],
		itemsTabletSmall: false,
		itemsMobile : [480,1]
	});
	$(".next_button1").click(function(){
		owl.trigger("owl.next");
	});
	$(".prev_button1").click(function(){
		owl.trigger("owl.prev");
	});
	//Кнопка "Наверх"
	//Документация:
	//http://api.jquery.com/scrolltop/
	//http://api.jquery.com/animate/
	$("#top").click(function () {
		$("body, html").animate({
			scrollTop: 0
		}, 800);
		return false;
	});
	
	//Аякс отправка форм
	//Документация: http://api.jquery.com/jquery.ajax/
	//$("form").submit(function() {
	//	$.ajax({
	//		type: "GET",
	//		url: "mail.php",
	//		data: $("form").serialize()
	//	}).done(function() {
	//		alert("Спасибо за заявку!");
	//		setTimeout(function() {
	//			$.fancybox.close();
	//		}, 1000);
	//	});
	//	return false;
	//});

		// Slider otzivy
	(function () {
		var otz = $('.section-7'),
			list = otz.find('.otz-body'),
			flag = false,
			duration = 500;
		otz.find('.arrows div').click(function () {
			if (!flag) {
				flag = true;
				var items = list.find('.o_item');
				var item;
				if ($(this).hasClass('next_button2')) {
					list.append(items.first().clone(true)).animate({ marginLeft: (-1 * items.first().width()) + 'px' }, duration, function () {
						flag = false;
						items.first().remove();
						list.css({ marginLeft: 0 });
					});
					item = list.find('.o_item').eq(1);
				} else {
					list
						.css({ marginLeft: (-1 * items.first().width()) + 'px' })
						.prepend(items.last().clone(true))
						.animate({ marginLeft: 0 }, duration, function () {
							flag = false;
							items.last().remove();
						});
					item = list.find('.o_item').eq(0);
				}
			}
		});
	})();
	
});
$('.request-call-btn').bind("click", function () {
   $('.modal-backdrop').show();
   $('#modal-1').show();
   return false;
  });
  $('.modal-backdrop').bind("click", function () {
   $('.modal-backdrop').hide();
   $('#modal-1').hide();
   return false;
  });
  
  
$('.footer-request-call').bind("click", function () {
   $('.modal-backdrop').show();
   $('#modal-1').show();
   return false;
  });
  $('.modal-backdrop').bind("click", function () {
   $('.modal-backdrop').hide();
   $('#modal-1').hide();
   return false;
  });
  
  
$('.btn-call-me').bind("click", function () {
   $('.modal-backdrop').show();
   $('#modal-1').show();
   return false;
  });
  $('.modal-backdrop').bind("click", function () {
   $('.modal-backdrop').hide();
   $('#modal-1').hide();
   return false;
  });

$('.b-okno').bind("click", function () {
   $('.modal-backdrop').show();
   $('#modal-1').show();
   return false;
  });
  $('.modal-backdrop').bind("click", function () {
   $('.modal-backdrop').hide();
   $('#modal-1').hide();
   return false;
  });
  
  
$('.request-call-btn').bind("click", function () {
   $('.modal-backdrop').show();
   $('#modal-1').show();
   return false;
  });
  $('.modal-backdrop').bind("click", function () {
   $('.modal-backdrop').hide();
   $('#modal-1').hide();
   return false;
  });