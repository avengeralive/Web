<div class="row">
    <div class="container">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<? if ($item->role_id != 7) { ?>
	    <button class="btn btn-success" id="save" type="submit"><? echo Translations::gi()->save; ?></button>
	    <button class="btn btn-success" id="savesubmit" type="submit"><? echo Translations::gi()->save_submit; ?></button>
	    <a href="/dashboard" class="btn btn-danger"><? echo Translations::gi()->close; ?></a>
	    <button class="btn btn-warning" id="edit" type="button"><? echo Translations::gi()->edit; ?></button>
	    <? } ?>
	    <a href="/view?id=<? echo $_GET['id']; ?>" class="btn btn-info" target="_blank"><? echo Translations::gi()->view; ?></a>
	    <? if ($item->role_id == 2 || $item->role_id == 4) { ?>
	    <!--<button class="btn btn-info changestatus st1 st" data-id="1" type="button"><? echo Translations::gi()->created; ?>Created</button>
	    <button class="btn btn-info changestatus st2 st" data-id="2" type="button"><? echo Translations::gi()->pending; ?>Pending</button>-->
	    <button class="btn btn-danger changestatus st3 st" data-id="3" type="button"><? echo Translations::gi()->rejected; ?>Reject object</button>
	    <button class="btn btn-warning st4 st" data-toggle="modal" data-target="#correction"><? echo Translations::gi()->pending_correction; ?>Отправить на доработку</button>
	    <!--<button class="btn btn-info changestatus st5 st" data-id="5" type="button"><? echo Translations::gi()->pending_valuate; ?>Pending valuate</button>
	    <button class="btn btn-info changestatus st6 st" data-id="6" type="button"><? echo Translations::gi()->pending_approve; ?>Pending approve</button>-->
	    <button class="btn btn-success changestatus st7 st" data-id="7" type="button"><? echo Translations::gi()->approved; ?>Approve</button>
	    <button class="btn btn-dark changestatus st8 st" data-id="8" type="button"><? echo Translations::gi()->sold; ?>Sold</button>
	    <button class="btn btn-primary st9 st" data-toggle="modal" data-target="#appraisers"><? echo Translations::gi()->send_to_appraisers; ?>Отправить на оценку</button>
	    <button class="btn btn-primary st9 st" data-toggle="modal" data-target="#favorites"><? echo Translations::gi()->add_to_favorites; ?>Добавить в избранное</button>
	    <!--<ul>
		<li>Created - объект создан риелтором, находится в варианте черновика, не подтвержден им для дальнейшен обработки</li>
		<li>Pending - объект подтверден риелтором для дальнейшен обработки, у ПМ есть возможность отклонить его, отправить на доработку, либо же приготовить к оценке</li>
		<li>Reject - отклонить объект</li>
		<li>Pending correction - отправить объект на доработку с комментарием</li>
		<li>Pending valuate - объект готов к оценке. В этом статусе его можно отправлять на оценку оценщикам</li>
		<li>Pending approve - оценка завершена, ждем акты о лучшей оценке и т.д.</li>
		<li>Approved - объект оценен, может быть показан пользователям</li>
		<li>Sold - объект продан</li>
	    </ul>-->
	    <? } ?>
	</div>
    </div>
