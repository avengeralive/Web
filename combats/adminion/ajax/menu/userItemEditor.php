<?php
if(isset($_GET['action']) && $_GET['action']!='')
{
	//сохранение параметров вещи
	if($_GET['action']=='saveItem' ){
		$_POST['it_par'] = iconv('utf-8', 'cp1251', $_POST['it_par']);
		mysql_query('UPDATE `items_users` SET `data` = "'.$_POST['it_par'].'" WHERE `id` = '.mysql_real_escape_string($_POST['it_id']).';');
	}
	
	if($_GET['action']=='deleteItem' ){
		mysql_query('DELETE FROM `items_users` WHERE `id` = '.mysql_real_escape_string($_POST['it_id']).' LIMIT 1;');
	}
	
	
	//вывод из бд по айдишнику вещи
	if($_GET['action']=='loadItems' )
	{
		if (isset($_GET['itId']) && $_GET['itId']!='' && $_GET['itId']!="undefined")
		{
			if ((isset($_GET['itco']))&&($_GET['itco']>0))
			{
				$itco = $_GET['itco'];
			} else {
				$itco = 0;
			}
			$sp = mysql_query('SELECT `uid`, `id`, `data` FROM `items_users` WHERE `item_id` = "'.mysql_real_escape_string($_GET['itId']).'" ORDER BY `id` LIMIT '.$itco.', 10;');
			$it_n = mysql_query('SELECT `name`, `img` FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($_GET['itId']).'" ORDER BY `id` ;');
			$it_n_r = mysql_fetch_array($it_n);
			if ((isset($_GET['itco']))&&($_GET['itco']==0) && (mysql_num_rows($it_n)>0)){
				echo "<div>
					
					<b>".$it_n_r['name']."</b> [id:".$_GET['itId']."]
					<br><img src='https://img.testcombats.ru/i/items/".$it_n_r['img']."'>
				</div>";
			}
			
			//выводим инфу о каждом найденном персонаже и шмотке
			$i = 1;
			while($it_s = mysql_fetch_array($sp)){ 
				$us_r = mysql_query('SELECT `login`, `bot_room`, `align`, `level`, `id`, `pass` FROM `users` WHERE `id` = "'.mysql_real_escape_string($it_s['uid']).'" ORDER BY `id` ;');
				$pl = mysql_fetch_array($us_r);
				//проверка не бот ли и вывод инфы перса
				if ($pl['login']!="") { 
				if (($pl['pass']=="saintlucia")||($pl['bot_room']>0)) { $pp="[бот]"; $ppi="bots"; } else {$pp=""; $ppi="humans";}

						echo "<div class='".$ppi." new_br' id='i-".$it_s['id']."'><div><hr>".$pp."&nbsp;".$u->microLogin($it_s['uid'],1)." [id перса:".$it_s['uid']."] [id шмотки на персе: ".$it_s['id']."]</div>";
						//вывод параметров шмотки
						echo "<div><textarea id='id-".$it_s['id']."'>".$it_s['data']."</textarea></div>";
						echo "<script>
						function userItemSave".$it_s['id']."(){
							var itpar = $('#id-".$it_s['id']."').val();
							var itid = ".$it_s['id'].";
		
								$.ajax({
								url: '/adminion/index.php?mod=context&menu=userItemEditor&action=saveItem',
								type: 'POST',
								data: 'it_par='+itpar+'&it_id='+itid,
								beforeSend: function(){
									$('#savecheck-".$it_s['id']."').text('$nbsp...$nbsp...$nbsp...$nbsp...$nbsp...');
								},
								success: function(){
									$('#savecheck-".$it_s['id']."').html('<font color=green>&nbsp;Успешно сохранено</font>');
								}
							});
					
						}
						</script>
						<div><button onclick='userItemSave".$it_s['id']."();'>Сохранить параметры шмотки</button>
						";
						echo "&nbsp;<a onclick='PopUpShow".$it_s['id']."();  '><img src=https://img.testcombats.ru/i/clear.gif></a><span id='savecheck-".$it_s['id']."'></span></div>";
						echo "</div>";
						echo "
							<div class='b-popup' id='popup".$it_s['id']."'>
								<div class='b-popup-content'>
									Вы действительно хотите удалить <br><br>
									<img src='https://img.testcombats.ru/i/items/".$it_n_r['img']."'><b> ".$it_n_r['name']."</b> [id шмотки на персе: ".$it_s['id']."]<br><br>
									у персонажа ".$u->microLogin($it_s['uid'],1)." [id персонажа: ".$pl['id']."]<br><br>
									<button onclick='userItemDelete".$it_s['id']."();'>да</button><button onclick='PopUpHide".$it_s['id']."();'>нет, оставить шмотку</button>
								</div>
							</div>
						";
						
						echo "<script>
								$(document).ready(function(){
									PopUpHide".$it_s['id']."();
								});
								function PopUpShow".$it_s['id']."(){
									$('#popup".$it_s['id']."').show();
								}
								function PopUpHide".$it_s['id']."(){
									$('#popup".$it_s['id']."').hide();
								}
							</script>";	

						echo "<script> 
							function userItemDelete".$it_s['id']."(){
							var itid = ".$it_s['id'].";
		
								$.ajax({
								url: '/adminion/index.php?mod=context&menu=userItemEditor&action=deleteItem',
								type: 'POST',
								data: 'it_id='+itid,
								success: function(){
									$('#i-".$it_s['id']."').html('<font color=red>&nbsp;Предмет <b> ".$it_n_r['name']."</b> у персонажа <b>".$pl['login']."</b>[".$pl['level']."] удален</font>');
									PopUpHide".$it_s['id']."();
								}
							});
					
						}
						</script>";	

				}
				$i++;
			}
		}
		//вывод из бд по айдишнику персонажа
		elseif (isset($_GET['usId'])){ 
			$us_r = mysql_query('SELECT `login`, `align`, `level`, `id`, `pass` FROM `users` WHERE `id` = "'.mysql_real_escape_string($_GET['usId']).'" ORDER BY `id` ;');
			$num_us_r = mysql_num_rows($us_r);
			
			//если айдишника нет, то смотрим по имени перса
			if ($num_us_r != 1) {
				$us_r = mysql_query('SELECT `login`, `align`, `level`, `id`, `pass` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_GET['usId']).'" ORDER BY `id` ;');
			}
			$pl = mysql_fetch_array($us_r);
			//вывод инфы о персе
			if ($pl['login']!="") {
				if ((isset($_GET['itco']))&&($_GET['itco']>0)){
					$itco = $_GET['itco'];
				} else {
					$itco = 0;
					echo "<div>".$u->microLogin($pl['id'],1)." [id: ".$pl['id']."]</div>";
				}
				$sp = mysql_query('SELECT `item_id`, `id`, `data` FROM `items_users` WHERE `uid` = "'.mysql_real_escape_string($pl['id']).'" ORDER BY `id` LIMIT '.$itco.', 10;');
				
				//выводим инфу о каждом найденной шмотке
				$i=1;
				while($it_s = mysql_fetch_array($sp)){
					$it_n = mysql_query('SELECT `name`, `img` FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($it_s['item_id']).'" ORDER BY `id`;');
					$it_n_r = mysql_fetch_array($it_n);
					echo "<div class='new_br' id='i-".$it_s['id']."'><div><hr><img src='https://img.testcombats.ru/i/items/".$it_n_r['img']."'><b> ".$it_n_r['name']."</b> [id:".$it_s['item_id']."] [id шмотки на персе: ".$it_s['id']."]</div>";
					//вывод параметров шмотки
					echo "<div><textarea id='id-".$it_s['id']."'>".$it_s['data']."</textarea></div>";
					echo "<script> 
					function userItemSave".$it_s['id']."(){
						var itpar = $('#id-".$it_s['id']."').val();
						var itid = ".$it_s['id'].";
	
							$.ajax({
							url: '/adminion/index.php?mod=context&menu=userItemEditor&action=saveItem',
							type: 'POST',
							data: 'it_par='+itpar+'&it_id='+itid,
							beforeSend: function(){
								$('#savecheck-".$it_s['id']."').text('$nbsp...$nbsp...$nbsp...');
							},
							success: function(){
								$('#savecheck-".$it_s['id']."').html('<font color=green>&nbsp;Успешно сохранено</font>');
							}
						});
				
					}
					</script>
					<div><button onclick='userItemSave".$it_s['id']."();'>Сохранить параметры шмотки</button>
					";
					echo "&nbsp;<a onclick='PopUpShow".$it_s['id']."();'><img src=https://img.testcombats.ru/i/clear.gif></a><span id='savecheck-".$it_s['id']."'></span></div>";
					echo "</div>";
					
					echo "
						<div class='b-popup' id='popup".$it_s['id']."'>
							<div class='b-popup-content'>
								Вы действительно хотите удалить <br><br>
								<img src='https://img.testcombats.ru/i/items/".$it_n_r['img']."'><b> ".$it_n_r['name']."</b> [id шмотки на персе: ".$it_s['id']."]<br><br>
								у персонажа ".$u->microLogin($pl['id'],1)." [id: ".$pl['id']."]<br><br>
								<button onclick='userItemDelete".$it_s['id']."();'>да</button><button onclick='PopUpHide".$it_s['id']."();'>нет, оставить шмотку</button>
							</div>
						</div>
					";
					
					echo "<script>
							$(document).ready(function(){
								PopUpHide".$it_s['id']."();
							});
							function PopUpShow".$it_s['id']."(){
								$('#popup".$it_s['id']."').show();
							}
							function PopUpHide".$it_s['id']."(){
								$('#popup".$it_s['id']."').hide();
							}
						</script>";
						
					echo "<script> 
						function userItemDelete".$it_s['id']."(){
						var itid = ".$it_s['id'].";
	
							$.ajax({
							url: '/adminion/index.php?mod=context&menu=userItemEditor&action=deleteItem',
							type: 'POST',
							data: 'it_id='+itid,
							success: function(){
								$('#i-".$it_s['id']."').html('<font color=red>&nbsp;Предмет <b> ".$it_n_r['name']."</b> удален</font>');
								PopUpHide".$it_s['id']."();
							}
						});
				
					}
					</script>";
					$i++;
					}
					
		
				}
			}
		
	}
		
	die();
}

?>
<style>
.b-popup{
  display: none;
  background: rgba(0,0,0,.5);
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
}
.b-popup .b-popup-content{
    width:450px;
    height: 250px;
    padding:10px;
    background-color: #c5c5c5;
    border-radius:5px;
    box-shadow: 0px 0px 10px #000;
	position:fixed;
	top: 50%;
	left: 50%;
	margin-left: -225px;
	margin-top: -125px;
}

textarea
{
	width:100%;
	height: 60px;
	overflow-y: scroll;
}
.new_br
{
	margin-bottom:20px;
}
</style>
<script>
function usersItemSearch(){
	var itid = $("#itId").val();
	var usid = $("#usId").val();	
	$.ajax({
		url: "?mod=context&menu=userItemEditor&action=loadItems&itco="+itco,
		type: "GET",
		data: "itId="+itid+"&usId="+usid,
		beforeSend: function(){
			$('#bots_hide_but').hide();
			$("#itco").val(0);
		},
		success: function(data){
			$('#itemsList').html(data);	
			$('#bots_hide_but').show();
			$('#itco').show();
			$("#itco").val(10);
		}
	});
}
function usersItemSearchPlus(){
	block = true;
	var itid = $("#itId").val();
	var usid = $("#usId").val();
	var itco = $("#itco").val();
	$.ajax({
		url: "?mod=context&menu=userItemEditor&action=loadItems&itco="+itco,
		type: "GET",
		data: "itId="+itid+"&usId="+usid,
		success: function(data){			
			itco = Number(itco)+10;	
			$("#itco").val(itco);
//			$('#itemsList').append("<hr>-- "+itco/10+" --");	
			$('#itemsList').append(data);
			block = false;
		}
	});
}

var block = false;
$(window).scroll(function(){
	if($(window).height() + $(window).scrollTop()+100 >= $(document).height() && !block) {
		usersItemSearchPlus()
	}
});

</script>
<div style="display:flex;">

	<div>
		Поиск конкретной шмотки на всех персонажах<br>
		<input name="itId" id="itId"  style="width: 200px;" placeholder="сюда ввести id шмотки">
		<br><button onclick=" $('#usId').val(''); usersItemSearch();$('#show_bots').hide(); $('#hide_bots').show(); $('#show_hum').hide(); $('#hide_hum').show();">Найти предмет по id</button>
	</div>

	<div style="padding:30px;">
		<b>ИЛИ</b>
	</div>

	<div>все шмотки на одном персонаже<br>
		<input name="usId" id="usId"  style="width: 200px;" placeholder="сюда ввести имя или id персонажа">
		<br><button onclick=" $('#itId').val(''); usersItemSearch(); $('#bots_hide_but').hide();">Найти предметы на персонаже (имя или id)</button>
	</div>

</div>
<!--
<div id="bots_hide_but" style="display:none;">
	<button  id="hide_bots" onclick="$('.bots').hide(); $('#hide_bots').hide(); $('#show_bots').show();">убрать ботов</button>
	<button  id="show_bots" onclick="$('.bots').show(); $('#show_bots').hide(); $('#hide_bots').show();" style="display:none;">показать ботов</button>
	<button  id="hide_hum" onclick="$('.humans').hide(); $('#hide_hum').hide(); $('#show_hum').show();">убрать персонажей</button>
	<button  id="show_hum" onclick="$('.humans').show(); $('#show_hum').hide(); $('#hide_hum').show();" style="display:none;">показать персонажей</button>
</div>
-->
<div id="itemsList" style="width:100%;"></div>
<button id='itco' style="display:none; onclick="usersItemSearchPlus(); ">Загрузить еще</button>