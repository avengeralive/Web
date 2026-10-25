<?php
########################################################
#	system.lists.php
#
#	Различные структурированные данные, которые
#	находятся как в БД, так и в виде массивов
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
class SYSTEM_lists	{

	var $lists_std	=	array();
	var $lists_db	=	array();
	var $lists_ndb	=	array();
	var $lists_tree	=	array();
	var $lists_sys	=	array();
	var $lists		=	array();

	function _init( $static = false ) {

		include_constants( 'modules' );
		include_constants( 'static' );
		include_constants( 'filters' );
		include_constants( 'users' );
		include_constants( 'casting' );
		include_constants( 'db' );
		include_constants( 'timezones' );
		include_constants( 'lambda' );

		global $LISTS, $mysqli;
		$this->data = &$LISTS;
		$this->mysqli = &$mysqli;

		init_interfaces( $this, $static, array('logs') );

		$this->assoc	=	array();

		foreach( $this->data as $index => $params )
		{
			if( isset($params['is_system']) && $params['is_system'] )	{
				$this->lists_sys[ $index ] = 1;
				continue;
			}

			if( isset($params['is_std']) && $params['is_std'] )
				$this->lists_std[ $index ] = 1;

			if( isset($params['is_db']) && $params['is_db'] )
				$this->lists_db[ $index ] = 1;
			else
			{
				$this->lists_ndb[ $index ] = 1;

				if( isset($this->data[$index]['data']) )
					$this->data[$index]['dcount'] = count( $this->data[$index]['data'] );
				else
					$this->data[$index]['dcount'] = 0;

				if( isset($params['need_assoc']) && $params['need_assoc'] ) {
					if( isset($params['assoc_list']) )
						$assoc_list = &$params['assoc_list'];
					else
						if( isset($params['data']) )
							$assoc_list = array( 'data' );
						else;

					if( !empty($assoc_list) )
					foreach( $assoc_list as $assoc_index )
					foreach( $this->data[$index][$assoc_index] as $ind => $value )
					$this->assoc[$index][$assoc_index][$value] = $ind;

				}

				$this->data[ $index ][ 'search' ] = @implode( ";", $this->data[$index]['data'] );
			}

			if( isset($params['is_tree']) && $params['is_tree'] )
				$this->lists_tree[ $index ] = 1;
		}

	}

	var $db_data_inited = array();
	function init_db_data( $index, $from_cache = 1 ) {
		if( isset($this->db_data_inited[$index]) && $from_cache ) return;

		if( isset($this->lists_tree[$index]) )
		{
			// для дерева другой обработчик
			$this->generate_tree( $index );
			$this->data[ $index ][ 'data' ] = $this->tree;
		} else {
			// обработчик для линейного списка
			// sqlite
			/*$q = $mysqli->query( 'SELECT `id`, `value` FROM `'. $this->data[$index]['table'] .'` ORDER BY `order`' );
			while( $res = $q->fetch_assoc() )
			$this->data[ $index ][ 'data' ][ $res['value'] ] = $res['id'];*/

			$q->free();
		}

		$this->db_data_inited[ $index ] = 1;
	}


