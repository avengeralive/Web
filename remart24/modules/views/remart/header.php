<? 
$roles = array();
$roles[2] = 'admin'; 
$roles[4] = 'project_manager'; 
$roles[5] = 'realtor'; 
$roles[6] = 'credit_specialist'; 
$roles[7] = 'appraiser'; 
$roles[8] = 'buyer'; 
?>
<header>
    <div class="row">
	<div class="col-12" id="menu">
	    <div class="container">
		<div class="row">
		    <div class="col-12">
			<a href="/dashboard" style="display: inline-block; margin-top: 20px; margin-left: -50px; font-size: 2.5rem; color: #fff; text-decoration: none;">Remart <span style="font-size: 1em; color:#11dde0;">24</span></a>
			
			<ul class="navbar-nav mr-auto"> 
			    <? if (Backstage::gi()->login != '') { ?>
			    <? if ($item->role_id == 8) { ?>
			    <li class="nav-item"><a class="favbut" data-toggle="modal" data-target="#bids" title="" style="cursor: pointer;"><? echo Translations::gi()->send_bid; ?></a></li>
			    <? } ?>
			    <li class="nav-item"><a href="/favorites" class="favbut"><? echo Translations::gi()->favorites; ?> ( <? echo $favorites->cnt; ?> )</a></li>
			   
			    <li class="nav-item"><? echo Translations::gi()->{$roles[$item->role_id]}; ?> / <span class="cyan"><? echo $item->name; ?> <? echo $item->surname; ?></span></li>
			    <li class="nav-item">|</li>
			    <li class="nav-item"><a data-toggle="modal" data-target="#change" style="cursor: pointer;"><? echo Translations::gi()->change_pass; ?></a></li>
			    <li class="nav-item"><a class="nav-link" href="/auth/logout" title="<? echo Translations::gi()->logout; ?>"><i class="cyan fa fa-sign-out"></i></a></li>
			<? } ?>
			[[module type=pages action=getLangBar design=lang_bar]]
			</ul>
			
		    </div>
		    <? if (isset($request->parameters['p']) && ($request->parameters['p'] == 'objects' || $request->parameters['p'] == 'favorites')) { ?>
		    <style>
			#head img { min-height: 500px; }
			h1 { width: 80%; margin: 0 auto; color: #fff; }
			#head:after {
			    background: linear-gradient(to right, rgba(83, 85, 183, .6), rgba(89, 167, 180, .6));
			}
		    </style>
		    <div class="col-12">
			<h1 style="margin-top: 160px;"><? echo translations::gi()->head1; ?></h1>
			<div id="searchbox">
			    <div class="col-12 row">
				<div class="col-12 col-sm-6 col-md-3 pre">
				    <select class="form-control type">
					<option value=""><? echo Translations::gi()->object_type; ?></option>
					<option value="1"><? echo Translations::gi()->apartment; ?></option>
					<option value="2"><? echo Translations::gi()->private_home; ?></option>
					<option value="3"><? echo Translations::gi()->new_build; ?></option>
					<option value="4"><? echo Translations::gi()->old_build; ?></option>
				    </select>
				</div>
				<div class="col-12 col-sm-6 col-md-9 pre">
				    <input type="text" class="form-control line" placeholder="<? echo Translations::gi()->search_line; ?>"> 
				</div>
			    </div>
			    <div class="col-12 row">
				<div class="col-12 col-sm-6 col-md-3 pre">
				    <div class="btn-group" style="width: 100%;">
					<button class="btn btn-secondary btn-sm dropdown-toggle roombtn" id="city" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->city; ?></button>
					<div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff; max-height: 300px; overflow: scroll;">
					    <label style="width:100%"><input type="checkbox" name="cityall" class="cityall"><? echo Translations::gi()->select_all; ?></label>
					<? foreach ($objcities as $city) { ?>
					    <label style="width:100%"><input type="checkbox" name="city" class="city" value="<? echo $city->id; ?>" data-title="<? echo $city->name; ?>"><? echo $city->name; ?></label>
					<? } ?>
					</div>
				    </div>
				</div>
				<div class="col-12 col-sm-6 col-md-2 pre">
				    <!--<select class="form-control room">
					<option value=""><? echo Translations::gi()->room; ?></option>
				    <? for ( $i = 1; $i <= 9; $i++ ) { ?>
					<option value="<? echo $i; ?>"><? echo $i; ?></option>
				    <? } ?>
					<option value="10">10+</option>
				    </select>-->
				    <div class="btn-group" style="width: 100%;">
					<button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="room"><? echo Translations::gi()->room; ?></button>
					<div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
					<? for ( $i = 1; $i <= 9; $i++ ) { ?>
					<label style="width:100%"><input type="checkbox" name="room" class="room" value="<? echo $i; ?>"><? echo $i; ?></label>
					<? } ?>   
					<label style="width:100%"><input type="checkbox" name="room" class="room" value="10">10+</label>
					</div>
				    </div>
				</div>
				<div class="col-12 col-sm-12 col-md-7 row">  
				    <div class="col-12 col-sm-6 col-md-3 pre"><input type="text" class="form-control square_min" placeholder="<? echo Translations::gi()->square_min; ?>"></div>
				    <div class="col-12 col-sm-6 col-md-3 pre"><input type="text" class="form-control square_max" placeholder="<? echo Translations::gi()->square_max; ?>"></div>
				    <div class="col-12 col-sm-6 col-md-3 pre"><input type="text" class="form-control price_min" placeholder="<? echo Translations::gi()->price_min; ?>"></div>
				    <div class="col-12 col-sm-6 col-md-3 pre"><input type="text" class="form-control price_max" placeholder="<? echo Translations::gi()->price_max; ?>"></div>
				</div>
			    </div>
			    <div class="col-12 row">
				<div class="col-12 col-sm-6 col-md-3 pre">
				    <div class="btn-group" style="width: 100%;">
					<button class="btn btn-secondary btn-sm dropdown-toggle roombtn" id="region" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->region; ?></button>
					<div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
					    <label style="width:100%"><input type="checkbox" name="region" class="regionall"><? echo Translations::gi()->select_all; ?></label>
					<? foreach ($objregions as $region) { ?>
					    <label style="width:100%"><input type="checkbox" name="region" class="region" value="<? echo $region->id; ?>" data-title="<? echo $region->name; ?>"><? echo $region->name; ?></label>
					<? } ?>
					</div>
				    </div>
				</div>
				<div class="col-12 col-sm-6 col-md-3 pre">
				    <div class="btn-group" style="width: 100%;">
					<button class="btn btn-secondary btn-sm dropdown-toggle roombtn" id="metro" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->metro; ?></button>
					<div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
					    <label style="width:100%"><input type="checkbox" name="metroall" class="metroall"><? echo Translations::gi()->select_all; ?></label>
					<? foreach ($objmetros as $metro) { ?>
					    <label style="width:100%"><input type="checkbox" name="metro" class="metro" value="<? echo $metro->id; ?>" data-title="<? echo $metro->name; ?>"><? echo $metro->name; ?></label>
					<? } ?>
					</div>
				    </div>
				</div>
				<div class="col-12 col-sm-12 col-md-3 pre">
				</div>
				<div class="col-12 col-sm-12 col-md-3 pre">
				    <button class="btn search" id="searchbut"><? echo Translations::gi()->search; ?></button>
				</div>
			    </div>
			    <input type="hidden" class="form-control id" value="">
			    <input type="hidden" class="form-control address" value="">
			    <? if ($item->role_id == 7) { ?>
			    <input type="hidden" class="form-control status" value="5">
			    <? } else if ($item->role_id == 8) { ?>
			    <input type="hidden" class="form-control status" value="5,7">
			    <? } else { ?>
			    <input type="hidden" class="form-control status" value="5,7">
			    <? } ?>
			</div>
			<script type="text/javascript">
			    $(function() {
				$("#searchbox .regionall").on('change', function() { 
				    if ($("#searchbox .regionall").prop('checked')) $("#searchbox .region").prop("checked", true); 
				    else $("#searchbox .region").prop("checked", false);
				    if ($("#searchbox .region:checked").length > 0) $("#region").html("<? echo Translations::gi()->region; ?>: <? echo Translations::gi()->all; ?>");
				    else $("#region").html("<? echo Translations::gi()->region; ?>");
				});
				$("#searchbox .metroall").on('change', function() { 
				    if ($(".metroall").prop('checked')) $(".metro").prop("checked", true); 
				    else $(".metro").prop("checked", false);
				    if ($("#searchbox .metro:checked").length > 0) $("#metro").html("<? echo Translations::gi()->metro; ?>: <? echo Translations::gi()->all; ?>");
				    else $("#metro").html("<? echo Translations::gi()->metro; ?>");
				});
				$(".cityall").on('change', function() { 
				    if ($(".cityall").prop('checked')) $(".city").prop("checked", true); 
				    else $(".city").prop("checked", false); 
				    if ($("#searchbox .city:checked").length > 0) $("#city").html("<? echo Translations::gi()->city; ?>: <? echo Translations::gi()->all; ?>");
				    else $("#city").html("<? echo Translations::gi()->city; ?>"); 
				});
				$(".sort").on('change', function() { 
				    $("#sort").html($(this).attr('data-title')); 
				});
				$("#searchbox .city").on('click', function() {
				    var add = '';
				    if ($("#searchbox .city:checked").length != 0) add = ": " + $($("#searchbox .city:checked")[0]).attr('data-title'); 
				    if ($("#searchbox .city:checked").length - 1 > 0) add = add + ' (+' + ($("#searchbox .city:checked").length - 1) + ')';
				    $("#city").html("<? echo Translations::gi()->city; ?>" + add); 
				});
				$("#searchbox .region").on('click', function() {
				    var add = '';
				    if ($("#searchbox .region:checked").length != 0) add = ": " + $($("#searchbox .region:checked")[0]).attr('data-title'); 
				    if ($("#searchbox .region:checked").length - 1 > 0) add = add + ' (+' + ($("#searchbox .region:checked").length - 1) + ')';
				    $("#region").html("<? echo Translations::gi()->region; ?>" + add); 
				});
				$("#searchbox .metro").on('click', function() { 
				    var add = '';
				    if ($("#searchbox .metro:checked").length != 0) add = ": " + $($("#searchbox .metro:checked")[0]).attr('data-title'); 
				    if ($("#searchbox .metro:checked").length - 1 > 0) add = add + ' (+' + ($("#searchbox .metro:checked").length - 1) + ')';
				    $("#metro").html("<? echo Translations::gi()->metro; ?>" + add);
				});
				$("#searchbox .room").on('click', function() { 
				    var add = '';
				    if ($("#searchbox .room:checked").length == 0) add = '<? echo Translations::gi()->room; ?>';
				    else {
					var adds = [];
					for (i=0; i<$("#searchbox .room:checked").length; i++)
					{
					    adds.push($($("#searchbox .room:checked")[i]).val());
					}
					add = adds.join(', ') + " комн.";
				    }
				    $("#room").html(add);
				});
			    });
			</script>
		    </div>
		    <? } ?>
		    <? if ((isset($request->parameters['p']) && $request->parameters['p'] == 'home') || !isset($request->parameters['p'])) { ?>
		    <style>
			.spoiler { font-size: 20px; padding-top: 200px; }
			h1, p { color: #fff; text-align: center; }
			h1 { font-size: 2em; }
			p { font-size: 1em; }
			@media (max-width: 575px) {
			    #head {
				height: 950px !important;
				min-height: 850px !important;
				width: auto;
			    }
			}
		    </style>
		    <div class="col-12 spoiler">
			<h1><? echo Translations::gi()->head1; ?></h1>
			<p><? echo Translations::gi()->head2; ?></p>
			<? if (Backstage::gi()->login == '') { ?>
			<a href="/login" class="loginbtn"><? echo Translations::gi()->log_in; ?></a>
			<style>.spoiler { padding-top: 18vh; }</style>
			<? } ?>
		    </div>
		    <? } ?>
		</div>
	    </div>
	</div>
	<div class="col-12" id="head">
	    <? if ((isset($request->parameters['p']) && $request->parameters['p'] == 'home') || !isset($request->parameters['p'])) { ?>
	    <img src="[[$TEMPLATE_URL]]images/layer_main.jpg" />
	    <? } else if ($request->parameters['p'] == 'objects' || $request->parameters['p'] == 'favorites') { ?>
	    <img src="[[$TEMPLATE_URL]]images/remart_layer_3.jpg" />
	    <? } else if ($request->parameters['p'] == 'login' || $request->parameters['p'] == 'forgot') { ?>
	    <img src="[[$TEMPLATE_URL]]images/remart_layer.jpg" />
	    <? } else { ?>
	    <style>#head { min-height: 120px; }
	    #head:after {
		background: linear-gradient(to right, rgba(48, 55, 102, 1), rgba(89, 167, 180, 1));
	    }
	    </style>
	    <? } ?>
	</div>
    </div>
