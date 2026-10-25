<?
class ice_mysql {
    var $rows         = false;  // есть/нет поля в ответе
    var $numbers      = false;  // сколько строк
    var $error        = false;  // ошибка
    var $errno        = false;  // номер ошибки
    var $insert_id    = false;  // номер вставленной записи
    var $transactions = 0;      // баланс commit/rollback (для успешного commit должен быть ==1)
    var $history      = "";     // лог запросов

/**
*   @function ali_mysql()
*   В цикле делает MYSQL_CONNECT_COUNT попыток установить соединие к БД
*   Возвращает true (или false)
*   Внимание: временно переопределяет error_handler для корректной работы обработчика ошибок
*/
function ice_mysql() {
//    restore_error_handler();
//    error_reporting(0);
    $connect_count=0;
    $connect_ok = false;
    while (!$connect_ok) {
        $connect_ok = true;
        $connect_count++;
        if (!$this->try_to_connect()) {
            sleep(MYSQL_CONNECT_DELAY);
            $connect_ok = false;
            };
        if ($connect_count>=MYSQL_CONNECT_COUNT) {
 //           set_error_handler("ali_error_handler");
  //          error_reporting(E_ALL);
            trigger_error ("Can't connect to MYSQL server for ".$connect_count." times\nQUERYFILE=".__FILE__."\nQUERYLINE=".__LINE__, E_USER_ERROR);
            return false;
            };
        };
	$this->query('set names cp1251','','','');

    set_error_handler("ali_error_handler");
    error_reporting(E_ALL);
    return true;
    }


/**
*   @function try_to_connect()
*/
function try_to_connect() {
    if (!($this->d = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSW))) {
        return false;
        };
    if (!(mysql_select_db(MYSQL_DB, $this->d))) {
        return false;
        };

    mysql_query("SET NAMES cp1251");
//	$this->query("SET NAMES 'cp1251'", __FILE__, __LINE__, false);
    return true;
    }


/**
*   @function query($q, $f, $l, $a=false)
*   @param $q - темплейт запроса
*   @param $f - файл из которого вызван метод
*   @param $l - строка файла из которого вызван метод
*   @param $a - массив переменных к темплейту
*   Возвращает результат вызова функции mysql_query() (или false), устанавливает errno, error и тп,
*   взаимодействует с глобальным обработчиком ошибок
*/
function query($q, $f, $l, $a=false) {

	//print_r($this);
	
    // распарсить шаблон
    if (is_array($a)){
        while (list($k, $v)=each($a)){
            $str = "#".$k."#";
            $q = str_replace($str, addslashes($v), $q);
            };
        };

    if (MYSQL_QUERY_DEBUG) {
		$time = date('H:i:s', time());
		$us = gettimeofday();
		$usec = $us['usec'];
		echo "<table width=100%><tr><td bgcolor=#eeffff>";
    	echo "<pre><font color=#000000>$q<br>FILE=$f<br>LINE=$l<br>TIME=$time:$usec</font></pre>";
		echo "</td></tr></table>";
		$time_start = microtime();
    	};

//    $this->history .=  $q."\r\n\r\n";
    $r = mysql_query($q);
    if (mysql_insert_id()>0){
        $this->insert_id = mysql_insert_id();
        }
    else {
        $this->insert_id = false;
        };
    if (mysql_errno()>0) {
        // ошибка обработки запроса ...
        $this->error = mysql_error();
        $this->errno = mysql_errno();
        trigger_error (
			"ERROR: ".mysql_error().
			"QUERY ".$q.
			"QUERYFILE=".$f.
			"QUERYLINE=".$l
			, E_USER_ERROR);
        }
    else {
        $this->error = false;
        $this->errno = false;
        };
    $this->rows = (mysql_affected_rows()>0);
    if (MYSQL_QUERY_DEBUG) {
		$time_end = microtime();
		$time = $time_end - $time_start;
		echo "<table width=100%><tr><td bgcolor=#eeffff>";
    	echo "<pre><font color=#000000>QUERYTIME=$time sec</font></pre>";
    	echo "<p style='padding-left:50px;'><font color=#000000>".backtrace()."</font></p>";
		echo "</td></tr></table>";
    	};
    return $r;
    }


















