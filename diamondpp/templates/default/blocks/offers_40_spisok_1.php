<script>
    (function ($) {
        $(function () {

            $('input, select').styler({
                selectSearch: true,
                selectSearchLimit: 12,
            });

        })
    })(jQuery)

</script>
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
<link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
<style>
    td.vip{
        background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAGCAYAAADgzO9IAAAAMElEQVQYV2NkYGBg+H+I6z+IhgFGu2+MjOiCcEmYBEgVsm64DpwSyHaA2CjakS0HAFVzGy/IbRf5AAAAAElFTkSuQmCC)
    }
    .stat-sex .ct-series-a path{
        stroke: #3f51b5;
    }
    .stat-sex .ct-series-b path{
        stroke: #ff5722;
    }
    .stat-approve .ct-series-a path{
        stroke:#8bc34a;
    }
    .stat-approve .ct-series-b path{
        stroke: #ffeb3b;
    }
    .stat-approve .ct-series-c path{
        stroke: #e91e63;
    }
    .stat-popup svg text{
        font-size: 0.9rem;
        font-weight: normal;

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
    <table class="filter_table" style="width: 100%;color:#012434;" cellpadding="5">
        <tr>
            <Td width="200">
                <?php echo $loc['offers.php']['filter_field_category']; ?> 
                <select class="width-150" name="category">
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
            <td width="250">
                <?php echo $loc['offers.php']['filter_field_keyword']; ?> 
                <input type="text" size="13" placeholder="<?php echo $loc['offers.php']['filter_field_keyword_placeholder']; ?>" name="keyword" value="<?php echo htmlentities($getRequest->keyword); ?>">
            </td>
            <td width="200">
                <?php echo $loc['offers.php']['filter_field_price']; ?> 
                <input type="text" placeholder="<?php echo $loc['offers.php']['filter_field_priceFrom']; ?>" size=3 style="text-align:center" name="price1" value="<?php echo htmlentities($getRequest->price1); ?>">
                -
                <input type="text" placeholder="<?php echo $loc['offers.php']['filter_field_priceTo']; ?>" size=3 style="text-align:center" name="price2" value="<?php echo htmlentities($getRequest->price2); ?>">
            </td>
            <td width="180">
                <?php echo $loc['offers.php']['filter_field_geo']; ?> 
                <select name="geo" class="width-150">
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
        margin-right: 70px;
        color:#012434;
        font-family: 'intro_regular';
        font-size: 18px;
        text-decoration: none;
    }
    a.type.active{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#efefef+0,d6d6d6+100 */
        background: #efefef; /* Old browsers */
        background: -moz-linear-gradient(top,  #efefef 0%, #d6d6d6 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  #efefef 0%,#d6d6d6 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  #efefef 0%,#d6d6d6 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#d6d6d6',GradientType=0 ); /* IE6-9 */

        border-radius:15px;
        padding: 7px 25px;
    }
    .ct-bar{
        stroke-width: 7%;
    }
    .stats_table td {border:none;height: auto;line-height: inherit;}
</style>
<div id="js-ajax-content">

    <p style="margin-top:50px;margin-bottom:50px;" class="postTitle"><span><?php echo $loc['offers.php']['t02']; ?></span></p>
    <div style="float:left;">    
        <a class="type <?php if (!isset($getRequest->type) or $getRequest->type == 0) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&type=0"><?php echo $loc['offers.php']['filter_field_type_all']; ?></a>
        <a class="type <?php if (isset($getRequest->type) && $getRequest->type == 2) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&type=2"><?php echo $loc['offers.php']['filter_field_type_2']; ?></a>
        <a class="type <?php if (isset($getRequest->type) && $getRequest->type == 1) echo "active"; ?> navigation-page" href="<?php echo build_pagination_url(1); ?>&type=1"><?php echo $loc['offers.php']['filter_field_type_1']; ?></a>
    </div>
    <?php
    $perPage = 20;
    $sql = "select offer_id from offers_owner where owner_id = '$user_id'";
    $stmt = DB::getInstance()->query($sql);
    if ($stmt->rowCount() != 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($arr as $o) {
            $arr_offers[] = $o->offer_id;
        }
    }

    if (empty($arr_offers)) {
        $arr_offers = [-1];
    }
    $offersManager->where('id', $arr_offers, Entity_Manager::WHERE_IN);

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

    <div style="float:right;">  
        <?php
// Вывод количества страниц
// Display the number of pages
        pagination($result, $perPage, 11);
        ?>
    </div>

    <div class="clear"></div>

    <p style="margin-top:50px;">
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
                $offer_comission_res = new Offers_Manager(DB::getInstance());
                $offer_comission_res->setSql("select * from offers_visible where offer_id = ".$offer_id." and user_id = ".$user->id);
                $offer_comission_totalres = $offer_comission_res->get();
                if (is_array($offer_comission_totalres) && count($offer_comission_totalres) > 0) {
                    $offer_comission = array($offer_comission_totalres[0]['comission']);
                    $offer_comission_cpa = array($offer_comission_totalres[0]['comission_cpa']);
                }
                else
                {
                    // Получаем комиссию вебмастеру на оффере
                    // Get the commission webmaster to offer
                    $offer_comission = explode('|', trim($res['comission']));
                    // Получаем комиссию CPA-сети на оффере
                    // Get the CPA-network comission on offer
                    $offer_comission_cpa = explode('|', trim($res['comission_cpa']));
                }

                // Получаем комиссию вебмастеру на оффере
                // Get the commission webmaster to offer
                //$offer_comission = explode('|', trim($res['comission']));
                // Получаем комиссию CPA-сети на оффере
                // Get the CPA-network comission on offer
                //$offer_comission_cpa = explode('|', trim($res['comission_cpa']));
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
            <table class="stats_table" style="width: 100%; margin: 0px 0px 20px 0px;">
                <tr class="<?php
        if ($cvet & 1) {
            echo 'col2';
        } else {
            echo '';
        } $cvet++;
                ?>">
                    <td width="600">
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
                        <div style="text-align: left; margin-top: 10px; line-height: 28px;">
                            <a class="offerName" href="./offers.php?offer=<?php echo $offer_id; ?>"><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></a>
                            <?
                            if ($res['callcenter_info'] != '') {
                                echo '<a class=callcenter_info style="float:right"><img src=/images/headphones.png>'
                                . '<div class=callcenter_info><b>Режим работы КЦ: </b><BR><br>' . nl2br($res['callcenter_info']) . '</div></a>';
                            }
                            ?>
                            <br /><font style="color: #a2a4a5;font-size:14px;"><?php echo $o_deystvie . ' / ' . $offer_category_name; ?></font><br />

                            <?php if ($offer_active == '0') { ?>
                                <font class="openSansSemiBold" style="color: red;font-size:16px;">Оффер выключен</font><br />    
                                <?
                            }
                            if ($offer_active == '1') {
                                ?>
                                <font class="openSansSemiBold" style="color: green;font-size:16px;">Оффер включен</font><br />    
                                <?
                            }
                            if ($offer_active == '2') {
                                ?>
                                <font class="openSansSemiBold" style="color: yellow;font-size:16px;">Оффер на модерации</font><br />    
                                <?
                            }
                            ?>


                            <div style="margin-top:10px;">
                                <a title="Yandex" style="text-decoration: none; border-bottom: 0" href="#" class="js-trands" data-offer="<?php echo $offer_id; ?>" data-keyword="<?php echo htmlspecialchars($res->keyword, ENT_QUOTES); ?>"  data-type="yandex"><img width=38 src="https://cdn0.iconfinder.com/data/icons/social-flat-rounded-rects/512/yandex_bookmarks-128.png"></a>
                                &nbsp;    
                                <a title="Google" style="text-decoration: none; border-bottom: 0" href="#" class="js-trands" data-offer="<?php echo $offer_id; ?>" data-keyword="<?php echo htmlspecialchars($res->keyword, ENT_QUOTES); ?>" data-type="google"><img width=38 src="https://cdn4.iconfinder.com/data/icons/new-google-logo-2015/400/new-google-favicon-128.png"></a>
                                &nbsp;
                                <a title="Publer" style="text-decoration: none; border-bottom: 0" href="#" class="js-trands" data-offer="<?php echo $offer_id; ?>" data-keyword="<?php echo htmlspecialchars($res->keyword, ENT_QUOTES); ?>" data-type="publer"><img width=38 src="./templates/<?php echo $template; ?>/img/publer.png"></a>
                                <div class=baloon style="position:absolute; display:none;">
                                    <div style="padding: 20px; position:relative; top: -200px; left: 320px; width: 300px; height: 350px; box-sizing: border-box; background: white; border:1px solid #ccc">

                                    </div>
                                </div>                                
                                <?php if (false !== ($stat = $res->getStat() )) { ?> 
                                    &nbsp; <span><img style="margin-bottom: -2px;margin-left: 7px;" data-stat="<?php echo htmlspecialchars(json_encode($stat), ENT_QUOTES); ?>" alt="Статистика" title="Статистика" style="cursor: pointer" class="js-stat" data-id="<?php echo $offer_id; ?>" src="./templates/<?php echo $template; ?>/img/stats.png" width="60"/><div></div></span> 
                                <?php } ?>
                            </div>
                        </div>
                    </td>

                    <td style="color:#012434;text-align:left;padding:0;">
                        <span class="openSansBold" style="margin-left: 3px;"><?php echo $loc['offers.php']['t236']; ?>:</span> <?php echo $o_deystvie; ?>

                        <table style="width: 80%;">
                            <tr class=geo>
                                <td colspan="3" style="padding:0;color:#012434;text-align:left;"><span class="openSansBold"><?php echo $loc['offers.php']['r23']; ?>:</span></td>
                                <?php
                                // Определяем CR и EPC у оффера
                                // Determine the CR and EPC have offer
                                $cr_view = $epc_view = 0;
                                $cr_view = $res['cr'];
                                $epc_view = $res['epc'];
                                ?> 
                            </tr>    
                            <tr class=geo >    
                                <td width="70" style="padding:0;color:#012434;text-align:left;">
                                    CR (%): 
                                    <?php
                                    if (round($cr_view, 2) == '0') {
                                        echo $loc['offers.php']['t19'];
                                    } else {
                                        echo round($cr_view, 2);
                                    }
                                    ?>
                                </td>
                                <td width="70" style="padding:0;color:#012434;text-align:left;">
                                    EPC:
                                    <?php
                                    if (round($epc_view, 2) == '0') {
                                        echo $loc['offers.php']['t19'];
                                    } else {
                                        echo round($epc_view, 2);
                                    }
                                    ?>
                                </td>                   
                            </tr>
                        </table>                        

                    </td>	

                    <td style="text-align:<?php if ($user_uroven_dostupa >= $offer_uroven_dostupa || $offer_uroven_dostupa == -1) {
                                echo 'right';
                            } else echo 'center'; ?>">

                        <a href="./offers.php?offer=<?php echo $offer_id; ?>"><button class="others_button_sohranit">Подробнее</button></a>

                    <td>
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
