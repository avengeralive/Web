<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

global $USER;
$arGroupAvalaible = array(1,7,10,12);
$arGroups = CUser::GetUserGroup($USER->GetID());
$result_intersect = array_intersect($arGroupAvalaible, $arGroups);
$template = 'bxmaker_ajaxpagenav_default';
if(empty($result_intersect)){
// постраничная с подгрузкой
	CModule::IncludeModule('bxmaker.ajaxpagenav');
	$context = \BXmaker\Ajaxpagenav\Manager::getInstance()->getContext('catalog-cols');
}	
// постраничная с подгрузкой - конец

$this->setFrameMode(true);

//custom prices
?>
<?/*	<div class="bread">
		<?
			foreach($arResult['PATH'] as $path):?>

					<?if($path['ID'] == $arResult['ID']):?>
						<?if(count($arResult['PATH'])>1){?><span class="bread-divider">></span><?}?> <span><?=$path['NAME']?></span>
					<?else:?>
						<a href="<?=$path['SECTION_PAGE_URL']?>"><?=$path['NAME']?></a>
					<?endif;?>
				<?endforeach?>
	</div>*/?>
<?

if (!empty($arResult['ITEMS']))
{
?>
	<?/*<h2><?=$arResult['NAME']?></h2>*/?>
<?
	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
	// echo '<pre>';print_r($arParams);echo '</pre>';
?>
<?
// номер текущей страницы
$curPage = $arResult["NAV_RESULT"]->NavPageNomer;
// всего страниц - номер последней страницы
$totalPages = $arResult["NAV_RESULT"]->NavPageCount;
// номер постраничной навигации на странице
$navNum = $arResult["NAV_RESULT"]->NavNum;
if(empty($result_intersect)){
	?>
<script>
$(window).scroll(function(){
	// var itm = 4;
	// if($(window).width() < 1000)
		// itm = 2;
	// if($(window).width() < 550)
		// itm = 1;
	
	// var hei = $('.catalog-item').outerHeight(true)*($('.catalog-item').length/itm);
	// if($(window).scrollTop() > hei){
		// window.BXmakerAjaxpagenav.showMore('catalog-cols');
	// }
	var itemFromTop = $('.catalog-item:last').offset().top;
	if($(window).scrollTop() +$(window).height() > itemFromTop){
		window.BXmakerAjaxpagenav.showMore('catalog-cols');
	}
	
	// if($('.js-bxmaker__ajaxpagenav__block-showmore').length && $(window).scrollTop() > itemFromTop){
		// $(window).scrollTop(itemFromTop);
	// }
	// if($('.js-bxmaker__ajaxpagenav__block-showmore').length && $(window).scrollTop() + $(window).height() - $('.catalog-item:last').height()-200 > itemFromTop){
		// $(window).scrollTop(itemFromTop - $(window).height() + $('.catalog-item:last').height()+200);
	// }
});
</script>

<!--<section class="catalog-cols <?=$context->getBlockClassName('content');?>">-->
<section class="catalog-cols">
	<div class="catalog-col">
<?=$context->beginBlock('content');?>
<?}
else{?>
<section class="catalog-cols">
	<div class="catalog-col">
<?}?>

<?foreach ($arResult['ITEMS'] as $key => $arItem)
{
	$CNT++;
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);

	$arItemIDs = array(
		'ID' => $strMainID,
		'PICT' => $strMainID.'_pict',
		'SECOND_PICT' => $strMainID.'_secondpict',
		'STICKER_ID' => $strMainID.'_sticker',
		'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
		'QUANTITY' => $strMainID.'_quantity',
		'QUANTITY_DOWN' => $strMainID.'_quant_down',
		'QUANTITY_UP' => $strMainID.'_quant_up',
		'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
		'BUY_LINK' => $strMainID.'_buy_link',
		'BASKET_ACTIONS' => $strMainID.'_basket_actions',
		'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
		'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
		'COMPARE_LINK' => $strMainID.'_compare_link',

		'PRICE' => $strMainID.'_price',
		'DSC_PERC' => $strMainID.'_dsc_perc',
		'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
		'PROP_DIV' => $strMainID.'_sku_tree',
		'PROP' => $strMainID.'_prop_',
		'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
		'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
	);

	$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

	$productTitle = (
		isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $arItem['NAME']
	);
	$imgTitle = (
		isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']
		: $arItem['NAME']
	);

	$minPrice = false;
	if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
		$minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
	?>
	<?
// на проверке промо баннер	
	if($CNT%4 == 1) {
		?>
			</div><div class="catalog-col">
		<?
	}
	
	if($CNT==2 && $arResult['NAV_RESULT']->NavPageNomer==1 && !empty($arResult['PROMO']["PICTURE"])): $CNT+=2;
	
	?>
		<div class="catalog-item catalog-item-promo with-color-hover">
			<div class="catalog-item-img">
				<img src="<?=$arResult['PROMO']["PICTURE"]?>" alt="<?=$arResult['PROMO']["H1"]?>" />
			</div>
			<span class="second-slider-text">
<?if($arResult['PROMO']["H1"]){?>				
				<span class="second-slider-text-header with-line">
					<h1><?=$arResult['PROMO']["H1"]?></h1>
				</span>
<?}?>					
				<span class="h1"><?=$arResult['PROMO']["DESCRIPTION"]?></span>
			</span>
		</div>
	
<?
// на проверке промо баннер - конец

?>	
	<?elseif(false && $CNT==2 && $arResult['NAV_RESULT']->NavPageNomer==1 && !empty($arResult['PRODUCT_MONTH'])): $CNT+=2;
	
	?>
		<div class="catalog-item catalog-item-promo with-color-hover">
			<div class="catalog-item-img">
				<img src="<?=$arResult['PROMO']["PICTURE"]?>" alt="<?=$arResult['PROMO']["H1"]?>" />
			</div>
			<span class="second-slider-text">
<?if($arResult['PROMO']["H1"]){?>				
				<span class="second-slider-text-header with-line">
					<h1><?=$arResult['PROMO']["H1"]?></h1>
				</span>
<?}?>					
				<span class="h1"><?=$arResult['PROMO']["DESCRIPTION"]?></span>
			</span>
		</div>
	<?elseif($CNT==9 /*&& $arResult['NAV_RESULT']->NavPageNomer==1*/ && !empty($arResult['POPULAR'])): $CNT+=2;?>
		<?
			$pop_cnt = 0;
			$half = intval(count($arResult['POPULAR'])/2);
		?>
		<div class="catalog-col-popular">
			<p class="h2">Категории товара</p>
			<div class="catalog-col-popular-col">
				<?foreach($arResult['POPULAR'] as $popular): $pop_cnt++;
						if($popular["ELEMENT_CNT"] > 0){
				?>
<?if(strpos($APPLICATION->GetCurPage(false),'/catalog/santehnika/vanna/') !== false || strpos($APPLICATION->GetCurPage(false),'/catalog/santehnika/smesiteli/') !== false){?>
					<p class="oh2"><a href="<?=$popular['SECTION_PAGE_URL']?>"><?=$popular['NAME']?></a></p>
<?}else{?>					
					<h2><a href="<?=$popular['SECTION_PAGE_URL']?>"><?=$popular['NAME']?></a></h2>
<?}?>					
					<?= $half==$pop_cnt ? '</div><div class="catalog-col-popular-col">' : ''?>
						<?}
					endforeach;?>
			</div>
			<span class="clear"></span>
		</div>
	<?endif;?>


	<div class="catalog-item" id="<?=$strMainID; ?>">
		<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="catalog-item-a"></a>
			<div class="catalog-item-img with-gold-hover<?=$arItem['LABEL_CLASS']?>">
				<img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$imgTitle;?>" />
				<div class="catalog-item-img-text">
					<p class="h2"><?=$arItem['BRAND']?></p>
					<p><?=$arItem['COUNTRY']?></p>
				</div>
			</div>
			<div class="catalog-item-text" title="<?=$productTitle;?>">
				<a data-action="delay" data-item="<?=$arItem["ID"]?>" href="javascript:void(0)" class="crazy-grid__heart-btn favourite-button item-favourite">в избранное</a>
				<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="catalog-item-text-header"><?=$productTitle;?></a><br/>
				<p class="catalog-item-text-price">
				<?
					$prices = getProductPricesCustom($arItem["ID"]);
					//ppp($prices,"prices");
					//[basePrice] => 419619
					//[finalBasketPrice] => 251771
					//[priceWithMargin] => 629428
					//$boolDiscountShow = ($prices["priceWithMargin"] > $prices["finalBasketPrice"]);
					if (!empty($prices["finalBasketPrice"]))
					{
						if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])){
							echo GetMessage(
								'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
								array(
									'#PRICE#' => $minPrice['PRINT_DISCOUNT_VALUE'],
									'#MEASURE#' => GetMessage(
										'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
										array(
											'#VALUE#' => $minPrice['CATALOG_MEASURE_RATIO'],
											'#UNIT#' => $minPrice['CATALOG_MEASURE_NAME']
										)
									)
								)
							);
						}
						else
						{
							echo $prices["finalBasketPriceF"];
						}
						if ('Y' == $arParams['SHOW_OLD_PRICE'] && $prices['finalBasketPrice'] < $prices['priceWithMargin']){
							echo '<span class="old_price">'.$prices['priceWithMarginF'].'</span>';
						}
					}
					unset($prices);

					/* default price block
					if (!empty($minPrice))
					{
						if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])){
							echo GetMessage(
								'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
								array(
									'#PRICE#' => $minPrice['PRINT_DISCOUNT_VALUE'],
									'#MEASURE#' => GetMessage(
										'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
										array(
											'#VALUE#' => $minPrice['CATALOG_MEASURE_RATIO'],
											'#UNIT#' => $minPrice['CATALOG_MEASURE_NAME']
										)
									)
								)
							);
						}
						else
						{
							echo $minPrice['PRINT_DISCOUNT_VALUE'];
						}
						if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']){
							echo '<span class="old_price">'.$minPrice['PRINT_VALUE'].'</span>';
						}
					}
					unset($minPrice);
					*/
				?>
