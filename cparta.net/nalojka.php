<?php

// Открываем сессию
// Open session
session_start();

// Подключаем необходимые служебные файлы и библиотеки
// Connect the necessary office and library files
include './includes/includes_login.php';

// Пишем в базу данные о посетителе
// Write in the visitor data base
include_once './includes/userslog/index.php';

// Подключаем системную ТДС
// Connect system TDS
include './includes/systemtds/index.php';
	
// Разрешаем выполнение только рекламодателям, колл-центру сети и администраторам
// Allows the only advertisers, network call-center and administrators
if ($user_tip == '40' || $user_tip == '50' || $user_tip == '70' ) 
	{
	if (isset($_POST['submit_nalojka'])) 
		{
		include './modules/pdf/blank_nalojka.php';
		exit;
		} 
	else 
		{
		// Вывод отдельно взятого заказа
		// Display a single order
		if (isset($_GET['ob']) && ($_GET['ob']!=''))
			{
			$ob=htmlentities($_GET['ob']);
			if ($user_tip == '50' || $user_tip == '70') 
				{
				$xsql = "SELECT * FROM zakaz WHERE `id`='$ob'";
				}
			else
				{
				$xsql = "SELECT * FROM zakaz WHERE `owner_id`='$user_id' AND `id`='$ob'";
				}
			$xresult = $mysqli->query($xsql);
			if (mysqli_num_rows($xresult) > 0) 
				{
				$xres=mysqli_fetch_array($xresult);
				include './templates/'.$template.'/in_header.php';
				include './modules/pdf/nalojka.php';
				include './templates/'.$template.'/in_footer.php';
				}
			else
				{
				Header('Location: ./cabinet.php'); 
				exit;
				}
			}
		else
			{
			Header('Location: ./cabinet.php'); 
			exit;
			}
		}
	}

?>


