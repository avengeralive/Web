<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<? if ($permissions['objects']->create) { ?>
	<a href="/create_object" class="btn btn-sm btn-success addnew" title="<? echo Translations::gi()->$user_create; ?>"><i class="fa fa-plus"></i> <? echo Translations::gi()->create_object; ?></a>
	<? } ?>
	<a href="/objects" class="btn btn-sm btn-info" style="font-size: 16px; padding: 5px 20px; border-radius: 30px; margin-top: 30px;"><? echo Translations::gi()->web; ?></a>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
	<p><? echo Translations::gi()->see_as; ?>
	    <select class="form-control" id="perpage_objects" style="width: 100px;">
		<option value="10" selected>10</option>
		<option value="20">20</option>
		<option value="50">50</option>
	    </select>
	</p>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<table class="table table-sm" id="objects">
	    <thead>
		<tr class="tableheaders">
		    <th>ID</th>
		    <th><? echo Translations::gi()->object_type; ?></th>
		    <th><? echo Translations::gi()->room; ?></th>
		    <th><? echo Translations::gi()->square; ?></th>
		    <th><? echo Translations::gi()->price; ?></th>
		    <th><? echo Translations::gi()->city; ?></th>
		    <th><? echo Translations::gi()->region; ?></th>
		    <th><? echo Translations::gi()->address; ?></th>
		    <th><? echo Translations::gi()->realtor; ?></th>
		    <th><? echo Translations::gi()->status; ?></th>
		    <th><? echo Translations::gi()->valued; ?>Оценка</th>
		    <th></th>
		</tr>
		<tr>
		    <th><input type="text" class="form-control id"></th>
		    <th>
			<select class="form-control type">
			    <option value="">Все</option>
			    <option value="1"><? echo Translations::gi()->apartment; ?></option>
			    <option value="2"><? echo Translations::gi()->private_home; ?></option>
			</select>
		    </th>
		    <th>
			<div class="btn-group" style="width: 100%;">
			    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->room; ?></button>
			    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
				<? for ( $i = 1; $i <= 9; $i++ ) { ?>
				<label style="width:100%"><input type="checkbox" name="room" class="room" value="<? echo $i; ?>"><? echo $i; ?></label>
				<? } ?>   
				<label style="width:100%"><input type="checkbox" name="room" class="room" value="10">10+</label>
			    </div>
			</div>
		    </th>
		    <th>
			<input type="text" style="width:50%; float:left;" class="form-control square_min" placeholder="min">
			<input type="text" style="width:50%; float:left;" class="form-control square_max" placeholder="max">
		    </th>
		    <th>
			<input type="text" style="width:50%; float:left;" class="form-control price_min" placeholder="min">
			<input type="text" style="width:50%; float:left;" class="form-control price_max" placeholder="max">
		    </th>
		    <th>
			<div class="btn-group" style="width: 100%;">
			    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->city; ?></button>
			    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff; max-height: 300px; overflow: scroll;">
			    <? foreach ($objcities as $city) { ?>
				<label style="width:100%"><input type="checkbox" name="city" class="city" value="<? echo $city->id; ?>"><? echo $city->name; ?></label>
			    <? } ?>
			    </div>
			</div>
		    </th>
		    <th>
			<div class="btn-group" style="width: 100%;">
			    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->region; ?></button>
			    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
			    <? foreach ($objregions as $region) { ?>
				<label style="width:100%"><input type="checkbox" name="region" class="region" value="<? echo $region->id; ?>"><? echo $region->name; ?></label>
			    <? } ?>
			    </div>
			</div>
		    </th>
		    <th><input type="text" class="form-control address"></th>
		    <th>
			<select class="form-control realtor">
			    <option value="<? echo $permissions['parameters']->realtor; ?>">All</option>
			<? foreach ($objusers as $user) { ?>
			    <option value="<? echo $user->id; ?>"><? echo $user->name; ?> <? echo $user->surname; ?></option>
			<? } ?>
			</select>
		    </th>
		    <th>
			<select class="form-control status">
			    <option value="1,2,4,5,6,7,8">All</option>
			    <option value="1">Created</option>
			    <option value="2">Pending</option>
			    <option value="3">Rejected</option>
			    <option value="4">Pending correction</option>
			    <option value="5">Pending valuate</option>
			    <option value="6">Pending approve</option>
			    <option value="7">Approved</option>
			    <option value="8">Sold</option>
			</select>
		    </th>
		    <th>
			<select class="form-control valued">
			    <option value="0,1">All</option>
			    <option value="0">Not valued</option>
			    <option value="1">Valued</option>
			</select>
		    </th> 
		    <th>
			<button class="btn search"><i class="fa fa-search"></i></button>
			<button class="btn btn-danger reset"><i class="fa fa-ban"></i></button>
		    </th>
		</tr>
	    </thead>
	    <tbody id="table_body_objects"></tbody>
	</table>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_object">
    </div>
