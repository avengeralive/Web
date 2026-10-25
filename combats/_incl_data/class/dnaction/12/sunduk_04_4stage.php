<?
if( isset($s[1]) && $s[1] == '12/sunduk_04_4stage' ) {
/*
		Сундук: Потерянный сундук, можно найти ключ портала
		# Тактики
		# `id` IN ('4243', '4244', '4245', '4246', '4247', '4248', '4249', '4250', '4251', '4252', '4253', '4254', '4255', '4256', '4257', '4258', '4259', '4260', '4261', '4262', '4263', '4264', '4265', '4266', '4267')

		# Элики 15% 
		#'4514', '4515')
	*/
	//Все переменные сохранять в массиве $vad !
	$vad = array(
		'go' => true
	);
	
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" LIMIT 1'));
	$vad['test2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if( $vad['test2'][0] > 0 ) {
		$r = 'Вы уже обыскали &quot;'.$obj['name'].'&quot;...';
		$vad['go'] = false;
	}elseif( $vad['test1'][0] > 0 ) {
		$r = 'Кто-то обыскал &quot;'.$obj['name'].'&quot; раньше вас...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
		if(rand(0,100) > 78){ # Элики
			$vad['items'] = array(4514,4515);
		} else{ # Тактики
			$vad['repcent'] = rand(0,100);
			if( $vad['repcent'] <= 80 ) { # Тактики [1,2] 60%
				$vad['items'] = array(10109, 10120, 10115, 10125, 10130, 10111, 10121, 10126, 10131, 10116,);
			} elseif( $vad['repcent'] > 80 AND $vad['repcent'] <= 95 ) {# Тактики [3] 15% 
				$vad['items'] = array(10112, 10117, 10122, 10127, 10132);
			} elseif( $vad['repcent'] > 96 AND $vad['repcent'] <= 98 ) {# Тактики [4] 2%
				$vad['items'] = array(10118, 10113, 10123, 10128, 10133);
			}elseif( $vad['repcent'] > 99 ) { # Тактики [5] 1%
				$vad['items'] = array(10134, 10119, 10114, 10129, 10124);
			}
			if($vad['repcent'] < 79){ # Элики
				$vad['items'] = array_merge(array(4514,4515), $vad['items']);
			} 
		}
		
		$vad['items'] = $vad['items'][rand(0,count($vad['items'])-1)];
		if( $vad['items'] != 0 ) {
			//Выбрасываем предмет
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES (
				"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'",""
			)');
			if( !isset($vad['dn_delete'][$vad['items']]) ) {
				$vad['dn_delete'][$vad['items']] = false;
			}
			if( $this->pickitem($obj,$vad['items'],$u->info['id'],'',$vad['dn_delete'][$vad['items']]) ) {
				$r = 'Вы обнаружили предметы...';
			}else{
				$r = 'Что-то пошло не так, предметы растворились...';
			}
		}else{
			$r = 'Вы не нашли ничего полезного...';
		}
	}
	
	unset($vad);
}
?>