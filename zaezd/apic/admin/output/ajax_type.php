<?php
$inc_path=$_SERVER['DOCUMENT_ROOT']."/";
include($inc_path."config/head.php");
include($inc_path."config/config.php");

ini_set('session.gc_maxlifetime', 14400);
ini_set('session.cookie_lifetime', 14400);

session_name($session_name);
session_start();

if($_SESSION["user_type"]==1 || $_SESSION["user_type"]==2)
{
include_once($inc_path."kernel/engine.php");
include_once($inc_path."kernel/global_mode.php");
$site=new engine($params);

$fields_count=$site->get_fields_count($_GET["id_type"]);
$fields=$site->get_fields($_GET["id_type"]);

echo '<h3>'.$site->type[$_GET["id_type"]]["name"].' '.($_GET["num"]+1).'</h3>';
echo '<input class="w450" name="v_obj_type['.$_GET["num"].']" type="hidden" value="'.$_GET["id_type"].'" />';
echo '<input class="w450" name="v_obj_id['.$_GET["num"].']" type="hidden" value="-1" />';

if($fields["empty"][0]==0)
{
echo '<div class="it">';
echo '<label for="x">Название объекта<span> [обязательное]</span></label><br />';
echo '<input class="w450" name="v_field_val['.$_GET["num"].'][0]" id="name_'.$_GET["num"].'" type="text" value="" />';
echo '</div>';
}

for($i=1;$i<$fields_count;$i++)
{
if($fields["empty"][$i]==0) $empty='<span> [обязательное]</span>';	
else $empty='';	
	
echo '<div class="it">';
echo '<label for="x">'.$fields["name"][$i].$empty.'</label><br />';
if($fields["type"][$i]>0 && $fields["type"][$i]<3)
	echo '<input class="w450" name="v_field_val['.$_GET["num"].']['.$i.']" id="x" type="text" value="" />';
if($fields["type"][$i]==3)
	echo '<textarea id="x" name="v_field_val['.$_GET["num"].']['.$i.']" cols="72" rows="11"></textarea>';
if($fields["type"][$i]==4)
	echo '<input class="w450" name="v_field_val['.$_GET["num"].']['.$i.']" id="x" type="text" value="" onClick="displayDatePicker(\'start\',event);" />';

echo '</div>';
}
echo '<hr />';
}
?>