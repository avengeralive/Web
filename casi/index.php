<? get_header(); ?>
        <div class="menu-separate">



            <div class="custom-wrap" data-action="b1856e058bfc4532028839e1c1ccb8a5">

                <div class="col-content-layout">
<div class="wrapper border-bottom white-bg breadcrumb-heading">
    <? bcn_display(); ?>
</div>
                </div>


                <div class="col-content-layout">
                    <div class="layout-row">


                        <div class="col-layout-1">
<h1 class="m-b-md">
    <!--<span class="list-of-items-count">Всего: 85</span>-->
</h1>

<div class="view-switcher">
    <div class="casino-list">
        <? $query = new WP_Query( array( 'post_type' => 'casinos' ) ); ?>
        <? while ($query->have_posts()) : $query->the_post();?>
            <div class="casino-card">

                <a class="casino-card__img-link" href="<? the_permalink(); ?>"  title="Обзор Slot V Casino" style="background-color:#2c2c2c">
                    <img class="casino-card__img" src="<? echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="Slot V Casino"/>
                </a>


                <div class="casino-card__content">

                    <div class="casino-card__name">
                        <a href="<? the_permalink(); ?>" title="Обзор Slot V Casino"><? the_title(); ?></a>
                    </div>

                    <div class="casino-card__item">

                        <div class="casino-card__bonus-title">Бонус без депозита:</div>
                            <? echo get_field('бонус_без_депозита', get_the_ID()); ?>
                    </div>
                    <div class="casino-card__item">

                        <div class="casino-card__bonus-title">Приветственный бонус:</div>
                            <a class="casino-card__bonus-value" href="<? the_permalink(); ?>" title="Приветственный бонус в Slot V Casino">
                            <? echo get_field('приветственный_бонус', get_the_ID()); ?>
                            </a>

                    </div>
                </div>

                <div class="casino-card__buttons" rel="nofollow">
                        <a href="<? echo get_field('ссылка', get_the_ID()); ?>" target="_blank" class="btn btn-sm btn-block btn-success " title="Перейти на сайт Slot V Casino">
                            Перейти на сайт
                        </a>
                        <div class="cp__tc"></div>
                        <a href="<? the_permalink(); ?>" class="casino-card__download" title="Обзор Slot V Casino">Обзор</a>
                </div>
            </div>

        <? endwhile; ?>
            
    </div>
</div>



<div class="btn-group">
    <?
    $args = array(
        'show_all'     => false, // показаны все страницы участвующие в пагинации
        'end_size'     => 2,     // количество страниц на концах
        'mid_size'     => 2,     // количество страниц вокруг текущей
        'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
        'prev_text'    => __('<i class="fa fa-chevron-right"></i>'),
        'next_text'    => __('<i class="fa fa-chevron-right"></i>'),
        'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
        'add_fragment' => ''
    );
    the_posts_pagination($args); ?>



   
</div>

</div>
<? get_template_part('sidebar'); ?>
      
                    </div>
                </div>
            </div>
        </div>

    <? get_footer(); ?>