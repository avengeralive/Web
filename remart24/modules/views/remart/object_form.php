<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKjDgq1wATQHlVPSc7nNQqF8oUMKf9-PM" type="text/javascript"></script>
<form id="needs-validation" novalidate>
    <input type="hidden" id="photo">
    <input type="hidden" id="main_photo">
    <input type="hidden" id="kupche_doc">
    <input type="hidden" id="texpass_doc">
    <input type="hidden" id="lat" name="lat" value="">
    <input type="hidden" id="lng" name="lng" value="">
    <div class="row">
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="type"><? echo Translations::gi()->object_type; ?></label>
	    <select class="form-control" id="type" name="type" required>
		<option value="1"><? echo Translations::gi()->apartment; ?></option>
		<option value="2"><? echo Translations::gi()->private_home; ?></option>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="city"><? echo Translations::gi()->select_city; ?></label>
	    <select class="form-control" id="city" name="city" required>
	    <? foreach ($cities as $city) { ?>
		<option value="<? echo $city->id; ?>"><? echo $city->name; ?></option>
	    <? } ?>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="region"><? echo Translations::gi()->select_region; ?></label>
	    <select class="form-control" id="region" name="region" required>
	    	<option value="0" selected><? echo Translations::gi()->select_region; ?></option>
	    <? foreach ($regions as $region) { ?>
		<option value="<? echo $region->id; ?>"><? echo $region->name; ?></option>
	    <? } ?>
	    </select>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="metro"><? echo Translations::gi()->select_metro; ?></label>
	    <select class="form-control" id="metro" name="metro" required>
	    	<option value="0"><? echo Translations::gi()->select_metro; ?></option>
	    <? foreach ($metros as $metro) { ?>
		<option value="<? echo $metro->id; ?>"><? echo $metro->name; ?></option>
	    <? } ?>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="orient"><? echo Translations::gi()->orient; ?></label>
	    <div class="dropdown">
		<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->orient; ?></button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 700px; padding: 30px;">
		    <div class="row">
		    <? foreach ($orients as $orient) { ?>
			<div class="col-3"><label><input type="checkbox" name="orient[]" id="orient_<? echo $orient->id; ?>"> <? echo $orient->name; ?></label></div>
		    <? } ?>	
		    </div>
		</div>
	    </div>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="address"><? echo Translations::gi()->address; ?></label>
	    <input type="text" class="form-control" name="address" id="address" placeholder="<? echo Translations::gi()->address; ?>" required>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="price"><? echo Translations::gi()->price; ?></label>
	    <input type="text" class="form-control" name="price" id="price" placeholder="<? echo Translations::gi()->price; ?>" required>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="ap_type"><? echo Translations::gi()->ap_type; ?></label>
	    <select class="form-control" id="ap_type" name="ap_type" required>
	    	<option value="0"><? echo Translations::gi()->ap_type; ?></option>
		<option value="1"><? echo Translations::gi()->newh; ?></option>
		<option value="2"><? echo Translations::gi()->secondh; ?></option>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="project"><? echo Translations::gi()->project; ?></label>
	    <select class="form-control" id="project" name="project" required>
	    	<option value="0"><? echo Translations::gi()->project; ?></option>
	    <? foreach ($projects as $project) { 
	    $pro = 'pro_'.$project->id;
	    ?>
		<option value="<? echo $project->id; ?>"><? echo Translations::gi()->$pro; /*$project->name;*/ ?></option>
	    <? } ?>
	    </select>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="kupche"><? echo Translations::gi()->kupche; ?></label>
	    <select class="form-control" id="kupche" name="kupche" required>
		<option value="1"><? echo Translations::gi()->exists; ?></option>
		<option value="0"><? echo Translations::gi()->no; ?></option>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="pravo"><? echo Translations::gi()->pravo; ?></label>
	    <select class="form-control" id="pravo" name="pravo" required>
		<option value="1">В собственности</option>
		<option value="2">В пользовании</option>
		<option value="3">В аренде</option>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="gas"><? echo Translations::gi()->gas; ?></label>
	    <select class="form-control" id="gas" name="gas" required>
		<option value="1"><? echo Translations::gi()->exists; ?></option>
		<option value="0"><? echo Translations::gi()->no; ?></option>
	    </select>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="room"><? echo Translations::gi()->room; ?></label>
	    <select class="form-control" id="room" name="room" required>
	    <? for ( $i = 1; $i <= 9; $i++ ) { ?>
		<option value="<? echo $i; ?>"><? echo $i; ?></option>
	    <? } ?>
		<option value="10">10+</option>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="floors"><? echo Translations::gi()->floors; ?></label>
	    <select class="form-control" id="floors" name="floors" required>
	    <? for ( $i = 1; $i <= 50; $i++ ) { ?>
		<option value="<? echo $i; ?>"><? echo $i; ?></option>
	    <? } ?>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="floor"><? echo Translations::gi()->floor; ?></label>
	    <select class="form-control" id="floor" name="floor" required>
	    <? for ( $i = 1; $i <= 50; $i++ ) { ?>
		<option value="<? echo $i; ?>"><? echo $i; ?></option>
	    <? } ?>
	    </select>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="square_zeml"><? echo Translations::gi()->square_zeml; ?></label>
	    <input type="text" class="form-control" name="square_zeml" id="square_zeml" placeholder="<? echo Translations::gi()->square_zeml; ?>" required>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="square"><? echo Translations::gi()->square; ?></label>
	    <input type="text" class="form-control" name="square" id="square" placeholder="<? echo Translations::gi()->square; ?>" required>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="sanuz"><? echo Translations::gi()->sanuz; ?></label>
	    <select class="form-control" id="sanuz" name="sanuz" required>
	    <? for ( $i = 1; $i <= 9; $i++ ) { ?>
		<option value="<? echo $i; ?>"><? echo $i; ?></option>
	    <? } ?>
		<option value="10">10+</option>
	    </select>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="balkon"><? echo Translations::gi()->balkon; ?></label>
	    <select class="form-control" id="balkon" name="balkon" required>
	    <? for ( $i = 0; $i <= 9; $i++ ) { ?>
		<option value="<? echo $i; ?>"><? echo $i; ?></option>
	    <? } ?>
		<option value="10">10+</option>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="remont"><? echo Translations::gi()->remont; ?></label>
	    <select class="form-control" id="remont" name="remont" required>
		<option value="1">Без ремонта</option>
		<option value="2">Средний</option>
		<option value="3">Отличный</option>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-3 row">
	    <div class="col-md-6"><? echo Translations::gi()->phone; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="phone">
	    </div>
	    <div class="col-md-6"><? echo Translations::gi()->kabeltv; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="kabeltv">
	    </div>
	    <div class="col-md-6"><? echo Translations::gi()->lift; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="lift">
	    </div>
	</div>
	<div class="form-group col-md-3 row">
	    <div class="col-md-6"><? echo Translations::gi()->garage; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="garage">
	    </div>
	    <div class="col-md-6"><? echo Translations::gi()->safe; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="safe">
	    </div>
	    <div class="col-md-6"><? echo Translations::gi()->pvcwin; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="pvcwin">
	    </div>
	</div>
	<div class="form-group col-md-3 row">
	    <div class="col-md-6"><? echo Translations::gi()->waterboil; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="waterboil">
	    </div>
	    <div class="col-md-6"><? echo Translations::gi()->warm; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="warm">
	    </div>
	    <div class="col-md-6"><? echo Translations::gi()->kombi; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="kombi">
	    </div>
	</div>
	<div class="form-group col-md-3 row">
	    <div class="col-md-6"><? echo Translations::gi()->pool; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="pool">
	    </div>
	    <div class="col-md-6"><? echo Translations::gi()->conditioner; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="conditioner">
	    </div>
	    <div class="col-md-6"><? echo Translations::gi()->kitchen; ?></div>
	    <div class="col-md-6">
		<input type="checkbox" id="kitchen">
	    </div>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-8 row">
	    <label for="comment"><? echo Translations::gi()->comment; ?></label>
	    <textarea class="form-control" name="comment" id="comment" placeholder="<? echo Translations::gi()->comment; ?>" rows="6"></textarea>
	</div>
	<div class="form-group col-md-4 row">
	    <label>Фотографии объекта</label>
	    <div id="object-photo" class="dropzone"></div>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-4 row">
	    <label for="kupche_text"><? echo Translations::gi()->kupche; ?> (<? echo Translations::gi()->comment; ?>)</label>
	    <textarea id="kupche_text" class="form-control" ></textarea>
	</div>
	<div class="form-group col-md-4 row">
	    <label><? echo Translations::gi()->kupche; ?></label>
	    <div id="object-photo1" class="dropzone"></div>
	</div>
	<div class="form-group col-md-4 row">
	    <label><? echo Translations::gi()->texpass; ?></label>
	    <div id="object-photo2" class="dropzone"></div>
	</div>
    </div>
    <div class="row">
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12"><p>Фотографии объекта</p></div>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images row"></div>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12"><p><? echo Translations::gi()->kupche; ?></p></div>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images1 row"></div>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12"><p><? echo Translations::gi()->texpass; ?></p></div>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images2 row"></div>
    </div>
    <div class="row">
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><p><? echo Translations::gi()->map_desc; ?></p></div>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="map_admin" style="height: 300px;"></div>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><p id="gmap_msg" style="margin: 5px;"></p></div>
    </div>
