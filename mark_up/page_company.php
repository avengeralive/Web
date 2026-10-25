<?php
/*
Template Name: Страница "Компания"
*/
get_header(); ?>


 <section class="home-slide">
        
</section>
    <section class="company-info">
            <div class="container text-center">
                <h1 class="noBorderTop">КОМАНДА INFOSHELL</h1>
                <p>Команда Infoshell – это высококвалифицированные профессионалы, внедряющие тренды и решения будущего уже сегодня. Наши специалисты имеют компетенции в области искусственного интеллекта и нейросетей. Прямо сейчас мы разрабатываем hi-load проект, основанный на технологии машинного обучения. А вы готовы вступить в будущее?</p>
                 </div> 
              
    </section>
    <section class="our-advantages">
        <div class="container text-center">
            <h2 class="txt-black">наши преимущества</h2>
            <ul class="list-inline list-advantages">
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <strong>100</strong>
                            проектов
                        </span>
                    </span>
                    Реализовали <br>более 100 проектов
                  
                </li>
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <img src="<?php bloginfo('template_directory');?>/images/logo-iso.png" alt="Система менеджмента качества сертифицирована">
                        </span>
                    </span>
                    Система менеджмента <br>качества<br>сертифицирована
                </li> 
                <li>
                    <span class="btn-cicle">
                    <span class="btn-cicle-inner">
                        <strong>9 лет</strong>
                    </span>
                    </span>
                    с 2009 года на <br>Российском рынке  
                </li> 
                <li>
                   <span class="btn-cicle">
                       <span class="btn-cicle-inner">
                           <img src="<?php bloginfo('template_directory');?>/images/logo-ruwards.png" alt="Топовые позиции в рейтингах">
                       </span>
                    </span>
                    Топовые позиции <br>в рейтингах    
                </li> 
                <li>
                    <span class="btn-cicle">
                        <span class="btn-cicle-inner">
                            <strong>10 000</strong>
                            запросов/сек.
                        </span>
                    </span>
                    Разрабатываем <br>высоконагруженные <br>веб-сервисы
                </li>            
            </ul>
            <p>
                <a class="btn btn-primary email-us-btn" href="#" ymParam='COMP_NASHIPREIM_Z'><span class="icon icon-email"></span> оставить заявку</a>
            </p>
        </div>
    </section>
     <?php
    $posts = get_posts('category_name=testimonials&posts_per_page=5&orderby=rand');
    include(locate_template('reviews.php')); ?>

    <section class="certificates">
        <div class="container text-center">
            <h2 class="txt-black">сертификаты</h2>
            <ul class="no-list left-list certificates-list">
                <?php query_posts('category_name=certificates&orderby=date&order=DESC');?>   
                <?php if ( have_posts() ) : ?>
                        <?php
                        while ( have_posts() ) : the_post(); ?>
                            <?php 
                            $small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), array(180,235));
                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');

                            ?>
                            <li><a href="<?php echo $large_image_url[0]; ?>" rel="group"><img src="<?php echo $small_image_url[0]; ?>" alt="<?=the_title()?>" /></a></li>
                        <?php endwhile; ?>
                <?php endif; wp_reset_query();?>
            </ul>
            <script>
                $(document).ready(function() {
                    $(".certificates-list a").fancybox({
                        openEffect	: 'none',
                        closeEffect	: 'none'
                    });
                    /*$(".certificates-list a").click(function(){
                        return false;
                    });*/
                });
            </script>
        </div>
    </section>
    <section class="members-conference block-with-bg">
        <div class="container text-center">
            <h2>Участники конференций</h2>
            <ul class="list-inline members-list-brands">
                <li><img src="<?php echo get_template_directory_uri(); ?>/tpl/startup-village-white.png" alt="Startup village"></li>    
                <li><img src="<?php echo get_template_directory_uri(); ?>/tpl/moco-logo-white.png" alt="Moco forum"></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/tpl/dev-gamm-white.png" alt="Dev gamm"></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/tpl/digital-logo-white.png" alt="Digitale"></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/tpl/app4all-logo-white.png" alt="Apps4all"></li>        
                <li><img src="<?php echo get_template_directory_uri(); ?>/tpl/riw-14.png" alt="Riw14"></li>        
                <li><img src="<?php echo get_template_directory_uri(); ?>/tpl/mblt-14.png" alt="Mblt14"></li>        
                <li><img src="<?php echo get_template_directory_uri(); ?>/tpl/slush.png" alt="Slush"></li>        
                <li><img src="<?php echo get_template_directory_uri(); ?>/tpl/russian-app-day.png" alt="=Russian app day"></li>        
            </ul>
            <p>
                <a class="btn btn-primary email-us-btn" href="#" ymParam='COMP_CONF_Z'><span class="icon icon-email"></span> оставить заявку</a>
            </p>
        </div>
    </section>
    <section class="team-block-padding" itemscope itemtype="http://schema.org/Organization">
        <meta itemprop="name" content="Infoshell.ru" />
        <meta itemprop="telephone" content="+7 (495) 215-51-82" />
        <meta itemprop="address" content="Россия, г. Москва, ст. метро Маяковская, 1-я Тверская-Ямская улица, 16/23, оф. 8"/>
        <meta itemprop="email" content="info@infoshell.ru" />
        <meta itemprop="image" content="https://infoshell.ru/wp-content/themes/mark_up/images/logo.jpg"/>
        
        <div class="container text-center">
            <h2 class="txt-black">Ведущие специалисты</h2>
             <ul class="no-list left-list staff-list">
                <?
                $posts = get_posts(array(
                    'category_name'=>'all-staff',
                    'orderby'=>'date',
                    'posts_per_page'=>12,
                    'order'=>'ASC'
                ));

            foreach($posts as $post) {
                setup_postdata($post);?>
                            <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');?>
                            <li itemprop="employee" itemscope itemtype="http://schema.org/Person">
                                <div class="thumb"><img src="<?php echo $large_image_url[0]; ?>" alt="<?=get_the_title($post)?>" /></div>
                                    <meta itemprop="name" content="<?=get_the_title($post)?>" />
                                <?php the_content();?>
                            </li>

                <?php } ?>
            </ul>  
           <p>Всего в компании «InfoShell» трудится 48 специалистов.</p>

        </div>
      <!-- <div class="white-block-bottom"></div>-->
    </section>

<script type="text/javascript">
$(function() {
     $('#emailForm').submit( function() {
         yaCounter934261.reachGoal('callback_company');
         yaCounter934261.reachGoal('all_callbacks');
         yaCounter934261.reachGoal('all_goals');
         return true;
     });

     $('#callForm').submit( function() {
         yaCounter934261.reachGoal('contact_form_company');
         yaCounter934261.reachGoal('all_project_price_check');
         yaCounter934261.reachGoal('all_goals');
         return true;
     });
});
</script>


<?php get_footer(); ?>