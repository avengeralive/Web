function favorite(data) { 
	
	console.log(data)
	
	var $el = $( '<span></span>' );
	var json = {};
	json.func = "CFavorites";
    json.action = "iz_card";
    json.list_id = data.IDbase;
    json.id_card = data.options.data.ids; //tmp
    json.id_user = data.user;
	if (data.user.indexOf('wadmin_') != 0)
	{
		// $.ajax({
// 			url: '/json/',
// 			type: 'POST',
// 			dataType: 'json',
// 			data: json,
// 			error: function(ob) {
// 				console.log(ob);
// 			},
// 			success: function(ob) {    
// 				for (var x in data.mydata.favorite) ob = data.mydata.favorite[x];
// 				$spanaddizbr = $('<span class="spanaddizbr addizbr">Добавить в избранное</span>');
// 				$spandellizbr = $( '<span class="spandellizbr dellizbr">Удалить из избранного</span>' );
// 				$el.append( $spanaddizbr );
// 				$el.append( $spandellizbr );
// 				if (ob == true) {
// 					$spanaddizbr.css('display', 'none');
// 					$spandellizbr.css('display', 'block');
// 				} else {
// 					$spanaddizbr.css('display', 'block');
// 					$spandellizbr.css('display', 'none');
// 				}
// 
// 				$spanaddizbr.click(function(){
// 					json.action = "iz_add_card";
// 					json.id_card = data.ID;
// 					$.ajax({
// 						url: '//' + JSCat.domain + '/json/',
// 						type: 'POST',
// 						dataType: 'json',
// 						data: json,
// 						error: function(ob) {
// 							console.log(ob);
// 						},
// 						success: function(ob) {                   
// 							$el.children(".addizbr").css('display', 'none');
// 							$el.children(".dellizbr").css('display', 'block');
// 						}
// 					});
// 				});
// 				$spandellizbr.click(function(){
// 					json.action = "iz_del_card";
// 					json.id_card = data.ID;
// 					$.ajax({
// 						url: '//' + JSCat.domain + '/json/',
// 						type: 'POST',
// 						dataType: 'json',
// 						data: json,
// 						error: function(ob) {
// 							console.log(ob);
// 						},
// 						success: function(ob) {                   
// 							$el.children(".dellizbr").css('display', 'none');
// 							$el.children(".addizbr").css('display', 'block');
// 						}
// 					});
// 				});
// 
// 			}
// 
// 		});
		
		$el.children(".addizbr").click(function(){
			json.action = "iz_add_card";
			$.ajax({
				url: '//' + JSCat.domain + '/json/',
				type: 'POST',
				dataType: 'json',
				data: json,
				error: function(ob) {
					console.log(ob);
				},
				success: function(ob) {                   
					$el.children(".addizbr").css('display', 'none');
					$el.children(".dellizbr").css('display', 'block');
				}
			});
		});
		
		$el.children(".dellizbr").click(function(){
			json.action = "iz_del_card";
			$.ajax({
				url: '//' + JSCat.domain + '/json/',
				type: 'POST',
				dataType: 'json',
				data: json,
				error: function(ob) {
					console.log(ob);
				},
				success: function(ob) {                   
					$el.children(".dellizbr").css('display', 'none');
					$el.children(".addizbr").css('display', 'block');
				}
			});
		});
		
		
	}
	else $el = $('<span></span>');
	
	data.callback( $el );
	
}
