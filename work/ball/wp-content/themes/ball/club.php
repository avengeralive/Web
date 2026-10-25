<?
/*
Template name: Клуб
*/
get_header();
?>
<main class="site-main">
  <div class="rte bagel">
    <div class="html craftcms">
      <div class="body" id="topofpage">
        <main class="site-content" role="main">
          <div class="content pt--xlarge">
            <div class="content__container">
              <h1 class="animated fadeIn" data-action="has-animation" data-animation-type="fadeIn" data-animation-index="title-02">Клуб исследователей</h1>
                <div class="listing__items listing__items--partners">
                  <?
                  $posts = get_posts(array('post_type' => 'page', 'post_parent' => get_the_ID(), 'numberposts' => -1)); 
                    foreach ($posts as $post) {
                  ?>
                  <article class="listing__item listing__item--odd animated fadeInUp" data-action="has-animation" data-animation-type="fadeInUp" data-animation-index="col-listing-standard-29479">
                    <a class="listing__item__link" href="<? echo get_permalink($post->ID); ?>">
                      <figure role="img" class="listing__item__figure">
                        <img class="listing__item__image listing__item__image--active" style="" width="" height="" src="<? echo get_the_post_thumbnail_url($post->ID, 'full'); ?>">
                      </figure>
                      <h2 class="listing__item__title"><? echo $post->post_title; ?></h2>
                    </a>
                  </article>
                  <? } ?>
                </div>
            </div>
          </div>
          <style>
            [data-action=has-animation] {
              opacity: 1 !important;
            }
          </style>
        </main>
      </div>
    </div>
  </div>
</main>
<? get_footer(); ?>