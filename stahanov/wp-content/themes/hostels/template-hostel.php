<?php /* Template Name: Хостел */ get_header(); ?>

	<section class="main-screen">
		<div class="container">
			<div class="main-screen__wrapper">
				<div class="main-screen__title">
					<?= the_field('title'); ?>
				</div>
				<div class="main-screen__price">
					<p> От
						<strong> <?= the_field('price'); ?></strong> рублей в сутки! </p>
				</div>
			</div>
			<div class="button button__main-screen">
				<a href="#" class="modal_open"> Оставить заявку </a>
			</div>
		</div>
	</section>
	<main>
		<section class="slider-screen">
			<div class="container">
				<div class="title title__slider-screen">
					<h2> Общежития </h2>
				</div>
				<div class="row">
					<div class="col-xl-4">
						<div class="slider-screen__info">
							<p>
								<strong> 45 000+ </strong> человек остановились у нас! </p>
							<p>
								<strong> 100+ </strong> компаний разместили у нас свой персонал! </p>
						</div>
						<div class="slider-screen__partners">
							<div class="slider-screen__partners_title">
								<h3>Наши партнеры</h3>
							</div>
							<div class="slider-screen__partners_wrapper">
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
								
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
								
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
								
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
								
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
								
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
								
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
								
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
								
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
								
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
						
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
					
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
							
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
						
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
							
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
								
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
					
								</div>
								<div class="slider-screen__slide">
									<a href="#">
										<img src="<?= get_template_directory_uri(); ?>/img/partner1.jpg" alt=""> </a>
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-8">
						<div class="slider-screen__tabs_nav">
							<?php
							$items = get_field('hostels_list', 'option');
							foreach ($items as $item) {
								echo '<div class="tab" data-slide="1">'.$item['name'].'</div>';
							}
							?>
						</div>
						<div class="slider-screen__tabs_content">
							<?php
							$items = get_field('hostels_list', 'option');
							foreach ($items as $item) {
								echo '<div class="tab_item">
										<div class="slider-for">';
								$images = $item['gallery'];
								$size = 'full';
								foreach( $images as $image ) {
									echo '<div class="slider-for__slide">
														<a data-fancybox="gallery" href="'.$image['url'].'">
															'.wp_get_attachment_image( $image['ID'], $size ).'</a>
													</div>';
								}
								echo '</div>
										<div class="slider-nav">';
								$images = $item['gallery'];
								$size = 'full';
								foreach( $images as $image ) {
									echo '<div class="slider-nav__slide">
												'.wp_get_attachment_image( $image['ID'], $size ).'</div>';
								}
								echo '</div>
										<h3> Общежитие '.$item['name'].' </h3>
										<div class="tab_item__wrapper">
											<div class="tab_item__progress">
												<p>Занятых номеров</p>
												<progress value="'.$item['rooms_closed'].'" max="'.$item['rooms_free'].'"></progress>
												<p> Свободных номеров </p>
											</div>
											<div class="tab_item__price">
												<p> От
													<strong>'.$item['price'].'</strong> <br> рублей в сутки! </p>
											</div>
										</div>
										<div class="tab_item__info">
											'.$item['contacts'].'
										</div>
										<div class="col-12">
											<div class="button button__slider-screen">
												<a href="'.$item['link'].'">Подробние</a>
											</div>
										</div>
									</div>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="first-screen">
			<div class="container">
				<div class="row">
					<div class="col-xl-4">
						<div class="first-screen__text">
							<div class="title title__first-screen">
								<h2> <?= the_field('advantages_title', 'option'); ?> </h2>
							</div>
							<?= the_field('advantages_description', 'option'); ?>
						</div>
					</div>
					<div class="col-xl-8">
						<div class="first-screen__masonry">
							<?php
							$items = get_field('advantages_list', 'option');
							if($items) {
								foreach ($items as $item) {
									echo '
									<div class="first-screen__block">
										'.$item['icon'].'
										<p>'.$item['title'].'</p>
									</div>';
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="calc-screen">
			<div class="container">
				<div class="row">
					<div class="col-lg-7">
						<div class="title title__calc">
							<h2> Рассчитывайте стоимость вашего проживания </h2>
						</div>
							<div class="calc__wrapper">
					      <form class="calculator">
				            <p>
				              Выбор общежития
				            </p>
						    <?php //TODO: Треба підтягувати ціну з адмінки, приклад коду знизу ?>
					        <?php
						      /*$items = get_field('hostels_list', 'option');
						      foreach ($items as $item) {
							      echo $item['price'];
						      }*/
					        ?>

				            <select name="calc" id="choose" >
				            	<?php $items = get_field('hostels_list', 'option');
				            	foreach ($items as $item): ?>
				              		<option value="<?php echo $item['price']; ?>"><?php echo $item['name']; ?></option>
				          		<?php endforeach; ?>

				            </select>
			              	<div class="calculator__time">
				              <div class="calculator__time_input">
				                <label for="night">
				                  Количество ночей
				                </label>
				                <div class="input input_night">
				                  <input type="number" id="night" value="1" min="1">
				                </div>
				              </div>
				              <div class="calculator__time_input">
				                <label for="people">
				                    Количество человек
				                </label>
				                <div class="input input_people">
				                  <input type="number" id="people" value="1" min="1">
				                </div>

				              </div>
				            </div>
				            <div class="calculator__price">
				              <p>Цена за сутки: <span class="price-day" id="price-to-day">
				              330
				              </span> руб.
				              </p>
				              <p>Цена за все: <span class="price-all" id="full-price">
				              330
				              </span> руб.
				              </p>
				            </div>
				          </form>

						</div>
						<div class="button button__calc">
							<a href="#" class="modal_open"> Забронировать </a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="reviews">
			<div class="container">
				<div class="row">
					<div class="col-xl-4">
						<div class="title title__reviews">
							<h2> Отзывы о нас </h2>
						</div>
						<div class="reviews__slider">
							<?php
								$items = get_field('reviews');
								foreach ($items as $item) {
									echo '<div class="reviews__slide">
											'.$item['text'].'
											<div class="reviews__author">
												<img src="'.$item['photo'].'" alt="">
												<div class="reviews__author_name">
													'.$item['name'].'
												</div>
											</div>
										</div>';
								}
							?>
						</div>
					</div>
					<div class="col-xl-8">
						<div id="reviews" class="reviews__befor-after">
							<img src="<?= get_field('photo_before'); ?>" alt="">
							<img src="<?= get_field('photo_after'); ?>" alt=""> </div>
					</div>
				</div>
			</div>
		</section>
		<section class="faq-screen">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="title">
							<h2> Часто задаваемые вопросы </h2>
						</div>
						<div class="faq-screen__drop">
							<?php
							$items = get_field('faq', 'option');
							if($items) {
								foreach ($items as $item) {
									echo '<div class="faq-screen__head"> '.$item['answer'].' </div>
										<div class="faq-screen__toggle "> '.$item['reply'].' </div>';
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>