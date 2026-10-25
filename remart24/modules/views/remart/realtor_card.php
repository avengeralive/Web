<div class="row">
    <div class="container">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <button class="btn btn-success" id="submit" type="submit"><? echo Translations::gi()->save; ?></button>
	    <a href="/dashboard" class="btn btn-danger"><? echo Translations::gi()->close; ?></a>
	    <button class="btn btn-warning" id="edit" type="button"><? echo Translations::gi()->edit; ?></button>
	    <button class="btn btn-info" id="activate" type="button"><? echo Translations::gi()->activate; ?></button>
	    <button class="btn btn-danger" id="deactivate" type="button"><? echo Translations::gi()->deactivate; ?></button>
	</div>
    </div>
</div>
<div class="row formbody">
    <div class="container">
    <? include('realtor_form.php'); ?>
    </div>
    <script type="text/javascript">
	$(function(){
	    function disable() {
		$('form input').attr('disabled', true);
		$('form select').attr('disabled', true);
		$('form textarea').attr('disabled', true);
		$('form checkbox').attr('disabled', true);
		$('form radio').attr('disabled', true);
		$('form button').attr('disabled', true);
		$('form button').addClass('disabled');
		$('.deleteAdditionalPhone').attr('disabled', true);
		$('.deleteAdditionalPhone').addClass('disabled');
	    }
	    function enable() {
		$('form input').attr('disabled', false);
		$('form select').attr('disabled', false);
		$('form textarea').attr('disabled', false);
		$('form checkbox').attr('disabled', false);
		$('form radio').attr('disabled', false);
		$('form button').attr('disabled', false);
		$('form button').removeClass('disabled');
		$('.deleteAdditionalPhone').attr('disabled', false);
		$('.deleteAdditionalPhone').removeClass('disabled');
		$("#mobile1").attr('disabled', true);
		$("#home1").attr('disabled', true);
		$("#phone1_1").attr('disabled', true);
		$("#phone2_1").attr('disabled', true);
	    }
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
		url: '/remart/user',
		method: 'get',
		dataType: 'json',
		data: {
		    id: <? echo $_GET['id'] ?>
		},
		success: function(data)
		{
		    var mobile = phone_parser(data.data.mobile);
		    var home = phone_parser(data.data.home);
		    if (data.data.validated == 1) {
			$("#activate").hide();
			$("#deactivate").show();
		    }
		    else {
			$("#activate").show();
			$("#deactivate").hide();
		    }
		    $("#name").val(data.data.name);
		    $("#company_name").val(data.data.company_name);
		    $("#surname").val(data.data.surname);
		    $("#patronymic").val(data.data.patronymic);
		    $("#email").val(data.data.email);
		    $("#birthday").val(data.data.birthday);
		    $("#id_serial").val(data.data.id_serial);
		    $("#id_pin").val(data.data.id_pin);
		    $("#comment").val(data.data.comment);
		    $("#mobile2").val(mobile.code);
		    $("#mobile3").val(mobile.part1);
		    $("#mobile4").val(mobile.part2);
		    $("#mobile5").val(mobile.part3);
		    $("#home2").val(home.code);
		    $("#home3").val(home.part1);
		    $("#home4").val(home.part2);
		    $("#home5").val(home.part3);
		    if (data.data.phone1 != 'NaN')
		    {
			var phone1 = phone_parser(data.data.phone1);
			addphone();
			$("#phone1_2").val(phone1.code);
			$("#phone1_3").val(phone1.part1);
			$("#phone1_4").val(phone1.part2);
			$("#phone1_5").val(phone1.part3);
		    }
		    if (data.data.phone2 != 'NaN')
		    {
			var phone2 = phone_parser(data.data.phone2);
			addphone();
			$("#phone2_2").val(phone2.code);
			$("#phone2_3").val(phone2.part1);
			$("#phone2_4").val(phone2.part2);
			$("#phone2_5").val(phone2.part3);
		    }
		    disable();
		},
		error: function(data)
		{
		    console.log(data);
		}
	    });
	    $("#activate").on('click', function() {
		if (confirm('Вы уверены, что хотите активировать пользователя?')) {
		    $.ajax({
			url: '/remart/activate',
			method: 'post',
			dataType: 'json',
			data: {
			    id: <? echo $_GET['id']; ?>
			},
			success: function(data) {
			    alert('Пользователь активирован успешно');
			    $("#activate").hide();
			    $("#deactivate").show();
			}
		    });
		}
	    });
	    $("#deactivate").on('click', function() {
		if (confirm('Вы уверены, что хотите деактивировать пользователя?')) {
		    $.ajax({
			url: '/remart/deactivate',
			method: 'post',
			dataType: 'json',
			data: {
			    id: <? echo $_GET['id']; ?>
			},
			success: function(data) {
			    alert('Пользователь деактивирован успешно');
			    $("#activate").show();
			    $("#deactivate").hide();
			}
		    });
		}
	    });
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
			    id: <? echo $_GET['id']; ?>,
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
			    about: '',
			    website: ''
			},
			success: function(data) {
			    if (data == true) 
			    {
				disable();
				alert('<? echo Translations::gi()->edit_realtor_success; ?>');
			    }
			    else
			    {
				alert('<? echo Translations::gi()->edit_realtor_error; ?>');
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
