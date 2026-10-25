<?php
//Добавление предметов

//Добавление данных в базу
if( isset($_POST['it_name']) &&  isset($_POST['it_img']) ) {
	$_POST['it_name'] = iconv("UTF-8", "windows-1251", $_POST['it_name']);
	//Добавляем предмет
	$error = '';

	if( (int)$_POST['it_group_max'] > 0 ) {
		$_POST['it_group'] = 1;
	}

	$ins = mysql_query('INSERT INTO `items_main`
		(`name`,`img`,`type`,`massa`,`price1`,`price2`,`iznosMAXi`,`inslot`,
		 `inRazdel`,`info`,`group`,`group_max`,`geni`,`srok`,`max_text`,`2h`,`2too`) VALUES
		(
			"'.mysql_real_escape_string($_POST['it_name']).'",
			"'.mysql_real_escape_string($_POST['it_img']).'",
			"'.mysql_real_escape_string($_POST['it_type']).'",
			"'.mysql_real_escape_string($_POST['it_massa']).'",
			"'.mysql_real_escape_string($_POST['it_price1']).'",
			"'.mysql_real_escape_string($_POST['it_price2']).'",
			"'.mysql_real_escape_string($_POST['it_iznos']).'",
			"'.mysql_real_escape_string($_POST['it_slot']).'",
			"'.mysql_real_escape_string($_POST['it_inRazdel']).'",
			"'.mysql_real_escape_string($_POST['it_info']).'",
			"'.mysql_real_escape_string($_POST['it_group']).'",
			"'.mysql_real_escape_string($_POST['it_group_max']).'",
			"'.mysql_real_escape_string($_POST['it_geni']).'",
			"'.mysql_real_escape_string($_POST['it_srok']).'",
			"'.mysql_real_escape_string($_POST['it_max_text']).'",
			"'.mysql_real_escape_string($_POST['it_2h']).'",
			"'.mysql_real_escape_string($_POST['it_2too']).'"
		)');
		
		if( $ins ) {
			$iid = mysql_insert_id();
			$ins = mysql_query('INSERT INTO `items_main_data` (`items_id`,`data`) VALUES (
				"'.$iid.'","'.mysql_real_escape_string($_POST['it_data_value']).'"
			)');
			if( !$ins ) {
				$error = 'Неудалось добавить Er::(2)!';
			}else{
				$error = $iid.' Предмет добавлен!';
			}
		}else{
			$error = 'Неудалось добавить Er::(1)!';
		}
	if( $error == '' ) {
		$error = 'Что-то не так...';
	}
	die(''.$error.'');
}
if(isset($_FILES["file"]["type"])){
	$validextensions = array("jpeg", "jpg", "png", "gif");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/gif")
	) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
	&& in_array($file_extension, $validextensions)) {
		if ($_FILES["file"]["error"] > 0){
			echo "Ошибка: " . $_FILES["file"]["error"] . "<br/>";
		}
		else{
			if (file_exists("https://img.testcombats.ru/i/items/" . $_FILES["file"]["name"])){
				echo $_FILES["file"]["name"] . " <b>уже сужествует.</b>";
			}
			else{
				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = "https://img.testcombats.ru/i/items/".$_FILES['file']['name']; // Target path where file is to be stored
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "<script>$('#it_img').val('" . $_FILES["file"]["name"] . "');</script>Картинка загружена успешно!<br/>";
				echo "<br/><b>Название файла:</b> " . $_FILES["file"]["name"] . "<br>";
				echo "<b>Тип:</b> " . $_FILES["file"]["type"] . "<br>";
				echo "<b>Размер:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				//echo "<b>Временное название:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
			}
		}
	}
	else{
		echo "<span id='invalid'>***Неверный размер файла или тип***<span>";
	}
	die();

}




$trebovaniya = array(
	'align_bs' => 'Служитель закона','align'=>'Склонность','sex'=>'Пол','lvl'=>'Уровень','s1'=>'Сила','s2'=>'Ловкость','s3'=>'Интуиция','s4'=>'Выносливость','s5'=>'Интеллект','s6'=>'Мудрость','s7'=>'Духовность','s8'=>'Воля','s9'=>'Свобода духа','s10'=>'Божественность','a1'=>'Мастерство владения ножами, кинжалами','a2'=>'Мастерство владения топорами, секирами','a3'=>'Мастерство владения дубинами, молотами','a4'=>'Мастерство владения мечами','a5'=>'Мастерство владения магическими посохами','a6'=>'Мастерство владения луками','a7'=>'Мастерство владения арбалетами','aall'=>'Мастерство владения оружием','mall'=>'Мастерство владения магией стихий','m2all'=>'Мастерство владения магией','mg1'=>'Мастерство владения магией огня','mg2'=>'Мастерство владения магией воздуха','mg3'=>'Мастерство владения магией воды','mg4'=>'Мастерство владения магией земли','mg5'=>'Мастерство владения магией Света','mg6'=>'Мастерство владения магией Тьмы','mg7'=>'Мастерство владения серой магией','rep'=> 'Репутация Рыцаря'
);

