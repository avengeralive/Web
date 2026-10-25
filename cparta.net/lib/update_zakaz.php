<?php
// Если поступил запрос на изменение данных заказа, то выполняем
// If you received a request to change the order data, the
if (isset($_POST['change_status']) && ($user_tip=='20' || $user_tip=='40' || $user_tip=='50' || $user_tip=='70'))
	{
		
	// Функция обновления свойств заказа
	// Function updates the properties of the order
	function update_zakaz($addstatus)
		{
		global $mysqli, $id_zakaz, $status, $tracking_number, $cena, $country, $zipcode, $region, $town, $street, $date_obrabotka, $dom, $kvartira, $kolvo, $name, $phone, $email, $artikul, $comments,$comission,$comission_cpa;
		$sql_update_zakaz = "UPDATE zakaz SET `status`='$status', `addstatus`='$addstatus', `tracking_number`='$tracking_number', `cena`='$cena', `comission`='$comission', `comission_cpa`='$comission_cpa', `country`='$country', `zipcode`='$zipcode', `region`='$region', `town`='$town', `street`='$street', `date_obrabotka`='$date_obrabotka', `dom`='$dom', `kvartira`='$kvartira', `kolvo`='$kolvo', `name`='$name', `phone`='$phone', `email`='$email', `artikul`='$artikul', `comments`='$comments' WHERE `id`='$id_zakaz'";
		$result_update_zakaz = $mysqli->query($sql_update_zakaz);	
		}

	function update_offer($type_sql)
		{
		global $mysqli, $offer_id;
		$sql_update_offer = "UPDATE offers SET `kolvo_lids`= `kolvo_lids` ".$type_sql." WHERE `id` = '$offer_id' AND off_lids = '1' LIMIT 1";
		$result_update_offer = $mysqli->query($sql_update_offer);	
		}
		
	// Назначаем переменные под поступившие данные
	// Assign a variable received data
	$id_zakaz=htmlentities($_POST['nomer_zakaza']);        
	$date_obrabotka=date('d.m.Y H:i:s');
	$status=htmlentities($_POST['status']);
	$change_status=htmlentities($_POST['change_status']);
	$addstatus=htmlentities($_POST['addstatus']);
	$artikul=htmlentities($_POST['artikul']);
	$cena=htmlentities($_POST['cena']);
	$kolvo=htmlentities($_POST['kolvo']);
	$name=htmlentities($_POST['name']);
	$phone=htmlentities($_POST['phone']);
	$email=htmlentities($_POST['email']);
	$zipcode=htmlentities($_POST['zipcode']);
	$country=htmlentities($_POST['country']);
	$region=htmlentities($_POST['region']);
	$town=htmlentities($_POST['town']);
	$street=htmlentities($_POST['street']);
	$dom=htmlentities($_POST['dom']);
	$kvartira=htmlentities($_POST['kvartira']);
	$tracking_number=htmlentities($_POST['tracking_number']);
	$comments=htmlentities($_POST['comments']);
	$webmaster_id=htmlentities($_POST['user_id']);
        
        $zakaz = Zakaz::getById($id_zakaz);
		$offer = Offer::getById($zakaz->offer_id);
	
		$offer_comission_res = new Offers_Manager(DB::getInstance());
		$offer_comission_res->setSql("select * from offers_visible where offer_id = ".$zakaz->offer_id." and user_id = ".$zakaz->user_id);
		$offer_comission_totalres = $offer_comission_res->get();
		if (is_array($offer_comission_totalres) && count($offer_comission_totalres) > 0) {
			$comission = $offer_comission_totalres[0]['comission'];
			$comission_cpa = $offer_comission_totalres[0]['comission_cpa'];
		}
		else {
			$comission=$zakaz->comission;
			$comission_cpa=$zakaz->comission_cpa;
		}

	//$comission=$zakaz->comission;
	//$comission_cpa=$zakaz->comission_cpa;
        
	// Узнаем, каков был статус заказа и ID оффера до нашего вмешательства
	// Find out what was the status of the order and ID offera before our intervention
	$sql_zakaz_data = "SELECT status, offer_id, operator, owner_id  FROM zakaz WHERE `id`='$id_zakaz'";
	$result_zakaz_data = $mysqli->query($sql_zakaz_data);
	$res_zakaz_data=mysqli_fetch_array($result_zakaz_data);
	
	// Если мы под аккаунтом колл-центра сети и заказ взят в обработку не нами, то возвращаемся обратно
	// If we under the account of call center of a network and the order is taken in handling not by us, then we come back
	$zakaz_operator=htmlentities($res_zakaz_data['operator']);
	if ($user_tip=='20' && $zakaz_operator!=$user_id)
		{
		Header('Location: ./zakaz.php');
		exit;
		}

	// Назначаем переменную под ID оффера
	// Assign a variable ID offer
	$offer_id=htmlentities($res_zakaz_data['offer_id']);
	
	// Назначаем переменную под старый статус заказа
	// Assign a variable for the old order status
	$old_status_zakaza=htmlentities($res_zakaz_data['status']);
	
	// Назначаем переменную под ID рекламодателя, владельца оффера
	// Assign a variable ID advertiser offer owner
	$owner_id=htmlentities($res_zakaz_data['owner_id']);
	
	// Узнаем, какой тип действия используется на оффере
	// Find out what type of action used to offer
	$sql_offers_data = "SELECT deystvie FROM offers WHERE `id`='$offer_id'";
	$result_offers_data = $mysqli->query($sql_offers_data);
	$res_offers_data=mysqli_fetch_array($result_offers_data);

	// Назначаем переменную под тип действия на оффере
	// Assign a variable to the type of action to offer
	$offer_deystvie=htmlentities($res_offers_data['deystvie']);

	
	// Сумма заказа = цена * количество заказанного
	// Amount of order = price * quantity ordered
	$summa_zakaza=$cena*$kolvo;

	// Комиссия вебмастеру = комиссия вебмастеру * количество заказанного
	// The сommission webmaster = сommission webmaster * amount ordered
	$summa_comission=$comission*$kolvo;
	
	// Комиссия в пользу CPA-сети = комиссия CPA-сети * количество заказанного
	// The Commission in favor of the CPA-network = comission CPA-network * amount ordered
	$summa_comission_cpa=$comission_cpa*$kolvo;
	
	// Общая сумма вычитаемой с рекламодателя комиссии = комиссия вебмастеру + комиссия в пользу CPA-сети
	// The total amount is deducted from the advertiser's  = commission webmaster + commission in favor of the CPA-network
	$comission_all=$summa_comission+$summa_comission_cpa;
	
	// Узнаем текущий баланс рекламодателя
	// Check the current balance of advertiser
	$sql_balance_reklamodatel = "SELECT balance FROM users WHERE id=$owner_id";
	$result_balance_reklamodatel = $mysqli->query($sql_balance_reklamodatel);
	$res_balance_reklamodatel=mysqli_fetch_array($result_balance_reklamodatel);
	
	// Назначаем переменную под текущий баланс рекламодателя
	// Assign a variable for the current balance of advertiser
	$balance_reklamodatel=htmlentities($res_balance_reklamodatel['balance']);
	
	// Узнаем текущий баланс вебмастера и ID его рефовода
	// Check the current balance of the webmaster and its referrer ID
	$sql_data_webmaster = "SELECT balance,myrefovod,ref_program FROM users WHERE id=$webmaster_id";
	$result_data_webmaster = $mysqli->query($sql_data_webmaster);
	$res_data_webmaster=mysqli_fetch_array($result_data_webmaster);

	// Назначаем переменную под текущий баланс вебмастера
	// Assign a variable current balance webmaster
	$balance_webmaster=htmlentities($res_data_webmaster['balance']);
	
	// Назначаем переменную под ID рефовода вебмастера
	// Assign a variable referrer ID webmaster
	$refovod_webmaster=htmlentities($res_data_webmaster['myrefovod']);
	$ref_program = $res_data_webmaster['ref_program'];
        
	// Узнаем текущий баланс рефовода
	// Check the current balance of the referrer
	if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='' && $ref_program == 1)
		{
		$sql_balance_refovod = "SELECT balance FROM users WHERE `id`='$refovod_webmaster'";
		$result_balance_refovod = $mysqli->query($sql_balance_refovod);
		$res_balance_refovod=mysqli_fetch_array($result_balance_refovod);

		// Назначаем переменную под текущий баланс рефовода
		// Assign a variable current balance referrer
		$balance_refovod=htmlentities($res_balance_refovod['balance']);	
		}
	
	// Если не было изменения статуса заказа, а было только изменение свойств заказа, то изменяем свойства заказа
	// If there was no change in the status of an order , and it was only a change in the order of properties , you are changing the properties of the order
	if ($status==$old_status_zakaza)
		{
		update_zakaz($addstatus);
		}

