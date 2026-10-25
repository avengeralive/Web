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

<div class="bonus-table table">
    <div class="table__thead">
        <div class="table__row">
            <div class="table__cell bonus-table__num-caption">№</div>
            <div class="table__cell"></div>
            <div class="table__cell bonus-table__name-caption">Казино</div>
            <div class="table__cell text-center bonus-table__bonus-size-caption">Размер</div>
            <div class="table__cell bonus-table__comment-caption">Комментарий</div>
            <div class="table__cell text-right bonus-table__options-caption">Действия</div>
        </div>
    </div>
    <div class="table__tbody">
        <? while (have_posts()) : the_post();?>
        <div class="table__row">
            <div class="table__cell bonus-table__num">
                <span>#</span>1
            </div>
            <div class="table__cell bonus-table__icon">
                <a class="bonus-table__icon-link" href="<? the_permalink(); ?>" title="Описание бонуса">
                    <img src="<? echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="<? the_title(); ?>">
                </a>
            </div>
            <div class="table__cell bonus-table__name">
                <a href="<? the_permalink(); ?>" title="Описание бонуса"><? the_title(); ?></a>
                <div class="small text-muted bonus-table__bonus-kind"><? echo get_field('тип_бонуса', get_the_ID()); ?></div>
            </div>
            <div class="table__cell text-center bonus-table__bonus-size">
                <div class="bonus-table__main-bonus">
                    <span class="label label-md p-xxs"><? echo get_field('размер_бонуса', get_the_ID()); ?></span>
                </div>
                <div class="small"><strong>+ <? echo get_field('фриспины', get_the_ID()); ?> фриспинов</strong></div>
                <div class="small">Wager: <? echo get_field('множитель', get_the_ID()); ?></div>
            </div>
            <div class="table__cell bonus-table__comment">
                <? echo get_field('комментарий_к_бонусу', get_the_ID()); ?>
            </div>
            <div class="table__cell text-right bonus-table__options">
                <a href="<? echo get_field('ссылка_на_получение', get_the_ID()); ?>" target="_blank" title="Получить" class="btn btn-primary btn-sm">Получить</a>
                <div class="bonus-table__tc"></div>
                <i class="fa jshow-comment fa-chevron-down"></i>
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

      
                    </div>
                </div>
            </div>
        </div>

    <? get_footer(); ?>