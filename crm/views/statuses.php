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
		<h1>Статусы
			<i class="pull-right">
				<input class="btn btn-primary add" item="0" list="9" type="submit" value="Добавить Контейнер">
				<input class="btn btn-primary add" item="0" list="8" type="submit" value="Добавить Статус">
			</i>
			<i>Статусы, Контейнеры, Оттенки</i>
	   </h1>
	</div>
<div id="contents-add"></div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#container-1">Статусы</a></li>
  <li><a data-toggle="tab" href="#container-2">Контейнеры статусов</a></li>
  <li><a data-toggle="tab" href="#container-3">Оттенки групп статусов</a></li>
</ul>
<div class="tab-content" id="list2" style="padding-top: 6px;">
	<div id="container-1" class="tab-pane fade in active">
		<div searcher="" class="call crmls" list="8" status="all" user="all" count="150" pagination="true" template="10"></div><div paginator></div>
	</div>
	<div id="container-2" class="tab-pane fade">
		<div searcher="" class="call crmls" list="9" status="all" user="all" count="50" pagination="true" template="10"></div><div paginator></div>
	</div>
	<div id="container-3" class="tab-pane fade">
		<div id="list"></div>
		<script>
			setTimeout(() => {
			var face = <?php echo json_encode($css); ?>;
			for (var b in face) {
				var key = Object.keys(face[b]);
				
				$('#list').append('<div><strong>' + key + '</strong><span><input type="color" id="'+ b +'" value="'+ face[b][key] +'"></span></div>');
				$('#' + b).click(get_source.bind(this, b, $('#' + b)[0])).click();
			}
			function update(name, param) {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] = 'colors';
				json["params"] = [name, param];
				$.post("/json/", json, function() {});
			}
			function get_source(b, source) {
				var picker = new CP(source);
				source.onclick = function(e) {
					e.preventDefault();
				}
				picker.on("stop", function(color) {
					this.source.value = '#' + color;
					update(b, '#' + color);
					return false;
				});
			}
		}, 2000);
		</script>
	</div>
</div>
<script type="text/javascript" src="/js/colorpicker.js"></script>
<script>
	waitForElement('.spoiler-btn', function() {
        var $spoilers = $('.spoiler-btn'),
            $spoilerBodies = $('.spoiler-body');

        $spoilerBodies.collapse();

        $spoilers.on('click', function() {
            var $target = $(this).parent().find('.spoiler-body');
            $target.collapse('toggle');
        });
	})
</script>