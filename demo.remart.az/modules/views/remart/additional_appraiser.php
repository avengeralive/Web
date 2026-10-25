<h2 class="tab-title"><? echo Translations::gi()->appraisers; ?></h2>
<a href="/create_appraiser" class="btn btn-sm btn-success" title="<? echo Translations::gi()->create_appraiser; ?>"><i class="fa fa-plus"></i></a>
<div class="row">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
		<p><? echo Translations::gi()->see_as; ?>
			<select class="form-control" id="perpage_appraiser" style="width: 100px;">
				<option value="10" selected>10</option>
				<option value="20">20</option>
				<option value="50">50</option>
			</select>
		</p>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
		<table class="table table-sm" id="appraiser">
		</table>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_appraiser">
	</div>
</div>
<script type="text/javascript">
$(function(){
	function getAppraiserCnt()
	{
		$.ajax({
			url: '/remart/get_appraisers_count',
			method: 'get',
			dataType: 'json',
			success: function(data) {
				pages = (data.cnt % $("#perpage_appraiser").val()) ? Math.floor(data.cnt / $("#perpage_appraiser").val()) + 1 : Math.floor(data.cnt / $("#perpage_appraiser").val());
				pagination = '';
				for (i = 1; i <= pages; i++)
				{
					pagination += '<li class="page-item"><a class="page-link" data-page="' + i + '">' + i + '</a></li>';
				}
				pagination = '<ul class="pagination">' + pagination + '</ul>';
				$("#pagination_appraiser").html(pagination);
				getAppraiser(1);
			}
		});
	}
	function getAppraiser(page)
	{
		$.ajax({
			url: '/remart/get_appraisers',
			method: 'get',
			dataType: 'json',
			data: {
				perpage: $("#perpage_appraiser").val(),
				page: page
			},
			success: function(data) {
				$("#appraiser").html('<tr><th>ID</th><th>E-mail</th><th><? echo Translations::gi()->company_name; ?></th><th></th><th></th></tr>');
				<? if ($item->role_id == 2) { ?>
				for (i in data)
				{
					if (data[i].validated != 1) activate = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
					else activate = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
					$("#appraiser").append('<tr><td>' + data[i].id + '</td><td>' + data[i].email + '</td><td>' + data[i].company_name + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_appraiser?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activate + '</td></tr>');
				}
				<? } else { ?>
				for (i in data)
				{
					$("#appraiser").append('<tr><td>' + data[i].id + '</td><td>' + data[i].email + '</td><td>' + data[i].company_name + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_appraiser?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td></tr>');
				}
				<? } ?>
				$('#pagination_appraiser .page-item').removeClass('active');
				$($('#pagination_appraiser .pagination')[0].childNodes[page - 1]).addClass('active');
			}
		});
	}
	getAppraiserCnt();
	$(document).on('click', '#pagination_appraiser .page-link', function(){
		page = $(this).attr('data-page');
		getAppraiser(page);
	});
	$(document).on('change', '#perpage_appraiser', function(){
		getAppraiserCnt();
	});
});
</script>