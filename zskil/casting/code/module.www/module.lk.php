<?php
########################################################
# 	module.lk.php
#
#	Панель администратора
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.03 - файл создан
#
########################################################
class MODULE_lk {

	var $notices_codes = array(
		'Запись успешно отредактирована'	=> '1',
		'Запись добавлена'					=> '2'
	);
	var $notices_codes_index = array();

	function _init()	{

		$this->gets		= &$this->engine->gets;
		$this->user		= &$this->engine->user;
		$this->lists	= &$this->engine->lists;
		$this->template	= &$this->engine->template;
		$this->rights	= &$this->engine->rights;

		$this->s		= &$GLOBALS['subdomain'];

		$this->errors	= array();
		$this->notices	= array();
		$this->template->assignByRef( 'errors',		$this->errors );
		$this->template->assignByRef( 'notices',	$this->notices );

		$this->template->meta['title'] = 'Панель администратора';

		foreach( $this->notices_codes as $title => $id )
		$this->notices_codes_index[ $id ] = $title;

		// form notices
		if( isset($_GET['notice']) && gettype($_GET['notice']) == 'array' )
		foreach( $_GET['notice'] as $notice_id )
		if( isset($this->notices_codes_index[ $notice_id ]) )
		$this->notices[] = $this->notices_codes_index[ $notice_id ];

	}

	var $tpl_file	= '';
	var $javascript	= '';
	function _start() {
		$this->user->is_authorized ? $this->is_authorized() : $this->is_unauthorized();
	}

	var $promoauth_pwd = '';
	function is_unauthorized() {

		$login = '';
		if( isset($_POST['login']) )
		$login = $_POST['login'];

		// error handler
		$this->error = $this->engine->error;
		$notification	= '';
		$params			= array();

		if( $this->error->exists('err_main') ) {
			$err_code = $this->error->val( 'err_main' );
			switch( $err_code )
			{
				// ошибка авторизации
				case ERROR_AUTH:
				break;

				// IP-адрес заблокирован
				case ERROR_USER_BLOCKED:
					$params[ 'ip' ] = $this->user->ip;
					if( $this->error->exists('time_to_auth_wait') )
						$params[ 'block_time' ] = $this->error->val( 'time_to_auth_wait' );

					break;
			}
			$notification = $this->error->get_error_msg( $err_code, $params );
		}

		$this->template->assignByRef( 'login',			$login );
		$this->template->assignByRef( 'promoauth_pwd',	$this->promoauth_pwd );
		$this->template->assignByRef( 'notification',	$notification );
		$this->template->display( 'lk/authorization.tpl' );

	}

	function is_authorized() {

		$this->javascript = &$this->template->javascript;
		$this->template->assignByRef( 'javascript',	$this->javascript );

		$this->template->css_f		= array();
		$this->template->js_libs	= array( 'jquery', 'jquery.helpers' );

		$this->linker =
			URI.'/'.
			$this->engine->module_name	.'/'
		;
		$this->template->assignByRef( 'linker', $this->linker );


		// initialization of submenu && subsubmenu
		$this->submenu				= array();
		$this->subsubmenu			= array();
		$this->submenu_selected		= '';
		$this->subsubmenu_selected	= '';
		$this->template->assignByRef( 'submenu',			$this->submenu );
		$this->template->assignByRef( 'subsubmenu', 		$this->subsubmenu );
		$this->template->assignByRef( 'submenu_selected',	$this->submenu_selected );
		$this->template->assignByRef( 'subsubmenu_selected',	$this->subsubmenu_selected );

		$this->loadModule();

		if( isset($this->lists->data['lk_modules'][$this->s][$this->module]['submenu']) )
		$this->submenu = $this->lists->data['lk_modules'][$this->s][$this->module]['submenu'];

		$this->template->js_libs[] = 'js.core';
		$this->template->js_libs[] = 'js.www.lk';

		$this->javascript .=
			"\n".'var URI = "'. URI .'";'.
			"\n".'var URI_FRAMEWORK = "'. URL_FRAMEWORK .'";'.
			"\n".'var lk_module = "'. $this->module .'";'
		;

		// подсчет свободного места на жестком диске
		$this->template->assign( 'space_free', $this->engine->ankets->get_space_free() );
		$this->template->assign( 'space_total', $this->engine->ankets->get_space_total() );
		$this->template->assign( 'active_convert_tasks', $this->engine->ankets->get_active_convert_tasks_count() );

		// form allowed lk-modules;
		$this->lk_modules = array();
		foreach( $this->lists->data['lk_modules'][$this->s] as $module_name => $module_data )
		if(
			$this->rights->allow('module-lk',$module_name)	&&
			empty( $module_data['is_hidden'] )
		)
		$this->lk_modules[ $module_name ] = $module_data;
		$this->template->assignByRef( 'lk_modules', $this->lk_modules );


		if( empty($this->tpl_file) )
		$this->tpl_file = TPL_LK_404;

		$this->template->display( $this->tpl_file );

	}

	var $module = '';
	function loadModule()	{

		$index = $this->gets->next( 'lk' );

		if(
			empty($index)	||
			!$this->rights->allow( 'module-lk', $index ) ||
			!file_exists( CODE.'module.'.$this->s.'.lk/lk.'. $index .'.php' )
		) {
			$index = $this->lists->first( 'lk_modules', $this->s );
			foreach( $this->lists->data['lk_modules'][$this->s] as $index => $module_info )
			if( $this->rights->allow( 'module-lk', $index ) )
			break;
		}

		$this->template->assign( 'adm_module',		$index.'/' );
		$this->template->assign( 'module_title',	$this->lists->data['lk_modules'][$this->s][$index]['title']);
		$this->module = $index;

		$this->template->assignByRef( 'selected_module', $this->module );

		// loading
		include_file( CODE.'module.'.$this->s.'.lk/lk.'. $index .'.php' );
		$class_name					= 'MODULE_'. str_replace('-','_',$index);
		$this->{ $index }			= new $class_name;
		$this->{ $index }->root		= &$this;
		$this->{ $index }->engine	= &$this->engine;
		$this->{ $index }->_init();
		$this->{ $index }->_start();
	}

