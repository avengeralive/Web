<p>
<table class="stats_table">
	<tr>
	<td style="text-align: left; padding-bottom: 12px;">
<fieldset>
<legend><b><?php echo $loc['nalojka.php']['t26']; ?></b></legend>
<div class="zak_div1"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t27']; ?></div> <input maxlength="10" style="width: 100px;" placeholder="2000.00" name="sum" type="text" value="<?php if ($xres['cena']=='0') {echo htmlentities($xres['cena'])*htmlentities($res_zakaz['kolvo']);} else {echo htmlentities($xres['cena'])*htmlentities($res_zakaz['kolvo']);} ?>">&nbsp;(<?php echo $loc['nalojka.php']['t28']; ?>)&nbsp;</div>
</fieldset>
</td>
</tr>
</table>
</p>