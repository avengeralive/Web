<?
	$arResult['NUM_COLUMN'] = array(2,2,3,3); 
	
	foreach($arResult as $key=>&$arItem){
		
		if($arItem["DEPTH_LEVEL"] == 1){
			$PARENT_KEY = $key;
			$ITEMS[$PARENT_KEY] = $arItem;
		}else{
			$ITEMS[$PARENT_KEY]['CHILD'][] = $arItem;
		}
		
		//if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel){}
		//$previousLevel = $arItem["DEPTH_LEVEL"];
	};
	
	$arResult['ITEMS'] = $ITEMS;
	$arResult['CNT'] = count($ITEMS);
	
	$start = 0;
	foreach($arResult['NUM_COLUMN'] as $num){
		$arResult['COLUMNS'][] = array_slice($arResult['ITEMS'], $start, $num);
		$start += $num;
	}
	
?>