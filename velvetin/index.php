<? get_header(); the_post(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1><? the_title(); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-xl-2"></div>
            <div class="col-md-12 col-lg-10 col-xl-8">
                <? the_content(); ?>
            </div>
            <div class="col-lg-1 col-xl-2"></div>
        </div>
    </div>
</section>
<? get_footer(); ?>