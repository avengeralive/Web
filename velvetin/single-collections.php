<? get_header(); ?>
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
            <? $rows = get_field('строки', get_the_ID()); ?>
            <? foreach ($rows as $key => $row) { ?>
                <div class="row chessrow pos_center">
                    <div class="col-sm-6 textplace">
                        <?=$row['текст']; ?>
                    </div>
                    <div class="col-sm-6">
                        <div class="owl-carousel imgcarousel">
                        <? foreach ($row['галерея'] as $img) { ?>
                            <img src="<?=wp_get_attachment_image_url($img['ID'], 'medium-large');?>" style="width: 100%;">
                        <? } ?>
                        </div>
                    </div>
                </div>
            <? } ?>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>