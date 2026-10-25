$.fn.hoverSubMenu = function () {
    var windowWidth, documentWidth;
    $(this).hover(
        function () {
            var menu = $(this).find('.sub-menu');
            var menuHeight = '-' + (menu.innerHeight() + 35) + 'px';
            //$(this).find('.top-nav-btn').addClass('top-nav-btn-active')
            menu.css('bottom', menuHeight)
            menu.fadeIn(100);
            windowWidth = $(window).width();
            documentWidth = $(document).width();
            if (windowWidth < documentWidth) {
                var leftPos = (windowWidth - documentWidth) - 35 + 'px';
                menu.css('left', leftPos)
            }
        },
        function () {
            //$(this).find('.top-nav-btn').removeClass('top-nav-btn-active')
            $(this).find('.sub-menu').fadeOut(100);
        }
    )
}
var layerOpenClose = function () {
    $('body').toggleClass('overflow-hidden')
    $('.layer').fadeToggle(200);
}
var headerSearch = function () {
    $('header .main-form').animate({
        width: '255px'
    }, 200);
    $('header .main-input').fadeIn(100);
    $('header').addClass('search-open')
}
var headerSearchClose = function () {
    $('header .main-input').animate({
        opacity: 0
    }, 500);
    $('header .main-form').animate({
        width: '45px'
    }, 200);
    setTimeout(function () {
        $('header .main-input').css('display', 'none');
        $('header .main-input').css('opacity', '1');
        $('header .main-input').val('')
    }, 700)
    $('header').removeClass('search-open')
}
var openFilterMore = function () {
    //$('body').toggleClass('overflow-hidden')
    $('.catalog-nav-filter').slideToggle(200);
}
var closeFilterMore = function () {
    $('.catalog-nav-more').removeClass('catalog-nav-more-open');
    $('.catalog-nav-filter').slideUp(200);
}
var countSlidesActive = function () {
    if ($('.slider-counter-number').length > 0) {
        $('.slider-counter-number').empty()
    }
    var active = $('.swiper-container-catalog-item .swiper-slide-active').attr('id');
    $('.slider-counter-number').text(active);
}
var countSlides = function () {
    if ($('.swiper-container-catalog-item').length > 0) {
        var i = 0;
        $('.swiper-container-catalog-item .swiper-slide').each(function () {
            i++;
            $(this).attr('id', i)
        })
        countSlidesActive()
        var last = $('.swiper-container-catalog-item .swiper-slide').last().attr('id');
        $('<span class="slider-counter-many-number">' + last + '</span>').appendTo('.slider-counter-many');
    }
}
var countSlidesLandingActive = function () {
    if ($('.slider-counter-number').length > 0) {
        $('.slider-counter-number').empty()
    }
    var active = $('.swiper-container-partner-landing .swiper-slide-active').attr('id');
    $('.slider-counter-number').text(active);
}
var countSlidesLanding = function () {
    if ($('.swiper-container-partner-landing').length > 0) {
        var i = 0;
        $('.swiper-container-partner-landing .swiper-slide').each(function () {
            i++;
            $(this).attr('id', i)
        })
        //countSlidesLandingActive()
        var last = $('.swiper-container-partner-landing .swiper-slide').last().attr('id');
        $('<span class="slider-counter-many-number">' + last + '</span>').appendTo('.slider-counter-many');
    }
}
var countHolders = function () {
    if ($('.catalog-item-firm-nav-a').length > 0) {
        var i = 0;
        $('.catalog-item-firm-nav-a').each(function () {
            i++;
            $(this).attr('id', i);
        })
        clickHolders()
    }
}
var clickHolders = function (thisItem) {
    var id = $('.catalog-item-firm-nav-a-active').attr('id');
    var whatFind = '.catalog-item-firm-holder-' + id;
    $('.catalog-item-firm-holder-this').hide();
    $('.catalog-item-firm-holder').find(whatFind).fadeIn(200);
}
var openCheme = function (thisItem) {
    var src = thisItem.find('img').attr('src');
    var id = '.' + thisItem.attr('id');
    src = src.substring(0, src.length - 4) + '-big.jpg';
    thisItem.find('img').clone().appendTo(id)
    $(id).find('img').attr('src', src);
    $(id).parent().fadeToggle();
    $('body').toggleClass('overflow-hidden')
}
var closeCheme = function (thisItem) {
    thisItem.parent().parent().fadeToggle();
    $('body').toggleClass('overflow-hidden');
    thisItem.next().remove();
}

