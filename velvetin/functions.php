<?
add_theme_support('menus');
add_theme_support('widgets');
add_theme_support('post-thumbnails');
add_action( 'init', 'register_types' );
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function register_types() {
    $labels = array(
        'name'              => _x( 'Коллекции', 'taxonomy general name' ),
        'singular_name'     => _x( 'Коллекции', 'taxonomy singular name' ),
        'search_items'      => __( 'Поиск коллекций' ),
        'all_items'         => __( 'Все коллекции' ),
        'parent_item'       => __( 'Родительская коллекция' ),
        'parent_item_colon' => __( 'Родительская коллекция:' ),
        'edit_item'         => __( 'Редактировать коллекцию' ),
        'update_item'       => __( 'Обновить коллекцию' ),
        'add_new_item'      => __( 'Добавить новую коллекцию' ),
        'new_item_name'     => __( 'Имя новой коллекции' ),
        'menu_name'         => __( 'Коллекции' ),
    );
    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'kollekczii' ),
    );

    register_taxonomy( 'product_col', array( 'product_col' ), $args );

    register_taxonomy_for_object_type( 'product_col', 'product', $args );

    register_post_type( 'promotions',
        array(
            'labels' => array(
                'name' => __( 'Акции' ),
                'menu_name' => __( 'Акции' ),
                'singular_name' => __( 'Акция' ),
                'add_new' => __( 'Добавить акцию' ),
                'add_new_item' => __( 'Добавить новую акцию' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать акцию' ),
                'new_item' => __( 'Добавить новую акцию' ),
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
                 'slug'       => 'akcii',
                 'with_front' => false,
            )
        )
    );

    register_post_type( 'smi',
        array(
            'labels' => array(
                'name' => __( 'СМИ о нас' ),
                'menu_name' => __( 'СМИ о нас' ),
                'singular_name' => __( 'Новость' ),
                'add_new' => __( 'Добавить новость' ),
                'add_new_item' => __( 'Добавить новую новость' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать новость' ),
                'new_item' => __( 'Добавить новую новость' ),
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
                 'slug'       => 'smi-o-nas',
                 'with_front' => false,
            )
        )
    );

    register_post_type( 'collections',
        array(
            'labels' => array(
                'name' => __( 'Звездные коллекции' ),
                'menu_name' => __( 'Звездные коллекции' ),
                'singular_name' => __( 'Коллекция' ),
                'add_new' => __( 'Добавить коллекцию' ),
                'add_new_item' => __( 'Добавить новую коллекцию' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать коллекцию' ),
                'new_item' => __( 'Добавить новую коллекцию' ),
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
                 'slug'       => 'zvyozdnye-kollekcii',
                 'with_front' => false,
            )
        )
    );

    register_post_type( 'clients',
        array(
            'labels' => array(
                'name' => __( 'Звездные клиенты' ),
                'menu_name' => __( 'Звездные клиенты' ),
                'singular_name' => __( 'Звездные клиенты' ),
                'add_new' => __( 'Добавить клиента' ),
                'add_new_item' => __( 'Добавить нового клиента' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать клиента' ),
                'new_item' => __( 'Добавить нового клиента' ),
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
                 'slug'       => 'zvyozdnye-klienty',
                 'with_front' => false,
            )
        )
    );

    register_post_type( 'reviews',
        array(
            'labels' => array(
                'name' => __( 'Отзывы' ),
                'menu_name' => __( 'Отзывы' ),
                'singular_name' => __( 'Отзывы' ),
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
                 'slug'       => 'reviews',
                 'with_front' => false,
            )
        )
    );

}
add_filter( 'loop_shop_per_page', function ( $cols ) {
    return 12;
}, 20 );

function get_menu_array($name) {
    $result = array();
    $menu = wp_get_nav_menu_items($name);
    foreach ($menu as $element) {
        $element->child_elements = array();
        if ($element->menu_item_parent == 0) {
            $result[$element->ID] = $element;
        }
        else {
            $flag = 0;
            foreach ($result as $element2) {
                foreach ($element2->child_elements as $element3) {
                    if ($element3->ID == $element->menu_item_parent) {
                        $flag = 1;
                        $result[$element2->ID]->child_elements[$element3->ID]->child_elements[] = $element;
                        break;
                    }
                }
                if ($flag == 1) break;
            }
            if ($flag == 0) $result[$element->menu_item_parent]->child_elements[$element->ID] = $element;
        }
    }

    return $result;
}

function create_product_variation( $product_id, $variation_data ){
    // Get the Variable product object (parent)
    $product = wc_get_product($product_id);

    $variation_post = array(
        'post_title'  => $variation_data['title'],
        'post_name'   => 'product-'.$product_id.'-variation',
        'post_status' => 'publish',
        'post_parent' => $product_id,
        'post_type'   => 'product_variation',
        'guid'        => $product->get_permalink()
    );

    // Creating the product variation
    $variation_id = wp_insert_post( $variation_post );

    // Get an instance of the WC_Product_Variation object
    $variation = new WC_Product_Variation( $variation_id );

    // Iterating through the variations attributes
    $attributes_array = array();
    
    foreach ($variation_data['attributes'] as $attribute => $term_name )
    {
        $taxonomy = 'pa_'.$attribute; // The attribute taxonomy

        $attributes_array[$taxonomy] = array(
            'name' => $taxonomy,
            'value' => '',
            'is_visible' => '1',
            'is_variation' => '1',
            'is_taxonomy' => '1'       
        );
/*
        // Check if the Term name exist and if not we create it.
        if( ! term_exists( $term_name, $taxonomy ) )
            wp_insert_term( $term_name, $taxonomy ); // Create the term

        $term_slug = get_term_by('name', $term_name, $taxonomy )->slug; // Get the term slug

        // Get the post Terms names from the parent variable product.
        $post_term_names =  wp_get_post_terms( $product_id, $taxonomy, array('fields' => 'names') );

        // Check if the post term exist and if not we set it in the parent variable product.
        if( ! in_array( $term_name, $post_term_names ) )
            wp_set_post_terms( $product_id, $term_name, $taxonomy, true );

        // Set/save the attribute data in the product variation
        update_post_meta( $variation_id, 'attribute_'.$taxonomy, $term_slug );
*/
        $term = get_term_by('name', $term_name, $taxonomy);
        if (!$term) {
            $nt = wp_insert_term($term_name, $taxonomy);
            //var_dump($nt);
            $erm = get_term_by('term_id', $nt['term_id'], $taxonomy);
            $trm = $erm->slug;
        }
        else $trm = $term->slug;
        //var_dump($trm);

        wp_set_post_terms( $product_id, $term_name, $taxonomy, true );

        add_post_meta($variation_id, 'attribute_'.$taxonomy, $trm);
    }
    update_post_meta( $product_id, '_product_attributes', $attributes_array );

    ## Set/save all other data

    // SKU
    if( ! empty( $variation_data['sku'] ) )
        $variation->set_sku( $variation_data['sku'] );

    // Prices
    if( empty( $variation_data['sale_price'] ) ){
        $variation->set_price( $variation_data['regular_price'] );
    } else {
        $variation->set_price( $variation_data['sale_price'] );
        $variation->set_sale_price( $variation_data['sale_price'] );
    }
    $variation->set_regular_price( $variation_data['regular_price'] );

    // Stock
    if( ! empty($variation_data['stock_qty']) ){
        $variation->set_stock_quantity( $variation_data['stock_qty'] );
        $variation->set_manage_stock(false);
        $variation->set_stock_status('instock');
    } else {
        $variation->set_manage_stock(false);
    }

    $variation->set_weight(''); // weight (reseting)

    $variation->save(); // Save the data
}

function import_product_data() {
    $name = $_REQUEST['name'];
    $title = $_REQUEST['title'];
    $sku = $_REQUEST['sku'];
    $vid = $_REQUEST['vid'];
    $photo = $_REQUEST['photo'];
    $photo2 = $_REQUEST['photo2'];
    $collection = $_REQUEST['collection'];
    $category = $_REQUEST['category'];
    $metall = str_replace(',', ';', $_REQUEST['metall']);
    $vstavki = str_replace(',', ';', $_REQUEST['vstavki']);
    $price = $_REQUEST['price'];

    if ($_REQUEST['type'] == 'product') {
        $post_data = array(
            'post_title'    => $title,
            'post_type'  => 'product',
            'post_status'   => 'publish',
            'post_content' => ''
        );
        $product_id = wp_insert_post( $post_data );
        add_post_meta($product_id, '_regular_price', $price);
        add_post_meta($product_id, '_price', $price);
        add_post_meta($product_id, '_sku', $sku);
        add_post_meta($product_id, '_manage_stock', 'no');
        add_post_meta($product_id, '_backorders', 'no');
        add_post_meta($product_id, '_sold_individually', 'no');
        add_post_meta($product_id, '_virtual', 'no');
        add_post_meta($product_id, '_downloadable', 'no');
        add_post_meta($product_id, '_download_limit', '-1');
        add_post_meta($product_id, '_download_expiry', '-1');

        wp_set_object_terms($product_id, 'variable', 'product_type');

        $term = get_term_by('name', $category, 'product_cat');
        if (!$term) {
            $nt = wp_insert_term($category, 'product_cat');
            $trm = $nt['term_id'];
        }
        else $trm = $term->term_id;
        wp_set_object_terms($product_id, $trm, 'product_cat');

        if ($collection != NULL) {
        $term = get_term_by('name', $collection, 'product_col');
            if (!$term) {
                $nt = wp_insert_term($collection, 'product_col');
                $trm = $nt['term_id'];
            }
            else $trm = $term->term_id;
            wp_set_object_terms($product_id, $trm, 'product_col');
        }
//var_dump($photo);
        $imgs = array();
        $tmp = download_url( $photo );
        $file_array = [
            'name'     => basename( explode('?', $photo)[0]  ),
            'tmp_name' => $tmp
        ];
        $id = media_handle_sideload( $file_array, 0 );
        if (is_int($id)) $imgs[] = $id;

        if ($photo2 != '') {
            $tmp = download_url( $photo2 );
            $file_array = [
                'name'     => basename( explode('?', $photo2)[0] ),
                'tmp_name' => $tmp
            ];
            $id = media_handle_sideload( $file_array, 0 );
            if (is_int($id)) $imgs[] = $id;
        }

        $images = implode(',', $imgs);
        add_post_meta($product_id, '_product_image_gallery', $images);
        add_post_meta($product_id, '_thumbnail_id', $imgs[0]);

        $variation_data =  array(
            'attributes' => array(
                'ispolnenie' => $vid,
                'metall'  => $metall,
                'vstavki' => $vstavki,
            ),
            'title' => $title,
            'sku'           => $sku,
            'regular_price' => $price,
            'sale_price'    => '',
            'stock_qty'     => 10,
        );

        update_post_meta($product_id, 'kratkoe_nazvanie', $name);
        update_post_meta($product_id, '_kratkoe_nazvanie', 'field_5ec870341cc56');

        create_product_variation( $product_id, $variation_data );

        /*$post_data = array(
            'post_title'    => $title,
            'post_type'  => 'product_variation',
            'post_status'   => 'publish',
            'post_parent'   => $product_id,
            'post_content' => ''
        );
        $variation_id = wp_insert_post( $post_data );
        add_post_meta($variation_id, '_regular_price', $price);
        add_post_meta($variation_id, '_price', $price);
        add_post_meta($variation_id, '_sku', $sku);

        $term = get_term_by('name', $vid, 'pa_ispolnenie');
        if (!$term) {
            $nt = wp_insert_term($vid, 'pa_ispolnenie');
            $trm = $nt['slug'];
        }
        else $trm = $term->slug;
        add_post_meta($variation_id, 'attribute_pa_ispolnenie', $trm);

        $term = get_term_by('name', $metall, 'pa_metall');
        if (!$term) {
            $nt = wp_insert_term($metall, 'pa_metall');
            $trm = $nt['slug'];
        }
        else $trm = $term->slug;
        add_post_meta($variation_id, 'attribute_pa_metall', $trm);

        $term = get_term_by('name', $vstavki, 'pa_vstavki');
        if (!$term) {
            $nt = wp_insert_term($vstavki, 'pa_vstavki');
            $trm = $nt['slug'];
        }
        else $trm = $term->slug;
        add_post_meta($variation_id, 'attribute_pa_vstavki', $trm);*/

        echo $product_id;
    }
    else {
        $product_id = $_REQUEST['product_id'];
        $variation_data =  array(
            'attributes' => array(
                'ispolnenie' => $vid,
                'metall'  => $metall,
                'vstavki' => $vstavki,
            ),
            'title' => $title,
            'sku'           => $sku,
            'regular_price' => $price,
            'sale_price'    => '',
            'stock_qty'     => 10,
        );
        create_product_variation( $product_id, $variation_data );
        echo $product_id;
    }
    exit();
}

add_action('wp_ajax_import_product_data', 'import_product_data');
add_action('wp_ajax_nopriv_import_product_data', 'import_product_data');

function update_product_data() {
    $deti = $_REQUEST['ch'];
    $sku = $_REQUEST['sku'];
    //$photo = $_REQUEST['photo'];
    //$photo2 = $_REQUEST['photo2'];
    
    $product_id = wc_get_product_id_by_sku($sku);
    if ($deti == 1) $trm = "1-rebyonok";
    else if ($deti == 2) $trm = "2-rebyonka";
    else $trm = "3-rebyonka-i-bolee";
    wp_set_object_terms($product_id, $trm, 'product_col');

//var_dump($product_id);
    /*$thumb = get_post_meta($product_id, '_thumbnail_id');
    //if (!$thumb[0]) {
        $imgs = array();
        $tmp = download_url( $photo );
        $file_array = [
            'name'     => basename( explode('?', $photo)[0]  ),
            'tmp_name' => $tmp
        ];
        $id = media_handle_sideload( $file_array, 0 );
        var_dump($photo);
        var_dump($id);
        if (is_int($id)) $imgs[] = $id;

        if ($photo2 != '') {
            $tmp = download_url( $photo2 );
            $file_array = [
                'name'     => basename( explode('?', $photo2)[0] ),
                'tmp_name' => $tmp
            ];
            $id = media_handle_sideload( $file_array, 0 );
            if (is_int($id)) $imgs[] = $id;
        }

        $images = implode(',', $imgs);
        update_post_meta($product_id, '_product_image_gallery', $images);
        update_post_meta($product_id, '_thumbnail_id', $imgs[0]);*/
    //}

    //update_post_meta($product_id, 'kratkoe_nazvanie', $name);
    //update_post_meta($product_id, '_kratkoe_nazvanie', 'field_5ec870341cc56');

    
}

add_action('wp_ajax_update_product_data', 'update_product_data');
add_action('wp_ajax_nopriv_update_product_data', 'update_product_data');

function get_fav_count() {
    if (isset($_COOKIE['fav'])) {
        if ($_COOKIE['fav'] == "") return 0;
        return count(explode(",", $_COOKIE['fav']));
    }
    else return 0;
}

function more_reviews() {
    $posts = get_posts([
        'post_type' => 'reviews', 
        'numberposts' => 12, 
        'order' => 'asc', 
        'offset' => $_GET['offset'], 
        'meta_query'	=> array(
            'relation'		=> 'OR',
            array(
                'key'	 	=> 'kategoriya',
                'value'	  	=> $_GET['product_cat'],
                'compare' 	=> '=',
            ),
            array(
                'key'	  	=> 'kollekcziya',
                'value'	  	=> $_GET['product_col'],
                'compare' 	=> '=',
            ),
        )
    ]); 
	foreach ($posts as $post) { ?>
    <div class="col-4">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#card<?=$post->ID;?>">
        <? if (!get_the_post_thumbnail_url($post->ID, 'full')) { ?>
            <figure>
                <img src="/wp-content/uploads/woocommerce-placeholder.png">
            </figure>    
        <? } else { ?>
            <figure>
                <img src="<?=get_the_post_thumbnail_url($post->ID, 'full');?>">
            </figure>
        <? } ?>
        </a>
        <div class="modal fade" id="card<?=$post->ID;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="<?=get_template_directory_uri();?>/images/close.svg">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="product">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                <? if (get_field('video', $post->ID) == "") { ?>
                                    <figure>
                                        <img src="<?=get_the_post_thumbnail_url($post->ID, 'full');?>">
                                    </figure>
                                    <a href="<?=get_field('ssylka_na_tovar', $post->ID); ?>" style="display:inline-block;"><h2 style="text-decoration: underline;">Подробнее об этом изделии</h2></a>
                                <? } else { ?>
                                    <figure>
                                        <iframe src="<?=explode('/view', get_field('video', $post->ID))[0]; ?>/preview" width="640" height="480"></iframe>
                                    </figure>
                                <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } exit();
}

add_action('wp_ajax_more_reviews', 'more_reviews');
add_action('wp_ajax_nopriv_more_reviews', 'more_reviews');


function import_reviews() {
    //$video = $_REQUEST['video'];
    $photo = $_REQUEST['photo'];
    $title = $_REQUEST['title'];
    $sku = $_REQUEST['sku'];
    $collection = $_REQUEST['collection'];
    $category = $_REQUEST['category'];
    

    $post_data = array(
        'post_title'    => $title,
        'post_type'  => 'reviews',
        'post_status'   => 'publish',
        'post_content' => ''
    );

    $product_id = wp_insert_post( $post_data );
    //update_field('video', $video, $product_id);

    $imgs = array();
    $tmp = download_url( $photo );
    $file_array = [
        'name'     => basename( explode('?', $photo)[0]  ),
        'tmp_name' => $tmp
    ];
    $id = media_handle_sideload( $file_array, 0 );
    if (is_int($id)) $imgs[] = $id;

    add_post_meta($product_id, '_thumbnail_id', $imgs[0]);

    $term = get_term_by('name', $category, 'product_cat');
    if ($term) {
        update_field('kategoriya', $term->term_id, $product_id);
    }

    $term = get_term_by('name', $collection, 'product_col');
    if ($term) {
        update_field('kollekcziya', $term->term_id, $product_id);
    }

    $pid = wc_get_product_id_by_sku($sku);
    update_field('ssylka_na_tovar', $pid, $product_id);

    exit();
}

add_action('wp_ajax_import_reviews', 'import_reviews');
add_action('wp_ajax_nopriv_import_reviews', 'import_reviews');


function num_posts_archive_clients($query) {
    if (!is_admin() && $query->is_archive('clients') && $query->is_main_query() && $query->query['post_type'] == 'clients') {
            $query->set('posts_per_page', -1);
            //$query->set('orderby', 'sort');
            $query->set('order', 'asc');
    }
    return $query;
}
add_filter('pre_get_posts', 'num_posts_archive_clients');
?>