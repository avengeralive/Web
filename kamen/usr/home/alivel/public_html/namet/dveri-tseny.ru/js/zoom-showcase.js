;(function($) {
	
	var touched = "ontouchend" in document;
	
	function over(event) {
						
		$(this).data("image").fadeTo(250, 1);
				
	}
	
	function out(event) {
		
		var $this = $(this);
		
		$this.data("image").stop(true, true).fadeTo(250, $this.data("sideOpacity"));
				
	}
	
	function gotoURL(event) {
		
		var $this = $(this);	
			
		($this.data("target") === "_parent") ? window.location = $this.data("link") : window.open($this.data("link"));
			
	}
	
	$.fn.zoomShowcase = function(data) {
		
		return this.each(function() {
		
			var list = [],
			images = [],
			infos = [],
			$this = $(this),
			easing = data.easing,
			target = data.linkTarget,
			imgWidth = data.imageWidth,
			imgHeight = data.imageHeight,
			totalWidth = data.bannerWidth,
			sideOpacity = data.sideOpacity,		
			randomize = data.randomizeItems,
			speed = data.animationSpeed,
			delay = data.autoPlayDelay,
			quarters = data.backZoom,
			halves = data.sideZoom,
			auto = data.autoPlay,
			
			halfW = (imgWidth * halves) | 0,
			halfH = (imgHeight * halves) | 0,
			quarterW = (imgWidth * quarters) | 0,
			quarterH = (imgHeight * quarters) | 0,
			halfWidth = (totalWidth * 0.5) | 0,
			halfHeight = (imgHeight * 0.5) | 0,
					
			items = $this.children("ul").children("li"),
			leg = items.length,
			readyToFire = false,
			isHovering = false,
			isRunning = false,
			grabOnce = true,
			iLeg = leg - 1,
			counter = 0,
			isOn = 0,
					
			toLeft,
			toBack,
			toRight,
			toCenter,
			preloader,
			conList,
			tCount,
			direct,
			infoOn,
			store,
			extraW,
			extraH,
			timer,
			$this,
					
			rightX = totalWidth - halfW,
			centerX = halfWidth - ((imgWidth * 0.5) | 0),
			backX = halfWidth - ((quarterW * 0.5) | 0),
					
			sideY = halfHeight - ((halfH * 0.5) | 0),
			backY = halfHeight - ((quarterH * 0.5) | 0);
			
			if(leg < 4) return;
			init();
			
			this.goLeft = function() {
			
				clickLeft();
				
			}
			
			this.goRight = function() {
			
				clickRight();
				
			}
			
			this.isReady = function() {
			
				return !isRunning;
				
			}
			
			function init() {
				
				var totalWidth = data.bannerWidth;
				
				if(leg > 3) {
					
					var img, txt, titles, ar, pos, aligns, positions, styles, k = leg, tempList = [], tempImages = [], tempInfos = [], $_this;
					preloader = $this.find(".preloader");
							
					if(preloader.length) {
								
						preloader.css({
									
							left: halfWidth - ((parseInt(preloader.attr("width"), 10) * 0.5) | 0), 
							top: halfHeight - ((parseInt(preloader.attr("height"), 10) * 0.5) | 0),
							display: "block"
									
						});
								
					}
					
					$this.css("height", imgHeight + 20);
					$this.find("ul").css("display", "block");
					
					items.each(function(i) {
						
						$_this = $(this);
						
						tempList[i] = $_this.css({position: "absolute", backgroundColor: "#000"}).data({sideOpacity: sideOpacity, target: target}).hide();
						img = $("<img />").css({position: "absolute", top: 0, left: 0}).load(imgLoaded).appendTo($(this));
								
						tempImages[i] = img;
						$_this.data("image", img);
						
						ul = $_this.find("ul");
						
						if(ul.length) {
							
							if(ul.attr("title")) $_this.data("link", ul.attr("title"));
							
							if(ul.attr("class")) {
							
								aligns = ul.attr("class").toLowerCase();
								(aligns.search("-") !== -1) ? aligns = aligns.split("-")[1] : aligns = "left";
								
							}
							else {
							
								aligns = "left";
								
							}
							
						}
						else {
						
							aligns = "left";
							
						}
						
						txt = $_this.find("li");
						var $__this;
						
						if(txt.length) {
								
							titles = [];
							positions = [];
							styles = [];
									
							txt.each(function(j) {
								
								$__this = $(this);
										
								if($.trim(txt.html()) !== "") {
									
									if($__this.attr("class")) {
										
										pos = $__this.attr("class").toLowerCase();
										
										if(pos.search("x") !== -1) {
											
											ar = $__this.attr("class").split("x");
											
											titles[j] = $__this.html();
											positions[j] = {x: parseInt(ar[0], 10), y: parseInt(ar[1], 10)};
											styles[j] = {color: $__this.css("color"), backgroundColor: $__this.css("background-color")};
											
										}
										else {
											
											titles[j] = 0;
											positions[j] = 0;
											styles[j] = 0;
											
										}
										
									}
									else {
									
										titles[j] = 0;
										positions[j] = 0;
										styles[j] = 0;
										
									}
											
								}
								else {
										
									titles[j] = 0;
									positions[j] = 0;
									styles[j] = 0;
											
								}
											
							});
							
									
							tempInfos[i] = {content: titles, position: positions, style: styles, align: aligns};
									
						}
						else {
									
							tempInfos[i] = 0;
									
						}
						
						ul.empty();
		
					});
					
					if(!randomize) {
						
						list = tempList;
						images = tempImages;
						infos = tempInfos;
									
					}
								
					else {
						
						var shuf = [], shuf2 = [], shuf3 = [], placer, iOn;
								   
						for(var i = 0; i < leg; i++) {
							
							shuf[i] = tempList[i];
							shuf2[i] = tempImages[i];
							shuf3[i] = tempInfos[i];
							
						}
										
						while(shuf.length > 0) { 
										
							placer = (Math.random() * shuf.length) | 0;
							iOn = list.length;
							
							list[iOn] = shuf[placer];
							images[iOn] = shuf2[placer];
							infos[iOn] = shuf3[placer];
							
							shuf.splice(placer, 1);
							shuf2.splice(placer, 1);
							shuf3.splice(placer, 1);
										
						}
						
					}
					
					while(k--) {
						
						switch(k) {
									
							case 0: 
										
								list[k].css({left: centerX, top: 0, width: imgWidth, height: imgHeight, zIndex: 3});
								images[k].attr("width", imgWidth).attr("height", imgHeight);
										
							break;
									
							case 1:
										
								list[k].css({left: rightX, top: sideY, width: halfW, height: halfH, zIndex: 1});
								images[k].css("opacity", sideOpacity).attr("width", halfW).attr("height", halfH);
									
							break;
									
							case iLeg:
										
								list[k].css({left: 0, top: sideY, width: halfW, height: halfH, zIndex: 2});
								images[k].css("opacity", sideOpacity).attr("width", halfW).attr("height", halfH);
									
							break;
									
							default:
										
								list[k].css({left: backX, top: backY, width: quarterW, height: quarterH, xIndex: 0});
								images[k].attr("width", quarterW).attr("height", quarterH);
										
						}
						
						images[k].attr("src", list[k].attr("title"));
						list[k].removeAttr("title");
						
					}
					
				}
	
			}
					
			function imgLoaded(event) {
					
				event.stopPropagation();
						
				if(counter < iLeg) {
							
					counter++;
							
				}
				else {
					
					if(preloader) preloader.remove();
							
					list[0].fadeTo(500, 1, fadeSides);
							
					counter = null;
					preloader = null;
							
				}
						
			}
					
			function fadeSides() {
				
				toRight = 1;
				toLeft = iLeg;
				toCenter = 0;
						
				list[toRight].fadeTo(500, 1);
				list[toLeft].fadeTo(500, 1, addClicks);
						
			}
					
			function addClicks() {
					
				list[1].css("cursor", "pointer").mouseenter(over).mouseleave(out);
				list[iLeg].css("cursor", "pointer").mouseenter(over).mouseleave(out);
						
				var i = leg;		
				while(i--) list[i].show();
	
				if(auto) $this.mouseenter(enterMouse).mouseleave(exitMouse);
	
				addEvents();
						
			}
			
			function enterMouse(event) {
				
				isHovering = true;
				if(timer) clearTimeout(timer);
				
			}
			
			function exitMouse(event) {
				
				isHovering = false;
				if(readyToFire) timer = setTimeout(clickRight, delay);
				
			}
					
			function clickLeft(event) {
					
				if(timer) clearTimeout(timer);
				readyToFire = false;
					
				toCenter = (isOn > 0) ? isOn - 1 : iLeg,
				toLeft = (toCenter > 0) ? toCenter - 1 : iLeg;
				toBack = (isOn < iLeg) ? isOn + 1 : 0,
				toRight = isOn;
						
				list[toCenter].unbind("click", clickLeft);
				list[toBack].unbind("click", clickRight);
						
				list[toLeft].css("z-index", 1);
				list[toRight].css("z-index", 2);
						
				animate();
						
			}
					
			function clickRight(event) {
	
				if(timer) clearTimeout(timer);
				readyToFire = false;
				
				toCenter = (isOn < iLeg) ? isOn + 1 : 0,
				toLeft = isOn,
				toBack = (isOn > 0) ? isOn - 1 : iLeg,
				toRight = (toCenter < iLeg) ? toCenter + 1 : 0;
						
				list[toCenter].unbind("click", clickRight);
				list[toBack].unbind("click", clickLeft);
						
				list[toLeft].css("z-index", 2);
				list[toRight].css("z-index", 1);
						
				animate();
						
			}
					
			function animate() {
				
				list[isOn].css("cursor", "auto").unbind("click", gotoURL);
				
				isOn = toCenter;
				isRunning = true;		
				
				if(store != null) {
					
					while(store.length) {
						
						store[0].stop().data("child").stop();
						store[0].removeData("child").empty().remove();
						store.shift();
						
					}
						
					store = null;
					conList = null;
					
				}
				
				if(touched) {
					
					list[toBack].cjSwipe('off');
					list[toLeft].cjSwipe('off');
					list[toRight].cjSwipe('off');
					list[toCenter].cjSwipe('off');
					
				}
				
				list[toBack].unbind("mouseenter", over).unbind("mouseleave", out).css({zIndex: 0, cursor: "auto"}).animate({left: backX, top: backY, width: quarterW, height: quarterH}, speed, easing);		
				images[toBack].animate({width: quarterW, height: quarterH}, speed, easing);
						
				list[toLeft].css("cursor", "pointer").mouseenter(over).mouseleave(out).animate({left: 0, top: sideY, width: halfW, height: halfH}, speed, easing);
				images[toLeft].animate({width: halfW, height: halfH, opacity: sideOpacity}, speed, easing);
						
				list[toRight].css("cursor", "pointer").mouseenter(over).mouseleave(out).animate({left: rightX, top: sideY, width: halfW, height: halfH}, speed, easing);
				images[toRight].animate({width: halfW, height: halfH, opacity: sideOpacity}, speed, easing);
				
				list[toCenter].unbind("mouseenter", over).unbind("mouseleave", out).css({zIndex: 3, cursor: "auto"}).animate({left: centerX, top: 0, width: imgWidth, height: imgHeight}, speed, easing);		
				images[toCenter].stop(true, true).animate({width: imgWidth, height: imgHeight, opacity: 1}, speed, easing, addEvents);
						
			}
			
			function swiped(direction) {
			
				(direction) ? clickRight() : clickLeft();
				
			}
					
			function addEvents() {
				
				if(!touched) {	
					
					list[toRight].click(clickRight);
					list[toLeft].click(clickLeft);	
					
				}
				else {	
					
					list[toRight].click(clickRight).cjSwipe('on', swiped);
					list[toLeft].click(clickLeft).cjSwipe('on', swiped);
					list[toCenter].click(clickLeft).cjSwipe('on', swiped);
					
				}
				
				if(list[isOn].data("link")) list[isOn].css("cursor", "pointer").click(gotoURL);
				isRunning = false;
				
				if(infos[isOn] !== 0) {	
					
					conList = infos[isOn];
					tCount = conList.content.length - 1;
					direct = conList.align;
					store = [];
					infoOn = 0;
					showContent();
					
				}
				else {
					showDone();
				}	
						
			}
			
			function showDone() {
			
				if(auto && !isRunning && !isHovering) {
					
					timer = setTimeout(clickRight, delay);
						
				}
				
				readyToFire = true;
				
			}
					
			function showContent() {
				
				if(isRunning) return;
				
				var cont = conList.content[infoOn];
						
				if(cont === 0) {
							
					if(infoOn < tCount) {
						infoOn++;
						showContent();
					}
					else {
						showDone();
					}
							
					return;
							
				}
				
				var info = $("<div />").addClass("zoom-gallery-info-text").appendTo($this),
				inside = $("<span />").html(cont).appendTo(info),
				iWide,
				func, 
				obj, 
				w2,
				w, 
				h;
							
				if(grabOnce) {
								
					extraW = parseInt(info.css("padding-left"), 10) + parseInt(info.css("padding-right"), 10);
					extraH = parseInt(info.css("padding-top"), 10) + parseInt(info.css("padding-bottom"), 10);
					grabOnce = false;
								
				}
							
				h = info.height();
				w = w2 = info.width();
				
				inside.css({width: w - extraW, height: h});
							
				info.css(conList.style[infoOn]).css({
								 
					left: (direct === "left") ? centerX + conList.position[infoOn].x : centerX + imgWidth - conList.position[infoOn].x - extraW, 
					top: conList.position[infoOn].y,
					opacity: 1,
					width: 0,
					height: h
								
				}).data("child", inside).find("a").each(function() {
								
					$(this).css(conList.style[infoOn]);
								
				});
							
				store[infoOn] = info;
						
				if(infoOn < tCount) {
					infoOn++;
					func = showContent;
				}
				else {
					func = showDone;
				}
						
				if(direct === "left") {
					
					info.animate(
					
						{width: w},
						250,
						func
					
					);
							
				}
				else {
					
					inside.css({position: "relative", left: -w2}).animate({left: 0}, 250);
					
					info.animate(
					
						{left: centerX + imgWidth - conList.position[infoOn].x - w - extraW, width: w},
						250,
						func
					
					);
	
				}
							
			}
			
		});
		
	}
	
})(jQuery);

