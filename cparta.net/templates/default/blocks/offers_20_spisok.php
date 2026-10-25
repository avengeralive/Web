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

    <div class="col-12">
        <div class="card" style="    min-height: auto;">
          <div class="card-body">
              <p class="postTitle mb-20" style="color: #31C6B2;"><?php echo $loc['offers.php']['filter_title']; ?></p>
              <form class="js-ajax-filter" action="?" method="get">
                  
                <?php
                foreach ($_GET as $k => $v) {
                    if (in_array($k, array('page', 'category', 'keyword', 'price1', 'price2', 'type', 'geo'))) {
                        continue;
                    }
                    echo "<input type=hidden name='" . htmlentities($k, ENT_QUOTES) . "' value='" . htmlentities($v, ENT_QUOTES) . "' />" . PHP_EOL;
                }
                ?>
                  
                  <div class="row align-items-end">
                        <div class="col-3">
                          <div class="form-group">
                              <label class="" for=""><b><?php echo $loc['offers.php']['filter_field_category']; ?>&nbsp;</b></label>                            
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
                        <div class="col-3">   
                            <div class="form-group">
                            <label class="" for="keyword"><b><?php echo $loc['offers.php']['filter_field_keyword']; ?>&nbsp;</b></label>                            
                            <input type="text" class="form-control" name="keyword" id="keyword" value="<?php echo htmlentities($getRequest->keyword); ?>" placeholder="<?php echo $loc['offers.php']['filter_field_keyword_placeholder']; ?>">
                            </div>
                        </div>
                        <div class="col-3"> 
                            <div class="form-group">
                                <label class="" for=""><b><?php echo $loc['offers.php']['filter_field_price']; ?>&nbsp;</b></label>         
                                <div class="input-group ">   
                                    <input type="text" class="form-control text-center" name="price1" value="<?php echo htmlentities($getRequest->price1); ?>" placeholder="<?php echo $loc['offers.php']['filter_field_priceFrom']; ?>">
                                    <input type="text" class="form-control text-center" name="price2" value="<?php echo htmlentities($getRequest->price2); ?>" placeholder="<?php echo $loc['offers.php']['filter_field_priceTo']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                              <label class="" for=""><b><?php echo $loc['offers.php']['filter_field_geo']; ?>&nbsp;</b></label>                            
                              <select name="geo" class="form-control">
                                  <option value=""><?php echo $loc['offers.php']['filter_field_category_select']; ?></option>
                                    <?php
                                    foreach ($countries as $iso => $name) {
                                        echo '<option value="' . $iso . '">' . $name . '</option>' . PHP_EOL;
                                    }
                                    ?>
                              </select>
                          </div>
                        </div>
                  </div>  
                  
              </form>
            
          </div>
        </div>
        
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

    <div class="col-12 mb-20">   

        <div id="js-ajax-content">

            <div class="row block-sort align-items-center mt-50 text-center m-0 mb-25">
                <div class="col-auto">Категория: </div>
                <div class=" col-auto <?php if (!isset($getRequest->type_offer) or $getRequest->type_offer == 0) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=0"><?php echo $loc['offers.php']['filter_field_type_all']; ?></a></div>
                <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 1) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=1"><?php echo $loc['offers.php']['filter_field_type_1']; ?></a></div>
                <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 2) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=2">Gambling</a></div>
               <!-- <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 3) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=3"><?php echo $loc['offers.php']['filter_field_type_2']; ?></a></div> -->
                <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 5) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=5">Игры</a></div> 
                <div class=" col-auto <?php if (isset($getRequest->type_offer) && $getRequest->type_offer == 6) echo "active"; ?>" ><a href="<?php echo build_pagination_url(1); ?>&type_offer=6">Финансы</a></div> 
            </div>


    

    <?php
    $perPage = 20;
