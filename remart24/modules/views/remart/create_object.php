<div class="row">
    <div class="container">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style='padding: 15px 0px 0px 0px;'>
	    <h1><? echo Translations::gi()->create_object; ?></h1>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <button class="btn btn-success save" type="submit"><? echo Translations::gi()->save; ?></button>
	    <button class="btn btn-success savesubmit" type="submit"><? echo Translations::gi()->save_submit; ?></button>
	    <a href="/dashboard" class="btn btn-danger"><? echo Translations::gi()->close; ?></a>
	</div>
    </div>
</div>
<div class="row formbody">
    <div class="container">
    <? include('object_form.php'); ?>
    </div>
    <script>
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
	    initialize_map();
	});
	$(function(){
	    $(".save").on('click', function(event){
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
			imgord[$(value).attr('data-id')] = $(value).val();
		    });
		    $.ajax({
			url: '/remart/save_object',
			method: 'post',
			dataType: 'json',
			data: {
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
				alert('<? echo Translations::gi()->object_create_success; ?>');
				window.location = '/dashboard';
			    }
			    else
			    {
				alert('<? echo Translations::gi()->object_create_error; ?>');
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
	    $(".savesubmit").on('click', function(event){
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
			imgord[$(value).attr('data-id')] = $(value).val();
		    });
		    $.ajax({
			url: '/remart/save_object',
			method: 'post',
			dataType: 'json',
			data: {
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
			    imgord: JSON.stringify(imgord),
			    status: 2
			},
			success: function(data)
			{
			    if (data == true) 
			    {
				alert('Объект успешно создан!');
				window.location = '/dashboard';
			    }
			    else
			    {
				alert('Ошибка при создании объекта!');
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
<div class="row">
    <div class="container" style="margin-top: 30px;">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <button class="btn btn-success save" type="submit"><? echo Translations::gi()->save; ?></button>
	    <button class="btn btn-success savesubmit" type="submit"><? echo Translations::gi()->save_submit; ?></button>
	</div>
    </div>
</div>