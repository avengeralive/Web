<? 
/*
Template name: Faq
*/
get_header(); the_post(); ?>
<main class="main padding">
        <div class="faq block">
          <div class="container"> 
            <div class="faq__container">
              <div class="faq__head padding wow fadeInUp">
                <h4 class="title faq__title"><? echo get_field('h1', get_the_ID()); ?></h4>
                <p class="text faq__text"><? echo get_field('text', get_the_ID()); ?></p>
              </div>
              <div class="faq__tabs padding">
                <? $section = get_field('block', get_the_ID()); ?>
                <? foreach ($section as $item) { ?>
                <div class="faq-tab wow fadeInUp">
                  <div class="faq-tab__head faq-tab__head_toggle">
                    <h5 class="faq-tab__title"><? echo $item['h2']; ?></h5><span class="faq-tab__ind"></span>
                  </div>
                          <div class="faq-tab__dropdown">
                            <div class="faq-tab__content">
                              <? foreach ($item['questions'] as $qs) { ?>
                              <div class="sub-tab">
                                <div class="sub-tab__head">
                                  <h6 class="sub-tab__title"><? echo $qs['question']; ?></h6>
                                </div>
                                <div class="sub-tab__dropdown">
                                  <div class="sub-tab__content">
                                    <p class="text sub-tab__text"><? echo $qs['answer']; ?></p>
                                  </div>
                                </div>
                              </div>
                             <? } ?>
                            </div>
                          </div>
                </div>
                <? } ?>
                <div class="faq-tab faq-tab_info wow fadeInUp">
                  <div class="faq-tab__head">
                    <h5 class="faq-tab__title">Need More Help?</h5>
                    <div class="faq-tab__contacts">
                      <ul class="faq-tab__contacts-list">
                        <li class="faq-tab__contacts-item"><a class="button button_style1 faq-tab__button" href="<? echo get_field('button_1_url', get_the_ID()); ?>"><? echo get_field('button_1_title', get_the_ID()); ?></a></li>
                        <!--<li class="faq-tab__contacts-item"><a class="button button_style1 faq-tab__button" href="<? echo get_field('button_2_url', get_the_ID()); ?>"><? echo get_field('button_2_title', get_the_ID()); ?></a></li>-->
                        <li class="faq-tab__contacts-item"><span class="faq-tab__contacts-label"></span><? echo get_field('phone', get_the_ID()); ?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
<? get_footer(); ?>