<?/*					<a class="button_one_click_buy " rel="nofollow" onclick="oneClickBuy('<?=$arItem["ID"]?>', '<?=$arItem["IBLOCK_ID"]?>', '<?=$strObName?>')"><span>Покупаю</span></a> */?>
				</p>

			</div>
			<?//d($arItem['DISPLAY_PROPERTIES'])?>
		</div>
		<?//=$CNT%$arParams['LINE_ELEMENT_COUNT']==0?'<span class="clear"></span>':''?>


<?}?>
<?if(empty($result_intersect)){?>
	<?=$context->endBlock('content');?>
<?}?>
	</div>	
</section>
	<section class="catalog-numbers">
		<?if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
			<?if(empty($result_intersect)) { ?>			
				<div class="paginator <?=$context->getBlockClassName('navbottom');?>">
				   <?=$context->beginBlock('navbottom');?>
				   <?=$arResult['NAV_STRING'];?>
				   <?=$context->endBlock('navbottom');?>
				</div>
			<?} else {?>
				<div class="paginator">
   					<?=$arResult['NAV_STRING'];?>
				</div>
			<?}?>
		<? } ?>
		<div class="catalog-numbers-all">
			<p class="catalog-numbers-all">Всего в разделе <?=number_format($arResult['NAV_RESULT']->NavRecordCount, 0, '', ' ');?> <?=pluralForm($arResult['NAV_RESULT']->NavRecordCount, 'товар', 'товара', 'товаров');?></p>
		</div>
		<?if(!empty($arResult['DESCRIPTION']) and $arResult['NAV_RESULT']->PAGEN < 2 and !isset($_REQUEST['set_filter'])):
			if($arResult['ALT_NAME']){?>
				<div class="catalog-numbers-promo">
					<h1 class="h1_centered"><?=$arResult['ALT_NAME']?></h1>
				</div>
			<?}?>
			<?if(!$arResult["ALT_DESCRIPTION"]){?>
				<div class="catalog-numbers-promo">
			<?}?>
			<? //=$arResult['DESCRIPTION'];?>
			<?
