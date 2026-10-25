<?
if(!defined('GAME')) die();
if($e['bm_a1'] == 'bot_priems1' && $end == 0)
{
  	$pr_use = 1;
  	$pr_vars = array('hp_u1' => $this->users[$this->uids[$uid1]]['hpNow'], 'hp_u2' => $this->users[$this->uids[$uid2]]['hpNow']);
  	global $btl;

  	/* - - - - - - КАТАКОМБЫ БОТЫ ПРИЕМЫ НАЧАЛО - - - - - - -  */
	if( $this->users[$this->uids[$uid1]]['bot_id'] == 287 || $this->users[$this->uids[$uid1]]['bot_id'] == 286
	|| $this->users[$this->uids[$uid1]]['bot_id'] == 407 )
	{
		  //Древний страж
		  $pr_vars['priem_use'][0]['chance'] = 20;
		  $pr_vars['priem_use'][0]['name'] = 'Стойкость';
		  $pr_vars['priem_use'][0]['id'] = 13;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		  
		  //Пламенная вспышка
		  $pr_vars['priem_team_f'][0]['chance'] = 15;
		  $pr_vars['priem_team_f'][0]['name'] = 'Пламенная Вспышка';
		  $pr_vars['priem_team_f'][0]['x'] = 10;
		  $pr_vars['priem_team_f'][0]['type'] = 1;	  
		  $pr_vars['priem_team_f'][0]['hp'] = 0;
		  $pr_vars['priem_team_f'][0]['hp_dmg'] = 32;
		  $pr_vars['priem_team_f'][0]['priem'] = 73;
		  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][0]['on'] = $uid;
		  $pr_vars['priem_team_f'][0]['nomf'] = 0;
		  $pr_vars['priem_team_f'][0]['fiz'] = 0;
		  $pr_vars['priem_team_f'][0]['krituet'] = true;
	}

	if( $this->users[$this->uids[$uid1]]['bot_id'] == 283 )
	{
		//Шут повелителя
		$pr_vars['priem_use'][0]['chance'] = 20;
		$pr_vars['priem_use'][0]['name'] = 'Ярость';
		$pr_vars['priem_use'][0]['id'] = 14;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

		$pr_vars['priem_use'][1]['chance'] = 20;
		$pr_vars['priem_use'][1]['name'] = 'Стойкость';
		$pr_vars['priem_use'][1]['id'] = 13;
		$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

		$pr_vars['priem_use'][3]['chance'] = 20;
		$pr_vars['priem_use'][3]['name'] = 'Шокирующий удар';
		$pr_vars['priem_use'][3]['id'] = 235;
		$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
		$pr_vars['priem_use'][3]['no_chat'] = true;
		  
        if(150000 >= rand(0, 1000000))
		{
			$xu = $u->testAction('`vars` = "use_priem_'.$btl->info['id'].'_'.$uid1.'" AND `vals` = "focus" LIMIT 1',2);
			if(!$xu[0])//Один раз за бой
		  	{
				 //Волшебный фокус ворует 8-12% маны
			 	 $pr_vars['priem_regen2']['mp'] = floor($this->stats[$this->uids[$uid2]]['mpNow']/100*rand(8,12));
			 	 $pr_vars['priem_regen2']['chance'] = 100;
			 	 $pr_vars['priem_regen2']['name'] = 'Волшебный Фокус';

				 $this->stats[$this->uids[$uid2]]['mpNow'] -= $pr_vars['priem_regen2']['mp'];
				 if( $this->stats[$this->uids[$uid2]]['mpNow'] < 0 )$this->stats[$this->uids[$uid2]]['mpNow'] = 0;

				 mysql_query('UPDATE `stats` SET `mpNow` = "'.$this->stats[$this->uids[$uid2]]['mpNow'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
	             $u->addAction(time(),'use_priem_'.$btl->info['id'].'_'.$uid1,'focus');

				//заносим в лог боя
				$vLog = 'time1='.time().'||s1='.$btl->users[$btl->uids[$uid1]]['sex'].'||t1='.$btl->users[$btl->uids[$uid2]]['team'].'||login1='.$btl->users[$btl->uids[$uid1]]['login'].'||s2='.$btl->users[$btl->uids[$uid2]]['sex'].'||t2='.$btl->users[$btl->uids[$uid2]]['team'].'||login2='.$btl->users[$btl->uids[$uid2]]['login'].'';
				$mas1 = array('time'=>time(),'battle'=>$btl->info['id'],'id_hod'=>($btl->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				$mas1['text'] = '{tm1} {u1} {1x16x0} заклинание &quot;<b><font color=#006699>'.$pr_vars['priem_regen2']['name'].'</font></b>&quot; и поразил магией тьмы {u2}. <b><font title=Тип&nbsp;урона:&nbsp;Тьма color=#006699>-'.$pr_vars['priem_regen2']['mp'].'</font></b> ['.$this->stats[$this->uids[$uid2]]['mpNow'].'/'.$btl->stats[$btl->uids[$uid2]]['mpAll'].']';
				$btl->add_log($mas1);
			}
			unset($xu);
		}

		if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.33 )
		{
			$xu = $u->testAction('`vars` = "use_priem_'.$btl->info['id'].'_'.$uid1.'" AND `vals` = "soul" LIMIT 1',2);
			if(!$xu[0])//Один раз за бой
			{
				 //Украсть душу
				 $pr_vars['priem_regen']['hp'] = floor($this->stats[$this->uids[$uid2]]['hpAll']-1);
				 $pr_vars['priem_regen']['chance'] = 100;
				 $pr_vars['priem_regen']['name'] = 'Украсть Душу';

				 $this->stats[$this->uids[$uid2]]['hpNow'] -= $pr_vars['priem_regen']['hp'];
				 if( $this->stats[$this->uids[$uid2]]['hpNow'] < 1 ) $this->stats[$this->uids[$uid2]]['hpNow'] = 1;

				 mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
				 $u->addAction(time(),'use_priem_'.$btl->info['id'].'_'.$uid1,'soul');

				//Заносим в лог боя
				$vLog = 'time1='.time().'||s1='.$btl->users[$btl->uids[$uid1]]['sex'].'||t1='.$btl->users[$btl->uids[$uid2]]['team'].'||login1='.$btl->users[$btl->uids[$uid1]]['login'].'||s2='.$btl->users[$btl->uids[$uid2]]['sex'].'||t2='.$btl->users[$btl->uids[$uid2]]['team'].'||login2='.$btl->users[$btl->uids[$uid2]]['login'].'';
				$mas1 = array('time'=>time(),'battle'=>$btl->info['id'],'id_hod'=>($btl->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');

				$mas1['text'] = '{tm1} {u1} {1x16x0} заклинание &quot;<b><font color=#006699>'.$pr_vars['priem_regen']['name'].'</font></b>&quot; и поразил магией тьмы {u2}. <b><font title=Тип&nbsp;урона:&nbsp;Тьма color=#006699>-'.$pr_vars['priem_regen']['hp'].'</font></b> [1/'.$btl->stats[$btl->uids[$uid2]]['hpAll'].']';
				$btl->add_log($mas1);

				unset($pr_vars['priem_team_f'], $pr_vars['priem_use'], $pr_vars['priem_mana'],$pr_vars['priem_regen2']);
			 }
             unset($xu);
		}

        if(150000 >= rand(0, 1000000))
		{
			$xu = $u->testAction('`vars` = "use_priem_'.$btl->info['id'].'_'.$uid1.'" AND `vals` = "mygame" LIMIT 1',2);
			if(!$xu[0] && !isset($this->stats[$this->uids[$uid2]]['noeffectbattle1']))//Один раз за бой
			{
				$pr_vars['priem_team_f'][0]['chance'] = 100;
				$pr_vars['priem_team_f'][0]['name'] = 'Честная Игра (снимает эффекты до конца боя)';
				$pr_vars['priem_team_f'][0]['x'] = 1;
				$pr_vars['priem_team_f'][0]['type'] = 3;
				$pr_vars['priem_team_f'][0]['hp'] = 0;
				$pr_vars['priem_team_f'][0]['hp_dmg'] = rand(1,5);
				$pr_vars['priem_team_f'][0]['priem'] = 164;
				$pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
				$pr_vars['priem_team_f'][0]['on'] = $uid;
				$pr_vars['priem_team_f'][0]['nomf'] = 0;
				$pr_vars['priem_team_f'][0]['fiz'] = 1;
				$pr_vars['priem_team_f'][0]['krituet'] = true;

				 mysql_query('INSERT INTO `battle_actions` (`btl`,`uid`,`time`,`vars`,`vals`)
				 VALUES ("'.$this->info['id'].'","'.$uid2.'","'.time().'","noeffectbattle1","'.$uid1.'")');

				$u->addAction(time(),'use_priem_'.$btl->info['id'].'_'.$uid1,'mygame');
			}
            unset($xu);
		}
	}
	
	if( $this->users[$this->uids[$uid1]]['bot_id'] == 400 || $this->users[$this->uids[$uid1]]['bot_id'] == 404 )
	{
	 	//Проклятый Защитник
	  	$pr_vars['priem_use'][0]['chance'] = 20;
	  	$pr_vars['priem_use'][0]['name'] = 'Ярость';
	  	$pr_vars['priem_use'][0]['id'] = 14;
	  	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  
		$pr_vars['priem_use'][1]['chance'] = 20;
		$pr_vars['priem_use'][1]['name'] = 'Абсолютная защита';
		$pr_vars['priem_use'][1]['id'] = 140;
		$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
		$pr_vars['priem_use'][1]['no_chat'] = true;

		$pr_vars['priem_use'][2]['chance'] = 40;
		$pr_vars['priem_use'][2]['name'] = 'Активная защита';
		$pr_vars['priem_use'][2]['id'] = 7;
		$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
		$pr_vars['priem_use'][2]['no_chat'] = true;
	}

	if( $this->users[$this->uids[$uid1]]['bot_id'] == 405 || $this->users[$this->uids[$uid1]]['bot_id'] == 399 || $this->users[$this->uids[$uid1]]['bot_id'] == 282 )
	{
		//Проклятые Скиталец
		$pr_vars['priem_use'][0]['chance'] = 20;
		$pr_vars['priem_use'][0]['name'] = 'Ярость';
		$pr_vars['priem_use'][0]['id'] = 14;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

		$pr_vars['priem_use'][1]['chance'] = 20;
		$pr_vars['priem_use'][1]['name'] = 'Полная защита';
		$pr_vars['priem_use'][1]['id'] = 45;
		$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
		$pr_vars['priem_use'][1]['no_chat'] = true;
	}

	if( $this->users[$this->uids[$uid1]]['bot_id'] == 397 || $this->users[$this->uids[$uid1]]['bot_id'] == 402 )
	{
		//Проклятый Убица
		$pr_vars['priem_team_f'][0]['chance'] = 3;
		$pr_vars['priem_team_f'][0]['name'] = 'Удар Убицы';
		$pr_vars['priem_team_f'][0]['x'] = 1;
		$pr_vars['priem_team_f'][0]['type'] = 6;
		$pr_vars['priem_team_f'][0]['hp'] = 0;
		$pr_vars['priem_team_f'][0]['hp_dmg'] = rand(100,150);
		$pr_vars['priem_team_f'][0]['priem'] = 160;
		$pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
		$pr_vars['priem_team_f'][0]['on'] = $uid;
		$pr_vars['priem_team_f'][0]['nomf'] = 0;
		$pr_vars['priem_team_f'][0]['fiz'] = 1;
		$pr_vars['priem_team_f'][0]['krituet'] = false;
	}

	if( in_array($this->users[$this->uids[$uid1]]['bot_id'], array(397,402,406,398,396,403,280,401)) )
	{
		//Проклятые с приемом Ярость
		$pr_vars['priem_use'][0]['chance'] = 20;
		$pr_vars['priem_use'][0]['name'] = 'Ярость';
		$pr_vars['priem_use'][0]['id'] = 14;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}

	if($this->users[$this->uids[$uid1]]['bot_id'] == 276 || $this->users[$this->uids[$uid1]]['bot_id'] == 278)
	{
		  //Зомби 10 - 3 этаж
		  $pr_vars['priem_use'][0]['chance'] = 5;
		  $pr_vars['priem_use'][0]['name'] = 'Стылое касание';
		  $pr_vars['priem_use'][0]['id'] = 338;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		  
		  $pr_vars['priem_use'][1]['chance'] = 5;
		  $pr_vars['priem_use'][1]['name'] = 'Проглятье Голодного Мертвеца';
		  $pr_vars['priem_use'][1]['id'] = 339;
		  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
		  
		  $pr_vars['priem_use'][2]['chance'] = 20;
		  $pr_vars['priem_use'][2]['name'] = 'Ярость';
		  $pr_vars['priem_use'][2]['id'] = 14;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
		  
		  /*$pr_vars['priem_use'][3]['chance'] = 15;
		  $pr_vars['priem_use'][3]['name'] = 'Ошеломить';
		  $pr_vars['priem_use'][3]['id'] = 189;
		  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid2]];*/
		  
		  $pr_vars['priem_use'][4]['chance'] = 10;
		  $pr_vars['priem_use'][4]['name'] = 'Сильный удар';
		  $pr_vars['priem_use'][4]['id'] = 4;
		  $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
		  
          if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
		  {
		  	$pr_vars['priem_regen']['hp'] = floor($this->stats[$this->uids[$uid1]]['hpAll']/10);
		  	$pr_vars['priem_regen']['chance'] = 10;
		  	$pr_vars['priem_regen']['name'] = 'Регенерация';
		  }

		  $pr_vars['priem_team_f'][0]['chance'] = 10;
		  $pr_vars['priem_team_f'][0]['name'] = 'Ядовитый Укус';
		  $pr_vars['priem_team_f'][0]['x'] = 1;
		  $pr_vars['priem_team_f'][0]['type'] = 3;	  
		  $pr_vars['priem_team_f'][0]['hp'] = 0;
		  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(100,200);
		  $pr_vars['priem_team_f'][0]['priem'] = 83;
		  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][0]['on'] = $uid;
		  $pr_vars['priem_team_f'][0]['nomf'] = 0;
		  $pr_vars['priem_team_f'][0]['fiz'] = 0;
		  $pr_vars['priem_team_f'][0]['krituet'] = true;
	}

	if($this->users[$this->uids[$uid1]]['bot_id'] == 338 || $this->users[$this->uids[$uid1]]['bot_id'] == 380)
	{
		  //Окочанелый зомби
		  $pr_vars['priem_use'][0]['chance'] = 5;
		  $pr_vars['priem_use'][0]['name'] = 'Стылое касание';
		  $pr_vars['priem_use'][0]['id'] = 338;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		  
		  $pr_vars['priem_use'][1]['chance'] = 20;
		  $pr_vars['priem_use'][1]['name'] = 'Ярость';
		  $pr_vars['priem_use'][1]['id'] = 14;
		  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	}

	if($this->users[$this->uids[$uid1]]['bot_id'] == 389 || $this->users[$this->uids[$uid1]]['bot_id'] == 381)
	{
		  //Зубастый Зомби 10 - 3 этаж
		  $pr_vars['priem_use'][0]['chance'] = 20;
		  $pr_vars['priem_use'][0]['name'] = 'Ярость';
		  $pr_vars['priem_use'][0]['id'] = 14;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		  
		  $pr_vars['priem_team_f'][0]['chance'] = 10;
		  $pr_vars['priem_team_f'][0]['name'] = 'Ядовитый Укус';
		  $pr_vars['priem_team_f'][0]['x'] = 1;
		  $pr_vars['priem_team_f'][0]['type'] = 3;	  
		  $pr_vars['priem_team_f'][0]['hp'] = 0;
		  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(100,200);
		  $pr_vars['priem_team_f'][0]['priem'] = 83;
		  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][0]['on'] = $uid;
		  $pr_vars['priem_team_f'][0]['nomf'] = 0;
		  $pr_vars['priem_team_f'][0]['fiz'] = 0;
		  $pr_vars['priem_team_f'][0]['krituet'] = true;
	}

	if($this->users[$this->uids[$uid1]]['bot_id'] == 390 || $this->users[$this->uids[$uid1]]['bot_id'] == 382)
	{
		  //Голодный Зомби 10 - 3 этаж
		  $pr_vars['priem_use'][0]['chance'] = 10;
		  $pr_vars['priem_use'][0]['name'] = 'Проклятье Голодного Мертвеца';
		  $pr_vars['priem_use'][0]['id'] = 339;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		  
		  $pr_vars['priem_use'][2]['chance'] = 20;
		  $pr_vars['priem_use'][2]['name'] = 'Ярость';
		  $pr_vars['priem_use'][2]['id'] = 14;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	}

	if($this->users[$this->uids[$uid1]]['bot_id'] == 392 || $this->users[$this->uids[$uid1]]['bot_id'] == 384)
	{
		  //Загадочный Зомби 10 - 3 этаж
		  $pr_vars['priem_use'][0]['chance'] = 20;
		  $pr_vars['priem_use'][0]['name'] = 'Ярость';
		  $pr_vars['priem_use'][0]['id'] = 14;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		  
		  /*
		  //вызывает зависание боя - из-за sex...
		  $pr_vars['priem_use'][1]['chance'] = 15;
		  $pr_vars['priem_use'][1]['name'] = 'Ошеломить';
		  $pr_vars['priem_use'][1]['id'] = 189;
		  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];*/
	}

	if($this->users[$this->uids[$uid1]]['bot_id'] == 391 || $this->users[$this->uids[$uid1]]['bot_id'] == 383)
	{
		  //Живучий Зомби 10 - 3 этаж
		  $pr_vars['priem_use'][0]['chance'] = 20;
		  $pr_vars['priem_use'][0]['name'] = 'Ярость';
		  $pr_vars['priem_use'][0]['id'] = 14;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

		  if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
		  {
			$pr_vars['priem_regen']['hp'] = floor($this->stats[$this->uids[$uid1]]['hpAll']/10);
			$pr_vars['priem_regen']['chance'] = 10;
			$pr_vars['priem_regen']['name'] = 'Регенерация';
		  }
	}

	if($this->users[$this->uids[$uid1]]['bot_id'] == 395 || $this->users[$this->uids[$uid1]]['bot_id'] == 387)
	{
		  //Древний Зомби 10 - 3 этаж
		  $pr_vars['priem_use'][0]['chance'] = 20;
		  $pr_vars['priem_use'][0]['name'] = 'Ярость';
		  $pr_vars['priem_use'][0]['id'] = 14;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		  
		  $pr_vars['priem_use'][1]['chance'] = 10;
		  $pr_vars['priem_use'][1]['name'] = 'Сильный удар';
		  $pr_vars['priem_use'][1]['id'] = 4;
		  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	}

	if($this->users[$this->uids[$uid1]]['bot_id'] == 101 || $this->users[$this->uids[$uid1]]['bot_id'] == 277)
	{
		//Пожиратель Падали - 3 этаж
		$pr_vars['priem_use'][0]['chance'] = 20;
		$pr_vars['priem_use'][0]['name'] = 'Ярость';
		$pr_vars['priem_use'][0]['id'] = 14;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		  
		/*$pr_vars['priem_use'][1]['chance'] = 22;
		$pr_vars['priem_use'][1]['name'] = 'Парализующий Укус';
		$pr_vars['priem_use'][1]['id'] = 189;
		$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];*/
	}
	
	/*
	
	Семейство Проклятых: 
	Проклятый Оруженосец 2 удара 2 блока. Приёмы: Ярость
	Проклятый Страж 2 удара 2 блока. Приёмы: Ярость
	Проклятый Убийца 2 удара 2 блока. Приёмы: Ярость, "Удар Убийцы" - безответный удар
	Проклятый Пламеносец 2 удара 2 блока. Приёмы: Ярость
	Проклятый Скиталец 2 удара 2 блока. Приёмы: Ярость, "Полная защита. 
	Проклятый Защитник 2 блока, 2 удара. Приёмы: Ярость, "Абсолютная защита","Активная защита". 
	После смерти могут упасть предметы из комплектов 9го уровня, кроме ювелирки..
	Обычные проклятые имеют 1000 хп, все марочные 1500. 
	Место рождения: Катакомбы
	
	*/
	
	if($this->users[$this->uids[$uid1]]['bot_id'] == 251)
	{
		### Офицер Глубин [8] - Катакомбы 1 этаж
		if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
		{
		  	$pr_vars['priem_regen']['hp'] = 500;
		  	$pr_vars['priem_regen']['chance'] = 2;
		  	$pr_vars['priem_regen']['name'] = 'Эликсир лечения';
		}
		  $pr_vars['priem_use'][0]['chance'] = 25;
		  $pr_vars['priem_use'][0]['name'] = 'Ярость';
		  $pr_vars['priem_use'][0]['id'] = 14;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		  
		  $pr_vars['priem_use'][1]['chance'] = 10;
		  $pr_vars['priem_use'][1]['name'] = 'Сонный яд';
		  $pr_vars['priem_use'][1]['id'] = 333;
		  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
		  
		  $pr_vars['priem_use'][2]['chance'] = 20;
          $pr_vars['priem_use'][1]['name'] = 'танец лезвий';
		  $pr_vars['priem_use'][2]['id'] = 48;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
		  $pr_vars['priem_use'][2]['no_chat'] = true;
		  
		  $pr_vars['priem_use'][3]['chance'] = 20;
		  $pr_vars['priem_use'][3]['name'] = 'Шокирующий удар';
		  $pr_vars['priem_use'][3]['id'] = 235;
		  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
		  $pr_vars['priem_use'][3]['no_chat'] = true;
	}
	
	
	if($this->users[$this->uids[$uid1]]['bot_id'] == 259)
	{
		### Слизь [8] - Катакомбы 1 этаж
		if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
		{
		  $pr_vars['priem_regen']['hp'] = 50;
		  $pr_vars['priem_regen']['chance'] = 10;
		  $pr_vars['priem_regen']['name'] = 'Регенерация';
		}
	}
	
	if($this->users[$this->uids[$uid1]]['bot_id'] == 268)
	{
		### Слизь [9] - Катакомбы 1 этаж
		if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
		{
			$pr_vars['priem_regen']['hp'] = 75;
			$pr_vars['priem_regen']['chance'] = 10;
			$pr_vars['priem_regen']['name'] = 'Регенерация';
		}

		$pr_vars['priem_use'][0]['chance'] = 15;
		$pr_vars['priem_use'][0]['name'] = 'Ярость';
		$pr_vars['priem_use'][0]['id'] = 14;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}
	
	if($this->users[$this->uids[$uid1]]['bot_id'] == 268)
	{
		### Слизь [9] - Катакомбы 2 этаж
		if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
		{
			if( rand(0,1) == 1 )
			{
			  	$pr_vars['priem_regen']['hp'] = 75;
			  	$pr_vars['priem_regen']['chance'] = 15;
			  	$pr_vars['priem_regen']['name'] = 'Регенерация';
			} else {
			  	$pr_vars['priem_regen']['hp'] = 35;
			  	$pr_vars['priem_regen']['chance'] = 30;
			  	$pr_vars['priem_regen']['name'] = 'Воля к победе';
			}
		}
		  $pr_vars['priem_use'][0]['chance'] = 25;
		  $pr_vars['priem_use'][0]['name'] = 'Ярость';
		  $pr_vars['priem_use'][0]['id'] = 14;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		  
		  $pr_vars['priem_use'][1]['chance'] = 15;
		  $pr_vars['priem_use'][1]['name'] = 'Поцелуй Слизи';
		  $pr_vars['priem_use'][1]['id'] = 335;
		  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
		  
		$pr_vars['priem_use'][2]['chance'] = 25;
		$pr_vars['priem_use'][2]['name'] = 'Удачный удар';
		$pr_vars['priem_use'][2]['id'] = 11;
		$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

		$pr_vars['priem_use'][3]['chance'] = 15;
		$pr_vars['priem_use'][3]['name'] = 'Хлебнуть Крови';
		$pr_vars['priem_use'][3]['id'] = 240;
		$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

		$pr_vars['priem_team_f'][0]['chance'] = 5;
		$pr_vars['priem_team_f'][0]['name'] = 'Кислотный Плевок';
		$pr_vars['priem_team_f'][0]['x'] = 1;
		$pr_vars['priem_team_f'][0]['type'] = 3;
		$pr_vars['priem_team_f'][0]['hp'] = 0;
		$pr_vars['priem_team_f'][0]['hp_dmg'] = rand(100,300);
		$pr_vars['priem_team_f'][0]['priem'] = 164;
		$pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
		$pr_vars['priem_team_f'][0]['on'] = $uid;
		$pr_vars['priem_team_f'][0]['nomf'] = 0;
		$pr_vars['priem_team_f'][0]['fiz'] = 0;
		$pr_vars['priem_team_f'][0]['krituet'] = false;
		  
	}
	
	if($this->users[$this->uids[$uid1]]['bot_id'] == 275)
	{
		### Чернокнижник [9] - Катакомбы 2 этаж
		  $pr_vars['priem_use'][0]['chance'] = 30;
		  $pr_vars['priem_use'][0]['name'] = 'Ярость';
		  $pr_vars['priem_use'][0]['id'] = 14;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		  
		  $pr_vars['priem_use'][1]['chance'] = 30;
		  $pr_vars['priem_use'][1]['name'] = 'Стойкость';
		  $pr_vars['priem_use'][1]['id'] = 13;
		  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
		  
		  $pr_vars['priem_use'][2]['chance'] = 15;
		  $pr_vars['priem_use'][2]['name'] = 'Проклятье Тьмы';
		  $pr_vars['priem_use'][2]['id'] = 336;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid2]];
		  
            if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
			{
		  		$pr_vars['priem_use'][3]['chance'] = 10;
		  		$pr_vars['priem_use'][3]['name'] = 'Выпить Душу';
		  		$pr_vars['priem_use'][3]['id'] = 337;
		  		$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
		  	}
		  
			$pr_vars['priem_team_f'][0]['chance'] = 15;
			$pr_vars['priem_team_f'][0]['name'] = 'Касание Тьмы';
			$pr_vars['priem_team_f'][0]['x'] = 1;
			$pr_vars['priem_team_f'][0]['type'] = 6;
			$pr_vars['priem_team_f'][0]['hp'] = 0;
			$pr_vars['priem_team_f'][0]['hp_dmg'] = rand(100,300);
			$pr_vars['priem_team_f'][0]['priem'] = 160;
			$pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
			$pr_vars['priem_team_f'][0]['on'] = $uid;
			$pr_vars['priem_team_f'][0]['nomf'] = 0;
			$pr_vars['priem_team_f'][0]['fiz'] = 0;
			$pr_vars['priem_team_f'][0]['krituet'] = false;
			
			$pr_vars['priem_team_f'][1]['chance'] = 25;
			$pr_vars['priem_team_f'][1]['name'] = 'Разрушение [9]';
			$pr_vars['priem_team_f'][1]['x'] = 1;
			$pr_vars['priem_team_f'][1]['type'] = 6;
			$pr_vars['priem_team_f'][1]['hp_dmg'] = rand(100,300);
			$pr_vars['priem_team_f'][1]['hp'] = round($pr_vars['priem_team_f'][1]['hp_dmg']/2);
			$pr_vars['priem_team_f'][1]['priem'] = 160;
			$pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
			$pr_vars['priem_team_f'][1]['on'] = $uid;
			$pr_vars['priem_team_f'][1]['nomf'] = 0;
			$pr_vars['priem_team_f'][1]['fiz'] = 0;
			$pr_vars['priem_team_f'][1]['krituet'] = false;
			$pr_vars['priem_team_f'][1]['hpregen'] = true;
            $pr_vars['priem_team_f'][1]['hpregen05'] = true;
		  
	}
	
	if($this->users[$this->uids[$uid1]]['bot_id'] == 266)
	{
		  ### Епископ [9] - Катакомбы 2 этаж
		  if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
		  {
		  	$pr_vars['priem_regen']['hp'] = 300;
		  	$pr_vars['priem_regen']['chance'] = 15;
		  	$pr_vars['priem_regen']['name'] = 'Лечение';
		  }

		  $pr_vars['priem_use'][0]['chance'] = 10;
		  $pr_vars['priem_use'][0]['name'] = 'Святая Ярость';
		  $pr_vars['priem_use'][0]['id'] = 334;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		
		  $pr_vars['priem_use'][2]['chance'] = 35;
		  $pr_vars['priem_use'][2]['name'] = 'Обречённость';
		  $pr_vars['priem_use'][2]['id'] = 204;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
		  
		  $pr_vars['priem_use'][3]['chance'] = 35;
		  $pr_vars['priem_use'][3]['name'] = 'Активная защита';
		  $pr_vars['priem_use'][3]['id'] = 7;
		  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
		  $pr_vars['priem_use'][3]['no_chat'] = true;
		  
		  $pr_vars['priem_use'][4]['chance'] = 25;
		  $pr_vars['priem_use'][4]['name'] = 'Ярость';
		  $pr_vars['priem_use'][4]['id'] = 14;
		  $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
		  
	}

	if( $this->users[$this->uids[$uid1]]['bot_id'] == 288 )
	{
		//Повелитель
        $pr_vars['priem_one']['chance'] = 70;
    	$pr_vars['priem_one']['hpdmg'] = rand(300,400);
  		$pr_vars['priem_one']['name'] = 'Взмах дубиной';

		/*$pr_vars['priem_use'][0]['chance'] = 50;
		$pr_vars['priem_use'][0]['name'] = 'ВИЗГ Отрицания';
		$pr_vars['priem_use'][0]['id'] = 607;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
        $pr_vars['priem_use'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
        $pr_vars['priem_use'][0]['limit'] = 10;*/

        /*$pr_vars['priem608']['chance'] = 50;
    	$pr_vars['priem608']['dmg'] = rand(50,80);
  		$pr_vars['priem608']['name'] = 'Штормовой Щит';
    	$pr_vars['priem608']['team'] = $this->users[$this->uids[$uid2]]['team'];
        $pr_vars['priem608_add610'] = true;

		$pr_vars['priem610']['chance'] = 50;
		$pr_vars['priem610']['name'] = 'Заряженный Штормовой Щит';
    	$pr_vars['priem610']['dmg'] = rand(1,167);
		$pr_vars['priem610']['team'] = $this->users[$this->uids[$uid2]]['team'];*/

        /*$pr_vars['priem_mana']['chance'] = 50;
    	$pr_vars['priem_mana']['mppr'] = 5;
  		$pr_vars['priem_mana']['name'] = 'Воронка отрицания';
        $pr_vars['priem_mana']['team'] = $this->users[$this->uids[$uid2]]['team'];

	  	$pr_vars['priem_use'][0]['chance'] = 0;
	  	$pr_vars['priem_use'][0]['name'] = 'Кровожадность';
	  	$pr_vars['priem_use'][0]['id'] = 305;
	  	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

		$pr_vars['priem_use'][2]['chance'] = 0;
	  	$pr_vars['priem_use'][2]['name'] = 'Мастер Клинков';
	  	$pr_vars['priem_use'][2]['id'] = 601;
	  	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

		$pr_vars['priem_use'][3]['chance'] = 0;
	  	$pr_vars['priem_use'][3]['name'] = 'Изворотливость';
	  	$pr_vars['priem_use'][3]['id'] = 602;
	  	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

		$pr_vars['priem_use'][4]['chance'] = 0;
	  	$pr_vars['priem_use'][4]['name'] = 'Пробой Защиты';
	  	$pr_vars['priem_use'][4]['id'] = 603;
	  	$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];

		$pr_vars['priem_use'][4]['chance'] = 0;
	  	$pr_vars['priem_use'][4]['name'] = 'Бешенство';
	  	$pr_vars['priem_use'][4]['id'] = 604;
	  	$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];*/

		/*$pr_vars['priem_use'][0]['chance'] = 50;
		$pr_vars['priem_use'][0]['name'] = 'Шкура Поглощения';
		$pr_vars['priem_use'][0]['id'] = 175;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
        $pr_vars['priem_use'][0]['rand1'] = 350;
        $pr_vars['priem_use'][0]['rand2'] = 600;
        $pr_vars['priem_use'][0]['limit'] = 3;*/

		/*$pr_vars['priem_use'][0]['chance'] = 0;
		$pr_vars['priem_use'][0]['name'] = 'Абсолютный щит';
		$pr_vars['priem_use'][0]['id'] = 175;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
        $pr_vars['priem_use'][0]['rand1'] = 650;
        $pr_vars['priem_use'][0]['rand2'] = 750;
        $pr_vars['priem_use'][0]['limit'] = 5;*/

		/*$pr_vars['priem_use'][0]['chance'] = 0;
		$pr_vars['priem_use'][0]['name'] = 'Шкура Поглощения';
		$pr_vars['priem_use'][0]['id'] = 175;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
        $pr_vars['priem_use'][0]['rand1'] = 570;
        $pr_vars['priem_use'][0]['rand2'] = 1200;
        $pr_vars['priem_use'][0]['limit'] = 5;*/

		/*$pr_vars['priem_use'][0]['chance'] = 100;
		$pr_vars['priem_use'][0]['name'] = 'Болотная Атрофия';
		$pr_vars['priem_use'][0]['id'] = 605;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
        $pr_vars['priem_use'][0]['hodout'] = 15;

		pr_vars['priem_use'][0]['chance'] = 0;
		$pr_vars['priem_use'][0]['name'] = 'Пожрать';
		$pr_vars['priem_use'][0]['id'] = 271;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

		$pr_vars['priem_use'][1]['chance'] = 0;
	  	$pr_vars['priem_use'][1]['name'] = 'Раскол Брони';
	  	$pr_vars['priem_use'][1]['id'] = 600;
	  	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

        $pr_vars['priem_use'][0]['chance'] = 0;
		$pr_vars['priem_use'][0]['name'] = 'Парализующий дротик';
		$pr_vars['priem_use'][0]['id'] = 606;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
        $pr_vars['priem_use'][$i]['hpdmg'] = rand(30,50);

		$pr_vars['priem_use'][0]['chance'] = 0;
		$pr_vars['priem_use'][0]['name'] = 'Метеорит';
		$pr_vars['priem_use'][0]['id'] = 124;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
        $pr_vars['priem_use'][0]['data'] = 'atgm=199';

		$pr_vars['priem_use'][0]['chance'] = 0;
		$pr_vars['priem_use'][0]['name'] = 'Тишина';
		$pr_vars['priem_use'][0]['id'] = 607;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
        $pr_vars['priem_use'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];

        $pr_vars['priem_team_f'][0]['chance'] = 100;
		$pr_vars['priem_team_f'][0]['name'] = 'Высосать';
		$pr_vars['priem_team_f'][0]['x'] = 1;
		$pr_vars['priem_team_f'][0]['type'] = 6;
		$pr_vars['priem_team_f'][0]['hp_dmg'] = rand(100,300);
		$pr_vars['priem_team_f'][0]['hp'] = round($pr_vars['priem_team_f'][0]['hp_dmg']/2);
		$pr_vars['priem_team_f'][0]['priem'] = 160;
		$pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
		$pr_vars['priem_team_f'][0]['on'] = $uid;
		$pr_vars['priem_team_f'][0]['nomf'] = 0;
		$pr_vars['priem_team_f'][0]['fiz'] = 0;
		$pr_vars['priem_team_f'][0]['krituet'] = false;
		$pr_vars['priem_team_f'][0]['hpregen'] = true;
		$pr_vars['priem_team_f'][0]['hpregen05'] = true;*/

	}
	/* - - - - - - КАТАКОМБЫ БОТЫ ПРИЕМЫ КОНЕЦ - - - - - - -  */

//Излом хаоса
/*if($this->users[$this->uids[$uid1]]['bot_id'] == 416)
{
	#1#
	$pr_vars['priem_use'][0]['chance'] = 50;
	$pr_vars['priem_use'][0]['name'] = 'Грация Боя';
	$pr_vars['priem_use'][0]['id'] = 291;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	#1#
}*/
  
###Start (Приёмы ботам)###

if($this->users[$this->uids[$uid1]]['bot_id'] == 118 || $this->users[$this->uids[$uid1]]['bot_id'] == 119)
{
	###Пустынник Атаман [8] / Пустынник Атаман [9]
	$pr_vars['priem_use'][0]['chance'] = 30;
	$pr_vars['priem_use'][0]['name'] = 'Сильный удар';
	$pr_vars['priem_use'][0]['id'] = 4;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
	//Шокирующий
	$pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = 'Шокирующий удар';
	$pr_vars['priem_use'][0]['id'] = 236;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
  
}

//Канализация
/*elseif($this->users[$this->uids[$uid1]]['bot_id'] == 50 || $this->users[$this->uids[$uid1]]['bot_id'] == 53) {
	//Паук или Сточный паук
	//priem team x type hp hp_dmg
	  
	  //Быстрый удар
	  $pr_vars['priem_team_f'][] = array(
		  'chance' => 25,
		  'name' => 'Быстрый удар',
		  'x' => 1,
		  'type' => 7,	  
		  'hp' => 0,
		  'hp_dmg' => 2,	  
		  'priem' => 164,
		  'team' => $this->users[$this->uids[$uid2]]['team'],
		  'on' => $uid,
		  'nomf' => 1,
		  'fiz' => 1,
		  'krituet' => false 
	  );
	  
	  //Отпрыгнуть
	  $pr_vars['priem_use'][] = array(
		  'chance' => 25,
		  'name' => 'Отпрыгнуть',
		  'id' => 8,
		  'on' => $this->users[$this->uids[$uid1]],
		  'no_chat' => true
	  );
	  
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 54) {
	//Канализационный жук
	  
	  //Ослабить удар
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
	  $pr_vars['priem_use'][0]['id'] = 1;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Мощный удар
	  $pr_vars['priem_use'][1]['chance'] = 10;
	  $pr_vars['priem_use'][1]['name'] = 'Мощный удар';
	  $pr_vars['priem_use'][1]['id'] = 2;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 57) {
	 //Сантехник зомби
	  
	  //Быстрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Быстрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 2;
	$pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = false;
	  //Мощный удар
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = 'Мощный удар';
	  $pr_vars['priem_use'][0]['id'] = 2;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 58) {
	//Обитатель подвалов
	  
	  //Быстрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Мокрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 16;
	  $pr_vars['priem_team_f'][0]['priem'] = 73;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 0;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
	  
	  //Мощный удар
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = 'Мощный удар';
	  $pr_vars['priem_use'][0]['id'] = 2;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Закусить
	  $pr_vars['priem_regen']['hp'] = 8;
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Закусить';
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 56) {
	//Тунельный гад
	  
	  //Быстрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Быстрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 2;	  
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = false;
	  
	  //Регенерация
	  $pr_vars['priem_regen']['hp'] = rand(8,12);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 55) {
	//Жуткая мерзость
	  
	  //Быстрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Быстрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 2;	  
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = false;
	  //Кислотное касание
	  $pr_vars['priem_team_f'][1]['chance'] = 10;
	  $pr_vars['priem_team_f'][1]['name'] = 'Кислотное касание';
	  $pr_vars['priem_team_f'][1]['x'] = 1;
	  $pr_vars['priem_team_f'][1]['type'] = 3;	  
	  $pr_vars['priem_team_f'][1]['hp'] = 0;
	  $pr_vars['priem_team_f'][1]['hp_dmg'] = 32;
	  $pr_vars['priem_team_f'][1]['priem'] = 73;
	  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][1]['on'] = $uid;
	  $pr_vars['priem_team_f'][1]['nomf'] = 0;
	  $pr_vars['priem_team_f'][1]['fiz'] = 0;
	  $pr_vars['priem_team_f'][1]['krituet'] = true;	  
	  //Регенерация
	  $pr_vars['priem_regen']['hp'] = rand(8,12);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
	  //Надкусить
	  $pr_vars['priem_use'][0]['chance'] = 50;
	  $pr_vars['priem_use'][0]['name'] = 'Надкусить';
	  $pr_vars['priem_use'][0]['id'] = 293;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 52) {
	//Мартын
	  
	  //Мокрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Мокрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 32;
	  $pr_vars['priem_team_f'][0]['priem'] = 73;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 0;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;	  
	  //Регенерация
	  $pr_vars['priem_regen']['hp'] = rand(8,12);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
	  //Ослабить удар
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
	  $pr_vars['priem_use'][0]['id'] = 1;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Мощный удар
	  $pr_vars['priem_use'][1]['chance'] = 10;
	  $pr_vars['priem_use'][1]['name'] = 'Мощный удар';
	  $pr_vars['priem_use'][1]['id'] = 2;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  //Надкусить
	  if( rand(0,100) < 10 ) {
		  //Зловонная Вода
		  $pr_vars['priem_team_f'][1]['chance'] = 100;
		  $pr_vars['priem_team_f'][1]['name'] = 'Зловонная Вода';
		  $pr_vars['priem_team_f'][1]['x'] = 1;
		  $pr_vars['priem_team_f'][1]['type'] = 3;	  
		  $pr_vars['priem_team_f'][1]['hp'] = 0;
		  $pr_vars['priem_team_f'][1]['hp_dmg'] = 2;	  
		  $pr_vars['priem_team_f'][1]['priem'] = 164;
		  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][1]['on'] = $uid;
		  $pr_vars['priem_team_f'][1]['nomf'] = 1;
		  $pr_vars['priem_team_f'][1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][1]['krituet'] = false;
		  //
		  $pr_vars['priem_use'][2]['chance'] = 100;
		  $pr_vars['priem_use'][2]['name'] = 'Зловонная Вода';
		  $pr_vars['priem_use'][2]['id'] = 294;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid2]];
		  $pr_vars['priem_use'][2]['no_chat'] = true;
	  }
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 64) {
	//Канализационный паук
	  
	  //Быстрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Быстрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(10,13);
	  $pr_vars['priem_team_f'][0]['priem'] = 73;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;	  
	  //Проткнуть
	  if( rand(0,100) < 15 ) {
		  //Проткнуть
		  $pr_vars['priem_use'][0]['chance'] = 100;
		  $pr_vars['priem_use'][0]['name'] = 'Проткнуть';
		  $pr_vars['priem_use'][0]['id'] = 295;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		  //$pr_vars['priem_use'][2]['no_chat'] = true;
	  }
	  //Двойной удар
	  if( rand(0,100) < 15 ) {
		  $pr_vars['priem_team_f'][1]['chance'] = 100;
		  $pr_vars['priem_team_f'][1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][1]['x'] = 1;
		  $pr_vars['priem_team_f'][1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][1]['hp'] = 0;
		  $pr_vars['priem_team_f'][1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][1]['hp_dmg']['y'],$pr_vars['priem_team_f'][1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][1]['priem'] = 73;
		  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][1]['on'] = $uid;
		  $pr_vars['priem_team_f'][1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][1]['krituet'] = true;
		  //
		  $pr_vars['priem_team_f'][2]['chance'] = 100;
		  $pr_vars['priem_team_f'][2]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][2]['x'] = 1;
		  $pr_vars['priem_team_f'][2]['type'] = 7;	  
		  $pr_vars['priem_team_f'][2]['hp'] = 0;
		  $pr_vars['priem_team_f'][2]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][2]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][2]['hp_dmg']['y'],$pr_vars['priem_team_f'][2]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][2]['priem'] = 73;
		  $pr_vars['priem_team_f'][2]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][2]['on'] = $uid;
		  $pr_vars['priem_team_f'][2]['nomf'] = 0;
		  $pr_vars['priem_team_f'][2]['fiz'] = 1;
		  $pr_vars['priem_team_f'][2]['krituet'] = true;
	  }
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 62) {
	//Безголовый Сантехник
	  
	  //Проткнуть
	  if( rand(0,100) < 15 ) {
		  //Проткнуть
		  $pr_vars['priem_use'][0]['chance'] = 100;
		  $pr_vars['priem_use'][0]['name'] = 'Гнилая кровь';
		  $pr_vars['priem_use'][0]['id'] = 296;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	  }
	  //
  	  $pr_vars['priem_use'][] = array(
		 'chance' => 10,
		 'name' => 'Ослабить удар',
		 'id' => 7,
		 'on' => $this->users[$this->uids[$uid1]],
		 'no_chat' => true
	  );
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 65) {
	//Страшная крыса
	  
	  //Надкусить
	  $pr_vars['priem_use'][0]['chance'] = 40;
	  $pr_vars['priem_use'][0]['name'] = 'Надкусить';
	  $pr_vars['priem_use'][0]['id'] = 293;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	  //Укусить
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Укусить';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(1,13);	  
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = false;
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 61) {
	//Летучая бестия
	  
	  //Укусить
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Укусить';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(1,14);	  
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = false;
	  //
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Облако тьмы';
  	  $pr_vars['priem_use'][0]['id'] = 236;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	  //Отпрыгнуть
	  $pr_vars['priem_use'][1]['chance'] = 15;
	  $pr_vars['priem_use'][1]['name'] = 'Отпрыгнуть';
	  $pr_vars['priem_use'][1]['id'] = 8;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 63) {
	//Кровавый сантехник
	  
	  //ослабить удар
  	 $pr_vars['priem_use'][0]['chance'] = 10;
  	 $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	 $pr_vars['priem_use'][0]['id'] = 7;
  	 $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	 $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Надкусить
	  $pr_vars['priem_use'][1]['chance'] = 50;
	  $pr_vars['priem_use'][1]['name'] = 'Надкусить';
	  $pr_vars['priem_use'][1]['id'] = 293;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
	  //Проткнуть
	  if( rand(0,100) < 10 ) {
		  //Проткнуть
		  $pr_vars['priem_use'][2]['chance'] = 100;
		  $pr_vars['priem_use'][2]['name'] = 'Гнилая кровь';
		  $pr_vars['priem_use'][2]['id'] = 296;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid2]];
	  }
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 68) {
	//Старожил 
	  
	  //Метнуть болт
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Метнуть болт';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 37;
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
	  //Метнуть болт
	  $pr_vars['priem_team_f'][1]['chance'] = 10;
	  $pr_vars['priem_team_f'][1]['name'] = 'Взрыв грязи';
	  $pr_vars['priem_team_f'][1]['x'] = 1;
	  $pr_vars['priem_team_f'][1]['type'] = 3;	  
	  $pr_vars['priem_team_f'][1]['hp'] = 0;
	  $pr_vars['priem_team_f'][1]['hp_dmg'] = 22;
	  $pr_vars['priem_team_f'][1]['priem'] = 164;
	  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][1]['on'] = $uid;
	  $pr_vars['priem_team_f'][1]['nomf'] = 0;
	  $pr_vars['priem_team_f'][1]['fiz'] = 1;
	  $pr_vars['priem_team_f'][1]['krituet'] = true;
	  //ослабить удар
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  if( rand(0,100) < 25 ) {
		  //Метнуть болт
		  if( !isset($this->stats[$this->uids[$uid2]]['noeffectbattle1']) && true == false) {
			  $pr_vars['priem_team_f'][1]['chance'] = 100;
			  $pr_vars['priem_team_f'][1]['name'] = 'Прочистить (снимает эффекты до конца боя)';
			  $pr_vars['priem_team_f'][1]['x'] = 1;
			  $pr_vars['priem_team_f'][1]['type'] = 3;	  
			  $pr_vars['priem_team_f'][1]['hp'] = 0;
			  $pr_vars['priem_team_f'][1]['hp_dmg'] = rand(1,5);
			  $pr_vars['priem_team_f'][1]['priem'] = 164;
			  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
			  $pr_vars['priem_team_f'][1]['on'] = $uid;
			  $pr_vars['priem_team_f'][1]['nomf'] = 0;
			  $pr_vars['priem_team_f'][1]['fiz'] = 1;
			  $pr_vars['priem_team_f'][1]['krituet'] = true;
			  mysql_query('INSERT INTO `battle_actions` (`btl`,`uid`,`time`,`vars`,`vals`) VALUES (
				"'.$this->info['id'].'","'.$uid2.'","'.time().'","noeffectbattle1","'.$uid1.'"
			  )');
		  }
	  }
	 
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 66) {
	//Местный житель 
	  
	  //Взрыв грязи
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Взрыв грязи';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 24;
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
	  //ослабить удар
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //ослабить удар
  	  $pr_vars['priem_use'][1]['chance'] = 10;
  	  $pr_vars['priem_use'][1]['name'] = 'Активная защита';
  	  $pr_vars['priem_use'][1]['id'] = 7;
  	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  //Регенерация
	  $pr_vars['priem_regen']['hp'] = rand(1,10);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
	  //Закусить
	  $pr_vars['priem_team_f'][1]['chance'] = 10;
	  $pr_vars['priem_team_f'][1]['name'] = 'Закусить';
	  $pr_vars['priem_team_f'][1]['x'] = 1;
	  $pr_vars['priem_team_f'][1]['type'] = 3;	  
	  $pr_vars['priem_team_f'][1]['hp'] = 25;
	  $pr_vars['priem_team_f'][1]['hp_dmg'] = 25;
	  $pr_vars['priem_team_f'][1]['priem'] = 164;
	  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][1]['on'] = $uid;
	  $pr_vars['priem_team_f'][1]['nomf'] = 0;
	  $pr_vars['priem_team_f'][1]['fiz'] = 1;
	  $pr_vars['priem_team_f'][1]['krituet'] = true;
	  $pr_vars['priem_team_f'][1]['hpregen'] = true;
	 
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 59) {
	//Старший прораб 
	  
	  //ослабить удар
  	  $pr_vars['priem_use'][0]['chance'] = 15;
  	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Активная защита
  	  $pr_vars['priem_use'][1]['chance'] = 15;
  	  $pr_vars['priem_use'][1]['name'] = 'Активная защита';
  	  $pr_vars['priem_use'][1]['id'] = 7;
  	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  //Собраться
  	  $pr_vars['priem_use'][2]['chance'] = 15;
  	  $pr_vars['priem_use'][2]['name'] = 'Собраться';
  	  $pr_vars['priem_use'][2]['id'] = 297;
  	  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][2]['no_chat'] = true;
	  //Приказ Слабости
  	  $pr_vars['priem_use'][3]['chance'] = 5;
  	  $pr_vars['priem_use'][3]['name'] = 'Приказ Слабости';
  	  $pr_vars['priem_use'][3]['id'] = 298;
  	  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid2]];
	  //Регенерация
	  $pr_vars['priem_regen']['hp'] = rand(1,10);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
	  //Двойной удар
	  if( rand(0,100) < 15 ) {
		  //
		  $pr_vars['priem_team_f'][0]['chance'] = 100;
		  $pr_vars['priem_team_f'][0]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][0]['x'] = 1;
		  $pr_vars['priem_team_f'][0]['type'] = 7;	  
		  $pr_vars['priem_team_f'][0]['hp'] = 0;
		  $pr_vars['priem_team_f'][0]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][0]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][0]['hp_dmg']['y'],$pr_vars['priem_team_f'][0]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][0]['priem'] = 73;
		  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][0]['on'] = $uid;
		  $pr_vars['priem_team_f'][0]['nomf'] = 0;
		  $pr_vars['priem_team_f'][0]['fiz'] = 1;
		  $pr_vars['priem_team_f'][0]['krituet'] = true;
		  //
		  $pr_vars['priem_team_f'][1]['chance'] = 100;
		  $pr_vars['priem_team_f'][1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][1]['x'] = 1;
		  $pr_vars['priem_team_f'][1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][1]['hp'] = 0;
		  $pr_vars['priem_team_f'][1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][1]['hp_dmg']['y'],$pr_vars['priem_team_f'][1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][1]['priem'] = 73;
		  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][1]['on'] = $uid;
		  $pr_vars['priem_team_f'][1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][1]['krituet'] = true;
	  }
	 
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 67) {
	//Хозяин канализации 
	  
	  //Метнуть болт
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Метнуть болт';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(35,40);
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
	  //ослабить удар
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //$pr_vars['priem_use'][1]['no_chat'] = true;
	  if( rand(0,100) < 10 ) {
		  //Метнуть болт
		  if( !isset($this->stats[$this->uids[$uid2]]['noeffectbattle1']) && true == false) {
			  $pr_vars['priem_team_f'][1]['chance'] = 100;
			  $pr_vars['priem_team_f'][1]['name'] = 'Прочистить (снимает эффекты до конца боя)';
			  $pr_vars['priem_team_f'][1]['x'] = 1;
			  $pr_vars['priem_team_f'][1]['type'] = 3;	  
			  $pr_vars['priem_team_f'][1]['hp'] = 0;
			  $pr_vars['priem_team_f'][1]['hp_dmg'] = rand(1,5);
			  $pr_vars['priem_team_f'][1]['priem'] = 164;
			  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
			  $pr_vars['priem_team_f'][1]['on'] = $uid;
			  $pr_vars['priem_team_f'][1]['nomf'] = 0;
			  $pr_vars['priem_team_f'][1]['fiz'] = 1;
			  $pr_vars['priem_team_f'][1]['krituet'] = true;
			  mysql_query('INSERT INTO `battle_actions` (`btl`,`uid`,`time`,`vars`,`vals`) VALUES (
				"'.$this->info['id'].'","'.$uid2.'","'.time().'","noeffectbattle1","'.$uid1.'"
			  )');
		  }
	  }
	  //Двойной удар
	  if( rand(0,100) < 10 ) {
		  //
		  $cnt1 = count($pr_vars['priem_team_f']);
		  $pr_vars['priem_team_f'][$cnt1]['chance'] = 100;
		  $pr_vars['priem_team_f'][$cnt1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][$cnt1]['x'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][$cnt1]['hp'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][$cnt1]['hp_dmg']['y'],$pr_vars['priem_team_f'][$cnt1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][$cnt1]['priem'] = 73;
		  $pr_vars['priem_team_f'][$cnt1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][$cnt1]['on'] = $uid;
		  $pr_vars['priem_team_f'][$cnt1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['krituet'] = true;
		  //
		  $cnt1++;
		  $pr_vars['priem_team_f'][$cnt1]['chance'] = 100;
		  $pr_vars['priem_team_f'][$cnt1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][$cnt1]['x'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][$cnt1]['hp'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][$cnt1]['hp_dmg']['y'],$pr_vars['priem_team_f'][$cnt1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][$cnt1]['priem'] = 73;
		  $pr_vars['priem_team_f'][$cnt1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][$cnt1]['on'] = $uid;
		  $pr_vars['priem_team_f'][$cnt1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['krituet'] = true;
	  }
	 
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 60) {
	  //Слесарь-зомби 
	  
	  //ослабить удар
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Бесчувственность
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Бесчувственность';
  	  $pr_vars['priem_use'][0]['id'] = 141;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //
	  if( rand(0,100) < 25 )
	  {
		  //Метнуть болт
		  if( !isset($this->stats[$this->uids[$uid2]]['noeffectbattle1']) && true == false) {
			  $pr_vars['priem_team_f'][0]['chance'] = 100;
			  $pr_vars['priem_team_f'][0]['name'] = 'Прочистить (снимает эффекты до конца боя)';
			  $pr_vars['priem_team_f'][0]['x'] = 1;
			  $pr_vars['priem_team_f'][0]['type'] = 3;	  
			  $pr_vars['priem_team_f'][0]['hp'] = 0;
			  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(1,5);
			  $pr_vars['priem_team_f'][0]['priem'] = 164;
			  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
			  $pr_vars['priem_team_f'][0]['on'] = $uid;
			  $pr_vars['priem_team_f'][0]['nomf'] = 0;
			  $pr_vars['priem_team_f'][0]['fiz'] = 1;
			  $pr_vars['priem_team_f'][0]['krituet'] = true;
			  mysql_query('INSERT INTO `battle_actions` (`btl`,`uid`,`time`,`vars`,`vals`) VALUES (
				"'.$this->info['id'].'","'.$uid2.'","'.time().'","noeffectbattle1","'.$uid1.'"
			  )');
		  }
	  }
	  //Двойной удар
	  if( rand(0,100) < 10 ) {
		  //
		  $cnt1 = count($pr_vars['priem_team_f']);
		  $pr_vars['priem_team_f'][$cnt1]['chance'] = 100;
		  $pr_vars['priem_team_f'][$cnt1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][$cnt1]['x'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][$cnt1]['hp'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][$cnt1]['hp_dmg']['y'],$pr_vars['priem_team_f'][$cnt1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][$cnt1]['priem'] = 73;
		  $pr_vars['priem_team_f'][$cnt1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][$cnt1]['on'] = $uid;
		  $pr_vars['priem_team_f'][$cnt1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['krituet'] = true;
		  //
		  $cnt1++;
		  $pr_vars['priem_team_f'][$cnt1]['chance'] = 100;
		  $pr_vars['priem_team_f'][$cnt1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][$cnt1]['x'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][$cnt1]['hp'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][$cnt1]['hp_dmg']['y'],$pr_vars['priem_team_f'][$cnt1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][$cnt1]['priem'] = 73;
		  $pr_vars['priem_team_f'][$cnt1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][$cnt1]['on'] = $uid;
		  $pr_vars['priem_team_f'][$cnt1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['krituet'] = true;
	  }
	 
}
elseif($this->users[$this->uids[$uid1]]['bot_id'] == 51) {
	//Лука
	  
	  //Мокрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Мокрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 32;
	  $pr_vars['priem_team_f'][0]['priem'] = 73;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 0;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;	  
	  //Ослабить удар
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
	  $pr_vars['priem_use'][0]['id'] = 1;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Мощный удар
	  $pr_vars['priem_use'][1]['chance'] = 10;
	  $pr_vars['priem_use'][1]['name'] = 'Мощный удар';
	  $pr_vars['priem_use'][1]['id'] = 2;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
}*/

//птп
if($this->users[$this->uids[$uid1]]['bot_id'] == 123)
{
	###Дарьяна Корт [8]
	###To Do: Вытягивание души
    if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
	{
  		$pr_vars['priem_regen']['hp'] = rand(50,350);
  		$pr_vars['priem_regen']['chance'] = 25;
  		$pr_vars['priem_regen']['name'] = 'Лечение';
	}

	$pr_vars['priem_use'][0]['chance'] = 25;
	$pr_vars['priem_use'][0]['name'] = 'Активная защита';
	$pr_vars['priem_use'][0]['id'] = 7;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][1]['chance'] = 3;
	$pr_vars['priem_use'][1]['name'] = 'Стойкость';
	$pr_vars['priem_use'][1]['id'] = 13;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][2]['chance'] = 3;
	$pr_vars['priem_use'][2]['name'] = 'Ярость';
	$pr_vars['priem_use'][2]['id'] = 14;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 124)
{
	###Изгнанник Мглы [9]
  $pr_vars['priem_use'][0]['chance'] = 25;
  $pr_vars['priem_use'][0]['name'] = 'Второе дыхание';
  $pr_vars['priem_use'][0]['id'] = 49;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][1]['chance'] = 25;
  $pr_vars['priem_use'][1]['name'] = 'Удар серпом';
  $pr_vars['priem_use'][1]['id'] = 219;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 25;
  $pr_vars['priem_use'][2]['name'] = 'Активная защита';
  $pr_vars['priem_use'][2]['id'] = 7;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][3]['chance'] = 25;
  $pr_vars['priem_use'][3]['name'] = 'Сильный удар';
  $pr_vars['priem_use'][3]['id'] = 15;
  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][4]['chance'] = 25;
  $pr_vars['priem_use'][4]['name'] = 'Слепая удача';
  $pr_vars['priem_use'][4]['id'] = 47;
  $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][5]['chance'] = 25;
  $pr_vars['priem_use'][5]['name'] = 'Стойкость';
  $pr_vars['priem_use'][5]['id'] = 13;
  $pr_vars['priem_use'][5]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][6]['chance'] = 25;
  $pr_vars['priem_use'][6]['name'] = 'Ярость';
  $pr_vars['priem_use'][6]['id'] = 14;
  $pr_vars['priem_use'][6]['on'] = $this->users[$this->uids[$uid1]];

	if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
	{
  		$pr_vars['priem_regen']['hp'] = 35;
  		$pr_vars['priem_regen']['chance'] = 15;
  		$pr_vars['priem_regen']['name'] = 'Воля к победе';
  	}
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 125)
{
	###Страж Крантон [9]
	//$pr_vars['priem_use'][0]['chance'] = 25;
	//$pr_vars['priem_use'][0]['name'] = 'Удар правым жвалом';//чинить
	//$pr_vars['priem_use'][0]['id'] = 216;
	//$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][1]['chance'] = 25;
	$pr_vars['priem_use'][1]['name'] = 'Удачный удар';
	$pr_vars['priem_use'][1]['id'] = 11;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][2]['chance'] = 25;
	$pr_vars['priem_use'][2]['name'] = 'Коварный уход';
	$pr_vars['priem_use'][2]['id'] = 213;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = 'Стойкость';
	$pr_vars['priem_use'][3]['id'] = 13;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][4]['chance'] = 25;
	$pr_vars['priem_use'][4]['name'] = 'Ярость';
	$pr_vars['priem_use'][4]['id'] = 14;
	$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];

	if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
	{
  		$pr_vars['priem_regen']['hp'] = 35;
  		$pr_vars['priem_regen']['chance'] = 45;
  		$pr_vars['priem_regen']['name'] = 'Воля к победе';
  	}
}


