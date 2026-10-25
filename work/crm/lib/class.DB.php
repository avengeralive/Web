<?php
namespace lib;
if (!defined('VOCU_FWK')) die('не работает без нашего фреймверка'); // не работает без нашего фреймверка

/**
* class.JBase.php
*
*Класс - библиотека с функциями для для работы с Mysqli
*подгружается через автоподгрузку классов
*
* История:  2016.12.06 - файл создан
*
**/


class DB {
    public static $mysqli_pool = null;
    public static $last_error = '';
    public static $SqlID = '';

    function Query($sql) {

        self::getConnect();

        $result            = self::$mysqli_pool->query($sql);
        if ($result===false) self::$last_error = self::$mysqli_pool->error_list;
        self::$SqlID =  self::$mysqli_pool->insert_id;
        return $result;
    }
    
    public static function loadClassFrom($class,$action) {
        $a = new $class();
        return $a::$action();
    }
    
	function getConnect() {
		if( self::$mysqli_pool === null ) {
            self::$mysqli_pool = @new \mysqli(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASSWORD, MYSQL_DB);
            self::$mysqli_pool->set_charset("utf8");
        }
	}
	
    public static function close() {
        if( self::$mysqli_pool !== null )
        self::$mysqli_pool->close();

    }
    
    //возвращает шаблон сайта
    public static function template() {
        return self::Get_Field_Value_From_Domain('templates', 'templatename');
    }
    
    //получение данных по домену в таблице
    public static function Get_Field_Value_From_Domain($Table_Name, $field_Name) {
		
		$sql_end = self::Query("SELECT $field_Name FROM $Table_Name WHERE `domain` = '". DOMAIN ."'");
        if ($sql_end) {
            while ($Value = $sql_end->fetch_assoc()) {
                $guest = $Value[$field_Name];
                return $guest;
            }
        }
    }
    
	//забираем всю таблицу по шаблону
    public static function Get_Full_Table_From_Template($Table_Name) {
    	
		$QQ = "SELECT * FROM $Table_Name WHERE `template` = '". self::template() ."' AND `on` = '1'";
		//var_dump($QQ);
      return self::Query($QQ);
    }
    
    //
    public static function Get_Data($Table_Name, $select = '*', $where = null, $orderby = null) {
		if(is_array($select)) $select = implode(',', $select);
		$new_orderby = ($orderby) ? "ORDER BY " : NULL;
		if ($new_orderby) $new_orderby .= "`". $orderby."`";
		$new_where = '';
		
		if(is_array($where)){
			foreach($where as $key => $value) {
				if(is_array($value)) {
					$new_where .= $key." IN (".implode(",",$value).")";
				} else {
					$new_where .= "`". $key."`='".$value."' AND ";
				}
			}
			return self::Query("SELECT $select FROM `$Table_Name` WHERE $new_where `template` = '".self::template()."' $new_orderby");
		} else { 
      		return self::Query("SELECT $select FROM $Table_Name WHERE `template` = '".self::template()."' $new_orderby");
      	}
    }
    
    //
    public static function Update_Data($Table_Name, $set, $where = null){
		$new_where = '';
		$new_set = '';
		
		if(is_array($where)){
			foreach($where as $key => $value) {
				$new_where .= " AND `". $key."`='".$value."'";
			}
		} else $new_where .= $where;
		
		if(is_array($set)){
			foreach($set as $key => $value) {
				$new_set .= "`". $key."`='". $value ."', ";
			}
			$new_set = rtrim($new_set, ", ");
		} else $new_set .= $set;
		
		$QQ = "UPDATE $Table_Name SET $new_set WHERE `template` = '".self::template()."' $new_where ";	
		//var_dump($QQ);
		return self::Query($QQ);
	}
    
    public static function Set_Data($Table_Name, $List_Field, $List_Field_Value){
        $List_Field_str       = "`" . implode("`,`", $List_Field) . "`";
        $List_Field_Value_str = "'" . implode("','", $List_Field_Value) . "'";
        $QQ = "INSERT INTO $Table_Name ($List_Field_str) VALUES ($List_Field_Value_str)";
        //var_dump($QQ);
        return self::Query($QQ);
    }    
    
    
    
