<h1><span>404 - страница не найдена</span></h1>
<h2>Страница, которую Вы запросили не найдена или доступ к ней запрещён</h2>
<p>Возможно, Вы попали сюда по неверной ссылке, либо ранее существовавшая страница была удалена</p>
<p>Для поиска нужно информации воспользуйтесь формой поиска или картой сайта</p>
<h2>Карта сайта</h2>

<?php
$site->get_parts();
echo '<ul>';
for($i=0;$i<$site->part_count;$i++)
{
	$part=$site->part[$site->part_index[$i]];
	
	echo '<li><a href="http://'.$config["url"].$part->get_path().'">'.$part->name.'</a>';
	
	$part->get_child("special",0,"all");
	
	if($part->childs_count>0)
	{
		echo '<ul>';
		
		for($j=0;$j<$part->childs_count;$j++)
		{
			$id_type=$part->childs_index[$j][0];
			$id=$part->childs_index[$j][1];
			$obj=$part->childs[$id_type][$id];
			if($id_type==3) continue;
			
			echo '<li><a href="http://'.$config["url"].$obj->get_path().'">'.$obj->name.'</a>';
			
			$obj->get_child("special",0,"all");
			
			if($obj->childs_count>0)
			{
				echo '<ul>';
				
				for($k=0;$k<$obj->childs_count;$k++)
				{
					$id_type=$obj->childs_index[$k][0];
					$id=$obj->childs_index[$k][1];
					$obj1=$obj->childs[$id_type][$id];
					
					if($id_type==3) continue;
					
					echo '<li><a href="http://'.$config["url"].$obj1->get_path().'">'.$obj1->name.'</a>';
					
					echo '</li>';
				}
				
				echo '</ul>';
			}
			
			echo '</li>';
		}
		
		echo '</ul>';
	}
	echo '</li>';
}
echo '</ul>';
?>