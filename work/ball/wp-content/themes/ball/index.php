<? get_header(); ?>
<main class="site-main">
	<div class="backgroundf4f4f0">
  		<div id="shopify-section-static-blog" class="shopify-section blog--section">
			<nav class="breadcrumbs-container" aria-label="Breadcrumbs">
    			<a href="/">Главная</a>
    			<span class="breadcrumbs-delimiter" aria-hidden="true">
      				<i class="icon icon--rightarrow"></i>
    			</span>
      			<span>MediaBALL</span>
      		</nav>
			<header class="blog-header-text">
				<h2 class="blogbook__title animated fadeIn">MediaBall</h2>
			</header>
			<div class="blog--inner">
				<?
					$count_posts = wp_count_posts('post')->publish;;
					$posts = get_posts(array('post_type' => 'post', 'numberposts' => 9)); 
	    			foreach ($posts as $post) {
	    		?>
      			<article class="article--excerpt-wrapper">
					<a class="article--excerpt-image" href="<? echo get_permalink($post->ID); ?>" data-rimg="lazy" data-rimg-scale="1" data-rimg-template="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" data-rimg-max="5184x3456">
        				<noscript data-rimg-noscript>
      						<img src="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="Everest Longline-Pub-IMG 1013" data-rimg="noscript" srcset="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?> 1x, <? echo get_the_post_thumbnail_url($post->ID, 'full'); ?> 2x, <? echo get_the_post_thumbnail_url($post->ID, 'full'); ?> 3x, <? echo get_the_post_thumbnail_url($post->ID, 'full'); ?> 4x">
    					</noscript>
  						<img src="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="Everest Longline-Pub-IMG 1013" data-rimg="lazy" data-rimg-scale="1" data-rimg-template="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" srcset="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>">
						<div data-rimg-canvas></div>
					</a>
    				<div class="article--excerpt-content">
      					<h2 class="article--excerpt-title">
        					<a href="<? echo get_permalink($post->ID); ?>"><? echo $post->post_title; ?></a>
      					</h2>
						<div class="article--excerpt-text rte"><? echo mb_substr($post->post_content, 0, 140)."..."; ?></div>
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
			<!--<div class="pagination--container">
    			<ul class="pagination--inner">
					<li class="pagination--active">
              			<span class="pagination--item">1</span>
            		</li>
          			<li>
          				<a class="pagination--item" href="/blogs/blogbook?page=2">2</a>
          			</li>
        			<li>
            			<a class="pagination--item" href="/blogs/blogbook?page=3">3</a>
          			</li>
    			</ul>
  			</div>-->
		</div>
	</div>
</main>
<? get_footer(); ?>