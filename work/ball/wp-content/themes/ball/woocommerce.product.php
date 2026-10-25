<?
/*
Template name: Каталог товаров
*/
get_header();
?>
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
      <span><? the_title(); ?></span>
		</nav>
		<div class="productgrid--masthead">
  		<figure class="collection--image">
    		<noscript data-rimg-noscript="">
      		<img src="<? echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="Bremont Spitfire Graphic Solo" data-rimg="noscript" srcset="<? echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?> 1x, <? echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?> 1.62x">
    		</noscript>
  			<img src="<? echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="Bremont Spitfire Graphic Solo" data-rimg="loaded" data-rimg-scale="1" data-rimg-template="<? echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" data-rimg-max="2200x777" srcset="<? echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?> 1.31x" data-rimg-template-svg="data:image/svg+xml;utf8,<svg%20xmlns='http://www.w3.org/2000/svg'%20width='1350'%20height='477'></svg>">
				<div data-rimg-canvas=""></div>
			</figure>
  		<div class="collection--information">
    		<h1 class="collection--title"><? the_title(); ?></h1>
  		</div>
		</div>
		<div class="collection--description rte">
    	<? the_content(); ?>
  	</div>
		<div class="productgrid--outer layout--has-sidebar">
    	<div class="productgrid--wrapper">
        <div class="productgrid--title">
        	<div class="productgrid--sortby">
						<div class="utils-sortby-select form-field-select-wrapper no-label">
      				<p>Сортировка</p>
      				<select class="form-field form-field-select" id="product_grid_sort" data-productgrid-trigger-sort="" style="width: 187px;">
                <option value="Default">Все</option>
          			<option value="price-ascending">Цена: дешевле</option>
          			<option value="price-descending">Цена: дороже</option>
          		</select>
      				<svg aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="8" height="6" viewBox="0 0 8 6">
  							<g fill="currentColor" fill-rule="evenodd">
								  <polygon class="icon-chevron-down-left" points="4 5.371 7.668 1.606 6.665 .629 4 3.365"></polygon>
								  <polygon class="icon-chevron-down-right" points="4 3.365 1.335 .629 1.335 .629 .332 1.606 4 5.371"></polygon>
  							</g>
							</svg>
 	   				</div>
 	   			</div>
        	<div class="productgrid--filters">
						<ul class="filter-group--grid">
						</ul>
       	 	</div>
      	</div>
				<div class="productgrid--sidebar" style="z-index: 99; position: absolute; top: 118px;">
  				<a class="mobile-title show__mobile_filters">
    				<h2>Фильтровать</h2>
  				</a>
  				<div class="productgrid--sidebar-section" data-productgrid-filters-content="">
    				<div class="productgrid--sortby visible">
							<div class="utils-sortby-select form-field-select-wrapper no-label">
      							<p>Сортировка </p>
      							<select class="form-field form-field-select" id="product_grid_sort" data-productgrid-trigger-sort="" style="width: 187px;">
        							<option value="Default">Все</option>
          							<option value="price-ascending">Цена: дешевле</option>
          							<option value="price-descending">Цена: дороже</option>
          						</select>
      							<svg aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="8" height="6" viewBox="0 0 8 6">
  									<g fill="currentColor" fill-rule="evenodd">
									    <polygon class="icon-chevron-down-left" points="4 5.371 7.668 1.606 6.665 .629 4 3.365"></polygon>
									    <polygon class="icon-chevron-down-right" points="4 3.365 1.335 .629 1.335 .629 .332 1.606 4 5.371"></polygon>
  									</g>
								</svg>
    						</div>
    					</div>
              <?
              function cbuild_query($param, $value) {
                $par = $_GET; 
                if (isset($par[$param])) {
                  $k = array_search($value, $par[$param]);
                  if ($k === false) $par[$param][] = $value;
                  else unset($par[$param][$k]);
                }
                else {
                  $par[$param][] = $value;
                }
                return http_build_query($par);
              }
              ?>
    					<h2 class="title" style="">Фильтры</h2>
						  <h3 class="productgrid--sidebar-title--small <? if (isset($_GET['material'])) { ?>active<? } ?>" style="">Материал корпуса</h3>
  						<ul class="productgrid--sidebar-item filter-group" <? if (isset($_GET['material'])) { ?>style="display: block;"<? } ?>>
    						<li class="filter-item filter-item--inactive" data-tag-advanced="" data-group="Case Finish" data-handle="case-finish_polished-stainless-steel">
            			<a href="?<? echo cbuild_query('material', 'titan'); ?>" title="Narrow selection to products matching tag Case Finish_Polished Stainless Steel" <? if (in_array('titan', $_GET['material'])) { ?>class="filter-link--active"<? } ?>>
            		    <span class="filter-icon--checkbox">
            					<svg aria-hidden="true" focusable="false" role="presentation" width="11" height="11" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
  											<path fill="currentColor" fill-rule="evenodd" d="M0,2.00276013 C0,0.896666251 0.893542647,0 2.00276013,0 L10.9972399,0 C12.1033337,0 13,0.893542647 13,2.00276013 L13,10.9972399 C13,12.1033337 12.1064574,13 10.9972399,13 L2.00276013,13 C0.896666251,13 0,12.1064574 0,10.9972399 L0,2.00276013 Z M3.038,6.013 L2,7.024 L5.115,10.061 L11,4.325 L9.962,3.312 L5.115,8.038 L3.038,6.013 Z"></path>
										  </svg>
								    </span>
								    <span class="filter-text">Титан</span>
								  </a>
          			</li>
    						<li class="filter-item filter-item--inactive" data-tag-advanced="" data-group="Case Finish" data-handle="case-finish_stainless-steel">
       						<a href="?<? echo cbuild_query('material', 'bronze'); ?>" title="Narrow selection to products matching tag Case Finish_Stainless Steel" <? if (in_array('bronze', $_GET['material'])) { ?>class="filter-link--active"<? } ?>>
       							<span class="filter-icon--checkbox">
       								<svg aria-hidden="true" focusable="false" role="presentation" width="11" height="11" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
  											<path fill="currentColor" fill-rule="evenodd" d="M0,2.00276013 C0,0.896666251 0.893542647,0 2.00276013,0 L10.9972399,0 C12.1033337,0 13,0.893542647 13,2.00276013 L13,10.9972399 C13,12.1033337 12.1064574,13 10.9972399,13 L2.00276013,13 C0.896666251,13 0,12.1064574 0,10.9972399 L0,2.00276013 Z M3.038,6.013 L2,7.024 L5.115,10.061 L11,4.325 L9.962,3.312 L5.115,8.038 L3.038,6.013 Z"></path>
										  </svg>
								    </span>
								    <span class="filter-text">Бронза</span>
								  </a>
          			</li>
                <li class="filter-item filter-item--inactive" data-tag-advanced="" data-group="Case Finish" data-handle="case-finish_stainless-steel">
                  <a href="?<? echo cbuild_query('material', '316l'); ?>" title="Narrow selection to products matching tag Case Finish_Stainless Steel" <? if (in_array('316l', $_GET['material'])) { ?>class="filter-link--active"<? } ?>>
                    <span class="filter-icon--checkbox">
                      <svg aria-hidden="true" focusable="false" role="presentation" width="11" height="11" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" fill-rule="evenodd" d="M0,2.00276013 C0,0.896666251 0.893542647,0 2.00276013,0 L10.9972399,0 C12.1033337,0 13,0.893542647 13,2.00276013 L13,10.9972399 C13,12.1033337 12.1064574,13 10.9972399,13 L2.00276013,13 C0.896666251,13 0,12.1064574 0,10.9972399 L0,2.00276013 Z M3.038,6.013 L2,7.024 L5.115,10.061 L11,4.325 L9.962,3.312 L5.115,8.038 L3.038,6.013 Z"></path>
                      </svg>
                    </span>
                    <span class="filter-text">Сталь 316L</span>
                  </a>
                </li>
                <li class="filter-item filter-item--inactive" data-tag-advanced="" data-group="Case Finish" data-handle="case-finish_stainless-steel">
                  <a href="?<? echo cbuild_query('material', '904l'); ?>" title="Narrow selection to products matching tag Case Finish_Stainless Steel" <? if (in_array('904l', $_GET['material'])) { ?>class="filter-link--active"<? } ?>>
                    <span class="filter-icon--checkbox">
                      <svg aria-hidden="true" focusable="false" role="presentation" width="11" height="11" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" fill-rule="evenodd" d="M0,2.00276013 C0,0.896666251 0.893542647,0 2.00276013,0 L10.9972399,0 C12.1033337,0 13,0.893542647 13,2.00276013 L13,10.9972399 C13,12.1033337 12.1064574,13 10.9972399,13 L2.00276013,13 C0.896666251,13 0,12.1064574 0,10.9972399 L0,2.00276013 Z M3.038,6.013 L2,7.024 L5.115,10.061 L11,4.325 L9.962,3.312 L5.115,8.038 L3.038,6.013 Z"></path>
                      </svg>
                    </span>
                    <span class="filter-text">Сталь 904L</span>
                  </a>
                </li>
                <li class="filter-item filter-item--inactive" data-tag-advanced="" data-group="Case Finish" data-handle="case-finish_stainless-steel">
                  <a href="?<? echo cbuild_query('material', 'carbid'); ?>" title="Narrow selection to products matching tag Case Finish_Stainless Steel" <? if (in_array('carbid', $_GET['material'])) { ?>class="filter-link--active"<? } ?>>
                    <span class="filter-icon--checkbox">
                      <svg aria-hidden="true" focusable="false" role="presentation" width="11" height="11" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" fill-rule="evenodd" d="M0,2.00276013 C0,0.896666251 0.893542647,0 2.00276013,0 L10.9972399,0 C12.1033337,0 13,0.893542647 13,2.00276013 L13,10.9972399 C13,12.1033337 12.1064574,13 10.9972399,13 L2.00276013,13 C0.896666251,13 0,12.1064574 0,10.9972399 L0,2.00276013 Z M3.038,6.013 L2,7.024 L5.115,10.061 L11,4.325 L9.962,3.312 L5.115,8.038 L3.038,6.013 Z"></path>
                      </svg>
                    </span>
                    <span class="filter-text">Карбид мю-металла</span>
                  </a>
                </li>
    					</ul>
						  <h3 class="productgrid--sidebar-title--small <? if (isset($_GET['pokrit'])) { ?>active<? } ?>"">Покрытие корпуса</h3>
  						<ul class="productgrid--sidebar-item filter-group" <? if (isset($_GET['pokrit'])) { ?>style="display: block;"<? } ?>>
    						<li class="filter-item filter-item--inactive" data-tag-advanced="" data-group="Case Size" data-handle="case-size_43mm">
          		    <a href="?<? echo cbuild_query('pokrit', 'dlc'); ?>" title="Narrow selection to products matching tag Case Size_43mm" <? if (in_array('dlc', $_GET['pokrit'])) { ?>class="filter-link--active"<? } ?>>
          				  <span class="filter-icon--checkbox">
	          					<svg aria-hidden="true" focusable="false" role="presentation" width="11" height="11" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
	  										<path fill="currentColor" fill-rule="evenodd" d="M0,2.00276013 C0,0.896666251 0.893542647,0 2.00276013,0 L10.9972399,0 C12.1033337,0 13,0.893542647 13,2.00276013 L13,10.9972399 C13,12.1033337 12.1064574,13 10.9972399,13 L2.00276013,13 C0.896666251,13 0,12.1064574 0,10.9972399 L0,2.00276013 Z M3.038,6.013 L2,7.024 L5.115,10.061 L11,4.325 L9.962,3.312 L5.115,8.038 L3.038,6.013 Z"></path>
										  </svg>
								    </span>
								    <span class="filter-text">DLC</span>
								  </a>
         				</li>
                <li class="filter-item filter-item--inactive" data-tag-advanced="" data-group="Case Size" data-handle="case-size_43mm">
                  <a href="?<? echo cbuild_query('pokrit', 'tic'); ?>" title="Narrow selection to products matching tag Case Size_43mm" <? if (in_array('tic', $_GET['pokrit'])) { ?>class="filter-link--active"<? } ?>>
                    <span class="filter-icon--checkbox">
                      <svg aria-hidden="true" focusable="false" role="presentation" width="11" height="11" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" fill-rule="evenodd" d="M0,2.00276013 C0,0.896666251 0.893542647,0 2.00276013,0 L10.9972399,0 C12.1033337,0 13,0.893542647 13,2.00276013 L13,10.9972399 C13,12.1033337 12.1064574,13 10.9972399,13 L2.00276013,13 C0.896666251,13 0,12.1064574 0,10.9972399 L0,2.00276013 Z M3.038,6.013 L2,7.024 L5.115,10.061 L11,4.325 L9.962,3.312 L5.115,8.038 L3.038,6.013 Z"></path>
                      </svg>
                    </span>
                    <span class="filter-text">TiC</span>
                  </a>
                </li>
    					</ul>
              <h3 class="productgrid--sidebar-title--small <? if (isset($_GET['func'])) { ?>active<? } ?>"">Функции</h3>
              <ul class="productgrid--sidebar-item filter-group" <? if (isset($_GET['func'])) { ?>style="display: block;"<? } ?>>
                <li class="filter-item filter-item--inactive" data-tag-advanced="" data-group="Case Size" data-handle="case-size_43mm">
                  <a href="?<? echo cbuild_query('func', 'gmt'); ?>" title="Narrow selection to products matching tag Case Size_43mm" <? if (in_array('gmt', $_GET['func'])) { ?>class="filter-link--active"<? } ?>>
                    <span class="filter-icon--checkbox">
                      <svg aria-hidden="true" focusable="false" role="presentation" width="11" height="11" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" fill-rule="evenodd" d="M0,2.00276013 C0,0.896666251 0.893542647,0 2.00276013,0 L10.9972399,0 C12.1033337,0 13,0.893542647 13,2.00276013 L13,10.9972399 C13,12.1033337 12.1064574,13 10.9972399,13 L2.00276013,13 C0.896666251,13 0,12.1064574 0,10.9972399 L0,2.00276013 Z M3.038,6.013 L2,7.024 L5.115,10.061 L11,4.325 L9.962,3.312 L5.115,8.038 L3.038,6.013 Z"></path>
                      </svg>
                    </span>
                    <span class="filter-text">GMT</span>
                  </a>
                </li>
                <li class="filter-item filter-item--inactive" data-tag-advanced="" data-group="Case Size" data-handle="case-size_43mm">
                  <a href="?<? echo cbuild_query('func', 'chron'); ?>" title="Narrow selection to products matching tag Case Size_43mm" <? if (in_array('chron', $_GET['func'])) { ?>class="filter-link--active"<? } ?>>
                    <span class="filter-icon--checkbox">
                      <svg aria-hidden="true" focusable="false" role="presentation" width="11" height="11" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" fill-rule="evenodd" d="M0,2.00276013 C0,0.896666251 0.893542647,0 2.00276013,0 L10.9972399,0 C12.1033337,0 13,0.893542647 13,2.00276013 L13,10.9972399 C13,12.1033337 12.1064574,13 10.9972399,13 L2.00276013,13 C0.896666251,13 0,12.1064574 0,10.9972399 L0,2.00276013 Z M3.038,6.013 L2,7.024 L5.115,10.061 L11,4.325 L9.962,3.312 L5.115,8.038 L3.038,6.013 Z"></path>
                      </svg>
                    </span>
                    <span class="filter-text">Хронограф</span>
                  </a>
                </li>
              </ul>
            </div>
				  </div>
				  <div class="productgrid--items">
					<? 
            if (isset($_GET['material'])) $material = $_GET['material'];
            else $material = array('null', '0', 'titan', '904l', 'carbid', 'bronze', '316l');
            if (isset($_GET['func'])) $func = $_GET['func'];
            else $func = array('null', '0', 'gmt', 'chron');
            if (isset($_GET['pokrit'])) $pokrit = $_GET['pokrit'];
            else $pokrit = array('null', '0', 'dlc', 'tic');
            if (isset($_GET['sort_by'])) {
              if ($_GET['sort_by'] == 'price-ascending') $sort = 'asc';
              else $sort = 'desc';
            }
            else $sort = 'desc';
