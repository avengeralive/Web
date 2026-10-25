<?php namespace lib;
	if (!in_array('tech', $RoleGroup) && !in_array('tech', $RoleUser)) die();
	
	$css = [];
	$Result = JBase::get_Data('colors', ['alias','name','hash'], ['on' => 1]);
	if ($Result) {
		while($csss = $Result->fetch_assoc()) {
			$css[$csss['name']] = [$csss['alias'] => $csss['hash']];
		}
	}
?>

<div id="top">
	<h1>Вебмастера
		<i class="pull-right">
			<input class="btn btn-primary add" item="0" list="38" type="submit" value="Добавить Команду">
			<input class="btn btn-primary add" item="0" list="39" type="submit" value="Добавить Вебмастера">
		</i>
		<i>Вебмастера и Команды</i>
   </h1>
</div>
<div id="contents-add"></div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#container-1">Вебмастера</a></li>
  <li><a data-toggle="tab" href="#container-2">Команды</a></li>
</ul>
<div class="tab-content" id="list2" style="padding-top: 6px;">
	<div id="container-1" class="tab-pane fade in active">
		<div searcher="" class="call crmls" list="39" status="all" user="all" count="150" pagination="true" template="10"></div><div paginator></div>
	</div>
	<div id="container-2" class="tab-pane fade">
		<div searcher="" class="call crmls" list="38" status="all" user="all" count="50" pagination="true" template="10"></div><div paginator></div>
	</div>
</div>