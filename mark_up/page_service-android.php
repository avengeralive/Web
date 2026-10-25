<?php
/*
Template Name: Страница "Сервисы: Android"
*/
get_header(); ?>

<script> 
$(document).ready(function(){
    $('#menu-item-2108').addClass('current-menu-item'); 
});
</script>

	<div class="services-nav">
		<div class="container">
		<ul>
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>developing-for-iphone">
					<span class="box-circle">
						<span class="box-in"><i class="icon icon-ios-grey"></i></span>
					</span>
					<span>Разработка <br>под iOS</span>
				</a>
			</li>
			<li class="current">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>developing-for-android-os/">
					<span class="box-circle">
						<span class="box-in"><i class="icon icon-android-grey"></i></span>
					</span>
					<span>Разработка <br>под Android</span>
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>promotion-application/">
					<span class="box-circle">
						<span class="box-in"><i class="icon icon-app-grey"></i></span>
					</span>
					<span>Продвижение <br>приложений</span>
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>web-development/">
					<span class="box-circle">
						<span class="box-in"><i class="icon icon-web-grey"></i></span>
					</span>
					<span>Разработка <br>web-сервисов</span>
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>gamedevelopment/">
					<span class="box-circle">
						<span class="box-in"><i class="icon icon-game-grey"></i></span>
					</span>
					<span>Разработка <br>игр</span>
				</a>
			</li>
		</ul>
		</div>
	</div>
    <section class="page-service android-development">
    	<div class="container">
    		<h1>Сделаем Андроид <br>
                         приложение <br>
			 специально <br>
			  для Вас!</h1>
			<a class="btn btn-primary email-us-btn" href="#" ymParam='ANDROID_POS_Z'><span class="icon icon-email"></span> оставить заявку</a>
    	</div>
    </section>

	 <section class="company-info">
            <div class="container text-center">
                <h1 class="noBorderTop">Разработка приложений для Android</h1>
                <p>На сегодняшний день в мире более миллиарда пользователей android-устройств. На Российском рынке смартфоны с Android OS завоевали огромную популярность, поэтому приложения на этой платформе для наших клиентов мы разрабатываем особенно часто.
Безусловный плюс создания приложений в Infoshell в том, что мы не просто создаем ваше приложение, мы оказываем консультации и экспертную поддержку на всех этапах создания продукта. Наши эксперты обязательно подскажут, как улучшить идею и оптимизировать функционал приложения. В наших интересах сделать качественный продукт, который выстрелит на рынке.</p>
             </div> 
              
    </section>
    <div class="services-block">

    <?
        $posts = get_posts(array(
            'category_name'=>'projects_services_android',
            'orderby'=>'date',
            'order'=>'DESC',
            'posts_per_page'=>1000
        ));

        $part_title = "Наши проекты";
        include(locate_template('portfolio.paralax.php'));
    ?>
    </div>

    <section class="call-us">
        <div class="container">
            <h2 class="txt-black text-center">Экспертная оценка проекта</h2>
            <div class="tooltip-yellow">
                <p>Технический директор и Аналитик ответят на Ваши вопросы, дадут рекомендации и предложат оптимальные варианты реализации проекта</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p>г. Москва</p>
                    <p class="txt-lead">+7 (495) 215-51-82</p>
                </div>
                <div class="col-md-4">
                    <p>г. Санкт-Петербург</p>
                    <p class="txt-lead">+7 (812) 242-80-58</p>
                </div>
                 <div class="col-md-4 text-center">
                    <span class="icon icon-question"></span>
                    <a href="#" class="btn btn-primary email-us-btn" ymParam='ANDROID_EXPERT_Z'><span class="icon icon-email"></span> оставить заявку</a> 
                </div>
            </div>
        </div>
    </section>
	<section class="process-develop">
		<div class="container text-center">
			<h2>Как мы создаем приложение для Андроид?</h2>
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
                  	<div class="help-text">Исследуем рынок и выделим конкурентные преимущества вашего продукта.</div>
                </li> 
                <li>
                    <span class="btn-cicle">
                    <span class="btn-cicle-inner">
                        <i class="icon icon-prototype"></i>
                    </span>
                    </span>
                     <div class="title">3. UI/UX прототипы<br>
экранов</div>
                  	<div class="help-text">Аналитика поведения пользователей. <br>
Разработаем функциональный и интуитивно - понятный интерфейс.</div>
                </li> 
                <li>
                   <span class="btn-cicle">
                       <span class="btn-cicle-inner">
                           <i class="icon icon-design-adv"></i>
                       </span>
                    </span>
                     <div class="title">4. Дизайн</div>
                  	<div class="help-text">Продумаем наилучший вариант дизайна для реализации вашей идеи.</div>    
                </li> 
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-dev-adv"></i>
                        </span>
                    </span>
                     <div class="title">5. Разработка</div>
                  	<div class="help-text">Через 2 недели вы получите готовый рабочий прототип приложения.</div>
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
                  	<div class="help-text">Разрабатываем высоконагрузочные web – сервисы, которые выдерживают более 10 тыс. запросов/сек.</div>
                </li>
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-testing"></i>
                        </span>
                    </span>
                     <div class="title">7. Тестирование</div>
                  	<div class="help-text">Задолго до публикации мы проверяем качество и работоспособность проекта.</div>
                </li> 
                <li>
                    <span class="btn-cicle">
                    <span class="btn-cicle-inner">
                        <i class="icon icon-start"></i>
                    </span>
                    </span>
                     <div class="title">8. Запуск</div>
                  	<div class="help-text">Опытные маркетологи подготовят скриншоты, иконку и продающее описание продукта для максимального количества загрузок.</div>
                </li> 
                <li>
                   <span class="btn-cicle">
                       <span class="btn-cicle-inner">
                           <i class="icon icon-promotion"></i>
                       </span>
                    </span>
                     <div class="title">9. Продвижение</div>
                  	<div class="help-text">Гарантируем вывод приложения в ТОП AppStore и GooglePlay.</div>    
                </li> 
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-support"></i>
                        </span>
                    </span>
                     <div class="title">10. Поддержка</div>
                  	<div class="help-text">Мы будем работать над дальнейшей модификацией вашего проекта.</div>
                </li>            
            </ul>
			<p>
                <a class="btn btn-primary email-us-btn" href="#"><span class="icon icon-email" ymParam='ANDROID_VIPOLUCH_Z'></span> оставить заявку</a>
            </p>
		</div>
	</section>
	 <section class="team-block grey-block">
        <div class="container text-center">
            <h3 class="txt-black">Разработчики Android</h3>
             <ul class="no-list left-list staff-list">
                <?
                $posts = get_posts(array(
                    'category_name'=>'android',
                    'orderby'=>'date',
                    'posts_per_page'=>9,
                    'order'=>'DESC'
                ));

            foreach($posts as $post) {
                setup_postdata($post);?>
                            <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');?>
                            <li>
                                <div class="thumb"><img src="<?php echo $large_image_url[0]; ?>" alt="" /></div>

                                <?php the_content();?>
                            </li>

                <?php } ?>
            </ul>  
        </div>
    </section>
    <section class="white-block">
    	 <div class="container text-center">
    	 	<p class="next-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>promotion-application"><span>Далее:</span> Продвижение приложений <span class="icon icon-arrow-grey"></span></a></p>
    	 	<p>
                <a class="btn btn-primary email-us-btn" href="#" ymParam='ANDROID_FOOTER_Z'><span class="icon icon-email"></span> оставить заявку</a>
            </p>
    	 </div>
    </section>
<?php get_footer(); ?>