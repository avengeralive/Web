<?php
$pieces = explode('/',$application->getUnparsedUrl());
$math = $pieces[sizeof($pieces)-1];
$math = explode('.', $math);
$math = $math[0];

$URL_PATH = array();
$BREADCRUMB = array();
foreach($application->getCatalog()->getPath() as $c) {
    if (!$c->isRoot() && !$c->isServer()) $URL_PATH[] = $c->prototype->id;
    if (!$c->isRoot()) 
        	$BREADCRUMB[] = array(
        	  	'id'        => $c->id,
        	  	'name'      => $c->name,
        	  	'link'      => $c->url,
        	  	'alias'     => $c->alias,
        	  	'def_templ' => $c->template
        	);
}

$parent = $application->getCatalog()->id;
$root = $application->getServer()->id;

$u = \Cetera\Application::getInstance()->getUser();
if ($u) $GLOBALS['AUTHORIZED_USER'] = $u->fields;

function include_template($template,$_print=0,$prnt=0,$PARAM='') {
    global $parent, $URL_PATH, $math, $tpl, $smarty;
	
	$_mid_result = ob_get_contents();
	if ($_mid_result !== FALSE) ob_end_clean();
	ob_start();
	if (!isset($GLOBALS['template_stack'])) $GLOBALS['template_stack'] = array();
	$GLOBALS['template_stack'][] = $template;
	//include($template.'.php');
	include(Application::getInstance()->getTemplatePath($template.'.php'));
	array_pop($GLOBALS['template_stack']);
	$result = ob_get_contents();
	ob_end_clean();
	if ($_mid_result !== FALSE) {
		ob_start();
		print $_mid_result;
	}

    if ($_print)
  	    return $result;
        else print $result;
	
}

function var_by_name($name, $server = 0) { 
  return Application::getInstance()->getUserVar($name, $server);
}

function wherect($id, $name = 'idcat') {
    return $name.' in ('.implode(',',_wherect($id)).')';
}

function _wherect($id) {
    $c = Catalog::getById($id);
    if (!$c) return array();
    $children = array($c->prototype->id);
    foreach ($c->getChildren() as $child) {
        $children = array_merge($children, _wherect($child->prototype->id));
    }
    return $children;
}

// Создаёт массив подразделов
//  параметры:
//     id родительского раздела
//     поле сортировки подразделов
//     перечислять материалы как подразделы
function get_menu($id, $order = 'A.tag', $materials = FALSE, $active_math = FALSE) {
    global $math;
    
	  $menu = array();
	  if (!$id) return $menu;
	
    $c = Catalog::getById($id);
        
    $path = Application::getInstance()->getCatalog()->getPath();
        
    foreach($c->getChildren() as $child) {
        if ($child->isHidden()) continue;
        $menu[] = array(
            'id'   => $child->id,
            'dir'  => 1,
            'link' => $child->getUrl(),
            'name' => $child->name,
            'active' => $path->has($child),
            'tablename' => $child->alias,
            'describ' => $child->describ,
            'pic' => $child->pic
        );
    }

    if ($materials) {
		$r = select($id,"id, name, alias, CONCAT('".$c->getUrl()."',alias,'.html') as link",'','tag');
		while ($f = mysql_fetch_assoc($r)) {
			if ($active_math && ($f['alias'] == $math))
				$f['active'] = 1;
			    else $f['active'] = 0;
			$menu[] = $f;
		}
	}
	return $menu;

}

function id_by_dir($alias, $id) {
  
  if (!$id)
    $c = Application::getInstance()->getServer();
    else $c = Catalog::getById($id);
  if ($c) try {
    return $c->getChildByAlias($alias)->id;
  } catch (Exception $e) {
    return false;
  }
}

function name_to($id, $from = 1, $delim = ' / ', $reverse = FALSE) {
    $c = Catalog::getById($id);
    if (!$c) return false;
    $name = '';
    foreach ($c->getPath() as $item) {
        if ($from--) continue;        
        if ($reverse) 
            $name = $item->name.$delim.$name;
            else $name .= $delim.$item->name;   
    }
    return $name;
}

function path_to($id) {
  $c = Catalog::getById($id);
  if ($c) return $c->getUrl();
}

function dir_by_id($id) {
    try {
        $c = Catalog::getById($id);
        if ($c) return $c->alias;
    } catch (Exception $e) {
        return false;
    }
}

