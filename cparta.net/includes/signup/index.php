<?php
if(isset($_GET["ref"])){
    
    if(isset($_GET["ref"])){
    $_rid = (intval($_GET["ref"]) > 0) ? intval($_GET["ref"]) : 0; 
    setcookie("referer",$_rid,time()+(60*60*24*30));
    }  	
	
    header("Location: /");
}
?>