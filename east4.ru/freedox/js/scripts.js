$(document).ready(function(){$("a").click(function(){var elementClick=$(this).attr("href")
var destination=$(elementClick).offset().top;jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop:destination},800);return false;});if(window.innerWidth<990){$('.slider').slick({slidesToScroll:1,slidesToShow:1,arrows:true,autoplay:false,autoplaySpeed:2000});}else{$('.slider').slick({slidesToScroll:1,slidesToShow:2,arrows:true,autoplay:false,autoplaySpeed:2000});}var itembox=$(".review_radio");itembox.click(function(){var _this=$(this);_this.addClass("active").siblings(itembox).removeClass("active").find("input[type='radio']").removeAttr("checked");if(_this.hasClass('active')){_this.find("input[type='radio']").attr("checked","checked");}});var itembox=$(".review_radio");itembox.click(function(){itembox.hide();$(".review_result").fadeIn();$(".green_result").addClass("green_view");$(".red_result").addClass("red_view");$(".blue_result").addClass("blue_view");});$('.min_input .button').click(function(){$(this).siblings('input[type=file]').click();return false;});});

// preloader
jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
	$('#preloader').fadeOut('slow',function(){$(this).remove();});
});

});
