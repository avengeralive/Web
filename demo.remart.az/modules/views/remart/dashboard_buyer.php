<style>
.filters .col-12
{
	padding-top: 20px;
	padding-bottom: 20px;
}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<form>
				<div class="row filters">
					<div class="col-12 col-sm-9">
						<input class="form-control" type="text" id="object_id" name="object_id" placeholder="Найти по ID">
					</div>
					<div class="col-12 col-sm-3">
						<button type="submit" id="openid" class="btn btn-primary"><? echo Translations::gi()->search; ?></button>
					</div>
				</div>
			</form>
			<form>
				<div class="row filters">
					<div class="col-12 col-sm-3">
						<select class="form-control" id="type" name="type" required>
							<option value="0"><? echo Translations::gi()->object_type; ?></option>
							<option value="1"><? echo Translations::gi()->apartment; ?></option>
								<option value="2"><? echo Translations::gi()->private_home; ?></option>
						</select>
					</div>
					<div class="col-12 col-sm-3">
						<select class="form-control" id="ap_type" name="ap_type" disabled required>
							<option value="0"><? echo Translations::gi()->ap_type; ?></option>
							<option value="1"><? echo Translations::gi()->newh; ?></option>
							<option value="2"><? echo Translations::gi()->secondh; ?></option>
						</select>
					</div>
					<div class="col-12 col-sm-3">
						<div class="dropdown">
							<button disabled class="btn btn-secondary dropdown-toggle" type="button" id="project" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->project; ?></button>
							<div class="dropdown-menu" aria-labelledby="project">
							<? foreach ($projects as $project) { ?>
								<label><input type="checkbox" name="project[]" id="project_<? echo $project->id; ?>"> <? echo $project->name; ?></label><br>
							<? } ?>	
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-3">
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" id="room" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->room; ?></button>
							<div class="dropdown-menu" aria-labelledby="project">
							<label><input type="checkbox" id="room_1">1 комнатные</label><br>
							<label><input type="checkbox" id="room_2">2 комнатные</label><br>
							<label><input type="checkbox" id="room_3">3 комнатные</label><br>
							<label><input type="checkbox" id="room_4">4 комнатные</label><br>
							<label><input type="checkbox" id="room_5">5 комнатные и больше</label><br>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-3">
						<tbody>
							<tr>
								<td><? echo Translations::gi()->price; ?></td>
								<td><input class="form-control" type="text" id="min_pr" name="min_pr"></td>
								<td>-</td>
								<td><input class="form-control" type="text" id="max_pr" name="max_pr"></td>
								<td>AZN</td>
							</tr>
						</tbody>
					</div>
					<div class="col-12 col-sm-3">
						<tbody>
							<tr>
								<td><? echo Translations::gi()->square; ?></td>
								<td><input class="form-control" type="text" id="min_sq" name="min_sq"></td>
								<td>-</td>
								<td><input class="form-control" type="text" id="max_sq" name="max_sq"></td>
								<td>m<sup>2</sup></td>
							</tr>
						</tbody>
					</div>
					<div class="col-12 col-sm-3">
					</div>
					<div class="col-12 col-sm-3">
					</div>
					<div class="col-12 col-sm-3">
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" id="city" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Выберите город</button>
							<div class="dropdown-menu" aria-labelledby="project">
							<? foreach ($cities as $city) { ?>
								<label><input type="checkbox" name="city[]" id="city_<? echo $city->id; ?>"> <? echo $city->name; ?></label><br>
							<? } ?>	
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-3">
						<div class="dropdown">
							<button disabled class="btn btn-secondary dropdown-toggle" type="button" id="region" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->select_region; ?></button>
							<div class="dropdown-menu" aria-labelledby="region">
							<? foreach ($regions as $region) { ?>
								<label><input type="checkbox" name="region[]" id="region_<? echo $region->id; ?>"> <? echo $region->name; ?></label><br>
							<? } ?>	
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-3">
						<div class="dropdown">
							<button disabled class="btn btn-secondary dropdown-toggle" type="button" id="orient" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->orient; ?></button>
							<div class="dropdown-menu" aria-labelledby="orient">
							<? foreach ($orients as $orient) { ?>
								<label><input type="checkbox" name="orient[]" id="orient_<? echo $orient->id; ?>"> <? echo $orient->name; ?></label><br>
							<? } ?>	
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-3">
						<div class="dropdown">
							<button disabled class="btn btn-secondary dropdown-toggle" type="button" id="metro" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->select_metro; ?></button>
							<div class="dropdown-menu" aria-labelledby="metro">
							<? foreach ($metros as $metro) { ?>
								<label><input type="checkbox" name="metro[]" id="metro_<? echo $metro->id; ?>"> <? echo $metro->name; ?></label><br>
							<? } ?>	
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-3">
						<? if ($item->role_id == 2 || $item->role_id == 3) { ?>
						<select class="form-control" id="realtor" name="realtor" required>
							<option value="0"><? echo Translations::gi()->realtor; ?></option>
							<? foreach ($rieltors as $rieltor) { ?>
							<option value="<? echo $rieltor->id; ?>"><? echo $rieltor->name; ?> <? echo $rieltor->surname; ?> <? echo $rieltor->patronymic; ?></option>
							<? } ?>	
							</select>
						<? } ?>					
					</div>
					<div class="col-12 col-sm-9"></div>
					<div class="col-12 col-sm-3">
						<button type="submit" id="save" class="btn btn-primary"><? echo Translations::gi()->search; ?></button>
					</div>
				</div>
			</form>
			<script type="text/javascript">
			$(function(){
				$("#openid").on('click', function() {
					window.location = '/view?id=' + $("#object_id").val();
					return false;
				});
				$("#type").on('change', function(){
					if ($("#type").val() == 1) 
					{
						$("#ap_type").attr('disabled', false);
					}
					else 
					{
						$("#ap_type").attr('disabled', true);
						$("#project").attr('disabled', true);
					}
				});
				$("#ap_type").on('change', function(){
					if ($("#ap_type").val() == 2) 
					{
						$("#project").attr('disabled', false);
					}
					else 
					{
						$("#project").attr('disabled', true);
					}
				});
				$("#city_6").on('change', function(){
					if ($("#city_6").is(':checked'))
					{
						$("#region").attr('disabled', false);
						$("#orient").attr('disabled', false);
						$("#metro").attr('disabled', false);
					}
					else
					{
						$("#region").attr('disabled', true);
						$("#orient").attr('disabled', true);
						$("#metro").attr('disabled', true);
					}
				});
				$("#save").on('click', function() {
					orient = [];
					<? foreach ($orients as $orient) { ?>
					if ($("#orient_<? echo $orient->id; ?>").is(':checked') == true) orient.push(<? echo $orient->id; ?>);
					<? } ?>	
					metro = [];
					<? foreach ($metros as $metro) { ?>
					if ($("#metro_<? echo $metro->id; ?>").is(':checked') == true) metro.push(<? echo $metro->id; ?>);
					<? } ?>	
					city = [];
					<? foreach ($cities as $city) { ?>
					if ($("#city_<? echo $city->id; ?>").is(':checked') == true) city.push(<? echo $city->id; ?>);
					<? } ?>	
					region = [];
					<? foreach ($regions as $region) { ?>
					if ($("#region_<? echo $region->id; ?>").is(':checked') == true) region.push(<? echo $region->id; ?>);
					<? } ?>	
					min_pr = $("#min_pr").val();
					max_pr = $("#max_pr").val();
					min_sq = $("#min_sq").val();
					max_sq = $("#max_sq").val();
					type = $("#type").val();
					ap_type = $("#ap_type").val();
					room = [];
					if ($("#room_1").is(':checked') == true) room.push(1);
					if ($("#room_2").is(':checked') == true) room.push(2);
					if ($("#room_3").is(':checked') == true) room.push(3);
					if ($("#room_4").is(':checked') == true) room.push(4);
					if ($("#room_5").is(':checked') == true) room.push(5);
					project = [];
					<? foreach ($projects as $project) { ?>
					if ($("#project_<? echo $project->id; ?>").is(':checked') == true) project.push(<? echo $project->id; ?>);
					<? } ?>	
					$.ajax({
						url: '/remart/search',
						method: 'post',
						dataType: 'json',
						data: {
							<? if ($item->role_id == 6) { ?>realtor: <? echo $item->id; ?>,<? } ?>
							<? if ($item->role_id == 2 || $item->role_id == 3) { ?>realtor: $('#realtor').val(),<? } ?>
							orient: orient,
							city: city,
							region: region,
							metro: metro,
							project: project,
							room: room,
							min_pr: min_pr,
							max_pr: max_pr,
							min_sq: min_sq,
							max_sq: max_sq,
							type: type,
							ap_type: ap_type
						},
						success: function(data)
						{
							console.log(data);
							$("#cont").html('');
							for (i in data)
							{
								if (data[i].orient == null) orient = '';
								else orient = data[i].orient + ', ';
								if (data[i].rinok == '') price = "Риелторская цена: " + data[i].price;
								else price = "Рыночная цена: " + data[i].rinok + "<br>Риелторская цена: " + data[i].price;
								if (data[i].favorite) fav = '<button data-id="' + data[i].id + '" class="btn btn-danger favs"><i class="fa fa-star"></i></button>';
								else fav = '<button data-id="' + data[i].id + '" class="btn btn-success favs"><i class="fa fa-star"></i></button>';
								$("#cont").append('<div class="col-12 col-sm-6 col-md-3 col-lg-4 col-xl-4 row" style="padding-bottom: 40px;"><div class="col-12" style="height: 250px; overflow: hidden;"><img src="/materials/temp/files/' + data[i].main_photo + '" style="width: auto; height: 100%;"></div><div class="col-12" style="text-align: center;"><p>' + data[i].city + ', ' + data[i].region + ', ' + orient + data[i].address + '</p><p>' + data[i].type + '</p><p>' + price + ' AZN</p><a target="_blank" href="/view?id=' + data[i].id + '" class="btn btn-primary">Подробнее</a>' + fav + '</div></div>');
							}
						},
						error: function(data)
						{
							console.log(data);
						}
					});
					return false;
				});
			});
			</script>
		</div>
		<div class="row" id="cont">
