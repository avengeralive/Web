
<p>
	<form method="get" action="./users_log.php?<?php echo @$_SERVER['QUERY_STRING']?>">
		<p>
			<b><?php echo $loc['users_log.php']['t24']; ?></b>
			<select name="my_stats" class="userslog_select_text">
				<option class="options" value="0" <?php if (isset($_GET['my_stats']) && $_GET['my_stats']=='0') {echo 'selected="selected"';} ?>><?php echo $loc['users_log.php']['t26']; ?></option>
				<option class="options" value="1" <?php if (isset($_GET['my_stats']) && $_GET['my_stats']=='1') {echo 'selected="selected"';} ?>><?php echo $loc['users_log.php']['t27']; ?></option>
			</select>
		</p>
		<p>
			<b><?php echo $loc['users_log.php']['t25']; ?></b>
			<input type="text" name="email" value="<?php if (isset($_GET['email']) && $_GET['email']!='') {echo htmlentities($_GET['email']);} ?>" class="userslog_input_text">
		</p>
		<p>
			<input type="submit" class="btn button" value="<?php echo $loc['button']['t02']; ?>">
		</p>
	</form>
</p>
