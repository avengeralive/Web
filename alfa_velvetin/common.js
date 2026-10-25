document.addEventListener('DOMContentLoaded', function () {

	if (jQuery('.x-sale-city').length)
	{
		jQuery('.x-sale-city').autocomplete({
			minLength: 2,
			source: '/plugins/sale/ajax.php?action=city_lookup'
		});
	}

	jQuery('.x-sale-slider-range').each(function(key,value){					
				
		jQuery(value).slider({
			range: true,
			min: parseInt(jQuery(value).attr('data-start')),
			max: parseInt(jQuery(value).attr('data-end')),
			values: [
				parseInt(jQuery(value).attr('data-initial-start')),
				parseInt(jQuery(value).attr('data-initial-end'))
			],
			animate: false,
			classes: {
				"ui-slider": "slider",
				"ui-slider-range":  "slider-fill",
				"ui-slider-handle":  "slider-handle"
			},
			slide: function(event,ui) {
				var start = jQuery( event.target ).attr('data-control-start');
				jQuery( '#' + start).val(ui.values[0]);
				var end = jQuery( event.target ).attr('data-control-end');
				jQuery( '#' + end).val(ui.values[1]);				
			}
		});	

		jQuery( '#' + jQuery(value).attr('data-control-start') ).on('change', function(){			
			jQuery(value).slider( 'values', 0, jQuery(this).val() );			
		});
		
		jQuery( '#' + jQuery(value).attr('data-control-end') ).on('change', function(){			
			jQuery(value).slider( 'values', 1, jQuery(this).val() );			
		});		
		
	});

	jQuery('.x-order-cancel').click(function(event){
		
		event.preventDefault();
		var oid = jQuery(this).attr('data-oid');
		jQuery(this).html(_('Подождите...'));
		jQuery.ajax({
			url : '/plugins/sale/ajax.php',
			data: {
				action: 'order_cancel',
				id: oid
			},
			success: function (data) {                                
				jQuery('.x-order-'+oid+' .x-order-status').html(data);
				jQuery('.x-order-'+oid+' .x-order-cancel').remove();
			}
		});				
		
	});	
	$(document.body).on('click', '.x-add-to-wishlist', function(event){

		var pid = jQuery(this).attr('data-id');
		var me = jQuery(this);
		jQuery.ajax({
			url : '/plugins/sale/ajax.php',
			data: {
				action: 'wishlist_add',
				id: pid
			},
			dataType: 'json',
			success: function (data) {
				jQuery(document).trigger( 'cetera.sale.wishlist.add', [ data ] );
				me.html('<i class="fa fa-heart"></i>В избранном');
				me.removeClass('x-add-to-wishlist');
				me.addClass('x-remove-from-wishlist');
				//me.hide();

				//sale_show_result_tooltip( me, _('Товар добавлен в список') ) ;
			}
		});				
		//$(this).hide();
		//$(this).parent().children('.x-remove-from-wishlist').show();
	});	
	
	jQuery('.x-add-to-compare').click(function(event){

		event.preventDefault();
		var pid = jQuery(this).attr('data-id');
		var me = jQuery(this);
		jQuery.ajax({
			url : '/plugins/sale/ajax.php',
			data: {
				action: 'compare_add',
				id: pid
			},
			dataType: 'json',
			success: function (data) {
				jQuery(document).trigger( 'cetera.sale.compare.add', [ data ] );
				sale_show_result_tooltip( me, _('Товар добавлен к сравнению') ) ;
			}
		});				
		
	});	
	
	jQuery('.x-remove-from-compare').click(function(event){

		event.preventDefault();
		var pid = jQuery(this).attr('data-id');
		var me = jQuery(this);
		jQuery.ajax({
			url : '/plugins/sale/ajax.php',
			data: {
				action: 'compare_remove',
				id: pid
			},
			dataType: 'json',
			success: function (data) {
				jQuery(document).trigger( 'cetera.sale.compare.remove', [ data ] );
				sale_show_result_tooltip( me, _('Товар удален из списка') ) ;
			}
		});				
		
	});		

	jQuery('.x-clear-compare').click(function(event){

		event.preventDefault();
		jQuery.ajax({
			url : '/plugins/sale/ajax.php',
			data: {
				action: 'compare_clear'
			},
			dataType: 'json',
			success: function () {
				jQuery(document).trigger( 'cetera.sale.compare.clear' );
			}
		});				
		
	});		

	jQuery(".x-more").click(function(){
		var q = jQuery(this).parents('.x-product').find('.x-quantity');	
		var v = parseInt(q.val());
		if (isNaN(v)) v = 0;
		v = v+1;
		if (v<1) v = 1;		
		q.val(v);
	});
	
	jQuery(".x-less").click(function(){
		var q = jQuery(this).parents('.x-product').find('.x-quantity');	
		var v = parseInt(q.val());
		if (isNaN(v)) v = 0;
		v = v-1;
		if (v<1) v = 1;		
		q.val(v);
	});	
	
	jQuery(".x-add-to-cart").click(function() {

		var me = jQuery(this);
		var pid = me.attr('data-id');
		var p = jQuery(this).parents('.x-product');	
		if (!pid) {
			var pid = p.attr('data-id');
		}
		if (me.attr('data-quantity')) {
			var v = parseInt(me.attr('data-quantity'));
		}
		else {
			var v = parseInt(p.find('.x-quantity').val());
		}
		if (isNaN(v)) v = 1;
		
		var data = {
			action: 'add_to_cart',
			quantity: v,
			id: pid
		}		
		
		if (me.attr('data-offer-id')) {
			data.offer_id = parseInt(me.attr('data-offer-id'));
		}
		else {
			var o = p.find('.x-offer');
			if (o.length == 1) {
				data.offer_id = p.find('.x-offer').val();
			}
			else if (o.length > 1) {
				data.offer_id = p.find('.x-offer:checked').val();
			}
		}
		
		p.find('.x-options').each(function(){
			if( $(this).attr('name') && $(this).val() ) {
				if (!data.options) data.options = [];
				data.options[data.options.length] = {
					name: $(this).attr('name'),
					value: $(this).val()
				};
			}
		});
		
        jQuery.ajax({
            url : '/plugins/sale/ajax.php',
			data: data,
			dataType: 'json',
            success: function (data) {                                
				jQuery(document).trigger( 'cetera.sale.basket.add', [ data ] );	
				jQuery(document).trigger( 'cetera.sale.cart.add', [ data ] );	
				
				if (me.hasClass('x-checkout')) {
					var url = '/order/';
					if (me.attr('data-checkout-url')) {
						url = me.attr('data-checkout-url');
					}
					window.location = url;
				} else {
					//sale_show_result_tooltip( me, 'Товар добавлен в корзину' ) ;
					$(".dobavl").css('display', 'flex');
				}

				me.addClass('in_cart');
                me.html('В корзине');
            },
            error: function (xhr) {
				sale_show_result_tooltip( me, xhr.responseJSON.message );
            }			
        });		
	
		
	});	
	$(document.body).on('click', '.x-remove-from-wishlist', function(event) {
		event.preventDefault();
		var me = jQuery(this);
		var p = jQuery(this).parents('.columns');	
		var pid = me.attr('data-id');
        jQuery.ajax({
            url : '/plugins/sale/ajax.php',
			dataType: 'json',
			data: {
				action: 'wishlist_remove',
				id: pid
			},
            success: function (data) {
				jQuery(document).trigger( 'cetera.sale.wishlist.add', [ data ] );
				//jQuery("#" + pid).parents('.columns').remove();
				//if (me.hasClass('wishlist-area')) {
					//jQuery("#" + pid).parents('.columns').remove();
					//p.remove();
				//}
				//me.html('<i class="fa fa-heart-o"></i>Добавить в избранное');
				//me.addClass('x-add-to-wishlist');
				//me.removeClass('x-remove-from-wishlist');
				window.location.href = '/personal/wishlist';
				location.href = '/personal/wishlist';
            }
        });			
	});
	
	// расчет стоимости доставки выбранным метедом
	jQuery('.x-delivery-method-calculate').click(function(event) {
		event.preventDefault();
		var me = jQuery(this);
		var form = me.parents('.x-order-form');
		var data = form.serializeArray();
		
		me.html('Подождите ...');
        jQuery.ajax({
            url : '/plugins/sale/ajax.php?action=delivery_calculate&delivery_method='+me.attr('data-id'),
			data: data,
			dataType: 'json',
			method: 'post',
			success: function (data) { 
				var p = me.parents('.x-delivery-method');
				p.find('.x-delivery-method-cost').removeClass('error').html( data.delivery_cost );
				if (p.find('input:checked').length)
				{
					jQuery('.x-delivery-cost').html(data.delivery_cost);
					jQuery('.x-total').html(data.total);
					jQuery('.x-order-confirm').removeAttr('disabled');
				}
				if (data.html)
				{
					p.find('.x-delivery-method-html').html( data.html );
				}
				
            },
			error: function(xhr) {
				me.parents('.x-delivery-method').find('.x-delivery-method-cost').addClass('error').html( xhr.responseJSON.message );
			},
            complete: function () {                                
				me.html(_('Пересчитать'));
            }
        });			
	});

});

