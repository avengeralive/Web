$(document).ready(function() {
  $('#feedback_form').validate();
	$('#become_partner_form').validate();

	$("input[type=tel]").mask("+7 (999) 99 99 999");
	
	
	$('body').on('submit', '.ajax-form', function() {

    var form_id = $(this).attr('id');
    var form_url = $(this).data('url');

    request = $.ajax({
        url: form_url,
        type: "POST",
        data: $(this).serialize(),
    });

    request.done(function( msg ) {
        $( "#" + form_id ).html( msg );
    });

    request.fail(function( jqXHR, textStatus ) {
        alert( "Форма не отправлена =(   : " + textStatus );
    });

    return false;

  });
	

	$('.fancybox').fancybox({
		padding: 0,
		helpers: {
	    overlay: {
	      locked: false
	    }
	  }
	});
	
	ymaps.ready(function () {
  	var coords = [ $("#map").attr('data-lat'), $("#map").attr('data-lon') ];
    var myMap = new ymaps.Map('map', {
      center: coords,
      zoom: 13
    }, {
       searchControlProvider: 'yandex#search'
    }),
    myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
    	
    }, {

    });

    myMap.geoObjects.add(myPlacemark);
	});
	
	
	$('.js-like-counter').each(function( index ) {
		var url = $(this).data('url');
		var current = $(this);
		$.ajax({
		  url: "/ajax/counter.php",
		  data: {url: url}
		}).done(function(cnt) {
			//alert('Отчет: '+ cnt);
		  current.text(cnt);
		});
		
		return false;
	});
	
	var headerSearch = function() {
		$('.main-form').animate({
			width: '255px'
		}, 200);
		$('.main-form .main-input').fadeIn(100);
		$('.main-form').addClass('search-open')
	}
	var headerSearchClose = function() {
		$('.main-form .main-input').animate({
			opacity: 0
		}, 500);
		$('.main-form').animate({
			width: '45px'
		}, 200);
		setTimeout(function() {
			$('.main-form .main-input').css('display', 'none');
			$('.main-form .main-input').css('opacity', '1');
			$('.main-form .main-input').val('')
		}, 700)
		$('.main-form').removeClass('search-open')
	}
	
	$(document).on('click', '.main-form .search', function() {
		headerSearch()
	})
	$(document).on('click', '.main-form.search-open .search', function() {
		headerSearchClose()
	})
	
/*
	$(document).on('click', '._comments', function() {
		var id = $(this).data("id");
		$('.js-comment-block-'+id).fadeIn();
		
		return false;
	});
*/
	
	
});	