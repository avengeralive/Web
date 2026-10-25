<?php
if(isset($_GET['action']) && $_GET['action']!='')
{
	if($_GET['action']=='load' && $_GET['Search']!='')
	{
		$qq = (is_numeric($_GET['Search']) ? '`id`="'.$_GET['Search'].'"' : '`name` LIKE "%'.mysql_real_escape_string($_GET['Search']).'%" OR `magic_inci` LIKE "%'.mysql_real_escape_string($_GET['Search']).'%"');
		$sp = mysql_query('SELECT * FROM `items_main` WHERE '.$qq.' ORDER BY `id` LIMIT 1000');

		while($pl= mysql_fetch_array($sp))
		{ 
            $col = mysql_fetch_array(do_query('SELECT COUNT(`id`) FROM `items_users` WHERE `item_id` = "'.$pl['id'].'" AND  `delete` = "0" LIMIT 1'));
			echo "<div class='new_br'><div><hr>".$pl['name']." [ID:".$pl['id']."] <b>инфо:</b> ".$pl['info'].". <b>magic_inci:</b> ".$pl['magic_inci']." на руках: ".$col[0]."</div>";
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
		url: "?mod=context&menu=itemSearch&action=load&Search="+Search,
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
		Поиск предмета по id, названию, magic_inci<br>
		<input name="Search" id="Search"  style="width: 300px;" placeholder="id,название,magic_inci">
		&nbsp;<button onclick="itemSearch();">Найти</button>
	</div>
</div><br>
<div id="List" style="width:100%;"></div>