$deystvuet = array(
	'acestar' => 'Следующий каст будет критическим', 'spasenie' => 'Спасение после смерти','more_awards' => 'Повышеная награда %', 'exp' => 'Получаемый опыт (%)', 'align_bs' => 'Служитель закона',
	'nopryh' => 'Прямое поподание', 'puti'=>'Запрет перемещения','align'=>'Склонность','hpAll'=>'<font color=darkgreen><b>Уровень жизни (HP)</font></b>','mpAll'=>'<font color=blue><b>Уровень маны</font></b>','enAll'=>'Уровень энергии','sex'=>'Пол','lvl'=>'Уровень','s1'=>'Сила','s2'=>'Ловкость','s3'=>'Интуиция','s4'=>'Выносливость','s5'=>'Интеллект','s6'=>'Мудрость','s7'=>'Духовность','s8'=>'Воля','s9'=>'Свобода духа','s10'=>'Божественность','s11'=>'Энергия','m1'=>'Мф. критического удара (%)','m2'=>'Мф. против критического удара (%)','m3'=>'Мф. мощности крит. удара (%)','m4'=>'Мф. увертывания (%)','m5'=>'Мф. против увертывания (%)','m6'=>'Мф. контрудара (%)','m7'=>'Мф. парирования (%)','m8'=>'Мф. блока щитом (%)','m9'=>'Мф. удара сквозь броню (%)','m14'=>'Мф. абс. критического удара (%)','m15'=>'Мф. абс. увертывания (%)','m16'=>'Мф. абс. парирования (%)','m17'=>'Мф. абс. контрудара (%)','m18'=>'Мф. абс. блока щитом (%)','m19'=>'Мф. абс. магический промах (%)','m20'=>'Мф. удача (%)','a1'=>'Мастерство владения ножами, кинжалами','a2'=>'Мастерство владения топорами, секирами','a3'=>'Мастерство владения дубинами, молотами','a4'=>'Мастерство владения мечами','a5'=>'Мастерство владения магическими посохами','a6'=>'Мастерство владения луками','a7'=>'Мастерство владения арбалетами','aall'=>'Мастерство владения оружием','mall'=>'Мастерство владения магией стихий','m2all'=>'Мастерство владения магией','mg1'=>'Мастерство владения магией огня','mg2'=>'Мастерство владения магией воздуха','mg3'=>'Мастерство владения магией воды','mg4'=>'Мастерство владения магией земли','mg5'=>'Мастерство владения магией Света','mg6'=>'Мастерство владения магией Тьмы','mg7'=>'Мастерство владения серой магией','tj'=>'Тяжелая броня','lh'=>'Легкая броня','minAtack'=>'Минимальный урон','maxAtack'=>'Максимальный урон','m10'=>'Мф. мощности урона','m11'=>'Мф. мощности магии стихий','m11a'=>'Мф. мощности магии','pa1'=>'Мф. мощности колющего урона','pa2'=>'Мф. мощности рубящего урона','pa3'=>'Мф. мощности дробящего урона','pa4'=>'Мф. мощности режущего урона','pm1'=>'Мф. мощности магии огня','pm2'=>'Мф. мощности магии воздуха','pm3'=>'Мф. мощности магии воды','pm4'=>'Мф. мощности магии земли','pm5'=>'Мф. мощности магии Света','pm6'=>'Мф. мощности магии Тьмы','pm7'=>'Мф. мощности серой магии','za'=>'Защита от урона','zm'=>'Защита от магии стихий','zma'=>'Защита от магии','za1'=>'Защита от колющего урона','za2'=>'Защита от рубящего урона','za3'=>'Защита от дробящего урона','za4'=>'Защита от режущего урона','zm1'=>'Защита от магии огня','zm2'=>'Защита от магии воздуха','zm3'=>'Защита от магии воды','zm4'=>'Защита от магии земли','zm5'=>'Защита от магии Света','zm6'=>'Защита от магии Тьмы','zm7'=>'Защита от серой магии','magic_cast'=>'Дополнительный каст за ход','pza'=>'Понижение защиты от урона','pzm'=>'Понижение защиты от магии','pza1'=>'Понижение защиты от колющего урона','min_heal_proc'=>'Эффект лечения (%)','notravma'=>'Защита от травм','yron_min'=>'Минимальный урон','yron_max'=>'Максимальный урон','zaproc'=>'Защита от урона (%)','zmproc'=>'Защита от магии стихий (%)','zm2proc'=>'Защита от магии Воздуха (%)','pza2'=>'Понижение защиты от рубящего урона','pza3'=>'Понижение защиты от дробящего урона','pza4'=>'Понижение защиты от режущего урона','pzm1'=>'Понижение защиты от магии огня','pzm2'=>'Понижение защиты от магии воздуха','pzm3'=>'Понижение защиты от магии воды','pzm4'=>'Понижение защиты от магии земли','pzm5'=>'Понижение защиты от магии Света','pzm6'=>'Понижение защиты от магии Тьмы','pzm7'=>'Понижение защиты от серой магии','speedhp'=>'Регенерация здоровья (%)','speedmp'=>'Регенерация маны (%)','tya1'=>'Колющие атаки','tya2'=>'Рубящие атаки','tya3'=>'Дробящие атаки','tya4'=>'Режущие атаки','tym1'=>'Огненные атаки','mg2static_points'=>'Уровень заряда (Воздух)','tym2'=>'Электрические атаки','tym3'=>'Ледяные атаки','tym4'=>'Земляные атаки','hpProc'=>'Уровень жизни (%)','mpProc'=>'Уровень маны (%)','tym5'=>'Атаки Света','tym6'=>'Атаки Тьмы','tym7'=>'Серые атаки','min_use_mp'=>'Уменьшает расход маны','pog'=>'Поглощение урона','pog2'=>'Поглощение урона','pog2p'=>'Процент поглощение урона','pog2mp'=>'Цена поглощение урона','maxves'=>'Увеличивает рюкзак','bonusexp'=>'Увеличивает получаемый опыт','speeden'=>'Регенерация энергии (%)',
	'antm3' => 'Мф. против мощности крита','repair_z' => 'Бесплатное извлечение заточек','repair_r' => 'Бесплатное извлечение рун',
'yza' => 'Уязвимость физическому урона (%)','yzm' => 'Уязвимость магии стихий (%)','yzma' => 'Уязвимость магии (%)'
,'yza1' => 'Уязвимость колющему урона (%)','yza2' => 'Уязвимость рубящему урона (%)','yza3' => 'Уязвимость дробящему урона (%)','yza4' => 'Уязвимость режущему урона (%)'
,'yzm1' => 'Уязвимость магии огня (%)','yzm2' => 'Уязвимость магии воздуха (%)','yzm3' => 'Уязвимость магии воды (%)','yzm4' => 'Уязвимость магии земли (%)','yzm5' => 'Уязвимость магии (%)','yzm6' => 'Уязвимость магии (%)','yzm7' => 'Уязвимость магии (%)','rep'=> 'Репутация Рыцаря'
,'repair_discount' => 'Скидка на ремонт вещей','hpVinos' => 'Бонус жизни','bronze' => 'Bronze Premium Account','silvers' => 'Silver Premium Account','gold' => 'Gold Premium Account','speed_dungeon' => 'Скорость передвижения по подземельям',
'mib1' => 'Броня головы (мин.)','mab1' => 'Броня головы (макс.)','mib2' => 'Броня корпуса (мин.)','mab2' => 'Броня корпуса (макс.)','mib3' => 'Броня пояса (мин.)','mab3' => 'Броня пояса (макс.)','mib4' => 'Броня ног (мин.)','mab4' => 'Броня ног (макс.)'
);

