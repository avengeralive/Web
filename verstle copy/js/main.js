$(document).ready(function () {
	
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
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top-100 <= scrollPos) {
            $('.fixed-menu ul li a').removeClass("active-menu");
            currLink.addClass("active-menu");
        }
        else{
            currLink.removeClass("active-menu");
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

