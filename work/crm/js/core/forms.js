function forms(id) {
    $('.form_change').remove();
    $( id ).append('<div class="form_change"><h1>Категория</h1>\
    						<div id="group_button"></div>\
    						<div id="form_content"></div></div>');

    if (JSCat.category != null) {
        call_level.call(this);
    } else {
        alert('Категории не указаны. Обратитесь к администратору');
    }
    return true;
}
//вызываем первый уровень
function call_level() {
    $('#form_content').empty();
    $('#list_form1, #list_form2, .level_1').remove();
    $('#group_button').append('<div id="list_form1"><span id="groupsale">Продажа</span><span id="grouprent">Аренда</span></div>');
    
    $('#list_form1 span').click(function(){
    	var item = $(this);
    	var itemid = $(item).attr('id');
    	$('#list_form1 span').removeClass('flag1');
    	$(item).addClass("flag1");
    	call_level2(itemid)
    });
}
//вызываем второй уровень
function call_level2(itemid) {
    var category = JSCat.category.split('_');
	//получаем список каталогов
	var json = {};
	json.func = 'CPanel';
	json.action = 'get_category';
	json.domain = JSCat.domain;
	json.token = JSCat.token;
	$.ajax({
		url: '/json/',
		type: 'POST',
		context: this,
		dataType: 'json',
		data: json,
		success: function(catalogue) {
			$('#list_form2').remove();
    		$('#group_button').append('<div id="list_form2"></div>');
			for (var prop in catalogue) {
				if ($.inArray(prop, category) != '-1') { //ебать я хакер
					if (itemid == 'groupsale') {
						if ( prop == '1' || prop == '2' || prop == '3' || prop == '4' || prop == '5' || prop == '6' || prop == '7' || prop == '8' || prop == '10' ) 
							$('#list_form2').append('<span id="group_0' + prop + '">' + catalogue[prop] + '</span>');
					} else if (itemid == 'grouprent') {
						if ( prop == '9' || prop == '11' || prop == '12' || prop == '13' || prop == '14' || prop == '15' || prop == '16' ) 
							$('#list_form2').append('<span id="group_0' + prop + '">' + catalogue[prop] + '</span>');
					}
					
                    function callform(prop, title) {
                    	$('#form_story').remove();
                        $('#group_button').before('<div id="form_story"><span class="rchange">Сменить категорию</span><span class="level_1">' + title + '</span></div>');
            			$('.rchange').click(call_level.bind(this));
                        lib.call(this, 'add', {"id":prop,"formContent":"#form_content","FuncEnd":"addf"});
                    }
					$('#group_0' + prop).click(callform.bind(this, prop, catalogue[prop]));
				}
			}
		}
	});
}

