
	<?php
	include ('./templates/'.$template.'/checkform/jquery.proverka.domains.form.php');
	?>

	<!-- Блок с формой -->
	<!-- Block with a form -->
	<form name="cat_offers_form" class="report" method="post" action="./cat_offers.php?<?php echo @$_SERVER['QUERY_STRING']?>">
		<p>
			<b><?php echo $loc['cat_offers.php']['t11']; ?></b>
		</p>
		<p>
			<table class="domains_table">
				<tr>
					<td><?php echo $loc['cat_offers.php']['t12']; ?>&nbsp;</td><td><input type="text" name="category" class="search_pole" value="" maxlength="30" required /></td>
				</tr>
			</table>
			<p>
				<input name="submit_category" value="<?php echo $loc['button']['t01']; ?>" class="btn button" type="submit">
			</p>
		</p>
	</form>
	<!-- Конец блока с формой -->
	<!-- End block with a form -->
