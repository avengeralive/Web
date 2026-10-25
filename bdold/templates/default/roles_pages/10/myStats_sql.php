<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    $mess = var_dump(json_decode($_REQUEST, true));
    echo $mess;
    
    
}else exit();
?>