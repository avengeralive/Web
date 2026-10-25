<?php require 'index.config.php'; ?>
<?php
/*
Template Name: Страница "Контакты"
*/
get_header(); ?>

	<section class="contacts">
			<div class="container no-padding">
				<h1>КОНТАКТЫ</h1>
				<div class="row">
					<div class="col-md-5" itemscope itemtype="http://schema.org/LocalBusiness">
                        <meta itemprop="name" content="Infoshell офисы по России"/>
                        <meta itemprop="image" content="https://infoshell.ru/wp-content/themes/mark_up/images/logo.jpg"/>
                        <meta itemprop="priceRange" content="$$"/>
                        <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
    <meta itemprop="latitude" content="55.772867" />
    <meta itemprop="longitude" content="37.591710" />
  </div>
						<?php query_posts('category_name=contacts&orderby=date&order=DESC');?>	
						<?php if ( have_posts() ) : ?>
							<?php
							while ( have_posts() ) : the_post(); ?>
								<div class="place-contacts" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
									<a href="#" class="js-contacts-more clearfix"><i class="place-placemark-icon"></i><span itemprop="addressLocality"><?php the_title(); ?></span><i class="place-arrow-icon"></i></a>
									<div class="place-contacts-text">
										<address>Адрес: <span itemprop="streetAddress"><?php echo (get_post_meta($post->ID, 'address', true)); ?></span></address>
										<ul class="no-list place-contacts-info">
											<li><i class="place-contacts-phone-icon"></i><b>Телефон/факс:</b> <span itemprop="telephone"><?php echo (get_post_meta($post->ID, 'phone', true)); ?></span></li>
											<li><i class="place-contacts-mail-icon"></i><b>E-mail:</b> <span itemprop="email"><?php echo (get_post_meta($post->ID, 'email', true)); ?></span></li>
										</ul>
									</div>
								</div>				
							<?php endwhile; ?>
						<?php endif; wp_reset_query();?>
						
						<ul class="no-list left-list social-list">
                            <a class="infoshel-main-card__accordion-link infoshel-main-card__accordion-link-fb wow zoomIn" data-wow-delay="0.9s" href="<?php echo $socialUrl['fb'];?>" target="_blank"></a>
                            <a class="infoshel-main-card__accordion-link infoshel-main-card__accordion-link-bh wow zoomIn" data-wow-delay="0.9s" href="<?php echo $socialUrl['bh'];?>" target="_blank"></a>
                            <a class="infoshel-main-card__accordion-link infoshel-main-card__accordion-link-ins wow zoomIn" data-wow-delay="0.9s" href="<?php echo $socialUrl['ins'];?>" target="_blank"></a>
                            <a class="infoshel-main-card__accordion-link infoshel-main-card__accordion-link-kcru wow zoomIn" data-wow-delay="0.9s" href="<?php echo $socialUrl['vc'];?>" target="_blank"></a>
						</ul>
					</div>
					<div class="back-form col-md-6 col-md-offset-1">
						<div data-goals="contact_form_contacts,all_contact_forms,all_goals" name="frm1" class="contactForm">
				            <fieldset>
							<input type="text" value="" name="name" placeholder="Ваше имя" minlength="2" required>
							<input value="" type="email" name="email" placeholder="Ваш E-mail" required>
							<input value="" type="text" name="phone" placeholder="Ваш телефон" required>
							<textarea placeholder="Сообщение"  name="message" type="text" rows="4" minlength="2" required></textarea>
							<div class="text-right btn-container">
								<span class="btn btn-primary contactFormSubmit" onClick="ga('send','event','Form','Contacts'); return true;">Отправить</span>
							</div>


							<?php
								if(isset($_GET['resault'])&&$_GET['resault']==1){
									?>
                                    <script>
                                        $(document).ready(function(){
                                            alert("Ваше сообщение отправленно.");
                                        });

                                    </script>
                                    <?
								}
							?>
                            </fieldset>
						</div>

                        <script>
                            $(document).ready(function(){
                                $('#sendquest').validate({
                                    submitHandler: function(form) {
                                        yaCounter934261.reachGoal('ZAKAZ_FORM1');
                                        $(form).submit();
                                    }
                                });
                            });
                        </script>
					</div>
				</div>
			</div>
			<div class="map">
                <div id="map-canvas"></div>
				 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCts47b12TPDufFZnCg42iGboJP01GgTYU&sensor=false"></script>
				<script>
				var map;
				function initialize() {
					var mapOptions = {
						zoom: 5,
						center: new google.maps.LatLng(55.772089, 37.592534),
						panControl: true,
						panControlOptions: {
							position: google.maps.ControlPosition.LEFT_CENTER
						},
						zoomControl: true,
						zoomControlOptions: {
							style: google.maps.ZoomControlStyle.LARGE,
							position: google.maps.ControlPosition.RIGHT_CENTER
						}
					};
					var styles = [
					  {
						"stylers": [
						  { "saturation": -75 },
						  { "lightness": -55 }
						]
					  }
					]
					var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});
					map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
					map.mapTypes.set('map_style', styledMap);
					map.setMapTypeId('map_style');
					var image = 'https://infoshell.ru/wp-content/themes/mark_up/images/map-logo.png';
					
					
					
						<?php query_posts('category_name=contacts&orderby=date&order=DESC');?>	
						<?php if ( have_posts() ) : ?>
							<?php
							$ii=0;
							while ( have_posts() ) : the_post(); ?>
					
								var myLatLng<?php echo $ii; ?> = new google.maps.LatLng(<?php echo (get_post_meta($post->ID, 'coords', true)); ?>);
								var beachMarker = new google.maps.Marker({
								  position: myLatLng<?php echo $ii; ?>,
								  map: map,
								  icon: image
								});
					
							<?php 
								$ii=$ii+1;;
							endwhile; ?>
						<?php endif; wp_reset_query();?>
					
				}				
				google.maps.event.addDomListener(window, 'load', initialize);
				</script>

			</div>
		
	</section>


    <?php wp_footer(); ?>
	
<script type="text/javascript">
$(function() {
     $('#emailForm').submit( function() {
         yaCounter934261.reachGoal('callback_contants');
         yaCounter934261.reachGoal('all_callbacks');
         yaCounter934261.reachGoal('all_goals');
         return true;
     });
});
</script>


<?php get_footer(); ?>