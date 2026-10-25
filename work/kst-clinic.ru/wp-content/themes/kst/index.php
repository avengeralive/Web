<? get_header(); ?>
<? if (!is_front_page()) { ?>
<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 breadcrumbs">
<? bcn_display(); ?>
</div>
<? } ?>



<section id="main-content" class="home">
<? do_action('left_sidebar'); ?>
	<div class="col col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9" id="content">
<?
	while ( have_posts() ) : the_post();
		$banner = get_field('баннер_страницы', get_the_ID());
		$banner_title = get_field('запись_на_баннере', get_the_ID());
?>
		<script>
			$('.parallax-window').parallax({imageSrc: '<? echo $banner['url']; ?>'});
			$('#banner_title').html('<? echo $banner_title; ?>');
		</script>
		<article itemscope itemtype="http://schema.org/Article">
			<span itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
				<img itemprop="url image" src="https://kst-clinic.ru/wp-content/themes/kst/images/logo.png" style="display:none;" alt="Клиника Современных Технологий" />
				<meta itemprop="width" content="64">
				<meta itemprop="height" content="64">
			</span>
			<div itemid="<?php the_permalink() ?>" itemprop="mainEntityOfPage" style="display: none;">
				<h1 itemprop="headline"><? the_title(); ?></h1>
			</div>
			<div itemprop="articleBody">
				<? the_content(); ?>
			</div>
			<span itemprop="author"><a style="display:none;" href="https://kst-clinic.ru">Клиника Современных Технологий</a></span>
			<time class="post-time" itemprop="datePublished" datetime="<? the_date('Y-m-d'); ?>"></time>
			<time class="post-time" itemprop="dateModified" datetime="<? the_modified_time('Y-m-d'); ?>"></time>
			<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
				<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
					<img itemprop="url image" src="https://kst-clinic.ru/wp-content/themes/kst/images/logo.png" alt="Клиника Современных Технологий" style="display:none;" />
					<meta itemprop="width" content="64">
					<meta itemprop="height" content="64">
				</div>
				<meta itemprop="name" content="Клиника женского и мужского здоровья">
				<meta itemprop="address" content="Москва, ул. Большой Головин переулок, д. 4">
			</div>
		</article>
<?
	endwhile;
?>		
	</div>
	<? do_action('left_sidebar_mobile'); ?>
</section>
<? get_footer(); ?>