// product-box-adjust

;(function($){
	'use strict';
	$.fn.productboxHAdjst = function(targetClass, box , children){
		if(targetClass === 'undefined'){
			targetClass = '.product-box';
		}
		if(box === 'undefined'){
			targetClass = '.product-box-in';
		}
		if(children === 'undefinded'){
			children=['.product-box-in .product-price', '.product-box-in .product-copy', '.product-box-in > a, .product-box-in > div:first-child'];
		}
		if(!this.length) {return this;}
		if(this.length > 1){
			$.each(this, function(){
				$(this).productboxHAdjst(targetClass, box , children);
			});
			return this;
		}
		var _self = this;
		var _h = 0;
		var setitemArr = [];
		var restitems;
		var $productbox = $(_self).find(targetClass);
		if(!$productbox.length) {
			$(this).trigger('adjusted');
			return this;
		}
		if(typeof children === 'object'){
			$.each(children, function(index, val){
				setitemArr.push($productbox.find(val));
				if(targetClass !== box){
					restitems = children.join(',') + ',' + box;
				} else {
					restitems = children.join(',');
				}
				
			});
		} else if(typeof children === 'string'){
			setitemArr.push($productbox.find(children));
			if(targetClass !== box){
				restitems = children + ',' + box;
			} else {
				restitems = children;
			}
		}
		$productbox.find(restitems).css('height','');
		$.each(setitemArr, function(i, selector) {
			var $productBoxInElem = $(selector);
			var maxHeight = Math.max.apply(null,
				$.makeArray($productBoxInElem.map(function() { return $(this).height(); }))
			);
			$productBoxInElem.height(maxHeight);
		});
		if(targetClass !== box){
			$productbox.find(box).each(function() {
				_h = Math.max($(this).height(), _h);
			}).height(_h);
		}
		$(this).trigger('adjusted');
		return this;
	};
})(jQuery);

