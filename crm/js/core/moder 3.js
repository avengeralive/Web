function moder(data) {

	var i = data.i;
	var item_id = data.ID;
	var list_id = data.IDbase;
	var status = data.mydata.status;

	$el = $( '<span></span>' );

	if (JSCat.userType == '1') {
		
		var text = (status[i] == '1') ? 'Снять с публикации' : 'Опубликовать';
	    $el.empty().append('<span class="moders">'+ text +'</span><div class="full moders' + list_id + '' + item_id + '' + i + '"><div class="wrform"><b>Жалобы</b><span class="close"></span><button class="modersdone" id="done' + list_id + '' + item_id + '' + i +'">Продолжить</button></div></div>');
		
		$el.find('.moders').click(function() {
	        $('.moders' + list_id + '' + item_id + '' + i + '').show();
	        listwrongs();
	    });
	    $el.find('.close').click(function() {
            $('.moders' + list_id + '' + item_id + '' + i + '').hide();
	    });
		$el.find('.modersdone').click(function() {
			renderer.get.query({
				func: 'CEditCat',
				action: 'moderation',
				post: {
					method: 'post',
					change: (status[i] == '1') ? '0' : '1',
					item_id: item_id,
					list_id: list_id
				},
				callback: function(response) {
					window.location.reload()
				}
			});
		});
		function listwrongs(){
			util.ajax({
				func: 'CWrongs',
				action: 'WrongsListID',
				post: {
					method: 'post',
					item_id: item_id,
					list_id: list_id
				},
				json: false,
				callback: function(response) {
					if (response != 'Жалоб нет') {
						for (var n in response){
							$('.modersdone[id="done' + list_id + '' + item_id + '' + i +'"]').before('<div>'+ n +': '+ response[n] +'</div>');
						}
					} else {
						$('.modersdone[id="done' + list_id + '' + item_id + '' + i +'"]').before('<div>'+ response +'</div>');
					}
				}
			});
		}
	    
	}

	data.callback( $el );
}