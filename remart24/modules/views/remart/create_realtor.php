<div class="row">
    <div class="container">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style='padding: 15px 0px 0px 0px;'>
	    <h1><? echo Translations::gi()->create_realtor; ?></h1>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <button class="btn btn-success" id="submit" type="submit"><? echo Translations::gi()->save; ?></button>
	    <a href="/dashboard" class="btn btn-danger"><? echo Translations::gi()->close; ?></a>
	</div>
    </div>
</div>
<div class="row formbody">
    <div class="container">
    <? include('realtor_form.php'); ?>
    </div>
    <script type="text/javascript">
	$(function(){
	    $("#submit").on('click', function(event){
		if ($("#needs-validation")[0].checkValidity() == false) {
		    event.preventDefault();
		    event.stopPropagation();
		}
		else
		{
		    $.ajax({
			url: '/remart/save_user',
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
			    comment: $('#comment').val(),
			    company_name: $('#company_name').val(),
			    logo: '',
			    company: 0,
			    voen: '',
			    bank: 0,
			    website: '',
			    about: '',
			    role_id: 5
			},
			success: function(data) {
			    if (data == true) 
			    {
				alert('<? echo Translations::gi()->create_realtor_success; ?>');
				window.location = '/dashboard';
			    }
			    else
			    {
				alert('<? echo Translations::gi()->create_realtor_error; ?>');
			    }
			},
			error: function(data) {
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