/**
*   table = табличка, 
*   $key = массив ключей и значений  WHERE
*/
function delete($table, $key){
	// сформируем запрос
	$str = ' ';

	// where часть 
	$where='';
    if (is_array($key)){
        while (list($k, $v)=each($key)){
			$where .= "$k = '$v' AND ";
			};
		};
	$where = substr($where, 0, -4);

	$q = "
	DELETE FROM 
		$table
	WHERE
		".$where;

	return $this->query($q, __FILE__, __LINE__, array() );
	}



/**
*   table = табличка, 
*   $key = массив ключей и значений  WHERE
*   $ a = массив ключей и значений SET 
*/
function get($table, $key, $fields = NULL	){
	$str = '*';
	// select part
    if (is_array($fields)){
		$str = implode(',',$fields);
		};

	// where часть 
	$where='';
    if (is_array($key)){
        while (list($k, $v)=each($key)){
			$where .= "$k = '$v' AND ";
			};
		};
	$where = substr($where, 0, -4);

	$q = "
	SELECT 
		".$str."
	FROM
		$table
	WHERE
		".$where;

	return $this->selectOneRow($q, __FILE__, __LINE__, $key );
	}



/**
*   table = табличка, 
*   $key = массив ключей и значений  WHERE
*   $ a = массив ключей и значений SET 
*/
function gets($table, $key, $fields = NULL , $order=NULL	){
	$str = '*';
	// select part
    if (is_array($fields)){
		$str = implode(',',$fields);
		};

	// where часть 
	$where='';
    if (is_array($key)){
        while (list($k, $v)=each($key)){
			$where .= "$k = '$v' AND ";
			};
		};
	$where = substr($where, 0, -4);

	$orderby = '';
	if ($order!=NULL){
		$orderby = ' ORDER BY '.$order;
		};
	
	$q = "
	SELECT 
		".$str."
	FROM
		$table
	WHERE
		".$where.$orderby;

	return $this->selectManyRows($q, __FILE__, __LINE__, $key );
	}

/**
*   table = табличка, 
*   $key = массив ключей и значений  WHERE
*   $ a = массив ключей и значений SET 
*/
function getss($table, $key, $id, $fields = NULL	){
	$str = '*';
	// select part
    if (is_array($fields)){
		$str = implode(',',$fields);
		};

	// where часть 
	$where='';
    if (is_array($key)){
        while (list($k, $v)=each($key)){
			$where .= "$k = '$v' AND ";
			};
		};
	$where = substr($where, 0, -4);

	$q = "
	SELECT 
		".$str."
	FROM
		$table
	WHERE
		".$where;

	return $this->selectManyRowsByID($q, $id,  __FILE__, __LINE__, $key );
	}



/**
*   table = табличка, 
*   $key = массив ключей и значений  WHERE
*   $ a = массив ключей и значений SET 
*/
function update($table, $key, $a, $updatednow=false){
	// сформируем запрос
	$str = ' ';
    if (is_array($a)){
        while (list($k, $v)=each($a)){
			$str .= "$k = '#$k#',";
			};
		};
		if ($updatednow){
			$str .= "updated = NOW(),";
			};
	$str = substr($str, 0, -1);

	// where часть 
	$where='';
    if (is_array($key)){
        while (list($k, $v)=each($key)){
			$where .= "$k = '$v' AND ";
			};
		};
	$where = substr($where, 0, -4);

	$q = "
	UPDATE
		$table
	SET
		".$str."
	WHERE
		".$where;

	return $this->query($q, __FILE__, __LINE__, $a );
	}