/*
* Начало Бездны (Бездна)
* */
if($this->users[$this->uids[$uid1]]['bot_id'] == 356)
{
	###Страж Дайтон [9] - Бездна 1 этаж
	  
	if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
	{
  		$pr_vars['priem_regen']['hp'] = 35;
  		$pr_vars['priem_regen']['chance'] = 15;
  		$pr_vars['priem_regen']['name'] = 'Воля к победе';
  	}
	
	  $pr_vars['priem_team_f'][0]['chance'] = 3;
	  $pr_vars['priem_team_f'][0]['name'] = 'Удар правым жвалом';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(125,450);
	  $pr_vars['priem_team_f'][0]['priem'] = 216;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
	  
	$pr_vars['priem_use'][1]['chance'] = 35;
	$pr_vars['priem_use'][1]['name'] = 'Ярость';
	$pr_vars['priem_use'][1]['id'] = 14;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	//$pr_vars['priem_use'][2]['chance'] = 23;
	//$pr_vars['priem_use'][2]['name'] = 'Коварный уход';
	//$pr_vars['priem_use'][2]['id'] = 213;
	//$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][3]['chance'] = 20;
	$pr_vars['priem_use'][3]['name'] = 'Удачный удар';
	$pr_vars['priem_use'][3]['id'] = 11;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

}

