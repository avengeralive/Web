<link id="bsdp-css" href="./templates/<?php echo $template; ?>/lib/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script src="./templates/<?php echo $template; ?>/lib/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="./templates/<?php echo $template; ?>/lib/datepicker/locales/bootstrap-datepicker.ru.min.js" charset="UTF-8"></script>

<?php
// Подгружаем необходимые для работы функции
// Loads the necessary features to work
include 'zakaz_functions.php';
?>
<div class="row main mt-50 mb-50">

    <div class="col-12 mb-2">
        <p class="pageTitle"><span><?php echo $loc['zakaz.php']['t01']; ?></span></p>
    </div>
    
    <div class="col-12 mb-15">
        
<p>
	<?php 
	if (isset($_GET['xtext']) && $_GET['xtext']=='1') {echo '<font color=green><b>'.$loc['zakaz.php']['t02'].'</b></font> <a href="./zakaz.php">'.$loc['zakaz.php']['t03'].'</a>';} 
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='2') {echo '<font color=red><b>'.$loc['zakaz.php']['t04'].'</b></font> <a href="./zakaz.php">'.$loc['zakaz.php']['t05'].'</a>';} 
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='3') {echo '<font color=green><b>'.$loc['zakaz.php']['t160'].'</b></font>';} 	
	elseif (isset($_GET['xtext']) && $_GET['xtext']=='4') {echo '<font color=green><b>'.$loc['zakaz.php']['t02'].'</b></font>';}
	?>
</p>
    </div>
    
    
