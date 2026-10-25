<?
add_theme_support('menus');

add_action('left_sidebar', 'left_sidebar');
add_action('left_sidebar_service', 'left_sidebar_service');

add_action('getIcon', 'getIcon');
add_filter( 'wpseo_xml_sitemap_img', '__return_false' );

function getIcon($args)
{
	$image = get_field('иконка', $args['id']);
	echo $image['url'];
}


function left_sidebar()
{
?>
<div class="col col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
				<button class="btn btn-primary action" data-toggle="modal" data-target="#zvonok">Заказать звонок</button>
				<button class="btn btn-primary action" data-toggle="modal" data-target="#priem">Записаться на приём</button>
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="akcii">
					<h2>Акции</h2>
<?
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'coupon', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
		$image = get_field('картинка', $post->ID);
		$desc = get_field('краткое_описание', $post->ID);
?>
					
					<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 akcii_item">
						<a href="<? echo get_post_permalink($post->ID); ?>">
							<h3><? echo $post->post_title; ?></h3>
							<img src="<? echo $image['url']; ?>">
							<p><? echo $desc; ?></p>
						</a>
					</div>
	<? } ?>
				</div>
			</div>
<?
}

function left_sidebar_service()
{
?>
<div class="col col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
<?  ?>
				<button class="btn btn-primary action" data-toggle="modal" data-target="#zvonok">Заказать звонок</button>
				<button class="btn btn-primary action" data-toggle="modal" data-target="#priem">Записаться на приём</button>
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="akcii">
					<h2>Акции</h2>
<?
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'coupon', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
		$image = get_field('картинка', $post->ID);
		$desc = get_field('краткое_описание', $post->ID);
?>
					
					<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 akcii_item">
						<a href="<? echo get_post_permalink($post->ID); ?>">
							<h3><? echo $post->post_title; ?></h3>
							<img src="<? echo $image['url']; ?>">
							<p><? echo $desc; ?></p>
						</a>
					</div>
	<? } ?>
				</div>
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-top: 30px;">
		<div class="list-group" id="list-items-serv">
<?
	$args = array( 'posts_per_page'   => 999, 'category_name' => 'services', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
?>
		<a href="<? echo get_post_permalink($post->ID); ?>" class="list-group-item list-group-item-action <? if ($post->ID == get_the_ID()) echo 'active'; ?>"><? echo $post->post_title; ?></a>
	<? } ?>
	</div>
	</div>
			</div>
<?
}

add_action('getBanner', 'getBanner');
add_action('doctors_info', 'doctors_info');
add_action('technology_info', 'technology_info');
add_action('portfolio_info', 'portfolio_info');

function getBanner($args)
{
	$banner = get_field('баннер_страницы', $args['id']);
	$banner_title = get_field('запись_на_баннере', $args['id']);
?>
<script>
	$('.parallax-window').parallax({imageSrc: '<? echo $banner['url']; ?>'});
	$('#banner_title').html('<? echo $banner_title; ?>');
</script>
<?	
}

function doctors_info($args)
{
	$name = get_field('имя', $args['id']);
	$last = get_field('фамилия', $args['id']);
	$father = get_field('отчество', $args['id']);
	$spec = get_field('должность', $args['id']);
	$photo = get_field('фотография', $args['id']);
	$short = get_field('краткое_описание', $args['id']);
	$cert = get_field('сертификаты', $args['id']);
	$content_post = get_post($args['id']);
	$content = $content_post->post_content;
?>
	<div class="col col-12 col-sm-4 col-md-5 col-lg-5 col-xl-5" style="padding-left: 0px;">
		<img src="<? echo $photo['url']; ?>" class="alignleft" style="width: 100%;">
	</div>
	<div class="col col-12 col-sm-8 col-md-7 col-lg-7 col-xl-7">
		<h1 style="font-size: 24px; text-align: left;"><? echo $last; ?> <? echo $name; ?> <? echo $father; ?></h1>
		<p style="color: #32CD32;"><? echo $spec; ?></p>
		<button class="btn btn-primary action" data-toggle="modal" data-target="#priem" style="width: 300px; padding: 20px; margin-top: 15px; margin-bottom: 30px;" onclick="$('select[name=\'doc\']').val('<? echo $last; ?> <? echo $name; ?> <? echo $father; ?>');">Записаться на приём</button>
		<? echo $short; ?>
		<a href="#" data-toggle="modal" data-target="#detail">Читать полностью</a>
		<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="detailLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<p class="modal-title" id="detailLabel" style="color: #32CD32; font-size: 20px;"><? echo $last; ?> <? echo $name; ?> <? echo $father; ?>
						<br><span style="color: #ccc; font-size: 18px;"><? echo $spec; ?></span>	
						</p>
						
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="padding: 25px;">
						<? echo $content; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?
}


