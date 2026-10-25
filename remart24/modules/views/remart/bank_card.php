<div class="row">
    <div class="container">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <button class="btn btn-success" id="save" type="submit"><? echo Translations::gi()->save; ?></button>
	    <a href="/dashboard" class="btn btn-danger"><? echo Translations::gi()->close; ?></a>
	    <button class="btn btn-warning" id="edit" type="button"><? echo Translations::gi()->edit; ?></button>
	    <? if ($item->role_id == 2 || $item->role_id == 4) { ?>
	    <button class="btn btn-info changebstatus" data-id="1" id="activate" type="button"><? echo Translations::gi()->activate; ?></button>
	    <button class="btn btn-danger changebstatus" data-id="0" id="deactivate" type="button"><? echo Translations::gi()->deactivate; ?></button>
	    <? } ?>
	</div>
    </div>
</div>
<div class="row formbody">
    <div class="container">
    <? include('bank_form.php'); ?>
    </div>
    <script type="text/javascript">
	$(function() {
	    function disable() {
		$('form#needs-validation input').attr('disabled', true);
		$('form#needs-validation select').attr('disabled', true);
		$('form#needs-validation textarea').attr('disabled', true);
		$('form#needs-validation checkbox').attr('disabled', true);
		$('form#needs-validation radio').attr('disabled', true);
		$('form#needs-validation button').attr('disabled', true);
		$('form#needs-validation button').addClass('disabled');
		$('.dz-clickable').addClass('disabledlink');
	    }
	    function enable() {
		$('form#needs-validation input').attr('disabled', false);
		$('form#needs-validation select').attr('disabled', false);
		$('form#needs-validation textarea').attr('disabled', false);
		$('form#needs-validation checkbox').attr('disabled', false);
		$('form#needs-validation radio').attr('disabled', false);
		$('form#needs-validation button').attr('disabled', false);
		$('form#needs-validation button').removeClass('disabled');
		$('.dz-clickable').removeClass('disabledlink');
	    }
	    function activity_buttons(status)
	    {
		$(".changebstatus").show();
		if (status == 1) $("#activate").hide();
		if (status == 0) { $("#deactivate").hide(); }
	    }
	    $(".changebstatus").on('click', function() {
		if (confirm('Вы уверены, что хотите изменить статус банка?')) {
		    var status = $(this).attr('data-id');
		    $.ajax({
			url: '/remart/change_bank_status',
			method: 'post',
			dataType: 'json',
			data: {
			    id: <? echo $_GET['id']; ?>,
			    status: status},
			success: function(data) {
			    alert('Статус банка изменен');
			    activity_buttons(status);
			}
		    });
		}
		return false;
	    });
	    $("#edit").on('click', function() { 
	        enable();
	    });
	    function phone_parser(number)
	    {
		var phone = {};
		phone.worldwide = number.substring(0,4);
		phone.code = number.substring(4,6);
		phone.part1 = number.substring(6,9);
		phone.part2 = number.substring(9,11);
		phone.part3 = number.substring(11,13);
		return phone;
	    }
	    $.ajax({
		url: '/remart/bank',
		method: 'get',
		dataType: 'json',
		data: {
		    id: <? echo $_GET['id'] ?>
		},
		success: function(data)
		{
		    $("#bank_name").val(data.data.bank_name);
		    $("#website").val(data.data.website);
		    $("#logo").val(data.data.logo);
		    $("#name").val(data.data.name);
		    $("#surname").val(data.data.surname);
		    $("#email").val(data.data.email);
		    $("#comment").val(data.data.comment);
		    $("#position").val(data.data.position);
		    var phone1 = phone_parser(data.data.phone);
		    $("#mobile2").val(phone1.code);
		    $("#mobile3").val(phone1.part1);
		    $("#mobile4").val(phone1.part2);
		    $("#mobile5").val(phone1.part3);
		    images = $('#logo').val();
		    $.ajax({
			url: '/remart/getImages?ids=' + $('#logo').val(),
			method: 'get',
			dataType: 'json',
			success: function(data) {			   
			    $('.images').html('');
			    for (i in data) 
			    {
				$('.images').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + data[i].material_path + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + data[i].id + '"><i class="fa fa-trash"></i></button> <input type="text" class="photo_ordering form-control" data-id="' + data[i].id + '" value="' + data[i].ordering + '"></div>');
			    }
			    disable();
			}	
		    });
		    activity_buttons(data.data.status);
		    disable();
		},
		error: function(data)
		{
		    console.log(data);
		}
	    });
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
			    id: <? echo $_GET['id']; ?>,
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
				alert('<? echo Translations::gi()->bank_edit_success; ?>');
				window.location = '/dashboard';
			    }
			    else
			    {
				alert('<? echo Translations::gi()->bank_edit_error; ?>');
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