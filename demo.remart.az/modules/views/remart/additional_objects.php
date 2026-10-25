<style><? if ($item->role_id != 6) { ?> .corcom { display: none; }<? } ?></style>
<h2 class="tab-title"><? echo Translations::gi()->objects; ?></h2>
<? if ($item->role_id == 2 || $item->role_id == 6) { ?>
<a href="/create_object" class="btn btn-sm btn-success" title="<? echo Translations::gi()->create_object; ?>"><i class="fa fa-plus"></i></a>
<? } ?>
<div class="row">
	<div class="col-12 row" style="margin-bottom: 50px;">
		<div class="col-12 col-md-4 row">
			<label><? echo Translations::gi()->status; ?></label>
			<select id="sort" class="form-control">
				<option value="0"><? echo Translations::gi()->all; ?></option>
				<option value="1">Created</option>
				<option value="2">Pending</option>
				<option value="3">Rejected</option>
				<option value="4">Pending correction</option>
				<option value="5">Pending valuation</option>
				<option value="6">Pending approval</option>
				<option value="7">Approved</option>
				<option value="8">Sold</option>
			</select>
		</div>
		<div class="col-12 col-md-4 row">
			<label>Valuation Status<? echo Translations::gi()->valued; ?></label>
			<select id="valued" class="form-control">
				<option value="0"><? echo Translations::gi()->all; ?></option>
				<option value="1">Valued</option>
				<option value="2">Not Valued</option>
			</select>
		</div>
		<div class="col-12 col-md-4 row">
			<label><? echo Translations::gi()->city; ?></label>
			<select id="sort2" class="form-control">
				<option value="0"><? echo Translations::gi()->all; ?></option>
				<? foreach ($cities as $city) { ?>
				<option value="<? echo $city->id; ?>"><? echo $city->name; ?></option>
				<? } ?>
			</select>
		</div>
		<div class="col-12 col-md-4 row">
			<label><? echo Translations::gi()->region; ?></label>
			<select id="sort3" class="form-control">
				<option value="0"><? echo Translations::gi()->all; ?></option>
				<? foreach ($regions as $region) { ?>
				<option value="<? echo $region->id; ?>"><? echo $region->name; ?></option>
				<? } ?>
			</select>
		</div>
		<div class="col-12 col-sm-4">
			<? if ($item->role_id == 2 || $item->role_id == 3) { ?>
			<label><? echo Translations::gi()->realtor; ?></label>
			<select class="form-control" id="realtor" name="realtor" required>
				<option value="0"><? echo Translations::gi()->realtor; ?></option>
				<? foreach ($rieltors as $rieltor) { ?>
				<option value="<? echo $rieltor->id; ?>"><? echo $rieltor->name; ?> <? echo $rieltor->surname; ?> <? echo $rieltor->patronymic; ?></option>
				<? } ?>	
			</select>
			<? } ?>					
		</div>
		<div class="col-12 col-md-6 row">
			<input type="text" id="address" class="form-control" placeholder="<? echo Translations::gi()->address; ?>">
		</div>
		<div class="col-12 col-md-6 row">
			<button class="btn btn-primary" id="search"><? echo Translations::gi()->address_search; ?></button>
		</div>
	</div>
	<table class="table table-sm" id="objects">
		<tr>
			<th>ID</th>
			<th><? echo Translations::gi()->status; ?></th>
			<th><? echo Translations::gi()->realtor; ?></th>
			<th><? echo Translations::gi()->city; ?></th>
			<th><? echo Translations::gi()->address; ?></th>
			<th><? echo Translations::gi()->object_tyle; ?></th>
			<th><? echo Translations::gi()->valued; ?></th>
			<th class="corcom"><? echo Translations::gi()->comment; ?></th>
			<th></th>
			<th></th>
			<!--<th></th>-->
			<th></th>
		</tr>
	</table>
