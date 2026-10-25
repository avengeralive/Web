<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $item){ ?>
<div class="b-banner-five__line">
                <a href="<?=$item['LINK']?>" class="b-banner-five__link">
                    <img src="<?=$item['PICTURE']?>" alt="news">
                    <span class="b-banner-five__content">
                        <h2><?=$item['NAME']?></h2>
                        <h3></h3>
                    </span>
                </a>
            </div>
<?}?>

