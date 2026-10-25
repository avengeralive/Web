
	<?php
	include ('./templates/'.$template.'/checkform/jquery.proverka.domains.form.php');
	?>

	<!-- Блок с формой -->
	<!-- Block with a form -->
	<form name="domains_form" class="report" method="post" action="domains.php?<?php echo @$_SERVER['QUERY_STRING']?>">
		<p>
			<b><?php echo $loc['domains.php']['t18']; ?></b>
		</p>
		<p>
			<table class="domains_table">
				<tr>
					<td><?php echo $loc['domains.php']['t19']; ?>&nbsp;</td><td><input type="text" name="domain" class="search_pole" value="" maxlength="30" required /></td>
				</tr>
			</table>
			<p>
				<input name="submit_adddomain" value="<?php echo $loc['button']['t01']; ?>" class="btn button" type="submit">
			</p>
		</p>
	</form>
	<!-- Конец блока с формой -->
	<!-- End unit with a form -->
