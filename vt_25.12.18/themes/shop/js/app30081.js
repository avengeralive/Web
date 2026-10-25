;
$(document).foundation();

(function($) {
  "use strict";
  $(function() {

    $(".necklace").slick({
      infinite: true,
      slidesToShow: 1,
      dots: true,
      dotsClass: 'slick-dots slick-dots-necklace',
      swipeToSlide: true,
      arrows: false,
      autoplay: true,
      fade: true,
      speed: 2000,
      autoplaySpeed: 2500,
    });

    $(".piano").slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      prevArrow: '<i class="slick-prev fa fa-angle-left fa-3x"> </i>',
      nextArrow: '<i class="slick-next fa fa-angle-right fa-3x"> </i>',
      responsive: [


        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,

          }
        },
        {
          breakpoint: 960,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,

          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
    $(".star-clients__slider").slick({
      infinite: true,
      autoplay: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      prevArrow: '<i class="slick-prev slick-prev__star-clients fa fa-angle-left fa-2x slick-arrow" style="display: block; top: 90px; left: -30px;  color:#56483a;"> </i>',
      nextArrow: '<i class="slick-next slick-next__star-clients fa fa-angle-right fa-2x slick-arrow" style="display: block; top: 90px; right: -30px; color:#56483a;"> </i>',
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,

          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });

    $(".lone-star__slider").slick({
      infinite: true,
      swipeToSlide: true,
      arrows: false,
      autoplay: true,
      fade: true,
      dots: true,
    });
    //begin of .bar fix of height on IOS
    function fixHeight() {
      var windowHeight = $(window).height();
      var currentHeightOfBar = $('.bar').outerHeight();
      if (currentHeightOfBar != windowHeight) {
        $('.bar').height(windowHeight);
      }
    }
    $(window).on('load', function() {
      fixHeight();
    });
    $(window).on('resize', function() {
      fixHeight();
    });
    //end of .bar fix of height on IOS
    //begin of sticky information in header
    if ( !($('header + div').hasClass('beads')) == false  && $(window).width()>768) {
      $('header').height(224).find('.sticky').css('transform', 'none');
      $('.header__logo').css({
        'position': 'fixed',
        'top':0
      });
    }
    else {
      $('.beads').remove();
    }
    $(window).scroll(function() {
      var $infoBlock = $('.js-information');
      if ($infoBlock.length > 0) {

        var posAnchor = $infoBlock.offset().top;
        var scrollTop = window.pageYOffset;
        if (scrollTop >= posAnchor) {
          var offSetHeader = $('header').offset().top;
          //$('#somethingTop').animate({
          //  opacity: 0,
          //   height: 0
          //}, 300); //.hide(300);
          //history.pushState(null, null, '/jewellry');
          // $('.sticky').removeClass('sticky is-stuck is-at-top');
          $('.header__logo').css({
            'position': 'static'
          });
          $('header').height('auto');
          $('.beads').remove();
          $('.header__info').removeClass('hide');
          /*if ($(document).scrollTop() != 0) {
            $('html, body').animate({
              scrollTop: 0
            }, 300);
          }*/

          // } else {
          //     $('.sticky').removeClass('js-information');
          //     $('.header__info').addClass('hide');
        }

      } else {
        $('.sticky').addClass('js-information');
        $('.header__info').removeClass('hide');
      }
    });

    //end of sticky information in header
    //begin of jquery input type="file" help function
    $(document).ready(function() {
      $(".file__upload input[type=file]").change(function() {
        var filename = $(this).val().replace(/.*\\/, "");
        $(this).closest('.file').find(".file__main").val(filename);
      });
    });


    /*$(".stocksitem h4").click(function(){
      $(this).parent().parent().parent().parent().toggleClass('active');
      return false;
    });*/

    //end of jquery input type="file" help function
    //begin of bracelet open click menu
    var thisElementBracelet;
    $('.bracelet').click(function() {
      $('.bracelet').parent().css('margin-bottom', 0);
      thisElementBracelet= $(this);
      var MBThisElementBracelet = thisElementBracelet.css('margin-bottom');

      if ( !($(this).hasClass('bracelet_star')) ) {
        //reinit Equalizer для components/shop/_drop-prod only $('.bracelet')
        Foundation.reInit('equalizer');
      }


      var num = $(this).closest('.columns').index();
      var $filter = $(this).closest('.row').next().find('>.columns').eq(num).find('.filter')

      var triangleLeftPos = num * 33.33 + 16.66;
      var triangleWidth = 42;
      var productHeight = $(this).parent().height();
      if ($(this).hasClass('bracelete-pop'))
      {
        $('.bracelet').removeClass('js-open');
        $(this).addClass('js-open');
        if ($filter.hasClass('hide'))
        {
          $('.footer').css('margin-bottom', '500px');
          $('.filter_product').addClass('hide');
          $filter.toggleClass('hide');
        }
        else
        {
          $('.bracelet').removeClass('js-open');
          $('.filter_product').addClass('hide');
          clearUrlVar('id');
          thisElementBracelet.parent().css('margin-bottom', '0');
        }

      }
      else
      {
        $('.bracelet').removeClass('js-open');
        $(this).addClass('js-open');
        if ($filter.hasClass('hide')) {
          $('.filter_product').addClass('hide');
          $filter.toggleClass('hide');
          setUrlVar('id', $(this).attr('id'));
        } else {
          $('.bracelet').removeClass('js-open');
          $('.filter_product').addClass('hide');
          clearUrlVar('id');
          thisElementBracelet.parent().css('margin-bottom', '0');
        }
      }

      //new arrow coordinates if is popular items list
      if ($(this).hasClass('bracelete-pop')) {
        triangleLeftPos = num * 16.66 + 8.33;
        $filter.find('.filter__triangle').attr('style', 'left:calc( ' + triangleLeftPos + '% - ' + triangleWidth / 2 + 'px);')
      }
      else {
        if (num == 0) $filter.find('.filter__triangle').attr('style', 'left:calc(100%/6 - 17px);');
        if (num == 1) $filter.find('.filter__triangle').attr('style', 'left:calc(300%/6 - 17px);');
        if (num == 2) $filter.find('.filter__triangle').attr('style', 'left:calc(500%/6 - 17px);');
      }

      //new arrow coordinates stars-clients-new.html
      if ($(this).hasClass('bracelet_star')) {
        var windowWidth = $(window).width();
        if (windowWidth >= 640 ) {
          if (windowWidth >= 640 && windowWidth < 1200) {
            triangleLeftPos = num * 36.66 + 13.33;
            switch (num) {
              case 0:
              $filter.find('.filter__triangle').attr('style', 'left:calc( ' + triangleLeftPos + '% - ' + (triangleWidth / 2 - 30) + 'px);');
              break;
              case 2:
              $filter.find('.filter__triangle').attr('style', 'left:calc( ' + triangleLeftPos + '% - ' + (triangleWidth / 2 + 30) + 'px);');
              break;
              default:
              $filter.find('.filter__triangle').attr('style', 'left:calc( ' + triangleLeftPos + '% - ' + triangleWidth / 2 + 'px);');
            }
          } else if (windowWidth >= 1200 && windowWidth < 1440) {
            triangleLeftPos = (num*2 + 1) * 100 / 6;
            switch (num) {
              case 0:
              $filter.find('.filter__triangle').attr('style', 'left:calc( ' + triangleLeftPos + '% - ' + (triangleWidth / 2 - 15) + 'px);');
              break;
              case 2:
              $filter.find('.filter__triangle').attr('style', 'left:calc( ' + triangleLeftPos + '% - ' + (triangleWidth / 2 + 15) + 'px);');
              break;
              default:
              $filter.find('.filter__triangle').attr('style', 'left:calc( ' + triangleLeftPos + '% - ' + triangleWidth / 2 + 'px);');
            }
          } else if (windowWidth >= 1440) {
            triangleLeftPos = num * 36.66 + 13.33;
            $filter.find('.filter__triangle').attr('style', 'left:calc( ' + triangleLeftPos + '% - ' + triangleWidth / 2 + 'px);');
          }
        } else {
          triangleLeftPos = num * 34.33 + 15.66;
          $filter.find('.filter__triangle').attr('style', 'left:calc( ' + triangleLeftPos + '% - ' + triangleWidth / 2 + 'px);');
        }

      }
      if ($(window).width() < 640) {
        // $filter.css('margin-top', -productHeight * (2 - num));
        if ( !($(this).hasClass('bracelet_star')) ) {
          //reinit Equalizer для components/shop/_drop-prod only $('.bracelet')
          Foundation.reInit('equalizer');
        }
        if ( !($filter.hasClass('hide')) ) {
          var heightFilter = $filter.height() + 50;
          if ( $(this).hasClass('bracelet_star') ) {
            heightFilter = $filter.innerHeight() + 50;
          }
          $(this).parent().css('margin-bottom', (heightFilter) );
          var offsetBraceletParentColumn = $(this).parent().offset();
          var offsetBraceletParentRow = $(this).parent().parent().offset();
          var heightBraceletParentRow = $(this).parent().parent().height();
          // var tempMarginTop = marginTop + outerHeightFilter;
          // $filter.css('margin-top', -tempMarginTop );
          var marginTop = (offsetBraceletParentRow.top + heightBraceletParentRow) - (offsetBraceletParentColumn.top + productHeight);
          $filter.css('margin-top', -marginTop );
          $('.filter_product').find('.close-button').click(function() {
            thisElementBracelet.parent().css('margin-bottom', '0');
          });
        }

      }

      if ($(this).hasClass('bracelete-pop'))
      {
        var $scrollPos = $('div.bracelete-pop').offset().top - 70;
        var $currentScroll = $(document).scrollTop();
        if ($currentScroll != $scrollPos)
        {
          jQuery('html, body').stop(true).delay(200).animate({
            scrollTop: $scrollPos
          }, 800);
        }

        if ($filter.height() < 100)
        {
          $('.footer').css('margin-bottom','500px');
        }
        else
        {
            $('.footer').css('margin-bottom', '0');
        }

      } else {
        jQuery('html, body').animate({
          scrollTop: $filter.offset().top - 150
        }, 1000);
      }

      return false;
    });

    $('.filter_product').find('.close-button').click(function() {
      $('.bracelet').removeClass('js-open');
      $(this).closest('.filter_product').addClass('hide');
      //проверка на маргин после bracelet-pop
      if ($('.footer').css('margin-bottom') != 0) {
        $('.footer').css('margin-bottom', '0');
      }
    });
    //end of bracelet open click menu
    if ( $('.bracelet').hasClass('bracelete-pop') ) {
      $('footer').addClass('footer_popular-products');
    }
    //begin of .princess slider
    $(".princess").slick({
      infinite: true,
      swipeToSlide: true,
      arrows: false,
      autoplay: true,
      fade: true,
      dots: true,
      pauseOnHover: false,
      autoplaySpeed: 4000,
    });

    var tag = document.createElement('script');
    tag.id = 'iframe-demo';
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var player;
    function onYouTubeIframeAPIReady() {
      var elems1 = document.getElementsByClassName('yt-player');
      for(var i = 0; i < elems1.length; i++) {
        player = new YT.Player(elems1[i], {
          events: {
            'onStateChange': onPlayerStateChange
          }
        });
      }
    }
    function handleVideo(playerStatus) {
      //console.log(playerStatus);
            if (playerStatus == -1) {
                // unstarted
                $('.princess').slick('slickPause');
            } else if (playerStatus == 0) {
                // ended
                $('.princess').slick('slickPlay');
                
            } else if (playerStatus == 1) {
                // playing = green                
                $('.princess').slick('slickPause');                
            } else if (playerStatus == 2) {
                // paused = red
                $('.princess').slick('slickPlay');
            } else if (playerStatus == 3) {
                // buffering = purple
            } else if (playerStatus == 5) {
                // video cued
            }
        }
        function onPlayerStateChange(event) {
            handleVideo(event.data);
        }
        
        $('.princess').on('beforeChange', function(event, slick, currentSlide, nextSlide){
          
          onYouTubeIframeAPIReady();
            //$('.yt-player').each(function(){
            //    this.contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*')
            //});
        });

    focus();
    var listener = window.addEventListener('blur', function() {
        if (document.activeElement === document.getElementById('player')) {
            // clicked
          $('.princess').slick('slickPause');
        }
        window.removeEventListener('blur', listener);
    });

    //end of .princess slider

    function getUrlVar() {
      var valueAndKey = [];
      var resultArray = [];
      var arrayVar = (window.location.search.substr(1)).split('&');
      if (arrayVar[0] == "") return false;
      for (var i = 0; i < arrayVar.length; i++) {
        valueAndKey = arrayVar[i].split('=');
        resultArray[valueAndKey[0]] = valueAndKey[1];
      }
      console.log(resultArray);
      return resultArray;
    }

    function setUrlVar(name, val) {
      var arr = getUrlVar();
      if (!arr)
        arr = [];

      arr[name] = val;

      var param = Array();
      for (var i in arr) {
        param[param.length] = i + '=' + arr[i];
      }

      var d = location.href.split("#")[0].split("?");
      window.history.pushState(null, null, d[0] + '?' + param.join('&'));
      return false;
    }

    function clearUrlVar(name) {
      var arr = getUrlVar();

      if (arr && arr[name])
        delete arr[name];

      var param = Array();
      for (var i in arr) {
        param[param.length] = i + '=' + arr[i];
      }

      var d = location.href.split("#")[0].split("?");
      window.history.pushState(null, null, d[0] + '?' + param.join('&'));
      return false;
    }

    $('.close-desc').click(function() {
      clearUrlVar('id');
    });
    console.log(location.href);
    var arUrlVar = getUrlVar();
    console.log('#href' + arUrlVar['id']);
    if (arUrlVar['id']) {
      // $('#href' + arUrlVar['id']).click();
      $('#' + arUrlVar['id']).click();
    }

    /* ---Карусели---*/

    $(".carousel-about").slick({
      infinite: true,
      dots: true,
      arrows: false,
      slidesPerRow: 1,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      speed: 2000,
      autoplaySpeed: 2500,
      autoplayHoverPause: true,
      adaptiveHeight: true,
      fade: true,
      swipeToSlide: true,

    });



  });
})(jQuery);


