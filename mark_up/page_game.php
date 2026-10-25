<?php
/*
Template Name: Страница "game"
*/
get_header(); ?>
<script> 
$(document).ready(function(){
    $('#menu-item-2108').addClass('current-menu-item'); 
});
</script>

	
<?
$posts = get_posts(array(
    'category_name'=>'game_slider',
    'orderby'=>'date',
    'order'=>'DESC',
));
include(locate_template('new_slider_header.php'));
?>


	<section class="company-info">
        <div class="container text-center" itemscope itemtype="http://schema.org/Service">
            <h1 class="noBorderTop" itemprop="serviceType">Разработка игр для Android и iOS</h1>
            <div itemprop="description">
                <p align="left">Профессиональные разработчики игр Infoshell создают современные увлекательные приложения для Android и iOS, которые сразу набирают популярность.</p><br>
                <p align="left">Мы разрабатываем только кроссплатформенные игры для социальных сетей и под мобильные платформы Android, iOS, для девайсов iPhone и iPad.</p><br>
                <p align="left">Разработка игр для Android и iOS мобильных устройств — это выгодное вложение средств. Число пользователей операционных систем Android и iOS увеличивается с каждым годом, поэтому интересные игры востребованы.</p>
            </div> 
        </div> 
              
    </section>
    <!-- <section class="game-service-block">
        <div class="projects">
           <div class="portfolio-carousel game_carousel">
             <h2>Портфолио игр от разработчиков InfoShell</h2>
                <ul class="carousel-block no-list left-list">

                    <?php query_posts('category_name=projects_games&orderby=date&order=DESC');?>    
                    <?php if ( have_posts() ) : ?>
                        <?php
                        while ( have_posts() ) : the_post(); ?>
                    
                            <?php $image = get_field('background'); ?>
                            <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');?>
                    
                    
                            <li class="carousel-item block-with-bg" style="background:url(<?php echo $image['url']; ?>) no-repeat top center; background-size:cover;" data-stellar-vertical-offset="-30">
                                <div class="header-carousel-text">
                                    <div class="container">
                                        <div class="portfolio-carousel-arrows carousel-arrows">
                                            <a class="carousel-arrow a-left" href="#"><i></i></a>
                                            <a class="carousel-arrow a-right" href="#"><i></i></a>
                                        </div>
                                        <div class="row" itemscope itemtype="http://schema.org/Game">
                                            <div class="col-md-8">
                                                <img src="<?php echo $large_image_url[0]; ?>" alt="<?the_title()?>" class="anim-block"  data-anim-dir="left" data-anim-start="368" data-anim-end="-30" itemprop="image">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="anim-block" data-anim-start="368" data-anim-end="0" data-anim-dir="left" data-anim-speed="0.3">
                                                    <h3 itemprop="name"><?php the_title(); ?></h3>
                                                    <div class="carousel-item-text" itemprop="description"><?php the_content(); ?></div>
                                                    <p><a href="<?php echo (get_post_meta($post->ID, 'project_link', true)); ?>" class="btn btn-default" itemprop="url">Посмотреть</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endwhile; ?>
                    <?php endif; wp_reset_query();?>

                </ul>
            </div>
            
        </div>
    </section>  -->
    <section class="white-block text-center">
        <div class="container">
            <h3 class="txt-black txt-title">Наиболее перспективной нишей на IT рынке является разработка игр для операционной системы Android:</h3>
            <p class="rl">Самая быстрая окупаемость проектов, быстро растущая аудитория пользователей, высокие доходы. <br> За последние 3 года рынок iPhone, iPad и Android гейминга в России вырос <br>в 9 раз и составил 165 млн. долларов.</p>
        </div>
    </section>
        <section class="process-develop why-mobile-block">
        <div class="container text-center">
            <h2>Почему разработка игр?</h2>
            <ul class="list-inline list-advantages no-margin">
                
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <span class="bold txt-block">966</span>
                            млн
                        </span>
                    </span>
                    <div class="help-text">Человек играет на Android (Андроид), iPhone, iPad</div>
                </li> 
                <li>
                    <span class="btn-cicle">
                    <span class="btn-cicle-inner">
                        <span class="bold txt-block">38%</span>
                    </span>
                    </span>
                    <div class="help-text">Платящая аудитория</div>
                </li> 
                <li>
                    <span class="btn-cicle">
                    <span class="btn-cicle-inner">
                        <span class="bold txt-block">2.78$</span>
                    </span>
                    </span>
                    <div class="help-text">Средний месячный чек <br>на пользователя</div>
                </li>
                <li>
                    <span class="btn-cicle btn-cicle-white">
                        <span class="btn-cicle-inner">
                            <span class="bold txt-block">3 млн $</span>
                            в день
                        </span>
                    </span>
                    <div class="help-text">Зарабатывают<br> лидеры AppStore <br>и Google Play</div>
                </li>
           
            </ul>
        </div>
    </section>
	<section class="call-us">
        <div class="container">
           <!-- <h2 class="txt-black text-center">Разработка игр для android на заказ</h2>-->
            <div class="tooltip-yellow">
                <p>Технический директор и аналитик ответят на Ваши вопросы, дадут рекомендации и предложат оптимальные варианты реализации проекта.</p>
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
                    <a href="#" class="btn btn-primary email-us-btn" ymParam='GAMES_EXPERT_Z'><span class="icon icon-email"></span> оставить заявку</a> 
                </div>
            </div>
        </div>
    </section>

	
	<section class="process-develop advantages-web">
		<div class="container text-center">
			<h2>Этапы создания</h2>
			 <ul class="list-inline list-advantages">
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-idea"></i>
                        </span>
                    </span>
                    <div class="title">1. Идея</div>
                  	<div class="help-text">Подберем оптимальный способ реализации идеи и определимся с будущим функционалом.</div>
                </li>
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-market"></i>
                        </span>
                    </span>
                     <div class="title">2. Анализ рынка</div>
                  	<div class="help-text">Проведем аналитику рынка, используя уникальные данные из собственных аккаунтов AppAnnie, Distimo и MetricsMonk. </div>
                </li> 
                <li>
                    <span class="btn-cicle">
                    <span class="btn-cicle-inner">
                        <i class="icon icon-game-design"></i>
                    </span>
                    </span>
                     <div class="title">3. Гейм-дизайн <br>
