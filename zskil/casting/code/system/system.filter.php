<?php
########################################################
#	system.filter.php
#
#	интерфейс для фильтрации списка данных
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
class SYSTEM_filter	{


	function _init() {

		$this->lists = &$this->engine->lists;

	}

	var $vars = array();

	// ссылки формируются в формате ЧПУ
	var $chpu = false;

	// если текущее значение параметра равно значению по умолчанию,
	// не выводить его (чтобы не засорять URL)
	var $emptyDefaultVals = true;

	function init( $params ){

		$this->vars = $params;
		$this->filter_blocked = array();

	}

	function init_auto( &$fv, $index, $subindex = 'site' ) {

		if( !isset($this->lists->data['filters'][ $subindex ][ $index ]) )
		return;

		$not_link = $fv;

		$src = &$this->lists->data['filters'][ $subindex ][ $index ];

		$init_nabor = array();
		foreach( $src['vars'] as $var_name => $var_info )
		if( $this->chpu )
			if( isset($var_info['slash']) )
				$init_nabor[ $var_name ] = array( &$fv[$var_name], $not_link[$var_name], $var_info['slash'] );
			else
				$init_nabor[ $var_name ] = array( &$fv[$var_name], $not_link[$var_name], false );
		else
			$init_nabor[ $var_name ] = array( &$fv[$var_name], $not_link[$var_name] );

		$this->init( $init_nabor );
	}

	function init_defaultVars( &$filter_vars, $index, $subindex = 'site' ) {

		if( !isset($this->lists->data['filters'][ $subindex ][ $index ]) )
		return $filter_vars;

		$src = &$this->lists->data['filters'][ $subindex ][ $index ];

		foreach( $src['vars'] as $var_name => $var_info ) {

			$default_value = '';

			switch( $var_info['type'] ) {

				case 'first':

					if( isset($var_info['array_pointer']) )
						$default_value = $this->lists->first( $var_info['array_pointer'] );
					else
						$default_value = $this->lists->first( $src[$var_name] );
				break;

				case 'value':
				$default_value = $var_info['value'];
				break;

			}

			$filter_vars[ $var_name ] = $default_value;

		}
	}

	var $sort_keys	= array();
	var $sort_vals_init = array(
		'href'		=> '',
		'title'		=> '',
		'img'		=> '',
		'by_name'	=> '',
		'by_type'	=> ''
	);

	var $desc_index = 'desc';
	function init_sort( $params, $desc_index = 'desc' ) {
		$this->sort_keys 	= $params;
		$this->sort_vals 	= $this->sort_vals_init;
		$this->desc_index	= $desc_index;
		$this->engine->template->assignByRef( 'sort', $this->sort_vals );
	}

	function init_paginator( &$fv, $rubrik_index, $module_index='lk' ) {

		if( isset($_GET['page']) )
		$fv[ 'page' ] = filter( $_GET['page'] );

		if(	isset($_GET['on_page'])	&&
			$this->lists->exists_filter( $_GET['on_page'], 'on_page', $rubrik_index, $module_index )
		)	$fv[ 'on_page' ] = $_GET[ 'on_page' ];

		if(	isset($_GET['desc']) )
		$fv[ 'desc' ] = filter( $_GET['desc'] );

		if( isset($_GET['sort'])	&&
			$this->lists->exists_filter(
				$_GET['sort'] .'-'. ($fv['desc']?'desc':'asc'),
				'sort',
				$rubrik_index,
				$module_index
			)
		)	$fv[ 'sort' ] = $_GET[ 'sort' ];
	}

	function order(){
		$index = $this->val('sort') .'-'. ( $this->val($this->desc_index) ? 'desc' : 'asc' );

		if( isset($this->sort_keys[ $index ]) )
			return $this->sort_keys[ $index ];
		else
			return $this->engine->lists->first( $this->sort_keys, false );
	}

	function get()	{
		// значения для всех непереданных методу параметров ставятся в текущие значения

		$this->arg_filter = array();

		$arg_list = func_get_args();
		$count = count( $arg_list );

		for($i = 0;$i < $count;)
		$this->arg_filter[ $arg_list[$i++] ] = $arg_list[ $i++ ];

		return $this->_apply();
	}

	var $arg_filter_invert = array();
	function get_default()	{
		// значения для всех непереданных методу параметров ставятся в значения по умолчанию

		$arg_list  = func_get_args();
		$arg_count = count( $arg_list );

		$this->arg_filter = array();
		$this->arg_filter_invert = array();

		for( $i = 0;$i < $arg_count; )
		$this->arg_filter_invert[ $arg_list[$i++] ]=$arg_list[ $i++ ];


		foreach( $this->vars as $conf_index => $data )
			if( isset($this->arg_filter_invert[$conf_index]) )
				$this->arg_filter[ $conf_index ] = $this->arg_filter_invert[ $conf_index ];
			else
				$this->arg_filter[ $conf_index ] = $data[ 1 ];

		return $this->_apply();
	}

