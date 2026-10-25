<? get_header(); the_post(); ?>
      <div class="home">
        <div class="home__scene" id="scene">
          <div class="home__background" data-limit-x="10" data-depth="1"></div>
        </div>
        <div class="container">
          <div class="home__container">
            <h1 class="home__title"><? echo get_field('h1', get_the_ID()); ?></h1>
            <a class="button button_style1 home__button" href="<? echo get_field('main_link_url', get_the_ID()); ?>"><? echo get_field('main_link_title', get_the_ID()); ?></a>
            <img class="home__icon" src="<? echo get_template_directory_uri(); ?>/img/icons/map-pin.svg" alt="">
            <div class="home__images">
              <img class="home__image home__image_wooman" src="<? echo get_template_directory_uri(); ?>/img/icons/woman.png" alt="">
              <img class="home__image home__image_left" src="<? echo get_template_directory_uri(); ?>/img/icons/samokat_left.png" alt="">
              <img class="home__image home__image_right" src="<? echo get_template_directory_uri(); ?>/img/icons/samokat_right.png" alt="">
              <img class="home__image home__image_man" src="<? echo get_template_directory_uri(); ?>/img/icons/man.png" alt="">
            </div>
          </div>
        </div>
      </div>
      <main class="main padding">
        <div class="features padding block">
          <div class="container">
            <div class="features__container">
              <? $icons = get_field('icon_block', get_the_ID()); 
              foreach ($icons as $key => $icon) {
              ?>
              <div class="features-block wow <? if ($key % 2 == 0) { ?>fadeInLeft<? } else { ?>fadeInRight<? } ?>">
                <div class="features-block__container">
                  <div class="features-block__image"><img class="lazy" data-src="<? echo $icon['image']; ?>" alt=""></div><span class="features-block__title"><? echo $icon['title']; ?></span>
                </div>
              </div>
              <? } ?>
            </div>
          </div>
        </div>
        <div class="advantages block padding">
          <div class="advantages__container">
            <div class="advantages-section padding">
              <div class="container">
                <div class="advantages-section__container padding">
                  <div class="advantages-section__content wow slideInLeft">
                    <h4 class="title advantages-section__title"><? echo get_field('block_1_heading', get_the_ID()); ?></h4>
                    <h5 class="sub-title advantages-section__sub-title"><? echo get_field('block_1_subheading', get_the_ID()); ?></h5>
                    <p class="text advantages-section__text"><? echo get_field('block_1_text', get_the_ID()); ?></p>
                  </div>
                  <div class="advantages-section__image advantages-section__image_scooter wow slideInRight">
                    <div class="advantages-section__scooter"><img class="lazy" data-src="<? echo get_field('block_1_image', get_the_ID()); ?>" alt=""></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="advantages-section padding">
              <div class="container">
                <div class="advantages-section__container padding">
                  <div class="advantages-section__image wow slideInLeft">
                    <div class="advantages-section__phone"><img class="lazy" data-src="<? echo get_field('block_2_image', get_the_ID()); ?>" alt=""></div>
                  </div>
                  <div class="advantages-section__content wow slideInRight">
                    <h4 class="title advantages-section__title"><? echo get_field('block_2_heading', get_the_ID()); ?></h4>
                    <div class="advantages-section__list">
                      <ul>
                        <? $icons = get_field('block_2_list', get_the_ID()); 
                        foreach ($icons as $icon) {
                        ?>
                        <li class="advantages-section__item"><? echo $icon['item']; ?></li>
                        <? } ?>
                      </ul>
                    </div><a class="link-more" href="<? echo get_field('block_2_link', get_the_ID()); ?>"><? echo get_field('block_2_link_text', get_the_ID()); ?> </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      <style>.breadcrumbs{display: none;}</style>
<? get_footer(); ?>