if($this->users[$this->uids[$uid1]]['bot_id'] == 355)
{
	### Кошмар Глубин [12] - Бездна 3 этаж

	// Подставить лоб - аналог Полной Защите
	$pr_vars['priem_use'][0]['chance'] = 20;
	$pr_vars['priem_use'][0]['name'] = 'Подставить лоб';
	$pr_vars['priem_use'][0]['id'] = 45;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// Раздавить - аналог Скрытой Силе.
	$pr_vars['priem_use'][1]['chance'] = 25;
	$pr_vars['priem_use'][1]['name'] = 'Раздавить';
	$pr_vars['priem_use'][1]['id'] = 216;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	// Удар Хвостом - наносит моментальный урон.
	$pr_vars['priem_team_f'][0]['chance'] = 25;
	$pr_vars['priem_team_f'][0]['name'] = 'Удар Хвостом';
	$pr_vars['priem_team_f'][0]['x'] = 1;
	$pr_vars['priem_team_f'][0]['type'] = 3;
	$pr_vars['priem_team_f'][0]['hp'] = 0;
	$pr_vars['priem_team_f'][0]['hp_dmg'] = rand(35,40);
	$pr_vars['priem_team_f'][0]['priem'] = 164;
	$pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	$pr_vars['priem_team_f'][0]['on'] = $uid;
	$pr_vars['priem_team_f'][0]['nomf'] = 0;
	$pr_vars['priem_team_f'][0]['fiz'] = 1;
	$pr_vars['priem_team_f'][0]['krituet'] = true;

	$pr_vars['priem_use'][2]['chance'] = 25;
	$pr_vars['priem_use'][2]['name'] = 'Стойкость';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = 'Ярость';
	$pr_vars['priem_use'][3]['id'] = 14;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
}

