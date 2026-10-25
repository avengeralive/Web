<?
/*
Template name: Ticket
*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">

	<script src="/wp-content/themes/intertkanb2b/js/vendor/jquery.min.js"></script>
	<script src="/wp-content/themes/intertkanb2b/js/vendor/jquery-barcode.min.js"></script>
</head>
<body>
	<?
	//var_dump($_GET['h']);
	$posts = get_posts(array(
		'numberposts'	=> -1,
		'post_type'		=> 'tickets',
		'meta_query'	=> array(
			array(
				'key'	 	=> 'hash',
				'value'	  	=> $_GET['h'],
				'compare' 	=> '=',
			)
		),
	));
	//var_dump($posts);
	?>


		<script type="text/javascript">
			jQuery(function(){

				// Штрихкод  4174160
			
			var value = '5555010' + (Number($('#barcode').attr('data-barcode-value')) + 35553);
				btype = 'ean13';
				var settings = {
					output: 'css',
					bgColor: '#FFFFFF',
					color: '#000000',
					barWidth: 2,
					barHeight: 70,
					moduleSize: 5,
					posX: 0,
					posY: 0,
					addQuietZone: 1
				};
				$('#barcode').barcode(value, btype, settings);


				// Печать
				setTimeout(function(){
					window.print();
				}, 2000);

			});
		</script>

		<article id="ticket" style="width: 960px; margin: auto; padding: 10px; border: #999 2px solid; font: 13px Verdana;">

			<table width="100%" cellpadding="10" cellspacing="6">
				<tr>
					<td style="background: #005fbf; font: 31px Verdana; color: white; text-transform: uppercase;" width="55%"><? pll_e('t1'); ?></td>
					<td rowspan="2" valign="top">
						<img src="<? if (pll_current_language() == 'ru') echo get_field('лого', 7); else echo get_field('лого', 121); ?>" style="height: 100px;" alt="logo theme"> 
					</td>
				</tr>
				<tr>
					<td style="font: bold 15px Verdana; padding-bottom: 30px;"><? pll_e('t2'); ?></td>
				</tr>
			</table>

			<table width="100%" cellpadding="10" cellspacing="6">
				<tr>
					<th style="background: #005fbf; font: 23px Verdana; color: white; text-transform: uppercase;" width="35%"><? pll_e('t3'); ?></th>
					<th colspan="2" style="background: #005fbf; font: 23px Verdana; color: white; text-transform: uppercase;"><? pll_e('t4'); ?></th>
				</tr>
				<tr>
					<td style="font: bold 19px Verdana; padding-bottom: 30px;">
						<? echo $posts[0]->post_title; ?>
					</td>
					<td>
						<div id="barcode" data-barcode-value=" "></div>
					</td>
					<td style="font: bold 15px Verdana; padding-bottom: 30px;">
						<? pll_e('t5'); ?>
					</td>
				</tr>
			</table>

			<table width="100%" cellpadding="10" cellspacing="6">
				<tr>
					<th style="background: #005fbf; font: 23px Verdana; color: white; text-transform: uppercase;" width="35%"><? pll_e('t6'); ?></th>
					<th style="background: #005fbf; font: 23px Verdana; color: white; text-transform: uppercase;" width="35%"><? pll_e('t7'); ?></th>
					<th style="background: #005fbf; font: 23px Verdana; color: white; text-transform: uppercase;"><? pll_e('t8'); ?></th>
				</tr>
				<tr>
					<td style="font: bold 19px Verdana;">
					<? if (pll_current_language() == 'ru') { ?>
					Интерткань 2018. B2B. Текстильная торговая сессия.
					<? } else { ?>
					Interfabric 2018. B2B. Textile Marketplace.
					<? } ?>	
					</td>
					<td style="font: bold 19px Verdana;"> 
					<? if (pll_current_language() == 'ru') { ?>
					5-6 сентября, 2018
					<? } else { ?>
					September 5-6, 2018
					<? } ?>
					</td>
					<td style="font: bold 19px Verdana;">2</td>
				</tr>
				<tr>
					<td style="border-left: 5px #005fbf solid;">
						<p><? pll_e('t11'); ?></p>
						<p><? pll_e('t12'); ?></p>
						<p><? pll_e('t13'); ?></p>
					</td>
					<td style="border-left: 5px #005fbf solid;">
						 <p><? pll_e('t14'); ?></p>
						<ul>
							<li><? pll_e('t15'); ?></li>
							<li><? pll_e('t16'); ?></li>
						</ul>
					</td>
					<td></td>
				</tr>
				<tr>
					<td width="35%" valign="top">

					</td>
					<td width="35%" valign="top" style="font: bold 17px Verdana;"> </td>
					<td>
						<table cellpadding="10" cellspacing="0">
							<tr>
								<td style="background: #005fbf; font: bold 15px Verdana; color: white; text-transform: uppercase; text-align: left;">
									<? pll_e('t10'); ?>
								</td>
							</tr>
							<tr>
								<td style="font: bold 15px Verdana; border-left: 5px #005fbf solid;">
									<? echo $posts[0]->post_date; ?>
								</td>
							</tr>
						</table>

					</td>
				</tr>
			</table>

			<table>
				<tr>
					<td>

					</td>
				</tr>
			</table>

			<table style="max-width: 100%;">
				<tr>
					<td style="font: bold 15px Verdana, sans-serif; color: #999; padding-bottom: 20px;">
						<? pll_e('t9'); ?>
					</td>
				</tr>
				<? if (pll_current_language() == 'ru') { ?>
				<tr>
					<td>
											<img style="margin-right: 30px;" src="http://intertkan.ru/wp-content/themes/intertkan2/images/brands/organizers/souzlegprom.png" alt="" width="180">
											</td>
					<td>
											<img src="http://intertkan.ru/wp-content/themes/intertkan2/images/brands/organizers/legprommedia.png" alt="" width="180">
											</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<? } else { ?>
				<tr>
					<td>
					<img style="margin-right: 30px;" src="http://intertkan.ru/wp-content/themes/intertkan2/images/logo-souz_eng.png" alt="" width="180">					</td>
					<td>
					<img src="http://intertkan.ru/wp-content/themes/intertkan2/images/brands/organizers/legprommedia_eng.png" alt="" width="180">					</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<? } ?>
			</table>

		</article>


</body>
</html>
