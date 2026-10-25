$(document).ready(function(){
	$('.popup-fixed').click(function(e) {
		if($(e.target).closest('.popup-content').length==0) {
			$('.popup-overlay').css('display', 'none');
			$('.popup-fixed').css('display', 'none');
			$('.popup').css('display', 'none');
		}
	});

	$('.popup__close').click(function() {
		$('.popup-overlay').css('display', 'none');
		$('.popup-fixed').css('display', 'none');
		$('.popup').css('display', 'none');
	});

	$('.open-popup').click(function(event) {
		event.preventDefault();
		$('.popup-overlay').css('display', 'block');
		$('.popup-fixed').css('display', 'block');
		$('.popup').css('display', 'block');
	});
});

function openPopupThanks() {
	$('.popup-overlay').css('display', 'block');
	$('.popup-fixed').css('display', 'block');
	$('.popup-thanks').css('display', 'block');
}

function closePopup() {
	$('.popup-overlay').css('display', 'none');
	$('.popup-fixed').css('display', 'none');
	$('.popup').css('display', 'none');
}

function clearValue() {
	$('input[type="text"]').val('');
	$('textarea').val('');
	$('.wrap-element__placeholder').show();
}