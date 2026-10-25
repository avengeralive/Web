<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<? if ($permissions['banks']->create) { ?>
	<a href="/create_bank" class="btn btn-sm btn-success addnew" title="<? echo Translations::gi()->create_bank; ?>"><i class="fa fa-plus"></i> <? echo Translations::gi()->create_bank; ?></a>
	<? } ?>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
	<p><? echo Translations::gi()->see_as; ?>
	    <select class="form-control" id="perpage_banks" style="width: 100px;">
		<option value="10" selected>10</option>
		<option value="20">20</option>
		<option value="50">50</option>
	    </select>
	</p>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	<table class="table table-sm" id="banks">
	    <thead>
		<tr class="tableheaders">
		    <th>ID</th>
		    <th><? echo Translations::gi()->bank_name; ?></th>
		    <th><? echo Translations::gi()->active_buyer; ?>Активные покупатели</th>
		    <th><? echo Translations::gi()->status; ?></th>
		    <th></th>
		</tr>
		<tr>
		    <th><input type="text" class="form-control id"></th>
		    <th>
			<input type="text" class="form-control name">
		    </th>
		    <th></th>
		    <th>
			<select class="form-control status">
			    <option value="0,1">All</option>
			    <option value="1">Active</option>
			    <option value="0">Deactive</option>
			</select>
		    </th>
		    <th>
			<button class="btn search"><i class="fa fa-search"></i></button>
			<button class="btn btn-danger reset"><i class="fa fa-ban"></i></button>
		    </th>
		</tr>
	    </thead>
	    <tbody id="table_body_banks"></tbody>
	</table>
    </div>
    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_bank">
    </div>
</div>
<script type="text/javascript">
$(function(){
    var limit_bank = $("#perpage_banks").val();
    get_banks(limit_bank, 0);
    function get_banks(limit, offset)
    {	
	$.ajax({
	    url: '/remart/get_banks',
	    method: 'get',
	    dataType: 'json',
	    data: {
		limit: limit,
		offset: offset,
		id: $("#banks .id").val(),
		name: $("#banks .name").val(),
		status: $("#banks .status").val(),
		sort: 'id'
	    },
	    success: function(data) {
		$("#table_body_banks").html('');
		var status = [];
		var valuation = [];
		var type = [];
		var ztype = [];
		status[0] = 'deactive';
		status[1] = 'active';
		for (i in data.data)
		{
		    $("#table_body_banks").append('<tr><td>' + data.data[i].id + '</td><td>' + data.data[i].name + '</td><td>' + data.data[i].buyers + '</td><td>' + status[data.data[i].status] + '</td><td><a href="/bank?id=' + data.data[i].id + '" class="btn view">Подробнее</a></td></tr>');
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
		$("#pagination_bank").html(pagination_container);
	    }
	});
    }
    $(document).on('click', '#banks .search', function(){
	get_banks(limit_bank, 0);
    });
    $(document).on('click', '#banks .reset', function(){
	$("#banks .id").val('');
	$("#banks .name").val('');
	$("#banks .status").val('0,1');
	get_banks(limit_bank, 0);
    });
    $(document).on('change', '#perpage_banks', function(){
	limit_bank = $("#perpage_banks").val();
	get_banks(limit_bank, 0);
    });
    $(document).on('click', '#pagination_bank .page-link', function(){
	page = $(this).attr('data-page');
	get_banks(limit_bank, (page - 1) * limit_bank);
    });
});
</script> 