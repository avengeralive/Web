
<?php
include ('./templates/'.$template.'/checkform/jquery.proverka.registration.form.php');
?>

<div id="parent_popup_click">
	<div id="popup_click">
		<div style="overflow-y: auto; height: 350px; padding: 0px 20px 0px 20px; margin: 0px 0px 0px 0px;">
		<?php include ('./templates/'.$template.'/blocks/rules_system.php'); ?>
		<a class="closebutton" title="Закрыть" onclick="document.getElementById('parent_popup_click').style.display='none';">X</a>
		</div>
	</div>
</div>
		
<div style="position: absolute; margin: 0px 0px 0px 38px; width: 250px; border: 2px solid #d5af16; color: red; text-align: center; background: black; z-index: 500;">
<?php if (isset($errortext_registration) && $errortext_registration!='') {echo $errortext_registration;} ?>
</div>

<form name="registration_form" class="grab__form" method="post">
	<div class="grab__head"><?php echo $loc['reg']['t01']; ?></div>
	<div class="grab__wrap-input">
		<div class="e-container1">
			<input type="text" name="registration_email" placeholder="<?php echo $loc['reg']['t02']; ?>"><i></i>
		</div>
	</div>
	<div class="grab__wrap-input">
		<div class="e-container2">
			<input type="password" name="registration_password_1" id="registration_password_1" placeholder="<?php echo $loc['reg']['t03']; ?>"><i></i>
		</div>
	</div>
	<div class="grab__wrap-input">
		<div class="e-container3">
			<input type="password" name="registration_password_2" placeholder="<?php echo $loc['reg']['t04']; ?>"><i></i>
		</div>
	</div>
	<div class="grab__wrap-checkbox" style="margin-top: 20px;">
		<div class="oops">
			<?php 
			if ($settings_registration_wm=='1') {?><label><input type="radio" name="registration_tip" value="10">&nbsp;<?php echo $loc['reg']['t05']; ?></label><?php }
			if ($settings_registration_wm=='1' AND $settings_registration_rk=='1') {?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }
			if ($settings_registration_rk=='1') {?><label><input type="radio" name="registration_tip" value="40">&nbsp;<?php echo $loc['reg']['t06']; ?></label><?php }
			?>
		</div>
	</div>
	<div class="grab__wrap-checkbox" style="margin-top: 20px;">
		<div class="oops"><input type="checkbox" name="registration_agree_rules" class="grab__checkbox"><?php echo $loc['reg']['t07']; ?>&nbsp;<a class="link" href="javascript:void(0)" onclick="document.getElementById('parent_popup_click').style.display='block';"><?php echo $loc['reg']['t08']; ?></a>&nbsp;<?php echo $loc['reg']['t09']; ?></div>
	</div>
	<div class="grab__wrap-button">
		<span class="grab__wrap-submit"><button type="submit" name="registration_submit" class="grab__submit"><span><?php echo $loc['reg']['t10']; ?></span></button></span>
	</div>
	<?php
	// Если в GET-запросе был передан ID рефовода, то добавляем в форму скрытое поле с этим значением
	// If the GET-request was handed partner ID, then add in the form of a hidden field with the same value
	if (isset($_GET['ref']))
		{
		$refovod=htmlentities((int)$_GET['ref']);
		echo '<input type="hidden" name="refovod" value="'.$refovod.'">';
		}
	?>
</form>
