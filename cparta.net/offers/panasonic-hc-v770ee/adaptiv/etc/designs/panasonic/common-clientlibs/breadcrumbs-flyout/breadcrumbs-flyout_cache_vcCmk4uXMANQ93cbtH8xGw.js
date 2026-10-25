// JavaScript Document
;
jQuery(function($){
	/*$('.breadcrumbs-flyout').find('.flyout > p > a').on('tap click', function(e){
		if($(this).closest('.flyout').hasClass('active')){
			$(this).closest('.flyout').removeClass('active');
		}else{
			$(this).closest('.flyout').addClass('active');
		}
	});*/
	$('.breadcrumbs-flyout').find('.flyout').attr('tabindex','0').find('p > a').attr('tabindex','-1');
	if($('html').hasClass('touch-device')){
		$('.breadcrumbs-flyout').find('.flyout > p > a').on('tap click', function(e){
			if($(this).closest('.flyout').hasClass('active')){
				$(this).closest('.flyout').removeClass('active');
			}else{
				$(this).closest('.flyout').addClass('active');
			}
		});
	}else{
		$('.breadcrumbs-flyout').find('.flyout').on({
			'mouseenter focus' : function(e){
				$(this).addClass('active');
			},
			'mouseleave' : function(e){
				$(this).removeClass('active');
			}
		}).find('p > a').on('click', function(e){
			e.preventDefault();
		});
		$('body').on('keyup', function(e){
			if(!$('.breadcrumbs-flyout').find('.flyout').is(':focus') && $('.breadcrumbs-flyout').find('.flyout').find(':focus').length === 0){
				$('.breadcrumbs-flyout').find('.flyout').removeClass('active');
			}
		})
	}
});