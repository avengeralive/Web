<?php
get_header();

	if($_GET['cat']==10||$_GET['cat']==11||$_GET['cat']==12){
		include ("category_portfolio.php");}
	else{
		include ("category_blog.php");}
		
 get_footer(); ?>
