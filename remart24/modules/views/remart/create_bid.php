<div class="row">
    <div class="container">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style='padding: 15px 0px 0px 0px;'>
	    <h1><? echo Translations::gi()->create_bid; ?></h1>
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <button class="btn btn-success save" type="submit"><? echo Translations::gi()->save; ?></button>
	    <a href="/dashboard" class="btn btn-danger"><? echo Translations::gi()->close; ?></a>
	</div>
    </div>
</div>
<div class="row formbody">
    <div class="container">
    <? include('bid_form.php'); ?>
    </div>
    <script>
	$(function(){
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
				
	    $(".save").on('click', function(event){
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
		    
		    if ($("#notify").prop("checked", true)) notify = 1;
		    else notify = 0;
		    $.ajax({
			url: '/remart/save_bid',
			method: 'post',
			dataType: 'json',
			data: {
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
				alert('<? echo Translations::gi()->bid_create_success; ?>');
				window.location = '/dashboard';
			    }
			    else
			    {
				alert('<? echo Translations::gi()->bid_create_error; ?>');
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