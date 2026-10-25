<?php
########################################################
# 	system.template.php
#
#	Системный модуль - интерфейс для работы с шаблонизатором Smarty
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
include_once( SMARTY_DIR .'Smarty.class.php' );

class SYSTEM_template extends Smarty {

	var $ACT = 0x00;

	function SYSTEM_template(){
		parent::__construct();

		$this->template_dir		= SMARTY_DIR_TEMPLATE.'/'.$GLOBALS['subdomain'];
		$this->compile_dir		= SMARTY_DIR_COMPILE;
		$this->plugins_dir		= SMARTY_DIR_PLUGINS;
		$this->config_dir		= SMARTY_DIR_CONFIG;
		$this->cache_dir		= SMARTY_DIR_CACHE;

		$this->caching			= SMARTY_CACHING;
		$this->debugging		= SMARTY_DEBUG_CONSOLE;
		$this->force_compile	= SMARTY_FORCE_COMPILE;
		$this->compile_check	= SMARTY_COMPILE_CHECK;
		$this->error_reporting	= SMARTY_ERROR_REPORTING;

		$this->engine	= new ArrayObject;
		$this->gets		= new ArrayObject;
		$this->lists	= new ArrayObject;
		$this->user		= new ArrayObject;
		$this->settings	= new ArrayObject;
		$this->cache	= new ArrayObject;
		$this->mysqli	= new ArrayObject;
		$this->rights	= new ArrayObject;
		$this->server	= new ArrayObject;
	}

	function _init( $static = false )	{

		global $mysqli;
		$this->mysqli = &$mysqli;

		if( !$static ) {

			$this->gets		= &$this->engine->gets;
			$this->lists	= &$this->engine->lists;
			$this->user		= &$this->engine->user;
			$this->settings = &$this->engine->settings;
			$this->rights	= &$this->engine->rights;
			$this->cache	= &$this->engine->cache;

		} else {

			global $gets, $lists, $user, $settings, $rights, $cache;

			$this->gets		= &$gets;
			$this->lists	= &$lists;
			$this->user		= &$user;
			$this->settings	= &$settings;
			$this->rights	= &$rights;
			$this->cache	= &$cache;

		}

		$this->generate_globalVars();
		$this->print = $this->gets->exists( 'print' );
	}

	function display( $template = null, $cache_id = null, $compile_id = null, $parent = null )	{
		$this->generate_globalVars_bottom();
		parent::display( $template, $cache_id, $compile_id, $parent );
	}

	var $javascript	= '';
	var $js_libs	= array( 'jquery' );
	var $css_f		= array();
	var $notices	= array();
	var $errors		= array();
	var $error		= array( 'code' => 0, 'message' => '' );
	var $meta		= array(
		'title_prefix'	=> '',
		'title_postfix'	=> '',
		'title'			=> 'Главная',
		'description'	=> '',
		'keywords'		=> ''
	);
	var $print_mode = false;
	var $pdf_mode = false;
	var $loadYaMap	= false;
	var $counts = array();
	var	$mail = array();
	var $include_ckeditor = false;
	var $include_ckfinder = false;
	var $include_tinymce = false;
	var $banners = array();