function type_by_id($_id) {
    try {
        $c = Catalog::getById($id);
        if ($c) return $c->materialsType;
    } catch (Exception $e) {
        return false;
    }
}


function pic_by_id($id) {
  $c = Catalog::getById($id);
  if ($c) return $c->pic;
}

function describ_by_id($id) {
  $c = Catalog::getById($id);
  if ($c) return $c->describ;
}

function name_by_id($id) {
    try {
        $c = Catalog::getById($id);
        if ($c) return $c->name;
    } catch (Exception $e) {
        return false;
    }
}

function table_by_id($id) {
  $c = Catalog::getById($id);
  if ($c) return $c->materialsTable;
}

function realcat($id) {
  $c = Catalog::getById($id);
  if ($c) return $c->prototype->id;
}

function parent_by_id($id) {
    try {
        $c = Catalog::getById($id);
        if ($c) return $c->parent->id;
    } catch (Exception $e) {
        return 0;
    }
}

function children($id) {
    $c = Catalog::getById($id);
    if (!$c) return FALSE;
    $children = array();
    foreach ($c->getChildren() as $child) $children[] = $child->id;
    return $children;
}

/**
 * Функции для работы с материалами
 *
 * @version $Id$
 * @copyright 2006 
 **/

/*
* Private
*/
function get_linked_table($tablefrom,$field) {

  $r = fssql_query("select A.type, A.len from types_fields A, types B where A.id=B.id and A.name='$field' and B.alias='$tablefrom'");
  $f = mysql_fetch_row($r);
  if ($f[0] == FIELD_MATSET) {
	return $GLOBALS['_table_type'][$f[1]];
  } elseif (($f[0] == FIELD_LINKSET)||($f[0] == FIELD_LINK)) {
    if ($f[1]) return table_by_id($f[1]);
	return $tablefrom;
  } else {
    return FALSE;
  }
}

/*
* select_links_in
* 
* Выбирает материалы в которых есть ссылка на заданный материал
* 
* param int ID заданного материала
* param string имя таблицы, к которой находится заданный материал
* param string имя поля, по которому связаны материалы
* param string список полей для выборки
* param string условие выборки материалов (аналог WHERE в SQL)
* param string условие сортировки материалов (аналог ORDER BY в SQL)
* param string условие группировки материалов (аналог GROUP BY в SQL)
* param string ограничение (аналог LIMIT в SQL)
* return mysql_result
*/
function select_links_in($idmath,$tablefrom,$field,$fields='*',$where='',$order='',$group='',$limit='') {

  //$tablefrom = table_by_id($idcat);
  $r = fssql_query("select A.len, A.type from types_fields A, types B where B.id=A.id and B.alias='$tablefrom' and A.name='$field' order by A.tag");

  $f = mysql_fetch_row($r);
  if ($f[1] == FIELD_LINKSET) {
    if ($f[0])
		$tableto = table_by_id($f[0]);
        else $tableto = $tablefrom;
  } elseif ($f[1] == FIELD_MATSET) {
	$tableto = table_by_type($f[0]);
  } else { 
    return FALSE;
  }
  $table = $tablefrom.'_'.$tableto.'_'.$field;

  $r = fssql_query("show tables like '$table'");
  if (mysql_num_rows($r)) {
    $where1 = '';
    if (is_array($idmath))
        $r = fssql_query("select id from $table where dest IN (".implode(',',$idmath).")");
        else $r = fssql_query("select id from $table where dest=$idmath");
	$ids = array();
	while ($f = mysql_fetch_row($r)) $ids[] = $f[0];
	$where1 = 'id IN ('.implode(',', $ids).')';
	if (sizeof($ids)) {

	  $sql = 'select '.$fields.' from '.$tablefrom.' where '.PUBLISHED.' and ('.$where1.')';
	  if ($where) $sql .= ' and '.$where;
	  if ($group) $sql .= ' group by '.$group;
	  if ($order) $sql .= ' order by '.$order;
	  if ($limit) $sql .= ' limit '.$limit;
	 // print $sql;
	  return fssql_query($sql);

	} else { return FALSE; }
	
  } else {
    return FALSE;
  }
}

