<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? //var_dump($arResult["ITEMS"]);?>
<style>.crazy-grid-item { position: relative; }</style>
<? //var_dump($arResult["ITEMS"][0]); ?>
<div class="crazy-grid-items">
                <a href="<?=$arResult["ITEMS"][0]['DETAIL_PAGE_URL']; ?>" class="crazy-grid-item crazy-grid-item-thin ">
                    <img src="<?=$arResult["ITEMS"][0]['PREVIEW_PICTURE']; ?>" alt="<?=$arResult["ITEMS"][0]['ALT']; ?>" />
                    
                    <span class="crazy-grid-text">
                        <span class="crazy-grid-text-header with-line"></span>
                        <span class="crazy-grid-text-name"><?=$arResult["ITEMS"][0]['NAME']; ?></span>
                        
                    </span>

                    <span class="crazy-grid-text">
                        <?$i=0;?>
                        <span class="crazy-grid-text-header with-line" style="color: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING']['VALUE']; ?></span>
                        <span class="crazy-grid-text-name" style="color: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['MIDDLE_STRING']['VALUE']; ?></span>
                        <? $i++; ?>
                    </span>
                </a>
                <a href="<?=$arResult["ITEMS"][1]['DETAIL_PAGE_URL']; ?>" class="crazy-grid-item crazy-grid-item-big ">
                    <img src="<?=$arResult["ITEMS"][1]['PREVIEW_PICTURE']; ?>" alt="<?=$arResult["ITEMS"][1]['ALT']; ?>" />
                    
                    <span class="crazy-grid-text">
                        <span class="crazy-grid-text-header with-line" style="color: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING']['VALUE']; ?></span>
                        <span class="crazy-grid-text-name" style="color: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['MIDDLE_STRING']['VALUE']; ?></span>
                        <? $i++; ?>
                    </span>
                </a>
                <div class="crazy-grid-item-two">
                    <a href="<?=$arResult["ITEMS"][2]['DETAIL_PAGE_URL']; ?>" class="crazy-grid-item crazy-grid-item-small ">
                        <img src="<?=$arResult["ITEMS"][2]['PREVIEW_PICTURE']; ?>" alt="<?=$arResult["ITEMS"][2]['ALT']; ?>" />
	                    
	                    <span class="crazy-grid-text">
                        <span class="crazy-grid-text-header with-line" style="color: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING']['VALUE']; ?></span>
                        <span class="crazy-grid-text-name" style="color: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['MIDDLE_STRING']['VALUE']; ?></span>
                        <? $i++; ?>
                    </span>
                    </a>
                    <a href="<?=$arResult["ITEMS"][3]['DETAIL_PAGE_URL']; ?>" class="crazy-grid-item crazy-grid-item-small ">
                        <img src="<?=$arResult["ITEMS"][3]['PREVIEW_PICTURE']; ?>" alt="<?=$arResult["ITEMS"][3]['ALT']; ?>" />
	                    
	                    <span class="crazy-grid-text">
                        <span class="crazy-grid-text-header with-line" style="color: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING']['VALUE']; ?></span>
                        <span class="crazy-grid-text-name" style="color: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['MIDDLE_STRING']['VALUE']; ?></span>
                        <? $i++; ?>
                    </span>
                    </a>
                </div>
            </div>
            <div class="crazy-grid-items">
                <a href="<?=$arResult["ITEMS"][4]['DETAIL_PAGE_URL']; ?>" class="crazy-grid-item crazy-grid-item-small_bottom ">
                    <img src="<?=$arResult["ITEMS"][4]['PREVIEW_PICTURE']; ?>" alt="<?=$arResult["ITEMS"][4]['ALT']; ?>" />
                    
                    <span class="crazy-grid-text">
                        <span class="crazy-grid-text-header with-line" style="color: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING']['VALUE']; ?></span>
                        <span class="crazy-grid-text-name" style="color: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['MIDDLE_STRING']['VALUE']; ?></span>
                        <? $i++; ?>
                    </span>
                </a>
                <a href="<?=$arResult["ITEMS"][5]['DETAIL_PAGE_URL']; ?>" class="crazy-grid-item crazy-grid-item-small_bottom ">
                    <img src="<?=$arResult["ITEMS"][5]['PREVIEW_PICTURE']; ?>" alt="<?=$arResult["ITEMS"][5]['ALT']; ?>" />
                    
                    <span class="crazy-grid-text">
                        <span class="crazy-grid-text-header with-line" style="color: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING']['VALUE']; ?></span>
                        <span class="crazy-grid-text-name" style="color: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['MIDDLE_STRING']['VALUE']; ?></span>
                        <? $i++; ?>
                    </span>
                </span>
                </a>
                <a href="<?=$arResult["ITEMS"][6]['DETAIL_PAGE_URL']; ?>" class="crazy-grid-item crazy-grid-item-long ">
                    <img src="<?=$arResult["ITEMS"][6]['PREVIEW_PICTURE']; ?>" alt="<?=$arResult["ITEMS"][6]['ALT']; ?>"/>
                    
                    <span class="crazy-grid-text">
                        <span class="crazy-grid-text-header with-line" style="color: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['TOP_STRING']['VALUE']; ?></span>
                        <span class="crazy-grid-text-name" style="color: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_COLOR']['VALUE'];?> ; font-size: <?=$arResult["ITEMS"][$i]['MIDDLE_STRING_SIZE']['VALUE']; ?>px;"><?=$arResult["ITEMS"][$i]['PROPERTIES']['MIDDLE_STRING']['VALUE']; ?></span>
                        <? $i++; ?>
                    </span>
                </span>
                </a>
            </div>

