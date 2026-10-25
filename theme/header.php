<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" href="/wp-content/themes/film/style.css">
	<link rel="stylesheet" href="/wp-content/themes/film/css/bootstrap.min.css">
	<link rel="stylesheet" href="/wp-content/themes/film/fontawesome/css/fontawesome-all.min.css">
	<script src="/wp-content/themes/film/js/jquery.min.js"></script>
	<script src="/wp-content/themes/film/js/popper.min.js"></script>
	<script src="/wp-content/themes/film/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			  	var target = $(this.hash);
			  	target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					event.preventDefault();
					$('html, body').animate({
					  scrollTop: target.offset().top
					}, 1000, function() {
						var $target = $(target);
						$target.focus();
						if ($target.is(":focus")) { // Checking if the target was focused
							return false;
						} else {
							$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
							$target.focus(); // Set focus again
						};
					});
			  	}
			}
		});
		apply_css();
	})
	$(window).resize(apply_css);
	function apply_css()
	{
		//if ($(window).width() >= 768) {
			$(".layer_top div").height($(window).width()/4);
			$(".layer_top").height($(window).width()/4);
			$(".layer").height($(window).width()/4);
		/*}
		else {
			$(".layer_top div").height(500);
			$(".layer_top").height(500);
			$(".layer").height(500);
		}*/
	}
	</script>
	<? wp_head(); ?>
</head>
<body>
	<header>
		<div class="row">
			<div class="col-12 layer">
				<!--<div class="layer_top">
					<div class="table">
						<div class="cell">
							<h1 class="site-title"><? echo get_bloginfo('name'); ?></h1>
							<h2 class="site-sub-title"><? echo get_bloginfo('description'); ?></h2>
						</div>
					</div>	
				</div>-->
				<nav class="navbar navbar-expand-lg menubar">
  					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    					<i class="fas fa-bars"></i>
 			 		</button>
	  				<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav m-auto">
							<li class="nav-item">
								<a class="nav-link" href="#studio">Студия <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#projects">Работы</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Команда</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#contacts">Контакты</a>
							</li>
						</ul>
  					</div>
				</nav>
			</div>
		</div>
	</header>
	