(function($) {
	
	var touchStop, touchMove, touchStart, modern = 'addEventListener' in window,
	
	methods = {
		
		on: function($this, cb) {
			
			$this.cjCallback = cb;
			$this.addEventListener(touchStart, startIt);
			
		},
		
		off: function($this) {
			
			$this.removeEventListener(touchStart, startIt);
			$this.removeEventListener(touchMove, moveIt);
			$this.removeEventListener(touchStop, endIt);
			
			delete $this.cjSwipeLeft;
			delete $this.cjSwipeRight;		
			delete $this.cjNewPageX;
			delete $this.cjPageX;
			
		}
		
	};
	
	if('ontouchend' in document) {
	
		touchStop = 'touchend';
		touchMove = 'touchmove';
		touchStart = 'touchstart';
		
	}
	else {
	
		touchStop = 'MSPointerUp';
		touchMove = 'MSPointerMove';
		touchStart = 'MSPointerDown';
		
	}
	
	$.fn.cjSwipe = function(type, cb) {
		
		if(!modern) return;
		return this.each(cycleEach, [type, cb]);
		
	};
	
	function cycleEach(type, cb) {
		
		methods[type](this, cb);
		
	}
	
	function startIt(event) {
		
		var pages = event.touches ? event.touches[0] : event;
		
		this.cjPageX = pages.pageX;
		this.addEventListener(touchStop, endIt);
		this.addEventListener(touchMove, moveIt);
		
	}
	
	function moveIt(event) {
		
		var pages = event.touches ? event.touches[0] : event,
		newPageX = this.cjNewPageX = pages.pageX;
		
		if(Math.abs(this.cjPageX - newPageX) > 10) event.preventDefault();
		
	}
	
	function endIt() {
		
		this.removeEventListener(touchMove, moveIt);
		this.removeEventListener(touchStop, endIt);
		
		var newPageX = this.cjNewPageX, pageX = this.cjPageX;
		if(Math.abs(pageX - newPageX) > 30) this.cjCallback(pageX > newPageX);
		
	}
		
})(jQuery);






