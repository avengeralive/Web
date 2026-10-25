<style>
    a.warning_popup div.warning_popup{
        display: none;
    }
    div.warning_popup{
        position: absolute;
        display: none;
        right: 0px;
        background: rgba(0,0,0,0.8);
        color: white;
        font-size: 14px;
        font-weight: 300;
        padding: 10px;
        width: 250px;
        text-align:center;
        border-radius: 5px;
        z-index: 999;
    }
    a.warning_popup:hover div{
        display:block;
    }
</style>
<?php
if (sizeof($result_to_display)) {
    $cvet = 0;
    $full_summa = 0;
    foreach ($result_to_display as $res) {
        // Получаем данные о свойствах заказа и оффера к которому он относится
        // Get the data on the properties and offer order to which he belongs
        $offer_id = htmlentities($res['offer_id']);

        // Получаем буквенное имя оффера
        // Get the name of the letter offer
        $sql_offers_name = "SELECT name,deystvie FROM offers WHERE id = $offer_id";
        $result_offers_name = $mysqli->query($sql_offers_name);
        $res_offers_name = mysqli_fetch_array($result_offers_name);
        $offer_name = htmlentities($res_offers_name['name']);
        $offer_deystvie = htmlentities($res_offers_name['deystvie']);

        // Назначаем необходимые переменные
        // Assign the required variables
        $zakaz_id = htmlentities($res['id']);
        $zakaz_user_id = htmlentities($res['user_id']);
        $user_alias = DB::getInstance()->query("select alias from users where id=" . intval($zakaz_user_id))->fetchColumn();
        $zakaz_number = htmlentities($res['zakaz_number']);
        $zakaz_cena = htmlentities($res['cena']);
        $zakaz_comission_cpa = htmlentities($res['comission_cpa']);
        $zakaz_comission = htmlentities($res['comission']);
        $zakaz_kolvo = htmlentities($res['kolvo']);
        $zakaz_status = htmlentities($res['status']);
        $zakaz_addstatus = htmlentities($res['addstatus']);
        $zakaz_date = date('d.m.Y H:i:s', strtotime(htmlentities($res['date'])));
        $zakaz_date_obrabotka = htmlentities($res['date_obrabotka']);
        $zakaz_comments = htmlentities($res['comments']);

        $zakaz_date = date('d.m.Y', strtotime(htmlentities($res['date']))) . '<br />' . date('H:i:s', strtotime(htmlentities($res['date'])));
        if ($res['date_obrabotka'] != '') {
            $zakaz_date_obrabotka = date('d.m.Y', strtotime(htmlentities($res['date_obrabotka']))) . '<br />' . date('H:i:s', strtotime(htmlentities($res['date_obrabotka'])));
        } else {
            if ($offer_deystvie != 5) {
                $zakaz_date_obrabotka = '<center>' . $loc['zakaz.php']['t137'] . '<br />' . $loc['zakaz.php']['t138'] . '</center>';
            }
        }
        $zakaz_comments = htmlentities($res['comments']);
        $zakaz_clientname = htmlentities($res['name']);
        $zakaz_clientphone = htmlentities($res['phone']);
        $zakaz_tracking_number = htmlentities($res['tracking_number']);
        $zakaz_zipcode = htmlentities($res['zipcode']);
        $zakaz_country = htmlentities($res['country']);
        $zakaz_short_country = htmlentities($res['short_country']);
        $zakaz_region = htmlentities($res['region']);
        $zakaz_town = htmlentities($res['town']);
        $zakaz_street = htmlentities($res['street']);
        $zakaz_dom = htmlentities($res['dom']);
        $zakaz_kvartira = htmlentities($res['kvartira']);
        $zakaz_client_address = htmlentities($res['client_address']);
        $zakaz_email = htmlentities($res['email']);
        $zakaz_ip = htmlentities($res['ip']);
        $zakaz_artikul = htmlentities($res['artikul']);
                switch ($zakaz_status){
                    case 0:
                        $backcolor = 'bg-danger';
                        break;
                    case 1:
                        $backcolor = 'bg-warning';
                        break;
                    case 2:
                        $backcolor = 'bg-success';
                        break; 
                    case 3:
                        $backcolor = 'bg-success';
                        break;
                    case 5:
                        $backcolor = 'bg-secondary';
                        break; 
                    default:
                        $backcolor = '';
                        break; 
                }
                
        ?>

            <tr  class="<?=$backcolor; ?>">
                <td class="zakaz_table_view_number">
                    <input type="checkbox" name="offer_id[]" class="checkboxzakaz" value="<?php echo $zakaz_id; ?>" onchange="check_checkbox();">
                </td>
                <td class="zakaz_table_view_name">
                    <?php
                    // Проверка, назначено ли промо для оффера. Если не назначено, то выводим сообщение об этом
                    // Check if the promo is scheduled to offer. If not set, the message about this
                    if (file_exists('./tmp/offer' . $offer_id . '.png')) {
                        ?>
                        <a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><img class="zakaz_table_view_imgoffer" src="./tmp/offer<?php echo $offer_id; ?>.png"></a>
                        <?php
                    } else {
                        ?>
                        <a style="border: 0; text-decoration: none;" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><div class="zakaz_table_view_imgoffer"></div></a>
                        <?php
                    }
                    ?>
                    <div class="zakaz_table_view_nametext" style="padding-top: 15px;">
                        <a target="_blank" href="./offers.php?offer=<?php echo $offer_id; ?>"><b style="font-size:14px;"><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></b></a> <sup><a target="_blank" href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><?php echo $zakaz_id; ?></a></sup><br />
                        <font color=gray>
                        Цена: 
                        <?php 
                        $full_summa += $zakaz_comission;
                        $full_summa += $zakaz_comission_cpa;
                        $summa_view = sprintf("%.2f", $zakaz_cena * $zakaz_kolvo);

                        echo number_format($summa_view, 0, ',', ' ') . ' ';

                        $db = DB::getInstance();
                        $sql = "select currency from sxgeo_country where iso='$zakaz_short_country' LIMIT 1";
                        $row = $db->query($sql)->fetchObject();

                        echo isset($row->currency) ? $row->currency : 'NA';
                        ?>
                        <br>
                        Комиссия:&nbsp;<?php echo $zakaz_comission; ?>&nbsp;<?php echo $loc['zakaz.php']['t140']; ?>
                        <br>
                        Комиссия CPA:&nbsp;<?php echo $zakaz_comission_cpa; ?>&nbsp;<?php echo $loc['zakaz.php']['t140']; ?>
                        <br>
                        <?php echo $loc['zakaz.php']['t168']; ?>&nbsp;<?php
                        if ($zakaz_clientname != '') {
                            echo $zakaz_clientname;
                        } else {
                            echo 'Не указано';
                        }
                        ?> &nbsp&nbsp Тел.:<?= $zakaz_clientphone; ?>
                        </font>
                        <?php
                        if($res['warning_level'] != 0){
                        ?>
                            <br>
                            <a class="warning_popup" style="position: relative;color:red;text-align:right;font-weight:bold;margin:0;">Подозрительный заказ!
                            <div class=warning_popup>
                                <?php
                                $settings = Settings::getById(1);
                                $arr = [
                                    1=>'Копирование данных в форму',
                                    2=>'Мало времени на сайте',
                                    4=>'Лиды с IP как у вебмастера',
                                    8=>'Лиды с одного IP',
                                    16=>'Лиды без реферера',
                                    32=>'Тест номеров на доступность',
                                    64=>'Несоответствие гео номера и гео IP лида',
                                    256=>'IP или телефон в блеклисте',
                                    ];
                                if($res['warning_level'] > $settings->limit_warning){
                                    $warning = $res['warning'];
                                    
                                }
                                ?>                                                    
                            </div>
                            </a>                     
                        <?php
                        }
                        ?> 	                       
                    </div>
                </td>
                <td>
                    <?php
                    /*if ($zakaz_status == '0') {
                        echo '<div class="zakaz_table_view_status_0">' . $loc['zakaz.php']['t08'] . '</div>';
                    }
                    if ($zakaz_status == '1') {
                        echo '<div class="zakaz_table_view_status_1">' . $loc['zakaz.php']['t07'] . '</div>';
                    }
                    if ($zakaz_status == '2') {
                        echo '<div class="zakaz_table_view_status_2">' . $loc['zakaz.php']['t10'] . '</div>';
                    }
                    if ($zakaz_status == '3') {
                        echo '<div class="zakaz_table_view_status_3">' . $loc['zakaz.php']['t10'] . '</div>';
                    }
                    if ($zakaz_status == '5') {
                        echo '<div class="zakaz_table_view_status_2">' . $loc['zakaz.php']['r1'] . '</div>';
                    }

                    if ($zakaz_addstatus == '0') {
                        echo '<div class="zakaz_table_view_addstatus_0">' . $loc['zakaz.php']['t16'] . '</div>';
                    }
                    if ($zakaz_addstatus == '1') {
                        echo '<div class="zakaz_table_view_addstatus_1">' . $loc['zakaz.php']['t17'] . '</div>';
                    }
                    if ($zakaz_addstatus == '2') {
                        echo '<div class="zakaz_table_view_addstatus_2">' . $loc['zakaz.php']['t18'] . '</div>';
                    }
                    if ($zakaz_addstatus == '3') {
                        echo '<div class="zakaz_table_view_addstatus_3">' . $loc['zakaz.php']['t19'] . '</div>';
                    }
                    if ($zakaz_addstatus == '4') {
                        echo '<div class="zakaz_table_view_addstatus_4">' . $loc['zakaz.php']['t20'] . '</div>';
                    }
                    if ($zakaz_addstatus == '5') {
                        echo '<div class="zakaz_table_view_addstatus_5">' . $loc['zakaz.php']['t21'] . '</div>';
                    }
                    if ($zakaz_addstatus == '6') {
                        echo '<div class="zakaz_table_view_addstatus_6">' . $loc['zakaz.php']['t22'] . '</div>';
                    }
                    if ($zakaz_addstatus == '7') {
                        echo '<div class="zakaz_table_view_addstatus_7">' . $loc['zakaz.php']['t146'] . '</div>';
                    }
                    if ($zakaz_addstatus == '8') {
                        echo '<div class="zakaz_table_view_addstatus_8">' . $loc['zakaz.php']['t147'] . '</div>';
                    }
                    if ($zakaz_addstatus == '9') {
                        echo '<div class="zakaz_table_view_addstatus_9">' . $loc['zakaz.php']['t148'] . '</div>';
                    }*/
                    if ($zakaz_addstatus < 10) echo '<div class="zakaz_table_view_addstatus_'.$zakaz_addstatus.'">' . $loc['zakaz.php']['t30'.$zakaz_addstatus] . '</div>';
                    else echo '<div class="zakaz_table_view_addstatus_'.$zakaz_addstatus.'">' . $loc['zakaz.php']['t3'.$zakaz_addstatus] . '</div>';
                    ?>
                </td>
                <td class="zakaz_table_view_date">
                <?php echo $zakaz_date; ?>
                </td>
                <td class="zakaz_table_view_date" style="<?php
                        if ($res['date_obrabotka'] == '' && $offer_deystvie != 5) {
                            echo 'background: yellow; color: red;';
                        }
                        ?>">
        <?php echo $zakaz_date_obrabotka; ?>
                </td>				
                <td class="zakaz_table_view_comments">
                    <a href="./zakaz.php?ob=<?php echo $zakaz_id; ?>"><?php echo TrimText($zakaz_comments, 130); ?></a>
                </td>
                <td class="zakaz_table_view_geo">
                    <?php
                    echo '<b style="font-size:14px;">' . $loc['zakaz.php']['t142'] . '&nbsp;</b>' . $zakaz_ip;
                    $zakaz_short_country = strtolower($zakaz_short_country);
                    // Проверка, есть ли в наличии картинка под определяемую страну
                    // Check whether there is a presence of the picture under the defined country
                    if (file_exists('./modules/detectclient/SxGeo/img/' . $zakaz_short_country . '.png')) {
                        echo '<br /><img src=./modules/detectclient/SxGeo/img/' . $zakaz_short_country . '.png> ';
                        echo $zakaz_country;
                    } else {
                        echo '<br />' . $zakaz_country;
                    }
                    if ($zakaz_user_id != '0') {
                        echo '<br /><b style="font-size:14px;">' . $loc['zakaz.php']['t143'] . '&nbsp;</b>';
                        if ($user_alias != '')
                            echo '<br><a style="font-size:14px;" target="_blank" href="./users.php?edit=' . $zakaz_user_id . '">' . $user_alias . ' (' . $zakaz_user_id . ')</a>';
                        else
                            echo '<a style="font-size:14px;" target="_blank" href="./users.php?edit=' . $zakaz_user_id . '">' . $zakaz_user_id . '</a>';
                    }
                    else {
                        echo '<br /><b style="font-size:14px;">' . $loc['zakaz.php']['t144'] . '</b>';
                    }
                    ?>
                </td>
        </tr>
        <?php
    }
}
?>