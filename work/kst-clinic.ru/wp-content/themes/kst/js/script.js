$(window).scroll(function(){
	if ($("#main-menu" ).offset().top > 100) $("header" ).addClass('bs-scroll');
	else $("header" ).removeClass('bs-scroll');
	//console.log($("footer").offset()); 
	//console.log($("body").offset()); 
	if ($("#stickyHelper").offset().top >= $("footer").offset().top) { $("#sticky").removeClass("fixed"); $("#sticky_mobile").removeClass("fixed"); }
	if ($("#stickyHelper").offset().top < $("footer").offset().top) { $("#sticky").addClass("fixed"); $("#sticky_mobile").addClass("fixed"); }
});
$(function(){
	$("#header-search").on('click', function(){
		if ($("#search-form").hasClass('active')) 
		{
			$("#header-search i").addClass('fa-search');
			$("#header-search i").removeClass('fa-close');
			$("#search-form").removeClass('active');
		}
		else 
		{
			$("#header-search i").removeClass('fa-search');
			$("#header-search i").addClass('fa-close');
			$("#search-form").addClass('active');
		}
	});
	if ($("#stickyHelper").offset().top < $("footer").offset().top) { $("#sticky").addClass("fixed"); $("#sticky_mobile").addClass("fixed"); }
	$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top - 130
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
});