</div>
<script type="text/javascript">
$(function(){
	$(document).on('click', '.create', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
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
						alert('<? echo Translations::gi()->create_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->create_error; ?>');
					}
				}
			});
		}
	});
	$(document).on('click', '.pending', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
			$.ajax({
				url: '/remart/make_pending',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('<? echo Translations::gi()->pending_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->pending_error; ?>');
					}
				}
			});
		}
	});
	$(document).on('click', '.reject', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
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
						alert('<? echo Translations::gi()->return_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->return_error; ?>');
					}
				}
			});
		}
	});
	$(document).on('click', '.correct', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
			$.ajax({
				url: '/remart/make_correct',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('<? echo Translations::gi()->correct_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->correct_error; ?>');
					}
				}
			});
		}
	});
	$(document).on('click', '.valuate', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
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
						alert('<? echo Translations::gi()->valuation_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->valuation_error; ?>');
					}
				}
			});
		}
	});
	$(document).on('click', '.approval', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
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
						alert('<? echo Translations::gi()->pending_valuation_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->pending_valuation_error; ?>');
					}
				}
			});
		}
	});
	$(document).on('click', '.approve', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
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
						alert('<? echo Translations::gi()->valuated_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->valuated_error; ?>');
					}
				}
			});
		}
	});
	$(document).on('click', '.sold', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
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
						alert('<? echo Translations::gi()->sold_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->sold_error; ?>');
					}
				}
			});
		}
	});
	
	$("#sort").on('change', function(){
		var c1, c2, c3, c4, c5;
		if ($("#sort").val() == 0) c1 = 'object';
		else c1 = 'obj_' + $("#sort").val();
		if ($("#sort2").val() == 0) c2 = 'object';
		else c2 = 'cit_' + $("#sort2").val();
		if ($("#sort3").val() == 0) c3 = 'object';
		else c3 = 'reg_' + $("#sort3").val();
		if ($("#valued").val() == 0) c4 = 'object';
		else if ($("#valued").val() == 1) c4 = 'valued';
		else c4 = 'notvalued';
		if ($("#realtor").val() == 0) c5 = 'object';
		else c5 = 'real_' + $("#realtor").val();
		$('.object').hide();
		$('.object').each(function(index, value){
			if ($(value).hasClass(c1) && $(value).hasClass(c2) && $(value).hasClass(c3) && $(value).hasClass(c4) && $(value).hasClass(c5)) $(value).show();
		});
	});
	
	$("#sort2").on('change', function(){
		var c1, c2, c3, c4, c5;
		if ($("#sort").val() == 0) c1 = 'object';
		else c1 = 'obj_' + $("#sort").val();
		if ($("#sort2").val() == 0) c2 = 'object';
		else c2 = 'cit_' + $("#sort2").val();
		if ($("#sort3").val() == 0) c3 = 'object';
		else c3 = 'reg_' + $("#sort3").val();
		if ($("#valued").val() == 0) c4 = 'object';
		else if ($("#valued").val() == 1) c4 = 'valued';
		else c4 = 'notvalued';
		if ($("#realtor").val() == 0) c5 = 'object';
		else c5 = 'real_' + $("#realtor").val();
		$('.object').hide();
		$('.object').each(function(index, value){
			if ($(value).hasClass(c1) && $(value).hasClass(c2) && $(value).hasClass(c3) && $(value).hasClass(c4) && $(value).hasClass(c5)) $(value).show();
		});
	});
	
	$("#sort3").on('change', function(){
		var c1, c2, c3, c4, c5;
		if ($("#sort").val() == 0) c1 = 'object';
		else c1 = 'obj_' + $("#sort").val();
		if ($("#sort2").val() == 0) c2 = 'object';
		else c2 = 'cit_' + $("#sort2").val();
		if ($("#sort3").val() == 0) c3 = 'object';
		else c3 = 'reg_' + $("#sort3").val();
		if ($("#valued").val() == 0) c4 = 'object';
		else if ($("#valued").val() == 1) c4 = 'valued';
		else c4 = 'notvalued';
		if ($("#realtor").val() == 0) c5 = 'object';
		else c5 = 'real_' + $("#realtor").val();
		$('.object').hide();
		$('.object').each(function(index, value){
			if ($(value).hasClass(c1) && $(value).hasClass(c2) && $(value).hasClass(c3) && $(value).hasClass(c4) && $(value).hasClass(c5)) $(value).show();
		});
	});
	
	$("#valued").on('change', function(){
		var c1, c2, c3, c4, c5;
		if ($("#sort").val() == 0) c1 = 'object';
		else c1 = 'obj_' + $("#sort").val();
		if ($("#sort2").val() == 0) c2 = 'object';
		else c2 = 'cit_' + $("#sort2").val();
		if ($("#sort3").val() == 0) c3 = 'object';
		else c3 = 'reg_' + $("#sort3").val();
		if ($("#valued").val() == 0) c4 = 'object';
		else if ($("#valued").val() == 1) c4 = 'valued';
		else c4 = 'notvalued';
		if ($("#realtor").val() == 0) c5 = 'object';
		else c5 = 'real_' + $("#realtor").val();
		$('.object').hide();
		$('.object').each(function(index, value){
			if ($(value).hasClass(c1) && $(value).hasClass(c2) && $(value).hasClass(c3) && $(value).hasClass(c4) && $(value).hasClass(c5)) $(value).show();
		});
	});
	
	$("#realtor").on('change', function(){
		var c1, c2, c3, c4, c5;
		if ($("#sort").val() == 0) c1 = 'object';
		else c1 = 'obj_' + $("#sort").val();
		if ($("#sort2").val() == 0) c2 = 'object';
		else c2 = 'cit_' + $("#sort2").val();
		if ($("#sort3").val() == 0) c3 = 'object';
		else c3 = 'reg_' + $("#sort3").val();
		if ($("#valued").val() == 0) c4 = 'object';
		else if ($("#valued").val() == 1) c4 = 'valued';
		else c4 = 'notvalued';
		if ($("#realtor").val() == 0) c5 = 'object';
		else c5 = 'real_' + $("#realtor").val();
		$('.object').hide();
		$('.object').each(function(index, value){
			if ($(value).hasClass(c1) && $(value).hasClass(c2) && $(value).hasClass(c3) && $(value).hasClass(c4) && $(value).hasClass(c5)) $(value).show();
		});
	});
});
</script>
<? if ($item->role_id == 2) { ?>
<script type="text/javascript">
$(function(){
	$.ajax({
		url: '/remart/get_objects',
		method: 'get',
		dataType: 'json',
		success: function(data) { console.log(data);
			for (i in data)
			{
				if (data[i].rinok == '') is_valued = 'Not valued', iv = 'notvalued';
				else is_valued = 'Valued', iv = 'valued';
				$("#objects").append('<tr class="object obj_' + data[i].status + ' cit_' + data[i].city_id + ' reg_' + data[i].region + ' ' + iv + ' real_' + data[i].realtor_id + '"><td>' + data[i].id + '</td><td>' + data[i].status_name + '</td><td>' + data[i].realtor + '</td><td>' + data[i].city + '</td><td>' + data[i].address + '</td><td>' + data[i].type + '</td><td>' + is_valued + '</td><td class="corcom">' + data[i].correction_comment + '</td><td><a class="btn btn-sm btn-primary" target="_blank" href="/view?id=' + data[i].id + '" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-link"></i></a>  <button class="viewobject btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" target="_blank" href="/edit_object?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><!--<td><button class="create btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="Created"><i class="fa fa-sticky-note-o"></i></button> <button class="pending btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Pending"><i class="fa fa-briefcase"></i></button> <button class="reject btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="Rejected"><i class="fa fa-close"></i></button> <button class="correct btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Pending correction"><i class="fa fa-edit"></i></button> <button class="valuate btn btn-sm btn-info" data-id="' + data[i].id + '" type="button" title="Pending valuate"><i class="fa fa-star-o"></i></button> <button class="approval btn btn-sm btn-dark" data-id="' + data[i].id + '" type="button" title="Pending approve"><i class="fa fa-stop"></i></button> <button class="approve btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="Approved"><i class="fa fa-check"></i></button> <button class="sold btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="Sold"><i class="fa fa-dollar"></i></button></td>--><td><button class="valuates btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Valuates"><i class="fa fa-dollar"></i></button><button class="sendtoaprize btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Отправить на оценку"><i class="fa fa-user"></i></button></td></tr>');
			}
		}
	});
	$("#search").on('click', function(){
		$.ajax({
			url: '/remart/get_objects',
			method: 'get',
			dataType: 'json',
			data: {
				address: $("#address").val()
			},
			success: function(data) {
				$("#objects").html('');
				for (i in data)
				{
					if (data[i].rinok == '') is_valued = 'Not valued', iv = 'notvalued';
					else is_valued = 'Valued', iv = 'valued';
					$("#objects").append('<tr class="object obj_' + data[i].status + ' cit_' + data[i].city_id + ' reg_' + data[i].region + ' ' + iv + ' real_' + data[i].realtor_id + '"><td>' + data[i].id + '</td><td>' + data[i].status_name + '</td><td>' + data[i].realtor + '</td><td>' + data[i].city + '</td><td>' + data[i].address + '</td><td>' + data[i].type + '</td><td>' + is_valued + '</td><td class="corcom">' + data[i].correction_comment + '</td><td><a class="btn btn-sm btn-primary" target="_blank" href="/view?id=' + data[i].id + '" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-link"></i></a>  <button class="viewobject btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" target="_blank" href="/edit_object?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><!--<td><button class="create btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="Created"><i class="fa fa-sticky-note-o"></i></button> <button class="pending btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Pending"><i class="fa fa-briefcase"></i></button> <button class="reject btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="Rejected"><i class="fa fa-close"></i></button> <button class="correct btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Pending correction"><i class="fa fa-edit"></i></button> <button class="valuate btn btn-sm btn-info" data-id="' + data[i].id + '" type="button" title="Pending valuate"><i class="fa fa-star-o"></i></button> <button class="approval btn btn-sm btn-dark" data-id="' + data[i].id + '" type="button" title="Pending approve"><i class="fa fa-stop"></i></button> <button class="approve btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="Approved"><i class="fa fa-check"></i></button> <button class="sold btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="Sold"><i class="fa fa-dollar"></i></button></td>--><td><button class="valuates btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Valuates"><i class="fa fa-dollar"></i></button></td><button class="sendtoaprize btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Отправить на оценку"><i class="fa fa-user"></i></button></tr>');
				}
			}
		});
	});
});
</script>
<script type="text/javascript">
$(function(){
	$(document).on('click', '.valuates', function(){
		ID = $(this).attr('data-id');
		$.ajax({
			url: '/remart/get_valuates',
			method: 'post',
			dataType: 'json',
			data: {
				id: ID
			},
			success: function(data) {
				$('#app_vals').html('');
				for (i in data)
				{
					$('#app_vals').append('<tr><td>' + data[i].id + '</td><td>' + data[i].email + '</td><td>' + data[i].status + '</td><td>' + data[i].rinok + '</td><td>' + data[i].liquid + '</td><td>' + data[i].comment + '</td><td><button type="button" class="btn btn-warning prevaluate" data-id="' + data[i].id + '" title="Pre-valued"><i class="fa fa-shield"></i></button> <button type="button" class="btn btn-success approvevalue" data-id="' + data[i].id + '" title="Approved"><i class="fa fa-check"></i></button> <button type="button" class="btn btn-success approvefinalvalued" data-id="' + data[i].id + '" title="Valued"><i class="fa fa-shield"></i></button> <button type="button" class="btn btn-danger declinevalue" data-id="' + data[i].id + '" title="Decline"><i class="fa fa-close"></i></button></td></tr>');
				}
				$('#valuates').modal('show');
			}
		});
	});
	
	$(document).on('click', '.sendtoaprize', function(){
		ID = $(this).attr('data-id');
		$("#sendtoaprize_id").val(ID);
		$('#sendtoaprize').modal('show');
	});
	
	$(document).on('click', '#send_invite', function(){
		$.ajax({
			url: '/remart/send_invite',
			method: 'post',
			dataType: 'json',
			data: {
				object_id: $("#sendtoaprize_id").val(),
				user_id: $("#sendtoaprize_user").val()
			},
			success: function(data) {
				alert('Объект отправлен на оценку');
				$('#sendtoaprize').modal('hide');
			}
		});
		return false;
	});
	
	$(document).on('click', '.prevaluate', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
			$.ajax({
				url: '/remart/pending_value',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('<? echo Translations::gi()->prevalued_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->prevalued_error; ?>');
					}
				}
			});
		}
	});
	
	$(document).on('click', '.approvevalue', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
			$.ajax({
				url: '/remart/approve_value',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('<? echo Translations::gi()->valued_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->valued_error; ?>');
					}
				}
			});
		}
	});
	
	$(document).on('click', '.approvefinalvalued', function(){
		ID = $(this).attr('data-id');
		$('#actid').val(ID);
		$('#valuated').modal('show');
	});
	
	$(document).on('click', '.declinevalue', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
			$.ajax({
				url: '/remart/decline_value',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('<? echo Translations::gi()->valued_reject_success; ?>');
						window.location = '/dashboard';
					}
					else
					{
						alert('<? echo Translations::gi()->valued_reject_error; ?>');
					}
				}
			});
		}
	});
});
</script>
<div class="modal fade" id="valuates" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewLabel">Просмотр оценок недвижимости</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table" id="app_vals">
					<tr>
						<th>ID</th>
						<th>Email</th>
						<th><? echo Translations::gi()->status; ?></th>
						<th>Market</th>
						<th>Liquid</th>
						<th>Comment</th>
						<th></th>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><? echo Translations::gi()->close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="sendtoaprize" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Отправить на оценку</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<input type="hidden" id="sendtoaprize_id">
					<select id="sendtoaprize_user" class="form-control">
						<?
							foreach ($apprizers as $apprizer)
							{
						?>
						<option value="<? echo $apprizer->id; ?>"><? echo $apprizer->name; ?> <? echo $apprizer->surname; ?> <? echo $apprizer->patronymic; ?></option>
						<?
							}
						?>
					</select>
					<button type="submit" class="btn btn-success" id="send_invite">Отправить</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><? echo Translations::gi()->close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="valuated" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewLabel">Акт о проверке</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="needs-validation3" novalidate>
					<input type="hidden" id="act">
					<input type="hidden" id="actid">
					<div class="row">
						<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<label for="user">Пользователь</label>
							<select class="form-control" id="user" name="user">
								<? foreach ($buyers as $user) { ?>
								<option value="<? echo $user->id; ?>"><? echo $user->id; ?>. <? echo $user->email; ?>: <? echo $user->surname; ?> <? echo $user->name; ?> <? echo $user->patronymic; ?></option>
								<? } ?>
							</select>
						</div>
					</div>
					<p>Акт оценки:</p>
					<div class="col col-12 col-sm-12 col-md-12 col-lg-12">
						<div id="object-photo" class="dropzone"></div>
					</div>
					<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images row">
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<button class="btn btn-success" type="submit" id="saveact"><? echo Translations::gi()->save; ?></button>
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
				$("#act").val(name);
				$('.images').html('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + name + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button></div>');
			},
			error: function (file, response) {
				file.previewElement.classList.add("dz-error");
			}
		});
		$(function(){
			images = $('#act').val();
			if (images != '')
			{
				$('.images').html('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + images + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button></div>');
			}
			$(document).on('click', '.delete', function(){
				$(this).parent().remove();
				$("#act").val('');
			});
			$("#needs-validation3").on('submit', function(event){
				if ($("#needs-validation3")[0].checkValidity() == false) {
					event.preventDefault();
					event.stopPropagation();
				}
				else
				{
					$.ajax({
						url: '/remart/save_act',
						method: 'post',
						dataType: 'json',
						data: {
							user: $('#user').val(),
							id: $('#actid').val(),
							act: $('#act').val()
						},
						success: function(data)
						{
							if (data == 'true') 
							{
								alert('Акт успешно загружен!');
								window.location = '/dashboard';
							}
							else
							{
								alert('Ошибка при загрузке акта!');
							}
						},
						error: function(data)
						{
							console.log(data);
						}
					});
				}
				$("#needs-validation3").addClass("was-validated");
				return false;
			});
		});
