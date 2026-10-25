<?
get_header(); ?>
<script type="text/javascript">
  $.expr[":"].contains = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});
  function pagechange() {
    if ($('#pagin').val() == 0) $('#catalog-container').css('height', 'auto');
    else $('#catalog-container').css('height', ($('#pagin').val() / 6 * 320) + 'px');
  }
  function morepagechange() {
    $('#catalog-container').css('height', ($('#catalog-container').height() + $('#pagin').val() / 6 * 320 ) + 'px');
  }
  function filter() {
    $('.texture').hide();
    console.log($('.texture:contains("' + $('#catalog-search').val() + '")'));
    $('.texture:contains("' + $('#catalog-search').val() + '")').show();
    var flag = 0;
    $('.prod').each(function(e,v){
        if ($(v).prop('checked')) flag = 1;
    });
    if (flag) {
      $('.prod').each(function(e,v){
          if (!$(v).prop('checked')) $('.texture[data-prod="' + $(v).val() + '"]').hide();
      });
    }
    filter_m();
    filter_c();
  }
  function filter_m() {
    var flag = 0;
    $('.mat').each(function(e,v){
        if ($(v).prop('checked')) flag = 1;
    });
    if (flag) {
      $('.mat').each(function(e,v){
        if (!$(v).prop('checked')) $('.texture[data-material="' + $(v).val() + '"]').hide();
      });
    }
    
  }
  function filter_c() {
    var flag = 0;
    $('.color').each(function(e,v){
        if ($(v).prop('checked')) flag = 1;
    });
    if (flag) {
      $('.color').each(function(e,v){
        if (!$(v).prop('checked')) $('.texture[data-color="' + $(v).val() + '"]').hide();
      });
    }
    
  }

</script>
<style>
  .kat_models { font-size: 18px; }
  ul li { list-style: none; font-size: 16px; }
.texture:hover {
  cursor: pointer;
}

.products-view-info {
    display: block !important;
}

.products-view-info .products-view-properties {
    padding-right: 0px;
    font-size: 13px;
}

.products-view-info .products-view-properties {
    padding-right: 0px;
    font-size: 13px;
    margin-left: 6px;
}

.products-view-info .products-view-properties .products-view-properties-item-name {
    text-align: center;
    font-weight: bold;
    color: #848484;
}

.products-view-info .products-view-properties .products-view-properties-item-value {
    text-align: center;
    font-size: 14px;
    font-weight: bold;
}

.products-view-price-block {
    margin-top: 12px !important;
}


.i-offer-modal .modal-dialog {
  width: 360px !important;
  max-width: calc(100% - 20px);
  margin: 30px auto !important;
}
.i-offer-modal .modal-body {
  padding: 20px;
}
.i-offer-modal .modal-content {
  position: relative;
}
.i-offer-modal .modal-content .modal-header {
  position: absolute;
  right: -50px;
  top: -10px;
}
.i-offer-modal .modal-content .modal_catalog_filter_name {
  text-align: left;
  font-size: 24px;
  text-transform: uppercase;
  font-family: "LatoBold";
  margin: 20px 0 8px 0;
}
.i-offer-modal .products-view-properties .products-view-properties-item {
  display: -ms-flexbox;
  display: flex;
  margin-bottom: 8px;
}
.i-offer-modal .products-view-properties .products-view-properties-item.price {
  margin-top: 22px;
  color: #000 !important;
  font-size: 18px;
}
.i-offer-modal .products-view-properties .products-view-properties-item.price .products-view-properties-item-name {
  color: #000 !important;
  font-size: 18px !important;
}
.i-offer-modal .products-view-properties .products-view-properties-item .products-view-properties-item-name,
.i-offer-modal .products-view-properties .products-view-properties-item .products-view-properties-item-value {
  font-size: 14px !important;
  font-weight: normal !important;
  color: #9f9f9f !important;
  margin-right: 8px !important;
}
.i-offer-modal .products-view-properties .products-view-properties-item .products-view-properties-item-value {
  margin-right: 0 !important;
  color: #000 !important;
}
.catalog-filter-page-right-filter-menu-item .catalog-filter-block-item-label .custom-input-native, .color-viewer-list .color-viewer-item .custom-input-native {
    opacity: 0;
    position: absolute;
}

.catalog-filter-page-right-filter-menu-item .catalog-filter-block-item-label .custom-input-checkbox, .color-viewer-list .color-viewer-item .custom-input-checkbox{
    cursor: pointer;
    position: relative;
    display: inline-block;
    width: 20px;
    background: white;
    height: 20px;
    margin: 0 12px 0 0;
    border: 1px solid #cccccc;
}
.color-viewer-list .color-viewer-item .custom-input-checkbox{margin:0;}

