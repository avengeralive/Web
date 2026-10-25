;(function($){
	$.fn.scene7TumbsSlider = function(_scene,_options){
		$.each(this, function(index, value){
			var opts = $.extend({}, $.fn.scene7TumbsSlider.defaults, _options);
			var carousel = $(this);  
			var children =  carousel.children();
			var container = carousel.parent().parent();
			var sceneMain = $(_scene);
			setUp();
			function setUp(){
				carousel.carouFredSel({
					prev: container.find('.prev'),
					next: container.find('.next'),
					auto: false,
					height : 'auto',
					infinite: false,
					circular: false,
					align : 'center',
					swipe : {
						onMouse : false,
						onTouch : false
					},
					scroll : {
						onEnd : function(data){
						}
					},
					onCreate: function(data){
						if(carousel.triggerHandler("configuration",'items.visible') > children.length){
							carousel.width('auto').css({'position' : 'relative', 'text-align':'center'});
						}
						touchSwipe();
						carousel.children().each(function(index, element){
							$(this).on('click tap', this, function(e){
								$(this).addClass('selected');
								$(this).siblings().removeClass('selected');
								if($('#page').css('min-width') != '320px'){
									$('#hero.scene7 .hero-inner').animate({height:'597px'},{duration:300, complete:function(){
										$('#hero.scene7,#hero.scene7 .hero-inner').css('min-height','597px');
									}});
								}
								var $thumb = $(this);
								var $scene7Section = $('#hero.scene7 .scene7-section');
								if (!sceneMain.is(':visible')) {
									/* add start scsk */
									if($('#page').css('min-width') != '320px'){
									/* add end scsk */
										sceneMain.fadeIn(300, function() {
											var $s7MainWrapper = $('#hero.scene7 .scene7Main-wrapper');
											$scene7Section.multiMediaView('resizeContainer', $s7MainWrapper.width(), $s7MainWrapper.height() - carousel.height());

											$('.s7container .s7slider .slide-block .youtube-placeholder.youku-player', $scene7Section).each(function() {
												YouTubeUtils.switchVisibleYkuPlayerIframe(this);
											});

											$scene7Section.multiMediaView('selectViewByThumb', $thumb, true);

										});
									/* add start scsk */
									} else {
										sceneMain.show();
										holderSize();
										$scene7Section.multiMediaView('fullscreenContainer', function() {
											$scene7Section.multiMediaView('selectViewByThumb', $thumb, true);
										});
										$('.s7container .s7slider .slide-block .youtube-placeholder.youku-player', $scene7Section).each(function() {
											YouTubeUtils.switchVisibleYkuPlayerIframe(this);
										});
									/* add end scsk */
										$scene7Section.multiMediaView('showIconEffect', $thumb.data('$slide_block'));
									}
								/* add start scsk */
								} else {
									$scene7Section.multiMediaView('selectViewByThumb', $thumb);
								}
								/* add end scsk */
								e.preventDefault();
							});
						});
						sceneMain.find('.s7closebutton').on('click', this, function(e){
							e.preventDefault();
							carousel.children().removeClass('selected');
							if($('#page').css('min-width') != '320px'){
								$('#hero.scene7,#hero.scene7 .hero-inner').css('min-height','560px');
								$('#hero.scene7 .hero-inner').animate({height:'560px'},{duration:300});
							}
							sceneMain.fadeOut(300, function(){
							});
							// e.preventDefault();
						});
						if($('#page').css('min-width') == '320px'){
							$(window).on('resize orientationchange', function(e){
								if (carousel.is(':visible')) {
									carousel.trigger('configuration', ['items', 'variable']);
									carousel.trigger('updateSizes');
									if(carousel.triggerHandler("configuration",'items.visible') > children.length){
										carousel.width('auto').css({'position' : 'relative', 'text-align':'center'});
									}else{
										carousel.css({'position' : 'absolute', 'text-align':'left'});
									}
								}
							});
						}
					}
				});
				function touchSwipe(){
					if ("ontouchstart" in window) {
						var startX = 0;
						var endX = 0;
						var _d = 0;
						carousel.on('touchstart',this, function(e){
							_d = 0;
							endX = 0;
							startX = e.originalEvent.touches[0].pageX;
						});
						carousel.on('touchmove',this, function(e){
							endX = e.originalEvent.touches[0].pageX;
						});
						carousel.on('touchend',this, function(e){
							if(endX!=0){
								_d = startX - endX;
								if(_d > 30){
									carousel.trigger('next');
								}
								if(_d < -30){
									carousel.trigger('prev');
								}
							}
						});
					}
				}
				
			}
		});
	};
	$.fn.scene7TumbsSlider.defaults = {
	};
})(jQuery);

/* add start scsk */
(function($){
	$.fn.scene7ViewSlider = function(options) {
		return $(this).each(function() {
			var opts = $.extend({}, $.fn.scene7ViewSlider.defaults, options);
			var carousel = $(this);  
			var $container = $('#hero.scene7 .scene7-section');
			setUp();
			function setUp(){
				carousel.carouFredSel({
					prev: $container.find('.s7slidepreviousbutton'),
					next: $container.find('.s7slidenextbutton'),
					auto: false,
					height : 'auto',
					infinite: false,
					circular: false,
					swipe : {
						onMouse : false,
						onTouch : false
					},
					onCreate: function(data){
						$(window).on('resize', function(e){
							$container.multiMediaView('fullscreenVideoSize', carousel.triggerHandler('currentVisible'));
						});
						if($('#page').css('min-width') == '320px'){
							$(window).on('resize orientationchange', function(e){
								if ($('.scene7Main-section', $container).is(':visible')) {
									$container.multiMediaView('containerMoveToTopLeft');
								}
							});
						}
					},
					scroll: {
						onBefore: function(data){
							YouTubeUtils.stopYoutubeVideos();
							$container.multiMediaView('setAssetForViewer', data.items.visible);
							$container.multiMediaView('fullscreenVideoSize', data.items.visible);
						},
						onAfter: function(data) {
							$container.multiMediaView('setAssetForAroundViewer', data.items.visible);
							$container.multiMediaView('focusToThumbnail', data.items.visible);
							$container.multiMediaView('toggleViewController', data.items.visible);
							$container.multiMediaView('showIconEffect', data.items.visible);
						}
					}
				});
				function touchSwipe(){
					if ("ontouchstart" in window) {
						var startX = 0;
						var endX = 0;
						var _d = 0;
						carousel.on('touchstart',this, function(e){
							_d = 0;
							endX = 0;
							startX = e.originalEvent.touches[0].pageX;
						});
						carousel.on('touchmove',this, function(e){
							endX = e.originalEvent.touches[0].pageX;
						});
						carousel.on('touchend',this, function(e){
							if(endX!=0){
								_d = startX - endX;
								if(_d > 30){
									carousel.trigger('next');
								}
								if(_d < -30){
									carousel.trigger('prev');
								}
							}
						});
					}
				}
			}
		});
	};
	$.fn.scene7ViewSlider.defaults = {
	};
})(jQuery);
/* add end scsk */

