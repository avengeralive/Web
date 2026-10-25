<?php

if (sizeof($result_to_display)) 
	{
	$cvet=0;
	$full_summa=0;
	foreach($result_to_display as $res) 
		{
		// Получаем данные о свойствах заказа и оффера к которому он относится
		// Get the data on the properties and offer order to which he belongs
		$offer_id=htmlentities($res['offer_id']);

		// Получаем буквенное имя оффера
		// Get the name of the letter offer
		$sql_offers_name = "SELECT name,deystvie FROM offers WHERE id = $offer_id";
		$result_offers_name = $mysqli->query($sql_offers_name);
		$res_offers_name=mysqli_fetch_array($result_offers_name);
		$offer_name=htmlentities($res_offers_name['name']);		
		$offer_deystvie=htmlentities($res_offers_name['deystvie']);		

		// Назначаем необходимые переменные
		// Assign the required variables
		$zakaz_id=htmlentities($res['id']);
		$zakaz_user_id=htmlentities($user_id);
		$zakaz_number=htmlentities($res['zakaz_number']);
		$zakaz_cena=htmlentities($res['cena']);
                $zakaz_comission=htmlentities($res['comission']);
		$zakaz_kolvo=htmlentities($res['kolvo']);
		$zakaz_status=htmlentities($res['status']);
		$zakaz_addstatus=htmlentities($res['addstatus']);		
		$zakaz_date=date('d.m.Y H:i:s', strtotime(htmlentities($res['date'])));
		$zakaz_date_obrabotka=htmlentities($res['date_obrabotka']);
		$zakaz_comments=htmlentities($res['comments']);
                $zakaz_view_owner_id=htmlentities($res['owner_id']);
		$zakaz_date=date('d.m.Y', strtotime(htmlentities($res['date']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date'])));
		if ($res['date_obrabotka']!='') 
			{
			$zakaz_date_obrabotka=date('d.m.Y', strtotime(htmlentities($res['date_obrabotka']))).'<br />'.date('H:i:s', strtotime(htmlentities($res['date_obrabotka'])));
			}
		else
			{
			if ($offer_deystvie!=5)
				{
				$zakaz_date_obrabotka='<center>'.$loc['zakaz.php']['t137'].'<br />'.$loc['zakaz.php']['t138'].'</center>';
				}
			}
		$zakaz_comments=htmlentities($res['comments']);
		$zakaz_clientname=htmlentities($res['name']);
		$zakaz_clientphone=htmlentities($res['phone']);
		$zakaz_tracking_number=htmlentities($res['tracking_number']);
		$zakaz_zipcode=htmlentities($res['zipcode']);
		$zakaz_country=htmlentities($res['country']);
		$zakaz_short_country=htmlentities($res['short_country']);
		$zakaz_region=htmlentities($res['region']);
		$zakaz_town=htmlentities($res['town']);
		$zakaz_street=htmlentities($res['street']);
		$zakaz_dom=htmlentities($res['dom']);
		$zakaz_kvartira=htmlentities($res['kvartira']);
		$zakaz_client_address=htmlentities($res['client_address']);
		$zakaz_email=htmlentities($res['email']);
		$zakaz_ip=htmlentities($res['ip']);
		$zakaz_artikul=htmlentities($res['artikul']);
                
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
		

			<tr class="<?  //$backcolor; ?>">
                            
                            <td class="align-middle text-center" style="border-right: 0;">

                                        <?php
                                        // Проверка, назначено ли промо для оффера. Если не назначено, то выводим сообщение об этом
                                        // Check if the promo is scheduled to offer. If not set, the message about this
                                        if (file_exists('./tmp/offer'.$offer_id.'.png')) 
                                                {
                                                ?>
                                                <img class="zakaz_table_view_imgoffer" src="./tmp/offer<?php echo $offer_id; ?>.png">
                                                <?php
                                                }
                                        else
                                                {
                                                ?>
                                                <div class="zakaz_table_view_imgoffer"></div>
                                                <?php
                                                }							
                                        ?>
                            </td>
                            <td class="align-middle text-left" style="border-left: 0;">

                                        <b><a href="./offers.php?offer=<?=$offer_id; ?>"><?php echo html_entity_decode($offer_name, ENT_QUOTES, 'utf-8'); ?></a></b><sup><?php echo $res['id']; ?></sup><br />
                                        <font color=gray><span class="f300"><?php echo $loc['zakaz.php']['t26']; ?></span>&nbsp;<?php echo $zakaz_cena; ?></font><br>
                                        <font color=gray><span class="f300"><?php echo $loc['zakaz.php']['t168']; ?></span>&nbsp;<?php if ($zakaz_clientname!='') {echo $zakaz_clientname;} else {echo 'Не указано';} ?></font>
                                        <div style="float:right;font-size:11px">
                                            <?php
                                                $subs = [];
                                                for($i=1;$i<=5;$i++){
                                                    if( $res['subid'.$i]!=''){
                                                        $subs[]='subid'.$i.': '.$res['subid'.$i];
                                                    }
                                                }
                                                if(!empty($subs)){
                                                    echo implode(', ', $subs);
                                                }
                                            ?>
                                        </div>

                            </td>
                            <td class="align-middle text-left">
                                    <?php 
                                    if ($zakaz_status=='0') {
                                        echo '<div class="zakaz_table_view_status_0">'.$loc['zakaz.php']['t08'];
                                        if($zakaz_comments != ''){    
                                        echo ' <i data-toggle="tooltip" class="fa fa-question-circle" aria-hidden="true" title="'. $zakaz_comments .'"></i>';
                                        }            
                                        echo '</div>';
                                    }
                                    if ($zakaz_status=='1') {echo '<div class="zakaz_table_view_status_1">'.$loc['zakaz.php']['t07'].'</div>';}
                                    if ($zakaz_status=='2') {echo '<div class="zakaz_table_view_status_3">'.$loc['zakaz.php']['t10'].'</div>';}
                                    if ($zakaz_status=='3') {echo '<div class="zakaz_table_view_status_3">'.$loc['zakaz.php']['t10'].'</div>';}
                                    if ($zakaz_status=='5') {
                                        echo '<div class="zakaz_table_view_status_2">'.$loc['zakaz.php']['r1'];
                                        if($zakaz_comments != ''){    
                                        echo ' <i data-toggle="tooltip" class="fa fa-question-circle" aria-hidden="true" title="'. $zakaz_comments .'"></i>';
                                        }            
                                        echo '</div>';
                                    }					
                                    ?>


                            </td>
				<td class="align-middle text-left">
					<?php echo $zakaz_date; ?>
				</td>
				<td class="align-middle text-left" style="<?php if ($res['date_obrabotka']=='' && $offer_deystvie!=5) {echo 'background: yellow; color: red;';} ?>">
					<?php echo $zakaz_date_obrabotka; ?>
				</td>				

				<td class="align-middle text-left">
					<?php echo '<span class="f300">'.$loc['zakaz.php']['t142'].'&nbsp;</span><br>'.$zakaz_ip;
					$zakaz_short_country=strtolower($zakaz_short_country);
					// Проверка, есть ли в наличии картинка под определяемую страну
					// Check whether there is a presence of the picture under the defined country
					if (file_exists('./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png')) 
						{
						echo '<br /><img src=./modules/detectclient/SxGeo/img/'.$zakaz_short_country.'.png> ';
						echo '<span class="f300">'.$zakaz_country."</span>";
						}
					else
						{
						echo '<br /><span class="f300">'.$zakaz_country."</span>";
						}
					?>
				</td>
				<td class="align-middle text-left">
                                    <?php echo number_format($zakaz_comission, 0, ',', ' '); ?> р.
				</td>
			</tr>

		<?php
		}
	}	
	
?>
