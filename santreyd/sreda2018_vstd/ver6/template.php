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
<?
//$arElements=$APPLICATION->IncludeComponent("bitrix:search.page", "search_page", Array(
//	"RESTART" => "Y",	// Искать без учета морфологии (при отсутствии результата поиска)
//		"NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],	// Отключить обработку слов как логических операторов
//		"USE_LANGUAGE_GUESS" => "N",	// Включить автоопределение раскладки клавиатуры
//		"CHECK_DATES" => $arParams["CHECK_DATES"],	// Искать только в активных по дате документах
//		"arrFILTER" => array(	// Ограничение области поиска
//			0 => "iblock_".$arParams["IBLOCK_TYPE"],
//		),
//		"={\"arrFILTER_iblock_\".\$arParams[\"IBLOCK_TYPE\"]}" => array(
//			0 => $arParams["IBLOCK_ID"],
//		),
//		"USE_TITLE_RANK" => "N",	// При ранжировании результата учитывать заголовки
//		"DEFAULT_SORT" => "rank",	// Сортировка по умолчанию
//		"FILTER_NAME" => "",	// Дополнительный фильтр
//		"SHOW_WHERE" => "N",	// Показывать выпадающий список "Где искать"
//		"arrWHERE" => "",
//		"SHOW_WHEN" => "N",	// Показывать фильтр по датам
//		"PAGE_RESULT_COUNT" => "500",	// Количество результатов на странице
//		"DISPLAY_TOP_PAGER" => "N",	// Выводить над результатами
//		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под результатами
//		"PAGER_TITLE" => "",	// Название результатов поиска
//		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
//		"PAGER_TEMPLATE" => "N",	// Название шаблона
//	),
//	$component,
//	array('HIDE_ICONS' => 'Y')
//);

//делаем чтобы находились товары у которых точный запрос в названии.
//todo - можно закешировать запрос.
/*
CModule::IncludeModule("iblock");
$arElements = array();
$query = htmlspecialchars($_REQUEST["q"]);
$filter = array(
	"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
	//"?NAME"=> "%".$query."%",
	array(
		"LOGIC"=>"OR",
		array("?NAME"=> "%".$query."%"),
		array("?PROPERTY_ARTNUMBER"=>$query),
	)
);
//ppp($filter,"filter");
$rs = CIBlockElement::GetList(
	array(),
	$filter
	,false,false,array("ID","NAME")
);
while($ar = $rs->GetNext()){
	//m(1);
	$arElements[] = $ar["ID"];
}
*/

