<?php
namespace lib;
//ini_set('memory_limit', '-1');

/**
* class.JBase.php
*
*Класс - библиотека с функциями для для работы с Mysqli
*подгружается через автоподгрузку классов
*
*
**/


class JBase {
    public static $mysqli_pool = null;
    public static $last_error = '';
    public static $SqlID = '';
	public static $db = ''; 

    function Query($sql) {
		if (empty(self::$db))
		    self::$db=self::get_db();

        self::getConnect();

        $result            = self::$mysqli_pool->query($sql);
        if ($result === false) self::$last_error = self::$mysqli_pool->error_list;
        self::$SqlID =  self::$mysqli_pool->insert_id;
        return $result;
    }
    
    public static function loadClassFrom($class, $action) {
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
    
    public static function Get_Field_Value_From_Id($Table_Name, $id, $field_Name) {
        $id = (int)$id;
		
		$sql_end = self::Query("SELECT $field_Name FROM $Table_Name WHERE `id` = '$id' AND `domain` = '". self::get_db() ."'");
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
	public static function Get_Count($list, $status) {
		$sql_end = self::Query("SELECT COUNT(*) as `get` FROM `$list` WHERE `status` = '$status'");
		if ($sql_end) {
			while ($Value = $sql_end->fetch_assoc()) {
				$get = $Value['get'];
				return $get;
			}
		}
	}
	//тяжело
	public static function Get_All_Count() {
		$res = [];
		$Result = self::Get_Data('list8', ['id', 'statusgroup'], ['status' => '1']);
		if ($Result) while( $g = $Result->fetch_assoc() ) {
			$res[$g['id']] = $g['statusgroup'];
		}
		if (!empty($res)) {
			foreach ($res as $key => $value) {
				self::Update_Data('list8', ['count' => self::Get_Count('list'. $value, $key)], ['id' => $key]);
			}
			
			//JSCat.operatorSetting.operator_newlead
			//последнее количество заказов в обработке
			self::Update_Data('operators', ['operator_newlead' => self::Get_Field_Value_From_Id('list8', '1', 'count')], ['id' => '1']);
		}
		return $res;
// 		return [];
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
			$sql_end = self::Query("SELECT `type_field` FROM `list_field` WHERE $new_where `domain` = '". self::get_db() ."'");
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
		
		$QQ = "SELECT * FROM $Table_Name WHERE `$fild_Name` = '$Where' AND `domain` = '". self::get_db() ."' ORDER BY $ORDER_BY";
      	return self::Query($QQ);
    }
    
	public static function ifExist($table, $key, $value) {
		//проверка, существует ли запись
		$Result = JBase::Query('SELECT 1 FROM `'. $table .'` WHERE `'. $key .'` = "'. $value .'"');
		$access_allowed = false;
		if ($Result) while( $access_try = $Result->fetch_assoc() ) {
			$access_allowed = true;
			break;
		}		
		if( !$access_allowed ) {
			return false;
		} else return true;
	}
	public static function statusChange($list, $ids, $tostatus) {
		$userId = CTemplates::Session_Go();
		if (is_array($ids)) {
			foreach($ids as $key) {
				// Leadvertex::start($list, $key, $tostatus);
				Debugging::debug('statusChange','list='.$list.' id='.$key.' tostatus='.$tostatus.' User= '.$userId);
				$tolist = self::Get_Field_Value_From_Id('list8', $tostatus, 'statusgroup');
				if (self::ifExist('list'. (int)$tolist, 'id', $key)) {
					self::Update_Data('list'. (int)$tolist, ['status' => (int)$tostatus, 'statustime' => time()], ['id' => (int)$key]);
				} else {
					//return "INSERT IGNORE INTO list". (int)$tolist ." SELECT list". (int)$list .".* FROM list". (int)$list ." WHERE list". (int)$list .".id = '". (int)$key ."'";
					self::Query("INSERT IGNORE INTO list". (int)$tolist ." SELECT list". (int)$list .".* FROM list". (int)$list ." WHERE list". (int)$list .".id = '". (int)$key ."'");
					self::Query("DELETE FROM list". (int)$list ." WHERE `id` = '". (int)$key ."'");
					self::Update_Data('list'. $tolist, ['status' => (int)$tostatus, 'statustime' => time()], ['id' => (int)$key]);
				}
				if ($tostatus == 2) {
					self::Query("INSERT INTO cron_robot (object, list, order_status, template, status, status_sms, domain, calltime) VALUES (".$key.", ".$tolist.", 2, 1, 0, 0, '1v1-crm.ru', '".date('Y-m-d H:i:s', time())."')");
				}
				Statuses::listChangeSms($tostatus, $key); //слишком много sql
			
			if ($tostatus == '2' || $tostatus == '28') //855 НДЗ-Звонит Робот || Думает/набрать позже
				self::Update_Data('list'. $tolist, ['id_user' => 0], ['id' => (int)$key]); //Подчищаем id_user
				
   			if ($tostatus == '31') //Подтверждена отправка
   				self::Update_Data('list'. $tolist, ['approvedAt' => time()], ['id' => (int)$key]); //Дата апрува
   			
   			if ($tostatus == '5') //Отправлен по РФ
   				self::Update_Data('list'. $tolist, ['shippedAt' => time()], ['id' => (int)$key]); //Дата отправки
   				
   			if ($tostatus == '4') //Отменен
   				self::Update_Data('list'. $tolist, ['canceledAt' => time()], ['id' => (int)$key]); //Дата отмены
   			
   			if ($tostatus == '7') //Оплачен
   				self::Update_Data('list'. $tolist, ['buyoutAt' => time()], ['id' => (int)$key]); //Дата выкупа
   			
   			if ($tostatus == '9') //Возврат
   				self::Update_Data('list'. $tolist, ['refundedAt' => time()], ['id' => (int)$key]); //Дата возврата
   				
			}
   		
   		if ($tostatus == '51' || $tostatus == '53') //завести в Liveinform
   			Liveinform::start(['method' => 'add'], $ids);	
		}
	}
    
	public static function Get_Data($Table_Name, $select = '*', $where = null, $orderby = null) {
		if(is_array($select)) $select = implode(',', $select);
		$new_orderby = ($orderby) ? "ORDER BY " : NULL;
		if ($new_orderby) $new_orderby .= $orderby;
		$new_where = '';
		
		if(is_array($where)){
			foreach($where as $key => $value) {
				if(is_array($value)) {
					$new_where .= $key." IN (".implode(",",$value).") AND ";
				} else {
					$new_where .= "`". $key."`='".$value."' AND ";
				}
			}
			$QQ = "SELECT $select FROM `$Table_Name` WHERE $new_where `domain` = '". self::get_db() ."' $new_orderby LIMIT 1000";
			//var_dump($QQ);
			return self::Query($QQ);
		} else { 
				$QQ = "SELECT $select FROM $Table_Name WHERE `domain` = '". self::get_db() ."' $new_orderby LIMIT 1000";
				//var_dump($QQ);
				return self::Query($QQ);
      	}
	}

	public static function Get_Search_Text($Table_Name, $select = '*', $data = NULL) {
		$where 						= null;
		$fio 						= (isset($data['fio'])) ? $data['fio'] : NULL;
		$product 					= (isset($data['product'])) ? $data['product'] : NULL;
		$externalId 				= (isset($data['externalId'])) ? $data['externalId'] : NULL;
		$externalWebmaster 			= (isset($data['externalWebmaster'])) ? $data['externalWebmaster'] : NULL;

		$apr_date_from 				= (isset($data['apr_date_from'])) ? $data['apr_date_from'] : NULL;
		$apr_date_before 			= (isset($data['apr_date_before'])) ? $data['apr_date_before'] : NULL;
		$buy_date_from 				= (isset($data['buy_date_from'])) ? $data['buy_date_from'] : NULL;
		$buy_date_before 			= (isset($data['buy_date_before'])) ? $data['buy_date_before'] : NULL;
		$shippedAt_from 			= (isset($data['shippedAt_from'])) ? $data['shippedAt_from'] : NULL;
		$shippedAt_before 			= (isset($data['shippedAt_before'])) ? $data['shippedAt_before'] : NULL;
		$canceledAt_from 			= (isset($data['canceledAt_from'])) ? $data['canceledAt_from'] : NULL;
		$canceledAt_before 			= (isset($data['canceledAt_before'])) ? $data['canceledAt_before'] : NULL;
		$refundedAt_from 			= (isset($data['refundedAt_from'])) ? $data['refundedAt_from'] : NULL;
		$refundedAt_before 			= (isset($data['refundedAt_before'])) ? $data['refundedAt_before'] : NULL;

		$phone 						= (isset($data['phone'])) ? $data['phone'] : NULL;
		$post_track 				= (isset($data['post_track'])) ? $data['post_track'] : NULL;
		$id 						= (isset($data['id'])) ? $data['id'] : NULL;
		$status 					= (isset($data['status'])) ? $data['status'] : NULL;
		$webmasterId	 			= (isset($data['webmasterId'])) ? $data['webmasterId'] : NULL;

		if($fio) 									$where .= "`name` = '".$fio."' AND ";
		if($product) 								$where .= "`goods_names` LIKE '%".$product."%' AND ";
		if($phone) 									$where .= "`phone` = '".$phone."' AND ";
		if($externalId) 							$where .= "`externalId` = '".$externalId."' AND ";
		if($externalWebmaster) 						$where .= "`externalWebmaster` = '".$externalWebmaster."' AND ";

		if($apr_date_from && $apr_date_before) 		$where .= "`approvedAt` > '".$apr_date_from."' AND `approvedAt` < '".$apr_date_before."' AND ";
		if($buy_date_from && $buy_date_before) 		$where .= "`buyoutAt` > '".$buy_date_from."' AND `buyoutAt` < '".$buy_date_before."' AND ";
		if($shippedAt_from && $shippedAt_before) 	$where .= "`shippedAt` > '".$shippedAt_from."' AND `shippedAt` < '".$shippedAt_before."' AND ";
		if($canceledAt_from && $canceledAt_before) 	$where .= "`canceledAt` > '".$canceledAt_from."' AND `canceledAt` < '".$canceledAt_before."' AND ";
		if($refundedAt_from && $refundedAt_before) 	$where .= "`refundedAt` > '".$refundedAt_from."' AND `refundedAt` < '".$refundedAt_before."' AND ";

		if($post_track){
			$s = strpos($post_track,',');
			if($s){
				$post_track = explode(",", $post_track);
				$where .= "`russianpostTrack` IN (";
				for ($i=0; $i < count($post_track); $i++) { 
					if($i > 0 && ($i + 1) == count($post_track)){
						$where .= $post_track[$i];
					}else {
						$where .= $post_track[$i].',';
					}
				}
				$where .= ') AND';
			}else{
				$where .= "`russianpostTrack` = '".$post_track."' AND ";
			}
		}

		if($id){
			$s = strpos($id,',');
			if($s){
				$id = explode(",", $id);
				$where .= "`id` IN (";
				for ($i=0; $i < count($id); $i++) { 
					if($i > 0 && ($i + 1) == count($id)){
						$where .= $id[$i];
					}else {
						$where .= $id[$i].',';
					}
				}
				$where .= ') AND';
			}else{
				$where .= "`id` = '".$id."' AND ";
			}
		}

		if($status){
			$s = strpos($status,',');
			if($s){
				$status = explode(",", $status);
				$where .= "`id` IN (";
				for ($i=0; $i < count($status); $i++) { 
					if($i > 0 && ($i + 1) == count($status)){
						$where .= $status[$i];
					}else {
						$where .= $status[$i].',';
					}
				}
				$where .= ') AND';
			}else{
				$where .= "`id` = '".$status."' AND ";
			}
		}

		if($webmasterId) $where .= "`webmasterId` = '".$webmasterId."' AND ";
		if($where === '') {
			$QQ = "SELECT $select FROM list14 WHERE 1' ";
		}else {
			$QQ = "SELECT $select FROM `$Table_Name` WHERE $where `domain` = '". self::get_db() ."' ";
		}
		if($where) unset($where);
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
      		return self::Query("SELECT $select FROM $Table_Name WHERE `domain` = '". self::get_db() ."' $new_orderby");
      	}
    }
    
   public static function Get_Regexp($Table_Name, $select = '*', $where = null) {
		if(is_array($select)) $select = implode(',', $select);
		$new_where = '';
		
		if(is_array($where)){
			foreach($where as $key => $value) {
				$new_where .= "`". $key."` REGEXP '".$value."' AND ";
			}
			return self::Query("SELECT $select FROM `$Table_Name` WHERE $new_where `domain` = '". self::get_db() ."'");
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
			return self::Query("SELECT $select FROM `$Table_Name` WHERE $new_where `domain` = '". self::get_db() ."'");
		}
    }

   public static function Set_Data($Table_Name, $List_Field, $List_Field_Value){
        $List_Field_str       = "`" . implode("`,`", $List_Field) . "`";
        $List_Field_Value_str = "'" . implode("','", $List_Field_Value) . "'";
		$QQ = "INSERT INTO $Table_Name ($List_Field_str) VALUES ($List_Field_Value_str)";
		
        return self::Query($QQ);
    }
    
   public static function Update_Data($Table_Name, $set, $where){
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
		
		$QQ = "UPDATE $Table_Name SET $new_set WHERE `domain` = '". self::get_db() ."' $new_where ";	
		//var_dump($QQ);
		return self::Query($QQ);
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
		
		$QQ = "UPDATE $Table_Name SET $new_set WHERE 1=1 $new_where ";	
		//var_dump($QQ);
		return self::Query($QQ);
	}
   
    //проверяем есть ли такая запись
   function Test_Data($Table_Name, $List_Field_Value) {
    	$test = self::Query("SELECT * FROM $Table_Name WHERE $List_Field_Value AND `domain` = '". self::get_db() ."' LIMIT 1");
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
    //возвращает имя сайта
    public static function get_db() {
        if (!self::$db){
            if (substr($_SERVER['SERVER_NAME'], 0, 4) == 'www.')
                $WEB_DOMAIN = substr($_SERVER['SERVER_NAME'], 4, strlen($_SERVER['SERVER_NAME']));
            else
                $WEB_DOMAIN = $_SERVER['SERVER_NAME'];
            self::$db=$WEB_DOMAIN;
        }
        return self::$db;
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
			if ($noId) $sql_end = self::Query("SELECT `id` FROM `$Table_Name` WHERE $new_where `id` != '". $noId ."' AND `domain` = '". self::get_db() ."'");
			if (!$noId) $sql_end = self::Query("SELECT `id` FROM `$Table_Name` WHERE $new_where `domain` = '". self::get_db() ."'");
			while ($Where = $sql_end->fetch_assoc()) {
        	    $result = $Where['id'];
				return $result;
        	}
        }
    }
	//забираем последнее значение domain_id (double autoincrement)
	public static function Get_Last($Table_Name) {		
        $row_sql  = self::Query("SELECT `domain_id` FROM $Table_Name WHERE `domain` = '". self::get_db() ."' ORDER BY `domain_id` DESC LIMIT 1");
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
	public static function Get_Full_Table($Table_Name, $order=null) {
    	$orderby = ($order) ? 'ORDER BY '. $order : null;
		$res = JBase::Query("SELECT * FROM $Table_Name $orderby");
		return $res;
	}
	//забираем всю таблицу по домену
    public static function Get_Full_Table_From_Domain($Table_Name) {
		$sql_end = self::Query("SELECT * FROM $Table_Name WHERE `domain` = '". self::get_db() ."'");
        return $sql_end;
    }
	//забираем всю таблицу по шаблону
    public static function Get_Full_Table_From_Template($Table_Name) {
		$template = self::Get_Field_Value_From_Domain('templates','templatename');
		$sql_end = self::Query("SELECT * FROM $Table_Name WHERE `template` = '". $template ."'");
      return $sql_end;
    }
	//функция для выборки каталогов по domain_id
    public static function Get_Field_Value_From_Domain_Id($Table_Name, $id, $field_Name) {
        $id = JBase::escape($id);
		
		$sql_end = self::Query("SELECT $field_Name FROM $Table_Name WHERE `domain_id` = '$id' AND `domain` = '". self::get_db() ."'");
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
		
		return self::Query("UPDATE $Table_Name SET $List_Field_Value WHERE (`domain_id`='$id') AND `domain` = '". self::get_db() ."'");
    }
    //получение данных по домену в таблице
    public static function Get_Field_Value_From_Domain($Table_Name, $field_Name) {
		
		$sql_end = self::Query("SELECT $field_Name FROM $Table_Name WHERE `domain` = '". self::get_db() ."'");
        if ($sql_end) {
            while ($Value = $sql_end->fetch_assoc()) {
                $guest = $Value[$field_Name];
                return $guest;
            }
        }
    }
    //обновление данных по домену в таблице
    public static function Update_Field_Value_From_Domain($Table_Name, $List_Field_Value) {
		return self::Query("UPDATE $Table_Name SET $List_Field_Value WHERE (`domain` = '". self::get_db() ."')");
    }
    //получение данных по домену в таблице (похож на Get_Last)
    public static function Get_Max($Table_Name, $Field) {
		$row_sql  = self::Query("SELECT $Field FROM $Table_Name WHERE `domain`='". self::get_db() ."' ORDER BY $Field DESC LIMIT 1");
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
  									`statuschange` int(11) NOT NULL,
  									`price` int(11) NOT NULL,
  									`geo` text NOT NULL,
  									`name` text NOT NULL,
  									UNIQUE KEY `id` (`id`)
  					) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0");

		self::Query("INSERT INTO `list_field` (
        	`table_field`, 					`name_field`, 	`type_field`, 	`caption`, 			`searchtext`, 	`required`,	`domain`) VALUES
			( 'list" . $list . "', 	'name', 		'text', 		'Название', 		1, 				1,			'". self::get_db() ."'),
			( 'list" . $list . "', 	'timeupdate', 	'system', 		'Дата модерации', 	0, 				0,			'". self::get_db() ."'),
			( 'list" . $list . "', 	'geo', 			'system', 		'Гео модуль', 		0, 				0,			'". self::get_db() ."'),
			( 'list" . $list . "', 	'status', 		'system', 		'Статус', 			0, 				0,			'". self::get_db() ."'),
			( 'list" . $list . "', 	'time', 			'system', 		'Дата добавления', 	0, 			0,			'". self::get_db() ."'),
			( 'list" . $list . "', 	'statuschange', 'system', 		'Дата смены статуса', 0, 			0,			'". self::get_db() ."'),
			( 'list" . $list . "', 	'premium', 		'system', 		'Premium', 			0, 				0,			'". self::get_db() ."'),
			( 'list" . $list . "', 	'id_user', 		'system', 		'Пользователь', 	0, 				0,			'". self::get_db() ."'),
			( 'list" . $list . "', 	'domain', 		'system', 		'Домен', 			0, 				0,			'". self::get_db() ."'),
			( 'list" . $list . "', 	'id', 			'system', 		'Идентификатор', 	0, 				0,			'". self::get_db() ."'),
            ( 'list" . $list . "', 	'page', 		'system', 		'Раздел', 			0, 				0,			'". self::get_db() ."'),
            ( 'list" . $list . "', 	'price', 	'textint', 		'Цена',				0, 				0,			'". self::get_db() ."') ");   
		return true;
	}
    
	public static function Alter_Table($list, $field, $type) {
		$field = preg_replace('/[^\p{L}\p{N}\s]/u', '', $field);
		$list = preg_replace('/[^\p{L}\p{N}\s]/u', '', $list);
    	$type = preg_replace('/[^\p{L}\p{N}\s]/u', '', $type);
		if (!in_array($list, ['list14','list15','list16','list17','list18','list19','list20'])) {
			self::Query("ALTER TABLE  `". $list ."` ADD  `". $field ."` ". $type ." NOT NULL");
		} else {
			self::Query("ALTER TABLE  `list14` ADD  `". $field ."` ". $type ." NOT NULL");
			self::Query("ALTER TABLE  `list15` ADD  `". $field ."` ". $type ." NOT NULL");
			self::Query("ALTER TABLE  `list16` ADD  `". $field ."` ". $type ." NOT NULL");
			self::Query("ALTER TABLE  `list17` ADD  `". $field ."` ". $type ." NOT NULL");
			self::Query("ALTER TABLE  `list18` ADD  `". $field ."` ". $type ." NOT NULL");
			self::Query("ALTER TABLE  `list19` ADD  `". $field ."` ". $type ." NOT NULL");
			self::Query("ALTER TABLE  `list20` ADD  `". $field ."` ". $type ." NOT NULL");
		}
		return true;
	}
	
	
    
	public static function Delete_Hash($table, $hash) {
		$hash = self::escape($hash);
		if ($table == 'mod_menu_css' || $table == 'mod_menu_js')
			return self::Query("DELETE FROM $table WHERE `hash` = '$hash' AND `domain` = '". self::get_db() ."' LIMIT 1");
		else return false;
	}
    
	public static function Get_Limit($table, $a, $b, $limit) {
		$limit = (int)$limit;
		$res = self::Query("SELECT $a, $b FROM $table WHERE `domain` = '". self::get_db() ."' LIMIT $limit"); 
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