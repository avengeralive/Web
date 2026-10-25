$(function() {
	$('input, textarea').placeholder({customClass:'my-placeholder'});
	$(document).ready(function(){
		$(".popup").colorbox({inline:true});
	});
	$('input, select').styler({
		selectSearch: true,
	});
	var swiper = new Swiper('.slider_first_page .swiper-container', {
        pagination: {
            el: '.slider_first_page .swiper-pagination',
            type: 'bullets',
        },
        paginationClickable: true,
		autoplay: 2500,
        autoplayDisableOnInteraction: false
    });
	var swiper = new Swiper('.slider_first_page .swiper-container', {
        pagination: '.slider_first_page .swiper-pagination',
        paginationClickable: true,
		autoplay: 2500,
        autoplayDisableOnInteraction: false
    });
	
	var swiper = new Swiper('.table_info_box .swiper-container', {
        nextButton: '.table_info_box .swiper-button-next',
        prevButton: '.table_info_box .swiper-button-prev',
        spaceBetween: 30
    });
	
	var galleryTop = new Swiper('.webcam .gallery-top', {
        nextButton: '.webcam .swiper-button-next',
        prevButton: '.webcam .swiper-button-prev',
        spaceBetween: 10,
        loop:true,
        loopedSlides: 1, //looped slides should be the same     
    });
    var galleryThumbs = new Swiper('.webcam .gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        touchRatio: 0.2,
        loop:true,
        loopedSlides: 1, //looped slides should be the same
        slideToClickedSlide: true
    });
    galleryTop.params.control = galleryThumbs;
    galleryThumbs.params.control = galleryTop;
	
	
	var swiper = new Swiper('.slider_vertical .swiper-container', {
        pagination: '.slider_vertical .swiper-pagination',
        paginationClickable: true,
        direction: 'vertical',
		autoplay: 2500,
        autoplayDisableOnInteraction: false
    });
	
	var swiper = new Swiper('.slider_personal .swiper-container', {
        pagination: '.slider_personal .swiper-pagination',
        paginationClickable: true,
        nextButton: '.slider_personal .swiper-button-next',
        prevButton: '.slider_personal .swiper-button-prev',
        spaceBetween: 30,
		slidesPerView: 5
    });
	
	var swiper = new Swiper('.slider_img .swiper-container', {
        pagination: '.slider_img .swiper-pagination',
        paginationClickable: true,
        nextButton: '.slider_img .swiper-button-next',
        prevButton: '.slider_img .swiper-button-prev',
        spaceBetween: 30
    });
	calculator();	
	$("#calc").submit(function(){
		reCalc();
		return false;
	});
	for (i=1; i<=$('#calcTable').attr('data-count'); i++) weightcalculator(i);

	var allItemsClass = 'tabledata';
	var lengthId = 'length';
	var weightId = 'weight';
	$("#"+weightId).val(1);
	var calcId = 'calc';
	var materialId = 'material';
	var meterWeightKg = $("#"+calcId).attr('data-price');
	$('#'+lengthId).val(Math.max(0,(1000*$('#'+weightId).val()/(meterWeightKg * $("#"+materialId).val())).toFixed(3)));
	var price1Class = 'price';
	var price2Class = 'price2';
	$("."+allItemsClass).each(function(){
		//$(this).children('.length').html($("#"+lengthId).val());
		//$(this).children('.'+price1Class).html('<b>'+(Math.max(0,($(this).attr('data-price') * $(this).attr('data-price-sub'))*$("#"+weightId).val()))+'</b><img src="/static/images/rub_table.png" alt="">');
		$(this).children('.'+price2Class).html('<b>'+((Math.max(0,($(this).attr('data-price') * $(this).attr('data-price-sub'))*$("#"+weightId).val()))/$("#"+lengthId).val()).toFixed(1)+'</b><img src="/static/images/rub_table.png" alt="">');
	});
	$("#"+weightId).val('');
	$("#"+lengthId).val('');
});
function filter(item, className)
{
	var allItemsClass = 'tabledata';
	var activeLinkClass = 'active';
	var allClass = 'all';
	var listClass = 'select';
	if ( $(item).hasClass(activeLinkClass) )
	{
		$(item).removeClass(activeLinkClass);
		$("."+className).hide();
	}
	else
	{
		if ( $('.'+allClass).hasClass(activeLinkClass) )
		{
			$('.'+allClass).removeClass(activeLinkClass);
			$("."+allItemsClass).hide();
		}
		if ( className == allItemsClass )
		{
			$('.'+listClass+'>a').removeClass(activeLinkClass);
		}
		$(item).addClass(activeLinkClass);
		$("."+className).show();
	}
	return false;
}

