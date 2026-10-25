(function($) {
$.fn.extend({
	placeholder: function(options) {
		
		var settings = $.extend( {
			'all' : false,
			'classWrap': 'wrap-element',
			'classPlaceholder': 'wrap-element__placeholder',
			'styleWrap': 'position:relative;display:inline-block;',
			'styleWrapAdd': {},
			'stylePlaceholder': 'position:absolute;cursor:text;',
			'stylePlaceholderAdd': {},
			'speed' : 200
		}, options);
		
		var items = this;
		var placeholder_support = !!('placeholder' in document.createElement('input'));
		
		if (settings.all) {
			placeholder_support = false;
		}		
		
		if ( ! placeholder_support) {
			items.each(function(){
				var item = $(this);
				var tag  = $(this).context.nodeName.toLowerCase();
				var attr = item.attr('placeholder');
				item.attr('placeholder','');
				
				function getNumber(str) {
					var num = parseInt(str);
					
					if (isNaN(num)) {
						return 0;
					} else {
						return num;
					}
				}
				
				if (attr) {
					item.wrap('<span style="'+settings.styleWrap+'" class="'+settings.classWrap+'"></span>');
					item.parent('span').append('<span style="'+settings.stylePlaceholder+'" class="'+settings.classPlaceholder+'"></span>');
					var itemNext = item.next();
					itemNext.text(attr);
										
					itemNext.css('top', getNumber(item.css('margin-top')) + 'px');
					itemNext.css('left', getNumber(item.css('margin-left')) + 'px');
					itemNext.css('right', getNumber(item.css('margin-right')) + 'px');
					itemNext.css('bottom', getNumber(item.css('margin-bottom')) + 'px');					

					if (tag == 'input') {						
						itemNext.css('padding-top', item.css('padding-top'));
						itemNext.css('line-height',
							(
								getNumber(item.css('height')) +
								getNumber(item.css('border-top-width')) +
								getNumber(item.css('border-bottom-width'))
							) + 'px'
						);					
					}
					
					if (tag == 'textarea') {
						item.css('display','block');
						itemNext.css('padding-top',
							(
								getNumber(item.css('padding-top')) +
								getNumber(item.css('border-top-width'))
							) + 'px'
						);
					}
					
					itemNext.css('padding-left',
						(
							getNumber(item.css('padding-left')) +
							getNumber(item.css('border-left-width'))
						) + 'px'
					);
					
					itemNext.css('padding-right', item.css('padding-right'));
					itemNext.css('padding-bottom', item.css('padding-bottom'));
					itemNext.css('color', item.css('color'));
					itemNext.css('font-family', item.css('font-family'));
					itemNext.css('font-size', item.css('font-size'));
					itemNext.css('text-align', item.css('text-align'));
					
					if (settings.stylePlaceholderAdd) {
						itemNext.css(settings.stylePlaceholderAdd);
					}
					if (settings.styleWrapAdd) {
						itemNext.parent().css(settings.styleWrapAdd);
					}
				}			
			});
			
			function showAllPlaceholder() {
				$('.'+settings.classWrap).children('input,textarea')
				.filter(function(){return this.value == "";})
				.next().fadeIn(settings.speed);				
			}
			
			$('.'+settings.classWrap).children('input,textarea').focus(function(){
				showAllPlaceholder();
				$(this).next().stop();
				$(this).next().fadeOut(settings.speed);				
			});
			
			$('.'+settings.classPlaceholder).click(function(){
				showAllPlaceholder();
				$(this).stop();
				$(this).fadeOut(settings.speed);
				$(this).prev().focus();
			});
			
			$('*').click(function(e){				
				if($(e.target).closest('.'+settings.classWrap).length == 0) {
					showAllPlaceholder();
				}
			});

			return items.each(function(){});
		}
	}
});
})(jQuery);

$(document).ready(function(){
	$('input[placeholder], textarea[placeholder]').placeholder({speed:0});
});