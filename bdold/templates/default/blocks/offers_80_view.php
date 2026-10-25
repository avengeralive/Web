<?php
$offer_id=htmlentities($_GET['offer']);

$user = User::getById($user_id);
$offer = Offer::getById($offer_id);
if ($offer->active != 1) {
    exit;
}

$hold_user = $user->hold_days;
$user_bonus_this_offer = 0;
$user_bonus_all_offer = $user->offers_reward_all;

$personal_bonus = explode('|', trim($user->offers_reward));
$offer_bonus = array();
foreach($personal_bonus as $key => $bonus){
    $offer_bonus[] = explode(':', trim($bonus));  
} 
$dop_bonus = 0;
foreach($offer_bonus as $bonus){
    if($bonus[0] == $offer_id){
        $dop_bonus = $bonus[1];
        break;
    }
}
if($dop_bonus != 0){
   $user_bonus_this_offer = $dop_bonus;
}elseif($dop_bonus == 0 && $user_bonus_all_offer != 0){
   $user_bonus_this_offer = $user_bonus_all_offer; 
}

	// Назначаем переменные
	// Assign variables

	$offer_tip=$offer->tip;
	$offer_active=$offer->active;
	$offer_uroven_dostupa=$offer->uroven_dostupa;
	$offer_name=$offer->name;
	$offer_descr = html_entity_decode($offer->descr);
	$offer_url=$offer->url;
        $offer_end=$offer->offer_end;
	$offer_date_end= ($offer_end > 0) ? date('d.m.Y H:i', $offer_end) : 'Неограничено';
	$kolvo_lids = ($offer->kolvo_lids > 0) ? $offer->kolvo_lids : 'Неограничено';
	$offer_owner_id=$offer->owner_id;
	$offer_deystvie=$offer->deystvie;
	$offer_cena=explode('|', trim($offer->cena));
	$offer_comission=explode('|', trim($offer->comission));
	$offer_tip_comission=explode('|', trim($offer->tip_comission));
	$offer_comission_cpa=explode('|', trim($offer->comission_cpa));
	$offer_tip_comission_cpa=explode('|', trim($offer->tip_comission_cpa));
	$offer_postclick=$offer->postclick;
	$offer_hold=$offer->hold;
        $off_balance=$offer->off_balance;
        $off_lids=$offer->off_lids;
        $deeplink=$offer->deeplink;
	
        
	// Переводим переменную отвечающая за тип принимаемого трафика в удобочитаемый вид
	// Translate variable responsible for the type of traffic received in convenient form
	$offer_tip_traffic=$offer->tip_traffic;
	list($tip_traffic1, $tip_traffic2, $tip_traffic3, $tip_traffic4, $tip_traffic5, $tip_traffic6, $tip_traffic7, $tip_traffic8, $tip_traffic9, $tip_traffic10, $tip_traffic11, $tip_traffic12, $tip_traffic13, $tip_traffic14, $tip_traffic15, $tip_traffic16) = explode('|', trim($offer_tip_traffic, '|'));	

	// Переводим переменную ГЕО в удобный вид
	// Translate variable GEO convenient form
	$offer_geo=explode('|', trim($offer->geo));
	$offer_country_iso_arr = explode(':', $offer_geo[0]);
	$offer_region_id_arr = explode(':', $offer_geo[1]);
	//list($offer_country_iso1, $offer_region_id1, $offer_city_id1) = explode('|', trim($offer_geo, '|'));
	?>
	<script src="./templates/<?php echo $template; ?>/js/main.js"></script>
	<p>
		<table class="stats_table" style="width: 750px;">
			<tr class="tableHead">
				<td><?php echo $loc['offers.php']['t03']; ?>&nbsp;&laquo;<?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?>&raquo;</td>
			</tr>
			<tr class="row_title" style="font-weight: normal;">
						<?php
						$sql_ur_v = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `uroven_dostupa`='$offer_uroven_dostupa' AND `tip_account`='10'";
						$result_ur_v = $mysqli->query($sql_ur_v);
						$res_ur_v=mysqli_fetch_array($result_ur_v);	
						$ur_v=htmlentities($res_ur_v['opisanie']);
						if ($user_uroven_dostupa>=$offer_uroven_dostupa) 
							{?><td style="background: green; color: white;"><nobr><?php echo $loc['offers.php']['t20']; ?></nobr><?php } 
						else
							{?><td style="background: red; color: white;"><nobr><?php echo $loc['offers.php']['t21']; ?>&nbsp;<?php echo $ur_v.'.</nobr>'; } 
						?>
						</td>
			</tr>
			<tr class="row_title">
				<td valign="top">
					<?php
					// определяем данные рекламодателя чей оффер выводится
					// Define the data the advertiser whose offer appears
					$sql_userdata = "SELECT * FROM users WHERE `id`='$offer_owner_id'";
					$result_userdata = $mysqli->query($sql_userdata);
					$res_userdata=mysqli_fetch_array($result_userdata);
					
					$userdata_id=htmlentities($res_userdata['id']);
					$userdata_email=htmlentities($res_userdata['email']);
					$userdata_balance=htmlentities($res_userdata['balance']);
					?>
						
					<p>
						<table class="offer_table2">
							<tr>
								<td style="width: 230px;">
						
									<?php $_SESSION['offer_id']=$offer_id; ?>

									<div class="cropimage_view" style="margin-left:15px;">
										<?php
										// Проверка, назначено ли промо для оффера
										// Check if the promo is scheduled to offera
										if (file_exists('./tmp/offer'.$offer_id.'.jpg')) 
											{
											?>
											<img border="0" src="./tmp/offer<?php echo $offer_id; ?>.jpg">
											<?php
											} 
										?>
									</div>

								</td>
								<td>
						
									<p style="line-height: 23px;    text-align: left;"><?php echo $offer_descr; ?></p>

								</td>								
							</tr>
						</table> 
							
						<table class="offer_table2">
							<tr class="tableHead">
								<td colspan="2"><?php echo $loc['offers.php']['t27']; ?></td>
							</tr>
							<tr>
								<td width="70%">
									<?php echo $loc['offers.php']['t30']; ?>
								</td>
								<td>
									<?php
									$res_checkdostup = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `uroven_dostupa`='$offer_uroven_dostupa' AND `tip_account`='10'";
									$result_checkdostup = $mysqli->query($res_checkdostup);
									$res_checkdostup=mysqli_fetch_array($result_checkdostup);
									echo $checkdostup_uroven_dostupa=htmlentities($res_checkdostup['opisanie']);
									?>		
								</td>
							</tr>								
						</table>							
					</p>

					<p>
						<table class="offer_table2">
							<tr class="tableHead">
								<td><?php echo $loc['offers.php']['t31']; ?></td>
							</tr>
							<tr>
								<td width="70%">
										<?php			
										$sql_deystvie = "SELECT deystvie FROM deystvie_tpl WHERE `id`='$offer_deystvie'";
										$result_deystvie = $mysqli->query($sql_deystvie);
										$res_deystvie=mysqli_fetch_array($result_deystvie);
										echo $deystvie_opisanie=htmlentities($res_deystvie['deystvie']);
										?>		
								</td>
							</tr>
						</table>  

						<table class="offer_table2">
							<tr class="tableHead">
								<td colspan="2"><?php echo $loc['offers.php']['t32']; ?></td>
							</tr>
							<tr>
								<td width="70%"><?php echo $loc['offers.php']['t33']; ?>&nbsp;<span class="smallinfo" title="<?php echo $loc['offers.php']['t35']; ?>"><?php echo $loc['offers.php']['t37']; ?></span></td>
								<td>
									<?php 
                                                                        if($offer->hidehold == 1 && $hold_user == 0){
                                                                           echo 
                                                                            '<a style="cursor:pointer;" id="faqHold">Индивидуально</a>
                                                                            <div class="faqHold">
                                                                                    Подробности уточняйте в тех.поддержке
                                                                            </div>                                                                               
                                                                            ';
                                                                        }elseif($hold_user != 0){                                                                            
                                                                           echo $hold_user;                                                                            
                                                                        }else{
                                                                           echo $offer_hold;  
                                                                        }
                                                                        
                                                                        
                                                                        ?>
								</td>
							</tr>
							<tr>
								<td><?php echo $loc['offers.php']['t38']; ?>&nbsp;<span class="smallinfo" title="<?php echo $loc['offers.php']['t39']; ?>"><?php echo $loc['offers.php']['t37']; ?></span></td>
								<td>
									<?php echo $offer_postclick; ?>
								</td>
							</tr>  
							<tr>
								<td><?php echo $loc['offers.php']['r1']; ?>&nbsp;<span class="smallinfo" title="<?php echo $loc['offers.php']['r2']; ?>"><?php echo $loc['offers.php']['t37']; ?></span></td>
								<td>
									
									<?php echo $offer_date_end; ?>
									
								</td>
							</tr>
							<tr>
								<td><?php echo $loc['offers.php']['r13']; ?>&nbsp;<span class="smallinfo" title="<?php echo $loc['offers.php']['r12']; ?>"><?php echo $loc['offers.php']['t37']; ?></span></td>
								<td>
									
									<?php echo $kolvo_lids; ?>
									
								</td>
							</tr>  							
						</table> 
						
						
