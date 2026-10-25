<script language="JavaScript" type="text/javascript">
function func_checkbox()
{
    If($('[name="land[]"]:checked').lenght===0) { alert("Вы не выбрали не одного лендинга!"); return false; } else { return true; }  
}
</script>

<div class="col-12 mb-10"><p class="pageTitle mb-25">Создание потока</p></div>

<?php
if (isset($_GET['offer']) && $_GET['offer'] != 0 && $_GET['offer'] != '') {
    $offer_id = htmlentities($_GET['offer']);
    
$user = User::getById($user_id);
$offer = Offer::getById($offer_id);    
if ($offer->active != 1) {
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
	//$offer_comission_cpa=explode('|', trim($offer->comission_cpa));
	$offer_tip_comission_cpa=explode('|', trim($offer->tip_comission_cpa));
	$offer_postclick=$offer->postclick;
	$offer_hold=$offer->hold;
        $off_balance=$offer->off_balance;
        $off_lids=$offer->off_lids;
        $deeplink=$offer->deeplink;
        
	// Переводим переменную отвечающая за тип принимаемого трафика в удобочитаемый вид
	// Translate variable responsible for the type of traffic received in convenient form
	$offer_tip_traffic=$offer->tip_traffic;
	list($tip_traffic1, $tip_traffic2, $tip_traffic3, $tip_traffic4, $tip_traffic5, $tip_traffic6, $tip_traffic7, $tip_traffic8, $tip_traffic9, $tip_traffic10, $tip_traffic11, $tip_traffic12, $tip_traffic13, $tip_traffic14, $tip_traffic15, $tip_traffic16) = explode('|', trim($offer_tip_traffic, '|'));	

	// Переводим переменную ГЕО в удобный вид
	// Translate variable GEO convenient form
	$offer_geo=explode('|', trim($offer->geo));
	$offer_country_iso_arr = explode(':', $offer_geo[0]);
	$offer_region_id_arr = explode(':', $offer_geo[1]);
	//list($offer_country_iso1, $offer_region_id1, $offer_city_id1) = explode('|', trim($offer_geo, '|'));     
        
        

        // Определяем домен который используется для лендингов
        // Determine the domain that is used for landing
        $sql_domain = "SELECT domain FROM domains WHERE `active`='1' ORDER BY `id` DESC";
        $result_domain = $mysqli->query($sql_domain);
        $res_domain=mysqli_fetch_array($result_domain);
        $domain=htmlentities($res_domain['domain']);
        // определяем данные рекламодателя чей оффер выводится
        // Define the data the advertiser whose offer appears
        $sql_userdata = "SELECT * FROM users WHERE `id`='$offer_owner_id'";
        $result_userdata = $mysqli->query($sql_userdata);
        $res_userdata=mysqli_fetch_array($result_userdata);

        $userdata_id=htmlentities($res_userdata['id']);
        $userdata_email=htmlentities($res_userdata['email']);
        $userdata_balance=htmlentities($res_userdata['balance']);        
?>
        <style>
            div.preview{
                float: right;
                margin-right: 70px;
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
                right: 0px;
            }
            .stats.active {
                margin-top: 12px;
            }            
            .link_wait_place {margin-top:22px;}
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
  
<script src="./templates/<?php echo $template; ?>/js/main.js"></script>

<form method="post" action="streams.php?<?php echo @$_SERVER['QUERY_STRING'] ?>" onsubmit="return func_checkbox()">

    <div class="col-12">    
      
  
            <p class="postTitle" style=""><span style="padding: 10px 66px 7px 66px;"><?php echo $loc['streams.php']['t44']; ?></span></p>
            <p class=""><span style="padding-left: 30px;" class="openSansBold"><?php echo $loc['offers.php']['r24']; ?>: &nbsp;</span> 
                <?php
                $res_checkdostup = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `uroven_dostupa`='$offer_uroven_dostupa' AND `tip_account`='10'";
                $result_checkdostup = $mysqli->query($res_checkdostup);
                $res_checkdostup=mysqli_fetch_array($result_checkdostup);
                echo $checkdostup_uroven_dostupa=htmlentities($res_checkdostup['opisanie']);
                ?>            
            </p>
            <p class=""><span style="padding-left: 30px;" class="openSansBold"><?php echo $loc['offers.php']['t236']; ?>: &nbsp;</span> 
                <?php			
                $sql_deystvie = "SELECT deystvie FROM deystvie_tpl WHERE `id`='$offer_deystvie'";
                $result_deystvie = $mysqli->query($sql_deystvie);
                $res_deystvie=mysqli_fetch_array($result_deystvie);
                echo $deystvie_opisanie=htmlentities($res_deystvie['deystvie']);
                ?>          
            </p>            
            <p class="">
                <img id="faqHold" src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -2px;" border="0">
                    <div class="faqHold">
                            <?php echo $loc['offers.php']['t237']; ?>
                    </div>
                <span style="padding-left: 30px;" class="openSansBold"><?php echo $loc['offers.php']['t33']; ?>: &nbsp;</span>                
                <?php 
                if($offer->hidehold == 1 && $hold_user == 0){
                   echo $loc['streams.php']['t45'];
                }elseif($hold_user != 0){                                                                            
                   echo $hold_user;                                                                            
                }else{
                   echo $offer_hold;  
                }


                ?>        
            </p>  
            <p class="">
                <img id="faqPostclick" src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -2px;" border="0">
                <div class="faqPostclick">
                        <?=$loc['offers.php']['t39']; ?>
                </div>                
                <span style="padding-left: 30px;" class="openSansBold"><?php echo $loc['offers.php']['t38']; ?>: &nbsp;</span> 
                <?php echo $offer_postclick; ?>         
            </p>
            <p class="">
                <img id="faqdate_end" src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -2px;" border="0">
                <div class="faqdate_end">
                        <?=$loc['offers.php']['r2']; ?>
                </div>                 
                <span style="padding-left: 30px;" class="openSansBold"><?php echo $loc['offers.php']['r1']; ?>: &nbsp;</span> 
                <?php echo $offer_date_end; ?>         
            </p>  
            <p class="">
                <img id="faqkolvo_lids" src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -2px;" border="0">
                <div class="faqkolvo_lids">
                       <?=$loc['offers.php']['r12']; ?>
                </div>                 
                <span style="padding-left: 30px;" class="openSansBold"><?php echo $loc['offers.php']['r13']; ?>: &nbsp;</span><br>
                <span style="padding-left: 30px;">
                <?php echo $kolvo_lids; ?>    
                </span>    
            </p>     
            <p class=""><span style="padding-left: 30px;" class="openSansBold"><?php echo $loc['offers.php']['t40']; ?>: &nbsp;</span><br>	
                <span style="padding-left: 30px;">
                <?php
                $cr_view = $epc_view = 0;
                $cr_view = $offer->cr;
                $epc_view = $offer->epc;
                echo $loc['offers.php']['t06']. ': ';if (round($cr_view,2)=='0') {echo $loc['offers.php']['t19'];} else {echo round($cr_view,2);}
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo $loc['offers.php']['t07']. ': ';if (round($epc_view,2)=='0') {echo $loc['offers.php']['t19'];} else {echo round($epc_view,2);}
                ?>     
                </span>
            </p>  
            <p style="font-size:15px;"><span style="padding-left: 30px;" class="openSansBold"><?php echo $loc['offers.php']['t28']; ?>&nbsp;</span> 
                <span id="price"><?=$default_price; ?></span>   
            </p>             
            <p style="font-size:15px;"><span style="padding-left: 30px;" class="openSansBold"><?php echo $loc['offers.php']['r18']; ?>:&nbsp;</span> 
                <span id="comission"><?=$default_comissions; ?></span>     
            </p>              
            <p class="postTitle" style="margin:30px 0;"><span style="padding: 10px 80px 7px 80px;"><?php echo $loc['offers.php']['t41']; ?></span></p>
            <?php
            
            if(count($offer_country_iso_arr) > 0 && count($offer_country_iso_arr) == count($offer_cena) && count($offer_country_iso_arr) == count($offer_comission)	&& count($offer_country_iso_arr) == count($offer_tip_comission)){
                echo '<table>';
                $t=0;
                
                foreach($offer_country_iso_arr as $key => $val){
                    $check = '';
                    $sql_geo = "SELECT name_ru,currency FROM sxgeo_country WHERE `iso`='$val'";
                    $result_geo = $mysqli->query($sql_geo);
                    if (mysqli_num_rows($result_geo) > 0){
                            $res_geo=mysqli_fetch_array($result_geo);
                            $geo_country_name=htmlentities($res_geo['name_ru']);
                            $currency=htmlentities($res_geo['currency']);
                    }else{
                            $geo_country_name=$loc['offers.php']['t09'];
                            $currency=$loc['offers.php']['t17'];
                    }				
                    if( $t%4==0){
                        echo '<tr>';
                    }
                    if($val == '0'){
                        echo '<td style="font-size: 18px;">Без ограничений</td>';
                        break;
                    }                        
                    if($t == 0){$check = 'checked';}
                    echo '<td><input '.$check.' name="countrys" data-iso="'.$val.'" type="radio" id="'.$val.'"><label for="'.$val.'"><img style="vertical-align: middle;margin-bottom: 3px" width="50px" src=./templates/'.$template.'/img/flags/' . $val . '.png></label></td>';											

                    $t++;
                }
                echo '</table>';
            }else{
                echo '<p style="font-size:15px;">'.$loc['offers.php']['t09'].'</p>';
            }
            ?>
            <p class="postTitle" style="margin:30px 0;"><span style="padding: 10px 45px 7px 45px;"><?php echo $loc['offers.php']['t45']; ?></span></p>
            <p style="font-size:15px;">
                <?php
                $sql_tip_traffic = "SELECT * FROM tip_traffic_tpl ORDER BY `tip` ASC";
                $result_tip_traffic=$mysqli->query($sql_tip_traffic);
                if (mysqli_num_rows($result_tip_traffic) > 0) 
                        {
                        while ($res_tip_traffic=mysqli_fetch_array($result_tip_traffic)) 
                                {
                                $tip_traffic=htmlentities($res_tip_traffic['tip']);
                                $id_tip_traffic=htmlentities($res_tip_traffic['id']);
                                echo '<p style="margin: 6px;" class="tiptrafic">';
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
                                echo '</p>';        
                                }
                        }
                ?>   
            </p>                
    
</div>  
     
<div style="float:right;width:70%;">        
        
    <div style="float:left;width:200px">
       <img style="border:3px solid #006b9d;border-radius: 10px;" border="0" src="./tmp/offer<?php echo $offer_id; ?>.jpg">
    </div>
    <div style="float:right;width:620px">
        <span class="offerName" style="font-size:20px;"><?php echo $loc['offers.php']['t03']; ?>&nbsp;&laquo;<?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?>&raquo;</span>
                                            <?php
                                                if($offer->callcenter_info !=''){
                                                    echo '<a class=callcenter_info style="margin-left: 25px;"><img src=/images/headphones.png>'
                                                    . '<div class=callcenter_info><b>Режим работы КЦ: </b><BR><br>'.nl2br($offer->callcenter_info).'</div></a>';
                                                }
                                            ?>        
        <p style="line-height: 23px;  color:#012434;  text-align: left;"><?php echo $offer_descr; ?></p>
    </div>
    <div class="clear"></div>          

    
    <div style="margin-top:30px;">
       <div class="link_wait_place stats navigation-page1 active"><a class="viewstats blocks" data-type="landings_block" ><?php echo $loc['offers.php']['t223']; ?></a></div>
       <div class="link_wait_place stats navigation-page1"><a class="viewstats blocks" data-type="prelandings_block" ><?php echo $loc['offers.php']['t222']; ?></a></div>
       <div class="link_wait_place stats navigation-page1" style="width: 145px;"><a class="viewstats blocks" data-type="postback_block" ><?php echo $loc['streams.php']['t22']; ?></a></div>
       <div class="link_wait_place stats navigation-page1" style="width: 145px;"><a class="viewstats blocks" data-type="trafback_block" ><?php echo $loc['offers.php']['r15']; ?></a></div>
       <div class="link_wait_place stats navigation-page1"><a class="viewstats blocks" data-type="iframe_block" ><?php echo $loc['offers.php']['r20']; ?></a></div>
    </div>     
    
            <table style="width:100%;margin:0 auto;border:1px solid #0085ba;border-top-width:7px; display:table; background: #fafafa" id="landings_block" class="tables_block">
                <?php
                $offer = Offer::getById($offer_id);
                $landings = $offer->getlandings();
                $check='';
                $y = 0;
                foreach ($landings as $landing) {
                    if($y==0){$check='checked';}
                    $code = partnerstroka_encode($user_id . '-' . $offer->id .'-'.$landing->id);
                    
                    ?>
                    <tr style="height: 50px;">
                        <td style="text-align: center;" width="10%">
                            <input type="checkbox" <?=$check; ?> class="landings" name="land[]" id="check_land" value="<?php echo $landing->id; ?>">
                        </td>
                        <td width="60%">
                            <?php
                            echo '<b>' . html_entity_decode($landing->name, ENT_QUOTES, 'utf-8') . '</b>';
                            ?>
                        </td>
                        <td>
                            <?php echo '<a target="_blank" href="http://bd-offers.ru/?p='.$code.'"><button type="button" style="font-size: 12px;padding: 2px 10px 2px 10px;" class="others_button_vyvesti">' . $loc['offers.php']['t119'] . '</button></a>'; ?>
                                <?php
                                    if( file_exists(dirname(__FILE__).'/../../../images/screens/'.md5($landing->url).'.jpg')){
                                        echo "<div class=preview><img class=ico width=16 src=/images/eye.ico><img class=preview src=/images/screens/".md5($landing->url).".jpg></div>";
                                    }
                                ?>                           
                        </td>
                    </tr>
                    <?php
                    $y++;
                }
                ?>
            </table>
            
            <table style="width:100%;margin:0 auto;border-top:7px solid #0085ba;display:none;" id="prelandings_block" class="tables_block">
                    <?php
                    $offer = Offer::getById($offer_id);
                    $landings = $offer->getPrelandings();
                    foreach ($landings as $landing) {
                        ?>
                        <tr style="height: 50px;">
                            <td style="text-align: center;" width="10%">
                                <input type="checkbox" <?=$check; ?> class="landings" name="pre[]" value="<?php echo $landing->id; ?>">
                            </td>
                            <td width="60%">
                                <?php
                                echo '<b>' . html_entity_decode($landing->name, ENT_QUOTES, 'utf-8') . '</b>';
                                ?>
                            </td>
                            <td>
                                <?php echo '<a target="_blank" href="' . $landing->url . '"><button type="button" style="font-size: 12px;padding: 2px 10px 2px 10px;" class="others_button_vyvesti">' . $loc['offers.php']['t119'] . '</button></a>'; ?>                         
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
            </table>        

            <table style="width:100%;margin: auto;border-top:7px solid #0085ba;display:none;" id="postback_block" class="tables_block">
                <tr>
                   <td style="text-align:center;">
                       <br> <br>
                                <a class="Postback_faq" style="cursor:pointer;"><?php echo $loc['streams.php']['t23']; ?>  <img src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-left: 10px;" border="0"></a>
<div class="helpPostback">
                                    <?php echo $loc['postback.php']['t03']; ?>
                                    <br/><br/>
                                    <?php echo $loc['postback.php']['t04']; ?>
                                    <br/><br/>
                                    <?php echo $loc['postback.php']['t05']; ?>
                                    <br/><br/>
                                    http://example.com/mystat.php?myprofit={profit}&subid={subid1}
                                    <br/>
                                    <?php echo $loc['postback.php']['t06']; ?>
                                    <br/><br/><b><?php echo $loc['postback.php']['t07']; ?>:</b><br/><br/>
                                    <table class="stats_table" style="width:100%;margin:10px auto;">
                                        <tr>
                                            <td><b>{status}</b></td>
                                            <td><?php echo $loc['postback.php']['t08']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>{stream_id}</b></td>
                                            <td><?php echo $loc['postback.php']['t09']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>{lead_time}</b></td>
                                            <td><?php echo $loc['postback.php']['t10']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>{ip}</b></td>
                                            <td><?php echo $loc['postback.php']['t11']; ?></td>
                                        </tr>											
                                        <tr>
                                            <td><b>{profit}</b></td>
                                            <td><?php echo $loc['postback.php']['t12']; ?></td>
                                        </tr>	
                                        <tr>
                                            <td><b>{offer_id}</b></td>
                                            <td><?php echo $loc['postback.php']['t13']; ?></td>
                                        </tr>	
                                        <tr>
                                            <td><b>{offer_name}</b></td>
                                            <td><?php echo $loc['postback.php']['t14']; ?></td>
                                        </tr>									
                                        <tr>
                                            <td><b>{subid1}</b></td>
                                            <td>SUB ID 1</td>
                                        </tr>
                                        <tr>
                                            <td><b>{subid2}</b></td>
                                            <td>SUB ID 2</td>
                                        </tr>
                                        <tr>
                                            <td><b>{subid3}</b></td>
                                            <td>SUB ID 3</td>
                                        </tr>
                                        <tr>
                                            <td><b>{subid4}</b></td>
                                            <td>SUB ID 4</td>
                                        </tr>
                                        <tr>
                                            <td><b>{subid5}</b></td>
                                            <td>SUB ID 5</td>
                                        </tr>                                        
                                    </table>		
                                </div>	                       
                       
                    <table class="offer_table2" style="width:50%;margin:10px auto;">
                        <tr>
                            <td>
                                <input type="checkbox" name="postback_add">
                            </td>
                            <td>
                                <?php echo $loc['streams.php']['t24']; ?>							
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="postback_success">
                            </td>
                            <td>
                                <?php echo $loc['streams.php']['t25']; ?>							
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="postback_cancel">
                            </td>
                            <td>
                                <?php echo $loc['streams.php']['t26']; ?>							
                            </td>
                        </tr>
                        <tr height="50px">
                            <td colspan="2">
                                <?php echo $loc['streams.php']['t27']; ?> &nbsp	<input type="text" name="postback_url"  value="" style="width: 250px; padding: 0px 8px 0px 8px; text-align: center;">						
                            </td>
                        </tr>							
                    </table>    
                    </td>
                </tr>
            </table> 
    

            <table style="width:100%;margin:0 auto;border-top:7px solid #0085ba;display:none;" id="trafback_block" class="tables_block">
                <tr>
                    <td>
                    <table class="offer_table2" id="trafback_list" style="width: 65%;margin:15px auto;">
                            <tr class="table_zagolovki" height="75px">
                                    <td colspan="3" style="text-align:center;">
                                    <?php echo $loc['offers.php']['r15']; ?> 
                                    <a class="tr_back_faq" onmouseenter="$('.helpTr2Back').show()" style="cursor:pointer;"><img src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-left: 20px;" border="0"></a>
                                    <div class="helpTr2Back" style='position: absolute; display:none' onmouseout="$(this).hide()">
                                        <div style='position:relative; top: -100px; left: 300px; width: 400px; border:1px solid #ccc; background: white; padding: 10px'>
                                            Вы можете указать ссылку, на которую будет перенаправляться пользователь в случае, если его гео не подходит под гео оффера, 
                                            либо в случае остановки оффера по техническим причинам.<br>
                                            Не теряйте свой трафик!<br>
                                            Вы так же можете передать метки, для этого используйте макросы:<br>
                                            {subid1}<br>
                                            {subid2}<br>
                                            {subid3}<br>
                                            Пример: avaleads.pro/?utm1={subid1}&utm2={subid2}&utm3={subid3}
                                        </div>
                                    </div>                                     
                                    </td>
                            </tr>

<?php
$trafback_main = 'http://';
?>                                
                        <tr>
                            <td>Url по умолчанию:</td>
                            <td><input type="text" id="main_url_trafback" style="width: 300px;" value="<?=$trafback_main; ?>" name="url_trafback[]"><input type="hidden" name="countries[]" value="ALL"></td>
                            <td><img style="cursor:pointer;width: 15px;" onclick="$('#main_url_trafback').val('')" src="./templates/<?php echo $template; ?>/img/ico_delete.png" border="0"></td>
                        </tr>    

                    </table>                          
                    <center><input type="button" class="others_button_vyvesti" id="add_trafback_country" value="Добавить страну"></center>
                    </td>
                </tr>    
            </table> 
 
                    <style>
                        .country_a{
                            background-repeat:no-repeat;
                            background-position:center left;padding-left:25px;
                            border:none;width: auto;text-align:center;
                        }
                    </style>   
    
            <table style="width:100%;margin: auto;border-top:7px solid #0085ba;display:none;" id="iframe_block" class="tables_block">
                <tr height="150px">
                    <td style="height: 80px;text-align: center;">
                            <textarea id="iframecode" style="line-height: 18px;width: 600px; height: 80px; padding: 0px 8px 0px 8px; text-align: center; font-weight: bold; font-size: 15px; margin-bottom:15px;margin-top:25px" readonly></textarea><br>									
                            <button id="btn-copy-iframecode" class="others_button_sohranit btn-copy" data-clipboard-text="">Скопировать код</button>
                            <br><br>
                    </td>
                </tr>
            </table>    
    
            <div style="width:80%;margin: 25px auto;border-top:3px solid #cccccc;padding-top:25px;text-align: center;">
                <input type="checkbox" name="smartAB" id='js-smartab'> <?=$loc['streams.php']['t46'] ;?>
                <a class="tr_back_faq" onmouseenter="$('.h1elpTrBack').show()" style="cursor:pointer;"> <img src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -1px;margin-left: 25px;" border="0"></a>
                <div class="h1elpTrBack" onmouseout="$(this).hide()" style='position: absolute; display:none'>
                    <div style='position:relative; top: -100px; left: 300px; width: 400px; border:1px solid #ccc; background: white; padding: 10px'>
                    В случае продвинутого a/b тестинга система будет выбирать наиболее прибыльный по ее мнению лендинг
                    среди выбранных. <br>
                    В случае обычного a/b тестинга трафик будет равномерно распределен по выбранным лендингам
                    </div>
                </div>             
            </div> 
                    <div style="width:80%;margin: 25px auto;border-top:3px solid #cccccc;padding-top:25px;text-align: center;min-height:5px;">
                    <div id="smartAB" >
                        <input type="checkbox" name="auto_mobile" <?php if ($stream->auto_mobile) echo 'checked'; ?> id='js-smartab'> Разделение мобильного трафика
                        <a class="tr_back_faq" onmouseenter="$('.help-automobile').show()" style="cursor:pointer;"> <img src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -1px;margin-left: 25px;" border="0"></a>
                        <div class="help-automobile" onmouseout="$(this).hide()" style='position: absolute; display:none'>
                            <div style='position:relative; top: -100px; left: 300px; width: 400px; border:1px solid #ccc; background: white; padding: 10px'>
                                Если опция включена, система будет автоматически распределять мобайл/пк трафик на лендинги. <br>Если среди выбранных вами лендингов не окажется нужного - система автоматически подставит нужный
                            </div>
                        </div> 
                    </div>
                </div>  
    
        <p style="text-align: center;width:370px;margin:100px auto 25px;background: #0085ba;border-radius: 10px;padding: 10px 35px 7px 35px;font-family: 'intro_regular';color: #fff;font-size: 18px;"><?php echo $loc['streams.php']['t15']; ?></p>   
     
        <div style="margin-top:30px;">
           <div class="link_wait_place stats navigation-page2 active"><a class="viewstats metriks" data-type="yandex_block" ><?php echo $loc['streams.php']['t16']; ?></a></div>
           <div class="link_wait_place stats navigation-page2" style="width: 145px;"><a class="viewstats metriks" data-type="vk_block" ><?php echo $loc['streams.php']['t17']; ?></a></div>
           <div class="link_wait_place stats navigation-page2"><a class="viewstats metriks" data-type="facebook_block" ><?php echo $loc['streams.php']['t18']; ?></a></div>
           <div class="link_wait_place stats navigation-page2" style="width: 145px;"><a class="viewstats metriks" data-type="mail_block" ><?php echo $loc['streams.php']['t19']; ?></a></div>
           <div class="link_wait_place stats navigation-page2"><a class="viewstats metriks" data-type="direct_block" ><?php echo $loc['streams.php']['t20']; ?></a></div>
        </div>     
    
            <table style="width:100%;margin: auto;border-top:7px solid #0085ba;display:table;" id="yandex_block" class="metriks_block">
                <tr height="100px">
                    <td style="text-align:center;padding-top: 25px;">
                        <a class="metrika_faq" style="cursor:pointer;"><img src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -2px;" border="0">  <span style="padding-left: 33px;"><?php echo $loc['streams.php']['t21']; ?></span></a><br>
                        <div class="helpmetrika">
                            Пример кода:<br>
                            &lt;!-- Yandex.Metrika counter --&gt;<br>
                            &lt;sсript type="text/javascript"&gt;<br>
                            (function (d, w, c) {<br>
                            (w[c] = w[c] || []).push(function() { <br>
                            try { <br>
                            w.yaCounter26311101 = new Ya.Metrika({id:<font color="red">26311101</font>}); <br>
                            } catch(e) { } <br>
                            }); <br><br>

                            var n = d.getElementsByTagName("script")[0], <br>
                            s = d.createElement("script"), <br>
                            f = function () { n.parentNode.insertBefore(s, n); }; <br>
                            s.type = "text/javascript"; <br>
                            s.async = true; <br>
                            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; <br><br>

                            if (w.opera == "[object Opera]") { <br>
                            d.addEventListener("DOMContentLoaded", f, false); <br>
                            } else { f(); } <br>
                            })(document, window, "yandex_metrika_callbacks"); <br>
                            &lt;/sсript&gt;<br>
                            &lt;nosсript&gt;&lt;div&gt;&lt;img src="//mc.yandex.ru/watch/<font color="red">26311101</font>"<br>
                            style="position:absolute; left:-9999px;" alt="" /&gt;&lt;/div&gt;</nosсript&gt; <br>
                            &lt;!-- /Yandex.Metrika counter --&gt; <br>
                            <b>То, что вам нужно вставить в поле из вашей версии кода: <font color="red">26311101</font></b>
                        </div>
                        <input type="text" name="metrika" placeholder="<?php echo $loc['streams.php']['t16']; ?>" value="" style="width: 200px; padding: 0px 8px 0px 8px; margin-top:20px;text-align: center;">
                    </td>
                </tr>
            </table>  
       
            <table style="width:100%;margin: auto;border-top:7px solid #0085ba;display:none;" id="vk_block" class="metriks_block">
                <tr height="100px">
                    <td style="text-align:center;padding-top: 25px;">
                        <a class="vk_faq" style="cursor:pointer;"><img src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -2px;" border="0">  <span style="padding-left: 33px;"><?php echo $loc['streams.php']['t21']; ?></span></a><br>
                        <div class="helpvk">
                            Пример кода:<br>
                            &lt;script type="text/javascript"&gt;(window.Image ? (new Image()) : document.createElement(\'img\')).src = location.protocol + '//vk.com/rtrg?r=<font color="red">nzDNUt*p3j1bOfzr7pAAJ/TyWBpKRVsZbZ12337cXRW8zPR79uL4W1qq3r<br>
                            UPsi4/vnT9rDliwSGGhNF1As7cwO374q099jrTnlDR4UzsSmaH3d13Ek6go580MrWqZUUxxD6TzctqeLq/d0uecZxn<br>
                            nEMTvpmO0dzrFC/m3BMjnHQ-&pixel_id=1000021819</font>';&lt;/script&gt;<br>
                            <b>В поле Вам нужно вставить все, начиная от «r=» до «';». </b>
                        </div>
                        <textarea name="vk" style="width: 200px; height:100px;padding: 0px 8px 0px 8px; text-align: center;margin-top:20px;"></textarea>
                    </td>
                </tr>
            </table>        

            <table style="width:100%;margin: auto;border-top:7px solid #0085ba;display:none;" id="facebook_block" class="metriks_block">
                <tr height="100px">
                    <td style="text-align:center;padding-top: 25px;">
                        <a class="facebook_faq" style="cursor:pointer;"><img src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -2px;" border="0">  <span style="padding-left: 33px;"><?php echo $loc['streams.php']['t21']; ?></span></a><br>
                        <div class="helpfacebook">
                            Пример кода: <br>
                            &lt;script&gt;(function() { <br>
                            var _fbq = window._fbq || (window._fbq = []); <br>
                            if (!_fbq.loaded) { <br>
                            var fbds = document.createElement(\'script\'); <br>
                            fbds.async = true; <br>
                            fbds.src = \'//connect.facebook.net/en_US/fbds.js\'; <br>
                            var s = document.getElementsByTagName(\'script\')[0]; <br>
                            s.parentNode.insertBefore(fbds, s); <br>
                            _fbq.loaded = true; <br>
                            } <br>
                            _fbq.push([\'addPixelId\', \'<font color="red">1542141899389999</font>\']); <br>
                            })(); <br>
                            window._fbq = window._fbq || []; <br>
                            window._fbq.push([\'track\', \'PixelInitialized\', {}]); <br>
                            &lt;/script&gt; <br>
                            &lt;noscript&gt;&lt;img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=<font color="red">1542141899389999</font>&amp;ev=PixelInitialized" /&gt;&lt;/noscript&gt; <br>
                            <b>То, что вам нужно вставить в поле из вашей версии кода: <font color="red">1542141899389999</font></b>
                        </div>
                        <input type="text" name="facebook"  value="" style="width: 200px; padding: 0px 8px 0px 8px; text-align: center;margin-top:20px;">
                    </td>
                </tr>
            </table>   
       
            <table style="width:100%;margin: auto;border-top:7px solid #0085ba;display:none;" id="mail_block" class="metriks_block">
                <tr height="100px">
                    <td style="text-align:center;padding-top: 25px;">
                        <a class="mail_faq" style="cursor:pointer;"><img src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -2px;" border="0">  <span style="padding-left: 33px;"><?php echo $loc['streams.php']['t21']; ?></span></a><br>
                        <div class="helpmail">
                            Пример кода: <br>
                            &lt;!-- Rating@Mail.ru counter --&gt; <br>
                            &lt;script type="text/javascript"&gt;<br>
                            var _tmr = _tmr || []; <br>
                            _tmr.push({id: "<font color="red">1234567</font>", type: "pageView", start: (new Date()).getTime()}); <br>
                            (function (d, w) { <br>
                            var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; <br>
                            ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js"; <br>
                            var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);}; <br>
                            if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } <br>
                            })(document, window); <br>
                            &lt;/script>&lt;noscript&gt;&lt;div style="position:absolute;left:-10000px;"&gt; <br>
                            &lt;img src="//top-fwz1.mail.ru/counter?id=<font color="red">1234567</font>;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" /&gt;<br>
                            &lt;/div>&lt;/noscript&gt;<br>
                            &lt;!-- //Rating@Mail.ru counter --&gt;<br>
                            <b>То, что вам нужно вставить в поле из вашей версии кода: <font color="red">1234567</font></b>
                        </div>
                        <input type="text" name="mail"  value="" style="width: 200px; padding: 0px 8px 0px 8px; text-align: center;margin-top:20px;">
                    </td>
                </tr>
            </table>            

            <table style="width:100%;margin: auto;border-top:7px solid #0085ba;display:none;" id="direct_block" class="metriks_block">
                <tr height="100px">
                    <td style="text-align:center;padding-top: 25px;">
                        <a class="directadvert_faq" style="cursor:pointer;"><img src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -2px;" border="0">  <span style="padding-left: 33px;"><?php echo $loc['streams.php']['t21']; ?></span></a><br>
                        <div class="helpdirectadvert">
                            Пример кода:<br> 
                            &lt;img src="//code.directadvert.ru/track/<font color="red">123456</font>.gif" width="1" height="1" /&gt;<br>
                            <b>То, что вам нужно вставить в поле из вашей версии кода: <font color="red">123456</font></b>
                        </div>
                        <input type="text" name="directadvert"  value="" style="width: 200px; padding: 0px 8px 0px 8px; text-align: center;margin-top:20px;">
                    </td>
                </tr>
            </table>  
        
    
        <p style="text-align: center;width:770px;margin:100px auto 25px;background: #0085ba;border-radius: 10px;padding: 10px 35px 7px 35px;font-family: 'intro_regular';color: #fff;font-size: 18px;"><?php echo $loc['streams.php']['t08']; ?></p>   

        <table style="margin: 0 auto; ">
            <tr height="25">
                <td width="10%" style="text-align:center;">
                    <input type="checkbox"  name="comeback">
                </td>
                <td>
                    <?php echo $loc['streams.php']['t09']; ?>							
                </td>
            </tr>
            <tr height="25">
                <td width="10%" style="text-align:center;">
                    <input type="checkbox"  name="pl_in_head">
                </td>
                <td>
                    <?php echo $loc['streams.php']['t10']; ?>							
                </td>
            </tr>
            <tr height="25">
                <td width="10%" style="text-align:center;">
                    <input type="checkbox"  name="pl_order">
                </td>
                <td>
                    <?php echo $loc['streams.php']['t11']; ?>							
                </td>
            </tr>
            <tr height="25">
                <td width="10%" style="text-align:center;">
                    <input type="checkbox"  name="pl_dost">
                </td>
                <td>
                    <?php echo $loc['streams.php']['t12']; ?>							
                </td>
            </tr>
            <tr height="25">
                <td width="10%" style="text-align:center;">
                    <input type="checkbox"  name="pl_us_online">
                </td>
                <td>
                    <?php echo $loc['streams.php']['t13']; ?>							
                </td>
            </tr>
            <tr height="25">
                <td width="10%" style="text-align:center;">
                    <input type="checkbox"  name="pl_freez_price">
                </td>
                <td>
                    <?php echo $loc['streams.php']['t14']; ?>							
                </td>
            </tr>							
        </table>           
        

            <div style="width:80%;margin: 25px auto;padding-top:25px;text-align: center;">
            <?php echo $loc['offers.php']['t234']; ?> <a class="tr_back_faq" onmouseenter="$('.helpMyTarget').show()" style="cursor:pointer;"> <img src="./templates/<?php echo $template; ?>/img/question2.png" style="position: absolute;margin-top: -1px;margin-left: 25px;" border="0"></a><br>
            <div class="helpMyTarget" onmouseout="$(this).hide()" style='position: absolute; display:none'>
                <div style='position:relative; top: -40px; left: 140px; width: 600px; border:1px solid #ccc; background: white; padding: 10px'>
                Выбор тизерной сети автоматически заполняет SubID 1-5          
                </div>
            </div>
            </div> 
            <div style="margin: 25px auto;width:300px;">
                <select id="teser_set">
                    <option value="0">Выбрать сеть</option>
                    <option value="1">MyTarget(https://target.my.com/)</option>
                    <option value="2">ActionTeaser(http://actionteaser.ru)</option>
                    <option value="3">AdHub(http://adhub.ru)</option>
                    <option value="4">AdvertLink (http://advertlink.ru)</option>
                    <option value="5">BodyClick (http://bodyclick.net)</option>
                    <option value="6">Etarg (http://etarg.ru)</option>
                    <option value="7">GlobalTeaser (http://globalteaser.ru)</option>
                    <option value="8">Goodsredtram (http://goods.redtram.com)</option>
                    <option value="9">Kadam (http://kadam.ru)</option>
                    <option value="10">MarketGid (http://marketgid.com)</option>
                    <option value="11">MediaVenus (http://mediavenus.ru)</option>
                    <option value="12">MegaTizer (http://megatizer.com)</option>
                    <option value="13">MobiAds (http://mobiads.ru)</option>
                    <option value="14">Novostimira (http://novostimira.com.ua)</option>
                    <option value="15">Oblivki (http://oblivki.biz)</option>
                    <option value="16">Octobird (http://octobird.com)</option>
                    <option value="17">Recreativ (http://recreativ.ru)</option>
                    <option value="18">TeaserMedia (http://teasermedia.net)</option>
                    <option value="19">TeaserNet (http://teasernet.com)</option>
                    <option value="20">Tovarro (http://www.tovarro.com)</option>
                    <option value="21">Visitweb (http://visitweb.com)</option>
                    <option value="22">Yottos (http://yottos.com)</option>
                </select>               
             </div>       
        
        
    <div style="margin: 10px auto;width:655px;">
        <input id="subid1" name="subid1"  type="text"   placeholder="SubID 1" style="text-align: center; width: 100px;" autocomplete="off">
        <input id="subid2" name="subid2"  type="text"   placeholder="SubID 2" style="text-align: center; width: 100px;" autocomplete="off">			
        <input id="subid3" name="subid3"  type="text"   placeholder="SubID 3" style="text-align: center; width: 100px;" autocomplete="off">				
        <input id="subid4" name="subid4"  type="text"  placeholder="SubID 4" style="text-align: center; width: 100px;" autocomplete="off">
        <input id="subid5" name="subid5"  type="text"  placeholder="SubID 5" style="text-align: center; width: 100px;" autocomplete="off">
    </div>

    <p style="width:390px;margin:30px auto;"><span style="" class="openSansBold"><?php echo $loc['streams.php']['t40']; ?>: &nbsp;</span>   
        <select name="domain" class="width-250">                                                        
             <?php
             $sql_domain = "SELECT id,domain FROM domains WHERE (`user_id`='$user_id' AND `active` = '5') OR `active` IN (1,4) ORDER BY `id` ASC";
             echo $sql_domain;

             $result_domain = $mysqli->query($sql_domain);
             if (mysqli_num_rows($result_domain) > 0) {
                 $i = 1;
                 while ($res_domain = mysqli_fetch_array($result_domain)) {
                     $domain_id = htmlentities($res_domain['id']);
                     $domain_url = htmlentities($res_domain['domain']);
                     ?>

                     <option <?php
                     if ($i == 1) {
                         echo 'selected';
                     }
                     ?> value="<?php echo $domain_id; ?>"><?php echo $domain_url; ?></option>

                     <?php
                     $i++;
                 }
             } else {
                 echo '<tr><td style="background: red; color: white;">' . $loc['offers.php']['t25'] . '</td></tr>';
             }
             ?>
         </select>   
    </p>
    <center>
        <input type="hidden" id="landings" name="landings" value="<?php if(isset($_GET['land'])){echo htmlentities($_GET['land']);} ?>">
        <input type="hidden" name="offer" value="<?= $offer_id; ?>">
        <input type="submit" name="streams_submit" value="<?php echo $loc['streams.php']['t28']; ?>" class="others_button_sohranit" style="margin-top: 25px;">
    </center>    
</div>    

    </form>
    <div class="clear"></div>
    <script src="./templates/<?php echo $template; ?>/js/ZeroClipboard.min.js"></script>
    <script src="./templates/<?php echo $template; ?>/js/ZeroClipboard.common.js"></script>										
<script>        
    $(document).on('click', '.blocks', function () {
        check_iframe();
        $('.navigation-page1').removeClass('active');
        $(this).parent('.navigation-page1').addClass('active');
        var type = $(this).attr('data-type');
        $('.tables_block').css('display','none');
        $('#'+type).css('display','table');
    })
    $(document).on('click', '.metriks', function () {
        $('.navigation-page2').removeClass('active');
        $(this).parent('.navigation-page2').addClass('active');
        var type = $(this).attr('data-type');
        $('.metriks_block').css('display','none');
        $('#'+type).css('display','table');
    })
</script>
    <?php
    include './templates/' . $template . '/js/streams.php';
}
?>
