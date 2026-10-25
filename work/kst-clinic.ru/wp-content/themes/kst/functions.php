<?
add_theme_support('menus');
remove_action( 'wp_head', 'wp_generator' );
add_action('left_sidebar', 'left_sidebar');
add_action('left_sidebar_mobile', 'left_sidebar_mobile');
add_action('left_sidebar_service', 'left_sidebar_service');
add_action('left_sidebar_service_mobile', 'left_sidebar_service_mobile');

add_action('getIcon', 'getIcon');

add_action( 'init', 'register_types' );
add_filter( 'wpseo_xml_sitemap_img', '__return_false' );


function register_types() {

    register_post_type( 'services',
        array(
            'labels' => array(
                'name' => __( 'Услуги' ),
                'menu_name' => __( 'Услуги' ),
                'singular_name' => __( 'Услуги' ),
                'add_new' => __( 'Добавить услугу' ),
                'add_new_item' => __( 'Добавить новую услугу' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать услугу' ),
                'new_item' => __( 'Добавить новую услугу' ),
                'view' => __( 'Просмотр' ),
                'view_item' => __( 'Просмотр' ),
                'search_items' => __( 'Поиск' ),
                'not_found' => __( 'Не найдено' ),
                'not_found_in_trash' => __( 'Не найдено' ),
            ),
            'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
            'taxonomies' => array(),
            'description' => __('Websites to be shown in Resources section.'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'query_var' => true,
            'capability_type' => 'post',
            'menu_position' => 5,
            'has_archive' => true,
            'can_export' => true,
            'hierarchical' => true,
            'rewrite'     => array(
                 'slug'       => 'uslugi', // if you need slug
                 'with_front' => false,
             )
        )
    );

}

// // хук для регистрации таксономии
// add_action( 'init', 'create_taxonomy' );
// function create_taxonomy(){

// 	register_taxonomy( 'taxonomy', [ 'services' ], [ 
// 		'label'                 => '', // определяется параметром $labels->name
// 		'labels'                => [
// 			'name'              => 'Теги',
// 			'singular_name'     => 'Тег',
// 			'search_items'      => 'Поиск тегов',
// 			'all_items'         => 'Все теги',
// 			'view_item '        => 'Посмотреть теги',
// 			'parent_item'       => 'Parent Genre',
// 			'parent_item_colon' => 'Parent Genre:',
// 			'edit_item'         => 'Добавить теги',
// 			'update_item'       => 'Обновить теги',
// 			'add_new_item'      => 'Добавить новый тег',
// 			'new_item_name'     => 'Название нового тега',
// 			'menu_name'         => 'Теги',
// 			'not_found'			  => 'Теги не найдены'
// 		],
// 		'description'           => '', // описание таксономии
// 		'public'                => true,
// 		// 'publicly_queryable'    => null, // равен аргументу public
// 		// 'show_in_nav_menus'     => true, // равен аргументу public
// 		// 'show_ui'               => true, // равен аргументу public
// 		// 'show_in_menu'          => true, // равен аргументу show_ui
// 		// 'show_tagcloud'         => true, // равен аргументу show_ui
// 		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
// 		'hierarchical'          => true,

// 		'rewrite'               => false,
// 		//'query_var'             => $taxonomy, // название параметра запроса
// 		'capabilities'          => array(),
// 		'meta_box_cb'           => 'post_categories_meta_box', // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
// 		'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
// 		'show_in_rest'          => null, // добавить в REST API
// 		'rest_base'             => null, // $taxonomy
// 		// '_builtin'              => false,
// 		//'update_count_callback' => '_update_post_term_count',
// 	] );
// }

function getIcon($args)
{
	$image = get_field('иконка', $args['id']);
	echo $image['url'];
}


function left_sidebar()
{
?>
<div class="col col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
				<button class="btn btn-primary action leftzvonokall" data-toggle="modal" data-target="#zvonok">Заказать звонок</button>
				<button class="btn btn-primary action leftzapisall" data-toggle="modal" data-target="#priem">Запись на приём</button>
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 leftsidebar" id="akcii">
					<span style="display:block; font-weight:bold; text-align: center; font-size: 1.8em; margin: 0.67em 0 0.67em 0; color:#004F6F">Новости и акции</span>
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
							<span style="display:block; font-weight:bold; font-size: 1.07em; margin: 1em 0 1em 0;text-align: center; color:#004F6F""><? echo get_field('заголовок', $post->ID); ?></span>
							<img src="<? echo $image['url']; ?>" alt="<? echo $post->post_title; ?>">
							<p><? echo $desc; ?></p>
						</a>
					</div>
	<? } ?>
					<br>
					<br>
					
					<button class="btn btn-primary action" ><a href="/patients/news/" ><span style="color:#ffffff";>Читать дальше...</span></a></button>
				</div>
	
			</div>
<?
}

function left_sidebar_mobile()
{
?>
<!--<div class="col col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 leftsidebarmobile">
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
			</div>-->
<?
}

function left_sidebar_service()
{
?>
<div class="col col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
<?  ?>
				<button class="btn btn-primary action leftzvonok" data-toggle="modal" data-target="#zvonok">Заказать звонок</button>
				<button class="btn btn-primary action leftzapis" data-toggle="modal" data-target="#priem">Запись на приём</button>
				<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 leftsidebar" id="akcii">
					<span style="display:block; font-weight:bold; text-align: center; font-size: 1.8em; margin: 0.67em 0 0.67em 0; color:#004F6F">Новости и акции</span>
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
							<span style="display:block; font-weight:bold; font-size: 1.07em; margin: 1em 0 1em 0;text-align: center; color:#004F6F""><? echo $post->post_title; ?></span>
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
	foreach ($posts_array as $key=>$post) { ?>
		<a href="<? echo get_post_permalink($post->ID); ?>" class="list-group-item list-group-item-action <? if ($post->ID == get_the_ID()) echo 'active'; ?>">
  		<? echo $post->post_title; ?>
    </a>
	<? } ?>
	</div>
	</div>
</div>
<?
}

function left_sidebar_service_mobile()
{
?>
<!--<div class="col col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 leftsidebarmobile">
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
</div>-->
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
		<img src="<? echo $photo['url']; ?>" alt="<? echo $photo['alt']; ?>" class="alignleft" style="width: 100%;">
	</div>
	<div class="col col-12 col-sm-8 col-md-7 col-lg-7 col-xl-7">
		<h1 style="font-size: 24px; text-align: left;"><? echo $last; ?> <? echo $name; ?> <? echo $father; ?></h1>
		<p style="color: #008080;"><? echo $spec; ?></p>
		<button class="btn btn-primary action doctorzapis" data-toggle="modal" data-target="#priem" style="width: 300px; padding: 10px; margin-top: 15px; margin-bottom: 30px;" onclick="$('select[name=\'doc\']').val('<? echo $last; ?> <? echo $name; ?> <? echo $father; ?>');">Запись на приём</button>
		<button class="btn btn-primary action" data-toggle="modal" data-target="#otziv" style="width: 300px; padding: 10px;" onclick="$('select[name=\'doc\']').val('<? echo $last; ?> <? echo $name; ?> <? echo $father; ?>');">Оставить отзыв</button>
		<? echo $short; ?>
		<a href="#" data-toggle="modal" data-target="#detail">Читать полностью</a>
		<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="detailLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<p class="modal-title" id="detailLabel" style="color: #008080; font-size: 20px;"><? echo $last; ?> <? echo $name; ?> <? echo $father; ?>
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
<h3>
	Отзывы пациентов
</h3>
<? $args2 = array( 'posts_per_page'   => 999, 'category_name' => 'reviews_1');
	$posts_array = get_posts( $args2 );
	foreach ($posts_array as $key=>$post)
	{
		$serv = get_field('услуги', $post->ID);
		$doc = get_field('врач', $post->ID);
		if ($doc->ID == $args['id']) {
?>
		<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px; margin-top: 30px; margin-bottom: 10px; position: relative;">
			<h4 style="text-align: left; color: #000;"><em><? echo $post->post_title; ?><!--<span style="text-align: right; color: #aaa; padding-left: 20px; font-size: .8rem;"><? echo $post->post_date; ?></span>--></em></h4>
			<? echo $post->post_content; ?>
			<div style="height: 0px; width: 100%; border-top: 1px solid #008080; padding-left: 10px; margin-bottom:30px; margin-top: 30px;"></div>
			<!--<h5 style="text-align: left; color: #000; margin-top: 20px; font-weight: bold;">Оказанные услуги</h5>
			<? echo $serv; ?>-->
		</div>
<?  }
} ?>
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
					<h5 style="color:#008080;"><? echo $last; ?> <? echo $name; ?> <? echo $father; ?></h5>
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
							<td style="height: 150px;"><p style="text-align: center; font-size: 14px; color: #008080;"><? echo $title; ?></p></td>
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
	$call_value = $_POST['call_value']; /* ID сессии Calltouch, полученный из JS-переменной, и отправленный в обработчик на сервере */
	$ct_node_id = '8';
	$ct_site_id = '27439';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded;charset=utf-8"));
	curl_setopt($ch, CURLOPT_URL,'https://api-node'.$ct_node_id.'.calltouch.ru/calls-service/RestAPI/requests/'.$ct_site_id.'/register/');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
		"fio=".urlencode($_POST['name'])
		."&phoneNumber=".$_POST['phone']
		."&comment=".$_POST['comment']
		."&subject=".urlencode('Заказ звонка')
		."".($call_value != 'undefined' ? "&sessionId=".$call_value_1366504378 : ""));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$calltouch = curl_exec ($ch);
	curl_close ($ch);
	
	
	
	$to = 'zaoksmt@yandex.ru, info@kst-clinic.ru';
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
	$call_value = $_POST['call_value']; /* ID сессии Calltouch, полученный из JS-переменной, и отправленный в обработчик на сервере */
	$ct_node_id = '8';
	$ct_site_id = '27439';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded;charset=utf-8"));
	curl_setopt($ch, CURLOPT_URL,'https://api-node'.$ct_node_id.'.calltouch.ru/calls-service/RestAPI/requests/'.$ct_site_id.'/register/');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
		"fio=".urlencode($_POST['name'])
		."&phoneNumber=".$_POST['phone']
		."&service=".$_POST['service']
		."&comment=".$_POST['comment']
		."&subject=".urlencode('Новая запись на приём')
		."".($call_value != 'undefined' ? "&sessionId=".$call_value_1366504378 : ""));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$calltouch = curl_exec ($ch);
	curl_close ($ch);
	
	$to = 'zaoksmt@yandex.ru, info@kst-clinic.ru, sabalek@mail.ru';
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
	$call_value = $_POST['call_value']; /* ID сессии Calltouch, полученный из JS-переменной, и отправленный в обработчик на сервере */
	$ct_node_id = '8';
	$ct_site_id = '27439';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded;charset=utf-8"));
	curl_setopt($ch, CURLOPT_URL,'https://api-node'.$ct_node_id.'.calltouch.ru/calls-service/RestAPI/requests/'.$ct_site_id.'/register/');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
		"fio=".urlencode($_POST['name'])
		."&phoneNumber=".$_POST['phone']
		."&email=".$_POST['email']
		."&doctor=".$_POST['doc']
		."&question=".$_POST['question']
		."&comment=".$_POST['comment']
		."&subject=".urlencode('Новый вопрос')
		."".($call_value != 'undefined' ? "&sessionId=".$call_value_1366504378 : ""));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$calltouch = curl_exec ($ch);
	curl_close ($ch);
	
	$to = 'zaoksmt@yandex.ru, info@kst-clinic.ru, sabalek@mail.ru';
	$subject = 'Новый вопрос';
	$message = '
