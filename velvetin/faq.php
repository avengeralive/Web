<? 
/* Template name: FAQ */
get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1><? the_title(); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
            <? foreach (get_field('voprosy', get_the_ID()) as $key => $voprosy) {  ?>
                <p class="vopros" data="<?=$key?>"><a href="javascript:void(0)"><?=$voprosy['vopros']; ?> <i class="fas fa-chevron-up"></i><i class="fas fa-chevron-down"></i></a></p>
                <div class="vopros_item_box item<?=$key?>">
                    <?=$voprosy['otvet']; ?>
                </div>
             <? } ?>
            </div>
            <div class="col-lg-1"></div>
        </div>
        <div class="row formblock">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <p class="formheading">Нет нужного ответа? Задайте свой вопрос</p>
                <?=do_shortcode('[contact-form-7 id="118" title="Контактная форма 1"]');?>
                </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>