/*if($this->users[$this->uids[$uid1]]['bot_id'] == 152)
{*/
### Ольгерт Вирт [10] - Бездна 2 этаж
/*
* 1 удар, 3 блока. Профильный урон: дробящий, стихийные атаки: огонь.
в начале боя - Отрицание Силы - аналог Неуязвимость оружию или Отрицание Слова - аналог Неуязвимость стихиям
Сильный удар,
Активная защита
Обречённость,
Ошеломить
Стойкость,
Ярость

При достижении 85%НР начинает действовать Усталость, с каждым потеряным 1%НР усталость увеличивается на 1% - из-за усталости урон снижается, максимум до 33%.
В конце боя использует Последняя Воля - Сгинуть вместе с врагами - зарядов у приёма 8 или 10. У вас остаётся 8 или 10 ходов чтоб убить его, иначе он убьёт всех вместе с собой.
*/
/*
	// Сильный удар.
	$pr_vars['priem_use'][0]['chance'] = 20;
	$pr_vars['priem_use'][0]['name'] = 'Сильный удар';
	$pr_vars['priem_use'][0]['id'] = 4;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// Активная защита.
	$pr_vars['priem_use'][1]['chance'] = 20;
	$pr_vars['priem_use'][1]['name'] = 'Активная защита';
	$pr_vars['priem_use'][1]['id'] = 7;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	// Стойкость.
	$pr_vars['priem_use'][2]['chance'] = 20;
	$pr_vars['priem_use'][2]['name'] = 'Стойкость';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	// Ярость.
	$pr_vars['priem_use'][3]['chance'] = 20;
	$pr_vars['priem_use'][3]['name'] = 'Ярость';
	$pr_vars['priem_use'][3]['id'] = 14;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	// Обречённость, срабатывает если у цели родной ловкости больше 30-ти...
	if( (int)$u->lookStats($this->users[$this->uids[$uid2]]['stats'])['s2'] > 30) {
		$pr_vars['priem_use'][4]['chance'] = 22;
		$pr_vars['priem_use'][4]['name'] = 'Обречённость';
		$pr_vars['priem_use'][4]['id'] = 204;
		$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
	}
	//Ошеломить, срабатывает если у цели родного мудрости больше 10-ти...
	if( (int)$u->lookStats($this->users[$this->uids[$uid2]]['stats'])['s5'] > 10) {
		$pr_vars['priem_use'][4]['chance'] = 22;
		$pr_vars['priem_use'][4]['name'] = 'Ошеломить';
		$pr_vars['priem_use'][4]['id'] = 189;
		$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
	}

	$pr_vars['hp'] = mysql_fetch_array(mysql_query('SELECT hp as `Now`, hpAll as `All` FROM `battle_users` WHERE `uid` = "'.$uid1.'" LIMIT 1'));
	$pr_vars['hp']['Ustalost'] = round(85 - ($pr_vars['hp']['Now'] / ($pr_vars['hp']['All']/100))) ;
	// Усталость
	if( $pr_vars['hp']['Now'] != 0 AND $pr_vars['hp']['Now'] / ($pr_vars['hp']['All']/100) < 85  ) {
		if( $pr_vars['hp']['Ustalost'] > 0 ){
			if($pr_vars['hp']['Ustalost'] > 33){
				$pr_vars['hp']['Ustalost'] = 33;
			}
			$pr_vars['hp']['exist'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `delete` = "0" AND `id_eff` = "5" AND `uid` = "'.$uid1.'" LIMIT 1'));
			if($pr_vars['hp']['exist']) { // Если существует
				mysql_query('UPDATE `eff_users` SET `data` = "add_m10=-'.$pr_vars['hp']['Ustalost'].'0", `name` = "Усталость -'.$pr_vars['hp']['Ustalost'].'%" WHERE `delete` = "0" AND `id_eff` = "5" AND `uid` = "'.$uid1.'" LIMIT 1');
			} else { // Если не существует
				mysql_query('INSERT INTO `eff_users` (`id_eff`, `uid`, `img2`, `name`, `data`, `user_use`,`timeUse`, `delete`, `v1`, `v2`, `x`, `no_Ace`) VALUES (5, '.$uid1.', "eff_travma.gif", "Усталость -'.$pr_vars['hp']['Ustalost'].'%", "add_m10=-'.$pr_vars['hp']['Ustalost'].'0", "'.$uid1.'","77", "0", "priem", "292", "1", "1")');
			}
		}
	}
	unset($pr_vars['hp']);
	
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 156) {
### Забытый [12] - Бездна 3 этаж
}*/

