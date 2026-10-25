<h2 class="tab-title"><? echo Translations::gi()->buyers; ?></h2>
<? if ($item->role_id == 2 || $item->role_id == 5) { ?>
<a href="/create_buyer" class="btn btn-sm btn-success" title="<? echo Translations::gi()->create_buyer; ?>"><i class="fa fa-plus"></i></a>
<? } ?>
<div class="row">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
		<p><? echo Translations::gi()->see_as; ?>
			<select class="form-control" id="perpage_buyer" style="width: 100px;">
				<option value="10" selected>10</option>
				<option value="20">20</option>
				<option value="50">50</option>
			</select>
		</p>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
		<table class="table table-sm" id="buyer">
		</table>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_buyer">
	</div>
</div>
<script type="text/javascript">
$(function(){
	function getBuyerCnt()
	{
		<? if ($item->role_id == 2 || $item->role_id == 3) { ?>
		$.ajax({
			url: '/remart/get_buyers_count',
			method: 'get',
			dataType: 'json',
			success: function(data) {
				pages = (data.cnt % $("#perpage_buyer").val()) ? Math.floor(data.cnt / $("#perpage_buyer").val()) + 1 : Math.floor(data.cnt / $("#perpage_buyer").val());
				pagination = '';
				for (i = 1; i <= pages; i++)
				{
					pagination += '<li class="page-item"><a class="page-link" data-page="' + i + '">' + i + '</a></li>';
				}
				pagination = '<ul class="pagination">' + pagination + '</ul>';
				$("#pagination_buyer").html(pagination);
				getBuyer(1);
			}
		});
		<? } ?>
		<? if ($item->role_id == 5) { ?>
		$.ajax({
			url: '/remart/get_my_buyers_count',
			method: 'get',
			dataType: 'json',
			success: function(data) {
				pages = (data.cnt % $("#perpage_buyer").val()) ? Math.floor(data.cnt / $("#perpage_buyer").val()) + 1 : Math.floor(data.cnt / $("#perpage_buyer").val());
				pagination = '';
				for (i = 1; i <= pages; i++)
				{
					pagination += '<li class="page-item"><a class="page-link" data-page="' + i + '">' + i + '</a></li>';
				}
				pagination = '<ul class="pagination">' + pagination + '</ul>';
				$("#pagination_buyer").html(pagination);
				getBuyer(1);
			}
		});
		<? } ?>
	}
	function getBuyer(page)
	{
		<? if ($item->role_id == 2) { ?>
		$.ajax({
			url: '/remart/get_buyers',
			method: 'get',
			dataType: 'json',
			data: {
				perpage: $("#perpage_buyer").val(),
				page: page
			},
			success: function(data) {
				$("#buyer").html('<tr><th>ID</th><th><? echo Translations::gi()->name; ?></th><th><? echo Translations::gi()->surname; ?></th><th><? echo Translations::gi()->patronymic; ?></th><th>Mob</th><th>Favorite</th><th></th><th></th><th></th></tr>');
				for (i in data)
				{
					if (data[i].validated != 1) activate = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
					else activate = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
					fav = '';
					for (j in data[i].favorites) fav += '<a href="/view?id=' + data[i].favorites[j].id + '">' + data[i].favorites[j].id + '</a> ';
					$("#buyer").append('<tr><td>' + data[i].id + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td>' + data[i].mobile + '</td><td>' + fav + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_buyer?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activate + '</td></tr>');
				}
				$('#pagination_buyer .page-item').removeClass('active');
				$($('#pagination_buyer .pagination')[0].childNodes[page - 1]).addClass('active');
			}
		});
		<? } ?>
		<? if ($item->role_id == 3) { ?>
		$.ajax({
			url: '/remart/get_buyers',
			method: 'get',
			dataType: 'json',
			data: {
				perpage: $("#perpage_buyer").val(),
				page: page
			},
			success: function(data) {
				$("#buyer").html('<tr><th>ID</th><th><? echo Translations::gi()->name; ?></th><th><? echo Translations::gi()->surname; ?></th><th><? echo Translations::gi()->patronymic; ?></th><th>Mob</th><th>Favorite</th><th></th><th></th><th></th></tr>');
				for (i in data)
				{
					if (data[i].validated != 1) activate = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
					else activate = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
					fav = '';
					for (j in data[i].favorites) fav += '<a href="/view?id=' + data[i].favorites[j].id + '">' + data[i].favorites[j].id + '</a> ';
					$("#buyer").append('<tr><td>' + data[i].id + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td>' + data[i].mobile + '</td><td>' + fav + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_buyer?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activate + '</td></tr>');
				}
				$('#pagination_buyer .page-item').removeClass('active');
				$($('#pagination_buyer .pagination')[0].childNodes[page - 1]).addClass('active');
			}
		});
		<? } ?>
		<? if ($item->role_id == 5) { ?>
		$.ajax({
			url: '/remart/get_my_buyers',
			method: 'get',
			dataType: 'json',
			data: {
				perpage: $("#perpage_buyer").val(),
				page: page
			},
			success: function(data) {
				$("#buyer").html('<tr><th>ID</th><th><? echo Translations::gi()->name; ?></th><th><? echo Translations::gi()->surname; ?></th><th><? echo Translations::gi()->patronymic; ?></th><th>Mob</th><th></th><th></th></tr>');
				for (i in data)
				{
					$("#buyer").append('<tr><td>' + data[i].id + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td>' + data[i].mobile + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_buyer?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td></tr>');
				}
				$('#pagination_buyer .page-item').removeClass('active');
				$($('#pagination_buyer .pagination')[0].childNodes[page - 1]).addClass('active');
			}
		});
		<? } ?>
	}
	getBuyerCnt();
	$(document).on('click', '#pagination_buyer .page-link', function(){
		page = $(this).attr('data-page');
		getBuyer(page);
	});
	$(document).on('change', '#perpage_buyer', function(){
		getBuyerCnt();
	});
});
</script>