<?php
// Блок с выводом отдельно взятого заказа
// Block with the output of a single order
if (isset($_GET['ob']) && $_GET['ob']!='' && $user_tip=='40')
	{
	$access_zakaz = 1;
		
	$ob=htmlentities($_GET['ob']);
	$sql_zakaz_view = "SELECT * FROM zakaz WHERE `id`='$ob' AND `owner_id`='$user_id'";
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
                $zakaz_view_subid4=htmlentities($res_zakaz_view['subid4']);
                $zakaz_view_subid5=htmlentities($res_zakaz_view['subid5']);
		$zakaz_view_name=htmlentities($res_zakaz_view['name']);

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

		$zakaz_offer_comission=htmlentities($res_zakaz_view['comission']);
		$zakaz_offer_comission_cpa=htmlentities($res_zakaz_view['comission_cpa']);

		$sql1 = "SELECT type_rekl,balance FROM users WHERE `id`='$user_id' LIMIT 1";
		$result1 = $mysqli->query($sql1);
		$res1=mysqli_fetch_array($result1);

		$type_rekl = $res1['type_rekl'];
		$balance_rekl = $res1['balance'];
		$zakaz_view_full_comission=sprintf("%.2f",(($zakaz_offer_comission+$zakaz_offer_comission_cpa)));

		if($type_rekl == 0 && $balance_rekl < $zakaz_view_full_comission){
			$access_zakaz = 0;
		}

		if($access_zakaz == 1){ 
		$zakaz_view_phone=htmlentities($res_zakaz_view['phone']);
		$zakaz_view_email=htmlentities($res_zakaz_view['email']);
		}else{
		$zakaz_view_phone=$loc['zakaz.php']['t200'];
		$zakaz_view_email=$loc['zakaz.php']['t200'];
		}
			
		// Получаем данные об оффере по которому был заказ
		// Get the data on offere by which the order was
		$sql_offer = "SELECT * FROM offers WHERE id = $zakaz_view_offer_id";
		$result_offer = $mysqli->query($sql_offer);
		$res_offer=mysqli_fetch_array($result_offer);
		$zakaz_offer_name=htmlentities($res_offer['name']);
		$zakaz_offer_cena=htmlentities($res_offer['cena']);
		$zakaz_offer_deystvie=htmlentities($res_offer['deystvie']);
		$zakaz_offer_sms_ok=htmlentities($res_offer['sms_ok']);
		$zakaz_allow_success_status_zakaz=htmlentities($res_offer['allow_success_status_zakaz']);
		?>
		
			<table class="stats_table" style="width: 100%;">
				<tr class="tableHead">
					<td colspan="2"><?php echo $loc['zakaz.php']['t06']; ?>&nbsp;<?php echo $zakaz_view_number; ?> (<?php if ($zakaz_view_status=="1") {echo $loc['zakaz.php']['t07'];} if ($zakaz_view_status=="0") {echo $loc['zakaz.php']['t08'];} if ($zakaz_view_status=="2") {echo $loc['zakaz.php']['t09'];} if ($zakaz_view_status=="3") {echo $loc['zakaz.php']['t10'];} ?>)</td>
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
							<p style="font-size:16px;">
								<b><?php echo $loc['zakaz.php']['t14']; ?>&nbsp;</b>
                                                                <?php
                                                                if($zakaz_view_status != 2 && $zakaz_view_status != 3){
                                                                ?>
								<select name="status" class="width-150">
									<?php if ($zakaz_allow_success_status_zakaz!='1')
										{
										if ($zakaz_view_status!='0' && $zakaz_view_status!='2' && $zakaz_view_status!='3' && $zakaz_view_status!='5') {?><option value="1" <?php if ($zakaz_view_status=='1') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t07']; ?></option><?php }
										if ($zakaz_view_status!='0' && $zakaz_view_status!='3' && $zakaz_view_status!='5') {?><option value="2" <?php if ($zakaz_view_status=='2') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t09']; ?></option><?php }
										if ($zakaz_view_status!='0' && $zakaz_view_status!='5') {?><option value="3" <?php if ($zakaz_view_status=='3') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t10']; ?></option><?php }
										if ($zakaz_view_status!='3' && $zakaz_view_status!='5') {?><option value="0" <?php if ($zakaz_view_status=='0') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t08']; ?></option><?php }
										if ($zakaz_view_status!='0') {?><option value="5" <?php if ($zakaz_view_status=='0') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['r1']; ?></option><?php }
										}
									else
										{
										if ($zakaz_offer_deystvie=='5')
											{
											?><option value="3" <?php if ($zakaz_view_status=='3') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t10']; ?></option><?php
											?><option value="0" <?php if ($zakaz_view_status=='0') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t08']; ?></option><?php
											}
										else
											{
											?><option value="1" <?php if ($zakaz_view_status=='1') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t07']; ?></option><?php
											?><option value="2" <?php if ($zakaz_view_status=='2') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t09']; ?></option><?php
											?><option value="3" <?php if ($zakaz_view_status=='3') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t10']; ?></option><?php
											?><option value="0" <?php if ($zakaz_view_status=='0') {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t08']; ?></option><?php
											}
										}
									?>
								</select>
                                                                 <?php
                                                                }else{

										if ($zakaz_offer_deystvie=='5')
											{
											if ($zakaz_view_status=='3') {echo $loc['zakaz.php']['t10'];}
                                                                                        if ($zakaz_view_status=='0') {echo $loc['zakaz.php']['t08'];}
											}
										else
											{
                                                                                    if ($zakaz_view_status=='1') {echo $loc['zakaz.php']['t07'];}
                                                                                    if ($zakaz_view_status=='2') {echo $loc['zakaz.php']['t09'];}
                                                                                    if ($zakaz_view_status=='3') {echo $loc['zakaz.php']['t10'];}
                                                                                    if ($zakaz_view_status=='0') {echo $loc['zakaz.php']['t08'];}
											}

                                                                }
                                                                ?>                                                               
								<b><?php echo $loc['zakaz.php']['t15']; ?></b> 
								<select name="addstatus" class="width-200">
									<?php for ($i = 1; $i<=33; $i++) { ?>
									<option value="<?php echo $i; ?>" <?php if ($zakaz_view_addstatus==$i) {echo 'selected="selected"';} ?>><?php echo $loc['zakaz.php']['t'.(300+$i)]; ?></option>
									<?php } ?>							
								</select>
								<!--<select name="addstatus" class="width-200">
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
								</select>-->
                                                        </p>
							<p style="font-size:16px;">
								<b><?php echo $loc['zakaz.php']['t26']; ?>&nbsp;</b><input maxlength="10" style="width: 65px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="cena" type="text" value="<?php echo $zakaz_view_cena; ?>">&nbsp;<?php echo $loc['zakaz.php']['t30']; ?>&nbsp;
								<b><?php echo $loc['zakaz.php']['t29']; ?>&nbsp;</b>
								<?php 
								/*
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
								*/	
								$summa_comission=$zakaz_offer_comission;
								$summa_comission_cpa=$zakaz_offer_comission_cpa;
                                                                echo $zakaz_view_full_comission=sprintf("%.2f",(($summa_comission+$summa_comission_cpa)));
								echo '&nbsp;'.$loc['zakaz.php']['t30'].'&nbsp;';
								?>&nbsp;
								<b><?php echo $loc['zakaz.php']['t31']; ?>&nbsp;</b><?php echo $zakaz_view_itogo=sprintf("%.2f",($zakaz_view_cena*$zakaz_view_kolvo)-$zakaz_view_full_comission); ?>&nbsp;<?php echo $loc['zakaz.php']['t30']; ?>&nbsp;
							</p>								
							<fieldset style="background: white; padding: 10px;">
							<legend style="background: white; line-height: 17px;"><b><?php echo $loc['zakaz.php']['t32']; ?></b></legend>
							<p>
								<b><?php echo $loc['zakaz.php']['t33']; ?>&nbsp;</b><input maxlength="40" style="width: 250px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="name" type="text" value="<?php echo $zakaz_view_name; ?>">&nbsp;&nbsp;
							</p>
                                                        <p>
                                                                <b><?php echo $loc['zakaz.php']['t34']; ?>&nbsp;</b><input maxlength="20"  placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="phone" type="text" value="<?php echo $zakaz_view_phone; ?>">&nbsp;&nbsp;
							</p>
                                                        <p>
                                                                <b><?php echo $loc['zakaz.php']['t35']; ?>&nbsp;</b><input maxlength="50" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="email" type="text" value="<?php echo $zakaz_view_email; ?>">
							</p>
							<p style="font-size:16px;">
								<b><?php echo $loc['zakaz.php']['t36']; ?>&nbsp;</b><?php if ($zakaz_view_client_address!=null) {echo $zakaz_view_client_address;} else {echo $loc['zakaz.php']['t25'];} ?>
							</p>
							<p>
								<b><?php echo $loc['zakaz.php']['t37']; ?>&nbsp;</b><input maxlength="10" style="width: 70px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="zipcode" type="text" value="<?php echo $zakaz_view_zipcode; ?>">&nbsp;&nbsp;
								<b><?php echo $loc['zakaz.php']['t38']; ?>&nbsp;</b><input maxlength="30" style="width: 120px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="country" type="text" value="<?php echo $zakaz_view_country; ?>">&nbsp;&nbsp;
							</p>
                                                        <p>
                                                                <b><?php echo $loc['zakaz.php']['t39']; ?>&nbsp;</b><input maxlength="30" style="width: 200px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="region" type="text" value="<?php echo $zakaz_view_region; ?>">&nbsp;&nbsp;
								<b><?php echo $loc['zakaz.php']['t40']; ?>&nbsp;</b><input maxlength="30" style="width: 200px;" placeholder="<?php echo $loc['zakaz.php']['t24']; ?>" name="town" type="text" value="<?php echo $zakaz_view_town; ?>">
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
								<b><?php echo $loc['zakaz.php']['t46']; ?>&nbsp;<font color=gray><?php echo $loc['zakaz.php']['t47']; ?></font>:&nbsp;</b><br /><textarea name="comments" maxlength="100" style="width: 90%; height: 50px; resize: none; font-family: Tahoma, Arial; font-weight: normal; font-size: 15px; letter-spacing: 1px; line-height: 18px;" placeholder="<?php echo $loc['zakaz.php']['t48']; ?>"><?php echo $zakaz_view_comments; ?></textarea>
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
						
                                                        <input name="kolvo" type="hidden" value="<?php echo $zakaz_view_kolvo; ?>">  
                                                        <input name="artikul" type="hidden" value="<?php echo $zakaz_view_artikul; ?>">								
							<input name="nomer_zakaza" type="hidden" value="<?php echo $zakaz_view_id; ?>">
							<input name="user_id" type="hidden" value="<?php echo $zakaz_view_user_id; ?>">
							<input name="comission" type="hidden" value="<?php echo $zakaz_view_comission; ?>">
							<input name="comission_cpa" type="hidden" value="<?php echo $zakaz_offer_comission_cpa; ?>">
							<p>
								<input name="change_status" type="submit" value="<?php echo $loc['button']['t01']; ?>" class="others_button_sohranit" onclick="if (!confirm('<?php echo $loc['zakaz.php']['t51']; ?>'))return false;">
							</p>
						</form>
						<p>
						<?php 
						// Если в настройках CPA-сети разрешен трекинг посылок, то выводим блок с трекингом
						// If the CPA- network configuration allowed the tracking of parcels, the output unit with tracking
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
								<tr class="tableHead">
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
								<tr>
									<td colspan="2" style="line-height: 23px;">
										<?php
										$sql_operator_check = "SELECT email,callcenter FROM users WHERE `id`='$zakaz_view_operator' AND `creator`='$user_id'";
										$result_operator_check = $mysqli->query($sql_operator_check);
										$res_operator_check=mysqli_fetch_array($result_operator_check);	
										$operator_email=htmlentities($res_operator_check['email']);
										$operator_callcenter=htmlentities($res_operator_check['callcenter']);
										
										$sql_callcenter_check = "SELECT name FROM callcenters WHERE `id`='$operator_callcenter' AND `owner_id`='$user_id'";
										$result_callcenter_check = $mysqli->query($sql_callcenter_check);
										$res_callcenter_check=mysqli_fetch_array($result_callcenter_check);
										$callcenter_name=htmlentities($res_callcenter_check['name']);
										
										echo $loc['zakaz.php']['t157'].'&nbsp;';
											$sql_view_operators = "SELECT id,email FROM users WHERE `creator`='$user_id' AND `callcenter`='$operator_callcenter'";
										$result_view_operators = $mysqli->query($sql_view_operators);
										if (mysqli_num_rows($result_view_operators)>0) 
											{
											echo '<form action="./zakaz.php" method="post"><select name="op_id" style="width: 200px;"><option value="0">'.$loc['zakaz.php']['t161'].'</option>';
											while($res_view_operators=mysqli_fetch_array($result_view_operators)) 
												{
												$op_id=htmlentities($res_view_operators['id']);
												$op_email=htmlentities($res_view_operators['email']);
												?>
												<option value="<?php echo $op_id; ?>" <?php if ($op_id==$zakaz_view_operator) {echo 'selected="selected"';} ?>><?php echo html_entity_decode($op_email, ENT_QUOTES, 'utf-8'); ?></option>
												<?php
												}
											echo '</select><input name="id_zakaz" type="hidden" value="'.$ob.'">&nbsp;&nbsp;<input name="submit_change_operator" type="submit" value="'.$loc['zakaz.php']['t162'].'" onclick="if (!confirm(`'.$loc['zakaz.php']['t163'].'`))return false;"></form>';	
											}
										else
											{
											echo $loc['zakaz.php']['t161'];
											}
										?>
									</td>
								</tr>								
							</table>  

							<table class="offer_table2">
								<tr class="tableHead">
									<td><?php echo $loc['zakaz.php']['t58']; ?></td>
								</tr>
								<tr>
									<td style="line-height: 20px; padding: 10px;"><b><?php echo $loc['zakaz.php']['t59']; ?></b><br /><?php echo $zakaz_view_ip; ?><br /><br />
										<b><?php echo $loc['zakaz.php']['t60']; ?></b><br />
										<?php echo $zakaz_view_geo; ?>
									</td>
								</tr>
							</table>

                                                        <?php
                                                        if($access_zakaz == 1){ 
                                                        ?>
							<table class="offer_table2">
								<tr class="tableHead">
									<td><?php echo $loc['zakaz.php']['t61']; ?></td>
								</tr>
								<tr>
									<td style="line-height: 20px; padding: 10px;"><a target="_blank" href="nalojka.php?ob=<?php echo $zakaz_view_id; ?>"><?php echo $loc['zakaz.php']['t62']; ?></a></td>
								</tr>
							</table>
							
							<?php
                                                        }
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
																		timeout: 11000,
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
																		timeout: 11000,
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
																		timeout: 11000,
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

		<?php 
		}
	}
	// Конец блока с выводом отдельно взятого заказа
	// End unit with the output of a single order
else
	{
	?>
	<!-- Блок с фильтром -->
	<!-- Block filter -->
		<script>
                    $(function() {    
                        $('.input-daterange').datepicker({
                            todayBtn: "linked",
                            language: "ru",
                            todayHighlight: true
                        });
                    });
		</script>
                
            <div class="col-12 mb-15">
                
                 <form method="get" class="" action="./zakaz.php">
                    <div class="row align-items-end">
                        <div class="col-4"> 
                            <div class="form-group">
                                <label class="" for=""><b><?php echo $loc['zakaz.php']['t122']; ?>&nbsp;</b></label>         
                                <div class="input-daterange input-group" id="datepicker">   
                                    <input type="text" class="form-control" name="date1" value="<?php if ( !isset( $_GET['date1'] ) ) {echo date('d.m.Y',strtotime($dat1));} else {echo $_GET['date1'];} ?>" readonly>
                                    <input type="text" class="form-control" name="date2" value="<?php if ( !isset( $_GET['date2'] ) ) {echo date('d.m.Y',strtotime($dat2));} else {echo $_GET['date2'];} ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">   
                            <div class="form-group">
                            <label class="" for=""><b><?php echo $loc['zakaz.php']['t14']; ?>&nbsp;</b></label>                            
                            <select name="status" class="form-control">
                            <option class="options" value="-1" <?php if (isset($_GET['status']) && $_GET['status']=="-1") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t123'];?></option>
                            <option class="options" value="1" <?php if (!isset($_GET['status']) || $_GET['status']=="1") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t124']; ?></option>
                            <option class="options" value="3" <?php if (isset($_GET['status']) && $_GET['status']=="3") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t126']; ?></option>
                            <option class="options" value="0" <?php if (isset($_GET['status']) && $_GET['status']=="0") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t127']; ?></option>
                            <option class="options" value="5" <?php if (isset($_GET['status']) && $_GET['status']=="5") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['r1']; ?></option>
                            </select>
                            </div>
                        </div>
                        <div class="col-3">   
                            <div class="form-group">
                            <label class="" for=""><b><?php echo $loc['zakaz.php']['t13']; ?>&nbsp;</b></label>                            
                            <select name="offer" class="form-control" style="">
                                    <option class="options" value="-1"><?php echo $loc['zakaz.php']['t123']; ?></option>
                                    <?php
                                    $sql_offer_view = "SELECT DISTINCT offer_id FROM zakaz where user_id = '$user_id'";
                                    $result_offer_view = $mysqli->query($sql_offer_view);
                                    if (mysqli_num_rows($result_offer_view)>0) 
                                            {
                                            while($res_offer_view=mysqli_fetch_array($result_offer_view)) 
                                                    {
                                                    $of_id=htmlentities($res_offer_view['offer_id']);
                                                    $sql_offer_name = "SELECT name,allow_success_status_zakaz,deystvie FROM offers WHERE `id`='$of_id'";
                                                    $result_offer_name = $mysqli->query($sql_offer_name);
                                                    $res_offer_name=mysqli_fetch_array($result_offer_name);
                                                    $of_name=html_entity_decode($res_offer_name['name']);
                                                    ?>
                                                    <option class="options" value="<?php echo $of_id; ?>"<?php if (isset($_GET['offer']) && $_GET['offer']==$of_id) {echo 'selected="selected"';} ?>><?php echo $of_name; ?></option>
                                                    <?php
                                                    }
                                            }
                                    ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-2"> 
                            <div class="form-group">
                            <label class="" for=""><b><?php echo $loc['zakaz.php']['t123']; ?>&nbsp;</b></label>                            
                            <select name="webmaster" class="form-control" style="">
                                <option class="options" value="-1"><?php echo $loc['zakaz.php']['t123']; ?></option>
                                <?php
                                $sql_webmaster_view = "SELECT DISTINCT user_id FROM zakaz WHERE `owner_id`='$user_id'";
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
                            </div>
                        </div>
                    </div>    
                    <div class="form-group">   
                        <input type="hidden" name="page" value="1">
                        <input name="submit" value="<?php echo $loc['button']['t02']; ?>" class="btn button" type="submit">
                    </div>
                    <a href="./zakaz.php"><button type="button" class="btn button"><?php echo $loc['zakaz.php']['t128']; ?></button></a>
                </form>

            </div>	
		<!-- Конец блока с фильтром -->
		<!-- End unit with filter -->

		<p>
			<?php
			// инициируем обработчик запросов для вычисления количества заказов во всех статусах
			// Initiate the query processor to calculate the number of orders in all statuses
			$zp=new zakaz_processor($mysqli);
			$zp->filter_fields['user_id']=isset($_GET['webmaster']) ? intval($_GET['webmaster']) : -1;
			$zp->filter_fields['owner_id']=intval($user_id);
			$zp->filter_fields['offer']=isset($_GET['offer']) ? intval($_GET['offer']) : -1;
			$zp->filter_fields['count']=isset($_GET['count']) ? intval($_GET['count']) : 20;
			$zp->filter_fields['page']=isset($_GET['page']) ? intval($_GET['page']) : 1;
			$zp->filter_fields['sum']=isset($_GET['sum']) ? intval($_GET['sum']) : -1; 
			$zp->filter_fields['date_z']=isset($_GET['date_z']) ? intval($_GET['date_z']) : -1; 
			$zp->filter_fields['date_i']=isset($_GET['date_i']) ? intval($_GET['date_i']) : -1; 
			$zp->filter_fields['date1']=$dat1.' '.$DT;
			$zp->filter_fields['date2']=$dat2.' '.$NT;
                        
			$zp->filter_fields['status']='-1';
			$k_zakaz_all=$zp->get_count(true);
                        
			$zp->filter_fields['status']=1;
			$k_zakaz_wait=$zp->get_count(true);
			$zp->filter_fields['status']=2;
			$k_zakaz_hold=$zp->get_count(true);
			$zp->filter_fields['status']=3;
			$k_zakaz_ok=$zp->get_count(true);
			$zp->filter_fields['status']=0;
			$k_zakaz_cancel=$zp->get_count(true);
                        
                        $zp->filter_fields['landing_id']=isset($_GET['landing_id']) ? intval($_GET['landing_id']) : -1;
                        $zp->filter_fields['prelanding_id']=isset($_GET['prelanding_id']) ? intval($_GET['prelanding_id']) : -1;
                        $zp->filter_fields['country']=isset($_GET['country']) ? htmlentities($_GET['country']) : -1;                        
                        
			?>

    <div class="col-12 mb-10">
        
                <div class="row align-items-center mt-50 text-center m-0">
                    <div class="link_wait_place col  <?php if (!isset($_GET['status']) or $_GET['status'] == '-1') echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => -1, 'page' => 1))?>">Все&nbsp;<?php if (isset($k_zakaz_all) && $k_zakaz_all>0) {echo "(".$k_zakaz_all.")";} ?></a></div>
                    <div class="link_wait_place col  <?php if (isset($_GET['status']) && $_GET['status'] == 1) echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 1, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t07']; ?>&nbsp;<?php if (isset($k_zakaz_wait) && $k_zakaz_wait>0) {echo "(".$k_zakaz_wait.")";} ?></a></div>
                    <div class="link_wait_place col  <?php if (isset($_GET['status']) && $_GET['status'] == 3) echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 3, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t129']; ?>&nbsp;<?php if (isset($k_zakaz_ok) && $k_zakaz_ok>0) {echo "(".$k_zakaz_ok.")";} ?></a></div>
                    <div class="link_wait_place col  <?php if (isset($_GET['status']) && $_GET['status'] == 0) echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 0, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t130']; ?>&nbsp;<?php if (isset($k_zakaz_cancel) && $k_zakaz_cancel>0) {echo "(".$k_zakaz_cancel.")";} ?></a></div>
                    <div class="link_wait_place col  <?php if (isset($_GET['status']) && $_GET['status'] == 5) echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 5, 'page' => 1))?>"><?php echo $loc['zakaz.php']['r1']; ?>&nbsp;<?php if (isset($k_zakaz_trash) && $k_zakaz_trash>0) {echo "(".$k_zakaz_trash.")";} ?></a></div>
                </div>
        
    </div>    

        <?php
        if($k_zakaz_all > 0){
        // передаем значения из фильтра
        // Pass the values ​​of the filter
        $zp->filter_fields['status']=isset($_GET['status']) ? intval($_GET['status']) : '-1';
        $zp->filter_fields['addstatus']=isset($_GET['addstatus']) ? intval($_GET['addstatus']) : -1;
        // задаем limit и offset
        // We set limit and offset

        $show_pages = $zp->filter_fields['count']; // Сколько новостей покажем посетителям // How many news show visitors
        $zp->page_size=$show_pages;
        $zp->offset=$show_pages*(isset($_GET['page']) ? (intval($_GET['page'])-1) : 0);
        $rows_max=$zp->get_count(true);

        if ( isset( $_GET['page'] ) && !empty( $_GET['page'] ) ) $this_page = filter_var( $_GET['page'], FILTER_SANITIZE_NUMBER_INT ); // Номер текущей страницы
        else $this_page = 1;

        // Вывод количества страниц (буферизируем html-код переключалки страниц в $paging_html)
        // Display the number of pages (html-code buffering switcher pages in $paging_html)
        $paging_html='';
        $col = '';
        $col_end = '';
        // Первая и предыдущая страницы
        // First & previous pages
        if ($this_page != 1) {
            $paging_html.='<div id="pagination-before-after"><a class="left" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => ($this_page-1))).'"></a></div>';
        }

        if ( $rows_max > $show_pages ){

            if($this_page >= 3){
                $col = '<div class="col-12 mb-10">';
                $col_end = '</div>';
                $paging_html.= '<div id="pagination"><a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => 1)).'">1</a></div>';
                $paging_html.= '<div id="pagination"> ... </div>';                                
                for ($r = 1; $r <= ceil( $rows_max/$show_pages ); $r++) {   
                    if($r < ($this_page-1)){
                        continue;
                    }  
                    if($r > ($this_page+1) && $this_page < ($rows_max - 1)){
                        $paging_html.= '<div id="pagination"> ... </div>';
                        $paging_html.= '<div id="pagination"><a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => ceil( $rows_max/$show_pages))).'">'.ceil( $rows_max/$show_pages).'</a></div>';
                        break;
                    }    
                    $paging_html.='<div id="pagination">';
                    if ( $r != $this_page ){
                        $paging_html.='<a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => $r)).'">'.$r.'</a>'; 
                    }else{
                        $paging_html.='<span class=act>'.$r.'</span>';
                    }
                    $paging_html.='</div>';
                }                              
            }elseif($this_page < 3){
                $col = '<div class="col-12 mb-10">';
                $col_end = '</div>';
                for ($r = 1; $r <= ceil( $rows_max/$show_pages ); $r++) {            
                    if($r > 3){
                        $paging_html.= '<div id="pagination"> ... </div>';
                        $paging_html.= '<div id="pagination"><a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => ceil( $rows_max/$show_pages))).'">'.ceil( $rows_max/$show_pages).'</a></div>';
                        break;
                    }
                    $paging_html.='<div id="pagination">';
                    if ($r != $this_page) {
                        $paging_html.='<a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => $r)).'">'. $r .'</a>';
                    } else {
                        $paging_html.='<span class=act>'.$r.'</span>';
                    }
                    $paging_html.='</div>';
                }  
            }
            if ($this_page != ceil( $rows_max/$show_pages )) {
                $paging_html.='<div id="pagination-before-after"><a class="right" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => ($this_page+1))).'"></a></div>';
            }                           

        }

        // Конец вывода количества страниц
        // End of the output number of pages
        ?>

        <div class="col-12 mb-30">
                
			<table class="table table-bordered text-center">
				<tr class="tableHead" style="text-align: center;">
					<td><?php echo $loc['zakaz.php']['t132']; ?></td>
                                        <td style="min-width:135px;">Статус</td>
					<td>
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
					<td>
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
					<td><?php echo $loc['zakaz.php']['t135']; ?></td>
					<td><?php echo $loc['zakaz.php']['t136']; ?></td>
					<td class="zakaz_table_view_summ">
						<a href="./zakaz.php?<?php 
						if (isset($_GET['sum']) && $_GET['sum']=='1')
							{
							$zp->filter_fields['sum']='2';
							$zp->filter_fields['date_z']='-1';
							$zp->filter_fields['date_i']='-1';													
							}
						elseif (isset($_GET['sum']) && $_GET['sum']=='2')
							{
							$zp->filter_fields['sum']='1';
							$zp->filter_fields['date_z']='-1';
							$zp->filter_fields['date_i']='-1';																			
							}
						else
							{
							$zp->filter_fields['sum']='1';
							}						
						echo prepare_get_query($_GET,Array('status' => $zp->filter_fields['status'], 'page' => $zp->filter_fields['page'], 'date_z' => $zp->filter_fields['date_z'], 'date_i' => $zp->filter_fields['date_i'], 'sum' => $zp->filter_fields['sum']))?>"><?php echo $loc['zakaz.php']['t169']; ?></a>	
					</td>
				</tr>			

			<?php
			// получаем результат и вызываем файл zakaz_sql.php, в котором выводится результат
			// Get the result and call zakaz_sql.php file in which the result is output
			$result_to_display=$zp->get_result();
			include('zakaz_sql.php');
			?>
					</table>
        </div>
             <div class="col-12">
                <div class="row align-items-center">
                    <div class="col">
                        <?php echo $paging_html; ?>
                    </div>
                    <div class="col float-right text-right" style="height: 45px;">
                        <p>
                            <b><?php echo $loc['zakaz.php']['t170']; ?></b>&nbsp;
                            <select name="count" class="width-100">
                                <option value="20" <?php if (isset($_GET['count']) && $_GET['count']=='20') {echo 'selected="selected"';} ?>>20</option>
                                <option value="50" <?php if (isset($_GET['count']) && $_GET['count']=='50') {echo 'selected="selected"';} ?>>50</option>
                                <option value="100" <?php if (isset($_GET['count']) && $_GET['count']=='100') {echo 'selected="selected"';} ?>>100</option>
                            </select>						
                        </p>
                    </div>
                </div>
            </div>
                
		
		<?php
                        }else{
                ?>
                <div class="col-12 text-center">
                <p class="">Нет результатов</p>
                </div>
                <?php
                        }
        }
	?>		

    
    
    
</div>

