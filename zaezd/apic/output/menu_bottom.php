<div class="col">
<?php
	$part=$site->current_part;
	
	$obj=$part;
	
	$obj->get_path();
	$obj->get_child("special",0,7);
		
	if($obj->childs_count>0)
	{
		for($j=0;$j<$obj->childs_count;$j++)
		{
			$id_type=$obj->childs_index[$j][0];
			$id=$obj->childs_index[$j][1];
			$obj1=$obj->childs[$id_type][$id];
            if($part->sid=="main") $obj1->get_child("special",0,"all");
            if($part->sid=="en" && $j!=3) $obj1->get_child("special",0,"all");
            echo '<h4><a href="'.$obj1->get_path().'">'.$obj1->name.'</a></h4><ul class="footer-menu">';
            for($k=0;$k<$obj1->childs_count;$k++)
    		{
    			$id_type=$obj1->childs_index[$k][0];
    			$id=$obj1->childs_index[$k][1];
    			$obj2=$obj1->childs[$id_type][$id];
                      
                echo '<li'.$class.'><a href="'.$obj2->get_path().'">'.$obj2->name.'</a></li>';
    		}
            echo '</ul>';
            if($part->sid=="main" && $j!=0 && $j!=5 && $j!=6) echo '</div><div class="col">';
            if($part->sid=="en" && $j!=1 && $j!=5) echo '</div><div class="col">';
		}
		
	}
?>
<!-- <div class="socials">
<h4>Социальные сети</h4>
<ul class="social-list">
<li><a href="#"><img src="/images/ico05.png" width="26" height="27" alt="image description"></a></li>
<li><a href="#"><img src="/images/ico06.png" width="26" height="27" alt="image description"></a></li>
<li><a href="#"><img src="/images/ico07.png" width="26" height="27" alt="image description"></a></li>
<li><a href="#"><img src="/images/ico08.png" width="26" height="27" alt="image description"></a></li>
<li><a href="#"><img src="/images/ico09.png" width="26" height="27" alt="image description"></a></li>
</ul>
</div> -->
</div>