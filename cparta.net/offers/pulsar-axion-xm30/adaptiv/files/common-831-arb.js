function CountBox() {
    dateNow = new Date();
    amount = ((23 - dateNow.getHours()) * 60 * 60 + (59 - dateNow.getMinutes()) * 60 + (60 - dateNow.getSeconds())) * 1000;
    delete dateNow;
    if (amount < 0) {
        out = "<div class='countbox-num'><div class='countbox-hours'><span></span>00</div><div class='countbox-hours-text'></div></div>" + "<div class='countbox-num'><div class='countbox-mins'><span></span>00</div><div class='countbox-mins-text'></div></div>" + "<div class='countbox-num'><div class='countbox-secs'><span></span>00</div><div class='countbox-secs-text'></div></div>";
        var list = document.getElementsByClassName("countbox");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = out;
        }
        setTimeout("CountBox()", 10000)
    } else {
        days = 0;
        days1 = 0;
        days2 = 0;
        hours = 0;
        hours1 = 0;
        hours2 = 0;
        mins = 0;
        mins1 = 0;
        mins2 = 0;
        secs = 0;
        secs1 = 0;
        secs2 = 0;
        out = "";
        amount = Math.floor(amount / 1e3);
        days = Math.floor(amount / 86400);
        days1 = (days >= 10) ? days.toString().charAt(0) : '0';
        days2 = (days >= 10) ? days.toString().charAt(1) : days.toString().charAt(0);
        amount = amount % 86400;
        hours = Math.floor(amount / 3600);
        hours1 = (hours >= 10) ? hours.toString().charAt(0) : '0';
        hours2 = (hours >= 10) ? hours.toString().charAt(1) : hours.toString().charAt(0);
        amount = amount % 3600;
        mins = Math.floor(amount / 60);
        mins1 = (mins >= 10) ? mins.toString().charAt(0) : '0';
        mins2 = (mins >= 10) ? mins.toString().charAt(1) : mins.toString().charAt(0);
        amount = amount % 60;
        secs = Math.floor(amount);
        secs1 = (secs >= 10) ? secs.toString().charAt(0) : '0';
        secs2 = (secs >= 10) ? secs.toString().charAt(1) : secs.toString().charAt(0);
        out = "<div class='countbox-num'><div class='countbox-hours'><span></span>" + hours1 + hours2 + "</div><div class='countbox-hours-text'>часов</div></div>" + "<div class='countbox-num'><div class='countbox-mins'><span></span>" + mins1 + mins2 + "</div><div class='countbox-mins-text'>минут</div></div>" + "<div class='countbox-num'><div class='countbox-secs'><span></span>" + secs1 + secs2 + "</div><div class='countbox-secs-text'>секунд</div></div>";
        var list = document.getElementsByClassName("countbox");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = out;
        }
        setTimeout("CountBox()", 1e3)
    }
}
window.onload = function() {
    CountBox()
}
$(document).ready(function() {
    $("a[href^='#']").click(function(){
        var _href = $(this).attr("href");
        $("html, body").animate({scrollTop: $(_href).offset().top+"px"});
        return false;
    });
    $(".order_form").submit(function(){
        if ($(this).find("input[name='name']").val() == "" && $(this).find("input[name='phone']").val() == "") {
            alert("Введите Ваши имя и телефон");
            $(this).find("input[name='name']").focus();
            return false;
        }
        else if ($(this).find("input[name='name']").val() == "") {
            alert("Введите Ваше имя");
            $(this).find("input[name='name']").focus();
            return false;
        }
        else if ($(this).find("input[name='phone']").val() == "") {
            alert("Введите Ваш телефон");
            $(this).find("input[name='phone']").focus();
            return false;
        }
        return true;
    });
    $(".ba_block").owlCarousel({
        navigation: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true,
        center:false,
        lazyLoad: false,
        nav: true,
        items: 3,
        margin: 0,
        responsiveClass:true,
        responsive:{
            0:{
                items:1
            },
            665:{
                items:2
            },
            980:{
                items:3
            }
        }
    });
    $(".reviews_block").owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navigation: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        loop: true,
        lazyLoad: false,
        nav: true,
        items: 1,
        margin: 10
    })
});