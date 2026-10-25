<?php
     $_SESSION = array();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();	    
     
     echo "<h2>Выход успешно выполнен.</h2>";
     echo '<META HTTP-EQUIV="Refresh" CONTENT="1; URL='.$base_url.'nr/">';

?>