</form>
<script>
    Dropzone.autoDiscover = false;
    //Object photo
    jQuery("#object-photo").dropzone({
	url: '/materials/temp/dropzone.php?session_id=<?php echo session_id(); ?>',
	acceptedFiles: 'image/*',
	timeout: 1000000,
	method: "post",
	success: function (file, response) {
	    file.previewElement.classList.add("dz-success");
	    name = response;
	    if ($("#photo").val() == '') $("#photo").val(name);
	    else $("#photo").val($("#photo").val() + ',' + name);
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
		}
	    });
	},
	error: function (file, response) {
	    file.previewElement.classList.add("dz-error");
	}
    });
    //Kupchaya
    jQuery("#object-photo1").dropzone({
	url: '/materials/temp/dropzone.php?session_id=<?php echo session_id(); ?>',
	acceptedFiles: 'image/*',
	timeout: 1000000,
	method: "post",
	success: function (file, response) {
	    file.previewElement.classList.add("dz-success");
	    name = response;
	    if ($("#kupche_doc").val() == '') $("#kupche_doc").val(name);
	    else $("#kupche_doc").val($("#kupche_doc").val() + ',' + name);
	    $.ajax({
		url: '/remart/getImages?ids=' + $('#kupche_doc').val(),
		method: 'get',
		dataType: 'json',
		success: function(data) {			   
		    $('.images1').html('');
		    for (i in data) $('.images1').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + data[i].material_path + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + data[i].id + '"><i class="fa fa-trash"></i></button> <input type="text" class="photo_ordering form-control" data-id="' + data[i].id + '" value="' + data[i].ordering + '"></div>');
		}
	    });
	},
	error: function (file, response) {
	    file.previewElement.classList.add("dz-error");
	}
    });
    //Texpassport
    jQuery("#object-photo2").dropzone({
	url: '/materials/temp/dropzone.php?session_id=<?php echo session_id(); ?>',
	acceptedFiles: 'image/*',
	timeout: 1000000,
	method: "post",
	success: function (file, response) {
	    file.previewElement.classList.add("dz-success");
	    name = response;
	    if ($("#texpass_doc").val() == '') $("#texpass_doc").val(name);
	    else $("#texpass_doc").val($("#texpass_doc").val() + ',' + name);
	    $.ajax({
		url: '/remart/getImages?ids=' + $('#texpass_doc').val(),
		method: 'get',
		dataType: 'json',
		success: function(data) {			   
		    $('.images2').html('');
		    for (i in data) $('.images2').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + data[i].material_path + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + data[i].id + '"><i class="fa fa-trash"></i></button> <input type="text" class="photo_ordering form-control" data-id="' + data[i].id + '" value="' + data[i].ordering + '"></div>');
		}
	    });
	},
	error: function (file, response) {
	    file.previewElement.classList.add("dz-error");
	}
    });
    function form_init()
    {
	if ($("#city").val() != 6)
	{
	    $("#region").attr('disabled', true);
	    $("#metro").attr('disabled', true);
	    $("#dropdownMenuButton").attr('disabled', true);
	}
    }
    function changeParams()
    {
	if ($("#type").val() == 1)
	{
	    $('#pravo').attr('disabled', 'disabled');
	    $('#square_zeml').attr('disabled', 'disabled');
	    $('#ap_type').attr('disabled', false);
	    $('#floor').attr('disabled',false);
	}
	else
	{
	    $('#pravo').attr('disabled', false);
	    $('#square_zeml').attr('disabled', false);
	    $('#ap_type').attr('disabled', 'disabled');
	    $('#floor').attr('disabled', 'disabled');
	}
    }
    function changeParams2() {
	if ($("#ap_type").val() == 1 || $("#ap_type").val() == 0)
	{
	    $('#project').attr('disabled', 'disabled');
	}
	else
	{
	    $('#project').attr('disabled', false);
	}
    };
    function changeParams3() {
	if ($("#city").val() != 6)
	{
	    $("#region").attr('disabled', true);
	    $("#metro").attr('disabled', true);
	    $("#dropdownMenuButton").attr('disabled', true);
	}
	else
	{
	    $("#region").attr('disabled', false);
	    $("#metro").attr('disabled', false);
	    $("#dropdownMenuButton").attr('disabled', false);
	}
    };
    $(function(){
	$("#city").val(6);
	form_init();
	changeParams();
	changeParams2();
	$("#type").on('change', changeParams);
	$("#ap_type").on('change', changeParams2);
	$("#city").on('change', changeParams3);
	
	$(document).on('click', '.makemain', function(){
	    $("#main_photo").val($(this).attr('data-name'));
	    $(".makemain").html('<i class="fa fa-check"></i>');
	    $(this).html('<i class="fa fa-close"></i>');
	    return false;
	});
	$(document).on('click', '.delete', function(){
	    images = $('#photo').val().split(',');
	    photo = '';
	    for (i in images) if (images[i] != $(this).attr('data-name')) 
	    {
		if (photo == '') photo = images[i];
		else photo += ','+images[i];
	    }
	    $('#photo').val(photo);
	    images = $('#kupche_doc').val().split(',');
	    photo = '';
	    for (i in images) if (images[i] != $(this).attr('data-name')) 
	    {
		if (photo == '') photo = images[i];
		else photo += ','+images[i];
	    }
	    $('#kupche_doc').val(photo);
	    images = $('#texpass_doc').val().split(',');
	    photo = '';
	    for (i in images) if (images[i] != $(this).attr('data-name')) 
	    {
		if (photo == '') photo = images[i];
		else photo += ','+images[i];
	    }
	    $('#texpass_doc').val(photo);
	    $(this).parent().remove();
	});
    });
</script>