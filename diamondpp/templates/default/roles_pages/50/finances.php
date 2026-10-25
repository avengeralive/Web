
<h1><?php echo $loc['finances.php']['t01']; ?></h1>

<?php
// Если баланс был успешно пополнен, то выводим сообщение об этом
// If the balance has been successfully topped up, the message about this
if (isset($_GET['success']))
	{
	echo '<p><b><font color="green">'.$loc['finances.php']['t02'].'</font></b></p>';
	}
// Если баланс НЕ был успешно пополнен, то выводим сообщение об этом
// If the balance has not been successfully topped up, the message about this
if (isset($_GET['fail']))
	{
	echo '<p><b><font color="red">'.$loc['finances.php']['t03'].'</font></b></p>';
	}	
?>

<p>
	<table class="finance_table">
		<tr>
			<td style="width: 475px; vertical-align: top;">
				<p>
					<b><?php echo $loc['finances.php']['t04']; ?></b>
				</p>
				<p>
					<form name="paybalance_form" action="./finances.php?act=make_invoice" method="post">
						<p>
							<?php echo $loc['finances.php']['t05']; ?>&nbsp;
							<input type="text" name="amount" maxlength="6" value="" required>&nbsp;<?php echo $loc['finances.php']['t06']; ?>&nbsp;
						</p>
						<p>
							<?php echo $loc['finances.php']['t07']; ?>&nbsp; 
							<label style="cursor: pointer;">
								<input type="radio" name="paysys" value="wm" checked style="cursor: pointer;">&nbsp;<?php echo $loc['finances.php']['t08']; ?>
							</label> 
							<label style="cursor: pointer;">
								<input type="radio" name="paysys" value="yk" style="cursor: pointer;">&nbsp;<?php echo $loc['finances.php']['t09']; ?>
							</label>
						</p>
						<p>
							<input type="submit" name="submit_paybalance" value="<?php echo $loc['button']['t03']; ?>" class="others_button_dalee">
						</p>
					</form>
				</p>
			</td>
			<td style="width: 475px; vertical-align: top;">
				<p>
					<b><?php echo $loc['finances.php']['t10']; ?></b>
				</p>
				<p>
					<?php 
					if (isset($_GET['xtext']) && $_GET['xtext']!='')
						{
						if ($_GET['xtext']=='1') {echo '<font color=red>'.$loc['finances.php']['t11'].'&nbsp;<a href="profile.php" class="normal_link">'.$loc['finances.php']['t12'].'</a>.</font>';}
						if ($_GET['xtext']=='2') {echo '<font color=red>'.$loc['finances.php']['t13'].'&nbsp;'.$settings_min_vyvod.'&nbsp;'.$loc['finances.php']['t14'].'&nbsp;</font>';}
						if ($_GET['xtext']=='3') {echo '<font color=red>'.$loc['finances.php']['t15'].'</font>';}
						if ($_GET['xtext']=='4') {echo '<font color=red>'.$loc['finances.php']['t16'].'</font>';}
						if ($_GET['xtext']=='5') {echo '<font color=green>'.$loc['finances.php']['t17'].'</font>';}
						}
					?>
				</p>
				<p>
					<?php
					// Если сумма на балансе равна или больше минимальной суммы разрешенной для вывода, то выводим блок. Иначе сообщаем об ошибке.
					// If the amount on the balance sheet is equal to or more than the minimum amount authorized for output, the output unit. Otherwise, we report an error.
					if ($user_balance>=$settings_min_vyvod)
						{
						?>
						<form method="post" action="./finances.php?<?php echo @$_SERVER['QUERY_STRING']?>">
							<p>
								<?php echo $loc['finances.php']['t18']; ?>&nbsp;
								<input type="text" name="sum_vyvod" maxlength="6" value="<?php echo $user_balance; ?>">&nbsp;<?php echo $loc['finances.php']['t06']; ?>&nbsp;
							</p>
							<input type="hidden" name="vyvod" value="ok">
							<p>
								<?php echo $loc['finances.php']['t19']; ?>
							</p>
							<p>
								<input type="submit" name="submit" value="<?php echo $loc['button']['t03']; ?>" class="others_button_dalee" onclick="if (!confirm('<?php echo $loc['finances.php']['t20']; ?>'))return false;">
							</p>
						</form>
						<?php
						}
					else
						{
						echo '<p><font color=red>'.$loc['finances.php']['t21'].'&nbsp;'.$settings_min_vyvod.'&nbsp;'.$loc['finances.php']['t06'].'&nbsp;</font></p>';
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

<?php
// Подгружаем вывод статистики по операциям связанных с балансом пользователя
// Loads the display of statistics on transactions related to the user's balance
include './templates/'.$template.'/blocks/finances_log.php';
?>
	
<br /><br /><br />
		
<?php
include './templates/'.$template.'/in_footer.php';
exit;
?>
