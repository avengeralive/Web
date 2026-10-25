<?php
if(!empty($_SESSION["user_type"]))
{
	switch($global_mode)
	{
		case "rubric" : include($inc_path."admin/output/rubric.php");
						break;
        case "temy" : include($inc_path."admin/output/keyword.php");
						break;
		case "type" :	include($inc_path."admin/output/type.php");
						break;
		case "user" :	include($inc_path."admin/output/user.php");
						break;
		case "logout" :	include($inc_path."admin/service/logout.php");
						break;
        case "error" :	echo '<h1>Ошибка 404</h1>';
						break;                        
		default :		if(!empty($site->current_object) || (!empty($site->current_part) && ($action[1]=="child_add" || $action[1]=="arrange"))) include($inc_path."admin/output/object.php");
						else include($inc_path."admin/output/part.php"); 
						break;
	}
}
?>