if($this->users[$this->uids[$uid1]]['bot_id'] == 158)
{
	### Гарл Йонни Салистон [9] - Бездна 3 этаж

	// Хлебнуть Крови - аналог Полной Защите
	$pr_vars['priem_use'][0]['chance'] = 16;
	$pr_vars['priem_use'][0]['name'] = 'Хлебнуть Крови';
	$pr_vars['priem_use'][0]['id'] = 240;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// Слепая удача.
	$pr_vars['priem_use'][1]['chance'] = 25;
	$pr_vars['priem_use'][1]['name'] = 'Слепая удача';
	$pr_vars['priem_use'][1]['id'] = 47;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	// Ярость - лечится на 3000HP.
	//$pr_vars['priem_regen']['hp'] = 3000;
	//$pr_vars['priem_regen']['chance'] = 4;
	//$pr_vars['priem_regen']['name'] = 'Ярость';
}

//if($this->users[$this->uids[$uid1]]['bot_id'] == 261) {
### Рубака Глубин [9] - Бездна 1-3 этаж
/*  (650HP)
Сила: 50
Ловкость: 15
Интуиция: 60
Выносливость: 30
Интеллект: 5
Мудрость: 0
1 удар 2 блока. Профильный урон: рубящий, стихийные атаки: вода (у 8х).
* */
	
//}
//if($this->users[$this->uids[$uid1]]['bot_id'] == 345) {
### Рубака Глубин [8] - Бездна 1-3 этаж
/* (500HP)
Сила: 30
Ловкость: 25
Интуиция: 50
Выносливость: 30
Интеллект: 0
Мудрость: 0
1 удар 2 блока. Профильный урон: рубящий, стихийные атаки: вода (у 8х).
* */
	
//}
//if($this->users[$this->uids[$uid1]]['bot_id'] == 346) {
### Литейщик [7] - Бездна 1-3 этаж
/* (450HP)
Сила: 50
Ловкость: 25
Интуиция: 20
Выносливость: 30
Интеллект: 0
Мудрость: 0
1 удар, 2 блока. Профильный урон: дробящий.
*/
	
//}
//if($this->users[$this->uids[$uid1]]['bot_id'] == 347) {
### Литейщик [8] - Бездна 1-3 этаж
/* (500HP)
Сила: 30
Ловкость: 30
Интуиция: 50
Выносливость: 30
Интеллект: 0
Мудрость: 0
1 удар, 2 блока. Профильный урон: дробящий.
Место рождения: Бездна
*/
	
//}
//if($this->users[$this->uids[$uid1]]['bot_id'] == 348) {
### Надзиратель Глубин [9] - Бездна 1-3 этаж
/*(600HP)
Сила: 50
Ловкость: 50
Интуиция: 20
Выносливость: 30
Интеллект: 10
Мудрость: 0
1 удар 2 блока. Профильный урон: рубящий, стихийные атаки: вода (у 8х).
 */
	
//}
//if($this->users[$this->uids[$uid1]]['bot_id'] == 349) {
### Надзиратель Глубин [8] - Бездна 1-3 этаж
/* (375HP)
Сила: 40
Ловкость: 50
Интуиция: 35
Выносливость: 30
Интеллект: 0
Мудрость: 0
1 удар 2 блока. Профильный урон: рубящий, стихийные атаки: вода (у 8х).
*/
	
//}
if($this->users[$this->uids[$uid1]]['bot_id'] == 350)
{
	//Служитель глубин 8
	if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
	{
  		$pr_vars['priem_regen']['hp'] = 35;
  		$pr_vars['priem_regen']['chance'] = 15;
  		$pr_vars['priem_regen']['name'] = 'Воля к победе';
  	}

	  $pr_vars['priem_team_f'][0]['chance'] = 20;
	  $pr_vars['priem_team_f'][0]['name'] = 'Проклятье Бездны';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(15,100);
	  $pr_vars['priem_team_f'][0]['priem'] = 216;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 351)
{
	### Служитель Глубин [9] - Бездна 1-3 этаж
	if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
	{
  		$pr_vars['priem_regen']['hp'] = 35;
  		$pr_vars['priem_regen']['chance'] = 15;
  		$pr_vars['priem_regen']['name'] = 'Воля к победе';
  	}
	
	  $pr_vars['priem_team_f'][0]['chance'] = 20;
	  $pr_vars['priem_team_f'][0]['name'] = 'Проклятье Бездны';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(15,100);
	  $pr_vars['priem_team_f'][0]['priem'] = 216;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 352)
{
	### Большой Тяжелый Молот [9] - Бездна 3 этаж
	// Удачный удар.
	$pr_vars['priem_use'][0]['chance'] = 25;
	$pr_vars['priem_use'][0]['name'] = 'Удачный удар';
	$pr_vars['priem_use'][0]['id'] = 11;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// Активная защита.
	$pr_vars['priem_use'][1]['chance'] = 20;
	$pr_vars['priem_use'][1]['name'] = 'Активная защита';
	$pr_vars['priem_use'][1]['id'] = 7;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	// Стойкость.
	$pr_vars['priem_use'][2]['chance'] = 20;
	$pr_vars['priem_use'][2]['name'] = 'Стойкость';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	// Ярость.
	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = 'Ярость';
	$pr_vars['priem_use'][3]['id'] = 14;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
}

//if($this->users[$this->uids[$uid1]]['bot_id'] == 353) {
### Служитель Бездны [9] - Бездна 3 этаж
/* (1200HP)
Сила: 50
Ловкость: 15
Интуиция: 15
Выносливость: 50
Интеллект: 0
Мудрость: 0
1 удар 2 зоны блоков. Профильный урон: дробящий, стихийные атаки: огонь.
Использует приёмы:
"Проклятье Бездны" - каст магией тьмы.
"Камнепад" - каст магией земли, на всю команду.
"Аура Святости" - аналог "Призрачной Защиты"
"Воля К Победе" .
 * */
	
//}
//if($this->users[$this->uids[$uid1]]['bot_id'] == 355) {
### Проклятие Глубин [8] - Бездна 2 этаж
/* (800HP)
В количестве: 8 шт.
Сила: 80
Ловкость: 3
Интуиция: 3
Выносливость: 40
Интеллект: 0
Мудрость: 0
1 удар 2 блока. Профильный урон: дробящий, стихийная атака: огонь. Воскресают (примерно через час после смерти).
Обладает толстой бронёй.
 */
	
//}

/*
* Конец Бездны (Бездна)
* */

if($this->users[$this->uids[$uid1]]['bot_id'] == 126)
{
	###Маул Счастливчик [8]
  
  $pr_vars['priem_use'][0]['chance'] = 15;
  $pr_vars['priem_use'][0]['name'] = 'Удар Феникса';
  $pr_vars['priem_use'][0]['id'] = 216;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][1]['chance'] = 15;
  $pr_vars['priem_use'][1]['name'] = 'Слепая удача';
  $pr_vars['priem_use'][1]['id'] = 47;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 15;
  $pr_vars['priem_use'][2]['name'] = 'Активная защита';
  $pr_vars['priem_use'][2]['id'] = 7;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][3]['chance'] = 15;
  $pr_vars['priem_use'][3]['name'] = 'Стойкость';
  $pr_vars['priem_use'][3]['id'] = 13;
  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][4]['chance'] = 15;
  $pr_vars['priem_use'][4]['name'] = 'Ярость';
  $pr_vars['priem_use'][4]['id'] = 14;
  $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
}

