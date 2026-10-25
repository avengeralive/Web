(function($, root) {
	if (!$.fn.lazyload) {
		return;
	}
	$(function() {
		var options = {};
		if (!!$.lazyloadOptions) {
			if (isMobile() ) {
				$.extend(options, {
					threshold: $.lazyloadOptions.threshold_mobile,
					event: $.lazyloadOptions.event_mobile,
					effect: $.lazyloadOptions.effect_mobile,
					effect_speed: $.lazyloadOptions.effectspeed_mobile
				});
			} else {
				$.extend(options, {
					threshold: $.lazyloadOptions.threshold,
					event: $.lazyloadOptions.event,
					effect: $.lazyloadOptions.effect,
					effect_speed: $.lazyloadOptions.effectspeed
				});
			}
		}
		$(window).on('load', function() {
			// lazy load
			$('img.lazy').each(function() {
				$(this).lazyload($.extend(options, {
					data_attribute: 'src',
					container: (0 === options.event.indexOf("scroll")) ? window : this,
					appear: function() {
						var $targetImg = $(this);
						if ($targetImg.is('[data-type="img-conv"]')) {
							if (!$targetImg.data('ic-state')) {
								$targetImg.imageConverter({
									targetAttr: 'data-src'
								});
							} else {
								$targetImg.attr('data-src', $targetImg.attr('src'));
							}
						}
						if ($targetImg.closest('.accessories-block').size() > 0) {
							$('img.lazy', $targetImg.closest('.accessories-block')).trigger('appear');
						}
					},
					load: function() {
						var $targetImg = $(this);
						var $slider = $targetImg.closest('.slider');
						if ($slider.size() > 0 && $slider.closest('.slider-wrapper').is(':visible')) {
							if(navigator.userAgent.match(/Android/i)){
								setTimeout(function() {
									$slider.trigger('configuration', ['width', '100%']).trigger("updateSizes");
								}, 100);
							} else if ($targetImg.data('ic-state') === 'loading') {
								$targetImg.one('imageconverted.gwc',function() {
									$slider.trigger('configuration', ['width', '100%']).trigger("updateSizes");
								});
							} else {
								$slider.trigger('configuration', ['width', '100%']).trigger("updateSizes");
							}
						}
						if ($targetImg.closest('.demo-visual-btn').size() > 0) {
							$targetImg.data({
								src_on: $targetImg.attr('src').replace(/\-white/, '-dblue'),
								src_off: $targetImg.attr('src')
							});
							var onImg = new Image();
							onImg.src = $targetImg.data('src_on');
						}
						$(document).trigger('loaded-lazy.gwc');
					}
				}));
			});
			$(document).on('appear_container.gwc', function(event) {
				$.each($.makeArray(arguments).slice(1), function() {
					$('img.lazy', this).trigger('appear');
				});
			});
			$('.slider').on('slideScrollAfter.gwc', function() {
				// load current visible slide image, prev slide image and next slide image.
				$('img.lazy', this).trigger('appear');
			});
		});
	});
})(jQuery, this);
