
<h1><?php echo $loc['multiacc.php']['t01']; ?></h1>

<p>
<?php
$sql_detect_multiacc = "SELECT `id`,`email`,`user_session` FROM `users` WHERE `user_session` IN (SELECT `user_session` FROM `users` GROUP BY `user_session` HAVING count(*)>1) ORDER BY `id` ASC";
$result_detect_multiacc = $mysqli->query($sql_detect_multiacc);
$multiacc_kolvo=0;
$multiacc_number=1;
$multiacc_emails='';
$id_cur_check_user_session='';
if (mysqli_num_rows($result_detect_multiacc) > 0) 
	{
	while($res_detect_multiacc=mysqli_fetch_array($result_detect_multiacc)) 
		{
		echo '<div>';
		$id_cur_acc=htmlentities($res_detect_multiacc['id']);
		$email_cur_acc=htmlentities($res_detect_multiacc['email']);
		$id_cur_user_session=htmlentities($res_detect_multiacc['user_session']);
		if ($id_cur_user_session!=$id_cur_check_user_session && $id_cur_check_user_session!='') {$multiacc_emails.='<br /><br />'; $multiacc_number='1';}
		$id_cur_check_user_session=htmlentities($res_detect_multiacc['user_session']);
		$multiacc_kolvo++;
		if ($multiacc_number=='1')
			{
			$multiacc_emails.=' <span style="background: green; color: white; border: 1px dashed white;">'.$email_cur_acc.'</span> ';
			}
		else
			{
			$multiacc_emails.=$email_cur_acc;
			}
		$multiacc_number++;
		echo '</div>';
		}
	}
?>
</p>

<p>
	<b><?php echo $loc['multiacc.php']['t02']; ?>&nbsp;</b><?php echo $multiacc_kolvo; ?>
</p>

<p>
	<b><?php echo $loc['multiacc.php']['t03']; ?>&nbsp;</b>
</p>

<p>
	<?php echo $multiacc_emails; ?>
</p>

<p>
	<?php echo $loc['multiacc.php']['t04']; ?>
</p>

<p>
	&nbsp;
</p>

