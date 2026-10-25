<? 
/* Template name: Contacts */
get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1><? the_title(); ?></h1>
            </div>
        </div>
        <div class="row contact_info_block">
            <div class="col-12 text-center">
                <p>ИП: Череватенко Анастасия Александровна<br>ИНН 773670441761</p>
            </div>
            <div class="col-md-6 phones_block">
                <?=get_field('telefony', get_the_ID());?>
            </div>
            <div class="col-md-6 grafik_block">
                <?=get_field('grafik_raboty', get_the_ID());?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-5 map">
                <?=get_field('karta', get_the_ID());?>
            </div>
            <div class="col-lg-5 legend">
                <div class="square">
                    <?=get_field('adres_shou-rum', get_the_ID());?>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
        <div class="row">
            <div class="col-12 text-center h2heading">
                <h2>Команда</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-xl-2"></div>
            <div class="col-lg-10 col-xl-8">
                <div class="row">
                    <? foreach (get_field('komanda', get_the_ID()) as $team) { ?>
                    <div class="col-md-3 teamitem">
                        <img src="<?=wp_get_attachment_image_url($team['foto']);?>">
                        <h3><?=$team['imya'];?></h3>
                        <p><?=$team['dolzhnost'];?></p>
                    </div>
                    <? } ?>
                </div>
            </div>
            <div class="col-lg-1 col-xl-2"></div>
        </div>
        <div class="row">
            <div class="col-12 text-center h2heading">
                <h2>Связаться с нами</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-xl-4"></div>
            <div class="col-lg-6 col-xl-4">
                <?=do_shortcode('[contact-form-7 id="118" title="Контактная форма 1"]');?>
            </div>
            <div class="col-lg-3 col-xl-4"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>