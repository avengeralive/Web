
	<div class="wrapper">
		<!--[if lt IE 9]>
			<div class="browsehappy"><?php echo $loc['service']['t01']; ?></div>
		<![endif]-->

		<?php
		// Выводим шапку сайта
		// Print cap site
		include './templates/'.$template.'/blocks/shapka_not_login.php';

		// Выводим верхнее горизонтальное меню
		// Display the top horizontal menu
		include './templates/'.$template.'/blocks/top_menu_not_login.php';
		?>

		<div class="page">
			<div class="cnt">
				<div class="page__title"><span><?php echo $loc['hot_news.php']['t01']; ?></span></div>
				<div class="page__text">
					<h2><?php echo $loc['hot_news.php']['t02']; ?></h2>
					<p>

						<?php
						$result = $mysqli->query( "SELECT COUNT(id) AS count FROM `news` WHERE `public_news`='1' AND (`user_tip`='10' OR `user_tip`='40')" );
						function build_pagination_url( $page ) 
							{
							$parameters = array('page' => $page);
							return '?' . http_build_query( $parameters );
							}
						?>
						<p>
							<?php
							// Вывод количества страниц
							// Display the number of pages
							pagination($result,10,11);
							?>
						</p>
						
						<p style="margin: 60px 0px 10px 0px;">
	
							<?php
							if (isset($offset) && isset($show_pages))
								{
								$sql = "SELECT DATE_FORMAT(date, '%d.%m.%Y / %H:%i:%s') as date,news_zagolovok,news,id,user_tip FROM news WHERE `public_news`='1' AND (`user_tip`='10' OR `user_tip`='40') ORDER BY `id` DESC LIMIT $offset, $show_pages";
								$result = $mysqli->query($sql);
								if (mysqli_num_rows($result)>0) 
									{
									while($res=mysqli_fetch_array($result)) 
										{
										$news_id=htmlentities($res['id']);
										$news_date=htmlentities($res['date']);
										$news_zagolovok=htmlentities($res['news_zagolovok']);
										$news=htmlentities($res['news']);
										$news_user_tip=htmlentities($res['user_tip']);

										$sql_textrole = "SELECT title FROM users_roles_tpl WHERE `tip`='$news_user_tip'";		
										$result_textrole = $mysqli->query($sql_textrole);
										$res_textrole=mysqli_fetch_array($result_textrole);
										$role_title=htmlentities($res_textrole['title']);
										?>
										<div style="position: relative; width: 100%; border: 1px solid #FDA000; margin-bottom: 20px; display: inline-block; padding: 10px;">
											<table class="newsone_table">
												<tr>
													<td><?php echo $news_date.' <font color="gray">('.$loc['hot_news.php']['t03'].'&nbsp;'.$role_title.')</font><br /><b>'.html_entity_decode($news_zagolovok, ENT_QUOTES, 'utf-8').'</b>'; ?></td>
												</tr>
												<tr>
													<td style="padding-top: 8px;">
														<?php echo html_entity_decode($news, ENT_QUOTES, 'utf-8'); ?>
													</td>
												</tr>
											</table>
										</div>
										<?php
										}
									}
								}
							?>
						</p>
	
						<p style="margin-top: -20px;">
							<?php
							// Вывод количества страниц
							// Display the number of pages
							pagination($pagination_fetched_row,10,11);
							?>
						</p>

						<p>
							&nbsp;
						</p>
					</p>
				</div>
			</div>
		</div>

		<?php
		// То что выводится на каждой странице до авторизации
		// What is displayed on each page to login
		include './templates/'.$template.'/blocks/always_not_login.php';

		// Выводим нижнее горизонтальное меню
		// Display the bottom horizontal menu
		include './templates/'.$template.'/blocks/bottom_menu_not_login.php';
		?>

	</div>

	<?php
	// Выводим форму логина
	// Display the login form
	include './templates/'.$template.'/blocks/login_form.php';
	?>

	<script src="./templates/<?php echo $template; ?>/js/scripts.js"></script>
	
	<!--[if lt IE 10]>
	<script src="./templates/<?php echo $template; ?>/js/attrplaceholder.js"></script>
	<![endif]-->
	