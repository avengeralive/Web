<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["OPTIMISED"] == 'Y' && !isset($arParams["COMEL_ID"])){
	$postParams = array();
	foreach($arParams as $key => $param){
		if(strpos($key,'~') === false)
			$postParams[] = $key.'='.$param;
	}
	$postParams = implode('&',$postParams);
?>
<section id="<?=$arResult["COMEL_ID"]?>"></section>
<script>
$(document).ready(function(){
	var mob = 'n';
	if($(window).width() < 521)
		mob = 'y';
	var path = '<?=$this->GetFolder()?>/ajax.php',
	formData = 'id=<?=$arResult["COMEL_ID"]?>'+'&mobile='+mob+'&<?=$postParams?>',
	success = function(response){
		$('#<?=$arResult["COMEL_ID"]?>').append(response);
	};
	$.post(path, formData, success, 'html');
});
</script>
<?}
else{
	if($arParams["OPTIMISED"] != 'Y'){?>
<section>
<?	}?>
<?/*	<h1 class="section-title"><?=$arParams["BLOCK_TITLE"]?></h1>*/?>

	<div class="categories-tile-group">
<?
$cou = 0;
foreach($arResult["ITEMS"] as $item){
	$this->AddEditAction($item["ID"], $item["EDIT_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($item["ID"], $item["DELETE_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
	$addClass = '';
	if($cou == 1)
		$addClass = ' big';
	if($cou == 2)
		echo '<div class="tile tiles-group">';
	?>
          <div class="tile<?=$addClass?>" id="<?=$this->GetEditAreaId($item["ID"])?>">
						<img title="<?=$item["TITLE"]?>" alt="<?=$item["ALT"]?>" src="<?=$item["PICTURE"]?>" style="display:none;"/>
            <a href="<?=$item["URL"]?>" class="tile-content" style="background-image:url(<?=$item["PICTURE"]?>);">
<?
$style = array();
if($item["LINE1"]){
	if($item["LINE1_SIZE"])
		$style[] = 'font-size:'.$item["LINE1_SIZE"];
	if($item["LINE1_COLOR"])
		$style[] = 'color:'.$item["LINE1_COLOR"];
	$style = ' style="'.implode(';',$style).'"';
	?>
              <h2 class="tile-title"<?=$style?>><?=$item["LINE1"]?></h2>
<?}
	$style = array();
	if($item["LINE2_SIZE"])
		$style[] = 'font-size:'.$item["LINE2_SIZE"];
	if($item["LINE2_COLOR"])
		$style[] = 'color:'.$item["LINE2_COLOR"];
	$style = ' style="'.implode(';',$style).'"';
?>
            <span class="tile-text"<?=$style?>>
                <?if($item["LINE2"]){?>
                    <?=$item["LINE2"]?>
                <?}?>
                <?if($item["LINE3"]){
	                $style = array();
	                if($item["LINE3_SIZE"])
		                $style[] = 'font-size:'.$item["LINE3_SIZE"];
	                if($item["LINE3_COLOR"])
		                $style[] = 'color:'.$item["LINE3_COLOR"];
	                $style = ' style="'.implode(';',$style).'"'; ?>
                <span class="tile-text-info"<?=$style?>><?=$item["LINE3"]?></span>
                <?}?>
                <?  print_r($item["LINE3"]); ?>
                <?= ((!$item["LINE2"] || !$item["LINE3"])? '&nbsp;' : ''); // для валидного span ?>
            </span>
        </a>
    </div>
<?
	if($cou == 3)
		echo '</div>';

	$cou++;
}?>
	</div>
<?if($arParams["OPTIMISED"] != 'Y'){?>
</section>
<?}
}?>
