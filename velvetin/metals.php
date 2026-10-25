<? 
/* Template name: Metals */
get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1><? the_title(); ?></h1>
            </div>
        </div>
        <? foreach (get_field('materialy', get_the_ID()) as $material) { ?>
        <div class="row material-item">
            <div class="col-md-4">
                <? foreach ($material['galereya'] as $galitem) { ?>
                <img src="<?=wp_get_attachment_image_url($galitem['ID']);?>" alt="<?=get_post_meta($galitem['ID'], '_wp_attachment_image_alt', TRUE);?>">
                <? } ?>
            </div>
            <div class="col-md-4">
                <h2><?=$material['nazvanie']?></h2>
                <?=$material['opisanie']?>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <? } ?>
    </div>
</section>
<? get_footer(); ?>