</script>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><? echo Translations::gi()->close; ?></button>
			</div>
		</div>
	</div>
</div>
<? } ?>
<? if ($item->role_id == 3) { ?>
<script type="text/javascript">
$(function(){
	$.ajax({
		url: '/remart/get_objects',
		method: 'get',
		dataType: 'json',
		success: function(data) { console.log(data);
			for (i in data)
			{
				actions = '';
				if (data[i].status == 2) actions = '<button class="reject btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="Rejected"><i class="fa fa-close"></i></button> <button class="correct btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Pending correction"><i class="fa fa-edit"></i></button> <button class="valuate btn btn-sm btn-info" data-id="' + data[i].id + '" type="button" title="Pending valuate"><i class="fa fa-star-o"></i></button>';
				if (data[i].status == 5) actions = '<button class="approval btn btn-sm btn-dark" data-id="' + data[i].id + '" type="button" title="Pending approve"><i class="fa fa-stop"></i></button> ';
				if (data[i].status == 6) actions = '<button class="approve btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="Approved"><i class="fa fa-check"></i></button>';
				if (data[i].status == 7) actions = '<button class="sold btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="Sold"><i class="fa fa-dollar"></i></button>';
				if (data[i].rinok == '') is_valued = 'Not valued', iv = 'notvalued';
				else is_valued = 'Valued', iv = 'valued';
				$("#objects").append('<tr class="object obj_' + data[i].status + ' cit_' + data[i].city_id + ' reg_' + data[i].region + ' ' + iv + ' real_' + data[i].realtor_id + '"><td>' + data[i].id + '</td><td>' + data[i].status_name + '</td><td>' + data[i].realtor + '</td><td>' + data[i].city + '</td><td>' + data[i].address + '</td><td>' + data[i].type + '</td><td>' + is_valued + '</td><td class="corcom">' + data[i].correction_comment + '</td><td><a class="edit btn btn-sm btn-primary" href="/edit_object?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>" target="_blank"><i class="fa fa-edit"></i></a></td><td><a class="btn btn-sm btn-primary" target="_blank" href="/view?id=' + data[i].id + '" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-link"></i></a> <button class="viewobject btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><!--<td>' + actions + '</td>--><td><button class="valuates btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Valuates"><i class="fa fa-dollar"></i></button><button class="sendtoaprize btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Отправить на оценку"><i class="fa fa-user"></i></button></td></tr>');
			}
		}
	});
	$("#search").on('click', function(){
		$.ajax({
			url: '/remart/get_objects',
			method: 'get',
			dataType: 'json',
			data: {
				address: $("#address").val()
			},
			success: function(data) { console.log(data);
				$("#objects").html('');
				for (i in data)
				{
					actions = '';
					if (data[i].status == 2) actions = '<button class="reject btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="Rejected"><i class="fa fa-close"></i></button> <button class="correct btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Pending correction"><i class="fa fa-edit"></i></button> <button class="valuate btn btn-sm btn-info" data-id="' + data[i].id + '" type="button" title="Pending valuate"><i class="fa fa-star-o"></i></button>';
					if (data[i].status == 5) actions = '<button class="approval btn btn-sm btn-dark" data-id="' + data[i].id + '" type="button" title="Pending approve"><i class="fa fa-stop"></i></button> ';
					if (data[i].status == 6) actions = '<button class="approve btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="Approved"><i class="fa fa-check"></i></button>';
					if (data[i].status == 7) actions = '<button class="sold btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="Sold"><i class="fa fa-dollar"></i></button>';
					if (data[i].rinok == '') is_valued = 'Not valued', iv = 'notvalued';
					else is_valued = 'Valued', iv = 'valued';
					$("#objects").append('<tr class="object obj_' + data[i].status + ' cit_' + data[i].city_id + ' reg_' + data[i].region + ' ' + iv + ' real_' + data[i].realtor_id + '"><td>' + data[i].id + '</td><td>' + data[i].status_name + '</td><td>' + data[i].realtor + '</td><td>' + data[i].city + '</td><td>' + data[i].address + '</td><td>' + data[i].type + '</td><td>' + is_valued + '</td><td class="corcom">' + data[i].correction_comment + '</td><td><a class="edit btn btn-sm btn-primary" href="/edit_object?id=' + data[i].id + '" target="_blank" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td><a class="btn btn-sm btn-primary" target="_blank" href="/view?id=' + data[i].id + '" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-link"></i></a> <button class="viewobject btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><!--<td>' + actions + '</td>--><td><button class="valuates btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Valuates"><i class="fa fa-dollar"></i></button><button class="sendtoaprize btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Отправить на оценку"><i class="fa fa-user"></i></button></td></tr>');
				}
			}
		});
	});
});
</script>
<script type="text/javascript">
$(function(){
	$(document).on('click', '.valuates', function(){
		ID = $(this).attr('data-id');
		$.ajax({
			url: '/remart/get_valuates',
			method: 'post',
			dataType: 'json',
			data: {
				id: ID
			},
			success: function(data) {
				$('#app_vals').html('');
				for (i in data)
				{
					appr = '';
					if (data[i].status == 0)  appr = '<button type="button" class="btn btn-warning prevaluate" data-id="' + data[i].id + '" title="Pre-valued"><i class="fa fa-shield"></i></button>';
					if (data[i].status == 1)  appr = '<button type="button" class="btn btn-success approvevalue" data-id="' + data[i].id + '" title="Valued"><i class="fa fa-check"></i></button>';
					$('#app_vals').append('<tr><td>' + data[i].id + '</td><td>' + data[i].email + '</td><td>' + data[i].status + '</td><td>' + data[i].rinok + '</td><td>' + data[i].liquid + '</td><td>' + data[i].comment + '</td><td>' + appr + ' <button type="button" class="btn btn-danger declinevalue" data-id="' + data[i].id + '" title="Decline"><i class="fa fa-close"></i></button></td></tr>');
				}
				$('#valuates').modal('show');
			}
		});
	});
	
	$(document).on('click', '.sendtoaprize', function(){
		ID = $(this).attr('data-id');
		$("#sendtoaprize_id").val(ID);
		$('#sendtoaprize').modal('show');
	});
	
	$(document).on('click', '#send_invite', function(){
		$.ajax({
			url: '/remart/send_invite',
			method: 'post',
			dataType: 'json',
			data: {
				object_id: $("#sendtoaprize_id").val(),
				user_id: $("#sendtoaprize_user").val()
			},
			success: function(data) {
				alert('Объект отправлен на оценку');
				$('#sendtoaprize').modal('hide');
			}
		});
		return false;
	});
	
	$(document).on('click', '.prevaluate', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
			$.ajax({
				url: '/remart/pending_value',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('Оценка успешно подтверждена как предварительная!');
						window.location = '/dashboard';
					}
					else
					{
						alert('Ошибка при подтверждении предварительной оценки!');
					}
				}
			});
		}
	});
	
	$(document).on('click', '.approvevalue', function(){
		ID = $(this).attr('data-id');
		$('#valuated').modal('show');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
			$.ajax({
				url: '/remart/approve_value',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('Оценка успешно подтверждена!');
						window.location = '/dashboard';
					}
					else
					{
						alert('Ошибка при подтверждении оценки!');
					}
				}
			});
		}
	});
	
	$(document).on('click', '.declinevalue', function(){
		ID = $(this).attr('data-id');
		if (confirm('<? echo Translations::gi()->are_you_sure; ?>')) {
			$.ajax({
				url: '/remart/decline_value',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					if (data == 'true') 
					{
						alert('Оценка успешно отклонена!');
						window.location = '/dashboard';
					}
					else
					{
						alert('Ошибка при отклонении оценки!');
					}
				}
			});
		}
	});
});
</script>
<div class="modal fade" id="valuates" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewLabel">Просмотр пользователя</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table" id="app_vals">
					<tr>
						<th>ID</th>
						<th>Email</th>
						<th>Status</th>
						<th>Market</th>
						<th>Liquid</th>
						<th>Comment</th>
						<th></th>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="sendtoaprize" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Отправить на оценку</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<input type="hidden" id="sendtoaprize_id">
					<select id="sendtoaprize_user" class="form-control">
						<?
							foreach ($apprizers as $apprizer)
							{
						?>
						<option value="<? echo $apprizer->id; ?>"><? echo $apprizer->name; ?> <? echo $apprizer->surname; ?> <? echo $apprizer->patronymic; ?></option>
						<?
							}
						?>
					</select>
					<button type="submit" class="btn btn-success" id="send_invite">Отправить</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><? echo Translations::gi()->close; ?></button>
			</div>
		</div>
	</div>
