<h2 class="tab-title"><? echo Translations::gi()->rieltors; ?></h2>
<a href="/create_realtor" class="btn btn-sm btn-success" title="Создать риелтора"><i class="fa fa-plus"></i></a>
<div class="row">	
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
		<p><? echo Translations::gi()->see_as; ?>
			<select class="form-control" id="perpage_realtors" style="width: 100px;">
				<option value="10" selected>10</option>
				<option value="20">20</option>
				<option value="50">50</option>
			</select>
		</p>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<table class="table table-sm" id="realtors">
		</table>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_realtors">
	</div>
</div>
<script type="text/javascript">
$(function(){
	function getRealtorcnt()
	{
		$.ajax({
			url: '/remart/get_realtors_count',
			method: 'get',
			dataType: 'json',
			success: function(data) {
				pages = (data.cnt % $("#perpage_realtors").val()) ? Math.floor(data.cnt / $("#perpage_realtors").val()) + 1 : Math.floor(data.cnt / $("#perpage_realtors").val());
				pagination = '';
				for (i = 1; i <= pages; i++)
				{
					pagination += '<li class="page-item"><a class="page-link" data-page="' + i + '">' + i + '</a></li>';
				}
				pagination = '<ul class="pagination">' + pagination + '</ul>';
				$("#pagination_realtors").html(pagination);
				getRealtor(1);
			}
		});
	}
	function getRealtor(page)
	{ console.log("!");
		$.ajax({
			url: '/remart/get_realtors',
			method: 'get',
			dataType: 'json',
			data: {
				perpage: $("#perpage_realtors").val(),
				page: page
			},
			success: function(data) {
				$("#realtors").html('<tr><th>ID</th><th>E-mail</th><th><? echo Translations::gi()->company_name; ?></th><th><? echo Translations::gi()->name; ?></th><th><? echo Translations::gi()->surname; ?></th><th><? echo Translations::gi()->patronymic; ?></th><th></th><th></th></tr>');
				<? if ($item->role_id == 2) { ?>
				for (i in data)
				{
					if (data[i].validated != 1) activate = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
					else activate = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
					$("#realtors").append('<tr><td>' + data[i].id + '</td><td>' + data[i].login + '</td><td>' + data[i].company_name + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_realtor?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activate + '</td></tr>');
				}
				<? } else { ?>
				for (i in data)
				{
					$("#realtors").append('<tr><td>' + data[i].id + '</td><td>' + data[i].login + '</td><td>' + data[i].company_name + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_realtor?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td></tr>');
				}
				<? } ?>
				$('#pagination_realtors .page-item').removeClass('active');
				$($('#pagination_realtors .pagination')[0].childNodes[page - 1]).addClass('active');
			}
		});
	}
	getRealtorcnt();
	$(document).on('click', '#pagination_realtors .page-link', function(){
		page = $(this).attr('data-page');
		getRealtor(page);
	});
	$(document).on('change', '#perpage_realtors', function(){
		getRealtorcnt();
	});
});
</script>