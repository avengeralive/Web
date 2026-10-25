<?php
include("../config/head.php");
include($inc_path."config/config.php");

include($inc_path."kernel/engine.php");


$base_url="http://".$config["url"];

$site=new engine($params);

$str.='<html><head></head><body>'."\n";
$str.='<table border=1>'."\n";

$site->get_parts();

for($i=0;$i<$site->part_count;$i++)
{
	$obj=$site->part[$site->part_index[$i]];
    /*$obj->get_meta();
    
    if(empty($obj->title)) $obj->title=$obj->name;*/
	
	$str.='   <tr>'."\n";
	$str.='      <td>&nbsp;</td><td>'.$obj->name.'</td><td><a href="'.$base_url.$obj->get_path().'">'.$base_url.$obj->get_path().'</a></td>'."\n";
	$str.='   </tr>'."\n";

	$str.=rec_map($obj);
}

$str.='</table>';
$str.='<table border=1>'."\n";
    
    $sql='select id_key,word,sid from '.$pr.'keyword where id_key in (select distinct id_key from '.$pr.'object_keyword where id_part='.$site->current_part->id.') order by word asc';
	$keyw=mysql_query($sql);
	$keyw_count=mysql_num_rows($keyw);
	for($i=0;$i<$keyw_count;$i++)
	{
		$str.='<tr><td><a href="/temy'.$site->current_part->get_path().mysql_result($keyw,$i,2).'/">'.mysql_result($keyw,$i,1).'</a></td><td>'.$base_url.'/temy/'.mysql_result($keyw,$i,2).'/'.'</td></tr>';
	}

$str.='</table>';
$str.='</body></html>'."\n";

echo $str;

function rec_map($obj,$sect)
{
	global $base_url;
	
    $obj->get_child("special",0,"all");
    
    $tstr="";

	for($n=0;$n<$obj->childs_count;$n++)
	{
		$id_type=$obj->childs_index[$n][0];
		$id=$obj->childs_index[$n][1];
		$obj1=$obj->childs[$id_type][$id];
		/*$obj1->get_date("date");
        $obj1->get_meta();
    
    $title1=$obj1->name.' : '.$title;
    if(empty($obj1->title)) $obj1->title=$title1; */
    
    if(empty($sect)) $tsect="&nbsp;";
    else $tsect=$sect;
    
	$tstr.='   <tr>'."\n";
	$tstr.='      <td>'.$tsect.'</td><td>'.$obj1->name.'</td><td><a href="'.$base_url.$obj1->get_path().'">'.$base_url.$obj1->get_path().'</a></td>'."\n";
	$tstr.='   </tr>'."\n";
		
		if(empty($sect)) $tstr.=rec_map($obj1,$obj1->name);
        else $tstr.=rec_map($obj1,$sect);
	}
    unset($obj->childs,$obj->childs_index);
	
	return $tstr;
}


?>