</header>
<? if ($item->role_id == 8) { ?>
<div class="modal fade" id="bids" tabindex="-1" role="dialog" aria-labelledby="changeLabel" aria-hidden="true">		
    <div class="modal-dialog" role="document">
	<div class="modal-content">
	    <div class="modal-header">
		<h5 class="modal-title" id="changeLabel">Оставить заявку на подбор недвижимости</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    <span aria-hidden="true">×</span>
		</button>
	    </div>							
	    <div class="modal-body">
		<div class="container-fluid">
		    <form id="needs-validation" novalidate>
			<div class="row">
			    <div class="form-group col-12">
				<label for="phone"><? echo Translations::gi()->phone; ?></label>
				<p>
				    <input type="text" class="form-control" name="mobile1" id="phone1" value="+994" style="width:60px; float: left; margin-right: 10px;" disabled>
				    <select class="form-control" name="mobile2" id="phone2" style="width:60px; float: left; margin-right: 10px;">
					<option value="50">50</option>
					<option value="51">51</option>
					<option value="55">55</option>
					<option value="70">70</option>
					<option value="77">77</option>
				    </select>
				    <input type="text" class="form-control" name="mobile3" id="phone3" maxlength="3" style="width:48px; float: left; margin-right: 10px;" required>
				    <input type="text" class="form-control" name="mobile4" id="phone4" maxlength="2" style="width:40px; float: left; margin-right: 10px;" required>
				    <input type="text" class="form-control" name="mobile5" id="phone5" maxlength="2" style="width:40px; float: left;" required>
				</p>
			    </div>
			</div> 
			<div class="row">
			    <div class="form-group col-12">
				<label for="email">E-mail</label>
				<input type="text" class="form-control" name="email" id="email" placeholder="<? echo Translations::gi()->email; ?>" required>
			    </div>
			</div>
			<div class="row">
			    <div class="form-group col-12">
				<label for="type"><? echo Translations::gi()->object_type; ?></label>
				<div class="btn-group" style="width: 100%;">
				    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="bidtype"><? echo Translations::gi()->object_type; ?></button>
				    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff; max-height: 300px; overflow:scroll;">
				    <label style="width:100%"><input type="checkbox" name="type" class="type" value="0" data-title="<? echo Translations::gi()->all ?>"><? echo Translations::gi()->all ?></label>
				    <label style="width:100%"><input type="checkbox" name="type" class="type" value="1" data-title="<? echo Translations::gi()->new_build ?>"><? echo Translations::gi()->new_build ?></label>
				    <label style="width:100%"><input type="checkbox" name="type" class="type" value="2" data-title="<? echo Translations::gi()->old_build ?>"><? echo Translations::gi()->old_build ?></label>
				    <label style="width:100%"><input type="checkbox" name="type" class="type" value="3" data-title="<? echo Translations::gi()->private_h ?>"><? echo Translations::gi()->private_h ?></label>
				    </div>
				</div>
			    </div>
			</div>
			<div class="row">
			    <div class="form-group col-12">
				<label for="city"><? echo Translations::gi()->select_city; ?></label>
				<div class="btn-group" style="width: 100%;">
				    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="bidcity"><? echo Translations::gi()->city; ?></button>
				    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff; max-height: 300px; overflow:scroll;">
				    <? foreach ($cities as $city) { ?>
					<label style="width:100%"><input type="checkbox" name="city" class="city" value="<? echo $city->id; ?>" data-title="<? echo $city->name; ?>"><? echo $city->name; ?></label>
				    <? } ?>
				    </div>
				</div>
			    </div>
			</div>
			<div class='row'>
			    <div class="form-group col-12">
				<label for="region"><? echo Translations::gi()->select_region; ?></label>
				<div class="btn-group" style="width: 100%;">
				    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="bidregion"><? echo Translations::gi()->region; ?></button>
				    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
				    <? foreach ($regions as $region) { ?>
					<label style="width:100%"><input type="checkbox" name="region" class="region" data-title="<? echo $region->name; ?>" value="<? echo $region->id; ?>"><? echo $region->name; ?></label>
				    <? } ?>
				    </div>
				</div>
			    </div>
			</div>
			<div class="row">
			    <div class="form-group col-md-6">
				<label for="room"><? echo Translations::gi()->room; ?></label>
				<div class="btn-group" style="width: 100%;">
				    <button class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="bidroom"><? echo Translations::gi()->room; ?></button>
				    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
				    <? for ( $i = 1; $i <= 9; $i++ ) { ?>
					<label style="width:100%"><input type="checkbox" name="room" class="room" value="<? echo $i; ?>"><? echo $i; ?></label>
				    <? } ?>
				    <label style="width:100%"><input type="checkbox" name="room" class="room" value="10">10+</label>
				    </div>
				</div>
			    </div>
			    <div class="form-group col-md-6">
				<label for="price_max"><? echo Translations::gi()->price_max; ?></label>
				<input type="text" class="form-control" name="price_max" id="price_max" placeholder="<? echo Translations::gi()->price_max; ?>" required>
			    </div>
			</div>
			<div class="row">
			    <div class="form-group col-md-12 row">
				<label for="comment"><? echo Translations::gi()->comment; ?></label>
				<textarea class="form-control" name="comment" id="comment" placeholder="<? echo Translations::gi()->comment; ?>" rows="6"></textarea>
			    </div>
			</div>
			<div class="row">
			    <div class="form-group col-md-12">
				<label for="notify" style='font-weight: 400;'><input type="checkbox" name="notify" id="notify" checked disabled><? echo Translations::gi()->bid_notify; ?></label>
			    </div>
			</div>
			<div class="row">
			    <div class="form-group col-md-12">
				<button class='btn btn-success' id='sendbid'><? echo Translations::gi()->send; ?></button>
			    </div>
			</div>
		    </form>
		    <script>
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
			$(function(){
				$("#bids .city").on('click', function() {
				    var add = '';
				    if ($("#bids .city:checked").length != 0) add = ": " + $($("#bids .city:checked")[0]).attr('data-title'); 
				    if ($("#bids .city:checked").length - 1 > 0) add = add + ' (+' + ($("#bids .city:checked").length - 1) + ')';
				    $("#bidcity").html("<? echo Translations::gi()->city; ?>" + add); 
				});
				$("#bids .type").on('click', function() {
				    var add = '';
				    if ($("#bids .type:checked").length != 0) add = ": " + $($("#bids .type:checked")[0]).attr('data-title'); 
				    if ($("#bids .type:checked").length - 1 > 0) add = add + ' (+' + ($("#bids .type:checked").length - 1) + ')';
				    $("#bidtype").html("<? echo Translations::gi()->object_type; ?>" + add); 
				});
				$("#bids .region").on('click', function() { console.log();
				    var add = '';
				    if ($("#bids .region:checked").length != 0) add = ": " + $($("#bids .region:checked")[0]).attr('data-title'); 
				    if ($("#bids .region:checked").length - 1 > 0) add = add + ' (+' + ($("#bids .region:checked").length - 1) + ')';
				    $("#bidregion").html("<? echo Translations::gi()->region; ?>" + add); 
				});
				$("#bids .room").on('click', function() { 
				    var add = '';
				    if ($("#bids .room:checked").length == 0) add = '<? echo Translations::gi()->room; ?>';
				    else {
					var adds = [];
					for (i=0; i<$("#bids .room:checked").length; i++)
					{
					    adds.push($($("#bids .room:checked")[i]).val());
					}
					add = adds.join(', ') + " комн.";
				    }
				    $("#bidroom").html(add);
				});
			    var phone1 = phone_parser("<? echo $item->mobile; ?>");
			    $("#phone2").val(phone1.code);
			    $("#phone3").val(phone1.part1);
			    $("#phone4").val(phone1.part2);
			    $("#phone5").val(phone1.part3);
			    $("#email").val("<? echo $item->email; ?>");
			    $("#sendbid").on('click', function(event){
				if ($("#needs-validation")[0].checkValidity() == false) {
				    event.preventDefault();
				    event.stopPropagation();
				}
				else
				{	
				    var type = [];
				    $('#bids .type').each(function(e,v){ if ($(v).prop('checked')) type.push($(v).val()); });
				    type = type.join();
				    if (type.length == 0) type = '0,1,2,3';

				    var room = [];
				    $('#bids .room').each(function(e,v){ if ($(v).prop('checked')) room.push($(v).val()); });
				    room = room.join();
				    if (room.length == 0) room = '1,2,3,4,5,6,7,8,9,10';

				    var city = [];
				    var cities = [];
				    $('#bids .city').each(function(e,v){ cities.push($(v).val()); if ($(v).prop('checked')) city.push($(v).val()); });
				    city = city.join();
				    if (city.length == 0) city = cities.join();

				    var region = [];
				    var regions = [];
				    $('#bids .region').each(function(e,v){ regions.push($(v).val()); if ($(v).prop('checked')) region.push($(v).val()); });
				    region = region.join();
				    if (region.length == 0) region = regions.join();

				    if ($("#notify").prop("checked", true)) notify = 1;
				    else notify = 0;
				    $.ajax({
					url: '/remart/save_bid',
					method: 'post',
					dataType: 'json',
					data: {
					    buyer: <? echo $item->id; ?>, 
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
						alert('<? echo Translations::gi()->bid_success; ?>');
						$("#bids").modal('hide');
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
	    </div>	
	</div>
    </div>					
</div>
<? } ?>
<? if ($item->role_id == 6) { ?>
<style>
#buyers th:nth-child(4), #buyers td:nth-child(4)
{
    display: none !important;
}
</style>
<? } ?>
<style type="text/css">
.lang_<? echo Backstage::gi()->portal_current_lang; ?> { color: #0fdde0 !important; }
.objitem img { height: 260px;  }
.dropdown-menu label:hover { background: rgba(31, 152, 153, 1); }
.dropdown-menu { padding: 0px !important; }
.dropdown-menu label { padding: 1px 10px; }
@media (max-width: 767px) { .ps-list { display: none !important; } }
</style>
<script type="text/javascript">
	$(document).on('click', '.dropdown-menu', function (e) {
	  e.stopPropagation();
	});
</script>