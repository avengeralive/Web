$(function () {
    $('a[href^="#"]').click(function () {
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        jQuery("html:not(:animated), body:not(:animated)").animate({
            scrollTop: destination
        }, 800);
        return false;
    });

    times = function () {
        now = new Date();
        hour = 24 - now.getHours();
        hour = ((hour + '').length == 1 ? hour = '0' + hour : hour) + '';
        minu = 60 - now.getMinutes();
        minu = ((minu + '').length == 1 ? minu = '0' + minu : minu) + '';
        secu = 60 - now.getSeconds();
        secu = ((secu + '').length == 1 ? secu = '0' + secu : secu) + '';
        $('.timer-action').html('<h3>До конца акции осталось:</h3><span class="timer-col"><strong>' + hour + '</strong><br/><span>часов</span></span><span class="timer-col"><strong>' + minu + '</strong><br/><span>минут</span></span><span class="timer-col"><strong>' + secu + '</strong><br/><span>секунд</span></span>');
    }
    times();
    setInterval(times, 1000);

});

// $(window).on("load", function(){

//   $('.s9 .reviews').owlCarousel({
//     loop:true,
//     margin:10,
//     autoHeight: true,
//     navText: "",
//     responsive:{
//         0:{
//             items:1,
//             nav:true,
//         },
//         659:{
//             items:2,
//             nav:true,
//             dots: false,
//         },
//         960:{
//             items:3,
//             nav:false,
//             loop:false
//         }
//     }
// })

// });