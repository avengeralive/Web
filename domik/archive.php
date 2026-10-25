<? get_header(); ?>
<div class="" id="wrapper" style="opacity: 1;">
	<div class="content-holder elem transition3">
		<div class="content">
            <div class="bg-animate" style="opacity: 0.6;">
            	<img src="/wp-content/themes/domik/images/body-bg.png" width="1053" height="1053" class="respimg" alt="rotate background">
            </div>
    		<div class="wrapper-inner" style="opacity: 1;">
            	<section class="no-padding no-border">
    				<div class="domik_container">
        				<div class="page-title">
            				<h1 class="title">Колумна</h1>
            			</div>
    				</div>
				</section>
				<div class="clearfix"></div>
				<div class="domik_container domik-blog">
    				<section>
    					<div class="row">
        					<div class="col-md-12 nosidebar blog-posts-column">
	    						<div class="gallery-items two-coulms grid-small-pad" style="position: relative; height: 1902.52px;">
	    							<div class="grid-sizer"></div>
	    							<? while (have_posts()) : the_post(); ?>							
										<div class="content-content gallery-item post-784 post type-post status-publish format-standard has-post-thumbnail hentry category-free category-web-design tag-art tag-image tag-web-design" style="position: absolute; left: 0%; top: 0px;">
    										<div class="grid-item-holder">
        										<article>
													<div class="blog-media">
														<div class="box-item">
											                <a href="<? the_permalink(); ?>" class="ajax">
												                <span class="overlay"></span>
												                <img width="1000" height="605" src="<? echo get_the_post_thumbnail_url(); ?>" class="respimg wp-post-image" alt="" srcset="<? echo get_the_post_thumbnail_url(); ?> 1000w, <? echo get_the_post_thumbnail_url(); ?> 300w, <? echo get_the_post_thumbnail_url(); ?> 768w" sizes="(max-width: 1000px) 100vw, 1000px">
												            </a>
											            </div>
		    										</div>       
            										<div class="blog-text">
                										<h3 class="post-title"><a class="ajax" href="<? the_permalink(); ?>"><? the_title(); ?></a> </h3>   
                										<p><? the_excerpt(); ?></p> 				
														<div class="clearfix"></div>
														<a href="<? the_permalink(); ?>" class="ajax btn"><span>читать далее </span> <i class="fa fa-long-arrow-right"></i></a>
            										</div>
        										</article>
    										</div>
										</div>
										<? endwhile; ?>
									</div>
				 				</div>
        					</div>
    					</section>
    				</div>
                </div>
    				<div class="img-wrap hide_with_full">
        				<div class="bg skrollable skrollable-between" style="background-image: url(/wp-content/uploads/2018/05/DIA_1511TIFF.jpg); transform: translateY(77.96px);" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
    <div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div><div class="scale-callback scale-bg5"></div></div>
        <? get_footer(); ?>