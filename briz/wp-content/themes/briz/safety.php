<? 
/*
Template name: Safety
*/
get_header(); the_post(); ?>
<main class="main padding">
        <div class="safety block">
          <div class="container">
            <div class="safety__container">
              <div class="safety__top-section padding wow fadeInLeft">
                <h4 class="title"><? echo get_field('block_heading', get_the_ID()); ?></h4>
                <p class="safety__text"><? the_content(); ?></p>
              </div>
              <? $section = get_field('section', get_the_ID()); ?>
              <? foreach ($section as $item) { ?>
              <div class="safety-section padding wow <? echo $item['effect']; ?>">
                <div class="safety-section__container">
                  <div class="safety-section__info">
                    <h4 class="title safety-section__title"><? echo $item['h4']; ?></h4>
                    <p class="text safety-section__text"><? echo $item['paragraph']; ?></p>
                  </div>
                  <div class="safety-section__image cover-box"><img class="lazy" data-src="<? echo $item['image']; ?>" alt=""></div>
                </div>
              </div>
              <? } ?>
              <div class="safety-section safety-section_row padding">
                <? $block = get_field('block', get_the_ID()); ?>
                <? foreach ($block as $item) { ?>
                <div class="safety-block wow <? echo $item['effect']; ?>">
                  <div class="safety-block__container">
                    <div class="safety-block__image"><img class="lazy" data-src="<? echo $item['image']; ?>" alt=""></div>
                    <h4 class="title safety-block__title"><? echo $item['h4']; ?></h4>
                    <p class="text safety-block__text"><? echo $item['paragraph']; ?></p>
                  </div>
                </div>
                <? } ?>
              </div>
            </div>
          </div>
        </div>
      </main>
<? get_footer(); ?>