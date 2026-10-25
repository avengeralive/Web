<h2 class="tab-title"><? echo Translations::gi()->credit_specialists; ?></h2>
<a href="/create_credit_specialist" class="btn btn-sm btn-success" title="<? echo Translations::gi()->create_credit_specialist; ?>"><i class="fa fa-plus"></i></a>
<div class="row">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
		<p><? echo Translations::gi()->see_as; ?>
			<select class="form-control" id="perpage_creditspecialists" style="width: 100px;">
				<option value="10" selected>10</option>
				<option value="20">20</option>
				<option value="50">50</option>
			</select>
		</p>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
		<table class="table table-sm" id="creditspecialists">
		</table>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_creditspecialists">
	</div>
</div>
<script type="text/javascript">
$(function(){
	function getCreditSpecCnt()
	{
		$.ajax({
			url: '/remart/get_credit_specialists_count',
			method: 'get',
			dataType: 'json',
			success: function(data) {
				pages = (data.cnt % $("#perpage_creditspecialists").val()) ? Math.floor(data.cnt / $("#perpage_creditspecialists").val()) + 1 : Math.floor(data.cnt / $("#perpage_creditspecialists").val());
				pagination = '';
				for (i = 1; i <= pages; i++)
				{
					pagination += '<li class="page-item"><a class="page-link" data-page="' + i + '">' + i + '</a></li>';
				}
				pagination = '<ul class="pagination">' + pagination + '</ul>';
				$("#pagination_creditspecialists").html(pagination);
				getCreditSpec(1);
			}
		});
	}
	function getCreditSpec(page)
	{
		$.ajax({
			url: '/remart/get_credit_specialists',
			method: 'get',
			dataType: 'json',
			data: {
				perpage: $("#perpage_creditspecialists").val(),
				page: page
			},
			success: function(data) {
				$("#creditspecialists").html('<tr><th>ID</th><th>E-mail</th><th><? echo Translations::gi()->name; ?></th><th><? echo Translations::gi()->surname; ?></th><th><? echo Translations::gi()->patronymic; ?></th><th></th><th></th></tr>');
				<? if ($item->role_id == 2) { ?>
				for (i in data)
				{
					if (data[i].validated != 1) activate = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
					else activate = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
					$("#creditspecialists").append('<tr><td>' + data[i].id + '</td><td>' + data[i].login + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_credit_specialist?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activate + '</td></tr>');
				}
				<? } else { ?>
				for (i in data)
				{
					$("#creditspecialists").append('<tr><td>' + data[i].id + '</td><td>' + data[i].login + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_credit_specialist?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td></tr>');
				}
				<? } ?>
				$('#pagination_creditspecialists .page-item').removeClass('active');
				$($('#pagination_creditspecialists .pagination')[0].childNodes[page - 1]).addClass('active');
			}
		});
	}
	getCreditSpecCnt();
	$(document).on('click', '#pagination_creditspecialists .page-link', function(){
		page = $(this).attr('data-page');
		getCreditSpec(page);
	});
	$(document).on('change', '#perpage_creditspecialists', function(){
		getCreditSpecCnt();
	});
});
</script>