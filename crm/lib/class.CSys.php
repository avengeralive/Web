<?php 
namespace lib;
if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймворка

/**
* class.CSys.php 
*
*Класс - библиотека с функциями для работы с системными функциями  
*подгружается через автоподгрузку классов
*
* История:  2016.12.12 - файл создан
* История:  2017.03.26 - файл изменен, объединены функции
*
**/

class CSys {
	public static $modhtml = null;
	public static $modtemplate = null;
	public static $modhead = null;

	// формируем HTML-шаблоны
	function get_list_rows() {
		$Result = JBase::Get_Columns('list'. (int)$_GET['page_id']);
		while( $item = $Result->fetch_assoc() ) {
			$response[ $item['Field'] ] = $item['Default'];
		}
		return ($response);	
	}
	// формируем HTML-шаблоны
	function get_static_data() {   
		include_once  $_SERVER["DOCUMENT_ROOT"].'/lib.php';
		$json = &$GLOBALS['JSON'];
		$json['result'] = [];
	
		$arrays = explode( ';', $_POST['list'] );
		foreach( $arrays as $index )
			if( isset($GLOBALS['LISTS'][$index]) )
				$json['result'][ $index ] = &$GLOBALS['LISTS'][$index];
	
			json_good();
			json_result();
	}
	//хлебные крошки
	public static function Crumbss($Page) {
		//если не главная
		if (!empty($_GET['page'])) {
			$Data = '<a href="/">Главная</a>';
			$id_menu = JBase::Get_Field_Value_From_Id('my_menu', $Page, 'id_menu');
			$Menu = JBase::Get_Data('my_menu', ['id','cpu','title','id_parent'], ['id_menu'=>(int)$id_menu], 'ordering');
			
            $Crumbs = [];
			while($Rows = $Menu->fetch_assoc()) {
				$Crumbs[$Rows['id']]['id'] = $Rows['id'];
				$Crumbs[$Rows['id']]['cpu'] = $Rows['cpu'];
				$Crumbs[$Rows['id']]['title'] = $Rows['title'];
				$Crumbs[$Rows['id']]['id_parent'] = $Rows['id_parent'];
			}		
			foreach ($Crumbs as $id) {
				$Cpu = ( $id['cpu'] != '' ) ? $id['cpu'] : $id;				
				if ( $id['id'] == $Page && $id['id_parent'] != '0' && $Cpu != 'card') {
					$Data .= '<a>»</a><a href="/'. $Crumbs[$id['id_parent']]['cpu'] .'">'. $Crumbs[$id['id_parent']]['title'] .'</a>';
				}
				if ( $id['id'] == $Page && $Cpu != 'card')
					$Data .= '<a>»</a><a href="/'. $Cpu .'">'. $id['title'] .'</a>';
					
				if ( $id['id'] == $Page && $Cpu == 'card' && (substr(strtolower($_SERVER['REQUEST_URI']), 0, 6) == "/card?"))
					$Data .= '<a>»</a><a href="/'. $Cpu .'?'. substr($_SERVER['REQUEST_URI'], 6) .'">'. $id['title'] . substr($_SERVER['REQUEST_URI'], 6) .'</a>'; 

			}
 			return $Data;
		} else return '';
	}
	//шаблон модуля "Дублирующее меню - Шаблон default"
	public static function double_default($id_menu, $id_start) {
		$modtemplate = '';
		$test_one_ul = 0;
		
		if (!empty($id_start)) $Result = JBase::Get_Data('my_menu', '*', ['id_parent'=>$id_start, 'published'=>'1']);
		else $Result = JBase::Get_Data('my_menu', '*', ['id_parent' => $id_menu, 'published'=>'1']);
		while ($numrow = $Result->fetch_assoc()) {			 
				
			if ($test_one_ul == 0) {
				$modtemplate .= '<ul class="double_'. $numrow['id'] .'">';
				$test_one_ul = 1;
			}				 
			$Cpu = ( $numrow['cpu'] != '' ) ? $numrow['cpu'] : $numrow['id'];
			$modtemplate .= '<li><a href="/'. $Cpu .'">'. $numrow['title'] .'</a>';				 
			if (JBase::Test_Data('my_menu', JBase::Where_List_ToStr(['id_parent'], [$numrow['id']]))) {
				$Result1 = JBase::Get_Data('my_menu', '*', ['id_parent' => $numrow['id'], 'published'=>'1']);
				$test_one_ul = 0;
				
				while ($numrow1 = $Result1->fetch_assoc()) { 
					if ($test_one_ul == 0) {
						$modtemplate .= '<ul>';
						$test_one_ul = 1;
					} 
					$Cpu1 = ( $numrow1['cpu'] != '' ) ? $numrow1['cpu'] : $numrow1['id'];
					$modtemplate .= '<li><a href="/' . $Cpu1 . '">'. $numrow1['title'] . '</a>';							 
					$Result2   = JBase::Get_Data('my_menu', '*', ['id_parent' => $numrow1['id'], 'published'=>'1']);
					if (JBase::Test_Data('my_menu', JBase::Where_List_ToStr(['id_parent'], [$numrow1['id']]))) {
						$test_one_ul = 0;
						
						while ($numrow2 = $Result2->fetch_assoc()) {						
							if ($test_one_ul == 0) {
								$modtemplate .= '<ul>';
								$test_one_ul = 1;
							}
							$Cpu2 = ( $numrow2['cpu'] != '' ) ? $numrow2['cpu'] : $numrow2['id'];
							$modtemplate .= '<li><a  href="/' . $Cpu2 . '">'. $numrow2['title'] . '</a></li>';
						}
						$modtemplate .= ' </ul>';
					}							 
					$modtemplate .= '  </li>';					
				}										 
				$modtemplate .= '</ul>';
			}
		}		 
		$modtemplate .= '</li></ul>';
		return $modtemplate;
	}
	//шаблон модуля "Дублирующее меню - Шаблон default2"
	function double_default2($id_menu, $id_start) {
		
		$modtemplate .= '<ul class="double_' . $id_menu . '">';
		if (!empty($id_start)) $Result = JBase::Get_List('my_menu', 'id_parent', $id_start, 'ordering');
		else $Result = JBase::Get_List('my_menu', 'id_parent', $id_menu, 'ordering');
		while ($numrow = $Result->fetch_assoc()) {
			$Cpu = ( $numrow['cpu'] != '' ) ? $numrow['cpu'] : $numrow['id'];
			$modtemplate .= '<li><a href="/' . $Cpu . '">' . $numrow['title'] . '</a></li>';
		} $modtemplate .= '</ul>';
	
		return $modtemplate;
	}
	
