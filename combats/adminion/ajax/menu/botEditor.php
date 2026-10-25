<?php
if(isset($_GET['action']) && $_GET['action']!=''){


	if($_GET['action']=='loadBots' && isset($_GET['did']) && $_GET['did']>"0"){

		$sp = mysql_query('SELECT * FROM `dungeon_bots` WHERE `dn` = "0" AND `for_dn` = "'.mysql_real_escape_string($_GET['did']).'"  ORDER BY `id2`;');
		if(mysql_num_rows($sp)>0){
			echo'Список ботов:
				<div class="divTable" style="text-align: center;">
				<div class="divTableBody">
				<div class="divTableRow">
					<div class="divTableCell">Информация о боте</div>
					<div class="divTableCell">Перемещается</div>
					<div class="divTableCell">Действие</div>
				</div>
			';
			$i = 1;
			while($pl = mysql_fetch_array($sp)){
				if( $pl['id_bot'] > 0 ){
					$bot = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `id` = "'.$pl['id_bot'].'" LIMIT 1;'));
					echo'
						<div class="divTableRow">
							<div class="divTableCell" style="text-align: left;">ID:['.$pl['id2'].'] <b>'.$bot['login'].'</b> x'.$pl['colvo'].'</div>
							<div class="divTableCell" >'.($pl['go_bot']=="0"? 'Не перемещается':'Перемещяется').'</div>
							<div class="divTableCell"><a onclick="showDlg(\''.$pl['id2'].'\');return false;">Изменить</a> / <a onclick="botEditorDelete(\''.$pl['id2'].'\',\''.$_GET['did'].'\');return false;">Удалить</a></div>
						</div>
					';
					echo '';
				}
				elseif( $pl['bot_group'] != '' ){
					echo'
						<div class="divTableRow">
						<div class="divTableCell">
					';
					$bots = explode( ',', $pl['bot_group'] );
					$jjj=0;

					while( $jjj < count($bots) ){
						$bot = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `id` = "'.$bots[$jjj].'" LIMIT 1'));
						if( isset($bot['login']) ) echo 'ID:['.$pl['id2'].'] <b>'.$bot['login'].'</b>, ';
						$jjj++;
					}
					echo ' [x'.$pl['colvo'].']</div> 
						<div class="divTableCell" >'.($pl['go_bot']=="0"? 'Не перемещается':'Перемещяется').'</div>
						<div class="divTableCell"><a onclick="showDlg(\''.$pl['id2'].'\');return false;">Изменить</a> / <a onclick="botEditorDelete(\''.$pl['id2'].'\',\''.$_GET['did'].'\');return false;">Удалить</a></div></div>';
				}
				$i++;
			}
			echo'</div></div>';
		}
		else{
			echo'Ничего не найдено';
		}
		
	}
	elseif($_GET['action']=="saveBots"){
		mysql_query('UPDATE `dungeon_bots` SET `id_bot`="'.mysql_real_escape_string($_GET['bId']).'",`bot_group`="'.mysql_real_escape_string($_GET['bGroup']).'",`colvo`="'.mysql_real_escape_string($_GET['bCount']).'",`go_bot`="'.mysql_real_escape_string($_GET['bMove']).'",`x`="'.mysql_real_escape_string($_GET['bX']).'",`y`="'.mysql_real_escape_string($_GET['bY']).'" WHERE `id2`="'.mysql_real_escape_string($_GET['id']).'" LIMIT 1;');
		
		if($_GET['bId']>"0"){
			mysql_query('UPDATE `test_bot` SET
				`login` = "'.mysql_real_escape_string($_GET['bLogin']).'",
				`obraz` = "'.mysql_real_escape_string($_GET['bObraz']).'",
				`level` = "'.mysql_real_escape_string($_GET['bLevel']).'",
				`sex` = "'.mysql_real_escape_string($_GET['bSex']).'",
				`name` = "'.mysql_real_escape_string($_GET['bName']).'",
				`agressor` = "'.mysql_real_escape_string($_GET['bAgressor']).'",
				`expB` = "'.mysql_real_escape_string($_GET['bExpB']).'",
				`stats` = "'.mysql_real_escape_string($_GET['bStats']).'",
				`itemsUse` = "'.mysql_real_escape_string($_GET['bItemsUse']).'",
				`p_items` = "'.mysql_real_escape_string($_GET['bP_items']).'" WHERE `id` = "'.mysql_real_escape_string($_GET['bId']).'"
			LIMIT 1;');
		}
		
		echo'Успешно сохранено';
	}
	elseif($_GET['action']=="addBotsDlg"){
		$sp = mysql_query('SELECT * FROM `dungeon_bots` WHERE `dn` = "0" AND `id2` = "'.mysql_real_escape_string($_GET['id']).'"  ORDER BY `id2`;');
		if(mysql_num_rows($sp)>0){
			$pl = mysql_fetch_array($sp);
			$bt = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `id`="'.$pl['id_bot'].'" LIMIT 1;'));
			echo'
				<div class="divTable" >
					<div class="divTableBody">
						<div class="divTableRow">
							<div class="divTableCell" style="text-align: center;">ID</div>
							<div class="divTableCell" style="text-align: center;">'.$_GET['id'].'</div>
						</div>
						<div class="divTableRow">
							<div class="divTableCell" style="text-align: center;">ID бота</div>
							<div class="divTableCell" style="text-align: center;"><input type="text" name="bId" id="bId" value="'.$pl['id_bot'].'"></div>
						</div>
						<div class="divTableRow">
							<div class="divTableCell" style="text-align: center;">Группа ботов<br/><small>(ID,ID)</small></div>
							<div class="divTableCell" style="text-align: center;"><input type="text" name="bGroup" id="bGroup" value="'.$pl['bot_group'].'"></div>
						</div>
						<div class="divTableRow">
							<div class="divTableCell" style="text-align: center;">Количество</div>
							<div class="divTableCell" style="text-align: center;"><input type="text" name="bCount" id="bCount" value="'.$pl['colvo'].'"></div>
						</div>
						<div class="divTableRow">
							<div class="divTableCell" style="text-align: center;">Координата X</div>
							<div class="divTableCell" style="text-align: center;"><input type="text" name="bX" id="bX" value="'.$pl['x'].'"></div>
						</div>
						<div class="divTableRow">
							<div class="divTableCell" style="text-align: center;">Координата Y</div>
							<div class="divTableCell" style="text-align: center;"><input type="text" name="bY" id="bY" value="'.$pl['y'].'"></div>
						</div>
						<div class="divTableRow">
							<div class="divTableCell" style="text-align: center;">Перемещается</div>
							<div class="divTableCell" style="text-align: center;">
								<select name="bMove" id="bMove">';
									if($pl['go_bot']==0){
										echo'
											<option value="0" selected>Нет</option>
											<option value="1">Да</option>
										';
									}
									else{
										echo'
											<option value="0">Нет</option>
											<option value="1" selected>Да</option>
										';	
									}
									
							echo'</select>
							</div>
						</div>';
						if($pl['id_bot']>"0"){
							echo'-----------
								<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Логин</div>
									<div class="divTableCell" style="text-align: center;"><input type="text" name="bLogin" id="bLogin" value="'.$bt['login'].'"></div>
								</div>
								<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Образ</div>
									<div class="divTableCell" style="text-align: center;"><input type="text" name="bObraz" id="bObraz" value="'.$bt['obraz'].'"></div>
								</div>
								<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Уровень</div>
									<div class="divTableCell" style="text-align: center;"><input type="text" name="bLevel" id="bLevel" value="'.$bt['level'].'"></div>
								</div>
								<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Пол<br><small>(0 - муж. , 1 - жен.)</small></div>
									<div class="divTableCell" style="text-align: center;"><input type="text" name="bSex" id="bSex" value="'.$bt['sex'].'"></div>
								</div>
								<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Имя</div>
									<div class="divTableCell" style="text-align: center;"><input type="text" name="bName" id="bName" value="'.$bt['name'].'"></div>
								</div>
								<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Агрессия<br><small>(0-100%)</small></div>
									<div class="divTableCell" style="text-align: center;"><input type="text" name="bAgressor" id="bAgressor" value="'.$bt['agressor'].'"></div>
								</div>
								<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Опыт (%)</div>
									<div class="divTableCell" style="text-align: center;"><input type="text" name="bExpB" id="bExpB" value="'.$bt['expB'].'"></div>
								</div>
								<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Статы</div>
									<div class="divTableCell" style="text-align: center;"><textarea rows="5" cols="35" name="bStats" id="bStats">'.$bt['stats'].'</textarea><br>';
										echo'<select id="spar" name="spar">';
										foreach ($cfg['is'] as $key => $val){
											echo '<option value="'.$key.'">'.$val.'</option>';
										}
										echo'</select>';
										echo'<input type="number" id="sparid" name="sparid" size="10" placeholder="кол-во" min="0"><button onclick="botEditorAddStats();">+</button></div>
								</div>
								<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Предметы <br><small>(на боте, 2605 - использует приемы. Перечислять чреез запятую id предмета)</small></div>
									<div class="divTableCell" style="text-align: center;"><textarea rows="5" cols="35" name="bItemsUse" id="bItemsUse">'.$bt['itemsUse'].'</textarea></div>
								</div>
								<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Предметы <br><small>(которые падают с бота)</small></div>
									<div class="divTableCell" style="text-align: center;"><textarea rows="5" cols="35" name="bP_items" id="bP_items">'.$bt['p_items'].'</textarea></div>
								</div>
								';
						}
						
						
					echo'</div>
				</div>
				<div id="saveStatus"></div>
				<br><center><button onclick="botEditorSaveNew('.$_GET['id'].');">Сохранить</button></center>
			';
		}
	}
	elseif($_GET['action']=='delBots'){
		mysql_query('DELETE FROM `dungeon_bots` WHERE `id2`="'.mysql_real_escape_string($_POST['id']).'" LIMIT 1;');
	}

	
	
	die();
}

?>
<style>
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
</style>
<script>
$( "#dialog" ).dialog({
	autoOpen: false,
	width: 500
});

function showDlg(id){
	$( "#dialog" ).dialog( "open" );
	$('#dialog').load(path+'?mod=context&menu=botEditor&action=addBotsDlg&id='+id);
	
}
// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
	function() {
		$( this ).addClass( "ui-state-hover" );
	},
	function() {
		$( this ).removeClass( "ui-state-hover" );
	}
);
function botEditorSaveNew(id){
	var bId = $("#bId").val();
	var bGroup = $("#bGroup").val();
	var bCount = $("#bCount").val();
	var bMove = $("#bMove").val();
	var bX = $("#bX").val();
	var bY = $("#bY").val();
	//-------------------
	var bLogin = $("#bLogin").val();
	var bObraz = $("#bObraz").val();
	var bLevel = $("#bLevel").val();
	var bSex = $("#bSex").val();
	var bName = $("#bName").val();
	var bAgressor = $("#bAgressor").val();
	var bExpB = $("#bExpB").val();
	var bStats = $("#bStats").val();
	var bItemsUse = $("#bItemsUse").val();
	var bP_items = $("#bP_items").val();
	
	$.ajax({
		url: "?mod=context&menu=botEditor&action=saveBots",
		type: "GET",
		data: "id="+id+"&bGroup="+bGroup+"&bCount="+bCount+"&bMove="+bMove+"&bId="+bId+"&bX="+bX+"&bY="+bY+"&bLogin="+bLogin+"&bObraz="+bObraz+"&bLevel="+bLevel+"&bSex="+bSex+"&bName="+bName+"&bAgressor="+bAgressor+"&bExpB="+bExpB+"&bStats="+bStats+"&bItemsUse="+bItemsUse+"&bP_items="+bP_items+"",
		beforeSend: function(){
			$('#saveStatus').text('Loading...');
		},
		success: function(data){
			$("#saveStatus").html(data);
		}
	});
}

</script>
<select name="dnId" id="dnId">
<option value="0">Выберите пещеру</option>
	<?php
		$dng = mysql_query('SELECT `dungeon_id`,`dungeon_name` FROM `dungeon_room` ORDER by `id` ASC');
		while($dn = mysql_fetch_array($dng)){
			echo'<option value="'.$dn['dungeon_id'].'">'.$dn['dungeon_name'].'</option>';
		}
	?>
</select>
<button onclick="botEditorDng();">Найти ботов</button>
<p id="botList" style="max-width:950px; margin: 0 auto;"></p>
<div id="dialog" title="Редактирование ботов"></div>