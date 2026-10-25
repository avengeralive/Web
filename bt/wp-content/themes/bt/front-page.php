<? get_header(); ?>
<div class="home">
    <div class="container">
        <div class="home__container">
          	<h1 class="home__title"><? echo get_field('home_title', 2); ?></h1>
          	<p class="home__text"><? echo get_field('home_text', 2); ?></p>
          	<a class="button button_style1 home__button" href="#feedback"><? echo get_field('home_button', 2); ?></a>
        </div>
    </div>
</div>
<main class="main">
    <div class="advantages">
        <div class="container">
          	<div class="advantages__container">
            	<div class="advantages__content row">
              		<div class="advantages-block col-xl-4 col-sm-6 col-12">
                		<div class="advantages-block__container">
                  			<div class="advantages-block__icon">
                    			<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico1"></use></svg><span class="advantages-block__value">1</span>
                  			</div>
                  			<p class="advantages-block__text"><? echo get_field('advantage_text_1', 2); ?></p>
                		</div>
              		</div>
              		<div class="advantages-block col-xl-4 col-sm-6 col-12">
                		<div class="advantages-block__container">
                  			<div class="advantages-block__icon">
                    			<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico1"></use></svg><span class="advantages-block__value">1</span>
                  			</div>
                  			<p class="advantages-block__text"><? echo get_field('advantage_text_2', 2); ?></p>
                		</div>
              		</div>
              		<div class="advantages-block col-xl-4 col-sm-6 col-12">
                		<div class="advantages-block__container">
                  			<div class="advantages-block__icon">
                    			<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico1"></use></svg><span class="advantages-block__value">10</span>
                  			</div>
                  			<p class="advantages-block__text"><? echo get_field('advantage_text_3', 2); ?></p>
                		</div>
              		</div>
            	</div>
          	</div>
        </div>
    </div>
    <div class="about block" id="about">
        <div class="container">
          	<div class="about__container">
            	<h2 class="title title_style1">
              		<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico2"></use></svg><? echo get_field('title', 2); ?>
            	</h2>
            	<div class="about__content row">
              		<div class="about__section col-xl-6 col-sm-12">
                		<p class="about__text about__text_style1"><? echo get_field('about_text_1', 2); ?></p>
                		<div class="about__images"><img class="about__image" src="<? echo get_template_directory_uri(); ?>/img/logos/rga.png" alt=""><img class="about__image" src="<? echo get_template_directory_uri(); ?>/img/logos/rams.png" alt=""></div>
              		</div>
              		<div class="about__section col-xl-6 col-sm-12">
                		<p class="about__text"><? echo get_field('about_text_2', 2); ?></p>
              		</div>
            	</div>
          	</div>
        </div>
    </div>
    <div class="services block block_decorated" id="services">
        <div class="container">
          	<div class="services__container">
            	<h2 class="title title_style1">
              		<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico2"></use></svg>ОСНОВНЫЕ УСЛУГИ
            	</h2>
            	<div class="services__content services__content_1 row">
              		<div class="services-block col-xl-3 col-md-4 col-6">
                		<svg class="icon icon_style1"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico3"></use></svg><span class="services-block__text"><? echo get_field('service_1', 2); ?></span>
              		</div>
              		<div class="services-block col-xl-3 col-md-4 col-6">
                		<svg class="icon icon_style2"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico4"></use></svg><span class="services-block__text"><? echo get_field('service_2', 2); ?></span>
              		</div>
              		<div class="services-block col-xl-3 col-md-4 col-6">
                		<svg class="icon icon_style1"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico5"></use></svg><span class="services-block__text"><? echo get_field('service_3', 2); ?></span>
              		</div>
              		<div class="services-block col-xl-3 col-md-4 col-6">
                		<svg class="icon icon_style1"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico6"></use></svg><span class="services-block__text"><? echo get_field('service_4', 2); ?></span>
              		</div>
           		</div>
            	<div class="services__content services__content_2 row">
              		<div class="services-block col-xl-3 col-md-4 col-6">
                		<svg class="icon icon_style1"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico7"></use></svg><span class="services-block__text"><? echo get_field('service_5', 2); ?></span>
              		</div>
              		<div class="services-block col-xl-3 col-md-4 col-6">
                		<svg class="icon icon_style2"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico8"></use></svg><span class="services-block__text"><? echo get_field('service_6', 2); ?></span>
             	 	</div>
              		<div class="services-block__title col-xl-6 col-md-12">
                		<h2 class="title title_style2">
                 	 		<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico2"></use></svg><? echo get_field('more_services', 2); ?>
                		</h2>
              		</div>
              		<div class="services-block col-xl-3 col-md-4 col-6">
                		<svg class="icon icon_style1"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico9"></use></svg><span class="services-block__text"><? echo get_field('service_7', 2); ?></span>
              		</div>
              		<div class="services-block col-xl-3 col-md-4 col-6">
                		<svg class="icon icon_style1"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico10"></use></svg><span class="services-block__text"><? echo get_field('service_8', 2); ?></span>
              		</div>
              		<div class="services-block col-xl-3 col-md-4 col-6">
                		<svg class="icon icon_style1"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico11"></use></svg><span class="services-block__text"><? echo get_field('service_9', 2); ?></span>
              		</div>
              		<div class="services-block col-xl-3 col-md-4 col-6">
                		<svg class="icon icon_style1"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico12"></use></svg><span class="services-block__text"><? echo get_field('service_10', 2); ?></span>
              		</div>
            	</div>
          	</div>
        </div>
    </div>
   	<div class="activity block block_decorated">
      <div class="container">
        <div class="activity__container">
	            <h2 class="title title_style1">
	              	<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico2"></use></svg>НАПРАВЛЕНИЯ ДЕЯТЕЛЬНОСТИ
	            </h2>
            	<div class="activity__content row">
                <? $singles = get_posts(array('post_type' => 'post', 'numberposts' => -1, 'order' => 'ASC')); 
                foreach ($singles as $key => $single) {
                ?>
              	<div class="activity-block col-xl-3 col-sm-6 col-12">
              		<a class="activity-block__container" href="<? echo get_the_permalink($single->ID); ?>">
                    <? if ($key % 2 == 1) { ?><div class="activity-block__image"><img src="<? echo get_the_post_thumbnail_url($single->ID, 'full'); ?>" alt=""></div><? } ?>
	                  <div class="activity-block__content activity-block__content_top">
	                    <h3 class="activity-block__title"><? echo $single->post_title; ?></h3>
	                    <p class="activity-block__text"><? echo get_field('slogan', $single->ID); ?></p>
	                  </div>
                    <? if ($key % 2 == 0) { ?><div class="activity-block__image"><img src="<? echo get_the_post_thumbnail_url($single->ID, 'full'); ?>" alt=""></div><? } ?>
                  </a>
                </div>
                <? } ?>
              </div>
        </div>
      </div>
    </div>
    <div class="gallery block block_decorated" id="gallery">
        <div class="gallery__content">
          	<div class="container">
            	<div class="gallery__container">
            		<? $gallery = get_field('gallery', 2); ?>
              		<div class="gallery__section gallery__section_controls">
                		<div class="gallery__section-content">
                  			<div class="gallery__background"></div>
                  			<h2 class="title title_style2 gallery__title">
                    			<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico2"></use></svg>более 250 деловых<br> и спортивных мероприятий
                  			</h2>
                  			<div class="gallery__controls">
                    			<div class="gallery-nav">
                      				<ul class="gallery-nav__list">
                      					<? foreach ($gallery as $key => $element) { ?>
				                        <li class="gallery-nav__item">0<? echo $key + 1; ?></li>
				                    	<? } ?>
                      				</ul>
                    			</div>
                    			<div class="gallery-controls"> 
			                      	<button class="gallery-controls__next">
			                        	<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico13"></use></svg>
			                      	</button>
                      				<button class="gallery-controls__prev">
                        				<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico13"></use></svg>
                      				</button>
                    			</div>
                  			</div>
                		</div>
              		</div>
              		<div class="gallery__section gallery__section_slider">
                		<div class="gallery-slider">
                			<? foreach ($gallery as $element) { ?>
                  			<div class="gallery-slider__slide">
                  				<a class="gallery-slider__container" href="<? echo $element['photo']; ?>">
                      				<div class="gallery-slider__image"><img src="<? echo $element['photo']; ?>" alt=""></div>
                      				<span class="gallery-slider__title"><? echo $element['title']; ?></span>
                      			</a>
                      		</div>
                      		<? } ?>
                		</div>
              		</div>
            	</div>
          	</div>
        </div>
    </div>
    <div class="partners block" id="partners">
        <div class="container">
          	<div class="partners__container">
            	<h2 class="title title_style1">
              		<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico2"></use></svg>ПАРТНЁРЫ СРЕДИ ОТЕЛЕЙ
            	</h2>
            	<div class="partners__content row">
            		<? $partners = get_field('partners', 2); 
            		foreach ($partners as $partner) {
            		?>
	                <div class="partners-block col-xl-4 col-md-6 col-12">
	                	<span class="partners-block__title"><? echo $partner['title']; ?></span>
	                	<? foreach ($partner['hotels'] as $hotel) {?>
	                    <div class="partners-block__section">
	                      	<ul class="partners-block__rating-list">
	                      		<? for ($i = 1; $i<=$hotel['stars']; $i++) { ?>
	                        	<li class="partners-block__rating-item"></li>
	                        	<? } ?>
	                      	</ul>
	                      	<span class="partners-block__section-title"><? echo $hotel['title']; ?></span>
	                    </div>
	                	<? } ?>
	                </div>
	            	<? } ?>
            	</div>
        	</div>
    	</div>
	</div>
    <div class="feedback block" id="feedback">
        <div class="container">
          	<div class="feedback__container">
            	<h2 class="title title_style3 feedback__title">СВЯЗАТЬСЯ С НАМИ</h2>
            	<form class="feedback-form row" action="">
              		<div class="feedback-form__group col-xl-4 col-sm-6 col-12">
                		<input class="feedback-form__input" type="text" placeholder="Имя" required>
              		</div>
              		<div class="feedback-form__group col-xl-4 col-sm-6 col-12">
                		<input class="feedback-form__input" type="text" placeholder="Email" required>
              		</div>
              		<div class="feedback-form__group col-xl-4 col-sm-12">
                		<input class="feedback-form__input" type="text" placeholder="Тема" required>
              		</div>
              		<div class="feedback-form__group col-xl-8 col-sm-12">
                		<textarea class="feedback-form__textarea" rows="1" placeholder="Сообщение" required></textarea>
              		</div>
              		<div class="feedback-form__group col-xl-4 col-sm-12">
                		<button class="button button_style1 feedback-form__button" type="submit">ОТПРАВИТЬ</button>
              		</div>	
            	</form>
         	</div>
        </div>
    </div>
    <div class="clients block" id="clients">
        <div class="container">
          	<div class="clients__container">
            	<h2 class="title title_style1">
             		<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico2"></use></svg>КЛИЕНТЫ
           	 	</h2>
            	<div class="clients__content">
              		<button class="clients__prev">
                		<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico13"></use></svg>
              		</button>
              		<button class="clients__next">
                		<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico13"></use></svg>
              		</button>
             	 	<div class="clients-slider">
             	 		<? $clients = get_field('clients', 2);
             	 		foreach ($clients as $key => $client) { 
             	 			if ($key % 2 == 0) { ?>
                		<div class="clients-slider__slide">
                			<img src="<? echo $client['image']; ?>" alt="">
                			<? if (isset($clients[$key + 1])) { ?><img src="<? echo $clients[$key + 1]['image']; ?>" alt=""><? } ?>
                		</div>
                		<? } } ?>
              		</div>
            	</div>
          	</div>
        </div>
    </div>
    <div class="reviews block">
        <div class="container">
          	<div class="reviews__container">
            	<h2 class="title title_style1">
              		<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico2"></use></svg>отзывы
            	</h2>
            	<div class="reviews__content row">
            		<? $reviews = get_field('reviews', 2);
             	 	foreach ($reviews as $review) { ?>
                  	<div class="reviews-block col-xl-3 col-md-4 col-sm-6 col-12">
                  		<a class="reviews-block__container" href="<? echo get_template_directory_uri(); ?>/img/images/activity3.jpg" data-fancybox="reviews">
                      		<div class="reviews-block__content">
                      			<span class="reviews-block__title"><? echo $review['line_1']; ?></span>
                      			<span class="reviews-block__subtitle"><? echo $review['line_2']; ?></span>
                      		</div>
                      		<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico14"></use></svg>
                      	</a>
                    </div>
                	<? } ?>
            	</div>
          	</div>
        </div>
    </div>
    <div class="contacts block" id="contacts">
        <div class="container">
          	<div class="contacts__container">
            	<div class="contacts__section contacts__section_content">
              		<div class="contacts__section-content">
                		<h2 class="title title_style2 gallery__title">
                  			<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico2"></use></svg>Контакты
                		</h2>
                		<span class="contacts__adress"><? echo get_field('address', 2); ?></span>
                		<ul class="contacts__list">
                  			<li class="contacts__item"><a class="contacts__link" href="tel:<? echo get_field('phone', 2); ?>"><? echo get_field('phone', 2); ?></a></li>
                  			<li class="contacts__item"><a class="contacts__link" href="mailto:<? echo get_field('email', 2); ?>"><? echo get_field('email', 2); ?></a></li>
                		</ul>
                		<div class="socials">
                  			<ul class="socials__list">
                    			<li class="socials__item">
                    				<a class="socials__link" href="<? echo get_field('facebook', 2); ?>">
                        				<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico-facebook"></use></svg>
                        			</a>
                        		</li>
                    			<li class="socials__item">
                    				<a class="socials__link" href="<? echo get_field('instagram', 2); ?>">
                        				<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico-instagram"></use></svg>
                        			</a>
                        		</li>
                    			<li class="socials__item">
                    				<a class="socials__link" href="<? echo get_field('twitter', 2); ?>">
                        				<svg class="icon"><use xlink:href="<? echo get_template_directory_uri(); ?>/img/icons/icons-sprite.svg#ico-twitter"></use></svg>
                        			</a>
                        		</li>
                  			</ul>
                		</div>
              		</div>
              		<div class="contacts__background"></div>
            	</div>
            	<div class="contacts__section contacts__section_map">
              		<div id="map"></div>
            	</div>
          	</div>
        </div>
    </div>
</main>
<? get_footer(); ?>