<?php 
namespace lib;

if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
* class.CWrongs.php
*
*Класс - библиотека с функциями для ответов ajax для работы с Жалобами 
*подгружается через автоподгрузку классов
*
* История:  2016.12.07 - файл создан
*
**/


class CWrongs {


	//создание жалобы
    function creat_wrongs() {
        $param 		 = JBase::escape($_POST['param']);
        $list_id     = (int)$_POST['list_id'];
        $card_id     = (int)$_POST['card_id'];
    	
    	if ($list_id != '0' && $card_id != '0') {
        	JBase::Set_Data('users_wrongs', ['domain','id_user','list_id','id_card','param'], [DOMAIN, USERID, $list_id, $card_id, $param]);
		
        	// Инициализация PHPMailer и отправка ИД шаблона и массива данных
	        include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
			load_interface( 'settings' );
	        $settings	= &$GLOBALS['cotfw.settings'];
	        $mailadmin = $settings->val('pdd_main_mailbox');
			
			if (!empty($mailadmin)) {
				//отправка письма админу шаблон #11
				$Result = JBase::Get_Field_Value_From_Domain_Id('list_table',  $list_id, 'title');
        		$user_info['list_name'] = $Result;
				$user_info['list_id'] 	= $list_id;
				$user_info['card_id'] 	= $card_id;
				$user_info['param'] 	= $param;
				$user_info['email'] 	= $mailadmin;
				
				$mailsend = new MailSend( 'no-reply@otys.ru' );
				$mailsend->MailSend( 11, $user_info );
			}
		}
        return (true);
    }
    
	//список жалоб для модерации
    function WrongsListID() {
        $Result = JBase::Get_Data('users_wrongs', '*', ['list_id' =>(int)$_POST['list_id'], 'id_card' => (int)$_POST['item_id']]);
        while ($numrow = $Result->fetch_assoc()) {    
            if (empty($m[$numrow['param']]))
                $m[$numrow['param']] = 1;
            else
                $m[$numrow['param']]++;    
        }
        if (!empty($m))
            echo json_encode($m);
        else
            echo 'Жалоб нет';
    }
 
}