<? foreach ($objects as $object) { ?>
			<div class="col-12 col-sm-6 col-md-3 col-lg-4 col-xl-4 row" style="padding-bottom: 40px;">
				<div class="col-12" style="height: 250px; overflow: hidden;">
					<img src="/materials/temp/files/<? echo explode(',', $object->photo)[0]; ?>" style="width: auto; height: 100%;">
				</div>
				<div class="col-12" style="text-align: center;">
					<p><? echo $object->city; ?>, <? echo $object->region; ?>, <? echo $object->orient; ?>, <? echo $object->address; ?></p>
					<p><? echo $object->type; ?></p>
					<p><? echo $object->rinok; ?> AZN</p>
					<a href="/view?id=<? echo $object->id; ?>" class="btn btn-primary" target="_blank">Подробнее</a>
					<? if ($object->favorite) { ?><button data-id="<? echo $object->id; ?>" class="btn btn-danger favs"><i class="fa fa-star"></i></button><? } else { ?>
					<button data-id="<? echo $object->id; ?>" class="btn btn-success favs"><i class="fa fa-star"></i></button>
					<? } ?>
				</div>
			</div>
<? } ?>
		</div>
		<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_object">
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	function getObjectCnt()
	{
		$.ajax({
			url: '/remart/get_approved_objects_count',
			method: 'get',
			dataType: 'json',
			<? if ($item->role_id == 6) { ?>data: { realtor: <? echo $item->id; ?> },<? } ?>
			success: function(data) {
				pages = (data.cnt % 30) ? Math.floor(data.cnt / 30) + 1 : Math.floor(data.cnt / 30);
				pagination = '';
				for (i = 1; i <= pages; i++)
				{
					pagination += '<li class="page-item"><a class="page-link" data-page="' + i + '">' + i + '</a></li>';
				}
				pagination = '<ul class="pagination">' + pagination + '</ul>';
				$("#pagination_object").html(pagination);
				getObject(1);
			}
		});
	}
	function getObject(page)
	{
		$.ajax({
			url: '/remart/get_approved_objects',
			method: 'get',
			dataType: 'json',
			data: {
				perpage: 30,
				<? if ($item->role_id == 6) { ?>realtor: <? echo $item->id; ?>,<? } ?>
				page: page
			},
			success: function(data) {
				$("#cont").html('');			
				for (i in data)
				{
					if (data[i].orient == null) orient = '';
					else orient = data[i].orient + ', ';
					if (data[i].rinok == '') price = "Риелторская цена: " + data[i].price;
					else price = "Рыночная цена: " + data[i].rinok + "<br>Риелторская цена: " + data[i].price;
					if (data[i].favorite) fav = '<button data-id="' + data[i].id + '" class="btn btn-danger favs"><i class="fa fa-star"></i></button>';
					else fav = '<button data-id="' + data[i].id + '" class="btn btn-success favs"><i class="fa fa-star"></i></button>';
					$("#cont").append('<div class="col-12 col-sm-6 col-md-3 col-lg-4 col-xl-4 row" style="padding-bottom: 40px;"><div class="col-12" style="height: 250px; overflow: hidden;"><img src="/materials/temp/files/' + data[i].main_photo + '" style="width: auto; height: 100%;"></div><div class="col-12" style="text-align: center;"><p>' + data[i].city + ', ' + data[i].region + ', ' + orient + data[i].address + '</p><p>' + data[i].type + '</p><p>' + price + ' AZN</p><a target="_blank" href="/view?id=' + data[i].id + '" class="btn btn-primary">Подробнее</a>' + fav + '</div></div>');
				}
				$('#pagination_object .page-item').removeClass('active');
				$($('#pagination_object .pagination')[0].childNodes[page - 1]).addClass('active');
			}
		});
	}
	getObjectCnt();
	$(document).on('click', '#pagination_object .page-link', function(){
		page = $(this).attr('data-page');
		getObject(page);
	});
	$(document).on('click', '.btn-success.favs', function(event) {
		var el = $(this);
		var obj = $(this).attr('data-id');		
		$.ajax({
			url: '/remart/addfav',
			method: 'post',
			dataType: 'json',
			data: {
				object: obj,
			},
			success: function(data) {
				if (data == true) 
				{
					alert('Added to favorites');
					el.removeClass('btn-success');
					el.addClass('btn-danger');
				}
			}
		});
	});
	$(document).on('click', '.btn-danger.favs', function(event) {
		var el = $(this);
		var obj = $(this).attr('data-id');		
		$.ajax({
			url: '/remart/delfav',
			method: 'post',
			dataType: 'json',
			data: {
				object: obj,
			},
			success: function(data) {
				if (data == true) 
				{
					alert('Removed from favorites');
					el.removeClass('btn-danger');
					el.addClass('btn-success');
				}
			}
		});
	});
});
</script>