    //
    public static function Get_Data_ND($Table_Name, $select = '*', $where = null, $orderby = null) {
		if(is_array($select)) $select = implode(',', $select);
		$new_orderby = ($orderby) ? "ORDER BY " : NULL;
		if ($new_orderby) $new_orderby .= "`". $orderby."`";
		$new_where = '';
		
		if(is_array($where)){
			foreach($where as $key => $value) {
				if(is_array($value)) {
					$new_where .= $key." IN (".implode(",",$value).")";
				} else {
					$new_where .= "`". $key."`='".$value."' AND ";
				}
			}
			return self::Query("SELECT $select FROM `$Table_Name` WHERE $new_where `id` != 0 $new_orderby");
		} else { 
      		return self::Query("SELECT $select FROM $Table_Name $new_orderby");
      	}
    }
    
    
    
    
    
    
    
    
    
    
    public static function Get_Field_Value_From_Id($Table_Name, $id, $field_Name) {
        $id = (int)$id;
		
		$sql_end = self::Query("SELECT $field_Name FROM $Table_Name WHERE `id` = '$id' AND `domain` = '".self::template()."'");
        if ($sql_end) {
            while ($Value = $sql_end->fetch_assoc()) {
                $guest = $Value[$field_Name];
                return $guest;
            }
        }
    }
    public static function Get_Field_Value_From_Id_Nodomain($Table_Name, $id, $field_Name) {
        $id = (int)$id;
		
		$sql_end = self::Query("SELECT $field_Name FROM $Table_Name WHERE `id` = '$id'");
        if ($sql_end) {
            while ($Value = $sql_end->fetch_assoc()) {
                $guest = $Value[$field_Name];
                return $guest;
            }
        }
    }
    public static function Get_Middle_Commercial($select, $business_center_id) {
		
		$business_center_id = (int)$business_center_id;
		$sql_end = self::Query("SELECT list6.$select, count(*) as c FROM `list6` 
									LEFT JOIN `list15` ON list15.BusinessShoppingCenter = list6.BusinessShoppingCenter
										WHERE list6.BusinessShoppingCenter = '" . $business_center_id . "' GROUP BY list6.$select ORDER BY `c` DESC LIMIT 1");

        if ($sql_end) {
            while ($Value = $sql_end->fetch_assoc()) {
                $guest = $Value[$select];
                return $guest;
            }
        }
    }
    public static function Get_Middle_Building($select, $yandex_complex_id, $cian_complex_id) {
		
		$sql_end = self::Query("SELECT $select, count(*) as c FROM `list8`
									WHERE `idcian` = '" . $cian_complex_id . "' AND `idyandex` = '" . $yandex_complex_id . "' 
										GROUP BY $select ORDER BY `c` DESC LIMIT 1");

        if ($sql_end) {
            while ($Value = $sql_end->fetch_assoc()) {
                $guest = $Value[$select];
                return $guest;
            }
        }
    }
        
    public static function Get_Middle($Table_Name, $select, $where = null) {
		
		$new_where = '';
		if(is_array($where)){
			foreach($where as $key => $value) {
				$new_where .= "`". $key."`='".$value."'";
			}
			$sql_end = self::Query("SELECT `$select`, count(*) as c FROM `$Table_Name` WHERE $new_where GROUP BY `$select` ORDER BY `c` DESC LIMIT 1");
		}

        if ($sql_end) {
            while ($Value = $sql_end->fetch_assoc()) {
                $guest = $Value[$select];
                return $guest;
            }
        }
    }
    
    public static function Get_Type_Field($where) {
    	$new_where = '';
		if(is_array($where)){
			foreach($where as $key => $value) {
				$new_where .= "`". $key."`='".$value."' AND ";
			}
			$sql_end = self::Query("SELECT `type_field` FROM `list_field` WHERE $new_where `domain` = 'nodomain'");
        	if ($sql_end) {
        	    while ($Value = $sql_end->fetch_assoc()) {
        	        $guest = $Value['type_field'];
        	        return $guest;
        	    }
        	}
		}
    } 
    public static function Get_Field_Value_From_Domain_Name($Table_Name, $field_Name, $domain) {
        $domain = JBase::escape($domain);
		
		$sql_end = self::Query("SELECT `$field_Name` FROM $Table_Name WHERE `domain` = '$domain'");
        if ($sql_end) {
            while ($Value = $sql_end->fetch_assoc()) {
                $guest = $Value[$field_Name];
                return $guest;
            }
        }
    }    
    public static function Get_Like_Nodomain($Table_Name, $Gett, $field_Name, $Field_Value) {
		
		$uu = "SELECT `$Gett` FROM `$Table_Name` WHERE $field_Name LIKE '%" . $Field_Value . "%' LIMIT 50";
		$sql_end = self::Query($uu);
        if ($sql_end) {
            while ($Value = $sql_end->fetch_assoc()) {
                $guest = $Value[$Gett];
                return $guest;
            }
        }
    }
    
    public static function Update_Field_Value_From_Id($Table_Name, $id, $List_Field_Value) {
        $id = JBase::escape($id);
        $QQ = "UPDATE $Table_Name SET $List_Field_Value WHERE (id='$id')";
      	//var_dump($QQ);
		return self::Query($QQ);
    }
    
    public static function Get_List($Table_Name, $fild_Name, $Where, $ORDER_BY) {
        $Where = JBase::escape($Where);
        $ORDER_BY = JBase::escape($ORDER_BY);
		
		$QQ = "SELECT * FROM $Table_Name WHERE `$fild_Name` = '$Where' AND `domain` = '".self::template()."' ORDER BY $ORDER_BY";
      	return self::Query($QQ);
    }
    
    
    public static function Get_From_Template($Table_Name, $select = '*', $where = null, $orderby = null) {
		if(is_array($select)) $select = implode(',', $select);
		$new_orderby = ($orderby) ? "ORDER BY " : NULL;
		if ($new_orderby) $new_orderby .= "`". $orderby."`";
		$new_where = '';
		
		if(is_array($where)){
			foreach($where as $key => $value) {
				if(is_array($value)) {
					$new_where .= $key." IN (".implode(",",$value).")";
				} else {
					$new_where .= "`". $key."`='".$value."' AND ";
				}
			}
			return self::Query("SELECT $select FROM `$Table_Name` WHERE $new_where `published` = '1' $new_orderby");
		} else { 
      		return self::Query("SELECT $select FROM $Table_Name WHERE `domain` = '".self::template()."' $new_orderby");
      	}
    }
    
    
    
    public static function Get_Regexp($Table_Name, $select = '*', $where = null) {
		if(is_array($select)) $select = implode(',', $select);
		$new_where = '';
		
		if(is_array($where)){
			foreach($where as $key => $value) {
				$new_where .= "`". $key."` REGEXP '".$value."' AND ";
			}
			return self::Query("SELECT $select FROM `$Table_Name` WHERE $new_where `domain` = '".self::template()."'");
		}
    }
     
    public static function Get_Nodomain($Table_Name, $select = '*', $where = null){
		if(is_array($select)) $select = implode(',', $select);
		$new_where = '';
		
		if(is_array($where)){
			foreach($where as $key => $value) {
				if(is_array($value)) {
					$new_where .= $key." IN (".implode(",",$value).")";
				} else {
					$new_where .= "`". $key."`='".$value."' AND ";
				}
			}
			return self::Query("SELECT $select FROM `$Table_Name` WHERE $new_where `domain` = 'nodomain'");
		}
    }


    
    
    public static function Update_Data_From_Template($Table_Name, $set, $where = null){
		$template = self::Get_Field_Value_From_Domain('templates','templatename');
		$new_where = '';
		$new_set = '';
		
		if(is_array($where)){
			foreach($where as $key => $value) {
				$new_where .= " AND `". $key."`='".$value."'";
			}
		} else $new_where .= $where;
		
		if(is_array($set)){
			foreach($set as $key => $value) {
				$new_set .= "`". $key."`='". $value ."', ";
			}
			$new_set = rtrim($new_set, ", ");
		} else $new_set .= $set;
		
		$QQ = "UPDATE $Table_Name SET $new_set WHERE `template` = '". $template ."' $new_where ";	
		//var_dump($QQ);
		return self::Query($QQ);
	}
	
    public static function Update_Data_Nodomain($Table_Name, $set, $where){
		$new_where = '';
		$new_set = '';
		
		if(is_array($where)){
			foreach($where as $key => $value) {
				$new_where .= " AND `". $key."`='".$value."'";
			}
		} else $new_where .= $where;
		
		if(is_array($set)){
			foreach($set as $key => $value) {
				$new_set .= "`". $key."`='". $value ."', ";
			}
			$new_set = rtrim($new_set, ", ");
		} else $new_set .= $set;
		
		$QQ = "UPDATE $Table_Name SET $new_set WHERE `domain` = 'nodomain' $new_where ";	
		//var_dump($QQ);
		return self::Query($QQ);
	}
    //проверяем есть ли такая запись
    function Test_Data($Table_Name, $List_Field_Value) {
    	$test = self::Query("SELECT * FROM $Table_Name WHERE $List_Field_Value AND `domain` = '".self::template()."' LIMIT 1");
        $num_rows = mysqli_num_rows($test);
        return ($num_rows > 0) ? true : false;
    }
    //проверяем есть ли такая запись
    function Test_Data_Nodomain($Table_Name, $List_Field_Value) {
    	$test = self::Query("SELECT * FROM $Table_Name WHERE $List_Field_Value LIMIT 1");
        $num_rows = mysqli_num_rows($test);
        return ($num_rows > 0) ? true : false;
    }

    function Where_List_ToStr($List_Field_Name, $List_Field_Value) {
        $where_str ="1 ";
        foreach ($List_Field_Name as $i => $value) {
            $where_str .=  " and `" . $List_Field_Name[$i] . "` = '" . JBase::escape($List_Field_Value[$i]) . "'";
        }
        return $where_str ;
    }
    //Проверяет является ли строка json
    public static function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
    
    public static function Set_Data_Unik($Table_Name, $List_Field_Name, $List_Field_Value) {
        if (!self::Test_Data($Table_Name, self::Where_List_ToStr($List_Field_Name, $List_Field_Value))) {
            $List_Field_Name_str  = implode(",", $List_Field_Name);
            $List_Field_Value_str = "'" . implode("','", $List_Field_Value) . "'";
            self::Query("INSERT INTO $Table_Name ($List_Field_Name_str) VALUES ($List_Field_Value_str)");
            return self::$SqlID;
        } else {
            return false;
        }
    }
    //session_users only
    public static function Del_Data($Table_Name, $id) {
        $id = (int)$id;
		self::Query("DELETE FROM `session_users` WHERE (`id`='$id')");
    }
    //session_users only
    public static function Del_Data_Where($Table_Name, $Field_Name, $Where) {
        $Where = JBase::escape($Where);
		self::Query("DELETE FROM `session_users` WHERE (`$Field_Name`='$Where')");
    }
    
    function row( $query ) {
        $q = self::Query( $query );
        $result = $q->fetch_row();
        $q->free();

        return $result[ 0 ];
    }
    
    function insert( $rows, $table, $item_id=0, $where='1', $mysqli=null, $idrow='id' )	{
        $item_id = filter_str( $item_id );

        if( empty($item_id) ) {
            $cols = array();
            $vals = array();
            foreach( $rows as $row => $value ) {
                $cols[] = '`'.$row.'`';
                $vals[] = '\''. addslashes(remove_quotes($value)) .'\'';
            }

            self::Query('
				INSERT INTO `'.$table.'`
				('. implode(',',$cols) .')
				VALUES ('. implode(',',$vals) .')
			');
            $mysqli = self::$mysqli_pool;

            if( !$mysqli->errno ) {
                return $mysqli->insert_id;
            } else {
                return 0;
            }

        } else {

            if( $where == '1' )
                $where = '`'.$idrow.'` = \''.$item_id.'\'';

            $upadte_rows = array();
            foreach( $rows as $key => $value ) {
                $upadte_rows[] = '`'.$key.'` = \''. addslashes(remove_quotes($value)) .'\'';
            }
            self::Query('
				UPDATE	`'.$table.'`
				SET		'. implode(',',$upadte_rows) .'
				WHERE	'.$where
            );
            $mysqli = self::$mysqli_pool;

            if( !$mysqli->errno && $mysqli->affected_rows != -1 ) {
                return $item_id;
            } else {
                return 0;
            }
        }
    }
	
	static function escape($str) {
		self::getConnect();
		return self::$mysqli_pool->real_escape_string($str);
	}
    //запрашиваем id по where
	function Get_Id($Table_Name, $where, $noId=null) {
		$new_where = '';
		if (is_array($where)) {
			foreach ($where as $key => $value) {
				$new_where .= "`". $key."`='".$value."' AND ";
			}
			if ($noId) $sql_end = self::Query("SELECT `id` FROM `$Table_Name` WHERE $new_where `id` != '". $noId ."' AND `domain` = '".self::template()."'");
			if (!$noId) $sql_end = self::Query("SELECT `id` FROM `$Table_Name` WHERE $new_where `domain` = '".self::template()."'");
			while ($Where = $sql_end->fetch_assoc()) {
        	    $result = $Where['id'];
				return $result;
        	}
        }
    }
	//забираем последнее значение domain_id (double autoincrement)
	public static function Get_Last($Table_Name) {		
        $row_sql  = self::Query("SELECT `domain_id` FROM $Table_Name WHERE `domain` = '".self::template()."' ORDER BY `domain_id` DESC LIMIT 1");
        if (!empty($row_sql)) {
            while ($Where = $row_sql->fetch_assoc()) {
                $result = $Where['domain_id'];
                return $result;
            }
        } else {
            return false;
        }
    }
	//забираем всю таблицу
    public static function Get_Full_Table($Table_Name) {
        $res = JBase::Query("SELECT * FROM $Table_Name");
        return $res;
    }
	//забираем всю таблицу по домену
    public static function Get_Full_Table_From_Domain($Table_Name) {
		$sql_end = self::Query("SELECT * FROM $Table_Name WHERE `domain` = '".self::template()."'");
        return $sql_end;
    }
	//функция для выборки каталогов по domain_id
    public static function Get_Field_Value_From_Domain_Id($Table_Name, $id, $field_Name) {
        $id = JBase::escape($id);
		
		$sql_end = self::Query("SELECT $field_Name FROM $Table_Name WHERE `domain_id` = '$id' AND `domain` = '".self::template()."'");
        if ($sql_end) {
            while ($Value = $sql_end->fetch_assoc()) {
                $guest = $Value[$field_Name];
                return $guest;
            }
        }
    }
	//функция для записи значений в каталоги по domain_id
    public static function Update_Field_Value_From_Domain_Id($Table_Name, $id, $List_Field_Value) {
        $id = JBase::escape($id);
		
		return self::Query("UPDATE $Table_Name SET $List_Field_Value WHERE (`domain_id`='$id') AND `domain` = '".self::template()."'");
    }
    //обновление данных по домену в таблице
    public static function Update_Field_Value_From_Domain($Table_Name, $List_Field_Value) {
		return self::Query("UPDATE $Table_Name SET $List_Field_Value WHERE (`domain` = '".self::template()."')");
    }
    //получение данных по домену в таблице (похож на Get_Last)
    public static function Get_Max($Table_Name, $Field) {
		$row_sql  = self::Query("SELECT $Field FROM $Table_Name WHERE `domain`='".self::template()."' ORDER BY $Field DESC LIMIT 1");
        if (!empty($row_sql)) {
            while ($Where = $row_sql->fetch_assoc()) {
                $result = $Where[$Field];
                return $result;
            }
        } else {
            return false;
        }
    }
    
    public static function Create_List($list) {
    	$list = (int)$list;
        self::Query("CREATE TABLE IF NOT EXISTS `list" . $list . "` (
  									`id` int(11) NOT NULL AUTO_INCREMENT,
  									`domain` varchar(255) NOT NULL,
  									`id_user` int(11) NOT NULL,
  									`premium` int(1) NOT NULL,
  									`page` text NOT NULL,
  									`status` int(1) NOT NULL,
  									`time` int(11) NOT NULL,
  									`timeupdate` int(11) NOT NULL,
  									`price` int(11) NOT NULL,
  									`geo` text NOT NULL,
  									`name` text NOT NULL,
  									UNIQUE KEY `id` (`id`)
  					) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0");

        self::Query("INSERT INTO `list_field` (
        	`table_field`, 					`name_field`, 	`type_field`, 	`caption`, 			`searchtext`, 	`required`,	`domain`) VALUES
			( 'list" . $list . "', 	'name', 		'text', 		'Название', 		1, 				1,			'". self::template() ."'),
			( 'list" . $list . "', 	'timeupdate', 	'system', 		'Дата модерации', 	0, 				0,			'". self::template() ."'),
			( 'list" . $list . "', 	'geo', 			'system', 		'Гео модуль', 		0, 				0,			'". self::template() ."'),
			( 'list" . $list . "', 	'status', 		'system', 		'Статус', 			0, 				0,			'". self::template() ."'),
			( 'list" . $list . "', 	'time', 		'system', 		'Дата добавления', 	0, 				0,			'". self::template() ."'),
			( 'list" . $list . "', 	'premium', 		'system', 		'Premium', 			0, 				0,			'". self::template() ."'),
			( 'list" . $list . "', 	'id_user', 		'system', 		'Пользователь', 	0, 				0,			'". self::template() ."'),
			( 'list" . $list . "', 	'domain', 		'system', 		'Домен', 			0, 				0,			'". self::template() ."'),
			( 'list" . $list . "', 	'id', 			'system', 		'Идентификатор', 	0, 				0,			'". self::template() ."'),
            ( 'list" . $list . "', 	'page', 		'system', 		'Раздел', 			0, 				0,			'". self::template() ."'),
            ( 'list" . $list . "', 	'price', 		'textint', 		'Цена',				0, 				0,			'". self::template() ."') "); 
        return true;
    }
    
    public static function Alter_Table($list, $field, $type) {
    	$field = preg_replace('/[^\p{L}\p{N}\s]/u', '', $field);
    	$list = preg_replace('/[^\p{L}\p{N}\s]/u', '', $list);
    	$type = preg_replace('/[^\p{L}\p{N}\s]/u', '', $type);
        return self::Query("ALTER TABLE  `". $list ."` ADD  `". $field ."` ". $type ." NOT NULL");
    }
    
    public static function Delete_Hash($table, $hash) {
    	$hash = self::escape($hash);
    	if ($table == 'mod_menu_css' || $table == 'mod_menu_js')
    		return self::Query("DELETE FROM $table WHERE `hash` = '$hash' AND `domain` = '".self::template()."' LIMIT 1");
    	else return false;
    }
    
    public static function Get_Limit($table, $a, $b, $limit) {
    	$limit = (int)$limit;
		$res = self::Query("SELECT $a, $b FROM $table WHERE `domain` = '".self::template()."' LIMIT $limit"); 
        while ($rows = $res->fetch_object()) {
            $item_info[] = [
                'key' => $rows->$a,
                'value' => $rows->$b
            ];
	    }
        if (!empty($item_info))
        	return array_column($item_info, 'value', 'key');
    }
    
    public static function Get_Limit_Template($table, $a, $b, $limit, $template) {
    	$limit = (int)$limit;
		$res = self::Query("SELECT $a, $b FROM $table WHERE `domain` = '".$template."' LIMIT $limit"); 
        while ($rows = $res->fetch_object()) {
            $item_info[] = [
                'key' => $rows->$a,
                'value' => $rows->$b
            ];
	    }
        if (!empty($item_info))
        	return array_column($item_info, 'value', 'key');
    }
    
    public static function Get_Columns($table) {
    	$table = preg_replace('/[^\p{L}\p{N}\s]/u', '', $table);
    	return self::Query("SHOW COLUMNS FROM $table"); 
    }
    
    
    
                    		 
	
}