	var $tree_no_hidden = 0;
	var $rows_add = "";
	function generate_tree( $index, $no_hidden = 1, $rows_add='' )	{
		$this->rows_add = $rows_add;

		$this->info = array();
		$this->roots = array();

		// generate tree type lists from static data
		if( isset($this->lists_ndb[$index]) )
		{
			$this->tree = array();
			$this->tree_rcount = $this->data[ $index ]['dcount'];
			for($i = 1;$i < $this->tree_rcount;$i++)
				$this->tree[] = array(
					'info'	=> array(
						'id'		=>	$i,
						'hidden'	=>	0,
						'root'		=>	0,
						'is_folder'	=>	0,
						'value'		=>	$this->data[ $index ][ 'data' ][$i]
					)
				);
			return;
		}

		// generate tree type lists from linear data
		if( isset($this->lists_db[$index]) && !isset($this->lists_tree[$index]) )
		{
			$row_value = isset($this->data[$index]['value_row']) ? $this->data[$index]['value_row'] : 'value';

			$this->tree = array();
			// sqlite
			/*$q = $mysqli->query( 'SELECT `id`,`hidden`,`'.$row_value.'` as `value` FROM `'.$this->data[$index]['table']."`".($no_hidden?' WHERE `hidden`=0':'')." ORDER BY `order`" );
			$i = 0;
			while( $res = $q->fetch_assoc() )
				$this->tree[] = array(
					'info'	=> array(
						'id'		=>	$res['id'],
						'hidden'	=>	$res['hidden'],
						'root'		=>	0,
						'is_folder'	=>	0,
						'value'		=>	$res['value']
					)
				);
			$q->free();*/
			$this->tree_rcount = count( $this->tree );
			return;
		}
		////////////////////////////////////////////////////////////////

		if( isset($this->tree) ) unset( $this->tree );
		$this->index = $index;
		$this->tree_no_hidden = $no_hidden;

		$cfg = $this->data['db'][$index];

		if( isset($cfg['rows']) )
			$rows = $cfg['rows'];
		else
			$rows = array();

		$rows += array(
			'id'		=> '`id`',
			'root'		=> '`root`',
			'hidden'	=> '`hidden`',
			'disabled'	=> '`disabled`',
			'value'		=> '`value`',
			'order'		=> '`order`',
			'is_folder'	=> '`is_folder`'
		);

		foreach( $this->roots as $rootID => $contents )
			$this->roots[ $rootID ] = $contents['folders'] + $contents['files'];


		if( isset($_GET['format']) && $_GET['format']=="dynatree" ) {
			$this->tree = $this->generate_tree_vetkaDyna();
			echo_gz( $this->tree );
		} else {
			if( isset($cfg['dyna']) && !empty($cfg['dyna']) )
				$this->tree = $this->generate_tree_vetkaDyna();
			else
				$this->tree = $this->generate_tree_vetka();
		}

		$this->tree_rcount = count( $this->tree );

	}

	function generate_tree_vetka( $rootID=0 )	{

		$return = array();

		if( !isset($this->roots[$rootID]) ) return $return;

		$i = 0;
		foreach( $this->roots[$rootID] as $id => $fff )
		{
			$return[ $i ][ 'info' ] = $this->info[ $id ];
			if( $this->info[$id]['is_folder'] ) $return[ $i ][ 'childs' ] = $this->generate_tree_vetka( $id );
			$i++;
		}

		return $return;
	}

	function generate_tree_vetkaDyna( $rootID=0, $rootIsHidden=0 )	{
		$return = array();

		if( !isset($this->roots[$rootID]) ) return $return;

		$i = 0;
		foreach( $this->roots[$rootID] as $id => $fff )
		{
			$return[ $i ][ 'key' ]		= $id;
			$return[ $i ][ 'title' ]	= $this->info[ $id ]['value'];
			$return[ $i ][ 'info' ]		= $this->info[ $id ];

			if( $rootIsHidden )
				$this->info[$id]['hidden'] = 1;

			if( $this->info[$id]['hidden'] )
				$return[ $i ][ 'addClass' ] = "node_hided";

			if( $this->info[$id]['is_folder'] )
			{
				$return[ $i ][ 'isFolder' ] = true;
				$return[ $i ][ 'children' ] = $this->generate_tree_vetkaDyna( $id, $this->info[$id]['hidden'] );
			}
			$i++;
		}

		return $return;
	}

	function val( $index, $metka, $third = null ) {

		$from_assoc = false;
		$data_index = 'data';

		if( gettype($metka) == 'array' )
			if( isset($metka[$index]) )
				return $metka[ $index ];
			else
				return '';
		else;

		if( $third != null )
		switch( gettype($third) ){

			case 'string':
			$data_index = $third;
			break;

			case 'boolean':
			$from_assoc = $third;
			break;

			case 'array':
			$data_index = $third[0];
			$from_assoc	= $third[1];
			break;

		}

		$select_var = $from_assoc ? 'assoc' : 'data';

		if(
			isset($this->{$select_var}[$metka][$data_index])	&&
			isset($this->{$select_var}[$metka][$data_index][ $index ])
		)
			return $this->{ $select_var }[ $metka ][ $data_index ][ $index ];
		else
			return '';
	}

	function exists( $index, $metka, $third = null ) {

		$from_assoc = false;
		$data_index = 'data';

		if( $third != null )
		switch( gettype($third) ){

			case 'string':
			$data_index = $third;
			break;

			case 'boolean':
			$from_assoc = $third;
			break;

			case 'array':
			$data_index = $third[0];
			$from_assoc	= $third[1];
			break;

		}

		$select_var = $from_assoc ? 'assoc' : 'data';
		if(
			isset($this->{$select_var}[$metka][$data_index])	&&
			isset($this->{$select_var}[$metka][$data_index][ $index ])
		)
			return true;
		else
			return false;
	}

