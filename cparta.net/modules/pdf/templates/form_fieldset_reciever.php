<p>
<table class="stats_table" style="position: relative; float: left; margin-right: 20px;">
	<tr>
	<td style="text-align: left; padding-bottom: 12px;">
<fieldset>
<legend><b><?php echo $loc['nalojka.php']['t15']; ?></b></legend>
<div class="zak_div1"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t16']; ?></div> <input maxlength="40" style="width: 250px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="reciever_whom" type="text" value="<?php if (isset($res_profile['name'])) {echo htmlentities($res_profile['name']);} ?>"></div>
<div class="zak_div2"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t17']; ?></div> <input maxlength="30" style="width: 150px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="reciever_city" type="text" value="<?php if (isset($res_profile['town'])) {echo htmlentities($res_profile['town']);} ?>"></div>
<div class="zak_div2"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t18']; ?></div> <input maxlength="30" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="reciever_district" type="text" value="<?php if (isset($res_profile['region'])) {echo htmlentities($res_profile['region']);} ?>"></div>
<div class="zak_div2"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t19']; ?></div> <input maxlength="30" style="width: 150px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="reciever_country" type="text" value="<?php if (isset($res_profile['country'])) {echo htmlentities($res_profile['country']);} ?>"></div>
<div class="zak_div1"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t20']; ?></div> <input maxlength="200" style="width: 200px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="reciever_street" type="text" value="<?php if (isset($res_profile['street'])) {echo htmlentities($res_profile['street']);} ?>"></div>
<div class="zak_div2"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t21']; ?></div> <input maxlength="10" style="width: 100px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="reciever_building" type="text" value="<?php if (isset($res_profile['dom'])) {echo htmlentities($res_profile['dom']);} ?>"></div>
<div class="zak_div2"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t22']; ?></div> <input maxlength="4" style="width: 100px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="reciever_flat" type="text" value="<?php if (isset($res_profile['kvartira'])) {echo htmlentities($res_profile['kvartira']);} ?>"></div>
<div class="zak_div1"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t23']; ?></div> <input maxlength="10" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="reciever_zip" type="text" value="<?php if (isset($res_profile['zipcode'])) {echo htmlentities($res_profile['zipcode']);} ?>"></div>
<div class="zak_div1"><div class="zak_div_name"><?php echo $loc['nalojka.php']['t24']; ?></div> <input maxlength="20" style="width: 200px;" placeholder="<?php echo $loc['nalojka.php']['t14']; ?>" name="reciever_phone" type="text" value="<?php if (isset($res_profile['phone']) && (int)$res_profile['phone']) {if (strlen($res_profile['phone'])>10) {$res_profile2=substr($res_profile['phone'],-10);} echo htmlentities($res_profile2);} ?>"></div>
</fieldset>
</td>
</tr>
</table>
</p>