$svoystva = array(
	'acestar' => 'Следующий каст будет критическим', 'spasenie' => 'Спасение после смерти','more_awards' => 'Повышеная награда %', 'exp' => 'Получаемый опыт (%)', 'align_bs' => 'Служитель закона',
	'nopryh' => 'Прямое поподание', 'puti'=>'Запрет перемещения','align'=>'Склонность','hpAll'=>'<font color=darkgreen><b>Уровень жизни (HP)</font></b>','mpAll'=>'<font color=blue><b>Уровень маны</font></b>','enAll'=>'Уровень энергии','sex'=>'Пол','lvl'=>'Уровень','s1'=>'Сила','s2'=>'Ловкость','s3'=>'Интуиция','s4'=>'Выносливость','s5'=>'Интеллект','s6'=>'Мудрость','s7'=>'Духовность','s8'=>'Воля','s9'=>'Свобода духа','s10'=>'Божественность','s11'=>'Энергия','m1'=>'Мф. критического удара (%)','m2'=>'Мф. против критического удара (%)','m3'=>'Мф. мощности крит. удара (%)','m4'=>'Мф. увертывания (%)','m5'=>'Мф. против увертывания (%)','m6'=>'Мф. контрудара (%)','m7'=>'Мф. парирования (%)','m8'=>'Мф. блока щитом (%)','m9'=>'Мф. удара сквозь броню (%)','m14'=>'Мф. абс. критического удара (%)','m15'=>'Мф. абс. увертывания (%)','m16'=>'Мф. абс. парирования (%)','m17'=>'Мф. абс. контрудара (%)','m18'=>'Мф. абс. блока щитом (%)','m19'=>'Мф. абс. магический промах (%)','m20'=>'Мф. удача (%)','a1'=>'Мастерство владения ножами, кинжалами','a2'=>'Мастерство владения топорами, секирами','a3'=>'Мастерство владения дубинами, молотами','a4'=>'Мастерство владения мечами','a5'=>'Мастерство владения магическими посохами','a6'=>'Мастерство владения луками','a7'=>'Мастерство владения арбалетами','aall'=>'Мастерство владения оружием','mall'=>'Мастерство владения магией стихий','m2all'=>'Мастерство владения магией','mg1'=>'Мастерство владения магией огня','mg2'=>'Мастерство владения магией воздуха','mg3'=>'Мастерство владения магией воды','mg4'=>'Мастерство владения магией земли','mg5'=>'Мастерство владения магией Света','mg6'=>'Мастерство владения магией Тьмы','mg7'=>'Мастерство владения серой магией','tj'=>'Тяжелая броня','lh'=>'Легкая броня','minAtack'=>'Минимальный урон','maxAtack'=>'Максимальный урон','m10'=>'Мф. мощности урона','m11'=>'Мф. мощности магии стихий','m11a'=>'Мф. мощности магии','pa1'=>'Мф. мощности колющего урона','pa2'=>'Мф. мощности рубящего урона','pa3'=>'Мф. мощности дробящего урона','pa4'=>'Мф. мощности режущего урона','pm1'=>'Мф. мощности магии огня','pm2'=>'Мф. мощности магии воздуха','pm3'=>'Мф. мощности магии воды','pm4'=>'Мф. мощности магии земли','pm5'=>'Мф. мощности магии Света','pm6'=>'Мф. мощности магии Тьмы','pm7'=>'Мф. мощности серой магии','za'=>'Защита от урона','zm'=>'Защита от магии стихий','zma'=>'Защита от магии','za1'=>'Защита от колющего урона','za2'=>'Защита от рубящего урона','za3'=>'Защита от дробящего урона','za4'=>'Защита от режущего урона','zm1'=>'Защита от магии огня','zm2'=>'Защита от магии воздуха','zm3'=>'Защита от магии воды','zm4'=>'Защита от магии земли','zm5'=>'Защита от магии Света','zm6'=>'Защита от магии Тьмы','zm7'=>'Защита от серой магии','magic_cast'=>'Дополнительный каст за ход','pza'=>'Понижение защиты от урона','pzm'=>'Понижение защиты от магии','pza1'=>'Понижение защиты от колющего урона','min_heal_proc'=>'Эффект лечения (%)','notravma'=>'Защита от травм','yron_min'=>'Минимальный урон','yron_max'=>'Максимальный урон','zaproc'=>'Защита от урона (%)','zmproc'=>'Защита от магии стихий (%)','zm2proc'=>'Защита от магии Воздуха (%)','pza2'=>'Понижение защиты от рубящего урона','pza3'=>'Понижение защиты от дробящего урона','pza4'=>'Понижение защиты от режущего урона','pzm1'=>'Понижение защиты от магии огня','pzm2'=>'Понижение защиты от магии воздуха','pzm3'=>'Понижение защиты от магии воды','pzm4'=>'Понижение защиты от магии земли','pzm5'=>'Понижение защиты от магии Света','pzm6'=>'Понижение защиты от магии Тьмы','pzm7'=>'Понижение защиты от серой магии','speedhp'=>'Регенерация здоровья (%)','speedmp'=>'Регенерация маны (%)','tya1'=>'Колющие атаки','tya2'=>'Рубящие атаки','tya3'=>'Дробящие атаки','tya4'=>'Режущие атаки','tym1'=>'Огненные атаки','mg2static_points'=>'Уровень заряда (Воздух)','tym2'=>'Электрические атаки','tym3'=>'Ледяные атаки','tym4'=>'Земляные атаки','hpProc'=>'Уровень жизни (%)','mpProc'=>'Уровень маны (%)','tym5'=>'Атаки Света','tym6'=>'Атаки Тьмы','tym7'=>'Серые атаки','min_use_mp'=>'Уменьшает расход маны','pog'=>'Поглощение урона','pog2'=>'Поглощение урона','pog2p'=>'Процент поглощение урона','pog2mp'=>'Цена поглощение урона','maxves'=>'Увеличивает рюкзак','bonusexp'=>'Увеличивает получаемый опыт','speeden'=>'Регенерация энергии (%)',
	'antm3' => 'Мф. против мощности крита','repair_z' => 'Бесплатное извлечение заточек','repair_r' => 'Бесплатное извлечение рун',
'yza' => 'Уязвимость физическому урона (%)','yzm' => 'Уязвимость магии стихий (%)','yzma' => 'Уязвимость магии (%)'
,'yza1' => 'Уязвимость колющему урона (%)','yza2' => 'Уязвимость рубящему урона (%)','yza3' => 'Уязвимость дробящему урона (%)','yza4' => 'Уязвимость режущему урона (%)'
,'yzm1' => 'Уязвимость магии огня (%)','yzm2' => 'Уязвимость магии воздуха (%)','yzm3' => 'Уязвимость магии воды (%)','yzm4' => 'Уязвимость магии земли (%)','yzm5' => 'Уязвимость магии (%)','yzm6' => 'Уязвимость магии (%)','yzm7' => 'Уязвимость магии (%)','rep'=> 'Репутация Рыцаря'
,'repair_discount' => 'Скидка на ремонт вещей','hpVinos' => 'Бонус жизни','bronze' => 'Bronze Premium Account','silvers' => 'Silver Premium Account','gold' => 'Gold Premium Account','speed_dungeon' => 'Скорость передвижения по подземельям'
);

