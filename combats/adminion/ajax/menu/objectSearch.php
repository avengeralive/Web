<?php
if(isset($_GET['action']) && $_GET['action']!='')
{
	if($_GET['action']=='load' && $_GET['Search']!='')
	{
		$qq = (is_numeric($_GET['Search']) ? '`id`="'.$_GET['Search'].'"' : '`name` LIKE "%'.mysql_real_escape_string($_GET['Search']).'%"');
		$sp = mysql_query('SELECT * FROM `dungeon_obj` WHERE '.$qq.' ORDER BY `id` LIMIT 1000');

		while($pl= mysql_fetch_array($sp))
		{ 
            $dun = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_room` WHERE `dungeon_id` = "'.$pl['for_dn'].'" LIMIT 1'));
			echo "<div class='new_br'><div><hr><b>".$pl['name']."</b> [ID:".$pl['id']."]: <b>x:</b> ".$pl['x']." <b>y:</b> ".$pl['y']." <b>date:</b> ".$pl['date']." <b>пещера:</b> ".$dun['dungeon_name']."</div>";
		}
	}
	die();
}

?>
<style>
.new_br
{
	margin-bottom:20px;
}
</style>
<script>
function itemSearch()
{
	var Search = $("#Search").val();
	$.ajax({
		url: "?mod=context&menu=objectSearch&action=load&Search="+Search,
		type: "GET",
		success: function(data)
		{
            $('#List').html("");
			$('#List').append(data);
		}
	});
}
</script>
<div style="display:flex; text-align: center; margin: 10px auto;">
	<div style="margin: auto;">
		Поиск према по названию или id<br>
		<input name="Search" id="Search"  style="width: 300px;" placeholder="название или id объекта">
		&nbsp;<button onclick="itemSearch();">Найти</button>
	</div>
</div><br>
<div id="List" style="width:100%;"></div>