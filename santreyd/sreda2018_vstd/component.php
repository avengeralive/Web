<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
// echo '<pre style="display:none;">'; print_r($arParams); echo '</pre>';
CModule::IncludeModule('iblock');

$arNavParams = array(
	"nTopCount" => $arParams["PAGE_ELEMENT_COUNT"],
);
$CacheOptions = array(($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $bUSER_HAVE_ACCESS, $arNavParams);

$arButtons = CIBlock::GetPanelButtons(
	$arParams["IBLOCK_ID"],
	0,
	0,
	array("SECTION_BUTTONS"=>false, "SESSID"=>false)
);
if($APPLICATION->GetShowIncludeAreas())
	$this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));

if($this->StartResultCache(false, $CacheOptions)){
	$eWidth = 127;
	$eHeight = 83;

	$arSort = Array($arParams["ELEMENT_SORT_FIELD"]=>$arParams["ELEMENT_SORT_ORDER"]);
	$arFilter = Array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"SECTION_ID" => $arParams["SECTION_ID"],
		"INCLUDE_SUBSECTIONS" => "Y",	
	);
	$items = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, Array("ID","NAME","DETAIL_PICTURE","PROPERTY_URL","PROPERTY_ALT","PROPERTY_TITLE", "PROPERTY_FLAG"));
	while ($obItem = $items->GetNextElement()){		
		$arElemField = $obItem->GetFields();
  // echo '<pre>'; print_r($arElemField); echo '</pre>';
//var_dump($arElemField);
		$alt = $arElemField["NAME"];
		if($arElemField["PROPERTY_ALT_VALUE"])
			$alt = $arElemField["PROPERTY_ALT_VALUE"];
		$title = $arElemField["NAME"];
		if($arElemField["PROPERTY_TITLE_VALUE"])
			$title = $arElemField["PROPERTY_TITLE_VALUE"];

		$filepath = array();
		if($arElemField["DETAIL_PICTURE"]){
			$arSizeORIG = getimagesize($_SERVER['DOCUMENT_ROOT'].CFile::GetPath($arElemField["DETAIL_PICTURE"]));
			$width = intval($arSizeORIG[0]); 
			$height = intval($arSizeORIG[1]); 
				
			if(($width/$height)>=($eWidth/$eHeight)){
				if ($height>=$eHeight)
					$filepath = CFile::ResizeImageGet($arElemField["DETAIL_PICTURE"], array('width'=>2000, 'height'=>$eHeight), BX_RESIZE_IMAGE_PROPORTIONAL,true);
				else	
					$filepath = CFile::ResizeImageGet($arElemField["DETAIL_PICTURE"], array('width'=>2000, 'height'=>$height), BX_RESIZE_IMAGE_PROPORTIONAL,true);

				$arSizeORIG = getimagesize($_SERVER['DOCUMENT_ROOT'].$filepath["src"]);
				$width = intval($arSizeORIG[0]); 
				if ($width>$eWidth)
					img_crop($filepath["src"],$filepath["width"],$filepath["height"],$eWidth,$eHeight);
			}
			else{
				if ($width>=$eWidth)
					$filepath = CFile::ResizeImageGet($arElemField["DETAIL_PICTURE"], array('width'=>$eWidth, 'height'=>2000), BX_RESIZE_IMAGE_PROPORTIONAL,true);
				else	
					$filepath = CFile::ResizeImageGet($arElemField["DETAIL_PICTURE"], array('width'=>$width, 'height'=>2000), BX_RESIZE_IMAGE_PROPORTIONAL,true);

				$arSizeORIG = getimagesize($_SERVER['DOCUMENT_ROOT'].$filepath["src"]);
				$height = intval($arSizeORIG[1]); 
				if ($height>$eHeight)
					img_crop($filepath["src"],$filepath["width"],$filepath["height"],$eWidth,$eHeight);
			}
		}
		
		$arResult["ITEMS"][] = array(
			"ID" => $arElemField["ID"],
			"NAME" => $arElemField["NAME"],
			"PICTURE" => $filepath["src"],
			"ALT" => $alt,
			"TITLE" => $arElemField["PROPERTY_TITLE_VALUE"],
			"URL" => $arElemField["PROPERTY_URL_VALUE"],
			"FLAG" => CFile::ResizeImageGet($arElemField["PROPERTY_FLAG_VALUE"], array('width'=>100, 'height'=>"50"), BX_RESIZE_IMAGE_PROPORTIONAL,true)["src"]
		);	
	}
  // echo '<pre>'; print_r($arResult); echo '</pre>';
  $this->IncludeComponentTemplate();
}?>