<?php
/*
Template name: Статьи и обзоры главная
*/
the_post();
?>
<?php get_header('standart'); ?>
      <section class="section section-lg bg-gray-lighter novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix">
            <div class="col-sm-12">
              <h3><?php the_title(); ?></h3>
              <div class="divider divider-default"></div>
            </div>
          </div>
          <div class="row row-30 justify-content-sm-center">
            <div class="col-xl-12">
                <div class="row">
<? 
$args = array(
	'post_parent' => 20,
	'post_type'   => 'page', 
	'numberposts' => -1,
	'post_status' => 'publish' 
);
$children = get_children( $args );
?>
<? foreach ($children as $child) { ?>
            <div class="col-md-6 col-xl-6 col-xxl-6">

              <article class="post-blog-large">
                <figure class="post-blog-large-image"><img src="<?php echo get_field('обложка', $child->ID); ?>" alt="" width="343" height="215"/>
                </figure>
                <div class="post-blog-large-caption">
                  <ul class="post-blog-tags">
                  </ul><a class="post-blog-large-title" href="<?php echo get_permalink($child->ID); ?>"><?php echo $child->post_title; ?></a>
                  <p class="post-blog-large-text"><?php echo get_field('description', $child->ID); ?></p><a class="button button-xs button-secondary button-nina" href="<?php echo get_permalink($child->ID); ?>">Читать дальше</a>
                </div>
              </article>
            </div>
<? } ?>
	</div>
	</div>
	</div>
      </section>
<?php get_footer(); ?>