/**
*   table = табличка, 
*   $ a = массив ключей и значений SET 
*/
function insert($table, $a, $updatednow=false, $creatednow=false){
	// сформируем запрос
	$str = ' ';
    if (is_array($a)){
        while (list($k, $v)=each($a)){
			$str .= "$k = '#$k#',";
			};
		};
		if ($updatednow){
			$str .= "updated = NOW(),";
			};
		if ($creatednow){
			$str .= "created = NOW(),";
			};
	$str = substr($str, 0, -1);

	$q = "
	INSERT
		$table
	SET
		".$str;

	return $this->query($q, __FILE__, __LINE__, $a );
	}










/**
*   @function selectManyRows($q, $f, $l, $a=false)
*   @param $q - темплейт запроса
*   @param $f - файл из которого вызван метод
*   @param $l - строка файла из которого вызван метод
*   @param $a - массив переменных к темплейту
*   Возвращает очищенный массив для заданного запроса (или false)
*/
function selectManyRows($q, $f, $l, $a=false){
    $r = $this->query( $q, $f, $l, $a );
    if ($this->errno>0) {
        return false;
        };
    $return = array();
    $this->numbers=mysql_num_rows($r);
    for ( $i=0;$i<$this->numbers;$i++ ){ 
        $arr = mysql_fetch_array($r);
        while ( list ($k, $v) = each($arr) ) {
            if ( is_int($k) ) {
                unset( $arr[$k] );
                };
            };
        $return[] = $arr;
        }
    if (MYSQL_QUERY_DEBUG) {
		alid($return);
		};
    return $return;
    }




/**
*   @function selectOneRow($q, $f, $l, $a=false)
*   @param $q - темплейт запроса
*   @param $f - файл из которого вызван метод
*   @param $l - строка файла из которого вызван метод
*   @param $a - массив переменных к темплейту
*   Возвращает один элемент массива для заданного запроса (или false, в общем случае)
*/
function selectOneRow($q, $f, $l, $a=false){
    $r = $this->selectManyRows($q, $f, $l, $a);
    if (is_array($r) && (isset($r[0]))  ) {
        return $r[0];
        }
    else {
        return $r;
        };
    }



/**
*  @function commit()
*  Завершить InnoDB транзакцию
*/
function commit($f, $l){
    $this->transactions--;
    if (0>$this->transactions) {
        // нет активной транзакции
        trigger_error (mysql_error()."\nQUERY=COMMIT\nQUERYFILE=".$f."\nQUERYLINE=".$l, E_USER_ERROR);
        return false;
        }
    elseif ( 0==$this->transactions ) {
        $this->query('COMMIT', $f, $l);
        };
     return true;
     }




/**
*  @function rollback()
*  Откатить InnoDB транзакцию
*/
function rollback($f, $l){
    $this->query('ROLLBACK', $f, $l);
    $this->transactions=0;
    }



/**
*  @function begin()
*  Начать InnoDB транзакцию
*/
function begin($f, $l){
    if ($this->transactions==0) {
        $this->query('BEGIN', $f, $l);
        };
    $this->transactions++;
    }


/**
*   @function selectManyRowsByID
*   @param $q - темплейт запроса
*   @param $ID- по какому полю строится возвращаемый массив
*   @param $f - файл из которого вызван метод
*   @param $l - строка файла из которого вызван метод
*   @param $a - массив переменных к темплейту
*   Почти то-же, что и selectManyRows но ключи массива состоят из выбранного поля.
*/
function selectManyRowsByID($q, $ID, $f, $l, $a=false){
	$o = $this->selectManyRows($q, $f, $l, $a);
	if (
		(is_array($o)) && 
		(sizeof($o)>0)
		){
		$return = array();
		while(list($k, $v) = each($o)) {
			$return[$v[$ID]] = $v;
			};
	    if (MYSQL_QUERY_DEBUG) {
			alid($return);
			};
		return $return;
		}
	else {
	    if (MYSQL_QUERY_DEBUG) {
			alid($o);
			};
		return $o;
		};
	}


}
?>
