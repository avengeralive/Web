<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKjDgq1wATQHlVPSc7nNQqF8oUMKf9-PM" type="text/javascript"></script>
<? if ($object) { ?>
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<? if ($item->role_id == 2) { ?>
			<button class="create btn btn-sm btn-primary" data-id="<? echo $_GET['id']; ?>" type="button" title="Created"><i class="fa fa-sticky-note-o"></i></button> <button class="pending btn btn-sm btn-warning" data-id="<? echo $_GET['id']; ?>" type="button" title="Pending"><i class="fa fa-briefcase"></i></button> <button class="reject btn btn-sm btn-danger" data-id="<? echo $_GET['id']; ?>" type="button" title="Rejected"><i class="fa fa-close"></i></button> <button class="correct btn btn-sm btn-warning" data-id="<? echo $_GET['id']; ?>" type="button" title="Pending correction"><i class="fa fa-edit"></i></button> <button class="valuate btn btn-sm btn-info" data-id="<? echo $_GET['id']; ?>" type="button" title="Pending valuate"><i class="fa fa-star-o"></i></button> <button class="approval btn btn-sm btn-dark" data-id="<? echo $_GET['id']; ?>" type="button" title="Pending approve"><i class="fa fa-stop"></i></button> <button class="approve btn btn-sm btn-success" data-id="<? echo $_GET['id']; ?>" type="button" title="Approved"><i class="fa fa-check"></i></button> <button class="sold btn btn-sm btn-danger" data-id="<? echo $_GET['id']; ?>" type="button" title="Sold"><i class="fa fa-dollar"></i></button>
			<? } ?>
			<? if ($item->role_id == 3) { ?>
				<button class="pending btn btn-sm btn-warning" data-id="<? echo $_GET['id']; ?>" type="button" title="Pending"><i class="fa fa-briefcase"></i></button>
				<? if ($object->status == 2) { ?>
					<button class="reject btn btn-sm btn-danger" data-id="<? echo $_GET['id']; ?>" type="button" title="Rejected"><i class="fa fa-close"></i></button> <button class="correct btn btn-sm btn-warning" data-id="<? echo $_GET['id']; ?>" type="button" title="Pending correction"><i class="fa fa-edit"></i></button> <button class="valuate btn btn-sm btn-info" data-id="<? echo $_GET['id']; ?>" type="button" title="Pending valuate"><i class="fa fa-star-o"></i></button>
				<? } ?>
				<? if ($object->status == 5) { ?>
					<button class="approval btn btn-sm btn-dark" data-id="<? echo $_GET['id']; ?>" type="button" title="Pending approve"><i class="fa fa-stop"></i></button>
				<? } ?>
				<? if ($object->status == 6) { ?>
					<button class="approval btn btn-sm btn-dark" data-id="<? echo $_GET['id']; ?>" type="button" title="Pending approve"><i class="fa fa-stop"></i></button>
					<button class="approve btn btn-sm btn-success" data-id="<? echo $_GET['id']; ?>" type="button" title="Approved"><i class="fa fa-check"></i></button>
				<? } ?>
				<? if ($object->status == 7) { ?>
					<button class="sold btn btn-sm btn-danger" data-id="<? echo $_GET['id']; ?>" type="button" title="Sold"><i class="fa fa-dollar"></i></button>
				<? } ?>
			<? } ?>
			<? if ($item->role_id == 6) { ?>
				<? if ($object->status == 1 || $object->status == 4) { ?>
					<button class="pending btn btn-sm btn-warning" data-id="<? echo $_GET['id']; ?>" type="button" title="Submit"><i class="fa fa-briefcase"></i></button>
				<? } ?>
			<? } ?>
			<table class="table">
					<tr>
						<td>ID</td>
						<td id="view_id"><? echo $object->id; ?></td>
					</tr>
					<!--<tr>
						<td>Status</td>
						<td id="view_status"><? echo $object->status_name; ?></td>
					</tr>-->
					<tr>
						<td>Тип недвижимости</td>
						<td id="view_type"><? echo $object->type; ?></td>
					</tr>
					<tr>
						<td>Город</td>
						<td id="view_city"><? echo $object->city; ?></td>
					</tr>
					<tr>
						<td>Район</td>
						<td id="view_region"><? echo $object->region; ?></td>
					</tr>
					<tr>
						<td>Метро</td>
						<td id="view_metro"><? echo $object->metro; ?></td>
					</tr>
					<tr>
						<td>Ориентир</td>
						<td id="view_orient"><? echo $object->orient; ?></td>
					</tr>
					<? if ($object->type_id == 1) { ?>
					<tr>
						<td>Тип квартиры</td>
						<td id="view_ap_type"><? echo $object->ap_type; ?></td>
					</tr>
						<? if ($object->ap_type_id == 2) { ?>
					<tr>
						<td>Проект</td>
						<td id="view_project"><? echo $object->project; ?></td>
					</tr>
						<? } ?>
					<? } ?>
					<tr>
						<td>Купчая</td>
						<td id="view_kupche"><? echo $object->kupche; ?></td>
					</tr>
					<? if ($object->type_id == 2) { ?>
					<tr>
						<td>Право собственности на земельный участок</td>
						<td id="view_pravo"><? echo $object->pravo; ?></td>
					</tr>
					<? } ?>
					<tr>
						<td>Газ</td>
						<td id="view_gas"><? echo $object->gas; ?></td>
					</tr>
					<tr>
						<td>Комнат</td>
						<td id="view_room"><? echo $object->room; ?></td>
					</tr>
					<tr>
						<td>Этажей</td>
						<td id="view_floors"><? echo $object->floors; ?></td>
					</tr>
					<? if ($object->type_id == 1) { ?>
					<tr>
						<td>Этаж</td>
						<td id="view_floor"><? echo $object->floor; ?></td>
					</tr>
					<? } ?>
					<? if ($object->type_id == 2) { ?>
					<tr>
						<td>Площадь земельного участка</td>
						<td id="view_square_zeml"><? echo $object->square_zeml; ?></td>
					</tr>
					<? } ?>
					<tr>
						<td>Площадь</td>
						<td id="view_square"><? echo $object->square; ?></td>
					</tr>
					<tr>
						<td>Количество санузлов</td>
						<td id="view_sanuz"><? echo $object->sanuz; ?></td>
					</tr>
					<tr>
						<td>Балкон</td>
						<td id="view_balkon"><? echo $object->balkon; ?></td>
					</tr>
					<tr>
						<td>Ремонт</td>
						<td id="view_remont"><? echo $object->remont; ?></td>
					</tr>
					<tr>
						<td>Телефон</td>
						<td id="view_phone"><? echo $object->phone; ?></td>
					</tr>
					<tr>
						<td>Кабельное</td>
						<td id="view_kabeltv"><? echo $object->kabeltv; ?></td>
					</tr>
					<tr>
						<td>Лифт</td>
						<td id="view_lift"><? echo $object->lift; ?></td>
					</tr>
					<tr>
						<td>Гараж</td>
						<td id="view_garage"><? echo $object->garage; ?></td>
					</tr>
					<tr>
						<td>Сейф</td>
						<td id="view_safe"><? echo $object->safe; ?></td>
					</tr>
					<tr>
						<td>Окна PVC</td>
						<td id="view_pvcwin"><? echo $object->pvcwin; ?></td>
					</tr>
					<tr>
						<td>Бак для воды</td>
						<td id="view_waterboil"><? echo $object->waterboil; ?></td>
					</tr>
					<tr>
						<td>Внешнее отопление</td>
						<td id="view_warm"><? echo $object->warm; ?></td>
					</tr>
					<tr>
						<td>Комби</td>
						<td id="view_kombi"><? echo $object->kombi; ?></td>
					</tr>
					<tr>
						<td>Кондиционер</td>
						<td id="view_conditioner"><? echo $object->conditioner; ?></td>
					</tr>
					<tr>
						<td>Кухня</td>
						<td id="view_kitchen"><? echo $object->kitchen; ?></td>
					</tr>
					<tr>
						<td>Рыночная цена</td>
						<td id="view_rinok"><? if (isset($object->rinok)) echo $object->rinok; ?></td>
					</tr>
					<tr>
						<td>Ликвидная цена</td>
						<td id="view_rinok"><? if (isset($object->liquid)) echo $object->liquid; ?></td>
					</tr>
					<tr>
						<td>Риелторская цена</td>
						<td id="view_rinok"><? if (isset($object->price)) echo $object->price; ?></td>
					</tr>
				</table>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<? $images = explode(',', $object->photo); ?>
			<div class="row">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<? $i = 0; foreach ($images as $image) { ?>
						<div class="carousel-item <? if ($i==0) echo "active";?>" style="height:300px; overflow:hidden;">
							<a href="/materials/temp/files/<? echo str_replace('thumb_', '', $image); ?>" class="fancybox"><img class="d-block w-100" src="/materials/temp/files/<? echo str_replace('thumb_', '', $image); ?>" style="height: 100%; width: auto;"></a>
						</div>
						<? $i++; } ?>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			<div class="row">
			<? $i = 0; foreach ($images as $image) { ?>
			<div class="col-12 col-sm-4" style="margin-top: 15px; height: 150px; overflow: hidden;">
				<a href="/materials/temp/files/<? echo str_replace('thumb_', '', $image); ?>" class="fancybox"><img src="/materials/temp/files/<? echo $image; ?>" style="height: 100%; width: auto !important;"></a>
			</div>
			<? $i++; } ?>
			</div>
			<div class="row">
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-top: 20px;">
					<center>
						<input type="hidden" id="lat" value="<? echo trim($object->lat); ?>">
						<input type="hidden" id="lng" value="<? echo trim($object->lng); ?>">
						<div id="map_show" style="width: 100%; height: 300px; position: relative; overflow: hidden;"></div>
					</center>
				</div>
			</div>
			<div class="row">
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-top: 20px;">
					<h1>Этот объект в избранном у:</h1>
					<? foreach ($favorites as $favorite) { ?>
						<p><? echo $favorite->surname; ?> <? echo $favorite->name; ?> <? echo $favorite->patronymic; ?> <? echo $favorite->mobile; ?></p>
					<? } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<? } else { ?>
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12">
			<p>Объекта с таким ID не существует</p>
			<a href="/siteView">Назад</a>
		</div>
	</div>
</div>
<? } ?>
<div class="modal fade" id="commentbox" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewLabel">Комментарий к доработке</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="commentbox_id">
					<textarea id="comment" class="form-control"></textarea>
				</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="approve">На доработку</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(document).on('click', '.create', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/make_created',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('Объект успешно возвращён!');
						window.location = '/view?id=<? echo $_GET['id']; ?>';
					}
					else
					{
						alert('Ошибка при возвращении объекта!');
					}
				}
			});
		}
	});
	$(document).on('click', '.pending', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/make_created',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('Объект успешно возвращён!');
						window.location = '/view?id=<? echo $_GET['id']; ?>';
					}
					else
					{
						alert('Ошибка при возвращении объекта!');
					}
				}
			});
		}
	});
	$(document).on('click', '.reject', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/make_reject',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('Объект успешно отклонён!');
						window.location = '/view?id=<? echo $_GET['id']; ?>';
					}
					else
					{
						alert('Ошибка при отклонении объекта!');
					}
				}
			});
		}
	});
	$(document).on('click', '.correct', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$("#commentbox_id").val(ID);
			$("#commentbox").modal('show');
		}
	});
	$(document).on('click', '#approve', function(){
		$.ajax({
			url: '/remart/make_correct',
			method: 'post',
			dataType: 'json',
			data: {
				id: $("#commentbox_id").val(),
				comment: $("#comment").val()
			},
			success: function(data) {
				if (data == 'true') 
				{
					alert('Объект успешно отправлен на доработку!');
					window.location = '/view?id=<? echo $_GET['id']; ?>';
				}
				else
				{
					alert('Ошибка при отправлении на доработку!');
				}
			}
		});
	});
	$(document).on('click', '.valuate', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/make_valuation',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('Объект успешно отправлен на оценку!');
						window.location = '/view?id=<? echo $_GET['id']; ?>';
					}
					else
					{
						alert('Ошибка при отправки на оценку объекта!');
					}
				}
			});
		}
	});
	$(document).on('click', '.approval', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/make_approval',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('Объект успешно ожидает подтверждения!');
						window.location = '/view?id=<? echo $_GET['id']; ?>';
					}
					else
					{
						alert('Ошибка при ожидании подтверждения объекта!');
					}
				}
			});
		}
	});
	$(document).on('click', '.approve', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/make_approved',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('Объект успешно согласован!');
						window.location = '/view?id=<? echo $_GET['id']; ?>';
					}
					else
					{
						alert('Ошибка при согласовании объекта!');
					}
				}
			});
		}
	});
	$(document).on('click', '.sold', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/make_sold',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('Объект успешно продан!');
						window.location = '/view?id=<? echo $_GET['id']; ?>';
					}
					else
					{
						alert('Ошибка при продаже объекта!');
					}
				}
			});
		}
	});
});
$(function(){
// Google maps
// Add object mark
var k = 0;
function initialize_map() {
	
	// if it's a page ADD NOTE
	if (document.getElementById("map")) {
	  
	 	var latValue = "40.39297294190957";
	 	var lngValue = "49.84891891479492";

	 
    	var haightAshbury = new google.maps.LatLng( latValue, lngValue);//(долгота, широта)
    	var mapOptions = {
      	  zoom: 13,//масштаб
     	   center: haightAshbury,//позиционируем карту на заданые координаты
     	   mapTypeId: google.maps.MapTypeId.ROADMAP//задаем тип карты
    	};    
    	mapAddMark = new google.maps.Map(document.getElementById("map"), mapOptions);//инициализация карты
 
    	google.maps.event.addListener(mapAddMark, 'click', function (event) {
			if (k < 1) { // If there is no marker
     		   	addMarker(event.latLng);
			}
    	});//добавляем событие нажание мышки

	} // if it is a page SHOW DETAILS
	else if (document.getElementById("map_show")) {
		
		var latValue = $("#lat").val();
	 	var lngValue = $("#lng").val();
		
		var haightAshbury = new google.maps.LatLng( latValue, lngValue);//(долгота, широта)
    	var mapOptions = {
      	  zoom: 13,//масштаб
     	   center: haightAshbury,//позиционируем карту на заданые координаты
     	   mapTypeId: google.maps.MapTypeId.ROADMAP//задаем тип карты
    	};    
    	mapAddMark = new google.maps.Map(document.getElementById("map_show"), mapOptions);//инициализация карты
		console.log(mapAddMark);
		marker = new google.maps.Marker({
        	position: haightAshbury,
        	map: mapAddMark,
        	title: ""
    	});//добавление маркера
	} else if (document.getElementById("map_admin")) {
	 	var latValue = $('#lat').val() ? $('#lat').val() : "40.39297294190957";
	 	var lngValue = $('#lng').val() ? $('#lng').val() : "49.84891891479492";
		var lat = $('#lat').val();
		var lng = $('#lng').val();

	 
    	var haightAshbury = new google.maps.LatLng( latValue, lngValue);//(долгота, широта)
    	var mapOptions = {
      	  zoom: 13,//масштаб
     	   center: haightAshbury,//позиционируем карту на заданые координаты
     	   mapTypeId: google.maps.MapTypeId.ROADMAP//задаем тип карты
    	};    
    	mapAddMark = new google.maps.Map(document.getElementById("map_admin"), mapOptions);//инициализация карты
		
        if ((lat != "") && (lng != "")) {
    		marker = new google.maps.Marker({
        		position: haightAshbury,
        		map: mapAddMark,
        		title: "",
				draggable:true
    		});//добавление маркера
			
			google.maps.event.addListener(marker, 'dragend', function(event) {
				if (confirm('Изменить маркер?')) {
					latlng = event.latLng.toString().split(",");
					lat = latlng[0].split("(")[1];
					lng = latlng[1].split(")")[0];
					document.getElementById('lat').value = lat;
					document.getElementById('lng').value = lng;
					document.getElementById('gmap_msg').innerHTML = "Данные изменены.";
				}
			})
			
		} else {
			google.maps.event.addListener(mapAddMark, 'click', function (event) {
				if (k < 1) { // If there is no marker
					addMarker(event.latLng);
				}
			});//добавляем событие нажание мышки
		}

	}
	
}
//функция добавления маркера
function addMarker(location) {
	k++;
	marker = new google.maps.Marker({
        position: location,
        map: mapAddMark,
        title: "",
		draggable:true
    });//добавление маркера
	google.maps.event.addListener(marker, 'click', function(event) {
		if (confirm('Добавить маркер?')) {
			latlng = event.latLng.toString().split(",");
			lat = latlng[0].split("(")[1];
			lng = latlng[1].split(")")[0];
			document.getElementById('lat').value = lat;
			document.getElementById('lng').value = lng;
			document.getElementById('gmap_msg').innerHTML = "Данные добавлены.";
		}
	})
	google.maps.event.addListener(marker, 'dragend', function(event) {
		if (confirm('Изменить маркер?')) {
			latlng = event.latLng.toString().split(",");
			lat = latlng[0].split("(")[1];
			lng = latlng[1].split(")")[0];
			document.getElementById('lat').value = lat;
			document.getElementById('lng').value = lng;
			document.getElementById('gmap_msg').innerHTML = "Данные изменены.";
		}
	})
}



	initialize_map ();
//--------------------------------------

});
</script>