Имя отправителя: '.$_POST['name'].'<br>
Телефон: '.$_POST['phone'].'<br>
E-mail: '.$_POST['email'].'<br>
Желаемый доктор: '.$_POST['doc'].'<br>
Кратко: '.$_POST['question'].'<br>
Вопрос: '.$_POST['comment'];
	$headers = array('Content-Type: text/html; charset=UTF-8');
	wp_mail($to, $subject, $message, $headers);
	return true;
}

function review()
{
	$call_value = $_POST['call_value']; /* ID сессии Calltouch, полученный из JS-переменной, и отправленный в обработчик на сервере */
	$ct_node_id = '8';
	$ct_site_id = '27439';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded;charset=utf-8"));
	curl_setopt($ch, CURLOPT_URL,'https://api-node'.$ct_node_id.'.calltouch.ru/calls-service/RestAPI/requests/'.$ct_site_id.'/register/');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
		"fio=".urlencode($_POST['name'])
		."&phoneNumber=".$_POST['phone']
		."&service=".$_POST['service']
		."&comment=".$_POST['comment']
		."&subject=".urlencode('Новый отзыв')
		."".($call_value != 'undefined' ? "&sessionId=".$call_value_1366504378 : ""));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$calltouch = curl_exec ($ch);
	curl_close ($ch);
	
	$to = 'info@kst-clinic.ru, sabalek@mail.ru, indalo2004@mail.ru';
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
function micro_image ($content) {
global $post;
$pattern = "<img";
$replacement = '<img itemprop="url image" itemprop="url contentUrl"';
$content = str_replace ($pattern, $replacement, $content);
return $content;
}
add_filter ('the_content', 'micro_image');

