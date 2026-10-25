/* page navigation */

;(function($){
	$.fn.pageNavigation = function(_options){
		$.each(this, function(){
			var _container = $(this);
			var ubartH = ($('#userbar').length) ? $('#userbar').height() : 0;
			var bbartH = ($('#browsebar').length) ? $('#browsebar').height() : 0;
			var offsetY = getOffsetY();
			var opts = $.extend({},$.fn.pageNavigation.defaults, _options);
			if(_container.hasClass('page-progress-navigation')){
				opts.progress = true;
			}
			$(_container).find('a').each(function(index, element) {
				var _i = index;
				$(this).on('click', function(e){
					offsetY = getOffsetY();
					pageScroll($(this).attr('href'));
					e.preventDefault();
					return false;
				});
			});
			scrollEvent();
			//$(_container).find('li:first a').addClass('active');
			 active($(_container).find('li:first a'));
			function active(_elm){
				$(_elm).addClass('active').children().replaceWith(function() {
					return '<strong>'+ $(this).html() +'</strong>'
				});
				if(opts.progress) {
					$(_elm).parents('li').eq(0).nextAll().find('a').removeClass('active').children().replaceWith(function() {
						return '<span>'+ $(this).html() +'</span>'
					});
				} else {
					$(_elm).parents('li').eq(0).siblings().find('a').removeClass('active').children().replaceWith(function() {
						return '<span>'+ $(this).html() +'</span>'
					});
				}
			}
			//offsetY
			function getOffsetY(){
				var _offsetY = (bbartH + ubartH)*-1;
				$('.fixarea').each(function(index, element) {
					_offsetY -= $(this).outerHeight();
				});
				return _offsetY;
			}
			//scroll
			function pageScroll(_id){
				$.scrollTo(
					_id,
					{
						duration: 1000,
						easing: 'easeOutExpo',
						offset: { 'left':0, 'top':offsetY+1},
						onAfter : function(){}
					}
				);
			}
			function scrollEvent(){
				$(window).on('load',function(e){
					var pos = 0;
					var offY = 0;
					$(_container).find('a').first(0).addClass('bgactive');
					addActiveClass();
					$(window).on('scroll', function(e){
						addActiveClass();
					});
					function addActiveClass(){
						$(_container).find('a').each(function(index, element) {
							var _this = $(this);
							var _id = _this.attr('href');
							var _prevId = _this.parents('li').eq(0).prev().find('a').attr('href');
							//var _d =  (index > 0)? ($(_id).offset().top - $(_prevId).offset().top)/3 : 0;
							var _d =  (index > 0)? ($(window).height() + offsetY)/3.5 : 0;
							var _gap = (index > 0)?  $(window).scrollTop() -$(_id).offset().top -offsetY : 0;
							if(_gap + (_d) >= 0){
								active(_this);
							}							
							if(_gap >=0){
								_this.addClass('bgactive');
								_this.parents('li').eq(0).nextAll().find('a').removeClass('bgactive');
							}
						});
						if(opts.progress) bgpos();
					}
					function bgpos(){
						var last = _container.find('.bgactive').last();
						var lastId = last.attr('href');
						var next = last.parent().next().find('a');
						var nextId = next.attr('href');
						pos = last.position().left + last.outerWidth();
						var par = 0;
						if(last.parent().next().length){
							par = ($(window).scrollTop() - $(lastId).offset().top - offsetY)/($(nextId).offset().top - $(lastId).offset().top);
						}
						offY = Math.pow(par,5)*(last.parent().next().find('a').eq(0).outerWidth());
						_container.find('ul').eq(0).css({'background-position': -1000 + pos + Math.floor(Math.max(offY,0)) + 0 + 'px'});
					}
				});
			}
		});
	}
	$.fn.pageNavigation.defaults = {
		progress : false
	}
})(jQuery);

jQuery(function($){
	if($('#page').css('max-width')!='320px'){
		$('.page-progress-navigation').pageNavigation();
	}
});

// JavaScript Document