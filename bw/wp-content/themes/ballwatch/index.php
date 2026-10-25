<?php the_post(); get_header(); ?>
        <section>
          <!-- Welcome To-->
          <div class="swiper-container swiper-slider swiper-modern" data-loop="true" data-autoplay="5500" data-simulate-touch="false">
            <div class="swiper-wrapper">
	    <?php foreach (get_field('slider') as $slider) { ?>
	      <div class="swiper-slide" data-slide-bg="<?php echo get_template_directory_uri(); ?>/images/<?php echo $slider['image_name']; ?>">
                <div class="swiper-slide-caption">
                  <div class="section-lg context-dark text-center">
                    <div class="container container-wide">
                      <div class="row row-fix justify-content-sm-center">
                        <div class="col-xxl-10">
			<?php if (!empty($slider['pre_title'])) echo '<div class="heading-decor" data-caption-animate="fxRotateInDown" data-caption-delay="550"><span>'.$slider['pre_title'].'</span></div>' ?>
                          <h2 data-caption-animate="fxRotateInDown" data-caption-delay="550" class="heading-1"><?php echo $slider['title']; ?></h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
	      <?php } ?>
            <!-- Swiper controls-->
            <div class="swiper-pagination-wrap">
              <div class="swiper-pagination"></div>
            </div>
          </div>
			</div>
        </section>
<section class="section section-lg novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix justify-content-sm-center">
            <div class="col-sm-12">
              <h3><a href="o-kompanii/tehnologii">Самый технологичный бренд</a></h3>
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
			  <a class="button button-secondary button-nina" href="o-kompanii/tehnologii">Все технологии</a>
            </div>
          </div>
	</section>
<section class="section section-lg bg-gray-darker novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix justify-content-sm-center">
            <div class="col-sm-12">
              <h3><a href="o-kompanii/istoriya">О бренде</a></h3>
				<div class="divider divider-default"></div>
	      <p class="heading-5 text-left"><?php echo get_field('title', 18); ?></p><img src="<?php echo get_template_directory_uri(); ?>/images/history-image_03.jpg" alt="" width="370" height="265" style="float: right; margin-left: 20px; margin-bottom: 20px;" /><p class="text-spacing-sm text-justify"><?php echo get_field('company_history', 18); ?></p>
			</div>
			  <a class="button button-secondary button-nina" href="o-kompanii/istoriya">Подробнее</a>
            </div>
          </div>
	</section>
      <!-- Предзаказ -->
      <section class="section section-lg section-2-columns bg-default novi-background bg-cover">
        <div class="container container-bigger">
          <div class="row row-50 justify-content-md-center align-items-lg-center justify-content-xl-between">
	  <?php foreach (get_field('preorders') as $preorder) { ?>
            <div class="col-md-12">
              <h3><?php echo $preorder['title']; ?></h3>
              <div class="divider divider-default"></div>
			  </div>
			   <div class="col-md-12 text-justify"><img src="<?php echo $preorder['image']; ?>" alt="" width="auto" height="auto" style="float:right; margin-left: 20px; margin-bottom: 20px;"/><p class="heading-5"><a href="<?php echo $preorder['link']; ?>" target="_blank"><?php echo $preorder['model_preorder']; ?></a></p>
              <p class="text-spacing-sm"><?php echo $preorder['message']; ?></p><a class="button button-default-outline button-nina" href="<?php echo $preorder['link']; ?>">Перейти на страницу предзаказа</a>
	    </div>
	<?php } ?>
          </div>
        </div>
      </section>

      <!-- Blog posts-->
      <!--<section class="section section-lg bg-gray-lighter novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix">
            <div class="col-sm-12">
              <h3>Новости</h3>
              <div class="divider divider-default"></div>
            </div>
          </div>
          <div class="row row-30 justify-content-sm-center">
            <div class="col-xl-12">
                <div class="row">
<? 
$args = array(
	'post_parent' => 190,
	'post_type'   => 'page', 
	'numberposts' => 6,
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
<? } ?></div>
	</div><a class="button button-secondary button-nina" href="o-kompanii/novosti">Все новости</a>
	</div>
		  </div>
      </section>-->

      <section class="section section-lg text-center bg-gray-lighter novi-background bg-cover">
        <div class="container-wide">
          <h3>Галерея</h3>
          <div class="divider divider-default"></div>
          <div class="isotope-wrap row row-0 row-fix justify-content-sm-center">
            <div class="col-xl-12">
              <div class="isotope isotope-default" data-isotope-layout="masonry" data-isotope-group="gallery-01" data-lightgallery="group">
                <div class="row">
<? $images = get_field('галлерея', 2);
foreach ($images as $key=>$image) { ?>
                  <div class="col-12 col-md-6 col-lg-4 isotope-item" data-filter="type 1"><a class="gallery-item" href="<? echo $image['фото']; ?>" data-lightgallery="item">
                      <div class="gallery-item-image">
                        <figure><img src="<? echo $image['фото']; ?>" alt="" width="570" height="790"/>
                        </figure>
                      </div></a>
                  </div>
<? if ($key >= 5) break; } ?>
                </div>
              </div>
            </div>
			  <a class="button button-secondary button-nina" href="/galereya/">Вся галерея</a>
          </div>
        </div>
      </section>
<?php get_footer(); ?>