	function get_block() {

		$buffer = '';

		$args	= func_get_arg();
		$count	= count( $args );

		for( $i = 0; $i < $count;$i++ )
		$this->block( $args[$i] );

		$buffer = $this->get();

		for( $i = 0; $i < $count; $i++ )
		$this->block( $args[$i], false );

		return $buffer;
	}

	function _apply()	{
		$return = array();

		if( $this->chpu ) {

			// emptyDefaultVals

			foreach( $this->vars as $conf_index => $data )
			// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			// Issue #1
			if(
				$this->emptyDefaultVals	&&

				(
					isset( $this->arg_filter[$conf_index] )		AND

					$this->arg_filter[$conf_index] == $data[1]

				)	OR	(
					!isset( $this->arg_filter[$conf_index] )	AND
					$data[0] == $data[1]
				)
			) {
				continue;
			// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

			} else {

				if( empty($this->filter_blocked[$conf_index]) )
					$return[] =
						$conf_index .($data[2]?'/':'').
						( isset($this->arg_filter[$conf_index]) ? $this->arg_filter[$conf_index] : $data[0] )
					;
				else;

			}


			return implode( '/', $return );


		} else {

			foreach( $this->vars as $conf_index => $data )
			// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			// Issue #1
			if(
				$this->emptyDefaultVals	&&

				(
					isset( $this->arg_filter[$conf_index] )		AND

					$this->arg_filter[$conf_index] == $data[1]

				)	OR	(
					!isset( $this->arg_filter[$conf_index] )	AND
					$data[0] == $data[1]
				)
			) {
				continue;
			// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

			} else {
				if( empty($this->filter_blocked[$conf_index]) )
					$return[] =
						$conf_index .'='.
						( isset($this->arg_filter[$conf_index]) ? $this->arg_filter[$conf_index] : $data[0] )
					;
				else;
			}

			return implode( '&', $return );

		}
	}

	function tpl_get( $params ){
		if( !isset($params['vals']) ) return $this->get();

		$exploded = explode( ';', $params['vals'] );
		$count = count( $exploded );

		return call_user_func_array(array(&$this,'get'), $exploded);

	}

	function tpl_get_default( $params ) {

		if( !isset($params['vals']) ) return $this->get_default();

		$exploded = explode( ';', $params['vals'] );
		$count = count( $exploded );

		return call_user_func_array(array(&$this,'get_default'), $exploded);

	}

	var $sort_types = array(
		'asc'	=> 'по возрастанию',
		'desc'	=> 'по убыванию'
	);
	var $sort_last_link = '';
	function tpl_sort( $params ){

		if(	!isset($params['name'])		||
			!isset($params['title'])	||
			!isset($params['by'])
		)	return '';


		if( $this->engine->module_name == 'lk' )
			$tpl = 'lk/incl/sort-default.tpl';
		else
			if( isset($params['tpl']) )
				$tpl = $params[ 'tpl' ];
			else
				$tpl = 'incl/sort-default.tpl';

		if( $this->val('sort') == $params['name'] ){

			// sort is by current column
			$this->sort_vals[ 'by_type' ] = $this->sort_types[
				$this->val($this->desc_index) ? 'asc' : 'desc'
			];

			$this->sort_vals[ 'href' ] =
				$this->sort_last_link.
				$this->get( 'sort', $params['name'], $this->desc_index, $this->val($this->desc_index) ? '0' : '1' )
			;

			if( $this->engine->module_name == 'lk' ) {
				$this->sort_vals[ 'img' ] =
					URI.
					'/assets/images/lk/sort_'.
					( $this->val($this->desc_index) ? 'down' : 'up' ).
					'.gif'
				;
			} else {
				$this->sort_vals['img'] = '';
			}

		} else {
			// just column to select sort
			$this->sort_vals['by_type']	= $this->sort_types[ $this->desc_index ];

			$this->sort_vals['href']	=
				$this->sort_last_link.
				$this->get( 'sort', $params['name'], $this->desc_index, '1' )
			;

			$this->sort_vals[ 'img' ] = '';
		}

		$this->sort_vals[ 'title' ]		= $params['title'];
		$this->sort_vals[ 'by_name' ]	= $params[ 'by' ];

		return $this->engine->template->fetch( $tpl );

	}

	function val( $name, $default = false ) {

		$index = $default ? 1 : 0;

		if( isset($this->vars[$name]) )
			return $this->vars[ $name ][ $index ];
		else
			return '';

	}

	function set_url( $url ) {
		$this->sort_last_link = $url;
	}

	function set_var( $name, $value, $third = null ){

		if( isset($this->vars[$name]) )
			if( $third == null )
				$this->vars[ $name ][ 0 ] = $value;
			else {
				$this->vars[ $name ][ 0 ] = $value;
				$this->vars[ $name ][ 1 ] = $third;
			}
		else
			if( $third == null )
				$this->vars[ $name ] = array( $value, $value );
			else
				$this->vars[ $name ] = array( $value, $third );
	}

	function block( $index, $val = true ){ $this->filter_blocked[ $index ] = $val; }
	function add( $index, $vals ) { $this->vars[ $index ] = $vals; }

}

?>
