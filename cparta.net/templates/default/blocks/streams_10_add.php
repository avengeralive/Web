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

<form method="post" class="row" action="streams.php?<?php echo @$_SERVER['QUERY_STRING'] ?>" onsubmit="return func_checkbox()">

    <div class="col-12">    

        <div class="offer-items">
            
            <table class="table table-borderless table-sm mb-0">
                <tr>
                    <td class="align-middle">Название потока *</td>
                    <td class="align-middle">

                          <input type="text" class="form-control" name="name" placeholder="Название потока">

                    </td>
                </tr>
                <tr>
                    <td class="align-middle">Выбор домена *</td>
                    <td class="align-middle">

                            <select name="domain" class="form-control">                                                        
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

                    </td>
                </tr>
                
            </table>
            
        </div>

    </div>  
    
    <div class="col-12 mt-20">

        <div class="offer-items">
            <p class="pageTitle mb-25"><?php echo $loc['in_header_top_menu']['t18']; ?></p>
            <table  class="table table-borderless">

                <?php
                $offer = Offer::getById($offer_id);
                $landings = $offer->getlandings();
                $check='';
                $y = 0;
                foreach ($landings as $landing) {
                    if($y==0){$check='checked';}
                    $code = partnerstroka_encode($user_id . '-' . $offer->id .'-'.$landing->id);
                    
                    ?>
                    <tr>
                        <td class="align-middle" width="70%">
                            <div class="custom-control custom-checkbox">
                              <input <?=$check; ?> type="checkbox" name="land[]" class="custom-control-input landings" id="land_<?php echo $landing->id; ?>" value="<?php echo $landing->id; ?>">
                              <label class="custom-control-label" for="land_<?php echo $landing->id; ?>">
                                  <?php echo '<b>' . html_entity_decode($landing->name, ENT_QUOTES, 'utf-8') . '</b>'; ?>
                              </label>
                            </div>
                        </td>
                        <td class="align-middle text-right">
                            <?php
                                if( file_exists(dirname(__FILE__).'/../../../images/screens/'.md5($landing->url).'.jpg')){
                                    echo "<div class=preview><img class=ico width=16 src=/images/eye.ico><img class=preview src=/images/screens/".md5($landing->url).".jpg></div>";
                                }
                            ?>  
                            <?php 
                            echo '<a target="_blank" href="'.$landing->url.'"><button type="button" style="font-size: 12px;padding: 2px 10px 2px 10px;" class="btn button">' . $loc['offers.php']['t119'] . '</button></a>'; 
                            ?>                        
                        </td>
                    </tr>
                    <?php
                    $y++;
                }
                ?>        

            </table>
        </div>
    </div>
        
