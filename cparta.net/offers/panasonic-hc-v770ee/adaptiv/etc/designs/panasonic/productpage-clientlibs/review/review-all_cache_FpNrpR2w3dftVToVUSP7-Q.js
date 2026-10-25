
;(function($){ 'use strict';
	//reviews
	$.reviewAverage = function(){
		if($('#page').css('min-width')!=='320px' && !$('html').hasClass('touch-device')){
			$('.reviews-rate').each(function(index, element) {
				$(this).find('a').hover(
					function(e){
						var text = $(element).find('.alt').text();
						$('body').append('<div id="review-tooltips">'+text+'</div>');
						$('#review-tooltips').css({'top':e.pageY+'px', 'left':e.pageX+'px'});
					},
					function(e){
						$('#review-tooltips').remove();
					}
				).on('click',function(e){
					if($(this).attr('href').match(/javascript*|#/)){
						e.preventDefault();
					}
				});
				$(this).find('a').mousemove(function(e){
					$('#review-tooltips').css({'top':e.pageY+'px', 'left':e.pageX+'px'});
				});
			});
		}
	};
	$.fn.reviewSlider = function(){
		this.each(function(index, element) {
			var $this = $(this);
			if($('#page').css('min-width')!=='320px'){
				$this.closest('.reviews-slider-wrapper').height(0);
				$this.carouFredSel({
					circular : false,
					infinite : false,
					height : 'auto',
					align : 'left',
					onCreate : function(data){
						$this.closest('.reviews-slider-wrapper').css('height','');
					},
					items : {
						visible : 1,
					},
					scroll : {
						//items : 2,
						fx : 'fade',
						// add start
						onAfter: function(data) {
							$(document).trigger('appear_container.gwc', data.items.visible);
						},
						// add end
					},
					direction : ' up ',
					auto : {
						play : false
					},
					pagination : {
						container : $this.closest('.reviews-slider-wrapper').find('.paginator'),
						anchorBuilder : function(nr){
							return '<a href="#'+nr+'"><span>'+nr+'</span></a>';
						}
					}
				});
				$(window).on('load', function(){
					$this.trigger('configuration',{width:'100%'}).trigger('updateSizes');
				});
			} else {
				$this.find('.slide-block').filter(function(index) {
					if(index >= 6){
						$(this).hide();
					}
				});
				if($this.find('.slide-block').length <= 6){
					$this.closest('.reviews-expert').find('.seeall').hide();
				}
				$(window).on('load resize', function(e){
					var $wrapper = $this.closest('.reviews-slider-wrapper');
					$wrapper.height($this.height()).delay(100).queue(function(){
						$(this).addClass('loaded');
					});
				});
				// add start
				$(document).on('loaded-lazy.gwc', function(){
					var $wrapper = $this.closest('.reviews-slider-wrapper');
					$wrapper.css('height',$this.height());
				});
				// add end
				$this.closest('.reviews-expert').find('.seeall').on('click', 'a', function(e){
					e.preventDefault();
					var $wrapper = $this.closest('.reviews-slider-wrapper');
					var hidetems =  $this.find('.slide-block[style*=none]');
					//$wrapper.height($this.height());
					hidetems.filter(function(index) {
						if(index < 6){ return this; }
					}).show()/*.css('opacity',0)*/.each(function(){
						// add start
						$(document).trigger('appear_container.gwc', this);
						// add end
					});
					$wrapper.css('height',$this.height());
					/*$wrapper.on('transitionend', this, function(e){
						$wrapper.css('height','');
					});*/
					/*hidetems.filter(function(index) {
						if(index < 6){ return this; }
					}).css('opacity',1);*/
					if(!$this.find('.slide-block[style*=none]').length){
						$(this).css('visibility','hidden');
					}
				 });
			}
		});
	};
	$(function(){
		$.reviewAverage();
		$('.reviews-slider').reviewSlider();
	});
})(jQuery);