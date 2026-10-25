<?php
/*
Template Name: Страница "Сервисы: iOS"
*/
get_header(); ?>

<style>
@media screen and (max-width: 450px) {
	.header-img{margin-top: 99px;}
	.header-img img{top: 0px!important;}
	.review{ bachground-position:top center!important;}
}
</style>

	<div class="services-nav">
		<div class="container">
		<ul>
			<li class="current">
				<a href="#">
					<span class="box-circle">
						<span class="box-in"><i class="icon icon-ios-grey"></i></span>
					</span>
					<span>Разработка <br>под iOS</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="box-circle">
						<span class="box-in"><i class="icon icon-android-grey"></i></span>
					</span>
					<span>Разработка <br>под Android</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="box-circle">
						<span class="box-in"><i class="icon icon-app-grey"></i></span>
					</span>
					<span>Продвижение <br>приложений</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="box-circle">
						<span class="box-in"><i class="icon icon-web-grey"></i></span>
					</span>
					<span>Разработка <br>web-сервисов</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="box-circle">
						<span class="box-in"><i class="icon icon-game-grey"></i></span>
					</span>
					<span>Разработка <br>игр</span>
				</a>
			</li>
		</ul>
		</div>
	</div>
    <section class="page-service ios-development">
    	<div class="container">
    		<h1>Разработка <br>
			приложений <br>
			на базе iOS <br>
			для iPhone и iPad</h1>
			<a class="btn btn-primary" href="#"><span class="icon icon-email"></span> оставить заявку</a>
    	</div>
    </section>

	 <section class="company-info">
            <div class="container text-center">
                <h1 class="noBorderTop">всякие наши преимущества и прочая инфа для текстового блока</h1>
                <p>Разработка приложений под iOS, Android OS, Windows Phone 8,<br>а также приложений для социальных сетей и промо-приложений. Разработка кроссплатформенных приложений. Разработка игр для соц сетей, web и мобильных устройств. Продвижение приложений. Создание сайтов. Электронное обучение, управление бизнесом на планшетах. Портирование программного обеспечения и разработка ПО. Гарантия и техническая поддержка.</p>
            </div> 
              
    </section>
    <div class="services-block">

    <?
        $posts = get_posts(array(
            'category_name'=>'projects_services',
            'orderby'=>'date',
            'order'=>'DESC',
        ));

        $part_title = "Наши проекты";
        include(locate_template('portfolio.paralax.php'));
    ?>
    </div>

    <section class="call-us">
        <div class="container">
            <div class="tooltip-yellow">
                <p><strong>Бесплатная консультация с Техническим Директором и Аналитиком!</strong></p>
                <p>Если у вас есть вопросы или вы хотите оценить свою идею/проект, то можете позвонить по телефонам или воспользоваться формой обратной связи на сайте.</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p>г.Москва</p>
                    <p class="txt-lead">+7 (495) 215-51-82</p>
                </div>
                <div class="col-md-4">
                    <p>г. Санкт-Петербург</p>
                    <p class="txt-lead">+7 (812) 242-80-58</p>
                </div>
                 <div class="col-md-4 text-center">
                    <span class="icon icon-question"></span>
                    <a href="#" class="btn btn-primary"><span class="icon icon-email"></span> оставить заявку</a> 
                </div>
            </div>
        </div>
    </section>
	<section class="process-develop">
		<div class="container text-center">
			<h2>Работая с Infoshell, вы получаете</h2>
			 <ul class="list-inline list-advantages">
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-idea"></i>
                        </span>
                    </span>
                    <div class="title">1. Идея</div>
                  	<div class="help-text">Подберем оптимальный <br>способ реализации,<br>оценим риски.</div>
                </li>
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-market"></i>
                        </span>
                    </span>
                     <div class="title">2. Анализ рынка</div>
                  	<div class="help-text">Изучим рынок <br>
для приложения,<br>
разработаем план<br>
мотивации</div>
                </li> 
                <li>
                    <span class="btn-cicle">
                    <span class="btn-cicle-inner">
                        <i class="icon icon-prototype"></i>
                    </span>
                    </span>
                     <div class="title">3. UI/UX прототипы<br>
