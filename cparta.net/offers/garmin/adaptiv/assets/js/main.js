$(document).ready(function(){$('a[href^="#o"]').click(function(){var elementClick=$(this).attr("href");var destination=$(elementClick).offset().top;jQuery("html:not(:animated), body:not(:animated)").animate({scrollTop:destination},800);return false;})
// $('.reviews').slick({dots:true,infinite:true,speed:300,fade:false,cssEase:'linear',adaptiveHeight:true});
function createSlick(){  

	$(".reviews").not('.slick-initialized').slick({
    autoplay: true,
    dots: true,
    responsive: [{ 
        breakpoint: 200,
        settings: {
            dots: false,
            arrows: false,
            infinite: false,
            slidesToShow: 2,
            slidesToScroll: 2
        } 
    }]
});	

}

createSlick();

//Now it will not throw error, even if called multiple times.
$(window).on( 'resize', createSlick );
});