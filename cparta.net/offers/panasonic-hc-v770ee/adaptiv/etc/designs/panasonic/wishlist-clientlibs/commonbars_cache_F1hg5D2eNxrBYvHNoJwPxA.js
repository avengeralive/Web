;(function($){
	$.fn.hasWishlist = function(){
		$.each(this, function(){
			var $wishlist = $(this);
			if($wishlist.data('items')>0){
				$wishlist.addClass('added');
			} else {
				$wishlist.removeClass('added');
			}
		});
	};
	function initializeWishlist(){
		var $addwishlist = $('#browsebar-utils .addWishlist');
		var $wishlist = $('#userbar .wishlist');
		$wishlist.hasWishlist();
		$wishlist.children('a').on({
			click : function(e){
				if($(this).closest('.disabled-wishlist').length){
					e.preventDefault();
				}
			}
		});
		$addwishlist.children('a').on({
			click : function(e){
				e.preventDefault();
				if(!$(this).closest('.disabled-wishlist').length){
					var firsttime = ($wishlist.data('items') === 0) ? true : false;
					$(this).addClass('clicked');
					if($addwishlist.hasClass('added')){
						$addwishlist.removeClass('added');
						$wishlist.data('items',$wishlist.data('items') -1).removeClass('addedThis');
					} else {
						if($wishlist.data('items') < $wishlist.data('max-items')){
							$addwishlist.addClass('added');
							$wishlist.data('items',$wishlist.data('items') +1).addClass('addedThis');
						} else {
							$.wishlistPopupOpen($('#wishlist-max-popup-data'));
							return;
						}
					}
					//mobile
					if($('#page').css('min-width')==='320px' && firsttime){
						$(window).scrollTo(0,{
							duration: 500,
							easing: 'easeOutExpo',
							offset: { 'left':0, 'top':0}
						});
					}
					//
					$wishlist.find('.wishlist-tooltips').show().delay(2000).fadeOut(500);
					$wishlist.hasWishlist();
				}
			},
			mouseleave : function(e){
				$(this).removeClass('clicked');
			}
		});
		
		$(document).on('click', '.wishlist-button a', function(e){
			e.preventDefault();
			var $parent = $(this).closest('.wishlist-button');
			if(!$(this).closest('.disabled-wishlist').length){
				var firsttime = ($wishlist.data('items') === 0) ? true : false;
				if($parent.hasClass('added')){
					$parent.removeClass('added');
					$wishlist.data('items',$wishlist.data('items') -1).removeClass('addedThis');
				} else {
					if($wishlist.data('items') < $wishlist.data('max-items')){
						$parent.addClass('added');
						$wishlist.data('items',$wishlist.data('items') +1).addClass('addedThis');
					} else {
						$.wishlistPopupOpen($('#wishlist-max-popup-data'));
						return;
					}
				}
				$(this).addClass('clicked');
				//mobile
				if($('#page').css('min-width')==='320px' && firsttime){
					$(window).scrollTo(0,{
						duration: 500,
						easing: 'easeOutExpo',
						offset: { 'left':0, 'top':0}
					});
				}
				// tooltips
				$wishlist.find('.wishlist-tooltips').show().delay(2000).fadeOut(500);
				$wishlist.hasWishlist();
			}
		}).on('mouseleave blur', '.wishlist-button a' ,function(e){
			if(e.type === 'mouseleave'){
				$(this).blur();
			}
			$(this).removeClass('clicked');
		});
	}
	
	//wishlistPopupOpen
	$.wishlistPopupOpen = function(data, box){
		var popup_content = $(data).clone();
		focusedElementBeforeModal = jQuery(':focus');
		overlaysetPopup();
		$('#lightbox-overlay-popup').append('<div id="wl-popupwindow-wrapper"><div id="wl-popupwindow-bg"><a href="#" class="btn-close"><img src="/etc/designs/panasonic/common-clientlibs/images/btn-lightbox-close.png" alt="'+popup_content.data('alt-close')+'"></a><div id="wl-popupwindow"><div class="scrlbox">'+popup_content.html()+'</div></div><span id="popupFocusend" tabindex="0"></span></div></div>');
		$('#popupFocusend').on('focus', function(e){
			$('#wl-popupwindow-wrapper').find(':focusable').eq(0).focus();
		});
		var popup_wrapper = $('#wl-popupwindow-wrapper');
		var btnClose = popup_wrapper.find('.btn-close');
		btnClose.click(function(e) {
			closeBox();
			e.preventDefault();
		});
		setupLightBoxContainer();
		function setupLightBoxContainer(){
			$('#lightbox-overlay-popup').fadeIn({
				complete : function(){
					sizeSetting(popup_wrapper);
					if(!$('html').hasClass('touch-device')){
						setInitialFocusModal($(this));
						$(this).keydown(function(event){trapTabKey($(this),event);});
					}
					//remove box
					if(typeof box !== 'undefined'){
						popup_wrapper.find('.btn-remove').on('click', function(e){
							e.preventDefault();
							$(box).removeBox();
							closeBox();
						});
					}
				}
			});
		}
		function closeBox(){
			$('#lightbox-overlay-popup').fadeOut(function(){
				overlayRemovePopup();
				focusedElementBeforeModal.focus();
			});
		}
		function sizeSetting(box){
			var _box = box;
			var _wSctop = $(window).scrollTop();
			var _hbH = 0;
			var _bgBox = $(_box).find('#wl-popupwindow-bg');
			var _scrlBox = $(_box).find('.scrlbox');
			var _scrlBoxApi;
			resetSize(_hbH);
			$(window).on('resize', function(e){
				resetSize(_hbH);
			});
			function resetSize(_gp){
				var _ww = $('body').width();
				var _wh = window.innerHeight ? window.innerHeight : $(window).height();
				var _ua = window.navigator.userAgent.toLowerCase();
				if($('#page').css('min-width') !== '320px'){
					//position
					$(_box).height(_wh-100);
					$(_box).css({'left':_ww/2-$(_box).width()/2 +'px', 'top':_wSctop + 50+'px'});
					if(_scrlBox.height() >= _wh-100){
						_bgBox.css({'margin-top':0, 'height':'100%'}).children('div').filter(function(){
							if(typeof _scrlBoxApi === 'undefined'){
								$(this).css('overflow','auto');
							}
						});
					}else{
						_bgBox.css({'margin-top':($(_box).height() - _bgBox.height())/2+'px', 'height':'auto'}).children('div').css('overflow','hidden');
						$('#wl-popupwindow.jspScrollable').height(_scrlBox.height());
					}
				}else{
					//position
					_bgBox.css('height', '');
					_scrlBox.css('height', '');
					$(_box).outerHeight(_wh);
					$(_box).css({'top':_wSctop + 'px'});
					if(_scrlBox.children().outerHeight() > _scrlBox.parent().height()){
						_scrlBox.height(_scrlBox.parent().height());
					} else {
						_bgBox.css('height', 'auto');
					}
				}
			}
		}
	};
	function overlaysetPopup(_fix){
		var fix = _fix || 'fix';
		$('body').addClass('lightbox-lock');
		$('body').append('<div id="lightbox-overlay-popup"><div id="lightbox-bgcolor-popup"></div></div>');
		setWH();
		if(fix=='fix'){
			$('#lightbox-bgcolor-popup').on('mousewheel', function(e){
				e.preventDefault();
			});
		}
		if($('html').hasClass('touch-device') && fix=='fix'){
			$('#lightbox-bgcolor-popup, #modalwindow-popup *').on('touchmove',function(e){
				e.preventDefault();
			});
			if(navigator.userAgent.indexOf("Android 2") == -1){
				var sctop = $(window).scrollTop();
				$(window).on('scroll', {top:sctop} ,overlayFixPopup);
			}else{
				$('body').on('touchmove',function(e){e.preventDefault();});
			}
		}
		$(window).bind('resize',function(e){
			setWH();
		});
		function setWH(){
			var _h = Math.max($(window).height(),$('body').height());
			var _w = $('body').width();
			$('#lightbox-bgcolor-popup').css({'height':_h+'px', 'width':_w+'px'});
		}
	}
	function overlayFixPopup(event){
		$(window).scrollTop(event.data.top);
	}
	function overlayRemovePopup(){
		if($('html').hasClass('touch-device')){
			$(window).off('scroll', overlayFixPopup);
			$('body').off('touchmove');
		}
		$('body').removeClass('lightbox-lock').css('top','auto');
		$('#lightbox-overlay-popup').remove();
	}

	if ('GwcCommon' in window && 'storageData' in GwcCommon) {
		GwcWishlistUtils = {
			getWishlistData: function() {
				var $d_wishlistMsg = $.Deferred();
				GwcCommon.storageData(GwcWishlistUtils._storageKey()).then(
					// success
					function(value) {
						var wishlistData = new Hashtable();

						if (!!value) {
							$.each(JSON.parse(value), function(i, v) {
								wishlistData.put(v.product_page_path, v);
							});
						}
						$d_wishlistMsg.resolve(wishlistData);
					},
					// error
					function(value) {
						var msg = 'error';
						if (!!value) {
							var receiveValue = JSON.parse(value);
							if ('message' in receiveValue) {
								msg = receiveValue.message;
							}
						}
						$d_wishlistMsg.reject(msg);
					});
				return $d_wishlistMsg.promise();
			},
			addToWishlist: function(wishItem) {
				var $d_addWishlistMsg = $.Deferred();
				if (!_.isObject(wishItem) || !(_.has(wishItem, 'product_page_path') && _.has(wishItem, 'added_date_time') && _.has(wishItem, 'model_number'))) {
					return $d_addWishlistMsg.reject('invalid wishItem').promise();
				}

				this.getWishlistData().done(function(wishlistData) {
					if (!!wishlistData) {
						wishlistData.put(wishItem.product_page_path, wishItem);
					}
					GwcCommon.storageData(GwcWishlistUtils._storageKey(), GwcWishlistUtils._convertSendData(wishlistData)).done(function(value) {
						$d_addWishlistMsg.resolve(wishlistData);
					}).fail(function(value) {
						var msg = 'error';
						if (!!value) {
							var receiveValue = JSON.parse(value);
							if ('message' in receiveValue) {
								msg = receiveValue.message;
							}
						}
						$d_addWishlistMsg.reject(msg);
					});

				}).fail($d_addWishlistMsg.reject);
				return $d_addWishlistMsg.promise();
			},
			removeFromWishlist: function(key) {
				var $d_removeWishlistMsg = $.Deferred();
				if (_.isEmpty(key)) {
					return $d_removeWishlistMsg.reject('invalid key').promise();
				}

				this.getWishlistData().done(function(wishlistData) {
					if (!!wishlistData) {
						wishlistData.remove(key);
					}
					GwcCommon.storageData(GwcWishlistUtils._storageKey(), GwcWishlistUtils._convertSendData(wishlistData)).done(function(value) {
						$d_removeWishlistMsg.resolve(wishlistData);
					}).fail(function(value) {
						var msg = 'error';
						if (!!value) {
							var receiveValue = JSON.parse(value);
							if ('message' in receiveValue) {
								msg = receiveValue.message;
							}
						}
						$d_removeWishlistMsg.reject(msg);
					});

				}).fail($d_removeWishlistMsg.reject);
				return $d_removeWishlistMsg.promise();
			},
			_storageKey: function() {
				// LocalStorage key
				var $langData = $('#language-data');
				return 'wishlist_' + $langData.attr('cnty') + '_' + $langData.find('tr[data-selected="true"]').attr('path');
			},
			_convertSendData: function(wishlistData) {
				var sendStorageData = null;
				if (!!wishlistData) {
					var wishlistArray = [];
					wishlistData.each(function(key, value) {
						wishlistArray.push(_.pick(value, 'product_page_path', 'added_date_time', 'model_number'));
					});
					sendStorageData = JSON.stringify(wishlistArray);
				}
				return sendStorageData;
			},
			getCurrentDateTime: function() {
				var currDate = new Date();
				var hms = $.map([currDate.getHours(),currDate.getMinutes(),currDate.getSeconds()],function(value){
					var timeStr = value.toString();
					return timeStr.length < 2 ? '0' + timeStr : timeStr;
				}).join(':');
				return $.datepicker.formatDate('yy-mm-dd', currDate) + ' ' + hms;
			},
			/*
			 *  Utility of addition and deletion for list.
			 *  @param options below it.
			 *    path: target path.
			 *    model_number: target model number.
			 *    max: max item count.
			 *    added: callback for after the addition process. arguments are wishlist data.
			 *    removed: callback for after the deletion process. arguments are wishlist data.
			 */
			wishlistRegister: function(options) {
				var opts = $.extend({
					path: '',
					model_number: '',
					max: 0
				}, options);
				GwcWishlistUtils.getWishlistData().done(function(wishlistData) {
					if (wishlistData.containsKey(opts.path)) {
						GwcWishlistUtils.removeFromWishlist(opts.path).done(function() {
							wishlistData.remove(opts.path);
							if ($.isFunction(opts.removed)) {
								opts.removed.call(null, wishlistData);
							}
						});
					} else if(wishlistData.size() < opts.max) {
						var addItem = {
							product_page_path: opts.path,
							added_date_time: GwcWishlistUtils.getCurrentDateTime(),
							model_number: opts.model_number
						};
						GwcWishlistUtils.addToWishlist(addItem).done(function(){
							wishlistData.put(opts.path, addItem);
							if ($.isFunction(opts.added)) {
								opts.added.call(null, wishlistData);
							}
						});
					}
				});
			}
		};
	}
	$(function(){
		if ('GwcWishlistUtils' in window) {
			if ('GwcCommon' in window && 'isCookieUsable' in GwcCommon && !GwcCommon.isCookieUsable()) {
				$('#page').addClass('disabled-wishlist');
				initializeWishlist();
				return;
			}
			var path = document.location.pathname.replace(/(\..*|\/)$/, '');
			var $addwishlist = $('#page:not(.disabled-wishlist) #browsebar-utils .addWishlist');
			var $wishlist = $('#userbar .wishlist');

			// initial click event for addwishlist
			$addwishlist.children('a').on('click', function(e){e.preventDefault();}).addClass('clicked');

			var refreshWishlistIcon = function(wishlistData) {
				$wishlist.data('items', wishlistData.size()).hasWishlist();
				// Update addWishlist icon alt.
				var altText = wishlistData.containsKey(path) ? $('.wishlist-tooltips .text.remove', $addwishlist).text() : $('.wishlist-tooltips .text.add', $addwishlist).text();
				$('.icn > img', $addwishlist).attr('alt', altText);
			};

			$addwishlist.children('a').removeClass('clicked').on('click', function(e){
				e.preventDefault();

				GwcWishlistUtils.getWishlistData().done(function(wishlistData) {
					if (wishlistData.containsKey(path)) {
						GwcWishlistUtils.removeFromWishlist(path).done(function(){
							wishlistData.remove(path);
							refreshWishlistIcon(wishlistData);
						});
						
					} else if(wishlistData.size() < $wishlist.data('max-items')) {
						var addItem = {
							product_page_path: path,
							added_date_time: GwcWishlistUtils.getCurrentDateTime(),
							model_number: $.trim($('#hero-main .keycopy .extra-logo1 .typenum').text())
						};
						GwcWishlistUtils.addToWishlist(addItem).done(function(){
							wishlistData.put(path, addItem);
							refreshWishlistIcon(wishlistData);
						});
					}
				});
			});

			GwcWishlistUtils.getWishlistData().done(function(wishlistData) {

				if (wishlistData.containsKey(path)) {
					$addwishlist.addClass('added');
				}

				refreshWishlistIcon(wishlistData);
				initializeWishlist();

			});
		} else {
			initializeWishlist();
		}
	});
})(jQuery);