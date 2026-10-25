<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES'])) {
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BASIS_PRICE' => $strMainID.'_basis_price',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'BASKET_ACTIONS' => $strMainID.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);

global $USER_FIELD_MANAGER;
$parentparams = $USER_FIELD_MANAGER->GetUserFields("IBLOCK_" . $arParams["IBLOCK_ID"] . "_SECTION", $arResult["IBLOCK_SECTION_ID"]); // все свойства родителя
$id_for_src = $arItemIDs['ID'];
$src_article = $arResult['PROPERTIES']['ARTNUMBER']['VALUE'];
$searchhrefraw = 'http://sreda-obitaniya.ru/search/?q='.$src_article;  // получаем src для картинки моб версии
$searchhref_semi_raw = preg_replace('/[[:space:]]+/', '+', $searchhrefraw);
$searchhref = $searchhref_semi_raw.'+++';
$contents_raw = file_get_contents($searchhref);
$str_bx = strpos($contents_raw, 'class="catalog-cols"');
$sbstr_raw = substr($contents_raw, $str_bx, $str_bx+500);
$src_final = preg_match_all('|<img src="(.*)"|Uis', $sbstr_raw, $sbstr_post_arr_raw);
$detail_product_p_a_href = '/brands/'.$arResult["PROPERTIES"]["MANUFACTURER"]["CODE"].'/';
$arResult['UF_FIELD_PRODUCT'] = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult['IBLOCK_ID'], "ID"=>$arResult['SECTION']['ID']), false, Array("UF_*"))->GetNext(); // пользовательские поля товара
$arResult['UF_FIELD_BRAND'] = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=> 4), false, Array("UF_*"))->GetNext(); // пользовательские поля бренда
?>
<!-- sreda_adaptive/components/bitrix/catalog/catalog/bitrix/catalog.element/.default/template -->
<div itemscope itemtype="http://schema.org/Product" class="detail detail-css" style="padding-top: 5px;" id="<?= $arItemIDs['ID']; ?>">
    <div class="detail_product_name">
        <h1 itemprop="name" class="h1-second h-css-title detail_product_name_h1"><?= $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']?></h1><div class="for_article_span">
            <p class="detail_product_name_p">Бренд: <span itemporop="brand"><a href="<?= $detail_product_p_a_href; ?>"><?= $arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"];?></a></span> Артикул:<span itemprop="model"> <?=$arResult['PROPERTIES']['ARTNUMBER']['VALUE']?></span></p>
        </div>
    </div>
    <section class="catalog-item-slider img-desctop">
        <?php
        if (!empty($arResult["DETAIL_PICTURE"]["ID"])){
            $coef = $arResult["DETAIL_PICTURE"]["WIDTH"]/1200;
        }
        $brand_for_water_mark_raw = $arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"];
        $brand_for_water_mark_noprob = str_replace(' ', '', $brand_for_water_mark_raw);
        $brand_for_water_mark_final = strtolower($brand_for_water_mark_noprob);
        $brand_for_water_mark_check = 0;
        if ($brand_for_water_mark_final == 123) {
            $position = $arResult["PROPERTIES"]["watemark_position"]["VALUE_XML_ID"];
            if (!$position) $position = "br";//default center;
            $filterWatermark = Array(
                Array(
                        'name' => 'watermark',
                        'position' => $position,
                        'size'=>'z',
                        'coefficient' => $coef,
                        'type'=>'image',
                        'alpha_level'=>'40',
                        'file'=>$_SERVER['DOCUMENT_ROOT'].'/upload/wm/sreda_bi.png',
                    ),
            );
            $brand_for_water_mark_check = 1;
        }
        reset($arResult['MORE_PHOTO']);
        $arFirstPhoto = current($arResult['MORE_PHOTO']);
        ?>
        <div class="swiper-container-catalog-item">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <?php if (!empty($arResult["DETAIL_PICTURE"]["ID"])) {
                        $bigimg = CFile::ResizeImageGet(
                            $arResult["DETAIL_PICTURE"]["ID"],
                            array('width'=>1200, 'height'=>600),
                            BX_RESIZE_IMAGE_EXACT,
                            true,
                            $filterWatermark
                        ); ?>
                        <img itemprop="image" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"]; ?>"  title="<?= $arResult["DETAIL_PICTURE"]["TITLE"]; ?>" src="<?= $bigimg["src"];?>" height="600" width="1200">
                    <?php } ?>
                </div>
                <?php foreach ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $arPhoto) {
                    $thumb = CFile::ResizeImageGet(
                        $arPhoto,
                        array('width'=>1200, 'height'=>600),
                        BX_RESIZE_IMAGE_EXACT,
                        true,
                        $filterWatermark
                    ); ?>
                    <div class="swiper-slide">
                        <img alt="<?= $arResult['NAME']?>" title="<?= $arResult['NAME']?>" src="<?= $thumb['src']?>" height="600" width="1200">
                    </div><!--item-->
                <?php } ?>
	        </div>
             <?php if (!empty($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])) { ?>
                <div class="catalog-item-slider-counter">
                    <svg version="1.1" class="main-slider-arrow catalog-item-slider-arrow-prev a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                    <g>
                        <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z
                             M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4
                            c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                        <path d="M29.4,19.7H14.8l2.9-3.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L11.8,20c-0.4,0.4-0.4,1,0,1.4l4.5,4.8
                            c0.4,0.4,1,0.4,1.4,0c0.4-0.4,0.4-1,0-1.4l0,0l-2.9-3.1h14.6c0.6,0,1-0.4,1-1C30.4,20.1,30,19.7,29.4,19.7z"/>
                    </g>
                    </svg>
                    <span class="slider-counter"><span class="slider-counter-number"></span><span class="slider-counter-many"> / </span></span>
                    <svg version="1.1" class="main-slider-arrow catalog-item-slider-arrow-next a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                    <g>
                        <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z
                             M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4
                            c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                        <path d="M29.6,20l-4.5-4.8c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4l2.9,3.1H12.4c-0.6,0-1,0.4-1,1c0,0.6,0.4,1,1,1h14.2
                            l-2.9,3.1c-0.4,0.4-0.4,1,0,1.4c0.4,0.4,1,0.4,1.4,0l0,0l4.5-4.8C30,21,30,20.4,29.6,20z"/>
                    </g>
                    </svg>
                </div><?//catalog-item-slider-counter?>
            <?php } ?>
        </div><?//swiper-container-catalog-item?>
    </section>
    <div class="catalog-item-slider img-mobile">
        <?= $sbstr_post_arr_raw[0][0]; ?>>
    </div>
    <div class="clear"></div>
    <section class="breadcrumb-section">
        <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="breadcrumb-links">
            <span itemprop="title" style="position: absolute; top: -999999px;"><a itemprop="url" href="http://sreda-obitaniya.ru/">Среда Обитания</a></span>
            <?php foreach($arResult['CRUMBS'] as $item){ ?>
                <?php if(!empty($item["LINK"])) { ?>
                    <span itemprop="child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a itemprop="url" class="breadcrumb-font bread_crumb_tech breadcrumb-font-uppercase" href="<?= $item["LINK"]; ?>" title="<?= $item["NAME"]; ?>">
                            <span itemprop="title" class="breadcrumb-font breadcrumb-font-underline"><?= $item["NAME"]; ?></span>
                        </a>
                    </span>
                    <span class="bread-divider breadcrumb-font">></span>
                <?php } else { ?>
                    <span class="disable breadcrumb-font breadcrumb-font-uppercase"><?=$item["NAME"]?></span>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="breadcrumb-brand" onclick="location.href='<?= $arResult["PROPERTIES"]["COLLECTION_REF"]["LINK"]; ?>';">
            Все предметы коллекции<br><a class="breadcrumb-brand-href" href="<?= $arResult["PROPERTIES"]["COLLECTION_REF"]["LINK"]; ?>"><?= $arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"]; ?> <?= $arResult["PROPERTIES"]["COLLECTION_REF"]["VALUE"]; ?></a>
        </div>
    </section>
    <script>
    $( document ).ready(function() {
        $('.slide-right-img-plus:eq(2)').toggleClass('nodisplay');
    });
    </script>
    <div class="clear"></div>

    <section class="catalog-item-commodity">
        <div class="catalog-item-commodity-left">
    		<div class="catalog-item-complect-left" id="complect">
                <div class="catalog-item-complect-line">
                    <h2 class="h1-second h-css-title" style="font: 300 1em/1.4 'Arial';">
                        <?php
                        // подтягиваем Ч/Б картинку, от ее наличия зависит вид блока...
                        $mainPhoto = $arResult["DETAIL_PICTURE"]["ID"];
                        $lr = $arResult["PROPERTIES"]["picture_type"]["VALUE_XML_ID"];
                        if (isset($arResult['PROPERTIES']['complect_photo']['VALUE'])) {
                            $mainPhoto = $arResult['PROPERTIES']['complect_photo']['VALUE'];
                            $lr = '';
                        }
                        $trumb = thumb($mainPhoto, array('width'=>200, 'height'=>200), BX_RESIZE_IMAGE_EXACT, $lr);

                        if ($arResult['PROPERTIES']['H2ZONE']['VALUE'] == "") {
                            echo $parentparams['UF_ONCE_FORM']['VALUE'] . ' '; // берём единичную форму
                            echo $arResult['PROPERTIES']['main']['VALUE'] . ' '; // материал товара
                            echo $arResult["PROPERTIES"]["COLLECTION_REF"]["VALUE"] . ' '; // коллекция
                            echo $src_article . (($trumb["src"])? ' КОМПЛЕКТУЕТСЯ:' : ''); // артикул
                        } else {
                            echo $arResult['PROPERTIES']['H2ZONE']['VALUE'] . (($trumb["src"])? ' КОМПЛЕКТУЕТСЯ:' : '');
                        }
                        ?>
                    </h2>
                    <div class="clear"></div>
                </div><?//catalog-item-complect-line?>
                <?php if ($trumb["src"]) { ?>
	  			<span class="catalog-item-complect-block catalog-item-complect-this catalog-item-complect-this-css">
  				    <a class="catalog-item-complect-icon-plus checked" data-value="<?=$prices['finalBasketPrice'];?>" data-no-discount-price="<?= $priecs['priceWithMargin']; ?>" data-id="<?= $arResult['ID']; ?>" style="display: none;"></a>
  				    <span class="catalog-item-complect-img">
  					    <img src="<?= $trumb["src"];?>" alt="complect" />
  					    <span class="catalog-item-complect-icon" style="text-align: left;">
    					    <!-- <a href="#" class="catalog-item-complect-icon-zoom"></a> -->
    					    <a class="checkedn" onmousedown="return false;" onclick="return true;"></a>
  					    </span>
  				    </span>
  				    <span class="catalog-item-complect-text"><?= $arResult['NAME']; ?></span>
  			    </span>
                <div class="catalog-item-plus"></div>
                <?php } else {?>
                    <a class="catalog-item-complect-icon-plus checked" data-value="<?=$prices['finalBasketPrice'];?>" data-no-discount-price="<?= $priecs['priceWithMargin']; ?>" data-id="<?= $arResult['ID']; ?>" style="display: none;"></a>
                <?php } ?>
                <script>
                    $(document).ready(function() {
                        owlcycle();
                        $('.swiper-container-catalog-complect .swiper-wrapper.owl-carousel').owlCarousel({
                        loop:false, // Зацикливаем слайдер
                        navText:[ '<svg version="1.1" class="main-slider-arrow main-slider-arrow-prev a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve"><g>	<path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4	c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/><path d="M29.4,19.7H14.8l2.9-3.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L11.8,20c-0.4,0.4-0.4,1,0,1.4l4.5,4.8	c0.4,0.4,1,0.4,1.4,0c0.4-0.4,0.4-1,0-1.4l0,0l-2.9-3.1h14.6c0.6,0,1-0.4,1-1C30.4,20.1,30,19.7,29.4,19.7z"/>	</g></svg>', '<svg version="1.1" class="main-slider-arrow main-slider-arrow-next a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve"><g><path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4 c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/><path d="M29.6,20l-4.5-4.8c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4l2.9,3.1H12.4c-0.6,0-1,0.4-1,1c0,0.6,0.4,1,1,1h14.2l-2.9,3.1c-0.4,0.4-0.4,1,0,1.4c0.4,0.4,1,0.4,1.4,0l0,0l4.5-4.8C30,21,30,20.4,29.6,20z"/></g></svg>' ],
                        autoplayHoverPause: false,
                        navContainer:'.catalog-item-complect-line .catalog-item-complect-arrow',
                        dotsContainer:'', // .second-slider.categories .owl-dots
                        nav:true, // Отключил навигацию
                        dots:true, // Отключил пагинацию
                        autoplay:false, // Автозапуск слайдера
                        smartSpeed:1000, // Время движения слайда
                        autoplayTimeout:10, // Время смены слайда
                        responsive:{ // Адаптация в зависимости от разрешения экрана
                            0:{
                                items:2,
                                margin:10
                            },
                            1024:{
                                items:2
                            }
                        }
                        });
                    });
                </script>
                <div class="swiper-container-catalog-complect" onmousedown="return false;" onclick="return false;">
                    <div class="swiper-wrapper owl-carousel owl-no-drag" onmousedown="return false;" onclick="return false;">
                        <?php foreach ($arResult['PROPERTIES']['complect']['V'] as $complect) {
                            $pricesComplect = getProductPricesCustom($complect["ID"]);
                            ?>
                            <div itemscope itemtype="http://schema.org/SomeProducts" class="slide">
                                <meta itemprop="identifier" content="complect_<?= $complect['ID']; ?>">
                                <div class="catalog-item-complect-holder" style="width: 180px; float: left;">
                                    <span class="catalog-item-complect-block">
                                        <span class="catalog-item-complect-img">
                                            <img itemprop="image" src="<?= $complect["DETAIL_PICTURE"]["src"];?>" alt="<?= $complect["NAME"]; ?>" />
                                            <span class="catalog-item-complect-icon">
                                                <!-- <a href="<?= $complect["DETAIL_PICTURE_FULL"]["SRC"]; ?>" class="fancy catalog-item-complect-icon-zoom"></a> -->
                                                <a onclick="change_price_handler();" id="complect_<?= $complect['ID']; ?>" data-value="<?= $pricesComplect["finalBasketPrice"]; ?>" data-no-discount-price="<?= $finalBasketPrice["priceWithMargin"]; ?>" data-id="<?= $complect['ID']; ?>" class="catalog-item-complect-icon-plus"></a>
                                                <span class="catalog-item-complect-price" style="margin-right: 10px;">
                                                    <span  class="price-plus">+ </span>
                                                    <?= $pricesComplect["finalBasketPriceF"]; ?>
                                                    <?php if($pricesComplect["finalBasketPrice"] != $pricesComplect["priceWithMargin"]) { ?>
                                                        <br/>
                                                        <span>
                                                            <s><?= $pricesComplect["priceWithMarginF"]; ?></s>
                                                        </span>
                                                    <?php } ?>
                                                </span>
                                            </span>
                                        </span>
                                        <span class="catalog-item-complect-text" title="<?= strtolower($complect["NAME"]); ?>"><?= m($complect["ID"]); ?><?= strtolower($complect["NAME"]); ?></span>
                                    </span>
                                    <div class="clear"></div>
                                </div>
                                <div class="slide slide-right"></div>
                            </div>
                        <?php } ?>
      			    </div>
		        </div><?//swiper-container-catalog-complect?>

                <div class="catalog-item-complect-buttons invissible-class-hidden">
                    <p class="btn btn-pseudo" ><span id="complect_price"><?= $arResult['MIN_BASIS_PRICE']['PRINT_VALUE']; ?></span> <span class="rubl">Р</span></p>
                    <a href="#" class="btn btn-order js-btn-buy-complect">Купить</a>
                    <p class="newprice"></p>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div><?//catalog-item-complect-left?>

		    <script>
                var old_price_raw = $('#catalog_price_for_js').text();
                var old_price_no_prob = old_price_raw.replace(/\s/g, '');
                var old_price = old_price_no_prob.substring(0, old_price_no_prob.length - 1);

                function change_price_handler() {
                    setTimeout(change_price, 50);
                }

		        function change_price() {
		            price_part_2 = $('#complect_price').text().replace(/\s/g, '');
		            new_price = Number(old_price) + Number(price_part_2);
		            new_price_gap = String(new_price).replace(/\d{0,3}(?=(\d{3})+$)/g, "$& ");
                    console.log(old_price);
                    console.log(price_part_2);
		            $('#complect_new_price').text(new_price_gap);
                    if (old_price == new_price) {
                        $('.catalog-item-commodity-right-btn-css').text('купить');
                    } else {
                        $('.catalog-item-commodity-right-btn-css').text('купить комплект');
                    }
		        }
            </script>
		    <div class="catalog-item-commodity-text">
                <div class="catalog-item-commodity-article-text">
                    <p>Описание товара</p>
                </div>
                <div class="1_more_article_text">
                    <h2 style="font-size: 17px; font-weight: 600; margin: 0; margin-top: 0px; text-align: left; margin-top: 10px;">
                        <?php
                        if ($arResult['PROPERTIES']['H2ZONESECOND']['VALUE'] == "") {
                            echo $parentparams['UF_ONCE_FORM']['VALUE'].' '; // берём единичную форму
                            echo $arResult['PROPERTIES']['forma']['VALUE'].' '; // геометрическая форма товара
                            echo $arResult['PROPERTIES']['tip_ustanovki']['VALUE'].' '; // тип установки товара
                            echo $arResult["PROPERTIES"]["COLLECTION_REF"]["VALUE"].' '; // коллекция
                            echo $src_article; // артикул
                        } else {
                            echo $arResult['PROPERTIES']['H2ZONESECOND']['VALUE'];
                        }
                        ?>
                    </h2>
                </div>
                <?php if ($arResult['DETAIL_TEXT'] != '' || $arResult['PROPERTIES']['dop_description']['~VALUE']['TEXT'] != '') { ?>
                    <div class="bx_item_description catalog-item-commodity-p-css">
                        <div id="catalog_desciption_lenght" itemprop="description">
                            <?php
                            if ('html' == $arResult['DETAIL_TEXT_TYPE']) {
                                echo strip_tags($arResult['DETAIL_TEXT'], '<p><a><span><br/><br>');
                            } else {
                                echo '<p>' . $arResult['DETAIL_TEXT'] . '</p>';
                            }
                            // дополнительное описание (после обьединения удалить)
                            if ('HTML' == $arResult['PROPERTIES']['dop_description']['~VALUE']['TYPE']) {
                                echo strip_tags($arResult['PROPERTIES']['dop_description']['~VALUE']['TEXT'], '<p><a><span><br/><br>');
                            } else {
                                echo '<p>' . $arResult['PROPERTIES']['dop_description']['~VALUE']['TEXT'] . '</p>';
                            }
                            ?>
                        </div>
                        <p class="description_magasine"><a href="//sreda-obitaniya.ru">Магазин сантехники</a> Среда Обитания — Ваша территория комфорта.</p>
                        <p onclick="close_spoiler_description();" class="description_spoiler_but close_description description_off">свернуть</p>
                        <p onclick="open_spoiler_description();" class="description_spoiler_but open_description description_off">читать далее...</p>
                    </div>
                <?php } ?>
                <script>
                    $( document ).ready(function() { // спойлер для описания: 650 символов

                        description_lenght = $('#catalog_desciption_lenght').text().slice(0, -1).length;
                        description_full = $('#catalog_desciption_lenght').html();
                        description_cuted = description_full.substring(0, 650);

                        if (description_lenght > 650) {
                            $('#catalog_desciption_lenght').html(description_cuted);
                            $('.open_description').removeClass('description_off');
                            $('.description_magasine').addClass('description_off');
                        }
                    });

                    function close_spoiler_description() {
                        $('#catalog_desciption_lenght').html(description_cuted);
                        $('.close_description').addClass('description_off');
                        $('.open_description').removeClass('description_off');
                        $('.description_magasine').addClass('description_off');
                    }
                    function open_spoiler_description() {
                        $('#catalog_desciption_lenght').html(description_full);
                        $('.open_description').addClass('description_off');
                        $('.close_description').removeClass('description_off');
                        $('.description_magasine').removeClass('description_off');
                    }
                </script>
                <div class="nodisplay"></div>
                <?php if ($arResult["PROPERTIES"]["PURCHASE"]["VALUE"]) { ?>
                    <div class="catalog_simmilar_text">С ЭТИМ ТОВАРОМ ПОКУПАЮТ:</div>
                <?php } ?>
		    </div><?//catalog-item-commodity-text?>
        </div><?//catalog-item-commodity-left?>

        <div class="catalog-item-commodity-right">
            <!-- перенсти в нижнюю строчку -->
            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="catalog-item-commodity-right-content">
                <link itemprop="availability" href="http://schema.org/InStock">
                <?php
                $minPrice = (isset($arResult['RATIO_PRICE']) ? $arResult['RATIO_PRICE'] : $arResult['MIN_PRICE']);
                $boolDiscountShow = (0 < $minPrice['DISCOUNT_DIFF']);
                $prices = getProductPricesCustom($arResult["ID"]);
                $boolDiscountShow = ($prices["priceWithMargin"] > $prices["finalBasketPrice"]);

                $price_for_cheme = str_replace('<span class="rubl">Р</span>', '', $prices["finalBasketPriceF"]);
                $price_for_cheme_final = preg_replace('/\s/', '', $price_for_cheme);
                ?>
                <meta itemprop="price" content="<?= $price_for_cheme_final; ?>">
                <meta itemprop="priceCurrency" content="RUB">
                <p class="catalog-item-commodity-right-content-price old_price nodisplay"><?= ($boolDiscountShow ? $prices["priceWithMarginF"]  : ''); ?></p>
                <p id="catalog_price_for_js" class="catalog-item-commodity-right-content-price invissible-class-hidden"><?= $prices["finalBasketPriceF"] ?></p>
                <span class="catalog-item-commodity-right-content-price-css" >
                    <span style="color: #ffffff" id="complect_new_price"></span>
                    <span style="color: #ffffff" class="rubl">₽</span>
                </span>
                <a href="#" class="btn btn-order js-btn-buy-complect catalog-item-commodity-right-btn catalog-item-commodity-right-btn-css">Купить</a>
                <a class="button_one_click_buy gradient" rel="nofollow" style="display: none;" onclick="oneClickBuy('<?= $arResult["ID"]; ?>', '<?= $arParams["IBLOCK_ID"]; ?>', '<?= $strObName; ?>')">
                    <span>Быстрый заказ</span>
                </a>
                <?php if (isset($arResult['IS_IN_FAVORITE']) && $arResult['IS_IN_FAVORITE'] == 'N') {?>
                    <a data-action="delay" data-item="<?= $arResult["ID"]; ?>" href="javascript:void(0)" class="catalog-item-commodity__heart-btn favourite-button item-favourite favourite-css-catalog">в избранное</a>
                <?php } else { ?>
                    <span class="catalog-item-commodity__heart-active-btn favourite-css-catalog">в избранном</span>
                <?php } ?>
            </div>
            <!-- конец перенсти в нижнюю строчку -->
            <div class="catalog-item-firm-holder-this catalog-item-firm-holder-1 catalog-item-firm-holder-under-favourite display-important">
                <?php if ($arResult["CATALOG_LENGTH"] || $arResult["CATALOG_HEIGHT"] || $arResult["CATALOG_WIDTH"] || $arResult["CATALOG_WEIGHT"]) { ?>
                    <div class="catalog-item-firm-characters">
                        <table class="parametrs_under">
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <h2 style="text-align: center; font-weight: 600; font-size: 1.3em; width: 100%;">Параметры товара</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;">Страна</td>
                                    <td style="text-align: right;"><?= $arResult["PROPERTIES"]["MANUFACTURER"]["UF_COUNTRY"]; ?></td>
                                </tr>
                                    <?php if($arResult["CATALOG_WEIGHT"]) { ?>
                                        <tr>
                                            <td style="text-align: left;">Вес</td>
                                            <td style="text-align: right;"><?= $arResult["CATALOG_WEIGHT"]/1000; ?> кг</td>
                                        </tr>
                                    <?php } ?>
                                    <?php if($arResult["CATALOG_LENGTH"]) { ?>
                                        <tr>
                                            <td style="text-align: left;">Длина</td>
                                            <td style="text-align: right;"><?= $arResult["CATALOG_LENGTH"]/10; ?> см</td>
                                        </tr>
                                    <?php } ?>
                                    <?php if($arResult["CATALOG_HEIGHT"]) { ?>
                                        <tr>
                                            <td style="text-align: left;">Высота</td>
                                            <td style="text-align: right;"><?= $arResult["CATALOG_HEIGHT"]/10; ?> см</td>
                                        </tr>
                                    <?php } ?>
                                    <?php if($arResult["CATALOG_WIDTH"]) { ?>
                                        <tr>
                                            <td style="text-align: left;">Ширина</td>
                                            <td style="text-align: right;"><?= $arResult["CATALOG_WIDTH"]/10; ?> см</td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
            <?php
            // тут не доделал... нужно смотреть заполнено ли поле UF_NAME_PDF в Брендах и если да, то брать от туда текст, если нет, то по-умолчанию
            if (1 == 1) {
                $caption = 'Скачать каталог '.$arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"] . ' ' . $arResult["PROPERTIES"]["COLLECTION_REF"]["VALUE"];
            } else {
                $caption = '';
            }
            ?>
            <div class="box-pdf">
                <!--
                <div class="brand-pdf-link">
                    <a href="#" title="<?= $caption ;?>"><?= $caption ;?></a>
                </div>
                picture_ch
                -->
                <div class="tth-pdf-link">
                    <a href="/download.php?file=<?= CFile::GetPath($arResult["PROPERTIES"]["picture_ch"]["VALUE"]) ;?>" title="Скачать чертеж <?= $parentparams['UF_ONCE_FORM']['VALUE']; ?> <?= $arResult['PROPERTIES']['ARTNUMBER']['VALUE'] ;?>">Чертеж <?= $parentparams['UF_ONCE_FORM']['VALUE']; ?> <?= $arResult['PROPERTIES']['ARTNUMBER']['VALUE']; ?></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </section>
    <div class="clear"></div>
<style>.catalog-numbers-all { display: none;  }</style>
    <?php if ($arResult["PROPERTIES"]["PURCHASE"]["VALUE"]) { ?>
        <!-- start PURCHASE -->
        <section class="catalog-item-similar catalog-item-similar-css">
            <?php
            global $recomendFilter_1;

            // костыли для категорий пока не заполнилнили все карточки
            if ($arResult["SECTION"]["ID"] == 1424) { // Биде подвесные
                $arResult["PROPERTIES"]["PURCHASE"]["VALUE"] = array(
                    437587,
                    279213,
                    437638,
                    424690
                );
            }

            $recomendFilter_1["!ID"] = $arResult["ID"];
            $recomendFilter_1["ID"] = $arResult["PROPERTIES"]["PURCHASE"]["VALUE"];

            $APPLICATION->IncludeComponent("bitrix:catalog.section", "similar", Array(
                "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
                "IBLOCK_ID" => "2",	// Инфоблок
                "SECTION_ID" => "",	// ID раздела
                "SECTION_CODE" => "",	// Код раздела
                "SECTION_USER_FIELDS" => array(	// Свойства раздела
                    0 => "",
                    1 => "",
                ),
                "ELEMENT_SORT_FIELD" => "RAND",	// По какому полю сортируем элементы
                "ELEMENT_SORT_ORDER" => "RAND",	// Порядок сортировки элементов
                "ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
                "ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
                "FILTER_NAME" => "recomendFilter_1",	// Имя массива со значениями фильтра для фильтрации элементов
                "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
                "SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
                "PAGE_ELEMENT_COUNT" => "4",	// Количество элементов на странице
                "LINE_ELEMENT_COUNT" => "4",	// Количество элементов выводимых в одной строке таблицы
                "PROPERTY_CODE" => array(	// Свойства
                    0 => "picture_type",
                    15 => "ARTNUMBER",
                    16 => "MANUFACTURER",
                    17 => "COLLECTION_REF",
                    19 => "strana",
                ),
                "OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
                "ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
                "LABEL_PROP" => "-",	// Свойство меток товара
                "PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
                "SHOW_DISCOUNT_PERCENT" => "N",	// Показывать процент скидки
                "SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
                "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
                "MESS_BTN_ADD_TO_BASKET" => "Купить",	// Текст кнопки "Добавить в корзину"
                "MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
                "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
                "MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
                "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
                "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
                "SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
                "AJAX_MODE" => "N",	// Включить режим AJAX
                "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
                "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                "CACHE_TYPE" => "A",	// Тип кеширования
                "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
                "META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
                "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
                "META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
                "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
                "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                "DISPLAY_COMPARE" => "N",
                "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                "SET_STATUS_404" => "N",	// Устанавливать статус 404
                "CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
                "PRICE_CODE" => array(	// Тип цены
                    0 => "BASE",
                ),
                "USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
                "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
                "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
                "CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
                "CURRENCY_ID" => "RUB",	// Валюта, в которую будут сконвертированы цены
                "BASKET_URL" => $arParams["BASKET_URL"],	// URL, ведущий на страницу с корзиной покупателя
                "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
                "PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
                "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
                "ADD_PROPERTIES_TO_BASKET" => "N",	// Добавлять в корзину свойства товаров и предложений
                "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
                "PAGER_TITLE" => "Товары",	// Название категорий
                "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
                "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
                "PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
                "PRODUCT_PROPERTIES" => array(	// Характеристики товара
                ),
                "COMPONENT_TEMPLATE" => ".default",
                "HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
                "TEMPLATE_THEME" => "blue",	// Цветовая тема
                "SHOW_CLOSE_POPUP" => "N",	// Показывать кнопку продолжения покупок во всплывающих окнах
                "MESS_BTN_COMPARE" => "Сравнить",	// Текст кнопки "Сравнить"
                "SEF_MODE" => "N",	// Включить поддержку ЧПУ
                "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
                "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                "USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
                "ADD_TO_BASKET_ACTION" => "ADD",	// Показывать кнопку добавления в корзину или покупки
                "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                "SHOW_404" => "N",	// Показ специальной страницы
                "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
            ),
                $component,
                array("HIDE_ICONS"=>"Y")
            );
            ?>
        </section>
        <div class="clear"></div>
        <!-- end PURCHASE -->
    <?php }  ?>

    <?php if ($arResult["PROPERTIES"]["RECOMMEND"]["VALUE"]) { ?>
        <!-- start RECOMMEND -->
        <div class="catalog_simmilar_text notabsolute">С ЭТИМ ТОВАРОМ РЕКОМЕНДУЕМ ПОКУПАТЬ:</div>
        <div class="clear"></div>
        <section class="catalog-item-similar catalog-item-similar-css">
            <?php
            global $recomendFilter_2;

            $recomendFilter_2["!ID"] = $arResult["ID"];
            $recomendFilter_2["ID"] = $arResult["PROPERTIES"]["RECOMMEND"]["VALUE"];

            $APPLICATION->IncludeComponent("bitrix:catalog.section", "similar", Array(
                "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
                "IBLOCK_ID" => "2",	// Инфоблок
                "SECTION_ID" => "",	// ID раздела
                "SECTION_CODE" => "",	// Код раздела
                "SECTION_USER_FIELDS" => array(	// Свойства раздела
                    0 => "",
                    1 => "",
                ),
                "ELEMENT_SORT_FIELD" => "RAND",	// По какому полю сортируем элементы
                "ELEMENT_SORT_ORDER" => "RAND",	// Порядок сортировки элементов
                "ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
                "ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
                "FILTER_NAME" => "recomendFilter_2",	// Имя массива со значениями фильтра для фильтрации элементов
                "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
                "SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
                "PAGE_ELEMENT_COUNT" => "8",	// Количество элементов на странице
                "LINE_ELEMENT_COUNT" => "4",	// Количество элементов выводимых в одной строке таблицы
                "PROPERTY_CODE" => array(	// Свойства
                    0 => "picture_type",
                    15 => "ARTNUMBER",
                    16 => "MANUFACTURER",
                    17 => "COLLECTION_REF",
                    19 => "strana",
                ),
                "OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
                "ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
                "LABEL_PROP" => "-",	// Свойство меток товара
                "PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
                "SHOW_DISCOUNT_PERCENT" => "N",	// Показывать процент скидки
                "SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
                "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
                "MESS_BTN_ADD_TO_BASKET" => "Купить",	// Текст кнопки "Добавить в корзину"
                "MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
                "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
                "MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
                "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
                "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
                "SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
                "AJAX_MODE" => "N",	// Включить режим AJAX
                "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
                "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                "CACHE_TYPE" => "A",	// Тип кеширования
                "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
                "META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
                "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
                "META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
                "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
                "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                "DISPLAY_COMPARE" => "N",
                "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                "SET_STATUS_404" => "N",	// Устанавливать статус 404
                "CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
                "PRICE_CODE" => array(	// Тип цены
                    0 => "BASE",
                ),
                "USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
                "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
                "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
                "CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
                "CURRENCY_ID" => "RUB",	// Валюта, в которую будут сконвертированы цены
                "BASKET_URL" => $arParams["BASKET_URL"],	// URL, ведущий на страницу с корзиной покупателя
                "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
                "PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
                "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
                "ADD_PROPERTIES_TO_BASKET" => "N",	// Добавлять в корзину свойства товаров и предложений
                "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
                "PAGER_TITLE" => "Товары",	// Название категорий
                "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
                "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
                "PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
                "PRODUCT_PROPERTIES" => array(	// Характеристики товара
                ),
                "COMPONENT_TEMPLATE" => ".default",
                "HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
                "TEMPLATE_THEME" => "blue",	// Цветовая тема
                "SHOW_CLOSE_POPUP" => "N",	// Показывать кнопку продолжения покупок во всплывающих окнах
                "MESS_BTN_COMPARE" => "Сравнить",	// Текст кнопки "Сравнить"
                "SEF_MODE" => "N",	// Включить поддержку ЧПУ
                "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
                "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                "USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
                "ADD_TO_BASKET_ACTION" => "ADD",	// Показывать кнопку добавления в корзину или покупки
                "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                "SHOW_404" => "N",	// Показ специальной страницы
                "MESSAGE_404" => "", // Сообщение для показа (по умолчанию из компонента)
            ),
                $component,
                array("HIDE_ICONS"=>"Y")
            );
            ?>
        </section>
        <div class="clear"></div>
        <!-- end RECOMMEND -->
    <?php } ?>

    <?php if ($arResult["PROPERTIES"]["COLLECTION_REF"]["~VALUE"]) { ?>
        <!-- statr COLLECTION_REF -->
        <div class="catalog_simmilar_text notabsolute">ДРУГИЕ ТОВАРЫ ИЗ КОЛЕКЦИИ <?=$arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"];?> <?=$arResult["PROPERTIES"]["COLLECTION_REF"]["VALUE"];?>:</div>
        <div class="clear"></div>
        <section class="catalog-item-similar catalog-item-similar-css">
            <?php
            // разбираем цвет (почему то фильт отрабатывает только по значению ~VALUE, на ID значения цвета он не риагирует),
            // сначала смотрим цвет из двух слов или нет, потом у [0] отнимаем 2 символа и находим в цвете вхождение
            $arrCol = explode(' ', $arResult["PROPERTIES"]["main_color"]["~VALUE"]);
            $arrCol = substr($arrCol[0], 0, -2);

            $GLOBALS['arrFilter'] = array(
                "!ID" => $arResult["ID"], // не выводим в списке данный товар
                "ACTIVE" => "Y",
                "PROPERTY_17_VALUE" => $arResult["PROPERTIES"]["COLLECTION_REF"]["~VALUE"],
                "PROPERTY_1301_VALUE" => $arrCol."%",
            );
            $count = 600;

            $APPLICATION->IncludeComponent("bitrix:catalog.section", "similar", Array(
                "IBLOCK_TYPE" => "catalog",                     // Тип инфоблока
                "IBLOCK_ID" => "2",                             // Инфоблок
                "SECTION_ID" => "",                             // ID раздела
                "SECTION_CODE" => "",                           // Код раздела
                "SECTION_USER_FIELDS" => array(                 // Свойства раздела
                    0 => "",
                    1 => "",
                ),
                "ELEMENT_SORT_FIELD" => "RAND",                 // По какому полю сортируем элементы
                "ELEMENT_SORT_ORDER" => "RAND",                 // Порядок сортировки элементов
                "ELEMENT_SORT_FIELD2" => "id",                  // Поле для второй сортировки элементов
                "ELEMENT_SORT_ORDER2" => "desc",                // Порядок второй сортировки элементов
                "FILTER_NAME" => "arrFilter",                   // Имя массива со значениями фильтра для фильтрации элементов
                "INCLUDE_SUBSECTIONS" => "Y",                   // Показывать элементы подразделов раздела
                "SHOW_ALL_WO_SECTION" => "Y",                   // Показывать все элементы, если не указан раздел
                "PAGE_ELEMENT_COUNT" => $count,                 // Количество элементов на странице
                "LINE_ELEMENT_COUNT" => $count,                 // Количество элементов выводимых в одной строке таблицы
                "PROPERTY_CODE" => array(                       // Свойства
                    0 => "picture_type",
                    15 => "ARTNUMBER",
                    16 => "MANUFACTURER",
                    17 => "COLLECTION_REF",
                    19 => "strana",
                ),
                "OFFERS_LIMIT" => "0",                          // Максимальное количество предложений для показа (0 - все)
                "ADD_PICT_PROP" => "-",                         // Дополнительная картинка основного товара
                "LABEL_PROP" => "-",                            // Свойство меток товара
                "PRODUCT_SUBSCRIPTION" => "N",                  // Разрешить оповещения для отсутствующих товаров
                "SHOW_DISCOUNT_PERCENT" => "N",                 // Показывать процент скидки
                "SHOW_OLD_PRICE" => "Y",                        // Показывать старую цену
                "MESS_BTN_BUY" => "Купить",                     // Текст кнопки "Купить"
                "MESS_BTN_ADD_TO_BASKET" => "Купить",           // Текст кнопки "Добавить в корзину"
                "MESS_BTN_SUBSCRIBE" => "Подписаться",          // Текст кнопки "Уведомить о поступлении"
                "MESS_BTN_DETAIL" => "Подробнее",               // Текст кнопки "Подробнее"
                "MESS_NOT_AVAILABLE" => "Нет в наличии",        // Сообщение об отсутствии товара
                "SECTION_URL" => "",                            // URL, ведущий на страницу с содержимым раздела
                "DETAIL_URL" => "",                             // URL, ведущий на страницу с содержимым элемента раздела
                "SECTION_ID_VARIABLE" => "SECTION_ID",          // Название переменной, в которой передается код группы
                "AJAX_MODE" => "N",                             // Включить режим AJAX
                "AJAX_OPTION_JUMP" => "N",                      // Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "N",                     // Включить подгрузку стилей
                "AJAX_OPTION_HISTORY" => "N",                   // Включить эмуляцию навигации браузера
                "CACHE_TYPE" => "A",                            // Тип кеширования
                "CACHE_TIME" => "36000000",                     // Время кеширования (сек.)
                "CACHE_GROUPS" => "Y",                          // Учитывать права доступа
                "SET_META_KEYWORDS" => "N",                     // Устанавливать ключевые слова страницы
                "META_KEYWORDS" => "-",                         // Установить ключевые слова страницы из свойства
                "SET_META_DESCRIPTION" => "N",                  // Устанавливать описание страницы
                "META_DESCRIPTION" => "-",                      // Установить описание страницы из свойства
                "BROWSER_TITLE" => "-",                         // Установить заголовок окна браузера из свойства
                "ADD_SECTIONS_CHAIN" => "N",                    // Включать раздел в цепочку навигации
                "DISPLAY_COMPARE" => "N",
                "SET_TITLE" => "N",                             // Устанавливать заголовок страницы
                "SET_STATUS_404" => "N",                        // Устанавливать статус 404
                "CACHE_FILTER" => "Y",                          // Кешировать при установленном фильтре
                "PRICE_CODE" => array(                          // Тип цены
                    0 => "BASE",
                ),
                "USE_PRICE_COUNT" => "N",                       // Использовать вывод цен с диапазонами
                "SHOW_PRICE_COUNT" => "1",                      // Выводить цены для количества
                "PRICE_VAT_INCLUDE" => "Y",                     // Включать НДС в цену
                "CONVERT_CURRENCY" => "Y",                      // Показывать цены в одной валюте
                "CURRENCY_ID" => "RUB",                         // Валюта, в которую будут сконвертированы цены
                "BASKET_URL" => $arParams["BASKET_URL"],        // URL, ведущий на страницу с корзиной покупателя
                "ACTION_VARIABLE" => "action",                  // Название переменной, в которой передается действие
                "PRODUCT_ID_VARIABLE" => "id",                  // Название переменной, в которой передается код товара для покупки
                "USE_PRODUCT_QUANTITY" => "N",                  // Разрешить указание количества товара
                "ADD_PROPERTIES_TO_BASKET" => "N",              // Добавлять в корзину свойства товаров и предложений
                "PAGER_TEMPLATE" => ".default",                 // Шаблон постраничной навигации
                "DISPLAY_TOP_PAGER" => "N",                     // Выводить над списком
                "DISPLAY_BOTTOM_PAGER" => "N",                  // Выводить под списком
                "PAGER_TITLE" => "Товары",                      // Название категорий
                "PAGER_SHOW_ALWAYS" => "N",                     // Выводить всегда
                "PAGER_DESC_NUMBERING" => "N",                  // Использовать обратную навигацию
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",   // Время кеширования страниц для обратной навигации
                "PAGER_SHOW_ALL" => "N",                        // Показывать ссылку "Все"
                "AJAX_OPTION_ADDITIONAL" => "",                 // Дополнительный идентификатор
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",      // Название переменной, в которой передается количество товара
                "PRODUCT_PROPS_VARIABLE" => "prop",             // Название переменной, в которой передаются характеристики товара
                "PARTIAL_PRODUCT_PROPERTIES" => "N",            // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
                "PRODUCT_PROPERTIES" => Array(                  // Характеристики товара
                ),
                "COMPONENT_TEMPLATE" => ".default",
                "HIDE_NOT_AVAILABLE" => "N",                    // Не отображать товары, которых нет на складах
                "TEMPLATE_THEME" => "blue",                     // Цветовая тема
                "SHOW_CLOSE_POPUP" => "N",                      // Показывать кнопку продолжения покупок во всплывающих окнах
                "MESS_BTN_COMPARE" => "Сравнить",               // Текст кнопки "Сравнить"
                "SEF_MODE" => "N",                              // Включить поддержку ЧПУ
                "SET_BROWSER_TITLE" => "N",                     // Устанавливать заголовок окна браузера
                "SET_LAST_MODIFIED" => "N",                     // Устанавливать в заголовках ответа время модификации страницы
                "USE_MAIN_ELEMENT_SECTION" => "N",              // Использовать основной раздел для показа элемента
                "ADD_TO_BASKET_ACTION" => "ADD",                // Показывать кнопку добавления в корзину или покупки
                "PAGER_BASE_LINK_ENABLE" => "N",                // Включить обработку ссылок
                "SHOW_404" => "N",                              // Показ специальной страницы
                "MESSAGE_404" => "",                            // Сообщение для показа (по умолчанию из компонента)
            ),
                $component,
                Array("HIDE_ICONS"=>"Y")
            );
            ?>
        </section>
        <div class="clear"></div>
        <!-- end COLLECTION_REF -->
    <?php } ?>

    <section class="garantyy-blocks"><?php if($arResult['TAGS']) { ?>
        <div class="garantyy-blocks-div garantyy-blocks-div-4">
		    <p class="garantyy-description"><?= $arResult['TAGS']; ?></p>
        </div><?php } ?><!-- --><!--noindex--><div class="garantyy-blocks-div garantyy-blocks-div-1">
		    <img alt="Гарантия оплаты" class="garantyy-img" src="/local/templates/sreda_adaptive/images/garantee-star.png">
		    <p class="garantyy-under-img">Как оплатить<br><?= ($arResult['UF_FIELD_PRODUCT']['UF_FORM_INDUCEMENT']? $arResult['UF_FIELD_PRODUCT']['UF_FORM_INDUCEMENT'] : $arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"]); ?></p>
		    <p class="garantyy-description pad0">Основные способы оплаты:</p>
            <ul>
                <li>Наличный расчет;</li>
                <li>Безналичный расчет;</li>
                <li>Банковская карта;</li>
                <li>Электронные платежи;</li>
                <li>Мой баланс;</li>
                <li>Безопасность онлайновых платежей;</li>
                <li>Купить в кредит;</li>
                <li>Рассрочка платежа.</li>
            </ul>
	    </div><!-- --><div class="garantyy-blocks-div garantyy-blocks-div-2">
	    	<img alt="Гарантия получения товара" class="garantyy-img" src="/local/templates/sreda_adaptive/images/garantee-arrow.png">
		    <p class="garantyy-under-img">Как получить<br><?= ($arResult['UF_FIELD_PRODUCT']['UF_FORM_INDUCEMENT']? $arResult['UF_FIELD_PRODUCT']['UF_FORM_INDUCEMENT'] : $arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"]); ?></p>
            <p class="garantyy-description pad0">Доставка по Москве и Московской области Доставка по России Доставка в республики «ЕАЭС»</p>
            <ul>
                <li>Республика Армения;</li>
                <li>Республика Беларусь;</li>
                <li>Республика Казахстан;</li>
                <li>Кыргызская Республика.</li>
            </ul>
            <p class="garantyy-description pad0">Купленный товар застрахован!</p>
        </div><!-- --><div class="garantyy-blocks-div garantyy-blocks-div-3">
	    	<img alt="Гарантия производителя" class="garantyy-img" src="/local/templates/sreda_adaptive/images/garantee-like.png">
	    	<p class="garantyy-under-img">Гарантия на продукцию<br><?= $arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"]; ?></p>
	    	<p class="garantyy-description">Компания «Среда Обитания» устанавливает гарантийный срок 12 месяцев на всю продукцию «<?= $arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"]; ?>».<br>Гарантия предоставляется покупателям, осуществившим монтаж квалифицированным сервисом. Замена неисправного элемента или всей части товара, осуществляется в разумные сроки, предусмотренным договором оказании услуг.
            </p>
	    </div><!--/noindex-->
    </section>
    <script>
        $(document).ready(function() {
            change_price_handler();
            var swiper = new Swiper('.swiper-container-catalog-item', {
                nextButton: '.catalog-item-slider-arrow-next',
                prevButton: '.catalog-item-slider-arrow-prev',
                onSlideChangeStart : function() {
                    setTimeout(function() {
                    countSlidesActive();
                    }, 100)
                }
            });
            var swiper2 = new Swiper('.swiper-container-catalog-complect', {
                nextButton: '.catalog-item-complect-arrow-next',
                prevButton: '.catalog-item-complect-arrow-prev',
                slidesPerView: 3,
            });
            countSlidesActive();
            if ($('.header').width() >= 1200) {
                setTimeout(set_height_gold, 250);
            }

            function set_height_gold(){
                var height_for_price = $('#complect').height();
                $('.catalog-item-commodity-right-content').height(height_for_price - 16);
            }
            if ($('.header').width() >= 1200) {
                var item_block_height = 0;
                var item_block_height_raw_1 = $('.catalog-item-complect-block:eq(0)').height();
                var item_block_height_raw_2 = $('.catalog-item-complect-block:eq(1)').height();
                var item_block_height_raw_3 = $('.catalog-item-complect-block:eq(2)').height();
                var item_block_height_raw_4 = $('.catalog-item-complect-block:eq(3)').height();
                if (item_block_height_raw_1 > item_block_height){item_block_height = item_block_height_raw_1}
                if (item_block_height_raw_2 > item_block_height){item_block_height = item_block_height_raw_2}
                if (item_block_height_raw_3 > item_block_height){item_block_height = item_block_height_raw_3}
                if (item_block_height_raw_4 > item_block_height){item_block_height = item_block_height_raw_4}
                item_block_height = item_block_height + $('.catalog-item-complect-line').height() + 20;
                $('.catalog-item-complect-left').height(item_block_height);

                if($('.garantyy-blocks-div-4').width() == null) {
                    $('.garantyy-blocks-div-1').width(395);
                $('.garantyy-blocks-div-2').width(395);
                $('.garantyy-blocks-div-3').width(400);
            }}
        });

		function owlcycle(){
		    $('.owl-stage').css('transform', 'translate3d(0px, 0px, 0px)');
		    setTimeout(owlcycle, 1000);
	 }
	</script>
</div>
<style>
    .push {
	    display: none;
    }
</style>
<?php
    // pa($arResult["PROPERTIES"]["picture_ch"]["VALUE"]);
    // pa($arResult);
    // pa($arResult['UF_FIELD_ARRAY2']);
    // pa($arResult["PROPERTIES"]);
    // pa($arResult['PROPERTIES']);
    // pa($arResult['PROPERTIES']['dop_description']['~VALUE']['TEXT']);
    // pa($arResult["RECOMEND"]);
?>