$ostalnoe = array(
	'acestar' => 'Следующий каст будет критическим', 'spasenie' => 'Спасение после смерти','more_awards' => 'Повышеная награда %', 'exp' => 'Получаемый опыт (%)', 'align_bs' => 'Служитель закона',
	'nopryh' => 'Прямое поподание', 'puti'=>'Запрет перемещения','align'=>'Склонность','hpAll'=>'<font color=darkgreen><b>Уровень жизни (HP)</font></b>','mpAll'=>'<font color=blue><b>Уровень маны</font></b>','enAll'=>'Уровень энергии','sex'=>'Пол','lvl'=>'Уровень','s1'=>'Сила','s2'=>'Ловкость','s3'=>'Интуиция','s4'=>'Выносливость','s5'=>'Интеллект','s6'=>'Мудрость','s7'=>'Духовность','s8'=>'Воля','s9'=>'Свобода духа','s10'=>'Божественность','s11'=>'Энергия','m1'=>'Мф. критического удара (%)','m2'=>'Мф. против критического удара (%)','m3'=>'Мф. мощности крит. удара (%)','m4'=>'Мф. увертывания (%)','m5'=>'Мф. против увертывания (%)','m6'=>'Мф. контрудара (%)','m7'=>'Мф. парирования (%)','m8'=>'Мф. блока щитом (%)','m9'=>'Мф. удара сквозь броню (%)','m14'=>'Мф. абс. критического удара (%)','m15'=>'Мф. абс. увертывания (%)','m16'=>'Мф. абс. парирования (%)','m17'=>'Мф. абс. контрудара (%)','m18'=>'Мф. абс. блока щитом (%)','m19'=>'Мф. абс. магический промах (%)','m20'=>'Мф. удача (%)','a1'=>'Мастерство владения ножами, кинжалами','a2'=>'Мастерство владения топорами, секирами','a3'=>'Мастерство владения дубинами, молотами','a4'=>'Мастерство владения мечами','a5'=>'Мастерство владения магическими посохами','a6'=>'Мастерство владения луками','a7'=>'Мастерство владения арбалетами','aall'=>'Мастерство владения оружием','mall'=>'Мастерство владения магией стихий','m2all'=>'Мастерство владения магией','mg1'=>'Мастерство владения магией огня','mg2'=>'Мастерство владения магией воздуха','mg3'=>'Мастерство владения магией воды','mg4'=>'Мастерство владения магией земли','mg5'=>'Мастерство владения магией Света','mg6'=>'Мастерство владения магией Тьмы','mg7'=>'Мастерство владения серой магией','tj'=>'Тяжелая броня','lh'=>'Легкая броня','minAtack'=>'Минимальный урон','maxAtack'=>'Максимальный урон','m10'=>'Мф. мощности урона','m11'=>'Мф. мощности магии стихий','m11a'=>'Мф. мощности магии','pa1'=>'Мф. мощности колющего урона','pa2'=>'Мф. мощности рубящего урона','pa3'=>'Мф. мощности дробящего урона','pa4'=>'Мф. мощности режущего урона','pm1'=>'Мф. мощности магии огня','pm2'=>'Мф. мощности магии воздуха','pm3'=>'Мф. мощности магии воды','pm4'=>'Мф. мощности магии земли','pm5'=>'Мф. мощности магии Света','pm6'=>'Мф. мощности магии Тьмы','pm7'=>'Мф. мощности серой магии','za'=>'Защита от урона','zm'=>'Защита от магии стихий','zma'=>'Защита от магии','za1'=>'Защита от колющего урона','za2'=>'Защита от рубящего урона','za3'=>'Защита от дробящего урона','za4'=>'Защита от режущего урона','zm1'=>'Защита от магии огня','zm2'=>'Защита от магии воздуха','zm3'=>'Защита от магии воды','zm4'=>'Защита от магии земли','zm5'=>'Защита от магии Света','zm6'=>'Защита от магии Тьмы','zm7'=>'Защита от серой магии','magic_cast'=>'Дополнительный каст за ход','pza'=>'Понижение защиты от урона','pzm'=>'Понижение защиты от магии','pza1'=>'Понижение защиты от колющего урона','min_heal_proc'=>'Эффект лечения (%)','notravma'=>'Защита от травм','yron_min'=>'Минимальный урон','yron_max'=>'Максимальный урон','zaproc'=>'Защита от урона (%)','zmproc'=>'Защита от магии стихий (%)','zm2proc'=>'Защита от магии Воздуха (%)','pza2'=>'Понижение защиты от рубящего урона','pza3'=>'Понижение защиты от дробящего урона','pza4'=>'Понижение защиты от режущего урона','pzm1'=>'Понижение защиты от магии огня','pzm2'=>'Понижение защиты от магии воздуха','pzm3'=>'Понижение защиты от магии воды','pzm4'=>'Понижение защиты от магии земли','pzm5'=>'Понижение защиты от магии Света','pzm6'=>'Понижение защиты от магии Тьмы','pzm7'=>'Понижение защиты от серой магии','speedhp'=>'Регенерация здоровья (%)','speedmp'=>'Регенерация маны (%)','tya1'=>'Колющие атаки','tya2'=>'Рубящие атаки','tya3'=>'Дробящие атаки','tya4'=>'Режущие атаки','tym1'=>'Огненные атаки','mg2static_points'=>'Уровень заряда (Воздух)','tym2'=>'Электрические атаки','tym3'=>'Ледяные атаки','tym4'=>'Земляные атаки','hpProc'=>'Уровень жизни (%)','mpProc'=>'Уровень маны (%)','tym5'=>'Атаки Света','tym6'=>'Атаки Тьмы','tym7'=>'Серые атаки','min_use_mp'=>'Уменьшает расход маны','pog'=>'Поглощение урона','pog2'=>'Поглощение урона','pog2p'=>'Процент поглощение урона','pog2mp'=>'Цена поглощение урона','maxves'=>'Увеличивает рюкзак','bonusexp'=>'Увеличивает получаемый опыт','speeden'=>'Регенерация энергии (%)',
	'antm3' => 'Мф. против мощности крита','repair_z' => 'Бесплатное извлечение заточек','repair_r' => 'Бесплатное извлечение рун',
'yza' => 'Уязвимость физическому урона (%)','yzm' => 'Уязвимость магии стихий (%)','yzma' => 'Уязвимость магии (%)'
,'yza1' => 'Уязвимость колющему урона (%)','yza2' => 'Уязвимость рубящему урона (%)','yza3' => 'Уязвимость дробящему урона (%)','yza4' => 'Уязвимость режущему урона (%)'
,'yzm1' => 'Уязвимость магии огня (%)','yzm2' => 'Уязвимость магии воздуха (%)','yzm3' => 'Уязвимость магии воды (%)','yzm4' => 'Уязвимость магии земли (%)','yzm5' => 'Уязвимость магии (%)','yzm6' => 'Уязвимость магии (%)','yzm7' => 'Уязвимость магии (%)','rep'=> 'Репутация Рыцаря'
,'repair_discount' => 'Скидка на ремонт вещей','hpVinos' => 'Бонус жизни','bronze' => 'Bronze Premium Account','silvers' => 'Silver Premium Account','gold' => 'Gold Premium Account','speed_dungeon' => 'Скорость передвижения по подземельям'
);
?>
<script>
var et = {
	is_par:[
	<?php
	$html = ''; $html2 = '';
	$i = 0;
	$is_key = array_keys($deystvuet);
	while( $i < count($is_key) ) {
		$html  .= ',"'.$is_key[$i].'"';
		$html2 .= ',"'.$is_key[$i].'":"'.$deystvuet[$is_key[$i]].'"';
		$i++;
	}
	echo ltrim($html,',');	
	?>
	],	is_name:{
	<?=ltrim($html2,',')?>
	},
	is_tr:[
	<?php
	$html = ''; $html2 = '';
	$i = 0;
	$is_key = array_keys($trebovaniya);
	while( $i < count($is_key) ) {
		$html  .= ',"'.$is_key[$i].'"';
		$html2 .= ',"'.$is_key[$i].'":"'.$trebovaniya[$is_key[$i]].'"';
		$i++;
	}
	echo ltrim($html,',');	
	?>
	],	is_tr_name:{
	<?=ltrim($html2,',')?>
	},	
	data:{
		img:'w/w10.gif',
		name:'Название нового предмета'
	},
	complData:function() {
		var html = '';
		
		//Требует
		if( this.it_data_pr.tr != undefined ) {
			var i = 0;
			while( i <= this.it_data_pr.tr ) {
				var npar = $('#par_tr_'+i).val();
				if( npar != undefined && $('#val_tr_'+i).val() != '' ) {
					html += '|tr_'+npar+'='+$('#val_tr_'+i).val();
				}
				i++;
			}
		}
		//Действует на
		if( this.it_data_pr.add != undefined ) {
			var i = 0;
			while( i <= this.it_data_pr.add ) {
				var npar = $('#par_add_'+i).val();
				if( npar != undefined && $('#val_add_'+i).val() != '' ) {
					html += '|add_'+npar+'='+$('#val_add_'+i).val();
				}
				i++;
			}
		}
		//Свойства
		if( this.it_data_pr.sv != undefined ) {
			var i = 0;
			while( i <= this.it_data_pr.sv ) {
				var npar = $('#par_sv_'+i).val();
				if( npar != undefined  && $('#val_sv_'+i).val() != '') {
					html += '|sv_'+npar+'='+$('#val_sv_'+i).val();
				}
				i++;
			}
		}
		//Остальное
		if( this.it_data_pr.all != undefined ) {
			var i = 0;
			while( i <= this.it_data_pr.all ) {
				var npar = $('#par_all_'+i).val();
				if( npar != undefined && $('#val_all_'+i).val() != '' ) {
					html += '|'+npar+'='+$('#val_all_'+i).val();
				}
				i++;
			}
		}

		$('#it_data_value').val( html );
	},
	it_data_pr:{},
	newpar:function( id ) {
		var html = '';
		if( this.it_data_pr[id] == undefined ) {
			this.it_data_pr[id] = 0;
		}else{
			this.it_data_pr[id]++;
		}
		
		html += '<select id="par_'+id+'_'+this.it_data_pr[id]+'" name="par_'+id+'_'+this.it_data_pr[id]+'">';
		var i = 0;
		while( i <= this.is_par.length ) {
			if( this.is_par[i] != undefined ) {
				html += '<option value="'+this.is_par[i]+'">'+this.is_name[this.is_par[i]]+'</option>';
			}
			i++;
		}
		html += '</select><input id="val_'+id+'_'+this.it_data_pr[id]+'" name="val_'+id+'_'+this.it_data_pr[id]+'" type="text" value="" >';
		
		html = '<div id="new_par_'+id+'_'+this.it_data_pr[id]+'"> &nbsp; <a href="javascript:et.delpar(\''+id+'\','+this.it_data_pr[id]+')">&nbsp; x &nbsp;</a> &nbsp; ' + html + '</div>';
		$('#it_data_' + id).html( $('#it_data_' + id).html() + html );
	},
	new_tr:function( id ) {
		var html = '';
		if( this.it_data_pr[id] == undefined ) {
			this.it_data_pr[id] = 0;
		}else{
			this.it_data_pr[id]++;
		}
		
		html += '<select id="par_'+id+'_'+this.it_data_pr[id]+'" name="par_'+id+'_'+this.it_data_pr[id]+'">';
		var i = 0;
		while( i <= this.is_tr.length ) {
			if( this.is_tr[i] != undefined ) {
				html += '<option value="'+this.is_tr[i]+'">'+this.is_tr_name[this.is_tr[i]]+'</option>';
			}
			i++;
		}
		html += '</select><input id="val_'+id+'_'+this.it_data_pr[id]+'" name="val_'+id+'_'+this.it_data_pr[id]+'" type="text" value="" >';
		
		html = '<div id="new_par_'+id+'_'+this.it_data_pr[id]+'"> &nbsp; <a href="javascript:et.delpar(\''+id+'\','+this.it_data_pr[id]+')">&nbsp; x &nbsp;</a> &nbsp; ' + html + '</div>';
		$('#it_data_' + id).html( $('#it_data_' + id).html() + html );
	},
	delpar:function(id,num) {
		$('#new_par_'+id+'_'+num+'').remove();
	},
	compl:function() {
		var html = '',html_l = '',html_r = '';
		
		//Собираем данные
		this.data = {
			'name' : $('#it_name').val(),
			'img' : $('#it_img').val()
			
		};
		
		//Левая часть
		html_l += '<img src="https://img.combatz.ru/i/items/' + this.data.img + '">';
		
		//Правая часть
		html_r = '<a href="#">' + this.data.name + '</a>';
		
		//Собираем
		html = '<table style="border:#A5A5A5 1px solid;" width="100%" border="0" cellspacing="0" cellpadding="0">'+
					'<tr>'+
						'<td valign="top">' + 
						'<table width="100%" border="0" cellspacing="0" cellpadding="0">'+
						  '<tr>'+
							'<td width="20%" align="center" style="border-right:#A5A5A5 1px solid; padding:5px;">'+html_l+'</td>'+
							'<td valign="top" align="left" style="padding-left:3px; padding-bottom:3px; padding-top:7px;">'+html_r+'</td>'+
						  '</tr>'+
						'</table>'+
						'</td>'+
					'</tr>'+
				'</table>';
		
		$('#etitm').html( html );
	}
};


