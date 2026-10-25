<? 
/*
Template name: About
*/
get_header(); the_post(); ?>
<main class="main padding">
        <div class="about-block block padding">
          <div class="container">
            <div class="about-block__container padding">
              <? $list = get_field('list', get_the_iD());  ?>
				<h4 class="title about-block__title onlmo"><? echo $list[0]['title']; ?></h4>
				<?
              foreach ($list as $key => $value) {
                if ($key % 2 == 0) {
              ?>
              <div class="about-block__row wow slideInLeft">
                <div class="about-block__section">
                  <div class="about-block__text">
                    <h4 class="title about-block__title <? if ($key == 0) { echo 'fc'; }?>"><? echo $value['title']; ?></h4>
                    <p class="about-block__text"><? echo $value['text']; ?></p>
                    <? if ($value['list']) { ?>
                    <ul class="about-block__list">
                      <? foreach ($value['list'] as $item) { ?>
                      <li><? echo $item['item']; ?></li>
                      <? } ?>
                    </ul>
                    <? } ?>
                  </div>
                </div>
                <div class="about-block__section about-block__section_image">
                  <div class="about-block__image"><img class="lazy" data-src="<? echo get_template_directory_uri(); ?>/img/icons/about<? echo $key + 1; ?>.svg" alt=""></div>
                </div>
              </div>
              <? } else { ?>
              <div class="about-block__row wow slideInRight">
                <div class="about-block__section about-block__section_image">
                  <div class="about-block__image"><img class="lazy" data-src="<? echo get_template_directory_uri(); ?>/img/icons/about<? echo $key + 1; ?>.svg" alt=""></div>
                </div>
                <div class="about-block__section">
                  <div class="about-block__text">
                    <h4 class="title about-block__title"><? echo $value['title']; ?></h4>
                    <p class="about-block__text"><? echo $value['text']; ?></p>
                    <? if ($value['list']) { ?>
                    <ul class="about-block__list">
                      <? foreach ($value['list'] as $item) { ?>
                      <li><? echo $item['item']; ?></li>
                      <? } ?>
                    </ul>
                    <? } ?>
                  </div>
                </div>
              </div>
              <? } ?>
            <? } ?>
            </div>
          </div>
        </div>
      </main>
<? get_footer(); ?>