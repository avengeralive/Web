$(document).ready(function ($) {
    $('.slider_product').slick({
        arrows: true,
        dots: false,
        fade: true,
        infinite: true,
        autoplay: false,
        nextArrow: '<span class="slick-next"><i class="fas fa-caret-right"></i></span>',
        prevArrow: '<span class="slick-prev"><i class="fas fa-caret-left"></i></span>',
        autoplaySpeed: 3000,
        speed: 1000,
        adaptiveHeight: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('#slider').slick({
        arrows: true,
        dots: false,
        infinite: true,
        autoplay: false,
        nextArrow: '<span class="slick-next"><i class="fas fa-caret-right"></i></span>',
        prevArrow: '<span class="slick-prev"><i class="fas fa-caret-left"></i></span>',
        autoplaySpeed: 3000,
        speed: 1000,
        adaptiveHeight: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1
            }
        }]
    });
    $('[data-countdown]').each(function () {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function (event) {
            $this.html(event.strftime('<div class="col"><p class="fs">%D</p><p>дней</p></div><div class="col"><p class="fs">%H</p><p>часов</p></div><div class="col"><p class="fs">%M</p><p>минут</p></div><div class="col"><p class="fs">%S</p><p>секунд</p></div>'));
        });
    });
    $("#sticker").sticky({
        topSpacing: 0
    });
    
    

    $('.nav_tab').delegate('li:not(.cur)', 'click', function () {
        $(this).addClass('cur').siblings().removeClass('cur')
            .parents('.tab').find('div.box_tab').hide().eq($(this).index()).fadeIn(0);
    });
    
    
    $('.open_menu').click(function () {
        $('.menu_mobile').slideToggle('fast');
        $(this).toggleClass('active');
    });
    $('.menu_mobile li').click(function () {
        $('.menu_mobile').slideToggle('fast');
    });
    
    
    $(".menu_mobile li").click(function () {
        $('html, body').animate({
            scrollTop: $("#product_yakor").offset().top -10
        }, 500);
    });
    $(".js_go").click(function () {
        $('html, body').animate({
            scrollTop: $("#product_yakor").offset().top
        }, 500);
    });
    
    
    var telInp = $('input[type="tel"]');
    telInp.each(function () {
        $(this).mask("+7 ( 999 ) 999-99-99");
    });
    
    $('.myj').click(function () {
        $('.s1').removeClass('cur');
        $('.s2').addClass('cur');
        $('.b1').hide('');
        $('.b2').show('');
    });

   /* var telInp = $('input[type="tel"]');
    telInp.each(function () {
        $(this).mask("+7 ( 999 ) 999-99-99");
    });*/
	
	// Корзина
	recalculation();
	
	$(document)
		.on('click', '.product .add_cart', function(e) {
			e.preventDefault();
			var product = $(this).parents('.product').find('.title').text();
			var list_id = $(this).parents('.product_list').attr('data-list');
			$.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				dataType: 'json',
				data: 'action=add_cart&product=' + encodeURIComponent(product) + '&list_id=' + list_id,
				success: function(data) {
					if (data.success) {
						$('.cart_modul .num').text(data.data.count);
						$('.cart_modul b').text(data.data.sum);
						$('#bascet .name_h2 .namb').text(data.data.count);
						$('#bascet .list').html(data.data.message);
						recalculation();
						//$('.cart_modul').trigger('click');
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(arguments);
				}
			});
			
			var that = $(this).closest('.product').find('.attachment-loop');
			var bascket = $(".cart_modul");
			var w = that.width();
			that.clone()
				.css({
					'width': w,
					'position': 'absolute',
					'z-index': '9999',
					top: that.offset().top,
					left: that.offset().left
				})
				.appendTo("body")
				.animate({
					opacity: 0.05,
					left: bascket.offset()['left'],
					top: bascket.offset()['top'],
					width: 20
				}, 500, function () {
					$(this).remove();
				});
		})
		.on('submit', 'form.userform', function(e) {
			e.preventDefault();
			var userform = $(this);
			console.log($(this).parent.parent.class);
			/*$.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				dataType: 'json',
				data: userform.serialize(),
				success: function(data, statusText, xhr) {
					if (data.success) {
						
					} else {
						
					}
				},
				error: function(data) {
					console.log(arguments);
				}
			});*/
		})
		.on('click', '#bascet .product_basket .delete', function() {
			var product = $(this).parents('.product_basket');
			var session_array_id = product.attr('data-product');
			$.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				dataType: 'json',
				cache: false,
				data: 'session_array_id=' + session_array_id + '&action=remove_cart',
				success: function(data, statusText, xhr) {
					if (data.success) {
						product.remove();
						$('.cart_modul .num').text(data.data.count);
						$('.cart_modul b').text(data.data.sum);
						$('#bascet .name_h2 .namb').text(data.data.count);
						recalculation();
						
						if ($('#bascet .product_basket').length == 0) {
							$('#bascet .list').html('<p>Ваша корзина пуста.</p>');
						}
					} else {
						
					}
				},
				error: function(jqXHR, status, errorThrown){
					console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
				}
			});
		})
		.on('change', '#bascet .product_basket .option select[name="size"]', function() {
			var product = $(this).parents('.product_basket');
			var session_array_id = product.attr('data-product');
			var size = $(this).val();
			$.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				dataType: 'json',
				cache: false,
				data: 'session_array_id=' + session_array_id + '&action=update_size&size=' + size,
				success: function(data, statusText, xhr) {
					if (data.success) {
						recalculation();
					} else {
						console.log(data.data.message);
					}
				},
				error: function(jqXHR, status, errorThrown){
					console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
				}
			});
		})
		.on('change keyup input click', '#bascet .product_basket .option input[name="quantity"]', function() {
			var product = $(this).parents('.product_basket');
			var session_array_id = product.attr('data-product');
			var quantity = $(this).val();
			$.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				dataType: 'json',
				cache: false,
				data: 'session_array_id=' + session_array_id + '&action=update_quantity&quantity=' + quantity,
				success: function(data, statusText, xhr) {
					if (data.success) {
						$('.cart_modul .num').text(data.data.count);
						$('.cart_modul b').text(data.data.sum);
						$('#bascet .name_h2 .namb').text(data.data.count);
						recalculation();
					} else {
						console.log(data.data.message);
					}
				},
				error: function(jqXHR, status, errorThrown){
					console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
				}
			});
		})
		.on('click', 'a.more', function(e) {
			e.preventDefault();
			var elem = $(this);
			var list = elem.attr('data-list');
			var page = elem.attr('data-page');
			var onpage = elem.attr('data-onpage');
			$.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				dataType: 'json',
				data: 'action=loadmore&list=' + list + '&page=' + page + '&onpage=' + onpage,
				success: function(data) {
					if (data.success) {
						elem.parent('.button').siblings('.product_list').append(data.data.message);
						if (data.data.button)
							elem.parent('.button').after(data.data.button);
						elem.parent('.button').remove();
						$('.slider_product').not('.slick-initialized').slick({
							arrows: true,
							dots: false,
							fade: true,
							infinite: true,
							autoplay: false,
							nextArrow: '<span class="slick-next"><i class="fas fa-caret-right"></i></span>',
							prevArrow: '<span class="slick-prev"><i class="fas fa-caret-left"></i></span>',
							autoplaySpeed: 3000,
							speed: 1000,
							adaptiveHeight: true,
							slidesToShow: 1,
							slidesToScroll: 1
						});
						$('[data-countdown]').each(function () {
							var $this = $(this),
							finalDate = $(this).data('countdown');
							$this.countdown(finalDate, function (event) {
								$this.html(event.strftime('<div class="col"><p class="fs">%D</p><p>дней</p></div><div class="col"><p class="fs">%H</p><p>часов</p></div><div class="col"><p class="fs">%M</p><p>минут</p></div><div class="col"><p class="fs">%S</p><p>секунд</p></div>'));
							});
						});
					} else {
						console.log(data.data.message);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(arguments);
				}
			});
		})
		.on('click', '.btn_by', function() {
			$(this).parent().find('.window_hide_product').toggleClass('active');
			$('body').addClass('no_scroll');
			var title = $(this).parents('.product').find('.title').text();
			$(this).parents('.product').find('.order_form').find('input[name="by-product"]').val(title);
			
			$(this).parent().find('.window_hide_product').find('.slider_product').get(0).slick.setPosition();
		})
		.on('click', '.window_hide_product .size_2 li', function() {
			var title = $(this).parents('.product').find('.title').text();
			$(this).addClass('active');
			$(this).siblings('li').removeClass('active');
			$(this).parents('.product').find('.order_form').find('input[name="by-product"]').val(title + ' (Размер: ' + $(this).text() + ')');
		})
		.on('click', '.cart_modul', function() {
			$('#bascet').toggleClass('active');
			$('body').toggleClass('no_scroll');
		})
		.on('click', '.close_window', function() {
			$('#bascet').removeClass("active");
		})
		.on('click', '.bg_close', function() {
			$('#bascet').removeClass("active");
		})
		.on('click', '.close_window', function() {
			$('.window_hide_product').removeClass("active");
			$('body').removeClass('no_scroll');
		})
		.on('click', '.bg_close', function() {
			$('.window_hide_product').removeClass("active");
			$('body').removeClass('no_scroll');
		});
	
	function recalculation() {
		var count = 0;
		var sum = 0;
		var sum_old = 0;
		var message = '';
		$('#bascet .product_basket').each(function(index) {
			var count_prod = parseInt($(this).find('input[name="quantity"]').val());
			var cost = parseInt($(this).find('input[name="product_cost"]').val());
			var cost_old = parseInt($(this).find('input[name="product_cost_old"]').val());
			
			$(this).find('.price').children('.new').text(cost * count_prod);
			if (cost_old > 0) {
				$(this).find('.price').children('.old').text(cost_old * count_prod);
			}
			
			count = count + count_prod;
			sum = sum + (cost * count_prod);
			
			if (cost_old > 0) {
				sum_old = sum_old + (cost_old * count_prod);
			}
			
			message += $(this).find('.title').text() + "\n";
			message += 'Размер: ' + $(this).find('select[name="size"] option:selected').text() + "\n";
			message += 'Количество: ' + $(this).find('input[name="quantity"]').val() + "\n";
			message += 'На сумму (новая): ' + (cost * count_prod) + "\n";
			if (cost_old > 0) {
				message += 'На сумму (старая): ' + (cost_old * count_prod) + "\n\n";
			}
		});
		$('#bascet .total .total_price span').text(sum);
		if (sum_old > 0) {
			$('#bascet .total .total_salle span').text(sum_old - sum);
		} else {
			$('#bascet .total .total_salle span').text(0);
		}
		message += 'Итого (новая): ' + sum + " руб.\n";
		message += 'Итого (старая): ' + sum_old + " руб.\n";
		$('#bascet textarea[name="your-order"]').text(message);
		if ($('#bascet .product_basket').length == 0) {
			$('#bascet textarea[name="your-order"]').text('');
		}
	}
	
	document.addEventListener('wpcf7mailsent', function(event) {
		//console.log(event.detail);
		if (event['detail']['id'].substring(0, 9) == 'wpcf7-f54') {
			$.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				dataType: 'json',
				cache: false,
				data: {action: 'checkout_cart', order: event.detail.inputs},
				success: function(data, statusText, xhr) {
					if (data.success) {
						$('.cart_modul .num').text('0');
						$('.cart_modul b').text('0');
						$('#bascet .name_h2 .namb').text('0');
						$('#bascet .list').html('<p>Ваша корзина пуста.</p>');
						console.log("ok");
						recalculation();
					} else {
						console.log(data);
					}
				},
				error: function(jqXHR, status, errorThrown){
					console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
				}
			});
		} else if (event['detail']['id'].substring(0, 11) == 'wpcf7-f5-p2') {
			$.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				dataType: 'json',
				cache: false,
				data: {action: 'checkout_card', order: event.detail.inputs},
				success: function(data, statusText, xhr) {
					if (data.success) {
						console.log("ok");
					} else {
						console.log(data);
					}
				},
				error: function(jqXHR, status, errorThrown){
					console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
				}
			})
		} else if (event['detail']['id'].substring(0, 10) == 'wpcf7-f255') {
			$.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				dataType: 'json',
				cache: false,
				data: {action: 'recall', order: event.detail.inputs},
				success: function(data, statusText, xhr) {
					if (data.success) {
						console.log("ok");
					} else {
						console.log(data);
					}
				},
				error: function(jqXHR, status, errorThrown){
					console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
				}
			});
		}
	}, false);
});