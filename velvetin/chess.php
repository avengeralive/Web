<? 
/* Template name: Chess */
get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1><? the_title(); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-xl-<?=get_field('otstup', get_the_ID());?>"></div>
            <div class="col-lg-10 col-xl-<? echo 12 - 2*get_field('otstup', get_the_ID());?>">
            <? $rows = get_field('stroka', get_the_ID()); ?>
            <? foreach ($rows as $key => $row) { ?>
            <div class="row chessrow pos_<?=$row['czentrovka']; ?>">
                <div class="col-sm-6">
                    <figure>
                        <img src="<?=$row['kartinka']; ?>">
                    </figure>
                </div>
                <div class="col-sm-6 textplace">
                    <?=$row['tekst']; ?>
                </div>
            </div>
            <? } ?>
            </div>
            <div class="col-lg-1 col-xl-<?=get_field('otstup', get_the_ID());?>"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>