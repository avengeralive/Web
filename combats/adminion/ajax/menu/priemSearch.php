<?php
if(isset($_GET['action']) && $_GET['action']!='')
{
	if($_GET['action']=='load' && $_GET['Search']!='')
	{
		$qq = (is_numeric($_GET['Search']) ? '`id`="'.$_GET['Search'].'"' : '`name` LIKE "%'.mysql_real_escape_string($_GET['Search']).'%"');
		$sp = mysql_query('SELECT * FROM `priems` WHERE '.$qq.' ORDER BY `id` LIMIT 1000');

		while($pl= mysql_fetch_array($sp))
		{ 
			echo "<div class='new_br'><div><hr><b>".$pl['name']."</b> [ID:".$pl['id']."]: ".$pl['info']."<br>
			<b>tr:</b> ".$pl['tr']." <b>date2:</b> ".$pl['date2']." <b>date3:</b> ".$pl['date3']."</div>";
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
		url: "?mod=context&menu=priemSearch&action=load&Search="+Search,
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
		<input name="Search" id="Search"  style="width: 300px;" placeholder="название или id приема">
		&nbsp;<button onclick="itemSearch();">Найти</button>
	</div>
</div><br>
<div id="List" style="width:100%;"></div>