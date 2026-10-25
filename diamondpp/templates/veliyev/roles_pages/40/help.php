
<h1><?php echo $loc['help.php']['t01']; ?></h1>

<p style="margin:50px 0;">
	Для подключения своего оффера в партнескую сеть свяжитесь, пожалуйста, с менеджером <a style="color:blue;" href="skype:biz-consulting?chat">biz-consulting</a>
</p>

<p>
	<b><?php echo $loc['help.php']['t20']; ?></b>
</p>

	<?php if (isset($settings_skype) && $settings_skype!='') {echo $loc['help.php']['t22'].'&nbsp;<a href="skype:'.$settings_skype.'?add">'.$settings_skype.'</a><br />';} ?>
	<?php if (isset($settings_email) && $settings_email!='') {echo $loc['help.php']['t23'].'&nbsp;<a href="mailto:'.$settings_email.'">'.$settings_email.'</a><br />';} ?>
	<?php if (isset($settings_phone) && $settings_phone!='') {echo $loc['help.php']['t24'].'&nbsp;'.$settings_phone.'<br />';} ?>
</p>

<p>
	&nbsp;
</p>

<p>
	&nbsp;
</p>