<?php
if($off_lids != 0 or $off_balance != 0 or $offer_end != 0){    
    $sms_check = '';
    $email_check = '';
    $kolvo1 = 1;
	$kolvo_hour = 0;
	$kolvo_lids1 = 0;
    $sql = "SELECT * FROM dead_line_offers WHERE `user_id` = '$user_id' AND `offer_id` = '$offer_id' LIMIT 1";
    $result = $mysqli->query($sql);
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $type_deadline = $row['type_deadline'];
        $kolvo_hour = $row['kolvo_hour'];	
        $kolvo_lids1 = $row['kolvo_lids'];
        $sms_check = ($row['sms'] == 1) ? 'checked' : '';
        $email_check = ($row['email'] == 1) ? 'checked' : '';
    }
?>						
						
						<table class="offer_table2">
							<tr class="tableHead">
								<td colspan="2"><a style="cursor:pointer;" onclick="showRows('row1');"><?php echo $loc['offers.php']['r3']; ?></a></td>
							</tr>
							
							<tr class="row1" style="display:none;">
								<td width="70%"><?php echo $loc['offers.php']['r4']; ?></td>
								<td><input type="checkbox" id="sms_deadline" onchange="checkphone('<?=$user_phone; ?>');" value="1" <?=$sms_check; ?> name="sms_deadline"></td>
							</tr>
							<tr class="row1" style="display:none;">
								<td width="70%"><?php echo $loc['offers.php']['r5']; ?></td>
								<td><input type="checkbox" id="mail_deadline" value="1" <?=$email_check; ?> name="mail_deadline"></td>
							</tr> 
							<tr height="60px;" class="row1" style="display:none;">
								<td colspan="2">
								
								<?php 
                                if($offer_end != 0){ 
                                    
                                    echo $loc['offers.php']['r7']; 
                                    ?> 

                                    <input style="text-align:center;width:40px;font-size: 15px;height:22px;" id="kolvo_hour" type="text" name="kolvo_hour" value="<?=$kolvo_hour; ?>">								

                                    <?php echo $loc['offers.php']['r8']; ?>

                                    <?php echo $loc['offers.php']['r6']; ?>	
								
								<?php
                                }
                                if($off_lids != 0 or $off_balance != 0){
									if($offer_end != 0){ echo '&nbsp;&nbsp; / &nbsp;&nbsp;';} 
                                ?>    

                                    <?php echo $loc['offers.php']['r7']; ?> 

                                    <input style="text-align:center;width:40px;font-size: 15px;height:22px;" id="kolvo_lids" type="text" name="kolvo_lids" value="<?=$kolvo_lids1; ?>">								

                                    <?php echo $loc['offers.php']['r9']; ?>

                                    <?php echo $loc['offers.php']['r6']; ?>
								<?php
                                }
                                ?>  								
								</td>
							</tr> 	
							<tr class="row1" style="display:none;">
								<td colspan="2">
								<p id="phone_set"></p>
								<p>
									<input type="button" value="<?php echo $loc['button']['t01']; ?>" class="others_button_sohranit" style="margin-top: 6px;" onclick="setDeadLineNotific('<?=$offer_id; ?>');">
								</p>								
								</td>
							</tr>							
						</table>						

