<h2 class="tab-title"><? echo Translations::gi()->project_managers; ?></h2>
<a href="/create_project_manager" class="btn btn-sm btn-success" title="<? echo Translations::gi()->create_project_manager; ?>"><i class="fa fa-plus"></i></a>
<div class="row">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
		<p><? echo Translations::gi()->see_as; ?>
			<select class="form-control" id="perpage_project_manager" style="width: 100px;">
				<option value="10" selected>10</option>
				<option value="20">20</option>
				<option value="50">50</option>
			</select>
		</p>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<table class="table table-sm" id="project_managers">
		</table>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_project_manager">
	</div>
</div>
<script type="text/javascript">
$(function(){
	function getPMcnt()
	{
		$.ajax({
			url: '/remart/get_project_managers_count',
			method: 'get',
			dataType: 'json',
			success: function(data) {
				pages = (data.cnt % $("#perpage_project_manager").val()) ? Math.floor(data.cnt / $("#perpage_project_manager").val()) + 1 : Math.floor(data.cnt / $("#perpage_project_manager").val());
				pagination = '';
				for (i = 1; i <= pages; i++)
				{
					pagination += '<li class="page-item"><a class="page-link" data-page="' + i + '">' + i + '</a></li>';
				}
				pagination = '<ul class="pagination">' + pagination + '</ul>';
				$("#pagination_project_manager").html(pagination);
				getPM(1);
			}
		});
	}
	function getPM(page)
	{
		$.ajax({
			url: '/remart/get_project_managers',
			method: 'get',
			dataType: 'json',
			data: {
				perpage: $("#perpage_project_manager").val(),
				page: page
			},
			success: function(data) {
				$("#project_managers").html('<tr><th>ID</th><th>E-mail</th><th><? echo Translations::gi()->name; ?></th><th><? echo Translations::gi()->surname; ?></th><th><? echo Translations::gi()->patronymic; ?></th><th></th><th></th></tr>');
				for (i in data)
				{
					if (data[i].validated == 1) activation = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->lock; ?>"><i class="fa fa-lock"></i></button>';
					else activation = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->unlock; ?>"><i class="fa fa-unlock"></i></button>';
					$("#project_managers").append('<tr><td>' + data[i].id + '</td><td>' + data[i].login + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_project_manager?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activation + '</td></tr>');
				}
				$('#pagination_project_manager .page-item').removeClass('active');
				$($('#pagination_project_manager .pagination')[0].childNodes[page - 1]).addClass('active');
			}
		});
	}
	getPMcnt();
	$(document).on('click', '#pagination_project_manager .page-link', function(){
		page = $(this).attr('data-page');
		getPM(page);
	});
	$(document).on('change', '#perpage_project_manager', function(){
		getPMcnt();
	});
});
</script>