jQuery(function($){
	// $('.scene7Thumbs').scene7TumbsSlider('.scene7Main-section');

	// on switch fullscreen event
	var $scene7Section = $('.scene7-section');
	$scene7Section.on('switchfullscreen.gwc', '.s7container', function(e, isFullScreen) {
		var $s7container = $(this);
		var $thumbs = $('.scene7-section .scene7Thumbs-section');
		var $thumbsTab = $('.thumbs-tab', $s7container);
		var $slideButtons = $('.s7slidepreviousbutton, .s7slidenextbutton', $s7container);
		if (isFullScreen) {
			// move thumbnail section to scene7Thumbs-section-wrapper
			$('.scene7Thumbs-section-wrapper', $s7container).append($thumbs);
			$thumbs.show();

			if($('#page').css('min-width') != '320px') {
				thumbsSlideDown(0);

				$s7container.data('fullscreen-init-effect', setTimeout(function() {
					thumbsSlideUp();
					$slideButtons.not('.hover').fadeTo(300, 0);
				}, 2000));
				// fade toggle slide buttons on mouseover at fullscreen
				$slideButtons.each(function() {
					var $slideButton = $(this);
					$slideButton.css('top', ($(window).height() + $slideButton.height()) / 2);
					$slideButton.on('mouseenter', function() {
						$(this).addClass('hover').stop().fadeTo(300, 1);
					}).
					on('mouseleave', function() {
						$(this).addClass('hover').stop().fadeTo(300, 0);
					});
				});

				// fullscreen support for iPad
				if ($('html').is('.no-fullscreen.touch-device')) {
					var $hero = $('#hero');
					$hero.css('cssText', $hero.attr('style') + 'position: relative!important; z-index: 1100!important;');
				}
			} else {
				thumbsSlideUp(0);
			}

		} else {
			if($('#page').css('min-width') != '320px') {
				clearTimeout($s7container.data('fullscreen-init-effect'));
				$thumbs.stop(true, true);
				$slideButtons.fadeTo(0,1).css('top', '').off('mouseenter mouseleave');

				// fullscreen support for iPad
				if ($('html').is('.no-fullscreen.touch-device')) {
					$('#hero').css('position', '').css('zIndex', '');
				}
			} else {
				$('.scene7Main-section', $scene7Section).hide();
			}
			$('.scene7Main-section', $scene7Section).after($thumbs.show());
			thumbsMobileChange();
		}
	});

	if(!$('html').hasClass('touch-device')) {
		// toggle slide thumbnail-section on mouseover at fullscreen
		$scene7Section.find('.scene7Thumbs-section-wrapper').hover(thumbsSlideDown, thumbsSlideUp);
	} else {
		// toggle slide thumbnail-section on tap at fullscreen
		$('.s7container .thumbs-tab', $scene7Section).on('click', function() {
			var $thumbs = $('.scene7Thumbs-section-wrapper .scene7Thumbs-section', $scene7Section);
			if ($thumbs.is(':visible')) {
				thumbsSlideUp();
			} else {
				thumbsSlideDown();
			}
		});
	}

	function thumbsSlideUp(duration) {
		if (typeof(duration) == 'undefined') {
			duration = 300;
		}
		var $thumbs = $('.scene7Thumbs-section-wrapper .scene7Thumbs-section', $scene7Section);
		var $thumbsTab = $('.s7container .thumbs-tab');
		$thumbs.slideUp({
			duration: duration,
			progress: function() {
				$thumbsTab.css('bottom', $thumbs.height() + 'px');
			},
			done: function() {
				$thumbsTab.css('bottom', 0);
			},
			complete :function(){
				$thumbsTab.removeClass('active');
			}
		});
	}

	function thumbsSlideDown() {
		if (typeof(duration) == 'undefined') {
			duration = 300;
		}
		var $thumbs = $('.scene7Thumbs-section-wrapper .scene7Thumbs-section', $scene7Section);
		var $thumbsTab = $('.s7container .thumbs-tab');
		$thumbs.filter(':not(:animated)').slideDown({
			duration: duration,
			start : function(){
				$thumbsTab.addClass('active');
			},
			progress: function() {
				$thumbsTab.css('bottom', $thumbs.height() + 'px');
			},
			done: function() {
				thumbsMobileChange();
				$scene7Section.multiMediaView('focusToThumbnail', $('.s7slider', $scene7Section).triggerHandler('currentVisible'));
			},
		});
	}
	function thumbsMobileChange(){
		if($('#page').css('min-width')=='320px'){
			var carousel = $('.scene7-section .scene7Thumbs-section .scene7Thumbs');
			if (carousel.is(':visible')) {
				carousel.trigger('configuration', ['items', 'variable']);
				carousel.trigger('updateSizes');
				if(carousel.triggerHandler("configuration",'items.visible') > carousel.children().length){
					carousel.width('auto').css({'position' : 'relative', 'text-align':'center'});
				}else{
					carousel.css({'position' : 'absolute', 'text-align':'left'});
				}
			}
		}
	}

});

