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
		$object_params["id"]=2;
		$object_params["active"]=1;
    }

	$obj=new object($object_params,1);
    $obj->get_path();
	$obj->get_child("special",0,3);

echo '<div class="heading">';
if($part->sid=="eng") 
{
    echo '<h2>News</h2>';
    echo '<a href="'.$obj->get_path().'" class="link-all">Archive</a></div>';
}
else
{
    echo '<h2>В центре внимания</h2>';
    echo '<a href="'.$obj->get_path().'" class="link-all">Все события</a></div>';
}

echo '<ul class="product-list">';
for($j=0;$j<$obj->childs_count;$j++)
{
	$id_type=$obj->childs_index[$j][0];
	$id=$obj->childs_index[$j][1];
	$obj1=$obj->childs[$id_type][$id];
	

	$obj1->get_content();
	
	if($part->sid=="eng") $obj1->get_date("text_en");
    else $obj1->get_date("text");
	
    $text=$obj1->field["val"][1];
	echo '<li><div class="inner">';
    if(!empty($obj1->field["val"][4])) echo '<div class="img-holder"><img src="'.$obj1->field["val"][4].'" alt="'.$obj1->name.'"></div>';
    echo '<div class="content"><strong class="title"><a href="'.$obj1->get_path().'">'.$obj1->name.'</a></strong>';
	//echo '<span class="date"><time datetime="01-01">'.$obj1->date_add.'</time></span><div class="description">';
    echo '<div class="description">';
	echo $textile->TextileThis($text);
    if($part->sid=="eng") echo '</div><div class="link-holder"><a href="'.$obj1->get_path().'">Read more</a></div></div></div></li>';
    else echo '</div><div class="link-holder"><a href="'.$obj1->get_path().'">Читать далее</a></div></div></div></li>';


}
echo '</ul>';
?>
         