<footer class="footer block">
        <div class="container">
          <div class="footer__container">
            <div class="footer__section footer__section_nav">
              <ul class="footer__list">
                <li class="footer__item footer__item_title">COMPANY</li>
                <? $menu = wp_get_nav_menu_items('Company'); ?>
                <? foreach ($menu as $elem) { ?>
                <li class="footer__item"><a class="footer__link" href="<? echo $elem->url; ?>"><? echo $elem->title; ?></a></li>
                <? } ?>
              </ul>
              <ul class="footer__list">
                <li class="footer__item footer__item_title">RIDER</li>
                <? $menu = wp_get_nav_menu_items('Rider'); ?>
                <? foreach ($menu as $elem) { ?>
                <li class="footer__item"><a class="footer__link" href="<? echo $elem->url; ?>"><? echo $elem->title; ?></a></li>
                <? } ?>
              </ul>
              <ul class="footer__list">
                <li class="footer__item footer__item_title">CHARGER</li>
                <? $menu = wp_get_nav_menu_items('Charger'); ?>
                <? foreach ($menu as $elem) { ?>
                <li class="footer__item"><a class="footer__link" href="<? echo $elem->url; ?>"><? echo $elem->title; ?></a></li>
                <? } ?>
              </ul>
              <ul class="footer__list">
                <li class="footer__item footer__item_app"><a class="footer__link footer__link_appstore" href="#"></a></li>
                <li class="footer__item"><a class="footer__link footer__link_android" href="#"></a></li>
              </ul>
            </div>
            <div class="footer__section footer__section_bottom">
              <div class="socials">
                <ul class="socials__list">
                  <li class="socials__item"><a class="socials__link socials__link_facebook" href="#"></a></li>
                  <li class="socials__item"><a class="socials__link socials__link_twitter" href="#"></a></li>
                  <li class="socials__item"><a class="socials__link socials__link_instagram" href="#"></a></li>
                </ul>
              </div>
              <ul class="footer__doc-list">
                <? $menu = wp_get_nav_menu_items('Footer'); ?>
                <? foreach ($menu as $elem) { ?>
                <li class="footer__doc-item"><a class="footer__doc-link" href="<? echo $elem->url; ?>"><? echo $elem->title; ?></a></li>
                <? } ?>
              </ul><span class="copy">&copy 2019 BRiZ</span>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="<? echo get_template_directory_uri(); ?>/js/libs.min.js">                </script>
    <script src="<? echo get_template_directory_uri(); ?>/js/common.min.js"></script>
    <? if (is_front_page()) { ?><script src="<? echo get_template_directory_uri(); ?>/js/main.min.js"></script><? } else { ?>
    <script src="<? echo get_template_directory_uri(); ?>/js/secondary.min.js"></script>
    <? } ?>
    <? wp_footer(); ?>
  </body>
</html>