</div>


<? } ?>
<? if ($item->role_id == 6) { ?>
<script type="text/javascript">
$(function(){
	
	/*
		GET USER LIST SECTION
	*/
	
	$.ajax({
		url: '/remart/get_my_objects',
		method: 'get',
		dataType: 'json',
		success: function(data) { console.log(data);
			for (i in data)
			{
				if (data[i].status == 1 || data[i].status == 4) edit = '<a class="edit btn btn-sm btn-primary" target="_blank" href="/edit_object?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a>';
				else edit = '';
				actions = '';
				if (data[i].rinok == '') is_valued = 'Not valued', iv = 'notvalued';
				else is_valued = 'Valued', iv = 'valued';
				if (data[i].status == 1 || data[i].status == 4) actions = '<button class="pending btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Submit"><i class="fa fa-briefcase"></i></button>';
				actions += ' <button class="sold btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="Sold"><i class="fa fa-dollar"></i></button>';
				$("#objects").append('<tr class="object obj_' + data[i].status + ' cit_' + data[i].city_id + ' reg_' + data[i].region + '"><td>' + data[i].id + '</td><td>' + data[i].status_name + '</td><td>' + data[i].realtor + '</td><td>' + data[i].city + '</td><td>' + data[i].address + '</td><td>' + data[i].type + '</td><td>' + is_valued + '</td><td class="corcom">' + data[i].correction_comment + '</td><td><a class="btn btn-sm btn-primary" target="_blank" href="/view?id=' + data[i].id + '" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-link"></i></a>  <button class="viewobject btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td>' + edit + '</td><!--<td>' + actions + '</td>--></tr>');
			}
		}
	});
	
	$("#search").on('click', function(){
		$.ajax({
			url: '/remart/get_my_objects',
			method: 'get',
			dataType: 'json',
			data: {
				address: $("#address").val()
			},
			success: function(data) { console.log(data);
				$("#objects").html('');
				for (i in data)
				{
					if (data[i].status == 1 || data[i].status == 4) edit = '<a class="edit btn btn-sm btn-primary" target="_blank" href="/edit_object?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a>';
					else edit = '';
					actions = '';
					if (data[i].rinok == '') is_valued = 'Not valued', iv = 'notvalued';
					else is_valued = 'Valued', iv = 'valued';
					if (data[i].status == 1 || data[i].status == 4) actions = '<button class="pending btn btn-sm btn-warning" data-id="' + data[i].id + '" type="button" title="Submit"><i class="fa fa-briefcase"></i></button>';
					actions += ' <button class="sold btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="Sold"><i class="fa fa-dollar"></i></button>';
					$("#objects").append('<tr class="object obj_' + data[i].status + ' cit_' + data[i].city_id + ' reg_' + data[i].region + '"><td>' + data[i].id + '</td><td>' + data[i].status_name + '</td><td>' + data[i].realtor + '</td><td>' + data[i].city + '</td><td>' + data[i].address + '</td><td>' + data[i].type + '</td><td>' + is_valued + '</td><td class="corcom">' + data[i].correction_comment + '</td><td><a class="btn btn-sm btn-primary" target="_blank" href="/view?id=' + data[i].id + '" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-link"></i></a>  <button class="viewobject btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td>' + edit + '</td><!--<td>' + actions + '</td>--></tr>');
				}
			}
		});
	});
});	
	/*
		END GET USER LIST SECTION
	*/
</script>
<? } ?>
<? if ($item->role_id == 7) { ?>
<script type="text/javascript">
$(function(){	
	$.ajax({
		url: '/remart/get_val_objects',
		method: 'get',
		dataType: 'json',
		success: function(data) { //console.log(data);
			for (i in data)
			{
				actions = '';
				save = ''; console.log(data[i].values.status);
				if (typeof (data[i].values.status) == 'undefined') actions = '<button class="valuater btn btn-warning" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->valuate; ?>"><i class="fa fa-dollar"></i></button>';
				if (data[i].values.status < 2) actions = '<button class="valuater btn btn-warning" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->valuate; ?>"><i class="fa fa-dollar"></i></button>';
				if (data[i].values.status == 2) save = '<button type="button" class="btn btn-success approvefinalvalued" data-id="' + data[i].id + '" title="Valued"><i class="fa fa-shield"></i></button>';
				if (data[i].rinok == '') is_valued = 'Not valued', iv = 'notvalued';
				else is_valued = 'Valued', iv = 'valued';
				$("#objects").append('<tr class="object obj_' + data[i].status + ' cit_' + data[i].city_id + ' reg_' + data[i].region + '"><td>' + data[i].id + '</td><td>' + data[i].status_name + '</td><td>' + data[i].realtor + '</td><td>' + data[i].city + '</td><td>' + data[i].address + '</td><td>' + data[i].type + '</td><td>' + is_valued + '</td><td class="corcom">' + data[i].correction_comment + '</td><td><a class="btn btn-sm btn-primary" target="_blank" href="/view?id=' + data[i].id + '" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-link"></i></a> <button class="viewobject btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td>' + actions + '</td><td>' + save + '</td></tr>');
			}
		}
	});
	$("#search").on('click', function(){
		$.ajax({
			url: '/remart/get_val_objects',
			method: 'get',
			dataType: 'json',
			data: {
				address: $("#address").val()
			},
			success: function(data) { console.log(data);
				$("#objects").html('');
				for (i in data)
				{
					actions = '';
					save = '';
					if (typeof (data[i].values.status) == 'undefined') actions = '<button class="valuater btn btn-warning" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->valuate; ?>"><i class="fa fa-dollar"></i></button>';
					if (data[i].values.status < 2) actions = '<button class="valuater btn btn-warning" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->valuate; ?>"><i class="fa fa-dollar"></i></button>';
					if (data[i].values.status == 2) save = '<button type="button" class="btn btn-success approvefinalvalued" data-id="' + data[i].id + '" title="Valued"><i class="fa fa-shield"></i></button>';
					if (data[i].rinok == '') is_valued = 'Not valued', iv = 'notvalued';
					else is_valued = 'Valued', iv = 'valued';
					$("#objects").append('<tr class="object obj_' + data[i].status + ' cit_' + data[i].city_id + ' reg_' + data[i].region + '"><td>' + data[i].id + '</td><td>' + data[i].status_name + '</td><td>' + data[i].realtor + '</td><td>' + data[i].city + '</td><td>' + data[i].address + '</td><td>' + data[i].type + '</td><td>' + is_valued + '</td><td class="corcom">' + data[i].correction_comment + '</td><td><a class="btn btn-sm btn-primary" target="_blank" href="/view?id=' + data[i].id + '" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-link"></i></a> <button class="viewobject btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td>' + actions + '</td><td>' + save + '</td></tr>');
				}
			}
		});
	});
	$(document).on('click', '.approvefinalvalued', function(){
		ID = $(this).attr('data-id');
		$('#actid').val(ID);
		$('#valuated').modal('show');
	});
	$(document).on('click', '.valuater', function(){
		ID = $(this).attr('data-id');
		$.ajax({
			url: '/remart/get_valuate',
			method: 'post',
			dataType: 'json',
			data: {
				id: ID
			},
			success: function(data) {
				$("#rinok").val(data.rinok);
				$("#liquid").val(data.liquid);
				$("#comment").val(data.comment);
				$("#id").val(ID);
				$("#valuate").modal('show');
			}
		});
	});
});	
	/*
		END GET USER LIST SECTION
	*/
</script>
<div class="modal fade" id="valuate" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewLabel">Просмотр пользователя</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="needs-validation" novalidate>
					<input type="hidden" id="id">
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<label for="rinok">Рычночная стоимость</label>
							<input type="text" class="form-control" name="rinok" id="rinok" placeholder="Рычночная стоимость" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<label for="liquid">Ликвидная стоимость</label>
							<input type="text" class="form-control" name="liquid" id="liquid" placeholder="Ликвидная стоимость" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<label for="comment">Коммент</label>
							<textarea class="form-control" name="comment" id="comment"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="submit" id="submit" class="btn btn-primary">Сохранить</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$("#submit").on('click', function(event){
				if ($("#needs-validation")[0].checkValidity() == false) {
					event.preventDefault();
					event.stopPropagation();
				}
				else
				{
					$.ajax({
						url: '/remart/save_object_extra',
						method: 'post',
						dataType: 'json',
						data: {
							object_id: $('#id').val(),
							rinok: $('#rinok').val(),
							liquid: $('#liquid').val(),
							comment: $('#comment').val()
						},
						success: function(data)
						{
							if (data == 'true') 
							{
								alert('Данные об оценке успешно изменены!');
								window.location = '/dashboard';
							}
							else
							{
								alert('Ошибка!');
							}
						},
						error: function(data)
						{
							console.log(data);
						}
					});
					return false;
				}
				$("#needs-validation").addClass("was-validated");
				return false;
			});
});
</script>
<div class="modal fade" id="valuated" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewLabel">Акт о проверке</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="needs-validation3" novalidate>
					<input type="hidden" id="act">
					<input type="hidden" id="actid">
					<div class="row">
						<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<label for="user">Пользователь</label>
							<select class="form-control" id="user" name="user">
								<? foreach ($buyers as $user) { ?>
								<option value="<? echo $user->id; ?>"><? echo $user->id; ?>. <? echo $user->email; ?>: <? echo $user->surname; ?> <? echo $user->name; ?> <? echo $user->patronymic; ?></option>
								<? } ?>
							</select>
						</div>
					</div>
					<p>Акт оценки:</p>
					<div class="col col-12 col-sm-12 col-md-12 col-lg-12">
						<div id="object-photo" class="dropzone"></div>
					</div>
					<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images row">
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<button class="btn btn-success" type="submit" id="saveact"><? echo Translations::gi()->save; ?></button>
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
				$("#act").val(name);
				$('.images').html('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + name + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button></div>');
			},
			error: function (file, response) {
				file.previewElement.classList.add("dz-error");
			}
		});
		$(function(){
			images = $('#act').val();
			if (images != '')
			{
				$('.images').html('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + images + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button></div>');
			}
			$(document).on('click', '.delete', function(){
				$(this).parent().remove();
				$("#act").val('');
			});
			$("#needs-validation3").on('submit', function(event){
				if ($("#needs-validation3")[0].checkValidity() == false) {
					event.preventDefault();
					event.stopPropagation();
				}
				else
				{
					$.ajax({
						url: '/remart/save_act',
						method: 'post',
						dataType: 'json',
						data: {
							user: $('#user').val(),
							id: $('#actid').val(),
							act: $('#act').val()
						},
						success: function(data)
						{
							if (data == 'true') 
							{
								alert('Акт успешно загружен!');
								window.location = '/dashboard';
							}
							else
							{
								alert('Ошибка при загрузке акта!');
							}
						},
						error: function(data)
						{
							console.log(data);
						}
					});
				}
				$("#needs-validation3").addClass("was-validated");
				return false;
			});
		});
