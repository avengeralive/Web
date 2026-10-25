<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKjDgq1wATQHlVPSc7nNQqF8oUMKf9-PM" type="text/javascript"></script>
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h1><? echo Translations::gi()->edit_object; ?></h1>
		</div>
	</div>
	<form id="needs-validation" novalidate>
		<input type="hidden" id="photo" value="<? echo $object->photo; ?>">
		<input type="hidden" id="main_photo" value="<? echo $object->main_photo; ?>">
		<input type="hidden" id="kupche_doc" value="<? echo $object->kupche_doc; ?>">
		<input type="hidden" id="texpass_doc" value="<? echo $object->texpass_doc; ?>">
		<input type="hidden" id="id" value="<? echo $_GET['id']; ?>">
		<input type="hidden" id="lat" name="lat" value="<? echo $object->lat; ?>">
		<input type="hidden" id="lng" name="lng" value="<? echo $object->lng; ?>">
		<div class="row">
			<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<table>
					<tr>
						<td><? echo Translations::gi()->object_type; ?></td>
						<td>
							<select class="form-control" id="type" name="type" required>
								<option value="1" <? if ($object->type == 1) echo 'selected'; ?>><? echo Translations::gi()->apartment; ?></option>
								<option value="2" <? if ($object->type == 2) echo 'selected'; ?>><? echo Translations::gi()->private_home; ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->select_city; ?></td>
						<td>
							<select class="form-control" id="city" name="city" required>
								<? foreach ($cities as $city) { ?>
									<option value="<? echo $city->id; ?>" <? if ($object->city == $city->id) echo 'selected'; ?>><? echo $city->name; ?></option>
								<? } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->select_region; ?></td>
						<td>
							<select class="form-control" id="region" name="region" required>
								<? foreach ($regions as $region) { ?>
									<option value="<? echo $region->id; ?>" <? if ($object->region == $region->id) echo 'selected'; ?>><? echo $region->name; ?></option>
								<? } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->select_metro; ?></td>
						<td>
							<select class="form-control" id="metro" name="metro" required>
								<? foreach ($metros as $metro) { ?>
									<option value="<? echo $metro->id; ?>" <? if ($object->metro == $metro->id) echo 'selected'; ?>><? echo $metro->name; ?></option>
								<? } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->orient; ?></td>
						<td>
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
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->address; ?></td>
						<td>
							<input type="text" class="form-control" name="address" id="address" value="<? echo $object->address; ?>" placeholder="<? echo Translations::gi()->address; ?>" required>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="row">
								<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><p><? echo Translations::gi()->map_desc; ?></p></div>
								<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="map_admin" style="height: 300px;"></div>
								<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><p id="gmap_msg" style="margin: 5px;"></p></div>
							</div>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->price; ?></td>
						<td>
							<input type="text" class="form-control" name="price" id="price" value="<? echo $object->price; ?>" placeholder="Цена" required>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->ap_type; ?></td>
						<td>
							<select class="form-control" id="ap_type" name="ap_type" required>
								<option value="1" <? if ($object->ap_type == 1) echo 'selected'; ?>><? echo Translations::gi()->newh; ?></option>
								<option value="2" <? if ($object->ap_type == 2) echo 'selected'; ?>><? echo Translations::gi()->secondh; ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->project; ?></td>
						<td>
							<select class="form-control" id="project" name="project" required>
								<? foreach ($projects as $project) { ?>
									<option value="<? echo $project->id; ?>" <? if ($object->project == $project->id) echo 'selected'; ?>><? echo $project->name; ?></option>
								<? } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->kupche; ?></td>
						<td>
							<select class="form-control" id="kupche" name="kupche" required>
								<option value="1" <? if ($object->kupche == 2) echo 'selected'; ?>><? echo Translations::gi()->exists; ?></option>
								<option value="0" <? if ($object->kupche == 2) echo 'selected'; ?>><? echo Translations::gi()->no; ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>П<? echo Translations::gi()->pravo; ?></td>
						<td>
							<select class="form-control" id="pravo" name="pravo" required>
								<option value="1" <? if ($object->pravo == 2) echo 'selected'; ?>>В собственности</option>
								<option value="2" <? if ($object->pravo == 2) echo 'selected'; ?>>В пользовании</option>
								<option value="3" <? if ($object->pravo == 2) echo 'selected'; ?>>В аренде</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->gas; ?></td>
						<td>
							<select class="form-control" id="gas" name="gas" required>
								<option value="1" <? if ($object->gas == 2) echo 'selected'; ?>>Есть</option>
								<option value="0" <? if ($object->gas == 2) echo 'selected'; ?>>Нет</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->room; ?></td>
						<td>
							<select class="form-control" id="room" name="room" required>
							<? for ( $i = 1; $i <= 9; $i++ ) { ?>
								<option value="<? echo $i; ?>" <? if ($object->room == $i) echo 'selected'; ?>><? echo $i; ?></option>
							<? } ?>
								<option value="10" <? if ($object->room == 10) echo 'selected'; ?>>10+</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->floors; ?></td>
						<td>
							<select class="form-control" id="floors" name="floors" required>
							<? for ( $i = 1; $i <= 50; $i++ ) { ?>
								<option value="<? echo $i; ?>" <? if ($object->floors == $i) echo 'selected'; ?>><? echo $i; ?></option>
							<? } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->floor; ?></td>
						<td>
							<select class="form-control" id="floor" name="floor" required>
							<? for ( $i = 1; $i <= 50; $i++ ) { ?>
								<option value="<? echo $i; ?>" <? if ($object->floor == $i) echo 'selected'; ?>><? echo $i; ?></option>
							<? } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->square_zeml; ?></td>
						<td>
							<input type="text" class="form-control" name="square_zeml" value="<? echo $object->square_zeml; ?>" id="square_zeml" placeholder="<? echo Translations::gi()->square_zeml; ?>" required>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->square; ?></td>
						<td>
							<input type="text" class="form-control" name="square" id="square" value="<? echo $object->square; ?>" placeholder="<? echo Translations::gi()->square; ?>" required>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->sanuz; ?></td>
						<td>
							<select class="form-control" id="sanuz" name="sanuz" required>
							<? for ( $i = 1; $i <= 9; $i++ ) { ?>
								<option value="<? echo $i; ?>"><? echo $i; ?></option>
							<? } ?>
								<option value="10">10+</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->balkon; ?></td>
						<td>
							<select class="form-control" id="balkon" name="balkon" required>
							<? for ( $i = 0; $i <= 9; $i++ ) { ?>
								<option value="<? echo $i; ?>" <? if ($object->balkon == $i) echo 'selected'; ?>><? echo $i; ?></option>
							<? } ?>
								<option value="10" <? if ($object->balkon == 10) echo 'selected'; ?>>10+</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->remont; ?></td>
						<td>
							<select class="form-control" id="remont" name="remont" required>
								<option value="1" <? if ($object->remont == 1) echo 'selected'; ?>>Без ремонта</option>
								<option value="2" <? if ($object->remont == 2) echo 'selected'; ?>>Средний</option>
								<option value="3" <? if ($object->remont == 3) echo 'selected'; ?>>Отличный</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->phone; ?></td>
						<td>
							<input type="checkbox" id="phone" <? if ($object->phone) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->kabeltv; ?></td>
						<td>
							<input type="checkbox" id="kabeltv" <? if ($object->kabeltv) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->lift; ?></td>
						<td>
							<input type="checkbox" id="lift" <? if ($object->lift) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->garage; ?></td>
						<td>
							<input type="checkbox" id="garage" <? if ($object->garage) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->safe; ?></td>
						<td>
							<input type="checkbox" id="safe" <? if ($object->safe) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->pvcwin; ?></td>
						<td>
							<input type="checkbox" id="pvcwin" <? if ($object->pvcwin) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->waterboil; ?></td>
						<td>
							<input type="checkbox" id="waterboil" <? if ($object->waterboil) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->warm; ?></td>
						<td>
							<input type="checkbox" id="warm" <? if ($object->warm) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->kombi; ?></td>
						<td>
							<input type="checkbox" id="kombi" <? if ($object->kombi) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->pool; ?></td>
						<td>
							<input type="checkbox" id="pool" <? if ($object->pool) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->conditioner; ?></td>
						<td>
							<input type="checkbox" id="conditioner" <? if ($object->conditioner) echo 'checked'; ?>>
						</td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->kitchen; ?></td>
						<td>
							<input type="checkbox" id="kitchen" <? if ($object->kitchen) echo 'checked'; ?>>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<label for="comment"><? echo Translations::gi()->comment; ?></label>
				<textarea class="form-control" name="comment" id="comment" placeholder="<? echo Translations::gi()->comment; ?>" rows="6"><? echo $object->comment; ?></textarea>
			</div>
		</div>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12">
			<div id="object-photo" class="dropzone"></div>
		</div>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images row">
		</div>
		<p><? echo Translations::gi()->kupche; ?></p>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12">
			<div id="object-photo1" class="dropzone"></div>
		</div>	
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images1 row">
		</div>
		<p><? echo Translations::gi()->kupche; ?> (<? echo Translations::gi()->comment; ?>)</p>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12">
			
			<textarea id="kupche_text" class="form-control" ><? echo $object->kupche_text; ?></textarea>
		</div>
		<p><? echo Translations::gi()->texpass; ?></p>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12">
			<div id="object-photo2" class="dropzone"></div>
		</div>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images2 row">
		</div>
		
		<div class="row">
			<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<button class="btn btn-success" id="save"><? echo Translations::gi()->save; ?></button>
				<? if ($item->role_id == 6 || $item->role_id == 2) { ?>
				<button class="btn btn-success" id="savesubmit"><? echo Translations::gi()->save_submit; ?></button>
				<? } ?>
			</div>
		</div>
	</form>
	<script>
		Dropzone.autoDiscover = false;
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
				images = $('#photo').val().split(',');
				$('.images').html('');
				for (i in images) $('.images').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + images[i] + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + images[i] + '"><i class="fa fa-trash"></i></button><button class="btn btn-sm btn-success makemain" data-name="' + images[i] + '"><i class="fa fa-check"></i></button></div>');
			},
			error: function (file, response) {
				file.previewElement.classList.add("dz-error");
			}
		});
		images = $('#photo').val().split(',');
		if ($('#photo').val() != '') {
		for (i in images) $('.images').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + images[i] + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + images[i] + '"><i class="fa fa-trash"></i></button><button class="btn btn-sm btn-success makemain" data-name="' + images[i] + '"><i class="fa fa-check"></i></button></div>'); }
		
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
				images1 = $('#kupche_doc').val().split(',');
				$('.images1').html('');
				for (i in images1) $('.images1').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + images1[i] + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + images1[i] + '"><i class="fa fa-trash"></i></button></div>');
			},
			error: function (file, response) {
				file.previewElement.classList.add("dz-error");
			}
		});
		images1 = $('#kupche_doc').val().split(',');
		if ($('#kupche_doc').val() != '') {
		for (i in images1) $('.images1').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + images1[i] + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + images1[i] + '"><i class="fa fa-trash"></i></button></div>'); }
		
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
				images2 = $('#texpass_doc').val().split(',');
				$('.images2').html('');
				for (i in images2) $('.images2').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + images2[i] + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + images2[i] + '"><i class="fa fa-trash"></i></button></div>');
			},
			error: function (file, response) {
				file.previewElement.classList.add("dz-error");
			}
		});
		images2 = $('#texpass_doc').val().split(',');
		if ($('#texpass_doc').val() != '') {
		for (i in images2) $('.images2').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + images2[i] + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + images2[i] + '"><i class="fa fa-trash"></i></button></div>'); }
		
		
		$(function(){
			if ($("#city").val() != 6)
			{
				$("#region").attr('disabled', true);
				$("#metro").attr('disabled', true);
				$("#dropdownMenuButton").attr('disabled', true);
			}
			$("#city").on('change', function(){
				console.log($("#city").val());
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
			});
			<? foreach ($object->orient as $orient) { ?>
			$("#orient_<? echo $orient; ?>").prop('checked', true);
			<? } ?>
			changeParams = function() {
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
			};
			changeParams2 = function() {
				if ($("#ap_type").val() == 1)
				{
					$('#project').attr('disabled', 'disabled');
				}
				else
				{
					$('#project').attr('disabled', false);
				}
			};
			changeParams();
			changeParams2();
			$("#type").on('change', changeParams);
			$("#ap_type").on('change', changeParams2);
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
			changeParams();
			$("#type").on('change', changeParams);
			
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
					if($("#phone").is(':checked') == true) phone = 1; else phone = 0;
					if($("#kabeltv").is(':checked') == true) kabeltv = 1; else kabeltv = 0;
					if($("#lift").is(':checked') == true) lift = 1; else lift = 0;
					if($("#garage").is(':checked') == true) garage = 1; else garage = 0;
					if($("#safe").is(':checked') == true) safe = 1; else safe = 0;
					if($("#pvcwin").is(':checked') == true) pvcwin = 1; else pvcwin = 0;
					if($("#waterboil").is(':checked') == true) waterboil = 1; else waterboil = 0;
					if($("#warm").is(':checked') == true) warm = 1; else warm = 0;
					if($("#kombi").is(':checked') == true) kombi = 1; else kombi = 0;
					if($("#pool").is(':checked') == true) pool = 1; else pool = 0;
					if($("#conditioner").is(':checked') == true) conditioner = 1; else conditioner = 0;
					if($("#kitchen").is(':checked') == true) kitchen = 1; else kitchen = 0;
					$.ajax({
						url: '/remart/save_object',
						method: 'post',
						dataType: 'json',
						data: {
							id: $('#id').val(), 
							photo: $('#photo').val(), 
							main_photo: $('#main_photo').val(), 
							address: $('#address').val(), 
							kupche_doc: $('#kupche_doc').val(), 
							texpass_doc: $('#texpass_doc').val(), 
							type: $('#type').val(), 
							city: $('#city').val(), 
							region: $('#region').val(),
							metro: $('#metro').val(),
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
							comment: $('#comment').val(),
							lat: $('#lat').val(),
							lng: $('#lng').val(),
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
							pool: pool,
							conditioner: conditioner,
							kitchen: kitchen
						},
						success: function(data)
						{
							if (data == true) 
							{
								alert('Объект успешно изменён!');
								window.location = '/dashboard';
							}
							else
							{
								alert('Ошибка при изменении объекта!');
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
					$.ajax({
						url: '/remart/save_object',
						method: 'post',
						dataType: 'json',
						data: {
							id: $('#id').val(), 
							photo: $('#photo').val(), 
							address: $('#address').val(), 
							kupche_doc: $('#kupche_doc').val(), 
							texpass_doc: $('#texpass_doc').val(), 
							type: $('#type').val(), 
							city: $('#city').val(), 
							region: $('#region').val(),
							metro: $('#metro').val(),
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
							comment: $('#comment').val(),
							lat: $('#lat').val(),
							lng: $('#lng').val(),
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
							status: 6
						},
						success: function(data)
						{
							if (data == true) 
							{
								alert('<? echo Translations::gi()->edit_object_success; ?>');
								window.location = '/dashboard';
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
</div>
<style>
.form-control { width: 100%; }
table { width: 100%; }
.images { margin-top: 50px; margin-bottom: 50px;}
</style>