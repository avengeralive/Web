<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKjDgq1wATQHlVPSc7nNQqF8oUMKf9-PM" type="text/javascript"></script>
<?
$remont = array();
$remont[1] = Translations::gi()->remont1;
$remont[2] = Translations::gi()->remont2;
$remont[3] = Translations::gi()->remont3;
?>
<div class="container" id="object_view">
    <div class="col-12 row">
	<div class="col-12 col-sm-12">
	    <h1><? echo $title; ?></h1>
	    <h5><? echo $subtitle; ?> 
		<? if ($item->role_id == 2 || $item->role_id == 4 || $item->role_id == 5) { ?>
		<a href="/object?id=<? echo $_GET['id']; ?>"><span style="float: right;"><? echo Translations::gi()->id_code; ?>: <? echo $_GET['id']; ?></span></a>
		<? } else { ?>
		<span style="float: right;"><? echo Translations::gi()->id_code; ?>: <? echo $_GET['id']; ?></span>
		<? } ?>
	    </h5>
	</div>
    </div>
    <div class="col-12 row align-items-start">
	<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 row objcard">
	    <div class="col-12 col-sm-12 row">
		<ul class="pgwSlideshow">
		<?
		    foreach ($images as $key => $image) { 
		?>
		<li><img src="/materials/temp/files/<? echo $image->material_path; ?>"></li>
		<? } ?>
		</ul>
		<?
		    foreach ($images as $key => $image) { 
		?>
		<? if ($key > 0) { ?><a data-fancybox="fancybox" href="/materials/temp/files/<? echo $image->material_path; ?>"></a><? } } ?>
		<script type="text/javascript">
		$(document).ready(function() {
		    $('.pgwSlideshow').pgwSlideshow({
			maxHeight: 700,
			afterSlide: function(id) {
			    $(".ps-caption").html('<div class="row"><div class="col-3"><a style="float: left;" data-fancybox="fancybox" href="/materials/temp/files/<? echo $images[0]->material_path; ?>"><i class="fa fa-film"></i> Начать слайдшоу</a></div> <div class="col-6" style="text-align: center;"><span style="padding:0px;"> ' + id + ' / <? echo count($images); ?> </span></div> <div class="col-3"><a style="margin-right: 15px;" data-fancybox="fancybox2" href="' + $(".elt_" + id + " img").attr('src') + '"><i class="fa fa-search-plus"></i> Увеличить</a> Фото ' + id + '</div></div>');
			   // $(".fancybox").fancybox();
			}
		    });
		});
		</script>
	    </div>
	    <div class="col-12">
		<div class="col-12 col-sm-12 row opt">
		    <? if ($result['data']->type == 1) { ?>
		    <div class="col-12 col-sm-4">
			<p><span class="remicons kupche"></span><? echo Translations::gi()->kupche; ?>
			    <? if ($result['data']->kupche == 1) { ?>
			    <i class="fa fa-check yes"></i>
			    <? } else { ?>
			    <i class="fa fa-close no"></i>
			    <? } ?>
			</p>
		    </div>
		    <div class="col-12 col-sm-4">
			<p><span class="remicons gas"></span><? echo Translations::gi()->gas; ?>
			    <? if ($result['data']->gas == 1) { ?>
			    <i class="fa fa-check yes"></i>
			    <? } else { ?>
			    <i class="fa fa-close no"></i>
			    <? } ?>
			</p>
		    </div>
		    <div class="col-12 col-sm-4">
			<p><span class="remicons remont"></span><? echo Translations::gi()->remont; ?>: <? echo $remont[$result['data']->remont]; ?></p>
		    </div>
		    <? } else { ?>
		    <div class="col-12 col-sm-3">
			<p><span class="remicons kupche"></span><? echo Translations::gi()->kupche1; ?>
			    <? if ($result['data']->kupche == 1) { ?>
			    <i class="fa fa-check yes"></i>
			    <? } else { ?>
			    <i class="fa fa-close no"></i>
			    <? } ?>
			</p>
		    </div>
		    <div class="col-12 col-sm-3">
			<p><span class="remicons kupche"></span><? echo Translations::gi()->kupche2; ?>
			    <? if ($result['data']->pravo == 1) { ?>
			    <i class="fa fa-check yes"></i>
			    <? } else { ?>
			    <i class="fa fa-close no"></i>
			    <? } ?>
			</p>
		    </div>
		    <div class="col-12 col-sm-3">
			<p><span class="remicons gas"></span><? echo Translations::gi()->gas; ?>
			    <? if ($result['data']->gas == 1) { ?>
			    <i class="fa fa-check yes"></i>
			    <? } else { ?>
			    <i class="fa fa-close no"></i>
			    <? } ?>
			</p>
		    </div>
		    <div class="col-12 col-sm-3">
			<p><span class="remicons remont"></span><? echo Translations::gi()->remont; ?>: <? echo $remont[$result['data']->remont]; ?></p>
		    </div>
		    <? } ?>
		</div>
	    </div>
	    <div class="col-12 col-sm-12 row" style="padding: 15px;">
		<div class="col-12 col-sm-4">
		    <ul class="addlist">
			<li><span><? echo Translations::gi()->balkon; ?></span><span style="float: right;"><? echo $result['data']->balkon; ?></span></li>
			<li><span><? echo Translations::gi()->sanuz; ?></span><span style="float: right;"><? echo $result['data']->sanuz; ?></span></li>
			<? if ($result['data']->type == 1) { ?>
			<li><span><? echo Translations::gi()->phone; ?></span>
			    <span style="float:right">
				<? if ($result['data']->phone == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
			<? } else { ?>
			<li><span><? echo Translations::gi()->waterboil; ?></span>
			    <span style="float:right">
				<? if ($result['data']->waterboil == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
			<? } ?>
		    </ul>
		</div>
		<div class="col-12 col-sm-4">
		    <ul class="addlist">
			<? if ($result['data']->type == 1) { ?>
			<li><span><? echo Translations::gi()->kabeltv; ?></span>
			    <span style="float:right">
				<? if ($result['data']->kabeltv == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
			<li><span><? echo Translations::gi()->lift; ?></span>
			    <span style="float:right">
				<? if ($result['data']->lift == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
			<li><span><? echo Translations::gi()->garage; ?></span>
			    <span style="float:right">
				<? if ($result['data']->garage == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
			<? } else { ?>
			<li><span><? echo Translations::gi()->garage; ?></span>
			    <span style="float:right">
				<? if ($result['data']->garage == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
			<li><span><? echo Translations::gi()->pool; ?></span>
			    <span style="float:right">
				<? if ($result['data']->pool == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
			<li><span><? echo Translations::gi()->phone; ?></span>
			    <span style="float:right">
				<? if ($result['data']->phone == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
			<? } ?>
		    </ul>
		</div>
		<div class="col-12 col-sm-4">
		    <ul class="addlist" style="border:0px;">
			<li><span><? echo Translations::gi()->warm; ?></span>
			    <span style="float:right">
				<? if ($result['data']->warm == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
			<li><span><? echo Translations::gi()->conditioner; ?></span>
			    <span style="float:right">
				<? if ($result['data']->conditioner == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
			<li><span><? echo Translations::gi()->kitchen; ?></span>
			    <span style="float:right">
				<? if ($result['data']->kitchen == 1) { ?>
				<i class="fa fa-check yes"></i>
				<? } else { ?>
				<i class="fa fa-close no"></i>
				<? } ?>
			    </span>
			</li>
		    </ul>
		</div>
	    </div>
	    <div class="col-12 col-sm-12 row">
		<div class="col-12" style="border-bottom: 1px solid #ccc; padding-top: 15px; padding-bottom: 30px; padding-left: 0px; padding-right: 0px;">
		    <p><? echo $result['data']->comment; ?></p>
		</div>
	    </div>
	    <div class="col-12 col-sm-12 row">
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-top: 20px;">
		    <center>
			<input type="hidden" id="lat" value="<? echo trim($result['data']->lat); ?>">
			<input type="hidden" id="lng" value="<? echo trim($result['data']->lng); ?>">
			<div id="map_show" style="width: 100%; height: 300px; position: relative; overflow: hidden;"></div>
		    </center>
		</div>
	    </div>
	    <div class="col-12" style="padding: 0;">
		<div id="accordion">
		    <div class="card">
			<div class="card-header" id="metro" data-toggle="collapse" data-target="#metro_div" aria-expanded="true" aria-controls="metro_div">
			    <h5 class="mb-0">
				<button class="btn btn-link">
				    <span class="remicons metro"></span> <? echo Translations::gi()->metro; ?>
				</button>
				<i class="fa fa-angle-down" style="color: #209899; float: right;"></i>
			    </h5>
			</div>
			<div id="metro_div" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
			    <div class="card-body">
			    </div>
			</div>
		    </div>
		    <div class="card">
			<div class="card-header" id="schools" data-toggle="collapse" data-target="#schools_div" aria-expanded="true" aria-controls="schools_div">
			    <h5 class="mb-0">
				<button class="btn btn-link">
				    <span class="remicons schools"></span> <? echo Translations::gi()->schools; ?>
				</button>
				<i class="fa fa-angle-down" style="color: #209899; float: right;"></i>
			    </h5>
			</div>
			<div id="schools_div" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
			    <div class="card-body">
			    </div>
			</div>
		    </div>
		    <div class="card">
			<div class="card-header" id="hospitals" data-toggle="collapse" data-target="#hospitals_div" aria-expanded="true" aria-controls="hospitals_div">
			    <h5 class="mb-0">
				<button class="btn btn-link">
				    <span class="remicons hospitals"></span> <? echo Translations::gi()->hospitals; ?>
				</button>
				<i class="fa fa-angle-down" style="color: #209899; float: right;"></i>
			    </h5>
			</div>
			<div id="hospitals_div" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
			    <div class="card-body">
			    </div>
			</div>
		    </div>
		    <div class="card">
			<div class="card-header" id="parks" data-toggle="collapse" data-target="#parks_div" aria-expanded="true" aria-controls="parks_div">
			    <h5 class="mb-0">
				<button class="btn btn-link">
				    <span class="remicons parks"></span> <? echo Translations::gi()->parks; ?>
				</button>
				<i class="fa fa-angle-down" style="color: #209899; float: right;"></i>
			    </h5>
			</div>
			<div id="parks_div" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
			    <div class="card-body">
			    </div>
			</div>
		    </div>
		    <div class="card">
			<div class="card-header" id="restaurants" data-toggle="collapse" data-target="#restaurants_div" aria-expanded="true" aria-controls="restaurants_div">
			    <h5 class="mb-0">
				<button class="btn btn-link">
				    <span class="remicons restaurants"></span> <? echo Translations::gi()->restaurants; ?>
				</button>
				<i class="fa fa-angle-down" style="color: #209899; float: right;"></i>
			    </h5>
			</div>
			<div id="restaurants_div" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
			    <div class="card-body">
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	</div>
	<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 row objsidebar">
	    <div class="col-12 col-sm-12 row">
		<div class="col-9" style="background: #209899; text-align: center; padding: 8px;">
		    <span style="font-size:35px; color: #fff;"><? echo number_format($result['data']->price, 0, ',', ' '); ?> <i class="white manat"></i></span>
		</div>
		<div class="col-3" style="background: #f0f8f8; text-align: center; padding: 15px;">
		    <i class="fa <? if ($favorites) { ?>fa-star<? } else { ?>fa-star-o<? } ?>" id="favorite"></i>
		</div>
		<script type="text/javascript">
		    $(function(){
			$("#favorite").on('click', function(){
			    $.ajax({
				url: '/remart/add_to_fav',
				method: 'post',
				dataType: 'json',
				data: {
				    object_id: <? echo $_GET['id']; ?>
				},
				success: function(data) {
				    if (data == 1)
				    {
					$("#favorite").addClass('fa-star');
					$("#favorite").removeClass('fa-star-o');
				    }
				    else if (data == 2)
				    {
					$("#favorite").removeClass('fa-star');
					$("#favorite").addClass('fa-star-o');
				    }
				}
			     });
			});
		    });
		</script>
	    </div>
	    <? if ($item->role_id == 2 || $item->role_id == 4 || $item->role_id == 5 || $item->role_id == 8) { ?>
	    <div class="col-12 col-sm-12 row">
		<div class="col-12 realtorblock" style="background: #f1f8f8; padding: 25px; padding-bottom: 10px;">
		    <p><? echo Translations::gi()->agent; ?></p>
		    <h3><? if ($realtor->company == 0) { ?><? echo $realtor->name; ?> <? echo $realtor->surname; ?><? } else { ?> <? echo $realtor->company_name; ?><? } ?></h3>
		    <table>
			<tr>
			    <td><i class='fa fa-phone' style='font-size: 40px; color: #40d0d3;'></i><td>
			    <td><? 
				$p1 = substr($realtor->mobile, 0, 4);
				$p2 = substr($realtor->mobile, 4, 2);
				$p3 = substr($realtor->mobile, 6, 3);
				$p4 = substr($realtor->mobile, 9, 2);
				$p5 = substr($realtor->mobile, 11, 2);
				echo "<p>(0".$p2.") ".$p3." - ".$p4." - ".$p5."</p>";
				$p1 = substr($realtor->phone1, 0, 4);
				$p2 = substr($realtor->phone1, 4, 2);
				$p3 = substr($realtor->phone1, 6, 3);
				$p4 = substr($realtor->phone1, 9, 2);
				$p5 = substr($realtor->phone1, 11, 2);
				if ($p5 != '') echo "<p>(0".$p2.") ".$p3." - ".$p4." - ".$p5."</p>";
				$p1 = substr($realtor->phone2, 0, 4);
				$p2 = substr($realtor->phone2, 4, 2);
				$p3 = substr($realtor->phone2, 6, 3);
				$p4 = substr($realtor->phone2, 9, 2);
				$p5 = substr($realtor->phone2, 11, 2);
				if ($p5 != '') echo "<p>(0".$p2.") ".$p3." - ".$p4." - ".$p5."</p>";
				$p1 = substr($realtor->home, 0, 4);
				$p2 = substr($realtor->home, 4, 2);
				$p3 = substr($realtor->home, 6, 3);
				$p4 = substr($realtor->home, 9, 2);
				$p5 = substr($realtor->home, 11, 2);
				if ($p5 != '') echo "<p>(0".$p2.") ".$p3." - ".$p4." - ".$p5."</p>";
				?>
			   </td>
			<tr>
		    </table>
		</div>
	    </div>
	    <? } ?>
	    <div class="col-12 col-sm-12 row">
		<? if ($result['data']->type == 1) { ?>
		<div class="col-3" style="padding: 2px; padding-left: 0px;">
		    <div class="col-12" style="background:#f0f8f8; text-align: center; padding: 3px;">
			<p style="color: #209899; font-size: 25px; margin-bottom: 0;"><? echo $result['data']->room; ?></p>
			<p><? echo Translations::gi()->rooms; ?></p>
		    </div>
		</div>
		<div class="col-3" style="padding: 2px;">
		    <div class="col-12" style="background:#f0f8f8; text-align: center; padding: 3px;">
			<p style="color: #209899; font-size: 25px; margin-bottom: 0;"><? echo $result['data']->square; ?> <span style="font-size: .6em;">м<sup>2</sup></span></p>
			<p><? echo Translations::gi()->square1; ?></p>
		    </div>
		</div>
		<div class="col-3" style="padding: 2px;">
		    <div class="col-12" style="background:#f0f8f8; text-align: center; padding: 3px;">
			<p style="color: #209899; font-size: 25px; margin-bottom: 0;"><? echo ceil($result['data']->price / $result['data']->square); ?></p>
			<p><i class="manat"></i> / <span>м<sup>2</sup></span></p>
		    </div>
		</div>
		<div class="col-3" style="padding: 2px; padding-right: 0px;">   
		    <div class="col-12" style="background:#f0f8f8; text-align: center; padding: 3px;">
			<p style="color: #209899; font-size: 25px; margin-bottom: 0;"><? echo $result['data']->floor; ?>/<? echo $result['data']->floors; ?></p>
			<p><? echo translations::gi()->floor1; ?></p>
		    </div>    
		</div>    
		<? } else { ?>
		<div class="col-3" style="padding: 2px; padding-left: 0px;">
		    <div class="col-12" style="background:#f0f8f8; text-align: center; padding: 3px;">
			<p style="color: #209899; font-size: 25px; margin-bottom: 0;"><? echo $result['data']->room; ?></p>
			<p><? echo Translations::gi()->rooms; ?></p>
		    </div>
		</div>
		<div class="col-3" style="padding: 2px;">
		    <div class="col-12" style="background:#f0f8f8; text-align: center; padding: 3px;">
			<p style="color: #209899; font-size: 25px; margin-bottom: 0;"><? echo $result['data']->square; ?> <span style="font-size: .6em;">м<sup>2</sup></span></p>
			<p><? echo Translations::gi()->square1; ?></p>
		    </div>
		</div>
		<div class="col-3" style="padding: 2px; padding-right: 0px;">   
		    <div class="col-12" style="background:#f0f8f8; text-align: center; padding: 3px;">
			<p style="color: #209899; font-size: 25px; margin-bottom: 0;"><? echo $result['data']->floors; ?></p>
			<p><? echo Translations::gi()->floor1; ?></p>
		    </div>    
		</div>
		<div class="col-3" style="padding: 2px; padding-right: 0px;">   
		    <div class="col-12" style="background:#f0f8f8; text-align: center; padding: 3px;">
			<p style="color: #209899; font-size: 25px; margin-bottom: 0;"><? echo $result['data']->square_zeml; ?> <span style="font-size: .6em;"><? echo Translations::gi()->sot; ?></span></p>
			<p><? echo Translations::gi()->ucha; ?></p>
		    </div>    
		</div>
		<? } ?>
	    </div>
	    <div class="col-12 col-sm-12 row">
		<div class="col-12" style="background: #209899; text-align: center; padding: 10px; margin-top: 10px;">
		    <h2 class="credcalctitle"><? echo Translations::gi()->credit_calculator; ?></h2>
		</div>
		<div class="col-12 row calculator_ip" style="background: #f0f8f8; padding: 10px;">
		    <div class="col-12 row" style="padding: 0;">
			<div class="col-6" style="padding:5px;"><? echo Translations::gi()->st_kvart; ?></div>
			<div class="col-4" style="padding:5px; text-align: right;"><span class="calcamount"><? echo number_format($result['data']->price, 0, ',', ' '); ?> <i class="manat"></i></span></div>
			<div class="col-2" style="padding:5px;"></div>
		    </div>
		    <div class="col-12 row" style="padding: 0;">
			<div class="col-6" style="padding:10px 5px;"><? echo Translations::gi()->perv_vznos; ?></div>
			<div class="col-4" style="padding:5px; text-align: right;" id="div_perviy"></div>
			<div class="col-2" style="padding:5px;"><input type="text" id="perviy" style="width:100%;"></div>
		    </div>
		    <div class="col-12 row" style="padding: 0;">
			<div class="col-6" style="padding:5px;"><? echo Translations::gi()->summa_kred; ?></div>
			<div class="col-4" style="padding:5px; text-align: right;" id="div_summa"></div>
			<div class="col-2" style="padding:5px;"><input type="text" id="summa" style="width:100%;"></div>
		    </div>
		    <div class="col-12 row" style="padding: 0;">
			<div class="col-6" style="padding:5px;"><? echo Translations::gi()->stavka; ?></div>
			<div class="col-4" style="padding:5px; text-align: right;" id="div_stavka"></div>
			<div class="col-2" style="padding:5px;"><input type="text" id="stavka" style="width:100%;"></div>
		    </div>
		    <div class="col-12 row" style="padding: 0;">
			<div class="col-6" style="padding:5px;"><? echo Translations::gi()->srok; ?></div>
			<div class="col-4" style="padding:5px; text-align: right;" id="div_srok"></div>
			<div class="col-2" style="padding:5px;"><input type="text" id="srok" style="width:100%;"></div>
		    </div>
		    <div class="col-12 row" style="padding: 10px 0;">
			<div class="col-12 col-sm-8" style="padding:5px;">
			    <a class="switcher active" data-value="12"><? echo Translations::gi()->year; ?></a>
			    <a class="switcher" data-value="1"><? echo Translations::gi()->month; ?></a>
			</div>
			<div class="col-12 col-sm-4" style="padding:5px;">
			    <a class="calc"><? echo Translations::gi()->calc; ?></a>
			</div>
		    </div>
		    <div class="col-12 row" style="padding: 10px 0;">
			<p style='width:100%; line-height: 20px;'><? echo Translations::gi()->ejemesacniy; ?> <span id="result"></span></p>
		    </div>
		    <script>
			$(function(){
			    $("#perviy").on('change', function() {
				$("#div_perviy").html("<span class='calcamount'>" + $("#perviy").val().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + " <i class='manat'></i></span>");
				var amount = <? echo $result['data']->price; ?> - $("#perviy").val();
				$("#summa").val(amount);
				$("#div_summa").html("<span class='calcamount'>" + amount.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + " <i class='manat'></i></span>");
			    });
			    $("#summa").on('change', function() {
				$("#div_summa").html("<span class='calcamount'>" + $("#summa").val().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + " <i class='manat'></i></span>");
				var amount = <? echo $result['data']->price; ?> - $("#summa").val();
				$("#perviy").val(amount);
				$("#div_perviy").html("<span class='calcamount'>" + amount.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + " <i class='manat'></i></span>");
			    });
			    $("#stavka").on('change', function() {
				$("#div_stavka").html("<span class='calcamount'>" + $("#stavka").val() + " %</span>");
			    });
			    $("#srok").on('change', function() {
				$("#div_srok").html("<span class='calcamount'>" + $("#srok").val() + " </span>");
			    });
			    $(".switcher").on('click', function() {
				$(".switcher").removeClass('active');
				$(this).addClass('active');
			    });
			    function calc()
			    {
				var summa = $("#summa").val();
				var stavka = $("#stavka").val() / 1200;
				var srok = $("#srok").val() * $(".switcher.active").attr("data-value");
				x = 1 + Number(stavka);
				t = 1;
				for (i = 2; i <= srok; i++) t = t * x;
				$("#result").html("<span class='calcamount'>" + Math.round(summa * (stavka + stavka / (Math.pow(x, srok) - 1))) + " <i class='manat'></i></span>");
			    }
			    $(".calc").on('click', calc);
			});
		    </script>
		</div>
	    </div>
	    <div class="col-12 row">
		<? foreach ($appraisers as $appraiser) { ?>
		<? if (($item->role_id == 2 || $item->role_id == 4) && $appraiser->rinok != 0) { ?> 
		<div class="col-12 appraise" style="padding: 15px;">
		    <h4><? echo $appraiser->company_name; ?></h4>
		    <table id="val_<? echo $appraiser->user_id; ?>" style='width:100%;'>
			<tr>
			    <td style="width:60%; text-align: left;"><? echo Translations::gi()->rinok; ?></td>
			    <td style='text-align: right;'><span class='calcamount'><? echo number_format($appraiser->rinok, 0, ',', ' '); ?> <i class='manat'></i></span></td>
			</tr>
			<tr>
			    <td style="width:40%; text-align: left;"><? echo Translations::gi()->liquid; ?></td>
			    <td style='text-align: right;'><span class='calcamount'><? echo number_format($appraiser->liquid, 0, ',', ' '); ?> <i class='manat'></i></span></td>
			</tr>
		    </table>
		    <button class="btn btn-success makevalue" data-id="<? echo $appraiser->user_id; ?>"><? echo Translations::gi()->valuate; ?></button>
		</div>
		<? } else if ($item->role_id == 7 && $appraiser->user_id == $item->id) { ?>
		<div class="col-12 appraise" style="padding: 15px;">
		    <h4><? echo $appraiser->company_name; ?></h4>
		    <table id="val_<? echo $appraiser->user_id; ?>">
			<tr>
			    <td style="width:70%; text-align: left;"><? echo Translations::gi()->rinok; ?></td>
			    <td><input type="text" class="form-control rinok" value="<? echo $appraiser->rinok; ?>"></td>
			</tr>
			<tr>
			    <td style="width:30%; text-align: left;"><? echo Translations::gi()->liquid; ?></td>
			    <td><input type="text" class="form-control liquid" value="<? echo $appraiser->liquid; ?>"></td>
			</tr>
		    </table>
		    <button class="btn btn-success makevalue" data-id="<? echo $appraiser->user_id; ?>"><? echo Translations::gi()->valuate; ?></button>
		</div>
		<? } } ?>
		<script type="text/javascript">
		    $(function() {
			$('.makevalue').on('click', function(){
			    var appraiser_id = $(this).attr('data-id');
			    $.ajax({
				url: '/remart/valuate_object',
				method: 'post',
				dataType: 'json',
				data: {
				    rinok: $("#val_" + appraiser_id + " .rinok").val(),
				    liquid: $("#val_" + appraiser_id + " .liquid").val(),
				    appraiser_id: appraiser_id,
				    object_id: <? echo $_GET['id']; ?>
				},
				success: function(data) {
				    alert('Объект успешно оценен');
				}
			     });
			});
			<? if ($item->role_id != 7) { ?>
			$('.appraise input').attr('disabled', true);
			$('.appraise button').remove();
			<? } ?>
		    });
		</script>
	    </div>
	</div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    var k = 0;
    function initialize_map() {
	var latValue = $("#lat").val();
	var lngValue = $("#lng").val();
	var haightAshbury = new google.maps.LatLng( latValue, lngValue);
    	var mapOptions = {
	    zoom: 13,
	    center: haightAshbury,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
    	};    
    	mapAddMark = new google.maps.Map(document.getElementById("map_show"), mapOptions);
	    marker = new google.maps.Marker({
	    position: haightAshbury,
	    map: mapAddMark,
	    title: ""
    	});
    }
    initialize_map ();
    getPlaces();
    function degrees_to_radians(degrees)
    {
      var pi = Math.PI;
      return degrees * (pi/180);
    }
    function CalculationByDistance(lat1, lon1, lat2, lon2) {
        Radius = 6371;
        dLat = degrees_to_radians(lat2 - lat1);
        dLon = degrees_to_radians(lon2 - lon1);
        a = Number(Math.sin(dLat / 2) * Math.sin(dLat / 2))
                + Number(Math.cos(degrees_to_radians(lat1)))
                * Math.cos(degrees_to_radians(lat2)) * Math.sin(dLon / 2)
                * Math.sin(dLon / 2);
        c = 2 * Math.asin(Math.sqrt(a));
        return (Radius * c).toFixed(2);
    }
    function getPlaces() {
	$.ajax({
	    url: '/remart/getMapLoc',
	    method: 'get',
	    dataType: 'json',
	    data: {
		lat: $("#lat").val(),
		lng: $("#lng").val(),
		type: 'subway_station'
	    },
	    success: function(data) {
		for ( i in data.results) {
		    $("#metro_div .card-body").append("<p>" + data.results[i].name + " <span style='float:right'>" + CalculationByDistance($("#lat").val(), $("#lng").val(), data.results[i].geometry.location.lat, data.results[i].geometry.location.lng) + " km</span></p>");
		}
	    }
	});
	$.ajax({
	    url: '/remart/getMapLoc',
	    method: 'get',
	    dataType: 'json',
	    data: {
		lat: $("#lat").val(),
		lng: $("#lng").val(),
		type: 'school'
	    },
	    success: function(data) {
		for ( i in data.results) {
		    $("#schools_div .card-body").append("<p>" + data.results[i].name + " <span style='float:right'>" + CalculationByDistance($("#lat").val(), $("#lng").val(), data.results[i].geometry.location.lat, data.results[i].geometry.location.lng) + " km</span></p>");
		}
	    }
	 });
	 $.ajax({
	    url: '/remart/getMapLoc',
	    method: 'get',
	    dataType: 'json',
	    data: {
		lat: $("#lat").val(),
		lng: $("#lng").val(),
		type: 'hospital'
	    },
	    success: function(data) {
		for ( i in data.results) {
		    $("#hospitals_div .card-body").append("<p>" + data.results[i].name + " <span style='float:right'>" + CalculationByDistance($("#lat").val(), $("#lng").val(), data.results[i].geometry.location.lat, data.results[i].geometry.location.lng) + " km</span></p>");
		}
	    }
	 });
	 $.ajax({
	    url: '/remart/getMapLoc',
	    method: 'get',
	    dataType: 'json',
	    data: {
		lat: $("#lat").val(),
		lng: $("#lng").val(),
		type: 'park'
	    },
	    success: function(data) {
		for ( i in data.results) {
		    $("#parks_div .card-body").append("<p>" + data.results[i].name + " <span style='float:right'>" + CalculationByDistance($("#lat").val(), $("#lng").val(), data.results[i].geometry.location.lat, data.results[i].geometry.location.lng) + " km</span></p>");
		}
	    }
	 });
	 $.ajax({
	    url: '/remart/getMapLoc',
	    method: 'get',
	    dataType: 'json',
	    data: {
		lat: $("#lat").val(),
		lng: $("#lng").val(),
		type: 'restaurant'
	    },
	    success: function(data) {
		for ( i in data.results) {
		    $("#restaurants_div .card-body").append("<p>" + data.results[i].name + " <span style='float:right'>" + CalculationByDistance($("#lat").val(), $("#lng").val(), data.results[i].geometry.location.lat, data.results[i].geometry.location.lng) + " km</span></p>");
		}
	    }
	 });
    }
});
</script>
<style>
    #head img { display: none; }
    #head:after { background: linear-gradient(to right, rgba(48, 55, 102, 1), rgba(89, 167, 180, 1)); }
    #head { height: 100px !important; }
    @media (min-width: 576px) and (max-width: 767px) {
	#menu .navbar-nav {
	    margin-top: 40px !important;
	}
	#head { height: 25vh !important; }
    }
    @media (min-width: 768px) {
	#menu .navbar-nav {
	    margin-top: 25px !important;
	}
	#head { height: 100px !important; }
    }
    .col-12>h1 { margin-top: 50px !important; font-weight: 400; }
</style>
