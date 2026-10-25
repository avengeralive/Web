<p class="pageTitle"><span><?php echo $loc['operators.php']['t01']; ?></span></p>
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

<p>
	<?php
	if (isset($_GET['xtext']) && $_GET['xtext']!='')
		{
		// Сообщения об ошибках либо об успехе
		// Service messages
		$xtext=htmlentities($_GET['xtext']);
		if ($xtext=='1') {echo '<font color=red>'.$loc['operators.php']['t02'].'</font>';}
		if ($xtext=='2') {echo '<font color=green>'.$loc['operators.php']['t03'].'</font>';}
		if ($xtext=='3') {echo '<font color=red>'.$loc['operators.php']['t04'].'</font>';}
		if ($xtext=='4') {echo '<font color=red>'.$loc['operators.php']['t05'].'</font>';}
		if ($xtext=='5') {echo '<font color=red>'.$loc['operators.php']['t06'].'</font>';}
		if ($xtext=='6') {echo '<font color=red>'.$loc['operators.php']['t07'].'</font>';}
		if ($xtext=='7') {echo '<font color=red>'.$loc['operators.php']['t08'].'</font>';}
		if ($xtext=='8') {echo '<font color=red>'.$loc['operators.php']['t09'].'</font>';}
		if ($xtext=='9') {echo '<font color=green>'.$loc['operators.php']['t10'].'</font>';}
		if ($xtext=='10') {echo '<font color=red>'.$loc['operators.php']['t11'].'</font>';}
		if ($xtext=='11') {echo '<font color=red>'.$loc['operators.php']['t26'].'</font>';}
		if ($xtext=='12') {echo '<font color=green>'.$loc['operators.php']['t27'].'</font>';}
		}
	?>
</p>

<?php
if (isset($_GET['edit']) && $_GET['edit']!='')
	{
	$edit_operators=htmlentities($_GET['edit']);
	if ($user_tip=='70')
		{	
		$sql_check_operators = "SELECT * FROM users WHERE `id`='$edit_operators'";
		}
	else		
		{	
		$sql_check_operators = "SELECT * FROM users WHERE `creator`='$user_id' AND `id`='$edit_operators'";
		}		
	$result_check_operators = $mysqli->query($sql_check_operators);
	if (mysqli_num_rows($result_check_operators) > 0) 
		{
		$res_check_operators=mysqli_fetch_array($result_check_operators);
		$operators_id=htmlentities($res_check_operators['id']);
		$operators_email=htmlentities($res_check_operators['email']);
		$operators_name=htmlentities($res_check_operators['name']);
		$operators_active=htmlentities($res_check_operators['active']);
		$operators_callcenter=htmlentities($res_check_operators['callcenter']);
		?>
		<p>
			<?php
			// Форма редактирования оператора
			// Edit a operator form
			include './templates/'.$template.'/checkform/jquery.proverka.editoperators.form.php';
			include './templates/'.$template.'/blocks/editoperator_form.php';
			?>
		</p>	
		<?php
		}
	}
else
	{
	?>
	<p>
		<?php
		include './templates/'.$template.'/checkform/jquery.proverka.addoperators.form.php';
		include './templates/'.$template.'/blocks/addoperator_form.php';
		?>	
	</p>
	<p>
		<p>
			<b><?php echo $loc['operators.php']['t15']; ?></b>
		</p>
		<table class="stats_table" width="100%">
			<tr class="tableHead">
				<td><nobr><?php echo $loc['users.php']['t31']; ?></nobr></td>
				<td><nobr><?php echo $loc['operators.php']['t28']; ?></nobr></td>
				<td><nobr><?php echo $loc['operators.php']['t17']; ?></nobr></td>
				<td><nobr><?php echo $loc['operators.php']['t18']; ?></nobr></td>		
				<td width="100"><nobr><?php echo $loc['users.php']['t38']; ?></nobr></td>		
			</tr>
			<?php
			$sql = "SELECT * FROM users WHERE `creator`!='0' ORDER BY `id` DESC";
			$result = $mysqli->query($sql);
			if (mysqli_num_rows($result) > 0) 
				{
				while($res=mysqli_fetch_array($result)) 
					{ 
					$cur_id=htmlentities($res['id']);
					$cur_email=htmlentities($res['email']);
					$cur_name=htmlentities($res['name']);
					$cur_active=htmlentities($res['active']);
					$cur_date_activity=htmlentities($res['date_activity']);
					$cur_callcenter=htmlentities($res['callcenter']);
					$sql_callcenter_name = "SELECT id,name,active FROM callcenters WHERE `id`='$cur_callcenter'";
					$result_callcenter_name = $mysqli->query($sql_callcenter_name);
					$res_callcenter_name=mysqli_fetch_array($result_callcenter_name); 
					$callcenter_id=htmlentities($res_callcenter_name['id']);
					$callcenter_name=htmlentities($res_callcenter_name['name']);
					$callcenter_active=htmlentities($res_callcenter_name['active']);
					?> 
					<tr>
						<td><nobr><span style="<?php if ($cur_active=='1') {?>background: green; color: white;<?} elseif ($cur_active=='5') {?>background: red; color: white;<?} ?>">&nbsp;<?php echo $cur_email; ?>&nbsp;</span></nobr></td>
						<td><nobr><?php if ($cur_name!='') {echo html_entity_decode($cur_name, ENT_QUOTES, 'utf-8');} else {echo '<font color="#cccccc">'.$loc['operators.php']['t30'].'</font>';} ?></nobr></td>
						<td><nobr><span style="<?php if ($callcenter_active=='1') {?>background: green; color: white;<?} elseif ($callcenter_active=='2') {?>background: red; color: white;<?} ?>">&nbsp;<a class="no_border" style="color: white;" href="./callcenter.php?edit=<?php echo $callcenter_id; ?>"><?php echo html_entity_decode($callcenter_name, ENT_QUOTES, 'utf-8'); ?></a>&nbsp;</span></nobr></td>
						<td><nobr><?php echo date('d.m.Y / H:m:s', $cur_date_activity = strtotime($cur_date_activity)); ?></nobr></td>
						<td width="100"><a class="no_border" href="./operators.php?edit=<?php echo $cur_id; ?>"><div class="ico_edit" title="<?php echo $loc['callcenter.php']['t29']; ?>"></div></a>&nbsp;&nbsp;<a class="no_border" href="./operators.php?delete=<?php echo $cur_id; ?>" onclick="if (!confirm('<?php echo $loc['operators.php']['t19']; ?>&nbsp;&quot;<?php echo $cur_email; ?>&quot;?'))return false;"><div title="<?php echo $loc['callcenter.php']['t22'];?>" class="ico_delete"></div></a></td>
					</tr>
					<?php
					}
				}
			?>  
		</table>
	</p>
	<?php
	}
?>