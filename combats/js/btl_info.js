var stl4 = { 1:0,2:0 };
stl4[1] = { 4:'',5:'',6:'' };
stl4[2] = { 4:'',5:'',6:'' };
function info_reflesh(id_info,uid,up_info,obraz,hp,hpAll,mp,mpAll,invis,sex,eff,ststua,align,zag)
{
	stl4[id_info] = { 4:'',5:'',6:'' }; img4 = ''; lst4 = 0;
	var d = document.getElementById('player'+id_info);
	if(d!=undefined)
	{
		var mbmp = '';
		var nomp = 0;
		var whp = Math.floor(hp/hpAll*120);
		var wmp = Math.floor(mp/mpAll*120);
		var chp = 'hp_3';
		var cmp = 'hp_mp';
		if(whp<1)
		{
			chp = 'hp_none';	
		}
		if(whp>0)
		{
			chp = 'hp_1';
		}
		if(whp>32)
		{
			chp = 'hp_2';
		}
		if(whp>65)
		{
			chp = 'hp_3';
		}
		if(wmp<=0)
		{
			cmp = 'hp_none';
		}
		if(mpAll>0)
		{
			mbmp = '	<div title="Уровень маны" class="seemp" style="position:absolute; top:10px; width:120px; height:10px; z-index:12;"> '+mp+'/'+mpAll+'</div>'+
			'	<div title="Уровень маны" class="hpborder" style="position:absolute; top:10px; width:120px; height:9px; z-index:13;"><img src="//'+top.c.img+'/1x1.gif" height="9" width="1"></div>'+
			'	<div class="'+cmp+' senohp" style="height:9px; position:absolute; top:10px; width:'+wmp+'px; z-index:11;" id="lmp4"><img src="//'+top.c.img+'/1x1.gif" height="9" width="1"></div>'+
			'	<div title="Уровень маны" class="hp_none" style="position:absolute; top:10px; width:120px; height:10px; z-index:10;"></div>';
		}else{
			nomp = 5;	
		} 
		if (align==9){
			hp = Math.floor(hp/(hpAll/100)); 
			hpAll = '100%';
		} 
		var zaggg = '',zggg1 = '',zggg2 = '',zggg3,zggg4 = '';
		if( zag != undefined && zag != 0 && zag != '' ) {
			zggg1 = 'class="inf2s"';
			zggg2 = 'position:relative;height:280px;';
			zggg3 = 'position:absolute;top:3px;left:3px;z-index:102;';
			zggg4 = 'display:none;';
			zaggg += '<style> .inf2s { position:relative; filter: alpha(opacity=10); -moz-opacity: 0.10; -khtml-opacity: 0.10; opacity: 0.10; } .inf2s:hover { background-color:#e2e0e0;filter: alpha(opacity=70); -moz-opacity: 0.70; -khtml-opacity: 0.70; opacity: 0.70; } </style>';
			zaggg += '<img style="position:absolute;top:1px;left:1px;z-index:100;" oncontextmenu="return false;" src="//img.testcombats.ru/i/zag/' + zag + '">';
		}
		document.getElementById('player'+id_info+'_login').innerHTML = up_info;
		d.innerHTML = '<div align="left">'+
		 ' <div style="width:240px; '+zggg2+' padding:2px; border-bottom:1px solid #666666; border-right:1px solid #666666; border-left:1px solid #FFFFFF; border-top:1px solid #FFFFFF;">'+
			zaggg+
			'<div align="center">'+
			'  <!-- blocked -->'+
			'</div>'+
			'<table style="'+zggg3+'" width="240" border="0" cellspacing="0" cellpadding="0">'+
			 ' <tr>'+
				'<td width="60" valign="top"><table width="60" height="280" border="0" cellspacing="0" cellpadding="0">'+
				 ' <tr>'+
					'<td '+zggg1+' height="60" id="'+id_info+'_itmSlot1"><img style="display:block;" title="Пустой слот шлем" src="//'+top.c.img+'/i/items/w/w9.gif" oncontextmenu="return false;"></td>'+
				 ' </tr>'+
				  '<tr>'+
				'	<td '+zggg1+' height="40" id="'+id_info+'_itmSlot2"><img style="display:block;" title="Пустой слот наручи" src="//'+top.c.img+'/i/items/w/w13.gif" oncontextmenu="return false;"></td>'+
				 ' </tr>'+
				 ' <tr>'+
				'<td '+zggg1+' height="60" id="'+id_info+'_itmSlot3"><img style="display:block;" title="Пустой слот оружие" src="//'+top.c.img+'/i/items/w/w3.gif" oncontextmenu="return false;"></td>'+
				 ' </tr>'+
				 ' <tr>'+
				'	<td '+zggg1+' height="80"><div id="'+id_info+'_itmSlot4"><img style="display:block;" title="Пустой слот броня" src="//'+top.c.img+'/i/items/w/w4.gif" oncontextmenu="return false;"></div></td>'+
				  '</tr>'+
				 ' <tr>'+
				'	<td '+zggg1+' height="40" id="'+id_info+'_itmSlot7"><img style="display:block;" title="Пустой слот пояс" src="//'+top.c.img+'/i/items/w/w5.gif" oncontextmenu="return false;"></td>'+
				  '</tr>'+
				'</table></td>'+
				'<td height="280" valign="top"><table width="120" height="280" border="0" cellspacing="0" cellpadding="0">'+
				  '<tr>'+
					'<td height="20" valign="top"><!-- HP and MP -->'+
					'	  <div style="position:relative;">'+
						'	<div title="Уровень жизни" class="seehp" style="position:absolute; top:'+nomp+'px; width:120px; height:10px; z-index:12;"> '+hp+'/'+hpAll+'</div>'+
							'<div title="Уровень жизни" class="hpborder" style="position:absolute; top:'+nomp+'px; width:120px; height:9px; z-index:13;"><img style="display:block;" src="//'+top.c.img+'/1x1.gif" height="9" width="1"></div>'+
						'	<div class="'+chp+' senohp" style="height:9px; width:'+whp+'px; position:absolute; top:'+nomp+'px; z-index:11;" id="lhp4"><img style="display:block;" src="//'+top.c.img+'/1x1.gif" height="9" width="1"></div>'+
						'	<div title="Уровень жизни" class="hp_none" style="position:absolute; top:'+nomp+'px; width:120px; height:10px; z-index:10;"><img style="display:block;" src="//'+top.c.img+'/1x1.gif" height="10"></div>'+
						 mbmp+
						 ' </div>'+
					'  <!-- -->'+
					'</td>'+
				 ' </tr>'+
				 ' <tr>'+
					'<td valign="top"><div style="position:relative; height:220px;">'+
					 ' <!-- образ -->'+
					 ' <div style="'+zggg4+'position:absolute; width:120px; height:220px; z-index:1;" onMouseOver="top.hi(this,\''+ststua+'\',event,0,1,1,1,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"><a href="#obraz_pers"><img style="display:block;" width="120" height="220" src="//'+top.c.img+'/i/obraz/'+sex+'/'+obraz+'" oncontextmenu="return false;" ></a></div>'+
					 ' <div style="position:absolute; width:auto; height:auto; z-index:3;">'+eff+'</div>'+
					'</div></td>'+
				'  </tr>'+
				 ' <tr>'+
				'	<td '+zggg1+' height="40"><table width="120" border="0" cellspacing="0" cellpadding="0">'+
						'<tr>'+
						 ' <td width="40" id="'+id_info+'_itmSlot53" height="20"><img style="display:block;" title="Пустой слот правый карман" src="//'+top.c.img+'/i/items/w/w15.gif" oncontextmenu="return false;"></td>'+
						 ' <td width="40" id="'+id_info+'_itmSlot55" height="20"><img style="display:block;" title="Пустой слот центральный карман" src="//'+top.c.img+'/i/items/w/w15.gif" oncontextmenu="return false;"></td>'+
						 ' <td width="40" id="'+id_info+'_itmSlot54" height="20"><img style="display:block;" title="Пустой слот левый карман" src="//'+top.c.img+'/i/items/w/w15.gif" oncontextmenu="return false;"></td>'+
						'</tr>'+
						'<tr>'+
						 ' <td width="40" id="'+id_info+'_itmSlot56" height="20"><img style="display:block;" title="Пустой слот смена" src="//'+top.c.img+'/i/items/w/w20.gif" oncontextmenu="return false;"></td>'+
						 ' <td width="40" id="'+id_info+'_itmSlot57" height="20"><img style="display:block;" title="Пустой слот смена" src="//'+top.c.img+'/i/items/w/w20.gif" oncontextmenu="return false;"></td>'+
						 '<td width="40" id="'+id_info+'_itmSlot58" height="20"><img style="display:block;" title="Пустой слот смена" src="//'+top.c.img+'/i/items/w/w20.gif" oncontextmenu="return false;"></td>'+
						'</tr>'+
					  '</table></td>'+
				 ' </tr>'+
				'</table></td>'+
				'<td width="60" valign="top"><table width="60" border="0" cellspacing="0" cellpadding="0">'+
				'  <tr>'+
				'	<td '+zggg1+' height="20" id="'+id_info+'_itmSlot8"><img style="display:block;" title="Пустой слот серьги" src="//'+top.c.img+'/i/items/w/w1.gif" oncontextmenu="return false;"></td>'+
				 ' </tr>'+
				 ' <tr>'+
				'	<td '+zggg1+' height="20" id="'+id_info+'_itmSlot9"><img style="display:block;" title="Пустой слот ожерелье" src="//'+top.c.img+'/i/items/w/w2.gif" oncontextmenu="return false;"></td>'+
				 ' </tr>'+
				 ' <tr>'+
					'<td '+zggg1+' height="20"><table width="60" border="0" cellspacing="0" cellpadding="0">'+
					'  <tr>'+
					'	<td '+zggg1+' width="20" id="'+id_info+'_itmSlot10" height="20"><img style="display:block;" title="Пустой слот кольцо" src="//'+top.c.img+'/i/items/w/w6.gif" oncontextmenu="return false;"></td>'+
					'	<td '+zggg1+' width="20" id="'+id_info+'_itmSlot11"><img style="display:block;" title="Пустой слот кольцо" src="//'+top.c.img+'/i/items/w/w6.gif" oncontextmenu="return false;"></td>'+
					'	<td '+zggg1+' width="20" id="'+id_info+'_itmSlot12"><img style="display:block;" title="Пустой слот кольцо" src="//'+top.c.img+'/i/items/w/w6.gif" oncontextmenu="return false;"></td>'+
					'  </tr>'+
					'</table></td>'+
				 ' </tr>'+
				 ' <tr>'+
				'	<td '+zggg1+' height="40" id="'+id_info+'_itmSlot13"><img style="display:block;" title="Пустой слот перчатки" src="//'+top.c.img+'/i/items/w/w11.gif" oncontextmenu="return false;"></td>'+
				'  </tr>'+
				 ' <tr>'+
				'	<td '+zggg1+' height="60" id="'+id_info+'_itmSlot14"><img style="display:block;" title="Пустой слот щит" src="//'+top.c.img+'/i/items/w/w10.gif" oncontextmenu="return false;"></td>'+
				 ' </tr>'+
				 ' <tr>'+
				'	<td '+zggg1+' height="80" id="'+id_info+'_itmSlot16"><img style="display:block;" title="Пустой слот поножи" src="//'+top.c.img+'/i/items/w/w19.gif" oncontextmenu="return false;"></td>'+
				 ' </tr>'+
				 ' <tr>'+
				'	<td '+zggg1+' height="40" id="'+id_info+'_itmSlot17"><img style="display:block;" title="Пустой слот обувь" src="//'+top.c.img+'/i/items/w/w12.gif" oncontextmenu="return false;"></td>'+
				'  </tr>'+
				'</table></td>'+
			  '</tr>'+
			'</table>'+
		 ' </div>'+
		'</div>';

		
	}
}
var img4 = '';
var lst4 = 0;
var hr = '<div align=\\\'center\\\' style=\\\'margin:4px;\\\'><img src=\\\'//'+top.c.img+'/1x1.gif\\\' height=\\\'1\\\' width=\\\'111\\\' style=\\\'background-color:black;\\\'></div>';
function abitms(id_pers,uid,id,slot,name,title,img,clck)
{
	if(slot>=4 && slot<=6)
	{
		if(slot==4 && lst4==0)
		{
			img4 = img;
			lst4 = 4;
		}else if(slot==5 && lst4<5)
		{
			img4 = img;
			lst4 = 5;
		}else if(slot==6 && lst4<6)
		{
			img4 = img;
			lst4 = 6;
		}
		stl4[id_pers][slot] = title;
		slot = 4;
		var ltt4 = '';
		if(stl4[id_pers][6]!='')
		{
			ltt4 += stl4[id_pers][6];
			if(stl4[id_pers][4]!='' || stl4[id_pers][5]!=''){ ltt4 += hr; }			
		}
		if(stl4[id_pers][5]!='')
		{
			ltt4 += stl4[id_pers][5];
			if(stl4[id_pers][4]!=''){ ltt4 += hr; }			
		}
		if(stl4[id_pers][4]!='')
		{
			ltt4 += stl4[id_pers][4];
		}
		title = ltt4;
		img = img4;
	}
	
	var itm = document.getElementById(id_pers+'_itmSlot'+slot);
	

	if(itm!=undefined)
	{
		if(clck != undefined && clck != '') {
			clck = 'cursor:pointer;" onclick="'+clck;
		}
		itm.innerHTML = '<img style="display:block;'+clck+'" src="//'+top.c.img+'/i/items/'+img+'" oncontextmenu="return false;" onMouseOver="top.hi(this,\''+title+'\',event,3,1,1,1,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">';
	}
}

/* function user_invis_items(id_pers) {
    try {
        
        document.getElementById(id_pers + '_itmSlots53_58').innerHTML = '<img style="display: block; margin-top: 1px; margin-left: 1px;" src="//img.old-combats.com/i/items/invis/slot_invis.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot1').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/helm.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot2').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/naruchi.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot3').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/weap.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot4').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/bron.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot7').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/belt.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot8').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/serg.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot9').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/ojur.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot10').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/ring.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot11').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/ring.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot12').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/ring.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot13').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/perchi.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot14').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/shit.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot16').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/leg.gif" oncontextmenu="return false;"/>';
        document.getElementById(id_pers + '_itmSlot17').innerHTML = '<img style="display: block" src="//img.old-combats.com/i/items/invis/boots.gif" oncontextmenu="return false;"/>';

        $('#' + id_pers + '_user_obraz').css('margin-left', '1px');
        $('#' + id_pers + '_user_hpmp').css('padding-left', '1px');
        
    } catch (err){
        console.warn('user_invis_items error: ', err)
    }
} */