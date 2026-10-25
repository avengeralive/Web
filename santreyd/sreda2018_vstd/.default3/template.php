<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--<div class="bchoice-slider">-->
<?foreach($arResult["ITEMS"] as $item){?>
	<div class="swiper-slide">
                        <a href="<?=$item["URL"]?>" class="with-color-hover">
                            <img src="<?=$item["PICTURE"]?>" alt="<?=$item["ALT"]?>" title="<?=$item["TITLE"]?>"/>
                            <span class="second-slider-text">
                                <h3 class="h1"><?=$item["NAME"]?></h3>
                            </span>
                        </a>
                    </div>
	<!--<div class="image-card-item" style="background-image:url(<?=$item["PICTURE"]?>);">
		<img src="<?=$item["PICTURE"]?>" alt="<?=$item["ALT"]?>" title="<?=$item["TITLE"]?>" style="display:none;" />
		<a href="<?=$item["URL"]?>" class="image-card-item-content">
<?if($item["LINE1"]){
	$style = array();
	if($item["LINE1_SIZE"])
		$style[] = 'font-size:'.$item["LINE1_SIZE"];
	if($item["LINE1_COLOR"])
		$style[] = 'color:'.$item["LINE1_COLOR"];
	$style = ' style="'.implode(';',$style).'"';
	?>
			<h2 class="tile-title"<?=$style?>><?=$item["LINE1"]?></h2>
<?}?>
<?if($item["LINE2"]){
	$style = array();
	if($item["LINE2_SIZE"])
		$style[] = 'font-size:'.$item["LINE2_SIZE"];
	if($item["LINE2_COLOR"])
		$style[] = 'color:'.$item["LINE2_COLOR"];
	$style = ' style="'.implode(';',$style).'"';
	?>
			<span class="tile-text"<?=$style?>><?= ((!$item["LINE2"])? '&nbsp;' : $item["LINE2"]); ?></span>
<?}?>
<?if($item["IS_ITEM"]){?>
<?if($item["OLD_PRICE"]){?>
			<div class="old-price"><?=$item["OLD_PRICE"]?><span class="rubl">Р</span></div>
<?}?>
<?if($item["PRICE"]){?>
			<div class="current-price"><?=$item["PRICE"]?><span class="rubl">Р</span></div>
<?}?>
			<span data-action="delay" data-item="<?=$item["ID"]?>" class="icon-favourite favourite-button">
				<img src="/images/icons/icon-fav.svg" alt="">
			</span>
			<span class="icon-basket js-btn-buy-product" data-id="<?=$item["ID"]?>">
				<img src="/images/icons/icon-card.svg" alt="">
			</span>
<?}?>			
		</a>
	</div>-->
<?}?>
<!--</div>-->