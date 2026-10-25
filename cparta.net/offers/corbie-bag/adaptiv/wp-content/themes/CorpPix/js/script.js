(function($){


  var logo = "wp-content/uploads/2019/07/logo.svg",
      logoBlack = "wp-content/uploads/2019/07/logo-black.svg";

  $(".agree #logo img").attr("src",logoBlack);

  //Кнопка наверх и фиксированное меню
  $(document).scroll(function () {
    if ($(this).scrollTop() > 400) {
        $('.header_top').addClass("fixed");
	$('.wrapper').css({
		'paddingTop':'80px'
	});
        $("#logo img").attr("src",logoBlack);
    } else {
        $('.header_top').removeClass("fixed");
        $('.wrapper').removeAttr('style');
        $("#logo img").attr("src",logo);
        $(".agree #logo img").attr("src",logoBlack);
    }

    if ($(this).scrollTop() > 800) {
        $('#back-to-top').fadeIn();
        } else {
        $('#back-to-top').fadeOut();
    }
  });

  //Кнопка наверх
  $('#back-to-top').click(function () {
    $('.header_top').removeClass("fixed");
    $('.wrapper').removeAttr('style');
    $("#logo img").attr("src",logo);
    $(".agree #logo img").attr("src",logoBlack);

    $('body,html').animate({
        scrollTop: 0
    }, 2500);
    return false;
  });

  $(".mobilHeadMeny nav a").click(function() {
    $(".hamburger.hamburger--collapse").removeClass("is-active");
  });

})( jQuery );
