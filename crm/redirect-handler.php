<?php
#########################################################
# redirect-handler.php
#
# Обработка редиректа. При возникновении ошибки 404
# попытка перегенировать JSON-кеш
#
# История:	2016.10.01 - файл создан
#
#########################################################
#
use lib\COTFW_gets,
	lib\JBase,
    lib\CCSS,
    lib\CEditCat,
    lib\LocalConnection,
    lib\CMenuAdm,
    lib\CPanel,
	lib\JLoads;
	require_once dirname(__FILE__).'/lib.php';
	include_lib( 'cotfw.gets' );

	$redirect_handler = new COTFW_redirect_handler();
	$redirect_handler->check_redirects();
#
#########################################################
#
	class COTFW_redirect_handler {

		var $intercepted = false;
		var $exit_on_intercept = true;
		var $mysqli = null;
		var $db_name = '';

		function __construct() {
			$this->gets = new COTFW_gets();
			$this->gets->_init( isset($_GET['q_rewrite']) ? $_GET['q_rewrite'] : $_SERVER['DOCUMENT_URI'] );
			$this->db_name = filter_str( JBase::get_db(), MASK_GETS );
		}

		function init_mysql() {
			$this->mysqli = new mysqli( JLoads::$host_db, JLoads::$user_db, JLoads::$password_db, JLoads::$db );
			$GLOBALS['MYSQLI'] = &$this->mysqli;
			
			return !$this->mysqli->connect_error;

		}

		function check_domain() {
			if( empty(JLoads::$domain) )
			JLoads::$domain = $this->db_name;
		}

		function check_redirects() {
			
			// проверка на JSON-кеш скриптов
			if( $this->gets->exists('script') )
			$this->cache_script();
			
			if( $this->gets->exists('css') )
			$this->cache_css();

			// проверка на JSON-кеш формы
			if( $this->gets->exists('form') )
			$this->cache_form();

			// если обработчки был подхвачен - завершаем скрипт
			if( $this->intercepted && $this->exit_on_intercept )
			exit();

		}

		function cache_script() {
			$_GET['selector'] = 'js';
			$form_id = intval( $this->gets->last_folder );
			if( !empty($form_id) )
			$_GET['page'] = $form_id;
		
		

			if( $this->init_mysql() ) {

				$this->check_domain();

				if( !defined('_MODEXEC') ) {
					define( '_MODEXEC', 1 );
				}
				if( !defined('_JSEXEC') ) {
					define( '_JSEXEC', 1 );
				}
				//echo json_encode(\Lib\CCSS::page_js(''));
				echo json_encode(CCSS::pagecssjs('js', $_GET['page']));
				$this->intercepted = true;
			}

		}
		
		function cache_css() {
			$_GET['selector'] = 'css';
			$form_id = intval( $this->gets->last_folder );
			if( !empty($form_id) )
			//$_GET['page'] = $form_id;
		
			if( $this->init_mysql() ) {

				$this->check_domain();

				if( !defined('_MODEXEC') ) {
					define( '_MODEXEC', 1 );
				}
				if( !defined('_JSEXEC') ) {
					define( '_JSEXEC', 1 );
				}
				echo json_encode(CCSS::pagecssjs('css', $_GET['page']));
				$this->intercepted = true;
			}

		}

		function cache_form() {
			
			$form_id = intval( $this->gets->last_folder );
			if(
				!empty($form_id) &&
				$this->init_mysql()
			) {
				$this->check_domain();

				if( !defined('_MODEXEC') ) {
					define( '_MODEXEC', 1 );
				}
				
				$json = CPanel::gen( $form_id );

				if( !empty($json) ) {
					$this->intercepted = true;
					echo $json;
				}
			}

		}

	}
#
#########################################################
?>