$("#file").change(function() {
	$("#message").empty();
	var file = this.files[0];
	var imagefile = file.type;
	var match= ["image/jpeg","image/png","image/jpg","image/gif"];
	if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
		$('#previewing').attr('src','https://img.testcombats.ru/i/items/gl_banner.png');
		$("#message").html("<p id='error'>Выберите картинку</p>"+"<h4>Замечание*</h4>"+"<span id='error_message'>Только jpeg, jpg, gif и png типы картинок разрешены</span>");
		return false;
	}
	else{
		var reader = new FileReader();
		reader.onload = imageIsLoaded;
		reader.readAsDataURL(this.files[0]);
	}
});
function imageIsLoaded(e) {
	$("#file").css("color","green");
	$('#image_preview').css("display", "block");
	$('#previewing').attr('src', e.target.result);

};
$("#uploadimage").on('submit',(function(e) {
	e.preventDefault();
	$("#message").empty();
	$('#loading2').show();
	$.ajax({
		url: "/adminion/index.php?mod=context&menu=addItem", // Url to which the request is send
		type: "POST",             // Type of request to be send, called as method
		data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,        // To send DOMDocument or non processed data file it is set to false
		success: function(data)   // A function to be called if request succeeds
		{
			$('#loading2').hide();
			$("#message").html(data);
		}
	});
}));

