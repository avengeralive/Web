<? 
/* Template name: Search */
get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center page-header">
                <h1><? the_title(); ?></h1>
            </div>
        </div>
        <div class="row">
            <form action="/" class="search__search" data-filter-form="">
                <input type="text" name="s" class="search-search__input" autocomplete="off" placeholder="Поиск по сайту" value="">
                <button type="submit"><img src="<?=get_template_directory_uri();?>/images/search.svg"></button>
            </form>
        </div>
    </div>
</section>
<? get_footer(); ?>