function calculator()
{
	var calcId = 'calc';
	var weightId = 'weight';
	var lengthId = 'length';
	var itemLengthId = 'itemLength';
	var countId = 'count';
	var materialId = 'material';
	var meterWeightKg = $("#"+calcId).attr('data-price');
	if (typeof($("#"+materialId).val()) != 'undefined' )
	{
		$('#'+weightId).change(function(){
			$('#'+lengthId).val(Math.max(0,(1000*$('#'+weightId).val()/(meterWeightKg * $("#"+materialId).val())).toFixed(3)));
			if ( $.isNumeric($('#'+itemLengthId).val()) && $('#'+itemLengthId).val() != 0 && $.isNumeric($('#'+lengthId).val()) ) $('#'+countId).val(Math.max(0,($('#'+lengthId).val()/$('#'+itemLengthId).val()).toFixed(1)));
		});
		$('#'+lengthId).change(function(){
			$('#'+weightId).val(Math.max(0,($('#'+lengthId).val()*(meterWeightKg * $("#"+materialId).val())/1000).toFixed(3)));
			if ( $.isNumeric($('#'+itemLengthId).val()) && $('#'+itemLengthId).val() != 0 && $.isNumeric($('#'+lengthId).val()) ) $('#'+countId).val(Math.max(0,($('#'+lengthId).val()/$('#'+itemLengthId).val()).toFixed(1)));
		});
		$('#'+itemLengthId).change(function(){
			if ($('#'+itemLengthId).val() != 0) $('#'+countId).val(Math.max(0,($('#'+lengthId).val()/$('#'+itemLengthId).val()).toFixed(1)));
		});
		$('#'+countId).change(function(){
			if ($('#'+countId).val() != 0) $('#'+itemLengthId).val(Math.max(0,($('#'+lengthId).val()/$('#'+countId).val()).toFixed(1)));
		});
		$('#'+materialId).change(function(){
			$('#'+lengthId).val(Math.max(0,(1000*$('#'+weightId).val()/(meterWeightKg * $("#"+materialId).val())).toFixed(3)));
			if ( $.isNumeric($('#'+itemLengthId).val()) && $('#'+itemLengthId).val() != 0 && $.isNumeric($('#'+lengthId).val()) ) $('#'+countId).val(Math.max(0,($('#'+lengthId).val()/$('#'+itemLengthId).val()).toFixed(1)));
		});
	}
	else
	{
		$('#'+weightId).change(function(){
			$('#'+lengthId).val(Math.max(0,(1000*$('#'+weightId).val()/meterWeightKg).toFixed(3)));
			if ( $.isNumeric($('#'+itemLengthId).val()) && $('#'+itemLengthId).val() != 0 && $.isNumeric($('#'+lengthId).val()) ) $('#'+countId).val(Math.max(0,($('#'+lengthId).val()/$('#'+itemLengthId).val()).toFixed(1)));
		});
		$('#'+lengthId).change(function(){
			$('#'+weightId).val(Math.max(0,($('#'+lengthId).val()*meterWeightKg/1000).toFixed(3)));
			if ( $.isNumeric($('#'+itemLengthId).val()) && $('#'+itemLengthId).val() != 0 && $.isNumeric($('#'+lengthId).val()) ) $('#'+countId).val(Math.max(0,($('#'+lengthId).val()/$('#'+itemLengthId).val()).toFixed(1)));
		});
		$('#'+itemLengthId).change(function(){
			if ($('#'+itemLengthId).val() != 0) $('#'+countId).val(Math.max(0,($('#'+lengthId).val()/$('#'+itemLengthId).val()).toFixed(1)));
		});
		$('#'+countId).change(function(){
			if ($('#'+countId).val() != 0) $('#'+itemLengthId).val(Math.max(0,($('#'+lengthId).val()/$('#'+countId).val()).toFixed(1)));
		});
	}
}

