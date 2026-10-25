<?php
echo '<h1>Карта сайта</h1><br />';

$site->get_parts();

echo '<ul>';

for($i=0;$i<$site->part_count;$i++)
{
	$part=$site->part[$site->part_index[$i]];
	
	echo '<li><a href="'.$part->get_path().'">'.$part->name.'</a>';
	
	$part->get_child("special",0,"all");
	
	if($part->childs_count>0)
	{
		echo '<ul>';
		
		for($j=0;$j<$part->childs_count;$j++)
		{
			$id_type=$part->childs_index[$j][0];
			$id=$part->childs_index[$j][1];
			$obj=$part->childs[$id_type][$id];
			
			echo '<li><a href="'.$obj->get_path().'">'.$obj->name.'</a>';
			
			$obj->get_child("special",0,"all");
			
			if($obj->childs_count>0)
			{
				echo '<ul>';
				
				for($k=0;$k<$obj->childs_count;$k++)
				{
					$id_type=$obj->childs_index[$k][0];
					$id=$obj->childs_index[$k][1];
					$obj1=$obj->childs[$id_type][$id];
					
					$path='/'.$part->sid.'/'.$site->type[$id_type]["sid"].'/'.$obj1->sid.'/';
					echo '<li><a href="'.$obj1->get_path().'">'.$obj1->name.'</a>';
					
					echo '</li>';
				}
				
				echo '</ul>';
			}
			
			echo '</li>';
		}
		
		echo '</ul>';
	}
	
}

echo '</li></ul>';

?>