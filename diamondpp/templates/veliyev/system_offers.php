
	<div class="wrapper">
		<!--[if lt IE 9]>
			<div class="browsehappy"><?php echo $loc['service']['t01']; ?></div>
		<![endif]-->

		<?php
		// Выводим шапку сайта
		// Print cap site
		include './templates/'.$template.'/blocks/shapka_not_login.php';

		// Выводим верхнее горизонтальное меню
		// Display the top horizontal menu
		include './templates/'.$template.'/blocks/top_menu_not_login.php';
		?>

		<div class="page">
			<div class="cnt">
				<div class="page__title"><span><?php echo $loc['system_offers.php']['t01']; ?></span></div>
				<div class="page__text">
					<h2><?php echo $loc['system_offers.php']['t02']; ?></h2>
					<p>

						<?php
						$sql_ok = "SELECT id,name,deystvie,cena,comission,tip_comission,geo,category FROM offers WHERE `active`='1' ORDER BY `id` DESC";
						$result_ok = $mysqli->query($sql_ok);
						$cvet=0;
						if (mysqli_num_rows($result_ok) > 0) 
							{
							while($res_ok=mysqli_fetch_array($result_ok)) 
								{
								?>
								<div style="position: relative; width: 100%; border: 1px solid #FDA000; margin-bottom: 20px; display: inline-block;">
									<a class="open-popup" href="#"><div style="position: absolute; display: inline-block; text-align: right; height: 21px; margin: 0px; top: 50px; left: 800px; background: #FDA000; color: white; line-height: 20px;">&nbsp;<?php echo $loc['system_offers.php']['t03']; ?>&nbsp;</div></a>
									<?php
									$offer_id=htmlentities($res_ok['id']);
									$name=htmlentities($res_ok['name']);
									$id_deystvie=htmlentities($res_ok['deystvie']);
									$cena=htmlentities($res_ok['cena']);
									$comission=htmlentities($res_ok['comission']);
									$tip_comission=htmlentities($res_ok['tip_comission']);
									$geo=htmlentities($res_ok['geo']);
									
									// Получаем категорию оффера
									// Get the offer category
									$offer_category=htmlentities($res_ok['category']);		
									$sql_category = "SELECT name FROM category_tpl WHERE `id`='$offer_category'";
									$result_category = $mysqli->query($sql_category);
									$res_category=mysqli_fetch_array($result_category);
									$offer_category_name=htmlentities($res_category['name']);

									$sql_d = "SELECT deystvie FROM deystvie_tpl WHERE `id`='$id_deystvie'";
									$result_d = $mysqli->query($sql_d);
									$res_d=mysqli_fetch_array($result_d);
									$deystvie_name=htmlentities($res_d['deystvie']);
								
									if (file_exists('./tmp/offer'.$offer_id.'.jpg')) 
										{
										?>
										<a class="open-popup" style="border: 0; text-decoration: none;" href="#"><img style="float: left; width: 100px; height: 100px; margin: 10px 10px 10px 10px; padding: 0; border: 0; text-decoration: none;" src="./tmp/offer<?php echo $offer_id; ?>.jpg"></a>
										<?php
										}
									else
										{
										?>
										<a class="open-popup" style="border: 0; text-decoration: none;" href="#"><div style="float: left; width: 100px; height: 100px; margin: 10px 10px 10px 10px; padding: 0; border: 1px solid gray; text-decoration: none;"></div></a>
										<?php
										}							
									?>
									<div style="margin-top: 10px; line-height: 25px;">
										<b>
										<span style="color: gray;">
											<?php echo $loc['system_offers.php']['t04']; ?>&nbsp;
										</span>
										<a class="open-popup" href="#"><?php echo html_entity_decode($name, ENT_QUOTES, 'utf-8'); ?></a></b><br />
										<?php echo $loc['system_offers.php']['t05']; ?>&nbsp;
										<span style="font-size: 20px; font-weight: bold;">
											<font style="color: black; background: #FECC0F;">&nbsp;<?php echo $deystvie_name; ?>:&nbsp;</font>
											<span style="color: green;">
												&nbsp;
												<?php 
												if (isset($comission)) 
													{
													if (isset($tip_comission) && $tip_comission=='1') 
														{
														echo $comission.'&nbsp;'.$loc['system_offers.php']['t06'].'&nbsp;';
														}
													if (isset($tip_comission) && $tip_comission=='2')
														{
														echo (int)$comission.'&nbsp;'.$loc['system_offers.php']['t07'].'&nbsp;';
														}		
													} 
												else 
													{
													echo $loc['system_offers.php']['t08'];
													} 
												?>
											</span>
										</span>
										<br />
										<b><?php echo $loc['system_offers.php']['t09']; ?>&nbsp;</b><?php echo $offer_category_name; ?>
										<br />
										<b><?php echo $loc['system_offers.php']['t10']; ?>&nbsp;</b>
										<?php
										list($offer_country_iso1, $offer_region_id1, $offer_city_id1) = explode('|', trim($geo, '|'));
										$sql_geo = "SELECT name_ru FROM sxgeo_country WHERE `iso`='$offer_country_iso1'";
										$result_geo = $mysqli->query($sql_geo);
										if (mysqli_num_rows($result_geo) > 0) 
											{
											$res_geo=mysqli_fetch_array($result_geo);
											$geo_country=htmlentities($res_geo['name_ru']);
											}
										else
											{
											$geo_country=$loc['system_offers.php']['t11'];
											}
										echo $geo_country;
										?>
									</div>
								</div>
								<?php
								}
							}
						?>
				
					</p>
				</div>
			</div>
		</div>

		<?php
		// То что выводится на каждой странице до авторизации
		// What is displayed on each page to login
		include './templates/'.$template.'/blocks/always_not_login.php';

		// Выводим нижнее горизонтальное меню
		// Display the bottom horizontal menu
		include './templates/'.$template.'/blocks/bottom_menu_not_login.php';
		?>

	</div>

	<?php
	// Выводим форму логина
	// Display the login form
	include './templates/'.$template.'/blocks/login_form.php';
	?>

	<script src="./templates/<?php echo $template; ?>/js/scripts.js"></script>
	
	<!--[if lt IE 10]>
	<script src="./templates/<?php echo $template; ?>/js/attrplaceholder.js"></script>
	<![endif]-->
	