function htmlhook_img__figure($val, $attr, $content = null)
{
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> '',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $val;

	$capid = '';
	if ( $id ) {
		$id = esc_attr($id);
		$capid = 'id="figcaption_'. $id . '" ';
		$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
	}

    $images = get_children ( array(
		'post_mime_type' => 'image',
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment'
    ));

foreach ( $images as $images_id => $attachment )
        $metadata = wp_get_attachment_image_src($images_id, false);
  	    $height = ($metadata[2]);

	return '<figure itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject" ' . $id . '
	class="wp-caption ' . esc_attr($align) . '" style="width: ' . (int) $width . 'px">' . do_shortcode( $content ) . '
		<meta itemprop="width" content="' . (int) $width . '">
		<meta itemprop="height" content="' . $height . '">
		<meta itemprop="name" content="' . $caption . '">
	<figcaption itemprop="caption description" ' . $capid . 'class="wp-caption-text">' . $caption . '</figcaption>
	</figure>';
}

add_filter('img_caption_shortcode', 'htmlhook_img__figure', 10, 3);




class magomra_walker_nav_menu extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-menu',
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
			);
		$class_names = implode( ' ', $classes );

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	// add main/sub classes to li's and links
	 function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		global $post; //var_dump($post);
		if ($post->ID == $item->object_id) $output .= $indent . '<li class="nav-item active ' . $depth_class_names . ' ' . $class_names . '">';
		else if ($post->ID == 1144 && $item->object_id == 7) $output .= $indent . '<li class="nav-item active ' . $depth_class_names . ' ' . $class_names . '">';
		else $output .= $indent . '<li class="nav-item ' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		//var_dump($item);
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="menu-link nav-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// И там, где нужно выводим меню так:
function magomra_nav_menu( $menu_id ) {
	// main navigation menu
	$args = array(
		'theme_location'    => 'navigation_menu_primary',
		'container'     => 'false',
		'echo'          => true,
		'items_wrap'        => '%3$s',
		'depth'         => 10,
		'walker'        => new magomra_walker_nav_menu,
		'menu' => $menu_id
	);

	// print menu
	wp_nav_menu( $args );
}