/*
* select_links
* 
* Выбирает материалы на которые есть ссылка в заданном материале
* 
* param string имя таблицы, к которой находится заданный материал
* param int ID заданного материала
* param string имя поля, по которому связаны материалы
* param string список полей для выборки
* param string условие выборки материалов (аналог WHERE в SQL)
* param string условие сортировки материалов (аналог ORDER BY в SQL)
* param string условие группировки материалов (аналог GROUP BY в SQL)
* param string ограничение (аналог LIMIT в SQL)
* return mysql_result
*/
function select_links($tablefrom,$idmath,$field,$fields='*',$where='',$order='',$group='',$limit='') {

  //$tablefrom = table_by_id($idcat);
  $r = fssql_query("select A.len, A.type from types_fields A, types B where B.id=A.id and B.alias='$tablefrom' and A.name='$field' order by A.tag");
  $f = mysql_fetch_row($r);
  if ($f[1] == FIELD_LINKSET) {
  	 if ($f[0])
		$tableto = table_by_id($f[0]);
        else $tableto = $tablefrom;
  } elseif ($f[1] == FIELD_MATSET) {
	$tableto = $GLOBALS['_table_type'][$f[0]];
  } else { return FALSE; }
  $table = $tablefrom.'_'.$tableto.'_'.$field;
  $r = fssql_query("show tables like '$table'");
  if (mysql_num_rows($r)) {

      if ($order=='tag') $order='B.tag';
  
	  $sql = 'select '.$fields.' from '.$tableto.' A left join '.$table.' B ON (A.id=B.dest) where '.PUBLISHED.' and B.id='.$idmath;
	  if ($where) $sql .= ' and '.$where;
	  if ($group) $sql .= ' group by '.$group;
	  if ($order) $sql .= ' order by '.$order;
	  if ($limit) $sql .= ' limit '.$limit;
	  //print $sql.'<br>';
	  return fssql_query($sql);
	
  } else {
    return 0;
  }
}

/*
* get_links
* 
* Выбирает идентификаторы материалов на которые есть ссылка в заданном материале
* 
* param string имя таблицы, к которой находится заданный материал
* param int ID заданного материала
* param string имя поля, по которому связаны материалы
* return array
*/
function get_links($tablefrom,$idmath,$field) {

 // $tablefrom = table_by_id($idcat);
  $sql = "select A.len, A.type from types_fields A, types B where B.id=A.id and B.alias='$tablefrom' and A.name='$field'";
  //print $sql;
  $r = fssql_query($sql);
  $f = mysql_fetch_row($r);
  if ($f[1] == FIELD_LINKSET) {
  	 if ($f[0])
		$tableto = table_by_id($f[0]);
        else $tableto = $tablefrom;
  } else {
	$tableto = $GLOBALS['_table_type'][$f[0]];
  }
  $table = $tablefrom.'_'.$tableto.'_'.$field;
  $r = fssql_query("show tables like '$table'");
  if (mysql_num_rows($r)) {
    $sql = "select dest from $table where id=$idmath order by tag";
    $r = fssql_query($sql);
	while ($f = mysql_fetch_row($r)) {
	  $result[] = $f[0];
	}
	return $result;
  } else {
    return FALSE;
  }
}

/*
* select
* 
* Выбирает материалы из заданного раздела
* 
* param int ID заданного раздела
* param string список полей для выборки
* param string условие выборки материалов (аналог WHERE в SQL)
* param string условие сортировки материалов (аналог ORDER BY в SQL)
* param string условие группировки материалов (аналог GROUP BY в SQL)
* param string ограничение (аналог LIMIT в SQL)
* param boolean выбирать ли материалы из всех подразделов заданного раздела
* return mysql_result
*/
function select($idcat,$fields='*',$where='',$order='',$group='',$limit='',$subs=0) {
	if (!$idcat) return FALSE;
	$table = table_by_id($idcat);
	if (!$table) return FALSE;
	return _select($idcat, $table,$fields,$where,$order,$group,$limit,$subs);
}

