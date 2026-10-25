<style>
    .link_wait_place {
        width: 140px;
    }  
    .stats.active {
        width: 175px;
        font-size: 17px;
        margin-top: 14px;
    }
    div.preview{
        display: inline;
        padding-left:10px;
    }
    div.preview:hover img.preview{
        display: block;
    }

    div.preview img.preview{
        display: none;
        max-width: 250px;
        position: absolute;
    }    
</style>

<div id="loader"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>

<?php
// Подключаем дополнительные функции для работы статистики
// Connect additional functions for statistics
include './includes/stats/index_10.php';

$statsManager = new Stats_Manager(DB::getInstance());
$statsManager->byUserId = $user_id;
$getRequest = new Request($_GET);

if (isset($getRequest->date) and $getRequest->date != 0 and $getRequest->date != '') {
    $dd = explode(' - ', $getRequest->date);
} else {
    $dd = array(0 => date('d.m.Y', (time() - 60 * 60 * 24 * 6)), 1 => date('d.m.Y', time()));
}

$dat1 = $dd[0];
$dat2 = $dd[1];
$statsManager->dat1 = date('Y-m-d', strtotime($dat1));
$statsManager->dat2 = date('Y-m-d', strtotime($dat2));
$statsManager->tdat1 = date('Ymd', strtotime($dat1));
$statsManager->tdat2 = date('Ymd', strtotime($dat2));

function build_pagination_url($page = 1, $extra = []) {
    $parameters = array(
        'date' => ( isset($_GET['date']) ) ? $_GET['date'] : '',
        'offer' => ( isset($_GET['offer']) ) ? $_GET['offer'] : '',
        'country' => ( isset($_GET['country']) ) ? $_GET['country'] : '',
        'landings' => ( isset($_GET['landings']) ) ? $_GET['landings'] : '',
        'prelandings' => ( isset($_GET['prelandings']) ) ? $_GET['prelandings'] : '',
        'subidS' => ( isset($_GET['subidS']) ) ? $_GET['subidS'] : '',
        'subid1' => ( isset($_GET['subid1']) ) ? $_GET['subid1'] : '',
        'subid2' => ( isset($_GET['subid2']) ) ? $_GET['subid2'] : '',
        'subid3' => ( isset($_GET['subid3']) ) ? $_GET['subid3'] : '',
        'subid4' => ( isset($_GET['subid4']) ) ? $_GET['subid4'] : '',
        'subid5' => ( isset($_GET['subid5']) ) ? $_GET['subid5'] : '',
        'type' => ( isset($_GET['type']) ) ? $_GET['type'] : '',
        'device' => (isset($_GET['device']) ? $_GET['device'] : '-1'),
    );
    $parameters = array_merge($parameters, $extra);
    return '?' . http_build_query($parameters);
}
?>

<script type="text/javascript" src="./templates/<?php echo $template; ?>/js/moment.min.js"></script>
<script src="./templates/<?php echo $template; ?>/js/range.js"></script>
<link rel="stylesheet" type="text/css" href="./templates/<?php echo $template; ?>/css/daterangepicker.css" />


<div class="row main mt-50 mb-50">
    
    
    <div class="col-12 mb-2">
        <p class="pageTitle"><span><?php echo $loc['stats.php']['t01']; ?></span></p>
    </div>

    <!-- Блок с фильтром -->
    <!-- Block filter -->
<div class="col-12">
    <div class="row">
        <div class="col-12">

            <form class="js-ajax-filter" action="?" method="get" >
                <div class="row align-items-end">
                    <div class="col-4">     
                    <div class="form-group">
                        <label class="" for=""><b><?php echo $loc['stats.php']['t02']; ?></b></label>   
                        <input type="text" name="date" id="datepicker" class="form-control" style="text-align: center;" readonly />
                    </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                        <label class="" for=""><b><?php echo $loc['stats.php']['t03']; ?></b></label>   
                        <select class="form-control" data-search-placeholder="Оффер" name="offer" style="text-align: left;">
                            <option <?php if (!$getRequest->offer) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                            <?php
                            $offers = new Offer;
                            $offers_arr = $offers->getByWebmaster($user_id);
                            if (is_array($offers_arr) && count($offers_arr) > 0) {
                                foreach ($offers_arr as $offer) {
                                    echo '<option value="' . $offer['id'] . '" ';
                                    if ($getRequest->offer == $offer['id'])
                                        echo 'selected';
                                    echo '>' . html_entity_decode($offer['name'], ENT_QUOTES, 'utf-8') . '</option>';
                                }
                            }
                            ?>
                        </select>                                        
                    </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                        <label class="" for=""><b>Страна:</b></label>   
                        <select class="form-control" name="country" style="text-align: left; text-align: center;">
                            <option <?php if (!$getRequest->country) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                            <?
                            $countrys_arr = ['Россия' => 'RU', 'Украина' => 'UA', 'Беларусь' => 'BY', 'Казахстан' => 'KZ', 'Кыргызстан' => 'KG', 'Молдова' => 'MD', 'Армения' => 'AM', 'Грузия' => 'GE', 'Остальные' => 'all'];
                            foreach ($countrys_arr as $k => $v) {
                                ?>
                                <option <?php
                                if (isset($getRequest->country) && $getRequest->country == $v) {
                                    echo ' selected ';
                                }
                                ?> value="<?= $v; ?>"><?= $k; ?></option>
                                    <?php
                                }
                                ?>                                        
                        </select>                                        
                    </div>  
                    </div>
                </div>
                <div class="row align-items-end mt-15">
                    <div class="col">
                        <div class="form-group">
                            <input id="namesubid1" class="form-control" name="subid1" onkeyup="autocomplet(1);" type="text"  placeholder="SubID 1" style="text-align: left;" autocomplete="off">
                            <ul id="namesubid1_list" class="listAutoComplete" style=""></ul>
                        </div>
                    </div>   
                    <div class="col">
                        <div class="form-group">
                            <input id="namesubid2" class="form-control" name="subid2" onkeyup="autocomplet(2);"  type="text" placeholder="SubID 2" style="text-align: left;" autocomplete="off">
                            <ul id="namesubid2_list" class="listAutoComplete" style="margin-left: 213px; "></ul>	
                        </div>
                    </div>   
                    <div class="col">
                        <div class="form-group">
                            <input id="namesubid3" class="form-control" name="subid3" onkeyup="autocomplet(3);" type="text" placeholder="SubID 3" style="text-align: left;" autocomplete="off">
                            <ul id="namesubid3_list" class="listAutoComplete"  style="margin-left: 427px;"></ul>
                        </div>
                    </div>   
                    <div class="col">
                        <div class="form-group">
                            <input id="namesubid4" class="form-control" name="subid4" onkeyup="autocomplet(4);" type="text" placeholder="SubID 4" style="text-align: left;" autocomplete="off">
                            <ul id="namesubid4_list" class="listAutoComplete"  style="margin-left: 640px;"></ul>
                        </div>
                    </div>   
                    <div class="col">
                        <div class="form-group">
                            <input id="namesubid5" class="form-control" name="subid5" onkeyup="autocomplet(5);" type="text" placeholder="SubID 5" style="text-align: left;" autocomplete="off">
                            <ul id="namesubid5_list" class="listAutoComplete"  style="margin-left: 853px;"></ul>
                        </div>
                    </div>   
                
                </div>
        </div>
    </div>
        
                <input type="hidden" name="type" id="types" value="0">
                <input type="hidden" name="landings" id="landings" value="0">
                <input type="hidden" name="prelandings" id="prelandings" value="0">
                <input type="hidden" name="subidS" id="subidS" value="0">
            </form>
    <!-- Конец блока с фильтром -->
    <!-- End unit with filter -->
