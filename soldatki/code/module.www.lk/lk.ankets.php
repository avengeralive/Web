<?php
########################################################
#	lk.ankets.php
#
#	Модуль "Анкеты"
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class MODULE_ankets {

	var $ACT = '';
	var $id = '0';
	function _init()	{
		$this->root->prepare_module( $this );
        $this->template->js_libs[] = 'jquery';
        $this->template->js_libs[] = 'jquery.helpers';
        $this->template->js_libs[] = 'materialize.min';
        $this->template->js_libs[] = 'moment.min';
        $this->template->js_libs[] = 'SimpleAjaxUploader';

    }

	function _start()	{
		$this->root->run_submodule();
	}

	function listing() {

		$this->template->css_f[] = 'jquery.swipebox';
		$this->template->js_libs[] = 'jquery.swipebox';


		$this->template->css_f[] = 'simplemodal';
		$this->template->js_libs[] = 'jquery.simplemodal';

		$this->tpl_file = 'lk/ankets-list.tpl';
		$this->listing_initFilters();
		$this->listing_checkActions();
		$this->listing_formData();
	}

	function listing_initFilters() {

		$this->filter = &$this->engine->filter;

		// init filter
		$this->filter_vars = array();
		$this->filter->init_defaultVars( $this->filter_vars, 'ankets','lk');
		$this->filter->init_auto( $this->filter_vars, 'ankets', 'lk' );
		$this->filter->init_sort( $this->lists->data['filters']['lk']['ankets']['sort'] );
		$this->filter->set_url( '?' );

		$fv = &$this->filter_vars;
		$this->template->assignByRef( 'filter_vars', $this->filter_vars );

		#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		#		parse $_GET to set current filter vars				~
		#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		#
			$this->filter->init_paginator( $this->filter_vars, 'ankets', 'lk' );

			if( isset($_GET['status']) &&
				!empty($_GET['status'])	&&
				$this->lists->exists( $_GET['status'], 'ankets', 'statuses' )
			){
				$fv['status'] = $_GET['status'];

				$this->sql_add .= ' AND `items`.`status` = "'. $fv['status'] .'"';
			}

			if( isset($_GET['rating']) ){
				$fv['rating'] = filter( $_GET['rating'], MASK_FLOAT );

				if( $fv['rating'] != '' && $fv['rating'] >= 0 ) {
					$this->sql_add .= ' AND `items`.`rating` = '. $fv['rating'];
				} else {
					$fv['rating'] = '-1';
				}
			}

			if( isset($_GET['id']) &&
				!empty($_GET['id'])
			){
				$fv['id'] = filter( $_GET['id'] );

				if( !empty($fv['id']) )
				$this->sql_add .= ' AND `items`.`id` = '. $fv['id'];
			}

			if( isset($_GET['text']) &&
				!empty($_GET['text'])
			){
				$fv['text'] = filter( $_GET['text'], MASK_TEXT );

				if( !empty($fv['text']) )
				$this->sql_add .= '
					AND (
						`items`.`first_name` LIKE \'%'. $fv['text'] .'%\' OR
						`items`.`last_name` LIKE \'%'. $fv['text'] .'%\' OR
						`items`.`email` LIKE \'%'. $fv['text'] .'%\'
					)
				';
			}
		#
		#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	}

	function listing_checkActions() {

		/////////////////////////////////////////////////
		// мультидействия с массивом ID
		$ids = array();
		if(
			isset( $_GET['ids'] ) &&
			gettype( $_GET['ids'] ) == 'array'
		)
			foreach( $_GET['ids'] as $id ) {
				filter_ref( $id );
				if( !empty($id) )
				$ids[] = $id;
			}

		if( empty($ids) )
		return;

		$imploded = implode( ',', $ids );

		if( isset($_GET['delete']) && ($this->rights->allow('lk-ankets-moderate') || $this->rights->allow('lk-ankets-delete'))) {
			$this->ankets->delete( $ids );
			$this->notices[] = 'выбранные анкеты удалены';
		}

		if(
			isset($_GET['change_status']) &&
			($this->rights->allow('lk-ankets-moderate') || $this->rights->allow('lk-ankets-edit') ) &&
			isset($_GET['new_status']) &&
			$this->lists->exists( $_GET['new_status'], 'ankets', 'statuses' )
		) {

			$this->mysqli->query('

				UPDATE	`data_ankets`
				SET		`status` = "'. $_GET['new_status'] .'"
				WHERE	`id` IN ('.$imploded.')'

			);

			if( $this->mysqli->affected_rows != -1 ) {
				$this->notices[] = 'статус выбранных анкет обновлен';
			}
		}

	}

	var $sql_add = '';
	var $rows_count = 0;
	var $pages = 1;
	function listing_formData() {

		$fv = &$this->filter_vars;

		$this->rows_count = mysql_row('

			SELECT	COUNT(*)
			FROM	`data_ankets` as `items`
			WHERE	1'. $this->sql_add

		);
		$this->template->assignByRef( 'rows_count', $this->rows_count );


		// form pages
		if(
			$this->rows_count	&&
			$this->rows_count > $fv['on_page']	&&
			$fv['on_page']
		)	$this->pages = ceil( $this->rows_count / $fv['on_page'] );


		$limit_0 = ( $fv['page'] - 1 ) * $fv['on_page'];
		$limit_1 = $fv[ 'on_page' ];

		$q_text = '

			SELECT		*,
						`items`.`id` AS `id`,
						`items`.`id` AS `anket_id`,
						`file`.`id` AS `file_id`

			FROM		(SELECT * FROM `data_ankets` AS `items` WHERE 1'.$this->sql_add.' LIMIT '.$limit_0.','.$limit_1.' ORDER BY	'. $this->filter->order().') AS `items`

			LEFT JOIN   `data_ankets_files`  AS `file`
			ON			`items`.`id` = `file`.`anket_id`

			LEFT JOIN	`data_ankets_files_conv` AS `conv`
			ON			`file`.`id` = `conv`.`file_id`

			ORDER BY	'. $this->filter->order()

		;
		 pr( $q_text );

		$q = $this->mysqli->query( $q_text );
		$items = array();
		$items_by_id = array();
		while( $item = $q->fetch_assoc() ){

			if( !empty($fv['text']) )
			replace_searchs(
				array( 'first_name', 'last_name', 'email' ),
				$item,
				$fv['text']
			);

			if( !isset($items_by_id[$item['anket_id']]) ) {
				$items_by_id[ $item['anket_id'] ] = array();
			}
			$items_by_id[ $item['anket_id'] ][] = $item;
		}
		$q->free();

		// подготавливаем ссылки на медиафайлы
		if( !empty($items_by_id) ) {
			foreach( $items_by_id as $anket_id => $anket_items ) {
				$items[] = $this->ankets->get_anket_info( $anket_id, $anket_items );
			}
		}
		// pr( $items );

		$this->template->assignByRef( 'items', $items );
		$this->template->assignByRef( 'pages', $this->pages );
	}


	function insertEditCommon() {

		include_constants( 'post.anket' );

		$this->template->include_tinymce = true;

		$this->root->form_referer();
		$this->tpl_file = 'lk/ankets-insert.tpl';

		$this->template->assignByRef( 'act',		$this->ACT );
		$this->template->assignByRef( 'edit',		$this->edit );

	}

	function insert() {

		if( !$this->rights->allow('lk-ankets-moderate') && !$this->rights->allow('lk-ankets-insert') )
		return;

		$this->lists->data['lk_modules'][$this->s]['ankets']['submenu']['insert'] = $this->lists->data['lk_modules'][$this->s]['ankets']['submenu_hidden']['insert'];

		$this->insertEditCommon();

		$this->edit	= false;
		$this->ACT	= 'insert';

		$this->insert_checkDo();
	}

	function insert_initInputs() {

		$this->template->cur_obj = array();
		if( $this->ACT == 'edit' || $this->ACT == 'edit-try' ){

			$this->edit_process_media_upload();
			$this->edit_process_media_delete();

			$this->template->cur_obj = $this->ankets->get_anket_info( $this->id );
		}

		// form inputs using std interface
		$this->template->ACT = &$this->ACT;
		$this->template->form_inputs( $GLOBALS['POST_ANKET'] );
		$this->inputs = &$this->template->inputs;
		$this->inputs['id'] = &$this->id;

		$this->template->assignByRef( 'inputs', 	$this->inputs );
		$this->template->assignByRef( 'cur_obj',	$this->template->cur_obj );

	}

	function insert_checkInputs() {
		$this->errors = $this->validate->anket( $this->inputs );

		return empty( $this->errors );
	}

	function insert_checkDo() {

		if( !isset($_POST['do']) )
		return $this->insert_initInputs();

		$this->ACT .= '-try';
		$this->insert_initInputs();

		if( $this->insert_checkInputs()) {
			$this->template->form_insertVals( $GLOBALS['POST_ANKET'] );
			$this->edit ? $this->edit_do() : $this->insert_do();
		}
	}

	function insert_do() {

		$v = &$this->template->vals;

		$v['date_created'] = mysql_unixToTimestamp( NOW );

		$rows = array();
		$vals_stmt = array();
		$vals = array();
		$types = '';
		foreach( $v as $row => $value ) {
			$rows[] = '`'. $row .'`';
			$vals_stmt[] = '?';
			$vals[] = &$v[$row];
			$types .= 's';
		}

		$sql = 'INSERT INTO `data_ankets` ('. implode(',',$rows) .') VALUES ('. implode(',',$vals_stmt) .')';
		// pr($sql);pr($vals);
		$stmt = $this->mysqli->prepare($sql);
		if($stmt !== false) {
			// добавляем в начало переменную с описанием типов добавляемых данных
			array_unshift( $vals, $types );

			// выполняем запрос добавления
			call_user_func_array(array($stmt, 'bind_param'), $vals);
			$stmt->execute();
			$stmt->close();

			if( !$this->mysqli->errno ) {
				$this->id = $this->mysqli->insert_id;

				if( empty($this->errors) ) {
					$this->edit_process_media_upload();

					$this->root->redirectOnInsert( $this->id );
				}

			} else {
				$this->errors[] = 'Произошла ошибка при добавлении записи: '.$this->mysqli->error;
			}
		} else {
			$this->errors[] = 'Произошла ошибка при добавлении записи: '.$this->mysqli->error;
		}

	}

	function edit() {

		$this->id = $this->gets->val( 'id-' );

		if( !$this->rights->allow('lk-ankets-moderate') && !$this->rights->allow('lk-ankets-edit') )
		return;

		$this->lists->data['lk_modules'][$this->s]['ankets']['submenu']['edit'] = $this->lists->data['lk_modules'][$this->s]['ankets']['submenu_hidden']['edit'];

		$this->insertEditCommon();

		$this->edit	= true;
		$this->ACT	= 'edit';

		if( empty($this->id) ) {
			$this->tpl_file = TPL_LK_404;
			return false;
		}

		$this->insert_checkDo();
	}


	function edit_do() {

		$v = &$this->template->vals;

		$vals_stmt = array();
		$vals = array();
		$types = '';
		foreach( $v as $row => $value ) {
			$vals_stmt[] = "`$row` = ?";
			$vals[] = &$v[$row];
			$types .= 's';
		}

		$types .= 's';
		$vals[] = &$this->id;

		$sql = 'UPDATE `data_ankets` SET '. implode(',',$vals_stmt) .' WHERE `id` = ?';

		$stmt = $this->mysqli->prepare($sql);
		if($stmt !== false) {
			// добавляем в начало переменную с описанием типов добавляемых данных
			array_unshift( $vals, $types );

			// выполняем запрос добавления
			call_user_func_array(array($stmt, 'bind_param'), $vals);
			$stmt->execute();
			$stmt->close();

			if( !$this->mysqli->errno ) {
				if( empty($this->errors) ) {

					$this->root->redirectOnEdit( $this->id );
				}

			} else {
				$this->errors[] = 'Произошла ошибка при редактировании записи: '. $this->mysqli->error;
			}
		} else {
			$this->errors[] = 'Произошла ошибка при редактировании записи: '. $this->mysqli->error;
		}

	}

	function edit_process_media_upload() {
		$this->ankets->id = &$this->id;
		$this->ankets->anket_process_media();
	}

	function edit_process_media_delete() {

		// удаляем старые файлы
		if( !empty($_POST['media_delete']) ) {
			$filesToDelete = json_decode( $_POST['media_delete'], true );
			if( $filesToDelete !== false && !empty($filesToDelete) ) {
				$ids_to_delete = array();
				foreach( $filesToDelete as $file_id => $true ) {
					$file_id = filter( $file_id );
					if( !empty($file_id) ) {
						$ids_to_delete[] = $file_id;
					}
				}

				if( !empty($ids_to_delete) ) {
					$this->ankets->delete_media( $ids_to_delete );
				}
			}
		}

	}

}
?>
