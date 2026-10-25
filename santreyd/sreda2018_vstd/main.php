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
?>
<?global $USER;if ($USER->IsAdmin()){?>
	<script>
	console.log('/local/components/5corners/brands/templates/.default/main.php');	
	</script>
<?}?>
<?$APPLICATION->IncludeComponent(
	"5corners:catalog.section.list", 
	"partners-main", 
	array(
		"COMPONENT_TEMPLATE" => "partners-main",
		"IBLOCK_TYPE" => "references",
		"IBLOCK_ID" => "4",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"FILTER" => array('UF_LANDING'=>1),
		"COUNT_ELEMENTS" => "N",
		"COUNT" => 12,
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"VIEW_MODE" => "TILE",
		"SHOW_PARENT_NAME" => "N",
		"SECTION_URL" => "",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "36000",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_SECTION_NAME" => "N",
		"BECOME_PARTNER" =>'Y'
	),
	false,
	array("HIDE_ICONS"=>"Y")
);



$brandFilter = array();
	
	//Дёргаем секции и кешируем
	$obCache = new CPHPCache();
	$arFilter = array('IBLOCK_ID'=>2, 'GLOBAL_ACTIVE'=>'Y', 'DEPTH_LEVEL'=>2);
	if ($obCache->InitCache(36000, serialize($arFilter), "/brands/partners/"))
	{
		$CATEGORIES = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		$arSelect = array('ID', 'NAME');
		$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, $arSelect);
		while ($arSection = $rsSections->Fetch())
		{
		  $CATEGORIES[$arSection['ID']] = $arSection;
		}
		$obCache->EndDataCache($CATEGORIES);
	}
	//Финиш кеширования
	
if(isset($_REQUEST['clear']) and $_REQUEST['clear']=='Y'){
	$brandFilter = array();
}else{
	
	//Фильтр по названию
	if(isset($_REQUEST['name']) and !empty($_REQUEST['name']) and $_REQUEST['name'] != 'name'){
		$request_name = htmlspecialchars($_REQUEST['name']);
		$brandFilter['?NAME'] = $request_name;
	}		
	
	//Указываем активный раздел
	if(isset($_REQUEST['category']) && !empty($_REQUEST['category']) &&  isset($CATEGORIES[intval($_REQUEST['category'])])){
		$category_id = intval($_REQUEST['category']);
		$CATEGORIES[$category_id]['ACTIVE'] = true;
		
		$arrSelect = Array("ID", "IBLOCK_ID", "PROPERTY_MANUFACTURER");
		$arrFilter = Array(
			"IBLOCK_ID"=>IntVal(2), 
			"ACTIVE_DATE"=>"Y", 
			"ACTIVE"=>"Y", 
			"SECTION_ID"=>$category_id, 
			"INCLUDE_SUBSECTIONS"=>"Y"
		);
		
		$obCache2 = new CPHPCache();
		if ($obCache2->InitCache(36000, serialize($arrFilter), "/brands/partners/"))
		{
			$BRAND_IDS = $obCache2->GetVars();
		}
		elseif ($obCache2->StartDataCache())
		{
			$res = CIBlockElement::GetList(Array(), $arrFilter, false, false, $arrSelect);
			while($arElement = $res->GetNext())
			{
			 	$BRAND_IDS[$arElement['PROPERTY_MANUFACTURER_VALUE']] = $arElement['PROPERTY_MANUFACTURER_VALUE'];
			}
			$obCache2->EndDataCache($BRAND_IDS);
		}
		if (isset($BRAND_IDS))
		{	
			$brandFilter['ID'] = $BRAND_IDS;
		}	
	}	
	
}; //Финиш условия фильтра


?>

<section class="catalog-nav">
            <div class="catalog-nav__open-catalog" id="open_catalog"><span>Каталог товаров</span></div>
            <div class="catalog-nav-all">
                <span class="catalog-nav-href"><a href="<?=$APPLICATION->GetCurPageParam("clear=Y", array("name", "category", "PAGEN_2")); ?>">Все бренды</a></span>
            </div>
            <div class="catalog-nav-search">
                <div class="catalog-nav-search_text">
                    Поиск бренда (по имени | по группам товаров)
                </div>
                <div class="catalog-nav-search_form">
                	<form action="#" method="get" id="filter_form">
                	<input type="text" class="_name" placeholder="Введите наименование бренда" name="name" value="<?=$request_name ? $request_name : ''?>">
                    <select name="category" id="" class="_type" onchange="$('#filter_form').submit(); return false;">
                        <option value="">Фильтр групп товаров (выкл.)</option>
                        <?foreach($CATEGORIES as $category):?>
							<option value="<?=$category['ID']?>"<?= $category['ACTIVE'] ? ' selected' : ''?>><?=$category['NAME']?></option>
						<?endforeach?>
                    </select>
                	</form>
                </div>
            </div>


            <div class="clear"></div>
        </section>

<?$APPLICATION->IncludeComponent(
	"5corners:catalog.section.list", 
	"partners-all", 
	array(
		"COMPONENT_TEMPLATE" => "partners-all",
		"IBLOCK_TYPE" => "references",
		"IBLOCK_ID" => "4",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"FILTER" => $brandFilter,
		"COUNT_ELEMENTS" => "N",
		"COUNT" => 20,
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_ADDRESS",
			1 => "",
		),
		"VIEW_MODE" => "TILE",
		"SHOW_PARENT_NAME" => "N",
		"SECTION_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000",
		"CACHE_GROUPS" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_SECTION_NAME" => "N",
		"BECOME_PARTNER" =>'Y',
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Бренды",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "N",
		
	),
	false,
	array("HIDE_ICONS"=>"Y")
);?>

<? if (CModule::IncludeModule("iblock")) {
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