jQuery(window).load(function() {
    "use strict";
    if(jQuery(".domik-loader").length){
        jQuery(".domik-loader").fadeOut(500, function() {
            jQuery("#main").animate({
                opacity: "1"
            }, 500);
            contanimshow();
        });
    }else{
        contanimshow();
    }
    
});
jQuery("body").append('<div class="l-line"><span></span></div>');
function initDomik() {
    "use strict";
	// center content ------------------
    function a() {
        jQuery(" .fullheight-carousel .item").css({
            height: jQuery(".fullheight-carousel").outerHeight(true)
        });
        jQuery(".height-emulator").css({
            height: jQuery("footer").outerHeight(true)
        });
        jQuery(".team-social").css({
            "margin-top": -1 * jQuery(".team-social").height() / 2 + "px"
        });
        jQuery(".minus-wrap").css({
            "margin-top": -jQuery("footer").outerHeight(true)
        });
        jQuery(".srtp ul").css({
            "margin-top": -1 * jQuery(".srtp ul").height() / 2 + "px"
        });
        jQuery(".pagination").css({
            "margin-top": -1 * jQuery(".pagination").height() / 2 + "px"
        });
        jQuery(".slide-title").css({
            "margin-top": -1 * jQuery(".slide-title").height() / 2 + "px"
        });
        jQuery(".mm").css({
            "padding-top": jQuery("header").outerHeight(true)
        });
        //jQuery('.socials-widget').css({top:jQuery(window).height()});
        if(jQuery(window).scrollTop() >= jQuery(window).height()){
            jQuery('.socials-widget').css({position:'fixed',top:'0px',height:jQuery(window).height()});
        }else{
            jQuery('.socials-widget').css({position:'absolute',top:jQuery(window).height(),height:'auto'});
        }
    }
    a();
    jQuery(window).resize(function() {
        a();
        var b = jQuery(window).width();
        if (b > 1036){
            jQuery(".nav-holder").css({
                display: "block"
            });
        } else{
            jQuery(".nav-holder").css({
                display: "none"
            });
        }
    });
    jQuery(window).scroll(function(){
        //console.log(jQuery(this).scrollTop());
        //var w_h = jQuery(window).height();
        //var s_t = jQuery(this).scrollTop();
        //console.log(w_h);console.log(s_t);
        if( jQuery(this).scrollTop() >= jQuery(window).height()){
            jQuery('.socials-widget').css({position:'fixed',top:'0px',height:jQuery(window).height()});
        }else{
            jQuery('.socials-widget').css({position:'absolute',top:jQuery(window).height(),height:'auto'});
        }
    });
    jQuery(".show-hidden-info").on("click", function() {
        jQuery(this).toggleClass("vhi");
        jQuery(this).closest(".resume-box").find(".hidden-info").slideToggle(500);
    });

    jQuery(".fullwidth-slider").each(function(){

        var fhowl = jQuery(this) ;

        var fhowl_df = {animateOut:false,animateIn:false,responsive: false, smartSpeed:1300,autoplay:false,items:1,loop:true, dots: false,center:false,autoWidth:false,autoHeight:false,thumbs:false};
        var fhowl_ops = fhowl.data('options') ? fhowl.data('options') : {};
        fhowl_ops = jQuery.extend({}, fhowl_df, fhowl_ops);

        if(fhowl_ops.responsive){
                var respArr = fhowl_ops.responsive.split(',');
                fhowl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    fhowl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };

                }
            }else{
                fhowl_ops.responsive = false;
            }

        fhowl.owlCarousel({
            autoWidth: fhowl_ops.autoWidth,
            autoHeight: fhowl_ops.autoHeight,
            margin: 0,
            items: fhowl_ops.items,
            smartSpeed: fhowl_ops.smartSpeed,
            loop: fhowl_ops.loop,
            autoplay: fhowl_ops.autoplay,
            center: fhowl_ops.center,
            nav: false,
            dots: fhowl_ops.dots,
            //thumbs: fhowl_ops.thumbs,
            responsive: fhowl_ops.responsive,
            // thumbImage: true,
            // thumbContainerClass: "owl-thumbs",
            // thumbItemClass: "owl-thumb-item",

            animateOut: fhowl_ops.animateOut,
            animateIn: fhowl_ops.animateIn,
        });

        jQuery(".fullwidth-slider-holder a.next-slide").on("click", function() {
            jQuery(this).closest(".fullwidth-slider-holder").find(fhowl).trigger("next.owl.carousel");
        });
        jQuery(".fullwidth-slider-holder  a.prev-slide").on("click", function() {
            jQuery(this).closest(".fullwidth-slider-holder").find(fhowl).trigger("prev.owl.carousel");
        });


    });



    // var b = jQuery(".fullwidth-slider");
    // var optionsData = b.data('options') ? JSON.parse(decodeURIComponent(b.data('options'))) : {slidespeed:500,singleitem:true,autoplay:false};
    // b.owlCarousel({
    //     navigation: false,
    //     slideSpeed: optionsData.slidespeed,
    //     singleItem: optionsData.singleitem,
    //     pagination: true,
    //     autoPlay  : optionsData.autoplay,
    //     autoHeight:true,
        
    // });
    // jQuery(".fullwidth-slider-holder a.next-slide").on("click", function() {
    //     jQuery(this).closest(".fullwidth-slider-holder").find(b).trigger("owl.next");
    // });
    // jQuery(".fullwidth-slider-holder  a.prev-slide").on("click", function() {
    //     jQuery(this).closest(".fullwidth-slider-holder").find(b).trigger("owl.prev");
    // });
    // var c = jQuery(".fullscreen-slider");
    // c.owlCarousel({
    //     navigation: false,
    //     slideSpeed: 500,
    //     singleItem: true,
    //     pagination: true
    // });
    // jQuery(".fullscreen-slider-holder a.next-slide").on("click", function() {
    //     jQuery(this).closest(".fullscreen-slider-holder").find(c).trigger("owl.next");
    // });
    // jQuery(".fullscreen-slider-holder a.prev-slide").on("click", function() {
    //     jQuery(this).closest(".fullscreen-slider-holder").find(c).trigger("owl.prev");
    // });
    jQuery(".post_thumb_slider").each(function(){

        var fhowl = jQuery(this) ;

        var fhowl_df = {animateOut:false,animateIn:false,responsive: false, smartSpeed:1300,autoplay:false,items:1,loop:true, dots: true, nav: false,center:false,autoWidth:false,autoHeight:false,thumbs:false};
        var fhowl_ops = fhowl.data('options') ? fhowl.data('options') : {};
        fhowl_ops = jQuery.extend({}, fhowl_df, fhowl_ops);

        if(fhowl_ops.responsive){
                var respArr = fhowl_ops.responsive.split(',');
                fhowl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    fhowl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };

                }
            }else{
                fhowl_ops.responsive = false;
            }

        fhowl.owlCarousel({
            autoWidth: fhowl_ops.autoWidth,
            autoHeight: fhowl_ops.autoHeight,
            margin: 0,
            items: fhowl_ops.items,
            smartSpeed: fhowl_ops.smartSpeed,
            loop: fhowl_ops.loop,
            autoplay: fhowl_ops.autoplay,
            center: fhowl_ops.center,
            nav: fhowl_ops.nav,
            dots: fhowl_ops.dots,
            //thumbs: fhowl_ops.thumbs,
            responsive: fhowl_ops.responsive,
            // thumbImage: true,
            // thumbContainerClass: "owl-thumbs",
            // thumbItemClass: "owl-thumb-item",

            animateOut: fhowl_ops.animateOut,
            animateIn: fhowl_ops.animateIn,
        });

    });

    function d() {
        var a = document.querySelectorAll(".intense");
        if(a.length){
            Intense(a);
        }
        
    }
    d();
	// swiper ------------------
    var e = jQuery("#horizontal-slider").data("mwc");
    var ec = jQuery("#horizontal-slider").data("mwa");
    var sp = jQuery("#horizontal-slider").data("mws");
    var l = jQuery("#horizontal-slider").data("mwl");
	var d = jQuery("#horizontal-slider").data("mwd");
    var ef = 'slide';
    var ops = {};
        if(sp != 'undefined'){
            ops.speed = parseInt(sp);
        }
        if(l != 'undefined'){
            ops.loop = l;
        }
        ops.preventLinks = true;
        ops.grabCursor = true;
        if(e != 'undefined'){
            ops.mousewheelControl = e;
        }
        if(jQuery(window).width() < 1036){
            ops.mousewheelForceToAxis = true;
        }
        //mousewheelForceToAxis
        //ops.mode = "horizontal";
        // ops.mode = d;
        ops.direction = d;
        ops.pagination = ".pagination";
        ops.paginationClickable = true;
        if(ec != 'undefined'){
            ops.autoplay = parseInt(ec);
        }
        // ops.onClick = function(sw, ev){
        //     sw.swipeNext();
        // }  
        if(ef != 'undefined'){
            ops.effect = ef;
        }

    var f = new Swiper("#horizontal-slider", ops);
    jQuery(".hor a.arrow-left").on("click", function(a) {
        a.preventDefault();
        f.slidePrev();
    });
    jQuery(".hor a.arrow-right").on("click", function(a) {
        a.preventDefault();
        f.slideNext();
    });


	// magnificPopup ------------------
    jQuery(".image-popup").magnificPopup({
        type: "image",
        closeOnContentClick: false,
        removalDelay: 600,
        mainClass: "my-mfp-slide-bottom",
        image: {
            verticalFit: false
        }
    });
    jQuery(".popup-youtube, .popup-vimeo , .show-map").magnificPopup({
        disableOn: 700,
        type: "iframe",
        removalDelay: 600,
        mainClass: "my-mfp-slide-bottom"
    });
    jQuery(".popup-gallery").each(function(){
        jQuery(this).magnificPopup({
            delegate: "a",
            type: "image",
            fixedContentPos: true,
            fixedBgPos: true,
            tLoading: "Loading image #%curr%...",
            removalDelay: 600,
            closeBtnInside: true,
            zoom: {
                enabled: true,
                duration: 700
            },
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [ 0, 1 ]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });
    });
    jQuery(".popup-gallery-story").each(function(){
        jQuery(this).magnificPopup({
            delegate: "a",
            type: "image",
            fixedContentPos: true,
            fixedBgPos: true,
            tLoading: "Loading image #%curr%...",
            removalDelay: 600,
            closeBtnInside: true,
            zoom: {
                enabled: true,
                duration: 700
            },
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [ 0, 1 ]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });
    });
    jQuery(".popup-gallery-portfolio").each(function(){
        jQuery(this).magnificPopup({
            delegate: "a",
            type: "image",
            fixedContentPos: true,
            fixedBgPos: true,
            tLoading: "Loading image #%curr%...",
            removalDelay: 600,
            closeBtnInside: true,
            zoom: {
                enabled: true,
                duration: 700
            },
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [ 0, 1 ]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });
    });
    jQuery(".folio-gallery").each(function(){
        jQuery(this).magnificPopup({
            delegate: ".gallery-item:not([style*='display: none']) .folio-popup-gallery",
            type: "image",
            fixedContentPos: true,
            fixedBgPos: true,
            tLoading: "Loading image #%curr%...",
            removalDelay: 600,
            closeBtnInside: true,
            zoom: {
                enabled: true,
                duration: 700,
                // The "opener" function should return the element from which popup will be zoomed in
                // and to which popup will be scaled down
                // By defailt it looks for an image tag:
                opener: function(openerElement) {
                    // openerElement is the element on which popup was initialized, in this case its <a> tag
                    // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                    return openerElement.is('img') ? openerElement : openerElement.closest('.grid-item-holder').find('img');
                }
            },
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [ 0, 1 ]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            }
        });

    });

    if(domik_obj.rtl === '1'){
        jQuery(".hide-column").bind("click", function() {
            jQuery(".not-vis-column").animate({
                left: "-100%"
            }, 500);
        });
        jQuery(".show-info").bind("click", function() {
            jQuery(".not-vis-column").animate({
                left: "0"
            }, 500);
        });
    }else{
        jQuery(".hide-column").bind("click", function() {
            jQuery(".not-vis-column").animate({
                right: "-100%"
            }, 500);
        });
        jQuery(".show-info").bind("click", function() {
            jQuery(".not-vis-column").animate({
                right: "0"
            }, 500);
        });
    }
    
	// owl carousel ------------------
    jQuery(".fullheight-carousel").each(function(){

        var fhowl = jQuery(this) ;

        var fhowl_df = {animateOut:false,animateIn:false,responsive: false, smartSpeed:1300,autoplay:false,items:4,loop:true, dots: false,center:false,autoWidth:false,thumbs:false};
        var fhowl_ops = fhowl.data('options') ? fhowl.data('options') : {};
        fhowl_ops = jQuery.extend({}, fhowl_df, fhowl_ops);

        if(fhowl_ops.responsive){
                var respArr = fhowl_ops.responsive.split(',');
                fhowl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    fhowl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };

                }
            }else{
                fhowl_ops.responsive = false;
            }

        fhowl.owlCarousel({
            autoWidth: false,
            margin: 0,
            items: fhowl_ops.items,
            smartSpeed: fhowl_ops.smartSpeed,
            loop: fhowl_ops.loop,
            autoplay: fhowl_ops.autoplay,
            center: fhowl_ops.center,
            nav: false,
            dots: fhowl_ops.dots,
            //thumbs: fhowl_ops.thumbs,
            responsive: fhowl_ops.responsive,
            // thumbImage: true,
            // thumbContainerClass: "owl-thumbs",
            // thumbItemClass: "owl-thumb-item",

            animateOut: fhowl_ops.animateOut,
            animateIn: fhowl_ops.animateIn,

            // onInitialized: function() {
            //     jQuery(".num-holder2").text("1" + " of " + this.items().length);
            // }
        });

        jQuery(".fullheight-carousel-holder a.next-slide").on("click", function() {
            jQuery(this).closest(".fullheight-carousel-holder").find(fhowl).trigger("next.owl.carousel");
        });
        jQuery(".fullheight-carousel-holder a.prev-slide").on("click", function() {
            jQuery(this).closest(".fullheight-carousel-holder").find(fhowl).trigger("prev.owl.carousel");
        });
        fhowl.find(".carousel-link-holder").hover(function() {
            jQuery(this).parent(".carousel-item").addClass("vis-decor");
        }, function() {
            jQuery(this).parent(".carousel-item").removeClass("vis-decor");
        });


    });


    var full_in_mousewheel_pro = false;
    jQuery(".mousecontr").each(function(){
        var slider = jQuery(this);
        
        slider.on("translated.owl.carousel", function(a) {
            full_in_mousewheel_pro = false;
        });
        
        slider.on("mousewheel", ".owl-stage", function(a) {
            if(!full_in_mousewheel_pro) {
                full_in_mousewheel_pro = true;
                if (a.deltaY < 0) slider.trigger("next.owl"); else slider.trigger("prev.owl");
            }
            a.preventDefault();
        });
    });
    jQuery(".keyboardcontr").each(function(){
        var slider = jQuery(this);
        jQuery(document).on('keydown.slider-carousel', function(e) {
            if(e.keyCode == 37) {
                slider.trigger("prev.owl");
            };
            if(e.keyCode == 39) {
                slider.trigger("next.owl");
            };
        });
    });

    jQuery(".refreshowlonresize").each(function(){
        var slider = jQuery(this);
        jQuery(window).on('resize',function(){
            if(slider.find(".owl-stage-outer").length) slider.trigger('refresh.owl.carousel');
        });
    });


    // var g = jQuery(".fullheight-carousel");
    // var ful_h_c_ops = g.data('options') ? JSON.parse(decodeURIComponent(g.data('options'))) : {slidespeed:500,singleitem:false,autoplay:false,items:4};
    // g.owlCarousel({
    //     navigation: false,
    //     slideSpeed: ful_h_c_ops.slidespeed,
    //     items: ful_h_c_ops.items,
    //     singleItem: ful_h_c_ops.singleitem,
    //     pagination: false,
    //     autoPlay  : ful_h_c_ops.autoplay,
    // });
    // jQuery(".fullheight-carousel-holder a.next-slide").on("click", function() {
    //     jQuery(this).closest(".fullheight-carousel-holder").find(g).trigger("owl.next");
    // });
    // jQuery(".fullheight-carousel-holder a.prev-slide").on("click", function() {
    //     jQuery(this).closest(".fullheight-carousel-holder").find(g).trigger("owl.prev");
    // });
    // jQuery(".carousel-link-holder").hover(function() {
    //     jQuery(this).parent(".carousel-item").addClass("vis-decor");
    // }, function() {
    //     jQuery(this).parent(".carousel-item").removeClass("vis-decor");
    // });
    // var h = jQuery(".single-slider");
    // h.owlCarousel({
    //     singleItem: true,
    //     slideSpeed: 1000,
    //     navigation: false,
    //     pagination: true,
    //     responsiveRefreshRate: 200,
    //     autoHeight: true
    // });
    // jQuery(".single-slider-holder a.next-slide").on("click", function() {
    //     jQuery(this).closest(".portfolio-slider-holder").find(h).trigger("owl.next");
    // });
    // jQuery(".single-slider-holder a.prev-slide").on("click", function() {
    //     jQuery(this).closest(".single-slider-holder").find(h).trigger("owl.prev");
    // });
	//counter ------------------
    var i = 1;
    jQuery(document.body).on("appear", ".stats", function(a) {
        if (1 === i) k(2600);
        i++;
    });
    function j(a, b, c, d) {
        if (d) {
            var e = 0;
            var f = parseInt(d / a);
            var g = setInterval(function() {
                if (e - 1 < a) c.html(e); else {
                    c.html(b);
                    clearInterval(g);
                }
                e++;
            }, f);
        } else c.html(b);
    }
    function k(a) {
        jQuery(".stats .num").each(function() {
            var b = jQuery(this);
            var c = b.attr("data-num");
            var d = b.attr("data-content");
            j(c, d, b, a);
        });
    }
    jQuery(".animaper").appear();
	// video  ------------------
    // var l = jQuery(".background-video").data("vid");
    // var m = jQuery(".background-video").data("mv");
    // var ct = jQuery(".background-video").data("ct");
    // jQuery(".background-video").YTPlayer({
    //     fitToBackground: true,
    //     videoId: l,
    //     pauseOnScroll: true,
    //     mute: m,
    //     playerVars: {
    //         controls: ct,
    //     },
    //     callback: function() {
    //         var a = jQuery(".background-video").data("ytPlayer").player;
    //     }
    // });

    jQuery(".player").YTPlayer();

	// isotope ------------------

    function initisotop2() {
        if (jQuery(".gallery-itemss").length) {

            jQuery(".gallery-itemss").each(function(){
                var as = jQuery(this).isotope({
                    itemSelector: ".gallery-ites, .gallery-item-seconds, .gallery-item-threes",
                    percentPosition: true,
                    masonry: {
                        // use outer width of grid-sizer for columnWidth
                        columnWidth: ".grid-sizers, .grid-sizer-seconds, .grid-sizer-threes",
                    },
                    // transformsEnabled: true,
                    // transitionDuration: "700ms",
                    // resizable: true
                });
                as.imagesLoaded(function() {
                    as.isotope("layout");
                });
            });
        }
    }
    initisotop2();


    var l_more_num = 2;
    function n() {

        if (jQuery(".gallery-items").length) {
            jQuery(".gallery-items").each(function(){
                var galiso = jQuery(this).isotope({
                    itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three",
                    percentPosition: true,
                    masonry: {
                        // use outer width of grid-sizer for columnWidth
                        columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                    },
                });
                galiso.imagesLoaded(function() {
                    galiso.isotope("layout");
                });
                jQuery(".gallery-filters").on("click", "a.gallery-filter", function(b) {
                    b.preventDefault();
                    var c = jQuery(this).attr("data-filter");
                    galiso.isotope({
                        filter: c
                    });
                    jQuery(".gallery-filters a.gallery-filter").removeClass("gallery-filter-active");
                    jQuery(this).addClass("gallery-filter-active");
                    return false;
                });


                /*infinite scroll*/

                var win = jQuery(window);

                var in_scroll_progress = false;

                var scroll_offset = 0;

                // Each time the user scrolls
                win.scroll(function() {
                    // End of the document reached?
                    /*check for gallery */
                    if(jQuery('.gallery-load-more').length){

                        if(jQuery('.gallery-load-more').scrollTop()){
                            var compare_pos = jQuery('.gallery-load-more').scrollTop();
                        }else{
                            var lm_anchor_pos = jQuery('.gallery-load-more').offset() ;
                            var compare_pos = lm_anchor_pos.top;
                        }

                        if (win.scrollTop() >= compare_pos - win.height() + scroll_offset ) {
                            if(!in_scroll_progress){
                                
                                in_scroll_progress = true;

                                var lm_btn = jQuery('.gallery-load-more');
                                var click_num = lm_btn.attr('data-click')? lm_btn.attr('data-click') : 1;
                                var remain = lm_btn.attr('data-remain')? lm_btn.attr('data-remain') : 'no';
                                if(remain == 'yes'){
                                    var grid_hoder = lm_btn.closest('.domik_images_gallery_wrap').children('.gallery-items');
                                    var ajaxurl = grid_hoder.data('lm-request');
                                    var lm_settings = grid_hoder.data('lm-settings')? grid_hoder.data('lm-settings'): {action:'domik_lm_gal',lmore_items:3,images:'',loaded:10};
                                    
                                    lm_btn.closest('.gallery-lmore-holder').css('visibility','visible');

                                    var ajaxdata = {
                                        action: lm_settings['action'],
                                        _lmnonce: grid_hoder.data('lm-nonce'),
                                        wp_query : lm_settings,
                                        click_num: click_num
                                    };
                                    //console.log(ajaxdata);

                                    jQuery.ajax({
                                        type: "POST",
                                        data: ajaxdata,
                                        url: ajaxurl,
                                        success: function(d) {
                                            // console.log(d);
                                            lm_btn.closest('.gallery-lmore-holder').css('visibility','hidden');
                                            if(d.status == 'fail'){
                                                lm_btn.attr('data-remain','no');
                                                lm_btn.closest('.gallery-lmore-holder').remove();

                                            }else if(d.status == 'success'){
                                                galiso.isotope();
                                                galiso.isotope( 'insert', jQuery(d.content) );
                                                galiso.imagesLoaded(function() {
                                                    galiso.isotope("layout");
                                                });

                                                if(d.is_remaining == 'no'){
                                                    lm_btn.attr('data-remain','no');
                                                    lm_btn.closest('.gallery-lmore-holder').remove();
                                                    
                                                }
                                            }

                                            lm_btn.attr('data-click',++click_num);

                                            in_scroll_progress = false;
                                            
                                        }
                                    });//end ajax


                                }//end remain
                                    
                            }//end in_scroll_progress
                        }//end compare position
                    }
                    /*check for portfolio */
                    if(jQuery('.folio-load-more').length){

                        if(jQuery('.folio-load-more').scrollTop()){
                            var compare_pos = jQuery('.folio-load-more').scrollTop();
                        }else{
                            var lm_btn_pos = jQuery('.folio-load-more').offset() ;
                            var compare_pos = lm_btn_pos.top;
                        }
                        if (win.scrollTop() >= compare_pos - win.height() + scroll_offset ) {//win.scrollTop()) {

                            if(!in_scroll_progress){
                                
                                in_scroll_progress = true;

                                var lm_btn = jQuery('.folio-load-more');
                                var click_num = lm_btn.attr('data-click')? lm_btn.attr('data-click') : 1;
                                var remain = lm_btn.attr('data-remain')? lm_btn.attr('data-remain') : 'no';
                                var grid_hoder = lm_btn.closest('.folio-grid-folios-wrap').children('.gallery-items');
                                var ajaxurl = grid_hoder.data('lm-request');
                                var lm_settings = grid_hoder.data('lm-settings')? grid_hoder.data('lm-settings'): {action:'domik_lm_folio',lmore_items:3};

                                if(remain === 'yes'){

                                    lm_btn.closest('.folio-grid-lmore-holder').css('visibility','visible');

                                    var ajaxdata = {
                                        action: lm_settings['action'],
                                        _lmnonce: grid_hoder.data('lm-nonce'),
                                        wp_query : lm_settings,
                                        click_num: click_num
                                    };

                                    //console.log(ajaxdata);

                                    jQuery.ajax({
                                        type: "POST",
                                        data: ajaxdata,
                                        url: ajaxurl,
                                        success: function(d) {
                                            //console.log(d);
                                            lm_btn.closest('.folio-grid-lmore-holder').css('visibility','hidden');
                                            if(d.status == 'fail'){

                                                lm_btn.attr('data-remain','no');
                                                lm_btn.closest('.folio-grid-lmore-holder').remove();

                                            }else if(d.status == 'success'){
                                                galiso.isotope();
                                                galiso.isotope( 'insert', jQuery(d.content) );
                                                galiso.imagesLoaded(function() {
                                                    galiso.isotope("layout");
                                                });

                                                var j = jQuery(".gallery-item").length;
                                                jQuery(".all-album").html(j);

                                                if(d.is_remaining == 'no'){
                                                    
                                                    lm_btn.attr('data-remain','no');
                                                    lm_btn.closest('.folio-grid-lmore-holder').remove();
                                                }
                                            }

                                            lm_btn.attr('data-click',++click_num);

                                            in_scroll_progress = false;
                                            
                                        }
                                    });


                                }

                            }
                        }
                    }

                    
                });
                /*infinite scroll - end */


                // jQuery(document).on( "click.lmore-fl", '.iso-load-more', function(event) {
                //     event.preventDefault();
                //     // event.stopPropagation();
                //     var url = jQuery(this).attr('href');
                //     jQuery.get( url + l_more_num, function(data,textStatus) {
                //         var items = jQuery(data).find("#port-container").html();

                //         if(!items){
                //             jQuery("#loadmore-cus").remove();
                //         }



                //         galiso.isotope( 'insert', jQuery(items) );

                //         galiso.imagesLoaded(function() {
                //             galiso.isotope("layout");
                //         });

                //     }).fail(function() {
                //         jQuery("#loadmore-cus").remove();
                //     });
                //     l_more_num++;

                // });

            });

        }



    }
    n();
    // jQuery(window).load(function() {
    //     n();
    // });
	jQuery('.slide-title a , .box-item a.ajax , .carousel-link-holder').on('click',function(){
		jQuery('nav a').removeClass('act-link');
		jQuery('.pp').addClass('act-link');
	});
    jQuery('.logo-holder a.ajax').on('click',function(){
        jQuery('nav a').removeClass('act-link');
        jQuery('.ph').addClass('act-link');
    });
	jQuery('.single-title a').on('click',function(){
		jQuery('nav a').removeClass('act-link');
		jQuery('.pa').addClass('act-link');
	});
	// content functions ------------------
    jQuery(".team-box").hover(function() {
        jQuery(this).find("ul.team-social").fadeIn();
        jQuery(this).find(".team-social a").each(function(a) {
            var b = jQuery(this);
            setTimeout(function() {
                b.animate({
                    opacity: 1,
                    top: "0"
                }, 400);
            }, 150 * a);
        });
    }, function() {
        jQuery(this).find(".team-social a").each(function(a) {
            var b = jQuery(this);
            setTimeout(function() {
                b.animate({
                    opacity: 0,
                    top: "50px"
                }, 400);
            }, 150 * a);
        });
        setTimeout(function() {
            jQuery(this).find("ul.team-social").fadeOut();
        }, 150);
    });
    jQuery(".to-top").click(function() {
        jQuery("html, body").animate({
            scrollTop: 0
        }, "slow");
    });
    function o() {
        jQuery(".gallery-filters").removeClass("vis-filter").fadeIn(10);
        setTimeout(function() {
            jQuery(".gallery-filters a").each(function(a) {
                var b = jQuery(this);
                setTimeout(function() {
                    b.animate({
                        opacity: 1,
                        top: 0
                    }, 600, "easeOutCubic");
                }, 150 * a);
            });
        }, 250);
    }
    function p() {
        jQuery(".gallery-filters").addClass("vis-filter");
        jQuery(".gallery-filters a").each(function(a) {
            var b = jQuery(this);
            setTimeout(function() {
                b.animate({
                    opacity: 0,
                    top: "50px"
                }, 600, "easeOutCubic");
            }, 150 * a);
        });
        setTimeout(function() {
            jQuery(".gallery-filters").fadeOut(100);
        }, 650);
    }
    jQuery(".filter-button").on("click", function() {
        if (jQuery(".gallery-filters").hasClass("vis-filter")) o(); else p();
        return false;
    });
    jQuery.fn.duplicate = function(a, b) {
        var c = [];
        for (var d = 0; d < a; d++) jQuery.merge(c, this.clone(b).get());
        return this.pushStack(c);
    };
    jQuery("<div class='scale-callback'></div>").duplicate(12).appendTo(".img-wrap");
    jQuery(".custom-scroll-link").on("click", function() {
        var a = 74;
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") || location.hostname == this.hostname) {
            var b = jQuery(this.hash);
            b = b.length ? b : jQuery("[name=" + this.hash.slice(1) + "]");
            if (b.length) {
                jQuery("html,body").animate({
                    scrollTop: b.offset().top - a
                }, {
                    queue: false,
                    duration: 800,
                    easing: "easeInOutExpo"
                });
                return false;
            }
        }
    });
    var mobileHover = function () {
        jQuery('.gallery-item .box-item , nav li').on('touchstart', function () {
            jQuery(this).trigger('hover');
        }).on('touchend', function () {
            jQuery(this).trigger('hover');
        });
    };

    mobileHover();

    jQuery('#ajax-page-inline-css').remove();
    if(jQuery('#ajax-page-inline-div-css').length){
        jQuery( '<style id="ajax-page-inline-css" type="text/css">'+jQuery('#ajax-page-inline-div-css').text()+"</style>" ).appendTo( "head" );
    }

    //portfolio external link
    jQuery('.folio-external-link').on('click', function(e){
        e.preventDefault();
        var href = jQuery(this).attr('href');
        window.open(href,'_blank');
    });

}
// if mobile remove parallax and video  ------------------
function initparallax() {
    var a = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
        }
    };
    trueMobile = a.any();
    if (null == trueMobile) {
        var b = jQuery(".content");
        b.find("[data-top-bottom]").length > 0 && b.waitForImages(function() {
            s = skrollr.init();
            s.destroy();
            skrollr.init({
                forceHeight: !1,
                easing: "outCubic",
                mobileCheck: function() {
                    return !1;
                }
            });
        });
    }
    if (trueMobile) jQuery(".background-video").remove();
}
// show hide content and init functions  ------------------
function contanimshow() {
    jQuery(".elem").removeClass("scale-bg2");
    setTimeout(function() {
        jQuery(".scale-callback").each(function(a) {
            var b = jQuery(this);
            setTimeout(function() {
                b.addClass("scale-bg5");
            }, 80 * a);
        });
    }, 450);
    setTimeout(function() {
        jQuery(".wrapper-inner").animate({
            opacity: 1
        }, 1500, function(){
            jQuery("footer").animate({
                opacity: 1
            }, 1500);
            jQuery(".bg-animate ").animate({
                opacity: 0.6
            }, 1500);
        });
    }, 550);
  //   setTimeout(function() {
  //       jQuery("footer").animate({
  //           opacity: 1
  //       }, 1500);
		// jQuery(".bg-animate ").animate({
  //           opacity: 0.6
  //       }, 1500);		
  //   }, 650);
}