	function run_submodule() {

		$this->submenu_selected = first( $this->lists->data['lk_modules'][$this->s][ $this->module ][ 'submenu' ], true );
		$this->submenu_title = first( $this->lists->data['lk_modules'][$this->s][ $this->module ][ 'submenu' ], false );

		$this->template->assignByRef( 'submenu_title', $this->submenu_title );
		$try = $this->gets->next( $this->module );
		if( !empty($try)
				AND
			(
				isset($this->lists->data['lk_modules'][$this->s][ $this->module ][ 'submenu' ][ $try ])
					OR
				isset($this->lists->data['lk_modules'][$this->s][ $this->module ][ 'submenu_hidden' ][ $try ])
			)
		){
			$this->submenu_selected = $try;

			$this->submenu_title = isset($this->lists->data['lk_modules'][$this->s][ $this->module ][ 'submenu' ][ $try ]) ? $this->lists->data['lk_modules'][$this->s][ $this->module ][ 'submenu' ][ $try ] : $this->lists->data['lk_modules'][$this->s][ $this->module ][ 'submenu_hidden' ][ $try ];
		}

		$this->javascript .= "\n".'var submodule = "'. $this->submenu_selected .'";';

		$method_name = str_replace( '-', '_', $this->submenu_selected );
		$this->template->assignByRef( 'submodule', $this->submenu_selected );

		if( method_exists($this->{$this->module}, $method_name) )
		$this->{ $this->module }->{ $method_name }();

	}

	var $referer = '';
	function form_referer() {
		$this->template->assignByRef( 'referer', $this->referer );
		$referer = &$this->referer;

		if( isset($_GET['referer']) )
			$referer = $_GET['referer'];
		else
			if( isset($_POST['referer']) )
				$referer = $_POST['referer'];
			else
				if( isset($_SERVER['HTTP_REFERER']) )
					$referer = $_SERVER['HTTP_REFERER'];
				else
					$referer = URI.'/lk/'. $this->module .'/';

		$url = parse_url( $referer );
		if(
			isset($url['host']) &&
			$url['host'] != $_SERVER['HTTP_HOST']

			||
			isset($_GET['redirect']) && $_GET['redirect'] == '0' && empty($_GET['referer'])
		)
			$referer = URI.'/lk/'. $this->module .'/';

		// remove notice[] && error[] GET-params
		$parsed = parse_url( $referer );
		if( isset($parsed['query']) ) {

			$rewrited_params = array();

			$params = parse_str2( $parsed['query'], false );

			if( !empty($params) )
			foreach( $params as $i => $param )
			if( $param['key'] == 'notice[]' || $param['key'] == 'error[]' )
				unset( $params[ $i ] );
			else
				$rewrited_params[] = $param['key'].'='.$param['value'];

			$referer =
				$parsed['scheme'].'://'.
				$parsed['host'].
				$parsed['path'].
				(!empty($rewrited_params)?'?'.implode('&',$rewrited_params):'')
			;
		}

		// фильтруем реферер
		$referer = str_replace( '\'', '\\', $referer );

		// удаляем действия из реферера
		$referer = preg_replace( '#[\?&](delete|change_status)#si', '', $referer );

	}

	function redirectOnInsert( $new_id ) {
		if( isset($_POST['redirect']) )
			if( !empty($_POST['redirect']) )
				redirectToReferer(
					$this->referer,
					array('notice[]='.$this->notices_codes['Запись добавлена'])
				);
			else
				redirect( URI.'/lk/'. $this->module .'/edit/id-'.$new_id.'/?redirect=0&referer='.urlencode($this->referer).'&notice[]='.$this->notices_codes['Запись добавлена'] );
		else
			redirectToReferer(
				$this->referer,
				array('notice[]='.$this->notices_codes['Запись добавлена'])
			);
	}

	function redirectOnEdit( $new_id ) {
		$this->notices[] = 'Запись успешно отредактирована';
		if( isset($_POST['redirect']) && !empty($_POST['redirect']) )
		redirectToReferer(
			$this->referer,
			array('notice[]='.$this->notices_codes['Запись успешно отредактирована'])
		);
	}

	function prepare_module( &$mod ) {

		global $mysqli;
		$mod->mysqli = &$mysqli;

		$mod->gets			= &$this->engine->gets;
		$mod->user			= &$this->engine->user;
		$mod->lists			= &$this->engine->lists;
		$mod->template		= &$this->engine->template;
		$mod->settings		= &$this->engine->settings;
		$mod->user			= &$this->engine->user;
		$mod->rights		= &$this->engine->rights;
		$mod->validate		= &$this->engine->validate;
		$mod->ankets		= &$this->engine->ankets;

		$mod->errors				= &$this->errors;
		$mod->notices				= &$this->notices;
		$mod->javascript			= &$this->javascript;
		$mod->submenu_selected		= &$this->submenu_selected;
		$mod->notices_codes			= &$this->notices_codes;
		$mod->notices_codes_index	= &$this->notices_codes_index;
		$mod->referer				= &$this->referer;
		$mod->tpl_file				= &$this->tpl_file;

		$mod->s = &$GLOBALS['subdomain'];

	}
}

?>