/*
* Private
*/
function _select($idcat, $table, $fields='*',$where='',$order='',$group='',$limit='',$subs=0) {
  $ext = 0;
  $wherejoin = '';
  $orig_table = $table;
  $table .= ' A';
  if (preg_match_all('/([a-z][a-z]+)\.([a-z]+)/i',$fields,$fa))
  {
    $ord 	= ord('B');
    $ftable = $table;
    $ext 	= 1;
	//preg_match_all('/([a-z]+)\.([a-z]+)/i',$fields,$fa);
	foreach($fa[1] as $field)
	{
	  if (!$tables[$field])
	  {
	    $tables[$field] = chr($ord++);
	    if ($field == 'autor')
		{
		  $tbl = 'users';
		  $wherejoin .= " and $field=".$tables[$field].'.id';
		}
		elseif ($field == 'main')
		{
		  $tbl = 'dir_data';
		  $wherejoin .= " and idcat=".$tables[$field].'.id';
		}
		else
		{
		  $r = fssql_query("select A.len from types_fields A, types B where A.id=B.id and A.type=6 and A.name='$field' and B.alias='$ftable'");
		  $tbl = table_by_id(mysql_result($r,0));
		  $wherejoin .= " and $field=".$tables[$field].".id and ".$tables[$field].'.type&1=1';
		}
		$table 		.= ', '.$tbl.' '.$tables[$field];
	  }
	}
	while(list($src,$dst) = each($tables))
	{
      $fields = str_replace($src,$dst,$fields);
	  $where  = str_replace($src,$dst,$where);
	  $order  = str_replace($src,$dst,$order);
	  $group  = str_replace($src,$dst,$group);
	}
  }
  
  if ($idcat) {
	  if ($subs) {
	    $wherecat = ' and ('.wherect($idcat).')';
	  } else {
	    $wherecat = ' and idcat='.realcat($idcat);
	  }
  }
  $sql = 'select '.$fields.' from '.$table.' where '.PUBLISHED.$wherecat.$wherejoin;
  if ($where != 'INDEX') {
  	if ($where) $sql .= ' and ('.$where.')';
  } else {
  	$sql .= ' and (alias = "index")';
  }
  if ($group) $sql .= ' group by '.$group;
  if ($order) $sql .= ' order by '.$order;
  if ($where != 'INDEX') {
      if ($limit) $sql .= ' limit '.$limit;
  } else {
  	$sql .= ' limit 1';
  }
  if ($ext) {

    $r = fssql_query("show fields from $orig_table");
	while ($f = mysql_fetch_row($r))
	  $sql = preg_replace("/([^a-z|\.])($f[0][^a-z])/i",'\\1A.\\2',$sql);

  }
  //print "<font color='red'>".$sql."</font><br /><br />";
  $r = fssql_query($sql);
  if ($where == 'INDEX' && !mysql_num_rows($r)) {
  	  $sql = str_replace(' and (alias = "index")', '', $sql);
      $r = fssql_query($sql);
  }
  return $r;
}

// Карта сайта
//  параметры:
//     id раздела с которого начинать строить карту
function sitemap($id) {
	global $_curlevel;

	$link = path_to($id);
  	$map = array();
	$query = "SELECT A.id, A.tablename, A.name, B.level 
            FROM dir_data A, dir_structure B,  dir_structure C
            WHERE A.id=B.data_id and C.data_id=$id and B.lft BETWEEN C.lft and C.rght and B.level = C.level + 1
            ORDER by A.tag";
	$r = fssql_query($query);
    while ($f = mysql_fetch_assoc($r)) {
		$items = array();
		$items = array_merge($items, sitemap($f['id']));
		$map[] = array(
			'id'    => $f['id'],
        	'name'  => $f['name'],
			'level' => $f['level'],
      		'link'  => $link.$f['tablename'].'/',
			'items' => $items
		);
	}
	return $map;
}

// строка навигации
function navigation($length,$block_length,$current,$active,$ordinary,$delimeter) {

	$navbar = '';
	$blocks = (integer) ceil($length/$block_length);
	for ($i=1; $i <= $blocks; $i++) {
	  if ($i == $blocks) 
	    { $last = $length; } 
		else 
		  { $last = $i*$block_length; }
      if ($i == $current) {
	    $str = str_replace('{COUNTER}',$i,$active);
	  } else {
	    $str = str_replace('{COUNTER}',$i,$ordinary);
	  }
	  $str = str_replace('{FROM}',(($i-1)*$block_length+1),$str);
	  $str = str_replace('{TO}',$last,$str);
	  $navbar .= $str;
	  if ($i != $blocks) $navbar .= $delimeter;
	}

	return $navbar;
}

function is_email($email) {
  return ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $email);
}