	function exists_filter( $test_index, $filter_index, $module_index, $group_index ) {

		return isset(
			$this->data
				[ 'filters' ]
				[ $group_index ]		// like "lk" / "site"
				[ $module_index ]		// like "companies"
				[ $filter_index ]		// like "show" / "sort" / "on_page"
				[ $test_index ]			// like "published"
		);
	}


	function first( $index, $second = null ){

		$return_key	= true;

		if( !is_array($index) ) {
			$arr_key = 'data';

			if( $second !== null )
				if( $second === false )
					$return_key = false;
				else
					if( $second === true )
						$return_key = true;
					else
						$arr_key = $second;
			else;

			$array = &$this->data[ $index ][ $arr_key ];
		} else {
			$array = &$index;

			if( $second !== null )
				if( $second === false )
					$return_key = false;
				else
					if( $second === true )
						$return_key = true;
					else;
			else;
		}


		foreach( $array as $key => $value ){
			reset( $array );
			if( $return_key )
				return $key;
			else
				return $value;
		}
	}

	function get_img( $index )	{
		if( isset($this->data[$index]['img']) ) return $this->data[$index]['img'];
		else return 'no-image';
	}

	function get_comment( $index )	{
		if( isset($this->data[$index]['comment']) ) return $this->data[$index]['comment'];
		return '';
	}

