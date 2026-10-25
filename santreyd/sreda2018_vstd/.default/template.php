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
$this->setFrameMode(true);
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>

<?if (0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
?>	

<section id="<?=$this->GetEditAreaId($arResult['SECTION']['ID']);?>" class="b_partner_brand"<?if(!empty($arResult['SECTION']['DETAIL_PICTURE']['SRC'])):?> style="background-image: url(<?=$arResult['SECTION']['DETAIL_PICTURE']['SRC']?>);"<?endif?>>
	<div class="_layer"> 
		<?if(!empty($arResult['SECTION']['PICTURE']['SRC'])):?>
		<img src="<?=$arResult['SECTION']['PICTURE']['SRC']?>" height="<?=$arResult['SECTION']['PICTURE']['height']?>" width="<?=$arResult['SECTION']['PICTURE']['width']?>" alt="<?
		echo (
			isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
			? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
			: $arResult['SECTION']['NAME']
		);
	?>" class="_logo">
		<?endif?>
		<div class="_name">
			<h2><?=$arResult['SECTION']['NAME']?> <?=$arResult['COLLECTION']['NAME']?></h2>
			<?if(!empty($arResult['SECTION']['COUNTRY'])):?>
			<div class="country">
				<span class="phoca-flag <?=strtolower($arResult['SECTION']['COUNTRY']['CODE'])?>"></span>
				<?=$arResult['SECTION']['COUNTRY']['NAME']?>
			</div>
			<?endif?>
		</div>
		<div class="_data">
			<?if(!empty($arResult['SECTION']['UF_ADDRESS'])):?>
				<div class="_addr"><?=$arResult['SECTION']['UF_ADDRESS']?></div>
			<?endif?>
			
			<?if(!empty($arResult['SECTION']['UF_EMAIL'])):?>
				<a href="mailto:<?=$arResult['SECTION']['UF_EMAIL']?>" class="_mail"><?=$arResult['SECTION']['UF_EMAIL']?></a>
			<?endif?>
			
			<?if(!empty($arResult['SECTION']['UF_PHONE'])):?>
				<a href="tel:<?=$arResult["SECTION"]["UF_CLEAR_PHONE"]?>" class="_tel"><?=$arResult['SECTION']['UF_PHONE']?></a>
			<?endif?>
			
			<?if(!empty($arResult['SECTION']['UF_SITE'])):?>
				<a href="http://<?=$arResult['SECTION']['UF_SITE']?>" class="_web" target="_blank"><?=$arResult['SECTION']['UF_SITE']?></a>
			<?endif?>
		</div>
	</div>
	</section>

<?if(!empty($arResult['TOP_MENU'])):?>

	<section class="b_partner_brand_tabs">
		<?foreach($arResult['TOP_MENU'] as $item):?>
			<a href="<?=$item['LINK']?>" class="_item<?= $item['ACTIVE'] ? ' -active' : ''?>"><?=$item['NAME']?></a>
		<?endforeach?>
	</section>

<?endif;?>
	
<?}?>


<?if('brand_about' == $arResult['PAGE']): // brand_about ================================================= ?>

	<div class="b_partner_about">
		<?=$arResult['SECTION']['DESCRIPTION']?>
	</div>
	
