<h2 class="tab-title"><? echo Translations::gi()->banks; ?></h2>
<a href="/create_bank" class="btn btn-sm btn-success" title="<? echo Translations::gi()->create_bank; ?>"><i class="fa fa-plus"></i></a>
<div class="row">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
		<p><? echo Translations::gi()->see_as; ?>
			<select class="form-control" id="perpage_bank" style="width: 100px;">
				<option value="10" selected>10</option>
				<option value="20">20</option>
				<option value="50">50</option>
			</select>
		</p>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
		<table class="table table-sm" id="bank">
		</table>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination_bank">
	</div>
</div>

<script type="text/javascript">
$(function(){
	function getBankCnt()
	{
		$.ajax({
			url: '/remart/get_banks_count',
			method: 'get',
			dataType: 'json',
			success: function(data) {
				pages = (data.cnt % $("#perpage_bank").val()) ? Math.floor(data.cnt / $("#perpage_bank").val()) + 1 : Math.floor(data.cnt / $("#perpage_bank").val());
				pagination = '';
				for (i = 1; i <= pages; i++)
				{
					pagination += '<li class="page-item"><a class="page-link" data-page="' + i + '">' + i + '</a></li>';
				}
				pagination = '<ul class="pagination">' + pagination + '</ul>';
				$("#pagination_bank").html(pagination);
				getBank(1);
			}
		});
	}
	function getBank(page)
	{
		$.ajax({
			url: '/remart/get_banks',
			method: 'get',
			dataType: 'json',
			data: {
				perpage: $("#perpage_bank").val(),
				page: page
			},
			success: function(data) {
				$("#bank").html('<tr><th>ID</th><th><? echo Translations::gi()->company_name; ?></th><th></th><th></th><th></th></tr>');
				<? if ($item->role_id == 2) { ?>
				for (i in data)
				{
					if (data[i].validated != 1) activate = '<button class="activatebank btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
					else activate = '<button class="deactivatebank btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
					$("#bank").append('<tr><td>' + data[i].id + '</td><td>' + data[i].name + '</td><td><a class="edit btn btn-sm btn-primary" href="/edit_bank?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td><button type="button" class="btn btn-warning ipoteka" data-id="' + data[i].id + '" title="<? echo Translations::gi()->ipoteka; ?>"><i class="fa fa-shield"></i></button></td><td>' + activate + '</td></tr>');
				}
				<? } else { ?>
				for (i in data)
				{
					$("#bank").append('<tr><td>' + data[i].id + '</td><td>' + data[i].name + '</td><td><a class="edit btn btn-sm btn-primary" href="/edit_bank?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td><button type="button" class="btn btn-warning ipoteka" data-id="' + data[i].id + '" title="<? echo Translations::gi()->ipoteka; ?>"><i class="fa fa-shield"></i></button></td></tr>');
				}
				<? } ?>
				$('#pagination_bank .page-item').removeClass('active');
				$($('#pagination_bank .pagination')[0].childNodes[page - 1]).addClass('active');
			}
		});
	}
	getBankCnt();
	$(document).on('click', '#pagination_bank .page-link', function(){
		page = $(this).attr('data-page');
		getBank(page);
	});
	$(document).on('change', '#perpage_bank', function(){
		getBankCnt();
	});
});
</script>