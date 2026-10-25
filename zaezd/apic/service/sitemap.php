<?php
$i_path=$_SERVER['PHP_SELF'];
$i_path=str_replace('service/sitemap.php', '', $i_path);

include($i_path."config/head.php");
include($i_path."config/config.php");

$inc_path=$i_path;

include($i_path."kernel/engine.php");


$base_url="http://".$config["url"];

$site=new engine($params);

$str.='<?xml version="1.0" encoding="UTF-8"?>'."\n";
$str.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

$site->get_parts();

for($i=0;$i<$site->part_count;$i++)
{
	$obj=$site->part[$site->part_index[$i]];
	
	$str.='   <url>'."\n";
	$str.='      <loc>'.$base_url.$obj->get_path().'</loc>'."\n";
	$str.='   </url>'."\n";

	$str.=rec_map($obj);
}

$str.='</urlset>'."\n";

write_file($i_path."sitemap/sitemap.xml", $str);

function rec_map($obj)
{
	global $base_url;
	
    $obj->get_child("special",0,"all");
    
    $tstr="";

	for($n=0;$n<$obj->childs_count;$n++)
	{
		$id_type=$obj->childs_index[$n][0];
		$id=$obj->childs_index[$n][1];
		$obj1=$obj->childs[$id_type][$id];
		$obj1->get_date("date");

		$tstr.='   <url>'."\n";
		$tstr.='      <loc>'.$base_url.$obj1->get_path().'</loc>'."\n";
		$tstr.='      <lastmod>'.$obj1->date_modify.'</lastmod>'."\n";
		$tstr.='   </url>'."\n";
		
		$tstr.=rec_map($obj1);
	}
    unset($obj->childs,$obj->childs_index);
	
	return $tstr;
}

function write_file($filename, $data)
{

    $fp = fopen($filename, 'wb');
    if ($fp)
	{
        fwrite($fp, $data);
        fclose($fp);
        
        chmod($filename,"0644");
 	}

	return true;
}
?>