(function($) {
$(function() {
	$('input, select').styler({
		selectSearch: true
	});
});
})(jQuery);

$(function() {
	$('input, textarea').placeholder({customClass:'my-placeholder'});
	$(".btn").colorbox({inline:true});
    //$('.bwWrapper').BlackAndWhite();
    $('.slider_inner .list a').click(function(){
    	var img = $(this).prop('href');
    	$(this).closest('.list').find('.active').removeClass('active')
    	$(this).addClass('active');
    	$(this).closest('.slider_inner').find('.big img').prop('src',img).css('opacity',0).animate({opacity: 1}, 300);
    	return false;
    });
    var swiperTop = new Swiper('.slider_top .swiper-container', {
		speed: 400,
		spaceBetween: 0,
		slidesPerView: 1,
		pagination: '.slider_top .list ul',
		paginationElement: 'li',
		paginationClickable: true
	});   
    var swiperBottom = new Swiper('.slider_bottom .swiper-container', {
		speed: 400,
		spaceBetween: 0,
		slidesPerView: 1,
		pagination: '.slider_bottom .list ul',
		paginationElement: 'li',
		paginationClickable: true
	});   
    var swiperData = new Swiper('.data .swiper-container', {
		speed: 400,
		spaceBetween: 0,
		slidesPerView: 1,
		nextButton: '.data .left .arrow_right',
		prevButton: '.data .left .arrow_left',
	});   
    var swiperLogo = new Swiper('.slider_logo .swiper-container', {
		speed: 400,
		spaceBetween: 0,
		slidesPerView: 12,
		nextButton: '.slider_logo .arrow_right',
		prevButton: '.slider_logo .arrow_left',
	});   
    var swiperEmployers = new Swiper('.slider_employees .swiper-container', {
		speed: 400,
		spaceBetween: 36,
		slidesPerView: 6,
		nextButton: '.slider_employees .arrow_right',
		prevButton: '.slider_employees .arrow_left',
	});  
	calculator();	
	$("#calc").submit(function(){
		reCalc();
		return false;
	});
	for (i=1; i<=$('#calcTable').attr('data-count'); i++) weightcalculator(i);
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
		$(this).children('.'+price1Class).html('<b>'+(Math.max(0,$(this).attr('data-price')*$("#"+weightId).val()))+'</b><img src="/static/images/rub_table.png" alt="">');
		$(this).children('.'+price2Class).html('<b>'+(Math.max(0,($(this).attr('data-price') - $(this).attr('data-price-sub'))*$("#"+weightId).val()))+'</b><img src="/static/images/rub_table.png" alt="">');
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