<?php
/*
Template name: Где купить
*/
the_post();
?>
<?php get_header('standart'); ?>
     <?php //var_dump(get_field('where_to_buy')); ?>
      <section class="section section-lg section-2-columns bg-default novi-background bg-cover">
        <div class="container container-bigger">
          <div class="row row-50 justify-content-md-center align-items-lg-center justify-content-xl-between">
            <div class="col-md-9 col-lg-6 col-xxl-5">
              <h3><?php the_title(); ?></h3>
              <div class="divider divider-default"></div>
                 <!-- Map-->
		<div class="google-map">
             	<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=rJ59m0EELqFIkcg5k2iP9nyBj7n22i5T&amp;width=1170&amp;height=450&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
		</div>
	      <br>
              <p class="heading-5"><?php the_title(); ?></p>
              <p class="text-spacing-sm">

	      <?php foreach (get_field('where_to_buy') as $markets) { ?>
	      <p class="heading-5"><?php echo $markets['city']; ?></p>
       	      		      <?php foreach ($markets['markets'] as $market) { ?>
				<p><strong><?php echo $market['market_name']; ?></strong><br>
				<?php echo $market['address']; ?><br>
			 	<?php if(!empty($market['email'])) echo 'E-mail: <a href="mailto:'.$market['email'].'">'.$market['email'].'</a><br>'; ?>
			 	<?php if(!empty($market['site'])) echo '<a href="'.$market['site'].'">'.$market['site'].'</a><br>'; ?>
			      <?php } ?>
	      <br>
	      <?php } ?>

	      </p>
            </div>
          </div>
        </div>
      </section>
<?php get_footer(); ?>
