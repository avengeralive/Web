	<div class="block_top">
            <div class="content">
                <div class="">    
                    <span class="block_top_zagolovok"><a href="./cabinet.php"><img src="./templates/<?php echo $template; ?>/img-new/logo.png" alt="" style="width:130px;"></a></span>
			<ul class="block_top_nav_menu" style="margin-bottom: 0px;margin-top: 40px;padding-left: 20px;font-size: 14px;">
				<li >
					<a <?php if (curr_file()=='cabinet.php') {echo 'class="active"';} ?>  href="./cabinet.php"><?php echo $loc['in_header_top_menu']['t01']; ?></a>
				</li>
				<li>
					<a href="./stats.php" <?php if (curr_file()=='stats.php' || curr_file()=='zakaz.php') {echo 'class="active"';} ?>><?php echo $loc['in_header_top_menu']['t02']; ?></a>
                                        <ul class="podmenu" style="display:<?php if (curr_file()=='stats.php' || curr_file()=='zakaz.php') {echo 'block';}else{echo 'none';} ?>;position: absolute;margin-top: 13px;margin-left: -110px;">
                                               <li >
                                                       <a <?php if (curr_file()=='stats.php') {echo 'class="active"';} ?> href="./stats.php"><?php echo $loc['in_header_top_menu']['t02']; ?></a>
                                               </li>
                                               <li>
                                                       <a <?php if (curr_file()=='zakaz.php') {echo 'class="active"';} ?> href="./zakaz.php"><?php echo $loc['in_header_top_menu']['t19']; ?></a>
                                               </li>				
                                       </ul>				
                                
                                </li>                                
				<li>
					<a href="./offers.php" <?php if (curr_file()=='offers.php' || curr_file()=='landings.php' || curr_file()=='prelandings.php') {echo 'class="active"';} ?>><?php echo $loc['in_header_top_menu']['t03']; ?></a>
				</li>
				<li>
					<a href="./users.php" <?php if (curr_file()=='users.php' || curr_file()=='adduser.php' || curr_file()=='users_log.php' || curr_file()=='multiacc.php' || curr_file()=='antifrod.php') {echo 'class="active"';} ?>><?php echo $loc['in_header_top_menu']['t24']; ?></a>
                                        <ul class="podmenu" style="display:<?php if (curr_file()=='users.php' || curr_file()=='multiacc.php' || curr_file()=='antifrod.php') {echo 'block';}else{echo 'none';} ?>;position: absolute;margin-top: 13px;margin-left: -110px;">
                                                <li >
                                                        <a <?php if (curr_file()=='users.php') {echo 'class="active"';} ?> href="./users.php"><?php echo $loc['in_header_top_menu']['t24']; ?></a>
                                                </li>				
                                                <li >
                                                        <a <?php if (curr_file()=='multiacc.php') {echo 'class="active"';} ?> href="./multiacc.php"><?php echo $loc['in_header_top_menu']['t30']; ?></a>
                                                </li>
                                                <li >
                                                        <a <?php if (curr_file()=='antifrod.php') {echo 'class="active"';} ?> href="./antifrod.php"><?php echo $loc['in_header_top_menu']['t36']; ?></a>
                                                </li>
                                        </ul>				
                                
                                </li>
				<li>
					<a  <?php if (curr_file()=='news.php' || curr_file()=='mailing.php') {echo 'class="active"';} ?>  href="./news.php"><?php echo $loc['in_header_top_menu']['t22']; ?></a>
                                        <ul class="podmenu" style="display:<?php if (curr_file()=='news.php' || curr_file()=='mailing.php') {echo 'block';}else{echo 'none';} ?>;position: absolute;margin-top: 13px;margin-left: -110px;">
                                                <li>
                                                        <a <?php if (curr_file()=='news.php') {echo 'class="active"';} ?>  href="./news.php"><?php echo $loc['in_header_top_menu']['news-link-text']; ?></a>
                                                </li>
                                                <li>
                                                        <a <?php if (curr_file()=='mailing.php') {echo 'class="active"';} ?> href="./mailing.php"><?php echo $loc['in_header_top_menu']['delivery-link-text']; ?></a>
                                                </li>

                                        </ul>                                        
				</li>					
				<li>
					<a href="./tickets.php" <?php if (curr_file()=='tickets.php') {echo 'class="active"';} ?>><?php echo $loc['in_header_top_menu']['t14']; ?></a>
				</li>	
				<li>
					<a href="./help.php" <?php if (curr_file()=='help.php') {echo 'class="active"';} ?>><?php echo $loc['in_header_top_menu']['t08']; ?></a>
				</li>					
			</ul>

			
			<div class="block_top_nav_menu2" style="float:right;margin-left:10px;margin-top: 10px;">
                                <div class="<?php if($_SESSION['language'] == 'russian'){echo 'header_lang_current';}else{ echo 'header_lang';} ?>">
                                        <a href="./?language=russian"><img src="./templates/<?php echo $template; ?>/img-new/russian.png" alt=""></a>
				</div>
				<div class="<?php if($_SESSION['language'] == 'english'){echo 'header_lang_current';}else{ echo 'header_lang';} ?>">
					<a href="./?language=english"><img src="./templates/<?php echo $template; ?>/img-new/english.png" alt=""></a>
				</div>                            
				<?php
				include './templates/'.$template.'/checkform/jquery.proverka.app.php';
				?>					
			</div>					
		</div>
	</div>
</div>
	
	<div class="block_information">
		<div class="block_information_content">
			<b><?php echo htmlentities($user_tip_title); ?>: </b><?php echo htmlentities($user_email); ?>
			&nbsp;|&nbsp;
			<?php include 'main_menu_tickets.php'; ?>
			&nbsp;|&nbsp;
			<div class="exit_img"></div><a href="./logout.php"><?php echo $loc['in_header_top_menu']['t09']; ?></a>				
		</div>
	</div>

	
	
