var loadingLogNow = true;
var vlogid = 0;
var battleClass = {
	battle:0,
	hod:0,
	conf:{
		timeout:'-- мин.',
		damage:'0',
		tactic:[ 0 , 0 , 0 , 0 , 0 , 0 , 0 ],
		priems:[],		
		pr:"",
		pr_z:"",
		pr_s:0
	},
	me:0,
	enemy:0,
	users:{ },
	uids:[0],
	priems:{ },
	prms:[0],
	eff:[],
	act:[],
	log:function(txt) {
		console.log(txt);
	},
	start:function() {
		this.reflesh(1);
	},
	reflesh:function( type ) {
		$.getJSON( '/getbattle.php',{ 'global':true,'type':type },function(data) {
			//
			if( data.e != undefined && data.e != "" ) {
				alert( 'Ошибка: ' + data.e );
			}
			//
			battleClass.me = data.you;
			battleClass.enemy = data.enemy;
			battleClass.battle = data.btl;
			battleClass.hod = data.hod;
			battleClass.conf.timeout = data.to;
			battleClass.conf.damage = data.dm;
			battleClass.conf.pr = data.pr[0];
			battleClass.conf.pr_z = data.pr[1];
			battleClass.conf.pr_s = data.pr[2];
			battleClass.conf.tactic = [ 0 , data.t1 , data.t2 , data.t3 , data.t4 , data.t5 , data.t6 , data.t7 ];
			//
			battleClass.eff = data.r.eff_me;
			battleClass.act = data.r.act;
			//
			//Пользователи
			if( data.r.u != undefined ) {
				var i = 0;
				while( i != -1 ) {
					if( data.r.u[i] != undefined ) {
						if( data.r.u[i][0] > 0 ) {
							//
							if( battleClass.users[data.r.u[i][0]] == undefined ) {
								battleClass.users[data.r.u[i][0]] = { 'complete':false };
								battleClass.uids[0]++;
								battleClass.uids[battleClass.uids[0]] = data.r.u[i][0];
							}
							battleClass.users[data.r.u[i][0]].id = data.r.u[i][0];
							//
							battleClass.users[data.r.u[i][0]].hp = data.r.u[i][1];
							battleClass.users[data.r.u[i][0]].mp = data.r.u[i][2];
							battleClass.users[data.r.u[i][0]].hpAll = data.r.u[i][3];
							battleClass.users[data.r.u[i][0]].mpAll = data.r.u[i][4];
							//
							if( battleClass.users[data.r.u[i][0]].hp > battleClass.users[data.r.u[i][0]].hpAll ) {
								battleClass.users[data.r.u[i][0]].hp = battleClass.users[data.r.u[i][0]].hpAll;
							}
							if( battleClass.users[data.r.u[i][0]].mp > battleClass.users[data.r.u[i][0]].mpAll ) {
								battleClass.users[data.r.u[i][0]].mp = battleClass.users[data.r.u[i][0]].mpAll;
							}
							//
						}else{
							battleClass.log( 'Ошибка, игрок не найден...' );
						}
					}else{
						i = -2;
					}
					i++;
				}
				battleClass.loadingGlobaldata();
			}
			//
		});
	},
	loadingGlobaldata:function() {
		var r = {
			'load':0,
			'users':"0",
			'priems':"0"
		};
		//Обновляем пользователей которых не прогрузили
		/*
			Склонность, Клан, Уровень, Логин, Команда
		*/
		var i = 1;
		while( i <= battleClass.uids[0] ) {
			if( battleClass.users[ battleClass.uids[i] ].complete == false ) {
				//Прогружаем данные игрока
				r.load++;
				r.users = r.users + "," + battleClass.users[ battleClass.uids[i] ].id;
			}else{
				//Все окей
				
			}
			i++;
		}
		
		//Приемы
		var pr = battleClass.conf.pr.split('|');
		var prz = battleClass.conf.pr_z.split('|');
		var i = 0;
		while( i < battleClass.conf.pr_s ) {
			if( pr[i] != undefined && pr[i] > 0 ) {
				if( battleClass.priems[pr[i]] == undefined ) {
					//Прогружаем данные по приемам
					r.load++;
					r.priems += ',' + pr[i];
				}else{
					//Все окей
				}
			}
			i++;
		}
		
		//
		
		if( r.load > 0 ) {
			
			$.getJSON( '/getbattle.php',{ 'loading':true , 'uload':r.users , 'pload':r.priems },function(data) {
				//
				if( data.e != undefined && data.e != "" ) {
					alert( 'Ошибка: ' + data.e );
				}
				//
				if( data.r != undefined ) {
					//+++++++++++++++++++++++++++++
					
					battleClass.log(data);
					
					
					//Загрузка пользователей
					if( data.r.ul != undefined ) {
						//
						var i = 0;
						while( i != -1 ) {
							if( data.r.ul[i] != undefined ) {
								if( data.r.ul[i].id > 0 ) {
									//
									if( battleClass.users[data.r.ul[i].id] == undefined ) {
										battleClass.users[data.r.ul[i].id] = { };
										battleClass.uids[0]++;
										battleClass.uids[battleClass.uids[0]] = data.r.ul[i].id;
									}
									battleClass.users[data.r.ul[i].id] = data.r.ul[i];
									//
									battleClass.users[data.r.ul[i].id].complete = true;
									//
								}else{
									battleClass.log( 'Ошибка, игрок не найден...' );
								}
							}else{
								i = -2;
							}
							i++;
						}
						//
					}
					
					//Загрузка приемов
					if( data.r.pl != undefined ) {
						//
						var i = 0;
						while( i != -1 ) {
							if( data.r.pl[i] != undefined ) {
								if( data.r.pl[i].id > 0 ) {
									//
									if( battleClass.priems[data.r.pl[i].id] == undefined ) {
										battleClass.priems[data.r.pl[i].id] = { };
										battleClass.prms[0]++;
										battleClass.prms[battleClass.prms[0]] = data.r.pl[i].id;
									}
									battleClass.priems[data.r.pl[i].id] = data.r.pl[i];
									//
									battleClass.priems[data.r.pl[i].id].complete = true;
									//
								}else{
									battleClass.log( 'Ошибка, прием не найден...' );
								}
							}else{
								i = -2;
							}
							i++;
						}
						//
					}
					
					battleClass.generate();
					
					//+++++++++++++++++++++++++++++
				}
				//
			});
		}else{
			battleClass.generate();
		}
		//
		
	},
	loadLog:function(url) {
		var loadingLogNow = false;
		$('#battle_log').remove();
		var e = document.createElement("script");
		e.src = url;
		e.id  = 'battle_log';
		e.type="text/javascript";
		document.getElementsByTagName("head")[0].appendChild(e); 
	},
	testAct:function(uid1,uid2) {
		var r = false;
		var i = 0;
		while( i != -1 ) {
			if( this.act[i] != undefined ) {
				if( this.act[i][1] == uid1 && this.act[i][2] == uid2 ) {
					r = true;
				}
			}else{
				i = -2;
			}
			i++;
		}
		return r;
	},
	userInfoItems:function(id,t) {
		var i = 0;
		while( i != - 1 ) {
			if( this.users[id].itm[i] != undefined ) {
				//
				title  = '<center><b>'+this.users[id].itm[i][3]+'</b>';
				title += '<br><i>(Характеристики скрыты)</i>';
				title += '</center>';
				//
				var cvs = '';
				if( id == this.me ) {
					cvs = this.users[id].itm[i][5];
				}
				//
				abitms(t,id,this.users[id].itm[i][0],this.users[id].itm[i][2],this.users[id].itm[i][3],title,this.users[id].itm[i][4],cvs);
			}else{
				i = -2;
			}
			i++;
		}
	},
	userInfoEffects:function(id,t) {
		var i = 0;
		var html = '';
		if( this.eff != undefined ) {
			while( i != - 1 ) {
				if( this.eff[i] != undefined ) {
					if( this.eff[i][0] == id ) {
						var title_eff = '<b><u>'+this.eff[i][3]+'</u></b>';
						var eff_types = '(Эффект)';
						if( this.eff[i][5] > 0 && this.eff[i][5] < 7 ) {
							var eff_types = '(Эликсир)';
						}else if( (this.eff[i][5] > 6 && this.eff[i][5] < 11) || this.eff[i][5] == 16 ) {
							var eff_types = '(Заклятие)';
						}else if( this.eff[i][5] == 14 ) {
							var eff_types = '(Прием)';
						}else if( this.eff[i][5] == 15 ) {
							var eff_types = '(Изучение)';
						}else if( this.eff[i][5] == 17 ) {
							var eff_types = '(Проклятие)';
						}else if( this.eff[i][5] == 18 || this.eff[i][5] == 17 ) {
							var eff_types = '(Травма)';
						}else if( this.eff[i][5] == 20 ) {
							var eff_types = '(Пристрастие)';
						}else if( this.eff[i][5] == 22 ) {
							var eff_types = '(Ожидание)';
						}
						title_eff += ' ' + eff_types;
						html = '<div class="pimg" pog="0" col="0" stl="0" stt="'+title_eff+'"><img src="//img.testcombats.ru/i/eff/'+this.eff[i][4]+'"></div>'+html;
					}
				}else{
					i = -2;
				}
				i++;
			}
		}
		return html;
	},
	userInfo:function(id,t) {
		var stats_title = '';
		stats_title += '<b>'+this.users[id].login+'</b><br>';
		stats_title += 'Сила: --<br>';
		stats_title += 'Ловкость: --<br>';
		stats_title += 'Интуиция: --<br>';
		stats_title += 'Выносливость: --<br>';
		
		var eff_data = this.userInfoEffects(id,t);
		
		return info_reflesh(t,id,'',this.users[id].obraz,this.users[id].hp,this.users[id].hpAll,this.users[id].mp,this.users[id].mpAll,0,0,eff_data,stats_title,0,'');
	},
	generate:function() {
		
		//Набито
		$('#nabito').html( this.conf.damage );
		
		//Таймаут
		$('#timer_out').html( this.conf.timeout );
		
		//Тактики
		var i = 1;
		while( i <= 7 ) {
			$('#tac'+i).html( ( 0 + parseInt(this.conf.tactic[i]) ));
			i++;
		}
		$('#tac7t').attr( { 'title':'Уровень духа: ' + this.conf.tactic[7] } );
		
		//Игрок
		$('#player1').html( this.userInfo(this.me,1) );
		$('#player1_login').html( this.microLogin(this.me,0) );
		this.userInfoItems(this.me,1);
		
		//Противник
		if( this.enemy > 0 ) {
			$('#player2').html( this.userInfo(this.enemy,2) );
			$('#player2_login').html( this.microLogin(this.enemy,0) + '&nbsp;' );
			this.userInfoItems(this.enemy,2);
		}else{
			$('#player2_login').html('');
			$('#player2').html('Нет противника...');
		}
		
		//Доп.функции
		shpb();
		
		//Приемы
		var pr_see = '';
		var pr = battleClass.conf.pr.split('|');
		var prz = battleClass.conf.pr_z.split('|');
		var i = 0;
		while( i < battleClass.conf.pr_s ) {
			if( pr[i] != undefined && pr[i] > 0 ) {
				if( battleClass.priems[pr[i]] != undefined ) {
					prm = battleClass.priems[pr[i]];
					cl = '';
					if( prm.type == 1 ) {
						var onuser = '';
						if( prm.onUser > 0 ) {
							cl = 'href="javascript:void(0);" onClick="top.priemOnUser('+i+',1,\''+prm.name+'\',\''+onuser+'\',\''+prm.img+'\');"';
						}else{
							cl = 'href="javascript:void(0);" onClick="usepriem('+i+',1,\''+prm.img+'\');"';
						}
					}else if( prm.type == 2 ) {
						cl = 'href="javascript:void(0);" onClick="usepriem('+i+',1,\''+prm.img+'\');"';
					}else if( prm.type == 3 ) {
						cl = 'href="javascript:void(0);" onClick="alert(\'Возможно используем?\');"';
					}
				}else{
					prm = {
						'id':pr[i],
						'name':"*Неизвестный прием №"+pr[i]+"*",
						'img':"clearPriem.gif"
					};
					cl = 'href="javascript:void(0);" onclick="alert(\'Прием не найден\');"';
				}
				pr_see += '<a '+cl+'><img style="margin-top:4px;margin-left:4px;" title="'+prm.name+'" src="//img.testcombats.ru/i/eff/'+prm.img+'.gif" width="40" height="25"></a>';
			}else{
				pr_see += '<img style="margin-top:4px;margin-left:4px;" title="Пустой слот приема" src="//img.testcombats.ru/i/items/w/clearPriem.gif" width="40" height="25">';
			}
			i++;
		}
		$('#priems').html( pr_see );
		delete pr_see;
		
		//Собираем команды
		var rd = '';
		var tms = [];
		var tmr = [0];
		var i = 1;
		while( i <= this.uids[0] ) {
			if( tms[this.users[ this.uids[i] ].team] == undefined ) {
				tmr[0]++;
				tms[this.users[ this.uids[i] ].team] = '';
				tmr[tmr[0]] = this.users[ this.uids[i] ].team;
			}
			if( this.users[ this.uids[i] ].hp > 0 ) {
				if( tms[this.users[ this.uids[i] ].team] != '' ) {
					tms[this.users[ this.uids[i] ].team] += ', ';
				}
				tms[this.users[ this.uids[i] ].team] += this.teamLogin(this.users[ this.uids[i] ].id,1);
			}
			i++;
		}
		var i = 1;
		while( i <= tmr[0] ) {
			if( tms[tmr[i]] != '' ) {
				if( rd != '' ) {
					rd += ' &nbsp;&nbsp;<b>против</b>&nbsp;&nbsp; ';
				}
				rd += '<img src="//img.testcombats.ru/i/lock3.gif" style="cursor:pointer"> ' + tms[tmr[i]];
			}
			i++;
		}
		$('#teams').html( rd );
		//
		//лог боя
		this.loadLog('/battle_logs/btl_'+this.battle+'.js?'+this.hod);
		this.logTimerX = 0;
		this.logUpdateNow();
		//
		//Раздел поединка
		if( this.testAct( this.me , this.enemy ) == true ) {
			mainstatus(1);
		}else{
			mainstatus(2);
		}
		//
	},
	lastvlogid:0,
	logTimer:null,
	logTimerX:0,
	logUpdateNow:function() {
		clearTimeout(this.logTimer);
		if( typeof logRefleshedCache == 'function' && loadingLogNow == true && this.lastvlogid < vlogid) {
			this.lastvlogid = vlogid;
			this.logTimerX = 0;
			$('#battle_logg').html('');
			logRefleshedCache();
		}else{
			this.logTimerX++;
			this.log('logUpdateNow-cycles');
			if( this.logTimerX < 101 ) {
				this.logTimer = setTimeout('battleClass.logUpdateNow();',20);
			}else{
				this.logTimerX = 0;
			}
		}
	},
	teamLogin:function(id,type) {
		var r = '';
		if( this.users[id].align != undefined && this.users[id].align > 0 ) {
		//	r += '<img src="//img.testcombats.ru/i/align/align'+this.users[id].align+'.gif">';
		}
		if( this.users[id].clan != undefined && this.users[id].clan > 0 ) {
		//	r += '<img src="//img.testcombats.ru/i/clan/'+this.users[id].clan+'.gif">';
		}
		var stl = '';
		if( this.testAct(this.me,id) != false ) {
			//Ударили ожидаем ответа
			stl = '';
		}
		if( this.testAct(id,this.me) != false ) {
			//Ударили, нужно ответить 
			stl = 'text-decoration:underline;';
		}
		r += '<b style="'+stl+'" onclick="top.chat.addto(\''+this.users[id].login+'\',\'to\');" oncontextmenu="top.infoMenu(\''+this.users[id].login+'\',event,\'main\'); return false;" class="CSSteam'+this.users[id].team+'">'+this.users[id].login+'</b>';
		//
		r += '<small> ['+this.users[id].hp+'/'+this.users[id].hpAll+']</small>';
		//
		return r;
	},
	microLogin:function(id,type) {
		var r = '';
		if( this.users[id].align != undefined && this.users[id].align > 0 ) {
			r += '<img src="//img.testcombats.ru/i/align/align'+this.users[id].align+'.gif">';
		}
		if( this.users[id].clan != undefined && this.users[id].clan > 0 ) {
			r += '<img src="//img.testcombats.ru/i/clan/'+this.users[id].clan+'.gif">';
		}
		r += '<a href="javascript:void(0)" onclick="top.chat.addto(\''+this.users[id].login+'\',\'to\');" oncontextmenu="top.infoMenu(\''+this.users[id].login+'\',event,\'main\'); return false;">'+this.users[id].login+'</a> ['+this.users[id].level+']';
		r += '<a href="/info/'+this.users[id].id+'" target="_blank"><img title="Инф. о '+this.users[id].login+'" src="//img.testcombats.ru/i/inf_capitalcity.gif"></a>';
		return r;
	}
};