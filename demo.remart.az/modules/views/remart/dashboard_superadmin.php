<div class="container-fluid">
	<div class="row">
		<nav class="nav nav-pills flex-column flex-sm-row col-12">
			<a class="nav-link active" data-id="v-pills-projectmanagers"><? echo Translations::gi()->project_managers; ?></a>
			<a class="nav-link" data-id="v-pills-realtors"><? echo Translations::gi()->rieltors; ?></a>
			<a class="nav-link" data-id="v-pills-creditspecialists"><? echo Translations::gi()->credit_specialists; ?></a>
			<a class="nav-link" data-id="v-pills-bank"><? echo Translations::gi()->banks; ?></a>
			<a class="nav-link" data-id="v-pills-appraiser"><? echo Translations::gi()->appraisers; ?></a>
			<a class="nav-link" data-id="v-pills-objects"><? echo Translations::gi()->objects; ?></a>
			<a class="nav-link" data-id="v-pills-buyer"><? echo Translations::gi()->buyers; ?></a>
		</nav>
		<div class="tab-content col-12" id="v-pills-tabContent">
			<div class="tab-pane active" id="v-pills-projectmanagers">
				<? include('additional_project_manager.php'); ?>
			</div>
			<div class="tab-pane" id="v-pills-realtors">
				<? include('additional_realtor.php'); ?>
			</div>
			<div class="tab-pane" id="v-pills-creditspecialists">
				<? include('additional_credit_specialist.php'); ?>
			</div>
			<div class="tab-pane" id="v-pills-bank">
				<? include('additional_banks.php'); ?>
			</div>
			<div class="tab-pane" id="v-pills-appraiser">
				<? include('additional_appraiser.php'); ?>
			</div>
			<div class="tab-pane" id="v-pills-objects">
				<? include('additional_objects.php'); ?>
			</div>
			<div class="tab-pane" id="v-pills-buyer">
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
		url: '/remart/get_project_managers',
		method: 'get',
		dataType: 'json',
		success: function(data) {
			for (i in data)
			{
				if (data[i].validated == 1) activation = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->lock; ?>"><i class="fa fa-lock"></i></button>';
				else activation = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->unlock; ?>"><i class="fa fa-unlock"></i></button>';
				$("#project_managers").append('<tr><td>' + data[i].id + '</td><td>' + data[i].login + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->view; ?>"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_project_manager?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activation + '</td></tr>');
			}
		}
	});*/
	/*$.ajax({
		url: '/remart/get_realtors',
		method: 'get',
		dataType: 'json',
		success: function(data) {
			for (i in data)
			{
				if (data[i].validated != 1) activate = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
				else activate = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
				$("#realtors").append('<tr><td>' + data[i].id + '</td><td>' + data[i].login + '</td><td>' + data[i].company_name + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="Просмотреть"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_realtor?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activate + '</td></tr>');
			}
		}
	});*/
	/*$.ajax({
		url: '/remart/get_credit_specialists',
		method: 'get',
		dataType: 'json',
		success: function(data) {
			for (i in data)
			{
				if (data[i].validated != 1) activate = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
				else activate = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
				$("#creditspecialists").append('<tr><td>' + data[i].id + '</td><td>' + data[i].login + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="Просмотреть"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_credit_specialist?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activate + '</td></tr>');
			}
		}
	});*/
	/*$.ajax({
		url: '/remart/get_appraisers',
		method: 'get',
		dataType: 'json',
		success: function(data) {
			for (i in data)
			{
				if (data[i].validated != 1) activate = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
				else activate = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
				$("#appraiser").append('<tr><td>' + data[i].id + '</td><td>' + data[i].email + '</td><td>' + data[i].company_name + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="Просмотреть"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_appraiser?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activate + '</td></tr>');
			}
		}
	});*/
	/*$.ajax({
		url: '/remart/get_buyers',
		method: 'get',
		dataType: 'json',
		success: function(data) {
			for (i in data)
			{
				if (data[i].validated != 1) activate = '<button class="activate btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
				else activate = '<button class="deactivate btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
				$("#buyer").append('<tr><td>' + data[i].id + '</td><td>' + data[i].login + '</td><td>' + data[i].name + '</td><td>' + data[i].surname + '</td><td>' + data[i].patronymic + '</td><td><button class="view btn btn-sm btn-primary" data-id="' + data[i].id + '" type="button" title="Просмотреть"><i class="fa fa-eye"></i></button></td><td><a class="edit btn btn-sm btn-primary" href="/edit_buyer?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td>' + activate + '</td></tr>');
			}
		}
	});*/
	/*$.ajax({
		url: '/remart/get_banks',
		method: 'get',
		dataType: 'json',
		success: function(data) {
			for (i in data)
			{
				if (data[i].validated != 1) activate = '<button class="activatebank btn btn-sm btn-success" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->activate; ?>"><i class="fa fa-check"></i></button>';
				else activate = '<button class="deactivatebank btn btn-sm btn-danger" data-id="' + data[i].id + '" type="button" title="<? echo Translations::gi()->deactivate; ?>"><i class="fa fa-close"></i></button>';
				$("#bank").append('<tr><td>' + data[i].id + '</td><td>' + data[i].name + '</td><td><a class="edit btn btn-sm btn-primary" href="/edit_bank?id=' + data[i].id + '" type="button" title="<? echo Translations::gi()->edit; ?>"><i class="fa fa-edit"></i></a></td><td><button type="button" class="btn btn-warning ipoteka" data-id="' + data[i].id + '" title="Ипотека"><i class="fa fa-shield"></i></button></td><td>' + activate + '</td></tr>');
			}
		}
	});*/
	
	/*
		END GET USER LIST SECTION
	*/
	
	$(document).on('click', '.ipoteka', function(){	
		id = $(this).attr('data-id');
		$.ajax({
						url: '/remart/get_bank',
						method: 'post',
						dataType: 'json',
						data: {
							id: id
						},
						success: function(data)
						{
							console.log(data);
							$('#id').val(data.id);
							$('#name').val(data.name);
							$('#logo').val(data.logo);
							$('#price').val(data.price);
							$('#srok').val(data.srok);
							$('#percent').val(data.percent);
							$('#vznos').val(data.vznos);
							$('#comission').val(data.comission);
							$('#dolya').val(data.dolya);
							if (data.ipoteka == 1) $("#social").prop('checked', true);
							if (data.ipoteka == 2) $("#sample").prop('checked', true);
							if (data.stoimost == 1) $("#market").prop('checked', true);
							if (data.stoimost == 2) $("#liquid").prop('checked', true);
							$('#exampleModalLong').modal('show');
						},
						error: function(data)
						{
							console.log(data);
						}
					});
	});
	$(document).on('click', '.activate', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/activate',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					alert('Пользователь активирован успешно');
					window.location = '/dashboard';
				}
			});
		}
	});
	$(document).on('click', '.deactivate', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/deactivate',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					alert('Пользователь деактивирован успешно');
					window.location = '/dashboard';
				}
			});
		}
	});
	$(document).on('click', '.activatebank', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/activatebank',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					alert('Банк активирован успешно');
					window.location = '/dashboard';
				}
			});
		}
	});
	$(document).on('click', '.deactivatebank', function(){
		ID = $(this).attr('data-id');
		if (confirm('Вы уверены?')) {
			$.ajax({
				url: '/remart/deactivatebank',
				method: 'post',
				dataType: 'json',
				data: {
					id: ID
				},
				success: function(data) {
					alert('Банк деактивирован успешно');
					window.location = '/dashboard';
				}
			});
		}
	});
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
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Ипотека</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="needs-validation" novalidate>
					<input type="hidden" id="id">
					<input type="hidden" id="name">
					<input type="hidden" id="logo">
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="exampleRadios" id="social" value="1">
									Социальная ипотека
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="exampleRadios" id="sample" value="2">
									Обычная ипотека
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<label for="price">Максимально возможная сумма в AZN</label>
							<input type="text" class="form-control" name="price" id="price" placeholder="Максимально возможная сумма в AZN" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<label for="srok">Срок (в месяцах)</label>
							<input type="text" class="form-control" name="srok" id="srok" placeholder="Срок (в месяцах)" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<label for="percent">Процентная ставка</label>
							<input type="text" class="form-control" name="percent" id="percent" placeholder="Процентная ставка" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<label for="vznos">Первоначальный взнос (в процентах)</label>
							<input type="text" class="form-control" name="vznos" id="vznos" placeholder="Первоначальный взнос (в процентах)" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<label for="comission">Банковские комиссии</label>
							<input type="text" class="form-control" name="comission" id="comission" placeholder="Банковские комиссии">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<label for="dolya">Соотношение между суммой кредита и стоимостью объекта недвижимости (в долях 30% это 0.3)</label>
							<input type="text" class="form-control" name="dolya" id="dolya" placeholder="Соотношение между суммой кредита и стоимостью объекта недвижимости">
						</div>
					</div>
					
					<div class="row">
						<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="exampleRadios2" id="market" value="1">
									Рыночная стоимость
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="exampleRadios2" id="liquid" value="2">
									Ликвидная стоимость
								</label>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><? echo Translations::gi()->close; ?></button>
				<button type="submit" id="submit" class="btn btn-primary"><? echo Translations::gi()->save; ?></button>
			</div>
		</div>
	</div>
