$(document).ready(function(){
	$("select").dropdown();
	$('input').not('.default').iCheck({
		checkboxClass: 'check',
		radioClass: 'radio',
		increaseArea: '20%' // optional
	});
	$('.promo-list').bxSlider({
		mode: 'fade'
	});
	$(".nav-opener").click(function(e) {
		e.preventDefault();
		$('#header').toggleClass('nav-active');
	});
	initSly();
	function initSly(){
		if('sly' in $.fn){
			$('.scroll-frame').each(function(){
				var _this = $(this);
				var $frame = $('.v-scroll',this);
				var $wrap = $frame.parent();
				// Call Sly on frame
				$frame.sly({
					speed: 300,
					easing: 'easeOutExpo',
					pagesBar: $wrap.find('.pages'),
					activatePageOn: 'click',
					scrollBar: $wrap.find('.scrollbar'),
					scrollBy: 100,
					dragHandle: 1,
					dynamicHandle: 1,
					clickBar: 1,
					prevPage: $wrap.find('.prev'),
					nextPage: $wrap.find('.next')
				});
			});
		}
	};
});
