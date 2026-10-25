
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

$countries = Offers_Country::getUseCountry();
$countries = Offers_Country::getNamesByIso($countries, $lang);
//$result = $mysqli->query("SELECT COUNT(id) AS count FROM `offers` WHERE `active`='1'");
?>

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
                <select name="category">
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
                <select name="geo" style="width: 70px">
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
    a.type{
        margin-left: 20px;
    }
    a.type.active{
        color: #2d5ea3;

        border-bottom-style: solid;
        border-bottom-color: #2d5ea3;
    }
</style>
<div id="js-ajax-content">
    <p>
        <b><?php echo $loc['offers.php']['t02']; ?></b>
        <a class="type <?php if (isset($getRequest->type) && $getRequest->type == 0) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&type=0"><?php echo $loc['offers.php']['filter_field_type_all']; ?></a>
        <a class="type <?php if (isset($getRequest->type) && $getRequest->type == 2) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&type=2"><?php echo $loc['offers.php']['filter_field_type_2']; ?></a>
        <a class="type <?php if (isset($getRequest->type) && $getRequest->type == 1) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&type=1"><?php echo $loc['offers.php']['filter_field_type_1']; ?></a>
    </p>
    <?php
    $perPage = 20;
    $offersManager->where('active', 1);

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
            <td width="550"><?php echo $loc['offers.php']['t03']; ?></td>	
            <td width=100>Tренды</td>	
            <td width="200"><?php echo $loc['offers.php']['t04']; ?></td>		
            <td width="220"><a href="offers.php?<?php echo build_pagination_url(); ?>&sort_comission=ok" class="normal_link navigation-page"><?php echo $loc['offers.php']['t05']; ?></a></td>
            <td width="70"><a href="offers.php?<?php echo build_pagination_url(); ?>&sort_cr=ok" class="normal_link navigation-page"><?php echo $loc['offers.php']['t06']; ?></a></td>
            <td width="70"><a href="offers.php?<?php echo build_pagination_url(); ?>&sort_epc=ok" class="normal_link navigation-page"><?php echo $loc['offers.php']['t07']; ?></a></td>
            <td width="15"><a href="offers.php?<?php echo build_pagination_url(); ?>&sort_status=ok" class="normal_link navigation-page"><?php echo $loc['offers.php']['t08']; ?></a></td>

        </tr>
    </table>

    <?php
    $cvet = 0;
    
    if (is_array($result) && count($result) > 0) {
        foreach ($result as $res) {
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
            // Получаем уровень доступа на оффере
            // Get access level to offer
            $offer_uroven_dostupa = htmlentities($res['uroven_dostupa']);
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
             = explode('|', trim($res['comission_cpa']));
            // Получаем тип комиссии
            // Get the type of commission
            $offer_tip_comission = explode('|', trim($res['tip_comission']));
            // Получаем информацию о активности оффера
            // Get information about offer activity
            $offer_active = htmlentities($res['active']);
            // Переводим переменную ГЕО в удобочитаемый вид
            // Translate variable GEO readable view
            $offer_geo = explode('|', trim($res['geo']));
            $offer_country_iso_arr = explode(':', $offer_geo[0]);
            $offer_region_id_arr = explode(':', $offer_geo[1]);

            //list($offer_country_iso, $offer_region_id) = explode('|', trim($offer_geo, '|'));

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
            <table class="stats_table" style="width: 100%; margin: 15px 0px 15px 0px;">
                <tr class="<?php
                if ($cvet & 1) {
                    echo 'col2';
                } else {
                    echo '';
                } $cvet++;
                ?>">
                    <td width="550">
                        <?php
                        // Проверка, назначено ли промо для оффера
                        // Check if the promo is scheduled to offer
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
                            <a href="./offers.php?offer=<?php echo $offer_id; ?>"><b><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></b></a><br /><nobr><font style="color: gray; font-weight: bold;"><?php echo $o_deystvie . ' / ' . $offer_category_name; ?></font></nobr><br />

                            <?php
                            if ($user_uroven_dostupa >= $offer_uroven_dostupa) {
                                ?>	
                                <font color=green><b><?php echo $loc['offers.php']['t13']; ?></b></font><br />
                                <a href="./offers.php?offer=<?php echo $offer_id; ?>"><div style="border: 1px solid green; float: left; padding: 3px; background: green; color: white;"><b><?php echo $loc['offers.php']['t15']; ?></b></div></a>
                                <?php
                            } else {
                                ?>	
                                <font color=red><b><?php echo $loc['offers.php']['t14']; ?></b></font><br />
                                <div style="border: 1px solid red; float: left; padding: 3px; background: red; color: white;"><b><?php echo $loc['offers.php']['t16']; ?></b></div>
                                <?php
                            }
                            ?>
                        </div>
                    </td>
                    <td width=20 style="line-height: 50px">
                        <a title="Yandex" style="text-decoration: none; border-bottom: 0" href="#" class="js-trands" data-offer="<?php echo $offer_id; ?>" data-type="yandex"><img width=16 src="https://cdn0.iconfinder.com/data/icons/social-flat-rounded-rects/512/yandex_bookmarks-128.png"></a><Br>
                        <div style="margin:5px" class="clearfix"></div>
                        <a title="Google" style="text-decoration: none; border-bottom: 0" href="#" class="js-trands" data-offer="<?php echo $offer_id; ?>" data-type="google"><img width=16 src="https://cdn4.iconfinder.com/data/icons/new-google-logo-2015/400/new-google-favicon-128.png"></a><Br>
                        <div style="margin:5px" class="clearfix"></div>
                        <a title="Publer" style="text-decoration: none; border-bottom: 0" href="#" class="js-trands" data-offer="<?php echo $offer_id; ?>" data-type="publer"><img width=16 src="https://publer.wildo.ru/favicon.ico"></a>
                        <div class=baloon style="position:absolute; display:none;">
                            <div style="padding: 20px; position:relative; top: -100px; left: 90px; width: 300px; height: 270px; box-sizing: border-box; background: white; border:1px solid #ccc">

                            </div>
                        </div>
                    </TD>
                    <td style="text-align: left; line-height: 18px; padding: 10px;">
                        <?php
                        echo $offer_geo;
                        ?>
                    </td>
                    <td width="220">
                        <?php echo $o_deystvie . '<br /><b style="font-size: 14px;">'; ?>
                        <table style="width:80%;text-align:center;margin: 0 auto;">
                            <?php
                            if (isset($offer_comission) && isset()) {

                                if (count($offer_tip_comission) > 0 && count($offer_tip_comission) == count($offer_comission)) {
                                    $i = 0;
                                    foreach ($offer_country_iso_arr as $key => $val) {
                                        echo '<tr height="25px">';
                                        $sql_geo = "SELECT name_ru FROM sxgeo_country WHERE `iso`='$val'";
                                        $result_geo = $mysqli->query($sql_geo);
                                        if (mysqli_num_rows($result_geo) > 0) {
                                            $res_geo = mysqli_fetch_array($result_geo);
                                            $geo_country_name = htmlentities($res_geo['name_ru']);
                                        } else {
                                            $geo_country_name = $loc['offers.php']['t09'];
                                        }

                                        if (!empty($val)) {
                                            echo '<td style="height: 20px;border:none;vertical-align:middle;padding:0;"><center><img style="display:block;" title="' . $geo_country_name . '" src=./modules/detectclient/SxGeo/img/' . strtolower($val) . '.png></center></td>';
                                            if ($offer_tip_comission[$i] == 1) {
                                                echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . ($offer_comission[$i]) . ' ' . $loc['offers.php']['t17'] . '</td>';
                                            } elseif ($offer_tip_comission[$i] == 2) {
                                                echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . ($offer_comission[$i]) . ' % </td>';
                                            }
                                        } else {
                                            if ($offer_tip_comission[$i] == 1) {
                                                echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . ($offer_comission[$i]) . ' ' . $loc['offers.php']['t17'] . '</td>';
                                            } elseif ($offer_tip_comission[$i] == 2) {
                                                echo '<td style="height: auto;border:none;vertical-align:middle;padding:0;">';
                                                echo ($offer_comission[$i]) . ' %</td>';
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

                    <?php
                    // Определяем CR и EPC у оффера
                    // Determine the CR and EPC have offer
                    $result_z1 = $mysqli->query("SELECT COUNT(id) AS kolvo_zakaz_all FROM `zakaz` WHERE `offer_id`='$offer_id' AND `status` IN ('3','1','2','0','5')");
                    $row_z1 = mysqli_fetch_assoc($result_z1);
                    $result_z2 = $mysqli->query("SELECT SUM(comission) AS vyplachennaya_summa FROM `zakaz` WHERE `offer_id`='$offer_id' AND `status`='3'");
                    $row_z2 = mysqli_fetch_assoc($result_z2);
                    $result_z3 = $mysqli->query("SELECT COUNT(id) AS hostov_po_offeru FROM `clients_log` WHERE `offer_id`='$offer_id' AND `user_id`!='0'");
                    $row_z3 = mysqli_fetch_assoc($result_z3);

                    ///////

                    $result_z4 = $mysqli->query("SELECT SUM(comission) AS hold_summa FROM `zakaz` WHERE `offer_id`='$offer_id' AND `status`='2'");
                    $row_z4 = mysqli_fetch_assoc($result_z4);
                    ///////

                    if ($row_z3['hostov_po_offeru'] != '0') {
                        if ($row_z1['kolvo_zakaz_all'] > 15) {
                            $cr_view = ($row_z1['kolvo_zakaz_all'] / $row_z3['hostov_po_offeru']) * 100;
                        } else {
                            $cr_view = '0';
                        }
                    } else {
                        $cr_view = '0';
                    }


                    if ($row_z3['hostov_po_offeru'] != '0') {
                        $epc_view = ($row_z2['vyplachennaya_summa'] + $row_z4['hold_summa']) / $row_z3['hostov_po_offeru'];
                    } else {
                        $epc_view = '0';
                    }
                    ?>

                    <td width="70">
                        <?php
                        if (round($cr_view, 2) == '0') {
                            echo $loc['offers.php']['t19'];
                        } else {
                            echo round($cr_view, 2);
                        }
                        ?>
                    </td>	
                    <td width="70">
                        <?php
                        if (round($epc_view, 2) == '0') {
                            echo $loc['offers.php']['t19'];
                        } else {
                            echo round($epc_view, 2);
                        }
                        ?>
                    </td>						
                    <?php if ($user_uroven_dostupa >= $offer_uroven_dostupa) { ?><td style="width: 15px; background: green;"></td><? } else { ?><td style="width: 15px; background: red;"></td><? }
                    ?>					
                </tr>
            </table>
            <?php
        }
    }
    ?>    
    <script src="./templates/<?php echo $template; ?>/js/ZeroClipboard.min.js"></script>
    <script src="./templates/<?php echo $template; ?>/js/ZeroClipboard.common.js"></script>

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
