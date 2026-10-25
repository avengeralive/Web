<p>
	<b><?php echo $loc['rules']['t01']; ?></b>
</p>
<p>
	&nbsp;
</p>
<p>
	<?php echo $loc['rules']['t02']; ?>
</p>
<p>
	&nbsp;
</p>
<p>
	<b><?php echo $loc['rules']['t09']; ?></b>
</p>
<p>
	&nbsp;
</p>
<p>
	<?php echo $loc['rules']['t10']; ?>
</p>
<p>
	&nbsp;
</p>
<p>
	<b><?php echo $loc['rules']['t03']; ?></b>
</p>
<p>
	&nbsp;
</p>
<p>
	<?php 
	// Данные выводятся из базы MySQL, таблица "settings"
	// Data is output from the MySQL database , the table "settings"
	if (isset($settings_icq) && $settings_icq!='') 
		{echo $loc['rules']['t04'].'&nbsp;'.$settings_icq.'<br />';}
					
	if (isset($settings_skype) && $settings_skype!='') 
		{echo $loc['rules']['t05'].'&nbsp;'.$settings_skype.'<br />';}
						
	if (isset($settings_email) && $settings_email!='') 
		{echo $loc['rules']['t06'].'&nbsp;<a class="link" href=mailto:'.$settings_email.'>'.$settings_email.'</a><br />';}
						
	if (isset($settings_phone) && $settings_phone!='') 
		{echo $loc['rules']['t07'].'&nbsp;'.$settings_phone.'<br />';}
	?>
</p>
<p>
	&nbsp;
</p>
<p align=center>
	<a class="link" href="#" onclick="document.getElementById('parent_popup_click').style.display='none';">
	<?php echo $loc['rules']['t08']; ?></a>
</p>