<?php
$offer = Offer::getById($offer_id);
$landings = $offer->getPrelandings();
if($landings && count($landings) > 0) {
?>
    <div class="col-12 mt-20">

        <div class="offer-items">
            <p class="pageTitle mb-25">Прелендинги</p>
            <table  class="table table-borderless">

                <?php
                    foreach ($landings as $landing) {
                        ?>
                        <tr>
                            <td class="align-middle" width="70%">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" name="pre[]" class="custom-control-input landings" id="land_<?php echo $landing->id; ?>" value="<?php echo $landing->id; ?>">
                                  <label class="custom-control-label" for="land_<?php echo $landing->id; ?>">
                                      <?php echo '<b>' . html_entity_decode($landing->name, ENT_QUOTES, 'utf-8') . '</b>'; ?>
                                  </label>
                                </div>
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

   
    <div class="col-6 mt-20">
        <div class="offer-items">
            <p class="pageTitle mb-25"><?php echo $loc['streams.php']['t22']; ?></p>
            <p class=""><a class="Postback_faq link" style="cursor:pointer;"><?php echo $loc['streams.php']['t23']; ?></a></p>
<div class="helpPostback" style="display:none;">
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
                                    <table class="table table-borderless mb-30">
                                        <tr>
                                            <td><b>{id}</b></td>
                                            <td>ID лида</td>
                                        </tr>
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
    <div class="form-group">        
    <div class="custom-control custom-checkbox">
      <input type="checkbox" name="postback_add" class="custom-control-input" id="postback_add">
      <label class="custom-control-label" for="postback_add">
          <?php echo $loc['streams.php']['t24']; ?>
      </label>
    </div>
    </div>    
    <div class="form-group">        
    <div class="custom-control custom-checkbox">
      <input type="checkbox" name="postback_success" class="custom-control-input" id="postback_success">
      <label class="custom-control-label" for="postback_success">
          <?php echo $loc['streams.php']['t25']; ?>
      </label>
    </div>
    </div>    
    <div class="form-group">        
    <div class="custom-control custom-checkbox">
      <input type="checkbox" name="postback_cancel" class="custom-control-input" id="postback_cancel">
      <label class="custom-control-label" for="postback_cancel">
          <?php echo $loc['streams.php']['t26']; ?>
      </label>
    </div>
    </div>        
    <div class="form-group">
      <label for="postback_url"><?php echo $loc['streams.php']['t27']; ?></label>
      <input type="text" class="form-control" name="postback_url" id="postback_url">
    </div>

        </div>
    </div> 

    <div class="col-6 mt-20">
        <div class="offer-items">
            <p class="pageTitle mb-25"><?php echo $loc['offers.php']['r15']; ?> <i style="cursor:pointer;" onmouseenter="$('.helpTr2Back').show()" class="fa fa-question-circle" aria-hidden="true"></i></p>
            <div class="helpTr2Back" style='position: absolute; display:none' onmouseout="$(this).hide()">
                <div style='position:relative; top: -50px; left: -10px; width: 400px; border:1px solid #ccc; background: white; padding: 10px'>
                    Вы можете указать ссылку, на которую будет перенаправляться пользователь в случае, если его гео не подходит под гео оффера, 
                    либо в случае остановки оффера по техническим причинам.<br>
                    Не теряйте свой трафик!<br>
                    Вы так же можете передать метки, для этого используйте макросы:<br>
                    {subid1}<br>
                    {subid2}<br>
                    {subid3}<br>
                    Пример: http://google.com/?utm1={subid1}&utm2={subid2}&utm3={subid3}
                </div>
            </div> 

                    <table class="table table-borderless" id="trafback_list">

                    <?php
                    $trafback_main = 'http://';
                    ?>                                
                        <tr>
                            <td>Url по умолчанию:</td>
                            <td><input type="text" id="main_url_trafback" value="<?=$trafback_main; ?>" name="url_trafback[]"><input type="hidden" name="countries[]" value="ALL"></td>
                            <td><img style="cursor:pointer;width: 15px;" onclick="$('#main_url_trafback').val('')" src="./templates/<?php echo $template; ?>/img/ico_delete.png" border="0"></td>
                        </tr>    

                    </table>                          
                    <center><input type="button" class="btn button" id="add_trafback_country" value="Добавить страну"></center>

                    <style>
                        .country_a{
                            background-repeat:no-repeat;
                            background-position:center left;padding-left:25px;
                            border:none;width: auto;text-align:center;
                        }
                    </style> 
        </div>
    </div>
    
<!--
    <div class="col-6 mt-20">
        <div class="offer-items">
            <p class="pageTitle mb-25"><?php echo $loc['streams.php']['t22']; ?></p>
            <div class="form-group">
                <textarea class="form-control" id="iframecode" style="width: 600px; height: 80px; padding: 0px 8px 0px 8px;" readonly></textarea>
            </div>
            <div class="form-group">
                <button id="btn-copy-iframecode" class="btn button btn-copy" data-clipboard-text="">Скопировать код</button>
            </div>
        </div>
    </div>
 -->
<?php
if($offer_type == 1 || $offer_type == 7){
?>
    <div class="col-6 mt-20">
        <div class="offer-items">
            <p class="pageTitle mb-25"><?php echo $loc['streams.php']['t15']; ?></p>
            <div class="form-group">
              <label for="GoogleAnalytics">Google Analytics</label>
              <input type="text" class="form-control" name="GoogleAnalytics" id="GoogleAnalytics">
            </div>
            <div class="form-group">
              <label for="metrika">Яндекс Метрика</label>
              <input type="text" class="form-control" name="metrika" id="metrika">
            </div>
            <div class="form-group">
              <label for="mail">Счетчик Mail.Ru</label>
              <input type="text" class="form-control" name="mail" id="mail">
            </div>
            <div class="form-group">
              <label for="vk">Вконтакте</label>
              <input type="text" class="form-control" name="vk" id="vk">
            </div>
            <div class="form-group">
              <label for="facebook">Facebook</label>
              <input type="text" class="form-control" name="facebook" id="facebook">
            </div>
        </div>
    </div>
 
    <div class="col-6 mt-20">
        <div class="offer-items">
            <p class="pageTitle mb-25"><?php echo $loc['streams.php']['t08']; ?></p>
            
            <div class="form-group">        
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="smartAB" class="custom-control-input" id="smartAB">
              <label class="custom-control-label" for="smartAB">
                  <?=$loc['streams.php']['t46'] ;?> &nbsp; <i data-toggle="tooltip" class="fa fa-question-circle-o" aria-hidden="true" data-html="true" title="В случае продвинутого a/b тестинга система будет выбирать наиболее прибыльный по ее мнению лендинг среди выбранных.<br>В случае обычного a/b тестинга трафик будет равномерно распределен по выбранным лендингам"></i>
              </label>
            </div>
            </div>
            
            <div class="form-group">        
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="auto_mobile" class="custom-control-input" id="auto_mobile">
              <label class="custom-control-label" for="auto_mobile">
                  Разделение мобильного трафика &nbsp; <i data-toggle="tooltip" class="fa fa-question-circle-o" aria-hidden="true" data-html="true" title="Если опция включена, система будет автоматически распределять мобайл/пк трафик на лендинги. <br>Если среди выбранных вами лендингов не окажется нужного - система автоматически подставит нужный"></i>
              </label>
            </div>
            </div>
            
            <div class="form-group">        
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="comeback" class="custom-control-input" id="comeback">
              <label class="custom-control-label" for="comeback">
                  <?php echo $loc['streams.php']['t09']; ?>	
              </label>
            </div>
            </div>
            
            <div class="form-group">        
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="pl_in_head" class="custom-control-input" id="pl_in_head">
              <label class="custom-control-label" for="pl_in_head">
                  <?php echo $loc['streams.php']['t10']; ?>	
              </label>
            </div>
            </div>
            
            <div class="form-group">        
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="pl_order" class="custom-control-input" id="pl_order">
              <label class="custom-control-label" for="pl_order">
                  <?php echo $loc['streams.php']['t11']; ?>	
              </label>
            </div>
            </div>
            
            <div class="form-group">        
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="pl_dost" class="custom-control-input" id="pl_dost">
              <label class="custom-control-label" for="pl_dost">
                  <?php echo $loc['streams.php']['t12']; ?>	
              </label>
            </div>
            </div>
            
            
            <div class="form-group">        
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="pl_us_online" class="custom-control-input" id="pl_us_online">
              <label class="custom-control-label" for="pl_us_online">
                  <?php echo $loc['streams.php']['t13']; ?>	
              </label>
            </div>
            </div>
            
            <div class="form-group">        
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="pl_freez_price" class="custom-control-input" id="pl_freez_price">
              <label class="custom-control-label" for="pl_freez_price">
                  <?php echo $loc['streams.php']['t14']; ?>	
              </label>
            </div>
            </div>
        </div>
    </div>
<?php
}
?> 
 
 
    <div class="col-12 mt-20">
        <div class="offer-items">
            <p class="pageTitle mb-25"><?php echo $loc['offers.php']['t234']; ?> &nbsp; <i data-toggle="tooltip" class="fa fa-question-circle-o" aria-hidden="true" data-html="true" title="Выбор тизерной сети автоматически заполняет SubID 1-5"></i></p>
            
            <div class="row">    
            
                <div class="form-group col-auto">                            
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
                
                <div class="form-group col-auto">
                  <input id="subid1" name="subid1"  type="text" placeholder="SubID 1" style="text-align: center; width: 100px;" autocomplete="off">
                </div>
                <div class="form-group col-auto">
                  <input id="subid2" name="subid2"  type="text" placeholder="SubID 2" style="text-align: center; width: 100px;" autocomplete="off">
                </div>
                <div class="form-group col-auto">
                  <input id="subid3" name="subid3"  type="text" placeholder="SubID 3" style="text-align: center; width: 100px;" autocomplete="off">
                </div>
                <div class="form-group col-auto">
                  <input id="subid4" name="subid4"  type="text" placeholder="SubID 4" style="text-align: center; width: 100px;" autocomplete="off">
                </div>
                <div class="form-group col-auto">
                  <input id="subid5" name="subid5"  type="text" placeholder="SubID 5" style="text-align: center; width: 100px;" autocomplete="off">
                </div>
        </div>
    </div>
    </div>     

       

     <div class="col-12 mt-35 text-center">
        <input type="hidden" id="landings" name="landings" value="<?php if(isset($_GET['land'])){echo htmlentities($_GET['land']);} ?>">
        <input type="hidden" name="offer" value="<?= $offer_id; ?>">
        <input type="submit" name="streams_submit" value="<?php echo $loc['streams.php']['t28']; ?>" class="btn button">
    </div> 
</form>

    <script src="./templates/<?php echo $template; ?>/js/ZeroClipboard.min.js"></script>
    <script src="./templates/<?php echo $template; ?>/js/ZeroClipboard.common.js"></script>										

    <?php
    include './templates/' . $template . '/js/streams.php';
}
?>
