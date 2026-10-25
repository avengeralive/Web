$(function () {
$('a[href^="#"]:not(a[href="#"])').click(function (){
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        jQuery("html:not(:animated), body:not(:animated)").animate({scrollTop: destination}, 800);
        return false;
    });

    function update() {
        var Now = new Date(), Finish = new Date();
        Finish.setHours(23);
        Finish.setMinutes(59);
        Finish.setSeconds(59);
        if (Now.getHours() === 23 && Now.getMinutes() === 59 && Now.getSeconds === 59) {
            Finish.setDate(Finish.getDate() + 1);
        }
        var sec = Math.floor((Finish.getTime() - Now.getTime()) / 1000);
        var hrs = Math.floor(sec / 3600);
        sec -= hrs * 3600;
        var min = Math.floor(sec / 60);
        sec -= min * 60;
        $(".timer .hours").text(pad(hrs));
        $(".timer .minutes").text(pad(min));
        $(".timer .seconds").text(pad(sec));
        setTimeout(update, 200);
    }

    function pad(s) {
        return ('00' + s).substr(-2)
    }

    update();

    /* vote */

    var voice_count = $(".voice_count b").text().replace(/\D/g, "");
    $(".question_item").one("click", function () {
        $(".questions_list").addClass("active");
        voice_count++;
        $(".questions_list").children().each(function () {
            var percents = parseInt($(this).find(".percents").text().replace(/\D/g, ""), 10);
            $(this).find(".value").text((Math.round(voice_count * percents / 100) + "").replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, "$1 "));
            $(this).find(".line").animate({width: percents + "%"}, 700);
        });
        $(".voice_count b").text((voice_count + "").replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, "$1 "));
       
    });
   

});