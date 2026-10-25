<?php 
namespace lib;

/**
* class.CCSS.php
*
*Класс - библиотека с функциями для работы с CSS/JS
*подгружается через автоподгрузку классов
*
**/

class CCSS {

	function pagecssjs($selector = null, $page = null) {
		
		if ($selector == null) $selector = $_GET['selector'];
		if ($page == null) $page = $_GET['page'];

		$table = 'mod_menu_'. $selector;
        $mod_menu = $selector .'_editor';

		$cssID  = [];
		$home 	= '';
		$all  	= '';
		$css	= '';
		
		//css
 		$hasharr = JBase::Get_Field_Value_From_Id('my_menu', $page, $mod_menu);
 		$hasharr = explode(',', $hasharr);
 		foreach ( $hasharr as $hash ) {
 			$Result = JBase::Get_List($table, 'hash', $hash, 'id');
			while($numrow = $Result->fetch_assoc()) {
				if($numrow['this'] == 'true') {
					$css .= htmlspecialchars_decode($numrow['css'], ENT_QUOTES);
					$cssID[$numrow['id']] = $numrow['id'];
				}
			}
 		}
		
		//home
		$Result2 = JBase::Get_List($table, 'home', 'true', 'id');
		while($numrow2 = $Result2->fetch_assoc()) {
			$home .= htmlspecialchars_decode($numrow2['css'], ENT_QUOTES);
		}
		
		//all
		$Result3 = JBase::Get_List($table, 'all', 'true', 'id');
		while($numrow3 = $Result3->fetch_assoc()) {
			$all .= htmlspecialchars_decode($numrow3['css'], ENT_QUOTES);
		}

		if($selector == 'css') {
			$conn = new LocalConnection();
			$conn->SendFile($css, DOMAIN . '/css/' . $page . '.css');
			$conn->SendFile($home, DOMAIN . '/css/home.css');
			$conn->SendFile($all, DOMAIN . '/css/all.css');

		}
		else if($selector == 'js') {
			$conn = new LocalConnection();
			$conn->SendFile($css, DOMAIN . '/script' . DS . $page . '.js');
			$conn->SendFile($home, DOMAIN . '/script/home.js');
			$conn->SendFile($all, DOMAIN . '/script/all.js');	

		}
		return $conn;
	}
	
}
