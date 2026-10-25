<?php
// Вывод списка всех офферов
// Display a list of all offers
$offersManager = new Offers_Manager(DB::getInstance());
$getRequest = new Request($_GET);

function build_pagination_url($page = 1) {
    $parameters = array(
        'sort_id' => ( isset($_GET['sort_id']) ) ? $_GET['sort_id'] : '',
        'sort_cena' => ( isset($_GET['sort_cena']) ) ? $_GET['sort_cena'] : '',
        'sort_comission' => ( isset($_GET['sort_comission']) ) ? $_GET['sort_comission'] : '',
        'sort_status' => ( isset($_GET['sort_status']) ) ? $_GET['sort_status'] : '',
        'category' => (isset($_GET['category'])) ? $_GET['category'] : '',
        'keyword' => (isset($_GET['keyword'])) ? $_GET['keyword'] : '',
        'price1' => (isset($_GET['price1'])) ? $_GET['price1'] : '',
        'price2' => (isset($_GET['price2'])) ? $_GET['price2'] : '',
        'type' => (isset($_GET['type'])) ? $_GET['type'] : '',
        'geo' => (isset($_GET['geo'])) ? $_GET['geo'] : '',
        'page' => $page
    );
    return '?' . http_build_query($parameters);
}

$lang = 'ru';
if (isset($_SESSION['language'])) {
    $lang = substr($_SESSION['language'], 0, 2);
}

$countries = Offers_Country::getUseCountry(false);
$countries = Offers_Country::getNamesByIso($countries, $lang);
//$result = $mysqli->query("SELECT COUNT(id) AS count FROM `offers`");
?>
<script>
(function($) {
$(function() {

  $('input, select').styler({
    selectSearch: true,
    selectSearchLimit: 12,
  });

})
})(jQuery)

</script>
<p>
    <b><?php echo $loc['offers.php']['filter_title']; ?></b>
</p>
<form class="js-ajax-filter" action="?" method="get">
    <?php
    foreach ($_GET as $k => $v) {
        if (in_array($k, array('page', 'category', 'keyword', 'price1', 'price2', 'type', 'geo'))) {
            continue;
        }
        echo "<input type=hidden name='" . htmlentities($k, ENT_QUOTES) . "' value='" . htmlentities($v, ENT_QUOTES) . "' />" . PHP_EOL;
    }
    ?>
    <table class="filter_table" style="width: 100%; background: #f0f0f0;" cellpadding="5">
        <tr>
            <Td width="320">
                <?php echo $loc['offers.php']['filter_field_category']; ?> 
                <select name="category" class="width-150">
                    <option <?php if (!$getRequest->category) echo ' selected '; ?> value="0"><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                    <?php
                    foreach (Offers_Category::getAll(Offers_Category::NO_EMPTY) as $_cat) {
                        $s = '';
                        if ($_cat->id == $getRequest->category) {
                            $s = ' selected ';
                        }
                        echo "<option " . $s . " value='" . $_cat->id . "'>" . $_cat->name . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td width="360">
                <?php echo $loc['offers.php']['filter_field_keyword']; ?> 
                <input type="text" size="13" placeholder="<?php echo $loc['offers.php']['filter_field_keyword_placeholder']; ?>" name="keyword" value="<?php echo htmlentities($getRequest->keyword); ?>">
            </td>
            <td width="320">
                <?php echo $loc['offers.php']['filter_field_price']; ?> 
                <input type="text" placeholder="<?php echo $loc['offers.php']['filter_field_priceFrom']; ?>" size=3 style="text-align:center" name="price1" value="<?php echo htmlentities($getRequest->price1); ?>">
                -
                <input type="text" placeholder="<?php echo $loc['offers.php']['filter_field_priceTo']; ?>" size=3 style="text-align:center" name="price2" value="<?php echo htmlentities($getRequest->price2); ?>">
            </td>
            <td width="180">
                <?php echo $loc['offers.php']['filter_field_geo']; ?> 
                <select name="geo" class="width-100">
                    <option value=""><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                    <?php
                    foreach ($countries as $iso => $name) {
                        echo '<option value="' . $iso . '">' . $name . '</option>' . PHP_EOL;
                    }
                    ?>

                </select>
            </td>
        </tr>
    </table>
</form>
<style>
    td.vip{
        background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAGCAYAAADgzO9IAAAAMElEQVQYV2NkYGBg+H+I6z+IhgFGu2+MjOiCcEmYBEgVsm64DpwSyHaA2CjakS0HAFVzGy/IbRf5AAAAAElFTkSuQmCC)
    }
    a.type{
        margin-left: 20px;
    }
    a.type.active{
        color: #2d5ea3;
        border-bottom-style: solid;
        border-bottom-color: #2d5ea3;
    }
    a.callcenter_info div.callcenter_info{
        display: none;
    }
    div.callcenter_info{
        position: absolute;
        display: none;
        float: right;
        background: rgba(0,0,0,0.8);
        color: white;
        font-size: 90%;
        font-weight: 300;
        padding: 10px;
        max-width: 600px;
        border-radius: 5px;
    }
    a.callcenter_info:hover div{
        display:block;
    }
