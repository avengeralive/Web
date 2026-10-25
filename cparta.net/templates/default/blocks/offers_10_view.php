
<script>
    $(document).on('click', '.show-more-geo', function () {
        $(this).toggleClass('active');
        $(this).parents('.row').siblings('.geo-list').toggle();
    })
</script>
<?php
$offer_id=htmlentities($_GET['offer']);

$user = User::getById($user_id);
$offer = Offer::getById($offer_id);

if (!isset($offer) || $offer->active != 1) {
    exit;
}
if( $offer->uroven_dostupa==-1 && !Offer::isVisibleForUser($offer, $user)){
    exit("<h4>К сожалению ничего не получится.");  
}
if ($user_uroven_dostupa < $offer->uroven_dostupa) {
    exit("<h4>Недостаточный уровень вебмастера, обратитесь в тех.поддержку.");  
}

            $hold_user = $user->hold_days;
            $user_bonus_this_offer = 0;
            $user_bonus_all_offer = $user->offers_reward_all;
            $dop_bonus = 0;
            
            if($user->offers_reward != ''){  
                $personal_bonus = explode('|', trim($user->offers_reward));
                $offer_bonus = array();
                foreach ($personal_bonus as $key => $bonus) {
                    if($bonus == ''){continue;}
                    $offer_bonus[] = explode(':', trim($bonus));
                }  
                if($offer_bonus && is_array($offer_bonus)){
                    foreach ($offer_bonus as $key => $bonus) {
                        if ($bonus[0] == $offer->id){
                        $bonuses[] = explode(',', trim($bonus[1]));
                        foreach($bonuses as $bonus){
                            foreach($bonus as $k=>$v){
                                $bon[] = explode('-', trim($v));
                            }
                        }
                        break;    
                        }
                    }                
                }               
                
            }            


	// Назначаем переменные
	// Assign variables
        $offer_type=$offer->type_offer;    
	$offer_tip=$offer->tip;
	$offer_active=$offer->active;
	$offer_uroven_dostupa=$offer->uroven_dostupa;
	$offer_name=$offer->name;
	$offer_descr = html_entity_decode($offer->descr);
	$offer_url=$offer->url;
        $offer_end=$offer->offer_end;
	$offer_date_end= ($offer_end > 0) ? date('d.m.Y H:i', $offer_end) : $loc['offers.php']['r25'];
	$kolvo_lids = ($offer->kolvo_lids > 0) ? $offer->kolvo_lids : $loc['offers.php']['r25'];
	$offer_owner_id=$offer->owner_id;
	$offer_deystvie=$offer->deystvie;
    $offer_cena=explode('|', trim($offer->cena));

    $offer_comission_res = new Offers_Manager(DB::getInstance());
    $offer_comission_res->setSql("select * from offers_visible where offer_id = ".$offer_id." and user_id = ".$user_id);
    $offer_comission_totalres = $offer_comission_res->get();
    if (is_array($offer_comission_totalres) && count($offer_comission_totalres) > 0) {
        $offer_comission = array($offer_comission_totalres[0]['comission']);
        $offer_comission_cpa = array($offer_comission_totalres[0]['comission_cpa']);
    }
    else {
        $offer_comission=explode('|', trim($offer->comission));
        $offer_comission_cpa=explode('|', trim($offer->comission_cpa));
    }
    
	//$offer_comission=explode('|', trim($offer->comission));
	$offer_tip_comission=explode('|', trim($offer->tip_comission));
	//=explode('|', trim($offer->comission_cpa));
	$offer_tip_comission_cpa=explode('|', trim($offer->tip_comission_cpa));
	$offer_postclick=$offer->postclick;
	$offer_hold=$offer->hold;
        $off_balance=$offer->off_balance;
        $off_lids=$offer->off_lids;
        $deeplink=$offer->deeplink;
        
            // определяем по ID действия, что это за действие
            // Define the ID for action, what kind of action
            $o_deystvie = htmlentities($offer->deystvie);
            $o_sql = "SELECT deystvie FROM deystvie_tpl WHERE `id`='$o_deystvie'";
            $o_result = $mysqli->query($o_sql);
            $o_res = mysqli_fetch_array($o_result);

            // Получаем название действия
            // Get the name of the action
            $o_deystvie = htmlentities($o_res['deystvie']);
            
            
        //$price = ($offer_cena[0] != 0) ? $offer_cena[0] .' '. $loc['offers.php']['t17'] : $loc['offers.php']['t29'];
                
        //$default_price = $price;
        
	// Переводим переменную отвечающая за тип принимаемого трафика в удобочитаемый вид
	// Translate variable responsible for the type of traffic received in convenient form
	$offer_tip_traffic=$offer->tip_traffic;
	list($tip_traffic1, $tip_traffic2, $tip_traffic3, $tip_traffic4, $tip_traffic5, $tip_traffic6, $tip_traffic7, $tip_traffic8, $tip_traffic9, $tip_traffic10, $tip_traffic11, $tip_traffic12, $tip_traffic13, $tip_traffic14, $tip_traffic15, $tip_traffic16, $tip_traffic17, $tip_traffic18) = explode('|', trim($offer_tip_traffic, '|'));	

	// Переводим переменную ГЕО в удобный вид
	// Translate variable GEO convenient form
	$offer_geo=explode('|', trim($offer->geo));
	$offer_country_iso_arr = explode(':', $offer_geo[0]);
	$offer_region_id_arr = explode(':', $offer_geo[1]);
	//list($offer_country_iso1, $offer_region_id1, $offer_city_id1) = explode('|', trim($offer_geo, '|'));
	?>
        <style>
              div.preview{
                float: right;
                padding-top:5px;
                padding-right: 5px;
                
            }
            div.preview:hover img.preview{
                display: block;
            }
            
            div.preview img.preview{
                display: none;
                max-width: 350px;
                position: absolute;
                left: 850px;
                z-index:99999;
            }

            .stats.active {
                margin-top: 11px;
            }            
            .link_wait_place {margin-top:22px;}

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
        right: 100px;
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
<?php
     
        // Определяем домен который используется для лендингов
        // Determine the domain that is used for landing
        $sql_domain = "SELECT domain FROM domains WHERE `active`='1' ORDER BY `id` DESC";
        $result_domain = $mysqli->query($sql_domain);
        $res_domain=mysqli_fetch_array($result_domain);
        $domain=htmlentities($res_domain['domain']);

