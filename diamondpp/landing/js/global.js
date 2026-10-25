$(document).ready(function() {

    $('[data-fancybox]').fancybox({
        // smallBtn : true,
        // toolbar  : false,
        modal: false,
        touch:false,
        btnTpl   : {
          smallBtn : '<button data-fancybox-close="" class="fancybox-button fancybox-button--close" title="Закрыть"><svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M38 2.94332L35.0624 0L19.0007 16.0601L2.94026 0L0 2.94197L16.0604 19L0 35.058L2.94026 38L19.0007 21.9385L35.0624 38L38 35.0567L21.9416 19L38 2.94332Z" fill="white"/></svg></button>'
        },
        beforeLoad: function( instance, current ) {
            $('html').addClass('hidden');
        },
        afterClose: function (instance, current) {
        // if ($(window).width() < 767) {
            $('html').removeClass('hidden');
        // }
        }
    });


    $(document).on('click', '.header-top__mob', function() {
        $(this).parent().find('.header-top__right').addClass('active');

        if ($('html, body').is('.hidden')) {
            $('html, body').removeClass('hidden');
        } else{
            $('html, body').addClass('hidden');
        }
    });

    $(document).on('click', '.header-top__right-close', function() {
        $(this).parent().removeClass('active');

        if ($('html, body').is('.hidden')) {
            $('html, body').removeClass('hidden');
        } else{
            $('html, body').addClass('hidden');
        }
    });

    $(document).on('click', '.leads-item__arrow', function() {
        $(this).toggleClass('active').next().toggleClass('active');
        return false;
    });

});
