<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h1><? echo Translations::gi()->create_project_manager; ?></h1>
		</div>
	</div>
	<form id="needs-validation" novalidate>
		<div class="row">
			<div class="form-group col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
				<label for="first"><? echo Translations::gi()->name; ?></label>
				<input type="text" class="form-control" name="name" id="name" placeholder="<? echo Translations::gi()->name; ?>" required>
			</div>
			<div class="form-group col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
				<label for="last"><? echo Translations::gi()->surname; ?></label>
				<input type="text" class="form-control" name="surname" id="surname" placeholder="<? echo Translations::gi()->surname; ?>" required>
			</div>
			<div class="form-group col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
				<label for="patronymic"><? echo Translations::gi()->patronymic; ?></label>
				<input type="text" class="form-control" name="patronymic" id="patronymic" placeholder="<? echo Translations::gi()->patronymic; ?>">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<label for="email">E-mail</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required>
			</div>
			<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<label for="birthday"><? echo Translations::gi()->birthday; ?></label>
				<input type="date" class="form-control" name="birthday" id="birthday" placeholder="<? echo Translations::gi()->birthday; ?>">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<label for="mobile"><? echo Translations::gi()->mobile; ?></label>
				<p>
					<input type="text" class="form-control" name="mobile1" id="mobile1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
					<select class="form-control" name="mobile2" id="mobile2" style="width:60px; float: left; margin-right: 10px;">
						<option value="50">50</option>
						<option value="51">51</option>
						<option value="55">55</option>
						<option value="70">70</option>
						<option value="77">77</option>
					</select>
					<input type="text" class="form-control" name="mobile3" id="mobile3" maxlength="3" style="width:48px; float: left; margin-right: 10px;" required>
					<input type="text" class="form-control" name="mobile4" id="mobile4" maxlength="2" style="width:40px; float: left; margin-right: 10px;" required>
					<input type="text" class="form-control" name="mobile5" id="mobile5" maxlength="2" style="width:40px; float: left;" required>
				</p>
			</div>
			<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<label for="home"><? echo Translations::gi()->home; ?></label>
				<p>
					<input type="text" class="form-control" name="home1" id="home1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
					<select class="form-control" name="home2" id="home2" style="width:60px; float: left; margin-right: 10px;">
						<option value="12">12</option>
					</select>
					<input type="text" class="form-control" name="home3" id="home3" maxlength="3" style="width:48px; float: left; margin-right: 10px;">
					<input type="text" class="form-control" name="home4" id="home4" maxlength="2" style="width:40px; float: left; margin-right: 10px;">
					<input type="text" class="form-control" name="home5" id="home5" maxlength="2" style="width:40px; float: left;">
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<a id="addphone" style="color:#fff; cursor: pointer;" class="btn btn-sm btn-success" title="Добавить телефон"><i class="fa fa-plus"></i> Добавить телефон</a>
			</div>
		</div>
		<div class="row" id="additionalphone" style="margin-bottom: 15px;">
		</div>
		<div class="row">
			<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<label for="id_serial"><? echo Translations::gi()->id_serial; ?></label>
				<input type="text" class="form-control" name="id_serial" id="id_serial" placeholder="<? echo Translations::gi()->id_serial; ?>">
			</div>
			<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<label for="id_pin"><? echo Translations::gi()->id_pin; ?></label>
				<input type="text" class="form-control" name="id_pin" id="id_pin" placeholder="<? echo Translations::gi()->id_pin; ?>">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<label for="comment"><? echo Translations::gi()->comment; ?></label>
				<textarea class="form-control" name="comment" id="comment" placeholder="<? echo Translations::gi()->comment; ?>" rows="6"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<button class="btn btn-success" type="submit"><? echo Translations::gi()->save; ?></button>
			</div>
		</div>
	</form>
	<script>
		$(function(){
			var phone = 1;
			$("#addphone").on('click', function() {
				if (phone < 3) {
					$("#additionalphone").append('<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6"><label for="phone">Дополнительный телефон ' + phone + '</label><p><input type="text" class="form-control" name="phone' + phone + '_1" id="phone' + phone + '_1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled><select class="form-control" name="phone' + phone + '_2" id="phone' + phone + '_2" style="width:60px; float: left; margin-right: 10px;"><option value="50">50</option><option value="51">51</option><option value="55">55</option><option value="70">70</option><option value="77">77</option><option value="12">12</option></select><input type="text" class="form-control" name="phone' + phone + '_3" id="phone' + phone + '_3" maxlength="3" style="width:48px; float: left; margin-right: 10px;"><input type="text" class="form-control" name="phone' + phone + '_4" id="phone' + phone + '_4" maxlength="2" style="width:40px; float: left; margin-right: 10px;"><input type="text" class="form-control" name="phone' + phone + '_5" id="phone' + phone + '_5" maxlength="2" style="width:40px; float: left;"></p></div>');
					phone++;
				}
			});
			$("#needs-validation").on('submit', function(event){
				if ($("#needs-validation")[0].checkValidity() == false) {
					event.preventDefault();
					event.stopPropagation();
				}
				else
				{
					$.ajax({
						url: '/remart/save_project_manager',
						method: 'post',
						dataType: 'json',
						data: {
							name: $('#name').val(),
							surname: $('#surname').val(),
							patronymic: $('#patronymic').val(),
							email: $('#email').val(),
							birthday: $('#birthday').val(),
							mobile: $('#mobile1').val() + $('#mobile2').val() + $('#mobile3').val() + $('#mobile4').val() + $('#mobile5').val(),
							home: $('#home1').val() + $('#home2').val() + $('#home3').val() + $('#home4').val() + $('#home5').val(),
							phone1: $('#phone1_1').val() + $('#phone1_2').val() + $('#phone1_3').val() + $('#phone1_4').val() + $('#phone1_5').val(),
							phone2: $('#phone2_1').val() + $('#phone2_2').val() + $('#phone2_3').val() + $('#phone2_4').val() + $('#phone2_5').val(),
							id_serial: $('#id_serial').val(),
							id_pin: $('#id_pin').val(),
							comment: $('#comment').val()
						},
						success: function(data)
						{
							if (data == true) 
							{
								alert('<? echo Translations::gi()->create_pm_success; ?>');
								window.location = '/dashboard';
							}
							else
							{
								alert('<? echo Translations::gi()->create_pm_error; ?>');
							}
						},
						error: function(data)
						{
							console.log(data);
						}
					});
				}
				$("#needs-validation").addClass("was-validated");
				return false;
			});
		});
</script>
</div>
<style>
</style>