add_action('get_sub_posts', 'get_sub_posts');

function get_sub_posts($page_id=NULL) {
    $posts = get_field('теги', $page_id);
    if ($posts) {
	echo '<div class="tags">';
      echo '<div class="tags-title">Статьи по тегам:</div>';
      echo '<ul> ';
      foreach ($posts as $post_tag) {
        $url = esc_url(get_permalink($post_tag['статья']->ID));
        echo '<li> <a href="'.$url.'">'.$post_tag['статья']->post_title.'</a> </li>';
      }
      echo '</ul> ';
      echo '</div>';
    }
/*if (!empty($page_id)) {
    // Set up the objects needed
    $my_wp_query = new WP_Query();
    $all_wp_pages = $my_wp_query->query(array('post_type' => 'services', 'posts_per_page' => '-1'));

    // Get the page as an Object
    //$portfolio =  get_page_by_title('Portfolio');

    // Filter through all pages and find Portfolio's children
    $post_tags = get_page_children($page_id, $all_wp_pages);

    if (!empty($post_tags)) {
      foreach ($post_tags as $key => $post_tag) {
        if ($post_tag->post_parent != $page_id || empty($post_tag->post_content)) {
          unset($post_tags[$key]);
        }
      }
    }

    // echo what we get back from WP to the browser
    if (!empty($post_tags)) {
      echo '<div class="tags">';
      echo '<div class="tags-title">Статьи по тегам:</div>';
      echo '<ul> ';
      foreach ($post_tags as $post_tag) {
        $url = esc_url(get_permalink($post_tag));
        echo '<li> <a href="'.$url.'">'.$post_tag->post_title.'</a> </li>';
      }
      echo '</ul> ';
      echo '</div>';
    }
  }
*/
}




add_filter( 'pre_get_posts', 'tgm_io_cpt_search' );

function tgm_io_cpt_search( $query ) {
	//var_dump($query);
    if ( $query->is_search ) {
	//$query->set( 'post_type', array( 'post', 'page', 'services' ) );
    }

    //return $query;

}








add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);
function codeless_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