</div>
<script>
		$(function(){
			$("#submit").on('click', function(event){
				if ($("#needs-validation")[0].checkValidity() == false) {
					event.preventDefault();
					event.stopPropagation();
				}
				else
				{
					ipoteka = '';
					stoimost = '';
					if ($("#social").is(':checked') == true) ipoteka = 1;
					if ($("#sample").is(':checked') == true) ipoteka = 2;
					if ($("#market").is(':checked') == true) stoimost = 1;
					if ($("#liquid").is(':checked') == true) stoimost = 2;
					$.ajax({
						url: '/remart/save_bank',
						method: 'post',
						dataType: 'json',
						data: {
							id: $('#id').val(),
							name: $('#name').val(),
							logo: $('#logo').val(),
							price: $('#price').val(),
							srok: $('#srok').val(),
							percent: $('#percent').val(),
							vznos: $('#vznos').val(),
							comission: $('#comission').val(),
							dolya: $('#dolya').val(),
							ipoteka: ipoteka,
							stoimost: stoimost
						},
						success: function(data)
						{
							if (data == true) 
							{
								alert('Данные о банке успешно изменены!');
								window.location = '/dashboard';
							}
							else
							{
								alert('Ошибка при создании оценочной компании. Пользователь с такой почтой уже зарегистрирован!');
							}
						},
						error: function(data)
						{
							console.log(data);
						}
					});
					return false;
				}
				$("#needs-validation").addClass("was-validated");
				return false;
			});
		});
</script>
