<? get_header(); ?>
<main class="site-main">
	<div id="shopify-section-static-slideshow" class="shopify-section slideshow--section waypoint">
		<section class="slideshow slideshow-dots-medium step-up" data-delay="1">
			<? $slider = get_field('слайдер', get_the_ID()); 
			foreach ($slider as $key => $slide) {
			?>
	    	<div class="slideshow-slide slideshow-height-medium">
		        <a class="slideshow-link slideshow-height-medium" href="<? echo $slide['ссылка']; ?>">
			        <div class="slideshow-background slideshow-background--1543938084982 slideshow-height-medium" data-themecolor="#666666" data-slidecolor="#ffffff">
			          	<img src="<? echo $slide['фон']; ?>" alt="Bremont-Jag-Homepage" data-rimg srcset="<? echo $slide['фон']; ?> 1x" class="slideshow-image desktop">
						<img src="<? echo $slide['фон_моб']; ?>" alt="Bremont-Jaguar-Homepage-Mobile" data-rimg srcset="<? echo $slide['фон_моб']; ?> 1x" class="slideshow-image mobile">
						<? echo $slide['видео']; ?>
			         	<div class="slideshow-slide-overlay slideshow-slide-overlay--1543938084982"></div>
			        </div>
					<div class="slideshow-slide-content slideshow-slide-content--1543938084982 position-center">
			            <h2 class="slideshow-slide-heading">
			                <? echo $slide['заголовок']; ?>
			            </h2>
			            <p class="slideshow-slide-text">
			                <? echo $slide['описание']; ?>
			            </p>
			            <a href="<? echo $slide['ссылка']; ?>" class="slideshow-button button-primary"><? echo $slide['кнопка']; ?></a>
			        </div>
		        </a>
	    	</div>
	    	<? } ?>
	    	<style>
	    	.slideshow-slide-overlay--1543938084982 {
	      		background-color: #000000;
	      		opacity: 0.1;
	    	}
	    	.slideshow-height-fullscreen + .slideshow-slide-content--1543938084982 .slideshow-slide-heading, .slideshow-height-fullscreen + .slideshow-slide-content--1543938084982 .slideshow-slide-text {
	      		color: #ffffff;
	    	}
	    	@media (min-width: 720px) {
	      		.slideshow-slide-content--1543938084982 .slideshow-slide-heading, .slideshow-slide-content--1543938084982 .slideshow-slide-text {
	        		color: #ffffff;
	      		}
	    	}
	    	.slideshow-slide-overlay--1557475745242 {
	      		background-color: #000000;
	      		opacity: 0.5;
	   	 	}
	    	.slideshow-height-fullscreen + .slideshow-slide-content--1557475745242 .slideshow-slide-heading, .slideshow-height-fullscreen + .slideshow-slide-content--1557475745242 .slideshow-slide-text {
	      		color: #ffffff;
	    	}
	    	@media (min-width: 720px) {
	      		.slideshow-slide-content--1557475745242 .slideshow-slide-heading, .slideshow-slide-content--1557475745242 .slideshow-slide-text {
	        		color: #ffffff;
	      		}
	    	}
	    	.slideshow-slide-overlay--1550670132346 {
	      		background-color: #000000;
	      		opacity: 0.1;
	    	}
	    	.slideshow-height-fullscreen + .slideshow-slide-content--1550670132346 .slideshow-slide-heading, .slideshow-height-fullscreen + .slideshow-slide-content--1550670132346 .slideshow-slide-text {
	      		color: #ffffff;
	    	}
	    	@media (min-width: 720px) {
	      		.slideshow-slide-content--1550670132346 .slideshow-slide-heading, .slideshow-slide-content--1550670132346 .slideshow-slide-text {
	        		color: #ffffff;
	      		}
	    	}
			</style>
		</section>
	</div>
    <div id="shopify-section-1543398434026" class="shopify-section section-info-bar waypoint">
    	<div class="section-info-bar">
    		<div class="item step-up" data-delay="1">
      			<img src="/wp-content/themes/ball/assets/switz.png" alt="icon-brit" data-rimg srcset="/wp-content/themes/ball/assets/switz.png 1x" class="item-icon">
				<h6>Made in Switzerland</h6>
    		</div>
    		<div class="item step-up" data-delay="1">
    			<img src="/wp-content/themes/ball/assets/icon-clock_80x80.png" alt="icon-clock" data-rimg="" srcset="/wp-content/themes/ball/assets/icon-clock_80x80.png 1x" class="item-icon">
    			<h6>5 лет гарантии на все часы</h6>
    		</div>
  		</div>
	</div>
	<div id="shopify-section-1544005492927" class="shopify-section featured-slider waypoint">
		<section class="product-section--container product-row--container related-products--container" data-product-row>
	  		<h2 class="product-section--title related-products--title step-up" data-delay="1">Коллекция Ball Watch</h2>
	  		<p class="product-section--subtitle related-products--subtitle step-up" data-delay="1">Откройте для себя коллекцию швейцарских часов Ball</p>
	  		<div class="step-up" data-delay="1">
	  			<div class="owl-carousel related-carousel-main">
	  				<? $slider = get_field('карусель', get_the_ID()); 
					foreach ($slider as $key => $slide) {
					?>
	    			<article class="productgrid--item" data-product-item tabindex="1">
	         	 		<div class="productitem" data-product-item-content>
	            			<a class="productitem--image-link" href="/collections/the-armed-forces-collection">
	              				<figure class="productitem--image" data-product-item-image>
	                				<img src="<? echo $slide['фото']; ?>" alt="Bremont-Broadsword-front 596x1000 ac63a976-4a59-4981-8328-2d48800eaf60" data-rimg srcset="<? echo $slide['фото']; ?> 1x" class="feature">
									<img src="<? echo $slide['фото']; ?>" alt="Bremont-Broadsword---back 596x1000 7d0c79f4-45d4-44dd-bca1-05d016cdcd8e" data-rimg srcset="<? echo $slide['фото']; ?> 1x" class="alt">
								</figure>
	            			</a>
	            			<div class="productitem--info">
	              				<a href="/collections/the-armed-forces-collection" tabindex="1">
	                				<h2 class="productitem--title">Коллекция<br><? echo $slide['модель'][0]->name; ?></h2>
	                				<p class="models"><? echo $slide['модель'][0]->count; ?> моделей</p>
	              				</a>
	            			</div>
	          			</div>
	        		</article>
	    			<? } ?>
	 			</div>
	  		</div>
	  		<div class="step-up" data-delay="1">
	    		<a class="btn" href="/chasy">Все часы Ball</a>
	  		</div>
		</section>
	</div>
	<div id="shopify-section-1543399611715" class="shopify-section promo-mosaic--section waypoint">
		<section class="promo-mosaic--container">
  			<div class="home-section--content">
    			<div class="promo-mosaic--inner promo-mosaic--layout-2 step-up" data-delay="1">
    				<div class="promo-mosaic--row">
  						<div class="promo-mosaic--column">
    						<article class="promo-block promo-block--1543399611715-1 promo-block--default" data-rimg="lazy" data-rimg-scale="1" data-rimg-template="//cdn.shopify.com/s/files/1/0024/5084/9907/files/Broadsword_Armed_Forces_Collection_2_1400x1400_756843c0-adc8-4ba0-96c9-ee31f570d017_{size}.jpg?v=1560005495" data-rimg-max="1400x1400">
 								<noscript data-rimg-noscript>
      								<img src="<? echo get_field('блок_1'); ?>" alt="Broadsword Armed Forces Collection 2 1400x1400 756843c0-adc8-4ba0-96c9-ee31f570d017" data-rimg="noscript" srcset="<? echo get_field('блок_1'); ?> 1x, <? echo get_field('блок_1'); ?> 1.03x" class="promo-block--background">
      							</noscript>
      							<img src="<? echo get_field('блок_1'); ?>" alt="Broadsword Armed Forces Collection 2 1400x1400 756843c0-adc8-4ba0-96c9-ee31f570d017" data-rimg="lazy" data-rimg-scale="1" data-rimg-template="<? echo get_field('блок_1'); ?>" data-rimg-max="1400x1400" srcset="data:image/svg+xml;utf8,<svg%20xmlns='http://www.w3.org/2000/svg'%20width='1350'%20height='1350'></svg>" class="promo-block--background">
      							<div data-rimg-canvas></div>
								<video class="promo-block--video" muted="muted" autoplay="" loop="loop" onended="var v=this;setTimeout(function(){v.play()},300)" data-type="parallax" data-speed="2">
    								<source data-src="" type="video/mp4" src="">
    								<source data-src="" type="video/webm" src="">
  								</video>
  								<div class="promo-block--content promo-block--content-align-top-left" data-promo-block-content>
  									<div class="promo-block--content-wrapper">
      									<h2 class="promo-block--header">Новые модели</h2>
      									<a href="/collections/the-armed-forces-collection" class="button-primary promo-block--button">Подробнее</a>
      									<span class="promo-block--expander">
        									<svg aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8">
											  	<g fill="currentColor" fill-rule="evenodd" transform="translate(0 -.5)">
											    	<polygon class="icon-chevron-down-left" points="7 8.466 13.655 1.81 12.38 .533 7 5.913"/>
											    	<polygon class="icon-chevron-down-right" points="7 5.913 1.621 .533 .344 1.81 7 8.466"/>
											  	</g>
											</svg>
      									</span>
    								</div>
  								</div>
							</article>
  						</div>
  						<div class="promo-mosaic--column">
    						<article class="promo-block promo-block--1543399611715-0 promo-block--default" data-rimg="lazy" data-rimg-scale="1" data-rimg-template="//cdn.shopify.com/s/files/1/0024/5084/9907/files/Bremont-ALT1-ZT-51-2_{size}.jpg?v=1560005726" data-rimg-max="860x576">
  								<noscript data-rimg-noscript>
  									<img src="<? echo get_field('блок_2'); ?>" alt="Bremont-ALT1-ZT-51-2" data-rimg="noscript" srcset="<? echo get_field('блок_2'); ?> 1x" class="promo-block--background">
  								</noscript>
  								<img src="<? echo get_field('блок_2'); ?>" alt="Bremont-ALT1-ZT-51-2" data-rimg="lazy" data-rimg-scale="1" data-rimg-template="<? echo get_field('блок_2'); ?>" data-rimg-max="860x576" srcset="data:image/svg+xml;utf8,<svg%20xmlns='http://www.w3.org/2000/svg'%20width='860'%20height='576'></svg>" class="promo-block--background">
  								<div data-rimg-canvas></div>
								<video class="promo-block--video" muted="muted" autoplay="" loop="loop" onended="var v=this;setTimeout(function(){v.play()},300)" data-type="parallax" data-speed="2">
								    <source data-src="" type="video/mp4" src="">
								    <source data-src="" type="video/webm" src="">
  								</video>
	 	 						<div class="promo-block--content promo-block--content-align-top-left" data-promo-block-content>
	 	 							<div class="promo-block--content-wrapper">
      									<h2 class="promo-block--header">Ball предзаказ</h2>
      									<a href="/collections/watches-mens-alt1-z" class="button-primary promo-block--button">Перейти на сайт</a>
      									<span class="promo-block--expander">
      										<svg aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8">
      											<g fill="currentColor" fill-rule="evenodd" transform="translate(0 -.5)">
												    <polygon class="icon-chevron-down-left" points="7 8.466 13.655 1.81 12.38 .533 7 5.913"/>
												    <polygon class="icon-chevron-down-right" points="7 5.913 1.621 .533 .344 1.81 7 8.466"/>
  												</g>
											</svg>
										</span>
    								</div>
  								</div>
							</article>
  						</div>
					</div>
      			</div>
  			</div>
  			<style>
    		.promo-block--1543399611715-1 {
      			color: #ffffff;
    		}
			.promo-block--1543399611715-1 .promo-block--content {
        		background-color: rgba(8, 8, 8, 0.3);
      		}
    		.promo-block--1543399611715-0 {
	      		color: #ffffff;
      		}
			.promo-block--1543399611715-0 .promo-block--content {
        		background-color: rgba(0, 0, 0, 0.29);
      		}
    		</style>
		</section>
	</div>
	<div id="shopify-section-1543402793408" class="shopify-section promo-mosaic--section waypoint">
		<section class="promo-mosaic--container">
  			<div class="home-section--content">
      			<div class="promo-mosaic--inner promo-mosaic--layout-1 step-up" data-delay="1">
        			<div class="promo-mosaic--row">
  						<div class="promo-mosaic--column">
    						<article class="promo-block promo-block--1543402793408-0 promo-block--best-of-british">
  								<video class="promo-block--video" muted="muted" autoplay="" loop="loop" onended="var v=this;setTimeout(function(){v.play()},300)" data-type="parallax" data-speed="2">
								    <source data-src="/wp-content/themes/ball/assets/tech.mp4" type="video/mp4" src="/wp-content/themes/ball/assets/tech.mp4">
  								</video>
  								<div class="promo-block--content promo-block--content-align-right" data-promo-block-content>
  									<div class="promo-block--content-wrapper">
  										<h2 class="promo-block--header">Уникальные технологии Ball</h2>
      									<a href="/pages/british-engineering" class="button-primary promo-block--button">Подробно</a>
      									<a href="/chasy" class="button-secondary promo-block--button">Смотреть все модели</a>
      									<span class="promo-block--expander">
        									<svg aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8">
											  	<g fill="currentColor" fill-rule="evenodd" transform="translate(0 -.5)">
											    	<polygon class="icon-chevron-down-left" points="7 8.466 13.655 1.81 12.38 .533 7 5.913"/>
											    	<polygon class="icon-chevron-down-right" points="7 5.913 1.621 .533 .344 1.81 7 8.466"/>
											  	</g>
											</svg>
      									</span>
    								</div>
  								</div>
							</article>
  						</div>
					</div>
      			</div>
  			</div>
  			<style>
    		.promo-block--1543402793408-0 {
      			color: #ffffff;
      			background-color: #f0f0f0;
        		background-image: url('data:image/svg+xml,%3Csvg fill=%22%23c9c9c9%22 xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 525.5 525.5%22%3E%3Cpath d=%22M324.5 212.7H203c-1.6 0-2.8 1.3-2.8 2.8V308c0 1.6 1.3 2.8 2.8 2.8h121.6c1.6 0 2.8-1.3 2.8-2.8v-92.5c0-1.6-1.3-2.8-2.9-2.8zm1.1 95.3c0 .6-.5 1.1-1.1 1.1H203c-.6 0-1.1-.5-1.1-1.1v-92.5c0-.6.5-1.1 1.1-1.1h121.6c.6 0 1.1.5 1.1 1.1V308z%22/%3E%3Cpath d=%22M210.4 299.5H240v.1s.1 0 .2-.1h75.2v-76.2h-105v76.2zm1.8-7.2l20-20c1.6-1.6 3.8-2.5 6.1-2.5s4.5.9 6.1 2.5l1.5 1.5 16.8 16.8c-12.9 3.3-20.7 6.3-22.8 7.2h-27.7v-5.5zm101.5-10.1c-20.1 1.7-36.7 4.8-49.1 7.9l-16.9-16.9 26.3-26.3c1.6-1.6 3.8-2.5 6.1-2.5s4.5.9 6.1 2.5l27.5 27.5v7.8zm-68.9 15.5c9.7-3.5 33.9-10.9 68.9-13.8v13.8h-68.9zm68.9-72.7v46.8l-26.2-26.2c-1.9-1.9-4.5-3-7.3-3s-5.4 1.1-7.3 3l-26.3 26.3-.9-.9c-1.9-1.9-4.5-3-7.3-3s-5.4 1.1-7.3 3l-18.8 18.8V225h101.4z%22/%3E%3Cpath d=%22M232.8 254c4.6 0 8.3-3.7 8.3-8.3s-3.7-8.3-8.3-8.3-8.3 3.7-8.3 8.3 3.7 8.3 8.3 8.3zm0-14.9c3.6 0 6.6 2.9 6.6 6.6s-2.9 6.6-6.6 6.6-6.6-2.9-6.6-6.6 3-6.6 6.6-6.6z%22/%3E%3C/svg%3E');
    		}
			</style>
		</section>
	</div>
	<div id="shopify-section-1543404413256" class="shopify-section section-find-store waypoint">
		<div class="section-findstore step-up" data-delay="1">
  			<div class="contain">   
      			<h2>Где купить</h2>
    			<p>Найди ближайший часовой салон</p>
    			<a class="button" href="/pages/store-locator">Искать сейчас</a>
 			</div>
  			<img src="//cdn.shopify.com/s/files/1/0024/5084/9907/files/bremont-london-shop-58_d9e2d62f3ce4f3ee7a635226240feeca_450x450.jpg?v=1537867125" alt="bremont-london-shop-58 d9e2d62f3ce4f3ee7a635226240feeca" data-rimg srcset="//cdn.shopify.com/s/files/1/0024/5084/9907/files/bremont-london-shop-58_d9e2d62f3ce4f3ee7a635226240feeca_450x450.jpg?v=1537867125 1x" class="mobile">
			<img src="//cdn.shopify.com/s/files/1/0024/5084/9907/files/world_1920x945.png?v=1543934811" alt="world" data-rimg srcset="//cdn.shopify.com/s/files/1/0024/5084/9907/files/world_1920x945.png?v=1543934811 1x, //cdn.shopify.com/s/files/1/0024/5084/9907/files/world_2995x1474.png?v=1543934811 1.56x">
		</div>
	</div>
	<div id="shopify-section-1538048455471" class="shopify-section blogposts--section waypoint">
		<section class="blogposts--container blogposts--count-2">
  			<h1 class="home-section--title step-up" data-delay="1">Новости от Ball Watch</h1>
  			<div class="step-up" data-delay="1">
	    		<div class="home-section--content blogposts--inner" data-blog-posts>
	    			<? $posts = get_posts(array('post_type' => 'post', 'numberposts' => 2)); 
	    			foreach ($posts as $post) {
	    			?>
					<article class="article--excerpt-wrapper  ">
						<a class="article--excerpt-image" href="<? echo get_permalink($post->ID); ?>" data-rimg="lazy" data-rimg-scale="1" data-rimg-template="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" data-rimg-max="3000x1139">
	       					<noscript data-rimg-noscript>
	      						<img src="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="Bremont-Nims-Slider" data-rimg="noscript" srcset="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?> 1x, <? echo get_the_post_thumbnail_url($post->ID, 'full'); ?> 4.28x">
	      					</noscript>
	  						<img src="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="Bremont-Nims-Slider" data-rimg="lazy" data-rimg-scale="1" data-rimg-template="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" data-rimg-max="3000x1139" srcset="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>">
							<div data-rimg-canvas></div>
						</a>
	    				<div class="article--excerpt-content">
	      					<h2 class="article--excerpt-title">
						        <a href="<? echo get_permalink($post->ID); ?>">
						          <? echo $post->post_title; ?>
						        </a>
	      					</h2>
							<div class="article--excerpt-text rte">
								<? echo mb_substr($post->post_content, 0, 140)."..."; ?>
							</div>
							<a class="article--excerpt-readmore" href="<? echo get_permalink($post->ID); ?>">Читать далее
	        					<span class="article--excerpt-readmore--icon">
	          						<svg aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="8" height="6" viewBox="0 0 8 6">
	 									<g fill="currentColor" fill-rule="evenodd">
										    <polygon class="icon-chevron-down-left" points="4 5.371 7.668 1.606 6.665 .629 4 3.365"/>
										    <polygon class="icon-chevron-down-right" points="4 3.365 1.335 .629 1.335 .629 .332 1.606 4 5.371"/>
	  									</g>
									</svg>
	        					</span>
	      					</a>
	    				</div>
					</article>
					<? } ?>
				</div>
	  		</div>
			<div class="blogposts--footer step-up" data-delay="1">
	    		<a class="btn blogposts--footer-link" href="/blog">Смотреть все записи</a>
	  		</div>
		</section>
	</div>
	<div id="shopify-section-1543406731302" class="shopify-section section-contact-bar waypoint">
		<div class="section-contact-bar">
  			<div class="item step-up" data-delay="1">
      			<img src="/wp-content/themes/ball/cdn/icon-call_108x89.png" alt="icon-call" data-rimg srcset="/wp-content/themes/ball/cdn/icon-call_108x89.png" class="item-icon">
				<h6 class="desktop"><a href="tel:+74957888317">+7 495 788-83-17</a></h6>
      			<h6 class="mobile"><a href="tel:+74957888317">+7 495 788-83-17</a></h6>
    		</div>
  			<div class="item step-up" data-delay="1">
      			<img src="/wp-content/themes/ball/cdn/icon-mail_135x90.png" alt="icon-mail" data-rimg srcset="/wp-content/themes/ball/cdn/icon-mail_135x90.png 1x" class="item-icon">
				<h6><a href="mailto:info@timelight.ru">info@timelight.ru</a></h6>
    		</div>
  			<div class="item step-up" data-delay="1">
      			<img src="/wp-content/themes/ball/cdn/icon-local_66x90.png" alt="icon-local" data-rimg srcset="/wp-content/themes/ball/cdn/icon-local_66x90.png 1x" class="item-icon">
				<h6><a href="/pages/store-locator">Где купить</a></h6>
    		</div>
		</div>
	</div>
</main>
<script>
	$(function() {
    	$('.slideshow-video').get(0).play();
    });
</script>
<? get_footer(); ?>