// ОЖИДАЕТ //		
// EXPECTS //
		
	// Если происходит изменение статуса с ОЖИДАЕТ на В ХОЛДЕ
	// If there is a change of status with WAITING on HOLD
	elseif ($status=='2' && $old_status_zakaza=='1')
		{
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
                
                Events::trigger(Events::EVENT_ORDER_CONFIRM, $zakaz->id, ['comission' => $zakaz->comission, 'owner_id' => $zakaz->owner_id, 'user_id' => $zakaz->user_id]);
		$type_sql = "- '1'";
		update_offer($type_sql);	
		// Вычитаем у рекламодателя с баланса средства (сумма комиссии вебмастера для помещения в ХОЛД и сумму комиссии CPA-сети)
		// Subtract the advertiser with the balance of funds (the sum of commissions for webmasters premises in HOLD and the amount of CPA-network)
		$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`-'$comission_all' WHERE `id`='$owner_id'";
		$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);	

		// Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя
		// Write to the database, the table "finances", information about the funds are debited from the balance of advertiser
		$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$comission_all',12,'$balance_reklamodatel'-'$comission_all','2')";
		$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);		

		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{
			// Начисляем снятые у рекламодателя с баланса средства вебмастеру в ХОЛД
			// Accrued removed from the advertiser with a balance means webmaster HOLD
			$sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`+'$summa_comission' WHERE `id`='$webmaster_id'";
			$result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);
                        
                        
                        if($zakaz->stream && $zakaz->stream != '' && $zakaz->stream != 0){
                                $stream = Stream::getById($zakaz->stream);
                                if($stream->postback_add != 0 && $stream->postback_url != ''){
                                        $postback = Stream::postback($stream,$offer,$zakaz,'approved');
                                }
                        }

                        if(!isset($postback) || $postback === null){
                                $postback = Postback::getByUserId($zakaz->user_id);			
                                if(!empty($postback)){
                                        if($postback->send_add == 1 && $postback->url != '' && $postback->url != 'http://'){				
                                                Postback::sendPostback($offer,$zakaz,'approved');    
                                        }
                                }
                        }	                      
                        
			}
		}	
		
	// Если происходит изменение статуса с ОЖИДАЕТ на ПРИНЯТ
	// If there is a change of status with EXPECT on the ACCEPTED
	elseif ($status=='3' && $old_status_zakaza=='1')
		{
            Events::trigger(Events::EVENT_ORDER_CONFIRM, $zakaz->id, ['comission' => $zakaz->comission, 'owner_id' => $zakaz->owner_id, 'user_id' => $zakaz->user_id]);
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
		$type_sql = "- '1'";
		update_offer($type_sql);		
		// Вычитаем у рекламодателя с баланса средства (сумма комиссии вебмастера и сумму комиссии CPA-сети)
		// Subtract the advertiser with the balance of funds (sum of webmasters commission and the amount of CPA-network)
		$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`-'$comission_all' WHERE `id`='$owner_id'";
		$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);
		
		// Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя
		// Write to the database, in "finances" table, information about the funds are debited from the balance of advertiser
		$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$comission_all',13,'$balance_reklamodatel'-'$comission_all','2')";
		$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
		
		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{
			// Начисляем комиссию на баланс вебмастера
			// Commission is charged on the balance webmaster
			$sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`+'$summa_comission' WHERE `id`='$webmaster_id'";
			$result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);
                        if($zakaz->stream && $zakaz->stream != '' && $zakaz->stream != 0){
                                $stream = Stream::getById($zakaz->stream);
                                if($stream->postback_add != 0 && $stream->postback_url != ''){
                                        $postback = Stream::postback($stream,$offer,$zakaz,'approved');
                                }
                        }

                        if(!isset($postback) || $postback === null){
                                $postback = Postback::getByUserId($zakaz->user_id);			
                                if(!empty($postback)){
                                        if($postback->send_add == 1 && $postback->url != '' && $postback->url != 'http://'){				
                                                Postback::sendPostback($offer,$zakaz,'approved');    
                                        }
                                }
                        }    		
			// Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастеру
			// Write to the database, the table "finances", information on the funds be credited to the balance webmaster
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','1','$summa_comission',5,'$balance_webmaster'+'$summa_comission','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	

			// Начисляем на счет баланса CPA-сети средства вычтенные с баланса рекламодателя в качестве комиссии CPA-сети
			// Is charged to the account of the CPA- network balance of funds deducted from the advertiser's balance sheet as a CPA-network commission
			$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$summa_comission_cpa'";
			$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
			}
		// Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
		// If the order came without a webmaster, then execute
		else
			{
			// Начисляем на счет баланса CPA-сети средства вычтенные с баланса рекламодателя (комиссию вебмастера+комиссию CPA-сети)
			// Accrued on the account balance CPA-network money deducted from the advertiser's balance (commission webmaster + commission CPA-network)
			$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$comission_all'";
			$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);	
			}
			
		// Если у вебмастера есть рефовод, то начисляем рефоводу реферальские
		// If the webmaster has a referrer, the referrer accrue referral bonus
		if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='' && $ref_program == 1)
			{
			// Начисляем реферальские на счет рефовода
			// Referral bonus is charged to the account of the referrer
			$summ_referal=$summa_comission/100*$settings_refprocent;
			$sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`+'$summ_referal' WHERE `id`='$refovod_webmaster'";
			$result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);	
			
			// Пишем в базу, в таблицу "finances", информацию о начислении реферальских на баланс рефовода
			// Write to the database, the table "finances", information on the calculation of the balance of referrers to a referrer
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','1','$summ_referal',11,'$balance_refovod'+'$summ_referal','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
			}
		}
	// Если происходит изменение статуса с ОЖИДАЕТ на ОТКЛОНЕН
	// If there is a change of status with WAITING on REJECTED
	elseif ($status=='0' && $old_status_zakaza=='1')
		{    
                        Events::trigger(Events::EVENT_ORDER_CANCEL, $zakaz->id, ['comission' => $zakaz->comission, 'owner_id' => $zakaz->owner_id, 'user_id' => $zakaz->user_id]);
                        if($zakaz->stream && $zakaz->stream != '' && $zakaz->stream != 0){
                                $stream = Stream::getById($zakaz->stream);
                                if($stream->postback_add != 0 && $stream->postback_url != ''){
                                        $postback = Stream::postback($stream,$offer,$zakaz,'decline');
                                }
                        }

                        if(!isset($postback) || $postback === null){
                                $postback = Postback::getByUserId($zakaz->user_id);			
                                if(!empty($postback)){
                                        if($postback->send_add == 1 && $postback->url != '' && $postback->url != 'http://'){				
                                                Postback::sendPostback($offer,$zakaz,'decline');    
                                        }
                                }
                        }                         
		update_zakaz($addstatus);
		}			
		
// В ХОЛДЕ //
// HOLD //

	// Если происходит изменение статуса с в ХОЛДЕ на ОЖИДАЕТ
	// If there is a change in status with HOLD on WAITING
	elseif ($status=='1' && $old_status_zakaza=='2')
		{
		update_zakaz($addstatus);
		$type_sql = "+ '1'";
		update_offer($type_sql);		
		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{
			// Вычитаем из холда у вебмастера комиссию вебмастера для последующего возврата на баланс рекламодателю
			// Subtract from Hold at webmaster webmaster commission to return for the advertiser to balance
			$sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`-'$summa_comission' WHERE `id`='$webmaster_id'";
			$result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);
			}
		
		// Возвращаем рекламодателю на баланса средства (сумма комиссии вебмастера и сумму комиссии CPA-сети)
		// Return the advertiser at the balance sheet assets (sum commission webmaster and sum commission CPA-network)
		$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$comission_all' WHERE `id`='$owner_id'";
		$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);	
		
		// Пишем в базу, в таблицу "finances", информацию о возврате средств на баланс рекламодателю
		// Write to the database, the table "finances", the information on the return of funds to balance the advertiser
		$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','1','$comission_all',14,'$balance_reklamodatel'+'$comission_all','2')";
		$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
		}

	// Если происходит изменение статуса с в ХОЛДЕ на ПРИНЯТ
	// If there is a change of status with HOLD on ACCEPTED
	elseif ($status=='3' && $old_status_zakaza=='2')
		{
		// Обновляем свойства заказа и изменяем дополнительный статус на ЗАКАЗ ОПЛАЧЕН
		// Update the properties of order and change the optional status to "order has been paid"
		update_zakaz('4');
		
		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{		
			// Вычитаем средства из ХОЛДа у вебмастера, для последующего зачисления на баланс этому же вебмастеру
			// Subtract money from Holden in webmaster for further admission to the balance of the same webmaster
			$sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`-'$summa_comission' WHERE `id`='$webmaster_id'";
			$result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);

			// Начисляем средства, до этого вычтенные их ХОЛДа вебмастера на баланс этому же вебмастеру
			// Accrued funds deducted before their Holden webmaster to balance the same webmaster
			$sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`+'$summa_comission' WHERE `id`='$webmaster_id'";
			$result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);

			// Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастеру
			// Write to the database, the table "finances", information on the funds be credited to the balance webmaster
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','1','$summa_comission',5,'$balance_webmaster'+'$summa_comission','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
			}
		
		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{		
			// Начисляем на счет баланса CPA-сети средства вычтенные с баланса рекламодателя в качестве комиссии CPA-сети
			// Is charged to the account of the CPA-network balance of funds deducted from the advertiser's balance sheet as a CPA-network commission
			$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$summa_comission_cpa'";
			$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);		
			}
		// Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
		// If the order came without a webmaster, then execute
		else
			{
			// Начисляем на счет баланса CPA-сети средства вычтенные с баланса рекламодателя (сумма комиссии вебмастера и сумму комиссии CPA-сети)
			// Accrued on the account balance CPA-network money deducted from the advertiser's balance (sum commission webmaster and sum commission CPA-network)
			$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$comission_all'";
			$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);	
			}
			
		// Если у вебмастера есть рефовод, то начисляем рефоводу реферальские
		// If the webmaster has a referrer, the referrer accrue referral bonus
		if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='' && $ref_program == 1)
			{
			// Начисляем реферальские на счет рефовода
			// Referral bonus is charged to the account of the referrer
			$summ_referal=$summa_comission/100*$settings_refprocent;
			$sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`+'$summ_referal' WHERE `id`='$refovod_webmaster'";
			$result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);	
			
			// Пишем в базу, в таблицу "finances", информацию о начислении реферальских на баланс рефовода
			// Write to the database, the table "finances", information on the calculation of the balance of referrers to a referrer
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','1','$summ_referal',11,'$balance_refovod'+'$summ_referal','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
			}			
			
		}
		
	// Если происходит изменение статуса с В ХОЛДЕ на ОТКЛОНЕН
	// If there is a change in status with HOLD on REJECTED
	elseif ($status=='0' && $old_status_zakaza=='2')
		{
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
		$type_sql = "+ '1'";
		update_offer($type_sql);			
		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{	
			// Вычитаем у вебмастера сумму холда
			// Subtract the amount from the webmaster Hold
			$sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`-'$summa_comission' WHERE `id`='$webmaster_id'";
			$result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);	
			}
		
		// Начисляем на баланс рекламодателя сумму, вычтенную у него ранее в качестве комиссии вебмастера и комиссии CPA-сети
		// Advertiser is charged on the balance amount subtracted from him earlier as a webmaster commission and CPA-network commission
		$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$comission_all' WHERE `id`='$owner_id'";
		$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);	
		
		// Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс рекламодателю
		// Write to the database, in "finances" table, information about the funds be credited to the balance of advertiser
		$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','1','$comission_all',15,'$balance_reklamodatel'+'$comission_all','2')";
		$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
		}
		
