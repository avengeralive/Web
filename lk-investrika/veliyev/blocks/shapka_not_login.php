
		<div class="header_lang">
			<a href="#" class="header_lang_current"><img src="./templates/<?php echo $template; ?>/img/<?php echo $_SESSION['language']; ?>.jpg" alt=""></a>
			<ul class="header_lang_list">
				<li>
					<a href="./?language=english">
						<img src="./templates/<?php echo $template; ?>/img/english.jpg" alt="">
						English
					</a>
				</li>
				<li>
					<a href="./?language=russian">
						<img src="./templates/<?php echo $template; ?>/img/russian.jpg" alt="">
						Русский
					</a>
				</li>						
			</ul>
		</div>
		<?php
		include './templates/'.$template.'/checkform/jquery.proverka.app.php';
		?>		
		<div class="header">
			<div class="cnt">
				<div class="header__left">
					<div class="header__logo">
						<a href="./">
							<div class="img-logo"></div>
							<div class="zagolovok"><nobr><?php echo htmlentities($settings_zagolovok); ?></nobr></div>
							<div class="podzagolovok"><nobr><?php echo htmlentities($settings_podzagolovok); ?></nobr></div>
						</a>
						<div style="position: absolute; margin: 3px 0px 0px 250px; width: 200px; text-align: center;">
						<!-- begin WebMoney Transfer : accept label -->
						<a href="http://www.megastock.ru/" target="_blank"><img src="./templates/<?php echo $template; ?>/img/acc_blue_on_white_ru.png" alt="www.megastock.ru" style="border: 1px solid #cccccc;" /></a>
						<!-- end WebMoney Transfer : accept label -->
						&nbsp;&nbsp;
						<!-- begin WebMoney Transfer : attestation label -->
						<a href="https://passport.webmoney.ru/asp/certview.asp?wmid=147062819432" target="_blank"><img src="./templates/<?php echo $template; ?>/img/v_blue_on_white_ru.png" alt="Здесь находится аттестат нашего WM идентификатора 147062819432" style="border: 1px solid #cccccc;" /></a>
						<!-- end WebMoney Transfer : attestation label -->
						</div>
					</div>
				</div>
				<div class="header__right">
					<span class="header__description"><span><?php echo $loc['header']['t01']; ?></span><?php echo $loc['header']['t02']; ?></span>
					<span class="header__wrap-button"><button class="header__button open-popup"><span><?php echo $loc['header']['t03']; ?></span></button></span>
				</div>
			</div>
		</div>
		