<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
// TODO: мой пагинатор
$this->setFrameMode(true);
$ClientID = 'navigation_' . $arResult['NavNum'];

$arResult["bShowAll"] = false; // не показываем ссылку "Все"

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) {
        return;
    }
}
?>

<div class="catalog-numbers-pagination">
    <?php
    $strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
    $strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
    if ($arResult["bDescPageNumbering"] === true) {
    // to show always first and last pages
    $arResult["nStartPage"] = $arResult["NavPageCount"];
    $arResult["nEndPage"] = 1;

    $sPrevHref = '';
    if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
        $bPrevDisabled = false;
        if ($arResult["bSavePage"]) {
            $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
        } else {
            if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)) {
                $sPrevHref = $arResult["sUrlPath"] . $strNavQueryStringFull;
            } else {
                $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
            }
        }
    } else {
        $bPrevDisabled = true;
    }

    $sNextHref = '';
    if ($arResult["NavPageNomer"] > 1) {
        $bNextDisabled = false;
        $sNextHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1);
    } else {
        $bNextDisabled = true;
    }
    ?>

    <?php if ($bPrevDisabled) { ?>
        <svg version="1.1" class="main-slider-arrow catalog-arrow catalog-arrow-disable catalog-arrow-next a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                <g>
                    <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4 c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                    <path d="M29.4,19.7H14.8l2.9-3.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L11.8,20c-0.4,0.4-0.4,1,0,1.4l4.5,4.8 c0.4,0.4,1,0.4,1.4,0c0.4-0.4,0.4-1,0-1.4l0,0l-2.9-3.1h14.6c0.6,0,1-0.4,1-1C30.4,20.1,30,19.7,29.4,19.7z"/>
                </g>
            </svg>

    <?php } else { ?>
        <a href="<?= $sPrevHref; ?>" id="<?= $ClientID ?>_previous_page">
            <svg version="1.1" class="main-slider-arrow catalog-arrow catalog-arrow-next a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                    <g>
                        <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4 c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                        <path d="M29.4,19.7H14.8l2.9-3.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L11.8,20c-0.4,0.4-0.4,1,0,1.4l4.5,4.8 c0.4,0.4,1,0.4,1.4,0c0.4-0.4,0.4-1,0-1.4l0,0l-2.9-3.1h14.6c0.6,0,1-0.4,1-1C30.4,20.1,30,19.7,29.4,19.7z"/>
                    </g>
                </svg>
        </a>
    <?php } ?>

    <div class="catalog-numbers-holder">
        <?php
        $bFirst = true;
        $bPoints = false;
        do {
            $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
            if ($arResult["nStartPage"] <= 2 || $arResult["NavPageCount"] - $arResult["nStartPage"] <= 1 || abs($arResult['nStartPage'] - $arResult["NavPageNomer"]) <= 2) {
                if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) {
                    echo '<span class="catalog-numbers-number catalog-numbers-number-active"><a>' . $NavRecordGroupPrint . '</a></span>';
                } elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false) {
                    echo '<span class="catalog-numbers-number"><a href="' . $arResult["sUrlPath"] . $strNavQueryStringFull . '">' . $NavRecordGroupPrint . '</a></span>';
                } else {
                    echo '<span class="catalog-numbers-number"><a href="' . $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . $arResult["nStartPage"] . '">' . $NavRecordGroupPrint . '</a></span>';
                }
                $bFirst = false;
                $bPoints = true;
            } else {
                if ($bPoints) {
                    echo '<span class="catalog-numbers-number">...</span>';
                    $bPoints = false;
                }
            }
            $arResult["nStartPage"]--;
        } while ($arResult["nStartPage"] >= $arResult["nEndPage"]);
        } else {
        // to show always first and last pages
        $arResult["nStartPage"] = 1;
        $arResult["nEndPage"] = $arResult["NavPageCount"];

        $sPrevHref = '';
        if ($arResult["NavPageNomer"] > 1) {
            $bPrevDisabled = false;
            if ($arResult["bSavePage"]) {
                $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1);
            } else {
                if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] - 1)) {
                    $sPrevHref = $arResult["sUrlPath"] . $strNavQueryStringFull;
                } else {
                    $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1);
                }
            }
        } else {
            $bPrevDisabled = true;
        }

        $sNextHref = '';
        if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
            $bNextDisabled = false;
            $sNextHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
        } else {
            $bNextDisabled = true;
        }
        ?>

    <?php if ($bPrevDisabled) { ?>
        <svg version="1.1" class="main-slider-arrow catalog-arrow catalog-arrow-disable catalog-arrow-next a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                <g>
                    <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4 c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                    <path d="M29.4,19.7H14.8l2.9-3.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L11.8,20c-0.4,0.4-0.4,1,0,1.4l4.5,4.8 c0.4,0.4,1,0.4,1.4,0c0.4-0.4,0.4-1,0-1.4l0,0l-2.9-3.1h14.6c0.6,0,1-0.4,1-1C30.4,20.1,30,19.7,29.4,19.7z"/>
                </g>
            </svg>
    <?php } else { ?>
        <a href="<?= $sPrevHref; ?>" id="<?= $ClientID ?>_previous_page">
            <svg version="1.1" class="main-slider-arrow catalog-arrow catalog-arrow-next a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                    <g>
                        <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4 c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                        <path d="M29.4,19.7H14.8l2.9-3.1c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0L11.8,20c-0.4,0.4-0.4,1,0,1.4l4.5,4.8 c0.4,0.4,1,0.4,1.4,0c0.4-0.4,0.4-1,0-1.4l0,0l-2.9-3.1h14.6c0.6,0,1-0.4,1-1C30.4,20.1,30,19.7,29.4,19.7z"/>
                    </g>
                </svg>
        </a>
    <?php } ?>

        <div class="catalog-numbers-holder">
            <?php
            $bFirst = true;
            $bPoints = false;
            do {
                if ($arResult["nStartPage"] <= 2 || $arResult["NavPageCount"] - $arResult["nStartPage"] <= 1 || abs($arResult['nStartPage'] - $arResult["NavPageNomer"]) <= 2) {
                    if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) {
                        echo '<span class="catalog-numbers-number catalog-numbers-number-active"><a>' . $arResult["nStartPage"] . '</a></span>';
                    } elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false) {
                        echo '<span class="catalog-numbers-number"><a href="' . $arResult["sUrlPath"] . $strNavQueryStringFull . '">' . $arResult["nStartPage"] . '</a></span>';
                    } else {
                        echo '<span class="catalog-numbers-number"><a href="' . $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . $arResult["nStartPage"] . '">' . $arResult["nStartPage"] . '</a></span>';
                    }
                    $bFirst = false;
                    $bPoints = true;
                } else {
                    if ($bPoints) {
                        echo '<span class="catalog-numbers-number">...</span>';
                        $bPoints = false;
                    }
                }
                $arResult["nStartPage"]++;
            } while ($arResult["nStartPage"] <= $arResult["nEndPage"]);
            }

            if ($arResult["bShowAll"]) {
                if ($arResult["NavShowAll"]) {
                    echo '<a class="nav-page-pagen" href="' . $arResult["sUrlPath"] . '?' . $strNavQueryString . 'SHOWALL_' . $arResult["NavNum"] . '=0">' . GetMessage("nav_paged") . '</a>';
                } else {
                    echo '<a class="nav-page-all" href="' . $arResult["sUrlPath"] . '?' . $strNavQueryString . 'SHOWALL_' . $arResult["NavNum"] . '=1">' . GetMessage("nav_all") . '</a>';

                }
            }
            ?>
        </div>
        <?php if ($bNextDisabled){ ?>
            <svg version="1.1" class="main-slider-arrow catalog-arrow catalog-arrow-disable catalog-arrow-prev a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                <g>
                    <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4 c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                    <path d="M29.6,20l-4.5-4.8c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4l2.9,3.1H12.4c-0.6,0-1,0.4-1,1c0,0.6,0.4,1,1,1h14.2 l-2.9,3.1c-0.4,0.4-0.4,1,0,1.4c0.4,0.4,1,0.4,1.4,0l0,0l4.5-4.8C30,21,30,20.4,29.6,20z"/>
                </g>
            </svg>
        <?php } else { ?>
            <a href="<?= $sNextHref; ?>" id="<?= $ClientID ?>_next_page">
                <svg version="1.1" class="main-slider-arrow catalog-arrow catalog-arrow-prev a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 41.4 41.4" enable-background="new 0 0 41.4 41.4" xml:space="preserve">
                    <g>
                        <path d="M20.7,2.6c-10,0-18.1,8.1-18.1,18.1c0,10,8.1,18.1,18.1,18.1c10,0,18.1-8.1,18.1-18.1C38.8,10.7,30.7,2.6,20.7,2.6z M32.1,32.1c-2.9,2.9-6.9,4.7-11.4,4.7c-4.5,0-8.5-1.8-11.4-4.7c-2.9-2.9-4.7-6.9-4.7-11.4c0-4.5,1.8-8.5,4.7-11.4 c2.9-2.9,6.9-4.7,11.4-4.7c4.5,0,8.5,1.8,11.4,4.7c2.9,2.9,4.7,6.9,4.7,11.4C36.8,25.2,35,29.2,32.1,32.1z"/>
                        <path d="M29.6,20l-4.5-4.8c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4l2.9,3.1H12.4c-0.6,0-1,0.4-1,1c0,0.6,0.4,1,1,1h14.2 l-2.9,3.1c-0.4,0.4-0.4,1,0,1.4c0.4,0.4,1,0.4,1.4,0l0,0l4.5-4.8C30,21,30,20.4,29.6,20z"/>
                    </g>
                </svg>
            </a>
        <?php } ?>
    </div>