$('#saveItem').bind("click",function(){
	var img_file = $('#file').val();
	var it_name = encodeURI($('#it_name').val());
	var it_type = $('#it_type').val();
	var it_massa = $('#it_massa').val();
	var it_sudba = $('#it_sudba').val();
	var it_art3 = $('#it_art3').val();
	var it_art4 = $('#it_art4').val();
	var it_2too3 = $('#it_2too3').val();
	var it_price1 = $('#it_price1').val();
	var it_price2 = $('#it_price2').val();
	var it_iznos = $('#it_iznos').val();
	var it_slot = $('#it_slot').val();
	var it_inRazdel = $('#it_inRazdel').val();
	var it_info = $('#it_info').val();
	var it_group_max = $('#it_group_max').val();
	var it_geni = $('#it_geni').val();
	var it_srok = $('#it_srok').val();
	var it_max_text = $('#it_max_text').val();
	var it_ndata = $('#it_ndata').val();
	var it_data_value = $('#it_data_value').val();
	var it_img = $('#it_img').val();
	

	
	if(img_file==''){
		alert("Выберите картинку предмета");
	}
	else{
		$.ajax({
			url: "/adminion/index.php?mod=context&menu=addItem",
			type: "POST",
			data: "it_name="+it_name+"&it_type="+it_type+"&it_massa="+it_massa+"&it_sudba="+it_sudba+"&it_art3="+it_art3+"&it_art4="+it_art4+"&it_2too3="+it_2too3+"&it_price1="+it_price1+"&it_price2="+it_price2+"&it_iznos="+it_iznos+"&it_slot="+it_slot+"&it_inRazdel="+it_inRazdel+"&it_info="+it_info+"&it_group_max="+it_group_max+"&it_geni="+it_geni+"&it_srok="+it_srok+"&it_max_text="+it_max_text+"&it_ndata="+it_ndata+"&it_data_value="+it_data_value+"&it_img="+it_img+"", 
			success: function(data)
			{
				//$("#message").html(data);
				alert(data);
				lC('addItem');
			}
		});
	}
});

