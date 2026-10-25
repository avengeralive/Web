<?php
/*
Template Name: New.Infoshell "Our Work"
*/
require 'index.header.php';
?>
<section class="infoshel-main-ourWork">
<div class="infoshel-container container">
    <h2 class="infoshel-h2 infoshel-main-ourWork__h2">Наши работы</h2>
    <span class="infoshel-main-ourWork__title-span">Мы превращаем идеи в отличные результаты</span>
	
	<ul class="infoshel-main-ourWork__buttons nav nav-pills" role="tablist">
		<li class="infoshel-main-ourWork__tab nav-item">
			<a class="nav-link active" id="mobile_app-tab" data-toggle="pill" href="#mobile_app" role="tab" aria-controls="mobile_app" aria-selected="true">Моб. приложения</a>
		</li>
		<li class="infoshel-main-ourWork__tab nav-item">
			<a class="nav-link" id="web_services-tab" data-toggle="pill" href="#web_services" role="tab" aria-controls="web_services" aria-selected="false">Веб-Сервисы</a>
		</li>
	</ul>
	
    <div class="tab-content" id="pills-tabContent">
		<div id="mobile_app" class="tab-pane active" role="tabpanel" aria-labelledby="mobile_app-tab">
			<div class="infoshel-main-ourWork__flex-container">
				<div class="infoshel-main-ourWork__text">
				  <h3>InfoShell.Mobile</h3>
				  <p>Разрабатываем мобильные IT-решения для fintch,<br>
                      e-commerce и маркетплейсов.<br>
                      <br>
                      С собственной продуктовой аналитикой, дизайном,<br>
                      веб и мобильной разработкой.
                  </p>
				</div>
				<div class="infoshel-main-ourWork__video">
					<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) { ?>
					<iframe width="100%" height="100%" src="https://www.youtube.com/embed/yHoZVMRBhz4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					<? } ?>
				</div>
			</div>
		</div>
		<div id="web_services" class="tab-pane" role="tabpanel" aria-labelledby="web_services-tab">
			<div class="infoshel-main-ourWork__flex-container">
				<div class="infoshel-main-ourWork__text">
				  <h3>InfoShell.WebServices</h3>
				  <p>Мы помогаем крупному бизнесу создавать масштабные цифровые продукты:<br><br>
				  Веб-сервисы, CRM/ERP; корпоративные порталы, системы электронной коммерции (e-commerce); программы лояльности</p>
				</div>
				<div class="infoshel-main-ourWork__video">
					<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) { ?>
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/wFtIyKWlsYA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                	<? } ?>
				</div>
			</div>
		</div>
    </div>
</div>	
</section>

<section>
    <div class="infoshel-container container">
	
		<ul class="infoshel-main-ourWork__buttons nav nav-pills">
			<li class="infoshel-main-ourWork__tab"><a data-toggle="pill" href="#ourWork_category_0" class="active">Все</a></li>
			<li class="infoshel-main-ourWork__tab"><a data-toggle="pill" href="#ourWork_category_1">Приложения</a></li>
			<li class="infoshel-main-ourWork__tab"><a data-toggle="pill" href="#ourWork_category_2">Web сервисы</a></li>
			<li class="infoshel-main-ourWork__tab"><a data-toggle="pill" href="#ourWork_category_3">Игры</a></li>
		</ul>
		
		<div class="tab-content">
			<?php
			$post_categories = [[10,11,12],12,10,11];
			foreach($post_categories as $i => $category) {
			?>
			<div id="ourWork_category_<?php echo $i; ?>" class="tab-pane in <?php if($i == 0) echo 'active'; ?>">
                <div class="row clearfix"><br/><br/></div>
				<div class="row">
				<?php
				$posts = get_posts(array(
					'category'=>$category,
					'orderby'=>'date',
					'posts_per_page'=>48,
					'order'=>'DESC'
				));

				foreach($posts as $post) {
					setup_postdata($post);
					$img = wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'full');
                    ?>
				<div class="col-4">
				  <div class="infoshel-main-ourWork__slider-img">
                      <a href="<?php the_permalink(); ?>">
                          <div class="ourWork-swiper-slide-img">
                              <img src="<?php echo $img; ?>" alt="">
							  <?if(get_field('type_apple') || get_field('type_android') || get_field('type_windows')):?>
                                  <div class="ourWork-markers">
									  <?if(get_field('type_apple')):?>
                                          <span class="infoshel-main-ourWork__slider-img-icon infoshel-main-ourWork__icon-ios infoshel-main-ourWork__icon-surfprise-ios"></span>
									  <?endif;?>
									  <?if(get_field('type_android')):?>
                                          <span class="infoshel-main-ourWork__slider-img-icon infoshel-main-ourWork__icon-android infoshel-main-ourWork__icon-surfprise-android"></span>
									  <?endif;?>
									  <?if(get_field('type_windows')):?>
                                          <span class="infoshel-main-ourWork__slider-img-icon infoshel-main-ourWork__icon-web infoshel-main-ourWork__icon-surfprise-web"></span>
									  <?endif;?>
                                  </div>
							  <?endif;?>
                          </div>
                          <h4><?php the_title(); ?></h4>
                          <p><?php echo (get_post_meta($post->ID, 'short_description', true)); ?></p>
                      </a>
				</div>
				</div>
				<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
    </div>
</section>
<div class="row clearfix"><br/><br/></div>
<?php require 'index.footer.php'; ?>