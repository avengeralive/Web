<?php
switch($global_mode)
	{
	    case "user" :		include($inc_path."service/user.php");break;
        case "buy" :		include($inc_path."output/buy_proc.php");break;
		case "map" :		include($inc_path."output/map.php");break;
		case "search" :		include($inc_path."output/search.php");break;
        case "keyword" :		if($site->current_part->sid=="eng") include($inc_path."output/keyword_eng.php"); 
                        else include($inc_path."output/keyword.php");
		default :		if($site->current_part->sid=="en") include($inc_path."output/eng.php"); 
                        else include($inc_path."output/main.php");
						break;
	}
 if($global_mode1=="search") include($inc_path."output/search.php"); 
?>