	//модуль банки-партнеры
	public static function banks() {
		$Exit = '<p>Мы являемся партнёрами следующих банков</p>';
		$Bank = '';
		$banks = CPanel::get_banks();
		for ($i = 0; $i < count($banks['result']); $i++) { 
			if (in_array($banks['result'][$i]['id'], $banks['banks'])) {
				$Bank .= '<img src="'. $banks['result'][$i]['logo'] .'" />';
			}
		}
		if ($Bank != '') $Bank = $Exit . $Bank;
 		return $Bank;
	}

	//модуль пользователи
	public static function users() {
		$Exit = '<h2>Сотрудники</h2>';
		$Users = '';
		$Result = JBase::Get_Data('my_users', '*', ['status' => '1']);
		if (!empty($Result)) {
			$items = [];
			while ($item = $Result->fetch_assoc()) {
				$items[] = $item;
			}
		
			for ($i = 0; $i < count($items); $i++) { 
				$ava = (!empty($items[$i]['avatar']) && $items[$i]['avatar'] != 'nophoto.png') ? '/cdn/'. DOMAIN .'/avatar/'. $items[$i]['avatar'] : '/cdn/lib/man.png';
				if ($items[$i]['name'] != '00')
				$Users .= '<div class="user">
					<img alt="" src="'. $ava .'" /><div class="inner">
					<b>'. $items[$i]['name'] .'</b>
					<i>'. $items[$i]['job'] .'</i>
					<span><a href="tel:'. $items[$i]['phone'] .'">'. $items[$i]['phone'] .'</a></span>
					<span><a href="mailto:'. $items[$i]['email'] .'">'. $items[$i]['email'] .'</a></span>
					<p>'. $items[$i]['textarea'] .'</p>
				</div></div>';
			}
		}
		if ($Users != '') $Users = $Exit . $Users;
 		return $Users;
	}

	//модуль карта с объектами
	public static function mod_map() {
		$Exit = '<h2>Сотрудники</h2>';
		$Users = '';
		$Result = JBase::Get_Data('my_users', '*', ['status' => '1']);
		if (!empty($Result)) {
			$items = [];
			while ($item = $Result->fetch_assoc()) {
				$items[] = $item;
			}
		
			for ($i = 0; $i < count($items); $i++) { 
				$ava = (!empty($items[$i]['avatar']) && $items[$i]['avatar'] != 'nophoto.png') ? '/cdn/'. DOMAIN .'/avatar/'. $items[$i]['avatar'] : '/cdn/lib/man.png';
				if ($items[$i]['name'] != '00')
				$Users .= '<div class="user">
					<img alt="" src="'. $ava .'" /><div class="inner">
					<b>'. $items[$i]['name'] .'</b>
					<i>'. $items[$i]['job'] .'</i>
					<span><a href="tel:'. $items[$i]['phone'] .'">'. $items[$i]['phone'] .'</a></span>
					<span><a href="mailto:'. $items[$i]['email'] .'">'. $items[$i]['email'] .'</a></span>
					<p>'. $items[$i]['textarea'] .'</p>
				</div></div>';
			}
		}
		if ($Users != '') $Users = $Exit . $Users;
 		return $Users;
	}
	//модуль контакты с картой
	public static function mod_contacts() {
		$Exit = '<h2>Сотрудники</h2>';
		$Users = '';
		$Result = JBase::Get_Data('my_users', '*', ['status' => '1']);
		if (!empty($Result)) {
			$items = [];
			while ($item = $Result->fetch_assoc()) {
				$items[] = $item;
			}
		
			for ($i = 0; $i < count($items); $i++) { 
				$ava = (!empty($items[$i]['avatar']) && $items[$i]['avatar'] != 'nophoto.png') ? '/cdn/'. DOMAIN .'/avatar/'. $items[$i]['avatar'] : '/cdn/lib/man.png';
				if ($items[$i]['name'] != '00')
				$Users .= '<div class="user">
					<img alt="" src="'. $ava .'" /><div class="inner">
					<b>'. $items[$i]['name'] .'</b>
					<i>'. $items[$i]['job'] .'</i>
					<span><a href="tel:'. $items[$i]['phone'] .'">'. $items[$i]['phone'] .'</a></span>
					<span><a href="mailto:'. $items[$i]['email'] .'">'. $items[$i]['email'] .'</a></span>
					<p>'. $items[$i]['textarea'] .'</p>
				</div></div>';
			}
		}
		if ($Users != '') $Users = $Exit . $Users;
 		return $Users;
	}
}