экранов</div>
                  	<div class="help-text">Подберем оптимальный<br>
способ реализации,<br>
оценим риски.</div>
                </li> 
                <li>
                   <span class="btn-cicle">
                       <span class="btn-cicle-inner">
                           <i class="icon icon-design-adv"></i>
                       </span>
                    </span>
                     <div class="title">4. Дизайн</div>
                  	<div class="help-text">Изучим рынок <br>
для приложения,<br>
разработаем план<br>
мотивации.</div>    
                </li> 
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-dev-adv"></i>
                        </span>
                    </span>
                     <div class="title">5. Разработка</div>
                  	<div class="help-text">Подберем оптимальный<br>
способ реализации,<br>
оценим риски.</div>
                </li>            
            </ul>
            <ul class="list-inline list-advantages">
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-web-adv"></i>
                        </span>
                    </span>
                    <div class="title">6. WEB Разработка</div>
                  	<div class="help-text">Подберем оптимальный <br>способ реализации,<br>оценим риски.</div>
                </li>
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-testing"></i>
                        </span>
                    </span>
                     <div class="title">7. Тестирование</div>
                  	<div class="help-text">Изучим рынок <br>
для приложения,<br>
разработаем план<br>
мотивации</div>
                </li> 
                <li>
                    <span class="btn-cicle">
                    <span class="btn-cicle-inner">
                        <i class="icon icon-start"></i>
                    </span>
                    </span>
                     <div class="title">8. Запуск</div>
                  	<div class="help-text">Подберем оптимальный<br>
способ реализации,<br>
оценим риски.</div>
                </li> 
                <li>
                   <span class="btn-cicle">
                       <span class="btn-cicle-inner">
                           <i class="icon icon-promotion"></i>
                       </span>
                    </span>
                     <div class="title">9. Продвижение</div>
                  	<div class="help-text">Изучим рынок <br>
для приложения,<br>
разработаем план<br>
мотивации.</div>    
                </li> 
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-support"></i>
                        </span>
                    </span>
                     <div class="title">10. Поддержка</div>
                  	<div class="help-text">Подберем оптимальный<br>
способ реализации,<br>
оценим риски.</div>
                </li>            
            </ul>
			<p>
                <a class="btn btn-primary" href="#"><span class="icon icon-email"></span> оставить заявку</a>
            </p>
		</div>
	</section>
	<section class="our-clients">
        <div class="container text-center">
            <h2 class="txt-black">Клиенты</h2>
            <ul class="list-inline list-client-brands">
                <?php query_posts('category_name=clients&orderby=date&order=DESC');?>	
					<?php if ( have_posts() ) : ?>
						<?php
						while ( have_posts() ) : the_post(); ?>
							<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');?>
							<li><img src="<?php echo $large_image_url[0]; ?>" alt="" height="108" /></li>
						<?php endwhile; ?>
					<?php endif; wp_reset_query();?>              
            </ul>
            <p>и еще более 50 компаний</p>
            
        </div>
    </section>
	 <section class="team-block grey-block">
        <div class="container text-center">
            <h2 class="txt-black">команда <span class="txt-lowercase">i</span>OS</h2>
             <ul class="no-list left-list staff-list">
                <?php query_posts('category_name=staff&orderby=date&order=ASC');?>   
                <?php if ( have_posts() ) : ?>
                        <?php
                        while ( have_posts() ) : the_post(); ?>
                            <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');?>
                            <li>
                                <div class="thumb"><img src="<?php echo $large_image_url[0]; ?>" alt="" /></div>

                                <?php the_content();?>
                            </li>
                        <?php endwhile; ?>
                <?php endif; wp_reset_query();?>
            </ul>  
        </div>
    </section>
    <section class="white-block">
    	 <div class="container text-center">
    	 	<p class="next-link"><a href="#"><span>Далее:</span> Разработка под Android <span class="icon icon-arrow-grey"></span></a></p>
    	 	<p>
                <a class="btn btn-primary" href="#"><span class="icon icon-email"></span> оставить заявку</a>
            </p>
    	 </div>
    </section>
<?php get_footer(); ?>