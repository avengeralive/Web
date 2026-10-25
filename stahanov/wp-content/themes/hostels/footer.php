<?php if(is_single()): ?>
<footer class="footer">
	<div class="container">
		<div class="footer__wrapper">
			<div class="logo">
				<a href="/">
					<img src="<?= get_template_directory_uri(); ?>/img/logo.svg" alt=""> </a>
			</div>
			<div class="social">
				<?php if(get_field('vk', 'option')): ?>
					<a href="<?= the_field('vk', 'option'); ?>">
						<svg class="icon icon-vk-logo">
							<use xlink:href="<?= get_template_directory_uri(); ?>/img/sprite.svg#icon-vk-logo"></use>
						</svg>
					</a>
				<?php endif; ?>

				<?php if(get_field('ok', 'option')): ?>
					<a href="<?= the_field('ok', 'option'); ?>">
						<svg class="icon icon-facebook-logo">
							<use xlink:href="<?= get_template_directory_uri(); ?>/img/sprite.svg#icon-facebook-logo"></use>
						</svg>
					</a>
				<?php endif; ?>

				<?php if(get_field('tw', 'option')): ?>
					<a href="<?= the_field('tw', 'option'); ?>">
						<svg class="icon icon-twitter-logo">
							<use xlink:href="<?= get_template_directory_uri(); ?>/img/sprite.svg#icon-twitter-logo"></use>
						</svg>
					</a>
				<?php endif; ?>

				<?php if(get_field('insta', 'option')): ?>
					<a href="<?= the_field('insta', 'option'); ?>">
						<svg class="icon icon-instagram-logo">
							<use xlink:href="<?= get_template_directory_uri(); ?>/img/sprite.svg#icon-instagram-logo"></use>
						</svg>
					</a>
				<?php endif; ?>
			</div>
			<div class="copyright"> &#169; HOSTEL-STAHANOV, <?php the_date('Y'); ?> </div>
			<div class="main-nav__contacts main-nav__contacts_footer">
				<ul>
					<li>
						<a href="#" class="modal_open"> <?= the_field('phone1', 'option'); ?>
							<strong> (по России бесплатно) </strong>
						</a>
					</li>
					<li>
						<a href="#" class="modal_open"> <?= the_field('phone2', 'option'); ?>
							<strong> Заказать звонок </strong>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<?php else: ?>
<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4 order-md-1 order-2">
				<div class="footer__contacts">
					<div class="title">
						<h2> Контакты </h2>
					</div>
					<p>
	
						<a href="tel:<?= preg_replace( '![^0-9\+]+!', '', get_field('phone1', 'option') ); ?>"> <?= the_field('phone1', 'option'); ?>
						</a>

						<strong> (по России бесплатно) </strong>
					</p>
					<p>
						<a href="tel:<?= preg_replace( '![^0-9\+]+!', '', get_field('phone2', 'option') ); ?>"> <?= the_field('phone2', 'option'); ?>
						</a>
						<a href="#" class="modal_open">
			            	<strong>
			                	Заказать звонок
			            	</strong>
			            </a>	
					</p>
					<ul>
						<?php
							$items = get_field('hostels_contacts', 'option');
							if($items) {
								foreach ($items as $item) {
									echo '<li>
										<a href="mailto:'.$item['email'].'"> '.$item['title'].'
											<strong> '.$item['email'].' </strong>
										</a>
									</li>';
								}
							}
						?>
					</ul>
					<div class="button button__footer">
						<a href="#" class="modal_open"> Оставить заявку </a>
					</div>
					<div class="social">
						<?php if(get_field('vk', 'option')): ?>
							<a href="<?= the_field('vk', 'option'); ?>">
								<svg class="icon icon-vk-logo">
									<use xlink:href="<?= get_template_directory_uri(); ?>/img/sprite.svg#icon-vk-logo"></use>
								</svg>
							</a>
						<?php endif; ?>

						<?php if(get_field('ok', 'option')): ?>
							<a href="<?= the_field('ok', 'option'); ?>">
								<svg class="icon icon-facebook-logo">
									<use xlink:href="<?= get_template_directory_uri(); ?>/img/sprite.svg#icon-facebook-logo"></use>
								</svg>
							</a>
						<?php endif; ?>

						<?php if(get_field('tw', 'option')): ?>
							<a href="<?= the_field('tw', 'option'); ?>">
								<svg class="icon icon-twitter-logo">
									<use xlink:href="<?= get_template_directory_uri(); ?>/img/sprite.svg#icon-twitter-logo"></use>
								</svg>
							</a>
						<?php endif; ?>

						<?php if(get_field('insta', 'option')): ?>
							<a href="<?= the_field('insta', 'option'); ?>">
								<svg class="icon icon-instagram-logo">
									<use xlink:href="<?= get_template_directory_uri(); ?>/img/sprite.svg#icon-instagram-logo"></use>
								</svg>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-md-8 order-md-2 order-1">
				<div id="map"> </div>
			</div>
		</div>
	</div>
