<div class="news-row">
				<div class="container">
					<div class="news-wrap">
						<div class="news-side">
							<div class="h1"><a href="/about/apic-news/">АПИК информирует</a></div>
							<!-- <div class="social-info">
								<div class="text">Следите за нашими новостями</div>
								<ul class="social-list">
									<li><a href="#"><img src="/images/ico05.png" width="26" height="27" alt="image description"></a></li>
									<li><a href="#"><img src="/images/ico06.png" width="26" height="27" alt="image description"></a></li>
									<li><a href="#"><img src="/images/ico07.png" width="26" height="27" alt="image description"></a></li>
									<li><a href="#"><img src="/images/ico08.png" width="26" height="27" alt="image description"></a></li>
									<li><a href="#"><img src="/images/ico09.png" width="26" height="27" alt="image description"></a></li>
								</ul>
							</div> -->
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
		$object_params["id"]=365;
		$object_params["active"]=1;
    }

	$obj=new object($object_params,1);
    $obj->get_path();
	$obj->get_child("special",0,4);


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