/*multi-media-controller-thumb-custom.js*/
(function($, root) {

	if (s7sdk) {
		s7sdk.query.params.loglevel = 'SEVERE'; // SEVERE|WARNING|INFO|CONFIG|FINE|FINER|FINEST
		s7sdk.Logger.init();
	}

	if (!root.GwcCommon) {
		root.GwcCommon = {};
	}

	$.extend(root.GwcCommon, {
		MultiMediaViewer: function(root, options) {
			this.$root = $(root);
			this.$container = $('.s7container', this.$root);
			this.$viewSlider = $('.s7slider', this.$container);
			this.$paginator = $('.scene7Thumbs', this.$root);
			this.params = null;
			this.serverurl = null;
			var fixedOptions = {
				class_names: {
					spin: 's7spinview',
					gallery: 's7zoomview',
					s7video: 's7videoplayer'
				}
			};
			this.options = $.extend({}, $.fn.multiMediaView.defaults, options, fixedOptions);
			this.init();
		}
	});

	// class base definitions.
	$.extend(root.GwcCommon.MultiMediaViewer.prototype, {
		/*
		 * include the use components.
		 */
		loadLibs: function() {
			// for common
			s7sdk.Util.lib.include('s7sdk.common.Container');
			s7sdk.Util.lib.include('s7sdk.common.Button');
			if (this.isUseZoomView()) {
				// for zoom view (normal-image)
				s7sdk.Util.lib.include('s7sdk.image.ZoomView');
			}
			if (this.isUseSpinView()) {
				// for spin (360view)
				s7sdk.Util.lib.include('s7sdk.set.SpinView');
			}
			if (this.isUseZoomView() || this.isUseSpinView()) {
				// for navigation view
				s7sdk.Util.lib.include('s7sdk.image.NavigationView');
			}
			if (this.isUseVideoPlayer()) {
				// for spin (360view)
				s7sdk.Util.lib.include('s7sdk.video.VideoPlayer');
			}
			// initialize the SDK
			s7sdk.Util.init();
		},

		/*
		 * define the extended components.
		 */
		defineExtendedComponents: function() {
			if (!s7sdk.common.SlideNextButton) {
				s7sdk.common.SlideNextButton = function SlideNextButton(containerId, settings, compId) {
					s7sdk.Logger.log(s7sdk.Logger.CONFIG, "s7sdk.common.SlideNextButton constructor - containerId: %0, settings: %1 , compId: %2", containerId, settings, compId);
					arguments.callee.superclass.apply(this, [compId, containerId, null, 0, 0, "s7slidenextbutton", settings]);
					this.obj.panObj = this;
				};
				s7sdk.Class.inherits("s7sdk.common.SlideNextButton", "s7sdk.common.Button");
				s7sdk.common.SlideNextButton.prototype.symbols = {
					TOOLTIP: "Next"
				};
				s7sdk.SlideNextButton = s7sdk.common.SlideNextButton;
				(function addDefaultCSS() {
					s7sdk.common.Button.buttonsDefaultCSS("SlideNextButton", ".s7slidenextbutton", ["scroll_right_up.png", "scroll_right_over.png", "scroll_right_down.png", "scroll_right_disabled.png"], s7sdk.Util.css.createCssRuleText(".s7slidenextbutton", {
						width: "20px",
						height: "20px"
					}));
				})();
			}
			if (!s7sdk.common.SlidePreviousButton) {
				s7sdk.common.SlidePreviousButton = function SlidePreviousButton(containerId, settings, compId) {
					s7sdk.Logger.log(s7sdk.Logger.CONFIG, "s7sdk.common.SlidePreviousButton constructor - containerId: %0, settings: %1 , compId: %2", containerId, settings, compId);
					arguments.callee.superclass.apply(this, [compId, containerId, null, 0, 0, "s7slidepreviousbutton", settings]);
					this.obj.panObj = this;
				};
				s7sdk.Class.inherits("s7sdk.common.SlidePreviousButton", "s7sdk.common.Button");
				s7sdk.common.SlidePreviousButton.prototype.symbols = {
					TOOLTIP: "Previous"
				};
				s7sdk.SlidePreviousButton = s7sdk.common.SlidePreviousButton;
				(function addDefaultCSS() {
					s7sdk.common.Button.buttonsDefaultCSS("SlidePreviousButton", ".s7slidepreviousbutton", ["scroll_left_up.png", "scroll_left_over.png", "scroll_left_down.png", "scroll_left_disabled.png"], s7sdk.Util.css.createCssRuleText(".s7slidepreviousbutton", {
						width: "20px",
						height: "20px"
					}));
				})();
			}
			if (s7sdk.ItemDescType) {
				$.extend(s7sdk.ItemDescType, {
					CUSTOM_SPIN_SET: (s7sdk.ItemDescType.SPIN_SET | s7sdk.ItemDescType.EMPTY),
					CUSTOM_VIDEO: (s7sdk.ItemDescType.VIDEO | s7sdk.ItemDescType.EMPTY)
				});
			}
		},

		/*
		 * initialize.
		 */
		init: function() {

			this.loadLibs();

			this.serverurl = this.$container.data('serverurl');
			if (this.serverurl) {
				this.serverurl = this.serverurl.replace(/^:?\/\//, document.location.protocol + '//');
			}
			this.videoserverurl = this.$container.data('videoserverurl');
			if (this.videoserverurl) {
				this.videoserverurl = this.videoserverurl.replace(/^:?\/\//, document.location.protocol + '//');
			}
			this.$d_containerReady = $.Deferred();
			this.$d_componentsReady = $.Deferred();
			// create ParameterManager instance that will handle modifiers
			this.params = new s7sdk.ParameterManager();
			// the ParameterManager will dispatch SDK_READY when all modifiers have been processed
			// and it is safe to initalize the viewer
			this.params.addEventListener(s7sdk.Event.SDK_READY, this.initViewers.bind(this), false);
			// now it is safe to process the modifiers, the callbacks have been defined
			// this will trigger the SDK_READY event
			this.params.init();
		}, // end init

		/*
		 * initialize the viewers and thumbnails.
		 */
		initViewers: function() {
			var self = this;
			// define extended components
			self.defineExtendedComponents();

			// global param settings
			self.params.push("serverurl", self.serverurl);
			if (self.videoserverurl) {
				self.params.push("videoserverurl", self.videoserverurl);
			}
			// self.params.push("stagesize", self.$container.width() + ",100");
			self.params.push("stagesize", self.$container.width() + "," + self.$container.height());
			// self.params.push("iconeffect", (($('#page').css('min-width') == '320px') ? '1' : '0') + ',-1,0.3,0');
			// self.params.push("iconeffect", ($('#page').css('min-width') == '320px') ? '1' : '0');
			self.params.push("iconeffect", '0');

			if (this.isUseSpinView()) {
				// spin view params
				// for Example
				// self.params.push("SpinView.fmt","png-alpha");
				// self.params.push("SpinView.singleclick", "zoomReset"); //none|zoom|reset|zoomReset
				// self.params.push("SpinView.doubleclick", "reset"); //none|zoom|reset|zoomReset
				$.each(self.options.component_params.spin_view, function(key, val){
					self.params.push("SpinView." + key, val);
				});
			}
			if (this.isUseZoomView()) {
				// zoom view params
				// for Example
				// self.params.push("ZoomView.fmt","png-alpha");
				// self.params.push("ZoomView.resizable", "0");
				// self.params.push("ZoomView.zoomstep", "2,1");
				// self.params.push("ZoomView.frametransition", "none"); //none|fade|slide[,duration[,spacing]]
				// self.params.push("ZoomView.singleclick", "zoomReset"); //none|zoom|reset|zoomReset
				// self.params.push("ZoomView.doubleclick", "reset"); //none|zoom|reset|zoomReset
				$.each(self.options.component_params.zoom_view, function(key, val){
					self.params.push("ZoomView." + key, val);
				});
			}
			if (this.isUseSpinView() || this.isUseZoomView()) {
				// navigation view params
				self.params.push("NavigationView.iscommand", self.options.image_presets.nav_view); //none|zoom|reset|zoomReset
				self.params.push("NavigationView.fmt","png-alpha");
			}
			if (this.isUseVideoPlayer()) {
				// navigation view params
				// for Example
				// self.params.push("VideoPlayer.autoplay", self.options.component.video_player.autoplay); //0|1
				// self.params.push("VideoPlayer.playback", self.options.component.video_player.playback); //auto|native[,0|1]
				// self.params.push("VideoPlayer.singleclick", self.options.component.video_player.singleclick); //none|playPause
				$.each(self.options.component_params.video_player, function(key, val){
					self.params.push("VideoPlayer." + key, val);
				});
			}

			// create Container component
			self.createContainer();

			// load assets
			self.loadAssets().done(function($s7assets) {
				// create slide-content
				self.createAssetSlideContents($s7assets);
				// create viewer slider
				self.$viewSlider.scene7ViewSlider();
				// create the control components for s7sdk viewer
				self.createViewControlComponents();
				if (self.hasSlider()) {
					// create thumbnail slider
					self.$paginator.scene7TumbsSlider('.scene7Main-section');

					if (self.isUseSpinView() || self.isUseZoomView()) {
						// define an event handler function to slide swipe
						var sliderHandler = new s7sdk.InputController(self.$viewSlider.get(0), {
							swipeCallback: function (direction) {
								var viewComponent = self.$viewSlider.triggerHandler('currentVisible').data('view_component');
								if (viewComponent) {
									var capabilityState = viewComponent.getCapabilityState();
									if(capabilityState.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_OUT
										| s7sdk.SpinCapabilityState.SPIN_EAST
										| s7sdk.SpinCapabilityState.SPIN_NORTH
										| s7sdk.SpinCapabilityState.SPIN_SOUTH
										| s7sdk.SpinCapabilityState.SPIN_WEST)){
										return;
									}
								}
								if (direction == 'left') {
									self.$viewSlider.trigger('next');
								} else if (direction == 'right') {
									self.$viewSlider.trigger('prev');
								}
							},
							dragCallback: function (event, x, y, offsetX, offsetY) {
								var viewComponent = self.$viewSlider.triggerHandler('currentVisible').data('view_component');
								if (viewComponent && viewComponent.handler) {
									var capabilityState = viewComponent.getCapabilityState();
									if(capabilityState.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_OUT
										| s7sdk.SpinCapabilityState.SPIN_EAST
										| s7sdk.SpinCapabilityState.SPIN_NORTH
										| s7sdk.SpinCapabilityState.SPIN_SOUTH
										| s7sdk.SpinCapabilityState.SPIN_WEST)){
										viewComponent.handler.dragCallback(event, x, y, offsetX, offsetY);
									}
								}
							}
						});
						if($('#page').css('min-width') == '320px'){
							sliderHandler.doubleTapCallback = function (event, curX, curY) {
								self.cancelFullscreenContainer();
							};
						}
					}
				}
				self.$d_componentsReady.resolve();
			});

		}, // end initViewers

		/*
		 * create the main container.
		 */
		createContainer: function() {
			if (!this.s7container) {
				var self = this;
				var uniqId = s7sdk.Util.createUniqueId();
				self.$container.attr('id', 'multimedia-container-' + uniqId);

				var $containerParent = self.$container.parent();
				// set id to container parent
				$containerParent.attr('id', self.$container.attr('id') + '-wrapper');

				// create Container component
				self.s7container = new s7sdk.Container($containerParent.attr('id'), self.params, self.$container.attr('id'));

				// define an event handler function to resize the image when the container changes size
				self.s7container.addEventListener(s7sdk.event.ResizeEvent.COMPONENT_RESIZE, function(event) {
					// only when s7container resized
					if((typeof(event.target) == 'undefined') || (event.target == self.s7container.obj)) {
						s7sdk.Logger.log(s7sdk.Logger.INFO, "EVENT - onContainerResize width: %0 - height: %1", event.s7event.w, event.s7event.h); 
						$('.slide-block', self.$viewSlider).each(function() {
							$(this).css({width: event.s7event.w + 'px', height: event.s7event.h + 'px'});
							var viewComponent = $(this).data('view_component');
							if (viewComponent) {
								viewComponent.resize(event.s7event.w, event.s7event.h);
							}
						});
						if ($('.scene7Main-section', self.$root).is(':visible')) {
							self.$viewSlider.trigger('configuration', ['items', 1]);
							self.$viewSlider.trigger('updateSizes');
						}
						if($('#page').css('min-width')=='320px' && self.s7container.isFullScreen()){
							if (self.$paginator.is(':visible')) {
								self.$paginator.trigger('configuration', ['items', 'variable']);
								self.$paginator.trigger('updateSizes');
								if(self.$paginator.triggerHandler("configuration",'items.visible') > self.$paginator.children().length){
									self.$paginator.width('auto').css({'position' : 'relative', 'text-align':'center'});
								}else{
									self.$paginator.css({'position' : 'absolute', 'text-align':'left'});
								}
							}
						}
						self.fullscreenVideoSize(self.$viewSlider.triggerHandler('currentVisible'));
					}
				}, false);

				// define an event handler function to update the fullscreen switched
				self.s7container.addEventListener(s7sdk.event.ResizeEvent.FULLSCREEN_RESIZE, function(event) {
					s7sdk.Logger.log(s7sdk.Logger.INFO, "EVENT - onContainerFullScreen isFullScreen: %0", self.s7container.isFullScreen()); 

					if (self.s7fullScreenButton) {
						self.s7fullScreenButton.setSelected(self.s7container.isFullScreen());
					}
					if($('html').hasClass('touch-device')){
						if (self.s7container.isFullScreen()) {
							//$(window).scrollTop(0);
							$(self.s7container.obj).attr('mode', 'fullscreen');
						} else {
							$(self.s7container.obj).removeAttr('mode');
						}
					}

					$(self.s7container.obj).trigger('switchfullscreen.gwc', self.s7container.isFullScreen());
				}, false);
				self.$d_containerReady.resolve();
			}
		}, // end createContainer

		/*
		 * load the assets information by ajax.
		 */
		loadAssets: function() {
			var self = this;
			var $s7assets = $('.s7-asset', self.$container);
			// Deferred object for gets asset ajax response.
			var $d_contentProcess = $.Deferred();
			if ($s7assets.size() <= 0) {
				return $d_contentProcess.resolve($s7assets).promise();
			}
			var responseCnt = 0;
			var assetCount = $s7assets.size();
			$d_contentProcess.progress(function() {
				responseCnt++;
				if (responseCnt >= assetCount) {
					$d_contentProcess.resolve($s7assets);
				}
			});

			var isReq = new s7sdk.IS();
			// gets ssset contents
			$s7assets.each(function(i) {
				var $s7asset = $(this);
				var assetName = $s7asset.data('asset');
				if (assetName) {
					var reqUrl = self.serverurl + assetName + '@req=set,json,UTF-8';
					if (self.$container.data('testing')) {
						reqUrl += '&cache=validate';
					}

					isReq.getHttpReq(reqUrl,
						function(json, jsonId) {
							$s7asset.data('asset_desc', s7sdk.MediaSetParser.parse(json.set));
							$d_contentProcess.notify();
						},
						function(response) {
							s7sdk.Logger.log(s7sdk.Logger.WARNING, "s7sdk.set.MediaSet.requestError - response: %0", JSON.stringify(response));
							$d_contentProcess.notify();
						}
					);
				} else {
					var itemDescType = null;
					switch ($s7asset.data('type')) {
						case 'hmx':
							itemDescType = s7sdk.ItemDescType.CUSTOM_SPIN_SET;
							break;

						case 'video':
							itemDescType = s7sdk.ItemDescType.CUSTOM_VIDEO;
							break;

						default:
							break;
					}
					$d_contentProcess.notify();
				}
			});
			return $d_contentProcess.promise();
		}, // end loadAssets

		/*
		 * Create the slide-content for view component.
		 */
		createAssetSlideContents: function($s7assets) {
			var self = this;
			var createAssetSlideContentsImpl = function($s7asset, assetIdx, itemDesc, thumbIdx) {
				var $slideBlock = null;
				var $slideContent = null;
				if (self.hasSlider()) {
					var thumbSrc = null;
					if ($s7asset.data('thumb')) {
						thumbSrc = $s7asset.data('thumb');
					} else if (itemDesc.name) {
						var optionList = [self.options.image_presets.thumb, $.param(self.options.params.thumb)];
						thumbSrc = self.serverurl + itemDesc.name + '?' + _.chain(optionList).compact().join('&').value();
					}
					if ($s7asset.parent().is(':not(.slide-block)')) {
						$slideBlock = $($.trim(_.template($('.slide-block-template', self.$root).html(), {
							asset_type: $s7asset.data('type'),
							asset_name: itemDesc.name,
							thumb_src: thumbSrc,
							component_class: self.options.class_names[$s7asset.data('type')]
						})));

						self.$viewSlider.append($slideBlock);
					} else {
						$slideBlock = $s7asset.parent();
					}
					$slideContent = $slideBlock.find('.slide-content');
				} else {
					$slideBlock = $s7asset;
					$slideContent = $s7asset;
				}
				$slideBlock.data({
					item_desc: itemDesc
				});
				// set to slide-content id
				var slideContentId = self.$container.attr('id') + '-asset-' + assetIdx + '-' + thumbIdx;
				$slideContent.attr('id', slideContentId);
				$slideBlock.data('view_component', self.createViewComponent(slideContentId, $s7asset.data('type')));
			};

			// loop s7assets
			$s7assets.each(function(assetIdx) {
				var $s7asset = $(this);
				var assetDesc = $s7asset.data('asset_desc');

				if (assetDesc) {
					switch(assetDesc.type) {
						case s7sdk.ItemDescType.IMAGE_SET:
							// expand MediaSetDesc items
							$.each(assetDesc.items, function(thumbIdx, item){
								var mediaDesc = new s7sdk.MediaSetDesc(null, 0, assetDesc.type, assetDesc.name);
								var imgDesc = new s7sdk.ImageDesc(
									mediaDesc,
									item.type, item.name, item.swatch,
									item.width, item.height, item.version,
									item.isDefault, item.mod, item.pmod, item.label,
									null, null, null,
									(item.maps && item.maps.length),
									false, true
								);
								mediaDesc.items.push(imgDesc);
								createAssetSlideContentsImpl($s7asset, assetIdx, imgDesc, thumbIdx);
							});
							break;

						case s7sdk.ItemDescType.SPIN_SET:
							createAssetSlideContentsImpl($s7asset, assetIdx, assetDesc, 0);
							break;

						case s7sdk.ItemDescType.VIDEO:
							createAssetSlideContentsImpl($s7asset, assetIdx, _.first(assetDesc.items), 0);
							break;

						case s7sdk.ItemDescType.VIDEO_SET:
							createAssetSlideContentsImpl($s7asset, assetIdx, assetDesc, 0);
							break;

						default:
							break;
					}
				}
			});
			this.createThumbs();
		},

		/*
		 * Create the s7sdk view component.
		 */
		createViewComponent: function(slideContentId, assetType) {
			var self = this;
			// set to component tag id
			var componentTagId = slideContentId + '-viewer';
			$('#' + slideContentId).find('.' + self.options.class_names[assetType]).attr('id', componentTagId);

			// deferred of asset loaded
			var $d_firstAssetLoaded = $.Deferred();

			var viewComponent = null;
			var events = {
				assetChanged: null,
				notifyZoomNRegion: null,
				notifyCapabilityState: null
			};
			switch(assetType) {
				case 'gallery':
					viewComponent = new s7sdk.ZoomView(slideContentId, self.params, componentTagId);
					viewComponent.$d_firstAssetLoaded = $d_firstAssetLoaded.promise();

					$.extend(events, {
						assetChanged: s7sdk.AssetEvent.ASSET_CHANGED,
						notifyZoomNRegion: s7sdk.event.ZoomRgnEvent.NOTF_ZOOM_NRGN,
						notifyCapabilityState: s7sdk.event.CapabilityStateEvent.NOTF_ZOOM_CAPABILITY_STATE
					});
					break;
				case 'spin':
					viewComponent = new s7sdk.SpinView(slideContentId, self.params, componentTagId);
					viewComponent.$d_firstAssetLoaded = $d_firstAssetLoaded.promise();


					// define an event handler function to update the NavigationView each time the ZoomView
					viewComponent.addEventListener(s7sdk.event.CapabilityStateEvent.NOTF_SPIN_CAPABILITY_STATE, function(event) {
						// s7sdk.Logger.log(s7sdk.Logger.INFO, "EVENT - onZoomChange zoomRgn: %0", event.s7event.zoomRgn);
						if (event.s7event.state.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_OUT)) {
							if (event.s7event.state.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_IN_CONT)) {
								$(viewComponent.obj).attr('cursortype', 'zoomin');
							} else {
								$(viewComponent.obj).attr('cursortype', 'reset');
							}
						} else {
							$(viewComponent.obj).removeAttr('cursortype');
						}
					}, false);

					$.extend(events, {
						assetChanged: s7sdk.AssetEvent.ASSET_CHANGED,
						notifyZoomNRegion: s7sdk.event.ZoomRgnEvent.NOTF_ZOOM_NRGN,
						notifyCapabilityState: s7sdk.event.CapabilityStateEvent.NOTF_SPIN_CAPABILITY_STATE
					});

					var $spinSliderUI = $('.s7spinsliderUI', viewComponent.obj).hide();
					$.when(viewComponent.$d_firstAssetLoaded).done(function() {
						// setup the spin slider
						$spinSliderUI.show().s7spinsliderUI();

						// update the option
						var $spinSlider = $('.angle_scroll', $spinSliderUI);
						var frameLength = viewComponent.getFramesLength();
						var spinStep = Math.floor(360 / frameLength);
						var centerIndex = Math.ceil(frameLength / 2);
						var max = 360 - (360 % spinStep);
						var defaultValue = spinStep * centerIndex;
						$spinSlider.slider("option", {
							max: max,
							step: spinStep,
							value: defaultValue
						}).data('bySlide', true);
						$spinSlider.on('slide', function(event, ui) {
							// shift the starting point value to intermediate, and inverse the frame index
							// var frame = Math.abs(((ui.value + defaultValue) % 360 / spinStep) - frameLength) % frameLength;
							var frame = Math.abs((ui.value / spinStep) - centerIndex - frameLength) % frameLength;
							$spinSlider.data('bySlide', true);
							viewComponent.setCurrentFrameIndex(frame);
						});

						// Adding custom event listener for Spin
						viewComponent.addEventListener(s7sdk.AssetEvent.ASSET_CHANGED, function(event) {
								var frameIndex = viewComponent.getCurrentFrameIndex();
								var currVal = $spinSlider.slider('value') % max;
								var newVal = Math.abs((((frameIndex + Math.floor(frameLength / 2)) * spinStep) % max) - max) % max;
								if (!$spinSlider.data('bySlide')) {
									$spinSlider.slider('value', newVal);
								}
								self.s7naviview.setItem(event.s7event.asset);
						}, true);

						// Adding custom event listener for Spin
						viewComponent.addEventListener(s7sdk.event.UserEvent.NOTF_USER_EVENT, function(event) {
							if (event.s7event.trackEvent == s7sdk.event.UserEvent.SPIN) {
								$spinSlider.data('bySlide', false);
							}
						}, false);

					});

					break;
				case 's7video':
					viewComponent = new s7sdk.VideoPlayer(slideContentId, self.params, componentTagId);
					viewComponent.$d_firstAssetLoaded = $d_firstAssetLoaded.promise();

					$.extend(events, {
						assetChanged: s7sdk.AssetEvent.ASSET_CHANGED
					});
					viewComponent.addEventListener(s7sdk.event.VideoEvent.NOTF_VIDEO_END, function(event) {
						$('.s7playpausebutton a.videoOn', $('.scene7OpeningVideo').eq(0)).click();
					}, false);
					//here we check 'divClickElement' exists in VideoPlayer component and add it if not
					if (!viewComponent.hasOwnProperty('divClickElement')){
						var divClickElement = document.createElement('div');
						viewComponent.divClickElement = divClickElement;
						viewComponent.obj.appendChild(divClickElement);
					}
					break;
				default:
					break;
			}
			if (viewComponent) {
				// define an event handler function to update the NavigationView when the asset changes
				if (events.assetChanged) {
					viewComponent.addEventListener(events.assetChanged, function(event) {
						// s7sdk.Logger.log(s7sdk.Logger.INFO, "EVENT - onZoomAssetChange asset: %0 - frame: %1", event.s7event.asset, event.s7event.frame);
						$d_firstAssetLoaded.resolve();
					}, false);
				}

				if (events.notifyZoomNRegion) {
					// define an event handler function to update the NavigationView each time the ZoomView
					viewComponent.addEventListener(events.notifyZoomNRegion, function(event) {
						// s7sdk.Logger.log(s7sdk.Logger.INFO, "EVENT - onZoomChange zoomRgn: %0", event.s7event.zoomRgn);
						if(viewComponent == self.$viewSlider.triggerHandler('currentVisible').data('view_component')) {
							self.s7naviview.setViewPort(event.s7event.zoomRgn);
						}
					}, false);

					$(viewComponent.obj).mousewheel(function(e, delta, deltaX, deltaY) {
						e.preventDefault();
						var view = self.getCurrentViewOf(viewComponent);
						if (view) {
							var capabilityState = viewComponent.getCapabilityState();
							var x = e.clientX - s7sdk.Util.getObjPos(viewComponent.obj).x;
							var y = e.clientY - s7sdk.Util.getObjPos(viewComponent.obj).y;
							if (deltaY > 0) {
								if (capabilityState.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_IN_CONT)) {
									view.zoomClick(x, y, false);
								}
							} else {
								if (capabilityState.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_RESET)) {
									view.zoomClick(x, y, true);
								}
							}
						}
					});
					// Adding custom event listener for Zoom
					viewComponent.addEventListener(s7sdk.event.UserEvent.NOTF_USER_EVENT, function(event) {
						if (event.s7event.trackEvent == s7sdk.event.UserEvent.ZOOM) {
							if(viewComponent == self.$viewSlider.triggerHandler('currentVisible').data('view_component')) {
								var capabilityState = viewComponent.getCapabilityState();
								if(capabilityState.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_IN)) {
									self.s7zoomInButton.activate();
								} else {
									self.s7zoomInButton.deactivate();
								}
								if(capabilityState.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_OUT)) {
									self.s7zoomOutButton.activate();
									$(self.s7naviview.obj).fadeIn(300);
									$('.s7spinslider', viewComponent.obj).addClass('disabled').find('.s7spinsliderUI .angle_scroll').slider("disable");
								} else {
									self.s7zoomOutButton.deactivate();
									$(self.s7naviview.obj).fadeOut(300);
									$('.s7spinslider', viewComponent.obj).removeClass('disabled').find('.s7spinsliderUI .angle_scroll').slider("enable");
								}
								// self.setZoomGauge(viewComponent);
							}
						}
					}, false);
				}

			}
			return viewComponent;
		},

		/*
		 * Create the thumbnail elements.
		 */
		createThumbs: function() {
			var self = this;
			self.$viewSlider.children().each(function(i) {
				var $slideBlock = $(this);
				var $slideContent = $slideBlock.children('.slide-content');
				// create thumbnail
				var $thumb = $($.trim(_.template($('.thumb-block-template', self.$root).html(), {
					thumb_src: $slideContent.data('thumb'),
					thumb_idx: i+1
				}))).data({
					"$slide_block": $slideBlock,
				});
				$slideBlock.data({
					"$thumb": $thumb
				});
				if ($slideContent.data('type') == 'video') {
					$thumb.find('span').append('<span class="icn-video"></span>');
				}
				self.$paginator.append($thumb);
			});
			// improve the response speed for HMX
			var $hmxSlideBlock = $('.slide-content[data-type="hmx"]', self.$viewSlider);
			if ($hmxSlideBlock.size()) {
				self.$paginator.children().click(function() {
					if ($('.overview-hmx', $hmxSlideBlock).children().size() <= 0) {
						$('.overview-hmx', $hmxSlideBlock).append($('.slide-content-hmx-template', $hmxSlideBlock).html());
					}
				});
			}
		}, // end createThumbs

		/*
		 * Create the view control components.
		 * for example close button, fullscreen button and slide buttons.
		 */
		createViewControlComponents: function() {
			var self = this;
			if (!self.s7closeButton) {
				// ***** define close button *****
				// create the CloseButton component object
				var $closeButton = self.grantId('.s7closebutton', self.s7container, "-close-btn");
				if ($closeButton.length) {
					$.extend(self.params.i18n, {
						'CloseButton.TOOLTIP': $closeButton.data('tooltip') || null
					});
					self.s7closeButton = new s7sdk.CloseButton(self.s7container.id, self.params, $closeButton.attr('id'));

					// add an event listener for CloseButton clicks
					$(self.s7closeButton.obj).on("click", function() {
						if (self.s7container.isFullScreen()) {
							self.s7container.cancelFullScreen();
						}
						YouTubeUtils.stopYoutubeVideos();
					});
				}
			}

			if (!self.s7slidePrevButton) {
				// ***** define slide buttons *****
				// create the slide button component objects
				var $previousButton = self.grantId('.s7slidepreviousbutton', self.s7container, "-slide-previous-btn");
				if ($previousButton.length) {
					$.extend(self.params.i18n, {
						'SlidePreviousButton.TOOLTIP': $previousButton.data('tooltip') || null
					});
					self.s7slidePrevButton = new s7sdk.SlidePreviousButton(self.s7container.id, self.params, $previousButton.attr('id'));
				}
			}

			if (!self.s7slideNextButton) {
				var $nextButton = self.grantId('.s7slidenextbutton', self.s7container, "-slide-next-btn");
				if ($nextButton.length) {
					$.extend(self.params.i18n, {
						'SlideNextButton.TOOLTIP': $nextButton.data('tooltip') || null
					});
					self.s7slideNextButton = new s7sdk.SlideNextButton(self.s7container.id, self.params, $nextButton.attr('id'));
				}
			}

			if (!self.s7fullScreenButton) {
				// ***** define full screen button *****
				// create the FullScreenButton component object
				var $fullScreenButton = self.grantId('.s7fullscreenbutton', self.s7container, "-fullscreen-btn");
				if ($fullScreenButton.length) {
					$.extend(self.params.i18n, {
						'FullScreenButton.TOOLTIP_SELECTED': $fullScreenButton.data('tooltip-selected') || null,
						'FullScreenButton.TOOLTIP_UNSELECTED': $fullScreenButton.data('tooltip-unselected') || null
					});
					self.s7fullScreenButton = new s7sdk.FullScreenButton(self.s7container.id, self.params, $fullScreenButton.attr('id'));
					// add an event listener for FullScreenButton clicks
					self.s7fullScreenButton.addEventListener("click", function() {
						s7sdk.Logger.log(s7sdk.Logger.INFO, "EVENT - onClickFullScreen s7container#isFullScreen: %0", self.s7container.isFullScreen()); 
						if(self.s7container.isFullScreen()){
							self.s7container.cancelFullScreen();
						}else{
							self.s7container.requestFullScreen();
						}
					}, false);
				}
			}

			if (!self.s7zoomInButton) {
				// ***** define zoom buttons *****
				// create the ZoomInButton component object
				var $zoomInButton = self.grantId('.s7zoominbutton', self.s7container, "-zoomin-btn");
				if ($zoomInButton.length) {
					$.extend(self.params.i18n, {
						'ZoomInButton.TOOLTIP': $zoomInButton.data('tooltip') || null
					});
					self.s7zoomInButton = new s7sdk.ZoomInButton(self.s7container.id, self.params, $zoomInButton.attr('id'));

					// define an event handler function to update the ZoomView and the SpinView when zoomIn is clicked
					self.s7zoomInButton.addEventListener("click", function(event) {
						s7sdk.Logger.log(s7sdk.Logger.INFO, "EVENT - onZoomIn"); 

						var viewComponent = self.$viewSlider.triggerHandler('currentVisible').data('view_component');
						if (viewComponent) {
							viewComponent.zoomIn();
						}
					}, false);
				}
			}

			if (!self.s7zoomOutButton) {
				// create the ZoomOutButton component object
				var $zoomOutButton = self.grantId('.s7zoomoutbutton', self.s7container, "-zoomout-btn");
				if ($zoomOutButton.length) {
					$.extend(self.params.i18n, {
						'ZoomOutButton.TOOLTIP': $zoomOutButton.data('tooltip') || null
					});
					self.s7zoomOutButton = new s7sdk.ZoomOutButton(self.s7container.id, self.params, $zoomOutButton.attr('id'));

					// define an event handler function to update the ZoomView and the SpinView when zoomOut is clicked
					self.s7zoomOutButton.addEventListener("click", function(event) {
						s7sdk.Logger.log(s7sdk.Logger.INFO, "EVENT - onZoomOut"); 

						var viewComponent = self.$viewSlider.triggerHandler('currentVisible').data('view_component');
						if (viewComponent) {
							viewComponent.zoomOut();
						}
					}, false);
				}
			}

			if (!self.s7naviview) {
				// ***** define vavigation view *****
				// create the NavigationView componenent object
				var $nav = self.grantId('.s7navigationview', self.s7container, "-navview");
				if ($nav.length && (self.isUseZoomView() || self.isUseSpinView())) {
					self.s7naviview = new s7sdk.NavigationView(self.s7container.id, self.params, $nav.attr('id'));
					// define an event handler function to update the ZoomView each time the NavigationView
					self.s7naviview.addEventListener(s7sdk.event.ZoomPanEvent.NOTF_ZOOM_NPAN, function(event) {
						s7sdk.Logger.log(s7sdk.Logger.INFO, "EVENT - onNavChange dx: %0 - dy: %1", event.s7event.dx, event.s7event.dy); 
						var viewComponent = self.$viewSlider.triggerHandler('currentVisible').data('view_component');
						if (viewComponent) {
							viewComponent.zoomNPan(event.s7event.dx, event.s7event.dy);
						}
					}, true);
					$(self.s7naviview.obj).hide();
				}
			}

			if (!self.s7playPauseButton) {
				// create the PlayPauseButton component object
				var $playPauseButton = self.grantId('.s7playpausebutton', self.s7container, "-playpause-btn");
				if ($playPauseButton.length && self.isUseVideoPlayer()) {
					$.extend(self.params.i18n, {
						'PlayPauseButton.TOOLTIP_SELECTED': $playPauseButton.data('tooltip-selected') || null,
						'PlayPauseButton.TOOLTIP_UNSELECTED': $playPauseButton.data('tooltip-unselected') || null
					});
					self.s7playPauseButton = new s7sdk.PlayPauseButton(self.s7container.id, self.params, $playPauseButton.attr('id'));

					// define an event handler function to update the ZoomView and the SpinView when zoomOut is clicked
					self.s7playPauseButton.addEventListener("click", function(event) {
						s7sdk.Logger.log(s7sdk.Logger.INFO, "EVENT - onPlayPause"); 

						var viewComponent = $('.s7videoplayer-wrapper', self.$s7container).data('view_component');
						if (viewComponent) {
							if(!self.s7playPauseButton.isSelected()){
								viewComponent.play();
							}else{
								viewComponent.stop();
							}
						}
					}, false);
				}
			}

		}, // end createViewControlComponents

		/*
		 * Grant id to the component element.
		 */
		grantId: function(selector, parentComponent, suffix) {
			return $(selector, parentComponent.obj).attr('id', parentComponent.id + suffix);
		},

		/*
		 * Resize s7container.
		 * @params width
		 * @params height
		 */
		resizeContainer: function(width, height) {
			this.$d_containerReady.done(function() {
				this.s7container.resize(width, height);
			}.bind(this));
		},

		/*
		 * Resize s7component.
		 * @params componentManager Setting target viewer.
		 * @params width
		 * @params height
		 */
		resizeComponent: function(componentManager, width, height) {
			var $componentManager = $(componentManager);
			if (!$componentManager.size()) {
				return;
			}
			this.$d_componentsReady.done(function() {
				var viewComponent = $componentManager.data('view_component');
				if (viewComponent) {
					viewComponent.resize(width, height);
				}
			}.bind(this));
		},

		/*
		 * Sets scene7 Asset for viewer.
		 * @params componentManager Setting target viewer.
		 */
		setAssetForViewer: function(componentManager) {
			var $componentManager = $(componentManager);
			if (!$componentManager.size()) {
				return;
			}
			this.$d_componentsReady.done(function() {
				var viewComponent = $componentManager.data('view_component');
				if (viewComponent) {
					var itemDesc = $componentManager.data('item_desc');
					this.setItemFor(viewComponent, itemDesc);
				}
			}.bind(this));
		},

		/*
		 * Sets scene7 Asset for around viewer.
		 * @params slideBlock Setting target viewer.
		 */
		setAssetForAroundViewer: function(slideBlock) {
			var $slideBlock = $(slideBlock);
			if (!$slideBlock.size()) {
				return;
			}
			this.setAssetForViewer($slideBlock.prev());
			this.setAssetForViewer($slideBlock.next());
		},

		/*
		 * focus on the thumbnail of the displayed viewer.
		 * @params slideBlock Target viewer.
		 */
		focusToThumbnail: function(slideBlock) {
			var $slideBlock = $(slideBlock);
			if (!$slideBlock.size()) {
				return;
			}
			var $thumb = $slideBlock.data('$thumb');
			if (!$thumb.is('.selected')) {
				this.$paginator.children().not($thumb).removeClass('selected');
				$thumb.addClass('selected');
			}

			if (!this.$paginator.triggerHandler('currentVisible').is('.selected')) {
				this.$paginator.triggerHandler('slideTo', $thumb);
			}
		},

		/*
		 * Select the viewer by thumbnail clicked.
		 * @params targetThumb Target thumbnail. if not given argument, use the selected thumbnail.
		 */
		selectViewByThumb: function(targetThumb, withSetAsset) {
			var $targetThumb = $(targetThumb);
			if (!$targetThumb.size()) {
				$targetThumb = $('.selected', this.$paginator);
			}
			if ($targetThumb.size()) {
				var $slideBlock = $targetThumb.data('$slide_block');
				if (withSetAsset) {
					this.setAssetForViewer($slideBlock);
					this.toggleViewController($slideBlock);
				}
				this.$viewSlider.trigger('slideTo', $slideBlock);
			}
		},

		/*
		 * Switch display the controller of the target viewer.
		 * @params targetViewer Target viewer.
		 */
		toggleViewController: function(slideBlock) {
			var $slideBlock = $(slideBlock);
			if (!$slideBlock.size()) {
				return;
			}
			var viewComponent = $slideBlock.data('view_component');

			if (!!viewComponent) {
				$(this.s7zoomInButton.obj).show();
				$(this.s7zoomOutButton.obj).show();
				// $('.s7zoomgauge', this.$container).show();

				var itemDesc = this.getCurrentItemOf(viewComponent);
				// sets asset to navigation view
				if (itemDesc) {
					this.s7naviview.setItem(itemDesc);
				}
				var self = this;
				$.when(viewComponent.$d_firstAssetLoaded).done(function() {
					if ($slideBlock.is(self.$viewSlider.triggerHandler('currentVisible'))) {
							// switch availability of zoom buttons
							var zoomCapabilityState = viewComponent.getCapabilityState();
							if (zoomCapabilityState.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_IN)) {
								self.s7zoomInButton.activate();
							} else {
								self.s7zoomInButton.deactivate();
							}
							if (zoomCapabilityState.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_OUT)) {
								self.s7zoomOutButton.activate();
								self.s7naviview.setViewPort(self.getCurrentViewOf(viewComponent).getViewPort());
								$(self.s7naviview.obj).fadeIn(300);
							} else {
								self.s7zoomOutButton.deactivate();
								$(self.s7naviview.obj).hide();
							}
							// self.setZoomGauge(viewComponent);
					}
				});

			} else {
				$(this.s7zoomInButton.obj).hide();
				$(this.s7zoomOutButton.obj).hide();
				// $('.s7zoomgauge', this.$container).hide();
				if (this.s7naviview) {
					$(this.s7naviview.obj).hide();
				}
			}
		}, //toggleViewController

		/*
		 * calculate the initial zoom scale.
		 * @param viewComponent s7sdk view component
		 */
		calcInitZoomScale: function(viewComponent) {
			var asset = this.getCurrentItemOf(viewComponent);
			var view = this.getCurrentViewOf(viewComponent);
			var initRectangle = new s7sdk.Rectangle(0, 0, asset.width, asset.height);
			var topLeftPoint = this.imagePixelsToViewPointForInitScale(view, initRectangle.topLeft());
			var bottomRightPoint = this.imagePixelsToViewPointForInitScale(view, initRectangle.bottomRight());
			var initScale = (bottomRightPoint.y - topLeftPoint.y) / asset.height;
			initScale = Math.round((initScale + 0.00005) * 10000) / 100;
			return initScale;
		},

		/*
		 * create image pixels to view point at initial view size.
		 * @param view component view
		 * @param point2D s7sdk.Point2D Object
		 */
		imagePixelsToViewPointForInitScale: function(view, point2D) {
			var viewToImage = view.resetView();
			viewToImage.scale(view.imageWidth, view.imageHeight);
			viewToImage.invert();
			var transPoint = viewToImage.transformPoint(point2D);
			transPoint.x /= view.devicePixelRatio;
			transPoint.y /= view.devicePixelRatio;
			return transPoint;
		},

		/*
		 * Sets the zoom gauage of current view.
		 * @param viewComponent s7sdk view component
		 */
		setZoomGauge: function(viewComponent) {
			var capabilityState = viewComponent.getCapabilityState();
			if(capabilityState.hasCapability(s7sdk.ZoomCapabilityState.ZOOM_OUT)) {
				var initScale = this.calcInitZoomScale(viewComponent);
				// ScaleOfZoomLevel = InitScale * (2 ^ (ZoomLevel - 1))
				// -> ZoomLevel = log2(CurrScale / InitScale) + 1
				// ex. InitScale: 0.2(20%), CurrScale: 0.8(80%)
				//     -> log2(0.8 / 0.2) + 1 -> log2(4) + 1 = 3
				// var currZoomLevel = Math.round((Math.log(viewComponent.lastScale / initScale) / Math.log(2)) * 2) + 1;
				var levelRange = (100 - initScale) / 4;
				// console.log('initScale: [' + initScale + '], currScale:[' + viewComponent.lastScale + '], levelRange:[' + levelRange + ']');
				var currZoomLevel = 1;
				if (100 <= viewComponent.lastScale) {
					currZoomLevel = 5;
				} else {
					for (var i = 0; i < 5; i++) {
						var scaleOfEachLevel = initScale + (levelRange * i);
						// var scaleThreshold = levelRange / 2;
						// console.log('scaleRangeOfEachLevel: [' + (scaleOfEachLevel - levelRange) + ' - ' + scaleOfEachLevel + ']');
						if ((scaleOfEachLevel - levelRange) <= viewComponent.lastScale && viewComponent.lastScale <= scaleOfEachLevel) {
							currZoomLevel = i + 1;
							break;
						}
					}
				}
				// console.log('currZoomLevel:[' + currZoomLevel + ']');
				$('.s7zoomgauge span', this.$container).removeClass('selected').eq(Math.abs(currZoomLevel - 5)).addClass('selected');
			} else {
				$('.s7zoomgauge span', this.$container).removeClass('selected').last().addClass('selected');
			}
		},

		/* utility methods for view component */

		/*
		 * Gets the current viewing ItemDesc
		 * @param viewComponent s7sdk view component
		 */
		getCurrentItemOf: function(viewComponent) {
			if (this.isInstanceOf(viewComponent, 'SpinView')) {
				if (viewComponent.spinSet2D) {
					return viewComponent.spinSetDesc.items[viewComponent.getCurrentFrame().position.y];
				} else {
					return viewComponent.spinSetItems[viewComponent.getCurrentFrameIndex()];
				}
			} else if (this.isInstanceOf(viewComponent, 'ZoomView') || this.isInstanceOf(viewComponent, 'VideoPlayer')) {
				return viewComponent.item;
			}
			return null;
		},

		/*
		 * Sets the ItemDesc to view component
		 * @param viewComponent s7sdk view component
		 */
		setItemFor: function(viewComponent, itemDesc) {
			if (viewComponent && itemDesc) {
				if (this.isInstanceOf(viewComponent, 'SpinView')) {
					if (!viewComponent.spinSet) {
						viewComponent.setMediaSet(itemDesc);
					}
				} else if (this.isInstanceOf(viewComponent, 'ZoomView')) {
					if (!viewComponent.item) {
						viewComponent.setItem(itemDesc);
					}
				} else if (this.isInstanceOf(viewComponent, 'VideoPlayer')) {
					if (!viewComponent.item) {
						var $viewWrapper = $(viewComponent.obj).parent();
						// viewComponent.resize($viewWrapper.width(), $viewWrapper.height());
						viewComponent.setItem(itemDesc);
					}
				}
			}
		},

		/*
		 * Gets the s7sdk.View of view component.
		 * @param viewComponent s7sdk view component
		 */
		getCurrentViewOf: function(viewComponent) {
			if (this.isInstanceOf(viewComponent, 'SpinView')) {
				return viewComponent.getCurrentView();
			} else if (this.isInstanceOf(viewComponent, 'ZoomView')) {
				return viewComponent.view;
			}
			return null;
		},

		fullscreenContainer: function(callback) {
			var self = this;
			self.$d_containerReady.done(function() {
				if (!self.s7container.isFullScreen()) {
					if ($.isFunction(callback)) {
						$(self.s7container.obj).one(s7sdk.event.ResizeEvent.FULLSCREEN_RESIZE, callback);
					}
					self.s7container.requestFullScreen();
				}
			});
		},

		cancelFullscreenContainer: function(callback) {
			var self = this;
			self.$d_containerReady.done(function() {
				if (self.s7container.isFullScreen()) {
					if ($.isFunction(callback)) {
						$(self.s7container.obj).one(s7sdk.event.ResizeEvent.FULLSCREEN_RESIZE, callback);
					}
					self.s7container.cancelFullScreen();
				}
			});
		},

		/* fullscreen video size */
		fullscreenVideoSize: function(){
			var self = this;
			self.$d_containerReady.done(function() {
				self.$viewSlider.children().each(function() {
					var $slideBlock = $(this);
					if ($slideBlock.is(':has([data-type="video"])')) {
						if (self.s7container.isFullScreen()) {
							// WHY? not yet mode="fullscreen" on container resize event.
							var modeTmp = self.$container.attr('mode');
							self.$container.attr('mode', 'fullscreen');
							$('.youtube-placeholder', $slideBlock).height(Math.round(($('.slide-content', $slideBlock).width()/16)*9));
							self.$container.attr('mode', modeTmp);
						} else {
							$('.youtube-placeholder', $slideBlock).height(456);

						}
					}
				});
				self.$viewSlider.trigger('configuration', ['items', 1]);
				self.$viewSlider.trigger('updateSizes');
			});
		},

		/* show icon effect */
		showIconEffect: function(slideBlock){
			var $slideBlock = $(slideBlock);
			if (!$slideBlock.size()) {
				return;
			}

			var viewComponent = $slideBlock.data('view_component');
			if (!viewComponent) {
				return;
			}

			var indicatedIconFlgKey = null;
			var iconClassName = null;
			if (this.isInstanceOf(viewComponent, 'SpinView')) {
				indicatedIconFlgKey = 'is_indicated_icon_spin';
				iconClassName = 'spin';
			} else if (this.isInstanceOf(viewComponent, 'ZoomView')) {
				indicatedIconFlgKey = 'is_indicated_icon_zoom';
				iconClassName = 'zoom';
			}
			if (!this.$container.data(indicatedIconFlgKey)) {
				this.$container.data(indicatedIconFlgKey, true);
				$('.s7iconeffect', this.$container).hide().filter('.' + iconClassName).fadeIn(500).delay(1000).fadeOut(500);
			}
		},

		/* s7container move to top left */
		containerMoveToTopLeft: function(){
			var self = this;
			self.$d_containerReady.done(function() {
				self.s7container.moveToTopLeft();
			});
		},

		/* use ZoomView? */
		isUseZoomView: function(){
			return this.isUseComponent('gallery');
		},

		/* use SpinView? */
		isUseSpinView: function(){
			return this.isUseComponent('spin');
		},

		/* use VideoPlayer? */
		isUseVideoPlayer: function(){
			return this.isUseComponent('s7video');
		},

		/* judge use Component by viewType
		 * @param viewType
		 */
		isUseComponent: function(viewType){
			return this.$container.is(':has(.s7-asset[data-type="' + viewType + '"])');
		},

		/* judge use Component by viewType
		 * @param viewType
		 */
		isInstanceOf: function(obj, componentName){
			return componentName in s7sdk && obj instanceof s7sdk[componentName];
		},

		/* has Slider? */
		hasSlider: function(){
			return this.$container.is(':has(.s7slider)');
		},

		/* togglePlayVideo */
		togglePlayVideo: function(componentManager, doPlay){
			var $componentManager = $(componentManager);
			if (!$componentManager.size()) {
				return;
			}
			this.$d_componentsReady.done(function() {
				var viewComponent = $componentManager.data('view_component');
				if (this.isInstanceOf(viewComponent, 'VideoPlayer')) {
					if (doPlay) {
						viewComponent.play();
					} else {
						viewComponent.stop();
					}
					this.s7playPauseButton.setSelected(!doPlay);
				}
			}.bind(this));
		}

	});

	$.fn.multiMediaView = function(method, opts) {
		var methodArguments = arguments;
		return $(this).each(function() {
			var multiMediaViewer = $(this).data('multiMediaViewer');
			if (!multiMediaViewer) {
				var initOptions = {};
				if (methodArguments.length == 1 && _.isObject(methodArguments[0])) {
					$.extend(initOptions, methodArguments[0]);
				}
				$(this).data('multiMediaViewer', (multiMediaViewer = new GwcCommon.MultiMediaViewer(this, initOptions)));
			}
			var publicMethods = ['resizeContainer', 'resizeComponent', 'fullscreenContainer', 'cancelFullscreenContainer', 'selectViewByThumb', 'setAssetForViewer', 'setAssetForAroundViewer', 'focusToThumbnail', 'toggleViewController', 'fullscreenVideoSize', 'containerMoveToTopLeft', 'togglePlayVideo'];
			if (_.contains(publicMethods, method)) {
				multiMediaViewer[method].apply(multiMediaViewer, $.makeArray(methodArguments).slice(1));
			}
		});
	};
	$.fn.multiMediaView.defaults = {
		params: {
			thumb: {
				wid: 96,
				hei: 54,
				fmt: 'png-alpha'
			}
		},
		image_presets: {
			nav_view: '$NavigationView150$',
			thumb: '$Thumbnail96$'
		},
		component_params:{
			spin_view: {
				fmt: "png-alpha", // jpg|jpeg|png|png-alpha|gif|gif-alpha
				singleclick: "zoomReset", //none|zoom|reset|zoomReset
				doubleclick: "reset" //none|zoom|reset|zoomReset
			},
			zoom_view: {
				fmt: "png-alpha", // jpg|jpeg|png|png-alpha|gif|gif-alpha
				resizable: "0",
				zoomstep: "2,1", // step[,limit]
				frametransition: "none", // none|fade|slide[,duration[,spacing]]
				singleclick: "zoomReset", // none|zoom|reset|zoomReset
				doubleclick: "reset" // none|zoom|reset|zoomReset
			},
			video_player: {
				playback: 'auto,0',
				singleclick: 'playPause'
			}
		}
	};

	$(function() {
		$('#hero.scene7 .scene7-section').multiMediaView();
	});
})(jQuery, this);