/*if($this->users[$this->uids[$uid1]]['bot_id'] == 132) {
###Каменный страж [9]
###To Do : Раздавить, Сотрясение
  

}

if($this->users[$this->uids[$uid1]]['bot_id'] == 133) {
###Дух-Хранитель [10]
###To Do : Призрачное касание
}*/

if($this->users[$this->uids[$uid1]]['bot_id'] == 134)
{
	###Заблудшая Душа [10]
	###To Do : Призрачный удар, Крик души
  $pr_vars['priem_use'][0]['chance'] = 3;
  $pr_vars['priem_use'][0]['name'] = 'Призрачная защита';
  $pr_vars['priem_use'][0]['id'] = 141;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
}

/*if($this->users[$this->uids[$uid1]]['bot_id'] == 135) {
###Механик [9]
###To Do : Починить
  
  
}*/

if($this->users[$this->uids[$uid1]]['bot_id'] == 136)
{
	###Механический Голем [9]
	###To Do : Вспышка, Обнять
  $pr_vars['priem_use'][0]['chance'] = 3;
  $pr_vars['priem_use'][0]['name'] = 'Оттеснить';
  $pr_vars['priem_use'][0]['id'] = 212;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}

/*if($this->users[$this->uids[$uid1]]['bot_id'] == 139) {
###Страж Сокровищ [11]
###To Do : Сотрясение, Проклятье стража, Раздавить, Сотрясение мозга
  

}

if($this->users[$this->uids[$uid1]]['bot_id'] == 141) {
###Механический Убийца [10]
###To Do : Взрыв, Глубокая рана
  
  
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 142) {
###Мастер Грит [11]
###To Do : Холодный Луч, Оюжигающее пламя, Тяжесть земли, Молния, Истинная форма, Самоуничтожение, Двойной удар, Оглушающий удар
  
  
}*/

if($this->users[$this->uids[$uid1]]['bot_id'] == 143)
{
	###Механический Охранник [10]
	###To Do : Вспышка, Обнять
  $pr_vars['priem_use'][0]['chance'] = 3;
  $pr_vars['priem_use'][0]['name'] = 'Оттеснить';
  $pr_vars['priem_use'][0]['id'] = 212;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 376)
{
  ###Древнее проклятие Глубин [9]
  $pr_vars['priem_regen']['hp'] = 18;
  $pr_vars['priem_regen']['chance'] = 7;
  $pr_vars['priem_regen']['name'] = 'Утереть пот';

  $pr_vars['priem_use'][0]['chance'] = 3;
  $pr_vars['priem_use'][0]['name'] = 'Подставить лоб';
  $pr_vars['priem_use'][0]['id'] = 45;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][1]['chance'] = 3;
  $pr_vars['priem_use'][1]['name'] = 'Раздавить';
  $pr_vars['priem_use'][1]['id'] = 216;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 3;
  $pr_vars['priem_use'][2]['name'] = 'Активная защита';
  $pr_vars['priem_use'][2]['id'] = 7;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][3]['chance'] = 3;
  $pr_vars['priem_use'][3]['name'] = 'Удачный удар';
  $pr_vars['priem_use'][3]['id'] = 11;
  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][4]['chance'] = 3;
  $pr_vars['priem_use'][4]['name'] = 'Стойкость';
  $pr_vars['priem_use'][4]['id'] = 13;
  $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][5]['chance'] = 3;
  $pr_vars['priem_use'][5]['name'] = 'Ярость';
  $pr_vars['priem_use'][5]['id'] = 14;
  $pr_vars['priem_use'][5]['on'] = $this->users[$this->uids[$uid1]];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 284)
{
	###Жора
	if(rand(0,100) <= 10) {
		$tp = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%Пришпилить%" AND `delete` = 0 LIMIT 1'));
		$name = '<b>Пришпилить x'.(1+$tp['x']).'</b>';
		if(!isset($tp['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","'.$name.'","add_m10=-33|add_m8=-20|add_m6=-20|add_m2=-250|add_m4=-400|add_m5=-500","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","hp_natisk.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+3),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}elseif($tp['x'] < 5) {
			mysql_query('UPDATE `eff_users` SET `name` = "'.$name.'", `data` = "add_m10=-'.(33+$tp['x']*33).'|add_m8=-'.(20+$tp['x']*20).'|add_m6=-'.(20+$tp['x']*20).'|add_m2=-'.(250+$tp['x']*250).'|add_m4=-'.(400+$tp['x']*400).'|add_m5=-'.(250+$tp['x']*250).' ", `x` = `x` + 1 WHERE `id` = "'.$tp['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+3),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}
	}
	//Гнилое дыхание(x5)
  	if(rand(0,100) <= 15) {
		$tp1 = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%Гнилое Дыхание%" AND `delete` = 0 LIMIT 1'));
		$name = '<b>Гнилое Дыхание x'.(1+$tp1['x']).'</b>';
		if(!isset($tp1['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","'.$name.'","add_za=-50|","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","wis_water_cloud08.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+7),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}elseif($tp1['x'] < 10) {
			mysql_query('UPDATE `eff_users` SET `data` = "add_za=-'.(50+$tp['x']*50).'| ", `x` = `x` + 1 WHERE `id` = "'.$tp1['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+7),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}
	}
	
	//Сожрать
	/* if($hp <= 1) {
		$this->stats[$this->uids[$uid1]]['hpNow'] += $this->stats[$this->uids[$uid2]]['hpNow'];
		//жора
		mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid1]]['id'].' LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>'','text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} восстановил здоровье, с помощью приема <b>&quot;Сожрать&quot;<font color=green> + '.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'&nbsp;</b></font> ['.$this->stats[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
		$this->add_log($mas);
	} */
	
  $pr_use = 1; 
  
  
  $pr_vars['priem_use'][1]['chance'] = 15;
  $pr_vars['priem_use'][1]['name'] = 'Удачный удар';
  $pr_vars['priem_use'][1]['id'] = 11;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][3]['chance'] = 35;
  $pr_vars['priem_use'][3]['name'] = 'Ярость';
  $pr_vars['priem_use'][3]['id'] = 14;
  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
  
  
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 254)
{
	###берсерк
  	if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
	{
  		$pr_vars['priem_regen']['hp'] = 75;
  		$pr_vars['priem_regen']['chance'] = 20;
  		$pr_vars['priem_regen']['name'] = 'Регенерация';
	}

	$pr_vars['priem_use'][0]['chance'] = 10;
	$pr_vars['priem_use'][0]['name'] = 'Удачный удар';
	$pr_vars['priem_use'][0]['id'] = 11;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][1]['chance'] = 25;
	$pr_vars['priem_use'][1]['name'] = 'Ярость';
	$pr_vars['priem_use'][1]['id'] = 14;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][2]['chance'] = 30;
	$pr_vars['priem_use'][2]['name'] = 'Раздробить череп';
	$pr_vars['priem_use'][2]['id'] = 219;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
}

//==========================Туманные низины===================================//
if($this->users[$this->uids[$uid1]]['bot_id'] == 703)
{
	//Болотный Тролль
  	if( $this->stats[$this->uids[$uid1]]['hpNow'] <= $this->stats[$this->uids[$uid1]]['hpAll'] * 0.5 )
	{
        $pr_vars['priem_regen']['chance'] = 8;
		$pr_vars['priem_regen']['hp'] = 3000;
  		$pr_vars['priem_regen']['name'] = 'Регенерация';
	}

  	$pr_vars['priem_one']['chance'] = 7;
    $pr_vars['priem_one']['hpdmg'] = rand(300,400);
  	$pr_vars['priem_one']['name'] = 'Взмах дубиной';

    $pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = 'Кровожадность';
	$pr_vars['priem_use'][0]['id'] = 305;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][1]['chance'] = 10;
	$pr_vars['priem_use'][1]['name'] = 'Бешенство';
	$pr_vars['priem_use'][1]['id'] = 604;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][2]['chance'] = 10;
  	$pr_vars['priem_use'][2]['name'] = 'Шкура Поглощения';
	$pr_vars['priem_use'][2]['id'] = 175;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
    $pr_vars['priem_use'][2]['rand1'] = 570;
    $pr_vars['priem_use'][2]['rand2'] = 1200;
    $pr_vars['priem_use'][2]['limit'] = 5;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 704)
{
	//Голодный Кровосос
	$pr_vars['priem_team_f'][0]['chance'] = 15;
	$pr_vars['priem_team_f'][0]['name'] = 'Высосать';
	$pr_vars['priem_team_f'][0]['x'] = 1;
	$pr_vars['priem_team_f'][0]['type'] = 6;
	$pr_vars['priem_team_f'][0]['hp_dmg'] = rand(100,300);
	$pr_vars['priem_team_f'][0]['hp'] = round($pr_vars['priem_team_f'][0]['hp_dmg']/2);
	$pr_vars['priem_team_f'][0]['priem'] = 160;
	$pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	$pr_vars['priem_team_f'][0]['on'] = $uid;
	$pr_vars['priem_team_f'][0]['nomf'] = 0;
	$pr_vars['priem_team_f'][0]['fiz'] = 0;
	$pr_vars['priem_team_f'][0]['krituet'] = false;
	$pr_vars['priem_team_f'][0]['hpregen'] = true;
	$pr_vars['priem_team_f'][0]['hpregen05'] = true;

	$pr_vars['priem_use'][0]['chance'] = 40;
	$pr_vars['priem_use'][0]['name'] = 'Болотная Атрофия';
	$pr_vars['priem_use'][0]['id'] = 605;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
    $pr_vars['priem_use'][0]['hodout'] = 20;

	/*if($uid2==3309821)
	{
		$pr_vars['priem_use'][0]['chance'] = 100;
		$pr_vars['priem_use'][0]['name'] = 'Болотная Атрофия';
		$pr_vars['priem_use'][0]['id'] = 605;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
    	$pr_vars['priem_use'][0]['hodout'] = 1;
	}*/

	$pr_vars['priem_use'][1]['chance'] = 10;
	$pr_vars['priem_use'][1]['name'] = 'ВИЗГ Отрицания';
	$pr_vars['priem_use'][1]['id'] = 607;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
    $pr_vars['priem_use'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
    $pr_vars['priem_use'][1]['limit'] = 10;

	$pr_vars['priem_mana']['chance'] = 20;
    $pr_vars['priem_mana']['mppr'] = 10;
  	$pr_vars['priem_mana']['name'] = 'Воронка отрицания';
    $pr_vars['priem_mana']['team'] = $this->users[$this->uids[$uid2]]['team'];

	$pr_vars['priem608']['chance'] = 15;
    $pr_vars['priem608']['dmg'] = rand(50,80);
  	$pr_vars['priem608']['name'] = 'Ядовитая Аура';
    $pr_vars['priem608']['team'] = $this->users[$this->uids[$uid2]]['team'];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 705)
{
	//Мародёр патрульный
    $pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = 'Кровожадность';
	$pr_vars['priem_use'][0]['id'] = 305;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

    $pr_vars['priem_use'][1]['chance'] = 20;
	$pr_vars['priem_use'][1]['name'] = 'Пробой Защиты';
	$pr_vars['priem_use'][1]['id'] = 603;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][2]['chance'] = 15;
	$pr_vars['priem_use'][2]['name'] = 'Абсолютный щит';
	$pr_vars['priem_use'][2]['id'] = 175;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
    $pr_vars['priem_use'][2]['rand1'] = 650;
    $pr_vars['priem_use'][2]['rand2'] = 750;
    $pr_vars['priem_use'][2]['limit'] = 5;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 706)
{
	//Мародёр разведчик
    $pr_vars['priem_use'][0]['chance'] = 15;
  	$pr_vars['priem_use'][0]['name'] = 'Мастер Клинков';
  	$pr_vars['priem_use'][0]['id'] = 601;
  	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][1]['chance'] = 15;
  	$pr_vars['priem_use'][1]['name'] = 'Изворотливость';
  	$pr_vars['priem_use'][1]['id'] = 602;
  	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][2]['chance'] = 40;
	$pr_vars['priem_use'][2]['name'] = 'Парализующий дротик';
	$pr_vars['priem_use'][2]['id'] = 606;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid2]];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 707)
{
	//Мародёр шаман
    $pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = 'Метеорит';
	$pr_vars['priem_use'][0]['id'] = 124;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
    $pr_vars['priem_use'][0]['data'] = 'atgm=199';

	$pr_vars['priem_use'][1]['chance'] = 10;
	$pr_vars['priem_use'][1]['name'] = 'Тишина';
	$pr_vars['priem_use'][1]['id'] = 607;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
    $pr_vars['priem_use'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];

    $pr_vars['priem609']['chance'] = 10;
  	$pr_vars['priem609']['name'] = 'Болотное Заживление';
    $pr_vars['priem609']['team'] = $this->users[$this->uids[$uid1]]['team'];

	$pr_vars['priem610']['chance'] = 10;
	$pr_vars['priem610']['name'] = 'Заряженный Штормовой Щит';
    $pr_vars['priem610']['dmg'] = rand(1,167);
	$pr_vars['priem610']['team'] = $this->users[$this->uids[$uid2]]['team'];

	$pr_vars['priem608']['chance'] = 10;
    $pr_vars['priem608']['dmg'] = rand(50,80);
  	$pr_vars['priem608']['name'] = 'Штормовой Щит';
    $pr_vars['priem608']['team'] = $this->users[$this->uids[$uid2]]['team'];
    $pr_vars['priem608_add610'] = true;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 708)
{
	//Проклятье болот
    $pr_vars['priem_one']['chance'] = 10;
	$pr_vars['priem_one']['hpdmg'] = 100;
  	$pr_vars['priem_one']['name'] = 'Пожрать';

    $pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = 'Раскол Брони';
	$pr_vars['priem_use'][0]['id'] = 600;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][1]['chance'] = 10;
  	$pr_vars['priem_use'][1]['name'] = 'Шкура Поглощения';
	$pr_vars['priem_use'][1]['id'] = 175;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
    $pr_vars['priem_use'][1]['rand1'] = 350;
    $pr_vars['priem_use'][1]['rand2'] = 600;
	$pr_vars['priem_use'][1]['limit'] = 3;
}
//==========================Туманные низины===================================//

//====================================================================//

