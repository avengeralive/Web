var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;
var dataVideoID = $('.video-movie').data('video-id');

function onYouTubeIframeAPIReady() {
  player = new YT.Player('video-placeholder', {
    width: '100%',
    height: '100%',
    videoId: dataVideoID,
    events: {
      onReady: initialize
    }
  });
}

function initialize() {
  // console.log(player)
}

$('.video-box .video-pic').on('click', function () {
  player.playVideo();

  var $t = this;

  $($t).addClass('active');

  setTimeout(function () {
    $($t).fadeOut();
  }, 500);
});




$(document).ready(function(){

  /*=============
  *  MAIN
  ===============*/
  
  objectFitImages();

  // don't dragging img
  $("img, a").on("dragstart", function(event) { event.preventDefault(); });

  // smoothScrolling
  smoothScrolling();

  // added item-n classes to .form-group elems
  ;(function addNumericFormGroup(form) {
    if (!form) return;

    $('.order-box .order-form').each(function() {
      $('.order-form .form-group #name_first').closest('.form-group').addClass('item-1');
      $('.order-form .form-group #phone').closest('.form-group').addClass('item-2');
      $('.order-form .form-group [type="submit"]').closest('.form-group').addClass('item-3');
    });
  })($('*').is('.order-form'));

  $('.order-box .order-form .form-group #phone').closest('.form-group')
  .after('<div class="select-box" id="select">' +
            '<select class="select-elem">' +
              '<option selected="selected" value="размер не указан" class="" disabled="disabled">Выберите размер</option>' +
              '<option value="42">42</option>' +
              '<option value="44">44</option>' +
              '<option value="46">46</option>' +
              '<option value="48">48</option>' +
              '<option value="50">50</option>' +
            '</select>' +
          '</div>');

  //fancybox
  $("[data-fancybox]").fancybox({
    loop: true,
    infobar: false,
    buttons: [
      "zoom",
      "close"
    ]
  });

  // .header
  ;(function () {
    var headerBtnMove = false;

    mediaQuery('576px', {
      'Up' : function () {
        if (headerBtnMove) {
          $('.header .bg-box').append( $('.header .bottom-box') );
          
          headerBtnMove = false;
        }
      }, 
      'Down' : function () {
        if (!headerBtnMove) {
          $('.header .container').append( $('.header .bg-box .bottom-box') );
  
          headerBtnMove = true;
        }
      }
    }); 
  })();

  $('.product').each(function () {
    var product = this;
    var titleMove = false;
    var priceMove = false;

    if ($(product).hasClass('product_color')) {

      $(product).find('.product__photos-box-item').each(function () {
        var item = this;
        $(item).find('.product__photos-big').slick({
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          fade: true,
          arrows: true,
          prevArrow: $(item).find('.product__slider-arrow_left'),
          nextArrow: $(item).find('.product__slider-arrow_right'),
        });
    
        $(item).find('.product__photos-small').on('click', function () {
          var photosSmall = this;
    
          $(item).find('.product__photos-big').slick('slickGoTo', $(photosSmall).attr('data-photo') - 1);
        });
      });

      $(product).find('.product__select-color .select-color__list-item').on('click', function () {
        $(product).find('.product__select-color .select-color__list-item').removeClass('select-color__list-item_active');
        $(this).addClass('select-color__list-item_active');

        $(product).find('.product__photos-box-wrap').attr('data-color', $(this).attr('data-color'));
      });
    } else {
      $(product).find('.product__photos-big').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: true,
        prevArrow: $(product).find('.product__slider-arrow_left'),
        nextArrow: $(product).find('.product__slider-arrow_right'),
      });
  
      $(product).find('.product__photos-small').on('click', function () {
        var photosSmall = this;
  
        $(product).find('.product__photos-big').slick('slickGoTo', $(photosSmall).attr('data-photo') - 1);
      });
    }

    mediaQuery('992px', {
      'Up' : function () {
        if (titleMove) {
          $(product).find('.product__description').prepend( $(product).find('.product__title') );
          
          titleMove = false;
        }
      }, 
      'Down' : function () {
        if (!titleMove) {
          $(product).find('.product__left').prepend( $(product).find('.product__title') );

          titleMove = true;
        }
      }
    }); 
    
    mediaQuery('576px', {
      'Up' : function () {
        if (priceMove) {
          $(product).find('.product__left').append( $(product).find('.product__price') );
          
          priceMove = false;
        }
      }, 
      'Down' : function () {
        if (!priceMove) {
          $(product).find('.product__form').prepend( $(product).find('.product__price') );

          priceMove = true;
        }
      }
    }); 
  });

  $('.reviews .slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    vertical: true,
    arrows: false,
    dots: false,
    swipe: false,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 1,
          vertical: false,
        }
      },
    ]
  });
  
  $('.reviews .item--arrow_next').on('click', function () {
    $('.reviews').addClass('slider-active');

    setTimeout(function () {
      $('.reviews .slider').slick('slickNext');
    }, 300)
  })
  
  $('.reviews .item--arrow_prev').on('click', function () {
    $('.reviews').addClass('slider-active');

    setTimeout(function () {
      $('.reviews .slider').slick('slickPrev');
    }, 300)
  })

  $('.reviews .slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
    $('.reviews').removeClass('slider-active');
  });

  // Get the current slide
  var currentSlide = $('.your-element').slick('slickCurrentSlide');


  /*=============
  *  FUNCTIONS
  ===============*/
  
  /********** mediaQuery **********/
  
  /**
   * javascript media query
   * @function
   * @param {string} breakpoint - breakpoint border
   * @param {function} [Up = empty function] - code that runs above breakpoint
   * @param {function} [Down = empty function] - code that runs below breakpoint
   */
  
  // How to use:
  // mediaQuery('768px', {
  //   'Up' : function () {
  //     console.log('some code');
  //   }, 
  //   'Down' : function () {
  //     console.log('some code');
  //   }
  // }); 
  
  function mediaQuery (breakpoint, userSettings) {
    var defaultSettings = {
      'Up' : $.noop, 
      'Down' : $.noop
    }
    var settings = $.extend(defaultSettings, (userSettings || {}));
    var mediaQueryList = window.matchMedia("(min-width: " + breakpoint + " )");
  
  
    function handleOrientationChange(mql) {
      if (mql.matches) settings.Up() 
      else settings.Down();
    }
  
    mediaQueryList.addListener(handleOrientationChange);
    handleOrientationChange(mediaQueryList);
  }
  
  
  /********** smoothScrolling **********/
  
  /**
   * Smooth Page Scrolling
   * @function
   * @param {string} selector - string selector to be used for scrolling 
   * @param {number} [speed = 1250] - scroll speed
   * @param {number} [offset = 0] - offset from block
   * @param {string} [easing] - easing function
   * @param {function} [callbackBegin] - function at the beginning of scrolling
   * @param {function} [callbackEnd] - function at the end of scrolling
   */
  function smoothScrolling (userSettings) {
    var defaultSettings = {
      clickOn : false,
      delay: 0,
      speed : 800,
      offset : 0,
      easing : '',
      dataName : 'data-smooth-scroll',
      callbackBegin : $.noop, 
      callbackEnd : $.noop,
    }
    
    var settings = $.extend(defaultSettings, (userSettings || {}));
  
    $('[' + settings.dataName + ']').each(function () {
  
      if (!settings.clickOn) {
        $(this).on('click', function(event) {
          var $anchor = $(this);
          var $anchorData = $anchor.attr(settings.dataName);
          
          event.preventDefault();
  
          setTimeout(function () {
            $('html, body').stop().animate({
              scrollTop: ( $($anchorData).offset().top - settings.offset)
            }, settings.speed, settings.easing, function () {
              if ($.isFunction(settings.callbackEnd)) {
                settings.callbackEnd();
              }
            });
          }, settings.delay)
  
          if ($.isFunction(settings.callbackBegin)) {
            settings.callbackBegin();
          }
  
        });
      } else {
        setTimeout(function () {
          $('html, body').stop().animate({
            scrollTop: ( $(settings.clickOn).offset().top - settings.offset)
          }, settings.speed, settings.easing, function () {
            if ($.isFunction(settings.callbackEnd)) {
              settings.callbackEnd();
            }
          });
        }, settings.delay)
      }
  
    });
  }
  
  // How to use:
  
  // js:
  
  // LP.smoothScrolling({
  //   speed : 1000,
  // });
  
  // html:
  
  // <a href="#" data-smooth-scroll="#catalog">Подробнее</a>
  // You can use any container! (a, div, li, span etc.)
  
  // libs/functions/setOneHeight.js
  // libs/functions/Accordion.js
  // libs/functions/Tabs.js
});