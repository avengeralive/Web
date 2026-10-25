<!DOCTYPE html>
<html lang="en-US">
<head>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/wp-content/themes/comp/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/wp-content/themes/comp/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="/wp-content/themes/comp/style.css">
	<script type="text/javascript" src="/wp-content/themes/comp/assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="/wp-content/themes/comp/assets/js/bootstrap.min.js"></script>
	<title><? wp_title(); ?></title>
	<? wp_head(); ?>
</head>
<body>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-6" style="padding-left: 0;">
					<h1 class="site-header"><? echo get_bloginfo(); ?></h1>
				</div>
				<div class="col-12 col-sm-6 text-right" style="padding-right: 0;">
					<p><a class="phone" href="tel:<? echo get_field('телефон_(без_формата)', 2); ?>"><? echo get_field('телефон', 2); ?></a></p>
					<p><a class="zakaz" href="#" data-toggle="modal" data-target="#exampleModal">ОНЛАЙН ЗАКАЗ КРУГЛОСУТОЧНО</a></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="container">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    			<span class="navbar-toggler-icon"></span>
		  			</button>
				 	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    			<ul class="navbar-nav ml-auto">
		    			<?
							$menu = wp_get_nav_menu_items('Главное меню');
							global $post;
							foreach ($menu as $item) {				
						?>
							<li class="menu-item menu-item-type-custom menu-item-object-custom <? if ($item->object_id == $post->ID) echo 'active'; ?>">
								<a class="nav-link" href="<? echo $item->url; ?>"><? echo $item->title; ?></a>
							</li>
						<? } ?>
		    			</ul>
				  	</div>
				</nav>
			</div>
		</div>
	</header>
	<section>
		<div class="container">
			<div class="row services">
				<? $args = array( 'posts_per_page' => 999, 'post_type' => 'services', 'order' => 'ASC');
					$posts_array = get_posts( $args );
					foreach ($posts_array as $key=>$post)
					{
						$sign = get_field('иконка', $post->ID);
						if ($key == 8) { ?><div class="col-12 col-sm-12 col-md-1"></div><? }
				?>
					<div class="col-4 col-sm-4 col-md-2 service_item">
						<a href="<? echo $post->guid; ?>">
							<p><i class="<? echo $sign; ?>"></i></p>
							<h4 class="box-title"><? echo $post->post_title; ?></h4>
						</a>
					</div>
				<? } ?>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row slider">
				<? $args = array( 'posts_per_page' => 999, 'post_type' => 'slider', 'order' => 'ASC');
					$posts_array = get_posts($args);
				?>
				<div class="col-sm-6 col-md-2 slide_block">
					<div class="col-12"><div class="tc hh2"><p><? echo $posts_array[0]->post_title; ?></p></div></div>
					<div class="col-12"><div class="tc hh2"><p><? echo $posts_array[1]->post_title; ?></p></div></div>
				</div>
				<div class="col-sm-6 col-md-2 slide_block">
					<div class="col-12"><div class="tc hh1"><p><? echo $posts_array[2]->post_title; ?></p></div></div>
				</div>
				<div class="col-sm-6 col-md-2 slide_block">
					<div class="col-12"><div class="tc hh3"><? echo $posts_array[3]->post_title; ?></div></div>
					<div class="col-12"><div class="tc hh3"><? echo $posts_array[4]->post_title; ?></div></div>
					<div class="col-12"><div class="tc hh3"><? echo $posts_array[5]->post_title; ?></div></div>
				</div>
				<div class="col-sm-6 col-md-3 slide_block">
					<div class="col-12"><div class="tc hh2"><? echo $posts_array[6]->post_title; ?></div></div>
					<div class="col-12"><div class="tc hh2"><? echo $posts_array[7]->post_title; ?></div></div>
				</div>
				<div class="col-sm-6 col-md-3 slide_block">
					<div class="col-12">
						<div class="tc hh1 zakmast">
							<a href="#" data-toggle="modal" data-target="#exampleModal">ONLINE ЗАКАЗ МАСТЕРА</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>