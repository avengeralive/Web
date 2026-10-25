<p>
<table class="stats_table" style="position: relative; float: left; margin-right: 20px;">
	<tr>
	<td style="text-align: left; padding-bottom: 12px;">
<fieldset>
<legend><b><?php echo $loc['nalojka.php']['t25']; ?></b></legend>
<div class="zak_div1"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t16']; ?></div> <input maxlength="40" style="width: 250px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="sender_whom" type="text" value="<?php if (isset($xres['name'])) {echo htmlentities($xres['name']);} ?>"></div>
<div class="zak_div2"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t17']; ?></div> <input maxlength="30" style="width: 150px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="sender_city" type="text" value="<?php if (isset($xres['town'])) {echo htmlentities($xres['town']);} ?>"></div>
<div class="zak_div2"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t18']; ?></div> <input maxlength="30" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="sender_district" type="text" value="<?php if (isset($xres['region'])) {echo htmlentities($xres['region']);} ?>"></div>
<div class="zak_div2"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t19']; ?></div> <input maxlength="30" style="width: 150px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="sender_country" type="text" value="<?php if (isset($xres['country'])) {echo htmlentities($xres['country']);} ?>"></div>
<div class="zak_div1"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t20']; ?></div> <input maxlength="200" style="width: 200px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="sender_street" type="text" value="<?php if (isset($xres['street'])) {echo htmlentities($xres['street']);} ?>"></div>
<div class="zak_div2"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t21']; ?></div> <input maxlength="10" style="width: 100px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="sender_building" type="text" value="<?php if (isset($xres['dom'])) {echo htmlentities($xres['dom']);} ?>"></div>
<div class="zak_div2"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t22']; ?></div> <input maxlength="4" style="width: 100px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="sender_flat" type="text" value="<?php if (isset($xres['kvartira'])) {echo htmlentities($xres['kvartira']);} ?>"></div>
<div class="zak_div1"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t23']; ?></div> <input maxlength="10" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="sender_zip" type="text" value="<?php if (isset($xres['zipcode'])) {echo htmlentities($xres['zipcode']);} ?>"></div>
<div class="zak_div1"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t24']; ?></div> <input maxlength="20" style="width: 200px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="sender_phone" type="text" value="<?php if (isset($xres['phone']) && $access_zakaz == 1) {echo htmlentities($xres['phone']);} ?>"></div>
</fieldset>
</td>
</tr>
</table>
</p>

