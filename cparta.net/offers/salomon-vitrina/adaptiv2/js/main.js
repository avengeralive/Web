$(function(){
	$('.mm-nav-line ul li a.nav-link-e').on("click",function(e){
		e.preventDefault();
		scroll_el = $(this).attr('href');
		Autoscroll(scroll_el);
	});

  
});
function Autoscroll(param){
        if ($(param).length != 0) { // проверим существование элемента чтобы избежать ошибки
      $('html, body').animate({ scrollTop: $(param).offset().top - 118 }, 700); // анимируем скроолинг к элементу scroll_el
        }
      return false; // выключаем стандартное действие
}