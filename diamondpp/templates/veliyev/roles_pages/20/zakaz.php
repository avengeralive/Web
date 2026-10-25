
<?php
// Подгружаем необходимые для работы функции
// Loads the necessary features to work
include 'zakaz_functions.php';
?>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url(); ?>/templates/<?php echo $template; ?>/css/redmond/jquery-ui-1.9.2.custom.css">
<script src="./templates/<?php echo $template; ?>/js/jquery-ui-1.9.2.custom.js"></script>

<h1><?php echo $loc['zakaz.php']['t01']; ?></h1>

<p>
	<?php 
	if (isset($_GET['xtext']) && $_GET['xtext']=='1') {echo '<font color=green><b>'.$loc['zakaz.php']['t02'].'</b></font> <a href="./zakaz.php">'.$loc['zakaz.php']['t03'].'</a>';} 
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='2') {echo '<font color=red><b>'.$loc['zakaz.php']['t04'].'</b></font> <a href="./zakaz.php">'.$loc['zakaz.php']['t05'].'</a>';} 
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='3') {echo '<font color=green><b>'.$loc['zakaz.php']['t150'].'</b></font>';}
	?>
</p>

<?php
// Блок с выводом отдельно взятого заказа
// Block with the output of a single order
if (isset($_GET['ob']) && $_GET['ob']!='' && $user_tip=='20')	
	{
	$ob=htmlentities($_GET['ob']);
	$sql_zakaz_view = "SELECT * FROM zakaz WHERE `id`='$ob'";
	$result_zakaz_view = $mysqli->query($sql_zakaz_view);
	if (mysqli_num_rows($result_zakaz_view)>0) 
		{
		$res_zakaz_view=mysqli_fetch_array($result_zakaz_view);
				
		$zakaz_view_id=htmlentities($res_zakaz_view['id']);
		$zakaz_view_number=htmlentities($res_zakaz_view['zakaz_number']);
		$zakaz_view_user_id=htmlentities($res_zakaz_view['user_id']);
		$zakaz_view_offer_id=htmlentities($res_zakaz_view['offer_id']);
		$zakaz_view_owner_id=htmlentities($res_zakaz_view['owner_id']);
		$zakaz_view_landing_id=htmlentities($res_zakaz_view['landing_id']);
		$zakaz_view_date=htmlentities($res_zakaz_view['date']);
		$zakaz_view_geo=htmlentities($res_zakaz_view['geo']);
		$zakaz_view_ip=htmlentities($res_zakaz_view['ip']);
		$zakaz_view_referer=htmlentities($res_zakaz_view['referer']);
		$zakaz_view_useragent=htmlentities($res_zakaz_view['useragent']);
		$zakaz_view_subid1=htmlentities($res_zakaz_view['subid1']);
		$zakaz_view_subid2=htmlentities($res_zakaz_view['subid2']);
		$zakaz_view_subid3=htmlentities($res_zakaz_view['subid3']);
		$zakaz_view_name=htmlentities($res_zakaz_view['name']);
		$zakaz_view_phone=htmlentities($res_zakaz_view['phone']);
		$zakaz_view_email=htmlentities($res_zakaz_view['email']);
		$zakaz_view_client_address=htmlentities($res_zakaz_view['client_address']);
		$zakaz_view_street=htmlentities($res_zakaz_view['street']);
		$zakaz_view_dom=htmlentities($res_zakaz_view['dom']);
		$zakaz_view_kvartira=htmlentities($res_zakaz_view['kvartira']);
		$zakaz_view_kolvo=htmlentities($res_zakaz_view['kolvo']);
		$zakaz_view_cena=htmlentities($res_zakaz_view['cena']);
		$zakaz_view_artikul=htmlentities($res_zakaz_view['artikul']);
		$zakaz_view_comission=htmlentities($res_zakaz_view['comission']);
		$zakaz_view_status=htmlentities($res_zakaz_view['status']);
		$zakaz_view_addstatus=htmlentities($res_zakaz_view['addstatus']);
		$zakaz_view_comments=htmlentities($res_zakaz_view['comments']);
		$zakaz_view_tracking_number=htmlentities($res_zakaz_view['tracking_number']);
		$zakaz_view_post_status=htmlentities($res_zakaz_view['post_status']);
		$zakaz_view_country=htmlentities($res_zakaz_view['country']);
		$zakaz_view_zipcode=htmlentities($res_zakaz_view['zipcode']);
		$zakaz_view_short_country=htmlentities($res_zakaz_view['short_country']);
		$zakaz_view_browser_name=htmlentities($res_zakaz_view['browser_name']);
		$zakaz_view_browser_version=htmlentities($res_zakaz_view['browser_version']);
		$zakaz_view_platform=htmlentities($res_zakaz_view['platform']);
		$zakaz_view_mobile=htmlentities($res_zakaz_view['mobile']);
		$zakaz_view_region=htmlentities($res_zakaz_view['region']);
		$zakaz_view_town=htmlentities($res_zakaz_view['town']);
		$zakaz_view_date_obrabotka=htmlentities($res_zakaz_view['date_obrabotka']);
		$zakaz_view_shop_zakaz_id=htmlentities($res_zakaz_view['shop_zakaz_id']);
		$zakaz_view_operator=htmlentities($res_zakaz_view['operator']);
		
		// Если мы под аккаунтом колл-центра сети и заказ взят в обработку не нами, то останавливаемся
		// If we under the account of call center of a network and the order is taken in handling not by us, then stop
		if ($user_tip=='20' && $zakaz_view_operator!=$user_id)
			{
			exit;
			}		
		
		// Получаем данные об оффере по которому был заказ
		// Get the data on offer by which the order was
		$sql_offer = "SELECT * FROM offers WHERE id = $zakaz_view_offer_id";
		$result_offer = $mysqli->query($sql_offer);
		$res_offer=mysqli_fetch_array($result_offer);
		$zakaz_offer_name=htmlentities($res_offer['name']);
		$zakaz_offer_cena=htmlentities($res_offer['cena']);
		$zakaz_offer_deystvie=htmlentities($res_offer['deystvie']);
		$zakaz_offer_sms_ok=htmlentities($res_offer['sms_ok']);
		?>
		<p>
			<table class="stats_table" style="width: 100%;">
				<tr class="table_zagolovki">
					<td colspan="2"><?php echo $loc['zakaz.php']['t06']; ?>&nbsp;<?php echo $zakaz_view_number; ?> (<?php if ($zakaz_view_status=="1") {echo $loc['zakaz.php']['t07'];} if ($zakaz_view_status=="0") {echo $loc['zakaz.php']['t08'];} if ($zakaz_view_status=="2") {echo $loc['zakaz.php']['t09'];} if ($zakaz_view_status=="3") {echo $loc['zakaz.php']['t10'];}?>)</td>
				</tr>
				<tr>
					<td><b><?php echo $loc['zakaz.php']['t11']; ?></b></td>
					<td width="300"><b><?php echo $loc['zakaz.php']['t12']; ?></b></td>
				</tr>
				<tr class="row_title">
					<td style="vertical-align: top; text-align: left;">
							<form method="post" action="./zakaz.php?<?php echo @$_SERVER['QUERY_STRING'];?>">
								<p>
									<b><?php echo $loc['zakaz.php']['t13']; ?>&nbsp;</b><?php echo html_entity_decode($zakaz_offer_name, ENT_QUOTES, 'utf-8'); ?>
								</p>
								<p>
									<b><?php echo $loc['zakaz.php']['t14']; ?>&nbsp;</b>
									<select name="status">
										<?php 
										if ($zakaz_offer_deystvie=='5')
											{
											?><option value="3" <?php if ($zakaz_view_status=='3') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t10']; ?></option><?php
											?><option value="0" <?php if ($zakaz_view_status=='0') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t08']; ?></option><?php
											}
										else
											{
											?>
											<option value="1" <?php if ($zakaz_view_status=='1') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t07']; ?></option>
											<option value="2" <?php if ($zakaz_view_status=='2') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t09']; ?></option>
											<option value="3" <?php if ($zakaz_view_status=='3') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t10']; ?></option>
											<option value="0" <?php if ($zakaz_view_status=='0') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t08']; ?></option>
											<?php
											}
										?>
									</select>
									&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t15']; ?></b> 
									<select name="addstatus">
										<option value="0" <?php if ($zakaz_view_addstatus=='0') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t16']; ?></option>
										<option value="1" <?php if ($zakaz_view_addstatus=='1') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t17']; ?></option>
										<option value="2" <?php if ($zakaz_view_addstatus=='2') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t18']; ?></option>
										<option value="3" <?php if ($zakaz_view_addstatus=='3') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t19']; ?></option>
										<option value="4" <?php if ($zakaz_view_addstatus=='4') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t20']; ?></option>
										<option value="5" <?php if ($zakaz_view_addstatus=='5') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t21']; ?></option>
										<option value="6" <?php if ($zakaz_view_addstatus=='6') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t22']; ?></option>
										<option value="7" <?php if ($zakaz_view_addstatus=='7') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t146']; ?></option>
										<option value="8" <?php if ($zakaz_view_addstatus=='8') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t147']; ?></option>
										<option value="9" <?php if ($zakaz_view_addstatus=='9') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t148']; ?></option>										
									</select>
									&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t23']; ?>&nbsp;</b><input maxlength="20" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="artikul" type="text" value="<?php echo $zakaz_view_artikul; ?>">
								</p>
								<p>
									<b><?php echo $loc['zakaz.php']['t26']; ?>&nbsp;</b><input maxlength="10" style="width: 65px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="cena" type="text" value="<?php echo $zakaz_view_cena; ?>" >&nbsp;<?php echo $loc['zakaz.php']['t30']; ?>&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t27']; ?>&nbsp;</b><input maxlength="4" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="kolvo" type="text" style="width: 30px;" value="<?php echo $zakaz_view_kolvo; ?>">&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t28']; ?>&nbsp;</b><?php echo sprintf("%.2f",$zakaz_view_cena*$zakaz_view_kolvo); ?></b>&nbsp;<?php echo $loc['zakaz.php']['t30']; ?>&nbsp;&nbsp;
									<?php 
									$zakaz_offer_comission=htmlentities($res_offer['comission']);
									$zakaz_offer_tip_comission=htmlentities($res_offer['tip_comission']);
									$zakaz_offer_comission_cpa=htmlentities($res_offer['comission_cpa']);
									$zakaz_offer_tip_comission_cpa=htmlentities($res_offer['tip_comission_cpa']);
									
									if ($zakaz_offer_tip_comission=='1')
										{
										$summa_comission=$zakaz_offer_comission;
										}
									if ($zakaz_offer_tip_comission=='2')
										{
										$summa_comission=$zakaz_view_cena/100*$zakaz_offer_comission;
										}
									if ($zakaz_offer_tip_comission_cpa=='1')
										{
										$summa_comission_cpa=$zakaz_offer_comission_cpa;
										}
									if ($zakaz_offer_tip_comission_cpa=='2') 
										{
										$summa_comission_cpa=$zakaz_view_cena/100*$zakaz_offer_comission_cpa;
										}		
									?>
								</p>								
								<fieldset style="background: white; padding: 10px;">
								<legend style="background: white; line-height: 17px;"><b><?php echo $loc['zakaz.php']['t32']; ?></b></legend>
								<p>
									<b><?php echo $loc['zakaz.php']['t33']; ?>&nbsp;</b><input maxlength="40" style="width: 250px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="name" type="text" value="<?php echo $zakaz_view_name; ?>">&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t34']; ?>&nbsp;</b><input maxlength="20" style="width: 100px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="phone" type="text" value="<?php echo $zakaz_view_phone; ?>">&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t35']; ?>&nbsp;</b><input maxlength="40" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="email" type="text" value="<?php echo $zakaz_view_email; ?>">
								</p>
								<p>
									<b><?php echo $loc['zakaz.php']['t36']; ?>&nbsp;</b><?php if ($zakaz_view_client_address!=null) {echo $zakaz_view_client_address;} else {echo 'Не указан';} ?>
								</p>
								<p>
									<b><?php echo $loc['zakaz.php']['t37']; ?>&nbsp;</b><input maxlength="10" style="width: 70px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="zipcode" type="text" value="<?php echo $zakaz_view_zipcode; ?>">&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t38']; ?>&nbsp;</b><input maxlength="30" style="width: 150px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="country" type="text" value="<?php echo $zakaz_view_country; ?>">&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t39']; ?>&nbsp;</b><input maxlength="30" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="region" type="text" value="<?php echo $zakaz_view_region; ?>">&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t40']; ?>&nbsp;</b><input maxlength="30" style="width: 150px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="town" type="text" value="<?php echo $zakaz_view_town; ?>">
								</p>
								<p>
									<b><?php echo $loc['zakaz.php']['t41']; ?>&nbsp;</b><input maxlength="200" style="width: 300px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="street" type="text" value="<?php echo $zakaz_view_street; ?>">&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t42']; ?>&nbsp;</b><input maxlength="10" style="width: 100px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="dom" type="text" value="<?php echo $zakaz_view_dom; ?>">&nbsp;&nbsp;
									<b><?php echo $loc['zakaz.php']['t43']; ?>&nbsp;</b><input maxlength="4" style="width: 100px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="kvartira" type="text" value="<?php echo $zakaz_view_kvartira; ?>">
								</p>
								</fieldset>
								<p>
									<b><?php echo $loc['zakaz.php']['t44']; ?>&nbsp;</b><input style="width: 150px; text-align: center;" maxlength="20" placeholder="<?php echo $loc['zakaz.php']['t45']; ?>" name="tracking_number" type="text" value="<?php echo $zakaz_view_tracking_number; ?>">
								</p>
								<p>
									<b><?php echo $loc['zakaz.php']['t46']; ?>&nbsp;<font color=gray><?php echo $loc['zakaz.php']['t47']; ?></font>: </b><br /><textarea name="comments" maxlength="100" style="width: 99%; height: 18px; resize: none; font-family: Tahoma, Arial; font-weight: normal; font-size: 15px; letter-spacing: 1px; line-height: 18px; text-indent: 10px;" placeholder="<?php echo $loc['zakaz.php']['t48']; ?>"><?php echo $zakaz_view_comments; ?></textarea>
								</p>
								<?php
								if ($user_tip=='70')
									{
									?>
									<p>
										<b><?php echo $loc['zakaz.php']['t49']; ?>&nbsp;</b><?php if ($zakaz_view_referer!=null) {echo $zakaz_view_referer;} else {echo $loc['zakaz.php']['t50'];} ?>
									</p>
									<?php
									}
									?>
								<input name="nomer_zakaza" type="hidden" value="<?php echo $zakaz_view_id; ?>">
								<input name="user_id" type="hidden" value="<?php echo $zakaz_view_user_id; ?>">
								<input name="comission" type="hidden" value="<?php echo $zakaz_view_comission; ?>">
								<input name="comission_cpa" type="hidden" value="<?php
								// Если комиссия выставлена в виде фиксированной суммы, то выполняем это.
								// If the commission is exhibited in the form of a fixed amount, then we execute it.
								if ($zakaz_offer_tip_comission_cpa=='1')
									{
									echo $zakaz_offer_comission_cpa;
									}
								// Если комиссия выставлена в виде процентов от цены, то выполняем это.
								// If the commission is exhibited in the form of interest on prices, then we execute it.
								if ($zakaz_offer_tip_comission_cpa=='2')
									{
									echo $zakaz_offer_cena/100*$zakaz_offer_comission_cpa;
									}
								?>">
								<p>
									<input name="change_status" type="submit" value="<?php echo $loc['button']['t01']; ?>" class="others_button_sohranit" onclick="if (!confirm('<?php echo $loc['zakaz.php']['t51']; ?>'))return false;">
								</p>
							</form>
		
							<p>
								<?php 
								// Если в настройках CPA-сети разрешен трекинг посылок, то выводим блок с трекингом
								// If the CPA-network configuration allowed the tracking of parcels, the output unit with tracking
								if ($settings_russianpost_ok=='1')
									{
									if ($zakaz_view_tracking_number!=null) {include('modules/russianpost/index.php');} 
									}
								?>
							</p>
							
	
					</td>
					<td valign="top" width="300">
						<div class="offer_text_description">

							<table class="offer_table2">
								<tr class="table_zagolovki">
									<td colspan="2"><?php echo $loc['zakaz.php']['t52']; ?></td>
								</tr>
								<tr>
									<td width="70%"><nobr><?php echo $loc['zakaz.php']['t53']; ?></nobr></td>
									<td><nobr><?php echo date('d.m.Y', strtotime($zakaz_view_date)); ?></nobr></td>
								</tr>
								<tr>
									<td width="70%"><nobr><?php echo $loc['zakaz.php']['t54']; ?></nobr></td>
									<td><nobr><?php echo date('H:i:s', strtotime($zakaz_view_date)); ?></nobr></td>
								</tr>  
								<tr>
									<?php
									if ($zakaz_view_user_id!='0') 
										{
										echo '<td width="70%"><nobr>'.$loc['zakaz.php']['t55'].'</nobr></td><td><nobr>'.$zakaz_view_user_id.'</nobr></td>';
										}
									else
										{
										echo '<td colspan="2"><nobr>'.$loc['zakaz.php']['t56'].'</nobr></td>';
										}
									?>
								</tr>  								
								<tr>
									<td width="70%"><nobr><?php echo $loc['zakaz.php']['t57']; ?></nobr></td>
									<td><nobr><?php echo $zakaz_view_shop_zakaz_id; ?></nobr></td>
								</tr>								
							</table>  

							<table class="offer_table2">
								<tr class="table_zagolovki">
									<td><?php echo $loc['zakaz.php']['t58']; ?></td>
								</tr>
								<tr>
									<td style="line-height: 20px; padding: 10px;"><b><?php echo $loc['zakaz.php']['t59']; ?></b><br /><?php echo $zakaz_view_ip; ?><br /><br />
										<b><?php echo $loc['zakaz.php']['t60']; ?></b><br />
										<?php echo $zakaz_view_geo; ?>
									</td>
								</tr>
							</table>

							<table class="offer_table2">
								<tr class="table_zagolovki">
									<td><?php echo $loc['zakaz.php']['t61']; ?></td>
								</tr>
								<tr>
									<td style="line-height: 20px; padding: 10px;"><a target="_blank" href="nalojka.php?ob=<?php echo $zakaz_view_id; ?>"><?php echo $loc['zakaz.php']['t62']; ?></a></td>
								</tr>
							</table>
							
							<?php 
							// Если в настройках системы разрешены СМС-уведомления, то выводим этот блок
							// If the system settings enabled SMS-notification, we derive the block
							if ($settings_sms_ok==1 && $zakaz_offer_sms_ok==1)
								{
								// Если на балансе рекламодателя есть сумма достаточная для списания СМС, то выводим этот блок
								// If the advertiser's balance is the sum sufficient to write off SMS, then derive the block
								if ($user_balance>=$settings_sms_price)
									{
									?>							
									<table class="offer_table2">
										<tr class="table_zagolovki">
											<td><?php echo $loc['zakaz.php']['t63']; ?></td>
										</tr>
										<tr>
											<td style="line-height: 20px; padding: 10px;">
											
												<input type="button" name="sms_send" id="sms_send" value="<?php echo $loc['zakaz.php']['t64']; ?>" style="width: 245px;">
												<script>
													$('#sms_send').click
														(
														function()
															{
															if (confirm('<?php echo $loc['zakaz.php']['t65']; ?>'))
																{	
																document.getElementById('sms_send').disabled='disabled';
																document.getElementById('sms_send').value='<?php echo $loc['zakaz.php']['t66']; ?>';
																$.ajax
																	(
																		{
																		type: 'POST',
																		url: './sendsms.php', 
																		data: 'sms=send&ob=<?php echo $zakaz_view_id; ?>&zakaz_number=<?php echo $zakaz_view_number; ?>&offer_id=<?php echo $zakaz_view_offer_id; ?>&owner_id=<?php echo $zakaz_view_owner_id; ?>',
																		cache: false,  
																		timeout: 2000,
																		success: function(html)
																			{  
																			document.getElementById('sms_send').value='<?php echo $loc['zakaz.php']['t67']; ?>';
																			document.getElementById('sms_send').disabled='disabled';
																			},
																		error: function(html) 
																			{
																			document.getElementById('sms_send').value='<?php echo $loc['zakaz.php']['t68']; ?>';
																			document.getElementById('sms_send').disabled='disabled';
																			}	
																		}
																	);  
																}
															} 
														);
												</script>
												<br /><br />
													
												<input type="button" name="sms_way" id="sms_way" value="<?php echo $loc['zakaz.php']['t69']; ?>" style="width: 245px;">
												<script>
													$('#sms_way').click
														(
														function()
															{
															if (confirm('<?php echo $loc['zakaz.php']['t70']; ?>'))
																{
																document.getElementById('sms_way').disabled='disabled';
																document.getElementById('sms_way').value='<?php echo $loc['zakaz.php']['t66']; ?>';
																$.ajax
																	(
																		{
																		type: 'POST',
																		url: './sendsms.php', 
																		data: 'sms=way&ob=<?php echo $zakaz_view_id; ?>&zakaz_number=<?php echo $zakaz_view_number; ?>&offer_id=<?php echo $zakaz_view_offer_id; ?>&owner_id=<?php echo $zakaz_view_owner_id; ?>',
																		cache: false,  
																		timeout: 2000,
																		success: function(html)
																			{  
																			document.getElementById('sms_way').value='<?php echo $loc['zakaz.php']['t67']; ?>';
																			document.getElementById('sms_way').disabled='disabled';
																			},
																		error: function(html) 
																			{
																			document.getElementById('sms_way').value='<?php echo $loc['zakaz.php']['t68']; ?>';
																			document.getElementById('sms_way').disabled='disabled';
																			}	
																		}
																	);  
																}
															}
														);
												</script>
												<br /><br />											
		
												<input type="button" name="sms_success" id="sms_success" value="<?php echo $loc['zakaz.php']['t71']; ?>" style="width: 245px;">
												<script>
													$('#sms_success').click
														(
														function()
															{
															if (confirm('<?php echo $loc['zakaz.php']['t72']; ?>'))
																{														
																document.getElementById('sms_success').disabled='disabled';
																document.getElementById('sms_success').value='<?php echo $loc['zakaz.php']['t66']; ?>';
																$.ajax
																	(
																		{
																		type: 'POST',
																		url: './sendsms.php', 
																		data: 'sms=success&ob=<?php echo $zakaz_view_id; ?>&zakaz_number=<?php echo $zakaz_view_number; ?>&offer_id=<?php echo $zakaz_view_offer_id; ?>&owner_id=<?php echo $zakaz_view_owner_id; ?>',
																		cache: false,  
																		timeout: 2000,
																		success: function(html)
																			{  
																			document.getElementById('sms_success').value='<?php echo $loc['zakaz.php']['t67']; ?>';
																			document.getElementById('sms_success').disabled='disabled';
																			},
																		error: function(html) 
																			{
																			document.getElementById('sms_success').value='<?php echo $loc['zakaz.php']['t68']; ?>';
																			document.getElementById('sms_success').disabled='disabled';
																			}	
																		}
																	);  
																}
															}
														);
												</script>
												<br /><br />
											</td>
										</tr>
									</table>	
									<?php
									}
								}
							?>
						</div>
					</td>
				</tr>  
			</table>
		</p>
		<?php 
		}
	}
	// Конец блока с выводом отдельно взятого заказа
	// End block with the output of a single order
