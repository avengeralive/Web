<?php
/*
Template Name: Страница "business"
*/
get_header(); ?>

<style>
@media screen and (max-width: 450px) {
	.header-img{margin-top: 99px; padding-bottom: 34px;}
	.header-img img{top: 0px!important;}
}
</style>

    <div class="relative mobmargin100">
        <div class="relative" data-stellar-ratio="0.5">
            <?php $image = get_field('background'); ?>
            <img src="<?php echo $image['url']; ?>" class="img-full-width relative" width="1920" >
        </div>
    </div>

	<section id="section_0">
		<div class="color_next-block color-block-info yellow-block">
			<div class="container">
				<h2>Мобильные приложения<br>для бизнеса</h2>
				<div style="" class=" text-center"><b>80%</b> компаний из списка <b>Fortune</b> уже создали свои мобильные приложения,<br>
что позволило достичь <b>30% экономии и увеличило объем продаж</b>. 
</div>
			</div>
		</div>
	</section>
	<section id="section_1">
		<div class="color_next-block color-block-info white-block">
			<div class="container mob_benefits">
				<h2 class="dark">Преимущества от мобилизации в бизнесе:</h2>
				<div class="row clearfix">
					<div class="col-md-2 mob30 no-padding col-md-offset-1 text-center ">
						<div class="round-arrow-item no-arrow">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/business_benifits1.png" alt=""></i>
							<span class="dark">Возможен рост  прибыли за счет оптимального использования ресурсов </span>
						</div>
					</div>
					<div class="col-md-2 mob30 text-center ">
						<div class="round-arrow-item no-arrow">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/business_benifits2.png" alt=""></i>
							<span class="dark">Прирост объема<br>продаж или <br>производства</span>
						</div>
					</div>
					<div class="col-md-2 mob30 text-center ">
						<div class="round-arrow-item no-arrow">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/business_benifits3.png" alt=""></i>
							<span class="dark">Улучшение<br>взаимоотношений <br>с покупателем</span>
						</div>
					</div>
					<div class="m_clear"><!--//--></div>
					<div class="col-md-2 mob30 mobpadl20 no-padding  text-center ">
						<div class="round-arrow-item no-arrow">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/business_benifits4.png" alt=""></i>
							<span class="dark">Повышение производительности труда работников</span>
						</div>
					</div>
					<div class="col-md-2 mob30 mobpadr20 no-padding text-center ">
						<div class="round-arrow-item no-arrow">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/business_benifits5.png" alt=""></i>
							<span class="dark">Улучшение<br>процесса принятия<br>управленческих <br>решений</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="section_2">
		<div class="color-block-info grey-block">
			<div class="container">
				<div class=" text-center"><b>70% ИТ-директоров подтверждают</b>, что  мобильность в бизнесе стратегически важна.<br><b>(согласно результатам опроса CIO.com и SAP)</b></div>
			</div>
		</div>
	</section>

    <?
    $posts = get_posts(array(
        'category_name'=>'projects_business',
        'orderby'=>'date',
        'order'=>'DESC',
    ));

    $part_title = "Решение для внутрикорпоративного<br>использования";
    $block_class = 'buisness_portfolio';
    include(locate_template('portfolio.paralax.php'));

    ?>

    <section id="section_4">
		<div class="presentaton color-block-info grey-block after200">
			<div class="container">
			<h2 class="dark">Решения для массового<br> использования</h2>
			<h3>Приложения класса B2С, которые помогают в осуществление коммуникации<br> между организацией и ее клиентами. Мы разрабатываем специализированные<br>мобильные приложения для  любой сферы бизнеса.</h3>
			<div class="presentaton-carousel" id="solution-carousel">
					<div class="solution-carousel-arrows dark carousel-arrows">
						<a class="carousel-arrow a-left" href="#"><i></i></a>
						<a class="carousel-arrow a-right" href="#"><i></i></a>
					</div>
  					<ul class="no-list left-list carousel-block">
					
					<?php query_posts('category_name=projects_mass&orderby=date&order=DESC');?>	
					<?php if ( have_posts() ) : ?>
						<?php
						while ( have_posts() ) : the_post(); ?>
					
						<?php
							$cont = get_the_content();
							$link = strip_tags($cont);
						?>
						<li class="carousel-item">
							<div class="row clearfix no-margin">
								<div class="col-md-8 no-padding col-md-offset-2">
									<div class="presentation-name"><?php the_title(); ?></div>
									<div class="presentation-block">
										<iframe src="<?php echo $link; ?>" width="663" height="533" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="max-width: 100%;" allowfullscreen> </iframe> 
									</div>
								</div>								
							</div>
						</li>
						
							<?php endwhile; ?>
					<?php endif; wp_reset_query();?>

					</ul>
				</div>
			</div>
		</div>
	</section>
	
	
	<section id="section_5">
		<div class="business_benifits block-with-bg parallax" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
			<div class="container mob_benefits">
				<h2>наши приемущества:</h2>
				<div class="row clearfix">
					<div class="col-md-2 mob30 no-padding col-md-offset-1 text-center">
						<div class="round-arrow-item no-arrow">
							<i class="white">80</i>
							<span>Реализовали<br>более 80 проектов</span>
						</div>
					</div>
					<div class="col-md-2 mob30 no-padding text-center">
						<div class="round-arrow-item no-arrow">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/be_partners1-white.png" alt=""></i>
							<span>Система<br>менеджмента качества<br>сертифицирована </span>
						</div>
					</div>
					<div class="col-md-2 mob30 no-padding text-center">
						<div class="round-arrow-item no-arrow">
							<i class="white">5</i>
							<span>5 лет на<br>Российском<br>рынке </span>
						</div>
					</div>
					<div class="m_clear"><!--//--></div>
					<div class="col-md-2 mob30 mobpadl20 text-center">
						<div class="round-arrow-item no-arrow">
							<i class="img-in"><img src="<?php echo get_template_directory_uri(); ?>/images/be_partners2-white.png" alt=""></i>
							<span>Топовые позиции<br>в рейтингах </span>
						</div>
					</div>
					<div class="col-md-2 mob30 mobpadr20 no-padding text-center">
						<div class="round-arrow-item no-arrow">
							<i class="text-type1 white" style="padding-top: 40px;"><div>более</div><b>10 000</b><div>запросов/сек</div></i>
							<span>Разрабатываем<br>высоконагруженные веб-сервисы </span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="section_6">
		<div class="color-block-info yellow-block">
			<div class="container">
				<div class=" text-center"><a href="#leave-review" class="btn-white2 js-leave-review">оценить свой проект</a></div>
			</div>
		</div>
		<div class="color-block-info white-block-container content none" id="leave-review">
			<div class="container">
				<form name="frm2" id="buisnessform1" class="review-form none" method='post' action='<?php echo get_template_directory_uri(); ?>/mail/send.php' enctype='multipart/form-data'>
					<div class="form-success none">Спасибо за заявку! Наши менеджеры свяжутся с вами<br> в ближайшее время!</div>
					<div class="row clearfix">
						<div class="col-md-4"><input type="text" value="" name="name" placeholder="Имя"></div>
						<div class="col-md-4"><input type="text" value="" name="email" placeholder="E-mail"></div>
						<div class="col-md-4"><input type="text" value="" name="phone" placeholder="Телефон"></div>
					</div>
					<div class="row clearfix">
						<div class="col-md-12"><textarea cols="3" name="message" placeholder="Доп. информация"></textarea></div>
					</div>
					<div class="row clearfix mbupl">
						<div class="col-md-7"></div>
						<div class="col-md-5" >
							<div class="file-upload left">
								<input type="file" name="upload_file" />
								<a href="#" class="btn-yellow upload-icon"><i></i>загрузить тз</a>
							</div>
							<input type="submit" class="btn-yellow" value="отправить" id="sendquest2" />
						</div>
					</div>
				</form>
			</div>
            <script>
                $(document).ready(function(){
                    $('#buisnessform1').submit(function(){

                        yaCounter934261.reachGoal('BUISINESS_1');
                       // console.log('BUISINESS_1');
                    });

                });
            </script>
			<div class="white-block-bottom"></div>
		</div>
	</section>


<?php get_footer(); ?>