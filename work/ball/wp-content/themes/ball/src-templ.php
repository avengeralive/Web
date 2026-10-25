<?
/*
Template name: Поиск
*/

$query = explode('*', $_GET['q'])[0];
global $wpdb;
$cont_arr = array();
$content = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."posts WHERE (post_title LIKE '%".$query."%' OR post_content LIKE '%".$query."%') AND post_type = 'page'" );
foreach ($content as $key => $post) {
	$tmp = array();
	$tmp['title'] = $post->post_title;
	$tmp['url'] = get_permalink($post->ID);
	$cont_arr[] = $tmp;
}
$content1 = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."posts WHERE (post_title LIKE '%".$query."%' OR post_content LIKE '%".$query."%') AND post_type = 'post'" );
foreach ($content1 as $key => $post) {
	$tmp = array();
	$tmp['title'] = $post->post_title;
	$tmp['url'] = get_permalink($post->ID);
	$cont_arr[] = $tmp;
}
$prod_arr = array();
$products = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."posts WHERE (post_title LIKE '%".$query."%' OR post_content LIKE '%".$query."%') AND post_type = 'product'" );
foreach ($products as $key => $post) {
	$_product = wc_get_product( $post->ID );
	$tmp = array();
	$tmp['title'] = $post->post_title;
	$tmp['url'] = get_permalink($post->ID);
	$tmp['id'] = $post->ID;
	$tmp['handle'] = $post->name;
	$tmp['on_sale'] = 'false';
	$tmp['consistent_saved'] = 'false';
	$tmp['price'] = array(
		"price" => $_product->get_price(),
		"price_min" => $_product->get_price(),
		"price_max" => $_product->get_price(),
		"compare_at_price" => null,
		"compare_at_price_min" => 0,
		"compare_at_price_max" => 0,
		"compare_at_price_varies" => false
	);
	$tmp['image'] = '<img src="'.get_the_post_thumbnail_url($post->ID, 'full').'" alt="'.$post->post_title.'" data-rimg srcset="'.get_the_post_thumbnail_url($post->ID, 'full').' 1x, '.get_the_post_thumbnail_url($post->ID, 'full').' 2x, '.get_the_post_thumbnail_url($post->ID, 'full').' 3x, '.get_the_post_thumbnail_url($post->ID, 'full').' 4x">';
	$prod_arr[] = $tmp;
}

$json = array(
	"content" => $cont_arr,
	"products" => $prod_arr,
	"terms" => $_GET['q'],
  	"sanitizedTerms" => $query
);
if (isset($_GET['view']) && $_GET['view'] == 'header') echo json_encode($json);
else {
?>
<? get_header(); ?>
<main class="site-main">
	<div id="shopify-section-static-collection" class="shopify-section collection--section">
		<script type="application/json" data-section-type="static-collection" data-section-id="static-collection" data-section-data="">
		  {
		    "context": {
		      "see_more": "See more",
		      "see_less": "See less"
		    }
		    
		  }
		</script>
		<nav class="breadcrumbs-container" aria-label="Breadcrumbs">
    		<a href="/">Главная</a>
	    	<span class="breadcrumbs-delimiter" aria-hidden="true">
	      		<i class="icon icon--rightarrow"></i>
	    	</span>
      		<span>Поиск "<? echo $query; ?>"</span>
		</nav>
		<div class="productgrid--masthead">
	  		<figure class="collection--image">
	    		<noscript data-rimg-noscript="">
	      		<img src="<? echo get_the_post_thumbnail_url(10, 'full'); ?>" alt="Bremont Spitfire Graphic Solo" data-rimg="noscript" srcset="<? echo get_the_post_thumbnail_url(10, 'full'); ?> 1x, <? echo get_the_post_thumbnail_url(10, 'full'); ?> 1.62x">
	    		</noscript>
	  			<img src="<? echo get_the_post_thumbnail_url(10, 'full'); ?>" alt="Bremont Spitfire Graphic Solo" data-rimg="loaded" data-rimg-scale="1" data-rimg-template="<? echo get_the_post_thumbnail_url(10, 'full'); ?>" data-rimg-max="2200x777" srcset="<? echo get_the_post_thumbnail_url(10, 'full'); ?> 1.31x" data-rimg-template-svg="data:image/svg+xml;utf8,<svg%20xmlns='http://www.w3.org/2000/svg'%20width='1350'%20height='477'></svg>">
				<div data-rimg-canvas=""></div>
			</figure>
	  		<div class="collection--information">
	    		<h1 class="collection--title">Поиск "<? echo $query; ?>"</h1>
	  		</div>
		</div>
		<div class="productgrid--outer layout--has-sidebar">
    		<div class="productgrid--wrapper">
				<div class="productgrid--items">
				<? foreach ($products as $product) { $_product = wc_get_product( $product->ID ); ?>
        			<article class="productgrid--item imagestyle--natural productitem--emphasis" data-product-item="" tabindex="1" style="">
    					<div class="productitem" data-product-item-content="" style="">
      						<figure class="productitem--image" data-product-item-image="">
          						<a class="productitem--image-link" href="/collections/watches-mens-solo/products/solo-cr">
          							<img src="<? echo get_the_post_thumbnail_url($product->ID, 'full'); ?>" alt="SOLO CR Front" data-rimg="" srcset="<? echo get_the_post_thumbnail_url($product->ID, 'full'); ?> 1x, <? echo get_the_post_thumbnail_url($product->ID, 'full'); ?> 1.16x">
  								</a>
        					</figure>
  							<div class="productitem--info">
        						<h2 class="productitem--title">
          							<a href="<? echo get_permalink($product->id); ?>" tabindex="1"><? echo $product->post_title; ?></a>
        						</h2>
  								<div class="product--price ">
    								<div class="price--compare-at" data-price-compare-at="">
        								<span class="money"></span>
    								</div>
    								<div class="price--main" data-price="">
  	      								<span class="money">₽ <? echo $_product->get_price(); ?></span>
  	  								</div>
  								</div>
        						<a class="productitem--btn" href="<? echo get_permalink($product->ID); ?>">Смотреть</a>
      						</div>
      					</div>
              		</article>
					<? } ?>
      			</div>
      			<div class="productgrid--footer">
					<article class="productgrid--footer-item">
  						<h2 class="productgrid--footer-title">Media Ball</h2>
  						<ul class="productgrid--footer-results-list">
  							<? foreach ($content1 as $post) { ?>
    						<li>
          						<a href="<? echo get_permalink($post->ID); ?>"><? echo $post->post_title; ?></a>
        					</li>
        					<? } ?>
      					</ul>
					</article>
					<article class="productgrid--footer-item">
 	 					<h2 class="productgrid--footer-title">Страницы</h2>
  						<ul class="productgrid--footer-results-list">
  							<? foreach ($content as $post) { ?>
    						<li>
          						<a href="<? echo get_permalink($post->ID); ?>"><? echo $post->post_title; ?></a>
        					</li>
        					<? } ?>
  						</ul>
					</article>
        		</div>
          	</div>
        </div>
    </div>
</main>
<? get_footer(); ?>
<? } ?>