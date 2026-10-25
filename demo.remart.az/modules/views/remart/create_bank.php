<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h1><? echo Translations::gi()->create_bank; ?></h1>
		</div>
	</div>
	<form id="needs-validation" novalidate>
		<input type="hidden" id="logo">
		<div class="row">
			<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
				<label for="name"><? echo Translations::gi()->company_name; ?></label>
				<input type="text" class="form-control" name="name" id="name" placeholder="<? echo Translations::gi()->company_name; ?>" required>
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
						url: '/remart/save_bank',
						method: 'post',
						dataType: 'json',
						data: {
							name: $('#name').val(),
							logo: $('#logo').val()
						},
						success: function(data)
						{
							if (data == true) 
							{
								alert('<? echo Translations::gi()->bank_create_success; ?>');
								window.location = '/dashboard';
							}
							else
							{
								alert('<? echo Translations::gi()->bank_create_error; ?>');
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