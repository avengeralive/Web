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
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
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

        $(".lone-star__slider").slick({
            infinite: true,
            swipeToSlide: true,
            arrows: false,
            autoplay: true,
            fade: true,
            dots: true,
        });

        //begin of sticky information in header
        $(window).scroll(function() {
            var $infoBlock = $('.js-info');
                if ($infoBlock.length > 0) {

                    var posAnchor = $infoBlock.offset().top;
                    var scrollTop = window.pageYOffset;
                    if (scrollTop > posAnchor) {
                        var offSetHeader = $('header').offset().top;
                        $('#somethingTop').animate({
                            opacity: 0,
                            height: 0
                        }, 300).hide(300);
                        history.pushState(null, null, '/jewellry');
                        $('.sticky').removeClass('sticky is-stuck is-at-top');
                        $('.beads').remove();
                        $('.header__info').removeClass('hide');
                        if($(document).scrollTop() !=0){
                            $('html, body').animate({ scrollTop: 0 }, 300);
                        }
                        
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
        //end of jquery input type="file" help function
        //begin of bracelet open click menu
        $('.bracelet').click(function() {

            var num = $(this).closest('.columns').index();
            var $filter = $(this).closest('.row').next().find('>.columns').eq(num).find('.filter')

            var triangleLeftPos = num * 33.33 + 16.66;
            var triangleWidth = 42;
            var productHeight = $(this).parent().height();
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
            }

            $filter.find('.filter__triangle').attr('style', 'left:calc( ' + triangleLeftPos + '% - ' + triangleWidth / 2 + 'px);')
            if ($(window).width() < 640) {
                $filter.css('margin-top', -productHeight * (2 - num));
            }
			
			jQuery('html, body').animate({
				scrollTop: $filter.offset().top - 150
			}, 1000);			

        });

        $('.filter_product').find('.close-button').click(function() {
            $('.bracelet').removeClass('js-open');
            $(this).closest('.filter_product').addClass('hide');
        });
        //end of bracelet open click menu

        function getUrlVar() {
            var valueAndKey = [];
            var resultArray = [];
            var arrayVar = (window.location.search.substr(1)).split('&');
            if (arrayVar[0] == "") return false;
            for (var i = 0; i < arrayVar.length; i++) {
                valueAndKey = arrayVar[i].split('=');
                resultArray[valueAndKey[0]] = valueAndKey[1];
            }
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

        //reinit Equalizer для components/shop/_drop-prod
        $('.bracelet').on('click', function(event) {
            Foundation.reInit('equalizer');
        });

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
document.addEventListener('DOMContentLoaded', function () {
jQuery(".g_price").click(function() {
  var ch_id=jQuery(this).attr('for');
  if(ch_id){
	var name=jQuery('#'+ch_id).attr('name');
	 console.log(name.substr(5));
	 var span = $('span[data-id="'+name.substr(5)+'"]');
	 var price=jQuery(this).html();
	 span.html(price);
	}
  })
});
