<?php
if($_SESSION["user_type"]==1) echo '<li id="l1"><a href="/admin/action-part_add/"><strong>Добавить часть</strong></a></li>';

if(!empty($_SESSION["user_type"]))
{
echo '<li id="l2"><a href="#"><strong>Добавить объект</strong></a>';

if(!empty($site->current_part))
{
echo '<ul class="sub">';
$part=$site->current_part;
$part->get_type();

if(empty($site->params["mode"]) && $part->permit>0)
{
	$path="";
	if(!empty($site->current_object))
		$path=$site->current_object->get_path("/admin");
	else 
		$path=$part->get_path("/admin");
	
	for($i=0;$i<$part->type_count;$i++)
		echo '<li><a href="'.$path.'action-child_add-'.$site->type[$part->type[$i]]["sid"].'/">'.$site->type[$part->type[$i]]["name"].'</a></li>';
}

echo '</ul>';
echo '</li>';
}
}


if($_SESSION["user_type"]==1)
{
echo '<li id="l3"><a href="/admin/type/"><strong>Типы объектов</strong></a>';
echo '<ul class="sub">';

	for($i=0;$i<$site->type_count;$i++)
		echo '<li><a href="/admin/type/'.$site->type[$site->type_index[$i]]["sid"].'/">'.$site->type[$site->type_index[$i]]["name"].'</a></li>';

echo '</ul>';
echo '</li>';

if(!empty($site->current_part))
{
	
	$part=$site->current_part;
	
	$part->get_rubric();
	
echo '<li id="l4"><a href="'.$part->get_path("/admin/rubric").'"><strong>Рубрики</strong></a>';
echo '<ul class="sub">';

	
	
	for($j=0;$j<$part->rubric_count;$j++)
		echo '<li><a href="'.$part->get_path("/admin/rubric").$part->rubric[$part->rubric_index[$j]]->sid.'/">'.$part->rubric[$part->rubric_index[$j]]->name.'</a></li>';
}
else 
{
echo '<li id="l4"><a href="#"><strong>Рубрики</strong></a>';
echo '<ul class="sub">';
}
echo '</ul>';
echo '</li>';

echo '<li id="l5"><a href="/admin/user/"><strong>Пользователи</strong></a></li>';

echo '<li id="l6"><a href="/admin/temy/"><strong>Темы</strong></a></li>';


}
?>