// ПРИНЯТ //					
// ACCEPTED //

	// Если происходит изменение статуса с ПРИНЯТ на ОЖИДАЕТ
	// If there is a change of status with WAITING on ACCEPTED
	elseif ($status=='1' && $old_status_zakaza=='3')
		{
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
		$type_sql = "+ '1'";
		update_offer($type_sql);		
		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{
			// Вычитаем с баланса CPA-сети средства начисленные с баланса рекламодателя в качестве комиссии CPA-сети
			// Subtract from the balance CPA- network funds accrued to the balance of the advertiser as a CPA-network commission
			$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$summa_comission_cpa'";
			$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
			}
		// Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
		// If the order came without a webmaster, then execute
		else
			{
			// Вычитаем с баланса CPA-сети средства начисленные с баланса рекламодателя (комиссия вебмастера и комиссия CPA-сети)
			// Subtract with CPA-network balance funds accrued to the balance of advertiser (comission webmaster and comission CPA-network)
			$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$comission_all'";
			$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);				
			}

		// Возвращаем рекламодателю на баланс вычтенную ранее сумму комиссии вебмастера и сумму комиссии CPA-сети
		// Return the advertiser to balance subtracted before sum comission webmasters and comission CPA-network
		$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$comission_all' WHERE `id`='$owner_id'";
		$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);
		
		// Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс рекламодателю
		// Write to the database, the table "finances", information on the funds be credited to the balance of advertiser
		$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','1','$comission_all',14,'$balance_reklamodatel'+'$comission_all','2')";
		$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
		
		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{
			// Вычитаем с баланса вебмастера сумму комиссии начисленную ранее
			// Subtract the amount from the balance webmaster commission assessed previously
			$sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`-'$summa_comission' WHERE `id`='$webmaster_id'";
			$result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);
		
			// Пишем в базу, в таблицу "finances", информацию о списании средств с баланса вебмастера
			// Write to the database, the table "finances", information about the funds are debited from the balance webmaster
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','2','$summa_comission',14,'$balance_webmaster'-'$summa_comission','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
			}	

		// Если у вебмастера есть рефовод, то вычитаем у рефовода реферальские
		// If the webmaster has a referrer, then subtract from referrer referral bonus
		if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='' && $ref_program == 1)
			{
			// Вычитаем реферальские со счета рефовода
			// Subtract from an account referral bonus referrer
			$summ_referal=$summa_comission/100*$settings_refprocent;
			$sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`-'$summ_referal' WHERE `id`='$refovod_webmaster'";
			$result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);	
			
			// Пишем в базу, в таблицу "finances", информацию о вычитании реферальских с баланса рефовода
			// Write to the database, the table "finances", information about referrers subtracted from the balance of the referrer
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','2','$summ_referal',11,'$balance_refovod'-'$summ_referal','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
			}	
			
		}

	// Если происходит изменение статуса с ПРИНЯТ на ОТКЛОНЕН
	// If there is a change of status with ACCEPTED on REJECTED
	elseif ($status=='0' && $old_status_zakaza=='3')
		{
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
		$type_sql = "+ '1'";
		update_offer($type_sql);		
		// Если данный оффер работает по онлайн-оплате, то выполняем
		// If this offer works for online payment, then execute
		if ($offer_deystvie=='5')
			{
			// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
			// If the order came from existing in the database webmaster, then execute
			if ($webmaster_id!='0')
				{
				// Вычитаем с баланса CPA-сети средства начисленные в качестве комиссии CPA-сети (комиссия вебмастера)
				// Subtract from the balance CPA-network funds accrued as a CPA-network commission (webmaster commission)
				$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$summa_comission_cpa'";
				$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);		
				}
			// Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
			// If the order came without a webmaster, then execute
			else
				{
				// Вычитаем с баланса CPA-сети средства начисленные в качестве комиссии CPA-сети (комиссия вебмастера и комиссию CPA-сети)
				// Subtract with CPA-network balance funds accrued as a CPA-network Commission (comission webmaster and commission CPA-network)
				$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$comission_all'";
				$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);						
				}		
			// Вычитаем у рекламодателю с баланса начисленную ранее сумму
			// Subtract advertisers with the balance of the amount previously accrued
			$vychet_u_rekla=$summa_zakaza-$comission_all;
			$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`-'$vychet_u_rekla' WHERE `id`='$owner_id'";
			$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);		

			// Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя
			// Write to the database, the table "finances", information about the funds are debited from the balance of advertiser
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$vychet_u_rekla',15,'$balance_reklamodatel'-'$vychet_u_rekla','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
			
			// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
			// If the order came from existing in the database webmaster, then execute
			if ($webmaster_id!='0')
				{		
				// Вычитаем с баланса вебмастера сумму комиссии начисленную ранее
				// Subtract the amount from the balance webmaster commission assessed previously
				$sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`-'$summa_comission' WHERE `id`='$webmaster_id'";
				$result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);	
			
				// Пишем в базу, в таблицу "finances", информацию о списании средств с баланса вебмастера
				// Write to the database, the table "finances", information about the funds are debited from the balance webmaster
				$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','2','$summa_comission',15,'$balance_webmaster'-'$summa_comission','2')";
				$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);			
				}
				
			// Если у вебмастера есть рефовод, то вычитаем у рефовода реферальские
			// If the webmaster has a referrer, then subtract from referrer referral bonus
			if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='' && $ref_program == 1)
				{
				// Вычитаем реферальские со счета рефовода
				// Subtract bonus referrer from an account referral
				$summ_referal=$summa_comission/100*$settings_refprocent;
				$sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`-'$summ_referal' WHERE `id`='$refovod_webmaster'";
				$result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);	
				
				// Пишем в базу, в таблицу "finances", информацию о вычитании реферальских с баланса рефовода
				// Write to the database, the table "finances", information about referrers subtracted from the balance of the referrer
				$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','2','$summ_referal',11,'$balance_refovod'-'$summ_referal','2')";
				$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
				}			
			}
		else
			{
			// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
			// If the order came from existing in the database webmaster, then execute
			if ($webmaster_id!='0')
				{
				// Вычитаем с баланса CPA-сети средства начисленные с баланса рекламодателя в качестве комиссии CPA-сети
				// Subtract from the balance CPA-network funds accrued to the balance of the advertiser as a CPA-network commission
				$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$summa_comission_cpa'";
				$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);		
				}
			// Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
			// If the order came without a webmaster, then execute
			else
				{
				// Вычитаем с баланса CPA-сети средства начисленные с баланса рекламодателя (комиссия вебмастера и комиссию CPA-сети)
				// Subtract with CPA-network balance funds accrued with balance of advertiser (webmaster commission and CPA-network comission)
				$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$comission_all'";
				$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);						
				}

			// Возвращаем рекламодателю на баланс вычтенную ранее сумму комиссии вебмастера и сумму комиссии CPA-сети
			// Return the advertiser to balance subtracted before sum comission webmasters and CPA-network commission
			$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$comission_all' WHERE `id`='$owner_id'";
			$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);
			
			// Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс рекламодателя
			// Write to the database, the table "finances", information on the funds be credited to the balance of advertiser
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','1','$comission_all',15,'$balance_reklamodatel'+'$comission_all','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);		
			
			// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
			// If the order came from existing in the database webmaster, then execute
			if ($webmaster_id!='0')
				{		
				// Вычитаем с баланса вебмастера сумму комиссии начисленную ранее
				// Subtract the amount from the balance webmaster Commission assessed previously
				$sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`-'$summa_comission' WHERE `id`='$webmaster_id'";
				$result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);	
			
				// Пишем в базу, в таблицу "finances", информацию о списании средств с баланса вебмастера
				// Write to the database, the table "finances", information about the funds are debited from the balance webmaster
				$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','2','$summa_comission',15,'$balance_webmaster'-'$summa_comission','2')";
				$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);			
				}
				
			// Если у вебмастера есть рефовод, то вычитаем у рефовода реферальские
			// If the webmaster has a referrer, then subtract from referrer referral bonus
			if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='' && $ref_program == 1)
				{
				// Вычитаем реферальские со счета рефовода
				// Subtract referral bonus account referrer
				$summ_referal=$summa_comission/100*$settings_refprocent;
				$sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`-'$summ_referal' WHERE `id`='$refovod_webmaster'";
				$result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);	
				
				// Пишем в базу, в таблицу finances, информацию о вычитании реферальских с баланса рефовода
				// Write to the database, in finances table, information about referrers subtracted from the balance of the referrer
				$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','2','$summ_referal',11,'$balance_refovod'-'$summ_referal','2')";
				$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
				}	
			}			
		}
	// Если происходит изменение статуса с ПРИНЯТ на В ХОЛДЕ
	// If there is a change of status with ACCEPTED on HOLD
	elseif ($status=='2' && $old_status_zakaza=='3')
		{
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
		$type_sql = "+ '1'";
		update_offer($type_sql);		
		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{
			// Вычитаем со счета CPA-сети средства (комиссию CPA-сети) для последующего возврата на счет рекламодателю
			// Subtract from the CPA-network account funds (CPA-network comission) for return on advertiser account
			$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$summa_comission_cpa'";
			$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);
			}
		// Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
		// If the order came without a webmaster, then execute
		else
			{
			// Вычитаем со счета CPA-сети средства (комиссию вебмастера и комиссию CPA-сети) для последующего возврата на счет рекламодателю
			// Subtract from the CPA-network bill means ( ebmaster commission and CPA-network comission) for subsequent return to the account of the advertiser
			$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`-'$comission_all'";
			$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);				
			}
		
		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{
			// Вычитаем средства с баланса вебмастера для последующего помещения их в ХОЛД этому же вебмастеру
			// Subtract the balance of funds from the webmaster for later placing them to HOLD the same webmaster
			$sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`-'$summa_comission' WHERE `id`='$webmaster_id'";
			$result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);
		
			// Пишем в базу, в таблицу "finances", информацию о списании средств с баланса вебмастера
			// Write to the database, the table "finances", information about the funds are debited from the balance webmaster
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','2','$summa_comission',16,'$balance_webmaster'-'$summa_comission','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
		
			// Начисляем средства, ранее взятые с баланса вебмастера в ХОЛД этому же вебмастеру
			// Accrued funds previously taken from the balance of the webmaster to HOLD the same webmaster
			$sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`+'$summa_comission' WHERE `id`='$webmaster_id'";
			$result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);
			}

		// Если у вебмастера есть рефовод, то вычитаем у рефовода реферальские
		// If the webmaster has a referrer, then subtract from referrer referral bonus
		if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='' && $ref_program == 1)
			{
			// Вычитаем реферальские со счета рефовода
			// Subtract from an account referral bonus referrer
			$summ_referal=$summa_comission/100*$settings_refprocent;
			$sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`-'$summ_referal' WHERE `id`='$refovod_webmaster'";
			$result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);	
			
			// Пишем в базу, в таблицу "finances", информацию о вычитании реферальских с баланса рефовода
			// Write to the database, the table "finances", information about referrers subtracted from the balance of the referrer
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','2','$summ_referal',11,'$balance_refovod'-'$summ_referal','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
			}				
			
		}		

// ОТКЛОНЕН //					
// REJECTED //

	// Если происходит изменение статуса с ОТКЛОНЕН на ОЖИДАЕТ
	// If there is a change of status with WAITING on REJECTED
	elseif ($status=='1' && $old_status_zakaza=='0')
		{
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
		}
	elseif ($status=='5' && $old_status_zakaza=='0')
		{
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
		}
	elseif ($status=='5' && $old_status_zakaza=='1')
		{
                        if($zakaz->stream && $zakaz->stream != '' && $zakaz->stream != 0){
                                $stream = Stream::getById($zakaz->stream);
                                if($stream->postback_add != 0 && $stream->postback_url != ''){
                                        $postback = Stream::postback($stream,$offer,$zakaz,'decline');
                                }
                        }

                        if(!isset($postback) || $postback === null){
                                $postback = Postback::getByUserId($zakaz->user_id);			
                                if(!empty($postback)){
                                        if($postback->send_add == 1 && $postback->url != '' && $postback->url != 'http://'){				
                                                Postback::sendPostback($offer,$zakaz,'decline');    
                                        }
                                }
                        }     
		update_zakaz($addstatus);
		}	
	elseif ($status=='1' && $old_status_zakaza=='5')
		{
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
		}		
	// Если происходит изменение статуса с ОТКЛОНЕН на В ХОЛДЕ
	// If there is a change of status with REJECTED on HOLD
	elseif ($status=='2' && $old_status_zakaza=='0')
		{
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
		$type_sql = "- '1'";
		update_offer($type_sql);		
		// Вычитаем с баланса рекламодателя суммы - сумму комиссию вебмастера и сумму комиссии CPA-сети
		// Subtract the amount from the balance of advertiser - sum commission webmaster and sum comission CPA-network
		$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`-'$comission_all' WHERE `id`='$owner_id'";
		$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);	
		
		// Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя
		// Write to the database, the table "finances", information about the funds are debited from the balance of advertiser
		$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$comission_all',12,'$balance_reklamodatel'-'$comission_all','2')";
		$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);
		
		// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
		// If the order came from existing in the database webmaster, then execute
		if ($webmaster_id!='0')
			{
			// Начисляем вебмастеру в ХОЛД сумму комиссии вебмастера
			// Is charged webmaster on HOLD sum comission webmaster
			$sql_update_hold_webmaster = "UPDATE users SET `hold`=`hold`+'$summa_comission' WHERE `id`='$webmaster_id'";
			$result_update_hold_webmaster = $mysqli->query($sql_update_hold_webmaster);	
			}
		}		
		
	// Если происходит изменение статуса с ОТКЛОНЕН на ПРИНЯТ
	// If there is a change of status with REJECTED on ACCEPTED
	elseif ($status=='3' && $old_status_zakaza=='0')
		{
		// Обновляем свойства заказа
		// Update the properties of the order
		update_zakaz($addstatus);
		$type_sql = "- '1'";
		update_offer($type_sql);		
		// Если данный оффер работает по онлайн-оплате, то выполняем
		// If this offer works for online payment, then execute
		if ($offer_deystvie=='5')
			{
			// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
			// If the order came from existing in the database webmaster, then execute
			if ($webmaster_id!='0')
				{
				// Начисляем на баланс CPA-сети средства в качестве комиссии CPA-сети (комиссия вебмастера)
				// Is charged on the balance of CPA-network capability as a CPA-network commission (webmaster commission)
				$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$summa_comission_cpa'";
				$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);		
				}
			// Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
			// If the order came without a webmaster, then execute
			else
				{
				// Начисляем на баланс CPA-сети средства в качестве комиссии CPA-сети (комиссия вебмастера и комиссию CPA-сети)
				// Charged on CPA-network capability as a CPA-network commission (webmaster commission and CPA-network comission)
				$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$comission_all'";
				$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);						
				}		
			// Начисляем рекламодателю на баланс заработанную сумму
			// Advertiser is charged on the balance of the amount earned
			$nachislenie_reklu=$summa_zakaza-$comission_all;
			$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`+'$nachislenie_reklu' WHERE `id`='$owner_id'";
			$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);		

			// Пишем в базу, в таблицу "finances", информацию о начислении средств на баланса рекламодателя
			// Write to the database, the table "finances", information on the funds be credited to the balance of advertiser
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','1','$nachislenie_reklu',17,'$balance_reklamodatel'+'$nachislenie_reklu','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
			
			// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
			// If the order came from existing in the database webmaster, then execute
			if ($webmaster_id!='0')
				{		
				// Начисляем на баланс вебмастера сумму комиссии 
				// Is charged on the webmaster balance sum commission
				$sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`+'$summa_comission' WHERE `id`='$webmaster_id'";
				$result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);	
			
				// Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастера
				// Write to the database, the table "finances", information on the funds be credited to the balance webmaster
				$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','1','$summa_comission',13,'$balance_webmaster'+'$summa_comission','2')";
				$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);			
				}
				
			// Если у вебмастера есть рефовод, то начисляем рефоводу реферальские
			// If the webmaster has a referrer, the referrer accrue referral bonus
			if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='' && $ref_program == 1)
				{
				// Начисляем реферальские на счет рефоводу
				// Referral bonus is charged to the account of referrer
				$summ_referal=$summa_comission/100*$settings_refprocent;
				$sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`+'$summ_referal' WHERE `id`='$refovod_webmaster'";
				$result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);	
				
				// Пишем в базу, в таблицу "finances", информацию о начислении реферальских на баланс рефоводу
				// Write to the database, the table "finances", information on the calculation of the balance of referrers to the referrer
				$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','1','$summ_referal',11,'$balance_refovod'+'$summ_referal','2')";
				$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
				}			
			}
		else
			{		
			// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
			// If the order came from existing in the database webmaster, then execute
			if ($webmaster_id!='0')
				{
				// Начисляем вебмастеру на баланс сумму комиссии
				// Webmaster charged on the balance of the amount of commission
				$sql_update_balance_webmaster = "UPDATE users SET `balance`=`balance`+'$summa_comission' WHERE `id`='$webmaster_id'";
				$result_update_balance_webmaster = $mysqli->query($sql_update_balance_webmaster);
			
				// Пишем в базу, в таблицу "finances", информацию о начислении средств на баланс вебмастера
				// Write to the database, the table "finances", information on the funds be credited to the balance webmaster
				$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$webmaster_id','1','$summa_comission',5,'$balance_webmaster'+'$summa_comission','2')";
				$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);		
				}
			
			// Вычитаем у рекламодателя с баланса сумму комиссии вебмастера и сумму комиссии CPA-сети
			// Subtract the advertiser to balance the amount of webmasters commission and the amount of commission CPA-network
			$sql_update_balance_reklamodatel = "UPDATE users SET `balance`=`balance`-'$comission_all' WHERE `id`='$owner_id'";
			$result_update_balance_reklamodatel = $mysqli->query($sql_update_balance_reklamodatel);
			
			// Пишем в базу, в таблицу "finances", информацию о списании средств с баланса рекламодателя
			// Write to the database, the table "finances", information about the funds are debited from the balance of advertiser
			$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$owner_id','2','$comission_all',13,'$balance_reklamodatel'-'$comission_all','2')";
			$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);			
	
			// Если заказ пришел от имеющегося в базе вебмастера, то выполняем
			// If the order came from existing in the database webmaster, then execute
			if ($webmaster_id!='0')
				{		
				// Начисляем на баланс CPA-сети комиссию CPA-сети
				// Commission is charged on the balance of CPA-network
				$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$summa_comission_cpa'";
				$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);				
				}
			// Если заказ пришел БЕЗ УЧАСТИЯ ВЕБМАСТЕРА, то выполняем
			// If the order came without a webmaster, then execute
			else
				{
				// Начисляем на баланс CPA-сети комиссию (комиссию вебмастера и комиссию CPA-сети)
				// Charged comission on balance CPA-network (commission webmasters and commission CPA-network)
				$sql_update_balance_cpa = "UPDATE settings SET `balance_cpa`=`balance_cpa`+'$comission_all'";
				$result_update_balance_cpa = $mysqli->query($sql_update_balance_cpa);				
				}
				
			// Если у вебмастера есть рефовод, то начисляем рефоводу реферальские
			// If the webmaster has a referrer, the referrer accrue referral bonus
			if ($settings_refprocent!='0' && $refovod_webmaster!='0' && $refovod_webmaster!='' && $ref_program == 1)
				{
				// Начисляем реферальские на счет рефоводу
				// Referral bonus is charged to the account of referrer
				$summ_referal=$summa_comission/100*$settings_refprocent;
				$sql_update_balance_refovod = "UPDATE users SET `balance`=`balance`+'$summ_referal' WHERE `id`='$refovod_webmaster'";
				$result_update_balance_refovod = $mysqli->query($sql_update_balance_refovod);	
				
				// Пишем в базу, в таблицу "finances", информацию о начислении реферальских на баланс рефоводу
				// Write to the database, the table "finances", information on the calculation of the balance of referrers to the referrer
				$sql_insert_log_finances = "INSERT INTO `finances_log` (`user_id`,`operation`,`summ`,`description`,`balance`,`status`) values ('$refovod_webmaster','1','$summ_referal',11,'$balance_refovod'+'$summ_referal','2')";
				$result_insert_log_finances = $mysqli->query($sql_insert_log_finances);	
				}		
			}
		}				
			
	// Редирект обратно в свойства заказа в котором производились изменения
	// Redirect back in the order in which the properties of the produced changes
	header('location:'.$_SERVER['PHP_SELF'].'?ob='.$id_zakaz.'&xtext=1');
	exit;
	}

// Если оператор взял в работу заказ	
// If the operator has taken in hand the order
if (isset($_GET['work']) && $_GET['work']!='' && $user_tip=='20')
	{
	$zakaz_work=htmlentities($_GET['work']);	
	$sql_zakaz_check = "SELECT id FROM zakaz WHERE `id`='$zakaz_work' AND `operator`='0'";
	$result_zakaz_check = $mysqli->query($sql_zakaz_check);
	if (mysqli_num_rows($result_zakaz_check)>0) 
		{
		$sql_zakaz_work = "UPDATE zakaz SET `operator`='$user_id' WHERE `id`='$zakaz_work'";
		$result_zakaz_work = $mysqli->query($sql_zakaz_work);
		header('location:'.$_SERVER['PHP_SELF'].'?ob='.$zakaz_work.'&xtext=3');
		exit;
		}
	}

// Если рекдамодатель сменил оператора на заказе
// If the rekdamodatel has replaced the operator on the order
if (isset($_POST['submit_change_operator']) && $user_tip=='40' && isset($_POST['id_zakaz']) && isset($_POST['op_id']))
	{
	$op_id=htmlentities($_POST['op_id']);	
	$id_zakaz=htmlentities($_POST['id_zakaz']);
	$sql_zakaz_check = "SELECT id FROM zakaz WHERE `id`='$id_zakaz' AND `owner_id`='$user_id'";
	$result_zakaz_check = $mysqli->query($sql_zakaz_check);
	if (mysqli_num_rows($result_zakaz_check)>0) 
		{
		$sql_zakaz_work = "UPDATE zakaz SET `operator`='$op_id' WHERE `id`='$id_zakaz'";
		$result_zakaz_work = $mysqli->query($sql_zakaz_work);
		header('location:'.$_SERVER['PHP_SELF'].'?ob='.$id_zakaz.'&xtext=3');
		exit;
		}
	}
	
?>