?>
<div class="s-filter">
            <h1>Поиск по товару</h1>
            <div class="b-filter-first">
                <div class="b-filter-first__left cart-radio">
                    <div class="b-filter-first__left-item">
                        <input type="checkbox" id="cart-checkbox-5551" class="radio-check" />
                        <label for="cart-checkbox-5551">Весь товар</label>
                    </div>
                    <div class="b-filter-first__left-item">
                        <input type="checkbox" id="cart-checkbox-5552" class="radio-check" />
                        <label for="cart-checkbox-5552">Товар под заказ</label>
                    </div>
                    <div class="b-filter-first__left-item">
                        <input type="checkbox" id="cart-checkbox-5553" class="radio-check" />
                        <label for="cart-checkbox-5553">Товар на складе</label>
                    </div>


                </div>

                <div class="b-filter-first__right">
                        <div class="btn-filter-outline">Сбросить фильтр</div>
                    <div class="btn-filter-outline">Показать 300 000 товаров</div>
                </div>
            </div>
            <div class="b-filter-second">

                <div class="b-filter-second">
                    <div class="b-filter-second_line ">
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-60551" class="radio-check" />
                            <label for="cart-checkbox-60551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-65052" class="radio-check" />
                            <label for="cart-checkbox-65052"><span>Ванны</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                        <input type="checkbox" id="cart-checkbox-655d3" class="radio-check" />
                        <label for="cart-checkbox-655d3"><span>Душевые лейки</span></label>
                    </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-65dd52" class="radio-check" />
                            <label for="cart-checkbox-65dd52"><span>Ванны</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6553" class="radio-check" />
                            <label for="cart-checkbox-6553"><span>Душевые лейки</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6553" class="radio-check" />
                            <label for="cart-checkbox-6553"><span>Душевые лейки</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6552" class="radio-check" />
                            <label for="cart-checkbox-6552"><span>Ванны</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6553" class="radio-check" />
                            <label for="cart-checkbox-6553"><span>Душевые лейки</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6553" class="radio-check" />
                            <label for="cart-checkbox-6553"><span>Душевые лейки</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6552" class="radio-check" />
                            <label for="cart-checkbox-6552"><span>Ванны</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6553" class="radio-check" />
                            <label for="cart-checkbox-6553"><span>Душевые лейки</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6552" class="radio-check" />
                            <label for="cart-checkbox-6552"><span>Ванны</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6553" class="radio-check" />
                            <label for="cart-checkbox-6553"><span>Душевые лейки</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6552" class="radio-check" />
                            <label for="cart-checkbox-6552"><span>Ванны</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6553" class="radio-check" />
                            <label for="cart-checkbox-6553"><span>Душевые лейки</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>
                        <div class="b-filter-second__item cart-radio">
                            <input type="checkbox" id="cart-checkbox-6551" class="radio-check" />
                            <label for="cart-checkbox-6551"><span>Мебель для ванной</span></label>
                        </div>

                    </div>
            </div>
            <div class="b-filter-third">

                <div class="b-filter-third__line b-filter-third__left">
                    <div class="b-filter-third__line-b">
                        <h2>Стиль</h2>
                        <span class="line-b__hidden">Скрыть</span>
                        <div class="b-filter-third__wrap-checks cart-radio ">
                            <input type="checkbox" id="cart-checkbox-1" class="radio-check" />
                            <label for="cart-checkbox-1">современный<span class="active">18</span></label>
                            <input type="checkbox" id="cart-checkbox-2" class="radio-check" />
                            <label for="cart-checkbox-2">классический<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-3" class="radio-check" />
                            <label for="cart-checkbox-3">арт-деко<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-4" class="radio-check" />
                            <label for="cart-checkbox-4">лофт<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-5" class="radio-check" />
                            <label for="cart-checkbox-5">прованс<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-6" class="radio-check" />
                            <label for="cart-checkbox-6">барокко<span>0</span></label>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="b-filter-third__line-b">
                        <h2>Вид</h2>
                        <span class="line-b__hidden">Скрыть</span>
                        <div class="b-filter-third__wrap-checks cart-radio">
                            <input type="checkbox" id="cart-checkbox-7" class="radio-check" />
                            <label for="cart-checkbox-7">овальные<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-8" class="radio-check" />
                            <label for="cart-checkbox-8">квадратная<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-9" class="radio-check" />
                            <label for="cart-checkbox-9">круглая<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-10" class="radio-check" />
                            <label for="cart-checkbox-10">постирочные<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-11" class="radio-check" />
                            <label for="cart-checkbox-11">с 2мя чашами<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-12" class="radio-check" />
                            <label for="cart-checkbox-12">угловая<span>0</span></label>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="b-filter-third__line-b">
                        <h2>Другие параметры</h2>
                        <span class="line-b__hidden">Скрыть</span>
                        <div class="b-filter-third__wrap-checks cart-radio">
                            <input type="checkbox" id="cart-checkbox-13" class="radio-check" />
                            <label for="cart-checkbox-13">без перелива<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-14" class="radio-check" />
                            <label for="cart-checkbox-14">с декором<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-15" class="radio-check" />
                            <label for="cart-checkbox-15">черные раковины<span>0</span></label>
                            <div class="clear"></div>
                        </div>
                    </div>

                </div>
                <div class="b-filter-third__line b-filter-third__center">
                    <div class="b-filter-third__line-b">
                        <h2>Отверстия под смеситель</h2>
                        <span class="line-b__hidden">Скрыть</span>
                        <div class="b-filter-third__wrap-checks cart-radio">
                            <input type="checkbox" id="cart-checkbox-21" class="radio-check" />
                            <label for="cart-checkbox-21">без отверстий<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-22" class="radio-check" />
                            <label for="cart-checkbox-22">1 отв.<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-23" class="radio-check" />
                            <label for="cart-checkbox-23">2 отв.<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-24" class="radio-check" />
                            <label for="cart-checkbox-4">3 отв.<span>0</span></label>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="b-filter-third__line-b">
                        <h2>Монтаж</h2>
                        <span class="line-b__hidden">Скрыть</span>
                        <div class="b-filter-third__wrap-checks cart-radio">
                            <input type="checkbox" id="cart-checkbox-27" class="radio-check" />
                            <label for="cart-checkbox-7">овальные<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-28" class="radio-check" />
                            <label for="cart-checkbox-8">квадратная<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-29" class="radio-check" />
                            <label for="cart-checkbox-9">круглая<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-210" class="radio-check" />
                            <label for="cart-checkbox-210">постирочные<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-211" class="radio-check" />
                            <label for="cart-checkbox-211">с 2мя чашами<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-212" class="radio-check" />
                            <label for="cart-checkbox-212">угловая<span>0</span></label>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="b-filter-third__line-b">
                        <h2>Отверстия под смеситель</h2>
                        <span class="line-b__hidden">Скрыть</span>
                        <div class="b-filter-third__wrap-checks cart-radio">
                            <input type="checkbox" id="cart-checkbox-221" class="radio-check" />
                            <label for="cart-checkbox-221">без отверстий<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-222" class="radio-check" />
                            <label for="cart-checkbox-222">1 отв.<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-223" class="radio-check" />
                            <label for="cart-checkbox-223">2 отв.<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-224" class="radio-check" />
                            <label for="cart-checkbox-224">3 отв.<span>0</span></label>
                            <div class="clear"></div>
                        </div>
                    </div>

                </div>
                <div class="b-filter-third__line b-filter-third__right">
                    <div class="b-filter-third__line-b">
                        <h2>Монтаж</h2>
                        <span class="line-b__hidden">Скрыть</span>
                        <div class="b-filter-third__wrap-checks cart-radio">
                            <input type="checkbox" id="cart-checkbox-37" class="radio-check" />
                            <label for="cart-checkbox-37">овальные<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-38" class="radio-check" />
                            <label for="cart-checkbox-38">квадратная<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-39" class="radio-check" />
                            <label for="cart-checkbox-39">круглая<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-330" class="radio-check" />
                            <label for="cart-checkbox-330">постирочные<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-331" class="radio-check" />
                            <label for="cart-checkbox-331">с 2мя чашами<span>0</span></label>
                            <input type="checkbox" id="cart-checkbox-332" class="radio-check" />
                            <label for="cart-checkbox-332">угловая<span>0</span></label>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="b-filter-third__line-b">
                        <h2>Другие параметры</h2>
                        <span class="line-b__hidden">Скрыть</span>
                        <div class="b-filter-third__wrap-checks cart-radio">
                            <input type="checkbox" id="cart-checkbox-33" class="radio-check" />
                            <label for="cart-checkbox-33">без перелива</label>
                            <input type="checkbox" id="cart-checkbox-34" class="radio-check" />
                            <label for="cart-checkbox-34">с декором</label>
                            <input type="checkbox" id="cart-checkbox-35" class="radio-check" />
                            <label for="cart-checkbox-35">черные раковины</label>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="b-filter-third__line-b">
                        <h2>Отверстия под смеситель</h2>
                        <span class="line-b__hidden">Скрыть</span>
                        <div class="b-filter-third__wrap-checks cart-radio">
                            <input type="checkbox" id="cart-checkbox-31" class="radio-check" />
                            <label for="cart-checkbox-21">без отверстий</label>
                            <input type="checkbox" id="cart-checkbox-32" class="radio-check" />
                            <label for="cart-checkbox-22">1 отв.</label>
                            <input type="checkbox" id="cart-checkbox-353" class="radio-check" />
                            <label for="cart-checkbox-353">2 отв.</label>
                            <input type="checkbox" id="cart-checkbox-354" class="radio-check" />
                            <label for="cart-checkbox-354">3 отв.</label>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

                <span class="clear"></span>
            </div>
            <div class="b-filter-action">
                <div class="btn-filter">Применить фильтр</div>
                <div class="btn-filter">Сбросить фильтр</div>
            </div>
        </div>
