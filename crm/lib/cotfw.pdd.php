<?php
namespace lib;
#########################################################
# cotfw.pdd.php
#
# Библиотека для работы PDD-yandex
#
# История:  2016.10.08 - файл создан
#
#########################################################
#
	class COTFW_pdd {

		var $mysqli = null;
		var $db_settings = null;
		var $api_url = 'https://pddimp.yandex.ru/api2/admin/';
		var $debug = false;

		function __construct( &$db_settings ) {
            global $mysqli;
			if( $mysqli === null ) {
			    JBase::Query("select 1");
			    $mysqli=JBase::$mysqli_pool;
			}
			$this->mysqli = &$mysqli;
			$this->json = &$GLOBALS['JSON'];

			$this->db_settings = $db_settings;
		}

		function mailbox_form() {

			if( !empty($this->db_settings->data['pdd_token']) ) {

				if( !empty($this->db_settings->data['pdd_domain']) ) {

					$mailbox_raw = array();

					// отправляем запрос на получение списка почтовых ящиков
					$page = 1;
					$pages = 0;
					do {
						$json = $this->api_query(array(
							'func'	=> 'email/list',
							'data'	=> array(
								'on_page'	=> '100',
								'page'		=> $page
							)
						));

						if( empty($json) )
						break;

						if( empty($pages) )
						$pages = $json['pages'];

						$page++;

						// обрабатываем список ящиков
						if( !empty($json['accounts']) )
						foreach( $json['accounts'] as $mailbox )
						$mailbox_raw[] = $mailbox;

					} while( $page <= $pages );

					// формируем данные для ответа
					$this->json['result'] = array();
					if( !empty($mailbox_raw) )
					foreach( $mailbox_raw as $mailbox )
					$this->json['result'][ $mailbox['login'] ] = array(
						'email'		=> $mailbox['login'],
						'iname'		=> $mailbox['iname'],
						'fname'		=> $mailbox['fname'],
						'uid'		=> $mailbox['uid'],
						'fio'		=> $mailbox['fio'],
						'enabled'	=> $mailbox['enabled'] == 'yes',
						'main'		=> $mailbox['login'] == $this->db_settings->val('pdd_main_mailbox')
					);

					$this->json['domain'] = $this->db_settings->val( 'pdd_domain' );
					json_good();

				} else {
					json_bad( 'пустой домен для PDD-yandex' );
				}
			} else {
				json_bad( 'пустой токен для PDD-yandex, сгенерировать его можно по адресу: https://pddimp.yandex.ru/api2/admin/get_token' );
			}

		}
		//Готовность Яндекс.Почты для домена подписывать письма согласно DKIM.
		function mailbox_info() {
			if( !empty($this->db_settings->data['pdd_token']) ) {
				if( !empty($this->db_settings->data['pdd_domain']) ) {
					$json = $this->api_query(array(
						'func'		=> 'dkim/status',
						'data'		=> array(
							'domain'	=> $this->db_settings->val( 'pdd_domain' ),
							'secretkey'	=> 'yes'
						)
					));
					// формируем данные для ответа
					$this->json['result'] = array();
					if( !empty($json) )
						foreach( $json as $Key => $value )
						$this->json['result'][ $Key ] = array(
							$Key => $value
						);
					json_good();

				} else {
					json_bad( 'пустой домен для PDD-yandex' );
				}
			} else {
				json_bad( 'пустой токен для PDD-yandex, сгенерировать его можно по адресу: https://pddimp.yandex.ru/api2/admin/get_token' );
			}
		}
		
		function mailbox_insert( $data ) {

			if( empty($data['uid']) ) {

				if( empty($data['email']) ) {
					json_bad( 'необходимо указать адрес электронной почты' );
					return;
				}
				
				if( empty($data['pass1']) ) {
					json_bad( 'необходимо указать пароль' );
					return;
				}

				// add mailbox
				if( !preg_match('#@#si',$data['email']) ) {
					$data['email'] .= '@'.$this->db_settings->val( 'pdd_domain' );
				}

				$json = $this->api_query(array(
					'func'		=> 'email/add',
					'method'	=> 'POST',
					'data'		=> array(
						'domain'	=> $this->db_settings->val( 'pdd_domain' ),
						'login'		=> $data['email'],
						'password'	=> $data['pass1']
					)
				));

				if( !empty($json['err_msg']) ) {
					json_bad( $json['err_msg'] );
					return;
				}
				$data['uid'] = $json['uid'];

			}

			$update_data = array(
				'domain'	=> $this->db_settings->val( 'pdd_domain' ),
				'uid'		=> $data['uid'],
				'iname'		=> $data['iname'],
				'fname'		=> $data['fname'],
			);
				
			if( !empty($data['pass1']) ) {
				$update_data['password'] = $data['pass1'];
			}

			// update
			$json = $this->api_query(array(
				'func'		=> 'email/edit',
				'method'	=> 'POST',
				'data'		=> $update_data
			));
			if( !empty($json['err_msg']) ) {
				json_bad( $json['err_msg'] );
				return;
			}

			if( $data['main'] == 'true' ) {

				if( !empty($data['pass1']) ) {
					$this->db_settings->update( 'pdd_main_mailbox_password', filter_str( $data['pass1'], MASK_TEXT ) );
				} else {
					json_bad( 'для выбора ящика "'.$data['email'].'" в качестве основного необходимо заново ввести пароль' );
					return;
				}

				$this->db_settings->update( 'pdd_main_mailbox', filter_str( $data['email'], MASK_TEXT ) );
			}

			$data['main'] = $data['main'] == 'true';

			$this->json['result'] = $data;
			json_good();

		}

		function mailbox_delete( $data ) {

			$json = $this->api_query(array(
				'func'		=> 'email/del',
				'method'	=> 'POST',
				'data'		=> array(
					'domain'	=> $this->db_settings->val( 'pdd_domain' ),
					'uid'		=> $data['uid']
				)
			));
			if( !empty($json['err_msg']) ) {
				json_bad( $json['err_msg'] );
				return;
			}

			if( $data['email'] == $this->db_settings->val('pdd_main_mailbox') )
			$this->db_settings->update( 'pdd_main_mailbox', '' );

			json_good();

		}

		function api_query( $params ) {
			
			$o = $params + array(
				'func'			=> '',
				'data'			=> array(),
				'method'		=> 'GET',
				'add_token'		=> true,
				'add_domain'	=> true,
				'rek_count'		=> 1
			);

			if( $o['add_domain'] && empty($o['data']['domain']) )
			$o['data']['domain'] = $this->db_settings->val( 'pdd_domain' );

			$uri = '';
			if( $o['data'] ) {
				if( gettype($o['data']) == 'array' ) {
					$uri .= http_build_query( $o['data'] );
				} else {
					$uri .= $o['data'];
				}
			}

			try {

				if( $o['method'] == 'GET' ) {

					$full_url = $this->api_url.$o['func'].(!empty($uri)?'?'.$uri:'');
					$result = file_get_contents( $full_url, false, stream_context_create(array(
						'http' => array(
							'method'	=>	'GET',
							'timeout'	=>	30,
							'header'	=>	"PddToken: ".$this->db_settings->val( 'pdd_token')."\r\n"
						)
					)));

				} else {

					$context = stream_context_create(array(
						'http' => array(
							'method'	=>	'POST',

							'header'	=>	"PddToken: ".$this->db_settings->val( 'pdd_token')."\r\n".
											"Content-type: application/x-www-form-urlencoded\r\n".
											"Content-length: ".strlen($uri)."\r\n",

							'content'	=>	$uri,
							'timeout'	=>	30
						)
					));

					$full_url = $this->api_url.$o['func'];
					$result = file_get_contents( $full_url, false, $context );

				}
				$json = json_decode( $result, true );

				if( $this->debug ) {
					if( !isset($this->json['debug']) )
					$this->json['debug'] = '';

					$this->json['debug'] .= $full_url.' ';
				}

			} catch(Exception $e) {

				$result = $e->getMessage();
				// $this->logs->add( '[WARN] '.$full_url.' '.$result );

				$json = false;
				if( $o['rek_count'] < 3 ) {
					// $this->logs( '[WARN] отправка повторного запроса через '.1.' сек.' );
					sleep( 1 );

					$o['rek_count']++;
					$status = $this->api_query( $o );

					if( $status !== false )
					$json = $status;
				}

			}
			// echo $full_url.'<br>';

			// повторный запрос при пустом результате
			if( empty($json) && $o['rek_count'] < 1 ) {
				// $this->logs->add( '[WARN] отправка повторного запроса через '.1.' сек. (сервер вернул пустой результат)' );
				// sleep( 1 );

				$o['rek_count']++;
				$status = $this->api_query( $o );

				if( $status !== false )
				$json = $status;
			}

			if( !empty($json) ) {

				if( $json['success'] == 'error' ) {
					$json['err_msg'] = 'yandex API вернул ошибку: '.$json['error'];
				}

			} else {
				$json['err_msg'] = 'yandex API вернул пустой результат';
			}

			return $json;
		}
	}
#
#########################################################
?>