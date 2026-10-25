<?php
// Подгружаем необходимые для работы функции
// Loads the necessary features to work
include 'zakaz_functions.php';
?>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url(); ?>/templates/<?php echo $template; ?>/css/redmond/jquery-ui-1.9.2.custom.css">
<script src="./templates/<?php echo $template; ?>/js/jquery-ui-1.9.2.custom.js"></script>

<script>
(function($) {
$(function() {

  $('input, select').styler({
    selectSearch: true,
    selectSearchLimit: 12,
  });

})
})(jQuery)

</script>
<p class="pageTitle"><span><?php echo $loc['zakaz.php']['t01']; ?></span></p>

<?php
// Блок с выводом отдельно взятого заказа
// Block with the output of a single order
if (isset($_GET['ob']) && $_GET['ob']!='' && $user_tip=='80')
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
                $zakaz_view_subid4=htmlentities($res_zakaz_view['subid4']);
                $zakaz_view_subid5=htmlentities($res_zakaz_view['subid5']);
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

		$zakaz_offer_comission=htmlentities($res_zakaz_view['comission']);
		$zakaz_offer_comission_cpa=htmlentities($res_zakaz_view['comission_cpa']);

		
		// Получаем данные об оффере по которому был заказ
		// Get the data on offere by which the order was
		$sql_offer = "SELECT * FROM offers WHERE id = $zakaz_view_offer_id";
		$result_offer = $mysqli->query($sql_offer);
		$res_offer=mysqli_fetch_array($result_offer);
		$zakaz_offer_name=htmlentities($res_offer['name']);
		$zakaz_offer_cena=htmlentities($res_offer['cena']);
		$zakaz_offer_deystvie=htmlentities($res_offer['deystvie']);
		$zakaz_offer_sms_ok=htmlentities($res_offer['sms_ok']);
                
                $status_array = array(0=>$loc['zakaz.php']['t08'], 1=>$loc['zakaz.php']['t07'], 2=>$loc['zakaz.php']['t09'],3=>$loc['zakaz.php']['t10'],5=>$loc['zakaz.php']['r1']);
                $dop_status_array = array(
                    0=>$loc['zakaz.php']['t16'], 
                    1=>$loc['zakaz.php']['t17'], 
                    2=>$loc['zakaz.php']['t18'],
                    3=>$loc['zakaz.php']['t19'],
                    4=>$loc['zakaz.php']['t20'],
                    5=>$loc['zakaz.php']['t21'],
                    6=>$loc['zakaz.php']['t22'],
                    7=>$loc['zakaz.php']['t146'],
                    8=>$loc['zakaz.php']['t147'],
                    9=>$loc['zakaz.php']['t148']
                        );
		?>
		<p>
			<table class="stats_table" style="width: 100%;">
				<tr class="tableHead">
					<td colspan="2"><?php echo $loc['zakaz.php']['t06']; ?>&nbsp;<?php echo $zakaz_view_id; ?> (<?php if ($zakaz_view_status=="1") {echo $loc['zakaz.php']['t07'];} if ($zakaz_view_status=="0") {echo $loc['zakaz.php']['t08'];} if ($zakaz_view_status=="2") {echo $loc['zakaz.php']['t09'];} if ($zakaz_view_status=="3") {echo $loc['zakaz.php']['t10'];} if ($zakaz_view_status=="5") {echo $loc['zakaz.php']['r1'];}?>)</td>
				</tr>
				<tr>
					<td><b><?php echo $loc['zakaz.php']['t11']; ?></b></td>
					<td width="300"><b><?php echo $loc['zakaz.php']['t12']; ?></b></td>
				</tr>
				<tr class="row_title">
					<td style="vertical-align: top; text-align: left;">

							<p>
								<b><?php echo $loc['zakaz.php']['t13']; ?>&nbsp;</b><?php echo html_entity_decode($zakaz_offer_name, ENT_QUOTES, 'utf-8'); ?>
							</p>
							<p>
								<b><?php echo $loc['zakaz.php']['t14']; ?>&nbsp;</b> <?php echo $status_array[$zakaz_view_status]; ?>
								&nbsp;&nbsp;
								<b><?php echo $loc['zakaz.php']['t15']; ?></b> <?php echo $dop_status_array[$zakaz_view_addstatus]; ?>
								&nbsp;&nbsp;
                                                                <b><?php echo $loc['zakaz.php']['t23']; ?>&nbsp;</b> <?php if(isset($zakaz_view_artikul) && $zakaz_view_artikul != '' && $zakaz_view_artikul != 0){echo $zakaz_view_artikul;}else{echo $loc['zakaz.php']['t24'];} ?>
							</p>
							<p>
								<b><?php echo $loc['zakaz.php']['t26']; ?>&nbsp;</b> <?php if(isset($zakaz_view_cena) && $zakaz_view_cena != '' && $zakaz_view_cena != 0){echo $zakaz_view_cena;}else{echo $loc['zakaz.php']['t24'];}?>&nbsp;
								<b><?php echo $loc['zakaz.php']['t27']; ?>&nbsp;</b> <?php if(isset($zakaz_view_kolvo) && $zakaz_view_kolvo != '' && $zakaz_view_kolvo != 0){echo $zakaz_view_kolvo;}else{echo $loc['zakaz.php']['t24'];}?>&nbsp;&nbsp;
								<b><?php echo $loc['zakaz.php']['t28']; ?>&nbsp;</b><?php echo sprintf("%.2f",$zakaz_view_cena*$zakaz_view_kolvo); ?></b>&nbsp;
								<b><?php echo $loc['zakaz.php']['t29']; ?>&nbsp;</b>
								<?php 	
								$summa_comission=$zakaz_offer_comission;
								$summa_comission_cpa=$zakaz_offer_comission_cpa;
								
								echo $zakaz_view_full_comission=sprintf("%.2f",($summa_comission*$zakaz_view_kolvo));
								echo '&nbsp;'.$loc['zakaz.php']['t30'].'&nbsp;';
                                                                ?>
							</p>								
							<fieldset style="background: white; padding: 10px;">
							<legend style="background: white; line-height: 17px;"><b><?php echo $loc['zakaz.php']['t32']; ?></b></legend>
							<p>
								<b><?php echo $loc['zakaz.php']['t33']; ?>&nbsp;</b> <?php if(isset($zakaz_view_name) && $zakaz_view_name != ''){echo $zakaz_view_name;}else{echo $loc['zakaz.php']['t24'];}?>&nbsp;&nbsp;
								<b><?php echo $loc['zakaz.php']['t34']; ?>&nbsp;</b> <?php if(isset($zakaz_view_phone) && $zakaz_view_phone != '' && $zakaz_view_phone != 0){echo $zakaz_view_phone;}else{echo $loc['zakaz.php']['t24'];}?>&nbsp;&nbsp;
								<b><?php echo $loc['zakaz.php']['t35']; ?>&nbsp;</b> <?php if(isset($zakaz_view_email) && $zakaz_view_email != '' && $zakaz_view_email != 0){ echo $zakaz_view_email;}else{echo $loc['zakaz.php']['t24'];}?>
							</p>
							</fieldset>
								<p>
									<b><?php echo $loc['zakaz.php']['t49']; ?>&nbsp;</b><?php if ($zakaz_view_referer!=null) {echo $zakaz_view_referer;} else {echo $loc['zakaz.php']['t50'];} ?>
								</p>
							<p>
								<b><?php echo $loc['zakaz.php']['t46']; ?>&nbsp;:&nbsp;</b><br /><textarea name="comments" rows="5" style="width: 99%; max-height: 150px;overflow-y: scroll; resize: none; font-family: Tahoma, Arial; font-weight: normal; font-size: 15px; letter-spacing: 1px; line-height: 18px; text-indent: 10px;" ><?php echo $zakaz_view_comments; ?></textarea>
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

						</div>
					</td>
				</tr>  
			</table>
		</p>
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
							<input type="text" name="date1" maxlength="10" value="<?php if ( !isset( $_GET['date1'] ) ) {echo date('d.m.Y',strtotime($dat1));} else {echo $_GET['date1'];} ?>" style="width: 87px; text-align: center;" id="datepicker" readonly />
							<input type="text" name="date2" maxlength="10" value="<?php if ( !isset( $_GET['date2'] ) ) {echo date('d.m.Y',strtotime($dat2));} else {echo $_GET['date2'];} ?>" style="width: 87px; text-align: center;" id="datepicker2" readonly />
						</span>
						<span>
							&nbsp;<b><?php echo $loc['zakaz.php']['t14']; ?>&nbsp;</b>
							<select class="width-150" name="status" style="height: 27px;">
							<option class="options" value="-1" <?php if (isset($_GET['status']) && $_GET['status']=="-1") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t123'];?></option>
							<option class="options" value="1" <?php if (!isset($_GET['status']) || $_GET['status']=="1") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t124']; ?></option>
							<option class="options" value="2" <?php if (isset($_GET['status']) && $_GET['status']=="2") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t125']; ?></option>
							<option class="options" value="3" <?php if (isset($_GET['status']) && $_GET['status']=="3") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t126']; ?></option>
							<option class="options" value="0" <?php if (isset($_GET['status']) && $_GET['status']=="0") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['t127']; ?></option>
							<option class="options" value="5" <?php if (isset($_GET['status']) && $_GET['status']=="5") { ?>selected="selected"<?php } ?>><?php echo $loc['zakaz.php']['r1']; ?></option>
							</select>
						</span>
						<span>
							&nbsp;<b><?php echo $loc['zakaz.php']['t149']; ?>&nbsp;</b>
							<select class="width-200"name="addstatus" style="height: 27px;">
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
							<select class="width-auto" name="offer">
                                                            <option <?php if (!isset($_GET['offer'])) echo ' selected '; ?> value="-1"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                                            <?php
                                                            $offers = new Offer;
                                                            $offers_arr = $offers->getByAdmin();   
                                                            if (is_array($offers_arr) && count($offers_arr) > 0) {
                                                                foreach ($offers_arr as $offer){
                                                                   echo '<option value="'.$offer['id'].'" ';
                                                                   if (isset($_GET['offer']) && $_GET['offer'] == $offer['id']) echo 'selected';
                                                                   echo '>'.html_entity_decode($offer['name'], ENT_QUOTES, 'utf-8').'</option>';
                                                                }                                    
                                                            }
                                                            ?>
							</select>
						</span>

						<span>
							&nbsp;<b><?php echo $loc['zakaz.php']['t55']; ?>&nbsp;</b>
							<select class="width-100" name="webmaster" style="height: 27px;">
								<option class="options" value="-1"><?php echo $loc['zakaz.php']['t123']; ?></option>
								<?php
								$sql_webmaster_view = "SELECT DISTINCT user_id FROM zakaz";
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
							<select class="width-100" name="count">
								<option value="20" <?php if (isset($_GET['count']) && $_GET['count']=='20') {echo 'selected="selected"';} ?>>20</option>
								<option value="50" <?php if (isset($_GET['count']) && $_GET['count']=='50') {echo 'selected="selected"';} ?>>50</option>
								<option value="100" <?php if (isset($_GET['count']) && $_GET['count']=='100') {echo 'selected="selected"';} ?>>100</option>
							</select>						
						</span>
					
					</p>
                                        
					<p>
						<span>
							<b>Поиск по ID:&nbsp;</b>
                                                        <input type="text" name="id" value="<?php if (isset($_GET['id']) && $_GET['id']!='') {echo $_GET['id'];} ?>" placeholder="id заказа">
						</span>                                         
                                            
						<span>
							<b>Поиск по тел.:</b>&nbsp;
							<input type="text" name="phone" value="<?php if (isset($_GET['phone']) && $_GET['phone']!='') {echo $_GET['phone'];} ?>" placeholder="Телефон(можно примерный)">						
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
                <div class="clear"></div>
		</p>
                
		<div style="margin-top: 20px;"></div>
		
		<!-- Конец блока с фильтром -->
		<!-- End unit with filter -->

		<p>
			<?php
			// инициируем обработчик запросов для вычисления количества заказов во всех статусах
			// Initiate the query processor to calculate the number of orders in all statuses
			$zp=new zakaz_processor($mysqli);
                        $zp->filter_fields['user_id']=isset($_GET['webmaster']) ? intval($_GET['webmaster']) : -1;
                        $zp->filter_fields['id']=(isset($_GET['id']) && $_GET['id'] != '') ? intval($_GET['id']) : -1;
                        $zp->filter_fields['phone']=(isset($_GET['phone']) && $_GET['phone'] != '') ? htmlentities($_GET['phone']) : -1;
			$zp->filter_fields['owner_id']=intval($user_id);
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
			$zp->filter_fields['status']=5;
			$k_zakaz_trash=$zp->get_count(true);
                        $zp->filter_fields['landing_id']=isset($_GET['landing_id']) ? intval($_GET['landing_id']) : -1;
                        $zp->filter_fields['prelanding_id']=isset($_GET['prelanding_id']) ? intval($_GET['prelanding_id']) : -1;
                        $zp->filter_fields['country']=isset($_GET['country']) ? htmlentities($_GET['country']) : -1;    			
			?>
			<div class="">
				<div class="link_wait_place stats <?php if (!isset($_GET['status']) or $_GET['status'] == 1) echo "active"; ?>"><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 1, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t07']; ?>&nbsp;<?php if (isset($k_zakaz_wait) && $k_zakaz_wait>0) {echo "(".$k_zakaz_wait.")";} ?></a></div>
				<div class="link_wait_place stats <?php if (isset($_GET['status']) && $_GET['status'] == 2) echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 2, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t09']; ?>&nbsp;<?php if (isset($k_zakaz_hold) && $k_zakaz_hold>0) {echo "(".$k_zakaz_hold.")";} ?></a></div>
				<div class="link_wait_place stats <?php if (isset($_GET['status']) && $_GET['status'] == 3) echo "active"; ?>"><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 3, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t129']; ?>&nbsp;<?php if (isset($k_zakaz_ok) && $k_zakaz_ok>0) {echo "(".$k_zakaz_ok.")";} ?></a></div>
				<div class="link_wait_place stats <?php if (isset($_GET['status']) && $_GET['status'] == 0) echo "active"; ?>" ><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 0, 'page' => 1))?>"><?php echo $loc['zakaz.php']['t130']; ?>&nbsp;<?php if (isset($k_zakaz_cancel) && $k_zakaz_cancel>0) {echo "(".$k_zakaz_cancel.")";} ?></a></div>
				<div class="link_wait_place stats <?php if (isset($_GET['status']) && $_GET['status'] == 5) echo "active"; ?>"><a href="./zakaz.php?<?=prepare_get_query($_GET,Array('status' => 5, 'page' => 1))?>"><?php echo $loc['zakaz.php']['r1']; ?>&nbsp;<?php if (isset($k_zakaz_trash) && $k_zakaz_trash>0) {echo "(".$k_zakaz_trash.")";} ?></a></div>
			</div>

		<div style="float:right;">
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

			if ( isset( $_GET['page'] ) && !empty( $_GET['page'] ) ) $this_page = filter_var( $_GET['page'], FILTER_SANITIZE_NUMBER_INT ); // Номер текущей страницы
			else $this_page = 1;

			// Вывод количества страниц (буферизируем html-код переключалки страниц в $paging_html)
			// Display the number of pages (html-code buffering switcher pages in $paging_html)
			$paging_html='';
                        // Первая и предыдущая страницы
                        // First & previous pages
                        if ($this_page != 1) {
                            $paging_html.='<div id="pagination-before-after"><a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => ($this_page-1))).'">&lt; Назад</a></div>';
                        }
    
			if ( $rows_max > $show_pages ){
                            
                            if($this_page >= 3){
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
                                $paging_html.='<div id="pagination-before-after"><a class="navigation-page" href="./zakaz.php?'.prepare_get_query($_GET,Array('page' => ($this_page+1))).'">Вперед &gt;</a></div>';
                            }                           
                            
                            echo $paging_html;
                        }
			// Конец вывода количества страниц
			// End of the output number of pages
			?>
                </div>
                <div class="clear"></div>
		
			<table class="stats_table" style="width: 100%; border: 1px solid #d3d3d3; margin: 0px 0px 10px 0px;">
				<tr class="tableHead" style="text-align: center;">
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
			</table>

			<?php
			// получаем результат и вызываем файл zakaz_sql.php, в котором выводится результат
			// Get the result and call zakaz_sql.php file in which the result is output
			$result_to_display=$zp->get_result();
			include('zakaz_sql.php');
			?>

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
