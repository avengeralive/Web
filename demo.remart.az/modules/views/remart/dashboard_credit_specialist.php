<div class="container-fluid">
	<div class="row">
		<nav class="nav nav-pills flex-column flex-sm-row col-12">
			<a class="nav-link active" data-id="v-pills-buyer"><? echo Translations::gi()->buyers; ?></a>
		</nav>
		<div class="tab-content col-12" id="v-pills-tabContent">
			<div class="tab-pane active" id="v-pills-buyer">
				<? include('additional_buyer.php'); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
<? if (!$item->passch) { ?>
alert("Смените пароль!");
<? } ?>
</script>
<script type="text/javascript">
$(function(){
	
	/*
		GET USER LIST SECTION
	*/
	
	/*$.ajax({
		url: '/remart/get_my_buyers',
		method: 'get',
		dataType: 'json',
		success: function(data) {
			for (i in data)
			{
				$("#buyer").append('<tr><td>' + data[i].id + '</td><td>' + data[i].login + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="Просмотреть"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_buyer?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td></tr>');
			}
		}
	});*/
	
	/*
		END GET USER LIST SECTION
	*/
	
	$(document).on('click', '.view', function(){
		ID = $(this).attr('data-id');
		$.ajax({
			url: '/remart/getInfo',
			method: 'post',
			dataType: 'json',
			data: {
				id: ID
			},
			success: function(data) {
				$('#view_id').html(data.id);
				$('#view_email').html(data.email);
				$('#view_name').html(data.name);
				$('#view_surname').html(data.surname);
				$('#view_patronymic').html(data.patronymic);
				$('#view_login').html(data.login);
				$('#view_birthday').html(data.birthday);
				$('#view_mobile').html(data.mobile);
				$('#view_home').html(data.home);
				$('#view_id_serial').html(data.id_serial);
				$('#view_id_pin').html(data.id_pin);
				$('#view_comment').html(data.comment);
				$('#view_company_name').html(data.company_name);
				$('#view_about').html(data.about);
				$('#view_voen').html(data.voen);
				$('#view').modal('show');
			}
		});
	});
});
</script>
<style>
.tab-pane { padding-left: 20px; }
</style>
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewLabel">Просмотр пользователя</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<th>Параметр</th>
						<th>Значение</th>
					</tr>
					<tr>
						<td>ID</td>
						<td id="view_id"></td>
					</tr>
					<tr>
						<td>Логин</td>
						<td id="view_login"></td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td id="view_email"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->company_name; ?></td>
						<td id="view_company_name"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->name; ?></td>
						<td id="view_name"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->surname; ?></td>
						<td id="view_surname"></td>
					</tr>
					<tr>
						<td><? echo Translations::gi()->patronymic; ?></td>
						<td id="view_patronymic"></td>
					</tr>
					<tr>
						<td>Дата рождения</td>
						<td id="view_birthday"></td>
					</tr>
					<tr>
						<td>Мобильный</td>
						<td id="view_mobile"></td>
					</tr>
					<tr>
						<td>Домашний</td>
						<td id="view_home"></td>
					</tr>
					<tr>
						<td>Серия паспорта</td>
						<td id="view_id_serial"></td>
					</tr>
					<tr>
						<td>Пин паспорта</td>
						<td id="view_id_pin"></td>
					</tr>
					<tr>
						<td>Комментарии</td>
						<td id="view_comment"></td>
					</tr>
					<tr>
						<td>О компании</td>
						<td id="view_about"></td>
					</tr>
					<tr>
						<td>VOEN</td>
						<td id="view_voen"></td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Закрыть</button>
			</div>
		</div>
	</div>
</div>