</div>
<div class="row formbody">
    <div class="container">
    	<div class="col-12 correction_comment"></div>
    <? include('object_form.php'); ?>
    </div>
    <script type="text/javascript">
	$(function(){
	    // Google maps
	    // Add object mark
	    var k = 0;
	    function initialize_map() {
		var latValue = $('#lat').val() ? $('#lat').val() : "40.39297294190957";
		var lngValue = $('#lng').val() ? $('#lng').val() : "49.84891891479492";
		var lat = $('#lat').val();
		var lng = $('#lng').val();
		var haightAshbury = new google.maps.LatLng( latValue, lngValue);
		var mapOptions = {
		    zoom: 13,
		    center: haightAshbury,
		    mapTypeId: google.maps.MapTypeId.ROADMAP
		};    
		mapAddMark = new google.maps.Map(document.getElementById("map_admin"), mapOptions);	
		if ((lat != "") && (lng != "")) {
		    marker = new google.maps.Marker({
			position: haightAshbury,
			map: mapAddMark,
			title: "",
			draggable:true
		    });
		    google.maps.event.addListener(marker, 'dragend', function(event) {
			if (confirm('Изменить маркер?')) {
			    latlng = event.latLng.toString().split(",");
			    lat = latlng[0].split("(")[1];
			    lng = latlng[1].split(")")[0];
			    document.getElementById('lat').value = lat;
			    document.getElementById('lng').value = lng;
			    document.getElementById('gmap_msg').innerHTML = "Данные изменены.";
			}
		    });
		} else {
		    google.maps.event.addListener(mapAddMark, 'click', function (event) {
			if (k < 1) {
			    addMarker(event.latLng);
			}
		    });
		}
	    }
	    function addMarker(location) {
		k++;
		marker = new google.maps.Marker({
		    position: location,
		    map: mapAddMark,
		    title: "",
		    draggable:true
		});
		latlng = location.toString().split(",");
		lat = latlng[0].split("(")[1];
		lng = latlng[1].split(")")[0];
		document.getElementById('lat').value = lat;
			document.getElementById('lng').value = lng;
			document.getElementById('gmap_msg').innerHTML = "Данные добавлены.";
		google.maps.event.addListener(marker, 'click', function(event) {
		    if (confirm('Добавить маркер?')) {
			latlng = event.latLng.toString().split(",");
			lat = latlng[0].split("(")[1];
			lng = latlng[1].split(")")[0];
			document.getElementById('lat').value = lat;
			document.getElementById('lng').value = lng;
			document.getElementById('gmap_msg').innerHTML = "Данные добавлены.";
		    }
		});
		google.maps.event.addListener(marker, 'dragend', function(event) {
		    if (confirm('Изменить маркер?')) {
			latlng = event.latLng.toString().split(",");
			lat = latlng[0].split("(")[1];
			lng = latlng[1].split(")")[0];
			document.getElementById('lat').value = lat;
			document.getElementById('lng').value = lng;
			document.getElementById('gmap_msg').innerHTML = "Данные изменены.";
		    }
		});
	    }
	    function disable() {
		$('form#needs-validation input').attr('disabled', true);
		$('form#needs-validation select').attr('disabled', true);
		$('form#needs-validation textarea').attr('disabled', true);
		$('form#needs-validation checkbox').attr('disabled', true);
		$('form#needs-validation radio').attr('disabled', true);
		$('form#needs-validation button').attr('disabled', true);
		$('form#needs-validation button').addClass('disabled');
		$('.dz-clickable').addClass('disabledlink');
		$('#map_admin').addClass('disabledlink');
	    }
	    function enable() {
		$('form#needs-validation input').attr('disabled', false);
		$('form#needs-validation select').attr('disabled', false);
		$('form#needs-validation textarea').attr('disabled', false);
		$('form#needs-validation checkbox').attr('disabled', false);
		$('form#needs-validation radio').attr('disabled', false);
		$('form#needs-validation button').attr('disabled', false);
		$('form#needs-validation button').removeClass('disabled');
		$('.dz-clickable').removeClass('disabledlink');
		$('#map_admin').removeClass('disabledlink');
		changeParams();
		changeParams2();
		changeParams3();
	    }
	    function activity_buttons(status)
	    {
		<? if ($item->role_id == 4) { ?>
		/*if (status == 2 || status == 1) {
		    $(".st").attr('disabled', true);
		    $(".st3").attr('disabled', false);
		    $(".st4").attr('disabled', false);
		    $(".st5").attr('disabled', false);
		}
		if (status == 3) {
		    $(".st").attr('disabled', true);
		}
		if (status == 4) {
		    $(".st").attr('disabled', true);
		}
		if (status == 5) {
		    $(".st").attr('disabled', true);
		    $(".st6").attr('disabled', false);
		    $(".st9").attr('disabled', false);
		}
		if (status == 6) {
		    $(".st").attr('disabled', true);
		    $(".st7").attr('disabled', false);
		}
		if (status == 7) {
		    $(".st").attr('disabled', true);
		    $(".st8").attr('disabled', false);
		}
		if (status == 8) {
		    $(".st").attr('disabled', true);
		}*/
		<? } ?>
	    }
	    $("#edit").on('click', function() { 
	        enable();
	    });
	    $.ajax({
		url: '/remart/object',
		method: 'get',
		dataType: 'json',
		data: {
		    id: <? echo $_GET['id'] ?>
		},
		success: function(data)
		{
		    $("#photo").val(data.data.photo);
		    $("#main_photo").val(data.data.main_photo);
		    $("#kupche_doc").val(data.data.kupche_doc);
		    $("#texpass_doc").val(data.data.texpass_doc);
		    $("#lat").val(data.data.lat);
		    $("#lng").val(data.data.lng);
		    $("#type").val(data.data.type);
		    $("#city").val(data.data.city);
		    $("#region").val(data.data.region);
		    $("#metro").val(data.data.metro);
		    $("#address").val(data.data.address);
		    $("#price").val(data.data.price);
		    $("#ap_type").val(data.data.ap_type);
		    $("#project").val(data.data.project);
		    $("#kupche").val(data.data.kupche);
		    $("#pravo").val(data.data.pravo);
		    $("#gas").val(data.data.gas);
		    $("#room").val(data.data.room);
		    $("#floors").val(data.data.floors);
		    $("#floor").val(data.data.floor);
		    $("#square_zeml").val(data.data.square_zeml);
		    $("#square").val(data.data.square);
		    $("#sanuz").val(data.data.sanuz);
		    $("#balkon").val(data.data.balkon);
		    $("#remont").val(data.data.remont);
		    $("#comment").val(data.data.comment);
		    if (data.data.correction_comment != '') $(".correction_comment").html('<p style="margin: 0px;" class="text-danger">' + data.data.correction_comment + '</p><style>.correction_comment { padding: 10px; border: 1px solid red; margin-bottom: 10px; }</style>');
		    if (data.data.phone == 1) $("#phone").prop('checked', true);
		    if (data.data.kabeltv == 1) $("#kabeltv").prop('checked', true);
		    if (data.data.lift == 1) $("#lift").prop('checked', true);
		    if (data.data.garage == 1) $("#garage").prop('checked', true);
		    if (data.data.safe == 1) $("#safe").prop('checked', true);
		    if (data.data.pvcwin == 1) $("#pvcwin").prop('checked', true);
		    if (data.data.waterboil == 1) $("#waterboil").prop('checked', true);
		    if (data.data.warm == 1) $("#warm").prop('checked', true);
		    if (data.data.kombi == 1) $("#kombi").prop('checked', true);
		    if (data.data.pool == 1) $("#pool").prop('checked', true);
		    if (data.data.conditioner == 1) $("#conditioner").prop('checked', true);
		    if (data.data.kitchen == 1) $("#kitchen").prop('checked', true);
		    if (data.data.orient) orient = data.data.orient.split(',');
		    else orient = [];
		    for (i in orient) { $("#orient_" + orient[i]).prop('checked', true); }
		    images = $('#photo').val().split(',');
		    $.ajax({
			url: '/remart/getImages?ids=' + $('#photo').val(),
			method: 'get',
			dataType: 'json',
			success: function(data) {			   
			    $('.images').html('');
			    for (i in data) 
			    {
				if (data[i].id == $("#main_photo").val()) main = '<i class="fa fa-close"></i>';
				else main = '<i class="fa fa-check"></i>';
				$('.images').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + data[i].material_path + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + data[i].id + '"><i class="fa fa-trash"></i></button> <button class="btn btn-sm btn-success makemain" data-name="' + data[i].id + '">' + main + '</button> <input type="text" class="photo_ordering form-control" data-id="' + data[i].id + '" value="' + data[i].ordering + '"></div>');
			    }
			    disable();
			}	
		    });
		    images1 = $('#kupche_doc').val().split(',');
		    $.ajax({
			url: '/remart/getImages?ids=' + $('#kupche_doc').val(),
			method: 'get',
			dataType: 'json',
			success: function(data) {			   
			    $('.images1').html('');
			    for (i in data) $('.images1').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + data[i].material_path + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + data[i].id + '"><i class="fa fa-trash"></i></button> <input type="text" class="photo_ordering form-control" data-id="' + data[i].id + '" value="' + data[i].ordering + '"></div>');
			    disable();
			}
		    });
		    images2 = $('#texpass_doc').val().split(',');
		    $.ajax({
			url: '/remart/getImages?ids=' + $('#texpass_doc').val(),
			method: 'get',
			dataType: 'json',
			success: function(data) {			   
			    $('.images2').html('');
			    for (i in data) $('.images2').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + data[i].material_path + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + data[i].id + '"><i class="fa fa-trash"></i></button> <input type="text" class="photo_ordering form-control" data-id="' + data[i].id + '" value="' + data[i].ordering + '"></div>');
			    disable();
			}
		    });
		    initialize_map();
		    activity_buttons(data.data.status);
		    disable();
		},
		error: function(data)
		{
		    console.log(data);
		}
	    });
	    $(".changestatus").on('click', function() {
		if (confirm('Вы уверены, что хотите изменить статус объекта?')) {
		    var status = $(this).attr('data-id');
		    $.ajax({
			url: '/remart/change_object_status',
			method: 'post',
			dataType: 'json',
			data: {
			    id: <? echo $_GET['id']; ?>,
			    status: status,
			    correction_comment: $("#correction_comment").val()
			},
			success: function(data) {
			    alert('Статус объекта изменен');
			    $("#correction").modal('hide');
			    activity_buttons(status);
			}
		    });
		}
		return false;
	    });
	    $("#save").on('click', function(event){
		if ($("#needs-validation")[0].checkValidity() == false) {
		    event.preventDefault();
		    event.stopPropagation();
		}
		else
		{
		    orient = [];
		    <? foreach ($orients as $orient) { ?>
		    if ($("#orient_<? echo $orient->id; ?>").is(':checked') == true) orient.push(<? echo $orient->id; ?>);
		    <? } ?>	
		    orient = orient.join();
		    if($("#phone").is(':checked') == true) phone = 1; else phone = 0;
		    if($("#kabeltv").is(':checked') == true) kabeltv = 1; else kabeltv = 0;
		    if($("#lift").is(':checked') == true) lift = 1; else lift = 0;
		    if($("#garage").is(':checked') == true) garage = 1; else garage = 0;
		    if($("#safe").is(':checked') == true) safe = 1; else safe = 0;
		    if($("#pvcwin").is(':checked') == true) pvcwin = 1; else pvcwin = 0;
		    if($("#waterboil").is(':checked') == true) waterboil = 1; else waterboil = 0;
		    if($("#warm").is(':checked') == true) warm = 1; else warm = 0;
		    if($("#kombi").is(':checked') == true) kombi = 1; else kombi = 0;
		    if($("#conditioner").is(':checked') == true) conditioner = 1; else conditioner = 0;
		    if($("#kitchen").is(':checked') == true) kitchen = 1; else kitchen = 0;
		    if($("#pool").is(':checked') == true) pool = 1; else pool = 0;
		    var imgord = [];
		    $(".photo_ordering").each(function(index, value){
			console.log($(value));
			imgord[$(value).attr('data-id')] = $(value).val();
			console.log(imgord);
		    });
		    $.ajax({
			url: '/remart/save_object',
			method: 'post',
			dataType: 'json',
			data: {
			    id: <? echo $_GET['id'] ?>,
			    photo: $('#photo').val(), 
			    main_photo: $('#main_photo').val(), 
			    address: $('#address').val(), 
			    kupche_doc: $('#kupche_doc').val(), 
			    texpass_doc: $('#texpass_doc').val(), 
			    type: $('#type').val(), 
			    lat: $('#lat').val(), 
			    lng: $('#lng').val(), 
			    city: $('#city').val(), 
			    region: $('#region').val(),
			    metro: $('#metro').val(),
			    comment: $('#comment').val(),
			    orient: orient,
			    project: $('#project').val(),
			    price: $('#price').val(),
			    ap_type: $('#ap_type').val(),
			    kupche: $('#kupche').val(),
			    pravo: $('#pravo').val(),
			    gas: $('#gas').val(),
			    room: $('#room').val(),
			    floors: $('#floors').val(),
			    floor: $('#floor').val(),
			    square_zeml: $('#square_zeml').val(),
			    square: $('#square').val(),
			    sanuz: $('#sanuz').val(),
			    balkon: $('#balkon').val(),
			    remont: $('#remont').val(),
			    kupche_text: $('#kupche_text').val(),
			    phone: phone,
			    kabeltv: kabeltv,
			    lift: lift,
			    garage: garage,
			    safe: safe,
			    pvcwin: pvcwin,
			    waterboil: waterboil,
			    warm: warm,
			    kombi: kombi,
			    conditioner: conditioner,
			    kitchen: kitchen,
			    pool: pool,
			    status: 1,
			    imgord: JSON.stringify(imgord)
			},
			success: function(data)
			{
			    if (data == true) 
			    {
				alert('<? echo Translations::gi()->edit_object_success; ?>');
				disable();
			    }
			    else
			    {
				alert('<? echo Translations::gi()->edit_object_error; ?>');
			    }
			},
			error: function(data)
			{
			    console.log(data);
			}
		    });
		}
		$("#needs-validation").addClass("was-validated");
		return false;
	    });
	    $("#savesubmit").on('click', function(event){
		if ($("#needs-validation")[0].checkValidity() == false) {
		    event.preventDefault();
		    event.stopPropagation();
		}
		else
		{
		    orient = [];
		    <? foreach ($orients as $orient) { ?>
		    if ($("#orient_<? echo $orient->id; ?>").is(':checked') == true) orient.push(<? echo $orient->id; ?>);
		    <? } ?>	
		    orient = orient.join();
		    if($("#phone").is(':checked') == true) phone = 1; else phone = 0;
		    if($("#kabeltv").is(':checked') == true) kabeltv = 1; else kabeltv = 0;
		    if($("#lift").is(':checked') == true) lift = 1; else lift = 0;
		    if($("#garage").is(':checked') == true) garage = 1; else garage = 0;
		    if($("#safe").is(':checked') == true) safe = 1; else safe = 0;
		    if($("#pvcwin").is(':checked') == true) pvcwin = 1; else pvcwin = 0;
		    if($("#waterboil").is(':checked') == true) waterboil = 1; else waterboil = 0;
		    if($("#warm").is(':checked') == true) warm = 1; else warm = 0;
		    if($("#kombi").is(':checked') == true) kombi = 1; else kombi = 0;
		    if($("#conditioner").is(':checked') == true) conditioner = 1; else conditioner = 0;
		    if($("#kitchen").is(':checked') == true) kitchen = 1; else kitchen = 0;
		    if($("#pool").is(':checked') == true) pool = 1; else pool = 0;
		    var imgord = [];
		    $(".photo_ordering").each(function(index, value){
			console.log($(value));
			imgord[$(value).attr('data-id')] = $(value).val();
			console.log(imgord);
		    });
		    $.ajax({
			url: '/remart/save_object',
			method: 'post',
			dataType: 'json',
			data: {
			    id: <? echo $_GET['id'] ?>,
			    photo: $('#photo').val(), 
			    main_photo: $('#main_photo').val(), 
			    address: $('#address').val(), 
			    kupche_doc: $('#kupche_doc').val(), 
			    texpass_doc: $('#texpass_doc').val(), 
			    type: $('#type').val(), 
			    lat: $('#lat').val(), 
			    lng: $('#lng').val(), 
			    city: $('#city').val(), 
			    region: $('#region').val(),
			    metro: $('#metro').val(),
			    comment: $('#comment').val(),
			    orient: orient,
			    project: $('#project').val(),
			    price: $('#price').val(),
			    ap_type: $('#ap_type').val(),
			    kupche: $('#kupche').val(),
			    pravo: $('#pravo').val(),
			    gas: $('#gas').val(),
			    room: $('#room').val(),
			    floors: $('#floors').val(),
			    floor: $('#floor').val(),
			    square_zeml: $('#square_zeml').val(),
			    square: $('#square').val(),
			    sanuz: $('#sanuz').val(),
			    balkon: $('#balkon').val(),
			    remont: $('#remont').val(),
			    kupche_text: $('#kupche_text').val(),
			    phone: phone,
			    kabeltv: kabeltv,
			    lift: lift,
			    garage: garage,
			    safe: safe,
			    pvcwin: pvcwin,
			    waterboil: waterboil,
			    warm: warm,
			    kombi: kombi,
			    conditioner: conditioner,
			    kitchen: kitchen,
			    pool: pool,
			    status: 2,
			    imgord: JSON.stringify(imgord)
			},
			success: function(data)
			{
			    if (data == true) 
			    {
				alert('<? echo Translations::gi()->edit_object_success; ?>');
				disable();
			    }
			    else
			    {
				alert('<? echo Translations::gi()->edit_object_error; ?>');
			    }
			},
			error: function(data)
			{
			    console.log(data);
			}
		    });
		}
		$("#needs-validation").addClass("was-validated");
		return false;
	    });
	});
    </script>
