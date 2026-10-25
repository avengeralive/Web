$(document).ready(function () {

    init();

    $(".buy").click(function(){
        $(".pop-up-shop").fadeIn(500);
        $("body, html").css("overflow", "hidden");
    });
	
   	$(".circle p").each(function(){
		$(this).click(function(){
			var x=$(this).attr("data-content");
			var y=$(x).position();
			$("body, html").animate({scrollTop:y.top},500);
		})
	})	
	
	$(".project").each(function(){
		$(this).click(function(){
			var x=$(this).attr("data-content");
			var y=$("#"+x).position();
			$("body, html").animate({scrollTop:y.top},500);
		})
	})	
	
	$(".close").click(function(){
		$(".pop-up-shop").fadeOut(500);
		$("body, html").css("overflow", "auto");
	});
	


	
	$(".nav-button").click(function(){
		$(".fixed-menu").slideToggle("slow");
	})
	
    $(document).on("scroll", onScroll);    
    //smoothscroll
    $('.fixed-menu ul li a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('.fixed-menu ul li a').each(function () {
            $(this).removeClass('active-menu');
        })
        $(this).addClass('active-menu');
      
        var target = this.hash,
        menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top+2
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });	
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.fixed-menu a').each(function () {
        var currLink = $(this);
        try {
            var refElement = $(currLink.attr("href"));
            if (typeof(refElement) != 'undefined') {
                if (refElement.position().top-100 <= scrollPos) {
                    $('.fixed-menu ul li a').removeClass("active-menu");
                    currLink.addClass("active-menu");
                }
                else{
                    currLink.removeClass("active-menu");
                }
            }
        } catch (e) {
            console.log(e);
        }
    });
	
	$('.circle p').each(function () {
        var currlink = $(this);
        var refelement = $(currlink.attr("data-content"));
        if (refelement.position().top <= scrollPos) {
            $('.circle p').removeClass("active");
            currlink.addClass("active");
        }
        else{
            currlink.removeClass("active");
        }
    });
	
}

$(window).resize(init);

function init() {
    if ($(window).width() > 768) {
        var w = $(window).width();
        var f = 1369;
        $('.about_p').css('font-size', w*28/f + 'px');
        $('.about_p').css('line-height', w*43/f + 'px');
        $('.overflow-text').css('font-size', w*14/f + 'px');
        $('.overflow-text').css('line-height', w*19/f + 'px');
        $('.head_section h2').css('font-size', w*30/f + 'px');
        $('.head_section h2').css('line-height', w*44/f + 'px');
        $('.head_section img').css('width', w*56/f + 'px');
        $('.head_section img').css('height', w*56/f + 'px');
        $('.op_sis img').css('width', w*125/f + 'px');
        $('.op_sis img').css('height', w*35/f + 'px');
        $('.project').css('font-size', w*14/f + 'px');
        $('.project').css('line-height', w*17/f + 'px');
        $('.project img').css('width', w*32/f + 'px');
        $('.project img').css('height', w*32/f + 'px');
        $('.logo').css('font-size', w*30/f + 'px');
        $('.team-size p').css('font-size', w*18/f + 'px');
        $('.team-size p').css('line-height', w*31/f + 'px');
        $('.contact p').css('font-size', w*14/f + 'px');
        $('.contact h2').css('font-size', w*14/f + 'px');
    }
}