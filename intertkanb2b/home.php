<? 
/*
Template name: Home
*/
get_header(); 
if (pll_current_language() == 'ru') $mp = 7;
else $mp = 121;
?>
<div class="banner-area banner-slider-active">
<?
	$slider = get_posts(array('post_type' => 'slider', 'lang' => pll_current_language()));
    foreach ($slider as $slide) {
?>
	<div class="banner justify-content-center align-items-center bg-parallax" data-black-overlay="5" style="background-image: url(<? echo get_the_post_thumbnail_url($slide->ID, 'full'); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
		<div class="container">
			<div class="banner-text banner-text-white">
				<h1><? echo $slide->post_title; ?></h1>
				<h4><? echo $slide->post_content; ?></h4>
				<a href="#regform" class="cr-btn cr-btn-lg">
					<span><? pll_e('register_now'); ?></span>
				</a>
				<!--<a href="#sl1"><img src="/wp-content/themes/intertkanb2b/images/scroll.gif" style="height: 140px; margin: 30px auto;"></a>-->
			</div>
		</div>
	</div>
	<? } ?>
</div>
<main id="page-content">
	<section class="cr-section about-area bg-white section-padding-md" style="padding-top: 30px;" id="sl1">
    	<div class="container" style="margin-bottom: 30px;">
    		<div class="row">
	        	<div class="about-text text-center col-md-6">
	        		<h3><? if (pll_current_language() == 'ru') { ?>Организатор:<? } else { ?>Organizer:<? } ?></h3>
	        		<img src="http://intertkan.ru/wp-content/themes/intertkan2/images/souzlegprom.png" style="height: 50px; margin-top: 50px; margin-bottom: 50px;">
	        	</div>
	        	<div class="about-text text-center col-md-6">
	        		<h3><? if (pll_current_language() == 'ru') { ?>Поддержка:<? } else { ?>Support:<? } ?></h3>
	        		<img src="http://minpromtorg.gov.ru/common/img/logo_share.png" style="height: 50px; float: left; margin: 0 5px; margin-top: 50px; margin-bottom: 50px;">
	        		<img src="https://tpprf.ru/local/templates/tpprf_main/images/logo.png" style="height: 50px; float: left; margin: 0px 15px; margin-top: 50px; margin-bottom: 50px;">
	        	</div>
	        </div>
        </div>
		<div class="container">
        	<div class="about-text text-center">

            	<!--<img src="<? echo get_field('значок', $mp); ?>" alt="about icons">-->
                <h4><? echo get_field('подзаголовок', $mp); ?></h4>
                <h2><? echo get_field('заголовок', $mp); ?></h2>
				<p><? echo get_field('описание', $mp); ?></p>
				<!--<div class="button-group">
					<a href="<? echo get_field('первая_ссылка', $mp); ?>" class="cr-btn cr-btn-blue">
						<span><? echo get_field('текст_первой_ссылки', $mp); ?></span>
					</a>
					<a href="<? echo get_field('вторая_ссылка', $mp); ?>" target="_blank" class="cr-btn cr-btn-red">
						<span><? echo get_field('текст_второй_ссылки', $mp); ?></span>
					</a>
				</div>-->
            </div>
        </div>
    </section>

    <section class="cr-section video-promo-area bg-white section-padding-md" style="padding-top: 0px;">
    	<div class="container">
			<div class="row">
				<? if (pll_current_language() == 'ru') { ?>
				<div class="col-md-4" style="background: #26aae1;">
					<div class="col-sm-12">
						<h2 style="text-align: center; font-size: 20px;">Участники</h2>
						<hr>
						<ul style="font-size: 14px;">
							<li>российские и зарубежные производители тканей и фурнитуры</li>
							<li>фабрики-производители одежды, домашнего текстиля, трикотажа.</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4" style="background: #f48324;">
					<div class="col-sm-12">
						<h2 style="text-align: center; font-size: 20px;">Посетители</h2>
						<hr>
						<ul style="font-size: 14px;">
							<li>представители российских и зарубежных брендов готовой одежды</li>
							<li>модные дома, дизайнеры</li>
							<li>владельцы розничных сетей и магазинов</li>
							<li>оптовые компании</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4" style="background: #ef3e36;">
					<div class="col-sm-12">
						<h2 style="text-align: center; font-size: 20px;">Формат проведения</h2>
						<hr>
						<ul style="font-size: 14px;">
							<li>деловые встречи в формате B2B</li>
							<li>персональные переговоры</li>
							<li>демонстрация своей продукции непосредственно менеджерам, принимающим решение о закупках</li>
						</ul>
					</div>
				</div>
				<? } else { ?>
				<div class="col-md-4" style="background: #26aae1;">
					<div class="col-sm-12">
						<h2 style="text-align: center; font-size: 20px;">Participants</h2>
						<hr>
						<ul style="font-size: 14px;">
							<li>Russian and foreign manufacturers of fabrics and accessories,</li>
							<li>factories–manufactories of clothes, home textiles, knitted fabrics</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4" style="background: #f48324;">
					<div class="col-sm-12">
						<h2 style="text-align: center; font-size: 20px;">Visitors</h2>
						<hr>
						<ul style="font-size: 14px;">
							<li>representatives of Russian and foreign brands of ready-to wear clothes</li>
							<li>fashion houses, designers</li>
							<li>owners of retail chains and wholesale companies</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4" style="background: #ef3e36;">
					<div class="col-sm-12">
						<h2 style="text-align: center; font-size: 20px;">Format of the event</h2>
						<hr>
						<ul style="font-size: 14px;">
							<li>business meetings in B2B format</li>
							<li>personal negotiations</li>
							<li>demonstration of products directly to managers who decide on procurement</li>
						</ul>
					</div>
				</div>
				<? } ?>
			</div>
		</div>
	</section>

	<section class="cr-section about-area bg-white section-padding-md" style="padding-top: 0px;" id="preim">
        <div class="container">
			<div class="row text-center">
				<h2 style="margin: 0 auto; margin-bottom: 50px;"><? pll_e('preim'); ?></h2>
			</div>
			<div class="about-text text-center row">
				<? if (pll_current_language() == 'ru') $preim = get_posts(array('post__in' => array(17), 'post_type' => 'page'));
					else $preim = get_posts(array('post__in' => array(139), 'post_type' => 'page'));
					echo $preim[0]->post_content;
				?>	
				<div class="button-group text-center" style="margin: 0 auto;">
					<a href="<? echo get_field('первая_ссылка', $mp); ?>" class="cr-btn cr-btn-blue">
						<span><? echo get_field('текст_первой_ссылки', $mp); ?></span>
					</a>
					<a href="<? echo get_field('вторая_ссылка', $mp); ?>" target="_blank" class="cr-btn cr-btn-red">
						<span><? echo get_field('текст_второй_ссылки', $mp); ?></span>
					</a>
				</div>
			</div>
        </div>
    </section>

			<!--// About Area -->

			
			
			

			<!-- Events Area -->
			
			<!--// Events Area -->

			<!-- Video Promo Area -->
			<!--<div class="cr-section video-promo-area bg-white section-padding-md">
				<div class="container">
					<div class="row">
						<div class="col-lg-7">
							<div class="videobox mr-0 mr-xl-3">
								<div class="embed-responsive embed-responsive-16by9">
									<? echo get_field('ссылка_на_видео', $mp); ?>
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="video-promo-content">
								<? echo get_field('описание_к_видео', $mp); ?>
								<a href="<? echo get_field('ссылка_кнопки', $mp); ?>" class="cr-btn cr-btn-red">
									<span><? echo get_field('текст_кнопки', $mp); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>-->
			<!--// Video Promo Area -->
	<section>
		<div class="container">
			<h2 class="text-center"><? pll_e('p10'); ?></h2>
		</div>
		<div class="container">
			<div class="row">
				<?
					$posts = get_posts(array('post_type' => 'post', 'limit' => 3, 'lang' => pll_current_language()));
				    foreach ($posts as $post) {
				?>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
					<a href="<? echo $post->guid; ?>" class="portfolio1">
						<div class="portfolio-thumb">
							<img src="<? echo get_the_post_thumbnail_url($post->ID); ?>" alt="portfolio thumb 1" style="height: 250px;">
						</div>
						<div class="portfolio-content">
							<h5 class="text-center" style="font-size: 14px;"><? echo $post->post_title; ?></h5>
						</div>
					</a>
				</div>
	            <? } ?>
			</div>
			<div class="row justify-content-center portfolios portfolio-popup-gallery-active" style="margin-top: 25px; margin-bottom: 50px;">
				<div class="button-group">
					<a href="/новости/" class="cr-btn cr-btn-blue">
						<span><? if (pll_current_language() == 'ru') { ?>Смотреть все<? } else { ?>See all<? } ?></span>
					</a>
				</div>
			</div>
		</div>
		
	</section>

	<section class="cr-section portfolio-area bg-white section-padding-md">
				<div class="container">
					<div class="row">
						<h3 style="margin: 0 auto; margin-bottom: 30px;"><? if (pll_current_language() == 'ru') { ?>Фотогалерея<? } else { ?>Photogallery<? } ?></h3>
					</div>
					<!--<div class="row justify-content-center portfolios portfolio-popup-gallery-active">
						<?
							$gallery = get_post_gallery_images(233, 'full');
							foreach ($gallery as $key=>$img) {
						?>
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
							<a href="<? echo $img; ?>" class="portfolio">
								<div class="portfolio-thumb">
									<img src="<? echo $img; ?>" alt="portfolio thumb" style="max-height: 180px;">
								</div>
							</a>
						</div>
						<? } ?>
					</div>-->

					<div class="brand-logos-slider portfolio-popup-gallery-active">
                    	<?
							$gallery = get_post_gallery_images(233, 'full');
							foreach ($gallery as $key=>$img) {
						?>
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
							<a href="<? echo $img; ?>" class="portfolio" style="margin-top: 0px;">
								<div class="portfolio-thumb">
									<img src="<? echo $img; ?>" alt="portfolio thumb" style="max-height: 136px;">
								</div>
							</a>
						</div>
						<? } ?>
                        
                    </div>
                    <div class="row justify-content-center portfolios portfolio-popup-gallery-active" style="margin-top: 25px; margin-bottom: 50px;">
						<div class="button-group">
							<a href="/фотогалерея-2/" class="cr-btn cr-btn-blue">
								<span><? if (pll_current_language() == 'ru') { ?>Смотреть все<? } else { ?>See all<? } ?></span>
							</a>
						</div>
					</div>
				</div>


				
                    
                

			</section>

	

    

	<!--<section class="cr-section portfolio-area bg-white section-padding-md" style="padding-top: 0px;">
		<div class="container">
			<div class="row justify-content-center">
				<h2 style="margin: 0 auto; margin-bottom: 50px;">Участники</h2>
			</div>
			<div class="row justify-content-center portfolios portfolio-popup-gallery-active">
				<?
                    $parts = get_posts(array('post_type' => 'participants', 'limit' => 3, 'lang' => pll_current_language()));
                    foreach ($parts as $part) {
                ?>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
					<a href="<? echo $part->guid; ?>" class="portfolio1">
						<div class="portfolio-thumb">
							<img src="<? echo get_the_post_thumbnail_url($part->ID); ?>" alt="portfolio thumb 1" style="height: 250px;">
						</div>
					</a>
				</div>
				<? } ?>
			</div>
			<div class="row justify-content-center portfolios portfolio-popup-gallery-active" style="margin-top: 50px;">
				<div class="button-group">
					<a href="/каталог-участников/" class="cr-btn cr-btn-blue">
						<span>Смотреть всех</span>
					</a>
				</div>
			</div>
		</div>
	</section>-->
			

			<div class="testimonial-area section-padding-sm" id="reviews">
                <div class="container">
                	<h2 class="text-center" style="color: #ef3e36 !important;"><? pll_e('p9'); ?></h2>
                </div>
                <div class="container">
                    <div class="testimonial-wrap">
                    	<?
			        		$slider = get_posts(array('post_type' => 'reviews', 'posts_per_page' => 200, 'lang' => pll_current_language()));
			        		foreach ($slider as $slide) {
			        	?>
                        <div class="testimonial text-center">
                            <p><? echo $slide->post_content; ?></p>
                            <h6><? echo $slide->post_title; ?></h6>
                        </div>
                        <? } ?>
                    </div>
                </div>
            </div>

			<div class="cr-section video-promo-area bg-gray section-padding-md" id="regform">
				<div class="container">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6" style="padding: 20px; border: 2px solid #ef3e36;">
							<h3 class="text-center"><? pll_e('p1'); ?></h3>
							<small class="text-center" style="width: 100%; display: inline-block;"><? pll_e('p2'); ?></small>
							<form action="/wp-admin/admin-post.php" method="post" id="contact-form" class="contact-page-form">
								<div class="row">
									<input type="hidden" name="action" value="register_participant">
									<input type="hidden" name="lang" value="<? echo pll_current_language(); ?>">
									<div class="col-12 mt-30">
										<input type="text" name="company_name" placeholder="<? pll_e('p3'); ?>">
									</div>
									<div class="col-12 mt-30">
										<input type="text" name="contact_pers" placeholder="<? pll_e('p4'); ?>">
									</div>
									<div class="col-12 mt-30">
										<input type="text" name="phone" placeholder="<? pll_e('p5'); ?>">
									</div>
									<div class="col-12 mt-30">
										<input type="email" name="email" placeholder="<? pll_e('p6'); ?>">
									</div>
									<div class="col-12 mt-30">
										<input type="text" name="source" placeholder="<? pll_e('p7'); ?>">
									</div>
									<div class="col-12 mt-30 text-center">
										<button type="submit" class="cr-btn mt-30">
											<span><? pll_e('p8'); ?> <i class="fa fa-angle-right"></i></span>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="cr-section mb-30" id="place" style="padding-top: 50px; padding-bottom: 30px;">
				<div class="container">
					<div class="row">
						<div class="col-12 text-center">
							<? if (pll_current_language() == 'ru') { ?>
							<h2 >Место проведения</h2>
							<p><b>ЦВК «Экспоцентр», павильон2, «Синий зал» (г. Москва,
	Краснопресненская набережная, д.14)</b></p>
	<p>Центральный выставочный комплекс «Экспоцентр» находится в центре столицы, рядом с
	деловым центром Москва-Сити, в шаговой доступности от метро «Выставочная» и
	«Деловой центр».</p>
	<p>Удобное расположение дает возможность всем участникам мероприятия быстро и
	комфортно добраться до места.</p>
							<div class="button-group">
								<a href="/стать-посетителем/" class="cr-btn cr-btn-blue">
									<span>Стать посетителем</span>
								</a>
							</div>
							<? } else { ?>
							<h2>Venue of the event</h2>
							<p><b>Expocentre Fairgrounds, Pavilion 2, Blue Hall (Moscow, Krasnopresnenskaya
Naberezhnaya, 14)</b></p>
	<p>The central exhibition complex Expocentre is located in the center of the
capital, close to the business center of Moscow City, within walking distance
from Vystavochnaya metro station and Delovoy Tsentr.</p>
	<p>A convenient location allows all participants of the event to quickly and
comfortably reach the place.</p>
							<div class="button-group">
								<a href="/get-e-ticket/" class="cr-btn cr-btn-blue">
									<span>Become a participant</span>
								</a>
							</div>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="banner-area banner-slider-active" style="max-height: 600px;">

	            <!-- Single Banner -->
	            <div class="banner justify-content-center align-items-center bg-parallax" style="background-image: url(<? echo get_field('фотка_места', $mp); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
	                <div class="container">
	                    
	                </div>
	            </div>
        	</div>

			<div class="cr-section">
				<div class="row">
					<div class="col-12">
						<iframe src="https://yandex.ru/map-widget/v1/-/CBuZEIa1XD" width="100%" height="400" frameborder="1" allowfullscreen="true"></iframe>
					</div>
				</div>
			</div>

<section id="partners" class="home">
	<div class="container">
	
	<section class="partners">
		<div class="partners-content">
			<h1>Организаторы:</h1>
			<ul class="partners-list ">
									<li>
												<a href="http://www.souzlegprom.ru" target="_blank">
							<img width="380" height="74" src="http://intertkan.ru/wp-content/uploads/2015/10/souzlegprom.png" class="attachment-full size-full" alt="http://www.souzlegprom.ru" srcset="http://intertkan.ru/wp-content/uploads/2015/10/souzlegprom.png 380w, http://intertkan.ru/wp-content/uploads/2015/10/souzlegprom-300x58.png 300w" sizes="(max-width: 380px) 100vw, 380px">						</a>
					</li>
									<li>
												<a href="http://www.legpromforum.ru" target="_blank">
							<img width="185" height="21" src="http://intertkan.ru/wp-content/uploads/2015/10/legprommedia.png" class="attachment-full size-full" alt="http://www.legpromforum.ru">						</a>
					</li>
							</ul>
		</div>
	</section>

	<section class="partners" style="display: none;">
		<div class="row">
						<h3 style="margin: 0 auto; margin-bottom: 30px;">Информационная поддержка</h3>
					</div>
		<div class="partners-content">
			<ul class="partners-list ">
									<li>
												<a href="http://minpromtorg.gov.ru" target="_blank">
							<img width="713" height="120" src="http://intertkan.ru/wp-content/uploads/2015/10/minpromtorg.png" class="attachment-full size-full" alt="http://minpromtorg.gov.ru" srcset="http://intertkan.ru/wp-content/uploads/2015/10/minpromtorg.png 713w, http://intertkan.ru/wp-content/uploads/2015/10/minpromtorg-300x50.png 300w, http://intertkan.ru/wp-content/uploads/2015/10/minpromtorg-600x101.png 600w" sizes="(max-width: 713px) 100vw, 713px">						</a>
					</li>
									<li>
												<a href="http://www.rspp.ru" target="_blank">
							<img width="289" height="281" src="http://intertkan.ru/wp-content/uploads/2015/10/rspp.png" class="attachment-full size-full" alt="http://www.rspp.ru">						</a>
					</li>
									<li>
												<a href="https://tpprf.ru/ru/" target="_blank">
							<img width="118" height="220" src="http://intertkan.ru/wp-content/uploads/2015/10/tpp-rf.png" class="attachment-full size-full" alt="https://tpprf.ru/ru/">						</a>
					</li>
							</ul>
		</div>
	</section>

	<!--<section class="partners">
		<div class="partners-content">
			<h1>Партнёры:</h1>
			<ul class="partners-list ">
									<li>
												<a href="" target="_blank">
							<img width="332" height="70" src="http://intertkan.ru/wp-content/uploads/2017/07/expocentr_logo.gif" class="attachment-full size-full" alt="">						</a>
					</li>
									<li>
												<a href="http://fashionconsulting.ru/" target="_blank">
							<img width="150" height="75" src="http://intertkan.ru/wp-content/uploads/2017/07/fcg-e1501060575806.jpg" class="attachment-full size-full" alt="http://fashionconsulting.ru/">						</a>
					</li>
									<li>
												<a href="http://trendsquire.ru/" target="_blank">
							<img width="1172" height="890" src="http://intertkan.ru/wp-content/uploads/2017/07/trandsquare-копия.png" class="attachment-full size-full" alt="http://trendsquire.ru/" srcset="http://intertkan.ru/wp-content/uploads/2017/07/trandsquare-копия.png 1172w, http://intertkan.ru/wp-content/uploads/2017/07/trandsquare-копия-300x228.png 300w, http://intertkan.ru/wp-content/uploads/2017/07/trandsquare-копия-768x583.png 768w, http://intertkan.ru/wp-content/uploads/2017/07/trandsquare-копия-1024x778.png 1024w, http://intertkan.ru/wp-content/uploads/2017/07/trandsquare-копия-600x456.png 600w" sizes="(max-width: 1172px) 100vw, 1172px">						</a>
					</li>
									<li>
												<a href="http://just-education.ru" target="_blank">
							<img width="167" height="107" src="http://intertkan.ru/wp-content/uploads/2017/07/logo-1.png" class="attachment-full size-full" alt="http://just-education.ru">						</a>
					</li>
									<li>
												<a href="http://riamoda.ru/" target="_blank">
							<img width="217" height="54" src="http://intertkan.ru/wp-content/uploads/2017/07/riamoda.gif" class="attachment-full size-full" alt="http://riamoda.ru/">						</a>
					</li>
									<li>
												<a href="http://marketing.rbc.ru/" target="_blank">
							<img width="2179" height="884" src="http://intertkan.ru/wp-content/uploads/2017/07/RBC_logo_rescerch_preview.jpg" class="attachment-full size-full" alt="http://marketing.rbc.ru/" srcset="http://intertkan.ru/wp-content/uploads/2017/07/RBC_logo_rescerch_preview.jpg 2179w, http://intertkan.ru/wp-content/uploads/2017/07/RBC_logo_rescerch_preview-300x122.jpg 300w, http://intertkan.ru/wp-content/uploads/2017/07/RBC_logo_rescerch_preview-768x312.jpg 768w, http://intertkan.ru/wp-content/uploads/2017/07/RBC_logo_rescerch_preview-1024x415.jpg 1024w, http://intertkan.ru/wp-content/uploads/2017/07/RBC_logo_rescerch_preview-600x243.jpg 600w" sizes="(max-width: 2179px) 100vw, 2179px">						</a>
					</li>
									<li>
												<a href="http://solstudiodesign.com/" target="_blank">
							<img width="177" height="178" src="http://intertkan.ru/wp-content/uploads/2017/08/solstudio.jpg" class="attachment-full size-full" alt="http://solstudiodesign.com/" srcset="http://intertkan.ru/wp-content/uploads/2017/08/solstudio.jpg 177w, http://intertkan.ru/wp-content/uploads/2017/08/solstudio-150x150.jpg 150w" sizes="(max-width: 177px) 100vw, 177px">						</a>
					</li>
									<li>
												<a href="http://arts.msu.ru" target="_blank">
							<img width="500" height="127" src="http://intertkan.ru/wp-content/uploads/2016/02/arts.msu_.ru_-1.jpg" class="attachment-full size-full" alt="http://arts.msu.ru" srcset="http://intertkan.ru/wp-content/uploads/2016/02/arts.msu_.ru_-1.jpg 500w, http://intertkan.ru/wp-content/uploads/2016/02/arts.msu_.ru_-1-300x76.jpg 300w" sizes="(max-width: 500px) 100vw, 500px">						</a>
					</li>
									<li>
												<a href="http://fashionfactoryschool.com/" target="_blank">
							<img width="150" height="74" src="http://intertkan.ru/wp-content/uploads/2017/07/logo-ff-black-1-e1501060338449.png" class="attachment-full size-full" alt="http://fashionfactoryschool.com/">						</a>
					</li>
									<li>
												<a href="http://rio777.ru/" target="_blank">
							<img width="3061" height="838" src="http://intertkan.ru/wp-content/uploads/2018/07/logomsk-2.jpg" class="attachment-full size-full" alt="http://rio777.ru/" srcset="http://intertkan.ru/wp-content/uploads/2018/07/logomsk-2.jpg 3061w, http://intertkan.ru/wp-content/uploads/2018/07/logomsk-2-300x82.jpg 300w, http://intertkan.ru/wp-content/uploads/2018/07/logomsk-2-768x210.jpg 768w, http://intertkan.ru/wp-content/uploads/2018/07/logomsk-2-1024x280.jpg 1024w, http://intertkan.ru/wp-content/uploads/2018/07/logomsk-2-600x164.jpg 600w" sizes="(max-width: 3061px) 100vw, 3061px">						</a>
					</li>
									<li>
												<a href="http://irinabo.com/" target="_blank">
							<img width="150" height="123" src="http://intertkan.ru/wp-content/uploads/2017/07/logoTomsoyer-e1501060997507.png" class="attachment-full size-full" alt="http://irinabo.com/">						</a>
					</li>
									<li>
												<a href="http://elenaregak.com/" target="_blank">
							<img width="94" height="105" src="http://intertkan.ru/wp-content/uploads/2017/07/regak.png" class="attachment-full size-full" alt="http://elenaregak.com/">						</a>
					</li>
									<li>
												<a href="http://thermopol.ru" target="_blank">
							<img width="1005" height="311" src="http://intertkan.ru/wp-content/uploads/2018/02/Logo_orange.jpg" class="attachment-full size-full" alt="http://thermopol.ru" srcset="http://intertkan.ru/wp-content/uploads/2018/02/Logo_orange.jpg 1005w, http://intertkan.ru/wp-content/uploads/2018/02/Logo_orange-300x93.jpg 300w, http://intertkan.ru/wp-content/uploads/2018/02/Logo_orange-768x238.jpg 768w, http://intertkan.ru/wp-content/uploads/2018/02/Logo_orange-600x186.jpg 600w" sizes="(max-width: 1005px) 100vw, 1005px">						</a>
					</li>
									<li>
												<a href="http://friendly-w.com" target="_blank">
							<img width="180" height="180" src="http://intertkan.ru/wp-content/uploads/2018/02/logo-fb-2012.jpg" class="attachment-full size-full" alt="http://friendly-w.com" srcset="http://intertkan.ru/wp-content/uploads/2018/02/logo-fb-2012.jpg 180w, http://intertkan.ru/wp-content/uploads/2018/02/logo-fb-2012-150x150.jpg 150w" sizes="(max-width: 180px) 100vw, 180px">						</a>
					</li>
									<li>
												<a href="http://expressrms.ru" target="_blank">
							<img width="149" height="74" src="http://intertkan.ru/wp-content/uploads/2017/07/logo_vert-2-e1501061111351.png" class="attachment-full size-full" alt="http://expressrms.ru">						</a>
					</li>
									<li>
												<a href="http://fashion-academy.ru" target="_blank">
							<img width="150" height="66" src="http://intertkan.ru/wp-content/uploads/2017/07/naim_logo_0-1.png" class="attachment-full size-full" alt="http://fashion-academy.ru">						</a>
					</li>
									<li>
												<a href="http://asm5.ru/" target="_blank">
							<img width="1244" height="489" src="http://intertkan.ru/wp-content/uploads/2018/02/Akademia_sistemnogo_marketinga_.png" class="attachment-full size-full" alt="http://asm5.ru/" srcset="http://intertkan.ru/wp-content/uploads/2018/02/Akademia_sistemnogo_marketinga_.png 1244w, http://intertkan.ru/wp-content/uploads/2018/02/Akademia_sistemnogo_marketinga_-300x118.png 300w, http://intertkan.ru/wp-content/uploads/2018/02/Akademia_sistemnogo_marketinga_-768x302.png 768w, http://intertkan.ru/wp-content/uploads/2018/02/Akademia_sistemnogo_marketinga_-1024x403.png 1024w, http://intertkan.ru/wp-content/uploads/2018/02/Akademia_sistemnogo_marketinga_-600x236.png 600w" sizes="(max-width: 1244px) 100vw, 1244px">						</a>
					</li>
									<li>
												<a href="http://comtense.ru" target="_blank">
							<img width="550" height="65" src="http://intertkan.ru/wp-content/uploads/2018/02/comtense_logo.png" class="attachment-full size-full" alt="http://comtense.ru" srcset="http://intertkan.ru/wp-content/uploads/2018/02/comtense_logo.png 550w, http://intertkan.ru/wp-content/uploads/2018/02/comtense_logo-300x35.png 300w" sizes="(max-width: 550px) 100vw, 550px">						</a>
					</li>
									<li>
												<a href="" target="_blank">
							<img width="345" height="633" src="http://intertkan.ru/wp-content/uploads/2018/03/I-ONE-LAB-logo.png" class="attachment-full size-full" alt="" srcset="http://intertkan.ru/wp-content/uploads/2018/03/I-ONE-LAB-logo.png 345w, http://intertkan.ru/wp-content/uploads/2018/03/I-ONE-LAB-logo-164x300.png 164w, http://intertkan.ru/wp-content/uploads/2018/03/I-ONE-LAB-logo-327x600.png 327w" sizes="(max-width: 345px) 100vw, 345px">						</a>
					</li>
									<li>
												<a href="http://fashionweek.ru." target="_blank">
							<img width="400" height="397" src="http://intertkan.ru/wp-content/uploads/2018/03/fashionweek.png" class="attachment-full size-full" alt="http://fashionweek.ru." srcset="http://intertkan.ru/wp-content/uploads/2018/03/fashionweek.png 400w, http://intertkan.ru/wp-content/uploads/2018/03/fashionweek-150x150.png 150w, http://intertkan.ru/wp-content/uploads/2018/03/fashionweek-300x298.png 300w" sizes="(max-width: 400px) 100vw, 400px">						</a>
					</li>
									<li>
												<a href="http://kunjut.com/" target="_blank">
							<img width="521" height="276" src="http://intertkan.ru/wp-content/uploads/2018/03/kunjut-1.png" class="attachment-full size-full" alt="http://kunjut.com/" srcset="http://intertkan.ru/wp-content/uploads/2018/03/kunjut-1.png 521w, http://intertkan.ru/wp-content/uploads/2018/03/kunjut-1-300x159.png 300w" sizes="(max-width: 521px) 100vw, 521px">						</a>
					</li>
									<li>
												<a href="http://styledom-om.com" target="_blank">
							<img width="1170" height="600" src="http://intertkan.ru/wp-content/uploads/2018/03/dom.jpg" class="attachment-full size-full" alt="http://styledom-om.com" srcset="http://intertkan.ru/wp-content/uploads/2018/03/dom.jpg 1170w, http://intertkan.ru/wp-content/uploads/2018/03/dom-300x154.jpg 300w, http://intertkan.ru/wp-content/uploads/2018/03/dom-768x394.jpg 768w, http://intertkan.ru/wp-content/uploads/2018/03/dom-1024x525.jpg 1024w, http://intertkan.ru/wp-content/uploads/2018/03/dom-600x308.jpg 600w" sizes="(max-width: 1170px) 100vw, 1170px">						</a>
					</li>
							</ul>
		</div>
	</section>-->

	<section class="partners">
		<div class="row">
						<h3 style="margin: 0 auto; margin-bottom: 30px;"><? if (pll_current_language() == 'ru') { ?>Информационная поддержка<? } else { ?>Media support<? } ?></h3>
					</div>
		<div class="partners-content">
			<ul class="partners-list ">
									<li>
												<a href="http://e-mm.ru" target="_blank">
							<img width="1024" height="306" src="http://intertkan.ru/wp-content/uploads/2016/02/logo-MM_OK.jpg" class="attachment-full size-full" alt="http://e-mm.ru" srcset="http://intertkan.ru/wp-content/uploads/2016/02/logo-MM_OK.jpg 1024w, http://intertkan.ru/wp-content/uploads/2016/02/logo-MM_OK-300x90.jpg 300w, http://intertkan.ru/wp-content/uploads/2016/02/logo-MM_OK-768x230.jpg 768w, http://intertkan.ru/wp-content/uploads/2016/02/logo-MM_OK-600x179.jpg 600w" sizes="(max-width: 1024px) 100vw, 1024px">						</a>
					</li>
									<li>
												<a href="http://www.riamoda.ru/" target="_blank">
							<img width="217" height="54" src="http://intertkan.ru/wp-content/uploads/2015/10/ria-moda.gif" class="attachment-full size-full" alt="http://www.riamoda.ru/">						</a>
					</li>
									<li>
												<a href="http://navystavke.ru" target="_blank">
							<img width="187" height="50" src="http://intertkan.ru/wp-content/uploads/2017/06/187_50.jpg" class="attachment-full size-full" alt="http://navystavke.ru">						</a>
					</li>
									<li>
												<a href="http://new-retail.ru" target="_blank">
							<img width="828" height="482" src="http://intertkan.ru/wp-content/uploads/2018/02/Лого_NR.jpg" class="attachment-full size-full" alt="http://new-retail.ru" srcset="http://intertkan.ru/wp-content/uploads/2018/02/Лого_NR.jpg 828w, http://intertkan.ru/wp-content/uploads/2018/02/Лого_NR-300x175.jpg 300w, http://intertkan.ru/wp-content/uploads/2018/02/Лого_NR-768x447.jpg 768w, http://intertkan.ru/wp-content/uploads/2018/02/Лого_NR-600x349.jpg 600w" sizes="(max-width: 828px) 100vw, 828px">						</a>
					</li>
									<li>
												<a href="http://fashion.ru" target="_blank">
							<img width="2047" height="375" src="http://intertkan.ru/wp-content/uploads/2018/02/FASHION.RU_logo-1.png" class="attachment-full size-full" alt="http://fashion.ru" srcset="http://intertkan.ru/wp-content/uploads/2018/02/FASHION.RU_logo-1.png 2047w, http://intertkan.ru/wp-content/uploads/2018/02/FASHION.RU_logo-1-300x55.png 300w, http://intertkan.ru/wp-content/uploads/2018/02/FASHION.RU_logo-1-768x141.png 768w, http://intertkan.ru/wp-content/uploads/2018/02/FASHION.RU_logo-1-1024x188.png 1024w, http://intertkan.ru/wp-content/uploads/2018/02/FASHION.RU_logo-1-600x110.png 600w" sizes="(max-width: 2047px) 100vw, 2047px">						</a>
					</li>
									<li>
												<a href="http://delruss.ru/" target="_blank">
							<img width="200" height="200" src="http://intertkan.ru/wp-content/uploads/2017/11/Logo-Delruss-120х120-2.jpg" class="attachment-full size-full" alt="http://delruss.ru/" srcset="http://intertkan.ru/wp-content/uploads/2017/11/Logo-Delruss-120х120-2.jpg 200w, http://intertkan.ru/wp-content/uploads/2017/11/Logo-Delruss-120х120-2-150x150.jpg 150w" sizes="(max-width: 200px) 100vw, 200px">						</a>
					</li>
									<li>
												<a href="http://retail.ru/" target="_blank">
							<img width="500" height="158" src="http://intertkan.ru/wp-content/uploads/2017/08/logo3.png" class="attachment-full size-full" alt="http://retail.ru/" srcset="http://intertkan.ru/wp-content/uploads/2017/08/logo3.png 500w, http://intertkan.ru/wp-content/uploads/2017/08/logo3-300x95.png 300w" sizes="(max-width: 500px) 100vw, 500px">						</a>
					</li>
									<li>
												<a href="http://www.exporthub.com" target="_blank">
							<img width="175" height="150" src="http://intertkan.ru/wp-content/uploads/2018/01/exporthub-logo-175x150.jpg" class="attachment-full size-full" alt="http://www.exporthub.com">						</a>
					</li>
									<li>
												<a href="http://moda.ru" target="_blank">
							<img width="150" height="40" src="http://intertkan.ru/wp-content/uploads/2018/02/Modaru.png" class="attachment-full size-full" alt="http://moda.ru">						</a>
					</li>
									<li>
												<a href="http://generalexpo.ru/" target="_blank">
							<img width="544" height="218" src="http://intertkan.ru/wp-content/uploads/2017/07/GE_logo.jpg" class="attachment-full size-full" alt="http://generalexpo.ru/" srcset="http://intertkan.ru/wp-content/uploads/2017/07/GE_logo.jpg 544w, http://intertkan.ru/wp-content/uploads/2017/07/GE_logo-300x120.jpg 300w" sizes="(max-width: 544px) 100vw, 544px">						</a>
					</li>
									<li>
												<a href="http://invest-russia.org" target="_blank">
							<img width="466" height="232" src="http://intertkan.ru/wp-content/uploads/2018/02/logo_InRa_black.png" class="attachment-full size-full" alt="http://invest-russia.org" srcset="http://intertkan.ru/wp-content/uploads/2018/02/logo_InRa_black.png 466w, http://intertkan.ru/wp-content/uploads/2018/02/logo_InRa_black-300x149.png 300w" sizes="(max-width: 466px) 100vw, 466px">						</a>
					</li>
									<li>
												<a href="http://moda247.ru" target="_blank">
							<img width="100" height="100" src="http://intertkan.ru/wp-content/uploads/2017/07/moda247.logo_.RGB_.jpg" class="attachment-full size-full" alt="http://moda247.ru">						</a>
					</li>
									<li>
												<a href="http://ria.ru" target="_blank">
							<img width="640" height="262" src="http://intertkan.ru/wp-content/uploads/2016/02/ria-novosti.jpg" class="attachment-full size-full" alt="http://ria.ru" srcset="http://intertkan.ru/wp-content/uploads/2016/02/ria-novosti.jpg 640w, http://intertkan.ru/wp-content/uploads/2016/02/ria-novosti-300x123.jpg 300w, http://intertkan.ru/wp-content/uploads/2016/02/ria-novosti-600x246.jpg 600w" sizes="(max-width: 640px) 100vw, 640px">						</a>
					</li>
									<li>
												<a href="http://businessofrussia.com" target="_blank">
							<img width="217" height="83" src="http://intertkan.ru/wp-content/uploads/2015/10/business-rossii.png" class="attachment-full size-full" alt="http://businessofrussia.com">						</a>
					</li>
									<li>
												<a href="http://allfairs.ru" target="_blank">
							<img width="316" height="117" src="http://intertkan.ru/wp-content/uploads/2017/06/allfairs.jpg" class="attachment-full size-full" alt="http://allfairs.ru" srcset="http://intertkan.ru/wp-content/uploads/2017/06/allfairs.jpg 316w, http://intertkan.ru/wp-content/uploads/2017/06/allfairs-300x111.jpg 300w" sizes="(max-width: 316px) 100vw, 316px">						</a>
					</li>
									<li>
												<a href="http://expotrade.ru" target="_blank">
							<img width="100" height="100" src="http://intertkan.ru/wp-content/uploads/2017/06/expotrade_100x100-2.png" class="attachment-full size-full" alt="http://expotrade.ru">						</a>
					</li>
									<li>
												<a href="http://expo-book.com" target="_blank">
							<img width="190" height="158" src="http://intertkan.ru/wp-content/uploads/2017/06/120x100-new.jpg" class="attachment-full size-full" alt="http://expo-book.com">						</a>
					</li>
									<li>
												<a href="http://modanews.ru" target="_blank">
							<img width="136" height="184" src="http://intertkan.ru/wp-content/uploads/2015/10/moda-news.gif" class="attachment-full size-full" alt="http://modanews.ru">						</a>
					</li>
									<li>
												<a href="http://www.mvexpo.ru" target="_blank">
							<img width="200" height="100" src="http://intertkan.ru/wp-content/uploads/2017/06/mvexpo-200x100.gif" class="attachment-full size-full" alt="http://www.mvexpo.ru">						</a>
					</li>
									<li>
												<a href="http://expoclub.ru" target="_blank">
							<img width="208" height="50" src="http://intertkan.ru/wp-content/uploads/2017/05/expoclubru_logo_horiz_50.jpg" class="attachment-full size-full" alt="http://expoclub.ru">						</a>
					</li>
									<li>
												<a href="http://terra-expo.com" target="_blank">
							<img width="333" height="58" src="http://intertkan.ru/wp-content/uploads/2017/06/terra-1.png" class="attachment-full size-full" alt="http://terra-expo.com" srcset="http://intertkan.ru/wp-content/uploads/2017/06/terra-1.png 333w, http://intertkan.ru/wp-content/uploads/2017/06/terra-1-300x52.png 300w" sizes="(max-width: 333px) 100vw, 333px">						</a>
					</li>
									<li>
												<a href="http://ridjey.ru/" target="_blank">
							<img width="100" height="100" src="http://intertkan.ru/wp-content/uploads/2017/05/ridley.jpg" class="attachment-full size-full" alt="http://ridjey.ru/">						</a>
					</li>
									<li>
												<a href="http://worldexpo.pro" target="_blank">
							<img width="206" height="120" src="http://intertkan.ru/wp-content/uploads/2017/06/logo-footerWE.png" class="attachment-full size-full" alt="http://worldexpo.pro">						</a>
					</li>
									<li>
												<a href="http://wikiprom.ru/" target="_blank">
							<img width="100" height="100" src="http://intertkan.ru/wp-content/uploads/2017/09/wikiprom100.png" class="attachment-full size-full" alt="http://wikiprom.ru/">						</a>
					</li>
									<li>
												<a href="http://expo-group.com" target="_blank">
							<img width="160" height="50" src="http://intertkan.ru/wp-content/uploads/2017/06/expo-group-logo.png" class="attachment-full size-full" alt="http://expo-group.com">						</a>
					</li>
									<li>
												<a href="http://www.russia-today.ru" target="_blank">
							<img width="250" height="80" src="http://intertkan.ru/wp-content/uploads/2015/10/russia-today.jpeg" class="attachment-full size-full" alt="http://www.russia-today.ru">						</a>
					</li>
									<li>
												<a href="http://www.lp-magazine.ru" target="_blank">
							<img width="265" height="91" src="http://intertkan.ru/wp-content/uploads/2015/10/kurier.png" class="attachment-full size-full" alt="http://www.lp-magazine.ru">						</a>
					</li>
									<li>
												<a href="http://tradeindia.com" target="_blank">
							<img width="250" height="100" src="http://intertkan.ru/wp-content/uploads/2018/04/trade-shows.jpg" class="attachment-full size-full" alt="http://tradeindia.com">						</a>
					</li>
									<li>
												<a href="http://tetex.com/" target="_blank">
							<img width="11812" height="4324" src="http://intertkan.ru/wp-content/uploads/2018/02/1-2.jpg" class="attachment-full size-full" alt="http://tetex.com/" srcset="http://intertkan.ru/wp-content/uploads/2018/02/1-2.jpg 11812w, http://intertkan.ru/wp-content/uploads/2018/02/1-2-300x110.jpg 300w, http://intertkan.ru/wp-content/uploads/2018/02/1-2-768x281.jpg 768w, http://intertkan.ru/wp-content/uploads/2018/02/1-2-1024x375.jpg 1024w, http://intertkan.ru/wp-content/uploads/2018/02/1-2-600x220.jpg 600w" sizes="(max-width: 11812px) 100vw, 11812px">						</a>
					</li>
									<li>
												<a href="http://kogd.ru" target="_blank">
							<img width="718" height="199" src="http://intertkan.ru/wp-content/uploads/2017/07/kogd-logo-full.jpg" class="attachment-full size-full" alt="http://kogd.ru" srcset="http://intertkan.ru/wp-content/uploads/2017/07/kogd-logo-full.jpg 718w, http://intertkan.ru/wp-content/uploads/2017/07/kogd-logo-full-300x83.jpg 300w, http://intertkan.ru/wp-content/uploads/2017/07/kogd-logo-full-600x166.jpg 600w" sizes="(max-width: 718px) 100vw, 718px">						</a>
					</li>
									<li>
												<a href="http://tok-bg.org" target="_blank">
							<img width="640" height="480" src="http://intertkan.ru/wp-content/uploads/2018/02/logoTOKTBULGARIA.png" class="attachment-full size-full" alt="http://tok-bg.org" srcset="http://intertkan.ru/wp-content/uploads/2018/02/logoTOKTBULGARIA.png 640w, http://intertkan.ru/wp-content/uploads/2018/02/logoTOKTBULGARIA-300x225.png 300w, http://intertkan.ru/wp-content/uploads/2018/02/logoTOKTBULGARIA-600x450.png 600w" sizes="(max-width: 640px) 100vw, 640px">						</a>
					</li>
									<li>
												<a href="http://lpbinfo.ru/" target="_blank">
							<img width="1052" height="225" src="http://intertkan.ru/wp-content/uploads/2016/02/DirectorLogo.jpg" class="attachment-full size-full" alt="http://lpbinfo.ru/" srcset="http://intertkan.ru/wp-content/uploads/2016/02/DirectorLogo.jpg 1052w, http://intertkan.ru/wp-content/uploads/2016/02/DirectorLogo-300x64.jpg 300w, http://intertkan.ru/wp-content/uploads/2016/02/DirectorLogo-768x164.jpg 768w, http://intertkan.ru/wp-content/uploads/2016/02/DirectorLogo-1024x219.jpg 1024w, http://intertkan.ru/wp-content/uploads/2016/02/DirectorLogo-600x128.jpg 600w" sizes="(max-width: 1052px) 100vw, 1052px">						</a>
					</li>
									<li>
												<a href="http://katalog-moscow.ru" target="_blank">
							<img width="1258" height="416" src="http://intertkan.ru/wp-content/uploads/2016/02/Katalog_Moskva_BK_Logo_0.jpg" class="attachment-full size-full" alt="http://katalog-moscow.ru" srcset="http://intertkan.ru/wp-content/uploads/2016/02/Katalog_Moskva_BK_Logo_0.jpg 1258w, http://intertkan.ru/wp-content/uploads/2016/02/Katalog_Moskva_BK_Logo_0-300x99.jpg 300w, http://intertkan.ru/wp-content/uploads/2016/02/Katalog_Moskva_BK_Logo_0-768x254.jpg 768w, http://intertkan.ru/wp-content/uploads/2016/02/Katalog_Moskva_BK_Logo_0-1024x339.jpg 1024w, http://intertkan.ru/wp-content/uploads/2016/02/Katalog_Moskva_BK_Logo_0-600x198.jpg 600w" sizes="(max-width: 1258px) 100vw, 1258px">						</a>
					</li>
									<li>
												<a href="http://rosdr.ru" target="_blank">
							<img width="142" height="54" src="http://intertkan.ru/wp-content/uploads/2016/02/rosdelcenter.png" class="attachment-full size-full" alt="http://rosdr.ru">						</a>
					</li>
									<li>
												<a href="http://b-mag.ru" target="_blank">
							<img width="243" height="65" src="http://intertkan.ru/wp-content/uploads/2016/02/b-mag.ru_.png" class="attachment-full size-full" alt="http://b-mag.ru">						</a>
					</li>
									<li>
												<a href="http://retail-life.ru" target="_blank">
							<img width="300" height="176" src="http://intertkan.ru/wp-content/uploads/2018/02/2_logo_ritail_life-3.png" class="attachment-full size-full" alt="http://retail-life.ru">						</a>
					</li>
									<li>
												<a href="http://expomap.ru" target="_blank">
							<img width="238" height="100" src="http://intertkan.ru/wp-content/uploads/2016/02/expomap.ru_.png" class="attachment-full size-full" alt="http://expomap.ru">						</a>
					</li>
									<li>
												<a href="http://www.baltictextile.eu/vilnius/en" target="_blank">
							<img width="285" height="170" src="http://intertkan.ru/wp-content/uploads/2018/02/BFT_285x170px_2018.jpg" class="attachment-full size-full" alt="http://www.baltictextile.eu/vilnius/en">						</a>
					</li>
									<li>
												<a href="http://chastnik.ru/" target="_blank">
							<img width="173" height="36" src="http://intertkan.ru/wp-content/uploads/2017/08/logo_chastnik.png" class="attachment-full size-full" alt="http://chastnik.ru/">						</a>
					</li>
									<li>
												<a href="http://promportal.su" target="_blank">
							<img width="211" height="31" src="http://intertkan.ru/wp-content/uploads/2016/02/promportal.su_.gif" class="attachment-full size-full" alt="http://promportal.su">						</a>
					</li>
									<li>
												<a href="http://pigmalion-journal.com" target="_blank">
							<img width="1176" height="994" src="http://intertkan.ru/wp-content/uploads/2018/02/PIGMALION-logo.jpg" class="attachment-full size-full" alt="http://pigmalion-journal.com" srcset="http://intertkan.ru/wp-content/uploads/2018/02/PIGMALION-logo.jpg 1176w, http://intertkan.ru/wp-content/uploads/2018/02/PIGMALION-logo-300x254.jpg 300w, http://intertkan.ru/wp-content/uploads/2018/02/PIGMALION-logo-768x649.jpg 768w, http://intertkan.ru/wp-content/uploads/2018/02/PIGMALION-logo-1024x866.jpg 1024w, http://intertkan.ru/wp-content/uploads/2018/02/PIGMALION-logo-600x507.jpg 600w" sizes="(max-width: 1176px) 100vw, 1176px">						</a>
					</li>
									<li>
												<a href="http://vedcons.ru" target="_blank">
							<img width="400" height="96" src="http://intertkan.ru/wp-content/uploads/2016/02/vedcons.ru_.png" class="attachment-full size-full" alt="http://vedcons.ru" srcset="http://intertkan.ru/wp-content/uploads/2016/02/vedcons.ru_.png 400w, http://intertkan.ru/wp-content/uploads/2016/02/vedcons.ru_-300x72.png 300w" sizes="(max-width: 400px) 100vw, 400px">						</a>
					</li>
									<li>
												<a href="http://kommersant.ru" target="_blank">
							<img width="1136" height="141" src="http://intertkan.ru/wp-content/uploads/2016/02/kommersant.ru_.png" class="attachment-full size-full" alt="http://kommersant.ru" srcset="http://intertkan.ru/wp-content/uploads/2016/02/kommersant.ru_.png 1136w, http://intertkan.ru/wp-content/uploads/2016/02/kommersant.ru_-300x37.png 300w, http://intertkan.ru/wp-content/uploads/2016/02/kommersant.ru_-768x95.png 768w, http://intertkan.ru/wp-content/uploads/2016/02/kommersant.ru_-1024x127.png 1024w, http://intertkan.ru/wp-content/uploads/2016/02/kommersant.ru_-600x74.png 600w" sizes="(max-width: 1136px) 100vw, 1136px">						</a>
					</li>
									<li>
												<a href="http://promvest.info" target="_blank">
							<img width="300" height="130" src="http://intertkan.ru/wp-content/uploads/2018/03/^932EFA1F04ACACC8D947E19CF562686969106A9021AFDD46FE^pimgpsh_fullsize_distr.jpg" class="attachment-full size-full" alt="http://promvest.info">						</a>
					</li>
									<li>
												<a href="http://WilliZ.ru" target="_blank">
							<img width="320" height="295" src="http://intertkan.ru/wp-content/uploads/2016/02/WilliZ.jpg" class="attachment-full size-full" alt="http://WilliZ.ru" srcset="http://intertkan.ru/wp-content/uploads/2016/02/WilliZ.jpg 320w, http://intertkan.ru/wp-content/uploads/2016/02/WilliZ-300x277.jpg 300w" sizes="(max-width: 320px) 100vw, 320px">						</a>
					</li>
									<li>
												<a href="http://natannge-fmd.ru" target="_blank">
							<img width="200" height="80" src="http://intertkan.ru/wp-content/uploads/2017/01/Наш-FMD-логотип-200x80.jpg" class="attachment-full size-full" alt="http://natannge-fmd.ru">						</a>
					</li>
									<li>
												<a href="http://totalexpo.ru" target="_blank">
							<img width="150" height="150" src="http://intertkan.ru/wp-content/uploads/2016/07/TOTAL-EXPO-logovar2-150x150.png" class="attachment-full size-full" alt="http://totalexpo.ru">						</a>
					</li>
									<li>
												<a href="http://ivtextil.ru" target="_blank">
							<img width="250" height="83" src="http://intertkan.ru/wp-content/uploads/2016/07/250-х-83.png" class="attachment-full size-full" alt="http://ivtextil.ru">						</a>
					</li>
									<li>
												<a href="http://hotwork.ru/" target="_blank">
							<img width="355" height="118" src="http://intertkan.ru/wp-content/uploads/2016/08/hotwork-logo-png-1.png" class="attachment-full size-full" alt="http://hotwork.ru/" srcset="http://intertkan.ru/wp-content/uploads/2016/08/hotwork-logo-png-1.png 355w, http://intertkan.ru/wp-content/uploads/2016/08/hotwork-logo-png-1-300x100.png 300w" sizes="(max-width: 355px) 100vw, 355px">						</a>
					</li>
									<li>
												<a href="http://www.mbm.ru" target="_blank">
							<img width="412" height="139" src="http://intertkan.ru/wp-content/uploads/2018/03/gbu_logo.jpg" class="attachment-full size-full" alt="http://www.mbm.ru" srcset="http://intertkan.ru/wp-content/uploads/2018/03/gbu_logo.jpg 412w, http://intertkan.ru/wp-content/uploads/2018/03/gbu_logo-300x101.jpg 300w" sizes="(max-width: 412px) 100vw, 412px">						</a>
					</li>
							</ul>
		</div>
	</section>
	</div>
</section>

        </main>
        <!--// Page Content -->

        <!-- Footer -->
<? get_footer(); ?>