</div>
<div class="modal fade" id="correction" tabindex="-1" role="dialog" aria-labelledby="changeLabel" aria-hidden="true">		
    <div class="modal-dialog" role="document">
	<div class="modal-content">
	    <div class="modal-header">
		<h5 class="modal-title" id="changeLabel">Отправить на редактирование</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    <span aria-hidden="true">×</span>
		</button>
	    </div>							
	    <div class="modal-body">
		<div class="container-fluid">
		    <form>
			<div class="row">
			    <div class="form-group col-12 col-sm-12">
				<label for="correction_comment">Комментарий</label>
				<textarea class="form-control" name="correction_comment" id="correction_comment"></textarea>
			    </div>
			    <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<button class="btn btn-primary changestatus" data-id="4">Изменить статус</button>
			    </div>
			</div>
		    </form>
		</div>
	    </div>	
	</div>
    </div>					
</div>
<div class="modal fade" id="appraisers" tabindex="-1" role="dialog" aria-labelledby="changeLabel" aria-hidden="true">		
    <div class="modal-dialog" role="document">
	<div class="modal-content">
	    <div class="modal-header">
		<h5 class="modal-title" id="changeLabel">Отправить объект на оценку</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    <span aria-hidden="true">×</span>
		</button>
	    </div>							
	    <div class="modal-body">
		<div class="container-fluid">
		    <form>
			<div class="row">
			    <div class="form-group col-12 col-sm-12">
				<label for="correction_comment">Выбрать оценщика</label>
				<select class="form-control" id='appraiser_id'>
				<? foreach ($appraisers as $user) { ?>
				    <option value="<? echo $user->id; ?>"><? echo $user->name; ?> <? echo $user->surname; ?></option>
				<? } ?>
				</select>
			    </div>
			    <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<button class="btn btn-primary" id="sendtoappraiser">Отправить на оценку</button>
			    </div>
			</div>
		    </form>
		    <script type="text/javascript">
			$(function(){
			    $("#sendtoappraiser").on('click', function() {
				$.ajax({
				    url: '/remart/send_to_appraiser',
				    method: 'post',
				    dataType: 'json',
				    data: {
					object_id: <? echo $_GET['id']; ?>,
					appraiser_id: $("#appraiser_id").val()
				    },
				    success: function(data) {
					alert('Объект успешно отправлен на оценку');
					$("#appraisers").modal('hide');
				    }
				});
				return false;
			    });
			});
		    </script>
		</div>
	    </div>	
	</div>
    </div>					
