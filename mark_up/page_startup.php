<?php
/*
Template Name: Страница "startup"
*/
get_header(); ?>

<style>
@media screen and (max-width: 450px) {
	.win-steps {background: url('<?php echo get_template_directory_uri(); ?>/images/to_win_steps-bg.jpg') no-repeat center top transparent;}
}
</style>

    <?
        //слайдер в шапке
        $posts = get_posts(array(
            'category_name'=>'startup_slider',
            'orderby'=>'date',
            'order'=>'DESC',
        ));
        include(locate_template('new_slider_header.php'));
    ?>


	<section id="section_0">
		<div class="color-block-info yellow2-block">
			<div class="container">
				<h2>«StartUp preview»</h2>
				<div class=" text-center"><i><b>Два раза в год</b> компания объявляет о приеме заявок на конкурс <b>«StartUp preview»</b>.<br> 
Участвовать может любой гражданин мира, в независимости от возраста и страны <br>
проживания. Две лучших идеи будут реализованы компаний <br>
бесплатно на условиях роялти.</i></div>
			</div>
		</div>
	</section>
	<section id="section_1">
		<div class="help-in-dev block-with-bg parallax "  data-stellar-background-ratio="0.5">
			<div class="container startup">
				<h2>помощь в разработке <br> от «ИДЕИ» до «ВЫВОДА НА РЫНОК»:</h2>
				<div class="row clearfix">
					<div class="col-md-3 text-center">
						<div class="round-arrow-item">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/help_icon1.png" alt=""></i>
							<span>Привлечем деньги для <br>финансирования проекта</span>
						</div>
					</div>
					<div class="col-md-3 text-center">
						<div class="round-arrow-item no">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/help_icon2.png" alt=""></i>
							<span>Доработаем<br>бизнес-модель</span>
						</div>
					</div>
					<div class="m_clear"><!--//--></div>
					<div class="col-md-3 text-center">
						<div class="round-arrow-item">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/help_icon3.png" alt=""></i>
							<span>Разработаем<br>проект</span>
						</div>
					</div>
					<div class="col-md-3 text-center">
						<div class="round-arrow-item no-arrow">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/help_icon4.png" alt=""></i>
							<span style="font-size:18px;line-height:24px;padding-top:3px;">Дадим рекомендации<br>по продвижению</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="color-block-info white-block after200">
			<div class="container">
				<div class="rl text-center"><i>В качестве жюри выступят эксперты  и представители крупных инвестиционных фондов России.  Ваш проект увидят профессионалы из GetTaxi, Lingualeo, iFREE, Литрес, Delivery club и многих других известных компаний.</i></div>
			</div>
		</div>
	</section>
	<section id="section_2">
		<div class="win-steps block-with-bg parallax"  data-stellar-background-ratio="0.5">
			<div class="container startup">
				<h2>Что нужно для того, чтобы выиграть<br>в конкурсе «StartUp preview»?</h2>
				<div class="row clearfix">
					<div class="col-md-3 text-center">
						<div class="round-arrow-item">
							<i class="win-step-text">1</i>
							<span>Описать бизнес-модель <br>вашего СТАРТАПА </span>
						</div>
					</div>
					<div class="col-md-3 text-center">
						<div class="round-arrow-item no">
							<i class="win-step-text">2</i>
							<span>Отправить заявку на<br> рассмотрение проекта</span>
						</div>
					</div>
					<div class="m_clear"><!--//--></div>
					<div class="col-md-3 text-center">
						<div class="round-arrow-item">
							<i class="win-step-text">3</i>
							<span>Пройти отбор среди<br>других СТАРТАПОВ</span>
						</div>
					</div>
					<div class="col-md-3 text-center">
						<div class="round-arrow-item no-arrow">
							<i class="win-step-text">4</i>
							<span style="font-size:18px;line-height:24px;padding-top:3px;">Начать работу с нашей<br>технической командой</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="section_3">
		<div class="color-block-info white-block after200">
			<div class="container mob_benefits">
				<h2 class="dark">Мы будем надежными<br>партнерами для Вас:</h2>
				<div class="row clearfix">
					<div class="col-md-2 mob30 no-padding text-center">
						<div class="round-arrow-item no-arrow">
							<i>80</i>
							<span class="dark">Реализовали<br>более 80 проектов</span>
						</div>
					</div>
					<div class="col-md-3 mob30 text-center">
						<div class="round-arrow-item no-arrow">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/be_partners1.png" alt=""></i>
							<span class="dark">Система<br>менеджмента качества<br>сертифицирована </span>
						</div>
					</div>
					<div class="col-md-2 mob30 no-padding text-center">
						<div class="round-arrow-item no-arrow">
							<i>5</i>
							<span class="dark">5 лет на<br>Российском<br>рынке </span>
						</div>
					</div>
					<div class="m_clear"><!--//--></div>
					<div class="col-md-3 mob30 mobpadl20 text-center">
						<div class="round-arrow-item no-arrow">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/be_partners2.png" alt=""></i>
							<span class="dark">Топовые позиции<br>в рейтингах </span>
						</div>
					</div>
					<div class="col-md-2 mob30 mobpadr20 no-padding text-center">
						<div class="round-arrow-item no-arrow">
							<i class="text-type1" style="padding-top: 40px;"><div>Более</div><b>10 000</b><div>запросов/сек</div></i>
							<span class="dark">Разрабатываем<br>высоконагруженные веб-сервисы </span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="section_4">
		<div class="startup-order block-with-bg parallax"  data-stellar-background-ratio="0.5">
			<div class="container mb_form">
				<h2>Заявка на рассмотрение проекта:</h2>
				<div class="row clearfix">
					<div class="col-md-5 startup-order-description">
						<i class="rl">Презентация проекта должна содержать <br>следующую информацию: История <br>компании/проекта; команда, описание <br>продукта/сервиса, рынок (конкуренты, <br>потребители, поставщики, заменители), <br>финансовые показатели (прогноз).</i>
						<div class="btn-container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>files/%D0%9F%D1%80%D0%B5%D0%B7%D0%B5%D0%BD%D1%82%D0%B0%D1%86%D0%B8%D1%8F%20%D1%81%D1%82%D0%B0%D1%80%D1%82%D0%B0%D0%BF%D0%B5%D1%80%D1%83%20%D1%88%D0%B0%D0%B1%D0%BB%D0%BE%D0%BD%20%D0%B4%D0%BB%D1%8F%20%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D1%8B.pptx" class="btn-white download-item"><span>шаблон<br>презентации</span><i></i></a></div>
					</div>
					<div class="col-md-6 col-md-offset-1">
					
						<form name="frm2" id="startupform1" class="startup-order-form" method='post' action='<?php echo get_template_directory_uri(); ?>/mail/send.php' enctype='multipart/form-data' >
							<input type="text" value="" name="name" placeholder="Имя и фамилия">
							<input type="text" value="" name="email" placeholder="E-mail:">
							<input type="text" value="" name="phone" placeholder="Телефон:">
							<textarea name="message" placeholder="Презентация проекта:" rows="9"></textarea>
							<div class="clearfix mbupl">
								<div class="file-upload left">
								<input type="file" name="upload_file" />
								<a href="#" class="btn-white3 upload-file"><i></i><span>прикрепить файл</span></a>
								</div>
								<input class="btn-white3 right class190" style="width:220px" type="submit" value="Отправить" id="sendquest2" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
        <script>
            $(document).ready(function(){
                $('#startupform1').submit(function(){

                    yaCounter934261.reachGoal('STARTUP_1');
                   // console.log('STARTUP_1');
                });

            });
        </script>
	</section>
    <? /*
	<section id="section_3" style="padding-bottom: 28px;">
		<div class="company-info white-block">
			<div class="container">
				<h2 class="dark">партнеры:</h2>


					<div class="star_sponsor">
						<?php query_posts('category_name=star_sponsor&orderby=date&order=DESC');?>	
						<?php if ( have_posts() ) : ?>
							<?php
							while ( have_posts() ) : the_post(); ?>
								<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'star_sponsor');?>
								<div class="ss"><img src="<?php echo $large_image_url[0]; ?>" alt=""   /></div>
							<?php endwhile; ?>
						<?php endif; wp_reset_query();?>
						
						
						<div class="clear"></div>
					</div>
					
					<style>
						.star_sponsor .ss{float:left; width:25%; margin:10px 0; text-align:center;overflow:hidden; line-height:137px; height:137px}
						.star_sponsor .ss img{max-height:137px; max-width:100%;}
					</style>
	
			</div>
		</div>
	</section>
    */?>
    <section id="section_3" class="partners_block">
        <div class="white-block">
            <div class="container no-padding">
                <h2 class="dark">партнеры:</h2>
                <div class="client-carousel" id="client-carousel">
                    <div class="client-carousel-arrows carousel-arrows dark">
                        <a class="carousel-arrow a-left" href="#"><i></i></a>
                        <a class="carousel-arrow a-right" href="#"><i></i></a>
                    </div>
                    <ul class="no-list left-list client-carousel-list">
                        <?php query_posts('category_name=star_sponsor&orderby=date&order=DESC');?>
                        <?php if ( have_posts() ) : ?>
                            <?php
                            while ( have_posts() ) : the_post(); ?>
                                <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');?>
                                <li><img src="<?php echo $large_image_url[0]; ?>" alt="" height="108" /></li>
                            <?php endwhile; ?>
                        <?php endif; wp_reset_query();?>


                    </ul>

                </div>
            </div>
        </div>
    </section>


<?php get_footer(); ?>