</script>
<div class="divTable" style="max-width:500px; margin: 0 auto;">
<div class="divTableBody">

	<div class="divTableRow">
		<div class="divTableCell">Изображение</div>
		<div class="divTableCell">
			<h4 id='loading2' style="display:none;">Загрузка..</h4>
			<div id="message"></div>
				<div id="image_preview"><img id="previewing" src="https://img.testcombats.ru/i/items/gl_banner.png" /></div>
				<form id="uploadimage" action="" method="post" enctype="multipart/form-data"><div id="selectImage">
				
					<input type="file" name="file" id="file" required /><br>
					<input type="submit" value="Загрузить" class="submit" />
				
				</div>
				</form>
		</div>
	</div>


<div class="divTableRow">
	<div class="divTableCell">Название</div>
	<div class="divTableCell"><input type="text" name="it_name" id="it_name"><input type="text" name="it_img" id="it_img" style="display:none;"></div>
</div>

<div class="divTableRow">
<div class="divTableCell">Тип</div>
<div class="divTableCell">
              <select name="it_type" id="it_type">
                <option value="0">выберите тип</option>
                <option value="1">Шлем</option>
                <option value="2">Венок</option>
                <option value="3">Наручи</option>
                <option value="4">Рубашка</option>
                <option value="5">Легкая броня</option>
                <option value="6">Тяжелая броня</option>
                <option value="7">Плащ</option>
                <option value="8">Пояс</option>
                <option value="9">Серьги</option>
                <option value="10">Амулет</option>
                <option value="11">Кольцо</option>
                <option value="12">Перчатки</option>
                <option value="13">Щит</option>
                <option value="14">Поножи</option>
                <option value="15">Ботинки</option>
                <option value="16">Предмет для карманов</option>
                <option value="17">Предмет для смены</option>
                <option value="18">Нож \ Кинжал</option>
                <option value="19">Топор \ Секира</option>
                <option value="20">Молот \ Дубина</option>
                <option value="21">Меч \ Клинок</option>
                <option value="22">Магический посох</option>
                <option value="23">Лук</option>
                <option value="24">Арбалет</option>
                <option value="25">Боеприпасы \ Стреллы</option>
                <option value="26">Костыли</option>
                <option value="27">Легендарное оружие</option>
                <option value="28">Цветы \ Букеты \ Ёлки</option>
                <option value="29">Заклятие</option>
                <option value="30">Эликсир</option>
                <option value="31">Руна</option>
                <option value="32">Ресурс</option>
                <option value="33">Мусор</option>
                <option value="34">Прочее</option>
                <!--<option value="35">Сумка</option>-->
                <option value="36">Усиление</option>
                <option value="37">Упаковка</option>
                <option value="38">Подарок</option>
                <option value="39">Подарок (требует упаковку)</option>
                <option value="40">Книжный прием</option>
                <option value="41">Приглашение</option>
                <option value="42">Билет</option>
                <option value="43">Слот смены</option>
                <option value="44">Пергамент (с текстом)</option>
                <option value="45">Сумка</option>
                <option value="46">Заточка</option>
                <option value="47">Усиление 1</option>
                <option value="48">Усиление 2 (временное)</option>
                <option value="49">Корм для животного</option>
                <option value="60">Бумага</option>
                <option value="61">Чек</option>
                <option value="62">Чарка</option>
                <option value="63">Открытка</option>
              </select></div>
