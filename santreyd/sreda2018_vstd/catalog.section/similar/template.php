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
$this->setFrameMode(true);


if (!empty($arResult['ITEMS']))
{
	//include('sku_props.php');
?>

<?if ($arParams["DISPLAY_TOP_PAGER"]){?><? echo $arResult["NAV_STRING"]; ?><?}?>

<?
	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>
<? if(empty($result_intersect)){
// постраничная с подгрузкой
	CModule::IncludeModule('bxmaker.ajaxpagenav');
	$context = \BXmaker\Ajaxpagenav\Manager::getInstance()->getContext('catalog-cols');
}	?>
<?if ($arParams["DISPLAY_TOP_PAGER"]){?>
		<div class="catalog-numbers-all-top">
			<p>Всего <?=pluralForm($arResult['NAV_RESULT']->NavRecordCount, 'найден', 'найдено', 'найдено');?> <?=number_format($arResult['NAV_RESULT']->NavRecordCount, 0, '', ' ');?> <?=pluralForm($arResult['NAV_RESULT']->NavRecordCount, 'товар', 'товара', 'товаров');?></p>
		</div>
<?}?>
<style>.catalog-item-similar .catalog-col { margin-bottom: 0px; } .catalog-numbers-all { display: none; }</style>
<section class="catalog-cols">
	<div class="catalog-col">

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
	
	?>


	<div class="catalog-item" id="<?=$strMainID; ?>">
		<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="catalog-item-a">
			<div class="catalog-item-img with-gold-hover<?=$arItem['LABEL_CLASS']?>">
				<img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$imgTitle;?>" />
				<div class="catalog-item-img-text">
					<p class="h2"><?=$arItem['BRAND']?></p>
					<p><?=$arItem['COUNTRY']?></p>
				</div>
			</div></a>
			<div class="catalog-item-text" title="<?=$productTitle;?>">
				<a data-action="delay" data-item="<?=$arItem["ID"]?>" href="javascript:void(0)" class="crazy-grid__heart-btn favourite-button item-favourite">в избранное</a>
				<a class="button_one_click_buy gradient js-btn-buy-product" data-item="<?=$arItem["ID"]?>" rel="nofollow"><span>Покупаю</span></a>
				<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="catalog-item-text-header"><?=$productTitle;?></a>
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