документ</div>
                  	<div class="help-text">Баланс видеоигр от лучших математиков страны, эффективная монетизация продукта.</div>
                </li> 
                 <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-dev-adv"></i>
                        </span>
                    </span>
                     <div class="title">4. Создание</div>
                  	<div class="help-text">Над вашим проектом будут работать лучшие iOS, Android (Андроид) разработчики.</div>
                </li>
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-web-adv"></i>
                        </span>
                    </span>
                    <div class="title">5. WEB Разработка</div>
                  	<div class="help-text">Разрабатываем высоконагрузочные web – сервисы, которые выдерживают более 10 тыс. запросов/сек.</div>
                </li>          
            </ul>
            <ul class="list-inline list-advantages">
                
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-testing"></i>
                        </span>
                    </span>
                     <div class="title">6. Тестирование</div>
                  	<div class="help-text">Тестирование геймплея, функциональности и контента – залог успеха будущей приложения.</div>
                </li> 
                <li>
                    <span class="btn-cicle">
                    <span class="btn-cicle-inner">
                        <i class="icon icon-start"></i>
                    </span>
                    </span>
                     <div class="title">7. Запуск</div>
                  	<div class="help-text">Развертывание проекта на серверах, подготовка к большим нагрузкам.</div>
                </li> 
                <li>
                   <span class="btn-cicle">
                       <span class="btn-cicle-inner">
                           <i class="icon icon-promotion"></i>
                       </span>
                    </span>
                     <div class="title">8. Продвижение</div>
                  	<div class="help-text">Гарантия увеличения количества платящих пользователей и раскрутка продукта в маркетах.</div>    
                </li> 
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-support"></i>
                        </span>
                    </span>
                     <div class="title">9. Поддержка</div>
                  	<div class="help-text">Мы используем собственную систему Back Office, созданную нашими программистами (более 100 параметров для анализа статистики game рынка).</div>
                </li>            
            </ul>
			<p>
                <a class="btn btn-primary email-us-btn" href="#" ymParam='GAMES_VIPOLUCH_Z'><span class="icon icon-email"></span> оставить заявку</a>
            </p>
		</div>
	</section>

	<section style="display: none;" class="team-block grey-block">
        <div class="container text-center">
            <h3 class="txt-black">Наши специалисты</h3>
             <ul class="no-list left-list staff-list">
             <?
                $posts = get_posts(array(
                    'category_name'=>'game-staff',
                    'orderby'=>'date',
                    'posts_per_page'=>12,
                    'order'=>'DESC'
                ));

            foreach($posts as $post) {
                setup_postdata($post);?>
                            <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');?>
                            <? $alt = get_post_meta($post->ID, "img-alt", true); ?>
                            <li>
                                <div class="thumb"><img src="<?php echo $large_image_url[0]; ?>" alt="<?=$alt ? $alt : '';?>" /></div>

                                <?php the_content();?>
                            </li>

                <?php } ?>
            </ul> 
             <p class="txt-item">В InfoShell задействовано 18 разработчиков игр.</p> 
        </div>
    </section>
    <section style="display: none;" class="white-block">
    	 <div class="container text-center">
    	 	<p>
                <a class="btn btn-primary email-us-btn" href="#" ymParam='GAMES_FOOTER_Z'><span class="icon icon-email"></span> оставить заявку</a>
            </p>
    	 </div>
    </section>

<script type="text/javascript">
$(function() {
     $('#emailForm').submit( function() {
         yaCounter934261.reachGoal('callback_service');
         yaCounter934261.reachGoal('all_callbacks');
         yaCounter934261.reachGoal('all_goals');
         return true;
     });

     $('#callForm').submit( function() {
         yaCounter934261.reachGoal('project_estimate_service');
         yaCounter934261.reachGoal('all_project_price_check');
         yaCounter934261.reachGoal('all_goals');
         return true;
     });
});
</script>


<?php get_footer(); ?>