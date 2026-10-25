jQuery(function($){
	if(!$.support.opacity && $('.product-box-in .buy-btn .btn-blue').length){
		$(window).on('load',function(e){
			$('.product-box-in .buy-btn .btn-blue').each(function(index, element) {
				$(this).addClass('ie8');
			});
		});
	}
	
	var usercart = function(){
		this.init = function(){
			eventCart();
			eventBuyBtn();
		}
		var container = $('#userbar-cart');
		var cartlist = $('#userbar-cartlist');
		/* add start */
		cartlist.on('noticecart.ec', showhideCartlist);
		/* add end */
		var apiscroll;
		var timerId = setTimeout('',0);
		function eventCart(){
			if(container.children('a').hasClass('noitem')){
				container.children('a').find('.num').hide();
			}else{
				if(container.hasClass('onloadopen')){
					$(window).on('load',function(e){
						setTimeout(showhideCartlist,200);
					});
				}
			}
			if($('#page').css('min-width')=='320px' && !$('#user-login').closest('.layout-row').length){
				$(window).on('load resize', function(e){
					container.css('height','34px');
					if($('#user-login').outerHeight()>34){
						$('#user-login').removeClass('ud34');
					}else{
						$('#user-login').addClass('ud34');
					}
					var _h = Math.max($('#user-login').outerHeight(),container.outerHeight());
					container.height(_h);
				});
			}
			container.children('a').on('click tap', function(e){
				e.preventDefault();
				if(!$(this).hasClass('noitem')){
					if(cartlist.hasClass('opened')){
						hideCartlist();
					}else{
						showCartlist();
					}
				}
			});
			if(!$('html').hasClass('touch-device') && $('#page').css('min-width') != '320px'){
				cartlist.hover(
					function(){
						clearTimeout(timerId);
					},
					function(){
						if(cartlist.hasClass('opened')){
							hideCartlist();
						}
					}
				);
			}
			cartlist.on('keydown', function(event){
				if ( event.which == 9 ) {
					var o = $(this).find('*');
					var focusableItems;
					focusableItems = o.filter(focusableElementsString).filter(':visible')
					var focusedItem;
					focusedItem = jQuery(':focus');
					var numberOfFocusableItems;
					numberOfFocusableItems = focusableItems.length
					var focusedItemIndex;
					focusedItemIndex = focusableItems.index(focusedItem);
					if (event.shiftKey) {
						if(focusedItemIndex==0){
							if(cartlist.hasClass('opened')){hideCartlist();container.children('a').focus();}
							event.preventDefault();
						}
					} else {
						if(focusedItemIndex==numberOfFocusableItems-1){
							if(cartlist.hasClass('opened')){hideCartlist();container.children('a').focus();}
							event.preventDefault();				
						}
					}
				}
			});
		}
		function showCartlist(callback){
			cartlist.addClass('opened');
			cartlist.slideDown(500,function(){
				
				if(callback){
					callback();
				}
			});
			scrollbar();
		}
		function hideCartlist(){
			cartlist.slideUp(500,function(){
				if(apiscroll && cartlist.find('.jspContainer').length){
					apiscroll.destroy();
					cartlist.find('.cartlist-table').height('auto');
				}
				cartlist.removeClass('opened');
			});
		}
		function showhideCartlist(){
			showCartlist(function(){
				timerId = setTimeout(hideCartlist, 3000);
			});
		}
		function scrollbar(){
			if(!$('html').hasClass('touch-device') && $('#page').css('min-width') != '320px'){
				var _h = cartlist.find('.cartlist-table table').outerHeight();
				if(_h > 330){
					cartlist.find('.cartlist-table').height(330);
					apiscroll =  cartlist.find('.cartlist-table').eq(0).jScrollPane({
						autoReinitialise : true,
						mouseWheelSpeed : 20
					}).data('jsp');
				}else{
					//cartlist.find('.cartlist-table').css('height') = _h + 'px';
				}
			}
		}
		function eventBuyBtn(){
			$(document).on('click', '#browsebar-buy a.cart-direct, .product-box-in .buy-btn .btn-blue, #ChooseProduct .ChooseProduct_entry_etc_inner_block .ec-part .buy-btn a.btn-blue, .common-productbox-btns__buy a', function(e){
				if($(this).attr('href')){
					if($(this).attr('href').match(/javascript*|#/)){
						buyWin();
						return false;
					}
				}else{
					buyWin();
					return false;
				}
			});
		}
		function buyWin(){
			var jspApi,buymenuTabs;
			focusedElementBeforeModal = jQuery(':focus');
			overlayset();
			$('#lightbox-overlay').append('<div id="buywindow-wrapper"><div id="buywindow-bg"><a href="#" class="btn-close"><img src="etc/designs/panasonic/eccart-clientlibs/images/btn-lightbox-close.png" alt="Close"></a><div id="buywindow"></div></div></div>');
			var buywin_wrapper = $('#buywindow-wrapper');
			var btnClose = buywin_wrapper.find('.btn-close');
			buyContent();
			$('#lightbox-overlay').fadeIn({
				/* add start */
				start: function(){
					$('#buywindow').trigger('buymenuready.ec');
				},
				/* add end */
				done:function(){
					/* mod start */
					if ($(this).is(':not(:has(.ec-wait-overlay))')) {
						setInitialFocusModal($(this));
					}
					/* mod end */
					$(this).keydown(function(event){trapTabKey($(this),event);});
					if($('#page').css('min-width')!='320px' && $('#buywindow').find('.buymenu_tabs').length){
						//$('#buywindow').find('.buymenu_tabs').tabs( "option", "heightStyle", "auto" );
						//sizeSetting();
					}
					scrlboxSize();
					contentEvents();
				}
			});
			btnClose.click(function(e) {
				if($(this).hasClass('success') && (container.hasClass('onloadopen') /* add start */ || (!!EC && !!EC.settings && EC.settings.auto_basket_close_buymenu) /* add end */ )){
					closeBox(showhideCartlist);
				}else{
					closeBox();
				}
				return false;
			});
			buywin_wrapper.on('click','.btn-cookieok a', function(e){
				e.preventDefault();
				$(this).closest('.btn-addCart').removeClass('nocookie');
				sizeSetting();
				scrlboxSize();
				$('#notescookies').slideUp();
				$('#notescookies-rwd').slideUp();
				/* add start */
				if ("CookiePolicy" in window && $.isFunction(CookiePolicy.onclick)) {
					CookiePolicy.onclick(0);
				}
				if ("GwcCommon" in window && "cookiePolicyOptIn" in GwcCommon) {
					GwcCommon.cookiePolicyOptIn.resolve();
				}
				/* add end */
			});
			function closeBox(_callback){
				$('#lightbox-overlay').fadeOut(function(){
					overlayRemove();
					focusedElementBeforeModal.focus();
					if(_callback){
						if($('#page').css('min-width')==='320px'){
							$(window).scrollTop(0);
						}
						_callback();
					}
				});
			}
			function sizeSetting(){
				var _wh = window.innerHeight ? window.innerHeight : $(window).height();
				var _ww = $('body').width();
				var _wSctop = $(window).scrollTop();
				if($('#page').css('min-width') != '320px'){
					buywin_wrapper.css({'left':_ww/2-buywin_wrapper.width()/2 +'px', 'height':_wh-100+'px', 'top':_wSctop+50+'px'});
				}else{
					buywin_wrapper.css({'height':_wh+'px', 'top':_wSctop + 'px'});
				}
			}
			function scrlboxSize(){
				var _scrlbox = buywin_wrapper.find('#buywindow-content .scrl-box').eq(0);
				var _sclbox_in = buywin_wrapper.find('#buywindow-content-in');
				var _sclbox_inH = _sclbox_in.height() + parseInt(_sclbox_in.css('padding-top'),10);
				var _bw = buywin_wrapper.find('#buywindow');
				var _pd = parseInt(_bw.css('padding-top'),10) + parseInt(_bw.css('padding-bottom'),10);
				var _hb = buywin_wrapper.find('#buywindow-title');
				var _hbH = (_hb.length)? _hb.outerHeight() +  parseInt($(_hb).css('margin-bottom'), 10) : 0;
				var _sH = buywin_wrapper.height() - _pd - _hbH;
				if($('#page').css('min-width') != '320px'){
					if(_sH < _sclbox_inH){
						_scrlbox.css({'height':_sH + 'px'/*,'max-height':'none'*/});
					}else{
						_scrlbox.css({'height':_sclbox_inH+'px'/*,'max-height':_sH + 'px'*/});
					}
					if(!$('html').hasClass('touch-device')){
						var elm = _scrlbox.jScrollPane({mouseWheelSpeed : 20, autoReinitialise:true,});
						jspApi = elm.data('jsp');
					}
				}else {
					_scrlbox.css({'height':_sH + 'px'});
					if(navigator.userAgent.indexOf("Android 2") != -1){
						buywin_wrapper.addClass('android2');
						var elm = _scrlbox.jScrollPane({autoReinitialise:true});
						jspApi = elm.data('jsp');
					}
				}
			}
			function buyContent(){
				var _content = $('#buywindow-element').html();
				$('#buywindow').html(_content);
				onlineIframeSize();
				buyTabs();
				sizeSetting();
				$(window).on('resize',function(e){
					sizeSetting();
					scrlboxSize();
				});	
				/* add start */
				$('#buywindow').on('buymenuadjustsize.ec', function() {
					if($('#page').css('min-width')=='320px') onlineIframeSize();
					sizeSetting();
					scrlboxSize();
				});
				/* add end */
			}
			function buyTabs(){
				var _tabs = $('#buywindow').find('.buymenu_tabs');
				var _mobTab = $('#buywindow').find('.tabnavigation-mob');
				_tabs.tabs({
					activate: function( event, ui ) {
						sizeSetting();
						scrlboxSize();
					},
					/* add start */
					active: $('ul li.default-select', _tabs).size() > 0 ? $('ul li.default-select', _tabs).index() : 0
					/* add end */
				});
				if($('#page').css('min-width')=='320px'){
					/* mod start */
					/*
					_mobTab.find('.tabs-menu-text').text(_mobTab.find('.tabs-menu-select-mob option').eq(0).text());
					*/
					_mobTab.find('.tabs-menu-text').text(_mobTab.find('.tabs-menu-select-mob option:selected').text());
					/* mod end */
					_mobTab.find('.tabs-menu-select-mob').on('change',function(){
						/* mod start */
						/*
						_tabs.tabs('option', 'active', $(this).val());
						*/
						_tabs.tabs('option', 'active', $(this).prop('selectedIndex'));
						/* mod end */
						/* mod start */
						/*
						_mobTab.find('.tabs-menu-text').text(_mobTab.find('.tabs-menu-select-mob option').eq($(this).val()).text());
						*/
						_mobTab.find('.tabs-menu-text').text(_mobTab.find('.tabs-menu-select-mob option:selected').text());
						/* mod end */
					});
				}
			}
			function onlineIframeSize(){
				 $('#buywindow #buymenu_buyfromonline').find('.retailers iframe').each(function(index, element) {
					 $(this).iFrameResize({
						 resizedCallback: function(){
							 scrlboxSize();
						 },
						 checkOrigin: false
					 });
					/*$(this).height('auto');
					var _bH = $(this).contents().find('body').outerHeight();
					$(this).height(_bH);*/
				});
			}
			function contentEvents(){
				var _bw = buywin_wrapper.find('#buywindow');
				var _bm = _bw.find('#buymenu');
				var _bmonline = _bw.find('#buymenu_buyfromonline');
				var _bs = _bw.find('#buysuccess');
				var _buymenuCaptionMore =_bm.find('.buymenu-caption-moreinfo-detail');
				var _shippingDetail = _bm.find('.shipping-detail');
				var _enegyDetail = _bm.find('.buymenu-energylable-detail');
				/* del */
				// var _enegyTop = _bm.find('.buymenu-product-name').outerHeight() + parseInt(_bm.find('.buymenu-product-name').css('margin-bottom'),10) + 20;
				// mod start
				/*
				_bm.find('form').on('submit',function(e){
				*/
				_bm.find('form').on('submit cartadded.gwc',function(e){
				// mod end
					formsubmit();
					return false;
				});
				_bm.find('.btn-addCart > a').on('click', function(e){
					if(!$(this).hasClass('outoforder')){
						_bm.find('form').submit();
					}
					return false;
				});
				if($('html').hasClass('touch-device')){
					_bm.find('.buymenu-caption.pcfix .buymenu-caption-moreinfo span').on('click tap', function(){
						if($(this).find('.buymenu-tooltips').length){
							baloonHide(this);
						}else{
							var content = '<div class="buymenu-tooltips-content">'+_buymenuCaptionMore.html()+'</div>';
							baloonShow(this,content,0,0,342,300,30);
						}
					});
					_bm.find('.shipping.pcfix > span').on('click tap', function(){
						if($(this).find('.buymenu-tooltips').length){
							baloonHide(this);
						}else{
							var content = '<div class="buymenu-tooltips-content">'+_shippingDetail.html()+'</div>';
							baloonShow(this,content,60,0,322,280);
						}
					});
				}else{
					_bm.find('.buymenu-caption.pcfix .buymenu-caption-moreinfo span').hover(
						function(e){
							var content = '<div class="buymenu-tooltips-content">'+_buymenuCaptionMore.html()+'</div>';
							baloonShow(this,content,0,0,342,300,30);
						},
						function(e){
							baloonHide(this);
						}
					).on('click',function(e){
						e.preventDefault();
					});
					_bm.find('.shipping.pcfix > span').hover(
						function(e){
							var content = '<div class="buymenu-tooltips-content">'+_shippingDetail.html()+'</div>';
							baloonShow(this,content,60,0,322,280);
						},
						function(e){
							baloonHide(this);
						}
					).on('click',function(e){
						e.preventDefault();
					});
				}
				//mobile
				_bm.find('.buymenu-caption.rwd .buymenu-caption-moreinfo a').on('click tap',
					function(e){
						_buymenuCaptionMore.slideToggle(200);
						$(this).toggleClass('opened');
					});
				_bm.find('.shipping.rwd a').on('click tap',
					function(e){
						_shippingDetail.slideToggle(200);
						$(this).toggleClass('opened');
					});
					
				//energy Label
				if($('#page').css('min-width')!='320px'){
					if($('html').hasClass('touch-device')){
						_bm.find('.buymenu-energylable').on('click tap', function(){
							if($(this).find('.buymenu-tooltips').length){
								baloonHide(this);
							}else{
								var content = _enegyDetail.html();
								/* add */
								var _enegyTop = _bm.find('.buymenu-product-name').outerHeight() + parseInt(_bm.find('.buymenu-product-name').css('margin-bottom'),10) + 20;
								baloonShow(this,content,_enegyTop,0,600,400);
							}
						});
					}else{
						_bm.find('.buymenu-energylable').hover(
							function(e){
								var content = _enegyDetail.html()/*'<img src="'+$(this).find('a').attr('data-content')+'" alt="'+$(this).find('img').attr('alt')+'" style="display:block">'*/;
								/* add */
								var _enegyTop = _bm.find('.buymenu-product-name').outerHeight() + parseInt(_bm.find('.buymenu-product-name').css('margin-bottom'),10) + 20;
								baloonShow(this,content,_enegyTop,0,600,400);
							},
							function(e){
								baloonHide(this);
							}
						);
					}
				}else{
					_bm.find('.buymenu-energylable').on('click tap',
						function(e){
							_enegyDetail.slideToggle(200);
						});
				}
				//by keys
				_bm.find('.buymenu-caption.pcfix .buymenu-caption-moreinfo span a').on('focus', function(e){
					if($('html').hasClass('pressTabkey')){
						var content = '<div class="buymenu-tooltips-content">'+_buymenuCaptionMore.html()+'</div>';
						baloonShow($(this).parent(),content,0,0,342,300,30);
					}
				});
				_bm.find('.shipping.pcfix > span a').on('focus', function(e){
					if($('html').hasClass('pressTabkey')){
						var content = '<div class="buymenu-tooltips-content">'+_shippingDetail.html()+'</div>';
						baloonShow($(this).parent(),content,60,0,322,280);
					}
				});
				_bm.find('.buymenu-energylable a').on('focus', function(e){
					if($('html').hasClass('pressTabkey')){
						var content = _enegyDetail.html();
						/* add */
						var _enegyTop = _bm.find('.buymenu-product-name').outerHeight() + parseInt(_bm.find('.buymenu-product-name').css('margin-bottom'),10) + 20;
						baloonShow($(this).parent(),content,_enegyTop,0,600,400);
					}
				});
				_bm.find('.buymenu-caption.pcfix .buymenu-caption-moreinfo span a').on('blur', function(e){
					baloonHide($(this).parent());
				});
				_bm.find('.shipping.pcfix > span a').on('blur', function(e){
					baloonHide($(this).parent());
				});
				_bm.find('.buymenu-energylable a').on('blur', function(e){
					baloonHide($(this).parent());
				});
				//
				_bm.find('.buymenu-colorselector').attr({'role':'radiogroup'});
				_bm.find('.buymenu-colorselector dd a').each(function(index, element){
					$(this).attr({'role':'radio'});
					if(index==0){
						$(this).attr({'aria-checked':'true'});
					}else{
						$(this).attr({'aria-checked':'false'});
					}
					$(this).find('img').attr({'role':'presentation'});
					$(this).on('click', function(e){
						if(!$(this).hasClass('disable')){
							$(this).addClass('selected').attr({'aria-checked':'true'});
							$(this).parent().siblings().children('a').removeClass('selected').attr({'aria-checked':'false'});
						}
						return false;
					});
				});
				_bmonline.find('.buymenu-colorselector').attr({'role':'radiogroup'});
				_bmonline.find('.buymenu-colorselector dd a').each(function(index, element){
					$(this).attr({'role':'radio'});
					if(index==0){
						$(this).attr({'aria-checked':'true'});
						_bmonline.find('.retailers iframe').eq(index).show();;
					}else{
						$(this).attr({'aria-checked':'false'});
					}
					$(this).find('img').attr({'role':'presentation'});
					$(this).on('click', function(e){
						if(!$(this).hasClass('disable')){
							$(this).addClass('selected').attr({'aria-checked':'true'});
							$(this).parent().siblings().children('a').removeClass('selected').attr({'aria-checked':'false'});
							var _iframe = _bmonline.find('.retailers iframe').eq(index);
							_iframe.show();
							_iframe.siblings('iframe').hide();
						}
						return false;
					});
				});
				/*_bmonline.find('.buymenu-colorselector').attr({'aria-labelledby':'colors'});
				_bmonline.find('.buymenu-colorselector dd a').each(function(index, element){
					$(this).attr({'role':'checkbox','aria-describedby':'colors desc'+index});
					if(index==0){
						$(this).attr({'aria-checked':'true'});
					}else{
						$(this).attr({'aria-checked':'false'});
					}
					$(this).find('img').attr({'role':'presentation'});
					$(this).on('click', function(e){
						if(!$(this).hasClass('disable')){
							if($(this).hasClass('selected')){
								$(this).removeClass('selected').attr({'aria-checked':'false'});
							}else{
								$(this).addClass('selected').attr({'aria-checked':'true'});
							}
						}
						return false;
					});
				});*/
				_bs.find('.btn-continue a').on('click', function(e){
					if(container.hasClass('onloadopen') /* add start */ || (!!EC && !!EC.settings && EC.settings.auto_basket_close_buymenu) /* add end */ ){
						closeBox(showhideCartlist);
					}else{
						closeBox();
					}
					return false;
				});
				
				//addToCartQuantity
				_bm.find('.addToCartQuantity .editQuantity').on('click', function(e){
					if($(this).hasClass('disabled')){
						$(this).removeClass('disabled');
						$(this).prevAll('input.buynowNumber').removeClass('disabled').removeAttr('disabled');
					}else{
						$(this).addClass('disabled');
						// mod start
						/*
						$(this).prevAll('input.buynowNumber').addClass('disabled').attr('disabled','disabled');
						*/
						$(this).prevAll('input.buynowNumber').addClass('disabled').attr('disabled','disabled').each(function(){$(this).val($(this).val().replace(/^0(.+)/, '$1'));});
						// mod end
					}
				});
				_bm.find('.addToCartQuantity .buynowNumber').keyup(function(){
					var s = new Array();
					$.each( $(this).val().split(''), function(i, v){
						if( v.match(/[0-9]/gi) ) s.push(v);
					} );
					if(s.length > 0)
						$(this).val( s.join('') );
					else $(this).val(''); 
				});
				function formsubmit(){
					buywin_wrapper.find('#buywindow-title').css('visibility','hidden');
					/* mod start */
					if (_bs.size() == 0) {
						btnClose.addClass('success').triggerHandler('click');
					} else {
						_bm.fadeOut(200,function(e){
							if(typeof jspApi == "object"){
								jspApi.scrollTo(0,0);
							}
							_bs.fadeIn(200);
							btnClose.addClass('success');
							/*
							container.children('a').find('.num').show();
							container.children('a').removeClass('noitem');
							*/
						});
					}
					/* mod end */
				}
				function baloonShow(_obj,_content,_top,_left,_w,_h,_bottom){
					var pointerImg,pointerClass,sideP;
					$(_obj).css('z-index',1);
					if($(_obj).parents('.buymenu-left').length){
						pointerImg = 'etc/designs/panasonic/eccart-clientlibs/images/img-tooltips-pointer-l.png'
						pointerClass = 'pointer-l';
					}else{
						pointerImg = 'etc/designs/panasonic/eccart-clientlibs/images/img-tooltips-pointer-r.png'
						pointerClass = 'pointer-r';
					}
					_html = '<div class="buymenu-tooltips"><div class="buymenu-tooltips-in">'+_content+'</div><div class="tooltips-pointer '+pointerClass+'"><img src="'+pointerImg+'" alt=""></div></div>';
					$(_obj).append(_html);
					var _ttp = $(_obj).find('.buymenu-tooltips');
					_ttp.find('.buymenu-tooltips-in').css({'width': _w+'px', 'max-height': _h+'px'});
					if(_bottom){
						var _objPos = $(_obj).position();
						_ttp.css({'bottom':-1*_bottom+'px'});
						_ttp.find('.buymenu-tooltips-in').css({'max-height':_objPos.top+_bottom+'px'});
						_ttp.find('.tooltips-pointer').css({'bottom':_bottom+'px'});
					}else{
						_ttp.css({'top':-1*_top+'px'});
						_ttp.find('.tooltips-pointer').css({'top':_top+'px'});
					}
					if(pointerClass == 'pointer-l'){
						if($('body').css('direction') !== 'rtl'){
							_ttp.css({'right':-1*(_ttp.outerWidth()-_left)+'px'});
						} else {
							_ttp.css({'left':-1*(_ttp.outerWidth()-_left)+'px'});
						}
					}else{
						if($('body').css('direction') !== 'rtl'){
							_ttp.css({'left':-1*(_ttp.outerWidth()-_left)+'px'});
						} else {
							_ttp.css({'right':-1*(_ttp.outerWidth()-_left)+'px'});
						}
					}
					_ttp.show();
				}
				function baloonHide(_obj){
					$(_obj).css('z-index',0);
					$(_obj).find('.buymenu-tooltips').remove();
				}
				/* add start */
				_bw.trigger('buymenushow.ec');
				/* add end */
			}
		}
	}
	
	var Usercart = new usercart();
	Usercart.init();
});