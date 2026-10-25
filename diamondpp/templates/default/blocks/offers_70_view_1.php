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
    <script src="./templates/<?php echo $template; ?>/js/main.js"></script>
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
        <div class="vip">
            Это закрытый офер, доступен избранным вебмастерам
        </div>
    <?php } ?>

    <form name="moderate_offer" id="moderate_offer" method="post" action="./offers.php?<?php echo @$_SERVER['QUERY_STRING'] ?>">
        <table class="stats_table">
            <tr class="tableHead">
                <td><?php echo $loc['offers.php']['t03']; ?>&nbsp;&nbsp;&nbsp;<input type="text" name="name" placeholder="<?php echo $loc['offers.php']['t151']; ?>" required style="width: 350px; text-align: center;" maxlength="90" value="<?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?>"></td>
            </tr>
            <tr class="row_title" style="font-weight: normal;">
                <?php if ($offer_active == '0') { ?><td style="background: red; color: white;"><?php echo $loc['offers.php']['t168']; ?>&nbsp;<a onclick="if (!confirm('<?php echo $loc['offers.php']['t171']; ?>'))
                                    return false;" href="./offers.php?on=<?php echo $offer_id; ?>"><?php echo $loc['offers.php']['t174']; ?></a>&nbsp;<?php echo $loc['offers.php']['t176']; ?>&nbsp;<a href="./offers.php?delete=<?php echo $offer_id; ?>" onclick="if (!confirm('Вы действительно желаете удалить этот оффер?'))
                                                return false;"><?php echo $loc['offers.php']['t177']; ?></a>.</td><?
                    }
                    if ($offer_active == '1') {
                        ?><td style="background: green; color: white;"><?php echo $loc['offers.php']['t169']; ?>&nbsp;<a onclick="if (!confirm('<?php echo $loc['offers.php']['t172']; ?>'))
                                            return false;" href="./offers.php?off=<?php echo $offer_id; ?>"><?php echo $loc['offers.php']['t175']; ?></a>&nbsp;<?php echo $loc['offers.php']['t176']; ?>&nbsp;<a href="./offers.php?delete=<?php echo $offer_id; ?>" onclick="if (!confirm('Вы действительно желаете удалить этот оффер?'))
                                                        return false;"><?php echo $loc['offers.php']['t177']; ?></a>.</td><?
                    }
                    if ($offer_active == '2') {
                        ?><td style="background: yellow; color: red;"><?php echo $loc['offers.php']['t170']; ?>&nbsp;<a onclick="if (!confirm('<?php echo $loc['offers.php']['t173']; ?>'))
                                            return false;" href="./offers.php?on=<?php echo $offer_id; ?>"><?php echo $loc['offers.php']['t174']; ?></a>,&nbsp;<a onclick="if (!confirm('<?php echo $loc['offers.php']['t172']; ?>'))
                                                        return false;" href="./offers.php?off=<?php echo $offer_id; ?>"><?php echo $loc['offers.php']['t175']; ?></a>&nbsp;<?php echo $loc['offers.php']['t176']; ?>&nbsp;<a href="./offers.php?delete=<?php echo $offer_id; ?>" onclick="if (!confirm('<?php echo $loc['offers.php']['t178']; ?>'))
                                                                    return false;"><?php echo $loc['offers.php']['t177']; ?></a>.</td><?php }
                    ?>
            </tr>

            <tr class="row_title">
                <td valign="top">
                    <?php
                    // определяем данные рекламодателя чей оффер выводится
                    // Define the data the advertiser whose offer appears
                    $sql_userdata = "SELECT * FROM users WHERE `id`='$offer_owner_id'";
                    $result_userdata = $mysqli->query($sql_userdata);
                    $res_userdata = mysqli_fetch_array($result_userdata);

                    $userdata_id = htmlentities($res_userdata['id']);
                    $userdata_email = htmlentities($res_userdata['email']);
                    $userdata_balance = htmlentities($res_userdata['balance']);
                    ?>

                    <p>
                       
                        <?php
                        $sql_prelandings = "SELECT id,name,url FROM prelandings WHERE `offer_id`='$offer_id'";
                        $result_prelandings = $mysqli->query($sql_prelandings);
                        if (mysqli_num_rows($result_prelandings) > 0) {
                            ?>
                        <table class="offer_table2">
                            <tr class="tableHead">
                                <td colspan="2"><?php echo $loc['offers.php']['t226']; ?></td>
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
                        <?php
                    }
                    ?>
                    <table class="offer_table2">
                        <tr class="tableHead">
                            <td colspan="2"><?php echo $loc['offers.php']['t116']; ?></td>
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

                    <table class="offer_table2">
                        <tr class="tableHead">
                            <td colspan="2"><?php echo $loc['offers.php']['t121']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 230px;">

                                <?php $_SESSION['offer_id'] = $offer_id; ?>

                                <link href="./modules/imagecrop/css/main.css" rel="stylesheet">
                                <link href="./modules/imagecrop/css/croppic.css" rel="stylesheet">

                                <div id="cropContainerModal" style="width: 200px; height: 200px; margin: 10px auto 10px auto; padding: 0; border: 1px solid gray;margin-left:15px;">
                                    <?php
                                    // Проверка, назначено ли промо для оффера.
                                    // Check if the promo is scheduled to offer.
                                    if (file_exists('./tmp/offer' . $offer_id . '.jpg')) {
                                        ?>
                                        <img border="0" src="./tmp/offer<?php echo $offer_id; ?>.jpg">
                                        <?php
                                    }
                                    ?>
                                </div>

                                <script src="./modules/imagecrop/js/croppic.min.js"></script>
                                <script src="./modules/imagecrop/js/main.js"></script>									

                            </td>
                            <td>

                                <p>
                                    <textarea maxlength="455" style="width:340px;height:180px;padding:10px;" name="offer_descr"><?php echo $offer_descr; ?></textarea>
                                    <textarea style="height:180px;padding:10px;" placeholder="Работа КЦ (255 символов)" name="callcenter_info"><?php echo $offer_callcenter_info;?></textarea>
                                </p>

                            </td>								


                        </tr>
                    </table> 

                    <table class="offer_table2">
                        <tr class="tableHead">
                            <td><?php echo $loc['offers.php']['t152']; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="offer_text_description" style="text-align: center; line-height: 25px;">
                                    <input name="url" value="<?php echo $offer_url; ?>" maxlength="200" required style="width: 500px; text-align: center;"> <a target="_blank" href="<?php echo $offer_url; ?>"><?php echo $loc['offers.php']['t179']; ?></a>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <table class="offer_table2">
                        <tr class="tableHead">
                            <td colspan="2"><?php echo $loc['offers.php']['t122']; ?></td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <?php echo $loc['offers.php']['t180']; ?>&nbsp;
                            </td>
                            <td>
                                <select class="width-250" name="category">
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
                            </td>
                        </tr>
                        <tr>
                                <td width="70%">
                                        Рекламодатель оп умолчанию&nbsp;(<a target="_blank" href="users.php?edit=<?php echo $offer_owner_id; ?>" class="normal_link"><?php echo $loc['offers.php']['t182']; ?></a>,&nbsp;<a target="_blank" href="./tickets.php?komu=<?php echo $offer_owner_id; ?>"><span class="send_ticket"></span></a>):
                                        <input type="hidden" name="id_owner" value="<?php echo $offer_owner_id; ?>">
                                </td>
                                <td>
                                        <select name="vladelec">
                                                <option value="<?php echo $userdata_id; ?>" selected="selected"><?php echo $userdata_email; ?></option>
                                                <?php
                                                $sql_rekl = "SELECT * FROM users WHERE `tip`='40' AND `active`='1' AND `uroven_dostupa`='2' ORDER BY `email`";
                                                $result_rekl = $mysqli->query($sql_rekl);
                                                if (mysqli_num_rows($result_rekl) > 0) 
                                                        {
                                                        while($res_rekl=mysqli_fetch_array($result_rekl)) 
                                                                {
                                                                $rekl_id=htmlentities($res_rekl['id']);
                                                                $rekl_email=htmlentities($res_rekl['email']);
                                                                if ($rekl_email!=$userdata_email)
                                                                        {
                                                                        ?>
                                                                        <option value="<?php echo $rekl_id; ?>"><?php echo $rekl_email; ?></option>
                                                                        <?php
                                                                        }
                                                                }
                                                        }
                                                ?>
                                        </select>										
                                </td>
                        </tr>                        
                        
                        <tr>
                           
                            <td width="50%">
                                Рекламодатели по ГЕО&nbsp;
                                <input type="hidden" name="id_owner" value="<?php echo $offer_owner_id; ?>">
                            </td>
                            <td width="50%">
                                <table class="" style="width:95%;margin:0 auto;">                                
                                    
                                <?php
                                $of = Offer::getById($offer_id);
                                $iso = $of->getISOCountries();
                                $owners = Offer::getOfferOwners($offer_id);
                                $def_owner = User::getById($offer_owner_id);
                                $def_o = ($def_owner['alias'] != '') ? $def_owner['alias'] : $def_owner['email'];
                                $def_o_bal = ($def_owner['balance'] > 1000) ? '<font color="green">('.$def_owner['balance'].')</font>': '<font color="red">('.$def_owner['balance'].')</font>';
                                $owner_this[0] = ['owner' => $def_o, 'balance' => $def_o_bal, 'andOther' => 1];   
                                if (count($owners) > 0) {
                                    foreach ($owners as $o){
                                        $owner = User::getById($o->owner_id);
                                        $ow = ($owner['alias'] != '') ? $owner['alias'] : $owner['email'];
                                        $bal = $owner['balance'];
                                        $bal = ($bal > 1000) ? '<font color="green">('.$bal.')</font>': '<font color="red">('.$bal.')</font>';                                        
                                        $owner_this[$o->country_iso] = ['owner' => $ow, 'balance' => $bal, 'andOther' => $o->andOther];   
                                        if($o->andOther == 1){
                                            $default_owner = ($owner['alias'] != '') ? $owner['alias'] : $owner['email'];
                                            $default_owner_bal = $owner['balance'];
                                            $default_owner_bal = ($default_owner_bal > 1000) ? '<font color="green">('.$default_owner_bal.')</font>': '<font color="red">('.$default_owner_bal.')</font>';
                                            $owner_this[0] = ['owner' => $default_owner, 'balance' => $default_owner_bal, 'andOther' => 1];                                            
                                        }                                         
                                    } 
                                }

                                foreach ($iso as $c_iso){
                                    echo '<tr>';   
                                    if(!empty($c_iso)){
                                        echo '<td>'.$c_iso.' <img src="./modules/detectclient/SxGeo/img/'. strtolower($c_iso) .'.png"></td>';
                                        if (array_key_exists($c_iso, $owner_this)) {
                                            $owner_data = $owner_this[$c_iso];
                                        }else{
                                            $owner_data = $owner_this[0];
                                        }
                                    }else{
                                        echo '<td>Без огр.</td>';
                                        $owner_data = $owner_this[0];
                                    }
                                    echo '<td>';
                                    echo $owner_data['owner'].' '.$owner_data['balance'];
                                    echo '</td>';
                                    echo '</tr>';
                                }                           
                                ?>                                 
                                </table>                                    
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <?php echo $loc['offers.php']['t183']; ?>&nbsp;
                            </td>
                            <td>
                                <?php echo $userdata_balance; ?>&nbsp;<?php echo $loc['offers.php']['t17']; ?>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <?php echo $loc['offers.php']['t30']; ?>&nbsp;
                            </td>
                            <td>
                                <select  class="width-250" name="uroven_dostupa">
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
                                <a href="#" class="magic " id="js-offer-visible" data-id="<?php echo $offer_id; ?>" style="display:none"><br>Список вебмастеров</a>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <?php echo $loc['offers.php']['t185']; ?>&nbsp;
                            </td>
                            <td>
                                <select class="width-250" name="allow_success_status_zakaz">
                                    <option value="0" <?php if ($offer_allow_success_status_zakaz == '0') { ?>selected="selected"<?php } ?>>&nbsp;<?php echo $loc['offers.php']['t186']; ?>&nbsp;</option>
                                    <option value="1" <?php if ($offer_allow_success_status_zakaz == '1') { ?>selected="selected"<?php } ?>>&nbsp;<?php echo $loc['offers.php']['t187']; ?>&nbsp;</option>
                                </select>
                            </td>
                        </tr>
	
                        <tr>
                            <td width="50%">
                                <?php echo $loc['offers.php']['t232']; ?>&nbsp;
                            </td>
                            <td>
                                <input name="deeplink" <?php
                                if ($deeplink == 1) {
                                    echo 'checked';
                                }
                                ?> type="checkbox">    
                            </td>
                        </tr>                        
                    </table>							
                    </p>

                    <p>
                    <table class="offer_table2">
                        <tr class="tableHead">
                            <td colspan="2"><?php echo $loc['offers.php']['t31']; ?></td>
                        </tr>
                        <tr>
                            <td width="70%">
                                <select class="width-250" name="deystvie" class="">
                                    <?php
                                    // Выводим список целевых действий
                                    // Display a list of targeted actions
                                    $sql_deystvie = "SELECT id,deystvie FROM deystvie_tpl";
                                    $result_deystvie = $mysqli->query($sql_deystvie);
                                    if (mysqli_num_rows($result_deystvie) > 0) {
                                        while ($res_deystvie = mysqli_fetch_array($result_deystvie)) {
                                            $id_deystvie = htmlentities($res_deystvie['id']);
                                            $descr_deystvie = htmlentities($res_deystvie['deystvie']);
                                            if ($id_deystvie == $offer_deystvie) {
                                                ?><option selected value="<?php echo $id_deystvie; ?>"><?php echo $descr_deystvie; ?></option><?php
                                            } else {
                                                ?><option value="<?php echo $id_deystvie; ?>"><?php echo $descr_deystvie; ?></option><?php
                                            }
                                        }
                                    }
                                    ?>		
                                </select>
                            </td>
                        </tr>
                    </table>  

                    <table class="offer_table2">
                        <tr class="tableHead">
                            <td colspan="2"><?php echo $loc['offers.php']['t32']; ?></td>
                        </tr>
                        <tr>
                            <td width="70%"><?php echo $loc['offers.php']['t33']; ?>&nbsp;<span class="smallinfo" title="<?php echo $loc['offers.php']['t35']; ?>"><?php echo $loc['offers.php']['t37']; ?></span></td>
                            <td>
                                <input name="hold" value="<?php echo $offer_hold; ?>" maxlength="2" style="width: 30px; text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td width="70%"><?php echo $loc['offers.php']['t231']; ?></td>
                            <td>
                                <input type="checkbox" <?php
                                if ($hidehold == 1) {
                                    echo 'checked';
                                }
                                ?> name="hidehold">
                            </td>
                        </tr>                          
                        <tr>
                            <td><?php echo $loc['offers.php']['t38']; ?>&nbsp;<span class="smallinfo" title="<?php echo $loc['offers.php']['t39']; ?>"><?php echo $loc['offers.php']['t37']; ?></span></td>
                            <td>
                                <input name="postclick" value="<?php echo $offer_postclick; ?>" maxlength="2" style="width: 30px; text-align: center;">
                            </td>
                        </tr>      
                        <tr>
                            <td><?php echo $loc['offers.php']['r1']; ?>&nbsp;<span class="smallinfo" title="<?php echo $loc['offers.php']['r2']; ?>"><?php echo $loc['offers.php']['t37']; ?></span></td>
                            <td>
                                <script src="./templates/<?php echo $template; ?>/js/jquery.maskedinput.min.js"></script>
                                <p id="dateEnd">
                                    <a style="cursor:pointer;" onclick="changeDateEndAdmin();"><?php echo $offer_date_end; ?></a>
                                </p>
                            </td>
                        </tr> 	

                        <tr>
                            <td><?php echo $loc['offers.php']['r10']; ?>&nbsp;<span class="smallinfo" title="<?php echo $loc['offers.php']['r11']; ?>"><?php echo $loc['offers.php']['t37']; ?></span></td>
                            <td>
                                <p id="KolvoLids">
                                    <a style="cursor:pointer;" onclick="changeKolvoLidsAdmin('<?php echo $kolvo_lids_num; ?>');"><?php echo $kolvo_lids; ?></a>
                                </p>
                            </td>
                        </tr> 

                    </table> 

                    <?php
                    $cr_view = $epc_view = 0;
                    $cr_view = $res['cr'];
                    $epc_view = $res['epc'];
                    if( $res['real_cr'] == 1){
                        $data = Offer::getRealCrAndEpcFor($res['id']);
                        if( $data->leads < 10){
                            $cr_view = $epc_view = 'Недостаточно данных';
                        }
                        else{
                            $cr_view = $data->cr;
                            $epc_view = $data->epc;
                        }
                    }
                    $data_fake = Offer::getFakeCrAndEpcFor($res['id']);
                    $data_real = Offer::getRealCrAndEpcFor($res['id']);
                    
                    ?>						

                    <table class="offer_table2">
                        <tr class="tableHead">
                            <td colspan="2"><?php echo $loc['offers.php']['t40']; ?></td>
                        </tr>
                        <tr>
                            <td width="70%"><?php echo $loc['offers.php']['t06']; ?></td>
                            <td>

                                <?php
                                    echo "Real: ". round(floatval($data_real->cr), 2).", Fake: ".round(floatval($data_fake->cr),2 );
                                ?>

                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $loc['offers.php']['t07']; ?></td>
                            <td>

                                <?php
                                    echo "Real: ". round(floatval($data_real->epc), 2).", Fake: ".round(floatval($data_fake->epc),2 );
                                ?>
                            </td>
                        </tr>   
                        <tr><td></td>
                                <TD>
                                    <input name=real_cr value=1 <?php if($res['real_cr']) echo 'checked'; ?> type='checkbox'>Использовать реальный
                                </TD>
                        </tr>
                    </table>
                    <?php
                    $stat = DB::getInstance()->query("select * from offers_stat where offer_id=" . $offer_id);
                    if ($stat->rowCount() == 0) {
                        $stat = false;
                    } else {
                        $stat = $stat->fetchObject();
                    }
                    ?>


                    <table class="offer_table2">
                        <tr class="tableHead">
                            <td colspan="20">Статистика</td>
                        </tr>
                        <tr>
                            <td width="10%">
                                Пол
                            </td>
                            <td align="left" style="text-align: right">
                                М: <input value="<?php if ($stat) echo htmlentities($stat->sex_male); ?>" name=stat[sex][male] size="3">%,
                                Ж: <input value="<?php if ($stat) echo htmlentities($stat->sex_female); ?>"name=stat[sex][female] size="3">%
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">
                                Возраст
                            </td>
                            <td align="left" style="text-align: right">
                                18-22: <input value="<?php if ($stat) echo htmlentities($stat->age_22); ?>" name=stat[age][22] size="3">%,
                                22-25: <input value="<?php if ($stat) echo htmlentities($stat->age_25); ?>"name=stat[age][25] size="3">%,
                                25-30: <input value="<?php if ($stat) echo htmlentities($stat->age_30); ?>"name=stat[age][30] size="3">%,
                                30-35: <input value="<?php if ($stat) echo htmlentities($stat->age_35); ?>"name=stat[age][35] size="3">%,
                                35-45: <input value="<?php if ($stat) echo htmlentities($stat->age_45); ?>"name=stat[age][45] size="3">%,
                                45+: <input value="<?php if ($stat) echo htmlentities($stat->age_99); ?>" name=stat[age][99] size="3">%

                            </td>
                        </tr>
                        <tr>
                            <td width="10%">
                                Устройство
                            </td>
                            <td align="left" style="text-align: right">
                                ПК: <input value="<?php if ($stat) echo htmlentities($stat->device_pc); ?>" name=stat[device][pc] size="3">%,
                                Моб: <input value="<?php if ($stat) echo htmlentities($stat->device_phone); ?>" name=stat[device][phone] size="3">%
                                Планшет: <input value="<?php if ($stat) echo htmlentities($stat->device_tablet); ?>" name=stat[device][tablet] size="3">%
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">
                                Аппрув
                            </td>
                            <td align="left" style="text-align: right">
                                Одобрено: <input value="<?php if ($stat) echo htmlentities($stat->approve_ok); ?>" name=stat[approve][ok] size="3">%,
                                Ожидание: <input value="<?php if ($stat) echo htmlentities($stat->approve_waiting); ?>" name=stat[approve][waiting] size="3">%
                                Отмена: <input value="<?php if ($stat) echo htmlentities($stat->approve_reject); ?>" name=stat[approve][reject] size="3">%
                            </td>

                        </tr>
                        <tr>
                            <td width="10%">
                                Истоник трафика
                            </td>
                            <td align="left" style="text-align: right">
                                <?php
                                $tUrl = '';
                                $tPercent = '';
                                ?>

                                <?php if ($stat) list($tUrl, $tPercent) = explode(',', $stat->traffic1); ?>
                                <input name=traffic[1][url] value="<?php echo htmlentities($tUrl); ?>" placeholder="УРЛ исчтоника"> <input value="<?php echo htmlentities($tPercent); ?>"  placeholder="%" size="3" name=traffic[1][percent]> <br>

                                <?php if ($stat) list($tUrl, $tPercent) = explode(',', $stat->traffic2); ?>
                                <input name=traffic[2][url] value="<?php echo htmlentities($tUrl); ?>" placeholder="УРЛ исчтоника"> <input value="<?php echo htmlentities($tPercent); ?>"  placeholder="%" size="3" name=traffic[2][percent]> <br>

                                <?php if ($stat) list($tUrl, $tPercent) = explode(',', $stat->traffic3); ?>
                                <input name=traffic[3][url] value="<?php echo htmlentities($tUrl); ?>" placeholder="УРЛ исчтоника"> <input value="<?php echo htmlentities($tPercent); ?>"  placeholder="%" size="3" name=traffic[3][percent]> <br>

                                <?php if ($stat) list($tUrl, $tPercent) = explode(',', $stat->traffic4); ?>
                                <input name=traffic[4][url] value="<?php echo htmlentities($tUrl); ?>" placeholder="УРЛ исчтоника"> <input value="<?php echo htmlentities($tPercent); ?>"  placeholder="%" size="3" name=traffic[4][percent]> <br>

                                <?php if ($stat) list($tUrl, $tPercent) = explode(',', $stat->traffic5); ?>
                                <input name=traffic[5][url] <?php if ($tUrl != '') { ?>value="<?php echo htmlentities($tUrl); ?>" <?php } ?> value="Другие источники"> <input value="<?php echo htmlentities($tPercent); ?>"  placeholder="%" size="3" name=traffic[5][percent]> <br>

                            </td>
                        </tr>

                    </table>
                    <?php include_once './templates/' . $template . '/js/geo_spisok_js.php'; ?>
                    <table class="offer_table2" id="geotraf">
                        <tr class="tableHead">
                            <td colspan="4"><?php echo $loc['offers.php']['t41']; ?></td>
                        </tr>
                        <tr class="tableHead">
                            <td><?php echo $loc['offers.php']['t42']; ?></td>
                            <td><?php echo $loc['offers.php']['t43']; ?></td>
                            <td colspan=2 style="width: 450px;">
                                <table style="width:100%;">
                                    <tr>
                                        <td colspan="4"><?php echo $loc['offers.php']['r17']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0;border: none;">
                                        <table style="width:100%;">
                                            <tr>
                                                <td style="padding: 0;font-size:11px;width:184px;"><?php echo $loc['offers.php']['t28']; ?></td>
                                                <td style="padding: 0;font-size:11px;width:184px;"><?php echo $loc['offers.php']['r18']; ?></td>
                                                <td style="padding: 0;font-size:11px;width:184px;"><?php echo $loc['offers.php']['t184']; ?></td>
                                                <td style="padding: 0;border:none;width:27px;"></td>
                                            </tr>	
                                        </table>    
                                        </td>    
                                    </tr>           
                                </table>			
                            </td>
                        </tr>
                        <?php
                        $countCountrys = count($offer_country_iso_arr);

                        for ($i = 0; $countCountrys > $i; $i++) {
                            $offer_country_iso = $offer_country_iso_arr[$i];
                            echo '<tr height="70px">';
                            echo '<td>';
                            ?>
                        <select name="country[]" onchange="setRegion(this);" class="width-200">
                                <option value="0"><?php echo $loc['offers.php']['t190']; ?></option>
                                <?php
                                $sql_spisokstran = "SELECT * FROM sxgeo_country ORDER BY `name_ru` ASC";
                                $result_spisokstran = $mysqli->query($sql_spisokstran);
                                if (mysqli_num_rows($result_spisokstran) > 0) {
                                    while ($res_spisokstran = mysqli_fetch_array($result_spisokstran)) {
                                        $current_country_iso = htmlentities($res_spisokstran['iso']);
                                        $current_country_name = htmlentities($res_spisokstran['name_ru']);
                                        ?>
                                        <option value="<?php echo $current_country_iso; ?>" <?php
                                        if ($current_country_iso == $offer_country_iso) {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $current_country_name; ?></option>
                                                <?php
                                            }
                                        } else {
                                            echo '<option value="0">' . $loc['offers.php']['t190'] . '</option>';
                                        }
                                        ?>
                            </select>									
                            <?php
                            echo '</td>';
                            echo '<td>';
                            echo '<select name="region[]" class="regions width-200"><option value="0">' . $loc['offers.php']['t190'] . '</option>';
                            $sql_region = "SELECT * FROM sxgeo_regions WHERE `country`='$offer_country_iso' ORDER BY `name_ru` ASC";
                            $result_region = $mysqli->query($sql_region);
                            if (mysqli_num_rows($result_region) > 0) {
                                while ($res_region = mysqli_fetch_array($result_region)) {
                                    $current_region_id = htmlentities($res_region['id']);
                                    $current_region_name = htmlentities($res_region['name_ru']);
                                    ?>
                                    <option value="<?php echo $current_region_id; ?>" <?php
                                    if ($current_region_id == $offer_region_id_arr[$i]) {
                                        echo 'selected="selected"';
                                    }
                                    ?>><?php echo $current_region_name; ?></option>
                                            <?php
                                        }
                                    } else {
                                        echo '<option value="0">' . $loc['offers.php']['t190'] . '</option>';
                                    }
                                    echo '</select>';

                                    echo '</td>';
                                    echo '<td>';
                                    echo '<table style="width:100%;">';
                                    echo '<tr>';

                                    $sql_geo = "SELECT currency FROM sxgeo_country WHERE `iso`='$offer_country_iso'";
                                    $result_geo = $mysqli->query($sql_geo);
                                    if (mysqli_num_rows($result_geo) > 0) {
                                        $res_geo = mysqli_fetch_array($result_geo);
                                        $currency = htmlentities($res_geo['currency']);
                                    } else {
                                        $currency = $loc['offers.php']['t17'];
                                    }

                                    if (count($offer_comission) == count($offer_comission_cpa)) {
                                        $comission_cpa1 = $offer_comission_cpa[$i];
                                    } else {
                                        $comission_cpa1 = 0;
                                    }

                                    echo '<td style="border:none;width:184px;padding: 0;"><input type="text" name="cena[]" style="vertical-align: middle;width: 50px; text-align: center;" maxlength="10" value="' . $offer_cena[$i] . '">&nbsp;<span class="curr">' . $currency . '</span>&nbsp;</td>';
                                    echo '<td style="border:none;width:184px;padding: 0;">';
                                    echo '<input type="text" name="comission[]" style="vertical-align: middle;width: 50px; text-align: center;" maxlength="10" value="' . $offer_comission[$i] . '"> ';
                                    ?>
                            <select class="width-100" name="tip_comission[]">
                                <option value="1" <?php if (isset($offer_tip_comission[$i]) && $offer_tip_comission[$i] == 1) { ?>selected="selected"<?php } ?>>&nbsp;<?php echo $loc['offers.php']['t17']; ?>&nbsp;</option>
                                <option value="2" <?php if (isset($offer_tip_comission[$i]) && $offer_tip_comission[$i] == 2) { ?>selected="selected"<?php } ?>>&nbsp;<?php echo $loc['offers.php']['t18']; ?>&nbsp;</option>
                            </select>							
                            <?php
                            echo '</td>';
                            echo '<td style="border:none;width:184px;padding: 0;">';
                            ?>
                            <input type="text" name="comission_cpa[]" style="vertical-align: middle;width: 50px; text-align: center;" maxlength="10" value="<?php
                            if ($offer_tip_comission[$i] == 1) {
                                echo $comission_cpa1;
                            } elseif ($offer_tip_comission[$i] == 2) {
                                echo (int) $comission_cpa1;
                            }
                            ?>">
                            <select class="width-100" name="tip_comission_cpa[]">
                                <option value="1" <?php if (isset($offer_tip_comission[$i]) && $offer_tip_comission[$i] == 1) { ?>selected="selected"<?php } ?>>&nbsp;<?php echo $loc['offers.php']['t17']; ?>&nbsp;</option>
                                <option value="2" <?php if (isset($offer_tip_comission[$i]) && $offer_tip_comission[$i] == 2) { ?>selected="selected"<?php } ?>>&nbsp;<?php echo $loc['offers.php']['t18']; ?>&nbsp;</option>
                            </select>						
                            <?php
                            echo '</td>';

                            echo '</tr>';
                            echo '</table>';

                            echo '</td>';
                            echo '<td style="width:27px;padding: 0;" class="js-delete-country">x</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                    <table class="offer_table2">
                        <tr>
                            <td><input type="button" value="Добавить страну" id="addCountryAdmin" class="others_button_vyvesti" style="margin:15px auto;"></td>
                        </tr>							
                    </table>
                    
                    <table class="offer_table2" id="geotraf"  >
                        <tr class="tableHead">
                            <td colspan="10">Ресейл</td>
                        </tr>
                        <tr class="tableHead">
                            <td width="200px"><?php echo $loc['offers.php']['t42']; ?></td>
                            <td colspan="2">Рекламодатель (ID/%)</td>
                            <td>Pinger Type</td>
                            <td>Pinger Value</td>
                            <td colspan="2">И другие страны / Удалить</td>
                        </tr>  
                        <?php
                        $offer_ownwers = Offer::getOfferOwners($res['id']);
                        foreach ($offer_ownwers as $row){
                            $s='';
                            if($row->andOther) $s='checked';
                            echo "<Tr>"
                            . "<td><input type=hidden name=resell[{$row->id}][id] value={$row->id}><input value=\"{$row->country_iso}\" type=text name=resell[{$row->id}][country_iso] size=3></td>"
                            . "<td><input value=\"{$row->owner_id}\" type=text name=resell[{$row->id}][owner_id] size=3></td>"
                            . "<td><input value=\"{$row->percent}\" type=text name=resell[{$row->id}][percent] size=3></td>"
                            . "<td width=100><input value=\"{$row->pinger_type}\" type=text name=resell[{$row->id}][pinger_type] ></td>"
                            . "<td width=100><input value=\"{$row->pinger_value}\" type=text name=resell[{$row->id}][pinger_value] ></td>"
                            . "<td><input type=checkbox name=resell[{$row->id}][andOther] value=1 $s></td>"
                            . "<td><input type=checkbox name=delete_resell[{$row->id}] value=1></td>"
                            . "</tr>"
                        ?>  
                       
                        <?php    
                        }
                        ?>
                          <Tr>
                            <td><input type=text name=resell[-1][country_iso] size=3></td>
                            <td><input type=text name=resell[-1][owner_id] size=3></td>
                            <td><input type=text name=resell[-1][percent] size=3 value="100"></td>
                            <td width=100><input type=text name=resell[-1][pinger_type] ></td>
                            <td width=100><input type=text name=resell[-1][pinger_value] ></td>
                            <td><input type=checkbox name=resell[-1][andOther] value=1 ></td>
                            </tr>
                    </table>
                                    
                    
                    <table class="offer_table2" id="geotraf"  >
                        <tr class="tableHead">
                            <td colspan="10">Похожие офферы</td>
                        </tr>
                        <tr class="tableHead">
                            <td>Оффер</td>
                            <td>Список похожих офферов</td>
                        </tr>  
                        <tr>
                            <td>
                                <select class="width-auto" id="sim_offers" data-search-placeholder="Оффер" name="offer" style="text-align: left;">
                                    <option>Выбрать оффер</option>
                                    <?php
                                    $offers = new Offer;
                                    $offers_arr = $offers->getByAdmin();   
                                    if (is_array($offers_arr) && count($offers_arr) > 0) {
                                        foreach ($offers_arr as $offer){
                                           echo '<option value="'.$offer['id'].'" ';
                                           echo '>'.html_entity_decode($offer['name'], ENT_QUOTES, 'utf-8').'</option>';
                                        }                                    
                                    }
                                    ?>
                                </select>  
                            </td>
                            <td>
                                <div class="sim_offer">
                                    <?php
                                    $similar_offer = Offer::getSimilarTo($offer_id);
                                    if(!empty($similar_offer)){
                                        $sim = explode(',', $similar_offer);
                                        foreach($sim as $k=>$v){
                                            $offer_sim = Offer::getById($v);
                                            echo '<p class="p_'.$v.'">'.$offer_sim->name.' <span class="del_sim" data-value="'.$v.'">X</span></p>';
                                        }  
                                    }
                                    ?>
                                </div> 
                                <input type="hidden" id="sim_of_n" name="similar_offers" value="<?php echo $similar_offer; ?>">
                            </td>
                        </tr>
                    </table>                    
                    
                    
                    <table class="offer_table2">
                        <tr class="tableHead">
                            <td colspan="2"><?php echo $loc['offers.php']['t45']; ?></td>
                        </tr>
                        <?php
                        $sql_tip_traffic = "SELECT * FROM tip_traffic_tpl ORDER BY `tip` ASC";
                        $result_tip_traffic = $mysqli->query($sql_tip_traffic);
                        if (mysqli_num_rows($result_tip_traffic) > 0) {
                            while ($res_tip_traffic = mysqli_fetch_array($result_tip_traffic)) {
                                $tip_traffic = htmlentities($res_tip_traffic['tip']);
                                $id_tip_traffic = htmlentities($res_tip_traffic['id']);
                                ?>
                                <tr>
                                    <td width="70%"><?php echo $tip_traffic; ?></td>
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

                    <br /><hr><br />

                    <form name="moderate_email_offer" id="moderate_email_offer" method="post" action="./offers.php?<?php echo @$_SERVER['QUERY_STRING'] ?>">
                        <table class="offer_table2">
                            <tr class="tableHead">
                                <td colspan="2"><?php echo $loc['offers.php']['t124']; ?></td>
                            </tr>
                            <tr>

                                <td style="width: 50%; line-height: 23px;">
                                    <?php echo $loc['offers.php']['t191']; ?><br />
                                    <select name="email_ok" style="width: 200px;">
                                        <option class="options" value="0" <?php if ($offer_email_ok == '0') { ?>selected="selected"<?php } ?>><?php echo $loc['offers.php']['t193']; ?></option>
                                        <option class="options" value="1" <?php if ($offer_email_ok == '1') { ?>selected="selected"<?php } ?>><?php echo $loc['offers.php']['t194']; ?></option>
                                    </select>
                                </td>
                                <td style="width: 50%; line-height: 23px;">
                                    <?php echo $loc['offers.php']['t192']; ?><br />
                                    <input type="text" name="email_box" id="email_box" maxlength="50" value="<?php echo $offer_email_box; ?>" style="width: 200px; text-align: center;" placeholder="<?php echo $loc['offers.php']['t195']; ?>&nbsp;email@mail.ru">
                                </td>								
                            </tr>
                        </table>
                    </form>	
                    <table class="offer_table2">
                        <?php
                        $offer = Offer::getById($offer_id);
                        ?>
                        <tr class="tableHead">
                            <td colspan="4"> Тренды </td>
                        </tr>
                        <Tr>
                            <td>
                                Ключевик
                            </td>
                            <td align=left colspan="3"><input name="keyword" value="<?php echo $offer->keyword; ?>"></td>
                        </tr>
                        <tr>

                            <Td>
                                Дата 
                            </Td>
                            <td><a href="#" onclick='window.open("https://wordstat.yandex.ua/#!/history?words=<?php echo urlencode($offer->keyword); ?>", "ya", "toolbar=yes,location=yes;width=900,height=700");
                                        return false' target=_blank>Yandex</a></td>
                            <td><a href="#" onclick='window.open("https://www.google.ru/trends/explore?date=today%2012-m&q=<?php echo urlencode($offer->keyword); ?>", "ya", "width=900,height=700");
                                        return false' target="_blank">Google</a></td>
                            <td>Publer</td>
                        </tr>
                        <?php
                        $trands = $offer->getTrands();
                        $i = 0;
                        foreach ($trands as $date => $stat) {
                            echo "<tr><td>{$date}</td>"
                            . " <td> <input class=js-trends-yandex tabindex=" . (100 + $i) . " name=trands[$date][yandex] value={$stat['yandex']}> </td>"
                            . " <td> <input class=js-trends-google tabindex=" . (200 + $i) . " name=trands[$date][google] value={$stat['google']}> </td>"
                            . " <td> <input tabindex=" . (300 + $i) . " name=trands[$date][publer] value={$stat['publer']}> </td>";
                            $i++;
                        }
                        ?>

                    </table>


                    <br /><hr><br />

                    <?php
                    // Если в настройках системы разрешены СМС-уведомления, то выводим этот блок
                    // If the system settings enabled SMS-notification, we derive the block
                    if ($settings_sms_ok == 1) {
                        ?>
                        <table class="offer_table2">
                            <tr class="tableHead">
                                <td colspan="2"><?php echo $loc['offers.php']['t196']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 50%; line-height: 23px;">
                                    <?php echo $loc['offers.php']['t191']; ?><br />
                                    <select name="sms_ok" style="width: 200px;">
                                        <option class="options" value="0" <?php if ($offer_sms_ok == '0') { ?>selected="selected"<?php } ?>><?php echo $loc['offers.php']['t193']; ?></option>
                                        <option class="options" value="1" <?php if ($offer_sms_ok == '1') { ?>selected="selected"<?php } ?>><?php echo $loc['offers.php']['t194']; ?></option>
                                    </select>
                                </td>
                                <td style="width: 50%; line-height: 23px;">
                                    <?php echo $loc['offers.php']['t197']; ?><br />
                                    <input type="text" name="sms_phone" id="sms_phone" maxlength="50" value="<?php echo $offer_sms_phone; ?>" style="width: 200px; text-align: center;" placeholder="<?php echo $loc['offers.php']['t195']; ?>&nbsp;79111234567">
                                </td>								
                            </tr>
                        </table>

                        <table class="offer_table2">
                            <tr class="tableHead">
                                <td><?php echo $loc['offers.php']['t198']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 38%; text-align: left; text-indent: 6px; line-height: 23px;">
                                    <b><?php echo $loc['offers.php']['t199']; ?>&nbsp;</b>"<?php echo $loc['offers.php']['t200']; ?>"
                                    <br>
                                    <input type="text" name="sms_text_zakaz" maxlength="100" value="<?php echo html_entity_decode($offer_sms_text_zakaz, ENT_QUOTES, 'utf-8'); ?>" style="width: 99%; text-align: center;" >
                                </td>
                            <tr>
                                <td style="width: 38%; text-align: left; text-indent: 6px; line-height: 23px;">
                                    <b><?php echo $loc['offers.php']['t201']; ?>&nbsp;</b>"<?php echo $loc['offers.php']['t202']; ?>"
                                    <br>
                                    <input type="text" name="sms_text_send" maxlength="100" value="<?php echo html_entity_decode($offer_sms_text_send, ENT_QUOTES, 'utf-8'); ?>" style="width: 99%; text-align: center;" >
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 38%; text-align: left; text-indent: 6px; line-height: 23px;">
                                    <b><?php echo $loc['offers.php']['t201']; ?>&nbsp;</b>"<?php echo $loc['offers.php']['t203']; ?>"
                                    <br>
                                    <input type="text" name="sms_text_way" maxlength="100" value="<?php echo html_entity_decode($offer_sms_text_way, ENT_QUOTES, 'utf-8'); ?>" style="width: 99%; text-align: center;" >
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 38%; text-align: left; text-indent: 6px; line-height: 23px;">
                                    <b><?php echo $loc['offers.php']['t201']; ?>&nbsp;</b>"<?php echo $loc['offers.php']['t204']; ?>"
                                    <br>
                                    <input type="text" name="sms_text_success" maxlength="100" value="<?php echo html_entity_decode($offer_sms_text_success, ENT_QUOTES, 'utf-8'); ?>" style="width: 99%; text-align: center;" >
                                </td>
                            </tr>							
                        </table>

                        <p>
                        <p>
                            <button type="button" onclick="$('#spisok_makros').toggle();" style="background: #d3d3d3;"><b><?php echo $loc['offers.php']['t205']; ?></b></button>
                        </p>
                        <table id="spisok_makros" style="display: none; border: 0; " align=center>
                            <tr>
                                <td><b>{net_name}</b></td>
                                <td><?php echo $loc['offers.php']['t206']; ?></td>
                            </tr>
                            <tr>
                                <td><b>{offer_name}</b></td>
                                <td><?php echo $loc['offers.php']['t207']; ?></td>
                            </tr>
                            <tr>
                                <td><b>{zakaz_date}</b></td>
                                <td><?php echo $loc['offers.php']['t208']; ?></td>
                            </tr>							
                            <tr>
                                <td><b>{zakaz_time}</b></td>
                                <td><?php echo $loc['offers.php']['t209']; ?></td>
                            </tr>								
                            <tr>
                                <td><b>{date}</b></td>
                                <td><?php echo $loc['offers.php']['t210']; ?></td>
                            </tr>
                            <tr>
                                <td><b>{time}</b></td>
                                <td><?php echo $loc['offers.php']['t211']; ?></td>
                            </tr>							
                        </table>
                        </p>
                        <?php
                    }
                    ?>
                    </p>
                    <p>
                        <input type="submit" name="moderate_submit" value="<?php echo $loc['button']['t01']; ?>" class="others_button_sohranit" style="margin-top: 6px;" onclick="if (!confirm('<?php echo $loc['offers.php']['t212']; ?>'))
                                        return false;">
                    </p>
                </td>
            </tr>  
        </table>
    </form>
    <script>
        window.addEventListener("message", receiveMessage, false);
        function receiveMessage(event) {
            var data = event.data;
            if (!data.type) {
                return;
            }

            var jsclass = false;
            if (data.type == 'google') {
                jsclass = 'js-trends-google';
            } else {
                jsclass = 'js-trends-yandex';
            }
            var koef = data.data;
            var index = 0;
            $('.' + jsclass).each(function () {
                var val = koef[index++];
                if (!val)
                    val = 0;
                $(this).val(val);
            })
        }
        
    $(document).on('change', '#sim_offers', function () {
        var offerid = $('#sim_offers').val();
        var offername = $("#sim_offers option:selected").text();
        var thisSimilarOffers = $('#sim_of_n').val();
        var thisSimilarOffersName = $('.sim_offer').html();
        if(thisSimilarOffers == ''){
            $('#sim_of_n').val(offerid);
        }else{
            $('#sim_of_n').val(thisSimilarOffers + ',' + offerid);
        }
        $('.sim_offer').html(thisSimilarOffersName + '<p class="p_'+offerid+'">'+offername+'<span class="del_sim" data-value="'+offerid+'">X</span></p>');
    });
    
    $(document).on('click', '.del_sim', function () {
        var idOffer = $(this).attr('data-value');
        $('.p_'+idOffer).remove();
        var offerid = $('#sim_of_n').val();
        var str = offerid.replace(/\(|\)/g,'').split(',').filter( function(a){ return a!=idOffer;}).join(',');
        $('#sim_of_n').val(str);
    });
    
    </script>
    <?php
}
?>
