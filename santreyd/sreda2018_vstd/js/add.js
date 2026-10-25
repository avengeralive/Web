function currencyFormat(num, dec) {
  num = Math.round( num / dec ) * dec;
  num = new Number(num).toFixed(0);   // особенности счета JavaScript ( x/100 не всегда = x*0.01 )
  var s = 0;
  var str = '';
  for( var i=num.toString().length-1; i>=0; i-- ) {
    s++;
    str = num.toString().charAt(i) + str;
    if(num.toString().charAt(i)=='.') s=0;
    if( s > 0 && !(s % 3) ) str  = " " + str;
  }
  return str;
}

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
      MyFavourite.reload();
      return true;
    }
  });

	return false;
};

function calculate_complect(){
		var sum = 0;
		var sum_no_discount = 0;
		$("#complect .catalog-item-complect-icon-plus.checked").each(function(index, element){
				sum+= $(this).data('value')*1
				sum_no_discount+= parseInt($(this).data('no-discount-price'));
				$('#complect_price').text(currencyFormat(sum, 1));
				$('#complect_price_no_discount_total').text(sum_no_discount);
		});

}; //calculate_complect

$(function(){

	if($(window).width() <= 660){
		$('.article-inner-text img').each(function(){
			$(this).wrap('<div class="art_image"></div>');
		});
	}

	$(document).on('click', '.crazy-grid-line-href', function() {
		var link = $(this).data('link');
		$.ajax({
		  url: "/ajax/main-tile.php?"+link,
		  context: document.body
		}).done(function(data) {
		  $('#main-tile').html(data);
		});
		return false;
	});


	$('body').on('click', '.js-main-blog-refresh',function(e){
		$(this).text('Загрузка...');
		var first = $(this).data('first');
		BX.showWait();
		$.ajax({
			url: '/ajax/blog.php',
			data: {first: first},
			success: function(data)
			{
				$('.js-main-blog-refresh').hide();
				$(data).appendTo(".js-main-blog-box");
				BX.closeWait();
			}
		});
	  e.preventDefault();
	});
	/*
	$(".fancy").fancybox({
		helpers: {
	    overlay: {
	      locked: false
	    }
	  }
	});
*/
	//$( ".js-btn-buy-product" ).click(function() {
	$('.js-btn-buy-product').on('click', function() {
		var id = $(this).attr('data-item');
    addBasket(id, 'product');
	  return false;
	});

	$('.favor__btn-basket').on('click', function() {
		var id = $(this).attr('data-item');
    addBasket(id, 'product');
	  return false;
	});

	$( ".js-btn-buy-complect" ).on('click', function() {
console.log(1);
		$(this).text('Загрузка...');
console.log(2);
		var ids = [];
    $("#complect .catalog-item-complect-icon-plus.checked").each(function(index, element){
	    ids.push(parseInt($(this).data("id")));
    });
    console.log(3);

    addBasket(ids, 'complect');

	  $(this).text('В КОРЗИНУ');

	  return false;
	});


		/* slide checkbox */
	calculate_complect();

	$("#complect .catalog-item-complect-icon-plus").on('click', function(){
		$(this).toggleClass('checked');
		calculate_complect();
		return false;
	})


});
