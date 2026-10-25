<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
$i = 0;
if (0 < $arResult["SECTIONS_COUNT"]) { ?>
    <section class="s-brands">
        <div class="s-brands__line">
        <?php
        foreach ($arResult['SECTIONS'] as &$arSection) {
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
            $i++; 
            if ($i%4 == 1) {
                ?></div><div class="s-brands__line"><?
            }
            ?>

                <div class="s-brands__item">
                    <div class="s-brands__item-wrap">
                        <div class="s-brands__item-head">
                            <div class="s-brands__item-name">
                                <a href="<?= $arSection['SECTION_PAGE_URL']; ?>" class="_name"><?= $arSection['NAME']; ?></a>
                            </div>
                            <div class="s-brands__item-country">
                                <img src="/images/Italy.jpg" alt="">
                            </div>
                        </div>
                        <div class="s-brands__item-logo">
                            <a href="<?= $arSection['SECTION_PAGE_URL']; ?>"><img src="<?= $arSection['PICTURE']['SRC']; ?>" alt=""></a>
                        </div>
                        <div class="s-brands__item-line">
                            <? //var_dump($arSection['PROPERTIES']); ?>
                        </div>
                    </div>
                </div>
            <!--<div class="_item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                <a href="<?= $arSection['SECTION_PAGE_URL']; ?>" class="_img">
                    <img src="<?= $arSection['PICTURE']['SRC']; ?>" alt="<?= $arSection['PICTURE']['TITLE']; ?>"
                         title="<?= $arSection['PICTURE']['TITLE']; ?>" height="<?= $arSection['PICTURE']['height'] ?>"
                         width="<?= $arSection['PICTURE']['width'] ?>">
                </a>
                <a href="<?= $arSection['SECTION_PAGE_URL']; ?>" class="_name"><?= $arSection['NAME']; ?></a>
                <div class="_addr"><?= $arSection['UF_ADDRESS']; ?></div>
            </div>-->
        <?php
        }
        ?>
    </div>
    </section>
<?php } //endif?>
<?= $arResult["NAV_STRING"] ?>