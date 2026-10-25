<?php
/*
Template Name: Страница "Сервисы: Web"
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
			<li>
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
			<li class="current">
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
    <section class="page-service web-development">
    	<div class="container">
    		<h1>Разработка <br>
			web-сервисов</h1>
			<a class="btn btn-primary email-us-btn" href="#" ymParam='WEB_POS_Z'><span class="icon icon-email"></span> оставить заявку</a>
    	</div>
    </section>

	 <section class="company-info">
            <div class="container text-center">
                <h1 class="noBorderTop">СОВРЕМЕННЫЕ ТЕХНОЛОГИИ ВПЕЧАТЛЯЮТ И УПРОЩАЮТ</h1>
                <p>Ваше время – вот что сейчас стало самым ценным ресурсом для успешных людей. Поэтому и мы особое внимание уделяем оптимизации вашего времени. Infoshell разрабатывает качественное программное обеспечение для web-продуктов любого уровня сложности. Индивидуальный аналитический подход к каждому кейсу и проверенная команда профессионалов своего дела – вот те ресурсы, которые позволяют нам создавать по-настоящему качественный продукт.</p>
                 </div> 
              
    </section>
    <div class="services-block">

    <?
        $posts = get_posts(array(
            'category_name'=>'projects_services_web',
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
                    <p>г.Москва</p>
                    <p class="txt-lead">+7 (495) 215-51-82</p>
                </div>
                <div class="col-md-4">
                    <p>г. Санкт-Петербург</p>
                    <p class="txt-lead">+7 (812) 242-80-58</p>
                </div>
                 <div class="col-md-4 text-center">
                    <span class="icon icon-question"></span>
                    <a href="#" class="btn btn-primary email-us-btn" ymParam='WEB_EXPERT_Z'><span class="icon icon-email"></span> оставить заявку</a> 
                </div>
            </div>
        </div>
    </section>
	<section class="process-develop process-develop-web">
		<div class="container text-center">
			<h2>Работая с Infoshell, вы получаете</h2>
            <ul class="develop-web-list text-left">
                <li>
                    <a href="javascript:void(0);"><span class="round-box"><i class="icon icon-web-solution"></i></span><span class="list-txt">Разработка высоконагруженных систем.</span></a>
                    <div class="box-collapse">
                        <ul>
                            <li>Грамотная архитектура. Горизонтальное масштабирование данных и ключевых механизмов системы. (Или вертикальное там, где горизонтальное невозможно по ряду причин);</li>
                            <li>Способность в параллельном режиме обслуживать обращения к системе;</li>
                            <li>Способность выдерживать большие и резкие пики нагрузки;</li>
                            <li>Доступность проекта по схеме 7х24х365;</li>
                            <li>Работоспособность без сбоев и потери данных;</li>
                            <li>Поиск баланса между: стоимостью разработки и дальнейшего обслуживания, и требований к дальнейшему развитию проекта.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:void(0);"><span class="round-box"><i class="icon icon-val-solution"></i></span><span class="list-txt">Решения для анализа больших объемов данных (Big Data Analytics)</span></a>
                    <div class="box-collapse">
                        <ul>
                            <li>Разработка решения для принятия решения основываясь на анализе слабоструктурированных наборов данных</li>
                            <li>Разработка решения для преобразования и построения прогностических и скоринговых моделей в реальном времени</li>
                            <li>Построение высокопроизводительного кластера для распределенных вычислений и хранения большого объема данных с помощью Hadoop, Informatica и прочих решений.</li>
                            <li>Опыт по внедрению решений в банковской, производственной, государственной, энергетической сферах.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:void(0);"><span class="round-box"><i class="icon icon-mob-solution"></i></span><span class="list-txt">Серверная часть для мобильных приложений</span></a>
                    <div class="box-collapse">
                        <ul>
                            <li>Разработка серверного решения, учитывая особенности мобильных операционных систем: iOS, Android, Windows Phone, Blackberry и других;</li>
                            <li>Адаптация алгоритмов взаимодействия сервера и приложения с целью снижения трафика и ускорения работы как приложения, так и сервера. Например, подгрузка контента приложением "по требованию";</li>
                            <li>Интеллектуальная система для валидации встроенных покупок (in-app purchases) для iTunes, Google Play, Microsoft Store, которая позволяет не терять бизнесу доход от мошеннических схем;</li>
                            <li>Поддержка вендорных систем рассылки пуш-уведомлений (push notifications) и возможность обслуживать миллионы отправлений уведомлений: Apple Notification Service (APNS), Google Cloud Messaging (GCM), Microsoft Push Notification Service (MPNS);</li>
                            <li>Возможность разработки серверов с real-time функционалом: мессенджеры, отслеживание передвижения объектов в пространстве (2D, 3D), изменения финансовых показателей и многое другое.</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="javascript:void(0);"><span class="round-box"><i class="icon icon-market"></i></span><span class="list-txt">Решения для оптимизации бизнес процессов</span></a>
                    <div class="box-collapse">
                        <ul>
                            <li>Решения для оптимизации рабочего времени сотрудника по схеме: один ко многим. Например, менеджер проекта может удаленно поставить задания сотрудникам и также удаленного проверить их выполнение.</li>
                            <li>Разработка и внедрение ERP-, CRM-систем;</li>
                            <li>Интранет-порталы.</li>
                        </ul>
                    </div>
                </li>
            </ul>
			<p>
                <a class="btn btn-primary email-us-btn" href="#" ymParam='WEB_VIPOLUCH_Z'><span class="icon icon-email"></span> оставить заявку</a>
            </p>
		</div>
	</section>

	 <section class="team-block grey-block">
        <div class="container text-center">
            <h2 class="txt-black">команда Web</h2>
             <ul class="no-list left-list staff-list">
                <?
                $posts = get_posts(array(
                    'category_name'=>'web-staff',
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
    	 	<p class="next-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>gamedevelopment"><span>Далее:</span> Разработка игр <span class="icon icon-arrow-grey"></span></a></p>
    	 	<p>
                <a class="btn btn-primary email-us-btn" href="#" ymParam='WEB_FOOTER_Z'><span class="icon icon-email"></span> оставить заявку</a>
            </p>
    	 </div>
    </section>
<?php get_footer(); ?>