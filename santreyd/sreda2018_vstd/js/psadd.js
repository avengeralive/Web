$(document).ready(function(){
	// создание ссылок на телефоны
	$('a[href^="tel:"]').each(function(){
		var phone = parseInt($(this).html().replace(/\D+/g,""));
		$(this).attr('href','tel:'+phone);
	});
// создание ссылок на email-ы
	$('a[href^="mailto:"]').each(function(){
		var email = $(this).text();
		email.replace('Email: ','');
		$(this).attr('href','mailto:'+email);
	});

	// Show Panel
	$( document ).on('scroll', function ( event ) {
			var offset = $('.header').height();
			if ( window.pageYOffset >= offset) {
				if(!$( '.fixed-header' ).is(':visible') && !$( '.fixed-header' ).is(':animated')){
					$( '.fixed-header' ).fadeIn( 200 );
				}	
			} else {
				if($( '.fixed-header' ).is(':visible') && !$( '.fixed-header' ).is(':animated')){
					$( '.fixed-header' ).fadeOut( 200 );
				}	
			}
	});

// fix выбора покупателей
	$('body').on('click','.image-card-item-content',function(e){
		e.preventDefault();
		if(!($(e.target).is('.favourite-button') || $(e.target).is('.js-btn-buy-product') || $(e.target).parent('.favourite-button').length || $(e.target).parent('.js-btn-buy-product').length))
			window.location.href = $(this).attr('href');
	});
	
var countHolders = function() {
	if ($('.catalog-item-firm-nav-a').length > 0) {
		var i = 0;
		$('.catalog-item-firm-nav-a').each(function() {
			i++;
			$(this).attr('id', i);
		})
		clickHolders()
	}
}
var clickHolders = function(thisItem) {
	
	var id = $('.catalog-item-firm-nav-a-active').attr('id');
	console.log(id);
	var whatFind = '.catalog-item-firm-holder-' + id;
	$('.catalog-item-firm-holder-this').hide();
	$('.catalog-item-firm-holder').find(whatFind).fadeIn(200);
}
	
	setInterval(function(){
		var fav = parseInt($('#favourite-body .fh__heart-num').text());
		if(fav > 0){
			$('.icons-menu .js-favorite .items-counter').text(fav).show();
			$('.fixed-header-favourite .count').text(fav).show();
		}
		else{
			$('.icons-menu .js-favorite .items-counter').text('').hide();
			$('.fixed-header-favourite .count').text('').hide();
		}
	});
	
	function addBasket(id, type){

		$.fancybox.showLoading();
		$.ajax({
			type: "POST",
			cache: false,
			url: '/ajax/add_basket.php',
			data: {id: id, type: type, ajax: 'Y'},
			success: function (data) {
				BX.onCustomEvent('OnBasketChange');
				$.fancybox.hideLoading();
				$.fancybox(data, {
					maxWidth: 520,
					padding: 0,
					helpers: {
						overlay: {
							locked: false
						}
					},
				});
				// MyFavourite.reload();
				return true;
			}
		});

		return false;
	};
	
	$('body').on('click','.js-btn-buy-product', function() {
		var id = $(this).data('id');
    addBasket(id, 'product');
	  return false;
	});
	
	// $(".main-slider").slick({
		// dots: true,
		// arrows: false,
		// infinite: true,
		// autoplay: true,
		// autoplaySpeed: 8000,
		// speed: 300,
		// asNavFor: '.slider-info',
	// });
	
	$('.blog-slider').slick({
		dots: true,
		arrows: false,
		infinite: true,
		autoplay: true,
		autoplaySpeed: 8000,
		speed: 300
	});

	$('.news-slider').slick({
			dots: true,
			arrows: false,
			infinite: false,
			speed: 300,
			slidesToShow: 3,
			slidesToScroll: 3,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 576,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
	});
	
	// $('.slider-info').slick({
		// slidesToShow: 1,
		// slidesToScroll: 1,
		// centerMode: true,
		// draggable: false,
		// focusOnSelect: true,
		// adaptiveHeight: true
	// });

	$('.hamburger').click(function(){
		$('body').toggleClass('is-reveal-open');
		$('.full.reveal.reveal-modal').toggleClass('without-overlay').fadeIn(300);
	});
	$('.full.reveal.reveal-modal .close-button').click(function(){
		$('body').toggleClass('is-reveal-open');
		$('.full.reveal.reveal-modal').toggleClass('without-overlay').fadeOut(300);
	});
	
	// $('.bchoice-slider').slick({
		// dots: true,
		// arrows: false,
		// infinite: false,
		// autoplay: true,
		// autoplaySpeed: 3000,
		// speed: 300,
		// slidesToShow: 3,
		// slidesToScroll: 3,
		// responsive: [
			// {
				// breakpoint: 992,
				// settings: {
					// slidesToShow: 2,
					// slidesToScroll: 2
				// }
			// },
			// {
				// breakpoint: 576,
				// settings: {
					// slidesToShow: 1,
					// slidesToScroll: 1
				// }
			// }
		// ]
	// });
	$('body').animate({'opacity':1},500);
	
	$('.fixed-header-butter').click(function(e){
		e.preventDefault();
		$('body').toggleClass('is-reveal-open');
		$('.full.reveal.reveal-modal').toggleClass('without-overlay').fadeIn(300);
	});

});