function filesize_ex($file, $suf = array(" B", " KB", " MB", " GB", " TB")) {
   // First check if the file exists.
   if(!is_file($file)) return;
   // Setup some common file size measurements.
   $kb = 1024;         // Kilobyte
   $mb = 1024 * $kb;   // Megabyte
   $gb = 1024 * $mb;   // Gigabyte
   $tb = 1024 * $gb;   // Terabyte
   // Get the file size in bytes.
   $size = filesize($file);
   /* If it's less than a kb we just return the size, otherwise we keep going until
   the size is in the appropriate measurement range. */
   if($size < $kb) {
       return $size.$suf[0];
   }
   elseif($size < $mb) {
       return round($size/$kb,2).$suf[1];
   }
   elseif($size < $gb) {
       return round($size/$mb,2).$suf[2];
   }
   elseif($size < $tb) {
       return round($size/$gb,2).$suf[3];
   }
   else {
       return round($size/$tb,2).$suf[4];
   }
}


DEFINE('ERROR_INVALID_PARAMS', -1);
DEFINE('ERROR_CAT_EXISTS', -2);
DEFINE('ERROR_CAT_PHYSICAL_EXISTS', -3);
DEFINE('ERROR_MATERIAL_NOT_FOUND', -4);
DEFINE('ERROR_USER_NOT_FOUND', -5);
DEFINE('ERROR_INVALID_PASSWORD', -6);
DEFINE('ERROR_AUTHORIZATION_FAILED', -7);
DEFINE('ERROR_INVALID_EMAIL', -8);
DEFINE('ERROR_SQL', -9);
DEFINE('ERROR_USER_EXISTS', -10);
DEFINE('ERROR_PASSWORDS_DOESNT_MATCH', -11);
DEFINE('ERROR_SERVER_NOT_FOUND', -12);
DEFINE('ERROR_TYPE_EXISTS',      -13);
DEFINE('ERROR_EMAIL_EXISTS',     -14);
DEFINE('ERROR_CANT_CREATE',      -15);
DEFINE('ERROR_MESSAGE_EXISTS',   -16);
DEFINE('ERROR_NO_RIGHTS',        -17);

define('CAT_DEFAULT', 1);
define('CAT_INHERIT', 2);
define('CAT_SAMETYPE',4);
define('CAT_LINKED', 16);
define('CAT_AUTOALIAS', 32);
define('CAT_EDITDATE', 64);
define('CAT_AUTOALIAS_TRANSLIT', 128);


/*
* smart_select
* 
* Выбирает материалы из заданного раздела
* 
* param int ID заданного раздела
* param array список полей для выборки
* param string условие выборки материалов (аналог WHERE в SQL)
* param string условие сортировки материалов (аналог ORDER BY в SQL)
* param string условие группировки материалов (аналог GROUP BY в SQL)
* param string ограничение (аналог LIMIT в SQL)
* param boolean выбирать ли материалы из всех подразделов заданного раздела
* return array
*/
function smart_select($idcat, $fields, $where='',$order='',$group='',$limit='',$subs=0) {
	$GLOBALS['_fetched_materials'] = array();
	$type_id = type_by_id($idcat);
	if (!$type_id) return FALSE;
	return _smart_select($idcat, $type_id, $fields, $where,$order,$group,$limit,$subs);
}