</div>
<div class="divTableRow">
<div class="divTableCell">Масса</div>
<div class="divTableCell"><input type="text" name="it_massa" id="it_massa"></div>
</div>
<div class="divTableRow">
<div class="divTableCell">Судьба</div>
<div class="divTableCell"><input name="it_sudba" type="checkbox" id="it_sudba" value="1"></div>
</div>
<div class="divTableRow">
<div class="divTableCell">Артефакт</div>
<div class="divTableCell"><input name="it_art2" type="checkbox" id="it_art3" value="1"></div>
</div>
<div class="divTableRow">
<div class="divTableCell">Двуручное</div>
<div class="divTableCell"><input name="it_2h" type="checkbox" id="it_art4" value="1"></div>
</div>
<div class="divTableRow">
<div class="divTableCell">В обе руки</div>
<div class="divTableCell"><input name="it_2too2" type="checkbox" id="it_2too3" value="1"></div>
</div>
<div class="divTableRow">
<div class="divTableCell">Цена (кр)</div>
<div class="divTableCell"><input  type="text" name="it_price1" id="it_price1"></div>
</div>
<div class="divTableRow">
<div class="divTableCell">Цена (екр)</div>
<div class="divTableCell"><input type="text" name="it_price2" id="it_price2"></div>
</div>
<div class="divTableRow">
<div class="divTableCell">Долговечность</div>
<div class="divTableCell"><input type="text" name="it_iznos" id="it_iznos"></div>
</div>
<div class="divTableRow">
<div class="divTableCell">Слот</div>
<div class="divTableCell"><select name="it_slot" id="it_slot">
              <option value="0">не надевается</option>
              <option value="1">Шлем</option>
              <option value="2">Наручи</option>
              <option value="3">Оружие (Правая рука)</option>
              <option value="4">Рубаха</option>
              <option value="5">Броня</option>
              <option value="6">Плащ</option>
              <option value="7">Пояс</option>
              <option value="8">Серьги</option>
              <option value="9">Амулет</option>
              <option value="10">Кольцо</option>
              <option value="13">Перчатки</option>
              <option value="14">Оружие \ Щит (Левая рука)</option>
              <option value="16">Поножи</option>
              <option value="17">Ботинки</option>
              <option value="18">Приём</option>
              <option value="40">Заклятия</option>
              <option value="51">Книга</option>
              <option value="52">Венок</option>
              <option value="53">Карман</option>
              <option value="55">Центральный карман</option>
              <option value="56">Смена оружия</option>
              <option value="59">Слот сумки</option>
			  </select></div>
</div>


<div class="divTableRow">
<div class="divTableCell">Раздел инвентаря</div>
<div class="divTableCell"><select name="it_inRazdel" id="it_inRazdel">
              <option value="1">Обмундирование</option>
              <option value="2">Заклятия</option>
              <option value="3">Эликсиры</option>
              <option value="6">Руны</option>
              <option value="4">Прочее</option>
            </select></div>
</div>



<div class="divTableRow">
<div class="divTableCell">Информация</div>
<div class="divTableCell"><input type="text" name="it_info" id="it_info"></div>
</div>


<div class="divTableRow">
<div class="divTableCell">Группировка</div>
<div class="divTableCell"><input type="text" name="it_group_max" id="it_group_max"></div>
</div>


<div class="divTableRow">
<div class="divTableCell">Поколение</div>
<div class="divTableCell"><input type="text" name="it_geni" id="it_geni"></div>
</div>

<div class="divTableRow">
<div class="divTableCell">Срок годности (сек.)</div>
<div class="divTableCell"><input type="text" name="it_srok" id="it_srok"></div>
</div>

<div class="divTableRow">
<div class="divTableCell">Макс. текст (символов)</div>
<div class="divTableCell"><input type="text" name="it_max_text" id="it_max_text"></div>
</div>

<div class="divTableRow">
	<div class="divTableCell">Доп.дата</div>
	<div class="divTableCell"><input type="text" name="it_ndata" id="it_ndata"></div>
</div>





<div class="divTableRow">
	<div class="divTableCell">Требования: <a href="javascript:et.new_tr('tr')">[+]</a></div>
	<div class="divTableCell"><div id="it_data_tr"></div></div>
</div>

<div class="divTableRow">
	<div class="divTableCell">Действует на: <a href="javascript:et.newpar('add')">[+]</a></div>
	<div class="divTableCell"><div id="it_data_add"></div></div>
</div>

<div class="divTableRow">
	<div class="divTableCell">Свойства: <a href="javascript:et.newpar('sv')">[+]</a></div>
	<div class="divTableCell"><div id="it_data_sv"></div></div>
</div>

<div class="divTableRow">
	<div class="divTableCell">Остальное: <a href="javascript:et.newpar('all')">[+]</a></div>
	<div class="divTableCell"><div id="it_data_all"></div></div>
</div>

<div class="divTableRow"> 
	<div class="divTableCell">ITEMS_MAIN_DATA:</div>
	<div class="divTableCell"><textarea name="it_data_value" rows="10" id="it_data_value" disabled></textarea></div>
</div>

<div class="divTableRow">
	<div class="divTableCell">Сформировать предмет:</div>
	<div class="divTableCell"><button onClick="et.complData()">Собрать дату</button></div>
</div>



<div class="divTableRow">
	<div class="divTableCell">Добавить предмет:</div>
	<div class="divTableCell"><button id="saveItem">Отправить предмет в базу</button></div>
</div>



</div>
</div>

