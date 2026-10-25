
<form class="report" method="post" action="./settings.php?<?php echo @$_SERVER['QUERY_STRING']?>">
	<table class="settings_table">	
		<tr>
			<td>
				<table>
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t03']; ?></b></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t04']; ?></td><td><input type="text" name="settings_zagolovok" value="<?php echo htmlentities($settings_zagolovok); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t05']; ?></td><td><input type="text" name="settings_podzagolovok" value="<?php echo htmlentities($settings_podzagolovok); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>	
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t06']; ?></b></td>
					</tr>
					<tr>
						<td style="width: 250px;"><?php echo $loc['settings.php']['t07']; ?></td>
						<td>
							<select class="width-200"name="settings_registration_wm">
								<option value="0"<?php if ($settings_registration_wm=='0') {?>selected="selected"<?} ?>><?php echo $loc['settings.php']['t09']; ?></option>
								<option value="1"<?php if ($settings_registration_wm=='1') {?>selected="selected"<?} ?>><?php echo $loc['settings.php']['t10']; ?></option>			
							</select>
						</td>
					</tr>	
					<tr>
						<td style="width: 250px;"><?php echo $loc['settings.php']['t08']; ?></td>
						<td>
							<select class="width-200"name="settings_registration_rk">
								<option value="0"<?php if ($settings_registration_rk=='0') {?>selected="selected"<?} ?>><?php echo $loc['settings.php']['t09']; ?></option>
								<option value="1"<?php if ($settings_registration_rk=='1') {?>selected="selected"<?} ?>><?php echo $loc['settings.php']['t10']; ?></option>			
							</select>
						</td>
					</tr>		
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>	
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t11']; ?></b></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t12']; ?></td><td><input type="text" name="settings_balance_cpa" value="<?php echo htmlentities($settings_balance_cpa); ?>" maxlength="80" style="width: 200px;">&nbsp;<?php echo $loc['settings.php']['t15']; ?></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t13']; ?></td><td><input type="text" name="settings_min_vyvod" value="<?php echo htmlentities($settings_min_vyvod); ?>" maxlength="80" style="width: 200px;">&nbsp;<?php echo $loc['settings.php']['t15']; ?></td>
					</tr>	
					<tr>
						<td><?php echo $loc['settings.php']['t14']; ?></td><td><input type="text" name="settings_refprocent" value="<?php echo htmlentities($settings_refprocent); ?>" maxlength="80" style="width: 200px;">&nbsp;<?php echo $loc['settings.php']['t16']; ?><br /><?php echo $loc['settings.php']['t17']; ?></td>
					</tr>		
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>	
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t18']; ?></b></td>
					</tr>
					<tr>
						<td style="width: 250px;"><?php echo $loc['settings.php']['t19']; ?></td>
						<td>
							<select class="width-200"name="settings_sms_ok">
								<option value="0"<?php if ($settings_sms_ok=='0') {?>selected="selected"<?} ?>><?php echo $loc['settings.php']['t20']; ?></option>
								<option value="1"<?php if ($settings_sms_ok=='1') {?>selected="selected"<?} ?>><?php echo $loc['settings.php']['t21']; ?></option>			
							</select>
						</td>
					</tr>	
					<tr>
						<td><?php echo $loc['settings.php']['t22']; ?></td><td><input type="text" name="settings_smslogin" value="<?php echo htmlentities($settings_smslogin); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t23']; ?></td><td><input type="text" name="settings_smspassword" value="<?php echo htmlentities($settings_smspassword); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>	
					<tr>
						<td><?php echo $loc['settings.php']['t24']; ?></td><td><input type="text" name="settings_smsapikey" value="<?php echo htmlentities($settings_smsapikey); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t25']; ?></td><td><input type="button" name="test_sms" id="test_sms" value="<?php echo $loc['settings.php']['t26']; ?>">
							<script>
								$('#test_sms').click
									(
									function()
										{
										if (confirm('<?php echo $loc['settings.php']['t27']; ?>'))
											{														
											document.getElementById('test_sms').disabled='disabled';
											document.getElementById('test_sms').value='<?php echo $loc['settings.php']['t28']; ?>';
											$.ajax
												(
													{
													type: 'POST',
													url: './sendsms.php', 
													data: 'testsms=ok&apikey=<?php echo $settings_smsapikey; ?>',
													cache: false,  
													timeout: 2000,
													success: function(html)
														{  
														document.getElementById('test_sms').value='<?php echo $loc['settings.php']['t29']; ?>';
														document.getElementById('test_sms').disabled='disabled';
														},
													error: function(html) 
														{
														document.getElementById('test_sms').value='<?php echo $loc['settings.php']['t30']; ?>';
														document.getElementById('test_sms').disabled='disabled';
														}	
													}
												);  
											}
										}
									);
							</script>				
						</td>
					</tr>	
					<tr>
						<td><?php echo $loc['settings.php']['t31']; ?></td><td><input type="text" name="settings_sms_price" value="<?php echo htmlentities($settings_sms_price); ?>" maxlength="80" style="width: 200px;">&nbsp;<?php echo $loc['settings.php']['t15']; ?></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>	
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t32']; ?></b></td>
					</tr>
					<tr>
						<td style="width: 250px;"><?php echo $loc['settings.php']['t33']; ?></td>
						<td>
							<select class="width-200"name="russianpost_ok">
								<option value="0"<?php if ($settings_russianpost_ok=='0') {?>selected="selected"<?} ?>><?php echo $loc['settings.php']['t34']; ?></option>
								<option value="1"<?php if ($settings_russianpost_ok=='1') {?>selected="selected"<?} ?>><?php echo $loc['settings.php']['t35']; ?></option>			
							</select>
						</td>
					</tr>	
					<tr>
						<td><?php echo $loc['settings.php']['t36']; ?></td><td><input type="text" name="russianpost_login" value="<?php echo htmlentities($settings_russianpost_login); ?>" maxlength="50" style="width: 200px;"></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t37']; ?></td><td><input type="text" name="russianpost_password" value="<?php echo htmlentities($settings_russianpost_password); ?>" maxlength="50" style="width: 200px;"></td>
					</tr>						
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>					
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t38']; ?></b></td>
					</tr>	
					<tr>
						<td><?php echo $loc['settings.php']['t39']; ?></td><td><input type="text" name="settings_email" value="<?php echo htmlentities($settings_email); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t40']; ?></td><td><input type="text" name="settings_icq" value="<?php echo htmlentities($settings_icq); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>
					<tr>	
						<td><?php echo $loc['settings.php']['t41']; ?></td><td><input type="text" name="settings_skype" value="<?php echo htmlentities($settings_skype); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>
					<tr>	
						<td>Телеграм</td><td><input type="text" name="settings_telegram" value="<?php echo htmlentities($settings_telegram); ?>"  style="width: 200px;"></td>
					</tr>
					<tr>	
						<td>VK</td><td><input type="text" name="settings_vk" value="<?php echo htmlentities($settings_vk); ?>" style="width: 200px;"></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t42']; ?></td><td><input type="text" name="settings_phone" value="<?php echo htmlentities($settings_phone); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
                                        
                                        <?php
                                            $settings = Settings::getById(1);
                                        ?>
                                        
					<tr>
						<td colspan="2"><b>Настройки антифрода:</b></td>
					</tr>	
					<tr>
						<td>Минимальный % хороших заказов (рейтинг пользователя)</td><td><input type="text" name="percent_frod" value="<?=$settings->percent_frod; ?>" maxlength="3" style="width: 50px;text-align:center;"></td>
					</tr>
					<tr>	
						<td>Кол-во баллов для фрода </td><td><input type="text" name="limit_warning" value="<?=$settings->limit_warning; ?>" maxlength="3" style="width: 50px;text-align:center;"></td>
					</tr>                                         
					<tr>
						<td colspan="2"><b>Баллы за проверки:</b></td>
					</tr>
					<tr>	
						<td>Лиды с одного IP </td><td><input type="text" name="same_ip" value="<?=$settings->same_ip; ?>" maxlength="3" style="width: 50px;text-align:center;"></td>
					</tr>
					<tr>	
						<td>Лиды с IP как у вебмастера </td><td><input type="text" name="web_ip" value="<?=$settings->web_ip; ?>" maxlength="3" style="width: 50px;text-align:center;"></td>
					</tr>
					<tr>	
						<td>Лиды без реферера </td><td><input type="text" name="no_referer" value="<?=$settings->no_referer; ?>" maxlength="3" style="width: 50px;text-align:center;"></td>
					</tr>
					<tr>	
						<td>Тест номеров на доступность </td><td><input type="text" name="phone_dost" value="<?=$settings->phone_dost; ?>" maxlength="3" style="width: 50px;text-align:center;"></td>
					</tr>
					<tr>	
						<td>Несоответствие гео номера и гео IP лида </td><td><input type="text" name="phone_geo" value="<?=$settings->phone_geo; ?>" maxlength="3" style="width: 50px;text-align:center;"></td>
					</tr>
					<tr>	
						<td>Время проведенное на сайте < 30 сек </td><td><input type="text" name="online_lid" value="<?=$settings->online_lid; ?>" maxlength="3" style="width: 50px;text-align:center;"></td>
					</tr>
					<tr>	
						<td>Копирование данных в форму </td><td><input type="text" name="pasted_lid" value="<?=$settings->pasted_lid; ?>" maxlength="3" style="width: 50px;text-align:center;"></td>
					</tr> 
					<tr>	
						<td>Сверка по блеклисту </td><td><input type="text" name="blacklist" value="<?=$settings->blacklist; ?>" maxlength="3" style="width: 50px;text-align:center;"></td>
					</tr>                                          
				</table>
			</td>
			<td>
				<table>	
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t43']; ?></b></td>
					</tr>
					<tr>
						<td style="width: 250px;"><?php echo $loc['settings.php']['t44']; ?></td>
						<td>
							<select class="width-200"name="settings_paysystem_pay">
								<option value="1"<?php if ($settings_paysystem_pay=='1') {?>selected="selected"<?} ?>><?php echo $loc['settings.php']['t45']; ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="width: 250px;"><?php echo $loc['settings.php']['t46']; ?></td>
						<td>
							<select class="width-200"name="settings_paysystem_landings">
							<option value="1"<?php if ($settings_paysystem_landings=='1') {?>selected="selected"<?} ?>><?php echo $loc['settings.php']['t47']; ?></option>
							</select>
						</td>
					</tr>		
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>		
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t48']; ?></b></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t49']; ?></td><td><input type="text" name="settings_webmoney_wmr" value="<?php echo htmlentities($settings_webmoney_wmr); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t50']; ?></td><td><input type="text" name="settings_webmoney_key" value="<?php echo htmlentities($settings_webmoney_key); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>	
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>	
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t51']; ?></b></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t52']; ?></td><td><input type="text" name="settings_yk_shopid" value="<?php echo htmlentities($settings_yk_shopid); ?>" maxlength="48" style="width: 200px;"></td>
					</tr>	
					<tr>
						<td><?php echo $loc['settings.php']['t53']; ?></td><td><input type="text" name="settings_yk_shoppassword" value="<?php echo htmlentities($settings_yk_shoppassword); ?>" maxlength="48" style="width: 200px;"></td>
					</tr>	
					<tr>
						<td><?php echo $loc['settings.php']['t54']; ?></td><td><input type="text" name="settings_yk_scid" value="<?php echo htmlentities($settings_yk_scid); ?>" maxlength="48" style="width: 200px;"></td>
					</tr>	
					<tr>
						<td><?php echo $loc['settings.php']['t55']; ?></td><td><input type="text" name="settings_yk_obrabotchik" value="<?php echo htmlentities($settings_yk_obrabotchik); ?>" maxlength="48" style="width: 200px;"></td>
					</tr>	
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t56']; ?></b></td>
					</tr>		
					<tr>
						<td><?php echo $loc['settings.php']['t57']; ?></td><td><input type="text" name="settings_account_max_offers" value="<?php echo htmlentities($settings_account_max_offers); ?>" maxlength="2" style="width: 200px;"></td>
					</tr>		
					<tr>
						<td><?php echo $loc['settings.php']['t72']; ?></td><td><input type="text" name="settings_account_max_prelandings" value="<?php echo htmlentities($settings_account_max_prelandings); ?>" maxlength="2" style="width: 200px;"></td>
					</tr>					
					<tr>
						<td><?php echo $loc['settings.php']['t58']; ?></td><td><input type="text" name="settings_account_max_landings" value="<?php echo htmlentities($settings_account_max_landings); ?>" maxlength="2" style="width: 200px;"></td>
					</tr>					
					<tr>
						<td><?php echo $loc['settings.php']['t59']; ?></td><td><input type="text" name="settings_account_max_subacc" value="<?php echo htmlentities($settings_account_max_subacc); ?>" maxlength="2" style="width: 200px;"></td>
					</tr>						
					<tr>
						<td><?php echo $loc['settings.php']['t68']; ?></td><td><input type="text" name="settings_account_max_callcenters" value="<?php echo htmlentities($settings_account_max_callcenters); ?>" maxlength="2" style="width: 200px;"></td>
					</tr>
					<tr>
						<td><?php echo $loc['settings.php']['t69']; ?></td><td><input type="text" name="settings_account_max_operators" value="<?php echo htmlentities($settings_account_max_operators); ?>" maxlength="2" style="width: 200px;"></td>
					</tr>					
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t60']; ?></b></td>
					</tr>
					<tr id="otladka">
						<td><?php echo $loc['settings.php']['t61']; ?>&nbsp;(<a href="#otladka" onclick="document.getElementById('settings_ip_otladka').value='<?php echo $_SERVER['REMOTE_ADDR']; ?>'; document.getElementById('settings_ip_otladka').style.color='green';" ><?php echo $loc['settings.php']['t62']; ?></a>):</td><td><input type="text" id="settings_ip_otladka" name="settings_ip_otladka" value="<?php echo htmlentities($settings_ip_otladka); ?>" maxlength="80" style="width: 200px;"></td>
					</tr>
					
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2"><b><?php echo $loc['settings.php']['t64']; ?></b></td>
					</tr>
					<tr>
                                            <td><?php echo $loc['settings.php']['t71']; ?></td><td><textarea name="settings_notice_email" value="<?php echo $settings_notice_email; ?>" style="width: 200px;"><?php echo $loc['settings.php']['t70']; ?></textarea></td>
					</tr>					
					<tr>
						<td>
							<?php echo $loc['settings.php']['t65']; ?></td><td><input type="checkbox" name="settings_notice_regwebmaster" 
							<?php
							if ($settings_notice_regwebmaster==1) {echo 'checked=checked';}
							?>
							>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $loc['settings.php']['t66']; ?></td><td><input type="checkbox" name="settings_notice_regreklamodatel" 
							<?php
							if ($settings_notice_regreklamodatel==1) {echo 'checked=checked';}
							?>						
							>
						</td>
					</tr>	
					<tr>
						<td>
							<?php echo $loc['settings.php']['t67']; ?></td><td><input type="checkbox" name="settings_notice_addoffer" 
							<?php
							if ($settings_notice_addoffer==1) {echo 'checked=checked';}
							?>						
							>
						</td>
					</tr>					
					<tr>
						<td>
							Уведомления прогноз баланса</td><td><input type="checkbox" name="settings_notice_prognoz" 
							<?php
							if ($settings_notice_prognoz==1) {echo 'checked=checked';}
							?>						
							>
						</td>
					</tr>	
                                        
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
                                        
					<tr>
						<td colspan="2"><b>Настройка витрины призов</b></td>
					</tr>
	
					<tr>
						<td>Мин.комиссия CPA за 1 монету</td>
                                                <td><input type="text" name="settings_coins_min" value="<?php echo htmlentities($settings_coins_min); ?>" maxlength="5" style="width: 200px;"></td>
					</tr>	
                                        
				</table>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="submit_settings" value="<?php echo $loc['button']['t01']; ?>" class="btn button" onclick="if (!confirm('<?php echo $loc['settings.php']['t63']; ?>'))return false;">
			</td>
		</tr>
	</table>
</form>