	function generate_globalVars()	{
		// генерируем переменные, которые используются в большей части шаблонов

		$this->registerPlugin( 'function', 'getEnding',			array($this,'getEnding') );
		$this->registerPlugin( 'function', 'formatNumber',		array($this,'formatNumber') );
		$this->registerPlugin( 'function', 'staticDataVal',		array($this,'staticDataVal') );
		$this->registerPlugin( 'function', 'setVar',			array($this,'setVarFromTemplate') );
		$this->registerPlugin( 'function', 'allow',				array($this->user,'tpl_allow') );
		$this->registerPlugin( 'function', 'daysInMonth',		array($this,'daysInMonth') );
		$this->registerPlugin( 'function', 'IsHoliday',			array($this,'IsHoliday') );
		$this->registerPlugin( 'function', 'replacement',		array($this,'replacement') );
		$this->registerPlugin( 'function', 'get_time_for_schedule',		'get_time_for_schedule' );
		$this->registerPlugin( 'function', 'mktime2',			array($this,'mktime2') );
		$this->registerPlugin( 'function', 'getPriceClassName',	'getPriceClassName' );
		$this->registerPlugin( 'function', 'lfToBr',			'lfToBr' );
		$this->registerPlugin( 'function', 'remove_quotes',		'remove_quotes' );
		$this->registerPlugin( 'function', 'get_image_rand',	'get_image_rand' );
		$this->registerPlugin( 'function', 'parse_size',		'parse_size' );
		$this->registerPlugin( 'function', 'mysql_timestampToUnix', 'mysql_timestampToUnix' );

		if( !empty($this->engine->filter) ) {
			$this->registerPlugin( 'function', 'filter',			array(&$this->engine->filter, 'tpl_get') );
			$this->registerPlugin( 'function', 'filter_default',	array(&$this->engine->filter, 'tpl_get_default') );
			$this->registerPlugin( 'function', 'sort',				array(&$this->engine->filter, 'tpl_sort') );
		}

		$this->assign( 'uri',				URI );
		$this->assign( 'checked',			CHECKED );
		$this->assign( 'selected',			SELECTED );
		$this->assign( 'disabled',			DISABLED );
		$this->assign( 'required',			REQUIRED );
		$this->assign( 'site_url',			SITE_URL );
		$this->assign( 'url_prefix',		'' );
		$this->assign( 'tinymce_url',		URL_FRAMEWORK.'tinymce/tinymce.min.js' );
		$this->assign( 'timestamp_mask',	'%Y-%m-%d %H:%M:%S' );
		$this->assign( 'subdomain',			$GLOBALS['subdomain_r'] );

		$this->assignByRef( 'include_tinymce', $this->include_tinymce );
		$this->assignByRef( 'js_libs',		$this->js_libs );
		$this->assignByRef( 'css_f',		$this->css_f );
		$this->assignByRef( 'lists',		$this->lists->data );
		$this->assignByRef( 'notices',		$this->notices );
		$this->assignByRef( 'errors',		$this->errors );
		$this->assignByRef( 'error',		$this->error );
		$this->assignByRef( 'javascript',	$this->javascript );
		$this->assignByRef( 'meta',			$this->meta );
		$this->assignByRef( 'loadYaMap',	$this->loadYaMap );
		$this->assignByRef( 'counts',		$this->counts );
		$this->assignByRef( 'user',			$this->user->info );
		$this->assignByRef( 'usr_obj',		$this->user );
		$this->assignByRef( 'mail',			$this->mail );
		$this->assignByRef( 'settings',		$this->settings );
		$this->assignByRef( 'rights',		$this->rights );
		$this->assignByRef( 'print_mode',	$this->print_mode );
		$this->assignByRef( 'pdf_mode',		$this->pdf_mode );

		if( CURRENCY_AUTO_FORM )
		$this->form_currency();

		$this->javascript .=
			"\n".'var is_authorized	= '.($this->user->is_authorized?'true':'false').';'.
			"\n".'var site_url		= "'. SITE_URL .'";'
		;

		if( $this->user->is_authorized ) {

			if( $this->user->type == 'admin' ) {

			}

		} else {

		}

	}


	function generate_globalVars_bottom()	{

		// вызывается перед template->display
		if( $this->user->is_authorized ) {

			if( $this->user->type == 'admin' ) {
				$this->form_count_ankets();
			}

		}

	}

	function getEnding( $params ) {

		if(
			!isset($params['count'])	&&
			!isset($params['words'])
		)	return '';

		return get_ending( $params['count'], explode(';',$params['words']) );
	}

	function init_filter( &$module, $rubrik_index, $module_index='lk'  ) {

		$module->filter = &$this->engine->filter;

		// init filter
		$module->filter_vars = array( 'pages' => 1, 'rows_count' => 0 );
		$module->filter->init_defaultVars( $module->filter_vars, $rubrik_index,$module_index);
		$module->filter->init_auto( $module->filter_vars, $rubrik_index, $module_index );
		$module->filter->init_sort( $module->lists->data['filters'][$module_index][$rubrik_index]['sort'] );
		$module->filter->set_url( '?' );

		$this->assignByRef( 'filter_vars', $module->filter_vars );

	}

