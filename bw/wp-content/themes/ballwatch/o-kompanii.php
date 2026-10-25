<?php
/*
Template name: О компании
*/
the_post();
?>
<?php get_header('standart'); ?>
      <!-- History -->
      <section class="section section-lg bg-gray-lighter novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix">
            <div class="col-sm-12 text-center">
              <h3><a href="o-kompanii/istoriya">История</a></h3>
				<div class="divider divider-default"></div>
	      <p class="heading-5 text-left"><?php echo get_field('title'); ?></p><img src="<?php echo get_template_directory_uri(); ?>/images/history-image_03.jpg" alt="" width="370" height="265" style="float: right; margin-left: 20px; margin-bottom: 20px;" /><p class="text-spacing-sm text-justify"><?php echo get_field('company_history'); ?></p>
            </div>
            </div>
          </div>
	</section>

	<section class="section section-lg bg-gray-darker novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix">
            <div class="col-sm-12">
              <h3><a href="o-kompanii/tehnologii">Технологии</a></h3>
              <div class="divider divider-default"></div>
            </div>
<? 
$args = array(
	'post_parent' => 94,
	'post_type'   => 'page', 
	'numberposts' => 6,
	'post_status' => 'publish' 
);
$children = get_children( $args );
?>
            <div class="col-xl-12">
                <div class="row">
<? foreach ($children as $child) { ?>
					<div class="col-12 col-md-6 col-lg-4" style="margin-top: 30px;">
					  <a class="gallery-item" href="<? echo get_permalink($child->ID); ?>">
						  <div class="gallery-item-image">
							<figure><img src="<?php echo get_field('обложка', $child->ID); ?>" alt=""/>
							</figure>
							<div class="caption">
							  <p class="caption-title"><? echo $child->post_title; ?></p>
							  <p class="caption-text"><? echo get_field('описание', $child->ID); ?></p>
							</div>
						  </div>
					  </a>
                  </div>
<? } ?>
				  </div>
			</div>
            </div>
          </div>
	</section>
	<!-- Explorers club -->

	<section class="section section-lg text-center bg-gray-lighter novi-background bg-cover">
        <div class="container-wide">
          <h3><a href="o-kompanii/explorers-club">Explorers Club</a></h3>
          <div class="divider divider-default"></div>
<? 
$args = array(
	'post_parent' => 330,
	'post_type'   => 'page', 
	'numberposts' => 6,
	'post_status' => 'publish' 
);
$children = get_children( $args );
?>
            <div class="col-xl-12">
                <div class="row">
<? foreach ($children as $child) { ?>
					<div class="col-12 col-md-6 col-lg-4" style="margin-top: 30px;">
					  <a class="gallery-item" href="<? echo get_permalink($child->ID); ?>">
						  <div class="gallery-item-image">
							<figure><img src="<?php echo get_field('обложка', $child->ID); ?>" alt=""/>
							</figure>
							<div class="caption">
							  <p class="caption-title"><? echo $child->post_title; ?></p>
							  <p class="caption-text"><? echo get_field('описание', $child->ID); ?></p>
							</div>
						  </div>
					  </a>
                  </div>
<? } ?>
				  </div>
			</div>
        </div>
      </section>
	
      <!-- BALL WATCH: КРЕПКИЙ ОРЕШЕК -->
      <section class="section section-lg bg-gray-darker novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix">
            <div class="col-sm-12">
              <h3>BALL WATCH:КРЕПКИЙ ОРЕШЕК</h3>
              <div class="divider divider-default"></div>
				<p></p>
</div>
<div class="col-sm-12">
	      <? echo get_field('основной_текст', 18); ?>
            </div>
            </div>
          </div>

	</section>
	<!-- Факты -->
	     <section class="section section-lg text-left bg-default novi-background bg-cover">
        <div class="container container-wide container-box-minimal-wrap">
          <div class="row row-50 justify-content-sm-center">
<? $facts = get_field('факты', 18); 
foreach ($facts as $key=>$fact) { ?>
<div class="col-sm-10 col-md-6 col-xl-4">
              <article class="box-minimal box-minimal-border">
                <div class="box-minimal-icon novi-icon mdi mdi-hangouts"></div>
                <p class="big box-minimal-title">Факт #<? echo $key + 1; ?></p>
                <hr>
                <div class="box-minimal-text text-spacing-sm"><? echo $fact['факт']; ?></div>
              </article>
            </div>
<? } ?>
          </div>
        </div>
      </section>
<?php get_footer(); ?>
