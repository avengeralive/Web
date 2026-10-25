<div class="row">
    <div class="container">
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <? if ($item->role_id == 2 || $item->role_id == 4) { ?>
	    <button class="btn btn-success" id="save" type="submit"><? echo Translations::gi()->save; ?></button>
	    <? } ?>
	    <a href="/dashboard" class="btn btn-danger"><? echo Translations::gi()->close; ?></a>
	    <? if ($item->role_id == 2 || $item->role_id == 4) { ?>
	    <button class="btn btn-warning" id="edit" type="button"><? echo Translations::gi()->edit; ?></button>
	    <button class="btn btn-info changebstatus" data-id="1" id="activate" type="button"><? echo Translations::gi()->activate; ?></button>
	    <button class="btn btn-danger changebstatus" data-id="2" id="deactivate" type="button"><? echo Translations::gi()->deactivate; ?></button>
	    <button class="btn btn-primary st9 st" data-toggle="modal" data-target="#appraisers"><? echo Translations::gi()->send_to_appraisers; ?>Отправить риелтору</button>
	    <? } ?>
	</div>
    </div>
</div>
<div class="row formbody">
    <div class="container">
    <? include('bid_form.php'); ?>
    </div>
    <script type="text/javascript">
	$(function() {
		$(".region").on('click', function() { console.log();
				    var add = '';
				    if ($(".region:checked").length != 0) add = ": " + $($(".region:checked")[0]).attr('data-title'); 
				    if ($(".region:checked").length - 1 > 0) add = add + ' (+' + ($(".region:checked").length - 1) + ')';
				    $("#bregion").html("<? echo Translations::gi()->region; ?>" + add); 
				});
		$(".city").on('click', function() { console.log();
				    var add = '';
				    if ($(".city:checked").length != 0) add = ": " + $($(".city:checked")[0]).attr('data-title'); 
				    if ($(".city:checked").length - 1 > 0) add = add + ' (+' + ($(".city:checked").length - 1) + ')';
				    $("#bcity").html("<? echo Translations::gi()->city; ?>" + add); 
				});
		$(".room").on('click', function() { console.log();
				    var add = '';
				    if ($(".room:checked").length != 0) add = ": " + $($(".room:checked")[0]).attr('data-title'); 
				    if ($(".room:checked").length - 1 > 0) add = add + ' (+' + ($(".room:checked").length - 1) + ')';
				    $("#broom").html("<? echo Translations::gi()->room; ?>" + add); 
				});
		$(".type").on('click', function() { console.log();
				    var add = '';
				    if ($(".type:checked").length != 0) add = ": " + $($(".type:checked")[0]).attr('data-title'); 
				    if ($(".type:checked").length - 1 > 0) add = add + ' (+' + ($(".type:checked").length - 1) + ')';
				    $("#btype").html("<? echo Translations::gi()->object_type; ?>" + add); 
				});
	    $(".changebstatus").on('click', function() {
		if (confirm('Вы уверены, что хотите изменить статус заявки?')) {
		    var status = $(this).attr('data-id');
		    $.ajax({
			url: '/remart/change_bid_status',
			method: 'post',
			dataType: 'json',
			data: {
			    id: <? echo $_GET['id']; ?>,
			    status: status},
			success: function(data) {
			    alert('Статус заявки изменен');
			    activity_buttons(status);
			}
		    });
		}
		return false;
	    });
	    function disable() {
		$('form#needs-validation input').attr('disabled', true);
		$('form#needs-validation select').attr('disabled', true);
		$('form#needs-validation textarea').attr('disabled', true);
		$('form#needs-validation checkbox').attr('disabled', true);
		$('form#needs-validation radio').attr('disabled', true);
		$('form#needs-validation button').attr('disabled', true);
		$('form#needs-validation button').addClass('disabled');
	    }
	    function enable() {
		$('form#needs-validation input').attr('disabled', false);
		$('form#needs-validation select').attr('disabled', false);
		$('form#needs-validation textarea').attr('disabled', false);
		$('form#needs-validation checkbox').attr('disabled', false);
		$('form#needs-validation radio').attr('disabled', false);
		$('form#needs-validation button').attr('disabled', false);
		$('form#needs-validation button').removeClass('disabled');
		changeParams3();
	    }
	    function activity_buttons(status)
	    {
		$(".changebstatus").show();
		$(".st9").show();
		if (status == 2) { $("#deactivate").hide(); $(".st9").hide(); }
		if (status == 1) $("#activate").hide();
		if (status == 0) { $("#deactivate").hide(); $(".st9").hide(); }
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
		url: '/remart/bid',
		method: 'get',
		dataType: 'json',
		data: {
		    id: <? echo $_GET['id'] ?>
		},
		success: function(data)
		{
		    $("#buyer").val(data.data.buyer);
		    $("#email").val(data.data.email);
		    $("#type").val(data.data.type);
		    city = data.data.city.split(',');
		    for (i in city) $(".city[value=" + city[i] + "]").prop("checked", true);
		    region = data.data.region.split(',');
		    for (i in region) $(".region[value=" + region[i] + "]").prop("checked", true);
		    $("#price_max").val(data.data.price_max);
		    $("#comment").val(data.data.comment);
		    var room = data.data.room.split(',');
		    for (i in room) $(".room[value=" + room[i] + "]").prop("checked", true);
		    var phone1 = phone_parser(data.data.phone);
		    $("#phone2").val(phone1.code);
		    $("#phone3").val(phone1.part1);
		    $("#phone4").val(phone1.part2);
		    $("#phone5").val(phone1.part3);
		    if (data.data.notify == 1) $("#notify").prop('checked', true);
		    changeParams3();
		    activity_buttons(data.data.status);
		    var add = '';
		    $('.region').each(function(e,v){
		    	if ($(v).prop('checked')) {
		    		add += $(v).attr('data-title');
		    		add += ', ';
		    	}
		    });
		    $("#bregion").html("<? echo Translations::gi()->region; ?>: " + add);
		    add = '';
		    $('.city').each(function(e,v){
		    	if ($(v).prop('checked')) {
		    		add += $(v).attr('data-title');
		    		add += ', ';
		    	}
		    });
		    $("#bcity").html("<? echo Translations::gi()->city; ?>: " + add);
		    
		    add = '';
		    $('.room').each(function(e,v){
		    	if ($(v).prop('checked')) {
		    		add += $(v).attr('data-title');
		    		add += ', ';
		    	}
		    });
		    $("#broom").html("<? echo Translations::gi()->room; ?>: " + add);
		    
		    add = '';
		    $('.type').each(function(e,v){
		    	if ($(v).prop('checked')) {
		    		add += $(v).attr('data-title');
		    		add += ', ';
		    	}
		    });
		    $("#btype").html("<? echo Translations::gi()->object_type; ?>: " + add);
		    //activity_buttons(data.data.status);
		    disable();
		},
		error: function(data)
		{
		    console.log(data);
		}
	    });
	    $("#save").on('click', function(event){
		if ($("#needs-validation")[0].checkValidity() == false) {
		    event.preventDefault();
		    event.stopPropagation();
		}
		else
		{
		    var type = [];
		    $('.type').each(function(e,v){ if ($(v).prop('checked')) type.push($(v).val()); });
		    type = type.join();
		    if (type.length == 0) type = '0,1,2,3';
		    
		    var room = [];
		    $('.room').each(function(e,v){ if ($(v).prop('checked')) room.push($(v).val()); });
		    room = room.join();
		    if (room.length == 0) room = '1,2,3,4,5,6,7,8,9,10';
		    
		    var city = [];
		    var cities = [];
		    $('.city').each(function(e,v){ cities.push($(v).val()); if ($(v).prop('checked')) city.push($(v).val()); });
		    city = city.join();
		    if (city.length == 0) city = cities.join();
		    
		    var region = [];
		    var regions = [];
		    $('.region').each(function(e,v){ regions.push($(v).val()); if ($(v).prop('checked')) region.push($(v).val()); });
		    region = region.join();
		    if (region.length == 0) region = regions.join();
		    
		    if ($("#notify").prop("checked")) notify = 1;
		    else notify = 0;
		    $.ajax({
			url: '/remart/save_bid',
			method: 'post',
			dataType: 'json',
			data: {
			    id: <? echo $_GET['id']; ?>,
			    buyer: $('#buyer').val(), 
			    phone: $('#phone1').val() + $('#phone2').val() + $('#phone3').val() + $('#phone4').val() + $('#phone5').val(), 
			    email: $('#email').val(),
			    room: room,
			    type: type, 
			    city: city, 
			    region: region, 
			    price_max: $('#price_max').val(), 
			    comment: $('#comment').val(), 
			    notify: notify 
			},
			success: function(data)
			{
			    if (data == true) 
			    {
				alert('<? echo Translations::gi()->bid_edit_success; ?>');
				window.location = '/dashboard';
			    }
			    else
			    {
				alert('<? echo Translations::gi()->bid_edit_error; ?>');
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
<div class="modal fade" id="appraisers" tabindex="-1" role="dialog" aria-labelledby="changeLabel" aria-hidden="true">		
    <div class="modal-dialog" role="document">
	<div class="modal-content">
	    <div class="modal-header">
		<h5 class="modal-title" id="changeLabel">Отправить заявку риелтору</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    <span aria-hidden="true">×</span>
		</button>
	    </div>							
	    <div class="modal-body">
		<div class="container-fluid">
		    <form>
			<div class="row">
			    <div class="form-group col-12 col-sm-12">
				<label for="correction_comment">Выбрать риелтора</label>
				<div class="btn-group" style="width: 100%;">
				    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->realtor; ?></button>
				    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
					<label style="width:100%"><input type="checkbox" name="realtor_id" class="realtorall"><? echo Translations::gi()->select_all; ?></label>
					<? foreach ($realtors as $user) { ?>
					<label style="width:100%"><input type="checkbox" name="realtor_id" class="realtor_id" value="<? echo $user->id; ?>"><? echo $user->name; ?> <? echo $user->surname; ?> (<? echo $user->company_name; ?>)</label>
					<? } ?>
				    </div>
				</div>
			    </div>
			    <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<button class="btn btn-primary" id="sendtoappraiser">Отправить риелтору</button>
			    </div>
			</div>
		    </form>
		    <script type="text/javascript">
			$(function(){
			    $(".realtorall").on('change', function() { 
				if ($(".realtorall").prop('checked')) $(".realtor_id").prop("checked", true); 
				else $(".realtor_id").prop("checked", false); 
			    });
			    $("#sendtoappraiser").on('click', function() {
				var realtor = [];
				var realtors = [];
				$('.realtor_id').each(function(e,v){ realtors.push($(v).val()); if ($(v).prop('checked')) realtor.push($(v).val()); });
				realtor = realtor.join();
				if (realtor.length == 0) realtor = realtors.join();
				$.ajax({
				    url: '/remart/send_to_realtor',
				    method: 'post',
				    dataType: 'json',
				    data: {
					bid_id: <? echo $_GET['id']; ?>,
					realtor_id: realtor
				    },
				    success: function(data) {
					alert('Заявка отправлена риелтору');
					$("#appraisers").modal('hide');
				    }
				});
				return false;
			    });
			});
		    </script>
		</div>
	    </div>	
	</div>
    </div>					
</div>