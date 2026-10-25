<?php
$word=strip_tags($_POST["query"]);

if(empty($global_mode1)) echo '<h1>Поиск: '.$word.'</h1><br />';
else echo '<h1>Search for: '.$word.'</h1><br />';

if(!empty($word))
{

	$sql='select distinct '.$site->pr.'object.id_type, '.$site->pr.'object.id, '.$site->pr.'object.sid, '.$site->pr.'object.active,'.$site->pr.'object.id_part, MATCH('.$site->pr.'values_text.val) AGAINST(\''.$word.'\') as score from '.$site->pr.'object';
	$sql.=' inner join '.$site->pr.'values_str on '.$site->pr.'values_str.id_part='.$site->pr.'object.id_part and '.$site->pr.'values_str.id_type='.$site->pr.'object.id_type and '.$site->pr.'values_str.id='.$site->pr.'object.id';
	$sql.=' left join '.$site->pr.'values_text on '.$site->pr.'values_text.id_part='.$site->pr.'object.id_part and '.$site->pr.'values_text.id_type='.$site->pr.'object.id_type and '.$site->pr.'values_text.id='.$site->pr.'object.id';
    
    if(empty($global_mode1)) $sql.=' where '.$site->pr.'object.id_part=1';
    else $sql.=' where '.$site->pr.'object.id_part=2';

	if($site->permit>0) $sql.=' and '.$site->pr.'values_str.id_fld=1 and '.$site->pr.'values_text.id_fld=3';
	else $sql.=' and '.$site->pr.'object.active=1 and '.$site->pr.'values_str.id_fld=1 and '.$site->pr.'values_text.id_fld=3';
		
	if(!empty($type)) $sql.=' and '.$site->pr.'object.id_type='.$type;
	
	$sql.=' and (MATCH('.$site->pr.'values_text.val) AGAINST(\''.$word.'\') or '.$site->pr.'values_str.val like \'%'.$word.'%\')';
    
//    $sql.=' and '.$site->pr.'values_str.val like \'%'.$word.'%\'';
		 		
	$sql.=' order by score desc, '.$site->pr.'object.tadd desc';
	
    //echo $sql;
		
	$temp=mysql_query($sql);
	$temp_count=mysql_num_rows($temp);
	
	if(empty($temp_count)) $temp_count=0;
	
	if(empty($global_mode1)) echo '<h2>Результатов: '.$temp_count.'</h2>';
    else echo '<h2>Results: '.$temp_count.'</h2>';
	
	echo '<ol>';
	for($i=0;$i<$temp_count-$smod;$i++)
	{
		$sql='select val from '.$site->pr.'values_str where id_part='.mysql_result($temp,$i,4).' and id_type='.mysql_result($temp,$i,0).' and id='.mysql_result($temp,$i,1).' and id_fld=1';
	    $nm=mysql_query($sql);
	    $nm=mysql_result($nm,0,0);
		
		
		$id_part=mysql_result($temp,$i,4);
		$id_type=mysql_result($temp,$i,0);
		$id=mysql_result($temp,$i,1);
		$sid=mysql_result($temp,$i,2);
		
		$object_params["id_part"]=$id_part;
		$object_params["id_type"]=$id_type;
		$object_params["id"]=$id;
		$object_params["sid"]=$sid;
		$object_params["name"]=$nm;

		$obj=new object($object_params,0);
		
		echo '<li><a href="'.$obj->get_path().'">'.$nm.'</a></li>';			
	}	
	echo '</ol>';	
	

}

?>