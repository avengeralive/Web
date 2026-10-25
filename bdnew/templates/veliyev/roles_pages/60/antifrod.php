
<p class="pageTitle"><span><?php echo $loc['antifrod.php']['t01']; ?></span></p>
<p>
	<?php if (isset($_GET['success'])) { ?><p><?php echo '<font color="green">Настройки антифрода сохранены!</font>'; ?></p><? } ?>
	<?php if (isset($_GET['banned'])) { ?><p><?php echo '<font color="green">Пользователь забанен!</font>'; ?></p><? } ?>
	<?php if (isset($_GET['checked'])) { ?><p><?php echo '<font color="green">Пользователь проверен!</font>'; ?></p><? } ?>

</p>
	<script>
(function($) {
$(function() {    
    $('select').styler({
       selectSearch: true,
       selectSearchLimit: 12,                      
     });               
     $('input').styler();   
});
})(jQuery);    

    $(document).on('change', '#checkingFrod', function () {
        var user = $('#user_id').val();
        $.ajax({
            url: './post/antifrod_check.php',
            type: 'POST',
            data: 'user='+user+'&check='+$(this).prop('checked')
        });
    })
	</script>
	<p>
		<form class="report" method="post" action="./antifrod.php?<?php echo @$_SERVER['QUERY_STRING']?>">
		
			<table class="stats_table" width="100%">
				<tr class="tableHead">
					<td colspan="6"><?php echo $loc['antifrod.php']['t02']; ?></td>
				</tr>		
				<tr class="">
					<td colspan="3"><b><?php echo $loc['antifrod.php']['t36']; ?></b></td>
					<td colspan="3"><b><?php echo $loc['antifrod.php']['t37']; ?></b></td>
				</tr>				
				<tr class="tableHead">
					<!-- <td><?php //echo $loc['antifrod.php']['t03']; ?></td>	-->
					<td><?php echo $loc['antifrod.php']['t04']; ?></td>
					<td><?php echo $loc['antifrod.php']['t06']; ?></td>		
					<td><?php echo $loc['antifrod.php']['t07']; ?></td>		
					<td><?php echo $loc['antifrod.php']['t04']; ?></td>
					<td><?php echo $loc['antifrod.php']['t06']; ?></td>
					<td><?php echo $loc['antifrod.php']['t38']; ?></td>
				</tr>
<?php
$sql = "SELECT * FROM antifrod_config WHERE `id` = '1' LIMIT 1";
$result = $mysqli->query($sql);
$antifrod_config=mysqli_fetch_array($result);
?>				
				<tr height="70px">
					<!-- <td><input type="text" name="phone" style="text-align:center;width:150px;" value="<? //echo $antifrod_config['phone']; ?>" maxlength="15" /></td>	-->
					<td><input type="text" name="lids_ip_1" style="text-align:center;width:70px;" value="<? echo $antifrod_config['lids_ip_1']; ?>" maxlength="15" /></td>	
					<td><input type="text" name="lids_referer_1" style="text-align:center;width:70px;" value="<? echo $antifrod_config['lids_referer_1']; ?>" maxlength="15" /></td>	
					<td><input type="text" name="lids_buys_1" style="text-align:center;width:70px;" value="<? echo $antifrod_config['lids_buys_1']; ?>" maxlength="15" /></td>	
					<td><input type="text" name="lids_ip_2" style="text-align:center;width:70px;" value="<? echo $antifrod_config['lids_ip_2']; ?>" maxlength="15" /></td>	
					<td><input type="text" name="lids_referer_2" style="text-align:center;width:70px;" value="<? echo $antifrod_config['lids_referer_2']; ?>" maxlength="15" /></td>	
					<td><input type="text" name="lids_buys_2" style="text-align:center;width:70px;" value="<? echo $antifrod_config['lids_buys_2']; ?>" maxlength="15" /></td>						
				</tr>
				<tr style="border:none;">
					<td colspan="7" style="border:none;"><input type="submit" name="submit_antifrod_settings" value="<?php echo $loc['button']['t01']; ?>" class="others_button_sohranit"></td>
				</tr>		

