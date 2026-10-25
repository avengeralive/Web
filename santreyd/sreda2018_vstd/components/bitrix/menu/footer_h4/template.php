<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$this->setFrameMode(true);
?>

<?if (!empty($arResult)):?>
<div class="footer-links-list">
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<h4><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></h4>
	<?else:?>
		<h4><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></h4>
	<?endif?>
	
<?endforeach?>

</div>
<?endif?>