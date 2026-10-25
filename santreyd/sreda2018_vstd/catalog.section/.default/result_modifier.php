<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (0 < $arResult['SECTIONS_COUNT'])
{
	foreach ($arResult['SECTIONS'] as &$arSection){ //var_dump($arSection);
			if(0 < $arSection['PICTURE']){;
				$arSection['PICTURE'] = CFile::ResizeImageGet($arSection['PICTURE'], array('width'=>126, 'height'=>83), BX_RESIZE_IMAGE_EXACT, true);
				$arSection['PICTURE']['SRC'] = $arSection['PICTURE']['src'];
			}else{
				$arSection['PICTURE'] =  array(
					'SRC' => $this->GetFolder().'/images/tile-empty.png',
					'ALT' => (
						'' != $arResult['SECTIONS'][$key]["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
						? $arResult['SECTIONS'][$key]["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
						: $arResult['SECTIONS'][$key]["NAME"]
					),
					'TITLE' => (
						'' != $arResult['SECTIONS'][$key]["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
						? $arResult['SECTIONS'][$key]["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
						: $arResult['SECTIONS'][$key]["NAME"]
					)
				);	
			};	
	};
};
?>