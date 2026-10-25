<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
      <!--<div class="page-content">
        <ul class="brand-list menu">-->
<?foreach($arResult["ITEMS"] as $item){
	//$this->AddEditAction($item["ID"], $item["EDIT_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
	//$this->AddDeleteAction($item["ID"], $item["DELETE_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
?>
          <!--<li id="<?=$this->GetEditAreaId($item["ID"])?>"><a href="<?=$item["URL"]?>" title="<?=$item["TITLE"]?>"><img src="<?=$item["PICTURE"]?>" alt="<?=$item["ALT"]?>"></a></li>-->
          <div class="s-brends__item">
                    <div class="s-brends__item-country">
                        <img src="/local/templates/sreda2018_vstd/images/germany.png" alt="">
                    </div>
                    <h3 class="s-brends-item__title"><a href="<?=$item["URL"]?>"><?=$item["NAME"]?></a></h3>
                    <div class="s-brends-item__img-wrap">
                        <img src="<?=$item["PICTURE"]?>" alt="<?=$item["ALT"]?>">
                        <div class="s-brends-item__hover">
                            <p><a href="<?=$item["URL"]?>"><?=$item["TITLE"]?></a></p>
                        </div>
                    </div>
                </div>
<?}?>
        <!--</ul>
      </div>-->