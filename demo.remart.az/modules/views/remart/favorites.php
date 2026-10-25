<div class="row" id="cont">
<? foreach ($objects as $object) { ?>
			<div class="col-12 col-sm-6 col-md-3 col-lg-4 col-xl-4 row" style="padding-bottom: 40px;">
				<div class="col-12" style="height: 250px; overflow: hidden;">
					<img src="/materials/temp/files/<? echo explode(',', $object->photo)[0]; ?>" style="width: auto; height: 100%;">
				</div>
				<div class="col-12" style="text-align: center;">
					<p><? echo $object->city; ?>, <? echo $object->region; ?>, <? echo $object->orient; ?>, <? echo $object->address; ?></p>
					<p><? echo $object->type; ?></p>
					<p><? echo $object->rinok; ?> AZN</p>
					<a href="/view?id=<? echo $object->id; ?>" class="btn btn-primary" target="_blank">Подробнее</a>
					<? if ($object->favorite) { ?><button data-id="<? echo $object->id; ?>" class="btn btn-danger favs"><i class="fa fa-star"></i></button><? } else { ?>
					<button data-id="<? echo $object->id; ?>" class="btn btn-success favs"><i class="fa fa-star"></i></button>
					<? } ?>
				</div>
			</div>
<? } ?>
</div>
<script type="text/javascript">
$(function(){
	$(document).on('click', '.btn-success.favs', function(event) {
		var el = $(this);
		var obj = $(this).attr('data-id');		
		$.ajax({
			url: '/remart/addfav',
			method: 'post',
			dataType: 'json',
			data: {
				object: obj,
			},
			success: function(data) {
				if (data == true) 
				{
					alert('Added to favorites');
					el.removeClass('btn-success');
					el.addClass('btn-danger');
				}
			}
		});
	});
	$(document).on('click', '.btn-danger.favs', function(event) {
		var el = $(this);
		var obj = $(this).attr('data-id');		
		$.ajax({
			url: '/remart/delfav',
			method: 'post',
			dataType: 'json',
			data: {
				object: obj,
			},
			success: function(data) {
				if (data == true) 
				{
					alert('Removed from favorites');
					el.removeClass('btn-danger');
					el.addClass('btn-success');
				}
			}
		});
	});
});
</script>