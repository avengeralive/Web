        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <p><a href="/" class="logo"><img src="<?=get_field('logo', 225); ?>" style="width: 135px;"></a></p>
                        <ul>
                            <li><a href="mailto:gold@velvetin.ru">gold@velvetin.ru</a></li>
                            <li><a href="tel:+78005510515">+7 800 551 05 15</a></li>
                            <li><a href="tel:+79255243828">+7 925 524 38 28</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <p>О нас</p>
                        <ul>
                        <? $menu = get_menu_array('О нас');
                        foreach ($menu as $element) { ?>
                            <li><a href="<? echo $element->url; ?>"><? echo $element->title; ?></a></li>
                        <? } ?>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <p>Информация</p>
                        <ul>
                        <? $menu = get_menu_array('Информация');
                        foreach ($menu as $element) { ?>
                            <li><a href="<? echo $element->url; ?>"><? echo $element->title; ?></a></li>
                        <? } ?>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?=get_template_directory_uri();?>/images/payment.svg">
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="copy">&copy; Velvetin Jewellery 2013-2020</p>
                        <a href="https://veliyev.ru" class="produced"><img src="<?=get_template_directory_uri();?>/images/veliyev.svg"> Создано в Студии Али Велиева</a>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
            </div>
        </footer>
        <? wp_footer(); ?>
    </body>
</html>