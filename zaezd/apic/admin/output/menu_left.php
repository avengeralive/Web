<?php
if(!empty($_SESSION["user_type"]))
{
$site->get_parts();

for($i=0;$i<$site->part_count;$i++)
{
	$part=$site->part[$site->part_index[$i]];
	
    echo '<li><a href="'.$part->get_path("/admin").'">'.$part->name.'</a>';
	
	if($part->id==$site->current_part->id) $part->get_child("special",0,"all");
	
	if($part->childs_count>0)
	{
		echo '<ul>';
		
		for($j=0;$j<$part->childs_count;$j++)
		{
			$id_type=$part->childs_index[$j][0];
			$id=$part->childs_index[$j][1];
			$obj=$part->childs[$id_type][$id];
			
			echo '<li><a href="'.$obj->get_path("/admin").'">'.$obj->name.'</a></li>';
		}
		
		echo '</ul>';
	}
	echo '</li>';
}
}
?>