<?php



function logbyid($u)
{
	$us = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id`="'.$u.'" LIMIT 1;'));
	return $us['login'];
}

function e($t,$to)
{
	$toLogin = logbyid($to);
	mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`)
	VALUES ("Тикет система ('.date('d.m.Y').' '.date('H:i:s').'): <b>'.mysql_real_escape_string($t).'</b>","capitalcity","'.$toLogin.'","6","1","-1")');
}


$plc = array('Не&nbsp;задано','Синтаксис','Недочет','Баг','Проверить','Тестировать','Разработать');
$plp = array('<font color=grey>Низкий</font>','<font color=green>Средний</font>','<b><font color=red>Высокий</font></b>','<b><font color=red>Высочайший</font></b>');
$pls = array('<font color=#ee8208>Новый</font>','<font color=green>В&nbsp;работе</font>','<font color=#3BA3D0>Наблюдаем</font>','<font color=grey>Отложен</font>','<font color=#0045CC>Завершен</font>','<font color=#660066>Висяк</font>');

if(isset($_GET['action']) && $_GET['action']!=''){
	//Показ работ
	if($_GET['action']=='showWorks'){
		
		if($_GET['type']=='1'){
			$type='`delete` = 0';
		}
		elseif($_GET['type']=='2'){
			$type='`delete` > 0';
		}
		
		echo'<div class="divTable" style="margin: 0 auto;">
			 <div class="divTableBody">
			 <div class="divTableRow">
				<div class="divTableCell">№</div>
				<div class="divTableCell">Автор</div>
				<div class="divTableCell">Тип</div>
				<div class="divTableCell">Приоритет</div>
                <div class="divTableCell">Статус</div>
				<div class="divTableCell">Текст</div>
				<div class="divTableCell">Опции</div>
			</div>';
			$order = ($_GET['type']==1 ? '`prior` DESC, `status` ASC, `time` ASC' : '`delete` DESC');
		$sp = mysql_query('SELECT * FROM `worklist` WHERE '.$type.' ORDER BY '.$order);
		while( $pl = mysql_fetch_array($sp) ) {
			
            $usr = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
			if($pl['delete']=='0'){
				$otext = '<i class="fa fa-unlock-alt" aria-hidden="true"></i>';
			}
			else{
				$otext = '<i class="fa fa-lock" aria-hidden="true"></i>';
			}
			
			$pl['text'] = TextToLink($pl['text']);//htmlspecialchars()
            $pl['text'] = str_replace("\n",'<br>',$pl['text']);

            $styles = '';
			if($pl['delete']==0)
			{
				if($pl['status']==1) $styles = 'background: #CCFFCC;';
            	elseif($pl['status']==3) $styles = 'color: grey;';
            	elseif($pl['prior']==3) $styles = 'color: red; background: #f5eb9a;';
            }

			echo '
			<div class="divTableRow" id="work_'.$pl['id'].'" style="'.$styles.'">
				<div class="divTableCell">#'.$pl['id'].' '.$otext.'</div>
				<div class="divTableCell"><b>'.$usr['login'].'</b><div class="divTableCellDate">['.date('d.m.Y H:i',$pl['time']).']</div></div>
				<div class="divTableCell">'.$plc[$pl['type']].'</div>
				<div class="divTableCell">'.$plp[$pl['prior']].'</div>
                <div class="divTableCell">'.$pls[$pl['status']].'</div>
				<div class="divTableCell"><div class="divTableCellTitle">'.$pl['title'].'</div><div class="divTableCellText">'.$pl['text'].'</div></div>
                <div class="divTableCell"><button class="btn btn-primary" onclick="showDlg('.$pl['id'].');">Инфо</button></div>
			</div>
			';
		}
		echo'</div>
			 </div>';
	}
	//Удаление/завершение работ
	elseif($_GET['action']=='delWork')
	{
		$check_del = mysql_query('SELECT `id`,`uid` FROM `worklist` WHERE id="'.mysql_real_escape_string($_GET['id']).'" AND `delete`="0" LIMIT 1;');
		if(mysql_num_rows($check_del)){
			$tik = mysql_fetch_array($check_del);
			mysql_query('UPDATE `worklist` SET `delete` = "'.time().'" WHERE `id` = "'.mysql_real_escape_string($_GET['id']).'" LIMIT 1;');
			echo 'Тикет #'.$_GET['id'].' успешно закрыт<script>workDelEffect(\''.$_GET['id'].'\')</script>';
			mysql_query('INSERT INTO `worklist_history` (
					`date`,`uid`,`text`,`tid`
				) VALUES (
					"'.time().'","'.$u->info['id'].'","закрыл тикет","'.mysql_real_escape_string($_GET['id']).'"
				)
			');
			//e('Персонаж '.$u->info['login'].' закрыл ваш тикет № '.$tik['id'].'!',$tik['uid']);
		}
		else{
			echo 'Такого открытого тикета не существует';
		}
	}
    elseif($_GET['action']=='delWork2')
	{
		$check_del = mysql_query('SELECT `id`,`uid` FROM `worklist` WHERE id="'.mysql_real_escape_string($_GET['id']).'" AND `delete`!="0" LIMIT 1;');
		if(mysql_num_rows($check_del))
		{
			mysql_query('DELETE FROM `worklist` WHERE `id` = "'.mysql_real_escape_string($_GET['id']).'" LIMIT 1');
            mysql_query('DELETE FROM `worklist_history` WHERE `еid` = "'.mysql_real_escape_string($_GET['id']).'"');
			echo 'Тикет #'.$_GET['id'].' успешно удален<script>workDelEffect(\''.$_GET['id'].'\')</script>';
			//e('Персонаж '.$u->info['login'].' удалил ваш тикет № '.$tik['id'].'!',$tik['uid']);
		}
		else{
			echo 'Такого закрытого тикета не существует';
		}
	}
	elseif($_GET['action']=='openWork')
	{
		$check_del = mysql_query('SELECT `id`,`uid` FROM `worklist` WHERE id="'.mysql_real_escape_string($_GET['id']).'" AND `delete`>"0" LIMIT 1;');
		if(mysql_num_rows($check_del)){
			$tik = mysql_fetch_array($check_del);
			mysql_query('UPDATE `worklist` SET `delete` = "0" WHERE `id` = "'.mysql_real_escape_string($_GET['id']).'" LIMIT 1;');
			echo'Тикет #'.$_GET['id'].' успешно открыт<script>workDelEffect(\''.$_GET['id'].'\')</script>';
			mysql_query('INSERT INTO `worklist_history` (
					`date`,`uid`,`text`,`tid`
				) VALUES (
					"'.time().'","'.$u->info['id'].'","вновь открыл тикет","'.mysql_real_escape_string($_GET['id']).'"
				)
			');
			//e('Персонаж '.$u->info['login'].' вновь открыл ваш тикет № '.$tik['id'].'!',$tik['uid']);
		}
		else{
			echo'Такого закрытого тикета не существует';
		}
	}
    elseif($_GET['action']=='saveWork')
	{
		$check_del = mysql_query('SELECT `id`,`uid` FROM `worklist` WHERE id="'.mysql_real_escape_string($_POST['id']).'" AND `delete`="0" LIMIT 1;');
		if(mysql_num_rows($check_del))
		{
			//$tik = mysql_fetch_array($check_del);
			$_POST['wtext'] = iconv("UTF-8", "windows-1251", $_POST['wtext']);
			mysql_query('UPDATE `worklist` SET `text` = "'.mysql_real_escape_string($_POST['wtext']).'"
			WHERE `id` = "'.mysql_real_escape_string($_POST['id']).'" LIMIT 1;');
			echo 'Тикет #'.$_POST['id'].' успешно обновлен<script>loadWorks("1");</script>';
			mysql_query('INSERT INTO `worklist_history` (
					`date`,`uid`,`text`,`tid`
				) VALUES (
					"'.time().'","'.$u->info['id'].'","обновил тикет","'.mysql_real_escape_string($_POST['id']).'"
				)
			');
			//e('Персонаж '.$u->info['login'].' обновил ваш тикет № '.$tik['id'].'!',$tik['uid']);
		}
		else{
			echo 'Такого открытого тикета не существует';
		}
	}
	//Добавление работ
	elseif($_GET['action']=='addWork')
	{
		if(isset($_POST['wtext']) && $_POST['wtext']!=''){
			$_POST['wtext'] = iconv("UTF-8", "windows-1251", $_POST['wtext']);
			$_POST['title'] = iconv("UTF-8", "windows-1251", $_POST['title']);
			if(isset($_POST['select']) && $_POST['select']!=''){
				mysql_query('INSERT INTO `worklist` (
					`time`,`uid`,`text`,`complete`,`delete`,`prior`,`type`,`title`
				) VALUES (
					"'.time().'","'.$u->info['id'].'","'.mysql_real_escape_string($_POST['wtext']).'","0","0","'.mysql_real_escape_string($_POST['select']).'","'.mysql_real_escape_string($_POST['type']).'","'.mysql_real_escape_string($_POST['title']).'"
				)');
				$lid = mysql_insert_id();
				mysql_query('INSERT INTO `worklist_history` (
					`date`,`uid`,`text`,`tid`
				) VALUES (
					"'.time().'","'.$u->info['id'].'","создал тикет","'.$lid.'"
				)');
				echo 'Задание успешно добавлено<script>loadWorks("1");</script>';
			}
			else{
				echo'Выберите важность задания';
			}
		}
		else{
			echo'Введите текст задания';
		}
	}
	elseif($_GET['action']=='showTicket' && isset($_GET['id']) && $_GET['id']!='')
	{
		$che = mysql_query('SELECT * FROM `worklist` WHERE id="'.mysql_real_escape_string($_GET['id']).'" LIMIT 1;');
		if(mysql_num_rows($che)>0){
			$tik = mysql_fetch_array($che);
			
			if($tik['delete']=='0')
			{
				$tmsg = '<button class="btn btn-danger" onclick="workDel('.$tik['id'].');">Закрыть тикет <i class="fa fa-lock" aria-hidden="true"></i></button>';
                $tmsg .= '&nbsp;&nbsp;&nbsp;<button onclick="SaveWork('.$tik['id'].');" id="saveWork" class="btn btn-success">Сохранить тикет <i class="fa fa-unlock-alt" aria-hidden="true"></i></button>';

				$tdis = '';
			}
			else{
				$tmsg  = '<button class="btn btn-success" onclick="workTikOpen('.$tik['id'].');">Открыть тикет <i class="fa fa-unlock-alt" aria-hidden="true"></i></button>';
				$tmsg .= '&nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick="workTikDel('.$tik['id'].');">Удалить тикет <i class="fa fa-unlock-alt" aria-hidden="true"></i></button>';
				$tdis = 'disabled';
			}
			
			$usr = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$tik['uid'].'" LIMIT 1'));
			echo'
			<div class="divTable" style="margin: 0 auto;">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell">Тикет №:</div>
						<div class="divTableCell">'.$tik['id'].'</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Автор:</div>
						<div class="divTableCell"><b>'.$usr['login'].'</b></div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Создан:</div>
						<div class="divTableCell">'.date('d.m.Y H:i',$tik['time']).'</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Тип:</div>
						<div class="divTableCell">
							<select name="select" id="typeSelect" onchange="workListType('.$tik['id'].',this.value);" '.$tdis.'>';
								for ($i = 0; $i <= count($plc)-1; $i++) {
									if($i==$tik['type']){
										echo '<option value="'.$i.'" selected>'.$plc[$i].'</option>';
									}
									else{
										echo '<option value="'.$i.'">'.$plc[$i].'</option>';
									}
								}
					   echo'</select><div id="chStatus"></div></div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Приоритет:</div>
						<div class="divTableCell">
							<select name="select" id="typeSelect2" onchange="workListPrior('.$tik['id'].',this.value);" '.$tdis.'>';
								for ($i = 0; $i <= count($plp)-1; $i++) {
									if($i==$tik['prior']){
										echo '<option value="'.$i.'" selected>'.$plp[$i].'</option>';
									}
									else{
										echo '<option value="'.$i.'">'.$plp[$i].'</option>';
									}
								}
					   echo'</select><div id="prStatus"></div></div>
					</div>
                    <div class="divTableRow">
						<div class="divTableCell">Статус:</div>
						<div class="divTableCell">
							<select name="select" id="typeSelect3" onchange="workListStatus('.$tik['id'].',this.value);" '.$tdis.'>';
								for ($i = 0; $i <= count($pls)-1; $i++) {
									if($i==$tik['status']){
										echo '<option value="'.$i.'" selected>'.$pls[$i].'</option>';
									}
									else{
										echo '<option value="'.$i.'">'.$pls[$i].'</option>';
									}
								}
					   echo'</select><div id="Status"></div></div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Заголовок:</div>
						<div class="divTableCell">'.$tik['title'].'</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell">Сообщение:</div>
						<div class="divTableCell"><textarea id="WorkiText" rows="15" cols="45" name="text">'.$tik['text'].'</textarea></div>
					</div>
				</div>
			</div>
			<br/><center>'.$tmsg.'<br/><br/>История тикета: </center>';
			$thistory = mysql_query('SELECT * FROM `worklist_history` WHERE `tid`="'.$tik['id'].'" ORDER BY `id` DESC LIMIT 5');
			if(mysql_num_rows($thistory)>0)
			{
				echo'<br>
					<div class="divTable" style="margin: 0 auto;">
						<div class="divTableBody">';
				while($th = mysql_fetch_array($thistory))
				{
                    $usr = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$th['uid'].'" LIMIT 1'));
					echo'
							<div class="divTableRow">
        						<div class="divTableCell">'.date('d.m.y H:i',$th['date']).'</div>
                                <div class="divTableCell"><b>'.$usr['login'].'</b></div>
								<div class="divTableCell">'.$th['text'].'</div>
							</div><br/>
					';
				}
				echo'</div>	
				</div>';		
			}
			else{
				echo'<b>Пусто</b>';
			}
		}
	}
	elseif($_GET['action']=='chType' ){
		$chTiket = mysql_query('SELECT `id`,`uid` FROM `worklist` WHERE `id`="'.mysql_real_escape_string($_POST['id']).'" AND `delete`="0" LIMIT 1;');
		if(mysql_num_rows($chTiket)>0){
			$tik = mysql_fetch_array($chTiket);
			mysql_query('UPDATE `worklist` SET `type`="'.mysql_real_escape_string($_POST['type']).'" WHERE `id`="'.mysql_real_escape_string($_POST['id']).'" LIMIT 1;');
			mysql_query('INSERT INTO `worklist_history` (
						`date`,`uid`,`text`,`tid`
					) VALUES (
						"'.time().'","'.$u->info['id'].'","сменил тип тикета на: '.$plc[$_POST['type']].'","'.mysql_real_escape_string($_POST['id']).'"
					)
			');
			//e('Персонаж '.$u->info['login'].' сменил тип вашего тикета № '.$tik['id'].' на '.$plc[$_POST['type']].'!',$tik['uid']);
			echo'Сохранено!';
		}
		else{
			echo'Тикет закрыт или не существует';
		}
	}
	elseif($_GET['action']=='chPrior' ){
		$chTiket = mysql_query('SELECT `id`,`uid` FROM `worklist` WHERE `id`="'.mysql_real_escape_string($_POST['id']).'" AND `delete`="0" LIMIT 1;');
		if(mysql_num_rows($chTiket)>0){
			mysql_query('UPDATE `worklist` SET `prior`="'.mysql_real_escape_string($_POST['type']).'" WHERE `id`="'.mysql_real_escape_string($_POST['id']).'" LIMIT 1;');
			mysql_query('INSERT INTO `worklist_history` (
						`date`,`uid`,`text`,`tid`
					) VALUES (
						"'.time().'","'.$u->info['id'].'","сменил приоритет тикета на: '.$plp[$_POST['type']].'","'.mysql_real_escape_string($_POST['id']).'"
					)
			');
			//e('Персонаж '.$u->info['login'].' сменил приоритет вашего тикета № '.$tik['id'].' на '.$plp[$_POST['type']].'!',$tik['uid']);
			echo'Сохранено!';
		}
		else{
			echo'Тикет закрыт или не существует';
		}
	}
	elseif($_GET['action']=='chStatus' ){
		$chTiket = mysql_query('SELECT `id`,`uid` FROM `worklist` WHERE `id`="'.mysql_real_escape_string($_POST['id']).'" AND `delete`="0" LIMIT 1;');
		if(mysql_num_rows($chTiket)>0){
			$tik = mysql_fetch_array($chTiket);
			mysql_query('UPDATE `worklist` SET `status`="'.mysql_real_escape_string($_POST['type']).'" WHERE `id`="'.mysql_real_escape_string($_POST['id']).'" LIMIT 1;');
			mysql_query('INSERT INTO `worklist_history` (
						`date`,`uid`,`text`,`tid`
					) VALUES (
						"'.time().'","'.$u->info['id'].'","сменил статус тикета на: '.$pls[$_POST['type']].'","'.mysql_real_escape_string($_POST['id']).'"
					)
			');
			//e('Персонаж '.$u->info['login'].' сменил тип вашего тикета № '.$tik['id'].' на '.$pls[$_POST['type']].'!',$tik['uid']);
			echo'Сохранено!';
		}
		else{
			echo'Тикет закрыт или не существует';
		}
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
	.workMsg {margin: 5px auto;}
	#typeSelect,
    #typeSelect2,
    #typeSelect3 {min-width: 150px;}
	.workHeader H3 {text-align:left;}
	.divTableCellText {max-height: 300px; overflow-y: scroll;margin-right: -5px;}
	.divTableCell, .divTableHead, .divTable {border: 1px solid #99999954;}
	.divTableCellDate {font-size: 12px; color: #000; white-space: nowrap; margin-top: 3px;}
    .divTableCellTitle {font-weight: bold; font-size: 14px; display: block; margin-bottom: 5px;}
</style>
<script>

$('#addWork').bind("click",function(){
	var workText = encodeURI($('#workText').val());
	var workSelect = $('#workSelect').val();
	var typeSelect = $('#typeSelect').val();
	var title = $('#title').val();
	

	$.ajax({
		url: "/adminion/index.php?mod=context&menu=workList&action=addWork",
		type: "POST",
		data: "wtext="+workText+"&select="+workSelect+"&type="+typeSelect+"&title="+title, 
		success: function(data){
			$("#workMsg").html(data);
		}
	});
});

function SaveWork(id)
{
	var workText = encodeURI($('#WorkiText').val());
	
	$.ajax({
		url: "/adminion/index.php?mod=context&menu=workList&action=saveWork",
		type: "POST",
		data: "wtext="+workText+"&id="+id,
		success: function(data){
			$("#workMsg").html(data);
		}
	});
}


$( "#dialog" ).dialog({
	autoOpen: false,
	width: 500
});

function showDlg(id){
	$( "#dialog" ).dialog( "open" );
	$('#dialog').load(path+'?mod=context&menu=workList&action=showTicket&id='+id);
	
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

loadWorks('1');
</script>
<?
$tic1 = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `worklist` WHERE `delete` = "0" LIMIT 1'));
$tic2 = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `worklist` WHERE `delete` != "0" LIMIT 1'));
?>
<div class="workHeader">
	<div class="workHeaderL">
		<h3>Тикеты [<? echo $tic1[0].'/'.$tic2[0];?>]</h3>
	</div>
	<div class="workHeaderR">
		<button onclick="hideShow('workAdd');" class="btn btn-success">Добавить <i class="fa fa-plus" aria-hidden="true"></i></button>
		<button onclick="loadWorks('1');" class="btn">Обновить <i class="fa fa-refresh" aria-hidden="true"></i></button>
		Тикеты:
		<button onclick="loadWorks('1');" class="btn btn-success">Открытые <i class="fa fa-unlock-alt" aria-hidden="true"></i></button>
		<button onclick="loadWorks('2');" class="btn btn-danger">Закрытые <i class="fa fa-lock" aria-hidden="true"></i></button>
	</div>
		
		
	
	
</div>
<div class="workMsg" id="workMsg"></div>
<div class="workAdd" id="workAdd">
	<fieldset>
		<legend><b>Добавить новый тикет</b> </legend>
		Заголовок: <input type="text" id="title" style="width:300px;">
		<textarea name="wtext" style="width:100%;height:100px;" id="workText"></textarea>
		
		Приоритет:
		<select name="select" id="workSelect">
			<?php
			for ($i = 0; $i <= count($plp)-1; $i++) {
				echo '<option value="'.$i.'">'.$plp[$i].'</option>';
			}
			?>
		</select><br/>
		Тип:
		<select name="select" id="typeSelect">
			<?php
			for ($i = 0; $i <= count($plc)-1; $i++) {
				echo '<option value="'.$i.'">'.$plc[$i].'</option>';
			}
			?>
		</select><br/>
		<button id="addWork" class="btn btn-success">Добавить <i class="fa fa-plus" aria-hidden="true"></i></button>
	</fieldset>
</div>
<div class="workList" id="workList"></div>
<div id="dialog" title="Подробности тикета"></div>