//$offersManager->where('active', 1);
    if (isset($getRequest->geo) && $getRequest->geo != '') {
        $offersManager->where('geo', $getRequest->geo, Offers_Manager::WHERE_LIKE);
    }
    if (isset($getRequest->type_offer) && $getRequest->type_offer > 0 && is_numeric($getRequest->type_offer)) {
        $offersManager->where('`type_offer`', $getRequest->type_offer);
    }else{
        $offersManager->where('type_offer', 'type_offer != 4' ,  Entity_Manager::WHERE_RAW);
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

    
    if (is_array($result) && count($result) > 0) {
        foreach ($result as $res) {
            $b_offer = '';
            // Получаем ID оффера
            // Get the ID offer
                $offer_id = htmlentities($res['id']);
                $offer = Offer::getById($res['id']);
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
            $offer_comission_cpa = explode('|', trim($res['comission_cpa']));
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
            if ($offer_active == "2") {$b_offer = 'border:1px solid orange;';}
            if ($offer_active == "0") {$b_offer = 'border:1px solid red;';}
            ?> 

            <div class="col-12 mb-25 p-0">
                <div class="card" style="    min-height: auto; <?=$b_offer; ?>">
                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col-auto offer-img">
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
                            </div>
                            <div class="col-3" style="border-right: 1px solid #ccc;">
                                <a class="offerName" href="./offers.php?offer=<?php echo $offer_id; ?>"><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></a><br>
                                <?php echo $offer_category_name; ?><br>
                                <?php 
                                if ($offer_active == "2") { ?><span style="background: yellow; color: red;">&nbsp;
                                    <?php echo $loc['offers.php']['t160']; ?>&nbsp;</span>
                                <?php
                                }
                                if ($offer_active == "1") {
                                    ?><span style="background: green; color: white;">&nbsp;<?php echo $loc['offers.php']['t161']; ?>&nbsp;</span><br>
                                <?php
                                }
                                if ($offer_active == "0") {
                                    ?><span style="background: red; color: white;">&nbsp;<?php echo $loc['offers.php']['t162']; ?>&nbsp;</span><br>
                                <?php
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
                                <br>    
                                <small>
                                    <span title="Fake" style='padding:3px; background: #ffaaaa'>CR<sup></sup>: <?php echo round(floatval($cr_view),2);?></span>
                                    <span title="Fake" style='padding:3px; background: #ffaaaa'>EPC<sup></sup>: <?php echo round(floatval($epc_view),2);?></span>
                                    <br>
                                    <span title="Real" style='padding:3px; background: #aaffaa'>CR<sup></sup>: <?php echo round(floatval($cr_view_real),2);?></span>
                                    <span title="Real" style='padding:3px; background: #aaffaa'>EPC<sup></sup>: <?php echo round(floatval($epc_view_real),2);?></span>
                                    <br>
                                    <span style='padding:3px; background: #ffffaa'>Leads<sup></sup>: <?php echo $data_real->leads;?></span>
                                    <br>
                                    <input <?php if($res['real_cr'])echo'checked ';?> accept=""onclick="$.post('?',{action:'changeRealCr', id: <?php echo $offer_id;?>, val: this.checked?1:0});" type='checkbox'>real
                                </small>
                                
                            </div>
                            <div class="col ">
                                
                                    
                                     <?php

                                $owners = Offer::getOfferOwners($offer_id);
                                $def_owner = User::getById($offer->owner_id);
                                $def_o = $def_owner['alias'];
                                $def_o_bal = ($def_owner['balance'] > 1000) ? '<font color="green">('.$def_owner['balance'].')</font>': '<font color="red">('.$def_owner['balance'].')</font>';
                                $owner_this[0] = ['owner' => $def_o, 'balance' => $def_o_bal, 'andOther' => 1];
                                     
                                     
                                    if (isset($offer_cena) && $offer_cena != '0') {

                                        if (count($offer_country_iso_arr) > 0) {
                                        if (count($offer_tip_comission) > 0 && count($offer_tip_comission) == count($offer_comission)) {    
                                            $i = 0;
                                            $max = count($offer_country_iso_arr);
                                            $iter = 0;
                                            echo '<table class="table text-center">';
                                            echo '<tr>';
                                            echo '<th>Гео</th>';
                                            echo '<th>Цена</th>';
                                            echo '<th>Комиссии</th>';
                                            echo '<th>Рекл</th>';
                                            echo '</tr>';
                                            
                                            foreach ($offer_country_iso_arr as $key => $val) {
                                                $iter++;
                                                echo '<tr>';
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
                                                
                                                if (count($offer_comission) == count($offer_comission_cpa)) {
                                                    $comission_cpa1 = $offer_comission_cpa[$i];
                                                } else {
                                                    $comission_cpa1 = 0;
                                                }   

                                                $price = ($offer_cena[$i] != 0) ? $offer_cena[$i] : $loc['offers.php']['t29'];
                                                $curr = ($offer_cena[$i] != 0) ? $currency : '';
                                                
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
                                                
                                                if (!empty($val) && count($offer_cena) == count($offer_country_iso_arr)) {
                                                    echo '<td class="text-left"><img style="" title="' . $geo_country_name . '" src=./modules/detectclient/SxGeo/img/' . strtolower($val) . '.png> ' . $geo_country_name . '</td>';
                                                    echo '<td>' . $price . ' ' . $curr . '</td>';
                                                    
                                                    if ($offer_tip_comission[$i] == 1) {
                                                        echo '<td>' . $offer_comission[$i] .'+'. $comission_cpa1 . ' ' . $loc['offers.php']['t17'] . '</td>';
                                                    } elseif ($offer_tip_comission[$i] == 2) {
                                                        echo '<td>' . $offer_comission[$i] .'+'. $comission_cpa1 . ' % </td>';
                                                    }
                                                    
                                                    if (array_key_exists($val, $owner_this)) {
                                                        $owner_data = $owner_this[$val];
                                                    }else{
                                                        $owner_data = $owner_this[0];
                                                    }
                                                    
                                                } else {
                                                    echo '<td>' . $price . ' ' . $curr . '</td>';
                                                    if ($offer_tip_comission[$i] == 1) {
                                                        echo '<td>' . $offer_comission[$i] .'+'. $comission_cpa1 . ' ' . $loc['offers.php']['t17'] . '</td>';
                                                    } elseif ($offer_tip_comission[$i] == 2) {
                                                        echo '<td>';
                                                        echo ($offer_comission[$i] + $comission_cpa1) . ' %</td>';
                                                    }
                                                    
                                                    echo '<td>Без огр.</td>';
                                                    $owner_data = $owner_this[0];
                                                }

                                                echo '<td>' . $owner_data['owner'].' '.$owner_data['balance'] . '</td>';
                                                echo '</tr>';
                                                
                                                 $i++;
                                             }
                                             echo '</table>';
                                        }
                                        }
                                     }
                                     ?>
   
                            </div>
                
                        </div> 
                        
                        <div class="row align-items-center justify-content-end mt-20">
                            <div class="col-auto">  
                                <a href="./offers.php?offer=<?php echo $offer_id; ?>">Подробнее</a>
                            </div> 
                        </div> 

                    </div>
                </div>    
            </div>     
            <?php
        }
    }
    ?> 
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