	function update_db_struct( $dry = false ) {

		$this->dry = $dry;
		$this->tables_info = array();
		$this->tables_indexes = array();

		// формируем существующие таблицы
		$q = $this->mysqli->query( 'SHOW TABLES' );
		while( @list($tbl_name) = $q->fetch_row() ) {
			$this->tables_info[ $tbl_name ] = array();
		}
		$q->free();

		// формируем текущую структуру нужных таблиц
		foreach( $this->tables_info as $tbl_name => $tbl_cols ) {

			$q = $this->mysqli->query( 'SHOW CREATE TABLE '.$tbl_name );
			while( $item = $q->fetch_row() ) {
				$create_query = $item[1];

				// формируем список существующих колонок
				$cols = explode( "\n", $create_query );
				$cols = preg_split( "/\n/", $create_query, -1, PREG_SPLIT_NO_EMPTY);

				// обрабатываем колонки
				if( !empty($cols) ) {
					$count = count( $cols );

					for( $i = 1;$i < $count-1;$i++ ) {  // 0: create table, -1: engine=myisam и т.д., поэтому первую и последнюю строчки пропускаем

						// если последний символ - запятая, то удаляем его
						if( $cols[$i][ strlen($cols[$i])-1 ] == ',' ) {
							$cols[ $i ] = substr( $cols[$i], 0, strlen($cols[$i])-1 );
						}

						// фикс, когда в имени индекса/колонки присутствуют пробелы
						$cols[$i] = preg_replace_callback( '#`([0-9A-z]*)([\s]*)([0-9A-z]*)`#si', 'preg_replace_col_spaces', $cols[$i] );

						$col_splitted = preg_split('/ /', $cols[$i], -1, PREG_SPLIT_NO_EMPTY);
						$col_splitted_count = count( $col_splitted );

						// проверка на то, что текущая строчка не колонка, а индекс
						if( strtolower($col_splitted[0]) == 'key' || strtolower($col_splitted[1]) == 'key' ) {
							// индексы в текущей версии скрипта нам не нужны

							$tbl_cur_index = array();
							$key_type = '';
							$key_name = '';
							$key_cols = '';
							if( strtolower( $col_splitted[0] ) == 'key' ) {
								if( count( $col_splitted ) >= 3 ) {
									$key_name = $col_splitted[1];
									$key_cols = $col_splitted[2];
								} else {
									$key_cols = $col_splitted[1];
								}
							} else {
								$key_type = $col_splitted[0];

								if( count( $col_splitted ) >= 4 ) {
									$key_name = $col_splitted[2];
									$key_cols = $col_splitted[3];
								} else {
									$key_cols = $col_splitted[2];
								}
							}

							if( strtolower($key_type) == 'primary' )
							$key_name = 'PRIMARY';

							$key_name = str_replace( array('[',']','"','`'), '', $key_name );

							$tbl_cur_index['type'] = $key_type;
							$tbl_cur_index['cols'] = $key_cols;
							$this->tables_indexes[ $tbl_name ][ $key_name ] = $tbl_cur_index;

						} else {

							// первый элемент - название колонки, остальные - ее характеристики
							$col_name =	str_replace( array('[',']','"','`'), '', $col_splitted[0] );

							if( $col_name != "" ) {
								$col_info = "";
								for( $j = 1;$j < $col_splitted_count;$j++ ) {
									if( $j != 1 )
									$col_info .= " ";

									$col_info .= $col_splitted[$j];
								}

								$this->tables_info[$tbl_name][ $col_name ] = $col_info;
							}
						}

					}

				}
			}
			$q->free();
		}

		// проверка таблиц на удаление - таблицы, неописанные
		// в JSON-массиве db_struct будут удалены (при соответствующей включенной опции UPDATE_STRUCT_DROP_TABLE_ENABLED)
		foreach( $this->tables_info as $tbl_name => $tbl_info )
		if( !isset($this->data['db']['struct'][$tbl_name]) ) {
			if( UPDATE_STRUCT_DROP_TABLE_ENABLED ) {
				$this->logs->add( 'Dropping table "'.$tbl_name.'"' );
				$this->update_db_struct_query( 'DROP TABLE `'.$tbl_name.'`' );

				if( $this->mysqli->errno ) {
					$this->log_error( 'Произошла ошибка при удалении таблицы "'.$tbl_name.'": '.$this->mysqli->error );
				}
			} else {
				$this->logs->add( 'Существующая таблица "'.$tbl_name.'" не описана в структуре $LISTS[\'db\'][\'struct\']! Для включения настройки автоматического удаления таблиц вне структуры используйте константу "UPDATE_STRUCT_DROP_TABLE_ENABLED"' );
			}
		}

		// обработка колонок и добавление отсутствующих таблиц
		foreach( $this->data['db']['struct'] as $tbl_name => $tbl_cols ) {

			if( !isset($this->tables_info[$tbl_name]) ) {

				// формируем колонки
				$new_table_counter = 0;
				$new_table_rows = '';
				foreach( $tbl_cols as $col_name => $col_val ) {
					if( $new_table_counter++ != 0 ) {
						$new_table_rows .= ",\n";
					}

					$new_table_rows .= '`'.$col_name.'` '.$col_val;
				}

				// формируем индексы
				if( isset($this->data['db']['indexes'][$tbl_name]) ) {
					foreach( $this->data['db']['indexes'][$tbl_name] as $index_name => $index_info ) {
						$new_table_rows .= ",\n";

						if( $index_info['type'] != '' ) {
							$new_table_rows .= $index_info['type'].' ';
						}

						if( $index_info['type'] == 'PRIMARY' )
						$index_name = "";

						$new_table_rows .= 'KEY '.$index_name.' '.$index_info['cols'];
					}
				}

				$this->logs->add( 'Add table '.$tbl_name );
				$this->update_db_struct_query( 'CREATE TABLE '.$tbl_name.' ('.$new_table_rows.")\nENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0" );

				if( $this->mysqli->errno ) {
					$this->logs->add_err( 'Произошла ошибка при добавлении таблицы "'.$tbl_name.'": '.$this->mysqli->error );
				}

			} else {

				// добавляем/изменяем отсутствующие колонки
				$add_after_col_name = '';
				foreach( $tbl_cols as $col_name => $col_info ) {
					if( !isset($this->tables_info[$tbl_name][$col_name]) ) {

						// добавляем новую колонку
						$this->logs->add( 'добавляем в таблицу "'.$tbl_name.'" новый столбец `'.$col_name.'` '.$col_info );
						$q_text = "ALTER TABLE `".$tbl_name."` ADD `".$col_name."` ".$col_info;


						if( $add_after_col_name != "" )
						$q_text .= " AFTER `".$add_after_col_name."`";

						$this->update_db_struct_query( $q_text );

						if( $this->mysqli->errno ) {
							$this->logs->add_err( 'Произошла ошибка при добавлении столбца "'.$col_name.'": '.$this->mysqli->error );
						}

					} else {

						// проверяем колонку на обновление формата
						if( strtolower($this->tables_info[$tbl_name][$col_name]) != strtolower($col_info) ) {

							$this->logs->add( 'обновляем в таблице "'.$tbl_name.'" столбец `'.$col_name.'` с '.$this->tables_info[$tbl_name][$col_name].' на '.$col_info );
							$this->update_db_struct_query("ALTER TABLE `".$tbl_name."` CHANGE `".$col_name."` `".$col_name."` ".$col_info);

							if( $this->mysqli->errno ) {
								$this->logs->add_err( 'Произошла ошибка при обновлении столбца "'.$col_name.'": '.$this->mysqli->error );
							}
						}

					}

					$add_after_col_name = $col_name;
				}

				// удаляем старые колонки
				foreach( $this->tables_info[$tbl_name] as $col_name => $col_value )
				if( !isset($tbl_cols[$col_name]) ){

					if( UPDATE_STRUCT_DROP_COLUMN_ENABLED ) {
						$this->logs->add( 'удаляем в таблице "'.$tbl_name.'" столбец `'.$col_name.'`' );
						$this->update_db_struct_query("ALTER TABLE `".$tbl_name."` DROP `".$col_name."`" );

						if( $this->mysqli->errno ) {
							$this->logs->add_err( 'Произошла ошибка при удалении столбца "'.$col_name.'" в таблице "'.$tbl_name.'": '.$this->mysqli->error );
						}
					} else {

						$this->logs->add( 'Существующая колонка "'.$col_name.'" не описана в структуре $LISTS[\'db\'][\'struct\']! Для включения настройки автоматического удаления колонок вне структуры используйте константу "UPDATE_STRUCT_DROP_COLUMN_ENABLED"' );
					}
				}
			}

		}

		// добавляем новые индексы (проверка по имени индекса)
		foreach( $this->data['db']['indexes'] as $tbl_name => $indexes ) {

			// если таблица была добавлена в текущей сессии, с индексами ничего не делаем,
			// т.к. они были добавлени при создании таблицы
			if( !isset($this->tables_info[$tbl_name]) )
			continue;

			foreach( $indexes as $index_name => $index_info ) {
				if( !isset($this->tables_indexes[$tbl_name][$index_name]) ) {
					$this->logs->add( 'Add index "'.$index_name.'" for table "'.$tbl_name.'"' );
					$this->update_db_struct_query( 'ALTER TABLE `'.$tbl_name.'` ADD '.$index_info['type'].' INDEX `'.$index_name.'` '.$index_info['cols'] );

					if( $this->mysqli->errno ) {
						$this->logs->add_err( 'Произошла ошибка при добавлении индекса "'.$index_name.'" в таблицу "'.$tbl_name.'": '.$this->mysqli->error );
					}
				}
			}
		}

		// удаляем старые индексы (проверка по имени индекса)
		foreach( $this->tables_indexes as $tbl_name => $indexes ){

			// если таблица была добавлена в текущей сессии, с индексами ничего не делаем,
			// т.к. они были добавлени при создании таблицы
			if( !isset($this->tables_info[$tbl_name]) )
			continue;

			foreach( $indexes as $index_name => $index_info ) {
				if( !isset($this->data['db']['indexes'][$tbl_name][$index_name]) ) {
					$this->logs->add( 'Drop index "'.$index_name.'" for table "'.$tbl_name.'"' );
					$this->update_db_struct_query( 'ALTER TABLE `'.$tbl_name.'` DROP INDEX `'.$index_name.'`' );

					if( $this->mysqli->errno ) {
						$this->logs->add( 'Произошла ошибка при удалении индекса "'.$index_name.'" из таблицы "'.$tbl_name.'": '.$this->mysqli->error );
					}
				}
			}
		}

	}

