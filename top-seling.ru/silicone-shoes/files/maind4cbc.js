$(document).ready(function(){
    $('a[href^="#"]').click(function (){
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        jQuery("html:not(:animated), body:not(:animated)").animate({scrollTop: destination}, 800);
        return false;
    })
  

$('.gallery2_box').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 1,
  adaptiveHeight: true,    
  responsive: [
    {
      breakpoint: 976,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
          dots: true
      }
    },
    {
      breakpoint: 659,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
          dots: true
      }
    }
  ]
});
    
$('.stars-speak').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 2,
  slidesToScroll: 1,
  adaptiveHeight: true,    
  responsive: [
    {
      breakpoint: 976,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true
      }
    },
    {
      breakpoint: 659,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true
      }
    }
  ]
});  
    
$('.reviews_1').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 2,
  slidesToScroll: 1,
  adaptiveHeight: true,    
  responsive: [
    {
      breakpoint: 976,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1      }
    },
    {
      breakpoint: 659,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
}); 
    
$('.reviews_2').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  adaptiveHeight: true,    
  responsive: [
    {
      breakpoint: 976,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: true
      }
    },
    {
      breakpoint: 659,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true
      }
    }
  ]
});
    
$('.ab_html5 .about-box_right').click(function() {
    var state = 1
    return function() {
      if (state === 1) {
        state = 2
        $('video').each(function() {
            this.play();
        })
        $('#playvideo').hide();
      } else if (state === 2) {
        state = 1
        $('video').each(function() {
            this.pause();
        })
        $('#playvideo').show();
      }
    }
  }());    
    
    
});

