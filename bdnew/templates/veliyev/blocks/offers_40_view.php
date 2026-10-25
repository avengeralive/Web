<?php
// Блок с выводом отдельно взятого оффера
// Block with the output of a single offer
$offer_id = htmlentities($_GET['offer']);
$sql = "SELECT * FROM offers WHERE `id`='$offer_id'";
$result = $mysqli->query($sql);
if (mysqli_num_rows($result) > 0) {
    $res = mysqli_fetch_array($result);

    // Назначаем переменные
    // Assign variables
    $offer_id = htmlentities($res['id']);
    $offer_tip = htmlentities($res['tip']);
    $offer_active = htmlentities($res['active']);
    $offer_uroven_dostupa = htmlentities($res['uroven_dostupa']);
    $offer_callcenter_info = html_entity_decode($res['callcenter_info']);
    $offer_name = htmlentities($res['name']);
    $offer_descr = html_entity_decode($res['descr']);
    $offer_url = htmlentities($res['url']);
    $offer_category = htmlentities($res['category']);
    $offer_owner_id = htmlentities($res['owner_id']);
    $offer_deystvie = htmlentities($res['deystvie']);
    $offer_date_end = ($res['offer_end'] > 0) ? date('d.m.Y H:i', htmlentities($res['offer_end'])) : 'Неограничено';
    $kolvo_lids = (htmlentities($res['kolvo_lids']) > 0) ? htmlentities($res['kolvo_lids']) : 'Неограничено';
    $kolvo_lids_num = (htmlentities($res['kolvo_lids']) > 0) ? htmlentities($res['kolvo_lids']) : 0;

    $offer_cena = explode('|', trim($res['cena']));
    $offer_comission = explode('|', trim($res['comission']));
    $offer_tip_comission = explode('|', trim($res['tip_comission']));
    $offer_comission_cpa = explode('|', trim($res['comission_cpa']));
    $offer_tip_comission_cpa = explode('|', trim($res['tip_comission_cpa']));

    $offer_postclick = htmlentities($res['postclick']);
    $offer_cr = htmlentities($res['cr']);
    $offer_epc = htmlentities($res['epc']);
    $offer_hold = htmlentities($res['hold']);
    $offer_sms_ok = htmlentities($res['sms_ok']);
    $offer_sms_phone = htmlentities($res['sms_phone']);
    $offer_email_ok = htmlentities($res['email_ok']);
    $offer_email_box = htmlentities($res['email_box']);
    $offer_sms_text_zakaz = htmlentities($res['sms_text_zakaz']);
    $offer_sms_text_send = htmlentities($res['sms_text_send']);
    $offer_sms_text_way = htmlentities($res['sms_text_way']);
    $offer_sms_text_success = htmlentities($res['sms_text_success']);
    $offer_allow_success_status_zakaz = htmlentities($res['allow_success_status_zakaz']);
    $offer_off_balance = htmlentities($res['off_balance']);
    $hidehold = htmlentities($res['hidehold']);
    $deeplink = htmlentities($res['deeplink']);
    // Переводим переменную отвечающую за тип принимаемого трафика в удобный вид
    // Translate variable responsible for the type of traffic received in convenient form
    $offer_tip_traffic = htmlentities($res['tip_traffic']);
    list($tip_traffic1, $tip_traffic2, $tip_traffic3, $tip_traffic4, $tip_traffic5, $tip_traffic6, $tip_traffic7, $tip_traffic8, $tip_traffic9, $tip_traffic10, $tip_traffic11, $tip_traffic12, $tip_traffic13, $tip_traffic14, $tip_traffic15, $tip_traffic16) = explode('|', trim($offer_tip_traffic, '|'));

    // Переводим переменную ГЕО в удобный вид
    // Translate variable GEO convenient form
    $offer_geo = explode('|', trim($res['geo']));
    $offer_country_iso_arr = explode(':', $offer_geo[0]);
    $offer_region_id_arr = explode(':', $offer_geo[1]);
    //list($offer_country_iso1, $offer_region_id1, $offer_city_id1) = explode('|', trim($offer_geo, '|'));
    ?>

    <script src="./templates/<?php echo $template; ?>/js/admin/edit_offer.js"></script>
    <style>
        .js-delete-country{
            color: red;
            cursor: pointer;
        }
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
    </style>
    <?php if ($offer_uroven_dostupa == -1) { ?>
        <style>
            .vip{
                background: #fdebc7;
                border:1px solid #f9b939;
                border-radius: 10px;
                font-size: 14px;
                text-align: center;
                padding: 20px;
                margin-bottom: 10px;
                box-sizing: border-box;
            }
        </style>
        <div class="col-12 mb-10 text-center">
            <div class="alert alert-primary" role="alert">
                Это закрытый офер, доступен избранным вебмастерам
            </div>
        </div>
    <?php } ?>

        
<div class="col-12">
        
    <form name="moderate_offer" class="row" id="moderate_offer" method="post" action="./offers.php?<?php echo @$_SERVER['QUERY_STRING'] ?>">
        
        
    <div class="col-12 ">
        <div class="card" style="min-height: auto;">
            <div class="card-body">
                <p class="postTitle mb-20 text-center">Изображение:</p>
                <?php $_SESSION['offer_id'] = $offer_id; ?>
                
  <style>
    .label {
      cursor: pointer;
    }

    .progress {
      display: none;
      margin-bottom: 1rem;
    }

    .img-container img {
      max-width: 100%;
    }
  </style>
                
                <link href="./modules/imagecrop/cropper/css/cropper.css" rel="stylesheet">
                
                <div class="text-center">
                    <label class="label " data-toggle="tooltip" title="Изменить изображение">
                        
                      
                                <?php
                                // Проверка, назначено ли промо для оффера
                                // Check if the promo is scheduled to offer
                                if (file_exists('./tmp/offer' . $offer_id . '.png')) {
                                    ?>
                                    <img id="avatar" border="0" src="./tmp/offer<?php echo $offer_id; ?>.png">
                                    <?php
                                } else {
                                    ?>
                                    <img id="avatar" border="0" src="./tmp/empty.png">
                                    <?php
                                }
                                ?>
                      
                      <input type="file" class="sr-only" id="input" name="image" accept="image/*">
                    </label>
                </div>    

                <div class="form-group mt-20">
                  <label for="offer_descr">Описание:</label>
                  <textarea maxlength="455" style="height:180px;padding:10px;" id="offer_descr" class="form-control" name="offer_descr"><?php echo $offer_descr; ?></textarea>
                </div>
                
                <div class="col-12 mt-30 mb-10 text-center">

                    <table class="table table-bordered">
                        <tr class="tableHead">
                            <td colspan="2"><b><?php echo $loc['offers.php']['t116']; ?></b></td>
                        </tr>
                        <?php
                        $sql_landings = "SELECT id,name,url FROM landings WHERE `offer_id`='$offer_id'";
                        $result_landings = $mysqli->query($sql_landings);
                        if (mysqli_num_rows($result_landings) > 0) {
                            while ($res_landings = mysqli_fetch_array($result_landings)) {
                                ?>
                                <tr>
                                    <td width="70%">
                                        <?php
                                        $land_id = htmlentities($res_landings['id']);
                                        $land_name = htmlentities($res_landings['name']);
                                        $land_url = str_replace('&amp;', '&', htmlentities($res_landings['url']));
                                        echo '<b>' . html_entity_decode($land_name, ENT_QUOTES, 'utf-8') . '</b>';
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo '<a target="_blank" href="' . $land_url . '">' . $loc['offers.php']['t119'] . '</a>'; ?>
                                        <?
                                            if( file_exists(dirname(__FILE__).'/../../../images/screens/'.md5($res_landings['url']).'.jpg')){
                                                echo "<div class=preview><img class=ico width=16 src=/images/eye.ico><img class=preview src=/images/screens/".md5($res_landings['url']).".jpg></div>";
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="2" style="background: red; color: white;">' . $loc['offers.php']['t120'] . '</td></tr>';
                        }
                        ?>
                    </table>
                    
                </div>
                
                
                       
                        <?php
                        $sql_prelandings = "SELECT id,name,url FROM prelandings WHERE `offer_id`='$offer_id'";
                        $result_prelandings = $mysqli->query($sql_prelandings);
                        if (mysqli_num_rows($result_prelandings) > 0) {
                            ?>
                            
                        <div class="col-12 mt-30 mb-10 text-center">    
                        <table class="table table-bordered">
                            <tr class="tableHead">
                                <td colspan="2"><b><?php echo $loc['offers.php']['t226']; ?></b></td>
                            </tr>
                            <?php
                            while ($res_prelandings = mysqli_fetch_array($result_prelandings)) {
                                ?>
                                <tr>
                                    <td width="70%">
                                        <?php
                                        $preland_id = htmlentities($res_prelandings['id']);
                                        $preland_name = htmlentities($res_prelandings['name']);
                                        $preland_url = str_replace('&amp;', '&', htmlentities($res_prelandings['url']));
                                        echo '<b>' . html_entity_decode($preland_name, ENT_QUOTES, 'utf-8') . '</b>';
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo '<a target="_blank" href="' . $preland_url . '">' . $loc['offers.php']['t119'] . '</a>'; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        </div>
                        <?php
                        }
                        ?>
                    
                               
                
                
            </div>
        </div>
    </div>  
        
        
    <div class="col-6 mt-20">
        <div class="card" style="min-height: auto;">
            <div class="card-body">
                <p class="postTitle mb-20"><?php echo $loc['offers.php']['t122']; ?></p>
                
                <div class="form-group">
                  <label for="name"><?php echo $loc['offers.php']['t03']; ?></label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo $loc['offers.php']['t151']; ?>" required value="<?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?>">
                </div>
                
                <div class="form-group">
                  <label for="url"><?php echo $loc['offers.php']['t152']; ?></label>
                  <input type="text" class="form-control" name="url" id="url" required  value="<?php echo html_entity_decode($offer_url, ENT_QUOTES, 'utf-8'); ?>">
                </div>
                
                <div class="form-group">
                    <label for=""><?php echo $loc['offers.php']['t180']; ?></label>                            
                    <select name="category" class="form-control">
                        <?php
                        $sql_category = "SELECT * FROM category_tpl";
                        $result_category = $mysqli->query($sql_category);
                        if (mysqli_num_rows($result_category) > 0) {
                            while ($res_category = mysqli_fetch_array($result_category)) {
                                $category_id = htmlentities($res_category['id']);
                                $category_name = htmlentities($res_category['name']);
                                if ($category_id == $offer_category) {
                                    ?>
                                    <option value="<?php echo $category_id; ?>" selected><?php echo $category_name; ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                  
                <div class="form-group">
                    <label class="" for=""><?php echo $loc['offers.php']['t30']; ?></label>                            
                    <select  class="form-control" name="uroven_dostupa">
                        <?php
                        $sql_checkdostup = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `tip_account`='10'";
                        $result_checkdostup = $mysqli->query($sql_checkdostup);
                        if (mysqli_num_rows($result_checkdostup) > 0) {
                            while ($res_checkdostup = mysqli_fetch_array($result_checkdostup)) {
                                $checkdostup_uroven_dostupa = htmlentities($res_checkdostup['uroven_dostupa']);
                                $checkdostup_opisanie = htmlentities($res_checkdostup['opisanie']);
                                ?>
                                <option value="<?php echo $checkdostup_uroven_dostupa; ?>" 
                                <?php
                                $res_checkdostup2 = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `uroven_dostupa`='$offer_uroven_dostupa' AND `tip_account`='10'";
                                $result_checkdostup2 = $mysqli->query($res_checkdostup2);
                                $res_checkdostup2 = mysqli_fetch_array($result_checkdostup2);
                                $checkdostup_uroven_dostupa2 = htmlentities($res_checkdostup2['uroven_dostupa']);
                                if ($checkdostup_uroven_dostupa == $checkdostup_uroven_dostupa2) {
                                    echo 'selected="selected"';
                                }
                                ?>><?php echo $checkdostup_opisanie; ?></option>
                                        <?php
                                    }
                                }
                                ?>		
                        <option <?php if ($offer_uroven_dostupa == -1) echo 'selected '; ?> value="-1">Закрытый, персональный доступ</option>
                    </select>
                    <a href="#" class="magic mt-5" id="js-offer-visible" data-id="<?php echo $offer_id; ?>" style="display:none">Список вебмастеров</a>
                </div>
                
                <div class="form-group">
                    <label class="" for=""><?php echo $loc['offers.php']['t31']; ?></label>                            
                    <select name="deystvie" class="form-control">
                    <?php			
                    // Выводим список целевых действий
                    // Display a list of targeted actions
                    $sql_deystvie = "SELECT id,deystvie FROM deystvie_tpl";
                    $result_deystvie = $mysqli->query($sql_deystvie);
                    if (mysqli_num_rows($result_deystvie) > 0) 
                            {
                            while($res_deystvie=mysqli_fetch_array($result_deystvie)) 
                                    { 
                                    $id_deystvie=htmlentities($res_deystvie['id']);
                                    $descr_deystvie=htmlentities($res_deystvie['deystvie']);
                                    ?><option value="<?php echo $id_deystvie; ?>"><?php echo $descr_deystvie; ?></option><?php
                                    }
                            }
                    ?>	
                    </select>
                </div>
                
                <div class="form-group">
                  <label for="postclick"><?php echo $loc['offers.php']['t38']; ?></label>
                  <input type="text" class="form-control" name="postclick" id="postclick" value="<?=$offer_postclick; ?>">
                </div>  
                
                <div class="form-group">
                  <label for="postclick"><?php echo $loc['offers.php']['t38']; ?></label>
                  <input type="text" class="form-control" name="postclick" id="postclick" value="<?=$default_price; ?>">
                </div>                 

            </div>
        </div>
    </div>
        
        
    <div class="col-6 mt-20">
        <div class="card" style="min-height: auto;">
            <div class="card-body">
                <p class="postTitle mb-20"><?php echo $loc['offers.php']['t45']; ?></p>
                <table class="table">
                    <?php
                    $sql_tip_traffic = "SELECT * FROM tip_traffic_tpl ORDER BY `tip` ASC";
                    $result_tip_traffic=$mysqli->query($sql_tip_traffic);
                    if (mysqli_num_rows($result_tip_traffic) > 0) 
                            {
                            while ($res_tip_traffic=mysqli_fetch_array($result_tip_traffic)) 
                                    {
                                    $tip_traffic=htmlentities($res_tip_traffic['tip']);
                                    $id_tip_traffic=htmlentities($res_tip_traffic['id']);
                                    ?>
                                    <tr>
                                            <td><?php echo $tip_traffic; ?></td>
                                    <td><input name="tip_traffic<?php echo $id_tip_traffic; ?>" type="checkbox" 
                                        <?php
                                        if ($id_tip_traffic == 1) {
                                            if ($tip_traffic1 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 2) {
                                            if ($tip_traffic2 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 3) {
                                            if ($tip_traffic3 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 4) {
                                            if ($tip_traffic4 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 5) {
                                            if ($tip_traffic5 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 6) {
                                            if ($tip_traffic6 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 7) {
                                            if ($tip_traffic7 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 8) {
                                            if ($tip_traffic8 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 9) {
                                            if ($tip_traffic9 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 10) {
                                            if ($tip_traffic10 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 11) {
                                            if ($tip_traffic11 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 12) {
                                            if ($tip_traffic12 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 13) {
                                            if ($tip_traffic13 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 14) {
                                            if ($tip_traffic14 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 15) {
                                            if ($tip_traffic15 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        if ($id_tip_traffic == 16) {
                                            if ($tip_traffic16 == 1) {
                                                echo 'checked=checked';
                                            }
                                        }
                                        ?>										
                                               ></td>
                                    </tr>
                                    <?php
                                    }
                            }
                    ?>
                </table>
            </div>
        </div>
    </div>
        

        
    <div class="col-12 form-group mt-35 text-center">
      <button type="submit" class="btn button" name="moderate_submit"><?php echo $loc['button']['t01']; ?></button>
    </div>
        
    </form>
</div>
        
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Обрезать изображение</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
          <img id="image" src="./tmp/offer<?php echo $offer_id; ?>.png">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary" id="crop">Сохранить</button>
      </div>
    </div>
  </div>
</div>

                <script src="./modules/imagecrop/cropper/js/cropper.js"></script>
                <script src="./modules/imagecrop/cropper/js/main.js"></script>
                
    <?php
}
?>