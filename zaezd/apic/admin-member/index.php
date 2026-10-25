<?php
include("../config/head.php");

session_name("apic");
session_start();

$mode=$_GET["mode"];
$smode=$_GET["smode"];
$ssmode=$_GET["ssmode"];

if(empty($mode)) $mode="firm";
if(empty($smode)) $smode="show";

echo '<html><head><meta charset="utf-8"></head><body><table cellpadding="0" cellspacing="0" border="1">'."\n"; 
echo '<tr>'."\n";
echo '<td>'."\n";
if($mode=="sect") echo '<a href="/admin-member/'.$folder.'index.php?mode=sect"><b>Разделы и группы</b></a>';
if($mode!="sect") echo '<a href="/admin-member/'.$folder.'index.php?mode=sect">Разделы и группы</a>';
echo '&nbsp;&nbsp;&nbsp;'."\n";
if($mode=="firm") echo '<a href="/admin-member/'.$folder.'index.php?mode=firm"><b>Фирмы</b></a>';
if($mode!="firm") echo '<a href="/admin-member/'.$folder.'index.php?mode=firm">Фирмы</a>';
echo '&nbsp;&nbsp;&nbsp;'."\n";
if($mode=="obj") echo '<a href="/admin-member/'.$folder.'index.php?mode=obj"><b>Типы объектов</b></a>';
if($mode!="obj") echo '<a href="/admin-member/'.$folder.'index.php?mode=obj">Типы объектов</a>';
echo '</td>'."\n";
echo '</tr>'."\n";

$border=0;

echo '<tr>'."\n";
echo '<td>'."\n";
if($mode=="firm" && ($smode=="show" || $smode=="add_f" || $smode=="edit_f" || $smode=="edit_br_f" || $smode=="delete")) 
{
	echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=add">Добавить фирму</a>';
	$border=1;
}
if($mode=="firm" && $smode=="edit_br") $border=1; 
if($mode=="firm" && ($smode=="inc" || $smode=="addbrand_f")) echo '<a href="/admin-member/'.$folder.'index.php?mode=firm&smode=addbrand">Добавить Брэнд</a>';
if($mode=="sect" && ($smode=="show" || $smode=="add_f" || $smode=="delete")) 	$border=1;
if($mode=="sect" && ($smode=="show" || $smode=="add_f")) 
{
	echo '<a href="/admin-member/'.$folder.'index.php?mode=sect&smode=add">Добавить раздел</a>';
}
echo '</td>'."\n";
echo '</tr>'."\n";

echo '<tr>'."\n";
echo '<td>'."\n";
echo '<table cellpadding="1" cellspacing="1" border="'.$border.'">'."\n"; 
if($mode=="firm") include("firm.php");
if($mode=="sect") include("sect.php");
if($mode=="obj") include("obj.php");
echo '</table>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";

echo '</table></body></html>'."\n";
?>