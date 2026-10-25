<p class="pageTitle"><span><?php echo $loc['finances.php']['t01']; ?></span></p>

<p>
	&nbsp;
</p>

<p>
	<?php
	function build_pagination_url($page) 
		{
		$parameters = array('page' => $page);
		return '?'.http_build_query($parameters);
		}
	$result = $mysqli->query( "SELECT COUNT(id) AS count FROM `finances_log` WHERE `description`='4' AND `status`='1'" );
	// Вывод количества страниц
	// Display the number of pages
	pagination($result,50,11);
	?>
</p>

<p>
	<table class="stats_table" width="100%">
		<tr class="tableHead">
			<td colspan="6"><?php echo $loc['finances.php']['t33']; ?></td>
		</tr>
		<tr>
			<td colspan="6"><b><?php echo $loc['finances.php']['t34']; ?></b>&nbsp;[<a target="_blank" href="./masspay.php?masspay=ok" class="normal_link" style="font-weight: normal;"><?php echo $loc['finances.php']['t41']; ?></a>&nbsp;|&nbsp;<a href="./finances.php?masspay=success" class="normal_link" style="font-weight: normal;" onclick="if (!confirm('<?php echo $loc['finances.php']['t42']; ?>'))return false;"><?php echo $loc['finances.php']['t43']; ?></a>]</td>
		</tr>	
		<tr class="tableHead">
			<td><?php echo $loc['finances.php']['t35']; ?></td>	
			<td><?php echo $loc['finances.php']['t36']; ?></td>	
			<td><?php echo $loc['finances.php']['t37']; ?></td>
			<td><?php echo $loc['finances.php']['t38']; ?></td>
			<td><?php echo $loc['finances.php']['t39']; ?></td>		
			<td><?php echo $loc['finances.php']['t40']; ?></td>		
		</tr>
		<?php
		if (isset($offset) && isset($show_pages))
			{
			$sql_payspisok = "SELECT id,date,user_id,summ FROM finances_log WHERE `description`='4' AND `status`='1' ORDER BY `id` DESC LIMIT $offset, $show_pages";
			}
		else
			{
			$sql_payspisok = "SELECT id,date,user_id,summ FROM finances_log WHERE `description`='4' AND `status`='1' ORDER BY `id` DESC";
			}
		$result_payspisok = $mysqli->query($sql_payspisok);
		$cvet=0; $num_id=0;
		if (mysqli_num_rows($result_payspisok) > 0) 
			{
			while($res_payspisok=mysqli_fetch_array($result_payspisok)) 
				{ 
				$pay_id=htmlentities($res_payspisok['id']);
				$pay_date=htmlentities($res_payspisok['date']);
				$pay_user_id=htmlentities($res_payspisok['user_id']);
				$pay_summ=htmlentities($res_payspisok['summ']);
                                
                                $sql_check = "select frod_check from users where id = '$pay_user_id' LIMIT 1";
                                $result_check = $mysqli->query($sql_check);
                                $res_check=mysqli_fetch_array($result_check);
                                $frod_check=htmlentities($res_check['frod_check']);
                                if($frod_check == 1){
                                    $check = '<img title="проверен на фрод" src="./templates/default/img/yes.png" width="20px"> &nbsp&nbsp';
                                }else{
                                    $check = '';
                                }  
                                
                                $percent = User::getPercentSusp($pay_user_id); 
                                $percent = ($percent < 10)? '<font color="green">Подозрений '.$percent.'%</font>': '<font color="red">Подозрений '.$percent.'%</font>';
				?>
				<tr class="<?php if ( $cvet & 1 ) {echo 'col2';} else {echo '';} $cvet++; $num_id++; ?> ?>">
					<td><?php echo $pay_id; ?></td>
					<td><?php echo date('d.m.Y / H:i:s', strtotime($pay_date)); ?></td>
					<td><?php echo $pay_summ; ?>&nbsp;<?php echo $loc['finances.php']['t44']; ?>&nbsp;</td>
					<td>
						<?php
						$sql_userdata = "SELECT id,email,wmr FROM users WHERE `id`='$pay_user_id'";
						$result_userdata = $mysqli->query($sql_userdata);
						$res_userdata=mysqli_fetch_array($result_userdata);
						$email_userdata=htmlentities($res_userdata['email']);
						$wmr_userdata=htmlentities($res_userdata['wmr']);
                                                echo $check;
						?>
						<a href="./users.php?edit=<?php echo $pay_user_id; ?>" target="_blank"><?php echo $email_userdata . ' / '.$pay_user_id.' / '.$percent; ?></a>
					</td>
					<td><?=$wmr_userdata;?></td>		
					<td>
						<a id="go_vyplata<?php echo $num_id; ?>" href="wmk:payto?Purse=<?php echo $wmr_userdata; ?>&Amount=<?php echo $pay_summ; ?>&Desc=<?php echo $settings_zagolovok; ?>:&nbsp;<?php echo $loc['finances.php']['t45']; ?>&nbsp;<?php echo $email_userdata; ?>&nbsp;<?php echo $loc['finances.php']['t46']; ?><?php echo $pay_id; ?>&BringToFront=Y" onclick="document.getElementById('go_vyplata<?php echo $num_id; ?>').style.display='none'; document.getElementById('ok_vyplata<?php echo $num_id; ?>').style.display='inline';"><?php echo $loc['finances.php']['t47']; ?></a>
						<a id="ok_vyplata<?php echo $num_id; ?>" style="display: none;" href="finances.php?ok_vyplata=<?php echo $pay_id; ?>&user=<?php echo $pay_user_id; ?>" onclick="if (!confirm('<?php echo $loc['finances.php']['t48']; ?>&nbsp;<?php echo $pay_summ; ?>&nbsp;<?php echo $loc['finances.php']['t44']; ?>&nbsp;<?php echo $loc['finances.php']['t49']; ?>&nbsp;&quot;<?php echo $email_userdata; ?>&quot;?'))return false;"><?php echo $loc['finances.php']['t50']; ?></a>
						&nbsp;|&nbsp;
						<a href="./finances.php?ne_vyplata=<?php echo $pay_id; ?>&user=<?php echo $pay_user_id; ?>" onclick="if (!confirm('<?php echo $loc['finances.php']['t51']; ?>&nbsp;<?php echo $pay_summ; ?>&nbsp;<?php echo $loc['finances.php']['t44']; ?>&nbsp;<?php echo $loc['finances.php']['t49']; ?>&nbsp;&quot;<?php echo $email_userdata; ?>&quot;?'))return false;"><?php echo $loc['finances.php']['t52']; ?></a>
						&nbsp;|&nbsp;
						<a target="_blank" href="./tickets.php?komu=<?php echo $pay_user_id; ?>"><span class="send_ticket"></span></a>
					</td>
				</tr>
				<?php
				}
			}
		?>	
	</table>
</p>

<p>
	<?php
	// Вывод количества страниц
	// Display the number of pages
	pagination($result,50,11);
	?>
</p>

<p>
	&nbsp;
</p>
