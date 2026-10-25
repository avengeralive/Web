<?php
if(!empty($_SESSION["user_type"]))
{
    echo '<h1>Рассылка АПИК</h1>';
    echo '<div class="box data">'.$le_form;
    include($inc_path."output/menu.php");
	switch($global_mode)
	{
		case "user" :	include($inc_path."output/user.php");
						break;
        case "list" :	include($inc_path."output/list.php");
						break;                        
		case "logout" :	include($inc_path."service/logout.php");
						break;
        case "error" :	echo '<h1>Ошибка 404</h1>';
						break;                        
		default :		include($inc_path."output/ras.php"); 
						break;
	}
    echo '</div>';
}
else echo $le_form;
?>