function contanimhide() {
    setTimeout(function() {
        jQuery(".elem").addClass("scale-bg2");
    }, 650);
}
// share ------------------
// if(domik_obj.social){
//     jQuery(".shareSelector").socialShare({
//         social: domik_obj.social,
//         whenSelect: true,
//         selectContainer: ".shareSelector",
//         blur: false
//     });
// }

if(jQuery(".shareSelector").length){
    jQuery(".shareSelector").each(function(){
        var that = jQuery(this);
        var shn = that.data('sharenames');
        if(shn){
            that.socialShare({
                social: shn,
                whenSelect: true,
                selectContainer: ".shareSelector",
                blur: false
            });
        }

    });
    
}

var shrcn = jQuery(".share-container"), nb = jQuery(".nav-button"), nh = jQuery(".nav-holder"), an = jQuery(".nav-holder ,.nav-button ");
function showShare() {
    shrcn.fadeIn();
    an.animate({
        opacity: 0
    }, 550);
    shrcn.removeClass("isShare");
    setTimeout(function() {
        jQuery(".arthref").addClass("inshare");
        jQuery(".arthref .icon-container ul li").each(function(a) {
            var b = jQuery(this);
            setTimeout(function() {
                b.animate({
                    opacity: 1,
                    top: 0
                }, 500);
            }, 120 * a);
        });
    }, 400);
}
function hideShare() {
    shrcn.addClass("isShare");
    jQuery(".arthrefSocialShare").find("ul").removeClass("active");
    jQuery(".arthref .icon-container ul li").each(function(a) {
        var b = jQuery(this);
        setTimeout(function() {
            b.animate({
                opacity: 0,
                top: "-150px"
            }, 500);
        }, 120 * a);
    });
    setTimeout(function() {
        jQuery(".arthrefSocialShare").remove();
        an.animate({
            opacity: 1
        }, 550);
        shrcn.fadeOut();
    }, 500);
}
jQuery(".selectMe").bind("click", function(a) {
    a.preventDefault();
    if (jQuery(".share-container").hasClass("isShare")) showShare(); else hideShare();
});
// jQuery('nav li a').on('click',function(){
//     jQuery('nav li a').removeClass('act-link');
//     jQuery(this).addClass('act-link');
//     var ww = jQuery(window).width();
//     if (ww < 1024) {
//        hideMenu();
//     }
// });
jQuery('nav li a').on('click',function(){
    jQuery('nav li a').removeClass('act-link');
    jQuery(this).addClass('act-link');
    var ww = jQuery(window).width();
    if (ww < 1037) {
       hideMenu();
    }
});
// mobile menu ------------------
function showMenu() {
    nb.removeClass("vis-m");
    nh.slideDown(500);
}
function hideMenu() {
    nb.addClass("vis-m");
    nh.slideUp(500);
}
nb.on("click", function() {
    if (jQuery(this).hasClass("vis-m")) showMenu(); else hideMenu();
});
//=============== init ajax  ==============

if(domik_obj.disable_ajax == '1'){
    jQuery(function(){
        readyFunctions();
    });
}else{
    jQuery(function() {
        jQuery.coretemp({
            ctbTrigger: "a.ajax",
            reloadbox: "#wrapper",
            loadErrorMessage: domik_obj.nf_tit, // 404 error text 
            loadErrorAddMessage: domik_obj.nf_msg, // 404 error text 
            loadErrorBacklinkText: domik_obj.nf_linktext, // 404 back button  text 
            loadErrorBg: domik_obj.nf_bg , //404 right bg
            outDuration: 250,
            inDuration: 150
        });
        readyFunctions();
        jQuery(document).on({
            ksctbCallback: function() {
                if("function" == typeof window.vc_js ) {
                    window.vc_js();
                }
                readyFunctions();
            }
        });
    });
}
//=============== init all functions  ==============
function readyFunctions() {
    initDomik();
    initparallax();
}