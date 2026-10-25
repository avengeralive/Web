<?php 
namespace lib;

if (!defined('VOCU_FWK')) die(); //не работает без нашего фреймверка

/**
* class.Roles.php
*
*Класс - библиотека с функциями для ответов ajax для работы с ролями пользователей
*подгружается через автоподгрузку классов
*
* История:  2016.12.12 - файл создан
*
**/

class Roles {
	
	//запрос списка пользователей
	function getUsers($token) {
    	if ( userType(CUser::user($token)) == '1' ) {
        	$items = [];
			$tagsarr = ['id','name','email','roles','status','usertype','job'];
        	$Result = JBase::Get_Data('my_users', $tagsarr);
			while ($item = $Result->fetch_assoc()) 
				$items[] = $item;
			return $items;
		}
	}

	//Галочки
	function role() {	
    	if ( userType(CUser::user(TOKEN)) == '1' ) {
			$table = (isset($_POST['role']) && $_POST['role'] == 'user') ? 'my_users' : 'my_users_group';
			return JBase::Update_Data_Nodomain($table, ['roles' => JBase::escape($_POST['data'])], ['id' => (int)substr($_POST['id'], 1)]);
		}
	}

	//общий фид
	function compare() {	
		$value = ($_POST['status'] == 'true') ? '1' : '0';
		JBase::Update_Data('templates', ['compare_feeds' => $value], '');
		return self::feed_new([USERID, DOMAIN]);
	}
	
	//запрос всех доступных площадок для выгрузки
	function getAll($token) {
    	if ( userType(CUser::user($token)) == '1' ) {
			//запрос всех доступных площадок для выгрузки
			$Result = JBase::Get_Full_Table('my_users_group');
			if (!empty($Result)) {
				$items = [];
				while ($item = $Result->fetch_assoc()) {
				$items[] = $item;
					}
				return $items;
			}
		}		
	}
}
