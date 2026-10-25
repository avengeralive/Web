<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--<div class="grid-x grid-margin-x">
<?foreach($arResult["ITEMS"] as $item){
?>
	<div class="card-item cell medium-6 xlarge-4">
		<a title="<?=$item["TITLE"]?>" href="<?=$item["DETAIL_PAGE_URL"]?>">
			<img src="<?=$item["PICTURE"]?>" alt="<?=$item["NAME"]?>" title="<?=$item["TITLE"]?>" />
			<div class="card-title"><?=$item["NAME"]?></div>
		</a>
	</div>
<?}?>
</div>-->


					<div class="s-blog__line">
                        <div class="s-blog__item">
                            <div class="s-blog__item-img">
                                <img src="<?=$arResult["ITEMS"][0]["PICTURE"]?>" alt="<?=$arResult["ITEMS"][0]["NAME"]?>" title="<?=$arResult["ITEMS"][0]["TITLE"]?>" />
                            </div>
                            <div class="s-blog__item-content">
                                <h3><a title="<?=$arResult["ITEMS"][0]["TITLE"]?>" href="<?=$arResult["ITEMS"][0]["DETAIL_PAGE_URL"]?>"><?=$arResult["ITEMS"][0]["NAME"]?></a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="s-blog__line">
                        <div class="blog-item__zag blog-item__zag--all">
                            <div>
                                <a href="/blog"><p>Все</p>
                                <p>записи</p></a>
                            </div>
                        </div>
                        <div class="s-blog__item">
                            <div class="s-blog__item-img">
                                <img src="<?=$arResult["ITEMS"][1]["PICTURE"]?>" alt="<?=$arResult["ITEMS"][1]["NAME"]?>" title="<?=$arResult["ITEMS"][1]["TITLE"]?>" />
                            </div>
                            <div class="s-blog__item-content">
                                <h3><a title="<?=$arResult["ITEMS"][1]["TITLE"]?>" href="<?=$arResult["ITEMS"][1]["DETAIL_PAGE_URL"]?>"><?=$arResult["ITEMS"][1]["NAME"]?></a></h3>
                            </div>
                        </div>
                        <div class="blog-item__zag blog-item__zag--more">
                            <div>
                                <a href="/blog"><p>ЕЩЕ</p>
                                <p>СТАТЬИ</p></a>
                            </div>
                        </div>
                    </div>
                    <div class="s-blog__line">
                        <div class="s-blog__item">
                            <div class="s-blog__item-img">
                                <img src="<?=$arResult["ITEMS"][2]["PICTURE"]?>" alt="<?=$arResult["ITEMS"][2]["NAME"]?>" title="<?=$arResult["ITEMS"][2]["TITLE"]?>" />
                            </div>
                            <div class="s-blog__item-content">
                                <h3><a title="<?=$arResult["ITEMS"][2]["TITLE"]?>" href="<?=$arResult["ITEMS"][2]["DETAIL_PAGE_URL"]?>"><?=$arResult["ITEMS"][2]["NAME"]?></a></h3>
                            </div>
                        </div>
                        <div class="s-blog__item">
                            <div class="s-blog__item-img">
                                <img src="<?=$arResult["ITEMS"][3]["PICTURE"]?>" alt="<?=$arResult["ITEMS"][3]["NAME"]?>" title="<?=$arResult["ITEMS"][3]["TITLE"]?>" />
                            </div>
                            <div class="s-blog__item-content">
                                <h3><a title="<?=$arResult["ITEMS"][3]["TITLE"]?>" href="<?=$arResult["ITEMS"][0]["DETAIL_PAGE_URL"]?>"><?=$arResult["ITEMS"][3]["NAME"]?></a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="s-blog__line">
                        <div class="blog-item__zag blog-item__zag--all blog-item__zag--all--mobile">
                            <div>
                                <a href="/blog"><p>Все</p>
                                <p>записи</p></a>
                            </div>
                        </div>
                        <div class="s-blog__item">
                            <div class="s-blog__item-img">
                                <img src="<?=$arResult["ITEMS"][4]["PICTURE"]?>" alt="<?=$arResult["ITEMS"][4]["NAME"]?>" title="<?=$arResult["ITEMS"][4]["TITLE"]?>" />
                            </div>
                            <div class="s-blog__item-content">
                                <h3><a title="<?=$arResult["ITEMS"][4]["TITLE"]?>" href="<?=$arResult["ITEMS"][4]["DETAIL_PAGE_URL"]?>"><?=$arResult["ITEMS"][4]["NAME"]?></a></h3>
                            </div>
                        </div>
                    </div>