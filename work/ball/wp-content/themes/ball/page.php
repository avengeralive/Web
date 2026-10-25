<? get_header(); the_post(); ?>
<main class="site-main" >
  <div id="shopify-section-static-product" class="shopify-section product--section">
    <nav class="breadcrumbs-container">
      <a href="/">Главная</a>
        <span class="breadcrumbs-delimiter" aria-hidden="true">
          <i class="icon icon--rightarrow"></i>
        </span>
        <span><? the_title(); ?></span>
    </nav>
    <div class="productgrid--masthead">
        <figure class="collection--image">
          <noscript data-rimg-noscript="">
            <img src="<? echo get_the_post_thumbnail_url(10, 'full'); ?>" alt="Bremont Spitfire Graphic Solo" data-rimg="noscript" srcset="<? echo get_the_post_thumbnail_url(10, 'full'); ?> 1x, <? echo get_the_post_thumbnail_url(10, 'full'); ?> 1.62x">
          </noscript>
          <img src="<? echo get_the_post_thumbnail_url(10, 'full'); ?>" alt="Bremont Spitfire Graphic Solo" data-rimg="loaded" data-rimg-scale="1" data-rimg-template="<? echo get_the_post_thumbnail_url(10, 'full'); ?>" data-rimg-max="2200x777" srcset="<? echo get_the_post_thumbnail_url(10, 'full'); ?> 1.31x" data-rimg-template-svg="data:image/svg+xml;utf8,<svg%20xmlns='http://www.w3.org/2000/svg'%20width='1350'%20height='477'></svg>">
        <div data-rimg-canvas=""></div>
      </figure>
        <div class="collection--information">
          <h1 class="collection--title"><? the_title(); ?></h1>
        </div>
    </div>
    <div class="html craftcms">
      <div class="content pt--xlarge" style="padding-bottom: 50px;">
        <div class="content__container">
          <? the_content(); ?>
        </div>
      </div>
    </div>
  </div>
</main>
<? get_footer(); ?>