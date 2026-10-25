<div class="news-row">
				<div class="container">
					<div class="news-wrap">
						<div class="news-side">
<?php
 if($site->current_part->sid=="main" && $site->open[0]["sid"]=="members" && !empty($action[1]))
 {
    $sql='select * from firms where cexp_only=0 and id='.addslashes($action[1]);
    $firm=mysql_query($sql);
    $id_firm=mysql_result($firm,0,0);
    $name=mysql_result($firm,0,1);
    
    echo '<div class="h1"><a href="/members/news/action-firm-'.$id_firm.'/">Новости компании '.$name.'</a></div>';
 }
 elseif($site->current_part->sid=="main" && !($site->open[0]["sid"]=="members" && !empty($action[1]))) echo '<div class="h1"><a href="/members/news/">Новости членов АПИК</a></div>';
?>                        
							<ul class="link-list">
								<li><a href="/members/geograph/">География АПИК</a></li>
								<li><a href="/members/geograph/">АПИК в вашем городе</a></li>
							</ul>
						</div>
						<ul class="news-list">
<?php

    $part=$site->current_part;
    
    if($part->sid=="eng")
    {
		$object_params["id_part"]=$part->id;
		$object_params["id_type"]=1;
		$object_params["id"]=29;
		$object_params["active"]=1;
    }
    else
    {
        $object_params["id_part"]=$part->id;
		$object_params["id_type"]=1;
		$object_params["id"]=795;
		$object_params["active"]=1;
    }

	$obj=new object($object_params,1);
    $obj->get_path();
	
    if($site->current_part->sid=="main" && !($site->open[0]["sid"]=="members" && !empty($action[1]))) $obj->get_child("special",0,4);
    elseif($site->current_part->sid=="main" && $site->open[0]["sid"]=="members" && !empty($action[1]))
    {
        $obj->params["search"][6]["fld"]=6;
        $obj->params["search"][6]["gt"]=$id_firm-1;
        $obj->params["search"][6]["lt"]=$id_firm+1;
    
        $obj->get_child_intersect("special",0,4);
    }


for($j=0;$j<$obj->childs_count;$j++)
{
	$id_type=$obj->childs_index[$j][0];
	$id=$obj->childs_index[$j][1];
	$obj1=$obj->childs[$id_type][$id];
	

	$obj1->get_content();
	
	if($part->sid=="eng") $obj1->get_date("text_en_short");
    else $obj1->get_date("text_short");
    
    $pic=$obj1->field["val"][3];
    if(empty($pic)) $pic="/images/apic_logo_small.png";

	
    $text=$obj1->field["val"][1];
	echo '<li>
								<a href="'.$obj1->get_path().'"><div class="visual">
									<div class="img-holder"><img src="'.$pic.'" alt="'.strip_tags($obj1->name).'"></div>
									<div class="date">'.$obj1->date_add.'</div>
								</div>
								<div class="frame">'.$obj1->name.'</div></a>
							</li>';


}
?>
						</ul>
					</div>
				</div>
			</div>