function sale_show_result_tooltip( elm, text ) {
	var tt = new Foundation.Tooltip(elm,{
		 clickOpen: false,
		 disableHover: true,
		 tipText: text
	});
	elm.foundation('show');
	setTimeout(function(){
		elm.foundation('hide');
		elm.foundation('destroy');
	}, 2000);	
}

function sale_order_get_available_payments( form ) {

	jQuery.ajax({
		url : '/plugins/sale/ajax.php?action=get_payment_methods',
		data: form.serializeArray(),
		dataType: 'json',
		method: 'post',
		success: function (data) {                                
			jQuery('.x-total').html(data.total);
			jQuery('.x-delivery-cost').html(data.delivery_cost);
			jQuery('.x-delivery-'+data.delivery_id+' .x-delivery-method-cost').html(data.delivery_cost);
			jQuery('.x-payment-method').addClass('hide');
			for (var i = 0; i  < data.payment.length; i++) 
			{
				jQuery(".x-payment-"+data.payment[i].id).removeClass('hide');
			}		
			jQuery('.x-delivery-method').addClass('hide');
			for (var i = 0; i  < data.delivery.length; i++) 
			{
				jQuery(".x-delivery-"+data.delivery[i].id).removeClass('hide');
			}
			if (data.total) {
				form.attr('data-payment-ok', 1);
			}
			else {
				form.attr('data-payment-ok', 0);
			}
			sale_order_check_form( form );
		}
	});		

}

function sale_order_check_form( form ) {
	
	form.find('.x-order-error').html('');
	
	valid = parseInt(form.attr('data-payment-ok')) > 0;
	
	form.find('input[required]').each(function(){
		
		if (
				(jQuery(this).prop('type') == 'checkbox' && !jQuery(this).prop('checked'))
				||
				(jQuery(this).prop('type') != 'checkbox' && !jQuery(this).val())
		   ) {
			form.find('.x-order-error').html('Заполните обязательные поля.');
			valid = false;
			return false;
		}
		
	});
	
	if (valid) {
		form.find('.x-order-confirm').removeAttr('disabled');
	}
	else {
		form.find('.x-order-confirm').attr('disabled', 1);
	}	
	
}

function sale_qd () {
	var qd = {};
	location.search.substr(1).split("&").forEach(function(item) {
		var s = item.split("="),
			k = s[0] && decodeURIComponent(s[0]),
			v = s[1] && decodeURIComponent(s[1]);
		qd[k] = v;

	});
	return qd;
}