	function update_db_struct_query( $query ) {
		if( $this->dry ) {
			pr( $query );
		} else {
			$this->mysqli->query( $query );
		}
	}

	// данный метод позволяет автоматически сгенерировать строку
	// с массивом на основе текущей структуры, чтобы не забивать
	// вручную массивы структуры базы данных
	// $GLOBALS['LISTS']['db']['struct'] и $GLOBALS['LISTS']['db']['indexes']
	function update_db_struct_form_list_array() {

		// формируем актуальные данные
		$this->update_db_struct( true/*без изменений в базе данных*/ );

		$t = '	';
		echo '<pre>';
		echo "\n$t$t'struct' => array(\n";
		foreach( $this->tables_info as $table_name => $cols ) {
			echo "$t$t$t'$table_name' => array(\n";
			foreach( $cols as $col_name => $col_define ) {
				echo "$t$t$t$t'$col_name' => '".str_replace("'",'\\\'',$col_define)."',\n";
			}
			echo "$t$t$t),\n";
		}
		echo "$t$t),\n";

		echo "$t$t'indexes' => array(\n";
		foreach( $this->tables_indexes as $table_name => $indexes ) {
			echo "$t$t$t'$table_name' => array(\n";
			foreach( $indexes as $index_name => $index_defines ) {
				echo "$t$t$t$t'$index_name' => array(\n";
				foreach( $index_defines as $define_name => $define_value ) {
					echo "$t$t$t$t$t'$define_name' => '".str_replace("'",'\\\'',$define_value)."',\n";
				}
				echo "$t$t$t$t),\n";
			}
			echo "$t$t$t),\n";
		}
		echo "$t$t)\n";
		echo '</pre>';

		// pr( $this->tables_info );
		// pr( $this->tables_indexes );

	}
}
?>