</div>
<div class="modal fade" id="favorites" tabindex="-1" role="dialog" aria-labelledby="changeLabel" aria-hidden="true">		
    <div class="modal-dialog" role="document">
	<div class="modal-content">
	    <div class="modal-header">
		<h5 class="modal-title" id="changeLabel">Добавить объект в избранное</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    <span aria-hidden="true">×</span>
		</button>
	    </div>							
	    <div class="modal-body">
		<div class="container-fluid">
		    <form>
			<div class="row">
			    <div class="form-group col-12 col-sm-12">
				<label for="correction_comment">Выбрать покупателя</label>
				<select class="form-control" id='user_id'>
				<? foreach ($buyers as $user) { ?>
				    <option value="<? echo $user->id; ?>"><? echo $user->name; ?> <? echo $user->surname; ?></option>
				<? } ?>
				</select>
			    </div>
			    <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<button class="btn btn-primary" id="sendtofav">Добавить в избранное</button>
			    </div>
			</div>
		    </form>
		    <script type="text/javascript">
			$(function(){
			    $("#sendtofav").on('click', function() {
				$.ajax({
				    url: '/remart/add_to_favorites',
				    method: 'post',
				    dataType: 'json',
				    data: {
					object_id: <? echo $_GET['id']; ?>,
					user_id: $("#user_id").val()
				    },
				    success: function(data) {
					alert('Объект успешно отправлен в избранное пользователю');
					$("#favorites").modal('hide');
				    }
				});
				return false;
			    });
			});
		    </script>
		</div>
	    </div>	
	</div>
    </div>					
</div>