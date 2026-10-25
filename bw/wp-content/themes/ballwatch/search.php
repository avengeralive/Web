<?php get_header('standart'); ?>
      <section class="section section-lg bg-gray-lighter novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix">
            <div class="col-sm-12">
              <h3>Результаты поиска</h3>
              <div class="divider divider-default"></div>
            </div>
          </div>
          <div class="row row-30 justify-content-sm-center">
            <div class="col-xl-12">
                <div class="row">

<? while (have_posts()) { the_post(); ?>
            <div class="col-md-6 col-xl-6 col-xxl-6">

              <article class="post-blog-large">
                <figure class="post-blog-large-image"><img src="<?php echo get_field('обложка', get_the_ID()); ?>" alt="" width="343" height="215"/>
                </figure>
                <div class="post-blog-large-caption">
                  <ul class="post-blog-tags">
                  </ul><a class="post-blog-large-title" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                  <p class="post-blog-large-text"><?php echo get_field('description', get_the_ID()); ?></p><a class="button button-xs button-secondary button-nina" href="<?php echo get_permalink(); ?>">Читать дальше</a>
                </div>
              </article>
            </div>
<? } ?>
	</div>
	</div>
	</div>
      </section>
<?php get_footer(); ?>
