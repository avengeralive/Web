<?php
if(empty($site->current_keyword))
{
	$sql='select id_key,word from '.$pr.'keyword where id_key in (select distinct id_key from '.$pr.'object_keyword where id_part='.$site->current_part->id.') order by word asc';
	$keyw=mysql_query($sql);
	$keyw_count=mysql_num_rows($keyw);
	
	echo '<h1>Tags</h1><br /><br />';
	
	echo '<ul>';
	for($i=0;$i<$keyw_count;$i++)
	{
		echo '<li><a href="/keyword'.$site->current_part->get_path().mysql_result($keyw,$i,0).'/">'.mysql_result($keyw,$i,1).'</a></li>';
	}
	echo '</ul><br />';
}
//----------------------------------------------
if(!empty($site->current_keyword))
{
    $part=$site->current_keyword;
	echo '<h1>'.$part->word.'</h1>';
    
    echo $textile->TextileThis($part->get_text());
    
    

	$part->get_child("special",0,"all");

//		echo $site->navy_bar;

if($part->childs_count>0) echo '<h2>Articles by tag:</h2>';

echo '<ul>';

		for($j=0;$j<$part->childs_count;$j++)
			{
				$id_type=$part->childs_index[$j][0];
				$id=$part->childs_index[$j][1];
				$obj=$part->childs[$id_type][$id];

				echo '<li><a href="'.$obj->get_path().'">'.$obj->name.'</a></li>';

			}
            echo '</ul>';

}
?>