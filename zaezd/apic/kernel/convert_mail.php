<?php
mb_internal_encoding("UTF-8");

$name=$_GET["name"];
$mail=$_GET["mail"];

?>

<form  action="" method="get">
Адрес электронной почты
<input name="mail" id="x" type="text" value="<? echo $mail; ?>" /><br />
Текст внутри ссылки
<input name="name" id="x" type="text" value="<? echo $name; ?>" /><br />
<input type="submit" name="submit" value="Конвертировать" class="submit" />
</form>

<?php

if(!empty($mail))
{
    if(empty($name)) $name=$mail;
    
    echo hideEmail($mail,$name).'<br /><br />';
    
    echo htmlentities('<notextile>'.hideEmail($mail,$name).'</notextile>');
}

function hideEmail($email,$name) {
   $str = "document.write('<a href=\"mailto:$email\">".$name."</a>')";
   $res = '';
   for ($i = 0; $i < mb_strlen($str); $i++) {
        $res .= '%u'.unibin2hex(mb_substr($str, $i, 1));
   }
   return "<script language='JavaScript'>eval(unescape('$res'))</script>";
 }

function unibin2hex($u) {
     $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
     $k1 = bin2hex(substr($k, 0, 1));
     $k2 = bin2hex(substr($k, 1, 1));
     return $k2.$k1;
 }
?>
