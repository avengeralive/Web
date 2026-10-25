<?php
########################################################
#	system.modules.php
#
#	Интерфейс для работы с модулями
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class SYSTEM_modules	{

	function _init()	{

		$this->lists		= &$this->engine->lists;
		$this->user			= &$this->engine->user;
		$this->template		= &$this->engine->template;
		$this->rights		= &$this->engine->rights;
		$this->gets			= &$this->engine->gets;
		$this->lang			= &$this->engine->lang;
		$this->lang_id		= &$this->engine->lang_id;

		$this->module_name		= &$this->engine->module_name;
		$this->module_sys_name	= &$this->engine->module_sys_name;
		$this->index_0	= &$this->engine->index_0;
		$this->CONF		= &$this->engine->CONF;
		$this->s		= &$GLOBALS['subdomain'];
		$this->subdomain = &$GLOBALS['subdomain_r'];

		// генерируем обратные индкесы url_name => module_sys_name
		$this->index = array();
		foreach( $this->lists->data['modules'][ $this->s ] as $index => $data ) {
			$this->index[$data['name']] = &$this->lists->data['modules'][ $this->s ][$index];
			$this->lists->data['modules'][ $this->s ][$index]['index'] = $index;
		}

		// проверяем на подцепление субдомена в качестве модуля
		if( isset($this->index[$this->subdomain]) ) {
			$this->index_0 = $this->subdomain;
		}

		if( !isset($this->index[$this->index_0]) ) {
			$this->index_0 = first( $this->lists->data['modules'][ $this->s ] );
		}

	}

	function form_include()	{

		$folder = '';

		if( empty($this->index_0) || $this->lists->exists($this->index_0,'lang','list') ) {

			$this->index_0 = $this->lists->first( 'modules', $this->s );
			$this->form_include();
			return;

		} else {

			if( $this->rights->allow('module-site',$this->index_0) ) {
				if( $this->index[$this->index_0]['is_static'] ) {

					$this->engine->static_info = isset($this->index[$this->index_0]['static_info']) ? $this->index[$this->index_0]['static_info'] : array();

					$this->module_name = 'static';
					$this->index_0 = 'static';
					$this->CONF |= BIT_MODULE_IS_STATIC;

				} else {

					$folder = $this->index[$this->index_0]['folder'];
					$this->module_name = strtolower( $this->index[$this->index_0]['index'] );

				}
			} else {
				$this->index_0 = $this->lists->first( 'modules', $this->s );
				$this->form_include();
				return;
			}
		}

		if( empty($this->module_name) )
		$this->module_name = first( $this->lists->data['modules'][ $this->s ], false );

		// pr($this->module_name,1);

		include_file(
			CODE.'module.'.$this->s.'/'.
			(!empty($folder)?$folder.'/':'').
			'module.'.$this->module_name.'.php'
		);

		if( isset($this->lists->data['modules'][ $this->s ][$this->module_name]['title']) )
		$this->template->meta['title'] = $this->lists->data['modules'][ $this->s ][$this->module_name]['title'];

		$this->name = $this->index_0;
		$this->template->assign( 'module_name', $this->index_0 );
		$this->template->javascript .=
			"\n".'var module_name = "'.$this->index_0.'";'.
			"\n".'var index_0 = "'. $this->gets->val_index(0) .'";'.
			"\n".'var link = "'. (empty($this->engine->static_info['link'])?'':$this->engine->static_info['link']) .'";'.
			"\n".'var URI = "'. URI .'";'.
			"\n".'var URI_FRAMEWORK = "'. URL_FRAMEWORK .'";'
		;

	}

	function route( &$module, $force_submodule='' ) {

		$cfg = &$this->lists->data['modules'][ $this->s ][ $this->module_name ];
		$regged = &$cfg['routes']['methods'];
		$this->module = &$module;

		if( empty($force_submodule) )
			$this->module->index_0 = $this->gets->next( $this->engine->module_name );
		else
			$this->module->index_0 = $force_submodule;

		$method_name = str_replace( '-', '_', $this->module->index_0 );
		if(
			isset( $cfg['routes']['methods'][$method_name] )	&&
			method_exists( $this->module, $method_name )
		) {
			$this->module->action = $method_name;
			$this->module->{ $method_name }();
		}
		else
			if( !empty($cfg['routes']['default']) ) {
				$method_name = $cfg['routes']['default'];
				$this->module->action = $method_name;
				$this->module->{ $method_name }();
			}
			else;

		$this->template->javascript .= "\n".'var action = "'. $this->module->action .'";';
		$this->template->assignByRef( 'action', $this->module->action );

		$this->template->display( $this->module->tpl_file );

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
					$referer = '/'. $this->module_name .'/';

		$url = parse_url( $referer );
		if(
			isset($url['host']) &&
			$url['host'] != $_SERVER['HTTP_HOST']

			||
			isset($_GET['redirect']) && $_GET['redirect'] == '0' && empty($_GET['referer'])
		)
			$referer = '/'. $this->module_name .'/';

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

		$referer = str_replace( '\'', '\\', $referer );
	}

	function prepare_landing( &$mod ) {

		global $mysqli;
		$mod->mysqli = &$mysqli;

		$mod->gets		= &$this->engine->gets;
		$mod->user		= &$this->engine->user;
		$mod->lists		= &$this->engine->lists;
		$mod->template	= &$this->engine->template;
		$mod->meta		= &$this->engine->meta;
		$mod->cache		= &$this->engine->cache;
		$mod->server	= &$this->engine->server;
		$mod->lang		= &$this->engine->lang;
		$mod->error		= &$this->engine->error;
		$mod->rights	= &$this->engine->rights;
		$mod->validate	= &$this->engine->validate;
		$mod->ankets	= &$this->engine->ankets;
		$mod->settings	= &$this->engine->settings;

		$mod->tpl_file	= &$mod->template->tpl_file;

		$mod->template->css_f	= array( 'Material-Icons', 'materialize.min', 'styles.www' );
		$mod->template->js_libs	= array( 'jquery', 'jquery.helpers', 'materialize.min', 'moment.min', 'js.core', 'js.www' );

		$mod->linker = '/';
		$mod->template->assignByRef( 'linker', $mod->linker );
	}

}

?>
