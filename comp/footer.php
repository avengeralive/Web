<footer>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<p><a class="phone" href="tel:<? echo get_field('телефон_(без_формата)', 2); ?>"><? echo get_field('телефон', 2); ?></a></p>
				<p><a class="zakaz" href="#" data-toggle="modal" data-target="#exampleModal">ОНЛАЙН ЗАКАЗ КРУГЛОСУТОЧНО</a></p>
        <ul class="navbar-nav menu">
              <?
              $menu = wp_get_nav_menu_items('Главное меню');
              global $post;
              foreach ($menu as $item) {        
            ?>
              <li class="menu-item menu-item-type-custom menu-item-object-custom <? if ($item->object_id == $post->ID) echo 'active'; ?>">
                <a class="nav-link" href="<? echo $item->url; ?>"><? echo $item->title; ?></a>
              </li>
            <? } ?>
        </ul>
			</div>
		</div>
	</div>
</footer>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Заявка на ремонт</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <? echo do_shortcode('[contact-form-7 id="4" title="Контактная форма 1"]'); ?>
      </div>
    </div>
  </div>
</div>
<? wp_footer(); ?>
</body>
</html>