<script>
    $(document).on('click', '.show-more-geo', function () {
        $(this).toggleClass('active');
        $(this).parents('.row').siblings('.geo-list').toggle();
    })
    $(function(){ $('.act').parent().addClass('active'); });
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
        'type_offer' => (isset($_GET['type_offer'])) ? $_GET['type_offer'] : '',
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

    <div class="col-md-12">
        <form class="js-ajax-filter" action="?" method="get">
        <?php
        foreach ($_GET as $k => $v) {
            if (in_array($k, array('page', 'category', 'keyword', 'price1', 'price2', 'type', 'geo'))) {
                continue;
            }
            echo "<input type=hidden name='" . htmlentities($k, ENT_QUOTES) . "' value='" . htmlentities($v, ENT_QUOTES) . "' />" . PHP_EOL;
        } ?>
            <div class="row grow">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="" for=""><?php echo $loc['offers.php']['filter_field_category']; ?>&nbsp;</label>  
                        <div class="custom_select">                          
                            <select name="category" class="form-control">
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
                        </div>
                    </div>
                </div>
                <div class="col-md-3">   
                    <div class="form-group">
                        <label class="" for="keyword"><?php echo $loc['offers.php']['filter_field_keyword']; ?>&nbsp;</label>                            
                        <input type="text" class="form-control" name="keyword" id="keyword" value="<?php echo htmlentities($getRequest->keyword); ?>" placeholder="<?php echo $loc['offers.php']['filter_field_keyword_placeholder']; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="" for=""><?php echo $loc['offers.php']['filter_field_geo']; ?>&nbsp;</label>
                        <div class="custom_select">                            
                            <select name="geo" class="form-control">
                                <option value=""><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                <?php
                                foreach ($countries as $iso => $name) {
                                    echo '<option value="' . $iso . '">' . $name . '</option>' . PHP_EOL;
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"> 
                    <div class="form-group">
                        <label class="" for=""><?php echo $loc['offers.php']['filter_field_price']; ?>&nbsp;</label>         
                        <div class="input-group ">   
                            <input type="text" class="form-control text-center" name="price1" value="<?php echo htmlentities($getRequest->price1); ?>" placeholder="<?php echo $loc['offers.php']['filter_field_priceFrom']; ?>">
                            <input type="text" class="form-control text-center" name="price2" value="<?php echo htmlentities($getRequest->price2); ?>" placeholder="<?php echo $loc['offers.php']['filter_field_priceTo']; ?>">
                        </div>
                    </div>
                </div>
            </div>  
        </form>
            
        
<style>
    a.type{
        margin-right: 30px;
        background: #31C6B2;
        color:fff;
        padding: 7px 25px;
        text-decoration: none;
    }
    a.type.active{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#efefef+0,d6d6d6+100 */

        
    }
    .ct-bar{
        stroke-width: 7%;
    }
    .stats_table td {border:none;height: auto;line-height: inherit;}
</style> 

    </div>

    <div class="col-md-12 mb-20">   

        <div id="js-ajax-content">

            <!--<div class="row block-sort align-items-center mt-50 text-center m-0 mb-25">
                <div class="col-auto">Категория: </div>
                <div class=" col-auto <?php if (!isset($getRequest->type_offer) or $getRequest->type_offer == 0) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=0"><?php echo $loc['offers.php']['filter_field_type_all']; ?></a></div>
                <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 1) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=1"><?php echo $loc['offers.php']['filter_field_type_1']; ?></a></div>
                <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 2) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=2">Gambling</a></div>
                <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 5) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=5">Игры</a></div> 
                <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 6) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=6">Финансы</a></div> 
                <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 7) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=7">Бурж</a></div> 
                <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 8) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=8">Инсталл</a></div> 
            </div>-->




    
    <div class="row grow">
    <?php
    $perPage = 20;
    $offersManager->where('active', 1);
    $offersManager->where(false, '(uroven_dostupa>0 or (select 1 from offers_visible where offer_id=offers.id and user_id=' . $user->id . ')=1)', Entity_Manager::WHERE_RAW);

    if (isset($getRequest->geo) && $getRequest->geo != '') {
        $offersManager->where('geo', $getRequest->geo, Offers_Manager::WHERE_LIKE);
    }
    if (isset($getRequest->type_offer) && $getRequest->type_offer > 0 && is_numeric($getRequest->type_offer)) {
        $offersManager->where('`type_offer`', $getRequest->type_offer);
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

            $offer_excluded_geo = explode('|', trim($res['excluded_geo']));
            $offer_excluded_country_iso_arr = explode(':', $offer_excluded_geo[0]);
            $offer_excluded_region_id_arr = explode(':', $offer_excluded_geo[1]);

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

            <div class="col-12 col-sm-12 col-md-12 mb-25">
                <div class="block card" style="    min-height: auto;">
                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col-2 offer-img text-center">
                                <?php
                                // Проверка, назначено ли промо для оффера
                                // Check if the promo is scheduled to offer
                                if (file_exists('./tmp/offer' . $offer_id . '.png')) {
                                    ?>
                                    <a style="border: 0; text-decoration: none;" href="./offers.php?offer=<?php echo $offer_id; ?>">
                                        <img class="" src="./tmp/offer<?php echo $offer_id; ?>.png">
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a style="border: 0; text-decoration: none;" href="./offers.php?offer=<?php echo $offer_id; ?>">
                                        <img src="./tmp/empty.png">
                                    </a>
                                    <?php
                                }
                                ?>
                                <?php
                                // Определяем CR и EPC у оффера
                                // Determine the CR and EPC have offer
                                $cr_view = $epc_view = $aproove = 0;
                                $cr_view = $res['cr'];
                                $epc_view = $res['epc'];

                                //$aproove = $res['avg_approve'];
                                $sql_aprove_zn = "SELECT count(id) as cnt FROM zakaz WHERE status != 5 and offer_id = ".$offer_id;
                                $result_aprove_zn = $mysqli->query($sql_aprove_zn);
                                $res_aprove_zn = mysqli_fetch_array($result_aprove_zn);

                                $sql_aprove = "SELECT count(id) as cnt FROM zakaz WHERE status = 3 and offer_id = ".$offer_id;
                                $result_aprove = $mysqli->query($sql_aprove);
                                $res_aprove = mysqli_fetch_array($result_aprove);
                                
                                if ($res_aprove_zn['cnt'] == 0) $aproove = 0;
                                else $aproove = $res_aprove['cnt'] / $res_aprove_zn['cnt'] * 100;
                                ?>
                                <br>
                                <?php
                                if ($user_uroven_dostupa >= $offer_uroven_dostupa) {
                                    ?>	
                                    <font class="openSansSemiBold" style="color: #55903a;font-size:16px;"><?php echo $loc['offers.php']['t13']; ?></font><br />
                                    <?php
                                } else {
                                    ?>	
                                    <font class="openSansSemiBold" style="color: #cf3648;font-size:16px;"><?php echo $loc['offers.php']['t14']; ?></font><br />
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-3">
                                        <a class="offerName" href="./offers.php?offer=<?php echo $offer_id; ?>"><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></a>
                                    </div>
                            <div class="col-5">
                                <div class="row">
                                    <div class="col-3"><b>СТРАНА</b></div>
                                    <div class="col-3"><b>ЦЕНА</b></div>
                                    <div class="col-3"><b>ВЫПЛАТА</b></div>
                                    <div class="col-3"><b>АПРУВ</b></div>
                                </div>
                                <div class="row">
                                    <div class="col-3 mt-15"> 
                                        <ul class="oglavl">
                                     <?php
                                     if (isset($offer_comission) && isset($offer_comission_cpa)) {
                                         $type_comission = $loc['offers.php']['t17'];    
                                         if (count($offer_tip_comission) > 0 && count($offer_tip_comission) == count($offer_comission)) {
                                             $i = 0;
                                             $iter = 0;
                                             $count = count($offer_country_iso_arr);
                                             echo '';
                                             $comission = 0;
                                             $comission_min = 0;
                                             $comission_max = 0;
                                             $comission_counts = count($offer_country_iso_arr);
                                             foreach ($offer_country_iso_arr as $key => $val) {
                                                 $iter++;
                                                 $sql_geo = "SELECT name_ru, currency FROM sxgeo_country WHERE `iso`='$val'";
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

                                                if (!empty($val)) {
                                                     //echo '<div class="col text-left"> <img title="' . $geo_country_name . '" src=./modules/detectclient/SxGeo/img/' . strtolower($val) . '.png> ' . $geo_country_name . '</div>';
                                                    echo '<li><span class="page"> '.$geo_country_name;
                                                    $sql_geo = "SELECT name_ru FROM sxgeo_regions WHERE `country`='$val' AND id IN(".implode(', ', $offer_excluded_region_id_arr).")";
                                                    //var_dump($sql_geo);
                                                    $result_geo = $mysqli->query($sql_geo);
                                                    $rg_arr = [];
                                                    while($res_geo = mysqli_fetch_array($result_geo)) {
                                                        $rg_arr[] = $res_geo['name_ru'];
                                                    }
                                                    if (count($rg_arr)) echo ' (<a href="javascript:void(0)" onclick="$(\'.expl'.$offer_id.'\').toggleClass(\'active\')">кроме</a>)';
                                                    echo '<div class="expl expl'.$offer_id.'">'.implode(',', $rg_arr).'</a>';
                                                    echo '</span></li>';
                                                     $comission = $offer_comission[$i];
                                                 if ($offer_tip_comission[$i] == 1) {
                                                     $type_comission = $loc['offers.php']['t17'];
                                                 } elseif ($offer_tip_comission[$i] == 2) {
                                                     $type_comission = '%';
                                                 }
                                                } else {
                                                    //echo '<div class="col text-left"> ГЕО ' . $loc['offers.php']['r19'] . '</div>';

                                                    $comission = $offer_comission[$i];
                                                    if ($offer_tip_comission[$i] == 1) {
                                                        $type_comission = $loc['offers.php']['t17'];
                                                    } elseif ($offer_tip_comission[$i] == 2) {
                                                        $type_comission = '%';
                                                    }
                                                }
                                                //echo '<li><span class="text">Цена товара:</span><span class="page"> '.$price.' руб.</span></li>';
                                                //echo '<li><span class="text">Выплата:</span><span class="page"> '.$comission.'</span></li>';
                                                //echo '<li><span class="text">Аппрув:</span><span class="page"> '.round($aproove, 2).'%</span></li>';
                                                //echo '<li><span class="text">CR:</span><span class="page"> '.round($cr_view, 2).'%</span></li>';
                                                //echo '<li><span class="text">ePC:</span><span class="page"> '.round($epc_view, 2).'</span></li>';
                                                
                                                
                                                 $i++;
                                             }
                                         }
                                     }
                                     if(count($offer_tip_comission) > 5){
                                     ?> 
                                        <div class="row mt-20 mb-25">
                                            <div class="col text-center">
                                                <a class="show-more-geo">Всё ГЕО</a>
                                            </div>
                                        </div>
                                     <?php
                                     }  
                                     ?>
                                     </ul>
                                    </div>
                                    <?php
                                        echo '<div class="col-3">'.$price.' руб.</div>';
                                        if ($user->offers_reward_all) echo '<div class="col-3">'.$comission.' + '.$user->offers_reward_all.' руб.</div>';
                                        else echo '<div class="col-3">'.$comission.' руб.</div>';
                                        if ($aproove == 0) echo '<div class="col-3">n/a</div>';
                                        else echo '<div class="col-3">'.round($aproove, 2).'%</div>';
                                    ?>
                                    <!--<div class="col-12 mt-15"> 
                                        <?php 
                                        if ($offer_uroven_dostupa == -1) { 
                                        ?> 
                                        <a href="./streams.php?offer=<?php echo $offer_id; ?>"><button class="btn button"><?php echo $loc['offers.php']['t15']; ?></button></a><br> 
                                        <?php 
                                        } else {
                                            if ($user_uroven_dostupa >= $offer_uroven_dostupa) {
                                            ?>
                                        <a href="./streams.php?offer=<?php echo $offer_id; ?>"><button class="btn button"><?php echo $loc['offers.php']['t15']; ?></button></a><br> 
                                            <?php
                                            } else { 
                                                echo '<font class="openSansBold" style="color: #cf3648;font-size:18px;text-align:center;">Недостаточный уровень<br>вебмастера</font><br>';
                                                echo '<a href="/tickets.php?new&levelup"><button class="others_button_sohranit">Поднять уровень</button></a>';
                                            }
                                        }
                                        ?>
                                        <a href="./offers.php?offer=<?php echo $offer_id; ?>" class="more">Подробнее <i class="fa fa-chevron-down"></i></a>
                                    </div>-->
                                </div>  
                            </div>
                            <div class="col-2">
                                        <a href="/streams.php?offer=<?php echo $offer_id; ?>" class="btn button">Создать поток</a>
                                    </div>
                        </div> 
                    </div>
                </div>    
            </div>     
            <?php
        }
    }
    ?> 
    </div>


<p>
    <?php
// Вывод количества страниц
// Display the number of pages
    pagination($pagination_fetched_row, 20, 11);
    ?>
</p>
        </div>  
  
    </div>   
    <script src="./templates/<?php echo $template; ?>/js/ZeroClipboard.min.js"></script>
    <script src="./templates/<?php echo $template; ?>/js/ZeroClipboard.common.js"></script>

<script src="./templates/<?php echo $template; ?>/js/offers/list.js"></script>
