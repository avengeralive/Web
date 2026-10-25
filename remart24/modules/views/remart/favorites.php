<div class="row" style="background:#d1d3e4;">
    <div class="container">
	<div style="margin:0px; width: 80%; margin: 0 auto; display: block; padding: 10px 15px;">
	    <p style="float: right; margin: 0px;">
		<div class="btn-group" style="float:right;">
		    <button id="sort" class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<? echo Translations::gi()->sort; ?>
		    </button>
		    <div class="dropdown-menu" style="padding: 10px; background-color: rgba(31, 152, 153, 0.75); color: #fff;  width: 225px;">
			<label><input type="radio" name="sort" class="sort" value="o.price DESC" checked><? echo Translations::gi()->sort1; ?></label>
			<label><input type="radio" name="sort" class="sort" value="o.price ASC"><? echo Translations::gi()->sort2; ?></label>
			<label><input type="radio" name="sort" class="sort" value="o.square DESC"><? echo Translations::gi()->sort3; ?></label>
			<label><input type="radio" name="sort" class="sort" value="o.square ASC"><? echo Translations::gi()->sort4; ?></label>
		    </div>
		</div>
	    </p>
	</div>
    </div>
</div>
<div class="row" style="background:#e8e7ed; padding: 50px 0px;">
    <div class="container">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 row" id="objects">
	</div>
	<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="pagination" style="padding-left: 30px;">
	</div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    var limit_object = 18;
    get_objects(limit_object, 0);
    function get_objects(limit, offset)
    {
	$('.sort').each(function(e,v){ if ($(v).prop('checked')) sort = $(v).val(); });
	var room = [];
	$('#searchbox .room').each(function(e,v){ if ($(v).prop('checked')) room.push($(v).val()); });
	room = room.join();
	if (room.length == 0) room = '1,2,3,4,5,6,7,8,9,10';
	var city = [];
	var cities = [];
	$('#searchbox .city').each(function(e,v){ cities.push($(v).val()); if ($(v).prop('checked')) city.push($(v).val()); });
	city = city.join();
	if (city.length == 0) city = cities.join();

	var region = [];
	var regions = [];
	$('#searchbox .region').each(function(e,v){ regions.push($(v).val()); if ($(v).prop('checked')) region.push($(v).val()); });
	region = region.join();
	if (region.length == 0) {
		regions.push(0);
		region = regions.join();
	}
	var metro = [];
	var metros = [];
	$('#searchbox .metro').each(function(e,v){ metros.push($(v).val()); if ($(v).prop('checked')) metro.push($(v).val()); });
	metro = metro.join();
	if (metro.length == 0) {
		metros.push(0);
		metro = metros.join();
	}
	var type = '';
	var ap_type = '';
	if ($("#searchbox .type").val() < 3) type = $("#searchbox .type").val();
	else {
		type = 1;
		ap_type = $("#searchbox .type").val() - 2;
	}
	$.ajax({
	    url: '/remart/get_favorites',
	    method: 'get',
	    dataType: 'json',
	    data: {
		limit: limit,
		offset: offset,
		id: $("#searchbox .id").val(),
		type: type,
		ap_type: ap_type,
		room: room,
		square_min: ($("#searchbox .square_min").val() == "") ? 0 : $("#searchbox .square_min").val(),
		square_max: ($("#searchbox .square_max").val() == "") ? 1000000000 : $("#searchbox .square_max").val(),
		price_min: ($("#searchbox .price_min").val() == "") ? 0 : $("#searchbox .price_min").val(),
		price_max: ($("#searchbox .price_max").val() == "") ? 1000000000 : $("#searchbox .price_max").val(),
		city: city,
		region: region,
		address: $("#searchbox .address").val(),
		metro: metro,
		realtor: '%',
		status: $("#searchbox .status").val(),
		sort: sort,
		user: <? echo isset($_GET['user']) ? $_GET['user'] : $item->id; ?>,
		search: ($("#searchbox .line").val() == "") ? '%' : $("#searchbox .line").val(),
		pm: '%'
	    },
	    success: function(data) {
		$("#objects").html('');
		var status = [];
		status[1] = 'created';
		status[2] = 'pending';
		status[3] = 'rejected';
		status[4] = 'pending correction';
		status[5] = 'pending valuate';
		status[6] = 'pending approve';
		status[7] = 'approved';
		status[8] = 'sold';
		var proj = [];
		proj[1] = "<? echo Translations::gi()->pro_1; ?>";
		proj[2] = "<? echo Translations::gi()->pro_2; ?>";
		proj[3] = "<? echo Translations::gi()->pro_3; ?>";
		proj[4] = "<? echo Translations::gi()->pro_4; ?>";
		proj[5] = "<? echo Translations::gi()->pro_5; ?>";
		proj[6] = "<? echo Translations::gi()->pro_6; ?>";
		proj[7] = "<? echo Translations::gi()->pro_7; ?>";
		proj[8] = "<? echo Translations::gi()->pro_8; ?>";
		proj[9] = "<? echo Translations::gi()->pro_9; ?>";
		proj[10] = "<? echo Translations::gi()->pro_10; ?>";
		for (i in data.data)
		{
		    var favorite = '';
		    favorite = '<i class="fa fa-star favorite" data-id="' + data.data[i].id + '"></i>';
		    var ap_type = [];
		    ap_type[1] = "<? echo Translations::gi()->new_build; ?>";
		    ap_type[2] = "<? echo Translations::gi()->old_build; ?>";
		    var params = '';
		    params = params + '<li><i class="fa fa-circle"></i> ' + data.data[i].room + ' <? echo Translations::gi()->rooms; ?></li>';
		    params = params + '<li><i class="fa fa-circle"></i> ' + data.data[i].square + ' м<sup>2</sup></li>';
		    var location = data.data[i].city;
		    if (data.data[i].region != null) location = location + ', ' + data.data[i].region;
		    if (data.data[i].type == 1)
		    {
			if (data.data[i].ap_type == 1) data.data[i].type = ap_type[1];
			else data.data[i].type = ap_type[2] + ' / ' + proj[data.data[i].project];
			params = params + '<li><i class="fa fa-circle"></i> <? echo Translations::gi()->floor1; ?> ' + data.data[i].floor + '/' + data.data[i].floors + '</li>';
		    }
		    else
		    {
			data.data[i].type = "<? echo Translations::gi()->private_h; ?>";
			params = params + '<li><i class="fa fa-circle"></i> <? echo Translations::gi()->ucha; ?> ' + data.data[i].square_zeml + ' <? echo Translations::gi()->ucha; ?></li>';
		    }
		    $("#objects").append('<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 objitem row"><span class="price">' + data.data[i].price.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + ' <i class="white manat"></i></span><div class="col-12 row"><div class="col-12" style="padding: 0;"><a target="_blank" href="/view?id=' + data.data[i].id + '"><img src="/materials/temp/files/' + data.data[i].main_photo + '"></a></div><div class="col-9" style="padding: 15px 0px; padding-left: 15px;"><p><i class="fa fa-map-marker"></i> ' + location + '</p><p><i class="fa fa-key"></i> ' + data.data[i].type + '</p></div><div class="col-3" style="text-align: right; padding: 15px 0px; padding-right: 15px;">' + favorite + '</div><div class="col-12 params"><ul class="inline">' + params + '</ul></div></div></div>');
		}
		var pages = Math.ceil(data.count / limit);
		var current_page = Math.ceil(offset / limit) + 1;
		var previous_page = '';
		var next_page = '';
		var pagination_container = '';
		for (i = 1; i < current_page; i++)
		{
		    pagination_container += '<li class="page-item"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
		}
		pagination_container += '<li class="page-item active"><a class="page-link" href="#" data-page="' + current_page + '">' + current_page + '</a></li>';
		for (i = current_page + 1; i <= pages; i++)
		{
		    pagination_container += '<li class="page-item"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
		}
		if (current_page > 1) previous_page = '<li class="page-item"><a class="page-link" href="#" data-page="' + (current_page - 1) + '"><i class="fa fa-angle-left"></i></a></li>';
		if (current_page < pages) next_page = '<li class="page-item"><a class="page-link" href="#" data-page="' + Number(current_page + 1) + '"><i class="fa fa-angle-right"></i></a></li>';
		pagination_container = '<nav aria-label="User paginations"><ul class="pagination">' + previous_page + pagination_container + next_page + '</ul></div>';
		$("#pagination").html(pagination_container);
	    }
	});
    }
    $(document).on('click', '#searchbox .search', function(){
	get_objects(limit_object, 0);
    });
    $(document).on('change', '.sort', function(){
	get_objects(limit_object, 0);
    });
    $(document).on('click', '#pagination .page-link', function(){
	page = $(this).attr('data-page');
	get_objects(limit_object, (page - 1) * limit_object);
    });
    $(document).on('click', '.favorite', function(){
	var id = $(this).attr('data-id');
	var elem = $(this);
	$.ajax({
	    url: '/remart/add_to_fav',
	    method: 'post',
	    dataType: 'json',
	    data: {
		object_id: id
	    },
	    success: function(data) {
		if (data == 1)
		{
		    elem.addClass('fa-star');
		    elem.removeClass('fa-star-o');
		}
		else if (data == 2)
		{
		    elem.removeClass('fa-star');
		    elem.addClass('fa-star-o');
		}
	    }
	});
    });
});
</script>
<style>
@media (max-width: 575px) {
    #head img {
	height: 990px !important;
    }
    #searchbox { width: 100%; }
    #head {
	height: 900px !important;
    }
    .col-12>h1 { margin-top: 15px !important; }
}
@media (min-width: 576px) and (max-width: 767px) {
    #head img {
	height: 630px !important;
    }
}
@media (min-width: 768px) {
    #head { min-height: 500px !important; }
}
</style>