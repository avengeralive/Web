<?php
if(isset($_GET['action']) && $_GET['action']!=''){
	$city = array('capitalcity','newcapital','newcapitalcity','angelscity','abandonedplain','angelcity','demonscity','fallenearth','emeraldscity','suncity','sandcity','mooncity','dreamscity','eastcity','lowcity','oldcity','devilscity');

	function city($arg,$now){
		global $city;
		sort($city);
		$html = '<select name="'.$arg.'">';
		foreach ($city as $value) {
			if($value == $now){
				$html.='<option value="'.$value.'" selected>'.$value.'</option>';
			}
			else{
				$html.='<option value="'.$value.'">'.$value.'</option>';
			}
		}
		$html.='<option value="">-- пусто --</option>';
		$html .= '</select>';
		return $html;
	}
	
	function clanInfo($now){
		$html = '<select name="nclan">';
		if($now=='0'){$html.='<option value="" selected>-- пусто --</option>';}
		$clan = mysql_query('SELECT `id`,`name` FROM `clan` ORDER by `id` ASC;');
		while ($cl = mysql_fetch_array($clan)) {
			
			if($now>0){
				if($cl['id'] == $now){
				$html.='<option value="'.$cl['id'].'" selected>'.$cl['name'].'</option>';
				}
				else{
				$html.='<option value="'.$cl['id'].'">'.$cl['name'].'</option>';
				}
			}
			else{
				$html.='<option value="'.$cl['id'].'">'.$cl['name'].'</option>';
			}
		}
		$html.='<option value="">-- пусто --</option>';
		$html .= '</select>';
		return $html;
	}
	
	function yrn($arg,$now){
		$html = '<select name="'.$arg.'">';
		
		if($now=='1'){
			$html.='<option value="1" selected>Да</option>';
			$html.='<option value="0">Нет</option>';
		}
		elseif($now=='0'){
			$html.='<option value="1">Да</option>';
			$html.='<option value="0" selected>Нет</option>';
		}
		$html .='</select>';
		
		return $html;
	}
	function sex($now){
		$html = '<select name="nsex">';
		
		if($now>0){
			if($now=='1'){
				$html.='<option value="1" selected>Мужской</option>';
				$html.='<option value="2">Женский</option>';
				$html.='<option value="0">-- пусто --</option>';
			}
			elseif($now=='2'){
				$html.='<option value="1">Мужской</option>';
				$html.='<option value="2" selected>Женский</option>';
				$html.='<option value="0">-- пусто --</option>';
			}
		}
		else{
			$html.='<option value="0" selected>-- пусто --</option>';
			$html.='<option value="1">Мужской</option>';
			$html.='<option value="2">Женский</option>';
		}
		
		
		$html .='</select>';
		return $html;
	}

	
	
	if($_GET['action']=='loadRooms'){
		$r = mysql_query('SELECT `id`,`city`,`name` FROM `room` ORDER by `id` ASC');
		if(mysql_num_rows($r)>0){
			echo'Редактирование локаций, <a onclick="addLocation(); return false;">Добавить локацию</a>
				<div class="divTable" style="max-width:700px; margin: 0 auto;">
				<div class="divTableBody"  style="text-align: center;">
				<div class="divTableRow">
						<div class="divTableCell">№</div>
						<div class="divTableCell">Название</div>
						<div class="divTableCell">Город</div>
						<div class="divTableCell">Редактировать</div>
						<div class="divTableCell">Удалить</div>

						

				</div>';
			while($ro = mysql_fetch_array($r)){
					echo'<div class="divTableRow">
						<div class="divTableCell">'.$ro['id'].'</div>
						<div class="divTableCell"  style="text-align: left;">'.$ro['name'].'</div>
						<div class="divTableCell">'.$ro['city'].'</div>
						<div class="divTableCell"><a onclick="editLocation('.$ro['id'].'); return false;">Редактировать</a></div>
						<div class="divTableCell"><a onclick="roomDelete('.$ro['id'].'); return false;">Удалить</a></div>
						
				</div>';
				
			}
			echo'</div></div>';
		}
	}
	elseif($_GET['action']=='editLocation'){
		
		$r = mysql_query('SELECT * FROM `room` WHERE `id` ="'.$_GET['id'].'" ORDER by `id` ASC');
		if(mysql_num_rows($r)>0){
			while($ro = mysql_fetch_array($r)){
				echo'
					<div class="divTable" >
						<div class="divTableBody">
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">№ локации</div>
									<div class="divTableCell">'.$ro['id'].'</div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Название</div>
									<div class="divTableCell"><input type="text" name="nname" value="'.$ro['name'].'" /></div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Город</div>
									<div class="divTableCell">'.city('ncity',$ro['city']).'</div>
							</div>					
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Код</div>
									<div class="divTableCell"><input type="text" name="ncode" value="'.$ro['code'].'" /></div>
							</div>					
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Переход (сек)</div>
									<div class="divTableCell"><input type="text" name="ntimeGO" value="'.$ro['timeGO'].'" /></div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Файл</div>
									<div class="divTableCell"><input type="text" name="nfile" value="'.$ro['file'].'" /></div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Уровень</div>
									<div class="divTableCell"><input type="text" name="nlevel" value="'.$ro['level'].'" /></div>
							</div>		
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Склонность</div>
									<div class="divTableCell"><input type="text" name="nalign" value="'.$ro['align'].'" /></div>
							</div>
														<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Клан ID</div>
									<div class="divTableCell">'.clanInfo($ro['clan']).'</div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Разрушено</div>
									<div class="divTableCell">'.yrn('ndestroy',$ro['destroy']).'</div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Закрыто</div>
									<div class="divTableCell">'.yrn('nclose',$ro['close']).'</div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Переходы в локации</div>
									<div class="divTableCell"><textarea name="nroomGo">'.$ro['roomGo'].'</textarea></div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Пол персонажа</div>
									<div class="divTableCell">'.sex($ro['sex']).'</div>
							</div>
						</div>
					</div>
					<div id="saveStatus" style="color:red;font-weight:bold;"></div><br/>
					<center><button onclick="roomsSave('.$ro['id'].');">Сохранить</button></center>
				';
			}
			
		}
		else{
			echo'Локация не найдена';
		}
		
	}
	elseif($_GET['action']=='addLocation'){
						echo'
					<div class="divTable" >
						<div class="divTableBody">
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Название</div>
									<div class="divTableCell"><input type="text" name="nname" value="" /></div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Город</div>
									<div class="divTableCell">'.city('ncity','capitalcity').'</div>
							</div>					
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Код</div>
									<div class="divTableCell"><input type="text" name="ncode" value="" /></div>
							</div>					
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Переход (сек)</div>
									<div class="divTableCell"><input type="text" name="ntimeGO" value="" /></div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Файл</div>
									<div class="divTableCell"><input type="text" name="nfile" value="" /></div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Уровень</div>
									<div class="divTableCell"><input type="text" name="nlevel" value="" /></div>
							</div>		
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Склонность</div>
									<div class="divTableCell"><input type="text" name="nalign" value="" /></div>
							</div>
														<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Клан ID</div>
									<div class="divTableCell">'.clanInfo($ro['clan']).'</div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Разрушено</div>
									<div class="divTableCell">'.yrn('ndestroy','0').'</div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Закрыто</div>
									<div class="divTableCell">'.yrn('nclose','0').'</div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Переходы в локации</div>
									<div class="divTableCell"><textarea name="nroomGo"></textarea></div>
							</div>
							<div class="divTableRow">
									<div class="divTableCell" style="text-align: center;">Пол персонажа</div>
									<div class="divTableCell">'.sex('0').'</div>
							</div>
						</div>
					</div>
					<div id="saveStatus" style="color:red;font-weight:bold;"></div><br/>
					<center><button onclick="roomsAdd();">Добавить</button></center>
				';
	}
	elseif($_GET['action']=='roomsSave'){
		if(isset($_POST['nid'])){
			$chLoc = mysql_query('SELECT `id` FROM `room` WHERE `id`="'.mysql_real_escape_string($_POST['nid']).'" LIMIT 1;');
			if(mysql_num_rows($chLoc)){
				$nname = iconv('UTF-8', 'windows-1251', $_POST['nname']);
				/*	echo'
					id:'.$_POST['nid'].'<br>
					nname:'.$nname.'<br>
					ncity:'.$_POST['ncity'].'<br>
					ncode:'.$_POST['ncode'].'<br>
					ntimeGO:'.$_POST['ntimeGO'].'<br>
					nfile:'.$_POST['nfile'].'<br>
					nlevel:'.$_POST['nlevel'].'<br>
					nclan:'.$_POST['nclan'].'<br>
					ndestroy:'.$_POST['ndestroy'].'<br>
					nclose:'.$_POST['nclose'].'<br>
					nsex:'.$_POST['nsex'].'<br>
				'; */
				if(mysql_query('UPDATE `room` SET 
								`name`="'.mysql_real_escape_string($nname).'",
								`city`="'.mysql_real_escape_string($_POST['ncity']).'",
								`code`="'.mysql_real_escape_string($_POST['ncode']).'",
								`timeGO`="'.mysql_real_escape_string($_POST['ntimeGO']).'",
								`file`="'.mysql_real_escape_string($_POST['nfile']).'",
								`level`="'.mysql_real_escape_string($_POST['nlevel']).'",
								`align`="'.mysql_real_escape_string($_POST['nalign']).'",
								`clan`="'.mysql_real_escape_string($_POST['nclan']).'",
								`destroy`="'.mysql_real_escape_string($_POST['ndestroy']).'",
								`close`="'.mysql_real_escape_string($_POST['nclose']).'",
								`roomGo`="'.mysql_real_escape_string($_POST['nroomGo']).'",
								`sex`="'.mysql_real_escape_string($_POST['nsex']).'"
							WHERE `id`="'.mysql_real_escape_string($_POST['nid']).'" LIMIT 1;')){
					echo'Успешно сохранено';
				}
				else{
					echo'Ошибка при сохранении';
				}
			}
			else{
				echo'Локация не найдена';
			}
		}
		else{
			echo'Выберите локацию для редактирования';
		}
	}
	elseif($_GET['action']=='roomsAdd'){
		if(isset($_POST['nname']) && $_POST['nname']!=''){
			$nname = iconv('UTF-8', 'windows-1251', $_POST['nname']);

			$ins = mysql_query('INSERT INTO `room` (`name`, `city`, `code`, `timeGO`, `file`, `level`, `align`, `clan`, `destroy`, `close`, `roomGo`, `sex`) VALUES 
											("'.mysql_real_escape_string($nname).'", "'.mysql_real_escape_string($_POST['ncity']).'", "'.mysql_real_escape_string($_POST['ncode']).'", "'.mysql_real_escape_string($_POST['ntimeGO']).'", "'.mysql_real_escape_string($_POST['nfile']).'", "'.mysql_real_escape_string($_POST['nlevel']).'", "'.mysql_real_escape_string($_POST['nalign']).'", "'.mysql_real_escape_string($_POST['nclan']).'", "'.mysql_real_escape_string($_POST['ndestroy']).'", "'.mysql_real_escape_string($_POST['nclose']).'", "'.mysql_real_escape_string($_POST['nroomGo']).'", "'.mysql_real_escape_string($_POST['nsex']).'");');
			if($ins){
				echo'Успешно добавлено';
			}
			else{
				echo'Ошибка при добавлении';
			}
		}
		else{
			echo'Введите название локации';
		}
	}
	elseif($_GET['action']=='roomsDel'){
		
		$chLoc = mysql_query('SELECT `id` FROM `room` WHERE `id`="'.mysql_real_escape_string($_POST['id']).'" LIMIT 1;');
		if(mysql_num_rows($chLoc)){
			mysql_query('DELETE FROM `room` WHERE `id`="'.mysql_real_escape_string($_POST['id']).'" LIMIT 1;');
		}
		
	}
	
die();
}

?>
<div id="room_list">Загрузка...</div>
<div id="dialog" title="Редактор локаций">Загрузка...</div>
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
roomsLoad();
$( "#dialog" ).dialog({
	autoOpen: false,
	width: 500
});
function editLocation(id){
	$( "#dialog" ).text('Загрузка...');
	$( "#dialog" ).dialog( "open" );
	$('#dialog').load(path+'?mod=context&menu=roomEditor&action=editLocation&id='+id);
	
}
function addLocation(){
	$( "#dialog" ).text('Загрузка...');
	$( "#dialog" ).dialog( "open" );
	$('#dialog').load(path+'?mod=context&menu=roomEditor&action=addLocation');
	
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
</script>