	var $tpl_vars_manual = array();
	function setVarFromTemplate( $params ) {

		if( isset($params['name']) && isset($params['value']) )
		$this->tpl_vars_manual[ $params['name'] ] = $params['value'];

		return '';
	}

	function daysInMonth( $params ) {

		if( isset($params['year']) && isset($params['month']) )
		return cal_days_in_month( CAL_GREGORIAN, $params['month'], $params['year'] );

		return '';
	}

	function IsHoliday( $params ) {

		if( isset($params['year']) && isset($params['month']) && isset($params['day']) ) {
			$unix = mktime2(array(
				'year'		=> $params['year'],
				'month'		=> $params['month'],
				'day'		=> $params['day'],
				'hour'		=> 12,
				'minute'	=> 0,
				'second'	=> 0
			));

			$dayOfWeek = get_dow( $unix );
			return $dayOfWeek >= 6 ? '1' : '0';
		}

		return '0';
	}

	function replacement( $params ) {
		$text = $params['text'];
		unset( $params['text'] );

 		$conf = str_replace_PREPARE( $params );

		if( !empty($conf['from']) )
		foreach( $conf['from'] as $index => $value )
		$conf['from'][ $index ] = '%'.$value.'%';

 		return str_replace( $conf['from'], $conf['to'], $text );
	}

	function mktime2( $params ) {
		return mktime2( $params );
	}

	function varEmpty( $name ) {
		return
			!isset($this->tpl_vars_manual[$name])	||
			empty($this->tpl_vars_manual[$name] )
		;
	}

	function value( $name ) {
		return $this->varEmpty($name) ? '' : $this->tpl_vars_manual[ $name ];
	}

	function mailCleanVars() {
		$this->mail = array();
	}

	function staticDataVal( $params ) {

		if(
			!isset($params['index'])	&&
			!isset($params['metka'])
		)	return '';

		if( isset($params['array']) )
		return $this->lists->val( $params['index'], $params['metka'], $params['array'] );


		return $this->lists->val( $params['index'], $params['metka'] );
	}

	function formatNumber( $params )	{

		if(
			!isset($params)				||
			!isset($params['value'])	||
			!isset($params['form1'])	||
			!isset($params['form2'])	||
			!isset($params['form3'])
		)
			return '%WRONG_PARAMS%';

		return get_ending( $params['value'], array($params['form1'],$params['form2'],$params['form3']) );
	}