<?

$arElements = $APPLICATION->IncludeComponent(
	"custom:search.title", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "10000000",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "N",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "all",
		)
	),
	false
);

if (!empty($arElements) && is_array($arElements))
{
	global $searchFilter;
	$searchFilter = array(
		"=ID" => $arElements,
	);
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"search",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
			"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
			"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
			"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
			"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
			"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
			"PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
			"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
			"OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
			"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
			"OFFERS_LIMIT" => $arParams["OFFERS_LIMIT"],
			"SECTION_URL" => $arParams["SECTION_URL"],
			"DETAIL_URL" => $arParams["DETAIL_URL"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
			"USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
			"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
			"CURRENCY_ID" => $arParams["CURRENCY_ID"],
			"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"FILTER_NAME" => "searchFilter",
			"SECTION_ID" => "",
			"SECTION_CODE" => "",
			"SECTION_USER_FIELDS" => array(),
			"INCLUDE_SUBSECTIONS" => "Y",
			"SHOW_ALL_WO_SECTION" => "Y",
			"META_KEYWORDS" => "",
			"META_DESCRIPTION" => "",
			"BROWSER_TITLE" => "",
			"ADD_SECTIONS_CHAIN" => "N",
			"SET_TITLE" => "N",
			"SET_STATUS_404" => "N",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "N",
			"SHOW_OLD_PRICE" => "Y",
		),
		$arResult["THEME_COMPONENT"],
		array('HIDE_ICONS' => 'N')
	);
}
else
{
	echo GetMessage("CT_BCSE_NOT_FOUND");
}
?>