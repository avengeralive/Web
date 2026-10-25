<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<? if ($permissions[$user_groups]->create) { ?>
	<a href="/<? echo $user_create; ?>" class="btn btn-sm btn-success addnew" title="<? echo Translations::gi()->$user_create; ?>"><i class="fa fa-plus"></i> <? echo Translations::gi()->$user_create; ?></a>
	<? } ?>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
	<p><? echo Translations::gi()->see_as; ?>
	    <select class="form-control" id="perpage_<? echo $user_groups; ?>" style="width: 100px;">
		<option value="10" selected>10</option>
		<option value="20">20</option>
		<option value="50">50</option>
	    </select>
	</p>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<table class="table table-sm" id="<? echo $user_groups; ?>">
	    <thead>
		<tr class="tableheaders">
		    <th>ID</th>
		    <th><? echo Translations::gi()->name; ?></th>
		    <th><? echo Translations::gi()->company_name; ?></th>
		    <th><? echo Translations::gi()->bank; ?></th>
		    <th><? echo Translations::gi()->phone; ?></th>
		    <th>E-mail</th>
		    <th><? echo Translations::gi()->objects; ?></th>
		    <th><? echo Translations::gi()->buyers; ?></th>
		    <th><? echo Translations::gi()->credit_specialist; ?></th>
		    <th><? echo Translations::gi()->favorites; ?></th>
		    <th><? echo Translations::gi()->bids; ?></th>
		    <th><? echo Translations::gi()->status; ?></th>
		    <th></th>
		</tr>
		<tr>
		    <th><input type="text" class="form-control id"></th>
		    <th><input type="text" class="form-control name"></th>
		    <th><input type="text" class="form-control company_name"></th>
		    <th>
			<select class="form-control bank">
			    <option value="">---</option>
			    <option value="0">Remart</option>
			<? foreach ($banks as $bank) { ?>   
			    <option value="<? echo $bank->id; ?>"><? echo $bank->name; ?></option>
			<? } ?>
			</select>
		    </th>
		    <th><input type="text" class="form-control phone"></th>
		    <th><input type="text" class="form-control email"></th>
		    <th>
			<input type="text" style="width:50%; float:left;" class="form-control objects_min" placeholder="min">
			<input type="text" style="width:50%; float:left;" class="form-control objects_max" placeholder="max">
		    </th>
		    <th>
			<input type="text" style="width:50%; float:left;" class="form-control buyers_min" placeholder="min">
			<input type="text" style="width:50%; float:left;" class="form-control buyers_max" placeholder="max">
		    </th>
		    <th>
			<select class="form-control reg_by">
			    <option value="<? echo $permissions['parameters']->credit_specialist; ?>">All</option>
			    <? foreach ($cs as $user) { ?>
			    <option value="<? echo $user->id; ?>"><? echo $user->name; ?> <? echo $user->surname; ?></option>
			    <? } ?>
			</select>
		    </th>
		    <th></th>
		    <th></th>
		    <th>
			<select class="form-control status">
			    <option value="">All</option>
			    <option value="1">Active</option>
			    <option value="2">Deactive</option>
			</select>
		    </th> 
		    <th>
			<button class="btn search"><i class="fa fa-search"></i></button>
			<button class="btn btn-danger reset"><i class="fa fa-ban"></i></button>
		    </th>
		</tr>
	    </thead>
	    <tbody id="table_body_<? echo $user_groups; ?>"></tbody>
	</table>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_<? echo $user_group; ?>">
    </div>