.catalog-filter-page-right-filter-menu-item .catalog-filter-block-item-label .custom-input-checkbox:after, .color-viewer-list .color-viewer-item .custom-input-checkbox:after {
    content: "";
    position: absolute;
    width: 19px;
    left: 1px;
    height: 19px;
    background-repeat: no-repeat;
    top: 1px;
}
.color-viewer-item {
  float: left;
  margin-right: 10px;
}
.catalog-filter-block-item-label input:checked~ .custom-input-checkbox:after {
    background-image: url(https://unirock.ru/wp-content/themes/unirock/images/catalog/checked-filter.png);
}
.catalog-filter-block-item-label input:checked~ .custom-input-checkbox.white:after{
  background-image: url(https://unirock.ru/wp-content/themes/unirock/images/catalog/checked-filter-white.png);
}
.custom-input-native:checked~.custom-input-checkbox:after {
    background-image: url(https://unirock.ru/wp-content/themes/unirock/images/catalog/checked-filter.png);
}
.bar-catalog li {
  display: inline-block;
  list-style: none;
  margin-right: 25px;
  color: #aaa;
}
.bar-catalog {
  display: inline-block;
}
.bar-catalog ul li {
  display: block;
}
.bar-catalog .dropdown {
  display: none;
}
.bar-catalog li:hover .dropdown {
    display: block;
    position: absolute;
    z-index: 10;
    background: #fff;
    box-shadow: 0px 2px 15px 2px #ffe600;
    padding: 10px;
}
.bar-catalog a {
  color: #000000;
    font-weight: bold;
}
.bar-catalog button {
  color: #000000;
  background: #ffe600;
    font-weight: bold;
    padding: 7px;
}
.bar-catalog input[type='text'] {
  padding: 5px;
}
#catalog-container {
  overflow: hidden;
}
</style>
<div class="b-contact">
   <div class="container">
      <h2>Каталог текстур</h2>
      <h3>Лучшая в России коллекция камней от ведущих мировых компаний.</h3>
<p>Каждый из наших камней прекрасно подходит для решения любых задач частных и коммерческих интерьеров: от изготовления кухонных столешниц или подоконников до производства ресепшн, барных стоек и эксклюзивных изделий. Для вашего удобства, вы можете отфильтровать ваши потребности по цветам, материалам и желаемым текстурам.</p>

   </div>
   <div class="container" style="padding: 40px 0px;">
    <div class="col-sm-12" style="margin-bottom: 20px;">
      <ul class="bar-catalog">
        <li>Фильтр</li>
        <li><a href="javascript:void(0)" onclick="$('input').val(''); $('input').prop('checked', false); filter(); ">х Сбросить</a></li>
        <li><a href="javascript:void(0)">Производитель</a>
            <ul class="dropdown">
              <?
                $terms = get_terms( array(
                  'taxonomy' => 'texture_category',
                  'hide_empty' => false,
                  'parent' => 0
                ) );
                foreach ($terms as $prod) { 
              ?>
              <li><input type="checkbox" value="<? echo $prod->term_id; ?>" class="prod" onclick="filter();"> <? echo $prod->name; ?></li>
              <? } ?>
            </ul>
        </li>
        <li><a href="javascript:void(0)">Материал</a>
            <ul class="dropdown">
              <li><input type="checkbox" class="mat" value="Акриловый камень" onclick="filter();"> Акриловый камень</li>
              <li><input type="checkbox" class="mat" value="Кварцевый агломерат" onclick="filter();"> Кварцевый агломерат</li>
              <li><input type="checkbox" class="mat" value="Керамика" onclick="filter();"> Керамика</li>
            </ul>
        </li>
        <li><a href="javascript:void(0)">Цвет</a>
          <div class="color-viewer-list dropdown">
        <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="1" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox"  style="background-color: #ffffff"></span>
                                                </label>
                                            </div>
                                                                                    <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="2" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox white" style="background-color: #000000"></span>
                                                </label>
                                            </div>
                                                                                    <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="3" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox" style="background-color: #b5b5b5"></span>
                                                </label>
                                            </div>
                                                                                    <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="4" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox white" style="background-color: #4d220e"></span>
                                                </label>
                                            </div>
                                                                                    <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="5" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox white" style="background-color: #cc0605"></span>
                                                </label>
                                            </div>
                                                                                    <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="6" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox" style="background-color: #ed9121"></span>
                                                </label>
                                            </div>
                                                                                    <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="7" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox" style="background-color: #f2e8c9"></span>
                                                </label>
                                            </div>
                                                                                    <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="8" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox" style="background-color: #cac4b0"></span>
                                                </label>
                                            </div>
                                                                                    <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="9" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox white" style="background-color: #1560bd"></span>
                                                </label>
                                            </div>
                                                                                    <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="10" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox white" style="background-color: #5f6943"></span>
                                                </label>
                                            </div>
                                                                                    <div class="color-viewer-item">
                                                <label class="catalog-filter-block-item-label">
                                                    <input type="checkbox" value="11" onchange="filter();" class="color custom-input-native">
                                                    <span class="custom-input-checkbox" style="background-color: #ffbcad"></span>
                                                </label>
                                            </div>
                                                                            </div>
        </li>
        <li><input type="text" placeholder="Поиск" id="catalog-search"><button id="catalog-search-btn" onclick="filter();">Найти</button></li>
        <li>Показать <select id="pagin" onchange="pagechange();"><option value="0">Все</option><option value="24">24</option><option value="48">48</option></select></li>
      </ul>
    </div>
    
    <div class="col-sm-12" id="catalog-container" style="padding-top: 5px;">
      <? $prods = get_posts(array('post_type' => 'textrure', 'posts_per_page' => -1, 'order' => 'ASC'));
      foreach ($prods as $prod) { 
        $terms = get_the_terms($prod->ID, 'texture_category');
        ?>  
      <div class="col-md-2 texture" data-prod="<? echo $terms[0]->term_id; ?>" data-material="<? echo get_field('материал', $prod->ID); ?>" data-color="<? echo get_field('цвет', $prod->ID); ?>" style="margin-bottom: 40px;" data-toggle="modal" data-target="#prod<? echo $prod->ID; ?>">
        <img src="<? echo get_the_post_thumbnail_url($prod->ID); ?>" style="width: 100%;">
        <p style="font-family: 'Roboto', sans-serif; text-align: center; font-size: 15px; margin-top: 10px;"><? echo $prod->post_title; ?></p>
        <p style="font-family: 'Roboto', sans-serif; text-align: center; font-size: 12px; margin-top: 10px; color: #ccc; "><? echo get_field('материал', $prod->ID); ?></p>
      </div>
      <div class="modal fade modal_catalog_filter i-offer-modal" id="prod<? echo $prod->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="http://stolkit.ru/wp-content/themes/stolkit/img/modal_close.png" alt=""></span></button>
                </div>
                <div class="modal-body">
                    <div class="modal-content-custom">
                        <div class="flex flex_column">
                            <div class="modal_catalog_filter-col-img">
                                <img src="<? echo get_the_post_thumbnail_url($prod->ID, 'full'); ?>" style="width: 100%;">
                            </div>
                            <div class="modal_catalog_filter_name"><? echo $prod->post_title; ?></div>
                            <div class="modal_catalog_filter-col-info">
                                <div class="products-view-info">
                                    <ul class="products-view-properties">
                                            <li class="products-view-properties-item">
                                                <div class="products-view-properties-item-name">Материал:</div>
                                                <div class="products-view-properties-item-value"><? echo get_field('материал', $prod->ID); ?></div>
                                            </li>
                                            <li class="products-view-properties-item">
                                                <div class="products-view-properties-item-name">Произодитель:</div>
                                                <div class="products-view-properties-item-value"><? echo $terms[0]->name; ?></div>
                                            </li>
                                            <li class="products-view-properties-item">
                                                <div class="products-view-properties-item-name">Коллекция:</div>
                                                <div class="products-view-properties-item-value"><? echo get_field('коллекция', $prod->ID); ?></div>
                                            </li>
                                            <li class="products-view-properties-item">
                                                <div class="products-view-properties-item-name">Страна производства:</div>
                                                <div class="products-view-properties-item-value products-view-properties-item-value-price"><? echo get_field('страна', $prod->ID); ?></div>
                                            </li>
                                             
                                     </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <? } ?>
    </div>
    <div class="col-md-12"><a href="javascript:void(0)" class="yellow-button" onclick="morepagechange();">Показать больше</a></div>
   </div>
</div>
 

<? get_template_part('templates/common/recalc'); ?>
      <? get_template_part('templates/common/free'); ?>
      <? get_template_part('templates/common/claimer'); ?>
      <? get_template_part('templates/common/timer'); ?>
      <? get_template_part('templates/common/textures'); ?>
      <? get_template_part('templates/common/claim'); ?>
      <? get_template_part('templates/common/reviews'); ?>
      <? get_template_part('templates/common/portfolio'); ?>
      <? get_template_part('templates/common/free_consultation'); ?>
      <? get_template_part('templates/common/contacts'); ?>
<? get_footer(); ?>