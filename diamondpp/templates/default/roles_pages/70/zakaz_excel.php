<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL & ~E_NOTICE);
$date = '123';
header( "Content-Type: application/vnd.ms-excel" );
header( "Content-disposition: attachment; filename=export.".$date.".xls" );
include 'zakaz_functions.php';
	$zp=new zakaz_processor($mysqli);
    $zp->filter_fields['user_id']=isset($_GET['webmaster']) ? intval($_GET['webmaster']) : -1;
    $zp->filter_fields['id']=(isset($_GET['id']) && $_GET['id'] != '') ? intval($_GET['id']) : -1;
    $zp->filter_fields['phone']=(isset($_GET['phone']) && $_GET['phone'] != '') ? htmlentities($_GET['phone']) : -1;
	$zp->filter_fields['owner_id']=intval($user_id);
	$zp->filter_fields['offer']=isset($_GET['offer']) ? intval($_GET['offer']) : 0;
	$zp->filter_fields['count']=100;
	$zp->filter_fields['page']=isset($_GET['page']) ? intval($_GET['page']) : 1;
	$zp->filter_fields['sum']=isset($_GET['sum']) ? intval($_GET['sum']) : -1; 
	$zp->filter_fields['date_z']=isset($_GET['date_z']) ? intval($_GET['date_z']) : -1; 
	$zp->filter_fields['date_i']=isset($_GET['date_i']) ? intval($_GET['date_i']) : -1; 
	$zp->filter_fields['date1']=$dat1.' '.$DT;
	$zp->filter_fields['date2']=$dat2.' '.$NT;
	$zp->filter_fields['status']=1;
                        
                        
	/*$zp->filter_fields['status']='-1';
	$k_zakaz_all=$zp->get_count(true);
                        
	$zp->filter_fields['status']=1;                        
	$k_zakaz_wait=$zp->get_count(true);
	$zp->filter_fields['status']=2;
	$k_zakaz_hold=$zp->get_count(true);
	$zp->filter_fields['status']=3;
	$k_zakaz_ok=$zp->get_count(true);
	$zp->filter_fields['status']=0;
	$k_zakaz_cancel=$zp->get_count(true);
	$zp->filter_fields['status']=5;
	$k_zakaz_trash=$zp->get_count(true);*/

    $zp->filter_fields['landing_id']=isset($_GET['landing_id']) ? intval($_GET['landing_id']) : -1;
    $zp->filter_fields['prelanding_id']=isset($_GET['prelanding_id']) ? intval($_GET['prelanding_id']) : -1;
    $zp->filter_fields['country']=isset($_GET['country']) ? htmlentities($_GET['country']) : -1;    			

    $zp->filter_fields['status']=isset($_GET['status']) ? intval($_GET['status']) : '-1';
	$zp->filter_fields['addstatus']=isset($_GET['addstatus']) ? intval($_GET['addstatus']) : -1;
    
    $zp->page_size=10000000;
	$zp->offset=0;