$(document).ready(function () {

    if (!$('#bx-panel').length) {
        var cpos = true;
        if (Math.round(Math.random()) == 0)
            cpos = false;
        //$('.page').addtocopy({htmlcopytxt: '<br>Источник: <a href="'+window.location.href+'">'+window.location.href+'</a> ', minlen:10, addcopyfirst: cpos});
    }

    countSlides()
    countHolders()
    countSlidesLanding()

//if resize
    $(window).on('resize load', function () {
        //var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
    });

//input and textarea
    /* $('input,textarea').focus(function(){
         $(this).data('placeholder',$(this).attr('placeholder'))
         $(this).attr('placeholder','');
      });
      */
    $('input,textarea').blur(function () {
        $(this).attr('placeholder', $(this).data('placeholder'));
    });

//open sub menu
//	$('.with-sub-menu').hoverSubMenu();

//layer open and close
    $(document).on('click', '.butter', function () {
        layerOpenClose()
    })
    $(document).on('click', '.close', function () {
        layerOpenClose()
    })


    var serachFormShowTrigger = function () {
        var inputField = $("#title-search-input");
        var formTopSearch = $(".form.main-form.top-form");
        var url = formTopSearch.attr("action");

        if (inputField.val() != "") {
            formTopSearch.submit();

            //alert("test = "+url + "?"+formTopSearch.serialize());
            //window.location = url + "?"+formTopSearch.serialize();
            return false;
        }

        if ($('header').hasClass("search-open")) {
            console.log("headerSearchClose()1");
            headerSearchClose()
        }	//добавл¤е header-у клас Open (» мен¤ет ширину поиску)
        else {
            headerSearch();
            console.log("headerSearch()2");
        }
    }
//header search
    $(document).on('click', 'header .search', function () {
        if ($(window).width() > 1024)
            serachFormShowTrigger();
        else
            $('form.main-form.top-form').submit();
    })
    //$(document).on('click', 'header.search-open .search', function() {
    //	//удал¤ем у header-а класс open и мен¤ет ширину инпутам обратно
    //	console.log("headerSearchClose()");
    //	headerSearchClose()
    //})
    ////header search
    //$(document).on('click', '.main-form .search', function() {
    //	headerSearch();
    //	console.log("test1");
    //})
    //$(document).on('click', '.main-form.search-open .search', function() {
    //	headerSearchClose();
    //	console.log("test2");
    //})

//catalog nav
    /*
        $(document).on('click', '.catalog-nav-inner-href', function() {
            $(this).toggleClass('catalog-nav-inner-href-choosed');

        })
    */
    $(document).on('click', '.catalog-nav-sort', function () {
        $(this).toggleClass('catalog-nav-sort-changed');

    })
    $(document).on('click', '.catalog-nav-filter-block h2', function () {
        $(this).parent().toggleClass('catalog-nav-filter-block-open');
        $(this).next().slideToggle();
    })
    $(document).on('click', '.catalog-nav-more', function () {
        $(this).toggleClass('catalog-nav-more-open');
        openFilterMore()
    })
    $(document).click(function (event) {
        var target = $(event.target);
        if (!(target.hasClass('catalog-nav-more') || target.hasClass('catalog-nav-filter') || target.hasClass('catalog-nav-sub') || $(".catalog-nav-sub").find(target).length > 0 || $(".catalog-nav-more").find(target).length > 0 || $(".catalog-nav-filter").find(target).length > 0)) {
            closeFilterMore()
        } else {
            return
        }
    })
    $(document).on('click', '.catalog-item-firm-nav-a', function () {
        $('.catalog-item-firm-nav-a-active').removeClass('catalog-item-firm-nav-a-active');
        $(this).addClass('catalog-item-firm-nav-a-active');
        clickHolders();
    })

    /*
    var swiper = new Swiper('.swiper-container-main', {
      nextButton: '.main-slider-arrow-next',
      prevButton: '.main-slider-arrow-prev',
      loop: true,
      autoplay: 5000,
      speed: 400
  });*/
    /*
    var swiper2 = new Swiper('.swiper-container-second', {
        nextButton: '.second-slider-arrow-next',
        prevButton: '.second-slider-arrow-prev',
        slidesPerView: 2,
        pagination: '.swiper-pagination',
        paginationClickable: true,
        loop: true
    });
    */
    /*
    var swiper3 = new Swiper('.swiper-container-third', {
        nextButton: '.third-slider-arrow-next',
        prevButton: '.third-slider-arrow-prev',
        slidesPerView: 2
    });
    */
    /*
    var swiper4 = new Swiper('.swiper-container-fourth', {
        nextButton: '.fourth-slider-arrow-next',
        prevButton: '.fourth-slider-arrow-prev',
        slidesPerView: 3,
        loop: true
    });
    */
    var swiper5 = new Swiper('.swiper-container-partner-landing', {
        nextButton: '.partner-landing-slider-arrow-next',
        prevButton: '.partner-landing-slider-arrow-prev',
        onSlideChangeStart: function () {
            setTimeout(function () {
                countSlidesLandingActive()
            }, 100)
        }
    });

    $('#v_phone').mask("+7 (999) 999-99-99", {placeholder: " "});
    $('input[name="REGISTER[WORK_PHONE]"]').mask("+7 (999) 999-99-99", {placeholder: " "});

    if ($('.fixed-header').length)
        CheckToTop();

//end of ready function
    if ($(window).width() < 1024) {
        if ($('.catalog-item-promo-a').length) {
            $('.catalog-cols').prepend($('.catalog-item-promo-a').parent('.catalog-item'));
        }
    }
});