//modalwindow
;(function($){
	$.productpage_modalwindow = function(_data, _class, callback, closealt){
		var _anchor = false;
		var _fixpartH;
		var _closealt = (closealt) ? closealt : 'Close';
		overlayset();
		$('#lightbox-overlay').append('<div id="modalwindow-wrapper"><div id="modalwindow-bg"><a href="#" class="btn-close"><img src="etc/designs/panasonic/common-clientlibs/images/btn-lightbox-close.png" alt="'+_closealt+'"></a><div id="modalwindow" class="'+_class+'"></div></div></div>');
		allSepecsContent('#modalwindow',_data,callback);
		$('#modalwindow').one('scrollto', function(e){
			if(_anchor){
				var posY = $(_anchor).position().top;
				if($(this).find('.spech_lightbox').hasClass('jspScrollable')){
					$(this).find('.spech_lightbox').data('jsp').scrollToY(posY);
				} else {
					$(this).find('.spech_lightbox').scrollTop(posY);
				}
			}
		});
		function setupLightboxContainer(){
			$(window).bind('resize',function(e){
				sizeSetting('#modalwindow-wrapper');
			});
			$('#lightbox-overlay').fadeIn({
				start : function(){
					_fixpartH = $('#modalwindow').height() - $('#modalwindow').find('.spech_lightbox').height();
					sizeSetting('#modalwindow-wrapper');
				},
				complete : function(){
					setInitialFocusModal($(this));
					$(this).keydown(function(event){trapTabKey($(this),event);});
				}
			});
			$('#modalwindow-wrapper .btn-close').click(function(e) {
				$('#lightbox-overlay').fadeOut(function(){
					overlayRemove();
					focusedElementBeforeModal.focus();
				});
				return false;
			});
		}
		function sizeSetting(_box){
			var _wh = window.innerHeight ? window.innerHeight : $(window).height();
			var _ww = $('body').width();
			var _wSctop = $(window).scrollTop();
			var _fH = parseInt($('#modalwindow').css('padding-top')) + parseInt($('#modalwindow').css('padding-bottom')) + parseInt($('#modalwindow-bg').css('margin-top')) + parseInt($('#modalwindow-bg').css('margin-bottom')) + _fixpartH;
			if($('#page').css('min-width') !== '320px'){
				$(_box).css({'left':_ww/2-$(_box).width()/2 +'px', 'height':_wh-100+'px', 'top':_wSctop+50+'px'});
				$(_box).find('.spech_lightbox').css({'height':$(_box).height() - _fH +'px', 'width':$(_box).find('.spech_box').width() + 'px'});
				if(!$('html').hasClass('touch-device') && _class !== 'reviews-all typeBV'){
					$(_box).find('.spech_lightbox').jScrollPane({mouseWheelSpeed : 20, autoReinitialise:true, contentWidth:940});
				}
			}else{
				$(_box).css({'height':_wh+'px', 'top':_wSctop + 'px'});
				$(_box).find('.spech_lightbox').css({'height':$(_box).height() - _fH +'px'});
				if(navigator.userAgent.indexOf("Android 2") !== -1){
					$(_box).addClass('android2');
					$(_box).find('.spech_lightbox').jScrollPane();
				}
			}
			$('#modalwindow').trigger('scrollto');
		}
		function allSepecsContent(_id,_data,callback){
			if(_class !== 'specs-all'){
				var _url;
				var _hasAnc = (_data.match(/(.*)(#.*)/));
				if(_hasAnc){					
					_url = _hasAnc[1];
					_anchor = _hasAnc[2];
				} else {
					_url = _data;
				}
				$(_id).load(_url+' section', function(responseText, statusText, xhr){
					setupLightboxContainer();
					if (callback) {
						callback();
					}
				});
			}else{
				$.ajax({
					url:_data,
					//dataType:"html",
					success: function(data, status, xhr){
						var html = String(data);
						$(html).append(data);
						$(_id).html(data);
						setupLightboxContainer();
					}
				});
			}
		}
	};
})(jQuery);

var specallhtmlLoc;
jQuery(function($){
	//slider
	var initializeTitlesPagerSlider = function(carousel, countSlides, container) {
		var titlesbox = $(container).find('.titles-paginator');
		var prevCont = $(carousel).children().eq((countSlides-1));
		var nextCont = $(carousel).children().eq((1));

		var prevTitle = container.hasClass('features-slider')?prevCont.find('.slide-block').attr("title"):prevCont.attr("title");
		var nextTitle = container.hasClass('features-slider')?nextCont.find('.slide-block').attr("title"):nextCont.attr("title");
		if(prevTitle){
			if(!titlesbox.find('.first-child p').length) titlesbox.find('.first-child').append('<p class="prev_feature_title" />');
			titlesbox.find('.first-child p').text(prevTitle);
		}
		if(nextTitle){
			if(!titlesbox.find('.last-child p').length) titlesbox.find('.last-child').prepend('<p class="next_feature_title" />');
			titlesbox.find('.last-child p').text(nextTitle);
		}
	}
	var slider = function(_target){
		var carousel = $(_target);  
		var children =  carousel.children();
		var container = carousel.parent();
		var hasThumbnailPaginator = container.find('.titles-paginator').hasClass('thumbnails');

		var width = container.width();
		var height = (carousel.closest('.categorylearn-contents').length) ? 'auto' : null;
		var countSlides = children.size();
		var onAfterScrollFunction = function(direction){}
		if (carousel.attr('width-value') != null) {
			width = carousel.attr('width-value');
		}
		var dotname;
		if($(container).parents('#overview-gallery').length){
			dotname = 'icn-slideshow-dot-grey';
		}else{
			dotname = 'icn-slideshow-dot';
		}
		
		// Check if the pager has titles
		if (container.find('.titles-paginator .first-child').length > 0) {
			initializeTitlesPagerSlider(carousel, countSlides, container);
		}
		carousel.productboxHAdjst('.product-box', '.product-box-in', ['.product-box-in > a, .product-box-in > div:first-child']);
		carousel.carouFredSel({
			scroll: { 
				//items: items, 
				//fx: carousel.attr('efect'), 
				onAfter: function(data) {
					// Check if the pager has titles
					if (container.find('.titles-paginator .first-child').length > 0) {
						initializeTitlesPagerSlider(carousel, countSlides, container);
					}
					changeColor(carousel,container);
					insertDots(container);
					focus2Thumbnail(container, data);
					carousel.trigger('slideScrollAfter.gwc');
				},
				onBefore: function(){
					YouTubeUtils.stopYoutubeVideos();
				}
			},
			width: '100%',
			height: height,
			responsive: true,
			//items: { visible: { min: parseInt(carousel.attr('min')), max: parseInt(carousel.attr('max')) } },
			onCreate : function(data){
				if(container.find('.titles-paginator').hasClass('thumbnails')){
					container.find('.paginator').wrap('<div class="paginator-thumb-control"><div class="paginator-wrapper"></div></div>');
					container.find('.paginator-thumb-control').prepend('<a href="javascript:void(0);" class="paginator-thumb-prev"><img src="etc/designs/panasonic/common-clientlibs/images/icn-arrow-black-left.png" alt="Previous"></a>');
					container.find('.paginator-thumb-control').append('<a href="javascript:void(0);" class="paginator-thumb-next"><img src="etc/designs/panasonic/common-clientlibs/images/icn-arrow-black-right.png" alt="Next"></a>');
				}
				changeColor(carousel,container);
				if($('#page').css('min-width')=='320px'){
					holderSize(carousel).always(function() {
						updateSliderSizes(carousel);
					});
					$(window).on('resize',function(){
						updateSliderSizes(carousel);
						carousel.productboxHAdjst('.product-box', '.product-box-in', ['.product-box-in > a, .product-box-in > div:first-child']);
						updateSliderSizes(carousel);
					});
				}
				if(carousel.find('img').length){
					$(window).on('load',function(){
						carousel.trigger('configuration', ['width', '100%']).trigger('updateSizes');
					});
				}
			},
			pagination: {
				container: hasThumbnailPaginator ? null : container.find('.paginator'),
				//keys: true,
				anchorBuilder   : function(nr) {
					if(hasThumbnailPaginator){
/*
						var src = $(children).eq(nr-1).attr('data-thumb');
						var type = $(children).eq(nr-1).attr('data-type');
						var alt = $(children).eq(nr-1).attr('data-thumb-alt') || '';
						var title = $(children).eq(nr-1).attr('data-thumb-title') || '';
*/
						/*var videoIcn = (type == 'video')? '<span class="icn-video"></span>' : '';
						if(navigator.userAgent.match(/MSIE/) && $('html').hasClass('csstransitions')){
							return '<a href="#" class="thumb"><img src="' + src + '" width="75" height="42" alt="" class="ie10"><svg xmlns="http://www.w3.org/2000/svg" id="svgroot' + nr + '" width="75" height="42">'+
							'<defs>'+
							'<filter id="filtersPicture' + nr + '">'+
							'<feComposite result="inputTo_38" in="SourceGraphic" in2="SourceGraphic" operator="arithmetic" k1="0" k2="1" k3="0" k4="0" />'+
							'<feColorMatrix id="filter_38" type="saturate" values="0" data-filterid="38" />'+
							'</filter>'+
							'</defs>'+
							'<image filter="url(#filtersPicture' + nr + ')" x="0" y="0"  width="75" height="42" xlink:href="' + src + '" />'+
							'</svg>'+ videoIcn +'</a>'
						}else{
							return '<a href="#" class="thumb"><img src="' + src + '" width="75" height="42" alt="">'+ videoIcn +'</a>';
						}*/
/*
						if(type == 'video'){
            				return '<a href="#" class="thumb"><img src="' + src + '" width="75" height="42" alt="'+alt+'" title="'+title+'" oncontextmenu="return false" onDragStart="return false"><span class="icn-video"></span></a>';
						}else{
							return '<a href="#" class="thumb"><img src="' + src + '" width="75" height="42" alt="'+alt+'" title="'+title+'" oncontextmenu="return false" onDragStart="return false"></a>';
						}
*/
					}else{
						var currPos = carousel.triggerHandler('currentPosition');
						if(currPos !== undefined ? (currPos + 1 == nr) : nr==1){
							return '<span><a href="#" class="dots"><span><img src="etc/designs/panasonic/common-clientlibs/images/'+dotname+'-on.png" alt="'+nr+'"></span></a>'+'<span class="paginator-mob"><span class="now">'+nr+'</span>/'+countSlides+'</span></span>'
						}else{
							return '<span><a href="#" class="dots"><span><img src="etc/designs/panasonic/common-clientlibs/images/'+dotname+'-off.png" alt="'+nr+'"></span></a>'+'<span class="paginator-mob"><span class="now">'+nr+'</span>/'+countSlides+'</span></span>'
						}
					}
				}
			},
			prev: container.find('.prev').parent(),
			next: container.find('.next').parent(),
			auto: false,
			infinite: !hasThumbnailPaginator,
			circular: !hasThumbnailPaginator,
			swipe : {
				onMouse : false,
				onTouch : false
			}
		});
		// for Thumbnail Paginator
		if(hasThumbnailPaginator) {
			var loadedThumbImageCount = 0;
			var paginator = container.find('.titles-paginator .paginator');
			children.each(function() {
				var $targetSlideBlock = $(this);
				var order = $targetSlideBlock.attr('order');
				var src = $targetSlideBlock.attr('data-thumb');
				var type = $targetSlideBlock.attr('data-type');
				var alt = $targetSlideBlock.attr('data-thumb-alt');
				var title = $targetSlideBlock.attr('data-thumb-title');

				var $img = $('<img width="75" height="42" alt="">');

				var $thumbsLink = $('<a href="#" order="' + order + '"></a>').addClass('thumb');
				if (order == carousel.triggerHandler('currentVisible').attr('order')) {
					$thumbsLink.addClass('selected');
				}
				$thumbsLink.on('click', function(e) {
					e.preventDefault();
					carousel.triggerHandler('slideTo', $targetSlideBlock);
					paginator.children().removeClass('selected');
					$(this).addClass('selected');
				});
				$thumbsLink.append($img);
				if (type == 'video') {
					$thumbsLink.append('<span class="icn-video"></span>');
				}
				paginator.append($thumbsLink);
				$img.attr({'src': src, 'alt': alt, 'title': title}).on('contextmenu dragstart', function() {return false;});
			});

			if (!isMobile()) {
				paginator.carouFredSel({
					auto	: false,
					items   : Math.min(9, children.size()),
					prev	: {
						button	: container.find('.paginator-thumb-control .paginator-thumb-prev')
					},
					next	: {
						button	: container.find('.paginator-thumb-control .paginator-thumb-next')
					},
					infinite: false,
					circular: false,
					swipe   : {
						onTouch : true,
						onMouse : true
					}
				},{
					wrapper: 'parent'
				});
			}
		}
		function changeColor(_carousel,_container){
			if($(_container).hasClass('features-slider')){
				if($(_carousel).children().children('.slide-block').eq(0).hasClass('style-dark')){
					$(_container).find('.titles-paginator').addClass('style-dark');
					$(_container).find('.titles-paginator .first-child a').removeClass('btn-black').addClass('btn-grey');
					$(_container).find('.titles-paginator .last-child a').removeClass('btn-black').addClass('btn-grey');
					if($(_container).closest('.feature-no-tab').length){
						$(_container).find('.titles-paginator .first-child a img').attr('src','etc/designs/panasonic/common-clientlibs/images/btn-arrow-ft-white-left.png');
						$(_container).find('.titles-paginator .last-child a img').attr('src','etc/designs/panasonic/common-clientlibs/images/btn-arrow-ft-white-right.png');
					}else{
						$(_container).find('.titles-paginator .first-child a img').attr('src','etc/designs/panasonic/common-clientlibs/images/btn-arrow-grey-left.png');
						$(_container).find('.titles-paginator .last-child a img').attr('src','etc/designs/panasonic/common-clientlibs/images/btn-arrow-grey-right.png');
					}
					dotname = 'icn-slideshow-dot-grey';
				}else{
					$(_container).find('.titles-paginator').removeClass('style-dark');
					$(_container).find('.titles-paginator .first-child a').removeClass('btn-grey').addClass('btn-black');
					$(_container).find('.titles-paginator .last-child a').removeClass('btn-grey').addClass('btn-black');
					if($(_container).closest('.feature-no-tab').length){
						$(_container).find('.titles-paginator .first-child a img').attr('src','etc/designs/panasonic/common-clientlibs/images/btn-arrow-ft-black-left.png');
						$(_container).find('.titles-paginator .last-child a img').attr('src','etc/designs/panasonic/common-clientlibs/images/btn-arrow-ft-black-right.png');
					}else{
						$(_container).find('.titles-paginator .first-child a img').attr('src','etc/designs/panasonic/common-clientlibs/images/btn-arrow-black-left.png');
						$(_container).find('.titles-paginator .last-child a img').attr('src','etc/designs/panasonic/common-clientlibs/images/btn-arrow-black-right.png');
					}
					dotname = 'icn-slideshow-dot';
				}
			}
		}
		function insertDots(_container){
			$(_container).find('.titles-paginator .dots').each(function(index, element) {
				if($(this).parent().hasClass('selected')){
					$(this).find('img').attr('src','etc/designs/panasonic/common-clientlibs/images/'+dotname+'-on.png');
				}else{
					$(this).find('img').attr('src','etc/designs/panasonic/common-clientlibs/images/'+dotname+'-off.png');
				}
			});
		}
	}
	
	//modalwindow

	
	//Overview
	var seemore = function(){
		$('#seemore-overlay').css({'display':'none','visibility':'visible'});
		$('#seemore').click(function(e) {
			$(window).scrollTop(0);
			overlayset('nonfix');
			focusedElementBeforeModal = jQuery(':focus');
			
			$('#lightbox-overlay').fadeIn(function(){
				$('#seemore-overlay').fadeIn(function(){
					setInitialFocusModal($(this));
					$(this).keydown(function(event){trapTabKey($(this),event);});
					updateSliderSizes($('.slider', this));

					load360ImagesAsNeed($('#overview-360').find('.view_container360'));
					if($('#overview-360').find('.view_container360').is(':visible')){
						r360();
					}

					holderSize($('#overview-tour', this)).always(function() {
						$('#overview-tour .youtube-placeholder.youku-player').switchVisibleYkuPlayer();
					});
					if(!!$('#overview-hmx-in').size() && !$.trim($('#overview-hmx-in').html())) {
						$('#overview-hmx-in').html($('#overview-hmx-template').html());
					}
					$(document).trigger('appear_container.gwc', this);
				});
			});
			$('#seemore-overlay .btn-close, #lightbox-bgcolor').click(function(e) {
				$('#lightbox-overlay').fadeOut(function(){overlayRemove()});
				$('#seemore-overlay').fadeOut(function(){
						$('#overview-tour .youtube-placeholder.youku-player').switchVisibleYkuPlayer(false);
					}
				);
				YouTubeUtils.stopYoutubeVideos();
				focusedElementBeforeModal.focus();
			});
		});
		if($('#seemore-content .tabs-menu ul li').length==1){
			$('#seemore-content .tabs-menu ul li').css('border','none');
		}
	}
	
	var r360 = function(){
		function mobsize(){
			$('#overview-360-in').css('width','100%');
			var _w = $('body').width();
			$('#overview-360 .view_container360').css('height',_w/2+'px');
			$('#overview-360 .image_hor').css('height',_w/2+'px');
		}
		if($('#page').css('min-width')=='320px'){
			mobsize();
		}
		var image_hor = $('#overview-360 .image_hor');
		var horLen = image_hor.find('img').length;
		var horUnit = Math.floor(360/horLen);
		var imgH = image_hor.parent().height();
		var bottom_slider = $('#overview-360 .bottom-slider');
		$(window).bind('resize',function(e){
			imgH = image_hor.parent().height();
		});
		var angleScroll = bottom_slider.find('.angle_scroll');
		angleScroll.not('.ui-slider').slider({
			min: 0,
			max: 360,
			value: 180,
			step:horUnit,
			create: function(event, ui){
				updateSlider($(this).slider('value'));
				$(this).find('a').append('<img src="etc/designs/panasonic/productpage-clientlibs/images/img-scrollbar-hor-slider.png" alt="slider">');
			},
			slide: function( event, ui ) {
				updateSlider(ui.value);
			},
			change: function( event, ui ) {
				updateSlider(ui.value);
			}
		});
		updateSlider(angleScroll.slider('value'));
		function updateSlider(_value){
			var value = _value;
			var imageselected = Math.ceil(horLen/(360/value) + horLen - 1) % horLen;
			bottom_slider.find('.grados').html( value+'&deg;');
			image_hor.css('top', -image_hor.find('img').eq(imageselected).position().top);
		}
		if($('#page').css('min-width')=='320px'){
			$(window).on('orientationchange resize', function(e){
				image_hor.css('top', '0');
				if ($('#overview-360 .view_container360').is(':visible')) {
					mobsize();
					updateSlider(angleScroll.slider('value'));
				}
			});
		}
	}
	
	var hmx360 = function(){
		if($('#page').css('min-width')=='320px'){
			var _iframe = $('#overview-hmx iframe').eq(0);
			setTimeout(function(){
				//window.open(_iframe.attr('src'));
				_iframe.height(_iframe.width()*0.56);
				
			},500);
			$(window).on('orientationchange resize', function(e){
				setTimeout(function(){
					_iframe.height(_iframe.width()*0.56);
				},500);
			});
		}
	}
	
	//relatedpages
	var relatedPages = function(){
		//scrollto
		var barH = $('#bookmarkbar').height()+$('#browsebar').height();
		$('#hero-main .extra-link a').click( function(e){
			var href = $(this).attr("href");
			if(href.charAt(0)=='#'){
				if($('#page').css('min-width')!='320px'){
					var offsetY = -1*(barH);
					$.scrollTo(
						href,
						{
							duration: 1000,
							easing: 'easeOutExpo',
							offset: { 'left':0, 'top':offsetY}
						}
					);
				}else{
					var section = $($(this).attr("href")).parents('.pagesectioncomponent');
					var tab = section.find('.sectionTitle');
					var contents =  section.find('.sectionContents');
					if(tab.hasClass('active')){
						$.scrollTo(href,{duration: 500,easing: 'easeOutExpo'});
					}else{
						sectionToggle(contents, tab, function(){
							$.scrollTo(href,{duration: 500});
						});
					}
				}
				return false;
			}
		});
	}
	
	//Specs
	var specsImage = function(){
		var image = $('.specs-images > img').eq(0);
		image.data('alt_org', image.attr('alt'));
		var size = $('.specs-sizeselector').eq(0);
		var colors = $('.specs-colors').eq(0);
		//setting(size.find('a.selected').eq(0));
		size.find('a').each(function(index, element) {
			var num = index;
			if(!$(this).hasClass('pagelink')){
				$(this).click(function(e) {
					colors.find('a').removeClass('selected');
					$(this).parent().siblings().find('a').removeClass('selected');
					$(this).addClass('selected');
					image.attr('src',$(this).attr('href'));
					if(num!=0){
						$('.specs-data-block').hide();
						image.attr('alt','');
					}else{
						$('.specs-data-block').show();
						image.attr('alt',image.data('alt_org'));
					}
					return false;
				});
			}
		});
		colors.find('a').each(function(index, element) {
			$(this).click(function(e) {
				if(!$(this).hasClass('pagelink')){
					size.find('a').removeClass('selected');
					$(this).parent().siblings().find('a').removeClass('selected');
					$(this).addClass('selected');
					image.attr('src',$(this).attr('href'));
					$('.specs-data-block').show();
					return false;
				}
			});
		});
		function setting(_element){
			var dataColors = _element.attr('data-colors');
			if(dataColors){
				var colorId = $('#'+dataColors);
				colorId.siblings().addClass('hid');
				colorId.removeClass('hid');
				image.attr('src',colorId.find('.selected').attr('href'));
			}else{
				colors.find('dl').addClass('hid');
				image.attr('src',_element.attr('href')); 
			}
		}
	};
	
	var seeAllSpecs = function(){
		$('.specs-data-block .seeall, .specs-data-block .seeall-installationspacing').each(function(index, element) {
			var data = $(this).find('a').attr('href');
			var loc = document.location.href;
			var id = $('.specs-data-block').parents('.pagesection').eq(0).attr('id');
			if(loc.indexOf('?allspecs')!=-1){
				$.productpage_modalwindow(data,'specs-all');
				focusedElementBeforeModal = jQuery(':focus');
			}
			$(this).find('a').click(function(e) {
				if($(this).hasClass('loadhtml')){
					specallhtmlLoc = $(this).prop('href');
					$.productpage_modalwindow(data,'specs-all html');
					focusedElementBeforeModal = jQuery(':focus');
				}else{
					$.productpage_modalwindow(data,'specs-all');
					focusedElementBeforeModal = jQuery(':focus');
				}
				e.preventDefault();
			});
		});
	}
	
	//badge
	var badge = function(){
		var lists = $('.specs-data .badge li');
		lists.each(function(index, element) {
			if(!$('html').hasClass('touch-device')){
				var text;
				$(this).hover(
					function(e){
						text = $(this).children('a').eq(0).attr('title');
						$(this).children('a').eq(0).attr('title','');
						var num = lists.index($(this))%4;
						if(text){
							$(this).append('<div class="badge-caption pos'+num+'"><span class="bodycopy1">'+text+'</span></div>');
						}
					},
					function(e){
						$(this).children('a').eq(0).attr('title',text);
						$(this).find('.badge-caption').remove();
					}
				).on('click',function(e){
					e.preventDefault();
				});
			}else{
				$(this).bind('click',function(e){
					if($(this).find('.badge-caption').length){
						$(this).find('.badge-caption').remove();
					}else{
						var text = $(this).children('a').eq(0).attr('title');
						var num = lists.index($(this))%4; 
						$(this).append('<div class="badge-caption pos'+num+'"><span class="bodycopy1">'+text+'</span></div>');
						$(this).siblings().find('.badge-caption').remove();
					}
					if($(this).attr('href') =='#') return false;
				});
			}
		});
	}

	//demos
	var demos = function(_container){
		var container = $(_container);
		var mainvisuals = $(container).find('.demo-visual-main');
		var btns = $(container).find('.demo-visual-btn li a');
		var btnsrc = [];
		var copies = $(container).find('.demo-copy');
		var inst = $(container).find('.instruction');
		var btnStart = $(container).find('.demo-visual-backtostart a'); 

		if(container.hasClass('type-hotspot')){
			btns.each(function(index, element) {
				/* for lazy load */
				var $btnImg = $(this).find('img');
				var src = $btnImg.attr('src');
				$btnImg.data({
					src_off: src,
					src_on: src.replace(/\-white/, '-dblue')
				});
				btnsrc[index] = {off : src , on : src.replace(/\-white/, '-dblue')};
				var onImg = new Image();
				onImg.src = $btnImg.data('src_on');
			});
		}
		btnsFunc(600);
		setAria();
		$(container).find('.demo-visual-btn ul').attr('role','tablist');

		$(container).find('.demo-visual-btn ul').on('keydown',function(e){
			var _obj;
			var _current = $(':focus');
			var _index = _current.parent().index();
			var _len = btns.length;
			if (e.keyCode == 37 || e.keyCode == 38) {
				if(_index == 0){
					_index = _len-1;
				}else{
					_index --; 
				}
				btns.eq(_index).attr('tabindex','0').focus();
				event.preventDefault();
				return false;
			}
			if (e.keyCode == 39 || e.keyCode == 40 ) {
				if(_index == _len-1){
					_index = 0;
				}else{
					_index ++;
				}
				btns.eq(_index).attr('tabindex','0').focus();
				event.preventDefault();
				return false;
			}
		});		
		function setAria(){
			initAria();
			btns.each(function(index, element) {
				$(this).parent().attr('role','tab');
				
			});
			copies.each(function(index, element) {
				$(this).attr('role','tabpanel');
			});
		}
		function initAria(){
			btns.each(function(index, element) {
				if(index==0){
					$(this).attr('tabindex','0');
				}else{
					$(this).attr('tabindex','-1');
				}
				$(this).parent().attr('aria-selected','false').attr('tabindex','-1');
			});
			copies.each(function(index, element) {
				$(this).attr('aria-expanded','false').attr('aria-hidden','true');
			});
			/*btnStart.parent().attr('aria-selected','true').attr('tabindex','0');
			btnStart.attr('tabindex','0');
			inst.attr('aria-expanded','true').attr('aria-hidden','false');*/
		}
		function btnsFunc(_duration){
			btnStart.on('click', function(e){
				e.preventDefault();
				btns.off();
				btns.each(function(index, element) {
					$(this).parent().removeClass('active');
				});
				btnStart.off();
				copies.hide();
				btnImgChange(100);
				mainvisuals.find('.demo-visual-main-part').hide();
				if($('html').hasClass('opacity')){
					mainvisuals.find('.demo-visual-main-inst').css({'visibility':'visible','opacity':'0'}).animate({opacity: 1},{duration: _duration});
				}else{
					mainvisuals.find('.demo-visual-main-inst').css({'visibility':'visible','opacity':'1'})
				}
				inst.fadeIn(_duration, function(){btnsFunc();});
				initAria();
			});
			btns.each(function(index, element) {
				if(!$('html').hasClass('touch-device') && container.hasClass('type-hotspot')){
					var tooltipTxt = copies.eq(index).find('h3').eq(0).text();
					$(this).on('mouseenter', function(e){
						$(this).parent().css('z-index', 2);
						$(this).parent().siblings().css('z-index',0);
						if(!$(this).parent().hasClass('active')){
							if(container.attr('data-tooltips') == 'on' && tooltipTxt){
								$(this).append('<div class="tooltips"><span class="text">'+tooltipTxt+'</span><span class="arrow"></span></div>');
								if($(this).parent().position().left <= container.find('.demo-visual-inner').width()/2){
									$(this).children('.tooltips').addClass('left')
								}else{
									$(this).children('.tooltips').addClass('right');
								}
								if($(this).parent().position().top <= container.find('.demo-visual-inner').height()/2){
									$(this).children('.tooltips').addClass('top');
								}else{
									$(this).children('.tooltips').addClass('bottom');
								}
							}
							/* for lazy load */
							$(this).children('img').each(function(){
								$(this).attr('src',$(this).data('src_on'));
							}).width(59);
							$(this).children('img').animate({width: '65px', marginTop:'-3px', marginLeft:'-3px', marginRight:'-3px'},{duration:100});
						}
					});
					$(this).on('mouseleave', function(e){
						$(this).children('.tooltips').remove();
						if(!$(this).parent().hasClass('active')){
							/* for lazy load */
							$(this).children('img').each(function(){
								$(this).attr('src',$(this).data('src_off'));
							});
							$(this).children('img').animate({width: '59px', marginTop:0, marginLeft:0},{duration:100, complete:function(){$(this).removeAttr('style');}});
						}
					});
				}
				$(this).on('click', function(e) {
					e.preventDefault();
					btns.off();
					btnStart.off();
					btnImgChange(index);
					inst.hide();
					if(!$('html').hasClass('touch-device') && container.hasClass('type-hotspot')){
						$(this).children('.tooltips').remove();
						$(this).parent().addClass('active');
						$(this).parent().siblings().removeClass('active');
						$(this).children('img').removeAttr('style');
					}
					mainvisuals.find('.demo-visual-main-inst').css('visibility','hidden');
					var mainvis = mainvisuals.find('.demo-visual-main-part').eq(index);
					if($('html').hasClass('opacity')){
						mainvis.fadeIn(_duration);
					}else{
						mainvis.show();
					}
					mainvis.siblings('.demo-visual-main-part').hide();
					var copy = copies.eq(index);
					copy.attr('aria-expanded','true').attr('aria-hidden','false');
					copy.fadeIn(_duration, function(){});
					copy.siblings().attr('aria-expanded','false').attr('aria-hidden','true').hide();
					btnsFunc();
					// for lazy load
					$(document).trigger('appear_container.gwc', [mainvis, copy]);
				});
			});
		}
		function btnImgChange(_index){
			/*btnStart.parent().attr('aria-selected','false').attr('tabindex','-1');
			btnStart.attr('tabindex','-1');
			inst.attr('aria-expanded','false').attr('aria-hidden','true');*/
			btns.each(function(index, element) {
				/* for lazy load */
				var $btn = $(this);
				if(index == _index){
					if(container.hasClass('type-hotspot')){
						var $btnImg = $btn.find('img');
						$btnImg.attr('src',$btnImg.data('src_on'));
					}else{
						$btn.addClass('selected');
					}
					$btn.attr('tabindex','0');
					$btn.parent().attr('aria-selected','true').attr('tabindex','0');
				}else{
					if(container.hasClass('type-hotspot')){
						var $btnImg = $btn.find('img');
						$btnImg.attr('src', $btnImg.data('src_off'));
					}else{
						$btn.removeClass('selected');
					}
					$btn.attr('tabindex','-1');
					$btn.parent().attr('aria-selected','false').attr('tabindex','-1');
				}
			});
		}
	};
	
	//support
	supportmod = function(){
		$('.support-content .disclaimer').each(function(index, element) {
			var data = $(this).attr('href');
			$(this).click(function(e) {
				$.productpage_modalwindow(data,'disclaimer-detail',function(){
					var href = $(".disclaimer-detail .main-btn a").attr('href');
					$(".disclaimer-detail .check-accept :checkbox").change(function(e) {
						$(this).parent().toggleClass('checked');
						$(this).parent().parent().parent().toggleClass('accepted');
					});
					$(".disclaimer-detail .main-btn a").click(function(e) {
						if(!$(this).parent().parent().hasClass('accepted')){
							return false;
						}
					});		
				});
				focusedElementBeforeModal = jQuery(':focus');
				return false;
			});
		});
		
	};
	
	//mobile 
	var iframes = new Array();
	var mobile = function(){
		if($('#page').css('min-width')=='320px'){
			$('section.pagesection').each(function(index, element) {
				var contents = $(this).find('.sectionContents');
				/*if(index!=0){
					contents.css('display','none');
					$('.youtube-placeholder.youku-player', contents).switchVisibleYkuPlayer(false);
				}else{
					$(this).find('.sectionTitle').addClass('active');
				}*/
				$(this).find('.sectionTitle').addClass('active');
				$(this).find('.sectionTitle').click(function(e) {
					sectionToggle(contents, $(this));
					return false;
				});
			});
		}

		$(window).resize(function(e) {
			if($('#page').css('min-width')!='320px'){
				$('#sections .sectionContents').css('display','block');
			}else{
				$('section.pagesection').each(function(index, element) {
					var contents = $(this).find('.sectionContents');
					if(!$(this).find('.sectionTitle').hasClass('active')){
						contents.css('display','none');
					}
				});
			}
		});
	}
	function sectionToggle(_contents, _tab, _func){
		var func = (_func)? _func : function(){
			$('.youtube-placeholder.youku-player', _contents).switchVisibleYkuPlayer();
		};
		if(_tab.hasClass('active')){
			_contents.slideUp('slow',function(e){
				func();
			});
			_tab.removeClass('active');
		}else{
			_contents.slideDown('slow',function(e){
				updateSliderSizes($('.slider', _contents));
				$(this).productboxHAdjst('.product-box', '.product-box-in', ['.product-box-in > a, .product-box-in > div:first-child']);
				holderSize(this).always(function(){
					func();
					updateSliderSizes($('.slider', _contents));
					$(document).trigger('appear_container.gwc', _contents);
				});
			});
			_tab.addClass('active');
		}
		
	}

	
	// Tabs initialization
	var tabs = function(_selector){
		$(_selector).not('.feature-mobile-tab').tabs({
			activate: function( event, ui ){
				YouTubeUtils.stopYoutubeVideos();
				updateSliderSizes($('.slider', ui.newPanel));
				holderSize(ui.newPanel).always(function(){
					$('.youtube-placeholder.youku-player', ui.newPanel).switchVisibleYkuPlayer();
					updateSliderSizes($('.slider', ui.newPanel));
				});
				var $thumbsPatinator = $(ui.newPanel).find('.titles-paginator.thumbnails .paginator');
				var isThumnailPagenator = $thumbsPatinator.size() > 0 && !isMobile();
				var paginatorOffsetOrder;
				if(isThumnailPagenator) {
					// mark first paginator thumnail.
					paginatorOffsetOrder = $thumbsPatinator.triggerHandler('currentVisible').first().attr('order');
				}
				$(ui.newPanel).productboxHAdjst('.product-box', '.product-box-in', ['.product-box-in > a, .product-box-in > div:first-child']);
				// carousel.anchorBuilder calls in updateSizes trigger.
				if(isThumnailPagenator && $thumbsPatinator.triggerHandler('currentVisible').first().attr('order') != paginatorOffsetOrder) {
					// reorder paginator.
					$thumbsPatinator.append($thumbsPatinator.children().slice(0, $thumbsPatinator.children('[order="' + paginatorOffsetOrder + '"]').index()));
				}

				var _360 = $(ui.newPanel).find('.view_container360');
				if(_360.length){
					r360();
				}
				var _hmx = $(ui.newPanel).find('.overview-hmx');
				if(_hmx.length){
					hmx360();
				}
				// for lazy load
				$(document).trigger('appear_container.gwc', ui.newPanel);
			},
			create: function( event, ui ) {
				holderSize(ui.panel).always(function(){
					$('.youtube-placeholder.youku-player', _selector).switchVisibleYkuPlayer();
				});
				$(ui.panel).productboxHAdjst('.product-box', '.product-box-in', ['.product-box-in > a, .product-box-in > div:first-child']);
			}
		});
		/*if($('#page').css('min-width')=='320px'){
			$(_selector).filter('.feature-mobile-tab').tabs({
				create : function(event, ui){
					$(ui.panel).find('.caroufredsel_wrapper').children().eq(0).trigger('configuration', ['width', '100%']).trigger("updateSizes");
				},
				activate : function(event, ui){
					YouTubeUtils.stopYoutubeVideos();
					$(ui.newPanel).find('.caroufredsel_wrapper').children().eq(0).trigger('configuration', ['width', '100%']).trigger("updateSizes");
					holderSize();
				}
			});
		}*/
		$(".product-tabs").find("li").find("a").attr("tabindex","0");
		$(".product-tabs").find("li").click(function(){
			$(this).find("a").attr("tabindex","0");
		});	
		$('.product-tabs').each(function(index, element) {
			var _tabs = $(this);
			_tabs.find('.tabs-menu-text').text(_tabs.find('.tabs-menu-select-mob option').eq(0).text());
			_tabs.find('.tabs-menu-select-mob').on('change',function(){
				_tabs.tabs('option', 'active', $(this).val());
				_tabs.find('.tabs-menu-text').text(_tabs.find('.tabs-menu-select-mob option').eq($(this).val()).text());
			});
		});
	}
	
	//bookmarkbar 
	var bookmarkbar = function(){
		//if($('#bookmarkbar').css('display')=='none')  return false;
		//scrollto
		var ubartH = ($('#userbar').length) ? $('#userbar').height() : 0;
		var barH = $('#bookmarkbar').height()+$('#browsebar').height()+ubartH;
		$('#bookmarkbar a').click( function(event){
			var offsetY = ($(this).hasClass('first'))? 0 : -1*(barH);
			$.scrollTo(
				$(this).attr("href"),
				{
					duration: 1000,
					easing: 'easeOutExpo',
					offset: { 'left':0, 'top':offsetY},
					onAfter : function(){}
				}
			);
			return false;
		});
		//slide
		var lists = $('#bookmarkbar li');
		var lists_w = 0;
		var lists_len = lists.length;
		var bg_w = 1000;
		var nav_w = $('#bookmarkbar nav').width();
		var gap = 18;
		lists.each(function(index, element) {
			var _w = $(this).width();
			lists_w += eval(_w);
		});
		var startX = (nav_w - lists_w)/2 - 1000 + lists.eq(0).width() + gap;
		$('#bookmarkbar nav').css({'background-position': startX + 'px 0' });
		var sections = $('#sections');
		var pagecomp = $('#sections .pagesectioncomponent');
		var sectionsH = (function(){
			var _ph = 0;
			pagecomp.each(function(index, element) {
				if($(this).height()<=650){
					_ph += eval($(this).height());
				}else{
					_ph += 650;
				}
			});
			return _ph -  pagecomp.last().height();
		})();
		var cotents_h = $('#sections').offset().top + sectionsH;
		
		$(window).scroll(function(e) {
			var sctop = $(window).scrollTop();
			var rate = sctop/cotents_h;
			if(rate < 1){
				var posX = (lists_w - lists.eq(0).width())*rate + startX;
				$('#bookmarkbar nav').css({'background-position': posX + 'px 0'});
			}
			pagecomp.each(function(index, element){
				var _id =$(this).find('section').attr('id');
				var num = $(this).index();
				var _ph = ($(this).prev().height())? $(this).prev().height() : $(this).height();
				if(sctop - $(this).offset().top +  _ph/2 > -1*barH){
					lists.eq(num+1).find('a').addClass('selected');
				}else{
					lists.eq(num+1).find('a').removeClass('selected');
				}
			});
			
		});
	};
	
	//action
	$('.slider').each(function(i, element) {
		slider(element);
	});
	swapImg(".item-box a", '-ro-db', 'p.blank img');
	seeAllSpecs();
	$(window).on('load',function(e) {
		//productBoxH();
		tabs(".product-tabs");
		seemore();
		relatedPages();
		specsImage();
		badge();
		$('.demo-block').each(function(index, element) {
			demos(element);
		});
		supportmod();
		mobile();
		// for lazy load
		imageLazyload();
	});
	if($('#bookmarkbar').length && $('#browsebar').length){
		$(window).on('load',function(e) {
			bookmarkbar();
		});
	}
	$('.extra-link a[target="_blank"]').each(function(index, element) {
		var img;
		$(this).find('img').each(function(i, e) {
			if($(this).css('display')!='none'){
				img = $(this);
			}
		});
		if($(this).closest('.style-dark').length){
			swapImg('.extra-link a[target="_blank"]', '-ro', img);
		}
		if($(this).closest('.style-light').length){
			swapImg('.extra-link a[target="_blank"]', '-ro', img);
		}
	});

	var updateSliderSizes = function(carousels) {
		$(carousels).each(function() {
			var $carousel = $(this);
			var $carouselWrapper = $carousel.closest('.slider-wrapper:visible');
			if ($carouselWrapper.size() > 0) {
				$carousel.trigger('updateSizes').trigger('configuration', ['width', '100%']).trigger('updateSizes');
			}
		});
	};
	function imageLazyload() {
		function loadSlideImagesAsNeed($targetSlider, isInit) {
			var $currentVisibleSilide = $targetSlider.children().first();
			var $targetSlideConts = $currentVisibleSilide.add($currentVisibleSilide.next());
			if (!isInit || (isInit && $targetSlider.closest('.features-slider').is(':not(.global-features-slider)'))) {
				$targetSlideConts = $targetSlideConts.add($currentVisibleSilide.nextAll(':last-child'));
			}
			var $loadTargetImgs = $targetSlideConts.find('img:not(.lazy)').filter('[data-type="img-conv"],[idx]');
			$loadTargetImgs.each(function() {
				var $target = $(this);
				if (!$(this).data('ic-state')) {
					$target.closest('.slider').parent().css("background", "url('etc/designs/panasonic/common-clientlibs/images/loader.gif') no-repeat scroll center center");
				}
				$target.on('imageconverted.gwc', function(){
					if ($target.closest('.caroufredsel_wrapper').is(':animated')) {
						$target.closest('.caroufredsel_wrapper').stop(true);
					}
					$target.closest('.slider').trigger('configuration', ['width', '100%']).trigger("updateSizes");
				}).imageConverter({convert: $target.is('[data-type="img-conv"]')});
				$target.closest('.slider').parent().css("background", "none");
			});
		}
		// each slider
		// on slideScrollAfter for carousel
		$('.slider').on('slideScrollAfter.gwc', function() {
			// load current visible slide image, prev slide image and next slide image.
			loadSlideImagesAsNeed($(this));
		}).filter(':visible').each(function() {
			// load init display images for first carousel
			loadSlideImagesAsNeed($(this), true);
		});
		$(document).on('appear_container.gwc', function(event, container) {
			if (!!$('.slider,.accessories-block', container).size()) {
				loadSlideImagesAsNeed($('.slider,.accessories-block', container));
			}
		});

	}
});


//Print All Specs
var printStyle;
jQuery(function($){
	if($('body').css('direction')=='rtl'){
		printStyle = 
		'body { direction:rtl}'+
		'body * { margin:0; padding:0 }'+
		'.spech_img { position:absolute; top:0; right:0; width:145px; height:109px;}'+
		'.printbut,.specall_buttons {display : none}'+
		'.spech_title {height:89px; margin-right:145px; padding-top:20px;}'+
		'.spech_title h2 { font-family: "Open Sans Condensed", sans-serif; font-size:20px; font-weight:bold; line-height:24px;}'+
		'.breadcrumbs {margin-bottom:5px; overflow:hidden; zoom:1;}'+
		'.breadcrumbs li { float:right; margin-left:10px; list-style:none;}'+
		'.breadcrumbs li a { display:inline-block; padding-right:14px; background-position:100% 50%; background-repeat:no-repeat; font-size:11px;}'+
		'.breadcrumbs li a { color:#9b9b9b; background-image:url(/etc/designs/panasonic/productpage-clientlibs/images/icn-arrow-lightgrey-left.gif);}'+
		'table { width:98%; border-collapse:collapse; border-spacing:0; border:1px solid #ccc;}'+
		'td, th { border:1px solid #ccc; background-color:#f5f5f5; padding:10px; vertical-align:top; font-size:12px; font-weight:normal; line-height:17px; text-align:inherit; }'+
		'td.tb-blk { background-color:#fff;}'+
		'.spech_lightbox.jspScrollable {overflow:visible!important; height:auto!important; width:auto!important;}'+
		'.spech_lightbox .jspContainer {height:auto!important; width:auto!important;}'+
		'.spech_lightbox .jspPane {position:static!important; width:auto!important;}'+
		'.spech_lightbox .jspVerticalBar {display:none;}'+
		'.print_copyright {margin-top:20px; text-align:center; font-size:12px;}'+
		'.spec_text {margin-bottom:20px;}'+
		'.spec_text p {font-size:12px;line-height:1.42;}'+
		'.spec_detail_image {text-align:center;}'+
		'.spec_detail_image img {max-width:100%; height:auto;}';
	}else{
		printStyle = 
		'body * { margin:0; padding:0 }'+
		'.spech_img { position:absolute; top:0; left:0; width:145px; height:109px;}'+
		'.printbut,.specall_buttons {display : none}'+
		'.spech_title {height:89px; margin-left:145px; padding-top:20px;}'+
		'.spech_title h2 { font-family: "Open Sans Condensed", sans-serif; font-size:20px; font-weight:bold; line-height:24px;}'+
		'.breadcrumbs {margin-bottom:5px; overflow:hidden; zoom:1;}'+
		'.breadcrumbs li { float:left; margin-right:10px; list-style:none;}'+
		'.breadcrumbs li a { display:inline-block; padding-left:14px; background-position:0 50%; background-repeat:no-repeat; font-size:11px;}'+
		'.breadcrumbs li a { color:#9b9b9b; background-image:url(/etc/designs/panasonic/productpage-clientlibs/images/icn-arrow-lightgrey-right.gif);}'+
		'table { width:98%; border-collapse:collapse; border-spacing:0; border:1px solid #ccc;}'+
		'td, th { border:1px solid #ccc; background-color:#f5f5f5; padding:10px; vertical-align:top; font-size:12px; font-weight:normal; line-height:17px; text-align:inherit; }'+
		'td.tb-blk { background-color:#fff;}'+
		'.spech_lightbox.jspScrollable {overflow:visible!important; height:auto!important; width:auto!important;}'+
		'.spech_lightbox .jspContainer {height:auto!important; width:auto!important;}'+
		'.spech_lightbox .jspPane {position:static!important; width:auto!important;}'+
		'.spech_lightbox .jspVerticalBar {display:none;}'+
		'.print_copyright {margin-top:20px; text-align:center; font-size:12px;}'+
		'.spec_text {margin-bottom:20px;}'+
		'.spec_text p {font-size:12px;line-height:1.42;}'+
		'.spec_detail_image {text-align:center;}'+
		'.spec_detail_image img {max-width:100%; height:auto;}';
	}
});

var win=null;
function printIt(printThis, printStyle){
	win = window.open();
	self.focus();
	win.document.open();
	win.document.write('<'+'html'+'><'+'head'+'><'+'style'+'>');
	win.document.write(printStyle);
	win.document.write('<'+'/'+'style'+'><'+'/'+'head'+'><'+'body'+'>');
	win.document.write(printThis);
	win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
	win.document.close();
	win.print();
	win.close();
}

function copyUrl(_target){
	var loc;
	if(specallhtmlLoc!=''){
		loc = specallhtmlLoc;
	}else{
		loc = (document.location.href.indexOf('?allspecs')==-1) ?  document.location.href + '?allspecs' : document.location.href ;
	}
	jQuery(function($){
		$('#copyurlbox').remove();
		$(_target).parent().parent().append('<div id="copyurlbox"><a href="#" class="btn_close"><img src="etc/designs/panasonic/common-clientlibs/images/btn-tooltip-close.gif" width="7" height="7" alt="close"></a><span><input type="text" value="'+loc+'" id="specallURL"></span></div>');
		$('#specallURL').select().focus();
		$('#specallURL').on('click', function(e){
			$(this).select().focus();
		});
		$('#specallURL').on('blur', function(e){
			$(this).val(loc);
		});
		$('#copyurlbox .btn_close').on('click',function(e){
			$('#copyurlbox').remove();
			return false;
		});
	});
}

/* swapimage */
jQuery(function($){
	$('.mouseover.swap').each(function(){
		if($('#page').css('min-width')!='320px'){
			var target = $(this).find('img').eq(0);
			var src = target.attr('data-src') || target.attr('src');
			var srcOv = target.attr('data-rosrc');
			var srcOvImg = new Image();
			srcOvImg.src = srcOv;
			$(this).hover(
				function(){
					if(window.navigator.taintEnabled != undefined){
						var w = target.width();
						var h = target.height();
						target.width(w).height(h).attr("src","data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw%3D%3D").css({'background-image':"url("+srcOv+")"});
					}else{
						target.attr('src',srcOv);
					}
				},
				function(){
					target.attr('src',src);
				}
			);
		}
	});
});


// v33
;(function($){
	//You might also like
	$(window).on('load', function(){
		$('.youlikesection-items').productboxHAdjst('.product-box', '.product-box-in', ['.product-box-in > a, .product-box-in > div:first-child']);
	}).on('resize', function(){
		if($('#page').css('min-width') === '320px'){
			$('.youlikesection-items').productboxHAdjst('.product-box', '.product-box-in', ['.product-box-in > a, .product-box-in > div:first-child']);
		}
	});
})(jQuery);

/**
 * load images(in 360) if imgs are existed in wrapper
 * @param wrapper   image object's container
 * @author jtk(scsk)
 */
function load360ImagesAsNeed(wrapper) {
	var emptyImgs = [];
	$("img[data-src]", wrapper).each(function() {
		var img = $(this);
		if ($(img).attr("data-src") != $(img).attr("src")) {
			emptyImgs.push(img);
		}
	});
	
	if (emptyImgs.length > 0) {
		var r360slider = wrapper.siblings('.bottom-slider').find('.angle_scroll');
		var loadedImageCount = 0;
		$("img[data-src]", wrapper).load(function() {
			loadedImageCount += 1;
			if (loadedImageCount >= emptyImgs.length) {
				if (r360slider.hasClass('ui-slider')) {
					r360slider.slider('value', r360slider.slider('value'));
				}
			}
		});
		ajax360Image(0, emptyImgs);
	}
}

/**
 * loading all images before 360 view could been showed
 * @param img  image object target
 * @author jtk(scsk)
 */
function ajax360Image(idx, imgs) {
	if (idx >= imgs.length) return;
	var img = imgs[idx];
	$(img).one("load", function() {
		idx += 1;
		ajax360Image(idx, imgs);
	}).attr("src", $(img).attr("data-src"));
}

/**
 * set focus to thumbnail image
 * @param container slider container
 * @param data      slider data
 * @author jtk(scsk)
 */
function focus2Thumbnail(container, data) {
	if(!container.find('.titles-paginator').hasClass('thumbnails')) return;
	var paginator = container.find('.titles-paginator .container .paginator');
	paginator.children().removeClass('selected').filter(function(){
		return $(this).attr('order') == data.items.visible.attr('order');
	}).addClass('selected');
	if (!isMobile() && !paginator.triggerHandler('currentVisible').is('.selected')) {
		paginator.triggerHandler('slideTo', paginator.children().filter('.selected'));
	}
}
