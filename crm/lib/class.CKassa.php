<?php
namespace lib;

#########################################################
# cotfw.kassa.php
#
# Библиотека для работы yandex-кассой
#
# История:  2016.10.13 - файл создан
#
#########################################################
#
	define( 'KASSA_RESPONSE_SUCCESS',		0 );
	define( 'KASSA_RESPONSE_ERROR_MD5',		1 );
	define( 'KASSA_RESPONSE_ERROR_ORDER',	100 );
	define( 'KASSA_RESPONSE_ERROR',			200 );
#
#########################################################
#
	class CKassa {

		function process_request() {
		    require_once $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		 	load_interface( 'settings' );
 			$settings = &$GLOBALS['cotfw.settings'];
 			
			if( empty($_POST['action']) && isset($_GET['action']) )
			$_POST = $_GET;

			// логгируем запрос
        	$List_Field_Name  = array(
        	    'user_id',
        	    'sum',
        	    'action',
        	    'invoiceId',
        	    'data'
        	);
        	$List_Field_Value = array(
        	    filter_str( $_POST['customerNumber'], MASK_TEXT ),
        	    filter_str( $_POST['orderSumAmount'], MASK_TEXT ),
        	    filter_str( $_POST['action'], MASK_TEXT ),
        	    filter_str( $_POST['invoiceId'], MASK_TEXT ),
        	    addslashes( json_encode($_POST) )
        	);
        	$idSqlBase = JBase::Set_Data_Unik('logs_kassa_requests', $List_Field_Name, $List_Field_Value);
			
			if( $idSqlBase ) 
				$log_request_mysql_id = $idSqlBase;

			if( self::check_md5($settings) ) {
				switch( $_POST['action'] ) {
					case 'checkOrder':	
						self::process_check_order($log_request_mysql_id);
					break;
					case 'paymentAviso':
						self::process_payment_aviso();
					break;
					case 'PaymentFail':
						self::process_payment_fail($settings->val('kassa_redirect_fail'));
					break;
					case 'PaymentSuccess':
						self::process_payment_success($settings->val('kassa_redirect_success'));
					break;
					default:
						self::bad( 'неизвестное действие' );
					break;
				}
			} else {
				self::bad( 'ошибка проверки хеш-суммы', KASSA_RESPONSE_ERROR_MD5 );
			}
		}

		function process_check_order($log_request_mysql_id) {
			// проверяем, что пользователь найден
			if( mysql_row('SELECT 1 FROM `my_users` WHERE `id` = \''.self::get_customerId().'\'')){
				self::good($log_request_mysql_id);
			} else {
				self::bad( 'пользователь с указанными данными не найден', KASSA_RESPONSE_ERROR_ORDER );
			}
		}

		function process_payment_aviso($log_request_mysql_id) {

			// проверяем, что пользователь найден
			if( mysql_row('SELECT 1 FROM `my_users` WHERE `id` = \''.self::get_customerId().'\'') ) {

				// текущий/новый баланс
				$current_balance = mysql_row('SELECT `balance` FROM `my_users` WHERE `id` = \''.self::get_customerId().'\'');
				$new_balance = $current_balance + self::get_orderSumAmount();
				
				// пополняем баланс пользователя
				$bal = JBase::Query('UPDATE `my_users` SET `balance` = \''.$new_balance.'\' WHERE `id` = \''.self::get_customerId().'\'');
				if( $bal ) {

					// логгируем операцию пополнения баланса
					JBase::Query('
					
						INSERT INTO `logs_kassa_refill_balance`
						(
							`balance_before`,
							`balance_after`,
							`sum`,
							`user_id`
						) VALUES (
							\''.$current_balance.'\',
							\''.$new_balance.'\',
							\''.self::get_orderSumAmount.'\',
							\''.self::get_customerId().'\'
						)
					');

					self::good($log_request_mysql_id);
				} else {
					self::bad( 'не удалось пополнить баланс' );
				}
			} else {
				self::bad( 'пользователь с указанными данными не найден' );
			}

		}

		function process_payment_success($a) {
			redirect( $a );
		}

		function process_payment_fail($b) {
			redirect( $b );
		}

		function check_md5($settings) {

			// для этих действий проверка хеша не нужна
			if( $_POST['action'] == 'PaymentFail' || $_POST['action'] == 'PaymentSuccess' )
			return true;

			$str =
				$_POST['action'].';'.
				$_POST['orderSumAmount'].';'.
				$_POST['orderSumCurrencyPaycash'].';'.
				$_POST['orderSumBankPaycash'].';'.
				$settings->val('kassa_shop_id').';'.
				self::get_invoiceId().';'.
				self::get_customerId().';'.
				$settings->val('kassa_shop_password')
			;
			$md5 = strtoupper( md5( $str ) );

			return $md5 == strtoupper( $_POST['md5'] );
		}

		function get_orderSumAmount() {
			return filter_str( $_POST['orderSumAmount'], MASK_TEXT );
		}

		function get_customerId() {
			return filter_str( $_POST['customerNumber'], MASK_TEXT );
		}

		function get_functionName() {
			return filter_str( $_POST['action'], MASK_TEXT );
		}

		function get_invoiceId() {
			return filter_str( $_POST['invoiceId'], MASK_TEXT );
		}

		function getformatDate( \DateTime $date ) {
			return $date->format("Y-m-d") . "T" . $date->format("H:i:s") . ".000" . $date->format("P");
		}

		function good($log_request_mysql_id) {
			self::result( $log_request_mysql_id, KASSA_RESPONSE_SUCCESS );
		}

		function bad( $message=null, $code=KASSA_RESPONSE_ERROR ) {
			self::result( $code, $message );
		}

		function result( $log_request_mysql_id, $result_code, $message = null ) {

		    require_once $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		 	load_interface( 'settings' );
 			$settings = &$GLOBALS['cotfw.settings'];
		
			$invoiceId = self::get_invoiceId();
			$functionName = self::get_functionName();
			$performedDatetime = self::getformatDate(new \DateTime());
			
			$response = '<?xml version="1.0" encoding="UTF-8"?><' . $functionName . 'Response performedDatetime="'.$performedDatetime.'" code="' . $result_code.'"'.($message !== null? ' message="'.$message.'"':"").' invoiceId="' . $invoiceId . '" shopId="' . $settings->val('kassa_shop_id').'" />';

			if( !empty($log_request_mysql_id) )
			JBase::Query('UPDATE `logs_kassa_requests` SET `response` = \''.remove_quotes( $response ).'\' WHERE `id` = \''.$log_request_mysql_id.'\'');

	        header("HTTP/1.0 200");
	        header("Content-Type: application/xml");
			echo $response;
			exit();
		}

	}
	
	
	