//var_dump($material);
            $products = get_posts(array('post_type' => 'product', 'numberposts' => -1, 'orderby' => 'meta_value_num', 'meta_key' => '_price', 'order' => $sort, 'meta_query'  => array(
              'relation'    => 'AND',
              array(
                'key'   => 'материал',
                'value'     => $material,
                'compare'   => 'IN',
              ),
            array(
              'key' => 'покрытие',
              'value'     => $pokrit,
              'compare'   => 'IN',
            ),
              array(
                'key'   => 'функции',
                'value'     => $func,
                'compare'   => 'IN',
              )
            ))); 
            if (count($products) == 0) {
              ?>
              <article class="productgrid--item imagestyle--natural productitem--emphasis" data-product-item="" tabindex="1" style="">
                <p>Нет товаров для показа</p>
              </article>
              <?
            }
            foreach ($products as $product) { $_product = wc_get_product( $product->ID ); ?>
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
          </div>
        </div>
		    <div class="shopify-section blogposts--section bgcolor--cream waypoint waypoint-reveal">
          <section class="blogposts--container blogposts--count-3">
            <h1 class="home-section--title">Media BALL</h1>
              <div class="home-section--content blogposts--inner" data-blog-posts="">
                <? $posts = get_posts(array('post_type' => 'post', 'numberposts' => 3)); 
                foreach ($posts as $post) {
                ?>
                <article class="article--excerpt-wrapper  ">
                  <a class="article--excerpt-image" href="<? echo get_permalink($post->ID); ?>" data-rimg="loaded" data-rimg-scale="1" data-rimg-template="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" data-rimg-max="3000x1139" style="background-image: url(<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>);">
                    <noscript data-rimg-noscript="">
                      <img src="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="Bremont-Nims-Slider" data-rimg="noscript" srcset="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?> 1x, <? echo get_the_post_thumbnail_url($post->ID, 'full'); ?> 4.28x">
                    </noscript>
                    <img src="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="Bremont-Nims-Slider" data-rimg="loaded" data-rimg-scale="1" data-rimg-template="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" data-rimg-max="3000x1139" srcset="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?> 2.00x" data-rimg-template-svg="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>">
                    <div data-rimg-canvas=""></div>
                  </a>
                  <div class="article--excerpt-content">
                    <h2 class="article--excerpt-title">
                      <a href="<? echo get_permalink($post->ID); ?>">B<? echo $post->post_title; ?></a>
                    </h2>
                    <div class="article--excerpt-text rte">
                      <div class="article--excerpt-text rte">
                        <? echo mb_substr($post->post_content, 0, 140)."..."; ?>
                      </div>
                    </div>
                    <a class="article--excerpt-readmore" href="<? echo get_permalink($post->ID); ?>">Читать далее
                      <span class="article--excerpt-readmore--icon">
                        <svg aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="8" height="6" viewBox="0 0 8 6">
                          <g fill="currentColor" fill-rule="evenodd">
                            <polygon class="icon-chevron-down-left" points="4 5.371 7.668 1.606 6.665 .629 4 3.365"></polygon>
                            <polygon class="icon-chevron-down-right" points="4 3.365 1.335 .629 1.335 .629 .332 1.606 4 5.371"></polygon>
                          </g>
                        </svg>
                      </span>
                    </a>
                  </div>
                </article>
                <? } ?>
              </div>
              <div class="blogposts--footer">
                <a class="btn blogposts--footer-link" href="/blog">Смотреть все</a>
              </div>
            </section>
          </div>
        </div>
      </main>
<? get_footer(); ?>