<?php
	if(isset($_GET['menu'])){
		$menu = htmlspecialchars($_GET['menu']);
		if(file_exists('./ajax/menu/'.$menu.'.php')){
			include('./ajax/menu/'.$menu.'.php');
		}else{
			echo 'Раздела '.$menu.' не существует';
		}
	}else{
		echo 'Добро пожаловать в админ панель';
	}