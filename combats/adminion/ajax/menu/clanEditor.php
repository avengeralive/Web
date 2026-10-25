<?php
if(isset($_GET['action']) && $_GET['action']!=''){
	function showClan($name,$align)
	{
		$tot='';
		if($align > 0){
			$tot .='<img src="https://img.testcombats.ru/i/align/align'.$align.'.gif">';
			$tot .= '<img src="https://img.testcombats.ru/i/clan/'.$name.'.gif"> ';
		} else $tot .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			$tot .=''.($name ? $name : 'клан не существует').'';
		
		return $tot;
	}
	function countSoclan($clanId){
		$cont = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `clan` = "'.$clanId.'" LIMIT 1;'));
		return $cont[0];
	}
	
	function nl2br2($string) { 
		$string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string); 
		return $string; 
	} 	
	if($_GET['action']=='loadClans'){
		$r = mysql_query('SELECT `name`,`id`,`align` FROM `clan` ORDER by `id` ASC');
		if(mysql_num_rows($r)>0){
			echo'Редактирование кланов
				<div class="divTable" style="max-width:950px; margin:0 auto;">
				<div class="divTableBody" style="text-align:center;">
				<div class="divTableRow">
						<div class="divTableCell" style="text-align: center;">№</div>
						<div class="divTableCell">Название</div>
						<div class="divTableCell">Состав (чел.)</div>
						<div class="divTableCell">Состав</div>
						<div class="divTableCell">Редактирование</div>
						<div class="divTableCell">Расформировать</div>
				</div>';
			while($ro = mysql_fetch_array($r)){
					echo'<div class="divTableRow">
						<div class="divTableCell">'.$ro['id'].'</div>
						<div class="divTableCell" style="text-align:left;">'.showClan($ro['name'],$ro['align']).'</div>
						<div class="divTableCell">'.countSoclan($ro['id']).'</div>
						<div class="divTableCell"><button onclick="clanSostav('.$ro['id'].');" class="btn btn-primary">Состав</button></div>
						<div class="divTableCell"><button class="btn btn-primary" onclick="clanEditor('.$ro['id'].');">Редактировать</button></div>
						<div class="divTableCell"><button class="btn btn-danger" onclick="clanRemove('.$ro['id'].');">Расформировать</button></div>
				</div>';
				
			}
			echo'</div></div>';
		}
	}
	elseif($_GET['action']=='editClan'){
		$r = mysql_query('SELECT * FROM `clan` WHERE `id` ="'.mysql_real_escape_string($_GET['id']).'" ORDER by `id` ASC');
		if(mysql_num_rows($r)>0){
			while($ro = mysql_fetch_array($r)){
				$clan_info = mysql_fetch_array(mysql_query('SELECT * FROM `clan_info` WHERE `id` = "'.$ro['id'].'" LIMIT 1'));
				echo'
					<div class="divTable" >
						<div class="divTableBody">
							<div class="divTableRow">
								<div class="divTableCell" style="text-align: center;">№ клана</div>
								<div class="divTableCell">'.$ro['id'].'</div>
							</div>
							<div class="divTableRow">
								<div class="divTableCell" style="text-align: center;">Название</div>
								<div class="divTableCell"><b>'.$ro['name'].'</b></div>
							</div>	
							<div class="divTableRow">
								<div class="divTableCell" style="text-align: center;">Информация</div>
								<div class="divTableCell"><textarea name="clanInfo" id="clanInfo" style="width: 280px; height: 85px;">'.$clan_info['info'].'</textarea></div>
							</div>
							<div class="divTableRow">
								<div class="divTableCell" style="text-align: center;">Девиз</div>
								<div class="divTableCell"><textarea name="clanDeviz" id="clanDeviz" style="width: 280px; height: 85px;">'.$clan_info['deviz'].'</textarea></div>
							</div>
							<div class="divTableRow">
								<div class="divTableCell" style="text-align: center;">Сайт</div>
								<div class="divTableCell"><input type="text" name="clanSite" id="clanSite" value="'.$ro['site'].'"  style="width: 280px;"/></div>
							</div>
						</div>
					</div>
					<div id="saveStatus" style="color:red;font-weight:bold;"></div><br/>
					<center><button class="btn btn-success" onclick="clanEditSave('.$ro['id'].');">Сохранить</button></center>
				';
			}
		}
		else{
			echo'Локация не найдена';
		}
	}
	elseif($_GET['action']=='editClanSave'){
		
		$_POST['clanDeviz'] = htmlspecialchars($_POST['clanDeviz']);
		$_POST['clanInfo'] = htmlspecialchars($_POST['clanInfo']);
		
		$_POST['clanDeviz'] = iconv('UTF-8', 'windows-1251', $_POST['clanDeviz']);
		$_POST['clanInfo'] = iconv('UTF-8', 'windows-1251', $_POST['clanInfo']);
		
		mysql_query('UPDATE `clan_info` SET `deviz`="'.mysql_real_escape_string($_POST['clanDeviz']).'",`info`="'.mysql_real_escape_string($_POST['clanInfo']).'" WHERE `id`="'.mysql_real_escape_string($_GET['clanId']).'" LIMIT 1;');
		mysql_query('UPDATE `clan` SET `site`="'.mysql_real_escape_string($_POST['clanSite']).'" WHERE `id`="'.mysql_real_escape_string($_GET['clanId']).'" LIMIT 1;');
		echo 'Успешно сохранено';
	}
	
	
	elseif($_GET['action']=='clanSostav'){
		
		$r = mysql_query('SELECT * FROM `clan` WHERE `id` ="'.mysql_real_escape_string($_GET['id']).'" ORDER by `id` ASC');
		if(mysql_num_rows($r)>0){
			$clan = mysql_fetch_array($r);
		
			$sp = mysql_query('SELECT `online`,`align`,`align2`,`login`,`level`,`id` FROM `users` WHERE `clan` = "'.$clan['id'].'" AND `clan_prava` = "glava" ORDER BY `login` ASC');
			$html = '';
			while( $pl = mysql_fetch_array($sp) ) {
				if( $pl['online'] < time() - 520 ) {
					$html .= '<div style="color:grey">';
				}else{
					$html .= '<div>';
				}
				$html .= '<img src="https://img.testcombats.ru/i/align/align'.$pl['align'].'.gif"> ';
				if( $pl['align2'] > 0 ) {
					$html .= '<img src="https://img.testcombats.ru/i/align/align'.$pl['align2'].'.gif"> ';
				}
				$html .= '<img src="https://img.testcombats.ru/i/clan/'.$clan['name'].'.gif"> ';
				$html .= '<b>'.$pl['login'].'</b> ['.$pl['level'].']';
				$html .= ' <a href="/info/'.$pl['id'].'" target="_blank"><img src="https://img.testcombats.ru/i/inf_capitalcity.gif"></a>';
				$html .= ' <small>- <font color=#008080><b>Глава клана</b></font></small>';
				if( $pl['online'] < time() - 520 ) {
					$html .= '&nbsp; <sup><i>не в игре</i></sup></div>';
				}else{
					$html .= '</div>';
				}
			}
			

			
			$sp = mysql_query('SELECT `online`,`align`,`align2`,`login`,`level`,`id`,`mod_zvanie` FROM `users` WHERE `clan` = "'.$clan['id'].'" AND `clan_prava` != "glava" AND `online` > "'.(time()-520).'" ORDER BY `login` ASC');
			while( $pl = mysql_fetch_array($sp) ) {
				$html .= '<div>';
				$html .= '<img src="https://img.testcombats.ru/i/align/align'.$pl['align'].'.gif"> ';
				if( $pl['align2'] > 0 ) {
					$html .= '<img src="https://img.testcombats.ru/i/align/align'.$pl['align2'].'.gif"> ';
				}
				$html .= '<img src="https://img.testcombats.ru/i/clan/'.$clan['name'].'.gif"> ';
				$html .= '<b>'.$pl['login'].'</b> ['.$pl['level'].']';
				$html .= ' <a href="/info/'.$pl['id'].'" target="_blank"><img src="https://img.testcombats.ru/i/inf_capitalcity.gif"></a>';
				$html .= ' <small>- '.$pl['mod_zvanie'].'</small>';
				$html .= '</div>';
			}
			$sp = mysql_query('SELECT * FROM `users` WHERE `clan` = "'.$clan['id'].'" AND `clan_prava` != "glava" AND `online` <= "'.(time()-520).'" ORDER BY `login` ASC');
			while( $pl = mysql_fetch_array($sp) ) {
				$html .= '<div style="color:grey">';
				$html .= '<img src="https://img.testcombats.ru/i/align/align'.$pl['align'].'.gif"> ';
				if( $pl['align2'] > 0 ) {
					$html .= '<img src="https://img.testcombats.ru/i/align/align'.$pl['align2'].'.gif"> ';
				}
				$html .= '<img src="https://img.testcombats.ru/i/clan/'.$clan['name'].'.gif"> ';
				$html .= '<b>'.$pl['login'].'</b> ['.$pl['level'].']';
				$html .= ' <a href="/info/'.$pl['id'].'" target="_blank"><img src="https://img.testcombats.ru/i/inf_capitalcity.gif"></a>';
				$html .= ' <small>- '.$pl['mod_zvanie'].'</small>';
				$html .= '&nbsp; <sup><i>не в игре</i></sup></div>';
			}
			echo $html;
			unset($html);
		}
	}
	elseif($_GET['action']=='clanRemove'){
		$r = mysql_query('SELECT * FROM `clan` WHERE `id` ="'.mysql_real_escape_string($_GET['id']).'" ORDER by `id` ASC');
		if(mysql_num_rows($r)>0){
			$clan = mysql_fetch_array($r);
			echo'<center>Расформирование клана <b>'.$clan['name'].'</b>!<br><br>
				<div id="clanRemoveStatus">
					<button class="btn btn-danger" >Расформировать</button><br>
					<small>(<font color="red">*</font> Это действие приведет к безвозвратному удалению клана, а так же снятие склонностей и клан знаков со всего состава клана.)</small>
				</div></center>';
		}
	}
	
die();
}

?>
<div id="clan_list">Загрузка...</div>
<div id="dialog" title="Редактирование клана">Загрузка...</div>
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
clanLoad();
$( "#dialog" ).dialog({
	autoOpen: false,
	width: 500
});
function clanEditor(id){
	$( "#dialog" ).text('Загрузка...');
	$( "#dialog" ).dialog( "open" );
	$('#dialog').load(path+'?mod=context&menu=clanEditor&action=editClan&id='+id);
}
function clanSostav(id){
	$( "#dialog" ).text('Загрузка...');
	$( "#dialog" ).dialog( "open" );
	$('#dialog').load(path+'?mod=context&menu=clanEditor&action=clanSostav&id='+id);
}
function clanRemove(id){
	$( "#dialog" ).text('Загрузка...');
	$( "#dialog" ).dialog( "open" );
	$('#dialog').load(path+'?mod=context&menu=clanEditor&action=clanRemove&id='+id);
}
$( "#dialog-link, #icons li" ).hover(
	function() {
		$( this ).addClass( "ui-state-hover" );
	},
	function() {
		$( this ).removeClass( "ui-state-hover" );
	}
);
</script>