$(window).load(function () {
    if (!$('.header-second-line nav').is(':visible')) { // если мобильная версия
        $('.page img').each(function () {
            $(this).removeAttr('width').removeAttr('height');
        });
    }
//end of load function

});

$(window).scroll(function () {
    if ($('.fixed-header').length)
        CheckToTop();

//end of scroll function	
});

function CheckToTop() {
    if ($('.partners_header').length)
        var from_top = $('.partners_header').offset().top + $('.partners_header').outerHeight(true);
    else
        var from_top = $('header').offset().top + $('header').outerHeight(true);

    if ($(window).scrollTop() > from_top)
        $('.fixed-header').fadeIn(400);
    else
        $('.fixed-header').fadeOut(200);
}

$(document).ready(function () {
    var $page = $('.page:not(".layer-menu"):contains("#PLUS_END#")');
    if ($page.length) {
        $page.html($page.html().replace(/#PLUS#/ig, '<div class="ps_plus_slidedown_box open">'));
        $page.html($page.html().replace(/#PLUS_END#/ig, '</div>'));

        // console.log($page.find('.ps_plus_slidedown').length);

        $page.find('.ps_plus_slidedown_box').each(function () {
            $(this).prepend('<span class="ps_plus_slidedown_opener js-plus_close">+</span>');
            // console.log($(this).find('img').length);
            $(this).find('p:not(":first"), img').wrapAll('<div class="ps_plus_slidedown"></div>');
        });

        $('body').on('click', '.ps_plus_slidedown_box:has(".js-plus_close")', function (e) {
            if (!$(e.target).parents('.ps_plus_slidedown').length && !$(this).is('.ps_plus_slidedown')) {
                $(this).find('.ps_plus_slidedown').slideUp(300, function () {
                    $(this).parent().removeClass('open');
                    $(this).parent().find('.ps_plus_slidedown_opener').removeClass('js-plus_close').addClass('js-plus_open').text('+');
                });
            }
        });

        $('body').on('click', '.ps_plus_slidedown_box:has(".js-plus_open")', function (e) {
            if (!$(e.target).parents('.ps_plus_slidedown').length && !$(this).is('.ps_plus_slidedown')) {
                $(this).find('.ps_plus_slidedown').slideDown(300, function () {
                    $(this).parent().addClass('open');
                    $(this).parent().find('.ps_plus_slidedown_opener').removeClass('js-plus_open').addClass('js-plus_close').text('–');
                });
            }
        });

        $('.js-plus_close').click();
    }

    $(window).resize();

    //Ф-я для слайдера для мобильных экранов при клике по слайдеру
    $('.swiper-slide').on('click', function () {
        var w = $(window).width();
        var url = $(this).data('link');
        if (url != undefined) {
            window.location.href = url;
        }
    });

    //	if(!$('#bx-panel').length){
        //	$('.page p').DisableSelection();
    //};
    $(window).resize(function () {
        if ($(window).width() < 500) {
            if ($('.blog-header-img').length)
                $('.blog-header-img img').css('margin-bottom', $('.blog-header-img .h1').height() - 20 + 'px');
        }
        else
            $('.blog-header-img img').removeAttr('style');

        if ($('.wrap-back-botton').length) {
            $('.catalog-nav').css('padding-left', '75px');
        }
        else {
            $('.catalog-nav').css('padding-left', '45px');
        }
        if ($('.js-target-prop').length && $('.header-second-line .with-sub-menu:visible').length) {
            $('.navs-holder').show();
        }
        else {
            $('.navs-holder').hide();
        }

    });
    $(window).bind('orientationchange', function () {
        $(window).resize();
    });

    /* с header.php ***************************************************************************************************/

    $('.header-promo-fixed-mobile span').click(function () {
        $(this).next().slideToggle(100);
    });
    setInterval(function () {
        if ($('html, body').scrollTop() > 200)
            $('.header-promo-fixed-mobile').css('top', 80);
        else
            $('.header-promo-fixed-mobile').css('top', 200);
    }, 200);

    $('.hamburger').click(function () {
        $('body').toggleClass('is-reveal-open');
        $('.full.reveal.reveal-modal').toggleClass('without-overlay').fadeIn(300);
    });
    $('.full.reveal.reveal-modal .close-button').click(function () {
        $('body').toggleClass('is-reveal-open');
        $('.full.reveal.reveal-modal').toggleClass('without-overlay').fadeOut(300);
    });
    /* ??? для чего это было друг за другом ХЗ */
    $('.hamburger').click(function () {
        console.log('view');
        $('#site-reveal-menu').addClass('reveal_new_class_view');
        $('body').toggleClass('overflow-hidden')
    });
    $('.close-button').click(function () {
        console.log('noview');
        $('#site-reveal-menu').removeClass('reveal_new_class_view');
        $('body').toggleClass('overflow-hidden')
    });

    var height1 = $('.footer-block-p-js-1').height();
    var height2 = $('.footer-block-p-js-2').height();
    var height3 = $('.footer-block-p-js-3').height();
    if (height1 >= height2 && height1 >= height3) {
        var set_height = height1
    }
    if (height2 >= height1 && height2 >= height3) {
        var set_height = height2
    }
    if (height3 >= height1 && height3 >= height2) {
        var set_height = height3
    }
    var height1 = $('.footer-block-p-js-1').height(set_height);
    var height2 = $('.footer-block-p-js-2').height(set_height);
    var height3 = $('.footer-block-p-js-3').height(set_height);

    /* с footer.php ***************************************************************************************************/

    $('.pssb_fb').click(function (e) {
        e.preventDefault();
        window.open('https://www.facebook.com/sredaobi', '_blank');
    });
    $('.pssb_gp').click(function (e) {
        e.preventDefault();
        window.open('https://plus.google.com/u/0/106472826675463508738', '_blank');
    });
    $('.pssb_inst').click(function (e) {
        e.preventDefault();
        window.open('https://www.instagram.com/sreda_obitaniia/', '_blank');
    });
    $('.pssb_tw').click(function (e) {
        e.preventDefault();
        window.open('https://twitter.com/sredashop', '_blank');
    });
    $('.js-scroll').on('click', function () {
        var data_id = $(this).attr('data-id');
        var height = $(document).height();
        if (data_id == 'up') {
            $("html,body").animate({"scrollTop": 0}, "slow");
        } else {
            $("html,body").animate({"scrollTop": height}, "slow");
        }
    });

    $(window).scroll(function () {
        var height = $(document).height();
        if ($(window).scrollTop() == height / 2 || $(window).scrollTop() > height / 2) {
            $('.js-scroll').removeClass('arrow-page-ico-down');
            $('.js-scroll').addClass('arrow-page-ico-up');
            $('.js-scroll').attr('data-id', 'up');
        } else {
            $('.js-scroll').removeClass('arrow-page-ico-up');
            $('.js-scroll').addClass('arrow-page-ico-down');
            $('.js-scroll').attr('data-id', 'down');
        }
    });
});