?>                     
			<table>
				<tr>
					<?php if (isset($_GET['excel_id'])) { ?><td>ID</td><?php } ?>
					<?php if (isset($_GET['excel_offer'])) { ?><td>Оффер</td><?php } ?>
                    <?php if (isset($_GET['excel_status'])) { ?><td>Статус</td><?php } ?>
                    <?php if (isset($_GET['excel_addstatus'])) { ?><td>Доп. статус</td><?php } ?>
                    <?php if (isset($_GET['excel_date'])) { ?><td>Дата</td><?php } ?>
                    <?php if (isset($_GET['excel_name'])) { ?><td>Имя</td><?php } ?>
                    <?php if (isset($_GET['excel_phone'])) { ?><td>Телефон</td><?php } ?>
                    <?php if (isset($_GET['excel_ip'])) { ?><td>IP</td><?php } ?>
                    <?php if (isset($_GET['excel_country'])) { ?><td>Страна</td><?php } ?>
                    <?php if (isset($_GET['excel_user'])) { ?><td>Вебмастер</td><?php } ?>
                    <?php if (isset($_GET['excel_comment'])) { ?><td>Комментарий</td><?php } ?>
                    <?php if (isset($_GET['excel_pinger'])) { ?><td>CRM</td><?php } ?>
                    <?php if (isset($_GET['excel_value'])) { ?><td>ID заказа в CRM</td><?php } ?>
				</tr>			
			

			<?php
			// получаем результат и вызываем файл zakaz_sql.php, в котором выводится результат
			// Get the result and call zakaz_sql.php file in which the result is output
			$result_to_display=$zp->get_result();
			?>
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
        $sql_offers_name            = "SELECT name,deystvie FROM offers WHERE id = $offer_id";
        $result_offers_name         = $mysqli->query($sql_offers_name);
        $res_offers_name            = mysqli_fetch_array($result_offers_name);
        $offer_name                 = htmlentities($res_offers_name['name']);
        $offer_deystvie             = htmlentities($res_offers_name['deystvie']);

        // Назначаем необходимые переменные
        // Assign the required variables
        $zakaz_id                   = htmlentities($res['id']);
        $zakaz_user_id              = htmlentities($res['user_id']);
        $user_alias                 = DB::getInstance()->query("select alias from users where id=" . intval($zakaz_user_id))->fetchColumn();
        $zakaz_number               = htmlentities($res['zakaz_number']);
        $zakaz_cena                 = htmlentities($res['cena']);
        $zakaz_comission_cpa        = htmlentities($res['comission_cpa']);
        $zakaz_comission            = htmlentities($res['comission']);
        $zakaz_kolvo                = htmlentities($res['kolvo']);
        $zakaz_status               = htmlentities($res['status']);
        $zakaz_addstatus            = htmlentities($res['addstatus']);
        $zakaz_date                 = date('d.m.Y H:i:s', strtotime(htmlentities($res['date'])));
        $zakaz_date_obrabotka       = htmlentities($res['date_obrabotka']);
        $zakaz_comments             = htmlentities($res['comments']);
        $zakaz_pinger_type          = htmlentities($res['pinger_type']);
        $zakaz_pinger_value          = htmlentities($res['pinger_value']);

        $zakaz_date                 = date('d.m.Y', strtotime(htmlentities($res['date']))) . '<br />' . date('H:i:s', strtotime(htmlentities($res['date'])));
        if ($res['date_obrabotka'] != '') {
            $zakaz_date_obrabotka       = date('d.m.Y', strtotime(htmlentities($res['date_obrabotka']))) . '<br />' . date('H:i:s', strtotime(htmlentities($res['date_obrabotka'])));
        } else {
            if ($offer_deystvie != 5) {
                $zakaz_date_obrabotka   = '<center>' . $loc['zakaz.php']['t137'] . '<br />' . $loc['zakaz.php']['t138'] . '</center>';
            }
        }
        $zakaz_comments             = htmlentities($res['comments']);
        $zakaz_clientname           = htmlentities($res['name']);
        $zakaz_clientphone          = htmlentities($res['phone']);
        $zakaz_tracking_number      = htmlentities($res['tracking_number']);
        $zakaz_zipcode              = htmlentities($res['zipcode']);
        $zakaz_country              = htmlentities($res['country']);
        $zakaz_short_country        = htmlentities($res['short_country']);
        $zakaz_region               = htmlentities($res['region']);
        $zakaz_town                 = htmlentities($res['town']);
        $zakaz_street               = htmlentities($res['street']);
        $zakaz_dom                  = htmlentities($res['dom']);
        $zakaz_kvartira             = htmlentities($res['kvartira']);
        $zakaz_client_address       = htmlentities($res['client_address']);
        $zakaz_email                = htmlentities($res['email']);
        $zakaz_ip                   = htmlentities($res['ip']);
        $zakaz_artikul              = htmlentities($res['artikul']);
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
              
        $zakaz_pinger_type = str_ireplace("Offer_Pinger_", "", $zakaz_pinger_type);
        ?>

            <tr  class="<?=$backcolor; ?>">
                <?php if (isset($_GET['excel_id'])) { ?><td><?php echo $zakaz_id; ?></td><?php } ?>
                <?php if (isset($_GET['excel_offer'])) { ?><td><?php echo $offer_id; ?> - <?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></td><?php } ?>
                <?php if (isset($_GET['excel_status'])) { ?><td>
                    <?php
                    if ($zakaz_status == '0') {
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
                    } ?>
                </td><?php } ?>
                <?php if (isset($_GET['excel_addstatus'])) { ?><td>
                    <?php 
                    if ($zakaz_addstatus < 10) echo '<div class="zakaz_table_view_addstatus_'.$zakaz_addstatus.'">' . $loc['zakaz.php']['t30'.$zakaz_addstatus] . '</div>';
                    else echo '<div class="zakaz_table_view_addstatus_'.$zakaz_addstatus.'">' . $loc['zakaz.php']['t3'.$zakaz_addstatus] . '</div>';
                    ?>
                </td><?php } ?>
                <?php if (isset($_GET['excel_date'])) { ?><td><?php echo $zakaz_date; ?></td><?php } ?>
                <?php if (isset($_GET['excel_name'])) { ?><td><?php echo $zakaz_clientname;?></td><?php } ?>
                <?php if (isset($_GET['excel_phone'])) { ?><td><?php echo $zakaz_clientphone;?></td><?php } ?>
                <?php if (isset($_GET['excel_ip'])) { ?><td><?php echo $zakaz_ip;?></td><?php } ?>
                <?php if (isset($_GET['excel_country'])) { ?><td><?php echo $zakaz_country;?></td><?php } ?>
                <?php if (isset($_GET['excel_user'])) { ?><td><?php echo $zakaz_user_id;?></td><?php } ?>
                <?php if (isset($_GET['excel_comment'])) { ?><td><?php echo $zakaz_comments;?></td><?php } ?>
                <?php if (isset($_GET['excel_pinger'])) { ?><td><?php echo $zakaz_pinger_type;?></td><?php } ?>
                <?php if (isset($_GET['excel_value'])) { ?><td><?php echo $zakaz_pinger_value;?></td><?php } ?>
        </tr>
        <?php
    }
} ?>                   
                </table>       

