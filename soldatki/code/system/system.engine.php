<?php
########################################################
#	system.engine.php
#
#	Движок сайта
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
########################################################
#
	define( 'LM_NO_INIT',				1 << 0 );
	define( 'LM_IS_NOT_SYSTEM',			1 << 1 );
	define( 'LM_N_EXIT',				1 << 2 );
	define( 'LM_NO_LOG_IS_LOADED',		1 << 3 );
	define( 'LM_RELOAD',				1 << 4 );
	define( 'LM_USE_SUB_FOLDER',		1 << 5 );
	define( 'LM_NO_TIRE',				1 << 6 );
	define( 'BIT_MODULE_IS_STATIC',		1 << 0 );
#
########################################################
class site	{

	var $module_name = '';
	var $CONF		= 0x00;
	var $lang		= '';
	var $lang_id	= '';
	var $l			= '';

	function _start( $start_module = true )	{

		set_time_limit2( LONG_LIFE_TIMEOUT );

		include_constants( 'lists' );
		include_constants( 'error' );
		include_constants( 'auth' );

		if( DEBUG ) {
			bot_kick_all();
		}

		$this->load_module( 'logs' );
		$this->load_module(	'lists' );
		$this->load_module( 'gets' );
		$this->load_module( 'settings' );
		$this->load_module( 'error' );
		$this->load_module( 'subdomains' );
		$this->load_module( 'user' );
		$this->load_module( 'rights' );
		$this->load_module( 'filter' );
		$this->load_module( 'template' );
		$this->load_module( 'cache' );
		$this->load_module( 'validate' );
		$this->load_module( 'session' );
		$this->load_module( 'ankets' );

		$this->form_index_0();

		$this->load_module( 'modules' );
		$this->modules->form_include();

		if( $start_module )
		$this->module_start();
	}
	###################################
	function module_start()	{
		$this->template->assignByRef( 'module_name', $this->module_name );

		$class_name = str_replace( '-', '_', 'MODULE_'.$this->module_name );

		$this->module = new $class_name;
		$this->module->engine = &$this;
		$this->module->_init();
		$this->module->_start();
	}
	###################################
	var $module_loaded = array();
	function load_module( $name, $CONF_BITS = 0x00, $init_params=false )	{

		if( !($CONF_BITS & LM_NO_TIRE) )
		$name = str_replace( '-', '_', $name );

		if( $CONF_BITS & LM_USE_SUB_FOLDER )
			$subfolder = $init_params['subfolder'] . '/';
		else
			$subfolder = '';

		if( $CONF_BITS & LM_IS_NOT_SYSTEM )
			{$prefix = 'module';$iPrefix = 'MODULE';}
		else
			{$prefix = 'system';$iPrefix = 'SYSTEM';}

		if( isset($this->module_loaded[$name]) ) {
			// если модуль уже загружен и не было команды перезапуска модуля, то отмена загрузки модуля
			if(!($CONF_BITS & LM_RELOAD)) {
				return;
			} else {
				unset( $this->{$name} );
			}
		} else {
			include_file( CODE.$prefix.'/'.$subfolder.$prefix.'.'.$name.'.php' );
		}

		############################
		# создание объекта
		############################
		$class_name = $iPrefix .'_'. str_replace('-','_',$name);
		$this->{ $name } = new $class_name;
		$this->{ $name }->engine = &$this;

		if(!( $CONF_BITS & LM_NO_INIT ))
		$this->{ $name }->_init( $init_params );

		################
		if( !($CONF_BITS & LM_NO_LOG_IS_LOADED) )
		$this->module_loaded[ $name ] = 1;
		################
		if( $CONF_BITS & LM_N_EXIT ) exit();
	}

	function form_index_0() {
		$folders = explode( '/', URI );

		$val_index = 0;
		foreach( $folders as $folder ) {
			if( !empty($folder) ) {
				$val_index++;
			}
		}
		$this->index_0 = $this->gets->val_index( $val_index );
	}
}
?>