?>           
    <div class="col-12 mb-10">
        <div class="row align-items-center mb-20">
            
            <div class="col text-left">    
            <span class="pageTitle left"><?php echo $loc['offers.php']['t03']; ?>&nbsp;&laquo;<?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?>&raquo;</span>
            </div>

            <div class="col text-right">
              <a href="./streams.php?offer=<?php echo $offer_id; ?>"><button class="btn button"><?php echo $loc['offers.php']['t15']; ?></button></a>         
            </div> 
        
        </div> 
    </div>
            
            
    <div class="col-12">
        <div class="row">

            <div class="col-4">
            <div class="offer-items" style="    min-height: auto;">
                <div class="text-center">
                <?php
                // Проверка, назначено ли промо для оффера
                // Check if the promo is scheduled to offer
                if (file_exists('./tmp/offer' . $offer_id . '.png')) {
                    ?>
                    <img  src="./tmp/offer<?php echo $offer_id; ?>.png">
                    <?php
                } else {
                    ?>
                    <img  src="./tmp/empty.png">
                    <?php
                }

                $cr_view = $epc_view = $aproove = 0;
                $cr_view = $offer->cr;
                $epc_view = $offer->epc;
                $aproove = $offer->avg_approve;
                ?>  
                </div>
                    <table class="table table-borderless table-sm mt-20">
                                             
                        
                        <tr>
                            <td class="text-left"><i data-toggle="tooltip" class="fa fa-question-circle" aria-hidden="true" title="<?php echo $loc['offers.php']['t237']; ?>"></i> <?php echo $loc['offers.php']['t33']; ?>:</td>
                            <td class="text-right">
                                <b>
                                    <?php 
                                    if($offer->hidehold == 1 && $hold_user == 0){
                                       echo $loc['streams.php']['t45'];
                                    }elseif($hold_user != 0){                                                                            
                                       echo $hold_user;                                                                            
                                    }else{
                                       echo $offer_hold;  
                                    }
                                    ?>  
                                </b>
                            </td>
                        </tr> 
                        <tr>
                            <td class="text-left"><i data-toggle="tooltip" class="fa fa-question-circle" aria-hidden="true" title="<?=$loc['offers.php']['t39']; ?>"></i> <?php echo $loc['offers.php']['t38']; ?>:</td>
                            <td class="text-right"><b><?php echo $offer_postclick; ?></b></td>
                        </tr>  
                        <tr>
                            <td class="text-left"><i data-toggle="tooltip" class="fa fa-question-circle" aria-hidden="true" title="Время до которого оффер принимает лиды."></i> <?php echo $loc['offers.php']['r1']; ?>:</td>
                            <td class="text-right"><b><?php echo $offer_date_end; ?></b></td>
                        </tr>  
                        <tr>
                            <td class="text-left"><?php echo $loc['offers.php']['t06']; ?>:</td>
                            <td class="text-right"><b><?php if (round($cr_view,2)=='0') {echo $loc['offers.php']['t19'];} else {echo round($cr_view,2);} ?></b></td>
                        </tr> 
                        <tr>
                            <td class="text-left"><?php echo $loc['offers.php']['t07']; ?>:</td>
                            <td class="text-right"><b><?php if (round($epc_view,2)=='0') {echo $loc['offers.php']['t19'];} else {echo round($epc_view,2);} ?></b></td>
                        </tr> 
                        <tr>
                            <td class="text-left">Аппрув:</td>
                            <td class="text-right"><b><?php if (round($aproove,2)=='0') {echo $loc['offers.php']['t19'];} else {echo round($aproove,2);} ?>%</b></td>
                        </tr> 

                            <?php
                            //$default_price; 
                            if (isset($offer_cena) && $offer_cena != '0') {
                            ?> 
                        <tr>
                            <td colspan="2"><br></td>
                        </tr> 
                        <tr>
                            <td class="text-left"><b><?php echo $loc['offers.php']['t28']; ?></b></td>
                            <td class="text-right"></td>
                        </tr> 
                        <tr>
                            <td colspan="2">
                            <?php    
                                if (count($offer_country_iso_arr) > 0) { 
                                    $i = 0;
                                    $max = count($offer_country_iso_arr);
                                    $iter = 0;
                                    echo '<table class="table text-center">';

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

                                        $price = ($offer_cena[$i] != 0) ? $offer_cena[$i] : $loc['offers.php']['t29'];
                                        $curr = ($offer_cena[$i] != 0) ? $currency : '';

                                        if (!empty($val) && count($offer_cena) == count($offer_country_iso_arr)) {
                                            echo '<td align="left" class="text-left"><img style="" title="' . $geo_country_name . '" src=./modules/detectclient/SxGeo/img/' . strtolower($val) . '.png> '.$geo_country_name.'</td>';
                                            echo '<td align="right" class="text-right">' . $price . ' ' . $curr . '</td>';
                                        } else {
                                            echo '<td align="center" colspan="2" class="text-center">' . $price . ' ' . $curr . '</td>';
                                        }
                                        echo '</tr>';

                                         $i++;
                                     }
                                     echo '</table>';
                                }
                             }
                            ?>
                            </td>
                        </tr> 
                    </table>

                
            </div>
                
            </div>


            <div class="col-8">

                <div class="row">
                    
                <div class=" col-12">
                    <div class="offer-items" style="    min-height: auto;">
                        <?php echo html_entity_decode($offer_descr, ENT_QUOTES, 'utf-8'); ?>
                    </div>  
                </div>     
                    
                    <div class=" col-12 mt-15">
            <div class="offer-items" style="    min-height: auto;">
                <div>
                        <div class="row text-center mb-10 text-bold" style="">
                            <div class="col text-left">Страна</div>
                            <div class="col">Цель</div>
                            <div class="col text-right">Комиссия</div>
                        </div>    

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
                                         
                                         
                                                 if($i >= 5){
                                                     echo '<div class="row text-center geo-list" style="display:none;">';
                                                 }else{
                                                     echo '<div class="row text-center">';
                                                 }

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
                                             echo '<div class="col text-left"> <img title="' . $geo_country_name . '" src=./modules/detectclient/SxGeo/img/' . strtolower($val) . '.png> ' . $geo_country_name . '</div>';
                                             $comission = $offer_comission[$i];
                                         if ($offer_tip_comission[$i] == 1) {
                                             $type_comission = $loc['offers.php']['t17'];
                                         } elseif ($offer_tip_comission[$i] == 2) {
                                             $type_comission = '%';
                                         }
                                        } else {
                                            echo '<div class="col text-left"> ГЕО ' . $loc['offers.php']['r19'] . '</div>';
                                            $comission = $offer_comission[$i];
                                            if ($offer_tip_comission[$i] == 1) {
                                                $type_comission = $loc['offers.php']['t17'];
                                            } elseif ($offer_tip_comission[$i] == 2) {
                                                $type_comission = '%';
                                            }
                                        }
                                        echo '<div class="col">' . $o_deystvie . '</div>';
                                        echo '<div class="col text-right"><b>' . $comission . ' ' .$type_comission.'</b></div>';
                                        echo '</div>';
                                         $i++;
                                     }
                                 }
                             }
                            if(count($offer_tip_comission) > 5){
                            ?>  
                               <div class="row mt-20 mb-10">
                                   <div class="col text-center">
                                       <a class="show-more-geo">Всё ГЕО</a>
                                   </div>
                               </div>
                            <?php
                            }  
                            ?>
                </div>          
            </div>       
            <div class="offer-items mt-15" style="    min-height: auto;">  
            <p class="postTitle"><?php echo $loc['offers.php']['t45']; ?></p>

                <?php
                $sql_tip_traffic = "SELECT * FROM tip_traffic_tpl ORDER BY `tip` ASC";
                $result_tip_traffic=$mysqli->query($sql_tip_traffic);
                if (mysqli_num_rows($result_tip_traffic) > 0) 
                        {
                        $ii = 0;
                        echo '<div class="row">';
                        while ($res_tip_traffic=mysqli_fetch_array($result_tip_traffic)) 
                                {
                                if($ii == 0){echo '<div class="col">';}
                                
                                $tip_traffic=htmlentities($res_tip_traffic['tip']);
                                $id_tip_traffic=htmlentities($res_tip_traffic['id']);
                                echo '<p class="tiptrafic">';
                                if ($id_tip_traffic==1) {if ($tip_traffic1==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}} 
                                if ($id_tip_traffic==2) {if ($tip_traffic2==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==3) {if ($tip_traffic3==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==4) {if ($tip_traffic4==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==5) {if ($tip_traffic5==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==6) {if ($tip_traffic6==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==7) {if ($tip_traffic7==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==8) {if ($tip_traffic8==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==9) {if ($tip_traffic9==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==10) {if ($tip_traffic10==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==11) {if ($tip_traffic11==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==12) {if ($tip_traffic12==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==13) {if ($tip_traffic13==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==14) {if ($tip_traffic14==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==15) {if ($tip_traffic15==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==16) {if ($tip_traffic16==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==17) {if ($tip_traffic17==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                if ($id_tip_traffic==18) {if ($tip_traffic18==1) {echo '<img src="./templates/'.$template.'/img/yes.png" border="0">&nbsp&nbsp<font color="#012434">'. $tip_traffic.'</font>';} else {echo '<img src="./templates/'.$template.'/img/no.png" border="0">&nbsp&nbsp<font color="#808181">'. $tip_traffic.'</font>';}}
                                echo '</p>'; 
                                
                                if($ii == 7){echo '</div><div class="col">';}
                                $ii++;
                                }
                                echo '</div>'; 
                        }
                ?>     

                </div>
                    </div>          
                </div>  
            </div>
            
        </div> 
    </div>    
                <?php
                    $offer = Offer::getById($offer_id);
                    $landings = $offer->getlandings();
                    $prelandings = $offer->getPrelandings();
                    $lands = explode(',', $offer->landing_id);
                    $prelands = explode(',', $offer->prelanding_id);
                ?>


    <div class="col-12 mt-20">

        <div class="offer-items">
            <p class="pageTitle mb-25"><?php echo $loc['in_header_top_menu']['t18']; ?></p>
            <table  class="table table-borderless table-hover">

            <?php

            foreach ($landings as $landing) 
            {
                if ($landing->type == 1)
                {
                    $type_lend = '<img src="/templates/default/img/helpers/type_desctop.png" width=32 title="Обычный лендинг">';
                }
                if ($landing->type == 2) {
                    $type_lend = '<img src="/templates/default/img/helpers/type_mobile.png" width=32 title="Мобильный лендинг">';
                }
                if ($landing->type == 4) {
                    $type_lend = '<img src="/templates/default/img/helpers/type_adaptive.png" width=32 title="Адаптивный лендинг">';
                }
                ?>

                <tr>
                    <td class="align-middle" style="text-align: center;" width="10%">
                    <?php echo $type_lend; ?>
                    </td>
                    <td class="align-middle" width="60%">
                        <?php echo '<b>' . html_entity_decode($landing->name, ENT_QUOTES, 'utf-8') . '</b>'; ?>                        
                    </td>
                    <td class="align-middle">
                        <?php 
                            echo '<a target="_blank" href="'.$landing->url.'"><button type="button" style="font-size: 12px;padding: 2px 10px 2px 10px;" class="btn button">' . $loc['offers.php']['t119'] . '</button></a>';
                            if($offer_type == 1 || $offer_type == 7){
                            echo '<a href="./streams.php?offer='. $offer_id .'"><button type="button" style="margin-left:10px; font-size: 12px;padding: 2px 10px 2px 10px;" class="btn button">Скачать</button></a> ';
                            }
                        ?>


                    </td>
                </tr>
            <?php
            }
            ?>

            </table>


        </div>

    </div>

<?php
if($prelandings && count($prelandings) > 0){
?>

    <div class="col-12 mt-20">

        <div class="offer-items">
            <p class="pageTitle mb-25"><?php echo $loc['in_header_top_menu']['t35']; ?></p>
            <table  class="table table-borderless table-hover">
                <?php
                foreach ($prelandings as $landing) 
                {
                ?>
                    <tr>

                        <td class="align-middle">
                            <?php echo '<b>' . html_entity_decode($landing->name, ENT_QUOTES, 'utf-8') . '</b>'; ?>
                        </td>
                        <td class="align-middle text-right">
                            <?php echo '<a target="_blank" href="' . $landing->url . '"><button type="button" style="font-size: 12px;padding: 2px 10px 2px 10px;" class="btn button">' . $loc['offers.php']['t119'] . '</button></a>'; ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
<?php
}
?>
    </div>  

    <script src="./templates/<?php echo $template; ?>/js/ZeroClipboard.min.js"></script>
    <script src="./templates/<?php echo $template; ?>/js/ZeroClipboard.common.js"></script>                                     
