
	<div class="block_top">
		<div class="content">
			<span class="block_top_zagolovok"><a href="./cabinet.php"><?php echo $settings_zagolovok; ?></a></span>
			<ul class="block_top_nav_menu">
				<li <?php if (curr_file()=='cabinet.php') {echo 'class="active"';} ?> >
					<a href="./cabinet.php"><?php echo $loc['in_header_top_menu']['t01']; ?></a>
				</li>
				<li <?php if (curr_file()=='zakaz.php') {echo 'class="active"';} ?> >
					<a href="./zakaz.php"><?php echo $loc['in_header_top_menu']['t19']; ?></a>
				</li>				
				<li <?php if (curr_file()=='tickets.php') {echo 'class="active"';} ?> >
					<a href="./tickets.php"><?php echo $loc['in_header_top_menu']['t14']; ?></a>
				</li>					
				<li <?php if (curr_file()=='finances.php') {echo 'class="active"';} ?> >
					<a href="./finances.php"><?php echo $loc['in_header_top_menu']['t06']; ?></a>
				</li>
				<li <?php if (curr_file()=='profile.php') {echo 'class="active"';} ?>>
					<a href="./profile.php"><?php echo $loc['in_header_top_menu']['t07']; ?></a>
				</li>
			</ul>	
			<div class="block_top_nav_menu2">
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
			</div>					
		</div>
	</div>
	<div class="block_information">
		<div class="block_information_content">
			<b><?php echo htmlentities($user_tip_title); ?>: </b><a href="profile.php"><?php echo htmlentities($user_email); ?></a>
			&nbsp;|&nbsp;
			<b><?php echo $loc['in_header_top_menu']['t17']; ?>&nbsp;</b><?php echo $user_balance; ?>&nbsp;<?php echo $loc['in_header_top_menu']['t16']; ?>&nbsp;
			<?php include 'main_menu_tickets.php'; ?>
			&nbsp;|&nbsp;
			<div class="exit_img"></div><a href="./logout.php"><?php echo $loc['in_header_top_menu']['t09']; ?></a>			
		</div>
	</div>
