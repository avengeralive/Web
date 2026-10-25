<div class="row">
    <div class="container">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style='padding: 15px 0px 0px 0px;'>
	    <h1><? echo Translations::gi()->create_bank; ?></h1>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <button class="btn btn-success save" type="submit"><? echo Translations::gi()->save; ?></button>
	    <a href="/dashboard" class="btn btn-danger"><? echo Translations::gi()->close; ?></a>
	</div>
    </div>
</div>
<div class="row formbody">
    <div class="container">
    <? include('bank_form.php'); ?>
    </div>
    <script>
	$(function(){
	    $(".save").on('click', function(event){
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
			    bank_name: $("#bank_name").val(),
			    website: $("#website").val(),
			    logo: $("#logo").val(),
			    name: $("#name").val(),
			    surname: $("#surname").val(),
			    position: $("#position").val(),
			    email: $("#email").val(),
			    comment: $("#comment").val(),
			    phone: $('#mobile1').val() + $('#mobile2').val() + $('#mobile3').val() + $('#mobile4').val() + $('#mobile5').val()
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
<div class="row">
    <div class="container" style="margin-top: 30px;">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <button class="btn btn-success save" type="submit"><? echo Translations::gi()->save; ?></button>
	</div>
    </div>
</div>