<?php
} 
?>					
							
						<table class="offer_table2">
							<tr class="tableHead">
								<td colspan="2"><?php echo $loc['offers.php']['t40']; ?></td>
							</tr>
							
							<?php
                                                        $cr_view = $epc_view = 0;
							$cr_view = $offer->cr;
                                                        $epc_view = $offer->epc;
							?>
							
							<tr>
								<td width="70%"><?php echo $loc['offers.php']['t06']; ?></td>
								<td><?php if (round($cr_view,2)=='0') {echo $loc['offers.php']['t19'];} else {echo round($cr_view,2);} ?></td>
							</tr>
							<tr>
								<td><?php echo $loc['offers.php']['t07']; ?></td>
								<td><?php if (round($epc_view,2)=='0') {echo $loc['offers.php']['t19'];} else {echo round($epc_view,2);} ?></td>
							</tr>  
						</table>

						<table class="offer_table2">
							<tr class="tableHead">
   								<td colspan="3"><?php echo $loc['offers.php']['t41']; ?></td>
							</tr>
 							<tr class="tableHead">
    							<td><?php echo $loc['offers.php']['t42']; ?></td>
								<td><?php echo $loc['offers.php']['t43']; ?></td>
								<td>
								<table style="width:100%;">
									<tr>
										<td colspan="2"><?php echo $loc['offers.php']['r17']; ?></td>
									</tr>
									<tr>
										<td style="font-size:13px;"><?php echo $loc['offers.php']['t28']; ?></td>
										<td style="font-size:13px;"><?php echo $loc['offers.php']['r18']; ?></td>
									</tr>	
								</table>			
								</td>
							</tr>									
							<tr>
									<?php
									
									if(count($offer_country_iso_arr) > 0 && count($offer_country_iso_arr) == count($offer_region_id_arr) && count($offer_country_iso_arr) == count($offer_cena) && count($offer_country_iso_arr) == count($offer_comission)	&& count($offer_country_iso_arr) == count($offer_tip_comission)){
										$t=0;
										foreach($offer_country_iso_arr as $key => $val){
											echo '<tr>';
											$sql_geo = "SELECT name_ru,currency FROM sxgeo_country WHERE `iso`='$val'";
											$result_geo = $mysqli->query($sql_geo);
											if (mysqli_num_rows($result_geo) > 0) 
												{
												$res_geo=mysqli_fetch_array($result_geo);
												$geo_country_name=htmlentities($res_geo['name_ru']);
												$currency=htmlentities($res_geo['currency']);
												}
											else
												{
												$geo_country_name=$loc['offers.php']['t09'];
												$currency=$loc['offers.php']['t17'];
												}				
											
											echo '<td>'.$geo_country_name.'</td>';
											
											$region = $offer_region_id_arr[$t];
											$sql_geo = "SELECT name_ru FROM sxgeo_regions WHERE `id`='$region'";
											$result_geo = $mysqli->query($sql_geo);
											if (mysqli_num_rows($result_geo) > 0) 
												{
												$res_geo=mysqli_fetch_array($result_geo);
												$geo_region=htmlentities($res_geo['name_ru']);
												}
											else
												{
												$geo_region=$loc['offers.php']['t09'];
												}											
											echo '<td>'.$geo_region.'</td>';	

												$price = ($offer_cena[$t] != 0) ? $offer_cena[$t] : $loc['offers.php']['t29'] ;
												$curr = ($offer_cena[$t] != 0) ? $currency : '' ;											
														
											if($offer_tip_comission[$t] == 1){
                                                                                            $bonus = '';
                                                                                            if($user_bonus_this_offer != 0){
                                                                                                $bonus = ' <font color="red">+'.$user_bonus_this_offer.' руб.</font>';
                                                                                            }
                                                                                            
												echo '<td><table style="width:100%;">';
												echo '<tr><td style="border:none;width:50%;">'.$price.' '.$curr.'</td>';
												echo '<td style="border:none;width:50%;">'.($offer_comission[$t]).' '.$loc['offers.php']['t17'].' '.$bonus.'</td>';
												echo '</tr></table></td>';											
											}elseif($offer_tip_comission[$t] == 2){
												echo '<td><table style="width:100%;">';
												echo '<tr><td style="border:none;width:50%;">'.$price.' '.$curr.'</td>';
												echo '<td style="border:none;width:50%;">'.($offer_comission[$t]).' %</td>';
												echo '</tr></table></td>';												
											}	
											echo '</tr>';
											$t++;
										}
									}else{
										echo '<tr>';
										echo '<td>'.$loc['offers.php']['t09'].'</td>';
										echo '<td>'.$loc['offers.php']['t09'].'</td>';

										if($offer_tip_comission[0] == 1){
											echo '<td><table style="width:100%;">';
											echo '<tr><td style="border:none;width:50%;">'.$offer_cena[0].' '.$loc['offers.php']['t17'].'</td>';
											echo '<td style="border:none;width:50%;">'.($offer_comission[0]).' '.$loc['offers.php']['t17'].'</td>';
											echo '</tr></table></td>';											
										}elseif($offer_tip_comission[0] == 2){
											echo '<td><table style="width:100%;">';
											echo '<tr><td style="border:none;width:50%;">'.$offer_cena[0].' '.$loc['offers.php']['t17'].'</td>';
											echo '<td style="border:none;width:50%;">'.($offer_comission[0]).' %</td>';
											echo '</tr></table></td>';												
										}
										echo '</tr>';
									}
									?>
						</table>

