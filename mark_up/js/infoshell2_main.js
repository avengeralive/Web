$(function() {
    $(".infoshel-header__container-burger").click(function() {
        $(".side-menu").toggleClass("active");
        $(".infoshel-page").toggleClass("active");
    });

    $(".side-menu__header-close").click(function() {
        $(".side-menu").removeClass("active");
        $(".infoshel-page").removeClass("active");
    });

    $(".infoshel-main-calculator__platform").click(function() {
        $(this).toggleClass("active");
    });
});


// var foo = jQuery('.infoshel-main-slider__img-six');
//
// foo.detach(); //удаляем элемент

$(document).ready(function(){
    $('.infoshel-header__container-requestCall').hover(
        function() {
            $( this ).addClass('class-name1');
            $( this ).removeClass('class-name2');
        }, function() {
            $( this ).removeClass('class-name1');
            $( this ).addClass('class-name2');
        }
    );
});



$(document).ready(function() {
        $(".infoshel-main-slider__container").owlCarousel({
            nav:true,
            loop:true,
            items:1,
            responsive:{
                0:{
                    nav:false,
                },
                1200:{
                    nav:true,
                },
            }

        });

        $(".infoshel-main-ourWork__slider").owlCarousel({
            nav:true,
            items:1,
            margin:1,
            loop:true,
            autoWidth:true,
            center:true,
            dots: false,
            responsive:{
                0:{
                    nav:false,
                },
                1200:{
                    nav:true,
                },
            }
        });

        $(".infoshel-main-blog__slider").owlCarousel({
            nav:true,
            loop:true,
            dots: false,
            items:3,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    autoWidth:true,
                    center:true
                },
                576:{
                    items:1,
                },
                650:{
                    items:2,
                    nav:false
                },
                1000:{
                    nav:true,
                }
            }
        });

        $(".infoshel-main-reviews__container").owlCarousel({
            nav:true,
            loop:true,
            dots: false,
            items:3,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    autoWidth:true,
                    center:true
                },
                576:{
                    items:1,
                },
                650:{
                    items:2,
                    nav:false
                },
                1000:{
                    nav:true,
                }
            }
        });
    });


    // $( function() {
    //     $( "#accordion" ).accordion({
    //         heightStyle: "content",
    //         icons: false,
    //         collapsible: true
    //     });
    // } );

    $( function() {
        $( "#accordion-1" ).accordion({
            heightStyle: "content",
            icons: false,
            collapsible: true
        });
    } );


    $('#carousel-default').floatingCarousel({
        autoScroll : true,
        autoScrollDirection : 'left',
        autoScrollSpeed : 60000,
        scrollSpeed : 'slow',
    });


    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();


   new WOW().init();