/*
* Private
*/
function _smart_select($idcat, $type_id, $fields, $where='',$order='',$group='',$limit='',$subs=0) {
	
	$ord 	= ord('B');
	
	if (!is_array($fields) && $fields != '*') return FALSE;
	$type_fields  = _get_fields($type_id);
	if (!$type_fields) return FALSE;
	$plain_fields = array('A.id');
	$form_fields = array();
	$link_fields = array();
	$mat_fields = array();
	$hlink_fields = array();
	$linkset_fields = array();
	$mathset_fields = array();
	
	$processed  = array();
	//$ext_tables = array();
	
	if ($fields == '*') {
	    $fields = array_keys($type_fields);
	}
	foreach ($fields as $field) {
		if (!isset($type_fields[$field])) {
		    $plain_fields[] = $field;
		} else {
			switch($type_fields[$field]['type']){
				case FIELD_FORM: 
					$form_fields[] = $field;
					$plain_fields[] = 'A.'.$field;
					break;
				case FIELD_LINK: 
					$link_fields[] = $field;
					$plain_fields[] = 'A.'.$field;
					break;
				case FIELD_MATERIAL: 
					$mat_fields[] = $field;
					$plain_fields[] = 'A.'.$field;
					break;
				case FIELD_HLINK: 
					$hlink_fields[] = $field;
					$plain_fields[] = 'A.'.$field;
					break;
				case FIELD_LINKSET: 
					$linkset_fields[] = $field;
					break;
				case FIELD_MATSET: 
					$mathset_fields[] = $field;
					break;
				case FIELD_DATETIME: 
					$plain_fields[] = 'A.'.$field;
					$plain_fields[] = 'UNIX_TIMESTAMP('.'A.'.$field.') as '.$field.'_stamp';
					break;
				default:
					$plain_fields[] = 'A.'.$field;
			} // switch
		}
	}
	foreach ($type_fields as $fld) if ($fld['type'] != FIELD_MATSET && $fld['type'] != FIELD_LINKSET) {
		$group = preg_replace("/(\b)(".$fld['name'].")(\b)/i",'\\1A.\\2\\3',$group);
		$order = preg_replace("/(\b)(".$fld['name'].")(\b)/i",'\\1A.\\2\\3',$order);
	}
	
	//$r = _select($idcat, $GLOBALS['_table_type'][$type_id], implode(',', $plain_fields), $where, $order, $group, $limit, $subs);
	
	  if ($idcat)
		  if ($subs) {
		    $wherecat = ' and ('.wherect($idcat, 'A.idcat').')';
		  } else {
		    $wherecat = ' and A.idcat='.realcat($idcat);
		  }
		   
	  $fields = implode(',', $plain_fields);
	  $tables = $GLOBALS['_table_type'][$type_id].' A';
	  $wher  = 'A.type&1=1 '.$wherecat;
		
	  if (preg_match_all('/([a-z]+)::([a-z]+)/i',$where,$match)) {
	  	foreach ($match[1] as $id => $field) {
			if (isset($processed[$field])) {
				$where = str_replace($match[0][$id], $processed[$field].'.'.$match[2][$id], $where);
			    continue;
			}
			switch($type_fields[$field]['type']){
				case FIELD_LINK: 
					$t = table_by_id($type_fields[$field]['len']);
					$b = chr($ord++);
					$tbl = $t.' '.$b;
					$tables .= ' LEFT JOIN '.$tbl.' ON (A.'.$field.'='.$b.'.id)';
					$where = str_replace($match[0][$id], $b.'.'.$match[2][$id], $where);
					$processed[$field] = $b;
					//$ext_tables[$b] = $field;
					break;
				case FIELD_MATERIAL: 
					$t = table_by_type($type_fields[$field]['len']);
					$b = chr($ord++);
					$tbl = $t.' '.$b;
					$tables .= ' LEFT JOIN '.$tbl.' ON (A.'.$field.'='.$b.'.id)';
					$where = str_replace($match[0][$id], $b.'.'.$match[2][$id], $where);
					$processed[$field] = $b;
					//$ext_tables[$b] = $field;
					break;
				case FIELD_LINKSET: 
					$t = table_by_id($type_fields[$field]['len']);
					$b = chr($ord++);
					$tbl = $t.' '.$b;
					$c = chr($ord++);
					$ltbl= $GLOBALS['_table_type'][$type_id].'_'.$t.'_'.$field.' '.$c;
					$tables .= ' LEFT JOIN '.$ltbl.' ON (A.id='.$c.'.id) LEFT JOIN '.$tbl.' ON ('.$c.'.dest='.$b.'.id)';
					$where = str_replace($match[0][$id], $b.'.'.$match[2][$id], $where);
					$processed[$field] = $b;
					//$ext_tables[$b] = $field;
					break;
				case FIELD_MATSET: 
					$t = table_by_type($type_fields[$field]['len']);
					$b = chr($ord++);
					$tbl = $t.' '.$b;
					$c = chr($ord++);
					$ltbl= $GLOBALS['_table_type'][$type_id].'_'.$t.'_'.$field.' '.$c;
					$tables .= ' LEFT JOIN '.$ltbl.' ON (A.id='.$c.'.id) LEFT JOIN '.$tbl.' ON ('.$c.'.dest='.$b.'.id)';
					$where = str_replace($match[0][$id], $b.'.'.$match[2][$id], $where);
					$processed[$field] = $b;
					//$ext_tables[$b] = $field;
					break;
			}
		}
		//print $tables.'<br>';
		//print $where.'<br>';
	  }
		  
	  if ($where != 'INDEX') {
	  	if ($where) $wher .= ' and ('.$where.')';
	  } else {
	  	$wher .= ' and (A.alias = "index")';
	  }
		  
	  $sql = 'SELECT '.$fields.' FROM '.$tables.' WHERE '.$wher;
  
	  if ($group) $sql .= ' GROUP BY '.$group;
	  if ($order) $sql .= ' ORDER BY '.$order;
	  if ($limit) $sql .= ' limit '.$limit;
	
	//print $sql.'<br><br>';
	$r = fssql_query($sql);
	
	if (!$r) return FALSE;
	$result = array();
	while($f = mysql_fetch_assoc($r)){
		if (isset($GLOBALS['_fetched_materials'][$type_id.'_'.$f['id']])) {
			$result[] = &$GLOBALS['_fetched_materials'][$type_id.'_'.$f['id']];
		    continue;
		}
		$GLOBALS['_fetched_materials'][$type_id.'_'.$f['id']] = TRUE;
		if ($f['idcat'] > 0) {
		    $f['path'] = path_to($f['idcat']);
		}
		if (function_exists('get_form'))
			foreach ($form_fields as $field)
				if ($f[$field]) 
				    $f[$field] = get_form($f[$field]);
					else unset($f[$field]);
		foreach ($link_fields as $field)
			if ($f[$field]) {	
				if ($type_fields[$field]['len'] == -1) {
  
				} elseif ($type_fields[$field]['len'] == -2) {
					if (function_exists('get_user_data'))
						$l[0] = get_user_data($f[$field]); 
				} else {
					$l = smart_select(($type_fields[$field]['len'])?$type_fields[$field]['len']:$idcat, '*', 'id='.$f[$field]);
				}
				if (is_array($l)) $f[$field] = $l[0];
			}
			
		foreach ($hlink_fields as $field)
			if ($f[$field])
				$f[$field] = get_hyperlink($f[$field]);
		foreach ($linkset_fields as $field) {
			$l = get_links($GLOBALS['_table_type'][$type_id], $f['id'], $field);
			$f[$field] = array();
			if (is_array($l)) foreach($l as $mid) {
				if (isset($GLOBALS['_fetched_materials'][type_by_id($type_fields[$field]['len']).'_'.$mid])) {
					$f[$field][] = &$GLOBALS['_fetched_materials'][type_by_id($type_fields[$field]['len']).'_'.$mid];
				} else {
					$k = _smart_select(0, type_by_id($type_fields[$field]['len']), '*', 'id='.$mid);
					if (is_array($k)) $f[$field][] = $k[0];
				}
			}
		}
		foreach ($mathset_fields as $field) {
			$l = get_links($GLOBALS['_table_type'][$type_id], $f['id'], $field);
			$f[$field] = array();
			if (is_array($l)) foreach($l as $mid) {
				if (isset($GLOBALS['_fetched_materials'][$type_fields[$field]['len'].'_'.$mid])) continue;
				$k = _smart_select(0, $type_fields[$field]['len'], '*', 'id='.$mid);
				if (is_array($k)) $f[$field][] = $k[0];
			}
		}
		foreach ($mat_fields as $field) {
			$k = _smart_select(0, $type_fields[$field]['len'], '*', 'id='.$f[$field]);
			if (is_array($k)) $f[$field] = $k[0];
		}
		$GLOBALS['_fetched_materials'][$type_id.'_'.$f['id']] = $f;
		$result[] = $f;
	} // while
	return $result;
}

function get_hyperlink($link_id) {
	$r = fssql_query('SELECT * FROM field_link WHERE link_id='.(int)$link_id);
	$a = mysql_fetch_assoc($r);
	$a = _get_hyperlink($a);
	return $a;
}

function _get_hyperlink($a) {
    if ($a['structure_id']) {
        if ($a['structure_type'] == 'main') {
            $a['link_value'] = path_to($a['structure_id']);
			$a['name'] = name_by_id($a['structure_id']);
        } else {
			$r = fssql_query('SELECT idcat, alias, name FROM '.$a['structure_type'].' WHERE id='.$a['structure_id']);
			if (mysql_num_rows($r)) {
			    $b = mysql_fetch_assoc($r);
				$a['link_value'] = path_to($b['idcat']).$b['alias'].'.html';
				$a['alias'] = $b['alias'];
				$a['idcat'] = $b['idcat'];
				$a['name'] = $b['name'];
			}
		}
    }
	return $a;
}