if (CModule::IncludeModule("iblock")) {
    $arFilter = array(
        "IBLOCK_ID" => 42, // инфоблок Шахматный текст
        "ACTIVE" => "Y",
        "ID" => 437213, // Префутер на главной
    );
    $dbEl = CIBlockElement::GetList(Array(), $arFilter, false, false, Array('ID', 'IBLOCK_ID', 'NAME', 'ALT_*'));
    if($obEl = $dbEl->GetNextElement()) {
        $arSect = $obEl->GetProperties();
    }
    for($cou = 1; $cou < 4; $cou++){
        $title = $pic = $alt = $text = '';
        if ($arSect['ALT_ALT_' . $cou]['VALUE']) {
            $alt = $arSect['ALT_ALT_' . $cou]['~VALUE'];
        }
        if ($arSect['ALT_TITLE_' . $cou]['VALUE']) {
            $title = '<h3>' . $arSect['ALT_TITLE_' . $cou]['~VALUE'] . '</h3>';
        }
        if ($arSect['ALT_PICTURE_' . $cou]['VALUE']) {
            $pic = '<img src="'.CFile::GetPath($arSect['ALT_PICTURE_' . $cou]['VALUE']).'" alt="' . $alt . '" title="' . $alt . '" />';
        }
        if ($arSect['ALT_TEXT_' . $cou]['VALUE']['TEXT']) {
            $text = $arSect['ALT_TEXT_' . $cou]['~VALUE']['TEXT'];
        }
        if($title || $pic || $text) {
            $descr .= '<div class="s-loft__item"><div class="s-loft__img">' . $pic . '</div><div class="s-loft__content">' . $title . $text . '</div></div>';
        }
    }
}
?>
        <section class="s-loft">
            <h2>Популярное предложение</h2>
            <div class="s-loft-wrap">
                <?= $descr; ?>
            </div>
        </section>
			<?if(!$arResult["ALT_DESCRIPTION"]){?>
				</div>
			<?}?>
		<?endif;?>
	</section>
	
<?if(isset($_REQUEST["set_filter"])){?>
	<div class="under_catalog_filter_info">Для более удобного поиска товаров на сайте "Среда Обитания", мы запустили бета-версию фильтра с конфигурацией продукции по цвету, стилю, типу материала и установки, а также по наличию представленных изделий. На данный момент нововведение лишь тестируется и фильтр не всегда показывает все доступные товары, тогда как, на самом деле, их количество гораздо больше.</div>
<?}?>
	<?//print_r($arResult['SECTION'])?>
	<?//d($arResult['PATH'])?>
	<?//d($arResult['NAV_RESULT']->PAGEN)?>
<?} // ITEMS?>