	function form_count_ankets() {
		$this->counts['ankets'] = mysql_row('

			SELECT	COUNT(*)
			FROM	`data_ankets`
			WHERE	`status` = "moderating"

		');
	}

	function form_fromSearch( $pattern, $reg = false ) {

		$from_search = false;
		if( isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ) {

			$url = parse_url( $_SERVER['HTTP_REFERER'] );

			if( $reg )
				$from_search = preg_match( $pattern, $url['path'] );
			else
				$from_search = strpos( $url['path'], $pattern );
		}
		$this->assign( 'from_search', $from_search );
	}

	function form_currency() {
		$currencies_list = array( 'RUB' => 1.0 );
		foreach( $this->lists->data['currency']['data'] as $id => $title )
		if( $id != 'RUB' )
		$currencies_list[$id] = floatval( $this->settings->val('currency_'.$id) );

		$this->javascript .= "\n".'var currency		= '.json_encode($currencies_list).';';
	}

	function form_inputs( &$rows ) {

		$this->inputs = array();

		foreach( $rows as $key => $row ){

			if( isset($row['cache']) ) {
				if( $this->ACT == 'edit' || $this->ACT == 'insert' ){

					$cfg = &$row['cache'];

					$json = array();
					if( isset($cfg['jsoned']) && !empty($cfg['jsoned']) ) {

						$unjsoned_str = $this->val( $cfg['jsoned_dbrow'] );

						if( !empty($unjsoned_str) )
							$unjsoned = $this->cache->row_extract( $unjsoned_str );
						else
							$unjsoned = array();

						if( !empty($unjsoned) )
						foreach( $unjsoned as $id => $data ) {

							$json[ $id ] = array();

							foreach( $cfg['jsoned_struct'] as $row_cfg )
							if( isset($data[$row_cfg['jsoned_index']]) )
								if( $row_cfg['filter'] == 'all-chars' )
									$json[$id][$row_cfg['json_index']] = all_chars( $data[$row_cfg['jsoned_index']]);
								else
									if( $row_cfg['filter'] == 'all-chars-except-tags' )
										$json[$id][$row_cfg['json_index']] = htmlspecialchars(remove_quotes( $data[$row_cfg['jsoned_index']]), ENT_COMPAT,ENC_HSC, true);
									else
										$json[$id][$row_cfg['json_index']] = filter( $data[$row_cfg['jsoned_index']], $row_cfg['filter'] );
							else
								$json[$id][$row_cfg['json_index']] = $row_cfg['defval'];

							if( isset($cfg['jsoned_single']) && !empty($cfg['jsoned_single']) )
							break;
						}

						if( isset($cfg['dbrow_id']) && isset($cfg['dbrow_index']) ) {
							$dbrow_id = $this->val( $cfg['dbrow_id'] );
							if( !empty($dbrow_id) ) {
								foreach( $cfg['jsoned_struct'] as $row_cfg ) {

									if( $row_cfg['jsoned_index'] != $cfg['dbrow_index'] )
									continue;

									$this->inputs[ $row_cfg['jsoned_index'] ] = filter( $this->val($dbrow_id, $cfg['dbrow_default']), $cfg['dbrow_filter'] );

								}
							}
						}

					}

					$this->inputs[ $key ] = json_encode( $json );
				} else {
					$this->inputs[ $key ] = $this->val( $key );
				}
				continue;
			}

			switch( $this->ACT ) {

				case 'edit':
				if( !empty($row['dbrow']) ) {
					$this->inputs[ $key ] = $this->val( $row['dbrow'], isset($row['defval'])?$row['defval']:'' );
				} else {
					$this->inputs[ $key ] = '';
				}
				break;

				case 'insert':
				$this->inputs[ $key ] = $this->val( $key, isset($row['defval'])?$row['defval']:'' );
				break;

				default:
				$this->inputs[ $key ] = $this->val( $key, isset($row['defval'])?$row['defval']:'' );

			}

			if( !empty($row['is_array']) && gettype($this->inputs[$key]) == 'array' ) {
				foreach( $this->inputs[$key] as $indx => $val )
				$this->inputs[$key][$indx] = $this->form_inputs_filter( $row, $this->inputs[$key][$indx] );
			} else {
				$this->inputs[$key] = $this->form_inputs_filter( $row, $this->inputs[$key] );
			}

			if( isset($row['lambda_reverse_exists']) ) {
				$lambda = create_function(
					$row[ 'lambda_reverse_params' ],
					$row[ 'lambda_reverse_body' ]
				);
				$lambda( $this->inputs[$key], $this->ACT );
			}

			if( isset($row['rights_need']) ) {

				$access_granted = true;
				$rights_need = array();
				if( gettype($row['rights_need']) == 'string' )
					$rights_need[] = $row['rights_need'];
				else
					$rights_need = $row['rights_need'];

				foreach( $rights_need as $right_need )
				if( !$this->rights->allow($right_need) ) {
					$access_granted = false;
					break;
				}

				if( !$access_granted )
				$this->inputs[ $key ] = $row['defval'];

			}

			if( isset($row['force']) ) {

				$force = array();
				$force_except = array();
				$force_ACT = array();

				if( gettype($row['force']) == 'string' )
					$force[ $row['force'] ] = true;
				else
					$force = $row['force'];

				if( isset($row['force_except']) )
					if( gettype($row['force_except']) == 'string' )
						$force_except[ $row['force_except'] ] = true;
					else
						$force_except = $row['force_except'];
				else;

				if( isset($row['force_ACT']) )
					if( gettype($row['force_ACT']) == 'string' )
						$force_ACT[ $row['force_ACT'] ] = true;
					else
						$force_ACT = $row['force_ACT'];
				else;

				if(
					(
						!empty($force['all']) ||
						!empty($force[ $this->user->type ])
					) &&
					empty($force_except[ $this->user->type ] ) &&
					(
						empty($force_ACT)	||
						!empty($force_ACT['all'])	||
						!empty($force_ACT[ $this->ACT ])
					)
				) {
					$this->inputs[ $key ] = $row['defval'];
				}

			}
		}

	}

	function form_inputs_filter( $row, $value ) {

		if( $row['filter'] == 'all-chars' )
			$value = all_chars( $value );
		else
			if( $row['filter'] == 'all-chars-except-tags' )
				$value = htmlspecialchars(str_replace( '\'', '', $value ), ENT_COMPAT,ENC_HSC, true);
			else
				filter_ref( $value, $row['filter'] );

		return $value;
	}

	function form_insertVals( &$rows ) {

		$this->vals = array();
		$this->mtms	= array();
		$v = &$this->vals;
		$n = &$this->inputs;
		$p = &$_POST;
		$value = null;

		foreach( $rows as $key => $row ){

			if(
				!isset( $n[$key] )	||

				(
					!isset( $p[$key] )	&&
					!isset( $row['allow_nopost'])	&&
					empty( $row['allow_nopost'])
				)

			)	continue;

			$value = $n[$key];

			if( !empty($row['is_array']) ) {
				foreach( $value as $indx => $val )
				$value[$indx] = $this->form_inputs_filter( $row, $value[$indx] );
			} else {
				$value = $this->form_inputs_filter( $row, $value );
			}


			if( isset($row['bbcode']) ) {
				$tags = str_replace_PREPARE( $row['bbtags'] );
				$value = str_replace( $tags['from'], $tags['to'], $value );
			}


			if( isset($row['lambda_exists']) ) {
				$lambda = create_function(
					$row[ 'lambda_params' ],
					$row[ 'lambda_body' ]
				);
				$lambda( $value );
			}


			if( isset($row['mtm']) )
			$this->mtms[ $row['mtm']['table'] ] = $row['mtm'] + array('raw_data' => $p[$key]);

			if( isset($row['cache']) ) {

				$json = !empty($p[$key]) ? json_decode($p[$key],true) : array();
				if( empty($json) )
				$json = array();

				$cfg = &$row['cache'];
				if( isset($cfg['jsoned']) && !empty($cfg['jsoned']) ) {

					$to_json = array();

					foreach( $json as $id => $data ) {
						foreach( $cfg['jsoned_struct'] as $row_cfg )
						if( isset($data[$row_cfg['json_index']]) )
							if( $row_cfg['filter'] == 'all-chars' )
								$to_json[ $id ][ $row_cfg['jsoned_index'] ] = all_chars( $data[$row_cfg['json_index'] ] );
							else
								if( $row_cfg['filter'] == 'all-chars-except-tags' )
									$to_json[ $id ][ $row_cfg['jsoned_index'] ] = htmlspecialchars(remove_quotes( $data[$row_cfg['json_index'] ]), ENT_COMPAT,ENC_HSC, true);
								else
									$to_json[ $id ][ $row_cfg['jsoned_index'] ] = filter( $data[$row_cfg['json_index'] ], $row_cfg['filter'] );
						else
							$to_json[ $id ][ $row_cfg['jsoned_index'] ] = $row_cfg['defval'];

						if( isset($cfg['jsoned_single']) && !empty($cfg['jsoned_single']) )
						break;
					}

					$v[ $cfg['jsoned_dbrow'] ] = $this->cache->row( $to_json );

				} else {

					if( !empty($json) ) {
						foreach( $json as $id => $data ) {
							foreach( $cfg['rows'] as $row_cfg ) {
								if( isset($data[$row_cfg['json_index']]) )
									$v[ $row_cfg['dbrow'] ] = filter( $data[$row_cfg['json_index']], $row_cfg['filter'] );
								else
									$v[ $row_cfg['dbrow'] ] = $row_cfg['defval'];
							}
							break;
						}
					} else {
						foreach( $cfg['rows'] as $row_cfg )
						$v[ $row_cfg['dbrow'] ] = $row_cfg['defval'];
					}

				}

				if( isset($cfg['dbrow_id']) && isset($cfg['dbrow_index']) ) {

					if( !empty($json) ) {
						foreach( $json as $val => $json_item )
						break;

						$v[ $cfg['dbrow_id'] ] = filter( $val, $cfg['dbrow_filter'] );

					} else {

						if( isset($cfg['dbrow_default']) )
							$v[ $cfg['dbrow_id'] ] = $cfg['dbrow_default'];
						else
							$v[ $cfg['dbrow_id'] ] = '';

					}
				}

			} else {
				if( !empty($row['dbrow']) )
				$v[ $row['dbrow'] ] = $value;
			}

		}

	}

	function update_capcha_url() {
		// запускаем сессию (она по умолчанию не запускается, чтобы не создавать лишней нагрузки, т.к. сессия представлена файлами)
		session_start();
		session_write_close();
		$this->assign( 'capcha_url', URL_FRAMEWORK.'kcaptcha/?'.session_name().'='.session_id().'' );
	}

	function db_updateMtms( $object_id, &$mysqli=null ) {

		if( $mysqli === null )
		$mysqli = &$this->mysqli;

		if( !empty($this->mtms) ) {

			$existed_all = array();
			foreach( $this->mtms as $tbl_name => $mtm ){

				// form already existed records in MTM-table
				$existed = array();
				$q = $mysqli->query('

					SELECT	*
					FROM	`'. $tbl_name .'`
					WHERE	`'. $mtm['parent_id'] .'` = '. $object_id

				);
				while( $tie = $q->fetch_assoc() )
				$existed[ $tie[$mtm['id']] ] = $tie;
				$q->close();

				$existed_all[ $tbl_name ] = $existed;
			}

			foreach( $this->mtms as $tbl_name => $mtm ){

				// form current data
				if( empty($mtm['raw_data']) )
				continue;

				$json = json_decode( $mtm['raw_data'], true );
				if( empty($json) )
				$json = array();

				$new_data = array();
				foreach( $json as $id => $data ) {
					$id = filter( $id );

					if( empty($id) )
					continue;

					$new_data[ $id ] = array(
						$mtm['id']			=> $id,
						$mtm['parent_id']	=> $object_id
					);

					if( !empty($mtm['rows']) )
					foreach( $mtm['rows'] as $mtm_row ) {
						if( isset($data[$mtm_row['json_index']]) )
							$new_data[ $id ][ $mtm_row['mtm_row'] ] = filter( $data[$mtm_row['json_index']], $mtm_row['filter'] );
						else
							$new_data[ $id ][ $mtm_row['mtm_row'] ] = $mtm_row['defval'];

						if( isset($mtm_row['lambda_exists']) ) {
							$lambda = create_function(
								$mtm_row[ 'lambda_params' ],
								$mtm_row[ 'lambda_body' ]
							);
							$lambda( $new_data[$id][ $mtm_row['mtm_row'] ] );
						}
					}
				}

				$existed = &$existed_all[ $tbl_name ];

				$ids_toDelete	= array();
				$ids_toInsert	= array();
				$ids_toUpdate	= array();

				if( empty($new_data) && !empty($existed) ) {

					// delete all MTM ties, if no nets for object
					$mysqli->query('

						DELETE
						FROM	`'. $tbl_name .'`
						WHERE	`'. $mtm['parent_id'] .'` = '. $object_id

					 );
					continue;

				} else {

					// check for delete existed
					foreach( $existed as $id => $data )
					if( !isset($new_data[$id]) )
						$ids_toDelete[] = $id;
					else
						// check for update existed rows
						if( isset($mtm['rows']) )
							foreach( $mtm['rows'] as $mtm_row )
							if( $new_data[$id][$mtm_row['mtm_row']] != $existed[$id][$mtm_row['mtm_row']] )
								$ids_toUpdate[ $id ][$mtm_row['mtm_row']] = $new_data[$id][$mtm_row['mtm_row']];
							else;
						else;

					// check for insert new
					foreach( $new_data as $id => $data )
					if( !isset($existed[$id]) )
					$ids_toInsert[] = $id;

					if( !empty($ids_toInsert) ) {
						$rows = '(`'.$mtm['parent_id'].'`,`'.$mtm['id'].'`';
						if( isset($mtm['rows']) )
						foreach( $mtm['rows'] as $mtm_row )
						$rows .= ',`'.$mtm_row['mtm_row'].'`';
						$rows .= ')';

						$buffer = array();
						foreach( $ids_toInsert as $id ) {
							$data = &$new_data[ $id ];

							$query = '(\''.$data[$mtm['parent_id']].'\',\''. $data[$mtm['id']] .'\'';

							if( isset($mtm['rows']) )
							foreach( $mtm['rows'] as $mtm_row )
							$query .= ',\''.$data[$mtm_row['mtm_row']].'\'';

							$query .= ')';
							$buffer[] = $query;
						}

						$mysqli->query('

							INSERT
							INTO	`'. $tbl_name .'`

							'. $rows .'
								VALUES
							'. implode( ',', $buffer )

						);

					}

					if( !empty($ids_toUpdate) ) {
						$queries = '';

						foreach( $ids_toUpdate as $mtm_id => $mtm_rows ) {

							$sets = array();
							foreach( $mtm_rows as $row => $value )
							$sets[] = '`'.$row.'` = \''. remove_quotes($value) .'\'';

							if( !empty($sets) )
							$queries .= '

								UPDATE	`'. $tbl_name .'`
								SET		'. implode(',',$sets) .'
								WHERE	`'. $mtm['id'] .'` = '.$mtm_id .'


							;';
						}

						if( !empty($queries) )
						$mysqli->multi_query( $queries );
					}

					if( !empty($ids_toDelete) )
					$mysqli->query('

						DELETE
						FROM	`'. $tbl_name .'`
						WHERE	`'. $mtm['parent_id'] .'` = '. $object_id .' AND
								`'. $mtm['id'] .'` IN ('. implode(',',$ids_toDelete).')

					' );

				}
			}
		}
	}

	function db_generateListCache( $index, $str ) {

		// generating cache
		$to_implode	= array();
		$query = $this->mysqli->query('

			SELECT	`id`,`value`
			FROM	`'. $this->lists->data[ $index ]['table'] .'`
			WHERE	`id` IN ('. implode(',',explode( EXPLODE, $str )) .')

		');
		while( @list($id, $value) = $query->fetch_row() )
		$to_implode[ $id ] = $value;

		$query->free();

		return serialize( $to_implode );
	}

	function val( $index, $default_val='' )	{

		if(
			$this->ACT == 'edit' &&
			isset($this->cur_obj[$index])/* &&
			$this->cur_obj[ $index ]*/
		)
			return $this->cur_obj[ $index ];


		if(
			$this->ACT == 'edit-try' &&
			!isset($_POST[$index]) &&
			isset($this->cur_obj[$index])
		)
			return $default_val;
			// return $this->cur_obj[ $index ];


		if(
			( $this->ACT == 'edit-try' && isset($_POST[$index]) )
				||
			( $this->ACT == 'insert-try' && isset($_POST[$index]) )
		)
			return $_POST[ $index ];

		return $default_val;

	}


	function __get( $name ){

		$allowed = array(
			'template_dir'	=> 'setTemplateDir',
			'config_dir'	=> 'setConfigDir',
			'plugins_dir'	=> 'setPluginsDir',
			'compile_dir'	=> 'setCompileDir',
			'cache_dir'		=> 'setCacheDir'
		);

		if( isset($allowed[$name]) )
			parent::__get( $name );
		else
			if( isset($this->{$name}) )
				return $this->{$name};
			else
			{
				$this->{$name} = new ArrayObject;
				return $this->{$name};
			}
	}


    function __set( $name, $value ){

		$allowed = array(
			'template_dir'	=> 'setTemplateDir',
			'config_dir'	=> 'setConfigDir',
			'plugins_dir'	=> 'setPluginsDir',
			'compile_dir'	=> 'setCompileDir',
			'cache_dir'		=> 'setCacheDir'
		);

		if( isset($allowed[$name]) )
			parent::__set( $name, $value );
		else
			$this->{ $name } = $value;
	}
}


?>
