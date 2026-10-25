
	<div class="popup-overlay"></div>
	<div class="popup-fixed">
		<div class="popup-container">
			<div class="popup-content">
				<div class="popup">
					<div class="popup__wrap-form">

						<?php
						include ('./templates/'.$template.'/checkform/jquery.proverka.login.form.php');
						?>

						<?php if (isset($errortext_login) && $errortext_login!='') {echo $errortext_login;} ?>
				
						<form name="login_form" class="popup__form" action="./" method="post">
							<div class="popup__close"></div>
							<div class="popup__head"><?php echo $loc['auth']['t01']; ?></div>
							<div class="popup__wrap-input">
								<div class="e-container1">
									<input type="text" name="login_email" placeholder="<?php echo $loc['auth']['t02']; ?>" value="" maxlength="40"><i></i>
								</div>
							</div>
							<div class="popup__wrap-input">
								<div class="e-container2">
									<input type="password" name="login_password" placeholder="<?php echo $loc['auth']['t03']; ?>" value="" maxlength="40"><i></i>
								</div>
							</div>
							<div class="popup__links">
								<a href="./recover.php"><?php echo $loc['auth']['t04']; ?></a>
								<?php
								if ($settings_registration_wm=='1' || $settings_registration_rk=='1') 
									{
									?>
									<a href="./"><?php echo $loc['auth']['t05']; ?></a>
									<?php
									}
								?>
							</div>
							<div class="popup__wrap-button">
								<span class="popup__wrap-submit"><button type="submit" name="login_submit" class="popup__submit"><span><?php echo $loc['auth']['t06']; ?></span></button></span>
							</div>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>