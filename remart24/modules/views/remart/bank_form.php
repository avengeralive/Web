<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKjDgq1wATQHlVPSc7nNQqF8oUMKf9-PM" type="text/javascript"></script>
<form id="needs-validation" novalidate>
    <input type="hidden" id="logo">
    <div class="row">
	<div class="form-group col-md-6">
	    <label for="type"><? echo Translations::gi()->bank_name; ?></label>
	    <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="<? echo Translations::gi()->bank_name; ?>" required>
	</div>
	<div class="form-group col-md-6">
	    <label for="type"><? echo Translations::gi()->website; ?></label>
	    <input type="text" class="form-control" name="website" id="website" placeholder="<? echo Translations::gi()->bank_name; ?>" required>
	</div>
    </div>
    <div class="row">
	<div class="form-group col-md-12 row">
	    <label>Лого</label>
	    <div id="object-photo" class="dropzone"></div>
	</div>
    </div>
    <div class="row">
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 images row"></div>
    </div>
    <div class="row">
	<div class="form-group col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
	    <label for="first"><? echo Translations::gi()->name; ?></label>
	    <input type="text" class="form-control" name="name" id="name" placeholder="<? echo Translations::gi()->name; ?>" required>
	</div>
	<div class="form-group col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
	    <label for="last"><? echo Translations::gi()->surname; ?></label>
	    <input type="text" class="form-control" name="surname" id="surname" placeholder="<? echo Translations::gi()->surname; ?>" required>
	</div>
	<div class="form-group col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
	    <label for="patronymic"><? echo Translations::gi()->position; ?></label>
	    <input type="text" class="form-control" name="position" id="position" placeholder="<? echo Translations::gi()->position; ?>">
	</div>
    </div>
    <div class="row">
	<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
	    <label for="email">E-mail</label>
	    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required>
	</div>
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
    </div>
    <div class="row">
	<div class="form-group col-md-12">
	    <label for="comment"><? echo Translations::gi()->comment; ?></label>
	    <textarea class="form-control" name="comment" id="comment" placeholder="<? echo Translations::gi()->comment; ?>" rows="6"></textarea>
	</div>
    </div>
</form>
<script>
    Dropzone.autoDiscover = false;
    //Object photo
    jQuery("#object-photo").dropzone({
	url: '/materials/temp/dropzone.php?session_id=<?php echo session_id(); ?>',
	acceptedFiles: 'image/*',
	timeout: 1000000,
	method: "post",
	success: function (file, response) {
	    file.previewElement.classList.add("dz-success");
	    name = response;
	    if ($("#logo").val() == '') $("#logo").val(name);
	    else $("#logo").val($("#logo").val() + ',' + name);
	    $.ajax({
		url: '/remart/getImages?ids=' + $('#logo').val(),
		method: 'get',
		dataType: 'json',
		success: function(data) {			   
		    $('.images').html('');
		    for (i in data) 
		    {
			if (data[i].id == $("#main_photo").val()) main = '<i class="fa fa-close"></i>';
			else main = '<i class="fa fa-check"></i>';
			$('.images').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"><img src="/materials/temp/files/' + data[i].material_path + '" style="width: 100%;"><button class="btn btn-sm btn-danger delete" data-name="' + data[i].id + '"><i class="fa fa-trash"></i></button> <input type="text" class="photo_ordering form-control" data-id="' + data[i].id + '" value="' + data[i].ordering + '"></div>');
		    }
		}
	    });
	},
	error: function (file, response) {
	    file.previewElement.classList.add("dz-error");
	}
    });
    $(function(){
	$(document).on('click', '.delete', function(){
	    $('#logo').val('');
	    $(this).parent().remove();
	});
    });
</script>