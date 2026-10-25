
;(function($){ 'use strict';
	//reviews
	var reviewsfunc = function(){
		$.reviewAverage();
		//Screen Name Comment Initial
		$('#ratings-userIdentifier, #ratings-text, #ratings-title').each(function(index, element) {
			$(this).val($(this).attr('data-placeholder'));
		});
		var inputRating = $('.reviews-write .input-rating .star');
		var inputRadio = $('.reviews-write .input-rating input[name="rating"]:radio');
		inputRatingImg();
		inputRating.each(function(index, element) {
			var text = $(element).find('label').text();
			$(this).click(function(e) {
				inputCheck(this);
				inputRadio.val([index+1]);
			});
			$(this).hover(
				function(e){
					$('body').append('<div id="review-tooltips">'+text+'</div>');
					$('#review-tooltips').css({'top':e.pageY+'px', 'left':e.pageX+'px'});
				},
				function(e){
					$('#review-tooltips').remove();
				}
			);
			$(this).mousemove(function(e){
				$('#review-tooltips').css({'top':e.pageY+'px', 'left':e.pageX+'px'});
			});
		});
		inputRadio.on('change', function(e){
			inputCheck(inputRating.eq($(this).val()-1));
		});
		function inputCheck(_element){
			$(_element).addClass('checked');
			$(_element).prevAll().addClass('checked');
			$(_element).nextAll().removeClass('checked');
			inputRatingImg();
		}
		function inputRatingImg(){
			inputRating.each(function(index, element){
				if($(this).hasClass('checked')){
					$(this).find('span > img, a > img').attr('src','etc/designs/panasonic/productpage-clientlibs/images/icn-rate-star-L-on.png');
				}else{
					$(this).find('span > img, a > img').attr('src','etc/designs/panasonic/productpage-clientlibs/images/icn-rate-star-L-off.png');
				}
			});
		}
		$('.reviews-write input[type=text],.reviews-write textarea').each(function(index, element) {
			var def = $(this).val();
			$(this).focus(function(e) {
				if($(this).val() === def){
					$(this).val('');
					$(this).closest('dd').removeClass('noinput');
				}
			});
			$(this).blur(function(e) {
				if($(this).val() === ''){
					$(this).val(def);
				}
			});
		});
		//submit
		$('.reviews-write .reviews-buttons').on('click', '.submit a', function(e){
			$('#ratings-form').submit();
		});
		//print
		/*$('.reviews_buttons .btn_print').on('click', 'a', function(e){
			var printThis = $('#modalwindow').html();
			var printStyle = ($('body').css('direction')!=='rtl') ? '<link rel="stylesheet" href="etc/designs/panasonic/productpage-libs.css" type="text/css"><link rel="stylesheet" href="etc/designs/panasonic/productpage-clientlibs/review/review-cq.css" type="text/css">' : '<link rel="stylesheet" href="etc/designs/panasonic/productpage-libs_arabic.css" type="text/css"><link rel="stylesheet" href="etc/designs/panasonic/productpage-clientlibs/review/review-cq_arabic.css" type="text/css">';
			var win = window.open();
			self.focus();
			win.document.open();
			win.document.write('<html><head>');
			win.document.write(printStyle);
			win.document.write('<style>');
			win.document.write('body * { margin:0; padding:0; list-style:none;}');
			win.document.write('</style>');
			win.document.write('</head><body class="reviews-all print">');
			win.document.write(printThis);
			win.document.write('<script>');
			win.document.write('window.addEventListener(\'load\', function(){ window.print(); window.close(); });');
			win.document.write('</script>');
			win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
			win.document.close();
		});*/
		
		//transplant 2016.0518
		function validateSubmitWrapperratingsform(id) {
			var form = document.getElementById('ratings-form');
			if (!form){
				return false;
			}
			if (document.getElementById(id + "-id")){
				return true;
			}
			var check = document.createElement("input");
			check.id = id + "-id";
			check.type = "hidden";
			check.name = "id";
			check.value = "nobot";
			form.appendChild(check);
			return true;
		}
		addReviewSubmit();
		function validateUserreview() {
			var valid = $(':radio[name="rating"]', '#ratings-form').is(':checked');
			validateSubmitWrapperratingsform('ratings');
			if (!valid) {
				$('.input-rating span.error').css('display','inline-block');
			}
			$('#ratings-userIdentifier,#ratings-text,#ratings-title').each(function() {
				var inStr = $(this);
				if (inStr.val() === '' || inStr.prop('defaultValue') === inStr.val()) {
					inStr.closest('dl').find('span.error').css('display','inline-block');
					inStr.closest('dd').addClass('noinput');
					valid = false;
				}
			});
			return valid;
		}
		function intiUserreviewform() {
			$('.reviews-write span.error').hide();
		}
		function confirmReview(){
			$('.reviews-confirm').each(function(index, element) {
				var cf_rating = $(':radio[name="rating"]:checked').val();
				var cf_title = $('#ratings-title').val();
				var cf_text = $('<div />').text($('#ratings-text').val()).html();
				cf_text = cf_text.replace(/\r\n/g, '\n');
				cf_text = cf_text.replace(/\r/g, '\n');
				var cf_text_rep = cf_text.split('\n').join('<br>');
				var cf_name = $('#ratings-userIdentifier').val();
				$(this).find('.reviews-text').empty();
				$(this).find('.reviews-reviewer').empty();
				$(this).find('.reviews-rate .alt').html(cf_rating + ' / 5');
				$(this).find('.reviews-rate .star').each(function(i, elem) {
					if(i < cf_rating){
						$(this).children('span').css('width','100%');
					} else {
						$(this).children('span').css('width','0%');
					}
				});
				$(this).find('.reviews-text').append($('<p class="subheader2">').text(cf_title));
				$(this).find('.reviews-text').append($('<p class="bodycopy1">').append(cf_text_rep));
				$(this).find('.reviews-reviewer').append($('<p class=" bodycopy1">').append($('<span class="name">').text(cf_name)));
			});
			$('.reviews-confirm .reviews-buttons .back > a').on('click', function(e){
				$('#ratings-form').removeClass('confirm');
				intiUserreviewform();
			});
		}
		function addReviewSubmit() {
			intiUserreviewform();
			var sendSubmitting = false;
			var changeSendState = function(isSending) {
				if (isSending) {
					sendSubmitting = true;
					$('.reviews-write .reviews-buttons .submit a').css('opacity', '0.5');
				} else {
					sendSubmitting = false;
					$('.reviews-write .reviews-buttons .submit a').css('opacity', '');
				}
			};
			
			var frm = $('#ratings-form');
			frm.submit(function (ev) {
				if (sendSubmitting) {return false;}
				changeSendState(true);
				intiUserreviewform();
				if (validateUserreview()) {
					if(!frm.hasClass('confirm') && $('.reviews-confirm').length){
						confirmReview();
						frm.addClass('confirm');
						changeSendState(false);
					}else{
						$.ajax({
							cache: false,
							type: frm.attr('method'),
							url: frm.attr('action'),
							data: frm.serialize()
						}).done(function() {
							$('.reviews-write').hide();
							$('.reviews-thankyou').show();
						}).fail(function() {
							$('.reviews-write .reviews-buttons .error').show().css('display','block');
						}).always(function() {
							changeSendState(false);
						});
					}
	
				} else {
					changeSendState(false);
				}
				ev.preventDefault();
			});
		}
	};

	var seeAllreviews = function(){
		var id = $('.specs-data-block').parents('.pagesection').eq(0).attr('id');
		$('.reviews-block a.modalwin, .reviews-block .review-readmore.modalwin, #hero-main .reviews-rate a.modalwin').click(function(e) {
			e.preventDefault();
			var data = $(this).attr('href');
			var _class = $(this).data('addclass');
			$.productpage_modalwindow(data,'reviews-all '+_class,reviewsfunc,$(this).data('close-alt'));
			focusedElementBeforeModal = jQuery(':focus');
		});
	};
	
	$(function(){
		seeAllreviews();
		if($('.reviews-all').length){
			reviewsfunc();
		}
	});
})(jQuery);