</style>
<div id="js-ajax-content">


    <p>
        <b><?php echo $loc['offers.php']['t02']; ?>&nbsp;</b>[<a href="./offers.php?addoffer=ok"><?php echo $loc['offers.php']['t150']; ?></a>]
        <a class="type <?php if (isset($getRequest->type) && $getRequest->type == 0) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&type=0"><?php echo $loc['offers.php']['filter_field_type_all']; ?></a>
        <a class="type <?php if (isset($getRequest->type) && $getRequest->type == 2) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&type=2"><?php echo $loc['offers.php']['filter_field_type_2']; ?></a>
        <a class="type <?php if (isset($getRequest->type) && $getRequest->type == 1) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&type=1"><?php echo $loc['offers.php']['filter_field_type_1']; ?></a>

    </p>
    <?php
    $perPage = 20;
//$offersManager->where('active', 1);
    if (isset($getRequest->geo) && $getRequest->geo != '') {
        $offersManager->where('geo', $getRequest->geo, Offers_Manager::WHERE_LIKE);
    }
    if (isset($getRequest->type) && $getRequest->type > 0 && is_numeric($getRequest->type)) {
        $offersManager->where('`type`', $getRequest->type);
    }
    if (isset($getRequest->price1) && $getRequest->price1 > 0) {
        $offersManager->where('(comission+0)', intval($getRequest->price1), '>=');
    }
    if (isset($getRequest->price2) && $getRequest->price2 > 0) {
        $offersManager->where('(comission+0)', intval($getRequest->price2), '<=');
    }
    if (isset($getRequest->keyword) && $getRequest->keyword != '') {
        $offersManager->where('name', $getRequest->keyword, Offers_Manager::WHERE_LIKE);
    }
    if (isset($getRequest->category) && is_numeric($getRequest->category) && $getRequest->category > 0) {
        $offersManager->where('category', $getRequest->category);
    }

    if (isset($getRequest->page) && $getRequest->page > 0) {
        $offersManager->offset($perPage * (intval($getRequest->page) - 1 ));
    }
    $offersManager->limit($perPage);
    if (isset($getRequest->sort_status) && $getRequest->sort_status == 'ok') {
        $offersManager->sortByRaw('active desc, uroven_dostupa asc');
    }
    if (isset($getRequest->sort_comission) && $getRequest->sort_comission == 'ok') {
        $offersManager->sortBy('0+comission', 'desc');
    }
    if (isset($getRequest->sort_cena) && $getRequest->sort_cena == 'ok') {
        $offersManager->sortBy('cena', 'desc');
    }
    if (isset($getRequest->sort_cr) && $getRequest->sort_cr == 'ok') {
        $offersManager->sortBy('cr', 'desc');
    }
    if (isset($getRequest->sort_epc) && $getRequest->sort_epc == 'ok') {
        $offersManager->sortBy('epc', 'desc');
    }

    $result = $offersManager->get();
    $pagination_fetched_row = array('count' => $offersManager->getTotal());
    ?>
    <p>
        <?php
        // Вывод количества страниц
        // Display the number of pages
        pagination($result, $perPage, 11);
        ?>
    </p>

    <p>
    <table class="stats_table" style="width: 100%;">
        <tr class="table_zagolovki">
            <td><?php echo $loc['offers.php']['t03']; ?></td>	
            <td>Тренды</td>	
            <td width="170"><a href="offers.php?<?php echo build_pagination_url(); ?>&sort_cena=ok" class="normal_link navigation-page"><?php echo $loc['offers.php']['t156']; ?></a></td>		
            <td width="140"><a href="offers.php?<?php echo build_pagination_url(); ?>&sort_comission=ok" class="normal_link navigation-page"><?php echo $loc['offers.php']['t157']; ?></a></td>
             <td width="120">Реклы и баланс</td>
            <td width="120"><?php echo $loc['offers.php']['t158']; ?></td>
            <td width="15"><a href="offers.php?<?php echo build_pagination_url(); ?>&sort_status=ok" class="normal_link navigation-page"><?php echo $loc['offers.php']['t159']; ?></a></td>

        </tr>

        <?php
        $cvet = 0;
        if (is_array($result) && count($result) > 0) {
            foreach ($result as $res) {
                $owner_this = [];
                ?>
                <tr><td colspan="6"><p></p></td></tr>
                <?php
                echo '<tr>';
                // Получаем ID оффера
                // Get the ID offer
                $offer_id = htmlentities($res['id']);
                // Получаем название оффера
                // Get the name of the offer
                $offer_name = htmlentities($res['name']);
                // Узнаем категорию оффера
                // Learn category offer
                $offer_category = htmlentities($res['category']);
                $sql_category = "SELECT name FROM category_tpl WHERE `id`='$offer_category'";
                $result_category = $mysqli->query($sql_category);
                $res_category = mysqli_fetch_array($result_category);
                $offer_category_name = htmlentities($res_category['name']);

                // CR & EPC
                $offer_cr = htmlentities($res['cr']);
                $offer_epc = htmlentities($res['epc']);

                // Получаем ГЕО по офферу
                // Get GEO offer
                $offer_geo = htmlentities($res['geo']);
                // Получаем цену на оффере
                // Get the price of the offer
                $offer_cena = explode('|', trim($res['cena']));
                // Получаем комиссию вебмастеру на оффере
                // Get the commission webmaster to offer
                $offer_comission = explode('|', trim($res['comission']));
                // Получаем комиссию CPA-сети на оффере
                // Get the CPA-network comission on offer
                $offer_comission_cpa = explode('|', trim($res['comission_cpa']));
                // Получаем тип комиссии
                // Get the type of commission
                $offer_tip_comission = explode('|', trim($res['tip_comission']));
                // Получаем информацию о активности оффера
                // Get information about offer activity
                $offer_active = htmlentities($res['active']);
                // Переводим переменную ГЕО в удобный вид
                // Translate variable GEO convenient form
                $offer_geo = explode('|', trim($res['geo']));
                $offer_country_iso_arr = explode(':', $offer_geo[0]);
                $offer_region_id_arr = explode(':', $offer_geo[1]);
                //list($offer_country_iso1, $offer_region_id1, $offer_city_id1) = explode('|', trim($offer_geo, '|'));

                $offer_geo = '<center>';
                if (count($offer_country_iso_arr) > 0) {
                    foreach ($offer_country_iso_arr as $key => $val) {

                        $sql_geo = "SELECT name_ru FROM sxgeo_country WHERE `iso`='$val'";
                        $result_geo = $mysqli->query($sql_geo);
                        if (mysqli_num_rows($result_geo) > 0) {
                            $res_geo = mysqli_fetch_array($result_geo);
                            $geo_country_name = htmlentities($res_geo['name_ru']);
                        } else {
                            $geo_country_name = $loc['offers.php']['t09'];
                        }
                        if (!empty($val)) {
                            $offer_geo.= '<img title="' . $geo_country_name . '" src=./modules/detectclient/SxGeo/img/' . strtolower($val) . '.png> &nbsp;';
                        } else {
                            $offer_geo.=$loc['offers.php']['t09'];
                        }
                    }
                } else {
                    $offer_geo.=$loc['offers.php']['t09'];
                }
                $offer_geo.='</center>';

                // определяем по ID действия, что это за действие
                // Define the ID for action, what kind of action
                $o_deystvie = htmlentities($res['deystvie']);
                $o_sql = "SELECT deystvie FROM deystvie_tpl WHERE `id`='$o_deystvie'";
                $o_result = $mysqli->query($o_sql);
                $o_res = mysqli_fetch_array($o_result);

                // Получаем название действия
                // Get the name of the action
                $o_deystvie = htmlentities($o_res['deystvie']);
                ?> 
                <tr class="<?php
                if ($cvet & 1) {
                    echo 'col2';
                } else {
                    echo '';
                } $cvet++;
                ?>">
                    <td width="650">
                        <?php
                        // Проверка, назначено ли промо для оффера.
                        // Check if the promo is scheduled to offer.
                        if (file_exists('./tmp/offer' . $offer_id . '.jpg')) {
                            ?>
                            <a style="border: 0; text-decoration: none;" href="./offers.php?offer=<?php echo $offer_id; ?>">
                                <img class="cropimage_spisok" src="./tmp/offer<?php echo $offer_id; ?>.jpg">
                            </a>
                            <?php
                        } else {
                            ?>
                            <a style="border: 0; text-decoration: none;" href="./offers.php?offer=<?php echo $offer_id; ?>">
                                <div class="cropimage_spisok"></div>
                            </a>
                            <?php
                        }
                        ?>
                        <div style="text-align: left; margin-top: 8px; line-height: 21px;">
                            <a href="./offers.php?offer=<?php echo $offer_id; ?>"><b><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></b></a>
                            <?
                                                                            if($res['callcenter_info']!=''){
                                                                                echo '<a class=callcenter_info style="float:right"><img src=/images/headphones.png>'
                                                                                . '<div class=callcenter_info><b>Режим работы КЦ: </b><BR><br>'.nl2br($res['callcenter_info']).'</div></a>';
                                                                            }
                                                                        ?>
                            <br /><nobr><font style="color: gray; font-weight: bold;"><?php echo $o_deystvie . ' / ' . $offer_category_name; ?></font></nobr><br />
                            <?php if ($offer_active == "2") { ?><span style="background: yellow; color: red;">&nbsp;<?php echo $loc['offers.php']['t160']; ?>&nbsp;</span><?
                            }
                            if ($offer_active == "1") {
                                ?><span style="background: green; color: white;">&nbsp;<?php echo $loc['offers.php']['t161']; ?>&nbsp;</span><?
                            }
                            if ($offer_active == "0") {
                                ?><span style="background: red; color: white;">&nbsp;<?php echo $loc['offers.php']['t162']; ?>&nbsp;</span><?
                            }

                            // Определяем CR и EPC оффера
                            $cr_view = $epc_view = 0;
                            $data_fake = Offer::getFakeCrAndEpcFor($offer_id);
                            $cr_view = $data_fake->cr;
                            $epc_view = $data_fake->epc;
                            
                            $data_real = Offer::getRealCrAndEpcFor($offer_id);
                            $cr_view_real = $data_real->cr;
                            $epc_view_real = $data_real->epc;
                            
                            ?>
                            <b><small>
                                    <span title="Fake" style='padding:3px; background: #ffaaaa;font-size:12px;'>CR<sup></sup>: <?php echo round(floatval($cr_view),2);?></span>
                                    <span title="Fake" style='padding:3px; background: #ffaaaa;font-size:12px;'>EPC<sup></sup>: <?php echo round(floatval($epc_view),2);?></span>
                                    <span title="Real" style='padding:3px; background: #aaffaa;font-size:12px;'>CR<sup></sup>: <?php echo round(floatval($cr_view_real),2);?></span>
                                    <span title="Real" style='padding:3px; background: #aaffaa;font-size:12px;'>EPC<sup></sup>: <?php echo round(floatval($epc_view_real),2);?></span>
                                    <span style='padding:3px; background: #ffffaa;font-size:12px;'>Leads<sup></sup>: <?php echo $data_real->leads;?></span>
                                    <input <?php if($res['real_cr'])echo'checked ';?> accept=""onclick="$.post('?',{action:'changeRealCr', id: <?php echo $offer_id;?>, val: this.checked?1:0});" type='checkbox'>real
                                
                            </small>
                            <br>
                            <div><a onclick="$(this).parent().find('div').slideToggle();;return false" href="#">Admin Comments <?php if ($res['admin_comments'] != '') echo '<font color=red>*</font>'; ?></a><div style="display:none"  ><br><textarea class="js-admin-comments" data-id="<?php echo $offer_id; ?>" style="width:90%;heigth:150px;" rows="5" placeholder="Комментарии к оферу, видны только админу"><?php echo $res['admin_comments']; ?></textarea></div></div>
                                                        </div>
                                                        
                                                    </td>
                                                    <td style="line-height: 50px">
                        <?php if ($res['keyword'] != '') { ?>
                                                                        <a data-keyword="<?php echo $res['keyword'];?>" title="Yandex" style="text-decoration: none; border-bottom: 0" href="#" class="js-trands" data-offer="<?php echo $offer_id; ?>" data-type="yandex"><img width=16 src="https://cdn0.iconfinder.com/data/icons/social-flat-rounded-rects/512/yandex_bookmarks-128.png"></a><Br>
                                                                        <div style="margin:5px" class="clearfix"></div>
                                                                        <a data-keyword="<?php echo $res['keyword'];?>" title="Google" style="text-decoration: none; border-bottom: 0" href="#" class="js-trands" data-offer="<?php echo $offer_id; ?>" data-type="google"><img width=16 src="https://cdn4.iconfinder.com/data/icons/new-google-logo-2015/400/new-google-favicon-128.png"></a><Br>
                                                                        <div style="margin:5px" class="clearfix"></div>
                                                                        <a data-keyword="<?php echo $res['keyword'];?>" title="Publer" style="text-decoration: none; border-bottom: 0" href="#" class="js-trands" data-offer="<?php echo $offer_id; ?>" data-type="publer"><img width=16 src="https://publer.wildo.ru/favicon.ico"></a>
                                                                        <div class=baloon style="position:absolute; display:none;">
                                                                            <div style="padding: 20px; position:relative; top: -100px; left: 90px; width: 300px; height: 350px; box-sizing: border-box; background: white; border:1px solid #ccc">

                                                                            </div>
                                                                        </div>
                                                                         <div style="margin:5px" class="clearfix"></div>
                                                                        
                                                                        
                        <?php } ?>
                                                    </TD>
                                                    
                                                    <td width="200">
                                                        <table style="width:90%;text-align:center;margin: 0 auto;">
                            <?php
                            if (isset($offer_cena) && $offer_cena != '0') {

                                if (count($offer_country_iso_arr) > 0) {
                                    $i = 0;
                                    $max = count($offer_country_iso_arr);
                                    $iter = 0;
                                    foreach ($offer_country_iso_arr as $key => $val) {
                                        $iter++;
                                        if ($iter == 10) {
                                            echo "<tr class=more{$offer_id} height=25><td colspan=2><a onclick=\"$('.more$offer_id').hide();$('.geo$offer_id').show();return false;\" href=#>Показать все</a></td></tr>";
                                            
                                        }
                                        echo '<tr class=geo'.$offer_id.' height="25px" ' . (($iter >= 10) ? 'style="display:none"' : '') . '>';
                                        $sql_geo = "SELECT name_ru,currency FROM sxgeo_country WHERE `iso`='$val'";
                                        $result_geo = $mysqli->query($sql_geo);
                                        if (mysqli_num_rows($result_geo) > 0) {
                                            $res_geo = mysqli_fetch_array($result_geo);
                                            $geo_country_name = htmlentities($res_geo['name_ru']);
                                            $currency = htmlentities($res_geo['currency']);
                                        } else {
                                            $geo_country_name = $loc['offers.php']['t09'];
                                            $currency = $loc['offers.php']['t17'];
                                        }

                                        $price = ($offer_cena[$i] != 0) ? $offer_cena[$i] : $loc['offers.php']['t29'];
                                        $curr = ($offer_cena[$i] != 0) ? $currency : '';
                                        if (!empty($val) && count($offer_cena) == count($offer_country_iso_arr)) {
                                            echo '<td style="height: 20px;border:none;vertical-align:middle;padding:0;"><center><img style="display:block;" title="' . $geo_country_name . '" src=./modules/detectclient/SxGeo/img/' . strtolower($val) . '.png></center></td>';
                                            echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;"> ' . $price . ' ' . $curr . '</td>';
                                        } else {
                                            echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">';
                                            echo $price . ' ' . $curr . '</td>';
                                        }
                                        echo '</tr>';
                                        $i++;
                                    }
                                }
                            } else {
                                echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">&nbsp;';
                                echo $loc['offers.php']['t29'] . '&nbsp;</td>';
                            }
                            ?>
                                                </tr>
                                            </table>
                                        </td>	
                                        <td width="220">
                                            <table style="width:90%;text-align:center;margin: 0 auto;">
                <?php
if (isset($offer_comission) && isset($offer_comission_cpa)) {

                    if (count($offer_tip_comission) > 0 && count($offer_tip_comission) == count($offer_comission)) {
                        $i = 0;
                        $iter = 0;
                        $max = count($offer_country_iso_arr);
                        foreach ($offer_country_iso_arr as $key => $val) {
                            $iter++;
                            if ($iter == 10) {
                                echo "<tr class=more{$offer_id} height=25><td colspan=2><nobr><a onclick=\"$('.more$offer_id').hide();$('.geo$offer_id').show();return false;\" href=#>Показать все</a></td></tr>";
                            }
                            echo '<tr class=geo'.$offer_id.' height="25px" ' . (($iter >= 10) ? 'style="display:none"' : '') . '>';
                            $sql_geo = "SELECT name_ru FROM sxgeo_country WHERE `iso`='$val'";
                            $result_geo = $mysqli->query($sql_geo);
                            if (mysqli_num_rows($result_geo) > 0) {
                                $res_geo = mysqli_fetch_array($result_geo);
                                $geo_country_name = htmlentities($res_geo['name_ru']);
                            } else {
                                $geo_country_name = $loc['offers.php']['t09'];
                            }

                            if (count($offer_comission) == count($offer_comission_cpa)) {
                                $comission_cpa1 = $offer_comission_cpa[$i];
                            } else {
                                $comission_cpa1 = 0;
                            }

                            if (!empty($val)) {
                                echo '<td style="height: 20px;border:none;vertical-align:middle;padding:0;"><center><img style="display:block;" title="' . $geo_country_name . '" src=./modules/detectclient/SxGeo/img/' . strtolower($val) . '.png></center></td>';
                                if ($offer_tip_comission[$i] == 1) {
                                    echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . $offer_comission[$i] .'+'. $comission_cpa1 . ' ' . $loc['offers.php']['t17'] . '</td>';
                                } elseif ($offer_tip_comission[$i] == 2) {
                                    echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . $offer_comission[$i] .'+'. $comission_cpa1 . ' % </td>';
                                }
                            } else {
                                if ($offer_tip_comission[$i] == 1) {
                                    echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . $offer_comission[$i] .'+'. $comission_cpa1 . ' ' . $loc['offers.php']['t17'] . '</td>';
                                } elseif ($offer_tip_comission[$i] == 2) {
                                    echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">';
                                    echo ($offer_comission[$i] + $comission_cpa1) . ' %</td>';
                                }
                            }

                            echo '</tr>';
                            $i++;
                        }
                    }
                } else {
                    echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . $loc['offers.php']['t47'] . '</td>';
                }
                ?>
                                            </table>					
                                        </td>	
                                        <td style="min-width:170px;">
                               <?php
                                $offer = Offer::getById($res['id']);
                                $iso = $offer->getISOCountries();
                                $owners = Offer::getOfferOwners($res['id']);
                                $def_owner = User::getById($offer->owner_id);
                                $def_o = $def_owner['alias'];
                                $def_o_bal = ($def_owner['balance'] > 1000) ? '<font color="green">('.$def_owner['balance'].')</font>': '<font color="red">('.$def_owner['balance'].')</font>';
                                $owner_this[0] = ['owner' => $def_o, 'balance' => $def_o_bal, 'andOther' => 1];
                                if (count($owners) > 0) {
                                    foreach ($owners as $o){
                                        $owner = User::getById($o->owner_id);
                                        $ow = $owner['alias'];
                                        $bal = $owner['balance'];
                                        $bal = ($bal > 1000) ? '<font color="green">('.$bal.')</font>': '<font color="red">('.$bal.')</font>';                                        
                                        $owner_this[$o->country_iso] = ['owner' => $ow, 'balance' => $bal, 'andOther' => $o->andOther];   
                                        if($o->andOther == 1){
                                            $default_owner = $owner['alias'];
                                            $default_owner_bal = $owner['balance'];
                                            $default_owner_bal = ($default_owner_bal > 1000) ? '<font color="green">('.$default_owner_bal.')</font>': '<font color="red">('.$default_owner_bal.')</font>';
                                            $owner_this[0] = ['owner' => $default_owner, 'balance' => $default_owner_bal, 'andOther' => 1];                                            
                                        }                                         
                                    } 
                                }

                                foreach ($iso as $c_iso){
                                    echo '<p>';   
                                    if(!empty($c_iso)){
                                        echo '<img src="./modules/detectclient/SxGeo/img/'. strtolower($c_iso) .'.png">&nbsp ';
                                        if (array_key_exists($c_iso, $owner_this)) {
                                            $owner_data = $owner_this[$c_iso];
                                        }else{
                                            $owner_data = $owner_this[0];
                                        }
                                    }else{
                                        echo 'Без огр.';
                                        $owner_data = $owner_this[0];
                                    }
                                    echo $owner_data['owner'].' '.$owner_data['balance'];
                                    echo '</p>';
                                }                           
                                ?>                                            

                                        </td>                                         
                                        
                                        <td width="70">
        <?php
            $uroven_dostupa = htmlentities($res['uroven_dostupa']);
            $sql_ur_v = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `uroven_dostupa`='$uroven_dostupa' AND `tip_account`='10'";
            $result_ur_v = $mysqli->query($sql_ur_v);
            $res_ur_v = mysqli_fetch_array($result_ur_v);
            
            if( $uroven_dostupa == -1){
                echo "<font color=blue>Закрытый офер</font>";
            }else{
                echo htmlentities($res_ur_v['opisanie']);
            }
            ?>
                                        </td>	
        <?php if ($offer_active == "2") { ?><td style="width: 5px; background: yellow;"></td>
            <?
        }
        if ($offer_active == "1") {
            ?><td style="width: 5px; background: green;"></td><?
        }
        if ($offer_active == "0") {
            ?><td style="width: 5px; background: red;"></td><?
        }
        echo '</tr>';
    }
}
?>    
</table>
</p>
<p>
<?php
// Вывод количества страниц
// Display the number of pages
    pagination($pagination_fetched_row, 20, 11);
    ?>
</p>
</div>
<script src="./templates/<?php echo $template; ?>/js/offers/list.js"></script>
<script src="./templates/<?php echo $template; ?>/js/admin/list_offer.js"></script>