else
	{
	?>
	<!-- Блок с фильтром -->
	<!-- Block filter -->

	
	
	<?php
	// Получаем данные об офферах с которыми может работать колл-центр
	// We obtain data about the offerakh with which the call center can work  
	$sql_checkoffers = "SELECT offers FROM callcenters WHERE `id`='$user_callcenter' AND `active`='1'";
	$result_checkoffers = $mysqli->query($sql_checkoffers);
	if (mysqli_num_rows($result_checkoffers)>0) 
		{
		$res_checkoffers=mysqli_fetch_array($result_checkoffers);
		$spisok_offers=htmlentities($res_checkoffers['offers']);
		if ($spisok_offers=='') {$spisok_offers='0';}
		}
	else
		{
		$spisok_offers='0'; 
		}
	?>
	
	
		<script>
		$(function() {
		$.datepicker.regional['ru'] = {
		closeText: '<?php echo $loc['zakaz.php']['t73']; ?>',
		prevText: '&#x3c;<?php echo $loc['zakaz.php']['t74']; ?>',
		nextText: '<?php echo $loc['zakaz.php']['t75']; ?>&#x3e;',
		currentText: '<?php echo $loc['zakaz.php']['t76']; ?>',
		monthNames: ['<?php echo $loc['zakaz.php']['t77']; ?>','<?php echo $loc['zakaz.php']['t78']; ?>','<?php echo $loc['zakaz.php']['t79']; ?>','<?php echo $loc['zakaz.php']['t80']; ?>','<?php echo $loc['zakaz.php']['t81']; ?>','<?php echo $loc['zakaz.php']['t82']; ?>',
		'<?php echo $loc['zakaz.php']['t83']; ?>','<?php echo $loc['zakaz.php']['t84']; ?>','<?php echo $loc['zakaz.php']['t85']; ?>','<?php echo $loc['zakaz.php']['t86']; ?>','<?php echo $loc['zakaz.php']['t87']; ?>','<?php echo $loc['zakaz.php']['t88']; ?>'],
		monthNamesShort: ['<?php echo $loc['zakaz.php']['t89']; ?>','<?php echo $loc['zakaz.php']['t90']; ?>','<?php echo $loc['zakaz.php']['t91']; ?>','<?php echo $loc['zakaz.php']['t92']; ?>','<?php echo $loc['zakaz.php']['t93']; ?>','<?php echo $loc['zakaz.php']['t94']; ?>',
		'<?php echo $loc['zakaz.php']['t95']; ?>','<?php echo $loc['zakaz.php']['t96']; ?>','<?php echo $loc['zakaz.php']['t97']; ?>','<?php echo $loc['zakaz.php']['t98']; ?>','<?php echo $loc['zakaz.php']['t99']; ?>','<?php echo $loc['zakaz.php']['t100']; ?>'],
		dayNames: ['<?php echo $loc['zakaz.php']['t102']; ?>','<?php echo $loc['zakaz.php']['t103']; ?>','<?php echo $loc['zakaz.php']['t104']; ?>','<?php echo $loc['zakaz.php']['t104']; ?>','<?php echo $loc['zakaz.php']['t105']; ?>','<?php echo $loc['zakaz.php']['t106']; ?>','<?php echo $loc['zakaz.php']['t107']; ?>'],
		dayNamesShort: ['<?php echo $loc['zakaz.php']['t108']; ?>','<?php echo $loc['zakaz.php']['t109']; ?>','<?php echo $loc['zakaz.php']['t110']; ?>','<?php echo $loc['zakaz.php']['t111']; ?>','<?php echo $loc['zakaz.php']['t112']; ?>','<?php echo $loc['zakaz.php']['t113']; ?>','<?php echo $loc['zakaz.php']['t114']; ?>'],
		dayNamesMin: ['<?php echo $loc['zakaz.php']['t115']; ?>','<?php echo $loc['zakaz.php']['t116']; ?>','<?php echo $loc['zakaz.php']['t117']; ?>','<?php echo $loc['zakaz.php']['t118']; ?>','<?php echo $loc['zakaz.php']['t119']; ?>','<?php echo $loc['zakaz.php']['t120']; ?>','<?php echo $loc['zakaz.php']['t121']; ?>'],
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false
		};
		$.datepicker.setDefaults($.datepicker.regional['ru']); 
		$( "#datepicker" ).datepicker({inline: true});
		$( "#datepicker2" ).datepicker({inline: true});
		});
		</script>

		<p>
			<form method="get" action="./zakaz.php">
				<div class="v_odin_ryad">
					<p>
						<span>
							<b><?php echo $loc['zakaz.php']['t122']; ?>&nbsp;</b>
							<input type="text" name="date1" maxlength="10" value="<?php if ( !isset( $_GET['date1'] ) ) {echo date('d.m.Y',strtotime($dat1));} else {echo $_GET['date1'];} ?>" style="width: 87px; height: 24px; border: 1; margin: 0; padding: 0; text-align: center;" id="datepicker" readonly />
							<input type="text" name="date2" maxlength="10" value="<?php if ( !isset( $_GET['date2'] ) ) {echo date('d.m.Y',strtotime($dat2));} else {echo $_GET['date2'];} ?>" style="width: 87px; height: 24px; border: 1; margin: 0; padding: 0; text-align: center;" id="datepicker2" readonly />
						</span>
						<span>
							&nbsp;<b><?php echo $loc['zakaz.php']['t14']; ?>&nbsp;</b>
							<select name="status" style="height: 27px;">
							<option class="options" value="-1" <?php if (isset($_GET['status']) && $_GET['status']=="-1") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t123']; ?></option>
							<option class="options" value="1" <?php if (!isset($_GET['status']) || $_GET['status']=="1") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t124']; ?></option>
							<option class="options" value="2" <?php if (isset($_GET['status']) && $_GET['status']=="2") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t125']; ?></option>
							<option class="options" value="3" <?php if (isset($_GET['status']) && $_GET['status']=="3") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t126']; ?></option>
							<option class="options" value="0" <?php if (isset($_GET['status']) && $_GET['status']=="0") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t127']; ?></option>
							</select>
						</span>
						<span>
							&nbsp;<b><?php echo $loc['zakaz.php']['t149']; ?>&nbsp;</b>
							<select name="addstatus" style="height: 27px;">
							<option class="options" value="-1" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="-1") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t123']; ?></option>
							<option class="options" value="1" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="1") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t17']; ?></option>
							<option class="options" value="2" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="2") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t18']; ?></option>
							<option class="options" value="3" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="3") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t19']; ?></option>
							<option class="options" value="4" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="4") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t20']; ?></option>
							<option class="options" value="5" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="5") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t21']; ?></option>
							<option class="options" value="6" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="6") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t22']; ?></option>
							<option class="options" value="7" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="7") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t146']; ?></option>
							<option class="options" value="8" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="8") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t147']; ?></option>
							<option class="options" value="9" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="9") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t148']; ?></option>
							<option class="options" value="0" <?php if (isset($_GET['addstatus']) && $_GET['addstatus']=="0") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t16']; ?></option>
							</select>
						</span>						
					</p>
					<p>
						<span>
							<b><?php echo $loc['zakaz.php']['t13']; ?>&nbsp;</b>
							<select name="offer" style="height: 27px;">
								<option class="options" value="-1"><?php echo $loc['zakaz.php']['t123']; ?></option>
								<?php
								$sql_offer_view = "SELECT DISTINCT offer_id FROM zakaz WHERE offer_id IN ($spisok_offers) AND (`operator`='$user_id' || `operator`='0')";
								$result_offer_view = $mysqli->query($sql_offer_view);
								if (mysqli_num_rows($result_offer_view)>0) 
									{
									while($res_offer_view=mysqli_fetch_array($result_offer_view)) 
										{
										$of_id=htmlentities($res_offer_view['offer_id']);
										$sql_offer_name = "SELECT name FROM offers WHERE `id`='$of_id'";
										$result_offer_name = $mysqli->query($sql_offer_name);
										$res_offer_name=mysqli_fetch_array($result_offer_name);
										$of_name=htmlentities($res_offer_name['name']);
										?>
										<option class="options" value="<?php echo $of_id; ?>"<?php if (isset($_GET['offer']) && $_GET['offer']==$of_id) {echo 'selected="selected"';} ?>><?php echo $of_name; ?></option>
										<?php
										}
									}
								?>
							</select>
						</span>
						<span>
							&nbsp;<b><?php echo $loc['zakaz.php']['t55']; ?>&nbsp;</b>
							<select name="webmaster" style="height: 27px;">
								<option class="options" value="-1"><?php echo $loc['zakaz.php']['t123']; ?></option>
								<?php
								$sql_webmaster_view = "SELECT DISTINCT user_id FROM zakaz WHERE offer_id IN ($spisok_offers) AND (`operator`='$user_id' || `operator`='0')";
								$result_webmaster_view = $mysqli->query($sql_webmaster_view);
								if (mysqli_num_rows($result_webmaster_view)>0) 
									{
									while($res_webmaster_view=mysqli_fetch_array($result_webmaster_view)) 
										{
										$id_webmaster=htmlentities($res_webmaster_view['user_id']);
										?>
										<option class="options" value="<?php echo $id_webmaster; ?>"<?php if (isset($_GET['webmaster']) && $_GET['webmaster']==$id_webmaster) {echo 'selected="selected"';} ?>><?php echo $id_webmaster; ?></option>
										<?php
										}
									}
								?>
							</select>
						</span>
						<span>
							<b><?php echo $loc['zakaz.php']['t170']; ?></b>&nbsp;
							<select name="count">
								<option value="20" <?php if (isset($_GET['count']) && $_GET['count']=='20') {echo 'selected="selected"';} ?>>20</option>
								<option value="50" <?php if (isset($_GET['count']) && $_GET['count']=='50') {echo 'selected="selected"';} ?>>50</option>
								<option value="100" <?php if (isset($_GET['count']) && $_GET['count']=='100') {echo 'selected="selected"';} ?>>100</option>
							</select>						
						</span>						
					</p>
				</div>
				<div class="v_odin_ryad">
					<p>
						<input name="submit" value="<?php echo $loc['button']['t02']; ?>" class="others_button_vyvesti" type="submit" style="top: -2px; margin-left: 0px;"><br />
						<a href="./zakaz.php"><?php echo $loc['zakaz.php']['t128']; ?></a>
						<input type="hidden" name="page" value="1">
					</p>
				</div>
			</form>
		</p>

		<div style="margin-top: 120px;"></div>
		
		<!-- Конец блока с фильтром -->
		<!-- End block with filter -->

		<p>
			<?php
			// инициируем обработчик запросов для вычисления количества заказов во всех статусах
			// Initiate the query processor to calculate the number of orders in all statuses
			$zp=new zakaz_processor($mysqli);
			$zp->filter_fields['user_id']=isset($_GET['webmaster']) ? intval($_GET['webmaster']) : -1;
			$zp->filter_fields['owner_id']=intval($user_creator);
			$zp->filter_fields['operator_ya']=intval($user_id);
			$zp->filter_fields['operator_net']='0';
			$zp->filter_fields['offer']=isset($_GET['offer']) ? intval($_GET['offer']) : -1;
			$zp->filter_fields['count']=isset($_GET['count']) ? intval($_GET['count']) : 20;
			$zp->filter_fields['page']=isset($_GET['page']) ? intval($_GET['page']) : 1;
			$zp->filter_fields['sum']=isset($_GET['sum']) ? intval($_GET['sum']) : -1; 
			$zp->filter_fields['date_z']=isset($_GET['date_z']) ? intval($_GET['date_z']) : -1; 
			$zp->filter_fields['date_i']=isset($_GET['date_i']) ? intval($_GET['date_i']) : -1;  			
			$zp->filter_fields['date1']=$dat1.' '.$DT;
			$zp->filter_fields['date2']=$dat2.' '.$NT;
			$zp->filter_fields['status']=1;
			$k_zakaz_wait=$zp->get_count(true);
			$zp->filter_fields['status']=2;
			$k_zakaz_hold=$zp->get_count(true);
			$zp->filter_fields['status']=3;
			$k_zakaz_ok=$zp->get_count(true);
			$zp->filter_fields['status']=0;
			$k_zakaz_cancel=$zp->get_count(true);
			?>
			<div class="v_odin_ryad">
				<div class="link_wait_place" style="background: <?=!isset($_GET['status'])||$_GET['status']==1 ? '#d3d3d3' : 'none';?>;"><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 1, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t07']; ?>&nbsp;<?php if (isset($k_zakaz_wait) && $k_zakaz_wait>0) {echo "(".$k_zakaz_wait.")";} ?></a></div>
				<div class="link_hold_place" style="background: <?=isset($_GET['status'])&&$_GET['status']==2 ? '#d3d3d3' : 'none';?>;"><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 2, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t09']; ?>&nbsp;<?php if (isset($k_zakaz_hold) && $k_zakaz_hold>0) {echo "(".$k_zakaz_hold.")";} ?></a></div>
				<div class="link_ok_place" style="background: <?=isset($_GET['status'])&&$_GET['status']==3 ? '#d3d3d3' : 'none';?>;"><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 3, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t145']; ?>&nbsp;<?php if (isset($k_zakaz_ok) && $k_zakaz_ok>0) {echo "(".$k_zakaz_ok.")";} ?></a></div>
				<div class="link_cancel_place" style="background: <?=isset($_GET['status'])&&$_GET['status']==0 ? '#d3d3d3' : 'none';?>;"><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 0, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t130']; ?>&nbsp;<?php if (isset($k_zakaz_cancel) && $k_zakaz_cancel>0) {echo "(".$k_zakaz_cancel.")";} ?></a></div>
			</div>
		</p>
		
		<div style="margin-top: 165px;"></div>
		
		<p>
			<?php
			// передаем значения из фильтра
			// Pass the values ​​of the filter
			$zp->filter_fields['status']=isset($_GET['status']) ? intval($_GET['status']) : 1;
			$zp->filter_fields['addstatus']=isset($_GET['addstatus']) ? intval($_GET['addstatus']) : -1;
			// задаем limit и offset
			// We set limit and offset
			$show_pages = $zp->filter_fields['count']; // Сколько новостей покажем посетителям // How many news show visitors
			$zp->page_size=$show_pages;
			$zp->offset=$show_pages*(isset($_GET['page']) ? (intval($_GET['page'])-1) : 0);
			$rows_max=$zp->get_count(true);

			if ( isset( $_GET['page'] ) && !empty( $_GET['page'] ) ) $this_page = filter_var( $_GET['page'], FILTER_SANITIZE_NUMBER_INT ); // Номер текущей страницы // The current page number
			else $this_page = 1;

			// Вывод количества страниц (буферизируем html-код переключалки страниц в $paging_html)
			// Display the number of pages (html-code buffering switcher pages in $paging_html)
			$paging_html='';
			if ( $rows_max > $show_pages ) 
				{
				$r = 1;
				while ( $r <= ceil( $rows_max/$show_pages ) ) 
					{
					if ( $r != $this_page ) 
						{
						$paging_html.='<div id=pagination><a href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => $r)).'">'.$r.'</a></div>'; 
						}
					else 
						{
						$paging_html.='<div id=pagination><b>'.$r.'</b></div>';
						}
					$r++;
					}
				?><?php echo $paging_html; ?><br /><?php
				}
			// Конец вывода количества страниц
			// End of the output number of pages
			?>
		</p>

		<p>
			<table class="stats_table" style="width: 100%; border: 1px solid #d3d3d3; margin: 0px 0px 10px 0px;">
				<tr class="table_zagolovki" style="text-align: center;">
					<td width="50">&nbsp;</td>
					<td width="430"><?php echo $loc['zakaz.php']['t132']; ?></td>
					<td width="75">
						<a href="./zakaz.php?<?php 
						if (isset($_GET['date_z']) && $_GET['date_z']=='1')
							{
							$zp->filter_fields['date_z']='2';
							$zp->filter_fields['date_i']='-1';
							$zp->filter_fields['sum']='-1';
							}
						elseif (isset($_GET['date_z']) && $_GET['date_z']=='2')
							{
							$zp->filter_fields['date_z']='1';
							$zp->filter_fields['date_i']='-1';
							$zp->filter_fields['sum']='-1';							
							}
						else
							{
							$zp->filter_fields['date_z']='1';
							}						
						echo prepare_get_query($_GET,Array('status' => $zp->filter_fields['status'], 'page' => $zp->filter_fields['page'], 'date_z' => $zp->filter_fields['date_z'], 'date_i' => $zp->filter_fields['date_i'], 'sum' => $zp->filter_fields['sum']))?>"><?php echo $loc['zakaz.php']['t133']; ?></a>										
					</td>
					<td width="75">
						<a href="./zakaz.php?<?php 
						if (isset($_GET['date_i']) && $_GET['date_i']=='1')
							{
							$zp->filter_fields['date_i']='2';
							$zp->filter_fields['date_z']='-1';
							$zp->filter_fields['sum']='-1';							
							}
						elseif (isset($_GET['date_i']) && $_GET['date_i']=='2')
							{
							$zp->filter_fields['date_i']='1';
							$zp->filter_fields['date_z']='-1';
							$zp->filter_fields['sum']='-1';														
							}
						else
							{
							$zp->filter_fields['date_i']='1';
							}						
						echo prepare_get_query($_GET,Array('status' => $zp->filter_fields['status'], 'page' => $zp->filter_fields['page'], 'date_z' => $zp->filter_fields['date_z'], 'date_i' => $zp->filter_fields['date_i'], 'sum' => $zp->filter_fields['sum']))?>"><?php echo $loc['zakaz.php']['t134']; ?></a>										
					</td>
					<td width="285"><?php echo $loc['zakaz.php']['t135']; ?></td>
					<td><?php echo $loc['zakaz.php']['t136']; ?></td>
				</tr>			
			</table>
	
		
			<?php
			// получаем результат и вызываем файл zakaz_sql.php, в котором выводится результат
			// Get the result and call zakaz_sql.php file in which the result is output
			$result_to_display=$zp->get_result();
			include('zakaz_sql.php');
			?>
		</p>

		<p>
			<?php echo $paging_html; ?>
		</p>
		
<?php
		}
?>		

		<p>
			&nbsp;
		</p>		
		<p>
			&nbsp;
		</p>		

