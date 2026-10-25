<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('admin', $RoleUser) && !in_array('admin', $RoleGroup)) die();	
?>

<br>

<h1>Календарь</h1>
<div id="contents-add"></div><div id="calendar"></div>

<script>
	function startcalendar() {
			//запрашиваем события юзера из бд
   			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token, user:JSCat.user};
			json["action"] = "get_calendar";
			$.post("/json/", json, function(result) {
			if ( typeof result !== 'object' ) result = JSON.parse(result);
			if ( result )
				for (var i=0; i < result.length; i++) {
				 	for (var a in result[i]) {
						if (a == 'start') result[i].start = new Date(result[i].start * 1000).toISOString();
					}
				}
				getcalendar(result);
			});
		}
	function getcalendar(result) {
			//инициализируем события календаря
			$('#calendar').fullCalendar({
				header: {
					left: 'title',
					center: '',
					right: 'prev,today,next'
				},
				defaultView: 'month',
				timezone: 'local',
				eventDurationEditable: true,
				eventResourceEditable: true,
				buttonIcons: true,
				//eventLimit: true,
				timeFormat: 'H:mm',
				lang: 'ru',
				height: 640,
				eventLimit: 6,
				navLinks: true,
				editable: true,
				droppable: true,
				drop: function(date, jsEvent, ui, resourceId) {
//         			новый объект в базу
//         			var timer = Date.parse(date.format()) / 1000;
// 					var json = {func:cabinet.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token, user:JSCat.user};
// 						json["action"] 	= "new_calendar";
// 						json["start"] 	= timer;
// 						json["title"] 	= jsEvent.target.innerText;
// 					$.post("/json/", json, function(result) {
// 						cabinet.calendar.start();
// 					});
      			},
				eventDrop: function(event, delta, revertFunc) {
					//меняем день при перетаскивании
 					var timer = Date.parse(event.start.format()) / 1000;
					var json = {func:cabinet.cfg.url.querypanel, domain:JSCat.domain, token:JSCat.token, user:JSCat.user};
					json["action"] = "update_calendar";
					json["title"] = event.title;
					json["link"] = event.link;
					json["start"] = timer;
					json["id"] = event.id;
					json["description"] = event.description;
					$.post("/json/", json, function(result) {
						cabinet.calendar.start();
					});
				},
// 				dayClick: function(date, jsEvent, view) {
// 					//var timeobj = util.timeObject(date.format('X'));
// 					$('#add').click();
//         		},
				eventClick: function(calEvent, jsEvent, view) {
					//инициализируем клики по событиям
					function waitForElement(elementPath, callBack){
						window.setTimeout(function() {
							if ($(elementPath).length) {
								callBack(elementPath, $(elementPath));
							} else {
								waitForElement(elementPath, callBack);
							}
						},500)
					}
 					var timer = Date.parse(calEvent.start.format()) / 1000;
					var timeobj = util.timeObject(timer);
					$('#calendar .call').remove();
					$('#calendar').append('<div class="call" list="17" user="" item="'+ calEvent.item +'" template="8" count="1" style="display:none;"></div>');
					waitForElement('span.add.owner[list="17"]',function(){
						$('span.add.owner[list="17"]').click();
					});
					
				},
				events: result
			});	
		}
		
		
		startcalendar();
</script>