if(!function_exists('rand_user_team'))
{
	function rand_user_team($tm, $tp)
	{
	  global $btl;
	  $r = array();
	  $i = 0;
	  while($i < count($btl->users)) {
		if($btl->users[$i]['team'] == $tm && $tp == 1) {
		  $r[] = $btl->users[$i]['id'];
		} elseif($btl->users[$i]['team'] != $tm && $tp == 2) {
		  $r[] = $btl->users[$i]['id'];
		}
		$i++;
	  }
	  if(count($r) == 0) {
		$r = 0;
	  } else {
		$r = rand(0,count($r)-1);
	  }
	  return $r;
	}
}

	
  if($pr_use > 0)// && (count($pr_vars['priem_use']) || count($pr_vars['priem_team_f']) || count($pr_vars['priem_regen']) || count($pr_vars['priem_one']) || count())
  {
	//priem_use , priem_team_f , priem_regen БОТ ИСПОЛЬЗУЕТ ТОЛЬКО 1 ПРИЕМ

	//Удаляем приемы с нулевой вероятностью
    if(is_array($pr_vars['priem_use']))
	{
		$count = count($pr_vars['priem_use']);
		for($n = 0; $n < $count; $n++) if(!$pr_vars['priem_use'][$n]['chance']) unset($pr_vars['priem_use'][$n]);
    	$pr_vars['priem_use'] = array_values($pr_vars['priem_use']);
	}

	//Удаляем приемы с нулевой вероятностью
	if(is_array($pr_vars['priem_team_f']))
	{
		$count = count($pr_vars['priem_team_f']);
		for($n = 0; $n < $count; $n++) if(!$pr_vars['priem_team_f'][$n]['chance']) unset($pr_vars['priem_team_f'][$n]);
    	$pr_vars['priem_team_f'] = array_values($pr_vars['priem_team_f']);
	}

	if( (rand(0,1) == 1 && count($pr_vars['priem_use'])) || !count($pr_vars['priem_team_f']) )
	{
		$pr_vars['priem_use'] = $pr_vars['priem_use'][rand(0,count($pr_vars['priem_use'])-1)];
		$pr_vars['priem_use'] = array( 0 => $pr_vars['priem_use'] );
		unset($pr_vars['priem_team_f']);
	}else{
			$pr_vars['priem_team_f'] = $pr_vars['priem_team_f'][rand(0,count($pr_vars['priem_team_f'])-1)];
			$pr_vars['priem_team_f'] = array( 0 => $pr_vars['priem_team_f'] );
			unset($pr_vars['priem_use']);
	}

    //Приемы безответного урона
    if(isset($pr_vars['priem_one']) && $pr_vars['priem_one']['chance']*10000 >= rand(0, 1000000))
	{
        pr($pr_vars['priem_one']['name'].'['.$pr_vars['priem_one']['chance'].'%]');

		$hpNow = $this->stats[$this->uids[$uid2]]['hpNow'] - $pr_vars['priem_one']['hpdmg'];
		if($hpNow < 0) $hpNow = 0;

		$this->users[$this->uids[$uid2]]['hpNow'] = $hpNow;
		$this->stats[$this->uids[$uid2]]['hpNow'] = $hpNow;
		mysql_query('UPDATE `stats` SET `hpNow` = '.$hpNow.' WHERE `id` = "'.$uid2.'" LIMIT 1');

		$dmg = ' <b><font color=#006699>-'.$pr_vars['priem_one']['hpdmg'].'</font></b> ['.ceil($hpNow).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';

		if(!isset($pr_vars['priem_one']['no_chat']))
		{
          $pr_vars['mas']['text'] = '{tm1} {u1} {1x16x0} заклинание &quot;<b><font color=#006699>'.$pr_vars['priem_one']['name'].'</font></b>&quot; и поразил магией тьмы {u2}</font>'.$dmg;
		  $pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		  $pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		  $this->add_log($pr_vars['mas']);
		}

		//Пропуск хода - противник ударил, пишем что игрок 2 пропустил ход
        $a1 = mysql_fetch_assoc(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$btl->info['id'].'"
		AND `uid1` = "'.$uid2.'" AND `uid2` = "'.$uid1.'" LIMIT 1'));
		mysql_query('UPDATE `battle_act` SET `out2` = "1",`tpo2` = "1" WHERE `id` = "'.$a1['id'].'" LIMIT 1');
		//pr($uid1);
		$a1['out2'] = 1;
		$a1['tpo2'] = 1;
		$btl->atacks[$a1['id']] = $a1;
		/*$btl->users[$u->info['id']]['priems_z'] = $u->info['priems_z'];*/
		$btl->startAtack($a1['id']);

		//бьем противника с пропуском хода
		//pr($btl->info['id']);
        //$minitime = round(microtime(true) * 1000);
		//mysql_query('INSERT INTO `battle_act` (`battle`,`uid1`,`uid2`,`time`,`minitime`,`out1`,`type`,`tpo1`)
		//VALUES ("'.$btl->info['id'].'","'.$uid2.'","'.$uid1.'","'.time().'","'.$minitime.'","1","1","2")');
		//ex();

		unset($pr_vars['priem_team_f'], $pr_vars['priem_use'], $pr_vars['priem_mana'],$pr_vars['priem_regen'],$pr_vars['priem_regen2']);
		unset($pr_vars['priem608'],$pr_vars['priem609'],$pr_vars['priem610']);
    }

    //Прием Болотное Заживление
    if(isset($pr_vars['priem609']) && $pr_vars['priem609']['chance']*10000 >= rand(0, 1000000))
	{
		pr($pr_vars['priem609']['name'].'['.$pr_vars['priem609']['chance'].'%]');

		$usr =  mysql_fetch_array(mysql_query('SELECT `uid` FROM `battle_users`
		WHERE `battle`="'.$this->info['id'].'" AND `team`="'.$pr_vars['priem609']['team'].'" AND `hp` > "0" ORDER BY RAND() LIMIT 1'));

		$hpRegen = ($usr['uid'] == $uid1 ? 400 : 300);
		$hpNow = $this->users[$this->uids[$usr['uid']]]['hpNow'] + $hpRegen;
		if($hpNow > $this->stats[$this->uids[$usr['uid']]]['hpAll']) $hpNow = $this->stats[$this->uids[$usr['uid']]]['hpAll'];

		$this->users[$this->uids[$usr['uid']]]['hpNow'] = $hpNow;
		$this->stats[$this->uids[$usr['uid']]]['hpNow'] = $hpNow;
		mysql_query('UPDATE `stats` SET `hpNow` = '.$hpNow.' WHERE `id` = "'.$usr['uid'].'" LIMIT 1');

		$pr_vars['mas']['text'] = '{tm1} {u1} использовал заклинание &quot;<b>'.$pr_vars['priem609']['name'].'</b>&quot; и восстановил ';
		$pr_vars['mas']['text'] .= ($usr['uid'] == $uid1 ? 'свое здоровье' : 'здоровье персонажа {u2}').'.';
		$pr_vars['mas']['text'] .= ' <b><font color=#006699>+'.$hpRegen.'</font></b> ['.$hpNow.'/'.$this->stats[$this->uids[$usr['uid']]]['hpAll'].']';
		$pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$usr['uid']]]['sex'].'||t2='.$this->users[$this->uids[$usr['uid']]]['team'].'||login2='.$this->users[$this->uids[$usr['uid']]]['login'].'';
		$pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$this->add_log($pr_vars['mas']);
            
		unset($pr_vars['priem_team_f'], $pr_vars['priem_use'],$pr_vars['priem_regen'],$pr_vars['priem_regen2'],$pr_vars['priem_mana']);
        unset($pr_vars['priem608'],$pr_vars['priem610']);
    }

	//Прием ядовитая аура, штормовой щит - нужна проверка на маг урон!
    if(isset($pr_vars['priem608']) && $pr_vars['priem608']['chance']*10000 >= rand(0, 1000000))
	{
        $limit_users = rand(2,5);

		pr($pr_vars['priem608']['name'].'['.$pr_vars['priem608']['chance'].'%] игроков: '.$limit_users);
		
        $usr = mysql_query('SELECT * FROM `battle_users` WHERE `battle`="'.$this->info['id'].'"
		AND `team`="'.$pr_vars['priem608']['team'].'" AND `hp` > "0" LIMIT '.$limit_users);

		while( $users = mysql_fetch_array($usr) )
		{
			$hpDmg = $pr_vars['priem608']['dmg'];
			$hpNow = $this->stats[$this->uids[$users['uid']]]['hpNow'] - $hpDmg;
			if($hpNow < 0) $hpNow = 0;

			$this->users[$this->uids[$users['uid']]]['hpNow'] = $hpNow;
			$this->stats[$this->uids[$users['uid']]]['hpNow'] = $hpNow;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$hpNow.' WHERE `id` = "'.$users['uid'].'" LIMIT 1');

			if(!isset($pr_vars['priem608']['no_chat']))
			{
	          $dmg = ' <b><font color=#006699>-'.$hpDmg.'</font></b> ['.ceil($hpNow).'/'.$this->stats[$this->uids[$users['uid']]]['hpAll'].']';
              $pr_vars['mas']['text'] = '{tm1} {u1} {1x16x0} заклинание &quot;<b><font color=#006699>'.$pr_vars['priem608']['name'].'</font></b>&quot; и поразил магией тьмы {u2}</font>'.$dmg;
			  $pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$users['uid']]]['sex'].'||t2='.$this->users[$this->uids[$users['uid']]]['team'].'||login2='.$this->users[$this->uids[$users['uid']]]['login'].'';
			  $pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			  $this->add_log($pr_vars['mas']);
			}

			$uteam = $this->users[$this->uids[$users['uid']]]['team'];
		}

		//Вызываем Заряженный Штормовой Щит
		if(isset($pr_vars['priem608_add610']))
		{
            $usr2 =  mysql_fetch_array(mysql_query('SELECT `uid` FROM `battle_users`
			WHERE `battle`="'.$this->info['id'].'" AND `team`="'.$uteam.'" AND `hp` > "0" ORDER BY RAND() LIMIT 1'));

			$pr_uron = rand(1,167);
			$hpNow = $this->stats[$this->uids[$usr2['uid']]]['hpNow'] - $pr_uron;
			if($hpNow < 0) $hpNow = 0;

			$this->users[$this->uids[$usr2['uid']]]['hpNow'] = $hpNow;
			$this->stats[$this->uids[$usr2['uid']]]['hpNow'] = $hpNow;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$hpNow.' WHERE `id` = "'.$usr2['uid'].'" LIMIT 1');

	        $dmg = ' <b><font color=#006699>-'.$pr_uron.'</font></b> ['.ceil($hpNow).'/'.$this->stats[$this->uids[$usr2['uid']]]['hpAll'].']';
            $pr_vars['mas']['text'] = '{tm1} {u1} {1x16x0} заклинание &quot;<b><font color=#006699>Заряженный Штормовой Щит</font></b>&quot; и поразил магией тьмы {u2}'.$dmg;
			$pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$usr2['uid']]]['sex'].'||t2='.$this->users[$this->uids[$usr2['uid']]]['team'].'||login2='.$this->users[$this->uids[$usr2['uid']]]['login'].'';
			$pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$this->add_log($pr_vars['mas']);

            //Вызываем Проклятье Болот с шансом 5% - в разарботке
		}

		unset($pr_vars['priem_team_f'], $pr_vars['priem_use'],$pr_vars['priem_regen'],$pr_vars['priem_regen2'],$pr_vars['priem_mana'], $pr_vars['priem610']);
    }

	//Заряженный Штормовой Щит - нужна проверка на маг урон!
    if(isset($pr_vars['priem610']) && $pr_vars['priem610']['chance']*10000 >= rand(0, 1000000))
	{
		pr($pr_vars['priem610']['name'].'['.$pr_vars['priem610']['chance'].'%]');

		$usr =  mysql_fetch_array(mysql_query('SELECT `uid` FROM `battle_users`
		WHERE `battle`="'.$this->info['id'].'" AND `team`="'.$pr_vars['priem610']['team'].'" AND `hp` > "0" ORDER BY RAND() LIMIT 1'));

		$pr_uron = $pr_vars['priem610']['dmg'];
		$hpNow = $this->stats[$this->uids[$usr['uid']]]['hpNow'] - $pr_uron;
		if($hpNow < 0) $hpNow = 0;

		$this->users[$this->uids[$pr_vars['priem610']['on']]]['hpNow'] = $hpNow;
		$this->stats[$this->uids[$pr_vars['priem610']['on']]]['hpNow'] = $hpNow;
		mysql_query('UPDATE `stats` SET `hpNow` = '.$hpNow.' WHERE `id` = "'.$usr['uid'].'" LIMIT 1');

        $dmg = ' <b><font color=#006699>-'.$pr_uron.'</font></b> ['.ceil($hpNow).'/'.$this->stats[$this->uids[$usr['uid']]]['hpAll'].']';
        $pr_vars['mas']['text'] = '{tm1} {u1} {1x16x0} заклинание &quot;<b><font color=#006699>'.$pr_vars['priem610']['name'].'</font></b>&quot; и поразил магией тьмы {u2}'.$dmg;
		$pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$usr['uid']]]['sex'].'||t2='.$this->users[$this->uids[$usr['uid']]]['team'].'||login2='.$this->users[$this->uids[$usr['uid']]]['login'].'';
		$pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$this->add_log($pr_vars['mas']);

		unset($pr_vars['priem_team_f'], $pr_vars['priem_use'],$pr_vars['priem_regen'],$pr_vars['priem_regen2'],$pr_vars['priem_mana']);
    }

	//Прием ворует ману у команды
    if(isset($pr_vars['priem_mana']) && $pr_vars['priem_mana']['chance']*10000 >= rand(0, 1000000))
	{
        pr($pr_vars['priem_mana']['name'].'['.$pr_vars['priem_mana']['chance'].'%]');

        $usr = mysql_query('SELECT * FROM `battle_users` WHERE `battle`="'.$this->info['id'].'"
		AND `team`="'.$pr_vars['priem_mana']['team'].'" AND `hp` > "0"');

		while( $users = mysql_fetch_array($usr) )
		{
			$mpDmg = round($this->stats[$this->uids[$users['uid']]]['mpAll']/100 * $pr_vars['priem_mana']['mppr']);
			$mpNow = $this->stats[$this->uids[$users['uid']]]['mpNow'] - $mpDmg;
			if($mpNow < 0) $mpNow = 0;

			$this->users[$this->uids[$users['uid']]]['mpNow'] = $mpNow;
			$this->stats[$this->uids[$users['uid']]]['mpNow'] = $mpNow;
			mysql_query('UPDATE `stats` SET `mpNow` = '.$mpNow.' WHERE `id` = "'.$users['uid'].'" LIMIT 1');

			if(!isset($pr_vars['priem_mana']['no_chat']))
			{
				$dmg = ' <b><font title=Тип&nbsp;урона:&nbsp;Тьма color=#006699>-'.$mpDmg.'</font></b> ['.ceil($mpNow).'/'.$this->stats[$this->uids[$users['uid']]]['mpAll'].']';
                $pr_vars['mas']['text'] = '{tm1} {u1} {1x16x0} заклинание &quot;<b><font color=#006699>'.$pr_vars['priem_mana']['name'].'</font></b>&quot; и поразил магией тьмы {u2}'.$dmg;
				$pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$users['uid']]]['sex'].'||t2='.$this->users[$this->uids[$users['uid']]]['team'].'||login2='.$this->users[$this->uids[$users['uid']]]['login'].'';
				$pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				$this->add_log($pr_vars['mas']);
			}
		}

		unset($pr_vars['priem_team_f'], $pr_vars['priem_use'],$pr_vars['priem_regen'],$pr_vars['priem_regen2']);
    }

	//Восстановление здоровья на всю команду
	$i = 0;
	while($i < count($pr_vars['priem_team_f']))
	{
	  {
	    $xx = 0; $ix = 0;
		$pl = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `activ` != "-1" AND `id` = "'.$pr_vars['priem_team_f'][$i]['priem'].'" LIMIT 1'));
		while($ix < count($this->users))
		{
		  if($this->stats[$ix]['hpNow'] > 0 && $this->users[$ix]['team'] == $pr_vars['priem_team_f'][$i]['team'] && $xx < $pr_vars['priem_team_f'][$i]['x'])
		  {
		    if(isset($pl['id']))
			{
              pr($pr_vars['priem_team_f'][$i]['name'].'['.$pr_vars['priem_team_f'][$i]['chance'].'%]');

			  $pr_vars['priem_team_f'][$i]['hp_dmg'] = $this->testYronPriem( $uid1, $uid2, 12, $pr_vars['priem_team_f'][$i]['hp_dmg'], -1, true );
			  $as = $priem->magicAtack($this->users[$ix], $pr_vars['priem_team_f'][$i]['hp_dmg'], $pr_vars['priem_team_f'][$i]['type'], $pl, array('user_use' => $this->users[$this->uids[$uid1]]['id']), 0, 0, $pr_vars['priem_team_f'][0]['fiz'], $pr_vars['priem_team_f'][$i]['nomf'], $pr_vars['priem_team_f'][0]['krituet'], $this->users[$this->uids[$uid1]]['id'],$pr_vars['priem_team_f'][$i]['name']);

			  if($as && isset($pr_vars['priem_team_f'][$i]['hpregen']))
			  {
                if(isset($pr_vars['priem_team_f'][$i]['hp']) || isset($pr_vars['priem_team_f'][$i]['hp_dmg']))
				{
                  if($pr_vars['priem_team_f'][$i]['hpregen05'])
				  {
					$as05 = round($as[0]/2);
					$n_hp = $this->stats[$this->uids[$uid1]]['hpNow'] + $as05;
                    $hp_vis = '+'.$as05;
                  }
				  elseif(isset($pr_vars['priem_team_f'][$i]['hp_dmg']))
				  {
                    $n_hp = $this->stats[$this->uids[$uid1]]['hpNow']+$as[0];
                    $hp_vis = '+'.$as[0];
                  } else {
					$n_hp = $this->stats[$this->uids[$uid1]]['hpNow']+$pr_vars['priem_team_f'][$i]['hp'];
                    $hp_vis = '+'.$pr_vars['priem_team_f'][$i]['hp'];

                  }
                  if($n_hp > $this->stats[$this->uids[$uid1]]['hpAll']) $n_hp = $this->stats[$this->uids[$uid1]]['hpAll'];

                  $uid_b = $this->users[$this->uids[$uid1]]['id'];
                  $this->users[$this->uids[$uid1]]['hpNow'] = $n_hp;
                  $this->stats[$this->uids[$uid1]]['hpNow'] = $n_hp;
                  mysql_query('UPDATE `stats` SET `hpNow` = '.$n_hp.' WHERE `id` = "'.$uid_b.'" LIMIT 1');

				  $pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_team_f'][$i]['name'].'</b>&quot; и восстановил свое здоровье. <b><font color=#006699>'.$hp_vis.'</font></b> ['.$this->users[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
                  $pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
                  $pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
                  $this->add_log($pr_vars['mas']);
                }
			  }
            }
			$xx++;
		  }
		  $ix++;
		}
	  }
	  $i++;	
	}

	//Восстановление здровья
    if(isset($pr_vars['priem_regen']) && $pr_vars['priem_regen']['chance']*10000 >= rand(0, 1000000))
	{
        pr($pr_vars['priem_regen']['name'].'['.$pr_vars['priem_regen']['chance'].'%]');

		$pr_vars['hp_u1'] += $pr_vars['priem_regen']['hp'];
		if($pr_vars['priem_regen']['hp'] > 0) $pr_vars['priem_regen']['hp'] = '+'.$pr_vars['priem_regen']['hp'];
		$this->users[$this->uids[$uid1]]['hpNow'] = $pr_vars['hp_u1'];
		$this->stats[$this->uids[$uid1]]['hpNow'] = $pr_vars['hp_u1'];

		mysql_query('UPDATE `stats` SET `hpNow` = '.$pr_vars['hp_u1'].' WHERE `id` = "'.$uid2.'" LIMIT 1');
		if( $pr_vars['hp_u1'] > $this->stats[$this->uids[$uid1]]['hpAll'] ) $pr_vars['hp_u1'] = $this->stats[$this->uids[$uid1]]['hpAll'];

		$pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_regen']['name'].'</b>&quot; и восстановил свое здоровье. <b><font color=#006699>'.$pr_vars['priem_regen']['hp'].'</font></b> ['.ceil($pr_vars['hp_u1']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
		$pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$this->add_log($pr_vars['mas']);
    }

	//Восстановление маны
    if(isset($pr_vars['priem_regen2']) && $pr_vars['priem_regen2']['chance']*10000 >= rand(0, 1000000))
	{
        pr($pr_vars['priem_regen2']['name'].'['.$pr_vars['priem_regen2']['chance'].'%]');

		$pr_vars['mp_u1'] += $pr_vars['priem_regen2']['mp'];
		if($pr_vars['priem_regen2']['mp'] > 0) $pr_vars['priem_regen2']['mp'] = '+'.$pr_vars['priem_regen2']['mp'];
		$this->users[$this->uids[$uid1]]['mpNow'] = $pr_vars['mp_u1'];
		$this->stats[$this->uids[$uid1]]['mpNow'] = $pr_vars['mp_u1'];
        
		mysql_query('UPDATE `stats` SET `mpNow` = '.$pr_vars['mp_u1'].' WHERE `id` = "'.$uid1.'" LIMIT 1');
		if( $pr_vars['mp_u1'] > $this->stats[$this->uids[$uid1]]['mpAll'] ) $pr_vars['mp_u1'] = $this->stats[$this->uids[$uid1]]['mpAll'];

		$pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_regen2']['name'].'</b>&quot; и восстановил свою ману. <b><font color=#006699>'.$pr_vars['priem_regen2']['mp'].'</font></b> ['.ceil($pr_vars['mp_u1']).'/'.$this->stats[$this->uids[$uid1]]['mpAll'].']';
		$pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$this->add_log($pr_vars['mas']);
    }
	
	//Обычные приемы
	$i = 0;
	while($i < count($pr_vars['priem_use']))
	{
	  if($pr_vars['priem_use'][$i]['hodout'])//Интервал ходов между использованием приема
	  {
	  	$xu = $u->testAction('`uid`="'.$uid1.'" AND `vars` = "use_priem_'.$btl->info['id'].'_'.$pr_vars['priem_use'][$i]['id'].'" ORDER BY `id` DESC LIMIT 1',1);
        if($xu['vals'] < $this->hodID) unset($xu);
	  }

	  if(isset($pr_vars['priem_use'][$i]) && $pr_vars['priem_use'][$i]['chance']*10000 >= rand(0, 1000000) && !isset($xu[0]))
	  {
		$pl = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `activ` != "-1" AND `id` = "'.mysql_real_escape_string($pr_vars['priem_use'][$i]['id']).'" LIMIT 1'));
		
		if(isset($pl['id']))
		{
			pr($pr_vars['priem_use'][$i]['name'].'['.$pr_vars['priem_use'][$i]['chance'].'%]');

			if($pl['id'] == 290) $priem->magicAtack($pr_vars['priem_use'][$i]['on'], 100, $pr_vars['priem_use'][$i]['type'], $pl, array('user_use' => $uid1), 0, 0, 0, 0, true, $this->users[$this->uids[$uid1]]['id'], $pl['name']);

			$rcu = false; $mpr = false; $pld = array(0 => '');
	      	$j = $u->lookStats($pl['date2']);
		  	$uid = $this->users[$this->uids[$uid1]]['id'];

		  	if(isset($pr_vars['priem_use'][$i]['on']['id'])) $uid = $pr_vars['priem_use'][$i]['on']['id'];
		  	if(isset($j['onlyOne'])) $mpr = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `v2` = "'.$pl['id'].'" AND `uid` = "'.$uid.'" AND `delete` = 0 LIMIT 1'));

			if(isset($mpr['id']) && $j['onlyOne'] == 1)//Повтороное использование для приема без стаков
			{
				$priem->uppz($pl, $id);
				if(isset($pr_vars['priem_use'][$i]['on']['id'])) $this->stats[$this->uids[$uid]] = $u->getStats($pr_vars['priem_use'][$i]['on'], 0);
				else $this->stats[$this->uids[$uid]] = $u->getStats($this->users[$this->uids[$uid1]], 0);
			}
			elseif(!isset($mpr['id']))//Первое использование
			{
				if(isset($j['date3Plus'])) $data = $priem->redate($pl['date3'], $this->users[$this->uids[$uid1]]['id']);
				elseif($pr_vars['priem_use'][0]['data']) $data = $pr_vars['priem_use'][$i]['data'];
				else $data = '';

				if(isset($pr_vars['priem_use'][$i]['rand1']) && isset($j['date3Plus']))
				{
                    $pog_rand = rand($pr_vars['priem_use'][$i]['rand1'], $pr_vars['priem_use'][$i]['rand2']);
					$data = preg_replace('/add_pog2=([0-9])+\|/i', 'add_pog2='.$pog_rand.'|', $data);
				}

				if(isset($pr_vars['priem_use'][$i]['limit'])) $pl['limit'] = $pr_vars['priem_use'][$i]['limit'];//число ходов
				$hd1 = ($pl['limit'] > 0 ? $pl['limit'] : -1);

				if(isset($pr_vars['priem_use'][$i]['team']))//На всю команду
				{
					$usr = mysql_query('SELECT * FROM `battle_users` WHERE `battle`="'.$this->info['id'].'" AND `team`="'.$pr_vars['priem_use'][$i]['team'].'" AND `hp` > "0"');
                    while( $users = mysql_fetch_array($usr) )
					{
						$limit = ($users['uid']==$uid ? $hd1 + 1 : $hd1);
                        mysql_query('INSERT INTO `eff_users` (`hod`, `v2`, `img2`, `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `v1`, `user_use`)
						VALUES ("'.$limit.'", "'.$pl['id'].'", "'.$pl['img'].'.gif", 22, "'.$users['uid'].'", "'.$pr_vars['priem_use'][$i]['name'].'", "'.$data.'", 0, "77", "priem", "'.$this->users[$this->uids[$uid1]]['id'].'")');
					}
				} else {
                    	mysql_query('INSERT INTO `eff_users` (`hod`, `v2`, `img2`, `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `v1`, `user_use`)
						VALUES ("'.$hd1.'", "'.$pl['id'].'", "'.$pl['img'].'.gif", 22, "'.$uid.'", "'.$pr_vars['priem_use'][$i]['name'].'", "'.$data.'", 0, "77", "priem", "'.$this->users[$this->uids[$uid1]]['id'].'")');
				}

				unset($hd1);

				$priem->uppz($pl,$id);

				if(isset($pr_vars['priem_use'][$i]['on']['id'])) $this->stats[$this->uids[$uid]] = $u->getStats($pr_vars['priem_use'][$i]['on'], 0);
				else $this->stats[$this->uids[$uid]] = $u->getStats($this->users[$this->uids[$uid1]], 0);
				$rcu = true;
		  }
		  elseif($j['onlyOne'] > 1)//стаки
		  {
			if($mpr['x'] < $j['onlyOne'])
			{
			  if(isset($j['date3Plus']))
			  {
				$j1 = $u->lookStats($mpr['data']);
				$j2 = $u->lookStats($priem->redate($pl['date3'], $this->users[$this->uids[$uid1]]['id']));
				$v = $u->lookKeys($priem->redate($pl['date3'], $this->users[$this->uids[$uid1]]['id']), 0);
				$i56 = 0; $inf = '';

				while($i56 < count($v))
				{
				  $j1[$v[$i56]] += $j2[$v[$i56]];
				  $vi = str_replace('add_', '', $v[$i56]);

				  if($u->is[$vi] != '')
				  {
					if($j2[$v[$i56]] > 0) $inf .= $u->is[$vi].': +'.($j2[$v[$i56]]*(1+$mpr['x'])).', ';
					elseif($j2[$v[$i56]] < 0) $inf .= $u->is[$vi].': '.($j2[$v[$i56]]*(1+$mpr['x'])).', ';
				  }
				  $i56++;
				}

				$inf = rtrim($inf, ', ');
				$j1 = $u->impStats($j1);
				$pld[0] = ' x'.($mpr['x']+1);

				$upd = mysql_query('UPDATE `eff_users` SET `data` = "'.$j1.'", `x` = `x`+1 WHERE `id` = "'.$mpr['id'].'" LIMIT 1');
				if($upd)
				{
					$priem->uppz($pl, $id);
					$rcu = true;
				}
			  }
			}
		  }
		}

        if($pr_vars['priem_use'][$i]['hpdmg'])//Урон от приема
		{
			$hpNow = $this->stats[$this->uids[$uid2]]['hpNow'] - $pr_vars['priem_use'][$i]['hpdmg'];
			if($hpNow < 0) $hpNow = 0;

			$this->users[$this->uids[$uid2]]['hpNow'] = $hpNow;
			$this->stats[$this->uids[$uid2]]['hpNow'] = $hpNow;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$hpNow.' WHERE `id` = "'.$uid2.'" LIMIT 1');
		}

		if($rcu == true && !isset($pr_vars['priem_use'][$i]['no_chat']))//Логи
		{
    	  	if( $inf != '' ) $inf = '('.$inf.')';
			if(!$dmg) $dmg = '.';

        	if(isset($pr_vars['priem_use'][$i]['team']))//На всю команду
			{
				$usr = mysql_query('SELECT * FROM `battle_users` WHERE `battle`="'.$this->info['id'].'" AND `team`="'.$pr_vars['priem_use'][$i]['team'].'" AND `hp` > "0"');
		        while( $users = mysql_fetch_array($usr) )
				{
                  $pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_use'][$i]['name'].'</b>&quot;';
		          $pr_vars['mas']['text'] .= ($users['uid'] != $uid1 ? '  на персонажа {u2}'.$dmg : '.');
				  $pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$users['uid']]]['sex'].'||t2='.$this->users[$this->uids[$users['uid']]]['team'].'||login2='.$this->users[$this->uids[$users['uid']]]['login'].'';
                  $pr_vars['mas']['vLog'] .= '||prm='.$pr_vars['priem_use'][$i]['id'];
				  $pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				  $this->add_log($pr_vars['mas']);
				}
			} else {
            	$dmg = ' <b><font color=#006699>-'.$pr_vars['priem_use'][$i]['hpdmg'].'</font></b>';
				$dmg .= ' ['.ceil($hpNow).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';

				$pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_use'][$i]['name'].$pld[0].'</b>&quot;';
		    	$pr_vars['mas']['text'] .= ($this->users[$this->uids[$uid1]]['id'] != $uid ? '  на персонажа {u2}'.$dmg.'.' : '.');
		        if(isset($inf)) $pr_vars['mas']['text'] .= ' <small>'.$inf.'</small>';
			  	$pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  	$pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			  	$this->add_log($pr_vars['mas']);
		  }
		}

		if($pr_vars['priem_use'][$i]['hodout']) $u->addAction(time(),'use_priem_'.$btl->info['id'].'_'.$pr_vars['priem_use'][$i]['id'], ($this->hodID + $pr_vars['priem_use'][$i]['hodout']), $uid1);
	  }
	  $i++;
	}

	unset($pr_use, $pr_vars);
  }
}
?>