</div>
<? if ($item->role_id == 7) { ?>
<style>
#objects th:nth-child(10), #objects td:nth-child(10)
{
    display: none;
}
#objects th:nth-child(11), #objects td:nth-child(11)
{
    display: none;
}
</style>
<? } ?>
<script type="text/javascript">
$(function(){
    var limit_object = $("#perpage_objects").val();
    get_objects(limit_object, 0);
    function get_objects(limit, offset)
    {
	var room = [];
	for (i = 1; i<=10; i++) if ($("#objects .room[value=" + i + "]").prop("checked")) room.push(i);
	room = room.join();
	if (room.length == 0) room = "1,2,3,4,5,6,7,8,9,10";
	
	var city = [];
	var cities = [];
	$('#objects .city').each(function(e,v){ cities.push($(v).val()); if ($(v).prop('checked')) city.push($(v).val()); });
	city = city.join();
	if (city.length == 0) city = cities.join();
		    
	var region = [];
	var regions = [];
	$('#objects .region').each(function(e,v){ regions.push($(v).val()); if ($(v).prop('checked')) region.push($(v).val()); });
	region = region.join();
	if (region.length == 0) 
	{
		regions.push(0);
		region = regions.join();
	}
	
	$.ajax({
	    url: '/remart/get_objects',
	    method: 'get',
	    dataType: 'json',
	    data: {
		limit: limit,
		offset: offset,
		id: $("#objects .id").val(),
		type: $("#objects .type").val(),
		room: room,
		square_min: ($("#objects .square_min").val() == "") ? 0 : $("#objects .square_min").val(),
		square_max: ($("#objects .square_max").val() == "") ? 1000000000 : $("#objects .square_max").val(),
		price_min: ($("#objects .price_min").val() == "") ? 0 : $("#objects .price_min").val(),
		price_max: ($("#objects .price_max").val() == "") ? 1000000000 : $("#objects .price_max").val(),
		city: city,
		region: region,
		address: $("#objects .address").val(),
		realtor: $("#objects .realtor").val(),
		status: $("#objects .status").val(),
		valued: $("#objects .valued").val(),
		sort: 'o.status ASC, o.id DESC',
		search: '%',
		pm: '<? echo $permissions['parameters']->pm; ?>'
		/*id: $("#<? echo $user_groups; ?> .id").val(),
		name: $("#<? echo $user_groups; ?> .name").val(),
		company_name: $("#<? echo $user_groups; ?> .company_name").val(),
		phone: $("#<? echo $user_groups; ?> .phone").val(),
		email: $("#<? echo $user_groups; ?> .email").val(),
		objects_min: ($("#<? echo $user_groups; ?> .objects_min").val() == "") ? 0 : $("#<? echo $user_groups; ?> .objects_min").val(),
		objects_max: ($("#<? echo $user_groups; ?> .objects_max").val() == "") ? 1000000000 : $("#<? echo $user_groups; ?> .objects_max").val(),
		buyers_min: ($("#<? echo $user_groups; ?> .buyers_min").val() == "") ? 0 : $("#<? echo $user_groups; ?> .buyers_min").val(),
		buyers_max: ($("#<? echo $user_groups; ?> .buyers_max").val() == "") ? 1000000000 : $("#<? echo $user_groups; ?> .buyers_max").val(),
		role_id: <? echo $user_role; ?>,
		status: $("#<? echo $user_groups; ?> .status").val(),
		company: <? echo $company; ?>*/
	    },
	    success: function(data) {
		$("#table_body_objects").html('');
		var status = [];
		var valuation = [];
		var type = [];
		status[1] = 'created';
		status[2] = 'pending';
		status[3] = 'rejected';
		status[4] = 'pending correction';
		status[5] = 'pending valuate';
		status[6] = 'pending approve';
		status[7] = 'approved';
		status[8] = 'sold';
		valuation[1] = 'not valued';
		valuation[2] = 'valued';
		type[1] = 'Квартира';
		type[2] = 'Частный дом';
		for (i in data.data)
		{
		    if (data.data[i].valued_obj == 0) valued_stat = valuation[1];
		    else valued_stat = valuation[2];
		    if (data.data[i].status == 4)
		    {
		    $("#table_body_objects").append('<tr class="text-danger"><td>' + data.data[i].id + '</td><td>' + type[data.data[i].type] + '</td><td>' + data.data[i].room + '</td><td>' + data.data[i].square + '</td><td>' + data.data[i].price + '</td><td>' + data.data[i].city + '</td><td>' + data.data[i].region + '</td><td>' + data.data[i].address + '</td><td>' + data.data[i].realtor + '</td><td>' + status[data.data[i].status] + '</td><td>' + valued_stat + '</td><td><a href="/object?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
			}
			else if (data.data[i].status == 1 || data.data[i].status == 2)
			{
				$("#table_body_objects").append('<tr class="text-warning"><td>' + data.data[i].id + '</td><td>' + type[data.data[i].type] + '</td><td>' + data.data[i].room + '</td><td>' + data.data[i].square + '</td><td>' + data.data[i].price + '</td><td>' + data.data[i].city + '</td><td>' + data.data[i].region + '</td><td>' + data.data[i].address + '</td><td>' + data.data[i].realtor + '</td><td>' + status[data.data[i].status] + '</td><td>' + valued_stat + '</td><td><a href="/object?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
			}
			else if (data.data[i].status == 5)
			{
				$("#table_body_objects").append('<tr class="text-info"><td>' + data.data[i].id + '</td><td>' + type[data.data[i].type] + '</td><td>' + data.data[i].room + '</td><td>' + data.data[i].square + '</td><td>' + data.data[i].price + '</td><td>' + data.data[i].city + '</td><td>' + data.data[i].region + '</td><td>' + data.data[i].address + '</td><td>' + data.data[i].realtor + '</td><td>' + status[data.data[i].status] + '</td><td>' + valued_stat + '</td><td><a href="/object?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
			}
			else if (data.data[i].status == 6)
			{
				$("#table_body_objects").append('<tr class="text-primary"><td>' + data.data[i].id + '</td><td>' + type[data.data[i].type] + '</td><td>' + data.data[i].room + '</td><td>' + data.data[i].square + '</td><td>' + data.data[i].price + '</td><td>' + data.data[i].city + '</td><td>' + data.data[i].region + '</td><td>' + data.data[i].address + '</td><td>' + data.data[i].realtor + '</td><td>' + status[data.data[i].status] + '</td><td>' + valued_stat + '</td><td><a href="/object?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
			}
			else
			{
				$("#table_body_objects").append('<tr><td>' + data.data[i].id + '</td><td>' + type[data.data[i].type] + '</td><td>' + data.data[i].room + '</td><td>' + data.data[i].square + '</td><td>' + data.data[i].price + '</td><td>' + data.data[i].city + '</td><td>' + data.data[i].region + '</td><td>' + data.data[i].address + '</td><td>' + data.data[i].realtor + '</td><td>' + status[data.data[i].status] + '</td><td>' + valued_stat + '</td><td><a href="/object?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
			}
		}
		var pages = Math.ceil(data.count / limit);
		var current_page = Math.ceil(offset / limit) + 1;
		var previous_page = '';
		var next_page = '';
		var pagination_container = '';
		for (i = 1; i < current_page; i++)
		{
		    pagination_container += '<li class="page-item"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
		}
		pagination_container += '<li class="page-item active"><a class="page-link" href="#" data-page="' + current_page + '">' + current_page + '</a></li>';
		for (i = current_page + 1; i <= pages; i++)
		{
		    pagination_container += '<li class="page-item"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
		}
		if (current_page > 1) previous_page = '<li class="page-item"><a class="page-link" href="#" data-page="' + (current_page - 1) + '"><? echo Translations::gi()->prev; ?></a></li>';
		if (current_page < pages) next_page = '<li class="page-item"><a class="page-link" href="#" data-page="' + Number(current_page + 1) + '"><? echo Translations::gi()->next; ?></a></li>';
		pagination_container = '<nav aria-label="User paginations"><ul class="pagination">' + previous_page + pagination_container + next_page + '</ul></div>';
		$("#pagination_object").html(pagination_container);
	    }
	});
    }
    $(document).on('click', '#objects .search', function(){
	get_objects(limit_object, 0);
    });
    $(document).on('click', '#objects .reset', function(){
	$("#objects .id").val('');
	$("#objects .type").val('');
	$("#objects .room").prop('checked', false);
	$("#objects .city").prop('checked', false);
	$("#objects .square_min").val('');
	$("#objects .square_max").val('');
	$("#objects .price_min").val('');
	$("#objects .price_max").val('');
	$("#objects .region").prop('checked', false),
	$("#objects .address").val(),
	$("#objects .realtor").val('<? echo $permissions['parameters']->realtor; ?>'),
	$("#objects .status").val('1,2,3,4,5,6,7,8'),
	$("#objects .valued").val('0,1'),
	get_objects(limit_object, 0);
    });
    $(document).on('change', '#perpage_objects', function(){
	limit_object = $("#perpage_objects").val();
	get_objects(limit_object, 0);
    });
    $(document).on('click', '#pagination_object .page-link', function(){
	page = $(this).attr('data-page');
	get_objects(limit_object, (page - 1) * limit_object);
    });
});
</script> 