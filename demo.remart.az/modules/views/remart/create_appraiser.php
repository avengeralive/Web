<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h1><? echo Translations::gi()->create_appraiser_company; ?></h1>
		</div>
	</div>
	<form id="needs-validation" novalidate>
		<input type="hidden" id="logo">
		<div class="row">
			<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<label for="company_name"><? echo Translations::gi()->company_name; ?></label>
				<input type="text" class="form-control" name="company_name" id="company_name" placeholder="<? echo Translations::gi()->company_name; ?>" required>
			</div>
			<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<label for="website"><? echo Translations::gi()->website; ?></label>
				<input type="text" class="form-control" name="website" id="website" placeholder="<? echo Translations::gi()->website; ?>">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<label for="email">E-mail</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
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
			<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<label for="comment"><? echo Translations::gi()->comment; ?></label>
				<textarea class="form-control" name="comment" id="comment" placeholder="<? echo Translations::gi()->comment; ?>" rows="6"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<label for="about"><? echo Translations::gi()->about; ?></label>
				<textarea class="form-control" name="about" id="about" placeholder="<? echo Translations::gi()->about; ?>" rows="6"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<label for="voen">VOEN</label>
				<input type="text" class="form-control" name="voen" id="voen" placeholder="VOEN">
			</div>
		</div>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12">
			<div id="object-photo" class="dropzone"></div>
		</div>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images row">
		</div>
		<div class="row">
			<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<button class="btn btn-success" type="submit"><? echo Translations::gi()->save; ?></button>
			</div>
		</div>
	</form>
	<script>
		Dropzone.autoDiscover = false;
		jQuery("#object-photo").dropzone({
			url: '/materials/temp/dropzone.php?session_id=<?php echo session_id(); ?>',
			acceptedFiles: 'image/*',
			timeout: 1000000,
			method: "post",
			success: function (file, response) {
				file.previewElement.classList.add("dz-success");
				name = response;
				$("#logo").val(name);
				$('.images').html('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + name + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button></div>');
			},
			error: function (file, response) {
				file.previewElement.classList.add("dz-error");
			}
		});
		$(function(){
			var phone = 1;
			$("#addphone").on('click', function() {
				if (phone < 3) {
					$("#additionalphone").append('<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6"><label for="phone">Дополнительный телефон ' + phone + '</label><p><input type="text" class="form-control" name="phone' + phone + '_1" id="phone' + phone + '_1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled><select class="form-control" name="phone' + phone + '_2" id="phone' + phone + '_2" style="width:60px; float: left; margin-right: 10px;"><option value="50">50</option><option value="51">51</option><option value="55">55</option><option value="70">70</option><option value="77">77</option><option value="12">12</option></select><input type="text" class="form-control" name="phone' + phone + '_3" id="phone' + phone + '_3" maxlength="3" style="width:48px; float: left; margin-right: 10px;"><input type="text" class="form-control" name="phone' + phone + '_4" id="phone' + phone + '_4" maxlength="2" style="width:40px; float: left; margin-right: 10px;"><input type="text" class="form-control" name="phone' + phone + '_5" id="phone' + phone + '_5" maxlength="2" style="width:40px; float: left;"></p></div>');
					phone++;
				}
			});
			images = $('#logo').val();
			if (images != '')
			{
				$('.images').html('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + images + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button></div>');
			}
			$(document).on('click', '.delete', function(){
				$(this).parent().remove();
				$("#logo").val('');
			});
			$("#needs-validation").on('submit', function(event){
				if ($("#needs-validation")[0].checkValidity() == false) {
					event.preventDefault();
					event.stopPropagation();
				}
				else
				{
					$.ajax({
						url: '/remart/save_appraiser',
						method: 'post',
						dataType: 'json',
						data: {
							company_name: $('#company_name').val(),
							email: $('#email').val(),
							website: $('#website').val(),
							mobile: $('#mobile1').val() + $('#mobile2').val() + $('#mobile3').val() + $('#mobile4').val() + $('#mobile5').val(),
							home: $('#home1').val() + $('#home2').val() + $('#home3').val() + $('#home4').val() + $('#home5').val(),
							phone1: $('#phone1_1').val() + $('#phone1_2').val() + $('#phone1_3').val() + $('#phone1_4').val() + $('#phone1_5').val(),
							phone2: $('#phone2_1').val() + $('#phone2_2').val() + $('#phone2_3').val() + $('#phone2_4').val() + $('#phone2_5').val(),
							voen: $('#voen').val(),
							about: $('#about').val(),
							logo: $('#logo').val(),
							comment: $('#comment').val()
						},
						success: function(data)
						{
							if (data == true) 
							{
								alert('<? echo Translations::gi()->appraiser_create_success; ?>');
								window.location = '/dashboard';
							}
							else
							{
								alert('<? echo Translations::gi()->appraiser_create_error; ?>');
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