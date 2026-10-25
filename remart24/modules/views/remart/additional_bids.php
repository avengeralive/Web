<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<? if ($permissions['bids']->create) { ?>
	<a href="/create_bid" class="btn btn-sm btn-success addnew" title="<? echo Translations::gi()->create_bid; ?>"><i class="fa fa-plus"></i> <? echo Translations::gi()->create_bid; ?></a>
	<? } ?>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
	<p><? echo Translations::gi()->see_as; ?>
	    <select class="form-control" id="perpage_bids" style="width: 100px;">
		<option value="10" selected>10</option>
		<option value="20">20</option>
		<option value="50">50</option>
	    </select>
	</p>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<table class="table table-sm" id="bids">
	    <thead>
		<tr class="tableheaders">
		    <th>ID</th>
		    <th><? echo Translations::gi()->buyer; ?></th>
		    <th><? echo Translations::gi()->type_obr; ?>Тип заявки</th>
		    <th><? echo Translations::gi()->object_type; ?></th>
		    <th><? echo Translations::gi()->room; ?></th>
		    <th><? echo Translations::gi()->max_price; ?>Цена (макс.)</th>
		    <th><? echo Translations::gi()->city; ?></th>
		    <th><? echo Translations::gi()->region; ?></th>
		    <th><? echo Translations::gi()->status; ?></th>
		    <th></th>
		</tr>
		<tr>
		    <th><input type="text" class="form-control id"></th>
		    <th>
			<? foreach ($bidbuyers as $buyer) { $ba[] = $buyer->id; }?>
			<select class="form-control buyer">
			    <option value="<? echo implode(',', $ba); ?>"><? echo Translations::gi()->all; ?></option>
			    <? foreach ($bidbuyers as $buyer) { ?>
			    <option value="<? echo $buyer->id; ?>"><? echo $buyer->name; ?> <? echo $buyer->surname; ?></option>
			    <? } ?>
			</select>
		    </th>
		    <th>
			<select class="form-control type_obr">
			    <option value="">Все</option>
			    <option value="1">Подбор</option>
			</select>
		    </th>
		    <th>
			<div class="btn-group" style="width: 100%;">
			    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->object_type; ?></button>
			    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
				<label style="width:100%"><input type="checkbox" name="type" class="type" value="0"><? echo Translations::gi()->all ?></label>
				<label style="width:100%"><input type="checkbox" name="type" class="type" value="1"><? echo Translations::gi()->new_build ?></label>
				<label style="width:100%"><input type="checkbox" name="type" class="type" value="2"><? echo Translations::gi()->old_build ?></label>
				<label style="width:100%"><input type="checkbox" name="type" class="type" value="3"><? echo Translations::gi()->private_h ?></label>
			    </div>
			</div>
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
			<input type="text" style="width: 50%; float:left;" class="form-control price_min" placeholder="min">
			<input type="text" style="width: 50%; float:left;" class="form-control price_max" placeholder="max">
		    </th>
		    <th>
			<div class="btn-group" style="width: 100%;">
			    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->city; ?></button>
			    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff; height: 300px; overflow: scroll;">
			    <? foreach ($cities as $city) { ?>
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
		    <!--<th>
			<div class="btn-group" style="width: 100%;">
			    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->metro; ?></button>
			    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
			    <? foreach ($objmetro as $metro) { ?>
				<label style="width:100%"><input type="checkbox" name="metro" class="metro" value="<? echo $metro->id; ?>"><? echo $metro->name; ?></label>
			    <? } ?>
			    </div>
			</div>
		    </th>-->
		    <th>
			<select class="form-control status">
			    <option value="%">All</option>
			    <option value="0">Pending</option>
			    <option value="1">Active</option>
			    <option value="2">Closed</option>
			</select>
		    </th>
		    <th>
			<button class="btn search"><i class="fa fa-search"></i></button>
			<button class="btn btn-danger reset"><i class="fa fa-ban"></i></button>
		    </th>
		</tr>
	    </thead>
	    <tbody id="table_body_bids"></tbody>
	</table>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_bid">
    </div>
</div>
<style>
<? if ($item->role_id == 5) { ?>
#bids td:nth-child(2), #bids th:nth-child(2) { display: none; }	
#bids td:nth-child(9), #bids th:nth-child(9) { display: none; }	
<? } ?>
</style>
<script type="text/javascript">
$(function(){
    var limit_bid = $("#perpage_bids").val();
    get_bids(limit_bid, 0);
    function get_bids(limit, offset)
    {
	var room = [];
	for (i = 1; i<=10; i++) if ($("#bids .room[value=" + i + "]").prop("checked")) room.push(i);
	room = room.join();
	var city = [];
	$("#bids .city").each(function(i, v) {
	    if ($(v).prop("checked")) city.push($(v).val());
	});
	city = city.join();
	var region = [];
	$("#bids .region").each(function(i, v) {
	    if ($(v).prop("checked")) region.push($(v).val());
	});
	region = region.join();
	var metro = [];
	$("#bids .metro").each(function(i, v) {
	    if ($(v).prop("checked")) metro.push($(v).val());
	});
	metro = metro.join();
	
	var type = [];
	$("#bids .type").each(function(i, v) {
	    if ($(v).prop("checked")) type.push($(v).val());
	});
	type = type.join();
	if (type == '') type = '0,1,2,3';
	
	$.ajax({
	    url: '/remart/get_bids',
	    method: 'get',
	    dataType: 'json',
	    data: {
		limit: limit,
		offset: offset,
		id: $("#bids .id").val(),
		buyer: $("#bids .buyer").val(),
		bidtype: $("#bids .bidtype").val(),
		room: room,
		price_min: ($("#bids .price_min").val() == "") ? 0 : $("#bids .price_min").val(),
		price_max: ($("#bids .price_max").val() == "") ? 1000000000 : $("#bids .price_max").val(),
		city: city,
		region: region,
		metro: metro,
		type: type,
		status: $("#bids .status").val(),
		valued: $("#bids .valued").val(),
		sort: 'o.status ASC, o.id DESC',
		search: '%'
		/*id: $("#<? echo $user_groups; ?> .id").val(),
		name: $("#<? echo $user_groups; ?> .name").val(),
		company_name: $("#<? echo $user_groups; ?> .company_name").val(),
		phone: $("#<? echo $user_groups; ?> .phone").val(),
		email: $("#<? echo $user_groups; ?> .email").val(),
		bids_min: ($("#<? echo $user_groups; ?> .bids_min").val() == "") ? 0 : $("#<? echo $user_groups; ?> .bids_min").val(),
		bids_max: ($("#<? echo $user_groups; ?> .bids_max").val() == "") ? 1000000000 : $("#<? echo $user_groups; ?> .bids_max").val(),
		buyers_min: ($("#<? echo $user_groups; ?> .buyers_min").val() == "") ? 0 : $("#<? echo $user_groups; ?> .buyers_min").val(),
		buyers_max: ($("#<? echo $user_groups; ?> .buyers_max").val() == "") ? 1000000000 : $("#<? echo $user_groups; ?> .buyers_max").val(),
		role_id: <? echo $user_role; ?>,
		status: $("#<? echo $user_groups; ?> .status").val(),
		company: <? echo $company; ?>*/
	    },
	    success: function(data) {
		$("#table_body_bids").html('');
		var status = [];
		var valuation = [];
		var type = [];
		var ztype = [];
		status[0] = 'pending';
		status[1] = 'active';
		status[2] = 'closed';
		type[1] = 'Квартира';
		type[2] = 'Частный дом';
		ztype[0] = 'подбор';
		for (i in data.data)
		{
		    if (data.data[i].valued_obj == 0) valued_stat = valuation[1];
		    else valued_stat = valuation[2];
		    if (data.data[i].status == 0) $("#table_body_bids").append('<tr class="text-info"><td>' + data.data[i].id + '</td><td>' + data.data[i].buyer + '</td><td>' + ztype[data.data[i].bidtype] + '</td><td>' + data.data[i].type + '</td><td>' + data.data[i].room + '</td><td>' + data.data[i].price_max + '</td><td>' + data.data[i].city + '</td><td>' + data.data[i].region + '</td><td>' + status[data.data[i].status] + '</td><td><a href="/bid?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
		    else if (data.data[i].status == 1) $("#table_body_bids").append('<tr class="text-success"><td>' + data.data[i].id + '</td><td>' + data.data[i].buyer + '</td><td>' + ztype[data.data[i].bidtype] + '</td><td>' + data.data[i].type + '</td><td>' + data.data[i].room + '</td><td>' + data.data[i].price_max + '</td><td>' + data.data[i].city + '</td><td>' + data.data[i].region + '</td><td>' + status[data.data[i].status] + '</td><td><a href="/bid?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
		    else if (data.data[i].status == 2) $("#table_body_bids").append('<tr class="text-danger"><td>' + data.data[i].id + '</td><td>' + data.data[i].buyer + '</td><td>' + ztype[data.data[i].bidtype] + '</td><td>' + data.data[i].type + '</td><td>' + data.data[i].room + '</td><td>' + data.data[i].price_max + '</td><td>' + data.data[i].city + '</td><td>' + data.data[i].region + '</td><td>' + status[data.data[i].status] + '</td><td><a href="/bid?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
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
		$("#pagination_bid").html(pagination_container);
	    }
	});
    }
    $(document).on('click', '#bids .search', function(){
	get_bids(limit_bid, 0);
    });
    $(document).on('click', '#bids .reset', function(){
	$("#bids .id").val('');
	$("#bids .type_obr").val('');
	$("#bids .room").prop('checked', false);
	$("#bids .city").prop('checked', false);
	$("#bids .price_min").val('');
	$("#bids .price_max").val('');
	$("#bids .region").prop('checked', false);
	$("#bids .status").val('%');
	$("#bids .buyer").val($("#bids .buyer:first").val()),
	get_bids(limit_bid, 0);
    });
    $(document).on('change', '#perpage_bids', function(){
	limit_bid = $("#perpage_bids").val();
	get_bids(limit_bid, 0);
    });
    $(document).on('click', '#pagination_bid .page-link', function(){
	page = $(this).attr('data-page');
	get_bids(limit_bid, (page - 1) * limit_bid);
    });
});
</script> 