<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

//print_r($arResult["PROPERTIES"]["COLLECTION_REF"]);

$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
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
?><?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

//print_r($arResult["PROPERTIES"]["COLLECTION_REF"]);

$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
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
?>

<?php
                $minPrice = (isset($arResult['RATIO_PRICE']) ? $arResult['RATIO_PRICE'] : $arResult['MIN_PRICE']);
                $boolDiscountShow = (0 < $minPrice['DISCOUNT_DIFF']);
                $prices = getProductPricesCustom($arResult["ID"]);
                
                $boolDiscountShow = ($prices["priceWithMargin"] > $prices["finalBasketPrice"]);

                $price_for_cheme = str_replace('<span class="rubl">Р</span>', '', $prices["finalBasketPriceF"]);
                $price_for_cheme_final = preg_replace('/\s/', '', $price_for_cheme);
                ?>
<style>.catalog-numbers-all { display: none !important;  }</style>
<script>
    $( document ).ready(function() {
        $('.slide-right-img-plus:eq(2)').toggleClass('nodisplay');
    });
    </script>
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
                    
		            $('#complect_new_price').text(new_price_gap);
                    if (old_price == new_price) {
                        $('.catalog-item-commodity-right-btn-css').text('купить');
                    } else {
                        $('.catalog-item-commodity-right-btn-css').text('купить комплект');
                    }
		        }
            </script>

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

		<div class="detail_product_name">
            <h1 itemprop="name" class="h1-second h-css-title detail_product_name_h1"><?=$arResult['NAME']?></h1>
            <div class="for_article_span">
                <div class="detail_product_name__right">
                    <div class="item__brand">
                        <span class="items__desc">Бренд:</span>
                        <span itemporop="brand">
                            <a href="/brands/<?=$arResult["PROPERTIES"]["MANUFACTURER"]["CODE"]?>/"><?=$arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"];?></a>
                        </span>
                    </div>
                    <div class="item__code">
                        <span class="items__desc">Артикул:</span>
                        <span itemprop="model" class="item__code-t"><?=$arResult['PROPERTIES']['ARTNUMBER']['VALUE']?></span>
                    </div>
                </div>
             </div>
        </div>
        <section class="catalog-item-slider">
            <div class="swiper-container-catalog-item swiper-container-horizontal">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
<?if(!empty($arResult["DETAIL_PICTURE"]["ID"])):?>
			<?


			$bigimg = CFile::ResizeImageGet(
					$arResult["DETAIL_PICTURE"]["ID"],
					array('width'=>1200, 'height'=>600),
					BX_RESIZE_IMAGE_EXACT,
					true,
					$filterWatermark
				);
// if($USER->isAdmin()){				
// echo '<pre style="display:none;">';print_r($bigimg);echo '</pre>';
// }
			// $bigimg2 = CFile::ResizeImageGet(
					// $bigimg["src"],
					// array('width'=>1200, 'height'=>600),
					// BX_RESIZE_IMAGE_EXACT,
					// true,
					// $filterWatermark_center
				// );?>
			<img alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"  title="<?=$arResult["DETAIL_PICTURE"]["TITLE"];?>" src="<?=$bigimg["src"];?>" />