</div>
<div id="js-ajax-content">
<div class="col-12">

        <form class="js-ajax-filter2" action="?" method="get">
            
            <div class="row align-items-end mt-15">
                
                
                <?php
                foreach ($_GET as $k => $v) {
                    if (in_array($k, array('landings', 'prelandings'))) {
                        continue;
                    }
                    echo "<input type=hidden name='" . htmlentities($k, ENT_QUOTES) . "' value='" . htmlentities($v, ENT_QUOTES) . "' />" . PHP_EOL;
                }
                ?>                            

                <div class="col-4">
                    <div class="form-group">
                        <label class="" for=""><b>Лендинг:</b></label>   
                        <select class="form-control" id="landchange" name="landings" style="text-align: left;">
                            <?php
                            if (isset($getRequest->offer) && $getRequest->offer != 0) {
                                ?>
                                <option <?php if (!$_GET['landings']) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                <?php
                                $offer = Offer::getById(htmlentities($getRequest->offer));
                                $landings = $offer->getLandings();
                                if (is_array($landings) && count($landings) > 0) {
                                    foreach ($landings as $landing) {
                                        echo '<option value="' . $landing->id . '" ';
                                        if ($_GET['landings'] == $landing->id)
                                            echo 'selected';
                                        echo '>' . $landing->name . '</option>';
                                    }
                                }
                            }else {
                                echo '<option value="">Выберите оффер</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div> 
                
                <div class="col-4">
                    <div class="form-group">
                        <label class="" for=""><b>Прелендинг:</b></label>   
                        <select class="form-control" id="prelandchange" name="prelandings" style="text-align: left;">
                            <?php
                            if (isset($getRequest->offer) && $getRequest->offer != 0) {
                                ?>
                                <option <?php if (!$getRequest->prelanding) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                <?php
                                $prelandings = $offer->getPrelandings();
                                if (is_array($prelandings) && count($prelandings) > 0) {
                                    foreach ($prelandings as $landing) {
                                        echo '<option value="' . $landing->id . '" ';
                                        if ($getRequest->prelanding == $landing->id)
                                            echo 'selected';
                                        echo '>' . $landing->name . '</option>';
                                    }
                                }
                            }else {
                                echo '<option value="">Выберите оффер</option>';
                            }
                            ?>
                        </select>  
                    </div>
                </div> 
                <div class="col-4">
                    <div class="form-group">
                        <label class="" for=""><b>Устройство:</b></label>   
                        <select class="form-control" id="devicechange" name="device" style="text-align: left;">
                            <option <?php if (isset($_GET['device']) && $_GET['device'] == -1) echo 'selected '; ?>  value="-1">Все</option>
                            <option <?php if (isset($_GET['device']) && $_GET['device'] == 0) echo 'selected '; ?> value="0">ПК</option>
                            <option <?php if (isset($_GET['device']) && $_GET['device'] == 1) echo 'selected '; ?> value="1">Мобильный</option>
                        </select>
                    </div>
                </div> 
            </div> 
        </form>
    
    
</div> 
    
<div class="col-12 mb-30 text-right">    
    <a href="./stats.php"><button class="btn button"><?php echo $loc['stats.php']['t08']; ?></button></a>    
</div>



    <?php
    $where = [];
    if (isset($getRequest->offer) && $getRequest->offer != 0 && $getRequest->offer != '') {
        $where[] = ['where' => '`offer_id`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->offer) . "'"];
    }
    if (!empty($_GET['landings'])) {
        $where[] = ['where' => '`landing_id`', 'type' => '=', 'values' => "'" . htmlentities($_GET['landings']) . "'"];
    }
    if (!empty($_GET['prelandings'])) {
        $where[] = ['where' => '`prelanding_id`', 'type' => '=', 'values' => "'" . htmlentities($_GET['prelandings']) . "'"];
    }
    if (isset($getRequest->subid1) && $getRequest->subid1 != '') {
        $where[] = ['where' => '`subid1`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->subid1) . "'"];
    }
    if (isset($getRequest->subid2) && $getRequest->subid2 != '') {
        $where[] = ['where' => '`subid2`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->subid2) . "'"];
    }
    if (isset($getRequest->subid3) && $getRequest->subid3 != '') {
        $where[] = ['where' => '`subid3`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->subid3) . "'"];
    }
    if (isset($getRequest->subid4) && $getRequest->subid4 != '') {
        $where[] = ['where' => '`subid4`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->subid4) . "'"];
    }
    if (isset($getRequest->subid5) && $getRequest->subid5 != '') {
        $where[] = ['where' => '`subid5`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->subid5) . "'"];
    }
    if (isset($getRequest->country) && $getRequest->country != 'all' && $getRequest->country != '0') {
        $where[] = ['where' => '`short_country`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->country) . "'"];
    } elseif (isset($getRequest->country) && $getRequest->country == 'all') {
        $where[] = ['where' => '`short_country`', 'type' => 'NOT IN', 'values' => "('RU','UA','BY','KZ','KG','MD','AM','GE')"];
    }
    ?>                                 

<div class="col-12">   
    
    <div class="row align-items-center mt-50 text-center m-0">
        <div style="width: 110px;" class="link_wait_place col  <?php if (!isset($getRequest->type) or $getRequest->type == 0) echo "active"; ?> navigation-page"><a class="viewstats" data-type="0" href="<?php echo build_pagination_url(1); ?>&type=0">Дни</a></div>
        <div style="width: 130px;" class="link_wait_place col  <?php if (isset($getRequest->type) && $getRequest->type == 1) echo "active"; ?> navigation-page"><a class="viewstats" data-type="1" href="<?php echo build_pagination_url(1); ?>&type=1">Офферы</a></div>
        <div style="width: 140px;" class="link_wait_place col  <?php if (isset($getRequest->type) && $getRequest->type == 2) echo "active"; ?> navigation-page"><a class="viewstats" data-type="2" href="<?php echo build_pagination_url(1); ?>&type=2">Subid</a></div>   
        <div style="width: 110px;" class="link_wait_place col  <?php if (isset($getRequest->type) && $getRequest->type == 3) echo "active"; ?> navigation-page"><a class="viewstats" data-type="3" href="<?php echo build_pagination_url(1); ?>&type=3">Гео</a></div>
        <div style="width: 110px;" class="link_wait_place col  <?php if (isset($getRequest->type) && $getRequest->type == 4) echo "active"; ?> navigation-page"><a class="viewstats" data-type="4" href="<?php echo build_pagination_url(1); ?>&type=4">Потоки</a></div>
        <div style="width: 120px;" class="link_wait_place col  <?php if (isset($getRequest->type) && $getRequest->type == 5) echo "active"; ?> navigation-page"><a class="viewstats" data-type="5" href="<?php echo build_pagination_url(1); ?>&type=5">Лендинги</a></div>
        <div style="width: 140px;" class="link_wait_place col  <?php if (isset($getRequest->type) && $getRequest->type == 6) echo "active"; ?> navigation-page"><a class="viewstats" data-type="6" href="<?php echo build_pagination_url(1); ?>&type=6">Прелендинги</a></div>
        <div style="width: 130px;" class="link_wait_place col  <?php if (isset($getRequest->type) && $getRequest->type == 8) echo "active"; ?> navigation-page"><a class="viewstats" data-type="8" href="<?php echo build_pagination_url(1); ?>&type=8">Источники</a></div>
    </div>

    <div id="buttonsSort"  style=" 
    <?php
    if ($getRequest->type != 2) {
        echo 'display:none;';
    }
     
    ?>" class="row align-items-center text-center m-0">
        <div class="link_wait_place col allsub <?php
        if (!isset($getRequest->subidS) or $getRequest->subidS == 0) {
            echo "active";
        }
        ?>">
            <a class="viewstatsSub" data-sub="0" href="<?php echo build_pagination_url(1); ?>&subidS=0">Все SubId</a>
        </div>
        <div class="link_wait_place col <?php
        if (!isset($getRequest->subidS) or $getRequest->subidS == 1) {
            echo "active";
        }
        ?>">
            <a class="viewstatsSub" data-sub="1" href="<?php echo build_pagination_url(1); ?>&subidS=1">SubId 1</a>
        </div>
        <div class="link_wait_place col <?php
        if (!isset($getRequest->subidS) or $getRequest->subidS == 2) {
            echo "active";
        }
        ?>">
            <a class="viewstatsSub" data-sub="2" href="<?php echo build_pagination_url(1); ?>&subidS=2">SubId 2</a>
        </div>
        <div class="link_wait_place col <?php
        if (!isset($getRequest->subidS) or $getRequest->subidS == 3) {
            echo "active";
        }
        ?>">
            <a class="viewstatsSub" data-sub="3" href="<?php echo build_pagination_url(1); ?>&subidS=3">SubId 3</a>
        </div>
        <div class="link_wait_place col <?php
        if (!isset($getRequest->subidS) or $getRequest->subidS == 4) {
            echo "active";
        }
        ?>">
            <a class="viewstatsSub" data-sub="3" href="<?php echo build_pagination_url(1); ?>&subidS=4">SubId 4</a>
        </div>
        <div class="link_wait_place col <?php
        if (!isset($getRequest->subidS) or $getRequest->subidS == 5) {
            echo "active";
        }
        ?>">
            <a class="viewstatsSub" data-sub="3" href="<?php echo build_pagination_url(1); ?>&subidS=5">SubId 5</a>
        </div>            
    </div>	

</div>
    
<div class="col-12">
    
    <table class="table table-bordered text-center" id="stats_table">

        <tr class="tableHead">
            <td id="emptTd" <?php
            if (isset($getRequest->type) && $getRequest->type == 2 && (!isset($getRequest->subidS) or $getRequest->subidS == 0)) {
                echo 'colspan="5"';
            }
            ?>>&nbsp;</td>
            <td colspan="<?php if (isset($getRequest->type) && $getRequest->type == 6) {echo 3;}else{ echo 2;} ?>"><?php echo $loc['stats.php']['t10']; ?></td>
            <td colspan="5"><?php echo $loc['stats.php']['t11']; ?></td>
            <td colspan="4"><?php echo $loc['stats.php']['t12']; ?></td>
            <td style="display:none;" colspan="6">Качество трафа</td>

            <td colspan="3"><?php echo $loc['stats.php']['t13']; ?></td>
        </tr>	

        <tr id="tablesorts" class="tabletd">
            <?php
            if (!isset($getRequest->type) or $getRequest->type == 0) {
                ?>
                <td id="nameType" title="<?php echo $loc['stats.php']['t63']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_dates=<?php
                if (isset($getRequest->sort_dates) && $getRequest->sort_dates == 'desc') {
                    echo 'asc';
                } else {
                    echo 'desc';
                }
                ?>"><?php echo $loc['stats.php']['t14']; ?></a></nobr></td>
                    <?php
                } elseif (isset($getRequest->type) && $getRequest->type == 1) {
                    ?>  
            <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr><?php echo $loc['offers.php']['t03']; ?></nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 2) {
            if (!isset($getRequest->subidS) or $getRequest->subidS == 0) {
                ?>     
                <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 1</nobr></td>
                <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 2</nobr></td>
                <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 3</nobr></td>
                <td id="nameType" title="SubID 4"><nobr>SubID 4</nobr></td>
                <td id="nameType" title="SubID 5"><nobr>SubID 5</nobr></td>
                <?php
            } elseif (isset($getRequest->subidS) && $getRequest->subidS == 1) {
                ?>
                <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 1</nobr></td>
                <?php
            } elseif (isset($getRequest->subidS) && $getRequest->subidS == 2) {
                ?>
                <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 2</nobr></td>    
                <?php
            } elseif (isset($getRequest->subidS) && $getRequest->subidS == 3) {
                ?>
                <td id="nameType" title="<?php echo $loc['offers.php']['t03']; ?>"><nobr>SubID 3</nobr></td>  
                <?php
            } elseif (isset($getRequest->subidS) && $getRequest->subidS == 4) {
                ?>
                <td id="nameType" title="SubID 4"><nobr>SubID 4</nobr></td>  
                <?php
            } elseif (isset($getRequest->subidS) && $getRequest->subidS == 5) {
                ?>
                <td id="nameType" title="SubID 5"><nobr>SubID 5</nobr></td>  
                <?php
            }
        } elseif (isset($getRequest->type) && $getRequest->type == 3) {
            ?>  
            <td id="nameType" title="Страна"><nobr>Страна</nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 4) {
            ?>  
            <td id="nameType" title="Поток"><nobr>Поток</nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 5) {
            ?>  
            <td id="nameType" title="Лендинг"><nobr>Лендинг</nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 6) {
            ?>  
            <td id="nameType" title="Прелендинг"><nobr>Прелендинг</nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 7) {
            ?>  
            <td id="nameType" title="Устройство"><nobr>Устройство</nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 8) {
            ?>  
            <td id="nameType" title="Реферер"><nobr>Реферер</nobr></td>
            <?php
        } elseif (isset($getRequest->type) && $getRequest->type == 9) {
            ?>  
            <td id="nameType" title="Сортировка По часам"><nobr>По часам</nobr></td>
            <?php
        }
        ?>
        <td style="width: 75px;" title="<?php echo $loc['stats.php']['t64']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_click=<?php
            if (isset($getRequest->sort_click) && $getRequest->sort_click == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><?php echo $loc['stats.php']['t15']; ?></a></nobr></td>
        <td style="width: 75px;" title="<?php echo $loc['stats.php']['t65']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_hosts=<?php
            if (isset($getRequest->sort_hosts) && $getRequest->sort_hosts == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><?php echo $loc['stats.php']['t16']; ?></a></nobr></td>
    <?php
    if (isset($getRequest->type) && $getRequest->type == 6) {
    ?>
        <td style="width: 75px;" title="Переход с прелендинга на лендинг %"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_TL=<?php
            if (isset($getRequest->sort_TL) && $getRequest->sort_TL == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>">П->Л</a></nobr></td>
    <?php    
    }
    ?>
        <td style="width: 100px;"><a class="sortslink" title="Заказы в ожидании" href="<?php echo build_pagination_url(); ?>&sort_zakaz_wait=<?php
            if (isset($getRequest->sort_zakaz_wait) && $getRequest->sort_zakaz_wait == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><img src="./templates/<?php echo $template; ?>/img/wait.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t68']; ?>"></a></td>
        <td style="width: 100px;"><a class="sortslink" title="Подтвержденные заказы" href="<?php echo build_pagination_url(); ?>&sort_zakaz_all=<?php
            if (isset($getRequest->sort_zakaz_all) && $getRequest->sort_zakaz_all == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><img src="./templates/<?php echo $template; ?>/img/accept.gif" border="0" width="25px" ="<?php echo $loc['stats.php']['t66']; ?>"></a></td>
        <td style="width: 100px;"><a class="sortslink" title="Отмененные заказы" href="<?php echo build_pagination_url(); ?>&sort_zakaz_cancel=<?php
            if (isset($getRequest->sort_zakaz_cancel) && $getRequest->sort_zakaz_cancel == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><img src="./templates/<?php echo $template; ?>/img/deny.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t69']; ?>"></a></td>
        <td style="width: 100px;"><a class="sortslink" title="Все заказы" href="<?php echo build_pagination_url(); ?>&sort_zakaz_itogo=<?php
            if (isset($getRequest->sort_zakaz_itogo) && $getRequest->sort_zakaz_itogo == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>">&sum;</a></td>	
        <td style="width: 100px;"><a class="sortslink" title="Треш" href="<?php echo build_pagination_url(); ?>&sort_zakaz_trash=<?php
            if (isset($getRequest->sort_zakaz_trash) && $getRequest->sort_zakaz_trash == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><img src="./templates/<?php echo $template; ?>/img/trash.png" width="25px" border="0" title="<?php echo $loc['stats.php']['r1']; ?>"></a></td>	
        <td style="width: 100px;"><a class="sortslink" title="Комиссия в ожидании" href="<?php echo build_pagination_url(); ?>&sort_comission_wait=<?php
            if (isset($getRequest->sort_comission_wait) && $getRequest->sort_comission_wait == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><img src="./templates/<?php echo $template; ?>/img/wait.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t68']; ?>"></a></td>
        <td style="width: 100px;"><a class="sortslink" title="Комиссия подтвержденная" href="<?php echo build_pagination_url(); ?>&sort_comission_all=<?php
            if (isset($getRequest->sort_comission_all) && $getRequest->sort_comission_all == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><img src="./templates/<?php echo $template; ?>/img/accept.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t70']; ?>"></a></td>
        <td style="width: 100px;"><a class="sortslink" title="Комиссия в отмене" href="<?php echo build_pagination_url(); ?>&sort_comission_cancel=<?php
            if (isset($getRequest->sort_comission_cancel) && $getRequest->sort_comission_cancel == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><img src="./templates/<?php echo $template; ?>/img/deny.gif" width="25px" border="0" title="<?php echo $loc['stats.php']['t73']; ?>"></a></td>	

        <td style="width: 100px;"><a class="sortslink" title="Комиссия в мусоре" href="<?php echo build_pagination_url(); ?>&sort_comission_trash=<?php
            if (isset($getRequest->sort_comission_trash) && $getRequest->sort_comission_trash == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><img src="./templates/<?php echo $template; ?>/img/trash.png" width="25px" border="0" title="<?php echo $loc['stats.php']['r1']; ?>"></a></td>				
        <td  style="display: none;"><a class="sortslink" title="Среднее время на лендинге" href="<?php echo build_pagination_url(); ?>&sort_comission_avT=<?php
            if (isset($getRequest->sort_comission_avT) && $getRequest->sort_comission_avT == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>">avT</a>
        </td>
        <td style="display: none;">
            <a class="sortslink" title="В среднем меньше 15 сек. на лендинге" href="<?php echo build_pagination_url(); ?>&sort_comission_15sec=<?php
            if (isset($getRequest->sort_comission_15sec) && $getRequest->sort_comission_15sec == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><15сек</a>
        </td>
        <td style="display: none;">
            <a class="sortslink" title="В среднем кликов на лендинге" href="<?php echo build_pagination_url(); ?>&sort_comission_cl=<?php
            if (isset($getRequest->sort_comission_cl) && $getRequest->sort_comission_cl == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>">Клики</a>
        </td>
        <td style="display: none;">
            <a class="sortslink" title="В среднем кликов в форме на лендинге" href="<?php echo build_pagination_url(); ?>&sort_comission_form=<?php
            if (isset($getRequest->sort_comission_form) && $getRequest->sort_comission_form == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>">Форма</a>
        </td style="display: none;">
        <td style="display: none;">
            <a class="sortslink" title="В среднем скролл страницы на лендинге" href="<?php echo build_pagination_url(); ?>&sort_comission_scroll=<?php
            if (isset($getRequest->sort_comission_scroll) && $getRequest->sort_comission_scroll == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>">Скрол</a>
        </td>
        <td style="display: none;">
            <a class="sortslink" title="В среднем выделений на лендинге" href="<?php echo build_pagination_url(); ?>&sort_comission_vid=<?php
            if (isset($getRequest->sort_comission_vid) && $getRequest->sort_comission_vid == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>">Выделение</a>
        </td>
        <td style="width: 75px;" title="<?php echo $loc['stats.php']['t21']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_cr=<?php
            if (isset($getRequest->sort_cr) && $getRequest->sort_cr == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><?php echo $loc['stats.php']['t23']; ?></a></nobr></td>
        <td style="width: 75px;" title="<?php echo $loc['stats.php']['t22']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_epc=<?php
            if (isset($getRequest->sort_epc) && $getRequest->sort_epc == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><?php echo $loc['stats.php']['t24']; ?></a></nobr></td>
        <td style="width: 90px;" title="<?php echo $loc['stats.php']['t83']; ?>"><nobr><a class="sortslink" href="<?php echo build_pagination_url(); ?>&sort_approove=<?php
            if (isset($getRequest->sort_approove) && $getRequest->sort_approove == 'desc') {
                echo 'asc';
            } else {
                echo 'desc';
            }
            ?>"><?php echo $loc['stats.php']['t74']; ?></a></nobr></td>
        </tr> 



        <?php
        $where = [];
        if (isset($getRequest->offer) && $getRequest->offer != 0 && $getRequest->offer != '') {
            $where[] = ['where' => '`offer_id`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->offer) . "'"];
        }
        if (!empty($_GET['landings'])) {
            $where[] = ['where' => '`landing_id`', 'type' => '=', 'values' => "'" . htmlentities($_GET['landings']) . "'"];
        }
        if (!empty($_GET['prelandings'])) {
            $where[] = ['where' => '`prelanding_id`', 'type' => '=', 'values' => "'" . htmlentities($_GET['prelandings']) . "'"];
        }
        if (isset($_GET['device'])) {
            $mob = intval($_GET['device']);
            if ($mob > -1) {
                $where[] = ['where' => '`mobile`', 'type' => '=', 'values' => "'" . $mob . "'"];
            }
        }
        if (isset($getRequest->subid1) && $getRequest->subid1 != '') {
            $where[] = ['where' => '`subid1`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->subid1) . "'"];
        }
        if (isset($getRequest->subid2) && $getRequest->subid2 != '') {
            $where[] = ['where' => '`subid2`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->subid2) . "'"];
        }
        if (isset($getRequest->subid3) && $getRequest->subid3 != '') {
            $where[] = ['where' => '`subid3`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->subid3) . "'"];
        }
        if (isset($getRequest->subid4) && $getRequest->subid4 != '') {
            $where[] = ['where' => '`subid4`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->subid4) . "'"];
        }
        if (isset($getRequest->subid5) && $getRequest->subid5 != '') {
            $where[] = ['where' => '`subid5`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->subid5) . "'"];
        }
        if (isset($getRequest->country) && $getRequest->country != 'all' && $getRequest->country != '0') {
            $where[] = ['where' => '`short_country`', 'type' => '=', 'values' => "'" . htmlentities($getRequest->country) . "'"];
        } elseif (isset($getRequest->country) && $getRequest->country == 'all') {
            $where[] = ['where' => '`short_country`', 'type' => 'NOT IN', 'values' => "('RU','UA','BY','KZ','KG','MD','AM','GE')"];
        }

        if (isset($getRequest->type) && $getRequest->type == 2) {
            if (!empty($getRequest->subidS) && $getRequest->subidS == 1) {
                $subs = 'subid1 as sub,';
                $subs2 = 'subid1';
                $statsManager->groupBy = 'subid1';
            }
            if (!empty($getRequest->subidS) && $getRequest->subidS == 2) {
                $subs = 'subid2 as sub,';
                $subs2 = 'subid2';
                $statsManager->groupBy = 'subid2';
            }
            if (!empty($getRequest->subidS) && $getRequest->subidS == 3) {
                $subs = 'subid3 as sub,';
                $subs2 = 'subid3';
                $statsManager->groupBy = 'subid3';
            }
            if (!empty($getRequest->subidS) && $getRequest->subidS == 4) {
                $subs = 'subid4 as sub,';
                $subs2 = 'subid4';
                $statsManager->groupBy = 'subid4';
            }
            if (!empty($getRequest->subidS) && $getRequest->subidS == 5) {
                $subs = 'subid5 as sub,';
                $subs2 = 'subid5';
                $statsManager->groupBy = 'subid5';
            }
            if (!isset($getRequest->subidS) or $getRequest->subidS == 0) {
                $statsManager->bySubs = 'subid1,subid2,subid3,subid4,subid5,';
                $statsManager->bySubs2 = 0;
                $statsManager->groupBy = 'subid1,subid2,subid3,subid4,subid5';
            } else {
                $statsManager->bySubs = $subs;
                $statsManager->bySubs2 = $subs2;
            }
        }

        $statsManager->byDate = htmlentities($statsManager->dat1) . " " . $DT . "' AND '" . htmlentities($statsManager->dat2) . ' ' . $NT;


        /////
        /////   СОРТИРОВКА
        /////

        if (isset($getRequest->sort_dates) && $getRequest->sort_dates != '') {
            $statsManager->sortBy('date_s', htmlentities($getRequest->sort_dates));
        }

        if (isset($getRequest->sort_click) && $getRequest->sort_click != '') {
            $statsManager->sortBy('clicks', htmlentities($getRequest->sort_click));
        }
        if (isset($getRequest->sort_hosts) && $getRequest->sort_hosts != '') {
            $statsManager->sortBy('hosts', htmlentities($getRequest->sort_hosts));
        }
        if (isset($getRequest->sort_zakaz_wait) && $getRequest->sort_zakaz_wait != '') {
            $statsManager->sortBy('zakaz_wait', htmlentities($getRequest->sort_zakaz_wait));
        }
        if (isset($getRequest->sort_zakaz_all) && $getRequest->sort_zakaz_all != '') {
            $statsManager->sortBy('zakaz_all', htmlentities($getRequest->sort_zakaz_all));
        }
        if (isset($getRequest->sort_zakaz_cancel) && $getRequest->sort_zakaz_cancel != '') {
            $statsManager->sortBy('zakaz_cancel', htmlentities($getRequest->sort_zakaz_cancel));
        }
        if (isset($getRequest->sort_zakaz_trash) && $getRequest->sort_zakaz_trash != '') {
            $statsManager->sortBy('zakaz_trash', htmlentities($getRequest->sort_zakaz_trash));
        }
        if (isset($getRequest->sort_comission_wait) && $getRequest->sort_comission_wait != '') {
            $statsManager->sortBy('comission_wait', htmlentities($getRequest->sort_comission_wait));
        }
        if (isset($getRequest->sort_comission_all) && $getRequest->sort_comission_all != '') {
            $statsManager->sortBy('comission_all', htmlentities($getRequest->sort_comission_all));
        }
        if (isset($getRequest->sort_comission_cancel) && $getRequest->sort_comission_cancel != '') {
            $statsManager->sortBy('comission_cancel', htmlentities($getRequest->sort_comission_cancel));
        }
        if (isset($getRequest->sort_comission_trash) && $getRequest->sort_comission_trash != '') {
            $statsManager->sortBy('comission_trash', htmlentities($getRequest->sort_comission_trash));
        }
        if (isset($getRequest->sort_cr) && $getRequest->sort_cr != '') {
            $statsManager->sortBy('cr', htmlentities($getRequest->sort_cr));
        }
        if (isset($getRequest->sort_epc) && $getRequest->sort_epc != '') {
            $statsManager->sortBy('epc', htmlentities($getRequest->sort_epc));
        }
        if (isset($getRequest->sort_approove) && $getRequest->sort_approove != '') {
            $statsManager->sortBy('approove', htmlentities($getRequest->sort_approove));
        }
        
        if (isset($getRequest->sort_comission_vid) && $getRequest->sort_comission_vid != '') {
            $statsManager->sortBy('mselect', htmlentities($getRequest->sort_comission_vid));
        }
        if (isset($getRequest->sort_comission_scroll) && $getRequest->sort_comission_scroll != '') {
            $statsManager->sortBy('mscroll', htmlentities($getRequest->sort_comission_scroll));
        }
        if (isset($getRequest->sort_comission_form) && $getRequest->sort_comission_form != '') {
            $statsManager->sortBy('minput', htmlentities($getRequest->sort_comission_form));
        }
        if (isset($getRequest->sort_comission_cl) && $getRequest->sort_comission_cl != '') {
            $statsManager->sortBy('mclicks', htmlentities($getRequest->sort_comission_cl));
        }
        if (isset($getRequest->sort_comission_15sec) && $getRequest->sort_comission_15sec != '') {
            $statsManager->sortBy('m15s', htmlentities($getRequest->sort_comission_15sec));
        }
        if (isset($getRequest->sort_comission_avT) && $getRequest->sort_comission_avT != '') {
            $statsManager->sortBy('monline', htmlentities($getRequest->sort_comission_avT));
        }
        if (isset($getRequest->sort_zakaz_itogo) && $getRequest->sort_zakaz_itogo != '') {
            $statsManager->sortBy('zakaz_sum', htmlentities($getRequest->sort_zakaz_itogo));
        } 
        
        if (isset($getRequest->sort_TL) && $getRequest->sort_TL != '') {
            $statsManager->sortBy('TL', htmlentities($getRequest->sort_TL));
        }   
        
        if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type)) {
            if ($getRequest->type == 1) {
                $result = $statsManager->getByOffers($where, 10);
            } elseif ($getRequest->type == 2) {
                $result = $statsManager->getBySubsId($where, 10);
            } elseif ($getRequest->type == 3) {
                $result = $statsManager->getByCountrys($where, 10);
            } elseif ($getRequest->type == 4) {
                $result = $statsManager->getByStreams($where, 10);
            } elseif ($getRequest->type == 5) {
                $result = $statsManager->getByLandings($where, 10);
            } elseif ($getRequest->type == 6) {
                $result = $statsManager->getByPrelandings($where, 10);
            } elseif ($getRequest->type == 7) {
                $result = $statsManager->getByDevices($where, 10);
            } elseif ($getRequest->type == 8) {
                $result = $statsManager->getByReferer($where, 10);
            } elseif ($getRequest->type == 9) {
                $result = $statsManager->getByHours($where, 10);
            }
        } else {
            $result = $statsManager->getByDates($where, 10);
        }
        $cvet = 0;
        $hosts_all = 0;
        $clicks_all = 0;
        $zakaz_ok_alls = 0;
        $zakaz_sum = 0;
        $zakaz_wait_all = 0;
        $zakaz_cancel_all = 0;
        $zakaz_trash_all = 0;
        $comission_ok_alls = 0;
        $comission_wait_all = 0;
        $comission_cancel_all = 0;
        $comission_trash_all = 0;
        if (is_array($result) && count($result) > 0) {

            $start = 23;

            foreach ($result as $d => $res) {
                $clicks_all+=$res['clicks'];
                $hosts_all+=$res['hosts'];
                $zakaz_wait_all+=$res['zakaz_wait'];
                $zakaz_ok_alls+=$res['zakaz_all'];
                $zakaz_sum+=$res['zakaz_sum'];
                $zakaz_cancel_all+=$res['zakaz_cancel'];
                $zakaz_trash_all+=$res['zakaz_trash'];
                $comission_ok_alls+=$res['comission_all'];
                $comission_wait_all+=$res['comission_wait'];
                $comission_cancel_all+=$res['comission_cancel'];
                $comission_trash_all+=$res['comission_trash'];
                //$tl_all = $res['TL'];
                $url_zakaz = '';
                $url_zakaz_wait = '';
                $url_zakaz_all = '';
                $url_zakaz_sum = '';
                $url_zakaz_cancel = '';
                $url_zakaz_trash = '';
                if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type)) {
                    $date_zakaz1 = $dat1;
                    $date_zakaz2 = $dat2;
                } else {
                    $date_zakaz = explode("-", $res['date']);
                    $date_zakaz1 = $date_zakaz[2] . '.' . $date_zakaz[1] . '.' . $date_zakaz[0];
                    $date_zakaz2 = $date_zakaz[2] . '.' . $date_zakaz[1] . '.' . $date_zakaz[0];
                }
                $urla = '<a target="_blank" href="/zakaz.php?date1=' . $date_zakaz1 . '&date2=' . $date_zakaz2;
                if ($res['zakaz_wait'] != 0) {
                    $url_zakaz_wait = $urla . '&status=1';
                }
                if ($res['zakaz_all'] != 0) {
                    $url_zakaz_all = $urla . '&status=2';
                }
                if ($res['zakaz_cancel'] != 0) {
                    $url_zakaz_cancel = $urla . '&status=0';
                }
                if ($res['zakaz_trash'] != 0) {
                    $url_zakaz_trash = $urla . '&status=5';
                }

                $url_zakaz = '';
                $url_zakaz_wait = '';
                $url_zakaz_all = '';
                $url_zakaz_cancel = '';
                $url_zakaz_trash = '';
                if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type)) {
                    $date_zakaz1 = $dat1;
                    $date_zakaz2 = $dat2;
                } else {
                    $date_zakaz = explode("-", $res['date']);
                    $date_zakaz1 = $date_zakaz[2] . '.' . $date_zakaz[1] . '.' . $date_zakaz[0];
                    $date_zakaz2 = $date_zakaz[2] . '.' . $date_zakaz[1] . '.' . $date_zakaz[0];
                }
                $urla = '<a target="_blank" href="/zakaz.php?date1=' . $date_zakaz1 . '&date2=' . $date_zakaz2;
                if ($res['zakaz_wait'] != 0) {
                    $url_zakaz_wait = $urla . '&status=1';
                }
                if ($res['zakaz_all'] != 0) {
                    $url_zakaz_all = $urla . '&status=2';
                }
                if ($res['zakaz_cancel'] != 0) {
                    $url_zakaz_cancel = $urla . '&status=0';
                }
                if ($res['zakaz_trash'] != 0) {
                    $url_zakaz_trash = $urla . '&status=5';
                }

                if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type)) {

                    if ($getRequest->type == 1) {
                        $url_zakaz .= '&offer=' . $res['offer_id'];
                    } elseif ($getRequest->type == 2) {
                        if (isset($res['sub']) && $res['sub'] != '') {
                            $url_zakaz .= '&subid' . $getRequest->subidS . '=' . $res['sub'];
                        }
                        if (isset($res['subid1']) && $res['subid1'] != '') {
                            $url_zakaz .= '&subid1=' . $res['subid1'];
                        }
                        if (isset($res['subid2']) && $res['subid2'] != '') {
                            $url_zakaz .= '&subid2=' . $res['subid2'];
                        }
                        if (isset($res['subid3']) && $res['subid3'] != '') {
                            $url_zakaz .= '&subid3=' . $res['subid3'];
                        }
                        if (isset($res['subid4']) && $res['subid4'] != '') {
                            $url_zakaz .= '&subid4=' . $res['subid4'];
                        }
                        if (isset($res['subid5']) && $res['subid5'] != '') {
                            $url_zakaz .= '&subid5=' . $res['subid5'];
                        }
                    } elseif ($getRequest->type == 3) {
                        if (isset($res['country_iso']) && $res['country_iso'] != '') {
                            $url_zakaz .= '&country=' . $res['country_iso'];
                        }
                    } elseif ($getRequest->type == 4) {
                        if (isset($res['stream_id']) && $res['stream_id'] != '') {
                            $url_zakaz .= '&stream=' . $res['stream_id'];
                        }
                    }
                }

                if (isset($getRequest->offer) && $getRequest->offer != 0 && $getRequest->offer != '') {
                    $url_zakaz .= '&offer=' . $getRequest->offer;
                }
                if (!empty($_GET['landings'])) {
                    $url_zakaz .= '&landing_id=' . htmlentities($_GET['landings']);
                }
                if (!empty($_GET['prelandings'])) {
                    $url_zakaz .= '&prelanding_id=' . htmlentities($_GET['prelandings']);
                }
                if (isset($getRequest->subid1) && $getRequest->subid1 != '') {
                    $url_zakaz .= '&subid1=' . $getRequest->subid1;
                }
                if (isset($getRequest->subid2) && $getRequest->subid2 != '') {
                    $url_zakaz .= '&subid2=' . $getRequest->subid2;
                }
                if (isset($getRequest->subid3) && $getRequest->subid3 != '') {
                    $url_zakaz .= '&subid3=' . $getRequest->subid3;
                }
                if (isset($getRequest->subid4) && $getRequest->subid4 != '') {
                    $url_zakaz .= '&subid4=' . $getRequest->subid4;
                }
                if (isset($getRequest->subid5) && $getRequest->subid5 != '') {
                    $url_zakaz .= '&subid5=' . $getRequest->subid5;
                }
                if (isset($getRequest->country) && $getRequest->country != 'all' && $getRequest->country != '0') {
                    $url_zakaz .= '&country=' . $getRequest->country;
                }
                $url_zakaz .= '&count=100&submit=Вывести&page=1';

                if ($url_zakaz_wait != '') {
                    $url_zakaz_wait .= $url_zakaz . '">' . $res['zakaz_wait'] . '</a>';
                } else {
                    $url_zakaz_wait = $res['zakaz_wait'];
                }
                if ($url_zakaz_all != '') {
                    $url_zakaz_all .= $url_zakaz . '">' . $res['zakaz_all'] . '</a>';
                } else {
                    $url_zakaz_all = $res['zakaz_all'];
                }
                if ($url_zakaz_cancel != '') {
                    $url_zakaz_cancel .= $url_zakaz . '">' . $res['zakaz_cancel'] . '</a>';
                } else {
                    $url_zakaz_cancel = $res['zakaz_cancel'];
                }
                if ($url_zakaz_trash != '') {
                    $url_zakaz_trash .= $url_zakaz . '">' . $res['zakaz_trash'] . '</a>';
                } else {
                    $url_zakaz_trash = $res['zakaz_trash'];
                }
                $url_zakaz_sum = $res['zakaz_sum'];

                if ($getRequest->type == 9 && count($result) > 0 && !empty($result)) {
                    $end = $res['date'];
                    for ($i = $start; $i > $end; $i--) {
                        $start = $i;
                        echo '<tr>'
                        . '<Td>' . str_pad($i, 2, '0', STR_PAD_LEFT) . ':00:00 - ' . str_pad($i, 2, '0', STR_PAD_LEFT) . ':59:59</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>00:00</td>'
                        . '<td>0%</td>'
                        . '<td>0%</td>'
                        . '<td>0%</td>'
                        . '<td>0%</td>'
                        . '<td>0%</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '</tr>';
                    }
                    $start = $res['date']-1;
                }
                
                ?>
                <tr class="statrow <?php
                if ($cvet & 1) {
                    echo 'col2';
                } $cvet++;
                ?>">
                <?php
                    if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type)) {
                        if ($getRequest->type == 1) {
                            ?>
                            <td><nobr><a href="/offers.php?offer=<?= $res['offer_id']; ?>"><?= $res['name']; ?></a></nobr></td>
                                <?php
                            } elseif ($getRequest->type == 2) {

                                if (!isset($getRequest->subidS) or $getRequest->subidS == 0) {
                                    if($res['subid1'] == ''){$sub1_view = '-';}else{$sub1_view = $res['subid1'];}
                                    if($res['subid2'] == ''){$sub2_view = '-';}else{$sub2_view = $res['subid2'];}
                                    if($res['subid3'] == ''){$sub3_view = '-';}else{$sub3_view = $res['subid3'];}
                                    if($res['subid4'] == ''){$sub4_view = '-';}else{$sub4_view = $res['subid4'];}
                                    if($res['subid5'] == ''){$sub5_view = '-';}else{$sub5_view = $res['subid5'];}
                                    ?> 
                            <td><nobr><?= $sub1_view; ?></nobr></td>
                            <td><nobr><?= $sub2_view; ?></nobr></td>
                            <td><nobr><?= $sub3_view; ?></nobr></td>      
                            <td><nobr><?= $sub4_view; ?></nobr></td> 
                            <td><nobr><?= $sub5_view; ?></nobr></td> 
                    <?php
                }
                if (isset($getRequest->subidS) && $getRequest->subidS != 0) {
                    if($res['sub'] == ''){$sub_view = '-';}else{$sub_view = $res['sub'];}
                    ?>
                            <td><nobr><?= $sub_view; ?></nobr></td>    
                            <?php
                        }
                    } elseif ($getRequest->type == 3) {
                        ?>
                        <td><nobr><?= $res['short_country']; ?></nobr></td>    
                        <?php
                    } elseif ($getRequest->type == 4) {
                        if($res['stream_id'] == ''){$stream_view = 'Без потока';}else{$stream_view = $res['stream_name'];}
                        ?>
                        <td><nobr><?= $stream_view; ?></nobr></td>    
                        <?php
                    } elseif ($getRequest->type == 5) {
                        if($res['land']['name'] == ''){$land_view = 'Без прелендинга';}else{$land_view = $res['land']['name'];}
                        if($res['land']['url'] == ''){$landing_url = '';}else{$landing_url = $res['land']['url'];}
                        ?>
                        <td><nobr><?= $land_view; ?>                        
                        </nobr></td>    
                        <?php
                    } elseif ($getRequest->type == 6) {
                        if($res['preland'] == ''){$preland_view = 'Без прелендинга';}else{$preland_view = $res['preland'];}
                        ?>
                        <td><nobr><?= $preland_view; ?></nobr></td>    
                        <?php
                    } elseif ($getRequest->type == 7) {
                        ?>
                        <td><nobr><?= $res['mobile']; ?></nobr></td>    
                        <?php
                    } elseif ($getRequest->type == 8) {
                        if($res['refhost'] == ''){$ref_view = 'Без источника';}else{$ref_view = $res['refhost'];}
                        ?>
                        <td><nobr><?= $ref_view; ?></nobr></td>    
                        <?php
                    } elseif ($getRequest->type == 9) {
                        ?>
                        <td><nobr><?= $res['date']; ?>:00:00 - <?php echo $res['date']; ?>:59:59</nobr></td>    
                        <?php
                    }
                } else {
                    ?>
                    <td><nobr><A href='<?php echo build_pagination_url(1, ['type' => 9, 'hours' => true, 'date' => $res['date'] . ' - ' . $res['date']]); ?>' class="sortslink" style="text-decoration: underline;background:none"><?= $res['date']; ?></a></nobr></td>
                    <?php
                }
                ?>                         


                <td><nobr><?= $res['clicks']; ?></nobr></td>
                <td><nobr><?= $res['hosts']; ?></nobr></td>
                   <?php
                   if ($getRequest->type == 6) {
                   ?>
                <td><nobr><?= $res['TL']; ?> %</nobr></td>   
                   <?php
                   }
                   ?>
                <td><nobr><?= $url_zakaz_wait; ?></nobr></td>
                <td><nobr><?= $url_zakaz_all; ?></nobr></td>
                <td><nobr><?= $url_zakaz_cancel; ?></nobr></td>
                <td><nobr><?= $url_zakaz_sum; ?></nobr></td>
                <td><nobr><?= $url_zakaz_trash; ?></nobr></td>



                <td><nobr><?= sprintf("%.2f", $res['comission_wait']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                <td><nobr><?= sprintf("%.2f", $res['comission_all']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                <td><nobr><?= sprintf("%.2f", $res['comission_cancel']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                <td><nobr><?= sprintf("%.2f", $res['comission_trash']); ?>&nbsp;<?= $loc["stats.php"]["t26"]; ?>&nbsp;</nobr></td>
                <td  style="display: none;"><?php echo str_pad(round($res['monline'] / 60), 2, '0', STR_PAD_LEFT) ?>:<?php echo str_pad(round(($res['monline'] % 60)), 2, '0', STR_PAD_LEFT) ?></td>
                
                <td style="display: none;"><?php echo $res['m15s']; ?>%</td>
                <td style="display: none;"><?php echo round($res['mclicks']/100, 1); ?>%</td>
                <td style="display: none;"><?php echo round($res['minput']/100, 1); ?>%</td>
                <td style="display: none;"><?php echo round($res['mscroll']/100, 1); ?>%</td>
                <td style="display: none;"><?php echo round($res['mselect']/100, 1); ?>%</td>
                
                <td><nobr><?php
                        if (!empty($res['cr'])) {
                            echo round($res['cr'], 2);
                        } else {
                            echo 0;
                        }
                ?></nobr></td>
                <td><nobr><?php
                    if (!empty($res['epc'])) {
                        echo round($res['epc'], 2);
                    } else {
                        echo 0;
                    }
                    ?></nobr></td>
                <td><nobr><?php
                    if (!empty($res['approove'])) {
                        echo round($res['approove'], 2);
                    } else {
                        echo 0;
                    }
                    ?></nobr></td>
                </tr> 
                    <?php
                }

                if ($getRequest->type == 9 && count($result) > 0 && !empty($result)) {
                    $startHour = $result[count($result) - 1]['date'];
                    for ($i = $startHour - 1; $i >= 0; $i--) {
                        echo '<tr>'
                        . '<Td>' . str_pad($i, 2, '0', STR_PAD_LEFT) . ':00:00 - ' . str_pad($i, 2, '0', STR_PAD_LEFT) . ':59:59</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>00:00</td>'
                        . '<td>0%</td>'
                        . '<td>0%</td>'
                        . '<td>0%</td>'
                        . '<td>0%</td>'
                        . '<td>0%</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '<td>&mdash;</td>'
                        . '</tr>';
                    }
                }
            } else {
                ?>
            <tr height="80" class="<?php
            if ($cvet & 1) {
                echo 'col2';
            } $cvet++;
            ?>">
                <td class="text-center" <?php
                if (isset($getRequest->type) && $getRequest->type == 2) {
                    echo 'colspan="25"';
                } else {
                    echo 'colspan="21"';
                }
                ?>> Нет результатов по выбранным параметрам.</td>
            </tr>  
                    <?php
                }
                ?>

        <tr class="tabletd">
            <td style="width: 75px;" <?php
        if (isset($getRequest->type) && $getRequest->type == 2 && (!isset($getRequest->subidS) or $getRequest->subidS == 0)) {
            echo 'colspan="5"';
        }
                ?>><nobr><b><?php echo $loc['stats.php']['t27']; ?></b></nobr></td>
        <td style="width: 66px;"><nobr><?php echo $clicks_all; ?></nobr></td>
        <td style="width: 66px;"><nobr><?php echo $hosts_all; ?></nobr></td>
        <td style="width: 100px;min-width: 50px;"><nobr><?php echo $zakaz_wait_all; ?></nobr></td>
        <td style="width: 100px;min-width: 50px;"><nobr><?php echo $zakaz_ok_alls; ?></nobr></td>
        <td style="width: 100px;min-width: 50px;"><nobr><?php echo $zakaz_cancel_all; ?></nobr></td>
        <td style="width: 100px;min-width: 50px;"><nobr><?php echo $zakaz_sum; ?></nobr></td>
        <td style="width: 100px;min-width: 50px;"><nobr><?php echo $zakaz_trash_all; ?></nobr></td>
        <td style="width: 100px;"><nobr><?php echo sprintf("%.2f", $comission_wait_all); ?>&nbsp;<?php echo $loc['stats.php']['t26']; ?>&nbsp;</nobr></td>
        <td style="width: 100px;"><nobr><?php echo sprintf("%.2f", $comission_ok_alls); ?>&nbsp;<?php echo $loc['stats.php']['t26']; ?>&nbsp;</nobr></td>
        <td style="width: 100px;"><nobr><?php echo sprintf("%.2f", $comission_cancel_all); ?>&nbsp;<?php echo $loc['stats.php']['t26']; ?>&nbsp;</nobr></td>
        <td style="width: 100px;"><nobr><?php echo sprintf("%.2f", $comission_trash_all); ?>&nbsp;<?php echo $loc['stats.php']['t26']; ?>&nbsp;</nobr></td>
        <td style="width: 50px;"><nobr><?php
                if ($hosts_all != '0') {
                    echo round((($zakaz_ok_alls + $zakaz_cancel_all + $zakaz_wait_all + $zakaz_trash_all) / $hosts_all) * 100, 2);
                } else {
                    echo '0';
                }
                ?></nobr></td>
        <td style="width: 50px;"><nobr><?php
            if ($hosts_all != '0') {
                echo round(($comission_ok_alls) / $hosts_all, 2);
            } else {
                echo '0';
            }
            ?></nobr></td>		
        <td style="width: 90px;"><nobr>
            <?php
            if ($hosts_all != '0') {
                $kolvo_zakaz_all = $zakaz_wait_all + $zakaz_ok_alls + $zakaz_cancel_all;
                if ($kolvo_zakaz_all != '0') {
                    echo round($approve_all = 100 / $kolvo_zakaz_all * ($zakaz_ok_alls), 2);
                } else {
                    echo '0';
                }
            } else {
                echo '0';
            }
            ?>			
        </nobr></td>		
        </tr>  		
    </table>

</div>
</div>
</div>

<?php
include ('./templates/' . $template . '/checkform/datepicker_addscript_10.php');
?>
