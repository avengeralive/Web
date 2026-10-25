function openModal(){
    $('#modal-contact').show();
    $('body').css('overflow', 'hidden');
    $('modal').css('overflow', 'auto');
}
function closeModal() {
    $('#modal-contact').hide();
    $('body').css('overflow', 'auto');
}
$('.radio_label').on('click', function(){
	$(this).prev('input').attr('checked', 'checked')
});