function isMobile() {
	try{ document.createEvent("TouchEvent"); return true; }
	catch(e){ return false; }
}

$(document).ready(function(){

	//contacts-accordion
	$('.contacts-list--item-head').click(function() {
		$('.contacts-list--item-content').slideUp();
		$(this).next().slideDown();
		return false;
	});

	//sidemenu
	$('#menu-toggle').on('click', function(event){
		event.preventDefault();
		$('html').toggleClass('side-menu-open');
	});

	//file attachment
	$('.attach-file-input').change(function() {
		var filename = $(this).val();
		$(this).parent('.attach-container').find('.attach-file-name').html(filename);
		$(this).parent().parent().addClass('show-attach-reset');
	});
	$('.attach-reset').on('click', function(event) {
		event.preventDefault();
		var inputFileElement = $(this).parent().find('.attach-container .attach-file-input');
		inputFileElement.replaceWith(inputFileElement.val('').clone(true));
		$(this).parent().find('.attach-container .attach-file-name').html('Добавить файл')
		$(this).parent().removeClass('show-attach-reset');
	});

	$('.tooltip span').on('click', function(event){
		event.preventDefault();
		if (isMobile()) {
			$(this).parent().toggleClass('open');
		}
	});

});