<?php
/*
Template Name: Страница "Продвижение"
*/
get_header(); ?>

<script> 
$(document).ready(function(){
    $('#menu-item-2108').addClass('current-menu-item'); 
});
</script>

<link rel="stylesheet" href="https://infoshell.ru/wp-content/themes/mark_up/css/promote_new.css">

    <section class="page-service promotion-application">
    	<div class="container">
<br>
<br>
<br>
    		<span class="main_title">Продвижение приложений в Google Play и AppStore</span>
<span class="contact_but">
			<a class="btn btn-primary email-us-btn" href="#" ymParam='PROM_POS_Z'><span class="icon icon-email"></span> оставить заявку</a>
</span>
    	</div>
    </section>
    <section class="company-info">
            <div class="container text-center">
                <h1 class="noBorderTop">Продвижение мобильных приложений</h1>
                <p>Даже если приложение сделано профессионально, это не гарантия того, что его установят тысячи пользователей мобильных маркетов. Компания Infoshell владеет необходимыми навыками и 8-летним опытом продвижения приложений. Портфолио с примерами продвижения – доказательство наших навыков.</p>
<p>Мы предлагаем конкурентную стоимость на продвижение мобильных приложений в Google Play и AppStore. Отдайте приложение на продвижение в руки наших аналитиков и получите гарантированный результат. Сделаем раскрутку приложения с помощью качественной рекламы!</p>
              </div> 
              
    </section>
	<section class="our-advantages advantages-promotion-app">
        <div class="container text-center">
            <h2>Наши преимущества</h2>
            <ul class="list-inline list-advantages">
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-price-install"></i>
                        </span>
                    </span>
                   Стоимость <br>
инсталла от 0,4$ <br>
(Самая низкая стоимость<br>
установки на рынке)
                  
                </li>
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <i class="icon icon-price-top"></i>
                        </span>
                    </span>
                   100% гарантия успешного продвижения приложения
                </li> 
                <li>
                    <span class="btn-cicle">
	                    <span class="btn-cicle-inner">
	                        <i class="icon icon-price-dev"></i>
	                    </span>
                    </span>
                    Большой опыт <br>
в раскрутке приложений <br>
в Европе и США
                </li> 
                <li>
                   <span class="btn-cicle">
                       <span class="btn-cicle-inner">
                           <i class="icon icon-price-expirience"></i>
                       </span>
                    </span>
                    Объемы загрузок для попадания в ТОП-10: <br>
Для попадания в ТОП <br> требуется большое количество загрузок <br>– в отличие от других, <br>мы можем обеспечить такой объем
                </li>            
            </ul>
            <p>
                <a class="btn btn-primary email-us-btn" href="#" ymParam='PROM_PREIM_Z'><span class="icon icon-email"></span> оставить заявку</a>
            </p>
        </div>
    </section>
	<section class="promotion-page-projects">
		<div class="cases" data-stellar-background-ratio="0.5">
			<div class="container text-center">
				<h2 class="txt-black">Кейсы продвижения:</h2>
				<div class="case-carousel">
				
				
				<?php 
				$ii=1; $close=0; $close2=0;
				query_posts('category_name=cases&orderby=date&posts_per_page=6&order=DESC');?>	
				<div class="row">
				<?php if ( have_posts() ) : ?>
					<?php
					while ( have_posts() ) : the_post(); ?>

							<div class="col-md-6">
							<div class="case-item">
								<?php the_post_thumbnail('cases', array('class' => 'thumbnail')); ?>
								<div class="overflow">
									<div class="case-name"><?php the_title(); //echo $ii; ?></div>
									<div class="case-position"><?php echo (get_post_meta($post->ID, 'case_position', true)); ?></div>
									<div class="case-text"><?php the_content(); ?></div>
								</div>
							</div>
							</div>
						
					<?php
						$ii=$ii+1; 
					endwhile; ?>
				<?php endif; wp_reset_query();?>

				</div>
				</div>

			</div>
		</div>
	</section>
    <?php
    $posts = get_posts('category_name=testimonials_2&posts_per_page=5&orderby=rand');
    include(locate_template('reviews.php')); ?>
	<section class="white-block">
    	 <div class="container text-center">
    	 	<p class="next-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>web-development"><span>Далее:</span>  Разработка web-сервисов <span class="icon icon-arrow-grey"></span></a></p>
    	 	<p>
                <a class="btn btn-primary email-us-btn" href="#" ymParam='PROM_FOOTER_Z'><span class="icon icon-email"></span> оставить заявку</a>
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