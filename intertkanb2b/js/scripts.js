/*********************************************************************************

	Template Name: Blazen - Event and Exhibition Bootstrap4 Template
	Description: A perfect multi-concept template for event or event management websites. It comes with nice and clean design.
	Version: 1.0

    Note: This is scripts js. All custom scripts here.

**********************************************************************************/

/*===============================================================================
			[ INDEX ]
=================================================================================

    Header Style 1 Sticky Header
    Header Style 2 Sticky Header
    Progress Bar Effect
    Breadcrumb Padding
    Portfolio Load More

=================================================================================
			[ END INDEX ]
================================================================================*/

(function ($) {
    'use strict';

    /* Header Style 1 Sticky Header */
    if($('.header-style-1.sticky-header').length){
        
        $(window).on('scroll', function () {

            var scrollPos = $(this).scrollTop();
              
            if (scrollPos > 300) {
                $('.sticky-header').addClass('is-sticky');
            } else {
                $('.sticky-header').removeClass('is-sticky');
            }

        });

    }

    /* Header Style 2 Sticky Header */
    if($('.header-style-2.sticky-header').length){
        var headerOffset = $('.header-style-2').offset().top;

        $(window).on('scroll', function () {

            var scrollPos = $(this).scrollTop();

            if (scrollPos > headerOffset + 500) {
                $('.sticky-header').addClass('is-sticky');
            } else {
                $('.sticky-header').removeClass('is-sticky');
            }

        });

    }




    /* Progress Bar Effect */
    $(window).on('scroll', function () {

        function winScrollPosition() {
            var scrollPos = $(window).scrollTop(),
                winHeight = $(window).height();
            var scrollPosition = Math.round(scrollPos + (winHeight / 1.2));
            return scrollPosition;
        }


        var trigger = $('.progress-bar');
        if (trigger.length) {
            var triggerPos = Math.round(trigger.offset().top);
            if (triggerPos < winScrollPosition()) {
                trigger.each(function () {
                    $(this).addClass('fill');
                });
            }
        }

    });






    /* Breadcrumb Padding */
    var winWidth = $(window).width();
    if(winWidth > 991){
        if( $('.cr-breadcrumb-area').length && $('.header-transparent').length ){
            var transparentHeaderHeight = $('.header-transparent').innerHeight();
            $('.cr-breadcrumb-area').css('padding-top', transparentHeaderHeight + 'px');
        }
    }



    /* Portfolio Load More */
    function portfolioLoadMore() {

        var portfolioGrid = $('.portfolios-loadmore-active');
        var portfolioSingleItem = '.portfolio-single-item';

        var portfolioInitialItems = portfolioGrid.data('portfolio-show');
        var portfolioNextItems = portfolioGrid.data('portfolio-load');
        var portfolioLoadMoreBtn = $('.portfolio-loadmore-button');

        /*-- Function that Show items when page is loaded --*/
        function portfolioShowNextItems(portfolioPagination) {
            var portfolioItemsMax = $('.portfolio-single-item.hidden').length;
            var portfoliotemsCount = 0;

            $('.portfolio-single-item.hidden').each(function () {
                if (portfoliotemsCount < portfolioPagination) {
                    $(this).removeClass('hidden');
                    portfoliotemsCount++;
                }
            });

            if (portfoliotemsCount >= portfolioItemsMax) {
                portfolioLoadMoreBtn.hide();
            }

        }

        /*-- Function that hides items when page is loaded --*/
        function portfolioHideItems(portfolioPagination) {
            var portfolioItemsMax = $(portfolioSingleItem).length;
            var portfoliotemsCount = 0;

            $(portfolioSingleItem).each(function () {
                if (portfoliotemsCount >= portfolioPagination) {
                    $(this).addClass('hidden');
                }
                portfoliotemsCount++;
            });

            if (portfoliotemsCount < portfolioItemsMax || portfolioInitialItems >= portfolioItemsMax) {
                portfolioLoadMoreBtn.hide();
            }

        }

        /*-- Function that Load items when Button is Click --*/
        portfolioLoadMoreBtn.on('click', function (e) {
            e.preventDefault();
            portfolioShowNextItems(portfolioNextItems);
        });

        portfolioHideItems(portfolioInitialItems);

    }
    portfolioLoadMore();

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
          scrollTop: target.offset().top - 100
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

  $("#contact-form button").on('click', function(){
    var flag = 0;
    if ($("#contact-form input[name=company_name]").val() == '') {
        $("#contact-form input[name=company_name]").addClass('error');
        flag = 1;
    }
    if ($("#contact-form input[name=contact_pers]").val() == '') {
        $("#contact-form input[name=contact_pers]").addClass('error');
        flag = 1;
    }
    if ($("#contact-form input[name=phone]").val() == '') {
        $("#contact-form input[name=phone]").addClass('error');
        flag = 1;
    }
    if ($("#contact-form input[name=email]").val() == '') {
        $("#contact-form input[name=email]").addClass('error');
        flag = 1;
    }
    if ($("#contact-form input[name=source]").val() == '') {
        $("#contact-form input[name=source]").addClass('error');
        flag = 1;
    }
    if (!flag) return true;
    else return false;
  });

  $("#contact-form2 button").on('click', function(){
    var flag = 0;
    if ($("#contact-form2 input[name=name]").val() == '') {
        $("#contact-form2 input[name=name]").addClass('error');
        flag = 1;
    }
    if ($("#contact-form2 input[name=surname]").val() == '') {
        $("#contact-form2 input[name=surname]").addClass('error');
        flag = 1;
    }
    if ($("#contact-form2 input[name=patro]").val() == '') {
        $("#contact-form2 input[name=patro]").addClass('error');
        flag = 1;
    }
    if ($("#contact-form2 input[name=phone]").val() == '') {
        $("#contact-form2 input[name=phone]").addClass('error');
        flag = 1;
    }
    if ($("#contact-form2 input[name=email]").val() == '') {
        $("#contact-form2 input[name=email]").addClass('error');
        flag = 1;
    }
    if ($("#contact-form2 input[name=site]").val() == '') {
        $("#contact-form2 input[name=site]").addClass('error');
        flag = 1;
    }
    if ($("#contact-form2 input[name=source]").val() == '') {
        $("#contact-form2 input[name=source]").addClass('error');
        flag = 1;
    }
    if ($('#contact-form2 select[name=type_deal]').val() == 0) {
        $("#contact-form2 select[name=type_deal]").addClass('error');
        flag = 1;
    }
    if (!flag) return true;
    else return false;
  });

})(jQuery);