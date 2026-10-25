<nav class="nav">
					<ul id="nav">
<?php
	$part=$site->current_part;
	
	$obj=$part;
	
	$obj->get_path();
	$obj->get_child("special",0,"all");
		
	if($obj->childs_count>0)
	{
		for($j=0;$j<$obj->childs_count;$j++)
		{
			$id_type=$obj->childs_index[$j][0];
			$id=$obj->childs_index[$j][1];
			$obj1=$obj->childs[$id_type][$id];
            
            if($part->sid=="main") $obj1->get_child("special",0,"all");
            if($part->sid=="en" && $j!=3) $obj1->get_child("special",0,"all");
            
            if($part->sid=="en" && $site->open[1]["sid"]==$obj1->sid && $obj1->childs_count>0) $class=' class="active hasdrop"';
            elseif($part->sid=="en" && $site->open[1]["sid"]==$obj1->sid) $class=' class="active"';
            elseif($part->sid=="main" && $site->open[0]["sid"]==$obj1->sid && $obj1->childs_count>0) $class=' class="active hasdrop"';
            elseif($part->sid=="main" && $site->open[0]["sid"]==$obj1->sid) $class=' class="active"';
            elseif($obj1->childs_count>0) $class=' class="hasdrop"';
            else unset($class);
            
            if ($obj1->get_path() == '/questions/'){
                   echo '<li'.$class.'><a href="/vozmozhnosti_apik/marketing/">Маркетинг</a>';
		}
            else {
                  echo '<li'.$class.'><a href="'.$obj1->get_path().'">'.$obj1->name.'</a>';
                  };

            if($obj1->childs_count>0)
            {
                echo '<div class="nav-drop"><ul>';
                for($k=0;$k<$obj1->childs_count;$k++)
        		{
        			$id_type=$obj1->childs_index[$k][0];
        			$id=$obj1->childs_index[$k][1];
        			$obj2=$obj1->childs[$id_type][$id];
                          
                    echo '<li'.$class.'><a href="'.$obj2->get_path().'">'.$obj2->name.'</a></li>';
        		}
                echo '</ul></div>';
            }
            echo '</li>';
		}
		
	}
?>					</ul>
				</nav>