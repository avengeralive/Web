<?
if(!defined('GAME')) {
	die();
}

    if($st['usefromfile']=='tactics') {
	if($u->info['battle'] > 0) {
		$id = $u->info['id'];
	if($u->info['hpNow'] > 0) {
			
		$tst = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `item_tactic` WHERE `uid` = "'.$u->info['id'].'" AND `date` = "'.date('d.m.Y').'" LIMIT 1'));
		$tst = $tst[0];
			
	if( $btl->info['noeff'] > 0 ) {
		$u->error = 'В этом бою нельзя использовать этот предмет!';
	}elseif( $tst >= 1 ) {
		$u->error = 'Использование плащ возможно 1 раз за бой!';
	}else{
		$lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
	if(isset($lastHOD['id'])) {
		$id_hod = $lastHOD['id_hod'];
	if($lastHOD['type'] != 6) {
		$id_hod++;
	}
	if( $itm['item_id'] == 4454 ) {
        $t = 2;
		$r = 2;
	}elseif( $itm['item_id'] == 4455 ) {
        $t = 3;
		$r = 1;
	}elseif( $itm['item_id'] == 4456 ) {
        $t = 1;
		$r = 5;
	}elseif( $itm['item_id'] == 4457 ) {
        $t = 2;
		$r = 4;
	}elseif( $itm['item_id'] == 4458 ) {
        $t = 2;
		$r = 3;
	}
        $u->info['tactic'.$r.''] += $t;
        $tactic = '`tactic'.$r.'` = "'.$u->info['tactic'.$r.''].'"'; 
        mysql_query('UPDATE `stats` SET '.$tactic.' WHERE `id` = "'.$u->info['id'].'" LIMIT 1');	
		mysql_query('INSERT INTO `item_tactic` (`uid`,`time`,`date`) VALUES ("'.$u->info['id'].'","'.time().'","'.date('d.m.Y').'")');
	if($u->info['sex']==1) {
        $txt = '{u1} применила заклинание &quot;<b>'.$itm['name'].'</b>&quot;.';
    }else{
        $txt = '{u1} применил заклинание &quot;<b>'.$itm['name'].'</b>&quot;.';
    }
		mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$txt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||login2='.$u->info['login'].'||t2='.$u->info['team'].'||time1='.time().'","","","","","6")');
	}	
		$u->error = 'Вы успешно использовали предмет!<script>setTimeout("reflesh(true);",100);</script>';
	}
}
	 }else{
		 $u->error = 'Можно использовать только в поединке!';
	}
}
        echo '<font color="red"><div><b>'.$u->error.'</b></div></font>';
        die();
?>