/*  spinSlider */

;(function($){
	$.fn.s7spinsliderUI = function(){
		$.each(this, function(index, value){
			var sliderUI = $(this); 
			sliderUI.find('.angle_scroll').slider({
				min: 0,
				max: 360,
				value: 180,
				step: 15,
				create: function(event, ui){
					updateSlider($(this).slider('value'));
					if($(this).parents('.scene7Main-wrapper').hasClass('style-light')){
						$(this).find('a').append('<img src="etc/designs/panasonic/productpage-clientlibs/scene7/images/img-scrollbar-hor-slider-dark.png" alt="slider">');
					}else{
						$(this).find('a').append('<img src="etc/designs/panasonic/productpage-clientlibs/images/img-scrollbar-hor-slider.png" alt="slider">');
					}
				},
				slide: function( event, ui ) {
					updateSlider(ui.value);
				},
				change: function( event, ui ) {
					updateSlider(ui.value);
				}
			});
			function updateSlider(_value){
				var value = _value;
				/* mod start scsk */
				// sliderUI.find('.grados').text( value+'?');
				// sliderUI.find('.grados').html( Math.min(value, sliderUI.find('.angle_scroll').slider('option', 'max'))+'&deg;');
				sliderUI.find('.grados').html( value+'&deg;');
				/* mod end scsk */
			}
		});
	};
})(jQuery);
