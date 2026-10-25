<?php 
namespace lib;

if (!defined('VOCU_FWK')) die(); // не работает без нашего фреймверка

/**
* class.CEmail.php
*
* Библиотека с функциями для работы модуля e-mail рассылок
* подгружается через автоподгрузку классов
*
* История: 07.07.2017 - файл создан
*
**/

class CEmail {
	//список шаблонов рассылки
	function mail_list() {
		$Result = JBase::Get_Full_Table_From_Domain('email');				
	    if (!empty($Result))
			$items = array();
			while ($item = $Result->fetch_assoc()) 
				$items[] = $item;
			return $items;
	}
	//сохранение шаблона
	function mail_save() {
        return JBase::Update_Data('email', ['name' => $_POST['name'], 'html' => $_POST['html']], ['id' => (int)$_POST['id']]);
	}
	//email уведомления в list_id
	function list_notify() {
		$notify = implode('_', [(int)$_POST['param'][1], (int)$_POST['param'][2], (int)$_POST['param'][3]]);
        return JBase::Update_Data('list_table', ['email' => $notify], ['domain_id' => (int)$_POST['param'][0]]);
	}
	//получение данных по чекбоксам
	function check_list() {
		$Result = JBase::Get_Data('list_table', ['id','email'], '');				
	    if (!empty($Result))
			$items = array();
			while ($item = $Result->fetch_assoc()) 
				$items[] = $item;
			return $items;
	}
}



