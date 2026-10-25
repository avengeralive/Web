<? 
/*
Template name: Charger
*/
get_header(); the_post(); ?>
<main class="main padding">
        <div class="charger block">
          <div class="charger__container">
            <div class="charger__scene" id="scene">
              <div class="charger__background"></div>
            </div>
          </div>
          <div class="container">
            <div class="charger__container wow fadeIn">
              <h4 class="title charger__title"><? echo get_field('title', get_the_ID()); ?></h4>
            </div>
            <div class="charger__container form-container wow fadeIn">
              <p class="form_description"><? echo get_field('text', get_the_ID()); ?></p>
            </div>
            <div class="charger__container form-container wow fadeIn">
              <? echo do_shortcode('[contact-form-7 id="178" title="Charger"]'); ?>
            </div>
            <div class="charger__container">
              <h4 class="title charger__title wow fadeIn"><? echo get_field('header', get_the_ID()); ?></h4>
            </div>
            <div class="charger__container">
              <div class="charger_list wow fadeInLeft">
                <h3><? echo get_field('heading_1', get_the_ID()); ?></h3>
                <p><? echo get_field('text_1', get_the_ID()); ?></p>
              </div>
              <div class="charger_list wow fadeInUp">
                <h3><? echo get_field('heading_2', get_the_ID()); ?></h3>
                <p><? echo get_field('text_2', get_the_ID()); ?></p>
              </div>
              <div class="charger_list wow fadeInRight">
                <h3><? echo get_field('heading_3', get_the_ID()); ?></h3>
                <p><? echo get_field('text_3', get_the_ID()); ?></p>
              </div>
            </div>
          </div>
        </div>
      </main>
<? get_footer(); ?>