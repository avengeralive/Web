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
	<?
	$aStart = '';
	$aEnd = '';
	if($arItem["LINK"]){
		$aStart = '<a href="'.$arItem["LINK"].'">';
		$aEnd = '</a>';
	}
		?>
		<h5><?=$aStart?><?=$arItem["TEXT"]?><?=$aEnd?></h5>
	
<?endforeach?>

</div>
<?endif?>