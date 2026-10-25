<?php
/*
Template name: Сервис
*/
the_post();
?>
<?php get_header('standart'); ?>
     <!-- Service -->
      <section class="section section-lg section-2-columns bg-default novi-background bg-cover">
        <div class="container container-bigger">
          <div class="row row-50 justify-content-md-center align-items-lg-center justify-content-xl-between">
            <div class="col-md-9 col-lg-6 col-xxl-5">
              <h3><?php the_title(); ?></h3>
              <div class="divider divider-default"></div>
                 <!-- Map-->
		<div class="google-map">
            	<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=m0XhfvlNMr-2gpO_12Ot3gx0afWaILeD&width=1170&height=450"></script>
		</div>
	      <br><br><br>
	      <h3>Авторизованный гарантийный сервисный центр часов BALL</h3>
	      <br>
      	      <p class="heading-5"><?php echo get_field('city'); ?></p>
			<p><strong><?php echo get_field('market_name'); ?></strong><br>
			<?php echo get_field('address'); ?><br>
		 	<?php if(!empty(get_field('email'))) echo 'E-mail: <a href="mailto:'.get_field('email').'">'.get_field('email').'</a><br>'; ?>
		 	<?php if(!empty(get_field('site'))) echo '<a href="'.get_field('site').'">'.get_field('site').'</a><br>'; ?>
	      <br>
	      </p>
              <p class="text-spacing-sm"><?php the_content(); ?></p>
            </div>
          </div>
        </div>
      </section>
<?php get_footer(); ?>
