<?php
/*
Template Name Posts: Блог
*/
get_header();
require_once(locate_template('ImagePreview.php'));
?>
<!-- Styles for Blog -->
<link rel="stylesheet" href="/wp-content/themes/mark_up/css/post_blog.css">

<section class="section-blog">
    
</section>

<section class="blog-container">
		<div class="container">
        

		<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-md-8" itemscope itemtype="http://schema.org/Article">
				<div class="post_img"><?php the_post_thumbnail('blog_big', array('itemprop' => 'image')); ?></div>
				<div class="social">
					<script type="text/javascript">(function() {
					  if (window.pluso)if (typeof window.pluso.start == "function") return;
					  if (window.ifpluso==undefined) { window.ifpluso = 1;
						var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
						s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
						s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
						var h=d[g]('body')[0];
						h.appendChild(s);
					  }})();</script>
					<div class="pluso" data-background="none;" data-options="small,square,line,horizontal,counter,sepcounter=1,theme=14" data-services="vkontakte,facebook,twitter,google"></div>
				</div>
				<h1 class="post_title" itemprop="headline"><?php the_title(); ?></h1>
				
				<div class="post_date"><?php the_time('j F y'); ?>
                <meta itemprop="name" content="<?php the_title(); ?>"/>
                <meta itemprop="author" content="Infoshell.ru"/>
                <div itemprop="publisher" itemscope="itemscope" itemtype="https://schema.org/Organization">
                    <link itemprop="url" href="https://infoshell.ru/"> 
                    <meta itemprop="name" content="Infoshell.ru" />
                    <meta itemprop="telephone" content="+7 (495) 215-51-82" />
                    <meta itemprop="address" content="Россия, г. Москва, ст. метро Маяковская, 1-я Тверская-Ямская улица, 16/23, оф. 8"/>
                    <meta itemprop="email" content="info@infoshell.ru" />
                    <meta itemprop="logo" content="https://infoshell.ru/wp-content/themes/mark_up/images/logo.jpg" />
                </div>
				<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>"/>
				</div>
				<div class="post_content" itemprop="articleBody"><?php the_content(); ?></div>
			</div>
			<?php endwhile; ?>
	
			<div class="col-md-4">
				<div class="search">
					<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="text" class="field" name="s" id="s" value="" placeholder="Поиск ..." />
						<input type="submit" class="submit" name="submit" id="searchsubmit" value="" />
					</form>
					<div class="clear"></div>
				</div>
				<div class="last-news__title">ПОСЛЕДНИЕ НОВОСТИ:</div>
			
				<div class="clearfix">
				<?php query_posts('category_name=blog&orderby=date&order=DESC&posts_per_page=3');?>	
				<?php if ( have_posts() ) : ?>
					<?php
					while ( have_posts() ) : the_post();
                        $link = get_permalink();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'big');
                        if (!empty($image)) {
                            $image[0] = str_replace(get_bloginfo('url').'/', '', $image[0]);
                            $preview = ImagePreview::createPreview($image[0], 225, 150);

                        }
                        ?>
						<div class="news">
							<div class="n_img"><img src="<?=$preview?>" alt="<?php the_title(); ?>"/></div>
							<div class="n_title"><a href="<?=$link?>"><?php the_title(); ?></a></div>
							<div class="n_date">
								<?php the_time('j F y'); ?>
							</div>
						</div>
					<?php
					endwhile; ?>
				<?php endif; wp_reset_query();?>
				</div>
			</div>


			</div>
		
	</div>
</section>

<?php get_footer(); ?>