<?endif;?>
</div>

		<?foreach ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $arPhoto):
			$thumb = CFile::ResizeImageGet(
				$arPhoto,
				array('width'=>1200, 'height'=>600),
				BX_RESIZE_IMAGE_EXACT,
				true,
				$filterWatermark
			);
		?>
			<div class="swiper-slide">
				<img alt="<?=$arResult['NAME']?>"  title="<?=$arResult['NAME']?>" src="<?=$thumb['src']?>" />
			</div><!--item-->
		<? endforeach; ?>
                </div>
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
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <section class="s-breadcrumb-product">
            <div class="s-breadcrumb-product__links">
            	<?foreach($arResult['CRUMBS'] as $item):?>
					<?if(!empty($item["LINK"])):?>
						<span itemprop="child" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
		                    <a itemprop="url" class="breadcrumb-font bread_crumb_tech breadcrumb-font-uppercase" href="<?=$item["LINK"]?>" title="<?=$item["NAME"]?>">
		                    <span itemprop="title" class="breadcrumb-font breadcrumb-font-underline"><?=$item["NAME"]?></span>
		                    </a>
		                </span>
						<span class="bread-divider breadcrumb-font">&gt;</span>
					<?else:?>
						<span class="disable breadcrumb-font breadcrumb-font-uppercase"><?=$item["NAME"]?></span>
					<?endif;?>
				<?endforeach;?>
            </div>
            <div class="s-breadcrumb-product__brand" onclick="location.href='/brands/smesitel-dlya-vannoj-ritmonio/smesitel-dlya-vannoj-diametro35-inox-ritmonio/';">
                <div class="s-breadcrumb-product__brand-wrap">
                    Все предметы коллекции<br>
                    <a class="breadcrumb-brand-href" href="/brands/<?=$arResult["PROPERTIES"]["MANUFACTURER"]["CODE"]?>/"><?=$arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"];?></a>
                </div>
            </div>
        </section>

        <section class="commodity-block">
            <div class="commodity-block__left">
                <div class="commodity-block__set">
                    <h3 class=""><?=$item["NAME"]?> КОМПЛЕКТУЕТСЯ:</h3>
                    <div class="wrap__set-item" id="complect">
                    <?
					$mainPhoto = $arResult["DETAIL_PICTURE"]["ID"];
					$lr = $arResult["PROPERTIES"]["picture_type"]["VALUE_XML_ID"];
					if(isset($arResult['PROPERTIES']['complect_photo']['VALUE'])){
						$mainPhoto = $arResult['PROPERTIES']['complect_photo']['VALUE'];
						$lr = '';
					}
					$trumb = thumb($mainPhoto, array('width'=>200, 'height'=>200), BX_RESIZE_IMAGE_EXACT, $lr);
					?>
                        <div class="set-item">
	                       	<span class="catalog-item-complect-icon">
	                           <a onclick="change_price_handler();" id="" data-value="<?=$prices['finalBasketPrice'];?>" data-no-discount-price="<?=$priecs['priceWithMargin']?>" data-id="<?=$arResult['ID']?>" class="catalog-item-complect-icon-plus checked"></a>
	                            <span class="catalog-item-complect-price" style="margin-right: 10px;">
	                            </span>
	                        </span>
                            <div class="set-item--wrap_img">
                                <img src="<?=$trumb["src"];?>" alt="complect">
                            </div>
                            <span class="catalog-item-complect-text" title="<?=$arResult['NAME']?>"><?=$arResult['NAME']?></span>
                        </div>

                        <? foreach ($arResult['PROPERTIES']['complect']['V'] as $complect):
							$pricesComplect = getProductPricesCustom($complect["ID"]); ?>
							<div class="set-item">
	                       		<span class="catalog-item-complect-icon">
	                           		<a onclick="change_price_handler();" id="complect_<?=$complect['ID']?>" data-value="<?=$pricesComplect["finalBasketPrice"];?>" data-no-discount-price="<?=$finalBasketPrice["priceWithMargin"];?>" data-id="<?=$complect['ID']?>" class="catalog-item-complect-icon-plus"></a>
	                            	<span class="catalog-item-complect-price" style="margin-right: 10px;">
	                            		<span class="price-plus">+ </span> <?=$pricesComplect["finalBasketPriceF"];?>
	                            	</span>
		                        </span>
		                        <div class="set-item--wrap_img">
		                        	<img src="<?=$complect["DETAIL_PICTURE"]["src"];?>" alt="<?=$complect["NAME"];?>">
		                        </div>
		                        <span class="catalog-item-complect-text" title="<?=strtolower($complect["NAME"]);?>"><?=strtolower($complect["NAME"]);?></span>
		                    </div>
						<?endforeach;?>
                    </div>
                </div>
                <div class="commodity-block__action">
                </div>
            </div>
            <div class="commodity-block__right">
                <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="commodity-block__right--content">
                    <link itemprop="availability" href="http://schema.org/InStock">
                    <meta itemprop="price" content="12180">
                    <meta itemprop="priceCurrency" content="RUB">
                    
                    <p class="catalog-item-commodity-right-content-price old_price " style="text-align: center; display: <? echo ($boolDiscountShow ? '' : 'none'); ?>"><? echo ($boolDiscountShow ? $prices["priceWithMarginF"]  : ''); ?> </p>
                    <p id="catalog_price_for_js" class="catalog-item-commodity-right-content-price invissible-class-hidden"><? echo $prices["finalBasketPriceF"] ?></p>
                    <p class="btn btn-pseudo invissible-class-hidden" ><span id="complect_price"><?= $arResult['MIN_BASIS_PRICE']['PRINT_VALUE']; ?></span> </p>
                    <span class="catalog-item-commodity-right-content-price-css">
	                    <span style="color: #ffffff" id="complect_new_price"><? echo $prices["finalBasketPriceF"] ?></span>
	                </span>
                    <div class="buy-block">
                        <!--<div class="buy-block_quantity">
                            <div class="buy-block_quantity--wrap">
                                <input type="text" class="buy-block_quantity--col_input" id="" name="QUANTITY" value="1">
                                <a href="javascript:void(0)" class="buy-block_quantity--btn_min" rel="nofollow">-</a>
                                <a href="javascript:void(0)" class="buy-block_quantity--btn_plus" rel="nofollow">+</a>
                                <span class="buy-block_quantity--desc">шт</span>
                            </div>
                        </div>-->
                        <div class="buy-block_btn">
                            <a href="#" class="btn-order js-btn-buy-complect catalog-item-commodity-right-btn catalog-item-commodity-right-btn-css" data-id="<?=$arResult['ID']?>">В корзину</a>
                        </div>
                        </div>
                    <a class="button_one_click_buy gradient" rel="nofollow" style="display: none;" onclick="oneClickBuy('<?=$arResult["ID"]?>', '<?=$arParams["IBLOCK_ID"]?>', '<?=$strObName?>')">
                        <span>Быстрый заказ</span>
                    </a>
                    <?
				      if (isset($arResult['IS_IN_FAVORITE']) && $arResult['IS_IN_FAVORITE'] == 'N')
				      {
				        ?>
				        <a
				            data-action="delay"
				            data-item="<?=$arResult["ID"]?>"
				            href="javascript:void(0)"
				            class="catalog-item-commodity__heart-btn favourite-button item-favourite"
				        >в избранное</a>
				        <?
				      }
				      else
				      {
				        ?>
				        <span class="catalog-item-commodity__heart-active-btn">в избранном</span>
				        <?
				      }
				      ?>
                </div>
            </div>
            <div class="clear"></div>
        </section>
        <section class="commodity-block">
            <div class="desc-block__left">
                <div class="catalog-item-commodity-article-text">
                    <p style="margin-top: -36px;">Описание товара</p>
                </div>
                <div class="more_article_text">
                	<?if ('Y' == $arParams['DISPLAY_NAME']){?>
					<h2 style="font-size: 17px; font-weight: 600; margin: 0; margin-top: 0px; text-align: left; margin-top: 10px;">
						<?
						echo (
							isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
							? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
							: $arResult["NAME"]
						); ?>
					</h2>
					<?}?>
                </div>
                <div class="bx_item_description catalog-item-commodity-p-css">
                    <div id="catalog_desciption_lenght" itemprop="description">
                        <?if ('html' == $arResult['DETAIL_TEXT_TYPE']){echo $arResult['DETAIL_TEXT'];}else{?><p><? echo $arResult['DETAIL_TEXT']; ?></p><?}?>
                    </div>
                    <p class="description_magasine description_off"><a href="//sreda-obitaniya.ru">Магазин сантехники</a> Среда Обитания — Ваша территория комфорта.</p>
                    <p onclick="close_spoiler_description();" class="description_spoiler_but close_description description_off">свернуть</p>
                    <p onclick="open_spoiler_description();" class="description_spoiler_but open_description">читать далее...</p>
                </div>
                <div class="nodisplay"></div>
            </div>
            <div class="desc-block__right">
                <div class="catalog-item-firm-holder-this catalog-item-firm-holder-1 catalog-item-firm-holder-under-favourite display-important">
                    <div class="catalog-item-firm-characters">
                        <table class="parametrs_under">
                            <tbody>
                            <tr>
                                <td colspan="2">
                                    <h2>Параметры товара</h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Страна</td>
                                <td style="text-align: right;"><?=$arResult["PROPERTIES"]["MANUFACTURER"]["UF_COUNTRY"];?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Вес</td>
                                <td style="text-align: right;"><?=$arResult["CATALOG_WEIGHT"]?> кг</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Длина</td>
                                <td style="text-align: right;"><?=$arResult["CATALOG_LENGTH"]?> см</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Высота</td>
                                <td style="text-align: right;"><?=$arResult["CATALOG_HEIGHT"]?> см</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Ширина</td>
                                <td style="text-align: right;"><?=$arResult["CATALOG_WIDTH"]?> см</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tth-pdf-link">
                    <a href="/download.php?file=/upload/iblock/2ff/bezymyannyy1.png" title="Скачать чертеж Раковина L108 104">Чертеж Раковина L108 104</a>
                </div>
            </div>
        </section>


        <section class="catalog-item-similar catalog-item-similar-css">
            <div class="catalog_simmilar_text">С ЭТИМ ТОВАРОМ РЕКОМЕНДУЕМ ПОКУПАТЬ:</div>
            <section class="catalog-cols">
                <?php
            global $recomendFilter_2;

            $recomendFilter_2["!ID"] = $arResult["ID"];
            $recomendFilter_2["ID"] = $arResult["PROPERTIES"]["RECOMMEND"]["VALUE"];

            $APPLICATION->IncludeComponent("bitrix:catalog.section", "similar", Array(
                "IBLOCK_TYPE" => "catalog", // Тип инфоблока
                "IBLOCK_ID" => "2", // Инфоблок
                "SECTION_ID" => "", // ID раздела
                "SECTION_CODE" => "",   // Код раздела
                "SECTION_USER_FIELDS" => array( // Свойства раздела
                    0 => "",
                    1 => "",
                ),
                "ELEMENT_SORT_FIELD" => "RAND", // По какому полю сортируем элементы
                "ELEMENT_SORT_ORDER" => "RAND", // Порядок сортировки элементов
                "ELEMENT_SORT_FIELD2" => "id",  // Поле для второй сортировки элементов
                "ELEMENT_SORT_ORDER2" => "desc",    // Порядок второй сортировки элементов
                "FILTER_NAME" => "recomendFilter_2",    // Имя массива со значениями фильтра для фильтрации элементов
                "INCLUDE_SUBSECTIONS" => "Y",   // Показывать элементы подразделов раздела
                "SHOW_ALL_WO_SECTION" => "Y",   // Показывать все элементы, если не указан раздел
                "PAGE_ELEMENT_COUNT" => "8",    // Количество элементов на странице
                "LINE_ELEMENT_COUNT" => "4",    // Количество элементов выводимых в одной строке таблицы
                "PROPERTY_CODE" => array(   // Свойства
                    0 => "picture_type",
                    15 => "ARTNUMBER",
                    16 => "MANUFACTURER",
                    17 => "COLLECTION_REF",
                    19 => "strana",
                ),
                "OFFERS_LIMIT" => "5",  // Максимальное количество предложений для показа (0 - все)
                "ADD_PICT_PROP" => "-", // Дополнительная картинка основного товара
                "LABEL_PROP" => "-",    // Свойство меток товара
                "PRODUCT_SUBSCRIPTION" => "N",  // Разрешить оповещения для отсутствующих товаров
                "SHOW_DISCOUNT_PERCENT" => "N", // Показывать процент скидки
                "SHOW_OLD_PRICE" => "Y",    // Показывать старую цену
                "MESS_BTN_BUY" => "Купить", // Текст кнопки "Купить"
                "MESS_BTN_ADD_TO_BASKET" => "Купить",   // Текст кнопки "Добавить в корзину"
                "MESS_BTN_SUBSCRIBE" => "Подписаться",  // Текст кнопки "Уведомить о поступлении"
                "MESS_BTN_DETAIL" => "Подробнее",   // Текст кнопки "Подробнее"
                "MESS_NOT_AVAILABLE" => "Нет в наличии",    // Сообщение об отсутствии товара
                "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
                "DETAIL_URL" => "", // URL, ведущий на страницу с содержимым элемента раздела
                "SECTION_ID_VARIABLE" => "SECTION_ID",  // Название переменной, в которой передается код группы
                "AJAX_MODE" => "N", // Включить режим AJAX
                "AJAX_OPTION_JUMP" => "N",  // Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "N", // Включить подгрузку стилей
                "AJAX_OPTION_HISTORY" => "N",   // Включить эмуляцию навигации браузера
                "CACHE_TYPE" => "A",    // Тип кеширования
                "CACHE_TIME" => "36000000", // Время кеширования (сек.)
                "CACHE_GROUPS" => "Y",  // Учитывать права доступа
                "SET_META_KEYWORDS" => "N", // Устанавливать ключевые слова страницы
                "META_KEYWORDS" => "-", // Установить ключевые слова страницы из свойства
                "SET_META_DESCRIPTION" => "N",  // Устанавливать описание страницы
                "META_DESCRIPTION" => "-",  // Установить описание страницы из свойства
                "BROWSER_TITLE" => "-", // Установить заголовок окна браузера из свойства
                "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                "DISPLAY_COMPARE" => "N",
                "SET_TITLE" => "N", // Устанавливать заголовок страницы
                "SET_STATUS_404" => "N",    // Устанавливать статус 404
                "CACHE_FILTER" => "Y",  // Кешировать при установленном фильтре
                "PRICE_CODE" => array(  // Тип цены
                    0 => "BASE",
                ),
                "USE_PRICE_COUNT" => "N",   // Использовать вывод цен с диапазонами
                "SHOW_PRICE_COUNT" => "1",  // Выводить цены для количества
                "PRICE_VAT_INCLUDE" => "Y", // Включать НДС в цену
                "CONVERT_CURRENCY" => "Y",  // Показывать цены в одной валюте
                "CURRENCY_ID" => "RUB", // Валюта, в которую будут сконвертированы цены
                "BASKET_URL" => $arParams["BASKET_URL"],    // URL, ведущий на страницу с корзиной покупателя
                "ACTION_VARIABLE" => "action",  // Название переменной, в которой передается действие
                "PRODUCT_ID_VARIABLE" => "id",  // Название переменной, в которой передается код товара для покупки
                "USE_PRODUCT_QUANTITY" => "N",  // Разрешить указание количества товара
                "ADD_PROPERTIES_TO_BASKET" => "N",  // Добавлять в корзину свойства товаров и предложений
                "PAGER_TEMPLATE" => ".default", // Шаблон постраничной навигации
                "DISPLAY_TOP_PAGER" => "N", // Выводить над списком
                "DISPLAY_BOTTOM_PAGER" => "N",  // Выводить под списком
                "PAGER_TITLE" => "Товары",  // Название категорий
                "PAGER_SHOW_ALWAYS" => "N", // Выводить всегда
                "PAGER_DESC_NUMBERING" => "N",  // Использовать обратную навигацию
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",   // Время кеширования страниц для обратной навигации
                "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
                "AJAX_OPTION_ADDITIONAL" => "", // Дополнительный идентификатор
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",  // Название переменной, в которой передается количество товара
                "PRODUCT_PROPS_VARIABLE" => "prop", // Название переменной, в которой передаются характеристики товара
                "PARTIAL_PRODUCT_PROPERTIES" => "N",    // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
                "PRODUCT_PROPERTIES" => array(  // Характеристики товара
                ),
                "COMPONENT_TEMPLATE" => ".default",
                "HIDE_NOT_AVAILABLE" => "N",    // Не отображать товары, которых нет на складах
                "TEMPLATE_THEME" => "blue", // Цветовая тема
                "SHOW_CLOSE_POPUP" => "N",  // Показывать кнопку продолжения покупок во всплывающих окнах
                "MESS_BTN_COMPARE" => "Сравнить",   // Текст кнопки "Сравнить"
                "SEF_MODE" => "N",  // Включить поддержку ЧПУ
                "SET_BROWSER_TITLE" => "N", // Устанавливать заголовок окна браузера
                "SET_LAST_MODIFIED" => "N", // Устанавливать в заголовках ответа время модификации страницы
                "USE_MAIN_ELEMENT_SECTION" => "N",  // Использовать основной раздел для показа элемента
                "ADD_TO_BASKET_ACTION" => "ADD",    // Показывать кнопку добавления в корзину или покупки
                "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
                "SHOW_404" => "N",  // Показ специальной страницы
                "MESSAGE_404" => "", // Сообщение для показа (по умолчанию из компонента)
            ),
                $component,
                array("HIDE_ICONS"=>"Y")
            );
            ?>
                <span class="clear"></span>
                <span class="clear"></span>
            </section>
        </section>

        <section class="catalog-item-similar catalog-item-similar-css">
            <div class="catalog_simmilar_text">С ЭТИМ ТОВАРОМ ПОКУПАЮТ:</div>
            <section class="catalog-cols">
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
                "IBLOCK_TYPE" => "catalog", // Тип инфоблока
                "IBLOCK_ID" => "2", // Инфоблок
                "SECTION_ID" => "", // ID раздела
                "SECTION_CODE" => "",   // Код раздела
                "SECTION_USER_FIELDS" => array( // Свойства раздела
                    0 => "",
                    1 => "",
                ),
                "ELEMENT_SORT_FIELD" => "RAND", // По какому полю сортируем элементы
                "ELEMENT_SORT_ORDER" => "RAND", // Порядок сортировки элементов
                "ELEMENT_SORT_FIELD2" => "id",  // Поле для второй сортировки элементов
                "ELEMENT_SORT_ORDER2" => "desc",    // Порядок второй сортировки элементов
                "FILTER_NAME" => "recomendFilter_1",    // Имя массива со значениями фильтра для фильтрации элементов
                "INCLUDE_SUBSECTIONS" => "Y",   // Показывать элементы подразделов раздела
                "SHOW_ALL_WO_SECTION" => "Y",   // Показывать все элементы, если не указан раздел
                "PAGE_ELEMENT_COUNT" => "4",    // Количество элементов на странице
                "LINE_ELEMENT_COUNT" => "4",    // Количество элементов выводимых в одной строке таблицы
                "PROPERTY_CODE" => array(   // Свойства
                    0 => "picture_type",
                    15 => "ARTNUMBER",
                    16 => "MANUFACTURER",
                    17 => "COLLECTION_REF",
                    19 => "strana",
                ),
                "OFFERS_LIMIT" => "5",  // Максимальное количество предложений для показа (0 - все)
                "ADD_PICT_PROP" => "-", // Дополнительная картинка основного товара
                "LABEL_PROP" => "-",    // Свойство меток товара
                "PRODUCT_SUBSCRIPTION" => "N",  // Разрешить оповещения для отсутствующих товаров
                "SHOW_DISCOUNT_PERCENT" => "N", // Показывать процент скидки
                "SHOW_OLD_PRICE" => "Y",    // Показывать старую цену
                "MESS_BTN_BUY" => "Купить", // Текст кнопки "Купить"
                "MESS_BTN_ADD_TO_BASKET" => "Купить",   // Текст кнопки "Добавить в корзину"
                "MESS_BTN_SUBSCRIBE" => "Подписаться",  // Текст кнопки "Уведомить о поступлении"
                "MESS_BTN_DETAIL" => "Подробнее",   // Текст кнопки "Подробнее"
                "MESS_NOT_AVAILABLE" => "Нет в наличии",    // Сообщение об отсутствии товара
                "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
                "DETAIL_URL" => "", // URL, ведущий на страницу с содержимым элемента раздела
                "SECTION_ID_VARIABLE" => "SECTION_ID",  // Название переменной, в которой передается код группы
                "AJAX_MODE" => "N", // Включить режим AJAX
                "AJAX_OPTION_JUMP" => "N",  // Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "N", // Включить подгрузку стилей
                "AJAX_OPTION_HISTORY" => "N",   // Включить эмуляцию навигации браузера
                "CACHE_TYPE" => "A",    // Тип кеширования
                "CACHE_TIME" => "36000000", // Время кеширования (сек.)
                "CACHE_GROUPS" => "Y",  // Учитывать права доступа
                "SET_META_KEYWORDS" => "N", // Устанавливать ключевые слова страницы
                "META_KEYWORDS" => "-", // Установить ключевые слова страницы из свойства
                "SET_META_DESCRIPTION" => "N",  // Устанавливать описание страницы
                "META_DESCRIPTION" => "-",  // Установить описание страницы из свойства
                "BROWSER_TITLE" => "-", // Установить заголовок окна браузера из свойства
                "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                "DISPLAY_COMPARE" => "N",
                "SET_TITLE" => "N", // Устанавливать заголовок страницы
                "SET_STATUS_404" => "N",    // Устанавливать статус 404
                "CACHE_FILTER" => "Y",  // Кешировать при установленном фильтре
                "PRICE_CODE" => array(  // Тип цены
                    0 => "BASE",
                ),
                "USE_PRICE_COUNT" => "N",   // Использовать вывод цен с диапазонами
                "SHOW_PRICE_COUNT" => "1",  // Выводить цены для количества
                "PRICE_VAT_INCLUDE" => "Y", // Включать НДС в цену
                "CONVERT_CURRENCY" => "Y",  // Показывать цены в одной валюте
                "CURRENCY_ID" => "RUB", // Валюта, в которую будут сконвертированы цены
                "BASKET_URL" => $arParams["BASKET_URL"],    // URL, ведущий на страницу с корзиной покупателя
                "ACTION_VARIABLE" => "action",  // Название переменной, в которой передается действие
                "PRODUCT_ID_VARIABLE" => "id",  // Название переменной, в которой передается код товара для покупки
                "USE_PRODUCT_QUANTITY" => "N",  // Разрешить указание количества товара
                "ADD_PROPERTIES_TO_BASKET" => "N",  // Добавлять в корзину свойства товаров и предложений
                "PAGER_TEMPLATE" => ".default", // Шаблон постраничной навигации
                "DISPLAY_TOP_PAGER" => "N", // Выводить над списком
                "DISPLAY_BOTTOM_PAGER" => "N",  // Выводить под списком
                "PAGER_TITLE" => "Товары",  // Название категорий
                "PAGER_SHOW_ALWAYS" => "N", // Выводить всегда
                "PAGER_DESC_NUMBERING" => "N",  // Использовать обратную навигацию
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",   // Время кеширования страниц для обратной навигации
                "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
                "AJAX_OPTION_ADDITIONAL" => "", // Дополнительный идентификатор
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",  // Название переменной, в которой передается количество товара
                "PRODUCT_PROPS_VARIABLE" => "prop", // Название переменной, в которой передаются характеристики товара
                "PARTIAL_PRODUCT_PROPERTIES" => "N",    // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
                "PRODUCT_PROPERTIES" => array(  // Характеристики товара
                ),
                "COMPONENT_TEMPLATE" => ".default",
                "HIDE_NOT_AVAILABLE" => "N",    // Не отображать товары, которых нет на складах
                "TEMPLATE_THEME" => "blue", // Цветовая тема
                "SHOW_CLOSE_POPUP" => "N",  // Показывать кнопку продолжения покупок во всплывающих окнах
                "MESS_BTN_COMPARE" => "Сравнить",   // Текст кнопки "Сравнить"
                "SEF_MODE" => "N",  // Включить поддержку ЧПУ
                "SET_BROWSER_TITLE" => "N", // Устанавливать заголовок окна браузера
                "SET_LAST_MODIFIED" => "N", // Устанавливать в заголовках ответа время модификации страницы
                "USE_MAIN_ELEMENT_SECTION" => "N",  // Использовать основной раздел для показа элемента
                "ADD_TO_BASKET_ACTION" => "ADD",    // Показывать кнопку добавления в корзину или покупки
                "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
                "SHOW_404" => "N",  // Показ специальной страницы
                "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
            ),
                $component,
                array("HIDE_ICONS"=>"Y")
            );
            ?>
                <span class="clear"></span>
                <span class="clear"></span>
            </section>
        </section>

        <section class="catalog-item-similar catalog-item-similar-css">
            <div class="catalog_simmilar_text">Другие коллекции из <?=$arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"];?>:</div>
            <section class="catalog-cols">
                <?
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
<? //endif;?>
                <span class="clear"></span>
                <span class="clear"></span>
            </section>
        </section>



        <section class="garantyy-blocks">
            <div class="garantyy-blocks-div garantyy-blocks-div-4">
            <p class="garantyy-description__tag"><?if($arResult['TAGS']){?><?=$arResult['TAGS'];?><?}?></p>
            </div>
            <div class="garantyy-blocks-div garantyy-blocks-div-1">
                <img alt="Гарантия оплаты" class="garantyy-img" src="/images/garantee-star.png">
                <p class="garantyy-under-img">Как оплатить<br>раковину</p>
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
            </div>
            <div class="garantyy-blocks-div garantyy-blocks-div-2">
                <img alt="Гарантия получения товара" class="garantyy-img" src="/images/garantee-arrow.png">
                <p class="garantyy-under-img">Как получить<br>раковину</p>
                <p class="garantyy-description pad0">Доставка по Москве и Московской области Доставка по России Доставка в республики «ЕАЭС»</p>
                <ul>
                    <li>Республика Армения;</li>
                    <li>Республика Беларусь;</li>
                    <li>Республика Казахстан;</li>
                    <li>Кыргызская Республика.</li>
                </ul>
                <p class="garantyy-description pad0">Купленный товар застрахован!</p>
            </div>
            <div class="garantyy-blocks-div garantyy-blocks-div-3">
                <img alt="Гарантия производителя" class="garantyy-img" src="/images/garantee-like.png">
                <p class="garantyy-under-img">Гарантия на продукцию<br>AeT</p>
                <p class="garantyy-description">Компания «Среда Обитания» устанавливает гарантийный срок 12 месяцев на всю продукцию «AeT».<br>Гарантия предоставляется покупателям, осуществившим монтаж квалифицированным сервисом. Замена неисправного элемента или всей части товара, осуществляется в разумные сроки, предусмотренным договором оказании услуг.
                </p>
            </div>
        </section>

<?//d($arResult)?>
<?//d($arResult)?>