function portfolio_info($args)
{
	$doc = get_field('врач', $args['id']);
	$content_post = get_post($args['id']);
	$content = $content_post->post_content;
	$name = get_field('имя', $doc->ID);
	$last = get_field('фамилия', $doc->ID);
	$father = get_field('отчество', $doc->ID);
	$spec = get_field('должность', $doc->ID);
	$photo = get_field('превью_фото', $doc->ID);
?>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 portfolio_content" style="padding: 0px;">
	<? echo $content; ?>
	</div>
	<!--<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-top: 30px; margin-bottom: 100px;">
		<h2 style="text-align: left;">Врачи проводившие лечение</h2>
		<div class="col col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding: 0px;">
			<a href="<? echo get_post_permalink($doc->ID); ?>" class="item_link">
				<div class="col col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 review_image" style="padding: 0px;">
					<img src="<? echo $photo['url']; ?>" style="width: 100%;">
				</div>
				<div class="col col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8" style="padding-right: 0px; text-align: left;">
					<h5 style="color:#32CD32;"><? echo $last; ?> <? echo $name; ?> <? echo $father; ?></h5>
					<p><? echo $spec; ?></p>
				</div>
			</a>
		</div>
	</div>-->
<?		$args = array( 'posts_per_page'   => 999, 'category_name' => 'portfolio', 'order' => 'ASC');
	$posts_array = get_posts( $args );
	foreach ($posts_array as $key=>$post)
	{
		$image = get_field('превью', $post->ID);
		$service = get_field('услуга', $post->ID);
		$doctor = get_field('врач', $post->ID);
		$title = $post->post_title;
?>	
		<div class="col col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 portfolio_item" style="padding-left: 0;" data-service="<? echo $service->post_title; ?>" data-doctor="<? echo $doctor->post_title; ?>">
			<a href="<? echo get_post_permalink($post->ID); ?>" class="item_link">
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 review_image" style="padding: 0">
					<img src="<? echo $image['url']; ?>" width="100%">
				</div>
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 tech-info" style="padding-left: 0;">
					<table style="width: 100%;">
						<tr>
							<td style="height: 40px; font-size: 12px; text-align: center;"><? echo $service->post_title; ?></td>
						</tr>
						<tr>
							<td style="height: 150px;"><p style="text-align: center; font-size: 14px; color: #32CD32;"><? echo $title; ?></p></td>
						</tr>
					</table>		
				</div>
			</a>
		</div>
<?  } ?>
<?
}

function technology_info($args)
{
	$desc = get_field('расширенное_описание', $args['id']);
	$price = get_field('стоимость', $args['id']);
	$content_post = get_post($args['id']);
	$content = $content_post->post_content;
	$post_title = $content_post->post_title;
?>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 15px; background: #eee;">
		<h1 style="text-align: left;"><? echo $post_title; ?></h1>
		<? echo $content; ?>
		<br>
		<br>
		<a style="margin-right: 20px;" href="#description"><i class="fa fa-arrow-circle-down"></i> Описание</a> <a href="#price"><i class="fa fa-arrow-circle-down"></i> Стоимость</a> 
	</div>
	<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px;">
		<h2 style="text-align: left; margin: 15px 0;" id="description">Описание</h2>
		<? echo $desc; ?>
		<h2 style="text-align: left;" id="price">Стоимость</h2>
	</div>
	<? echo $price; ?>
<?
}



add_action( 'admin_post_nopriv_ring', 'ring' );
add_action( 'admin_post_ring', 'ring' );
add_action( 'admin_post_nopriv_priem', 'priem' );
add_action( 'admin_post_priem', 'priem' );
add_action( 'admin_post_nopriv_ask', 'ask' );
add_action( 'admin_post_ask', 'ask' );
add_action( 'admin_post_nopriv_review', 'review' );
add_action( 'admin_post_review', 'review' );

function ring()
{
	$to = 'info@kst-dental.ru';
	$subject = 'Заказ звонка';
	$message = '
Имя пациента: '.$_POST['name'].'<br>
Телефон: '.$_POST['phone'].'<br>
Комментарий: '.$_POST['comment'];
	$headers = array('Content-Type: text/html; charset=UTF-8');
	wp_mail($to, $subject, $message, $headers);
	return true;
}

function priem()
{
	$to = 'info@kst-dental.ru';
	$subject = 'Новая запись на приём';
	$message = '
Имя пациента: '.$_POST['name'].'<br>
Телефон: '.$_POST['phone'].'<br>
Оказанная услуга: '.$_POST['service'].'<br>
Отзыв: '.$_POST['comment'];
	$headers = array('Content-Type: text/html; charset=UTF-8');
	wp_mail($to, $subject, $message, $headers);
	return true;
}

function ask()
{
	$to = 'info@kst-dental.ru';
	$subject = 'Новый вопрос';
	$message = '
Имя отправителя: '.$_POST['name'].'<br>
Телефон: '.$_POST['phone'].'<br>
E-mail: '.$_POST['email'].'<br>
Желаемый доктор: '.$_POST['doc'].'<br>
Вопрос: '.$_POST['comment'];
	$headers = array('Content-Type: text/html; charset=UTF-8');
	wp_mail($to, $subject, $message, $headers);
	return true;
}

function review()
{
	$to = 'info@kst-dental.ru';
	$subject = 'Новый отзыв';
	$message = '
Имя отправителя: '.$_POST['name'].'<br>
Телефон: '.$_POST['phone'].'<br>
Оказанная услуга: '.$_POST['service'].'<br>
Отзыв: '.$_POST['comment'];
	$headers = array('Content-Type: text/html; charset=UTF-8');
	wp_mail($to, $subject, $message, $headers);
	return true;
}
