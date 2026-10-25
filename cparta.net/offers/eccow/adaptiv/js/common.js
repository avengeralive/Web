$(document).ready(function(){

    ;(function() {
      
      addSelects('');

      function addSelects(selector, template) {
        $(selector).closest('.form-group').before(template);
      }

    })();

    ;(function() {
      $('.select-emul').each(function () {
        var $this = this;

        $(this).find('li').on('click', '.active', function () {
          
          if ( $($this).hasClass('active') ) {
            $($this).find('.items').fadeToggle();
          } else {          
            $('.select-emul').removeClass('active');
            $($this).addClass('active');
            
            
            $.when( $('.select-emul .items').fadeOut(0) ).then(function () {
  
  
              $($this).find('.items').fadeToggle();
              $($this).find('.items li').on('click', function () {
                  $($this).find('li.select-menu .active').html($(this).html());
                  $($this).find('.items').fadeOut();
              });
  
            });  
          }

        })
      });


    document.addEventListener('click', function(e) {
        var target = e.target;

        if ( !$(target).closest('.select-emul').hasClass('select-emul') ) {
          $('.select-emul .items').fadeOut();
        }
    });
  })();   

    // replace text
    ;(function() {
        if (window.matchMedia("(max-width: 992px)").matches) { 
            $('.demo .left .header-title-3').html($('.demo .right .header-title-3').html());
            $('.demo7555 .left .header-title-3').html($('.demo7555 .right .header-title-3').html());
            $('.demo7556 .left .header-title-3').html($('.demo7556 .right .header-title-3').html());
            $('.demo7557 .left .header-title-3').html($('.demo7557 .right .header-title-3').html());
        }

        window.addEventListener('resize', function() {
            if (window.matchMedia("(max-width: 992px)").matches) { 
              $('.demo .left .header-title-3').html($('.demo .right .header-title-3').html());
              $('.demo7555 .left .header-title-3').html($('.demo7555 .right .header-title-3').html());
              $('.demo7556 .left .header-title-3').html($('.demo7556 .right .header-title-3').html());
              $('.demo7557 .left .header-title-3').html($('.demo7557 .right .header-title-3').html());
            }
        });
    })();   

    ;(function() {

    })();   

    // timer
    ;(function() {
        var now = new Date(),
        secPassed = now.getHours() * 60 * 60 + now.getMinutes() * 60 + now.getSeconds();
        var t = (60 * 60 * 24) - secPassed;
    
        $('.timer').countdown({
            until: (t),
            labels: ['Годы', 'Месяцы', 'Недели', 'Дни', 'Часов', 'Минут', 'Секунд'],
            labels1: ['Годы', 'Месяцы', 'Недели', 'Дни', 'Часов', 'Минут', 'Секунд'],
            format: 'HMS',
            layout: '<ul class="time">' +
                        '<li class="time-item">' +
                            '<div class="time-num">' + 
                                '<span>{d10}</span>' +
                                '<span>{d1}</span>' +
                            '</div>' +
                            '<span class="time-text">Дней</span>' +
                        '</li>' +
                        '<li class="time-item">' +
                            '<div class="time-num">' + 
                                '<span>{h10}</span>' +
                                '<span>{h1}</span>' +
                            '</div>' +
                            '<span class="time-text">ЧАСОВ</span>' +
                        '</li>' +
                        '<li class="time-item">' +
                            '<div class="time-num">' + 
                                '<span>{m10}</span>' +
                                '<span>{m1}</span>' +
                            '</div>' +
                            '<span class="time-text">МИНУТ</span>' +
                        '</li>' +
                        '<li class="time-item">' +
                            '<div class="time-num">' + 
                                '<span>{s10}</span>' +
                                '<span>{s1}</span>' +
                            '</div>' +
                            '<span class="time-text">СЕКУНД</span>' +
                        '</li>' +
                    '</ul>'
        });
    })();
    
    // remodal
    ;(function() {
        var privacyPolicy = $('[data-remodal-id=privacy-policy]').remodal({});
    })();
    
    // page-scroll
    ;(function() {
        $('.page-scroll').pageScroll({
            speed : 1000,
        });
    })();

  // gallery slider
  ;(function() {

    var slider = sliderInit('.gallery .imgs');
    slider();

    window.addEventListener('resize', function() {
      slider();
    });

    function sliderInit(selector) {
      var owl = false;

      return function () {
        if (window.matchMedia("(max-width: 768px)").matches) {
          if (!owl) {
            $(selector).addClass('owl-carousel');

            owl = $(selector).owlCarousel({
              loop:true,
              margin:0,
              navText: ["", ""],
              items:1,
              nav:true,
              dots:true,
            })
          }
        } else {
          if (owl) {
            owl.trigger('destroy.owl.carousel');
            $(selector).removeClass('owl-carousel');
            owl = false;
          }
        }
      }
    }
  })();

    // Replace text on order form buttons
    ;(function() {
      $('.order-form button').each(function () {
          $(this).html('<span>' + $(this).text() + '</span>');
      })
    })();   
 
    ;(function() {
      owl = $('.reviews .slider-wrap').owlCarousel({
          loop:true,
          navText: ["", ""],
          items:3,
          nav:true,
          // autoHeight:fa,
          responsive:{
            0:{
                items:1,
                dots:true,
            },
            992:{
                items:3,
                dots:false,
                margin:10,
            },
            1200:{
              margin:30,
              dots: false,
            }
        }
      })
    })(); 

    ;(function() {
      getDemo({
        'big' : '.demo .slider .big',
        'small' : '.demo .small a'
      });

      getDemo({
        'big' : '.demo7556 .slider .big',
        'small' : '.demo7556 .small a'
      });

      getDemo({
        'big' : '.demo7555 .slider .big',
        'small' : '.demo7555 .small a'
      });

      function getDemo(obj) {
        $(obj.big).owlCarousel({
          loop:true,
          margin:0,
          navText: ["", ""],
          items:1,
          nav:false,
          dots:false,
          mouseDrag: false,
          startPosition: 'URLHash',
          smartSpeed: 50,
        });
      
        var links = $(obj.small);

        links.each(function () {
          var link = this;

          $(link).on('click', function () {
            if ( !$(this).hasClass('active') ) {
              links.removeClass('active');
              $(this).addClass('active');
            } else {
              // $(this).removeClass('active');
            }
          });
        });
      }

    })();   

});