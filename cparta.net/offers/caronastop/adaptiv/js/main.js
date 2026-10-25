var slider = 0, wdt = 0,
    options={
        mode: 'horizontal',
        minSlides: 1,
        maxSlides: 1,
        adaptiveHeight: true,
        touchEnabled: true,
        infiniteLoop: true,
        controls: true,
        pager: false
    };
$(document).ready(function(){
    wdt = $(window).width();

    $(document.body).on('click', '.mob-menu', function(e) {
        e.preventDefault();
        $('.menu-list').slideToggle();
    });

    $(".for-event").on("touchend, click", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top - 50;
        $('body,html').animate({scrollTop: top}, 1500);
    });

    var treeHours = new Date().getTime() + 10362000;
    $('#timer, #timer2, #timer3').countdown(treeHours, function(event) {
        var hours = event.offset.hours;
        var minutes = event.offset.minutes;
        var seconds = event.offset.seconds;

        var minutesPart1 = Math.floor(event.offset.minutes/10);
        var minutesPart2 = event.offset.minutes%10;

        var secondsPart1 = Math.floor(event.offset.seconds/10);
        var secondsPart2 = event.offset.seconds%10;

        var $this = $(this).html(event.strftime(''
            + '<span class="bg-date">' + hours +  '<span class="textSmaller">ч</span> : </span>'
            + '<span class="bg-date">' + minutesPart1 + minutesPart2 +  '<span class="textSmaller">м</span> : </span>'
            + '<span class="bg-date">' + secondsPart1 + secondsPart2 + '<span class="textSmaller">с</span></span>'));
    });


    $('#block3 .list3').scroolly([
        {
            from: 'el-top = vp-center',
            direction: 1,
            onTopIn: function($el){
                $('.list3-item').addClass('blockGo');
            }
        }
    ], $('#block3 .list3'));

    /* borderGreenGo */
    setTimeout(function(){
        $('.plus-prod .borderGreen').addClass('borderGreenGo');
    }, 500);


    $('.borderGreen-block').scroolly([
        {
            from: 'el-top = vp-center',
            direction: 1,
            onTopIn: function($el){
                console.log('borderGreen-block');
                $el.find('.borderGreen').addClass('borderGreenGo');
            }
        }
    ], $('.borderGreen-block'));

    /*$('#block7 .bl7-desc').scroolly([
        {
            from: 'el-top = vp-center',
            direction: 1,
            onTopIn: function($el){
                console.log('.bl7-desc');
                $('.bl7-desc .borderGreen').addClass('borderGreenGo');
            }
        }
    ], $('#block7'));

    $('#block2 .block2-desc').scroolly([
        {
            from: 'el-top = vp-center',
            direction: 1,
            onTopIn: function($el){
                console.log('.block2-desc');
                $('.block2-desc .borderGreen').addClass('borderGreenGo');
            }
        }
    ], $('#block2'));

    $('#block4 .list4-2').scroolly([
        {
            from: 'el-top = vp-center',
            direction: 1,
            onTopIn: function($el){
                console.log('.list4-2');
                $('.list4-2 .borderGreen').addClass('borderGreenGo');
            }
        }
    ], $('#block4'));

    $('#block5 .doc-quote').scroolly([
        {
            from: 'el-top = vp-center',
            direction: 1,
            onTopIn: function($el){
                console.log('.doc-quote');
                $('.doc-quote .borderGreen').addClass('borderGreenGo');
            }
        }
    ], $('#block5'));

    $('#block8 .bl8-desc').scroolly([
        {
            from: 'el-top = vp-center',
            direction: 1,
            onTopIn: function($el){
                console.log('.bl8-desc');
                $('.bl8-desc .borderGreen').addClass('borderGreenGo');
            }
        }
    ], $('#block8'));
    */

    if($(window).width() < 784){
        slider = $('.bx-review').bxSlider(options);
    }

});

$(window).resize(function(){
    wdt = $(window).width();

    if(wdt < 784){
        if(!slider.length){
            slider = $('.bx-review').bxSlider(options);
        }
    }else{
        if(slider.length){
            slider.destroySlider();

            slider=0;
            setTimeout(function(){
                $('.bx-review, .bx-review li').each(function(){
                    $(this).attr('style', '');
                });
            },100);
        }
    }
});