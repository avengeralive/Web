
<?php get_header('404'); ?>
<div class="page-404">
	

	<section>
		<div class="container">
			<div class="header-yellow">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="display-inline logo-yellow">InfoShell</a>
				<span class="yellow-txt display-inline">Разработка и продвижение <br> мобильных приложений и web-сервисов</span>
			</div>
			<div class="content content-404">
				<p class="large-txt">Вы можете <a href="#" class="email-us-btn" ymParam='EMAIL_404' >сообщить нам об ошибке</a></p>
				<p>или перейти в любой из разделов нашего сайта:</p>
				
				<div class="menu-nav-list">
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</div>
			</div>
		</div>
	</section>

</div>

<?
        include(locate_template('template_form.php'));
    ?>