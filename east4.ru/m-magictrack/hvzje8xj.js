$(document).ready(function(){
    $('a[href^="#"]').click(function (){
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        jQuery("html:not(:animated), body:not(:animated)").animate({scrollTop: destination}, 800);
        return false;
    })

    $('.reviews_slider').slick({
          dots: false,
          infinite: true,
          speed: 500,
          fade: false,
          cssEase: 'linear'
    });

    $('.reviews_slider_rev1').slick({
          dots: true,
          infinite: true,
          speed: 500,
          fade: false,
          cssEase: 'linear'
    });

    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        smartSpeed: 300,
        mouseDrag: false,
        pullDrag: false,
        nav: true,
        navText: ""
    });

    var itembox = $(".review_radio");
        itembox.click(function(){
            var _this = $(this);
            _this.addClass("active").siblings(itembox).removeClass("active").find("input[type='radio']").removeAttr("checked");

            if(_this.hasClass('active')){
              _this.find("input[type='radio']").attr("checked","checked");
            }
        });


        var itembox = $(".review_radio");
        itembox.click(function(){
            itembox.hide();
            $(".review_result").fadeIn();

            $(".green_result").addClass("green_view");
            $(".red_result").addClass("red_view");
            $(".blue_result").addClass("blue_view");
        });


        // Стилизация input[type=file]
        $('.min_input .button').click(function(){
            $(this).siblings('input[type=file]').click();
            return false;
        });   
    


    now = new Date();
    var perem = (24-now.getHours())*3600;
    $(".el-timer").attr("data-timer", perem);
    $(".el-timer").TimeCircles({
        "animation": "smooth",
        "bg_width": 0.2,
        "fg_width": 0.03,
        "circle_bg_color": "#fff",
        "time": {
            "Days": {
                "text": "Days",
                "color": "#fff",
                "show": false
            },
            "Hours": {
                "text": "Часов",
                "color": "#fff",
                "show": true
            },
            "Minutes": {
                "text": "Минут",
                "color": "#fff",
                "show": true
            },
            "Seconds": {
                "text": "Секунд",
                "color": "#fff",
                "show": true
            }
        }
    });

    now = new Date();
    var perem = (24-now.getHours())*3600;
    $(".el-timer2").attr("data-timer", perem);
    $(".el-timer2").TimeCircles({
        "animation": "smooth",
        "bg_width": 0.2,
        "fg_width": 0.03,
        "circle_bg_color": "#f2f2f2",
        "time": {
            "Days": {
                "text": "Days",
                "color": "#a1e019",
                "show": false
            },
            "Hours": {
                "text": "Часов",
                "color": "#a1e019",
                "show": true
            },
            "Minutes": {
                "text": "Минут",
                "color": "#a1e019",
                "show": true
            },
            "Seconds": {
                "text": "Секунд",
                "color": "#a1e019",
                "show": true
            }
        }
    });


});