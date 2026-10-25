<?php
     $_SESSION = array();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();	    
     
     $exp = mktime(0,0,0,1,1,1990);
     setcookie("log","0",$exp,'/',$_SERVER['HTTP_HOST']);
     setcookie("сlogin","",$exp,'/',$_SERVER['HTTP_HOST']);
     setcookie("сpass","",$exp,'/',$_SERVER['HTTP_HOST']);
     
     echo "<h2>Выход выполнен.</h2>";
     echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL=/admin/">';

?>