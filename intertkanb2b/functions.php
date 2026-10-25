<?
add_theme_support('menus');
add_theme_support('widgets');
add_theme_support('post-thumbnails');

add_action( 'init', 'register_types' );


function register_types() {
    pll_register_string('Зарегистрироваться сейчас', 'register_now');
    pll_register_string('Преимущества участия', 'preim');
    pll_register_string('Заполните форму и станьте участником', 'p1');
    pll_register_string('все поля обязательны для заполнения', 'p2');
    pll_register_string('Название компании', 'p3');
    pll_register_string('Контактное лицо', 'p4');
    pll_register_string('Телефон', 'p5');
    pll_register_string('E-mail', 'p6');
    pll_register_string('Из какого источника получили информацию о мероприятии', 'p7');
    pll_register_string('Стать участником', 'p8');
    pll_register_string('Отзывы', 'p9');
    pll_register_string('Новости', 'p10');
    pll_register_string('Читать далее', 'p11');

    pll_register_string('ВАШ ЭЛЕКТРОННЫЙ БИЛЕТ', 't1');
    pll_register_string('ВНИМАНИЕ! Вход на выставку только для специалистов', 't2');
    pll_register_string('ПОСЕТИТЕЛЬ', 't3');
    pll_register_string('ПЕРСОНАЛЬНЫЙ ШТРИХ-КОД', 't4');
    pll_register_string('ВНИМАНИЕ! Электронный билет продаже не подлежит', 't5');
    pll_register_string('НАЗВАНИЕ ВЫСТАВКИ', 't6');
    pll_register_string('ДАТЫ ПРОВЕДЕНИЯ', 't7');
    pll_register_string('ПАВИЛЬОНЫ', 't8');
    pll_register_string('Организаторы', 't9');
    pll_register_string('ДАТА И ВРЕМЯ СОЗДАНИЯ ЭЛЕКТРОННОГО БИЛЕТА', 't10');
    pll_register_string('ЦВК «Экспоцентр», 123100, Россия, Москва, Краснопресненская наб., 14', 't11');
    pll_register_string('Схема проезда на ЦВК и время работы выставки размещены на сайте: www.expocentr.ru', 't12');
    pll_register_string('Деловая программа: www.intertkan.ru/legpromforum', 't13');
    pll_register_string('Для входа в выставочный комплекс необходимо:', 't14');
    pll_register_string('На стойке онлайн-регистрации предъявить оператору билет для сканирования штрихкода;', 't15');
    pll_register_string('Получить Ваш персональный именной бейдж посетителя выставки.', 't16');
    pll_register_string('Популярное', 'popular');
    pll_register_string('', 't18');


    register_post_type( 'slider',
        array(
            'labels' => array(
                'name' => __( 'Слайдер' ),
				'menu_name' => __( 'Слайдер' ),
                'singular_name' => __( 'Слайдер' ),
                'add_new' => __( 'Добавить слайд' ),
                'add_new_item' => __( 'Добавить новый слайд' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать слайд' ),
                'new_item' => __( 'Добавить новый слайд' ),
                'view' => __( 'Просмотр' ),
                'view_item' => __( 'Просмотр' ),
                'search_items' => __( 'Поиск' ),
                'not_found' => __( 'Не найдено' ),
                'not_found_in_trash' => __( 'Не найдено' ),
            ),
			'supports' => array( 'title', 'editor', 'thumbnail'),
            'description' => __('Websites to be shown in Resources section.'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 5,
			'has_archive' => true,
            'can_export' => true,
			'rewrite'     => array(
                 'slug'       => 'slider', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'gallery',
        array(
            'labels' => array(
                'name' => __( 'Галерея' ),
                'menu_name' => __( 'Галерея' ),
                'singular_name' => __( 'Галерея' ),
                'add_new' => __( 'Добавить альбом' ),
                'add_new_item' => __( 'Добавить новый альбом' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать альбом' ),
                'new_item' => __( 'Добавить новый альбом' ),
                'view' => __( 'Просмотр' ),
                'view_item' => __( 'Просмотр' ),
                'search_items' => __( 'Поиск' ),
                'not_found' => __( 'Не найдено' ),
                'not_found_in_trash' => __( 'Не найдено' ),
            ),
            'supports' => array( 'title', 'editor', 'thumbnail'),
            'description' => __('Websites to be shown in Resources section.'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 5,
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'gallery', // if you need slug
                 'with_front' => false,
             )
        )
    );

    $labels = array(
        'name'              => _x( 'Категории', 'taxonomy general name' ),
        'singular_name'     => _x( 'Категория', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'participant_category' ),
    );

    
    register_taxonomy( 'participant_category', array( 'participant_category' ), $args );
    register_post_type( 'participants',
        array(
            'labels' => array(
                'name' => __( 'Участники' ),
                'menu_name' => __( 'Участники' ),
                'singular_name' => __( 'Участник' ),
                'add_new' => __( 'Добавить участника' ),
                'add_new_item' => __( 'Добавить нового участника' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать участника' ),
                'new_item' => __( 'Добавить нового участника' ),
                'view' => __( 'Просмотр' ),
                'view_item' => __( 'Просмотр' ),
                'search_items' => __( 'Поиск' ),
                'not_found' => __( 'Не найдено' ),
                'not_found_in_trash' => __( 'Не найдено' ),
            ),
            'supports' => array( 'title', 'editor', 'thumbnail'),
            'description' => __('Websites to be shown in Resources section.'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 5,
            'has_archive' => true,
            'can_export' => true,
            'taxonomies' => array( 'participant_category' ),
            'rewrite'     => array(
                 'slug'       => 'participants', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'reviews',
        array(
            'labels' => array(
                'name' => __( 'Отзывы' ),
                'menu_name' => __( 'Отзывы' ),
                'singular_name' => __( 'Отзыв' ),
                'add_new' => __( 'Добавить отзыв' ),
                'add_new_item' => __( 'Добавить новый отзыв' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать отзыв' ),
                'new_item' => __( 'Добавить новый отзыв' ),
                'view' => __( 'Просмотр' ),
                'view_item' => __( 'Просмотр' ),
                'search_items' => __( 'Поиск' ),
                'not_found' => __( 'Не найдено' ),
                'not_found_in_trash' => __( 'Не найдено' ),
            ),
            'supports' => array( 'title', 'editor', 'thumbnail'),
            'description' => __('Websites to be shown in Resources section.'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 5,
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'reviews', // if you need slug
                 'with_front' => false,
             )
        )
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'info_category' ),
    );

    
    register_taxonomy( 'info_category', array( 'info_category' ), $args );
    register_post_type( 'info',
        array(
            'labels' => array(
                'name' => __( 'Инфо' ),
                'menu_name' => __( 'Инфо' ),
                'singular_name' => __( 'Инфо' ),
                'add_new' => __( 'Добавить инфо' ),
                'add_new_item' => __( 'Добавить новое инфо' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать инфо' ),
                'new_item' => __( 'Добавить новое инфо' ),
                'view' => __( 'Просмотр' ),
                'view_item' => __( 'Просмотр' ),
                'search_items' => __( 'Поиск' ),
                'not_found' => __( 'Не найдено' ),
                'not_found_in_trash' => __( 'Не найдено' ),
            ),
            'supports' => array( 'title', 'editor', 'thumbnail'),
            'description' => __('Websites to be shown in Resources section.'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 5,
            'has_archive' => true,
            'can_export' => true,
            'taxonomies' => array( 'info_category' ),
            'rewrite'     => array(
                 'slug'       => 'info', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'tickets',
        array(
            'labels' => array(
                'name' => __( 'Билеты' ),
                'menu_name' => __( 'Билеты' ),
                'singular_name' => __( 'Билеты' ),
                'add_new' => __( 'Добавить билет' ),
                'add_new_item' => __( 'Добавить нового участника' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать билет' ),
                'new_item' => __( 'Добавить нового билета' ),
                'view' => __( 'Просмотр' ),
                'view_item' => __( 'Просмотр' ),
                'search_items' => __( 'Поиск' ),
                'not_found' => __( 'Не найдено' ),
                'not_found_in_trash' => __( 'Не найдено' ),
            ),
            'supports' => array( 'title', 'editor', 'thumbnail'),
            'description' => __('Websites to be shown in Resources section.'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 5,
            'has_archive' => true,
            'can_export' => true,
            'taxonomies' => array( 'participant_category' ),
            'rewrite'     => array(
                 'slug'       => 'tickets', // if you need slug
                 'with_front' => false,
             )
        )
    );
}

function register_participant() {
    //var_dump($_POST);
    $categ = array();
    foreach ($_POST['categ'] as $key=>$val) $categ[] = $key;

    $post_data = array(
        'post_title'    => wp_strip_all_tags( $_POST['company_name'] ),
        'post_content'  => '',
        'post_status'   => 'draft',
        'post_author'   => 1,
        'post_type'     => 'participants',
        'tax_input'      => array( 'participant_category' => $categ ),
    );

    $post_id = wp_insert_post( $post_data );

    update_field( 'тип_деятельности', $_POST['type_deal'], $post_id );
    update_field( 'контактное_лицо', $_POST['contact_pers'], $post_id );
    update_field( 'должность', $_POST['dolzn'], $post_id );
    update_field( 'телефон', $_POST['phone'], $post_id );
    update_field( 'e-mail', $_POST['email'], $post_id );
    update_field( 'cайт', $_POST['site'], $post_id );
    update_field( 'источник', $_POST['source'], $post_id );
    $to = 'forum@souzlegprom.ru';
    $subject = 'Заявка на участие';
    $body = '
<table>
<tr>
<td>Название компании</td>
<td>'.$_POST['company_name'].'</td>
</tr>
<tr>
<td>Контактное лицо</td>
<td>'.$_POST['contact_pers'].'</td>
</tr>
<tr>
<td>Должность</td>
<td>'.$_POST['dolzn'].'</td>
</tr>
<tr>
<td>Телефон</td>
<td>'.$_POST['phone'].'</td>
</tr>
<tr>
<td>E-mail</td>
<td>'.$_POST['email'].'</td>
</tr>
</table>
Отредактировать участника можно по этой <a href="http://b2b.aliveliyev.com/wp-admin/post.php?post='.$post_id.'&action=edit">ссылке</a>.
    ';
    $headers = array('Content-Type: text/html; charset=UTF-8');
     
    wp_mail( $to, $subject, $body, $headers );

    if ($_POST['lang'] == 'ru')  wp_redirect( '/спасибо-за-регистрацию/');
    else wp_redirect( '/thanks/');
}

function getticket() {
    //var_dump($_POST);
    $categ = array();
    foreach ($_POST['categ'] as $key=>$val) $categ[] = $key;

    $post_data = array(
        'post_title'    => wp_strip_all_tags( $_POST['surname'].' '.$_POST['name'].' '.$_POST['patro']),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'tickets',
        'tax_input'      => array( 'participant_category' => $categ ),
    );

    $post_id = wp_insert_post( $post_data );

    update_field( 'имя', $_POST['name'], $post_id );
    update_field( 'фамилия', $_POST['surname'], $post_id );
    update_field( 'отчество', $_POST['patro'], $post_id );
    update_field( 'телефон', $_POST['phone'], $post_id );
    update_field( 'e-mail', $_POST['email'], $post_id );
    update_field( 'тип_деятельности', $_POST['type_deal'], $post_id );
    update_field( 'компания', $_POST['company_name'], $post_id );
    update_field( 'cайт', $_POST['site'], $post_id );
    update_field( 'источник', $_POST['source'], $post_id );
    update_field( 'hash', md5($_POST['email']), $post_id );



    $to = $_POST['email'];
    $subject = 'Новый участник';
    $body = '<p>Уважаемый посетитель!</p>
<p>Благодарим Вас за регистрацию на текстильную торговую сессию "Интерткань.B2B"</p>
<p>Вы можете скачать Ваш электронный билет по <a href="'.get_site_url().'/электронный-билет/?h='.md5($_POST['email']).'">ссылке</a>.</p>
<p>Распечатайте данный электронный билет с уникальным кодом посетителя и обменяйте его
на стойке регистрации на именной бейдж для посещения мероприятия 5-6 сентября 2018г. </p>
 
 
<p>С уважением,</p>
<p>Команда организаторов "Интерткань.B2B"</p>';
    $headers = array('Content-Type: text/html; charset=UTF-8');
     
    wp_mail( $to, $subject, $body, $headers );
    $to = 'info@souzlegprom.ru';
    $subject = 'Заявка от посетителя';
    $body = '<p>Зарегистрировался новый посетитель. Электронный билет по <a href="'.get_site_url().'/электронный-билет/?h='.md5($_POST['email']).'">ссылке</a>.</p>';
    wp_mail( $to, $subject, $body, $headers );

    //if (pll_current_language() == 'ru') 
    if ($_POST['lang'] == 'ru') wp_redirect( '/электронный-билет/?h='.md5($_POST['email']) );
    else wp_redirect( '/e-ticket/?h='.md5($_POST['email']) );
}


add_action( 'admin_post_nopriv_register_participant', 'register_participant' );
add_action( 'admin_post_register_participant', 'register_participant' );

add_action( 'admin_post_nopriv_getticket', 'getticket' );
add_action( 'admin_post_getticket', 'getticket' );

?>