function reCalc()
{
	var allItemsClass = 'tabledata';
	var lengthId = 'length';
	var weightId = 'weight';
	var price1Class = 'price';
	var price2Class = 'price2';
	$("."+allItemsClass).each(function(){
		//$(this).children('.length').html($("#"+lengthId).val());
		$(this).children('.'+price1Class).html('<b>'+(Math.max(0,($(this).attr('data-price') * $(this).attr('data-price-sub'))*$("#"+weightId).val()))+'</b><img src="/static/images/rub_table.png" alt="">');
		$(this).children('.'+price2Class).html('<b>'+((Math.max(0,($(this).attr('data-price') * $(this).attr('data-price-sub'))*$("#"+weightId).val()))/$("#"+lengthId).val()).toFixed(1)+'</b><img src="/static/images/rub_table.png" alt="">');
	});
	return false;
}

function weightcalculator(id)
{
	var weightClass = 'weight';
	var lengthClass = 'length';
	var itemLengthClass = 'itemLength';
	var countClass = 'count';
	var materialClass = 'material';
	var itemId = 'item';
	var meterWeightKg = $('#'+itemId+"_"+id).attr('data-price');
	if (typeof($('#'+itemId+'_'+id+' select.'+materialClass).val()) != 'undefined' )
	{
		$('#'+itemId+'_'+id+' .'+weightClass).change(function(){
			$('#'+itemId+'_'+id+' .'+lengthClass).val(Math.max(0,(1000*$('#'+itemId+'_'+id+' .'+weightClass).val()/(meterWeightKg * $('#'+itemId+'_'+id+' select.'+materialClass).val())).toFixed(3)));
			if ( $.isNumeric($('#'+itemId+'_'+id+' .'+itemLengthClass).val()) && $('#'+itemId+'_'+id+' .'+itemLengthClass).val() != 0 && $.isNumeric($('#'+itemId+'_'+id+' .'+lengthClass).val()) ) $('#'+itemId+'_'+id+' .'+countClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()/$('#'+itemId+'_'+id+' .'+itemLengthClass).val()).toFixed(1)));
		});
		$('#'+itemId+'_'+id+' .'+lengthClass).change(function(){
			$('#'+itemId+'_'+id+' .'+weightClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()*(meterWeightKg * $('#'+itemId+'_'+id+' select.'+materialClass).val())/1000).toFixed(3)));
			if ( $.isNumeric($('#'+itemId+'_'+id+' .'+itemLengthClass).val()) && $('#'+itemId+'_'+id+' .'+itemLengthClass).val() != 0 && $.isNumeric($('#'+itemId+'_'+id+' .'+lengthClass).val()) ) $('#'+itemId+'_'+id+' .'+countClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()/$('#'+itemId+'_'+id+' .'+itemLengthClass).val()).toFixed(1)));
		});
		$('#'+itemId+'_'+id+' .'+itemLengthClass).change(function(){
			$('#'+itemId+'_'+id+' .'+countClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()/$('#'+itemId+'_'+id+' .'+itemLengthClass).val()).toFixed(1)));
		});
		$('#'+itemId+'_'+id+' .'+countClass).change(function(){
			$('#'+itemId+'_'+id+' .'+itemLengthClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()/$('#'+itemId+'_'+id+' .'+countClass).val()).toFixed(1)));
		});
		$('#'+itemId+'_'+id+' select.'+materialClass).change(function(){
			$('#'+itemId+'_'+id+' .'+lengthClass).val(Math.max(0,(1000*$('#'+itemId+'_'+id+' .'+weightClass).val()/(meterWeightKg * $('#'+itemId+'_'+id+' select.'+materialClass).val())).toFixed(3)));
			if ( $.isNumeric($('#'+itemId+'_'+id+' .'+itemLengthClass).val()) && $('#'+itemId+'_'+id+' .'+itemLengthClass).val() != 0 && $.isNumeric($('#'+itemId+'_'+id+' .'+lengthClass).val()) ) $('#'+itemId+'_'+id+' .'+countClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()/$('#'+itemId+'_'+id+' .'+itemLengthClass).val()).toFixed(1)));
		});
	}
	else
	{
		$('#'+itemId+'_'+id+' .'+weightClass).change(function(){
			$('#'+itemId+'_'+id+' .'+lengthClass).val(Math.max(0,(1000*$('#'+itemId+'_'+id+' .'+weightClass).val()/meterWeightKg).toFixed(3)));
			if ( $.isNumeric($('#'+itemId+'_'+id+' .'+itemLengthClass).val()) && $('#'+itemId+'_'+id+' .'+itemLengthClass).val() != 0 && $.isNumeric($('#'+itemId+'_'+id+' .'+lengthClass).val()) ) $('#'+itemId+'_'+id+' .'+countClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()/$('#'+itemId+'_'+id+' .'+itemLengthClass).val()).toFixed(1)));
		});
		$('#'+itemId+'_'+id+' .'+lengthClass).change(function(){
			$('#'+itemId+'_'+id+' .'+weightClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()*meterWeightKg/1000).toFixed(3)));
			if ( $.isNumeric($('#'+itemId+'_'+id+' .'+itemLengthClass).val()) && $('#'+itemId+'_'+id+' .'+itemLengthClass).val() != 0 && $.isNumeric($('#'+itemId+'_'+id+' .'+lengthClass).val()) ) $('#'+itemId+'_'+id+' .'+countClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()/$('#'+itemId+'_'+id+' .'+itemLengthClass).val()).toFixed(1)));
		});
		$('#'+itemId+'_'+id+' .'+itemLengthClass).change(function(){
			$('#'+itemId+'_'+id+' .'+countClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()/$('#'+itemId+'_'+id+' .'+itemLengthClass).val()).toFixed(1)));
		});
		$('#'+itemId+'_'+id+' .'+countClass).change(function(){
			$('#'+itemId+'_'+id+' .'+itemLengthClass).val(Math.max(0,($('#'+itemId+'_'+id+' .'+lengthClass).val()/$('#'+itemId+'_'+id+' .'+countClass).val()).toFixed(1)));
		});
	}
}
$(document).ready(function() {
	
$('body').on('keyup', '#weight', function() {
  var preg = $(this).val().replace(/[^\d.]*/g, '').replace(/([.])[.]+/g, '$1').replace(/^[^\d]*(\d+([.]\d{0,5})?).*$/g, '$1');
  $(this).val(preg);
});

$('body').on('keyup', '#length', function() {
  var preg = $(this).val().replace(/[^\d.]*/g, '').replace(/([.])[.]+/g, '$1').replace(/^[^\d]*(\d+([.]\d{0,5})?).*$/g, '$1');
  $(this).val(preg);
});

$('body').on('keyup', '#itemLength', function() {
  var preg = $(this).val().replace(/[^\d.]*/g, '').replace(/([.])[.]+/g, '$1').replace(/^[^\d]*(\d+([.]\d{0,5})?).*$/g, '$1');
  $(this).val(preg);
});

$('body').on('keyup', '#count', function() {
  var preg = $(this).val().replace(/[^\d.]*/g, '').replace(/([.])[.]+/g, '$1').replace(/^[^\d]*(\d+([.]\d{0,5})?).*$/g, '$1');
  $(this).val(preg);
});

$('body').on('keyup', '.weight', function() {
  var preg = $(this).val().replace(/[^\d.]*/g, '').replace(/([.])[.]+/g, '$1').replace(/^[^\d]*(\d+([.]\d{0,5})?).*$/g, '$1');
  $(this).val(preg);
});

$('body').on('keyup', '.length', function() {
  var preg = $(this).val().replace(/[^\d.]*/g, '').replace(/([.])[.]+/g, '$1').replace(/^[^\d]*(\d+([.]\d{0,5})?).*$/g, '$1');
  $(this).val(preg);
});

if($('.result')[0])
{
 $('html,body').animate({
        scrollTop: $('.result').offset().top},
        'slow');
 return true;
}
if($('.catalog_info')[0])
{
   $('html,body').animate({
        scrollTop: $(".catalog_info").offset().top},
        'slow');
 return true;
 }
if($('.size_box')[0])
{
   $('html,body').animate({
        scrollTop: $(".size_box").offset().top},
        'slow');
 return true;
 }
if($('.second_line')[0])
{
 $('html,body').animate({
        scrollTop: $('.second_line').offset().top},
        'slow');
 if($('.column')[0])
{
 $('html,body').animate({
        scrollTop: $('.column').offset().top},
        'slow');
 return true;
}
 return true;
}
});