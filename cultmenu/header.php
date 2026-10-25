<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <title><?php bloginfo('name'); wp_title(); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url()'); ?>">

    <?php wp_head(); ?>
</head>
<body>

<header class="navbar-top">
	<div class="container">
		<div class="col-md-4 soc">
			<ul>	
					<li class="soc-vk">
						<a href="#">
							<img src="<?php bloginfo('template_url'); ?>/images/vk.png" height="25" width="25"/>
						</a>
					</li>
					<li class="soc-fb">
						<a href="#">
							<img src="<?php bloginfo('template_url'); ?>/images/facebook.png" height="25" width="25" />	
						</a>
					</li>
					<li class="soc-inst">
						<a href="#">
							<img src="<?php bloginfo('template_url'); ?>/images/instagram.png" height="25" width="25"/>
						</a>
					</li>
				</ul>
		</div>
		<div class="col-md-4 cultmenu-td">
			<a href="<?php echo home_url(); ?>" style="color: #2937B8;"><h1><strong><b><?php bloginfo('name'); ?></b></strong></h1></a>
		</div>
		<div class="col-md-4">
			<form class="search-td" action="" method="">
				<input class="search-txt" type="text" name="search" />
				<input class="search-btn" type="image" src="<?php bloginfo('template_url'); ?>/images/search.png"/>
			</form>
		</div>
		<div class="col-xs-12 menu_bar">	
			<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php
					wp_nav_menu( array(
						'theme_location' => 'menu',
						'container' => 'false',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'menu_class' => 'menu nav navbar-nav',
						'menu_id' => '',
						'depth' => 1
					) );
				?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
		</div>
		<div class="col-xs-12" style="text-align: right;">
			<? if (is_user_logged_in()) { ?>
			<a href="/личный-кабинет">Личный кабинет</a>
			<? } else { ?>
			<a href="/вход">Вход</a> / <a href="/регистрация">Регистрация</a>
			<? } ?>
		</div>
	</div>
</header>

<!---->