`			</table>				
		</form>
	</p>
	
<p><br></p>	

	<p>
		<form name="user_poisk" class="report" method="get" action="./antifrod.php?<?php echo @$_SERVER['QUERY_STRING']?>">
			<p>
				<b><?php echo $loc['antifrod.php']['t18']; ?>&nbsp;</b>
				<input type="text" name="search_zapros" style="text-align:center;width:70px;" value="<? if (isset($_GET['search_zapros'])) {echo $_GET['search_zapros'];} ?>" maxlength="100" />
			</p>
			<p>
				<span>
					<b><?php echo $loc['zakaz.php']['t13']; ?>&nbsp;</b>
					<select name="offer" style="height: 27px;">
						<option class="options" value="0"><?php echo $loc['zakaz.php']['t123']; ?></option>
						<?php
						$sql_offer_view = "SELECT DISTINCT offer_id FROM zakaz";
						$result_offer_view = $mysqli->query($sql_offer_view);
						if (mysqli_num_rows($result_offer_view)>0) 
							{
							while($res_offer_view=mysqli_fetch_array($result_offer_view)) 
								{
								$of_id=htmlentities($res_offer_view['offer_id']);
								$sql_offer_name = "SELECT name,allow_success_status_zakaz,deystvie FROM offers WHERE `id`='$of_id'";
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
			</p>	
			<p>
				<span>
					<b><?php echo $loc['antifrod.php']['t26']; ?>&nbsp;</b>
					<select name="viewOrder" style="height: 27px;">
						<option class="options" <?php if (isset($_GET['viewOrder']) && $_GET['viewOrder']==1) {echo 'selected="selected"';} ?> value="1"><?php echo $loc['antifrod.php']['t22']; ?></option>
						<option class="options" <?php if (isset($_GET['viewOrder']) && $_GET['viewOrder']==2) {echo 'selected="selected"';} ?> value="2"><?php echo $loc['antifrod.php']['t23']; ?></option>
						<option class="options" <?php if (isset($_GET['viewOrder']) && $_GET['viewOrder']==3) {echo 'selected="selected"';} ?> value="3"><?php echo $loc['antifrod.php']['t24']; ?></option>		
						<option class="options" <?php if (isset($_GET['viewOrder']) && $_GET['viewOrder']==4) {echo 'selected="selected"';} ?> value="4"><?php echo $loc['antifrod.php']['t25']; ?></option>								
					</select>
				</span>
			</p>
			<p>
				<span>
					<b><?php echo $loc['antifrod.php']['t27']; ?>&nbsp;</b>
					<select name="typeOffer" style="height: 27px;">
						<option class="options" <?php if (isset($_GET['typeOffer']) && $_GET['typeOffer']==0) {echo 'selected="selected"';} ?> value="0"><?php echo $loc['zakaz.php']['t123']; ?></option>
						<option class="options" <?php if (isset($_GET['typeOffer']) && $_GET['typeOffer']==3) {echo 'selected="selected"';} ?> value="3"><?php echo $loc['antifrod.php']['t28']; ?></option>
						<option class="options" <?php if (isset($_GET['typeOffer']) && $_GET['typeOffer']==2) {echo 'selected="selected"';} ?> value="2"><?php echo $loc['antifrod.php']['t29']; ?></option>		
						<option class="options" <?php if (isset($_GET['typeOffer']) && $_GET['typeOffer']==1) {echo 'selected="selected"';} ?> value="1"><?php echo $loc['antifrod.php']['t30']; ?></option>								
					</select>
				</span>
			</p>			
			<p>
				<b>&nbsp;</b><input type="hidden" name="add"><input name="submit_search" value="<?php echo $loc['button']['t02']; ?>" class="others_button_vyvesti" type="submit">
			</p>
		</form>
	</p>	
	
	
	<?php
	if (isset($_GET['submit_search']) && isset($_GET['search_zapros']) && $_GET['search_zapros']!='')
		{
		$search_zapros=intval($_GET['search_zapros']);
		$offerid = '';
		if(isset($_GET['offer']) && $_GET['offer'] != '0'){$offerid = " AND offer_id = '".htmlentities($_GET['offer'])."'";}

		$type_1_arr = array();
		$sql = "SELECT `id` FROM offers WHERE `type_offer` = '1'";
		$result = $mysqli->query($sql);
		while($res=mysqli_fetch_array($result)){
			$type_1_arr[] = $res['id'];
		}
		$type_2_arr = array();
		$sql = "SELECT `id` FROM offers WHERE `type_offer` = '2'";
		$result = $mysqli->query($sql);
		while($res=mysqli_fetch_array($result)){
			$type_2_arr[] = $res['id'];
		}
		$type_3_arr = array();
		$sql = "SELECT `id` FROM offers WHERE `type_offer` = '3'";
		$result = $mysqli->query($sql);
		while($res=mysqli_fetch_array($result)){
			$type_3_arr[] = $res['id'];
		}		
		$type_1 = implode(',',$type_1_arr);
		$type_2 = implode(',',$type_2_arr);
		$type_3 = implode(',',$type_3_arr);
		
		$typeOffer = '';
		if(isset($_GET['typeOffer']) && $_GET['typeOffer'] != '0'){$type = htmlentities($_GET['typeOffer']);$typeOffer = " AND offer_id IN (". ${'type_'.$type} .")";}
		
		
		$sql = "SELECT email, id, ip, frod_check FROM users WHERE `id` = '$search_zapros' LIMIT 1";
		$result = $mysqli->query($sql);
		$res=mysqli_fetch_array($result);
		$us_email = $res['email'];
		$us_id = $res['id'];
		$us_ip = $res['ip'];
                $frod_check = $res['frod_check'];

		$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$us_id' AND status IN (2,3) ".$offerid." ".$typeOffer;
		$result = $mysqli->query($sql);
		$res=mysqli_fetch_array($result);
		$count_zakaz=$res['COUNT(id)'];

		
		$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$us_id' AND `ip` = '$us_ip' AND status IN (2,3)".$offerid." ".$typeOffer;
		$result = $mysqli->query($sql);
		$res=mysqli_fetch_array($result);
		$count_ipWeb=$res['COUNT(id)'];

		
		$sql = "SELECT COUNT(*) AS `ip_same` FROM zakaz  WHERE `ip` IN (SELECT `ip` FROM zakaz WHERE `user_id` = '$us_id' AND status IN (2,3) ".$offerid." ".$typeOffer." GROUP BY `ip` HAVING COUNT(id)>1) AND `user_id` = '$us_id' ".$offerid." AND status IN (2,3)";
		$result = $mysqli->query($sql);
		$res=mysqli_fetch_array($result);
		$count_ip_same=$res['ip_same'];
/*
		$sql = "CREATE TEMPORARY TABLE count_browsers_table AS (SELECT id, CONCAT_WS(' ',`browser_name`,`browser_version`) as browser FROM zakaz WHERE `user_id` = '$us_id' AND status IN (2,3) )";
		$result = $mysqli->query($sql);
		$sql = "SELECT COUNT(`browser`) - COUNT(DISTINCT `browser`) AS `browser_same` FROM count_browsers_table";
		$result = $mysqli->query($sql);	
		$res=mysqli_fetch_array($result);
		$count_browser_same=$res['browser_same'];
*/
		$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$us_id' AND `referer` = '' AND status IN (2,3) ".$offerid." ".$typeOffer;
		$result = $mysqli->query($sql);
		$res=mysqli_fetch_array($result);
		$count_not_referer=$res['COUNT(id)'];
		
		$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$us_id' AND `status` IN (2,3) AND addstatus = '4' ".$offerid." ".$typeOffer;
		$result = $mysqli->query($sql);
		$res=mysqli_fetch_array($result);
		$count_buys_lids=$res['COUNT(id)'];

		$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$us_id' AND `status` IN (2,3) AND addstatus IN (5,6) ".$offerid." ".$typeOffer;
		$result = $mysqli->query($sql);
		$res=mysqli_fetch_array($result);
		$count_not_buys_lids=$res['COUNT(id)'];

		$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$us_id' AND `status` IN (2,3) AND addstatus IN (2,0,1) ".$offerid." ".$typeOffer;
		$result = $mysqli->query($sql);
		$res=mysqli_fetch_array($result);
		$count_wait_lids=$res['COUNT(id)'];
		
		$sql = "SELECT COUNT(id) FROM zakaz WHERE `user_id` = '$us_id' AND `status` IN (2,3) AND addstatus IN (2,0,1) AND DATE_FORMAT(date, '%Y-%m-%d') < (NOW() - INTERVAL 10 DAY) ".$offerid." ".$typeOffer;
		$result = $mysqli->query($sql);
		$res=mysqli_fetch_array($result);
		$count_not_buys_lids2=$res['COUNT(id)'];		
		
		if($_GET['typeOffer'] == 3){
		$count_wait_lids = $count_wait_lids - $count_not_buys_lids2;
		}
		
		if($count_ipWeb != 0 && $count_zakaz != 0){$proc_ipweb = round(($count_ipWeb*100)/$count_zakaz, 2);}else{$proc_ipweb = 0;}
		if($count_ip_same != 0 && $count_zakaz != 0){$proc_ip_same = round(($count_ip_same*100)/$count_zakaz, 2);}else{$proc_ip_same = 0;}
		if($count_not_referer != 0 && $count_zakaz != 0){$proc_not_referer = round(($count_not_referer*100)/$count_zakaz, 2);}else{$proc_not_referer = 0;}
		if($count_buys_lids != 0 && $count_zakaz != 0){$proc_buys_lids = round(($count_buys_lids*100)/$count_zakaz, 2);}else{$proc_buys_lids = 0;}
		
		if($count_not_buys_lids != 0 && $count_zakaz != 0){$proc_not_buys_lids = round(($count_not_buys_lids*100)/$count_zakaz, 2);}else{$proc_not_buys_lids = 0;}
		if($count_not_buys_lids2 != 0 && $count_zakaz != 0){$proc_not_buys_lids2 = round(($count_not_buys_lids2*100)/$count_zakaz, 2);}else{$proc_not_buys_lids2 = 0;}
		
		if($count_wait_lids != 0 && $count_zakaz != 0){$proc_wait_lidss = round(($count_wait_lids*100)/$count_zakaz, 2);}else{$proc_wait_lidss = 0;}
		$proc_not_buys_lids = $proc_not_buys_lids + $proc_not_buys_lids2;
		?>
		<table class="stats_table" width="100%">
			<tr class="tableHead">
				<td colspan="11"><?php echo $loc['antifrod.php']['t08']; ?></td>
			</tr>
			<tr class="tableHead">
				<td><nobr><?php echo $loc['users.php']['t30']; ?></nobr></td>	
				<td><nobr><?php echo $loc['users.php']['t31']; ?></nobr></td>	
				<td><nobr><?php echo $loc['antifrod.php']['t21']; ?></nobr></td>				
				<td><nobr><?php echo $loc['antifrod.php']['t09']; ?></nobr></td>
				<td><nobr><?php echo $loc['antifrod.php']['t10']; ?></nobr></td>
				<td><nobr><?php echo $loc['antifrod.php']['t12']; ?></nobr></td>
			<?php
				if($_GET['typeOffer'] == 3){
			?>				
				<td><nobr><?php echo $loc['antifrod.php']['t13']; ?></nobr></td>
				<td><nobr><?php echo $loc['antifrod.php']['t14']; ?></nobr></td>
				<td><nobr><?php echo $loc['antifrod.php']['t15']; ?></nobr></td>
			<?php
				}elseif($_GET['typeOffer'] == 1){
			?>
				<td><nobr><?php echo $loc['antifrod.php']['t32']; ?></nobr></td>
				<td><nobr><?php echo $loc['antifrod.php']['t33']; ?></nobr></td>
			<?php
				}else{
			?>			
				<td><nobr><?php echo $loc['antifrod.php']['t34']; ?></nobr></td>
				<td><nobr><?php echo $loc['antifrod.php']['t35']; ?></nobr></td>
			<?php
				}
			?>				
				<td><nobr>Бан</nobr></td>	
                                <td><nobr>Проверен</nobr></td>	
			</tr>

			<tr>
				<td><nobr><?php echo $us_id; ?></nobr></td>
				<td><nobr><?php echo $us_email; ?></nobr></td>
				<td><nobr><?php echo $count_zakaz; ?></nobr></td>
				<td><nobr><?php if($count_ipWeb > 0){ echo '<font color="red">';}else{echo '<font>';} echo $count_ipWeb.' ('.$proc_ipweb.'%) '; echo '</font>'; ?></nobr></td>
			<?php
				if($_GET['typeOffer'] == 3){
			?>
				<td><nobr><?php if($count_ip_same > $antifrod_config['lids_ip_1']){ echo '<font color="red">';}else{echo '<font>';} echo $count_ip_same.' ('.$proc_ip_same.'%) '; echo '</font>'; ?></nobr></td>			
				<td><nobr><?php if($proc_not_referer > $antifrod_config['lids_referer_1']){ echo '<font color="red">';}else{echo '<font>';} echo $count_not_referer.' ('.$proc_not_referer.'%) '; echo '</font>'; ?></nobr></td>			
				<td><nobr><?php echo $count_buys_lids.' ('.$proc_buys_lids.'%) '; ?></nobr></td>
				<td><nobr><?php if($proc_not_buys_lids > $antifrod_config['lids_buys_1']){ echo '<font color="red">';}else{echo '<font>';} echo ($count_not_buys_lids2+$count_not_buys_lids).' ('. $proc_not_buys_lids.'%) '; echo '</font>'; ?></nobr></td>
				<td><nobr><?php echo $count_wait_lids.' ('.$proc_wait_lidss.'%) '; ?></nobr></td>
			<?php
				}elseif($_GET['typeOffer'] == 1){
			?>
				<td><nobr><?php if($count_ip_same > $antifrod_config['lids_ip_2']){ echo '<font color="red">';}else{echo '<font>';} echo $count_ip_same.' ('.$proc_ip_same.'%) '; echo '</font>'; ?></nobr></td>			
				<td><nobr><?php if($proc_not_referer > $antifrod_config['lids_referer_2']){ echo '<font color="red">';}else{echo '<font>';} echo $count_not_referer.' ('.$proc_not_referer.'%) '; echo '</font>'; ?></nobr></td>			
				<td><nobr><?php echo $count_buys_lids.' ('.$proc_buys_lids.'%) '; ?></nobr></td>
				<td><nobr><?php if($proc_wait_lidss > $antifrod_config['lids_buys_2']){ echo '<font color="red">';}else{echo '<font>';} echo $count_wait_lids.' ('.$proc_wait_lidss.'%) '; echo '</font>'; ?></nobr></td>
			<?php
				}else{
			?>	
				<td><nobr><?php echo $count_ip_same.' ('.$proc_ip_same.'%) '; ?></nobr></td>	
				<td><nobr><?php echo $count_not_referer.' ('.$proc_not_referer.'%) '; ?></nobr></td>			
				<td><nobr><?php echo $count_buys_lids.' ('.$proc_buys_lids.'%) '; ?></nobr></td>
				<td><nobr><?php echo $count_wait_lids.' ('.$proc_wait_lidss.'%) '; ?></nobr></td>
			<?php
				}
			?>			
				
				<td><nobr>
				<a href="./antifrod.php?ban=<?php echo $search_zapros; ?>" onclick="if (!confirm('<?php echo $loc['antifrod.php']['t40']; ?>'))return false;"><?php echo $loc['antifrod.php']['t20']; ?></a>
				</nobr></td>
                                <td>
                                <nobr>
                                    <input type="checkbox" <?php if($frod_check == 1){echo 'checked';}?> id="checkingFrod" value="">
                                    <input type="hidden" id="user_id" value="<?=$us_id;?>">
                                </nobr>
                                </td>
			</tr>				
		</table>
		
<?php		

		
		if(isset($_GET['viewOrder']) && $_GET['viewOrder'] == 1){
		$sql = "SELECT * FROM zakaz WHERE `user_id` = '$us_id' AND status IN (2,3) AND `ip` = '$us_ip' ".$offerid;
		$result = $mysqli->query($sql);
		if(mysqli_num_rows($result) != 0){
?>			
<p style="line-height:40px;"><b><?php echo $loc['antifrod.php']['t22']; ?></b></p>					
<?php			
		while($res=mysqli_fetch_array($result)){
		// Получаем данные о свойствах заказа и оффера к которому он относится
		// Get the data on the properties and offer order to which he belongs
		$offer_id=htmlentities($res['offer_id']);

		// Получаем буквенное имя оффера
		// Get the name of the letter offer
		$sql_offers_name = "SELECT name,deystvie FROM offers WHERE id = $offer_id";
		$result_offers_name = $mysqli->query($sql_offers_name);
		$res_offers_name=mysqli_fetch_array($result_offers_name);
		$offer_name=htmlentities($res_offers_name['name']);		
		$offer_deystvie=htmlentities($res_offers_name['deystvie']);		

		// Назначаем необходимые переменные
		// Assign the required variables
		$zakaz_id=htmlentities($res['id']);
		$zakaz_user_id=htmlentities($res['user_id']);
		$zakaz_number=htmlentities($res['zakaz_number']);
		$zakaz_cena=htmlentities($res['cena']);
		$zakaz_kolvo=htmlentities($res['kolvo']);
		$zakaz_status=htmlentities($res['status']);
		$zakaz_addstatus=htmlentities($res['addstatus']);		
		$zakaz_date=date('d.m.Y H:i:s', strtotime(htmlentities($res['date'])));
		$zakaz_date_obrabotka=htmlentities($res['date_obrabotka']);
		$zakaz_comments=htmlentities($res['comments']);
	
		$zakaz_date=date('d.m.Y', strtotime(htmlentities($res['date']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date'])));
		if ($res['date_obrabotka']!='') 
			{
			$zakaz_date_obrabotka=date('d.m.Y', strtotime(htmlentities($res['date_obrabotka']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date_obrabotka'])));
			}
		else
			{
			if ($offer_deystvie!=5)
				{
				$zakaz_date_obrabotka='<center>'.$loc['zakaz.php']['t137'].'<br />'.$loc['zakaz.php']['t138'].'</center>';
				}
			}
		$zakaz_comments=htmlentities($res['comments']);
		$zakaz_clientname=htmlentities($res['name']);
		$zakaz_clientphone=htmlentities($res['phone']);
		$zakaz_tracking_number=htmlentities($res['tracking_number']);
		$zakaz_zipcode=htmlentities($res['zipcode']);
		$zakaz_country=htmlentities($res['country']);
		$zakaz_short_country=htmlentities($res['short_country']);
		$zakaz_region=htmlentities($res['region']);
		$zakaz_town=htmlentities($res['town']);
		$zakaz_street=htmlentities($res['street']);
		$zakaz_dom=htmlentities($res['dom']);
		$zakaz_kvartira=htmlentities($res['kvartira']);
		$zakaz_client_address=htmlentities($res['client_address']);
		$zakaz_email=htmlentities($res['email']);
		$zakaz_ip=htmlentities($res['ip']);
		$zakaz_artikul=htmlentities($res['artikul']);

		
		
		
		
?>		
		<table class="zakaz_table_view">
			<tr>
				<td class="zakaz_table_view_name">
					<?php 
					if ($zakaz_status=='0') {echo '<div class="zakaz_table_view_status_0">'.$loc['zakaz.php']['t08'].'</div>';}
					if ($zakaz_status=='1') {echo '<div class="zakaz_table_view_status_1">'.$loc['zakaz.php']['t07'].'</div>';}
					if ($zakaz_status=='2') {echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['t09'].'</div>';}
					if ($zakaz_status=='3') {echo '<div class="zakaz_table_view_status_3">'.$loc['zakaz.php']['t10'].'</div>';}
					if ($zakaz_status=='5') {echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['r1'].'</div>';}
					
					if ($zakaz_addstatus=='0') {echo '<div class="zakaz_table_view_addstatus_0">'.$loc['zakaz.php']['t16'].'</div>';}					
					if ($zakaz_addstatus=='1') {echo '<div class="zakaz_table_view_addstatus_1">'.$loc['zakaz.php']['t17'].'</div>';}					
					if ($zakaz_addstatus=='2') {echo '<div class="zakaz_table_view_addstatus_2">'.$loc['zakaz.php']['t18'].'</div>';}					
					if ($zakaz_addstatus=='3') {echo '<div class="zakaz_table_view_addstatus_3">'.$loc['zakaz.php']['t19'].'</div>';}					
					if ($zakaz_addstatus=='4') {echo '<div class="zakaz_table_view_addstatus_4">'.$loc['zakaz.php']['t20'].'</div>';}					
					if ($zakaz_addstatus=='5') {echo '<div class="zakaz_table_view_addstatus_5">'.$loc['zakaz.php']['t21'].'</div>';}					
					if ($zakaz_addstatus=='6') {echo '<div class="zakaz_table_view_addstatus_6">'.$loc['zakaz.php']['t22'].'</div>';}					
					if ($zakaz_addstatus=='7') {echo '<div class="zakaz_table_view_addstatus_7">'.$loc['zakaz.php']['t146'].'</div>';}					
					if ($zakaz_addstatus=='8') {echo '<div class="zakaz_table_view_addstatus_8">'.$loc['zakaz.php']['t147'].'</div>';}					
					if ($zakaz_addstatus=='9') {echo '<div class="zakaz_table_view_addstatus_9">'.$loc['zakaz.php']['t148'].'</div>';}						

					// Проверка, назначено ли промо для оффера. Если не назначено, то выводим сообщение об этом
					// Check if the promo is scheduled to offer. If not set, the message about this
					if (file_exists('./tmp/offer'.$offer_id.'.jpg')) 
						{
						?>
						<a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><img class="zakaz_table_view_imgoffer" src="./tmp/offer<?php echo $offer_id; ?>.jpg"></a>
						<?php
						}
					else
						{
						?>
						<a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><div class="zakaz_table_view_imgoffer"></div></a>
						<?php
						}							
					?>
					<div class="zakaz_table_view_nametext">
						<a target="_blank" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><b><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></b></a>
					</div>
				</td>
				<td class="zakaz_table_view_date">
					<?php echo $zakaz_date; ?>
				</td>
				<td class="zakaz_table_view_date" style="<?php if ($res['date_obrabotka']=='' && $offer_deystvie!=5) {echo 'background: yellow; color: red;';} ?>">
					<?php echo $zakaz_date_obrabotka; ?>
				</td>				
				<td width="285" class="zakaz_table_view_comments">
					<a href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><?php echo TrimText($zakaz_comments,130); ?></a>
				</td>
				<td class="zakaz_table_view_geo">
					<?php echo '<b>'.$loc['zakaz.php']['t142'].'&nbsp;</b>'.$zakaz_ip;
					$zakaz_short_country=strtolower($zakaz_short_country);
					// Проверка, есть ли в наличии картинка под определяемую страну
					// Check whether there is a presence of the picture under the defined country
					if (file_exists('./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png')) 
						{
						echo '<br /><img src=./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png> ';
						echo $zakaz_country;
						}
					else
						{
						echo '<br />'.$zakaz_country;
						}
					if ($zakaz_user_id!='0') 
						{
						echo '<br /><b>'.$loc['zakaz.php']['t143'].'&nbsp;</b>'.$zakaz_user_id;
						}
					else
						{
						echo '<br /><b>'.$loc['zakaz.php']['t144'].'</b>';	
						}
					?>
				</td>
			</tr>
		</table>
<?php
		}
		}
		}elseif(isset($_GET['viewOrder']) && $_GET['viewOrder'] == 2){
		$sql = "SELECT * FROM zakaz WHERE `ip` IN (SELECT `ip` FROM zakaz WHERE `user_id` = '$us_id' AND status IN (2,3) ".$offerid." GROUP BY `ip` HAVING COUNT(id)>1) ".$offerid." AND `user_id` = '$us_id' AND status IN (2,3) ORDER BY `ip`";
		$result = $mysqli->query($sql);
		if(mysqli_num_rows($result) != 0){
?>			
<p style="line-height:40px;margin-top:25px;"><b><?php echo $loc['antifrod.php']['t23']; ?></b></p>		
<?php			
		while($res=mysqli_fetch_array($result)){
			// Получаем данные о свойствах заказа и оффера к которому он относится
			// Get the data on the properties and offer order to which he belongs
			$offer_id=htmlentities($res['offer_id']);

			// Получаем буквенное имя оффера
			// Get the name of the letter offer
			$sql_offers_name = "SELECT name,deystvie FROM offers WHERE id = $offer_id";
			$result_offers_name = $mysqli->query($sql_offers_name);
			$res_offers_name=mysqli_fetch_array($result_offers_name);
			$offer_name=htmlentities($res_offers_name['name']);		
			$offer_deystvie=htmlentities($res_offers_name['deystvie']);		

			// Назначаем необходимые переменные
			// Assign the required variables
			$zakaz_id=htmlentities($res['id']);
			$zakaz_user_id=htmlentities($res['user_id']);
			$zakaz_number=htmlentities($res['zakaz_number']);
			$zakaz_cena=htmlentities($res['cena']);
			$zakaz_kolvo=htmlentities($res['kolvo']);
			$zakaz_status=htmlentities($res['status']);
			$zakaz_addstatus=htmlentities($res['addstatus']);		
			$zakaz_date=date('d.m.Y H:i:s', strtotime(htmlentities($res['date'])));
			$zakaz_date_obrabotka=htmlentities($res['date_obrabotka']);
			$zakaz_comments=htmlentities($res['comments']);
		
			$zakaz_date=date('d.m.Y', strtotime(htmlentities($res['date']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date'])));
			if ($res['date_obrabotka']!='') 
				{
				$zakaz_date_obrabotka=date('d.m.Y', strtotime(htmlentities($res['date_obrabotka']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date_obrabotka'])));
				}
			else
				{
				if ($offer_deystvie!=5)
					{
					$zakaz_date_obrabotka='<center>'.$loc['zakaz.php']['t137'].'<br />'.$loc['zakaz.php']['t138'].'</center>';
					}
				}
			$zakaz_comments=htmlentities($res['comments']);
			$zakaz_clientname=htmlentities($res['name']);
			$zakaz_clientphone=htmlentities($res['phone']);
			$zakaz_tracking_number=htmlentities($res['tracking_number']);
			$zakaz_zipcode=htmlentities($res['zipcode']);
			$zakaz_country=htmlentities($res['country']);
			$zakaz_short_country=htmlentities($res['short_country']);
			$zakaz_region=htmlentities($res['region']);
			$zakaz_town=htmlentities($res['town']);
			$zakaz_street=htmlentities($res['street']);
			$zakaz_dom=htmlentities($res['dom']);
			$zakaz_kvartira=htmlentities($res['kvartira']);
			$zakaz_client_address=htmlentities($res['client_address']);
			$zakaz_email=htmlentities($res['email']);
			$zakaz_ip=htmlentities($res['ip']);
			$zakaz_artikul=htmlentities($res['artikul']);

			
			
			
			
	?>		
	
			<table class="zakaz_table_view">
				<tr>
					<td class="zakaz_table_view_name">
						<?php 
						if ($zakaz_status=='0') {echo '<div class="zakaz_table_view_status_0">'.$loc['zakaz.php']['t08'].'</div>';}
						if ($zakaz_status=='1') {echo '<div class="zakaz_table_view_status_1">'.$loc['zakaz.php']['t07'].'</div>';}
						if ($zakaz_status=='2') {echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['t09'].'</div>';}
						if ($zakaz_status=='3') {echo '<div class="zakaz_table_view_status_3">'.$loc['zakaz.php']['t10'].'</div>';}
						if ($zakaz_status=='5') {echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['r1'].'</div>';}
						
						if ($zakaz_addstatus=='0') {echo '<div class="zakaz_table_view_addstatus_0">'.$loc['zakaz.php']['t16'].'</div>';}					
						if ($zakaz_addstatus=='1') {echo '<div class="zakaz_table_view_addstatus_1">'.$loc['zakaz.php']['t17'].'</div>';}					
						if ($zakaz_addstatus=='2') {echo '<div class="zakaz_table_view_addstatus_2">'.$loc['zakaz.php']['t18'].'</div>';}					
						if ($zakaz_addstatus=='3') {echo '<div class="zakaz_table_view_addstatus_3">'.$loc['zakaz.php']['t19'].'</div>';}					
						if ($zakaz_addstatus=='4') {echo '<div class="zakaz_table_view_addstatus_4">'.$loc['zakaz.php']['t20'].'</div>';}					
						if ($zakaz_addstatus=='5') {echo '<div class="zakaz_table_view_addstatus_5">'.$loc['zakaz.php']['t21'].'</div>';}					
						if ($zakaz_addstatus=='6') {echo '<div class="zakaz_table_view_addstatus_6">'.$loc['zakaz.php']['t22'].'</div>';}					
						if ($zakaz_addstatus=='7') {echo '<div class="zakaz_table_view_addstatus_7">'.$loc['zakaz.php']['t146'].'</div>';}					
						if ($zakaz_addstatus=='8') {echo '<div class="zakaz_table_view_addstatus_8">'.$loc['zakaz.php']['t147'].'</div>';}					
						if ($zakaz_addstatus=='9') {echo '<div class="zakaz_table_view_addstatus_9">'.$loc['zakaz.php']['t148'].'</div>';}						

						// Проверка, назначено ли промо для оффера. Если не назначено, то выводим сообщение об этом
						// Check if the promo is scheduled to offer. If not set, the message about this
						if (file_exists('./tmp/offer'.$offer_id.'.jpg')) 
							{
							?>
							<a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><img class="zakaz_table_view_imgoffer" src="./tmp/offer<?php echo $offer_id; ?>.jpg"></a>
							<?php
							}
						else
							{
							?>
							<a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><div class="zakaz_table_view_imgoffer"></div></a>
							<?php
							}							
						?>
						<div class="zakaz_table_view_nametext">
							<a target="_blank" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><b><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></b></a>
						</div>
					</td>
					<td class="zakaz_table_view_date">
						<?php echo $zakaz_date; ?>
					</td>
					<td class="zakaz_table_view_date" style="<?php if ($res['date_obrabotka']=='' && $offer_deystvie!=5) {echo 'background: yellow; color: red;';} ?>">
						<?php echo $zakaz_date_obrabotka; ?>
					</td>				
					<td width="285" class="zakaz_table_view_comments">
						<a href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><?php echo TrimText($zakaz_comments,130); ?></a>
					</td>
					<td class="zakaz_table_view_geo">
						<?php echo '<b>'.$loc['zakaz.php']['t142'].'&nbsp;</b>'.$zakaz_ip;
						$zakaz_short_country=strtolower($zakaz_short_country);
						// Проверка, есть ли в наличии картинка под определяемую страну
						// Check whether there is a presence of the picture under the defined country
						if (file_exists('./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png')) 
							{
							echo '<br /><img src=./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png> ';
							echo $zakaz_country;
							}
						else
							{
							echo '<br />'.$zakaz_country;
							}
						if ($zakaz_user_id!='0') 
							{
							echo '<br /><b>'.$loc['zakaz.php']['t143'].'&nbsp;</b>'.$zakaz_user_id;
							}
						else
							{
							echo '<br /><b>'.$loc['zakaz.php']['t144'].'</b>';	
							}
						?>
					</td>
				</tr>
			</table>
		
		<?php
		}
		}
		
		}elseif(isset($_GET['viewOrder']) && $_GET['viewOrder'] == 3){
		$sql = "SELECT * FROM zakaz WHERE `referer` = '' AND `user_id` = '$us_id' AND status IN (2,3) ".$offerid." ".$typeOffer." ORDER BY `id`";
		$result = $mysqli->query($sql);
		if(mysqli_num_rows($result) != 0){
?>			
<p style="line-height:40px;margin-top:25px;"><b><?php echo $loc['antifrod.php']['t24']; ?></b></p>		
<?php			
		while($res=mysqli_fetch_array($result)){
			// Получаем данные о свойствах заказа и оффера к которому он относится
			// Get the data on the properties and offer order to which he belongs
			$offer_id=htmlentities($res['offer_id']);

			// Получаем буквенное имя оффера
			// Get the name of the letter offer
			$sql_offers_name = "SELECT name,deystvie FROM offers WHERE id = $offer_id";
			$result_offers_name = $mysqli->query($sql_offers_name);
			$res_offers_name=mysqli_fetch_array($result_offers_name);
			$offer_name=htmlentities($res_offers_name['name']);		
			$offer_deystvie=htmlentities($res_offers_name['deystvie']);		

			// Назначаем необходимые переменные
			// Assign the required variables
			$zakaz_id=htmlentities($res['id']);
			$zakaz_user_id=htmlentities($res['user_id']);
			$zakaz_number=htmlentities($res['zakaz_number']);
			$zakaz_cena=htmlentities($res['cena']);
			$zakaz_kolvo=htmlentities($res['kolvo']);
			$zakaz_status=htmlentities($res['status']);
			$zakaz_addstatus=htmlentities($res['addstatus']);		
			$zakaz_date=date('d.m.Y H:i:s', strtotime(htmlentities($res['date'])));
			$zakaz_date_obrabotka=htmlentities($res['date_obrabotka']);
			$zakaz_comments=htmlentities($res['comments']);
		
			$zakaz_date=date('d.m.Y', strtotime(htmlentities($res['date']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date'])));
			if ($res['date_obrabotka']!='') 
				{
				$zakaz_date_obrabotka=date('d.m.Y', strtotime(htmlentities($res['date_obrabotka']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date_obrabotka'])));
				}
			else
				{
				if ($offer_deystvie!=5)
					{
					$zakaz_date_obrabotka='<center>'.$loc['zakaz.php']['t137'].'<br />'.$loc['zakaz.php']['t138'].'</center>';
					}
				}
			$zakaz_comments=htmlentities($res['comments']);
			$zakaz_clientname=htmlentities($res['name']);
			$zakaz_clientphone=htmlentities($res['phone']);
			$zakaz_tracking_number=htmlentities($res['tracking_number']);
			$zakaz_zipcode=htmlentities($res['zipcode']);
			$zakaz_country=htmlentities($res['country']);
			$zakaz_short_country=htmlentities($res['short_country']);
			$zakaz_region=htmlentities($res['region']);
			$zakaz_town=htmlentities($res['town']);
			$zakaz_street=htmlentities($res['street']);
			$zakaz_dom=htmlentities($res['dom']);
			$zakaz_kvartira=htmlentities($res['kvartira']);
			$zakaz_client_address=htmlentities($res['client_address']);
			$zakaz_email=htmlentities($res['email']);
			$zakaz_ip=htmlentities($res['ip']);
			$zakaz_artikul=htmlentities($res['artikul']);

			
			
			
			
	?>		
	
			<table class="zakaz_table_view">
				<tr>
					<td class="zakaz_table_view_name">
						<?php 
						if ($zakaz_status=='0') {echo '<div class="zakaz_table_view_status_0">'.$loc['zakaz.php']['t08'].'</div>';}
						if ($zakaz_status=='1') {echo '<div class="zakaz_table_view_status_1">'.$loc['zakaz.php']['t07'].'</div>';}
						if ($zakaz_status=='2') {echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['t09'].'</div>';}
						if ($zakaz_status=='3') {echo '<div class="zakaz_table_view_status_3">'.$loc['zakaz.php']['t10'].'</div>';}
						if ($zakaz_status=='5') {echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['r1'].'</div>';}
						
						if ($zakaz_addstatus=='0') {echo '<div class="zakaz_table_view_addstatus_0">'.$loc['zakaz.php']['t16'].'</div>';}					
						if ($zakaz_addstatus=='1') {echo '<div class="zakaz_table_view_addstatus_1">'.$loc['zakaz.php']['t17'].'</div>';}					
						if ($zakaz_addstatus=='2') {echo '<div class="zakaz_table_view_addstatus_2">'.$loc['zakaz.php']['t18'].'</div>';}					
						if ($zakaz_addstatus=='3') {echo '<div class="zakaz_table_view_addstatus_3">'.$loc['zakaz.php']['t19'].'</div>';}					
						if ($zakaz_addstatus=='4') {echo '<div class="zakaz_table_view_addstatus_4">'.$loc['zakaz.php']['t20'].'</div>';}					
						if ($zakaz_addstatus=='5') {echo '<div class="zakaz_table_view_addstatus_5">'.$loc['zakaz.php']['t21'].'</div>';}					
						if ($zakaz_addstatus=='6') {echo '<div class="zakaz_table_view_addstatus_6">'.$loc['zakaz.php']['t22'].'</div>';}					
						if ($zakaz_addstatus=='7') {echo '<div class="zakaz_table_view_addstatus_7">'.$loc['zakaz.php']['t146'].'</div>';}					
						if ($zakaz_addstatus=='8') {echo '<div class="zakaz_table_view_addstatus_8">'.$loc['zakaz.php']['t147'].'</div>';}					
						if ($zakaz_addstatus=='9') {echo '<div class="zakaz_table_view_addstatus_9">'.$loc['zakaz.php']['t148'].'</div>';}						

						// Проверка, назначено ли промо для оффера. Если не назначено, то выводим сообщение об этом
						// Check if the promo is scheduled to offer. If not set, the message about this
						if (file_exists('./tmp/offer'.$offer_id.'.jpg')) 
							{
							?>
							<a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><img class="zakaz_table_view_imgoffer" src="./tmp/offer<?php echo $offer_id; ?>.jpg"></a>
							<?php
							}
						else
							{
							?>
							<a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><div class="zakaz_table_view_imgoffer"></div></a>
							<?php
							}							
						?>
						<div class="zakaz_table_view_nametext">
							<a target="_blank" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><b><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></b></a>
						</div>
					</td>
					<td class="zakaz_table_view_date">
						<?php echo $zakaz_date; ?>
					</td>
					<td class="zakaz_table_view_date" style="<?php if ($res['date_obrabotka']=='' && $offer_deystvie!=5) {echo 'background: yellow; color: red;';} ?>">
						<?php echo $zakaz_date_obrabotka; ?>
					</td>				
					<td width="285" class="zakaz_table_view_comments">
						<a href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><?php echo TrimText($zakaz_comments,130); ?></a>
					</td>
					<td class="zakaz_table_view_geo">
						<?php echo '<b>'.$loc['zakaz.php']['t142'].'&nbsp;</b>'.$zakaz_ip;
						$zakaz_short_country=strtolower($zakaz_short_country);
						// Проверка, есть ли в наличии картинка под определяемую страну
						// Check whether there is a presence of the picture under the defined country
						if (file_exists('./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png')) 
							{
							echo '<br /><img src=./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png> ';
							echo $zakaz_country;
							}
						else
							{
							echo '<br />'.$zakaz_country;
							}
						if ($zakaz_user_id!='0') 
							{
							echo '<br /><b>'.$loc['zakaz.php']['t143'].'&nbsp;</b>'.$zakaz_user_id;
							}
						else
							{
							echo '<br /><b>'.$loc['zakaz.php']['t144'].'</b>';	
							}
						?>
					</td>
				</tr>
			</table>
		
		<?php
		}
		}
		
		}elseif(isset($_GET['viewOrder']) && $_GET['viewOrder'] == 4){
		$sql = "SELECT * FROM zakaz WHERE `user_id` = '$us_id' AND status IN (2,3) AND addstatus IN (5,6) ".$offerid." ".$typeOffer." ORDER BY `id`";
		$result = $mysqli->query($sql);
		if(mysqli_num_rows($result) != 0){
?>			
<p style="line-height:40px;margin-top:25px;"><b><?php echo $loc['antifrod.php']['t25']; ?></b></p>		
<?php			
		while($res=mysqli_fetch_array($result)){
			// Получаем данные о свойствах заказа и оффера к которому он относится
			// Get the data on the properties and offer order to which he belongs
			$offer_id=htmlentities($res['offer_id']);

			// Получаем буквенное имя оффера
			// Get the name of the letter offer
			$sql_offers_name = "SELECT name,deystvie FROM offers WHERE id = $offer_id";
			$result_offers_name = $mysqli->query($sql_offers_name);
			$res_offers_name=mysqli_fetch_array($result_offers_name);
			$offer_name=htmlentities($res_offers_name['name']);		
			$offer_deystvie=htmlentities($res_offers_name['deystvie']);		

			// Назначаем необходимые переменные
			// Assign the required variables
			$zakaz_id=htmlentities($res['id']);
			$zakaz_user_id=htmlentities($res['user_id']);
			$zakaz_number=htmlentities($res['zakaz_number']);
			$zakaz_cena=htmlentities($res['cena']);
			$zakaz_kolvo=htmlentities($res['kolvo']);
			$zakaz_status=htmlentities($res['status']);
			$zakaz_addstatus=htmlentities($res['addstatus']);		
			$zakaz_date=date('d.m.Y H:i:s', strtotime(htmlentities($res['date'])));
			$zakaz_date_obrabotka=htmlentities($res['date_obrabotka']);
			$zakaz_comments=htmlentities($res['comments']);
		
			$zakaz_date=date('d.m.Y', strtotime(htmlentities($res['date']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date'])));
			if ($res['date_obrabotka']!='') 
				{
				$zakaz_date_obrabotka=date('d.m.Y', strtotime(htmlentities($res['date_obrabotka']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date_obrabotka'])));
				}
			else
				{
				if ($offer_deystvie!=5)
					{
					$zakaz_date_obrabotka='<center>'.$loc['zakaz.php']['t137'].'<br />'.$loc['zakaz.php']['t138'].'</center>';
					}
				}
			$zakaz_comments=htmlentities($res['comments']);
			$zakaz_clientname=htmlentities($res['name']);
			$zakaz_clientphone=htmlentities($res['phone']);
			$zakaz_tracking_number=htmlentities($res['tracking_number']);
			$zakaz_zipcode=htmlentities($res['zipcode']);
			$zakaz_country=htmlentities($res['country']);
			$zakaz_short_country=htmlentities($res['short_country']);
			$zakaz_region=htmlentities($res['region']);
			$zakaz_town=htmlentities($res['town']);
			$zakaz_street=htmlentities($res['street']);
			$zakaz_dom=htmlentities($res['dom']);
			$zakaz_kvartira=htmlentities($res['kvartira']);
			$zakaz_client_address=htmlentities($res['client_address']);
			$zakaz_email=htmlentities($res['email']);
			$zakaz_ip=htmlentities($res['ip']);
			$zakaz_artikul=htmlentities($res['artikul']);

			
			
			
			
	?>		
	
			<table class="zakaz_table_view">
				<tr>
					<td class="zakaz_table_view_name">
						<?php 
						if ($zakaz_status=='0') {echo '<div class="zakaz_table_view_status_0">'.$loc['zakaz.php']['t08'].'</div>';}
						if ($zakaz_status=='1') {echo '<div class="zakaz_table_view_status_1">'.$loc['zakaz.php']['t07'].'</div>';}
						if ($zakaz_status=='2') {echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['t09'].'</div>';}
						if ($zakaz_status=='3') {echo '<div class="zakaz_table_view_status_3">'.$loc['zakaz.php']['t10'].'</div>';}
						if ($zakaz_status=='5') {echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['r1'].'</div>';}
						
						if ($zakaz_addstatus=='0') {echo '<div class="zakaz_table_view_addstatus_0">'.$loc['zakaz.php']['t16'].'</div>';}					
						if ($zakaz_addstatus=='1') {echo '<div class="zakaz_table_view_addstatus_1">'.$loc['zakaz.php']['t17'].'</div>';}					
						if ($zakaz_addstatus=='2') {echo '<div class="zakaz_table_view_addstatus_2">'.$loc['zakaz.php']['t18'].'</div>';}					
						if ($zakaz_addstatus=='3') {echo '<div class="zakaz_table_view_addstatus_3">'.$loc['zakaz.php']['t19'].'</div>';}					
						if ($zakaz_addstatus=='4') {echo '<div class="zakaz_table_view_addstatus_4">'.$loc['zakaz.php']['t20'].'</div>';}					
						if ($zakaz_addstatus=='5') {echo '<div class="zakaz_table_view_addstatus_5">'.$loc['zakaz.php']['t21'].'</div>';}					
						if ($zakaz_addstatus=='6') {echo '<div class="zakaz_table_view_addstatus_6">'.$loc['zakaz.php']['t22'].'</div>';}					
						if ($zakaz_addstatus=='7') {echo '<div class="zakaz_table_view_addstatus_7">'.$loc['zakaz.php']['t146'].'</div>';}					
						if ($zakaz_addstatus=='8') {echo '<div class="zakaz_table_view_addstatus_8">'.$loc['zakaz.php']['t147'].'</div>';}					
						if ($zakaz_addstatus=='9') {echo '<div class="zakaz_table_view_addstatus_9">'.$loc['zakaz.php']['t148'].'</div>';}						

						// Проверка, назначено ли промо для оффера. Если не назначено, то выводим сообщение об этом
						// Check if the promo is scheduled to offer. If not set, the message about this
						if (file_exists('./tmp/offer'.$offer_id.'.jpg')) 
							{
							?>
							<a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><img class="zakaz_table_view_imgoffer" src="./tmp/offer<?php echo $offer_id; ?>.jpg"></a>
							<?php
							}
						else
							{
							?>
							<a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><div class="zakaz_table_view_imgoffer"></div></a>
							<?php
							}							
						?>
						<div class="zakaz_table_view_nametext">
							<a target="_blank" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><b><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></b></a>
						</div>
					</td>
					<td class="zakaz_table_view_date">
						<?php echo $zakaz_date; ?>
					</td>
					<td class="zakaz_table_view_date" style="<?php if ($res['date_obrabotka']=='' && $offer_deystvie!=5) {echo 'background: yellow; color: red;';} ?>">
						<?php echo $zakaz_date_obrabotka; ?>
					</td>				
					<td width="285" class="zakaz_table_view_comments">
						<a href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><?php echo TrimText($zakaz_comments,130); ?></a>
					</td>
					<td class="zakaz_table_view_geo">
						<?php echo '<b>'.$loc['zakaz.php']['t142'].'&nbsp;</b>'.$zakaz_ip;
						$zakaz_short_country=strtolower($zakaz_short_country);
						// Проверка, есть ли в наличии картинка под определяемую страну
						// Check whether there is a presence of the picture under the defined country
						if (file_exists('./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png')) 
							{
							echo '<br /><img src=./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png> ';
							echo $zakaz_country;
							}
						else
							{
							echo '<br />'.$zakaz_country;
							}
						if ($zakaz_user_id!='0') 
							{
							echo '<br /><b>'.$loc['zakaz.php']['t143'].'&nbsp;</b>'.$zakaz_user_id;
							}
						else
							{
							echo '<br /><b>'.$loc['zakaz.php']['t144'].'</b>';	
							}
						?>
					</td>
				</tr>
			</table>
		
		<?php
		}
		}
		if($_GET['typeOffer'] == 3){
		$sql = "SELECT * FROM zakaz WHERE `user_id` = '$us_id' AND status IN (2,3) AND addstatus IN (2,0,1) AND DATE_FORMAT(date, '%Y-%m-%d') < (NOW() - INTERVAL 10 DAY) ".$offerid." ".$typeOffer." ORDER BY `id`";
		$result = $mysqli->query($sql);
		echo mysqli_num_rows($result);
		if(mysqli_num_rows($result) != 0){
?>			
<p style="line-height:40px;margin-top:25px;"><b><?php echo $loc['antifrod.php']['t25']; ?></b></p>		
<?php			
		while($res=mysqli_fetch_array($result)){
			// Получаем данные о свойствах заказа и оффера к которому он относится
			// Get the data on the properties and offer order to which he belongs
			$offer_id=htmlentities($res['offer_id']);

			// Получаем буквенное имя оффера
			// Get the name of the letter offer
			$sql_offers_name = "SELECT name,deystvie FROM offers WHERE id = $offer_id";
			$result_offers_name = $mysqli->query($sql_offers_name);
			$res_offers_name=mysqli_fetch_array($result_offers_name);
			$offer_name=htmlentities($res_offers_name['name']);		
			$offer_deystvie=htmlentities($res_offers_name['deystvie']);		

			// Назначаем необходимые переменные
			// Assign the required variables
			$zakaz_id=htmlentities($res['id']);
			$zakaz_user_id=htmlentities($res['user_id']);
			$zakaz_number=htmlentities($res['zakaz_number']);
			$zakaz_cena=htmlentities($res['cena']);
			$zakaz_kolvo=htmlentities($res['kolvo']);
			$zakaz_status=htmlentities($res['status']);
			$zakaz_addstatus=htmlentities($res['addstatus']);		
			$zakaz_date=date('d.m.Y H:i:s', strtotime(htmlentities($res['date'])));
			$zakaz_date_obrabotka=htmlentities($res['date_obrabotka']);
			$zakaz_comments=htmlentities($res['comments']);
		
			$zakaz_date=date('d.m.Y', strtotime(htmlentities($res['date']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date'])));
			if ($res['date_obrabotka']!='') 
				{
				$zakaz_date_obrabotka=date('d.m.Y', strtotime(htmlentities($res['date_obrabotka']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date_obrabotka'])));
				}
			else
				{
				if ($offer_deystvie!=5)
					{
					$zakaz_date_obrabotka='<center>'.$loc['zakaz.php']['t137'].'<br />'.$loc['zakaz.php']['t138'].'</center>';
					}
				}
			$zakaz_comments=htmlentities($res['comments']);
			$zakaz_clientname=htmlentities($res['name']);
			$zakaz_clientphone=htmlentities($res['phone']);
			$zakaz_tracking_number=htmlentities($res['tracking_number']);
			$zakaz_zipcode=htmlentities($res['zipcode']);
			$zakaz_country=htmlentities($res['country']);
			$zakaz_short_country=htmlentities($res['short_country']);
			$zakaz_region=htmlentities($res['region']);
			$zakaz_town=htmlentities($res['town']);
			$zakaz_street=htmlentities($res['street']);
			$zakaz_dom=htmlentities($res['dom']);
			$zakaz_kvartira=htmlentities($res['kvartira']);
			$zakaz_client_address=htmlentities($res['client_address']);
			$zakaz_email=htmlentities($res['email']);
			$zakaz_ip=htmlentities($res['ip']);
			$zakaz_artikul=htmlentities($res['artikul']);

			
			
			
			
	?>		
	
			<table class="zakaz_table_view">
				<tr>
					<td class="zakaz_table_view_name">
						<?php 
						if ($zakaz_status=='0') {echo '<div class="zakaz_table_view_status_0">'.$loc['zakaz.php']['t08'].'</div>';}
						if ($zakaz_status=='1') {echo '<div class="zakaz_table_view_status_1">'.$loc['zakaz.php']['t07'].'</div>';}
						if ($zakaz_status=='2') {echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['t09'].'</div>';}
						if ($zakaz_status=='3') {echo '<div class="zakaz_table_view_status_3">'.$loc['zakaz.php']['t10'].'</div>';}
						if ($zakaz_status=='5') {echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['r1'].'</div>';}
						
						if ($zakaz_addstatus=='0') {echo '<div class="zakaz_table_view_addstatus_0">'.$loc['zakaz.php']['t16'].'</div>';}					
						if ($zakaz_addstatus=='1') {echo '<div class="zakaz_table_view_addstatus_1">'.$loc['zakaz.php']['t17'].'</div>';}					
						if ($zakaz_addstatus=='2') {echo '<div class="zakaz_table_view_addstatus_2">'.$loc['zakaz.php']['t18'].'</div>';}					
						if ($zakaz_addstatus=='3') {echo '<div class="zakaz_table_view_addstatus_3">'.$loc['zakaz.php']['t19'].'</div>';}					
						if ($zakaz_addstatus=='4') {echo '<div class="zakaz_table_view_addstatus_4">'.$loc['zakaz.php']['t20'].'</div>';}					
						if ($zakaz_addstatus=='5') {echo '<div class="zakaz_table_view_addstatus_5">'.$loc['zakaz.php']['t21'].'</div>';}					
						if ($zakaz_addstatus=='6') {echo '<div class="zakaz_table_view_addstatus_6">'.$loc['zakaz.php']['t22'].'</div>';}					
						if ($zakaz_addstatus=='7') {echo '<div class="zakaz_table_view_addstatus_7">'.$loc['zakaz.php']['t146'].'</div>';}					
						if ($zakaz_addstatus=='8') {echo '<div class="zakaz_table_view_addstatus_8">'.$loc['zakaz.php']['t147'].'</div>';}					
						if ($zakaz_addstatus=='9') {echo '<div class="zakaz_table_view_addstatus_9">'.$loc['zakaz.php']['t148'].'</div>';}						

						// Проверка, назначено ли промо для оффера. Если не назначено, то выводим сообщение об этом
						// Check if the promo is scheduled to offer. If not set, the message about this
						if (file_exists('./tmp/offer'.$offer_id.'.jpg')) 
							{
							?>
							<a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><img class="zakaz_table_view_imgoffer" src="./tmp/offer<?php echo $offer_id; ?>.jpg"></a>
							<?php
							}
						else
							{
							?>
							<a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><div class="zakaz_table_view_imgoffer"></div></a>
							<?php
							}							
						?>
						<div class="zakaz_table_view_nametext">
							<a target="_blank" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><b><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></b></a>
						</div>
					</td>
					<td class="zakaz_table_view_date">
						<?php echo $zakaz_date; ?>
					</td>
					<td class="zakaz_table_view_date" style="<?php if ($res['date_obrabotka']=='' && $offer_deystvie!=5) {echo 'background: yellow; color: red;';} ?>">
						<?php echo $zakaz_date_obrabotka; ?>
					</td>				
					<td width="285" class="zakaz_table_view_comments">
						<a href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><?php echo TrimText($zakaz_comments,130); ?></a>
					</td>
					<td class="zakaz_table_view_geo">
						<?php echo '<b>'.$loc['zakaz.php']['t142'].'&nbsp;</b>'.$zakaz_ip;
						$zakaz_short_country=strtolower($zakaz_short_country);
						// Проверка, есть ли в наличии картинка под определяемую страну
						// Check whether there is a presence of the picture under the defined country
						if (file_exists('./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png')) 
							{
							echo '<br /><img src=./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png> ';
							echo $zakaz_country;
							}
						else
							{
							echo '<br />'.$zakaz_country;
							}
						if ($zakaz_user_id!='0') 
							{
							echo '<br /><b>'.$loc['zakaz.php']['t143'].'&nbsp;</b>'.$zakaz_user_id;
							}
						else
							{
							echo '<br /><b>'.$loc['zakaz.php']['t144'].'</b>';	
							}
						?>
					</td>
				</tr>
			</table>
		
		<?php
		}
		}
		}
		
		
		
		}
		}
		?> 	
<p><br></p>	
<p><br></p>	
<p><br></p>	
<p><br></p>	
<p><br></p>			
<style>
.stats_table th {
    text-align: center;
    height: 29px;
    line-height: 29px;
    border: 1px solid #fff;
    padding: 0px 8px 0px 8px;
}
</style>
