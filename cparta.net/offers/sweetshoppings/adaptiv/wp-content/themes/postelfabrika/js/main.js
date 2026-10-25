$(document).ready(function() {
	
	/*Start DocumentReady*/
	var urllink=document.location.href;
	 $.each($(".catalog .list-inline li a"),function(){         //Меняем id или вписываем этот
	  if(this.href==urllink){
		  $(this).parent('li').addClass('label-danger');
		  $(this).addClass('catalog-link-white');
		  };
	 });
	 $.each($(".catalog .wwq li a"),function(){         //Меняем id или вписываем этот
	  if(this.href==urllink){
		  $(this).parent('li').addClass('label-danger');
		  $(this).addClass('catalog-link-white');
		  };
	 });
	 
	$('.wwq li a').click(function(e){
		e.preventDefault();
		$('.wwq li').removeClass('label-danger');
		$('.wwq li a').removeClass('catalog-link-white');
		$(this).parent('li').addClass('label-danger');
		$(this).addClass('catalog-link-white');
		
	});
	
	$('.wwq li').click(function(){
		
		iing = $(this).index();
		
		if(iing == '0') {
			pr1 = '6300';
			pr2 = '1890';
			razm = '170x210';
			sss = 'Покрывала 1.5-спальные';
		}
		if(iing == '1') {
			pr1 = '2211';
			pr2 = '1990';
			razm = '200x210';
			sss = 'Покрывала 2-спальные';
		}
		if(iing == '2') {
			pr1 = '2767';
			pr2 = '2490';
			razm = '240x210';
			sss = 'Покрывала евро';
		}
		
		$('.pr1').text(pr1);
		$('.pr2').text(pr2);
		$('.razm').text(razm);
		$('#sss').attr('value',sss);
		
	});
	 
	 
	/*End DocumentReady*/
	
	$.cookie("click_id", url("?click_id"), {expires : 80});
	$.cookie("utm", url('?utm_source'), {expires : 80});
    var cart = [];

    var article, price, category, img_src;

    $('body').on('click', '.catalog-product-card img', function() {
        article = $(this).parent().parent().find('#article').text().split(": ")[1];
        price = $(this).parent().parent().find('#price').text().split(": ")[1];
        price_old = $(this).parent().parent().find('#price_old').text().split(": ")[1];
        img_src = $(this).parent().parent().find('img').attr('src');
        category = $("li.label").text();

        $('.modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        $('.modal-body').html('');
        $('.modal-footer').html('');

        var c_n = "";
        if (typeof $.cookie('name') !== 'undefined') {
            c_n = $.cookie('name');
        }
        var c_p = "";
        if (typeof $.cookie('phone') !== 'undefined') {
            c_p = $.cookie('phone');
        }
        $('.modal-header').html($('.modal-header').html() + '<h4>Введите ваши данные:</h4>');
        $('.modal-body').append('<div><img src="'+img_src+'"></div>');
        $('.modal-body').append('<span style="font-size: 23px;">Артикул: '+article+'</span>');
        $('.modal-body').append('<div style="font-size: 16px;">Старая цена: <span style="text-decoration: line-through;">'+ price_old + "</span></div>");
        $('.modal-body').append('<div style="font-size: 23px;">Новая цена цена: <span style="color: red;">' + price + "</span></div>");
        $('#art').attr('value',article);
		$('#prr').attr('value',price);
        $('#modal').modal('toggle');
    });

    $('body').on('click', '.catalog-product-card-button', function() {
     
        article = $(this).parent().parent().find('#article').text().split(": ")[1];
        price = $(this).parent().parent().find('#price').text().split(": ")[1];
        price_old = $(this).parent().parent().find('#price_old').text().split(": ")[1];
        img_src = $(this).parent().parent().find('img').attr('src');
        category = $("li.label").text();
        id = false;
		
        $('.modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        $('.modal-body').html('');
        $('.modal-footer').html('');

        var c_n = "";
        if (typeof $.cookie('name') !== 'undefined') {
            c_n = $.cookie('name');
        }
        var c_p = "";
        if (typeof $.cookie('phone') !== 'undefined') {
            c_p = $.cookie('phone');
        }
        $('.modal-header').html($('.modal-header').html() + '<h4>Введите ваши данные:</h4>');
        $('.modal-body').append('<span style="font-size: 23px;">Артикул: '+article+'</span>');
        $('.modal-body').append('<div><img style="height: 150px; width: auto;" src="'+img_src+'"></div>');
        $('.modal-body').append('<div style="font-size: 16px;">Старая цена: <span style="text-decoration: line-through;">'+ price_old + "</span></div>");
        $('.modal-body').append('<div style="font-size: 23px;">Новая цена цена: <span style="color: red;">' + price + "</span></div>");
        $('#art').attr('value',article);
		$('#prr').attr('value',price);
        $('#modal').modal('toggle');
    });

    
    
   
	

    $('body').on('click', '#modal-order-close-button', function() {
        $("#modal").modal('toggle');
    });

    updateTimer();
	
	$('form').submit(function(){
		
		var ooozzzyy = Math.ceil(Math.random() * 100 );
		var wazzuppe = ( ooozzzyy < 50 ) ? 0 : 1;
		
		if (wazzuppe) {
	        	if ($.cookie("ordered")!="1") {
	              
	                if (typeof(yaCounter37026060) != "undefined") yaCounter37026060.reachGoal("lead");
	                ga("send","event","lead","done");
 
	                goog_report_conversion();
		            $.cookie("ordered", "1", {expires : 1000});
	        	}
			} else {
				$.cookie("ordered", "1", {expires : 1000});
			}
		
	});	
 
	
});

function updateTimer() {
    var time = new Date();
    $(".h").text(24 - time.getHours());
    $(".m").text(60 - time.getMinutes());
    $(".s").text(60 - time.getSeconds());
    setTimeout(updateTimer, 1000);
}

function clearModal() {
    $('.modal-header').animate({
        opacity: 0
    }, 300);
    $('.modal-body').animate({
        opacity: 0
    }, 300);
    $('.modal-footer').animate({
        opacity: 0
    }, 300);
    $('.modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
    $('.modal-body').html('');
    $('.modal-footer').html('');
    $('.modal-header').animate({
        opacity: 1
    }, 300);
    $('.modal-body').animate({
        opacity: 1
    }, 300);
    $('.modal-footer').animate({
        opacity: 1
    }, 300);
}

function getId() {
    var id = $.cookie('postel-id');
    if (!id) {
        id = Math.random() + Math.random() + Math.random();
        $.cookie('postel-id', id, {
            expires: 1
        });
    }
    return id;
}