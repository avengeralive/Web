<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<? wp_head(); ?>
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700&amp;subset=cyrillic" rel="stylesheet">
		<link href="<? echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<p class="logo">
				<a href="javascript:void(0)" class="burger-menu">
					<img src="<? echo get_template_directory_uri(); ?>/images/icons/menu.svg">
				</a>
				<img src="<? echo get_template_directory_uri(); ?>/images/logo.webp" alt="Студия Али Велиева лого" title="Студия Али Велиева">
				<span>Студия Али</span><br> Велиева
			</p>
			<ul>
				<li><a href="#">О компании</a></li>
				<li><a href="#">Услуги</a></li>
				<li><a href="#">Портфолио</a></li>
				<li><a href="#">Блог</a></li>
				<li><a href="#">Контакты</a></li>
			</ul>
		</header>
		