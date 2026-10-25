<div class="row cabinet main mt-50 mb-50">

    <div class="col-12 mb-10"><p class="pageTitle mb-25"><?php echo $loc['export_zakaz.php']['t01']; ?></p></div>

    <?php 
    if (isset($_GET['xtext']) && $_GET['xtext']=='2') {$error_message = $loc['export_zakaz.php']['t04'];$error_type = 'error';}
    ?>
<div class="col-12 mb-10">
<form action="./export_zakaz.php?export_zakaz" method="post">

<p>
	<?php
	if (isset($_POST['zakaz_numbers']) && $_POST['zakaz_numbers']!='')
		{
		$zakaz_numbers=htmlentities($_POST['zakaz_numbers']);
		echo '<b><font color="green">'.$loc['export_zakaz.php']['t03'].'</font></b><br />';
		echo '<input name="zakaz_numbers" type="hidden" value="'.$zakaz_numbers.'">';
		}
	?>
</p>

<p><?php echo $loc['export_zakaz.php']['t05']; ?>&nbsp;
	<select name="razdelitel">
		<option value="1"><?php echo $loc['export_zakaz.php']['t06']; ?>&nbsp;(";")</option>
		<option value="2"><?php echo $loc['export_zakaz.php']['t07']; ?>&nbsp;(",")</option>
	</select>
	&nbsp;&nbsp;
	<?php echo $loc['export_zakaz.php']['t08']; ?>&nbsp;
	<select name="extension">
		<option value="1"><?php echo $loc['export_zakaz.php']['t09']; ?></option>
		<option value="2"><?php echo $loc['export_zakaz.php']['t10']; ?></option>
	</select>
</p>

<p>
	<table>
	<?php
	$count_spisok=0;
	while($count_spisok<19) 
		{
		$count_spisok++;
		?>
		<tr id="block<?php echo $count_spisok; ?>">
			<td style="height: 25px; vertical-align: middle;">
				<select id="pole<?php echo $count_spisok; ?>" name="pole<?php echo $count_spisok; ?>" onchange="if ($('#pole<?php echo $count_spisok; ?>').val()=='0') {$('#block<?php echo $count_spisok; ?>').hide();}">
				<option value="0" style="background: red; color: white;"><?php echo $loc['export_zakaz.php']['t11']; ?></option>
				<option value="date" <?php if ($count_spisok==1) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t12']; ?></option>
				<option value="offer_id" <?php if ($count_spisok==2) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t13']; ?></option>
				<option value="cena" <?php if ($count_spisok==3) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t14']; ?></option>
				<option value="kolvo" <?php if ($count_spisok==4) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t15']; ?></option>
				<option value="name" <?php if ($count_spisok==5) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t16']; ?></option>
				<option value="phone" <?php if ($count_spisok==6) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t17']; ?></option>
				<option value="email" <?php if ($count_spisok==7) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t18']; ?></option>
				<option value="client_address" <?php if ($count_spisok==8) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t19']; ?></option>
				<option value="country" <?php if ($count_spisok==9) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t20']; ?></option>
				<option value="region" <?php if ($count_spisok==10) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t21']; ?></option>
				<option value="town" <?php if ($count_spisok==11) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t22']; ?></option>
				<option value="street" <?php if ($count_spisok==12) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t23']; ?></option>
				<option value="status" <?php if ($count_spisok==13) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t25']; ?></option>
				<option value="artikul" <?php if ($count_spisok==14) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t26']; ?></option>
				<option value="comments" <?php if ($count_spisok==15) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t27']; ?></option>
				<option value="ip" <?php if ($count_spisok==16) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t28']; ?></option>
				<option value="referer" <?php if ($count_spisok==17) {echo 'selected="selected"';} ?>><?php echo $loc['export_zakaz.php']['t29']; ?></option>
				<option value="user_id" <?php if ($count_spisok==18) {echo 'selected="selected"';} ?>>userID</option>
				<option value="pinger_value" <?php if ($count_spisok==19) {echo 'selected="selected"';} ?>>Pinger Value</option>
				</select>
			</td>
			<td style="width: 30px; height: 25px; text-align: center; vertical-align: middle;">
				<a href="#" style="text-decoration: none; border: 0;" onclick="$('#pole<?php echo $count_spisok; ?>').val('0'); $('#block<?php echo $count_spisok; ?>').hide();"><img title="<?php echo $loc['export_zakaz.php']['t30']; ?>" src="./templates/<?php echo $template; ?>/img/ico_delete.png" width="20" height="20" border="0"></a>
			</td>
		</tr>
		<?php
		}
	?>
	</table>
</p>

<p>
	<?php echo $loc['export_zakaz.php']['t31']; ?>&nbsp;<a href="./export_zakaz.php"><?php echo $loc['export_zakaz.php']['t32']; ?></a>&nbsp;<?php echo $loc['export_zakaz.php']['t33']; ?>
</p>

<p>
	<input type="submit" class="btn button" value="<?php echo $loc['export_zakaz.php']['t35']; ?>" onclick="if (!confirm('<?php echo $loc['export_zakaz.php']['t34']; ?>'))return false;">
</p>

</div>