</script>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><? echo Translations::gi()->close; ?></button>
			</div>
		</div>
	</div>
</div>
<? } ?>

<div class="modal fade" id="view_object" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewLabel"><? echo Translations::gi()->object_view; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<th><? echo Translations::gi()->parameter; ?></th>
						<th><? echo Translations::gi()->value; ?></th>
					</tr>
					<tr>
						<td>ID</td>
						<td id="view_obj_id"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->realtor; ?></td>
						<td id="view_realtor"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->object_type; ?></td>
						<td id="view_type"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->city; ?></td>
						<td id="view_city"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->region; ?></td>
						<td id="view_region"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->metro; ?></td>
						<td id="view_metro"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->orient; ?></td>
						<td id="view_orient"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->price; ?></td>
						<td id="view_price"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->ap_type; ?></td>
						<td id="view_ap_type"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->kupche; ?></td>
						<td id="view_kupche"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->pravo; ?></td>
						<td id="view_pravo"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->gas; ?></td>
						<td id="view_gas"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->room; ?></td>
						<td id="view_room"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->floors; ?></td>
						<td id="view_floors"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->floor; ?></td>
						<td id="view_floor"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->square_zeml; ?></td>
						<td id="view_square_zeml"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->square; ?></td>
						<td id="view_square"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->sanuz; ?></td>
						<td id="view_sanuz"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->balkon; ?></td>
						<td id="view_balkon"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->remont; ?></td>
						<td id="view_remont"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->phone; ?></td>
						<td id="view_phone"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->kabeltv; ?></td>
						<td id="view_kabeltv"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->lift; ?></td>
						<td id="view_lift"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->garage; ?></td>
						<td id="view_garage"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->safe; ?></td>
						<td id="view_safe"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->pvcwin; ?></td>
						<td id="view_pvcwin"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->waterboil; ?></td>
						<td id="view_waterboil"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->warm; ?></td>
						<td id="view_warm"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->kombi; ?></td>
						<td id="view_kombi"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->conditioner; ?></td>
						<td id="view_conditioner"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->kitchen; ?></td>
						<td id="view_kitchen"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->rinok; ?></td>
						<td id="view_rinok"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->liquid; ?></td>
						<td id="view_liquid"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->comment; ?></td>
						<td id="view_comment"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->status; ?></td>
						<td id="view_status"></td>
					</tr>				
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><? echo Translations::gi()->close; ?></button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(document).on('click', '.viewobject', function(){
		ID = $(this).attr('data-id');
		$.ajax({
			url: '/remart/get_object',
			method: 'post',
			dataType: 'json',
			data: {
				id: ID
			},
			success: function(data) {
				$('#view_realtor').html(data.realtor);
				$('#view_type').html(data.type);
				$('#view_city').html(data.city);
				$('#view_region').html(data.region);
				$('#view_metro').html(data.metro);
				$('#view_orient').html(data.orient);
				$('#view_price').html(data.price);
				$('#view_ap_type').html(data.ap_type);
				$('#view_kupche').html(data.kupche);
				$('#view_pravo').html(data.pravo);
				$('#view_gas').html(data.gas);
				$('#view_room').html(data.room);
				$('#view_floors').html(data.floors);
				$('#view_floor').html(data.floor);
				$('#view_square_zeml').html(data.square_zeml);
				$('#view_square').html(data.square);
				$('#view_sanuz').html(data.sanuz);
				$('#view_balkon').html(data.balkon);
				$('#view_remont').html(data.remont);
				$('#view_phone').html(data.phone);
				$('#view_kabeltv').html(data.kabeltv);
				$('#view_lift').html(data.lift);
				$('#view_garage').html(data.garage);
				$('#view_safe').html(data.safe);
				$('#view_pvcwin').html(data.pvcwin);
				$('#view_waterboil').html(data.waterboil);
				$('#view_warm').html(data.warm);
				$('#view_kombi').html(data.kombi);
				$('#view_conditioner').html(data.conditioner);
				$('#view_kitchen').html(data.kitchen);
				$('#view_photo').html(data.photo);
				$('#view_rinok').html(data.rinok);
				$('#view_liquid').html(data.liquid);
				$('#view_comment').html(data.comment);
				$('#view_status').html(data.status);
				$('#view_obj_id').html(data.id);
				$('#view_object').modal('show');
			}
		});
	});
});
</script>