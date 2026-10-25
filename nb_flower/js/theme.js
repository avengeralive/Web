jQuery(document).ready(function(){

    var flower_window_width = jQuery(window).width();
    jQuery(window).resize(function() {
        flower_window_width = jQuery(window).width();
    });
    
     ( function() {
        jQuery('#btt').fadeOut();
        jQuery(window).scroll(function() {
            if(jQuery(this).scrollTop() != 0) {
                jQuery('#btt').fadeIn();    
            } else {
                jQuery('#btt').fadeOut();
            }
        });

        jQuery('#btt').click(function() {
            jQuery('body,html').animate({scrollTop:0},800);
        });
    })();

    // Languages
    jQuery('.flower-lang').on('click',function(){
        jQuery(this).find('.flower-lang-sub').slideToggle(200);
    });
    // Mega menu
    jQuery( "#netbase-responsive-toggle" ).on("click",function(){
        jQuery("#mega-menu-primary").slideToggle(200);
    });
    // Best Seller
    jQuery('#flower-home1-best-seller .poduct-best-seller li.product').on('hover',function (){
        jQuery(this).find('.seller-detail').stop().slideToggle(400);
    });
    // Toogle Footer 
    function footer_toogle(){
        var footer_tabs = jQuery('#colophon .footer-column >.widget >h3');
        var footer_first = jQuery('#colophon #footer-1 h3.widget-title');
        if(flower_window_width <=991)
        {
            footer_tabs.siblings().stop().hide();
            footer_tabs.parent().nextAll().stop().hide();

            footer_first.siblings().show();
            footer_first.parent().nextAll().show();

            footer_tabs.on('click',function(){
                jQuery(this).siblings().stop().slideToggle();
                jQuery(this).parent().nextAll().stop().slideToggle();
            });
        }else{
            footer_tabs.siblings().show();
            footer_tabs.parent().nextAll().show();
        }
    }
    footer_toogle();
    jQuery(window).resize(function(){
        footer_toogle();
    });
    // Product Category
    jQuery('#shop-view-grid').on('click',function(){
        jQuery(this).addClass('active').next().removeClass('active');
        jQuery('.archive.woocommerce ul.products').addClass('grid').removeClass('list');
    });
    jQuery('#shop-view-list').on('click',function(){
        jQuery(this).addClass('active').prev().removeClass('active');
        jQuery('.archive.woocommerce ul.products').removeClass('grid').addClass('list');
    });
    // Product Deatail
    jQuery('.single-product .images .thumbnails').each(function(){
        jQuery(this).addClass('owl-carousel');
        jQuery('.single-product .images .thumbnails').owlCarousel({
            items:3,
            nav:true,
            dots:false,
            navText:[
                "<i class='fa fa-angle-left fa-2x'></i>",
                "<i class='fa fa-angle-right fa-2x'></i>"
            ],
            margin: 5,
            responsive: {
                0: {
                    items: 3,
                },
                480: {
                    items: 4,
                },
                600: {
                    items: 4,
                }                    
            }
        });
    });
    
    jQuery('.home3-step-four').closest('.panel-grid').addClass('four-wrapper');
    jQuery('.up-sells .products').each(function(){
        jQuery(this).addClass('owl-carousel');
        jQuery(this).owlCarousel({
            items:4,
            nav:true,
            dots:false,
            navText:[
                "<i class='fa fa-angle-left fa-2x'></i>",
                "<i class='fa fa-angle-right fa-2x'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                481: {
                    items: 2,
                },
                768: {
                    items: 4,
                }
            }
        });
    });

    jQuery('.template_tabs').owlCarousel({
        items:1,
        nav:true,
        dots:false,
        navText:[
            "<i class='fa fa-angle-left fa-2x'></i>",
            "<i class='fa fa-angle-right fa-2x'></i>"
        ]
    });

    jQuery('.wc-details-share-button').on('click',function(){
        jQuery(this).find('.button-wrap').slideToggle(200);
    });
    // Cart, Wishlist responsive
    jQuery(".woocommerce-cart table.cart").stacktable();
    // About
    jQuery("#flower-about-our-team .about-our-team").on({
        mouseenter: function () {
            jQuery(this).find('.about-our-team-info').find('.about-social').stop().show(500);
        },
        mouseleave: function () {
            jQuery(this).find('.about-our-team-info').find('.about-social').stop().hide(500);
        }
    });
    // Add To Cart Tool Tip
    jQuery('.product-content-info a.ajax_add_to_cart').on('click',function(){
        jQuery(this).find('.button-tooltip').text('Added');
    });
    // Add Quickview Text
    jQuery('.woocommerce a.yith-wcqv-button').append('<span class="button-tooltip">Quick View</span>');
    jQuery('.woocommerce a.compare').append('<span class="button-tooltip">Compare</span>');
    jQuery('.woocommerce .yith-wcwl-wishlistexistsbrowse').append('<span class="button-tooltip">Brower Wishlist</span>');
    jQuery('.woocommerce .yith-wcwl-wishlistaddedbrowse').append('<span class="button-tooltip">Brower Wishlist</span>');

    function trustView(elem){
        if( jQuery(elem).length ) {
            var bottomOfObject = jQuery(elem).offset().top;
            var bottomOfWindow = jQuery(window).scrollTop() + jQuery(window).height();
            if(bottomOfWindow > bottomOfObject){
                return true;
            }
        }
    }

    function addClassView(addClass, elem){
        if (trustView(elem) === true) {
            jQuery(addClass).addClass('inview');
        }
    }

    addClassView('#flower-shop-detail >.panel-grid-cell','#flower-shop-detail >.panel-grid-cell');
    addClassView('#countdown .time-wapper', '#countdown .time-wapper');
    addClassView('#flower-home1-blog-post .owl-item', '#flower-home1-blog-post .owl-item');
    addClassView('#flower_home1_our_services >.panel-grid-cell', '#flower_home1_our_services >.panel-grid-cell');
    addClassView('#home1-our-working .working-form >.panel-grid-cell', '#home1-our-working .working-form >.panel-grid-cell');

    jQuery(window).on('scroll', function() {
       addClassView('#flower-shop-detail >.panel-grid-cell','#flower-shop-detail >.panel-grid-cell');
       addClassView('#countdown .time-wapper', '#countdown .time-wapper');
       addClassView('#flower-home1-blog-post .owl-item', '#flower-home1-blog-post .owl-item');
       addClassView('#flower_home1_our_services >.panel-grid-cell', '#flower_home1_our_services >.panel-grid-cell');
       addClassView('#home1-our-working .working-form >.panel-grid-cell', '#home1-our-working .working-form >.panel-grid-cell');
    });
});