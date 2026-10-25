/* MASSIVE MENU 

Full screen adaptive menu

Build 0.2 Alpha
Author: Massive
*/

function Autoscroll(param){
	var w = $(window).width();
	var mm_nav_h;
	
  	$('body,html').animate({ scrollTop: $(param).offset().top - 100}, 1000); // анимируем скроолинг к элементу scroll_el
    
}

$(function (){
	var position;
	$(window).on({
		'resize':function() {
			if ($(".mm-open-icon").hasClass('is-active')) {
				CloseMenu(position);
			}
			addHeight();
		}
	});
	addHeight();
	$(document).on("click",".mm-open-icon",function(e){
		e.preventDefault();
		if (!$(this).hasClass('is-active')) {
			position = window.pageYOffset;
			OpenMenu();
		}
		else {
			CloseMenu(position);
		}
	});
	$('.mm-nav-mobile ul li a').on("click",function(e){
	e.preventDefault(); // если в href начинается с # или ., то ловим клик
		scroll_el = $(this).attr('href');
		CloseMenu(position);
		setTimeout(function(){
			Autoscroll(scroll_el);
		},300);
	});
});
function OpenMenu(){
	addHeight();
	$(".mm-mobile-menu").slideDown(300);
	setTimeout(function(){
		$("body").addClass('mm-fixed-body');
		$(".mm-open-icon").addClass('is-active');
	},100);
}
function CloseMenu(position){
	window.scrollTo(0,position);
	$("body").removeClass('mm-fixed-body');
	$(".mm-open-icon").removeClass('is-active');
	$(".mm-mobile-menu").slideUp(300);

}
function addHeight() {
	var h = $(window).height();
	h = h - $(".mm-container").outerHeight(true);
	$(".mm-mobile-menu").css('height', h);
	$(".mm-nav-mobile").css('height', h);
}