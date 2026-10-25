<form id="needs-validation" novalidate>
    <input type="hidden" id="photo">
    <input type="hidden" id="main_photo">
    <input type="hidden" id="kupche_doc">
    <input type="hidden" id="texpass_doc">
    <input type="hidden" id="lat" name="lat" value="">
    <input type="hidden" id="lng" name="lng" value="">
    <div class="row">
	<div class="form-group col-md-4 col-lg-4 col-xl-4" <? if ($item->role_id == 5) { ?>style="display: none;"<? } ?>>
	    <label for="buyer"><? echo Translations::gi()->buyer; ?></label>
	    <select class="form-control" id="buyer" name="buyer" required>
		<option value='<? echo $item->id; ?>'>Remart</option>
		<? foreach ($buyers as $buyer) { ?>
		<option value="<? echo $buyer->id; ?>"><? echo $buyer->surname; ?> <? echo $buyer->name; ?></option>
		<? } ?>
	    </select>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4" <? if ($item->role_id == 5) { ?>style="display: none;"<? } ?>>
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
	<div class="form-group col-md-4 col-lg-4 col-xl-4" <? if ($item->role_id == 5) { ?>style="display: none;"<? } ?>>
	    <label for="email">E-mail</label>
	    <input type="text" class="form-control" name="email" id="email" placeholder="<? echo Translations::gi()->email; ?>" required>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="type"><? echo Translations::gi()->object_type; ?></label>
	    <div class="btn-group" style="width: 100%;">
		<button class="btn btn-secondary btn-sm dropdown-toggle roombtn" id="btype" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->object_type; ?></button>
		<div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff; max-height: 300px; overflow:scroll;">
		<label style="width:100%"><input type="checkbox" name="type" class="type" value="0" data-title="<? echo Translations::gi()->all ?>"><? echo Translations::gi()->all ?></label>
		<label style="width:100%"><input type="checkbox" name="type" class="type" value="1" data-title="<? echo Translations::gi()->new_build ?>"><? echo Translations::gi()->new_build ?></label>
		<label style="width:100%"><input type="checkbox" name="type" class="type" value="2" data-title="<? echo Translations::gi()->old_build ?>"><? echo Translations::gi()->old_build ?></label>
		<label style="width:100%"><input type="checkbox" name="type" class="type" value="3" data-title="<? echo Translations::gi()->private_h ?>"><? echo Translations::gi()->private_h ?></label>
		</div>
	    </div>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="city"><? echo Translations::gi()->select_city; ?></label>
	    <div class="btn-group" style="width: 100%;">
		<button id="bcity" class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->city; ?></button>
		<div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff; max-height: 300px; overflow:scroll;">
		<? foreach ($cities as $city) { ?>
		    <label style="width:100%"><input type="checkbox" name="city" class="city" value="<? echo $city->id; ?>" data-title="<? echo $city->name; ?>"><? echo $city->name; ?></label>
		<? } ?>
		</div>
	    </div>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="region"><? echo Translations::gi()->select_region; ?></label>
	    <div class="btn-group" style="width: 100%;">
		<button id="bregion" class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->region; ?></button>
		<div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
		<? foreach ($regions as $region) { ?>
		    <label style="width:100%"><input type="checkbox" name="region" class="region" value="<? echo $region->id; ?>" data-title="<? echo $region->name; ?>"><? echo $region->name; ?></label>
		<? } ?>
		</div>
	    </div>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
	    <label for="room"><? echo Translations::gi()->room; ?></label>
	    <div class="btn-group" style="width: 100%;">
		<button id="broom" class="btn btn-secondary btn-sm dropdown-toggle roombtn" style="text-align: left;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? echo Translations::gi()->room; ?></button>
		<div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;">
		<? for ( $i = 1; $i <= 9; $i++ ) { ?>
		    <label style="width:100%"><input type="checkbox" name="room" class="room" value="<? echo $i; ?>" data-title="<? echo $i; ?>"><? echo $i; ?></label>
		<? } ?>
		<label style="width:100%"><input type="checkbox" name="room" class="room" value="10">10+</label>
		</div>
	    </div>
	</div>
	<div class="form-group col-md-4 col-lg-4 col-xl-4">
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
	    <label for="notify" style='font-weight: 400;'><input type="checkbox" name="notify" id="notify"><? echo Translations::gi()->bid_notify; ?></label>
	</div>
    </div>
</form>
<script>
    function changeParams3() {
	if ($("#city").val() != 6)
	{
	    $('#region').attr('disabled', 'disabled');
	}
	else
	{
	    $('#region').attr('disabled', false);
	}
    };
    $(function(){
	$("#city").val(6);
	$("#city").on('change', changeParams3);
    })
</script>