</footer>
<?php endif; ?>
<div id="modal" class="modal">
	<div class="container">
		<div class="modal_close"> x </div>
		<div class="modal__content">
			<div class="row">
				<div class="col-md-6">
					<h3>Заполните форму</h3>
					<p>и наш менеджер свяжется с вами в ближайшее время!</p>
				</div>
				<div class="col-md-6">
					<form action="<?= get_template_directory_uri(); ?>/sendmail.php" method="get" class="form">
						<input type="text" name="name" placeholder="Ваше имя" required>
						<input type="tel" name="tel" placeholder="Ваш телефон" required>
						<button type="submit" class="button" name="submit">Отправить</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="thanks" class="modal">
	<div class="thanks_close modal_close">x</div>
	<div class="modal__thanks">
		<h3>Спасибо за заказ</h3>
		<p>Скоро мы Вам перезвоним!</p>
	</div>
</div>
</div>
<!-- END content -->
<!-- BEGIN scripts -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmnk4RCDwjSucIJ2WXRnLkuCrsWR4DUM4"></script>
<script>
	function initMap()
	{
		var map = new google.maps.Map(document.getElementById('map'),
			{
				center:
					{
						lat: 55.5757,
						lng: 37.31975
					},
				zoom: 9,
				zoomControl: true,
				zoomControlOptions:
					{
						position: google.maps.ControlPosition.RIGHT_CENTER
					},
				mapTypeControl: false,
				streetViewControl: false,
				fullscreenControl: false,
				styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"},{"lightness":"30"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"gamma":"0.00"},{"lightness":"74"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"3"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
			});
		

		 <?php
			$items = get_field('hostels_contacts', 'option');
			if($items): ?>
				var locations = [
				<?php foreach ($items as $item): ?>
					{lat: <?php echo esc_js($item['coords']['coord_lat']); ?>, lng: <?php echo esc_js($item['coords']['coord_lng']); ?>},
				<?php endforeach; ?>
				];
			<?php endif;
		?>	
		var image = {
              url: '<?= get_template_directory_uri(); ?>/img/marker.svg',
              size: new google.maps.Size(68, 68),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(35, 35),
              scaledSize: new google.maps.Size(68, 68)
          };

		var markers = locations.map(function(location, i) {
              return new google.maps.Marker({
                  position: location,
                  map: map,
                  icon: image
              });
          });

	}
	initMap();
</script>
<script>	
jQuery(document).ready(function($) {	
	function calc() {	
  		var $choose   = parseInt($('#choose option:selected').val(), 10),
	      $people     = parseInt($('#people').val(), 10),
	      $night      = parseInt($('#night').val(), 10),
	      $priceToDay = $('#price-to-day'),
	      $fullPrice  = $('#full-price'),
	      $payToDay,
	      $fullPay;

	    function step1() {
	      var stepOne,itog,price;

	    <?php $items = get_field('hostels_list', 'option');
	      foreach ($items as $item): ?>
	     	if ($choose === <?php echo $item['price']; ?>) {price = <?php echo $item['price']; ?>;}
  		<?php endforeach; ?>


	    
	      if ($night >= 1 && $night < 7) stepOne = price * 1;
	      if ($night >= 7 && $night < 14) stepOne = price * 0.933;
	      if ($night >= 14 && $night < 21) stepOne = price * 0.867;
	      if ($night >= 21 && $night < 31) stepOne = price * 0.733;
	      if ($night >= 31) stepOne = price * 0.666;
	      itog = stepOne * $night;
	      return itog;
	    }

	    function step2() {
	      var stepTwo,itog;
	      if ($people >= 1 ) stepTwo = step1() * 1;
	      itog = stepTwo * $people;
	      return itog;
	    }
	    return step2();
	  }
	  $('#night, #people').on('keyup, change', function() {
	    if ( $('#night').val() === 0 || $('#people').val() === 0) {
	      $('#full-price').html('0');
	      $('#price-to-day').html('0');
	    } else {
	      $('#full-price').html(calc().toFixed(0));
	      $('#price-to-day').html((calc() / $('#night').val() / $('#people').val()).toFixed(0));
	    }
	  });
	  $('#choose').on('change', function() {
	    //
	    if ( $('#night').val() == 0 || $('#people').val() == 0) {
	      $('#full-price').html('0');
	      $('#price-to-day').html('0');

	    } else {
	      $('#full-price').html(calc().toFixed(0));
	      $('#price-to-day').html((calc() / $('#night').val() / $('#people').val()).toFixed(0));
	    }
	  });	
});
</script>

<!-- END scripts -->
		<?php wp_footer(); ?>
		

	</body>

</html>

