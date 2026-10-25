<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$this->setFrameMode(true);
if (!empty($arResult)){
	$arTopLine = array();
	$arBottonLine = array();
	foreach($arResult as $arItem){
		if($arItem["PARAMS"]["top"] == 'Y')
			$arTopLine[] = $arItem;
		else
			$arBottonLine[] = $arItem;
	}
	// echo '<pre>';print_r();echo '</pre>';
?>
<nav class="site-nav-bar">
	<ul class="main-nav-list">
<?foreach($arTopLine as $arItem){
		$openTag = '<h2>';
		$closeTag = '</h2>';
		if($arItem["PARAMS"]["noh2"] == 'Y'){
			$openTag = '<span class="h2">';
			$closeTag = '</span>';
		}	
	?>
		<li><?=$openTag?><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a><?=$closeTag?></li>
<?}?>		
	</ul>
	<ul class="secondary-nav-list">
<?foreach($arBottonLine as $arItem){
		$openTag = '<h2>';
		$closeTag = '</h2>';
		if($arItem["PARAMS"]["noh2"] == 'Y'){
			$openTag = '<span class="h2">';
			$closeTag = '</span>';
		}	
?>
		<li><?=$openTag?><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a><?=$closeTag?></li>
<?}?>		
	</ul>
 </nav>
<?}?>