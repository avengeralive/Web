<?php
if(isset($_GET['action']) && $_GET['action']!=''){
	if($_GET['action']=='showlogs'){
		if(isset($_GET['from']) && $_GET['from']!='' && isset($_GET['to']) && $_GET['to']!=''){
			$dsee = array();

			$dsee['date'] = explode('.',$_GET['from']);
			$dsee['date'] = $dsee['date'][2].'-'.$dsee['date'][1].'-'.$dsee['date'][0];
			$dsee['t1'] = strtotime($dsee['date'].' 00:00:00');
			$dsee['date'] = date('d.m.Y',$dsee['t1']);
			
			$dsee2 = array();
			$dsee2['date'] = explode('.',$_GET['to']);
			$dsee2['date'] = $dsee2['date'][2].'-'.$dsee2['date'][1].'-'.$dsee2['date'][0];
			$dsee2['t2'] = strtotime($dsee2['date'].' 23:59:59');

			$tar="";
			
			$adm = array();
			if($_GET['adm']>0 && $_GET['pal']==0 && $_GET['tar']==0){
				$adm[2] = ' AND `users`.`admin`>"0"'; 
			}
			if($_GET['adm']>0){
				$adm[1] = ' OR (`users`.`admin`>"0")';
			}
			if(($_GET['pal']==1 || $_GET['tar']==1) && $_GET['adm']>0){
				$adm[3] = ' OR `users`.`admin`>"0"'; 
			}

			if($_GET['pal']==1 && $_GET['tar']==1){
				$tar = ' AND ((`users`.`align`>="1.1" AND `users`.`align`<="1.99") OR (`users`.`align`>="3.01" AND `users`.`align`<="3.99") '.$adm[1].')';
			}
			if($_GET['tar']==1 && $_GET['pal']==0){
				$tar = ' AND (`users`.`align`>="3.01" AND `users`.`align`<="3.99" '.$adm[1].')';
			}				
			if($_GET['pal']==1 && $_GET['tar']==0){
				$tar = ' AND (`users`.`align`>="1.1" AND `users`.`align`<="1.99" '.$adm[1].')';
			}
			
			
			$q='SELECT `users_delo`.*,`users`.`align`,`users`.`id`,`users`.`admin` FROM `users_delo`,`users` WHERE `users_delo`.`time` >= "'.$dsee['t1'].'" AND `users_delo`.`time` <= "'.$dsee2['t2'].'" AND `users_delo`.`uid`=`users`.`id` '.$adm[2].' '.$tar.'  ;';
			//die($q);
			
			
			
			if($tar!='' || $adm[1]!=''){
				$sp = mysql_query('SELECT `users_delo`.*,`users`.`align`,`users`.`id`,`users`.`admin` FROM `users_delo`,`users` WHERE `users_delo`.`time` >= "'.$dsee['t1'].'" AND `users_delo`.`time` <= "'.$dsee2['t2'].'" AND `users_delo`.`uid`=`users`.`id` '.$adm[2].' '.$tar.'  ;');
				$rdl = '';
				while($pl = mysql_fetch_array($sp)) {
					$rdl .= '<div style="padding:0 10px 5px 10px; margin:5px;"><hr>'; 
					$rdl .= '<div style="display:inline-block;width:150px;color:green">'.date('d.m.Y H:i:s',$pl['time']).'</div>';
					$rdl .= $pl['text'].' '.$u->microLogin($pl['uid'],1);
					$rdl .= '</div>';
				}
				if($rdl == '') {
					$rdl = 'Не найдено действий за данное число'; 
				}
				echo $rdl;
			}
			else{
				echo'Выберите данные для поиска';
			}
		}
		else{
			echo'Выберите период для поиска';
		}
	}
	
	die();
}




?>
	C <input type="text" name="salesFrom" value="" id="datetimepicker"/> по <input type="text" name="salesTo" value="" id="datetimepicker2"/>
	<input type="checkbox" id="list_tar" checked/>
	<label for="list_tar">Тарманы</label>
	<input type="checkbox" id="list_pal" checked/>
	<label for="list_pal">Паладины</label>
	<input type="checkbox" id="list_adm" checked/>
	<label for="list_adm">Админы</label>
	<button onclick="moderLogSearch();" class="btn">Поиск <i class="fa fa-search" aria-hidden="true"></i></button>

	<div id="moderList" style="min-width:950px;"></div>
	<script>
	$.datetimepicker.setLocale('ru');

	$('#datetimepicker').datetimepicker({
		dayOfWeekStart : 1,
		timepicker:false,
		format:'d.m.Y',
		formatDate:'d.m.Y',

	});
	$('#datetimepicker2').datetimepicker({
		dayOfWeekStart : 1,
		timepicker:false,
		format:'d.m.Y',
		formatDate:'d.m.Y',

	});
	</script>