//цена изделия в зависимости от выбранных свойств
document.addEventListener('DOMContentLoaded', function() {
  jQuery(".g_price").click(function() {
    var ch_id = jQuery(this).attr('for');
    if (ch_id) {
      var name = jQuery('#' + ch_id).attr('name');
      console.log(name.substr(5));
      var span = $('span[data-id="' + name.substr(5) + '"]');
      var price = jQuery(this).html();
      span.html(price);
    }
  })
});

$(function(){
  $(document.body).on('click', '.slick-dots button', function(event) {
    var iframe = $( 'iframe');
    var iframeSrc = iframe.attr('src');
    iframe.attr('src', iframeSrc);
  });
  $(".calc__phone").on('keyup', function(char){
    var value = $(this).val(); 
    var rep = /[-\.;":'a-zA-Zа-яА-Я]/; 
    if (rep.test(value)) { 
        value = value.replace(rep, ''); 
        $(this).val(value); 
    } 
  });
  $(".search-result-link").hover(function() {
      $(this).siblings(".search-result-desc").addClass("active");
  }, function() {
      $(this).siblings(".search-result-desc").removeClass("active");
  });
  $(".search-result-desc").hover(function() {
      $(this).siblings(".search-result-link").addClass("active");
  }, function() {
      $(this).siblings(".search-result-link").removeClass("active");
  });
  $('.news__title a').hover(function() {
      $(this).parent().parent().siblings('.news__more').addClass("active");
  }, function() {
      $(this).parent().parent().siblings('.news__more').removeClass("active");
  });

  $('.modalusl .close-button').on('click', function(){
    $('.modalusl').hide();
  })
  $('.openmodal').on('click', function(){
    $('.modalusl').css('display', 'flex');
    return false;
  });
  $('.pht').on('click', function(){
    if (!$(this).parent().parent().hasClass('modals')) {
      h = $(this).parent().parent().height() + 13;
      $(this).parent().parent().addClass('modals');
      x = $(this).attr('src');
      $(this).attr('src', $(this).attr('data-zoom'));
      $(this).attr('data-zoom', x);
      //$(this).parent().parent().siblings('.imagesrow').css('marginTop', h + 'px');
      $('body').css('overflow', 'hidden');
    }
  });
  $('.bracelet img').hover(function(){
    $(this).parent().parent().siblings('p').children().css('text-decoration', 'underline');
  }, function(){
    $(this).parent().parent().siblings('p').children().css('text-decoration', 'none');
  });
  $('.chain img').hover(function(){
    $(this).parent().siblings('a').css('text-decoration', 'underline');
  }, function(){
    $(this).parent().siblings('a').css('text-decoration', 'none');
  });
  $(document).keyup(function(e) {
    if (e.keyCode === 27)  {
      $('.dobavl').hide();
      $('.modalusl').hide();
    }
  });

  $('img').bind('contextmenu', function(e) {
    return false;
}); 
  
});

$(function(){
  $('.bracelet__title').mouseenter(function(){
    $(this).css('text-decoration', 'underline');
    //console.log($(this).parent().parent().parent().children('.bracelet__img').children().children());
    $(this).parent().parent().parent().children('.bracelet__img').children().children().css('-ms-transform', 'scale(1.05)');
    $(this).parent().parent().parent().children('.bracelet__img').children().children().css('transform', 'scale(1.05)');
  });
  $('.bracelet__title').mouseleave(function(){
    $(this).css('text-decoration', 'none');
    $(this).parent().parent().parent().children('.bracelet__img').children().children().css('-ms-transform', 'scale(1)');
    $(this).parent().parent().parent().children('.bracelet__img').children().children().css('transform', 'scale(1)');
  });
  $('.bracelet__img img').mouseenter(function(){
    $(this).parent().parent().parent().children('.row').children('.columns').children('.bracelet__title').css('text-decoration', 'underline');
    $(this).css('-ms-transform', 'scale(1.05)');
    $(this).css('transform', 'scale(1.05)');
  });
  $('.bracelet__img img').mouseleave(function(){
    $(this).parent().parent().parent().children('.row').children('.columns').children('.bracelet__title').css('text-decoration', 'none');
    $(this).css('-ms-transform', 'scale(1)');
    $(this).css('transform', 'scale(1)');
  });


  $('.cart_product_title').mouseenter(function(){
    $(this).css('text-decoration', 'underline');
    $(this).parent().parent().parent().children('.cart__img').children().children().children().css('-ms-transform', 'scale(1.05)');
    $(this).parent().parent().parent().children('.cart__img').children().children().children().css('transform', 'scale(1.05)');
  });
  $('.cart_product_title').mouseleave(function(){
    $(this).css('text-decoration', 'none');
    $(this).parent().parent().parent().children('.cart__img').children().children().children().css('-ms-transform', 'scale(1)');
    $(this).parent().parent().parent().children('.cart__img').children().children().children().css('transform', 'scale(1)');
  });
  $('.cart__img:not(.img22) img').mouseenter(function(){
    $(this).parent().parent().parent().parent().children('.cart__p_title').children().children().css('text-decoration', 'underline');
    $(this).css('-ms-transform', 'scale(1.05)');
    $(this).css('transform', 'scale(1.05)');
  });
  $('.cart__img:not(.img22) img').mouseleave(function(){
    $(this).parent().parent().parent().parent().children('.cart__p_title').children().children().css('text-decoration', 'none');
    $(this).css('-ms-transform', 'scale(1)');
    $(this).css('transform', 'scale(1)');
  });

});