</div>
<script type="text/javascript">
$(function(){
    var limit_<? echo $user_group; ?> = $("#perpage_<? echo $user_groups; ?>").val();
    get_<? echo $user_groups; ?>(limit_<? echo $user_group; ?>, 0);
    function get_<? echo $user_groups; ?>(limit, offset)
    {
	$.ajax({
	    url: '/remart/get_users',
	    method: 'get',
	    dataType: 'json',
	    data: {
		limit: limit,
		offset: offset,
		reg_by: $("#<? echo $user_groups; ?> .reg_by").val(),
		id: $("#<? echo $user_groups; ?> .id").val(),
		name: $("#<? echo $user_groups; ?> .name").val(),
		company_name: $("#<? echo $user_groups; ?> .company_name").val(),
		phone: $("#<? echo $user_groups; ?> .phone").val(),
		email: $("#<? echo $user_groups; ?> .email").val(),
		bank: $("#<? echo $user_groups; ?> .bank").val(),
		objects_min: ($("#<? echo $user_groups; ?> .objects_min").val() == "") ? 0 : $("#<? echo $user_groups; ?> .objects_min").val(),
		objects_max: ($("#<? echo $user_groups; ?> .objects_max").val() == "") ? 1000000000 : $("#<? echo $user_groups; ?> .objects_max").val(),
		buyers_min: ($("#<? echo $user_groups; ?> .buyers_min").val() == "") ? 0 : $("#<? echo $user_groups; ?> .buyers_min").val(),
		buyers_max: ($("#<? echo $user_groups; ?> .buyers_max").val() == "") ? 1000000000 : $("#<? echo $user_groups; ?> .buyers_max").val(),
		role_id: <? echo $user_role; ?>,
		status: $("#<? echo $user_groups; ?> .status").val(),
		company: <? echo $company; ?>,
		pm: '<? echo $permissions['parameters']->pm; ?>'
	    },
	    success: function(data) {
		$("#table_body_<? echo $user_groups; ?>").html('');
		var status = [];
		status[0] = 'new user (deactive)';
		status[1] = 'active';
		status[2] = 'deactive';
		for (i in data.data)
		{
		    bid = [];
		    for (j in data.data[i].bids) bid.push("<a href='/bid?id=" + data.data[i].bids[j].id + "'>" + data.data[i].bids[j].id + "</a>");
		    bid = bid.join(', ');
			if (data.data[i].validated == 1) $("#table_body_<? echo $user_groups; ?>").append('<tr class="text-success"><td>' + data.data[i].id + '</td><td>' + data.data[i].name + ' ' + data.data[i].surname + ' ' + data.data[i].patronymic + '</td><td>' + data.data[i].company_name + '</td><td>' + data.data[i].bank + '</td><td>' + data.data[i].mobile + '</td><td>' + data.data[i].email + '</td><td><a href="/objects?realtor=' + data.data[i].id + '">' + data.data[i].user_objects + '</a></td><td>' + data.data[i].user_buyers + '</td><td>' + data.data[i].reg_by + '</td><td><a href="/favorites?user=' + data.data[i].id + '">' + data.data[i].favorites + '</a></td><td>' + bid + '</td><td>' + status[data.data[i].validated] + '</td><td><a href="/<? echo $user_group; ?>?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
			else $("#table_body_<? echo $user_groups; ?>").append('<tr class="text-danger"><td>' + data.data[i].id + '</td><td>' + data.data[i].name + ' ' + data.data[i].surname + ' ' + data.data[i].patronymic + '</td><td>' + data.data[i].company_name + '</td><td>' + data.data[i].bank + '</td><td>' + data.data[i].mobile + '</td><td>' + data.data[i].email + '</td><td><a href="/objects?realtor=' + data.data[i].id + '">' + data.data[i].user_objects + '</a></td><td>' + data.data[i].user_buyers + '</td><td>' + data.data[i].reg_by + '</td><td><a href="/favorites?user=' + data.data[i].id + '">' + data.data[i].favorites + '</a></td><td>' + bid + '</td><td>' + status[data.data[i].validated] + '</td><td><a href="/<? echo $user_group; ?>?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
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
		$("#pagination_<? echo $user_group; ?>").html(pagination_container);
	    }
	});
    }
    $(document).on('click', '#<? echo $user_groups; ?> .search', function(){
	get_<? echo $user_groups; ?>(limit_<? echo $user_group; ?>, 0);
    }); 
    $(document).on('click', '#<? echo $user_groups; ?> .reset', function(){
	$("#<? echo $user_groups; ?> .id").val('');
	$("#<? echo $user_groups; ?> .name").val('');
	$("#<? echo $user_groups; ?> .phone").val('');
	$("#<? echo $user_groups; ?> .email").val('');
	$("#<? echo $user_groups; ?> .status").val('');
	$("#<? echo $user_groups; ?> .reg_by").val('%');
	get_<? echo $user_groups; ?>(limit_<? echo $user_group; ?>, 0);
    });
    $(document).on('change', '#perpage_<? echo $user_groups; ?>', function(){
	limit_<? echo $user_group; ?> = $("#perpage_<? echo $user_groups; ?>").val();
	get_<? echo $user_groups; ?>(limit_<? echo $user_group; ?>, 0);
    });
    $(document).on('click', '#pagination_<? echo $user_group; ?> .page-link', function(){
	page = $(this).attr('data-page');
	get_<? echo $user_groups; ?>(limit_<? echo $user_group; ?>, (page - 1) * limit_<? echo $user_group; ?>);
    });
});
</script>