<?elseif('brand_contacts' == $arResult['PAGE']): // brand_contacts ======================================= ?>

	<div class="b_partners_contacts">
		
		<?if(!empty($arResult['SECTION']['UF_LAT']) && !empty($arResult['SECTION']['UF_LON'])):?>
		<div id="map" class="_map" data-lat="<?=$arResult['SECTION']['UF_LAT']?>" data-lon="<?=$arResult['SECTION']['UF_LON']?>"></div>
		<?endif;?>
		
		<?if(!empty($arResult['SECTION']['UF_ADDRESS']) || 
				 !empty($arResult['SECTION']['UF_PHONE']) || 
				 !empty($arResult['SECTION']['UF_MAIL'])
				):
		?>
		<div class="_info">
			<?if(!empty($arResult['SECTION']['UF_ADDRESS'])):?>
			<div class="_col">
				<div class="_addr">
					<?=$arResult['SECTION']['~UF_ADDRESS']?>
				</div>
			</div>
			<?endif;?>
			<?if(!empty($arResult['SECTION']['UF_PHONE'])):?>
			<div class="_col">
				<div class="_tel">
					<a href="tel:<?=$arResult["SECTION"]["UF_CLEAR_PHONE"]?>"><?=$arResult['SECTION']['~UF_PHONE']?></a>
				</div>
			</div>
			<?endif;?>
			<?if(!empty($arResult['SECTION']['UF_EMAIL'])):?>
			<div class="_col">
				<div class="_web">
					<a href="mailto:<?=$arResult['SECTION']['UF_EMAIL']?>"><?=$arResult['SECTION']['UF_EMAIL']?></a>
				</div>
			</div>
			<?endif;?>
		</div>
		<?endif?>
		
		<?if(!empty($arResult['PEOPLES'])): $people_i=0;?>
		<div class="_people">
			<div class="_row">
				<?foreach($arResult['PEOPLES'] as $people): $people_i++;?>
				<div class="_person">
					<?if(!empty($people['PICTURE'])):?>
					<img src="<?=$people['PICTURE']['SRC']?>" height="100<?//=$people['PICTURE']['height']?>" width="100<?//=$people['PICTURE']['width']?>" alt="<?=$people['NAME']?>" class="_img">
					<?endif;?>
					<div class="_occupation"><?= $people['POST'] ? $people['POST'].':' : ''?></div>
					<div class="_text">
						<?=$people['NAME']?><br>
						<?if(!empty($people['EMAIL'])):?>e-mail: <a href="mailto:<?=$people['EMAIL']?>"><?=$people['EMAIL']?></a><?endif?>
					</div>
				</div>
				
				<?= $people_i%2==0 ? '</div><div class="_row">' : ''?>
				
				<?endforeach;?>
			</div>
		</div>
		<?endif;?>
		
		<?$APPLICATION->IncludeFile("/ajax/partner_order.php", Array(), Array("MODE"=>'php', "SHOW_BORDER"=>false));?>
		
	</div>

<?elseif(in_array($arResult['PAGE'], array('brand_feed', 'brand_news', 'brand_blog', 'brand_stock'))):?>

<?
	global $arFeedFilter;
	$arFeedFilter = array('PROPERTY_BRAND'=> $arResult['SECTION']['ID']);
	$IBLOCK_TYPES = '';
	
	if($arResult['PAGE'] == 'brand_news'){
		$IBLOCKS = 1;
	}elseif($arResult['PAGE'] == 'brand_blog'){
		$IBLOCKS = 9;
	}elseif($arResult['PAGE'] == 'brand_stock'){		
		$IBLOCKS = 25;
	}else{
		$IBLOCKS = array(1, 9, 25);
		$IBLOCK_TYPES = array('news', 'blog', 'stock');
	}
?>

<??>

<div class="b_partner_brand_feed">
	
	<?if(!empty($arResult['LEFT_MENU'])):?>
	<div class="_filter">
		<?foreach($arResult['LEFT_MENU'] as $item):?>
			<a href="<?=$item['LINK']?>" class="_item<?= $item['ACTIVE'] ? ' -active' : ''?>"><?=$item['NAME']?></a>
		<?endforeach?>
		
		<?if(!empty($arResult['SECTION']['CERTIFICATES'])):?>
			<ul class="b_partner_certificates">
				<?foreach($arResult['SECTION']['CERTIFICATES'] as $certificate):?>
					<li>
						<a class="fancy" rel="certificates" href="<?=$certificate['BIG_SRC']?>">
							<img src="<?=$certificate['SRC']?>" width="<?=$certificate['width']?>" height="<?=$certificate['height']?>"></a>
						</a>
					</li>
				<?endforeach?>		
			</ul>
		<?endif?>
	</div>
	<?endif;?>

	
	<?$APPLICATION->IncludeComponent(
	"5corners:feed.list", 
	"partners-feed", 
	array(
		"COMPONENT_TEMPLATE" => "partners-feed",
		"IBLOCK_TYPE" => $IBLOCK_TYPES,
		"IBLOCK_ID" => $IBLOCKS,
		"IBLOCK_IDS" => $IBLOCKS,
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arFeedFilter",
		"FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "GALLERY",
			1 => "BRAND",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "200",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
	),
	$component
);?>
	
</div><?// .b_partner_brand_feed?>

	
<?elseif(in_array($arResult['PAGE'], array('brand', 'brand_category_collection'))):?>

<?endif?>