<?php
$urla1 = 'http://';
$sql = "SELECT * FROM traficbacks WHERE `user_id`='$user_id' AND `offer_id` = '$offer_id'";
$result = $mysqli->query($sql);
if (mysqli_num_rows($result) > 0){
	$row = mysqli_fetch_array($result);
	$trBackId = $row['id'];
	$urla1 = $row['url'];		
}
?>						
						<table class="offer_table2">
							<tr class="tableHead">
								<td colspan="3">
								<a style="cursor:pointer;" onclick="showRows('row2');"><?php echo $loc['offers.php']['r15']; ?></a> &nbsp&nbsp
								<a class="tr_back_faq" style="cursor:pointer;"><?php echo $loc['offers.php']['t37']; ?></a>
								<div class="helpTrBack">
									Вы можете указать ссылку, на которую будет перенаправляться пользователь в случае, если его гео не подходит под гео оффера, 
									либо в случае остановки оффера по техническим причинам.<br>
									Не теряйте свой трафик!<br>
									Вы так же можете передать метки, для этого используйте макросы:<br>
									{subid1}<br>
									{subid2}<br>
									{subid3}<br>
									Пример: blackdollar.ru/?utm1={subid1}&utm2={subid2}&utm3={subid3}
								</div>
								</td>
							</tr>
							
							<tr class="row2" style="display:none;">
								<td width="35%">Trafficback URL:</td>
								<td><input type="text" id="urla1" style="width: 300px;" value="<?=$urla1; ?>" name="urla1"></td>
								<td width="35px"><img style="cursor:pointer;width: 15px;" onclick="delTraficBackUrl('<?=$offer_id; ?>');" src="./templates/<?php echo $template; ?>/img/ico_delete.png" border="0"></td>
							</tr>
						
							<tr class="row2" style="display:none;">
								<td colspan="3">
									<p>
										<input type="button" value="<?php echo $loc['button']['t01']; ?>" class="others_button_sohranit" style="margin-top: 6px;" onclick="setTrafickBackUrl('<?=$offer_id; ?>');">
									</p>								
								</td>
							</tr>							
						</table>						
 
						<table class="offer_table2">
							<tr class="tableHead">
								<td colspan="2"><?php echo $loc['offers.php']['t45']; ?></td>
							</tr>
							<?php
							$sql_tip_traffic = "SELECT * FROM tip_traffic_tpl ORDER BY `tip` ASC";
							$result_tip_traffic=$mysqli->query($sql_tip_traffic);
							if (mysqli_num_rows($result_tip_traffic) > 0) 
								{
								while ($res_tip_traffic=mysqli_fetch_array($result_tip_traffic)) 
									{
									$tip_traffic=htmlentities($res_tip_traffic['tip']);
									$id_tip_traffic=htmlentities($res_tip_traffic['id']);
									?>
									<tr>
										<td width="70%"><?php echo $tip_traffic; ?></td>
										<td>
										<?php
										if ($id_tip_traffic==1) {if ($tip_traffic1==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==2) {if ($tip_traffic2==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==3) {if ($tip_traffic3==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==4) {if ($tip_traffic4==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==5) {if ($tip_traffic5==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==6) {if ($tip_traffic6==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==7) {if ($tip_traffic7==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==8) {if ($tip_traffic8==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==9) {if ($tip_traffic9==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==10) {if ($tip_traffic10==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==11) {if ($tip_traffic11==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==12) {if ($tip_traffic12==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==13) {if ($tip_traffic13==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==14) {if ($tip_traffic14==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==15) {if ($tip_traffic15==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										if ($id_tip_traffic==16) {if ($tip_traffic16==1) {echo '<font color=green><b>'.$loc['offers.php']['t46'].'</b></font>';} else {echo '<font color=red><b>'.$loc['offers.php']['t47'].'</b></font>';}}
										?>										
										</td>
									</tr>
									<?php
									}
								}
							?>
							
						<?php
						if ($user_uroven_dostupa>=$offer_uroven_dostupa) 
							{
							// Определяем домен который используется для лендингов
							// Determine the domain that is used for landing
							$sql_domain = "SELECT domain FROM domains WHERE `active`='1' ORDER BY `id` DESC";
							$result_domain = $mysqli->query($sql_domain);
							$res_domain=mysqli_fetch_array($result_domain);
							$domain=htmlentities($res_domain['domain']);
							?>

							<table class="offer_table2">
								<tr class="tableHead">
									<td colspan="3"><?php echo $loc['offers.php']['t222']; ?></td>
								</tr>
								<?php
								$sql_prelandings = "SELECT id,name,url FROM prelandings WHERE `offer_id`='$offer_id'";
								$result_prelandings = $mysqli->query($sql_prelandings);
								if (mysqli_num_rows($result_prelandings) > 0) 
									{
									while($res_prelandings=mysqli_fetch_array($result_prelandings)) 
										{
										$preland_id=htmlentities($res_prelandings['id']);
										$preland_name=htmlentities($res_prelandings['name']);
										$preland_url = str_replace('&amp;', '&', htmlentities($res_prelandings['url']));
										?>
										<tr>
											<td width="10%">
												<input type="checkbox" class="prelandings" name="prelandings[]" onchange="check_prelandings();" value="<?php echo $preland_id; ?>">
											</td>
											<td width="60%">
												<?php
												echo '<b>'.html_entity_decode($preland_name, ENT_QUOTES, 'utf-8').'</b>';
												?>
											</td>
											<td>
												<?php echo '<a target="_blank" href="'.$preland_url.'">'.$loc['offers.php']['t119'].'</a>'; ?>
											</td>
										</tr>
									<?php
									}
								}
							?>
							</table>
							
							<table class="offer_table2">
								<tr class="tableHead">
									<td colspan="3">
									<?php echo $loc['offers.php']['t223']; ?> 
																
									</td>
								</tr>								
								<?php
								$sql_landings = "SELECT id,name,url FROM landings WHERE `offer_id`='$offer_id'";
								$result_landings = $mysqli->query($sql_landings);
								if (mysqli_num_rows($result_landings) > 0) 
									{
                                                                        $z=0;
									while($res_landings=mysqli_fetch_array($result_landings)) 
										{
                                                                                if($z==0){$landing_ids = $res_landings['id'];}
										$land_id=htmlentities($res_landings['id']);
										$land_name=htmlentities($res_landings['name']);
										$land_url=htmlentities($res_landings['url']);											
										?>
										<tr>
											<td width="60%">
												<?php
												echo '<b>'.html_entity_decode($land_name, ENT_QUOTES, 'utf-8').'</b>';
												?>
											</td>
											<td>
												<?php echo '<a target="_blank" href="'.$land_url.'">'.$loc['offers.php']['t119'].'</a>'; ?>
											</td>
										</tr>
										<?php
                                                                                $z++;
										}
									}
								else
									{
									echo '<tr><td colspan="2" style="background: red; color: white;">'.$loc['offers.php']['t25'].'</td></tr>';		
									}
								?>
							</table>

							<?php
							}
						?>			
						
					</p>
				</td>
			</tr>  
		</table>

	</p>


<p>
	&nbsp;
</p>
	
