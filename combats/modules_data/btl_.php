<?
if(!defined('GAME')) {
	die();
}

$old_battle = true;

include('jx/battle/log_text.php');

if( $old_battle == true ) {

if(isset($btl_last['id']) && $u->info['battle'] == 0) {
	$u->info['battle'] = $btl_last['battle'];
}
	$bType = $u->BattleType($u->BattleYron($u->info['battle']));
	echo '<script>var server_fight = "";</script>';
?>
<script src="/js/jquery.js" type="text/javascript"></script>
<link href="/btl_1.css" rel="stylesheet" type="text/css">
<script>
function maginfo(z,p,m,obj) {
	var r = '';
	r += '<b>'+$(obj).attr('magelogin')+'</b><br><br>';
	r += 'Мощь: '+m+', ';
	r += 'Защита: '+z+', ';
	r += 'Подавление: '+p+'';
	return r;	
}
<?
if(isset($btl_last['id']) && ( $u->info['battle'] == 0 || $u->info['battle'] == $btl_last['battle']) ) {
	echo 'var battleFinishData = "'.$u->info['battle_text'].'";';
	//$u->info['battle_text'] = '';
	if( isset($_GET['finish'])) {
		mysql_query('UPDATE `stats` SET `battle_text` = "",`last_b`="0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		mysql_query('UPDATE `battle_users` SET `finish` = 1 WHERE `uid` = "'.$u->info['id'].'"');
		header('location: main.php');
		die();
	}
}else{
	echo 'var battleFinishData = -1;';
}

?>
var noErTmr;
var smnpty = <?=(0+$u->info['smena'])?>;
setInterval('top.c.noEr = 0;',0);
function mbsum(event) {
	if(event.keyCode==13 && top.c.noEr==0)
		{
            if( document.getElementById('mainpanel').style.display == 'none' ) {
				reflesh();
			}else{
				atack();
			}
			top.c.noEr = 1; clearTimeout(top.c.noErTmr);
		}
		//space -32
		if(event.keyCode==32 && top.c.noEr==0){ reflesh(); top.c.noEr = 1; clearTimeout(top.c.noErTmr); }
	//numes
	if(event.keyCode==49) {
		change_radioKeys(1,false);
	}
	if(event.keyCode==50) {
		change_radioKeys(2,false);
	}
	if(event.keyCode==51) {
		change_radioKeys(3,false);
	}
	if(event.keyCode==52) {
		change_radioKeys(4,false);
	}
	if(event.keyCode==53) {
		change_radioKeys(5,false);
	}
	if(event.keyCode==48) {
		change_radioKeys(0,false);
	}
}

$(document.body).bind('keyup',function(event){ mbsum(event); });

function shpb() {
	$(document).find('div.pimg').unbind('mouseover');
	$(document).find('div.pimg').unbind('mouseout');
	$(document).find('div.pimg').unbind('mousedown');
	$(document).find('div.pimg').bind('mouseover',function(){ top.hi(this,$(this).attr('stt'),event,0,1,1,1,'stt'); });
	$(document).find('div.pimg').bind('mouseout',function(){ top.hic(); });
	$(document).find('div.pimg').bind('mousedown',function(){ top.hic(); });
	var test = $(document).find('div.pimg');
	var i = 0;
	while(i != -1) {
		if(test[i] != undefined) {
			if($(test[i]).attr('pog') > 1 && $(test[i]).attr('stl') == 0) {
				$(test[i]).attr('stl',1);
				$(test[i]).html('<span class="sp1">'+$(test[i]).attr('pog')+'</span><span class="sp4">'+$(test[i]).attr('pog')+'</span><span class="sp3">'+$(test[i]).attr('pog')+'</span><span class="sp2">'+$(test[i]).attr('pog')+'</span><div>'+$(test[i]).attr('pog')+'</div>'+$(test[i]).html());
			}else if($(test[i]).attr('col') > 1 && $(test[i]).attr('stl') == 0) {
				$(test[i]).attr('stl',1);
				$(test[i]).html('<span class="sp1">x'+$(test[i]).attr('col')+'</span><span class="sp4">x'+$(test[i]).attr('col')+'</span><span class="sp3">x'+$(test[i]).attr('col')+'</span><span class="sp2">x'+$(test[i]).attr('col')+'</span><div>x'+$(test[i]).attr('col')+'</div>'+$(test[i]).html());
			}
		}else{
			i = -2;
		}
		i++;
	}
}
</script>
<div style="background-color:#e8e8e8">
<script type="text/javascript" src="js/btl_info.js"></script>
<script>
$.ajaxSetup({cache: false});
$(window).error(function(){
  return true;
});
</script>
<script src="//img.testcombats.ru/js/jx/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript">
var login = '<? echo $u->info['login']; ?>';
var za = <? echo 0+$u->stats['zona']; ?>;
var zb = <? echo 0+$u->stats['zonb']; ?>;
var level = <? echo $u->info['level']; ?>;

function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
}

function explode( delimiter, string ) {

	var emptyArray = { 0: '' };

	if ( arguments.length != 2
		|| typeof arguments[0] == 'undefined'
		|| typeof arguments[1] == 'undefined' ) {
		return null;
	}

	if ( delimiter === ''
		|| delimiter === false
		|| delimiter === null ) {
		return false;
	}

	if ( typeof delimiter == 'function'
		|| typeof delimiter == 'object'
		|| typeof string == 'function'
		|| typeof string == 'object' ) {
		return emptyArray;
	}

	if ( delimiter === true ) {
		delimiter = '1';
	}

	return string.toString().split ( delimiter.toString() );
}

<?
function convert($from, $to, $var)
{
    if (is_array($var))
    {
        $new = array();
        foreach ($var as $key => $val)
        {
            $new[convert($from, $to, $key)] = convert($from, $to, $val);
        }
        $var = $new;
    }
    else if (is_string($var))
    {
        $var = iconv($from, $to, $var);
    }
    return $var;
}
function normJsonStr($str){
    $str = preg_replace_callback('/\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $str);
    //$str = iconv('cp1251', 'utf-8', $str);
	return $str;
}
?>

var log_text = <? echo normJsonStr(json_encode(convert('cp1251','utf-8',$log_text))); ?>;
var youlogin = <?=$u->info['login']?>;

function looklogrep(text,vars) {
	
	var vars = explode('||',vars);
	var forYou = '';
	var data = { };
	var i = 0;
	var j = {};
	while(i != -1 ) {
		if( vars[i] != undefined ) {
			j = explode('=',vars[i]);
			data[j[0]] = j[1];
		}else{
			i = -2;
		}
		i++;
	}
	
	text = replaceAll('{u1}','<span onClick="top.chat.addto(\'' + data['login1'] + '\',\'to\'); return false;" oncontextmenu="top.infoMenu(\'' + data['login1'] + '\',event,\'chat\'); return false;" class="CSSteam'+data['t1']+'">' + data['login1'] + '</span>',text);
	text = replaceAll('{u2}','<span onClick="top.chat.addto(\'' + data['login2'] + '\',\'to\'); return false;" oncontextmenu="top.infoMenu(\'' + data['login2'] + '\',event,\'chat\'); return false;" class="CSSteam'+data['t2']+'">' + data['login2'] + '</span>',text);
	text = replaceAll('^^^^','=',text);
	text = replaceAll('{pr}','<b>' + data['prm'] + '</b>',text);
	
	var test_zb1 = [ 0 , 0 , 0 , 0 , 0 , 0];
	var test_zb2 = [ 0 , 0 , 0 , 0 , 0 , 0];
	i = 1;
	j = data['bl2'];
	while( i <= data['zb2'] ) {
		test_zb1[ j ] = 1;
		j++;
		if( j > 5 ) {
			j = 1;
		}
		i++;
	}
	
	i = 1;
	while( i <= 5 ) {
		j = 1;
		rej = '';
		while( j <= 5 ) {
			zab = '';
			if( i == j ) {
				zab += '1'; //a
			}else{
				zab += '0'; //a
			}
			if( test_zb1[ j ] == 1) {
				zab += '1'; //b
			}else{
				zab += '0'; //b
			}
			rej += '<img src="//img.testcombats.ru/i/zones/'+data['t2']+'/'+data['t1']+''+zab+'.gif">';
			j++;
		}
		text = replaceAll('{zn2_' + i + '}',rej,text);
		i++;
	}
	
	i = 1;
	while( i <= 21 ) {
		//замена R - игрок 1
		if( log_text[data['s1']] != undefined ) {
			if( log_text[data['s1']][i] != undefined ) {
				r = log_text[data['s1']][i];
				k = 0;
				while( k != -1 ) {
					if( r[k] != undefined ) {
						text = replaceAll('{1x' + i + 'x' + k + '}','' + r[k] + '',text);
					}else{
						k = -2;
					}
					k++;
				}
			}
		}
		//замена R - игрок 2
		if( log_text[data['s2']] != undefined ) {
			if( log_text[data['s2']][i] != undefined ) {
				r = log_text[data['s2']][i];
				k = 0;
				while( k != -1 ) {
					if( r[k] != undefined ) {
						text = replaceAll('{2x' + i + 'x' + k + '}','' + r[k] + '',text);
					}else{
						k = -2;
					}
					k++;
				}
			}
		}
		i++;
	}
	
	//Повторная замена
	text = replaceAll('{u1}','<span onClick="top.chat.addto(\'' + data['login1'] + '\',\'to\'); return false;" oncontextmenu="top.infoMenu(\'' + data['login1'] + '\',event,\'chat\'); return false;" class="CSSteam'+data['t1']+'">' + data['login1'] + '</span>',text);
	text = replaceAll('{u2}','<span onClick="top.chat.addto(\'' + data['login2'] + '\',\'to\'); return false;" oncontextmenu="top.infoMenu(\'' + data['login2'] + '\',event,\'chat\'); return false;" class="CSSteam'+data['t2']+'">' + data['login2'] + '</span>',text);
	
	if( data['prm'] != undefined ) {
		data['prm'] = replaceAll("rvnO","=",data['prm']);
	}
	
	//data['prm'] = replaceAll('^^^^','=', data['prm'] );
	
	text = replaceAll('{pr}','<b>' + data['prm'] + '</b>',text);
	
	text = replaceAll('^^^^','=',text);
	
	text = replaceAll('==','',text);
	
	if( ( data['login1'] == youlogin || data['login2'] == youlogin ) && youlogin != '' ) {
		text = replaceAll('{fru}',' date2 ',text);
	}else{
		text = replaceAll('{fru}','',text);
	}
	
	return text;
}

</script>
<script type="text/javascript" src="js/btl_mini.js"></script>
<div id="hint4" class="ahint"></div>
<style>
html, body {
	background-color:#e8e8e8;
}
</style>
<div align="center" onMouseDown="top.hic();" onMouseOut="top.hic();">
<table width="100%" bgcolor="#e8e8e8" border="0" cellspacing="0" cellpadding="1">
<tr>
        <td valign="top" width="260"><div id="player1">
        </div>
        <div align="right"></div></td>
        <td valign="top"><div align="center">
          <table width="100%" height="25" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%" valign="top"><div id="player1_login" style="float:left;"></div></td>
              <td width="50%" valign="top"><div id="player2_login" style="float:right;"></div></td>
            </tr>
          </table>
          <table border="0" align="center" cellpadding="0" cellspacing="3">
            <tr>
              <td height="2">
              <div id="ref2" name="ref2"></div><div id="ref" name="ref"></div></td>
            </tr>		
		<tr>
			<div id="error" style="display:none;"></div>	
              <td><div id="pers_magic" align="center">
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img title="Пустой слот заклятия" src="//img.testcombats.ru/i/items/w/w101.gif" oncontextmenu="return false;"/></td>
                    <td><img title="Пустой слот заклятия" src="//img.testcombats.ru/i/items/w/w101.gif" oncontextmenu="return false;"/></td>
                    <td><img title="Пустой слот заклятия" src="//img.testcombats.ru/i/items/w/w101.gif" oncontextmenu="return false;"/></td>
                    <td><img title="Пустой слот заклятия" src="//img.testcombats.ru/i/items/w/w101.gif" oncontextmenu="return false;"/></td>
                    <td><img title="Пустой слот заклятия" src="//img.testcombats.ru/i/items/w/w101.gif" oncontextmenu="return false;"/></td>
                    <td><img title="Пустой слот заклятия" src="//img.testcombats.ru/i/items/w/w101.gif" oncontextmenu="return false;"/></td>
                    <td><img title="Пустой слот заклятия" src="//img.testcombats.ru/i/items/w/w101.gif" oncontextmenu="return false;"/></td>
                    <td><img title="Пустой слот заклятия" src="//img.testcombats.ru/i/items/w/w101.gif" oncontextmenu="return false;"/></td>
                    <td><img title="Пустой слот заклятия" src="//img.testcombats.ru/i/items/w/w101.gif" oncontextmenu="return false;"/></td>
                    <td><img title="Пустой слот заклятия" src="//img.testcombats.ru/i/items/w/w101.gif" oncontextmenu="return false;"/></td>
                    </tr>
                </table>
              </div></td>
            </tr>
            <tr>
              <td><table border="0" align="center" cellpadding="0" cellspacing="1">
                  <tr>
                    <td align="center">
                    <div id="ndfksdw">
                     <table width="100%" id="mainpanel222" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td bgcolor="#A7A7A7"><div align="center"><strong>&nbsp;&nbsp;Атака</strong></div></td>
                          <td width="20" bgcolor="#A7A7A7"><div align="center" style="color:#A7A7A7;">-</div></td>
                          <td bgcolor="#A7A7A7"><div align="center"><strong>Защита</strong></div></td>
                        </tr>
                      </table>
                    
                    <table width="100%" border="0" align="center" cellpadding="1" cellspacing="2" id="mainpanel">
                          <tr>
                            <td><div id="zatack1_1" class="crop"><a onclick="change_radio(1,1,'atack',0);return false;" href="#"><img style="display:block;" id="atack_1_1" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack2_1" class="crop"><a onclick="change_radio(2,1,'atack',0);return false;" href="#"><img style="display:block;" id="atack_2_1" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack3_1" class="crop"><a onclick="change_radio(3,1,'atack',0);return false;" href="#"><img style="display:block;" id="atack_3_1" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack4_1" class="crop"><a onclick="change_radio(4,1,'atack',0);return false;" href="#"><img style="display:block;" id="atack_4_1" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack5_1" class="crop"><a onclick="change_radio(5,1,'atack',0);return false;" href="#"><img style="display:block;" id="atack_5_1" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td onclick="select_atack(1,1);" style="cursor:default;" align="left">удар в голову</td>
                            <td width="3" style="cursor:default;" onclick="select_atack(1,1);">&nbsp;</td>
                            <td><div id="zblock1_1" class="crop"><a onclick="change_radio(1,1,'block',0);return false;" href="#"><img style="display:block;" id="block_1_1" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td onclick="change_radio(1,1,'block');" style="cursor:default;" align="left"><div id="txtb1_1">&nbsp;блок головы</div>
                                <div id="txtb1_2">&nbsp;блок головы и груди</div>
                              <div id="txtb1_3">&nbsp;блок головы, груди и живота</div></td>
                          </tr>
                          <tr>
                            <td><div id="zatack1_2" class="crop"><a onclick="change_radio(1,2,'atack',0);return false;" href="#"><img style="display:block;" id="atack_1_2" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack2_2" class="crop"><a onclick="change_radio(2,2,'atack',0);return false;" href="#"><img style="display:block;" id="atack_2_2" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack3_2" class="crop"><a onclick="change_radio(3,2,'atack',0);return false;" href="#"><img style="display:block;" id="atack_3_2" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack4_2" class="crop"><a onclick="change_radio(4,2,'atack',0);return false;" href="#"><img style="display:block;" id="atack_4_2" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack5_2" class="crop"><a onclick="change_radio(5,2,'atack',0);return false;" href="#"><img style="display:block;" id="atack_5_2" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td onclick="select_atack(2,1);" style="cursor:default;" align="left">удар в грудь</td>
                            <td onclick="select_atack(2,1);" style="cursor:default;">&nbsp;</td>
                            <td><div id="zblock1_2" class="crop"><a onclick="change_radio(1,2,'block',0);return false;" href="#"><img style="display:block;" id="block_1_2" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td onclick="change_radio(1,2,'block');" style="cursor:default;" align="left"><div id="txtb2_1">&nbsp;блок груди</div>
                                <div id="txtb2_2">&nbsp;блок груди и живота</div>
                              <div id="txtb2_3">&nbsp;блок груди, живота и пояса</div></td>
                          </tr>
                          <tr>
                            <td><div id="zatack1_3" class="crop"><a onclick="change_radio(1,3,'atack',0);return false;" href="#"><img style="display:block;" id="atack_1_3" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack2_3" class="crop"><a onclick="change_radio(2,3,'atack',0);return false;" href="#"><img style="display:block;" id="atack_2_3" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack3_3" class="crop"><a onclick="change_radio(3,3,'atack',0);return false;" href="#"><img style="display:block;" id="atack_3_3" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack4_3" class="crop"><a onclick="change_radio(4,3,'atack',0);return false;" href="#"><img id="atack_4_3" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack5_3" class="crop"><a onclick="change_radio(5,3,'atack',0);return false;" href="#"><img style="display:block;" id="atack_5_3" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td onclick="select_atack(3,1);" style="cursor:default;" align="left">удар в живот</td>
                            <td onclick="select_atack(3,1);" style="cursor:default;">&nbsp;</td>
                            <td><div id="zblock1_3" class="crop"><a onclick="change_radio(1,3,'block',0);return false;" href="#"><img style="display:block;" id="block_1_3" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td onclick="change_radio(1,3,'block');" style="cursor:default;" align="left"><div id="txtb3_1">&nbsp;блок живота</div>
                                <div id="txtb3_2">&nbsp;блок живота и пояса</div>
                              <div id="txtb3_3">&nbsp;блок живота, пояса и ног</div></td>
                          </tr>
                          <tr>
                            <td><div id="zatack1_4" class="crop"><a onclick="change_radio(1,4,'atack',0);return false;" href="#"><img style="display:block;" id="atack_1_4" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack2_4" class="crop"><a onclick="change_radio(2,4,'atack',0);return false;" href="#"><img style="display:block;" id="atack_2_4" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack3_4" class="crop"><a onclick="change_radio(3,4,'atack',0);return false;" href="#"><img style="display:block;" id="atack_3_4" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack4_4" class="crop"><a onclick="change_radio(4,4,'atack',0);return false;" href="#"><img style="display:block;" id="atack_4_4" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack5_4" class="crop"><a onclick="change_radio(5,4,'atack',0);return false;" href="#"><img style="display:block;" id="atack_5_4" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td onclick="select_atack(4,1);" style="cursor:default;" align="left">удар в пояс(пах)</td>
                            <td onclick="select_atack(4,1);" style="cursor:default;">&nbsp;</td>
                            <td><div id="zblock1_4" class="crop"><a onclick="change_radio(1,4,'block',0);return false;" href="#"><img style="display:block;" id="block_1_4" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td onclick="change_radio(1,4,'block');" style="cursor:default;" align="left"><div id="txtb4_1">&nbsp;блок пояса</div>
                                <div id="txtb4_2">&nbsp;блок пояса и ног</div>
                              <div id="txtb4_3">&nbsp;блок пояса, ног и головы</div></td>
                          </tr>
                          <tr>
                            <td><div id="zatack1_5" class="crop"><a onclick="change_radio(1,5,'atack',0);return false;" href="#"><img style="display:block;" id="atack_1_5" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack2_5" class="crop"><a onclick="change_radio(2,5,'atack',0);return false;" href="#"><img style="display:block;" id="atack_2_5" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack3_5" class="crop"><a onclick="change_radio(3,5,'atack',0);return false;" href="#"><img style="display:block;" id="atack_3_5" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack4_5" class="crop"><a onclick="change_radio(4,5,'atack',0);return false;" href="#"><img style="display:block;" id="atack_4_5" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td><div id="zatack5_5" class="crop"><a onclick="change_radio(5,5,'atack',0);return false;" href="#"><img style="display:block;" id="atack_5_5" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td onclick="select_atack(5,1);" style="cursor:default;" align="left">удар по ногам</td>
                            <td onclick="select_atack(5,1);" style="cursor:default;">&nbsp;</td>
                            <td><div id="zblock1_5" class="crop"><a onclick="change_radio(1,5,'block',0);return false;" href="#"><img style="display:block;" id="block_1_5" class="radio_off" src="//img.testcombats.ru/i/misc/radio.gif" width="36" height="18" /></a></div></td>
                            <td onclick="change_radio(1,5,'block');" style="cursor:default;" align="left"><div id="txtb5_1">&nbsp;блок ног</div>
                                <div id="txtb5_2">&nbsp;блок ног и головы</div>
                              <div id="txtb5_3">&nbsp;блок ног, головы и груди</div></td>
                          </tr>
                      </table>
                    </div>
				    <div id="ref_menu_down" align="center">
                      <table width="100%" border="0" style="background-color:#f2f0f0;" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="40"></td>
						  
						  <td width="20" title="Случайный удар" onclick="top.cb_radio_click($('#cr_rach_rc3'),3);"><script>top.slcbrc[3] = 1; if( top.slcbrc[3] == 0 ) { document.write(top.create_check('rc3','','on')); }else{ document.write(top.create_check('rc3','','off')); }</script></td>
                          <td width="20" title="Не сбрасывать выбор" onclick="top.cb_radio_click($('#cr_rach_rc4'),4);"><script>if( top.slcbrc[4] == 0 ) { document.write(top.create_check('rc4','','off')); }else{ document.write(top.create_check('rc4','','on')); }</script></td>	
						  <td width="0"></td>
                          <td align="center">
						      <input name="fast_battle" id="fast_battle" type="hidden"/>
                              <button name="go_btn" type="button" id="go_btn" style="cursor:pointer;border: 1px double #9a9996;" title="Вперед!!!" onclick="atack();">Вперед!!!</button>      
                              <button name="reflesh_btn" onclick="reflesh();" type="button" id="reflesh_btn" style="cursor:pointer;display:none;border: 1px double #9a9996;" title="Обновить" >Обновить</button>                               
                              <button name="back_menu_down" onClick="top.frames['main'].location='main.php?finish=1';" type="button" id="back_menu_down" style="cursor:pointer;display:none;border: 1px double #9a9996;" title="Вернуться" >Вернуться</button>
                              <input name="save_zones" id="save_zones" type="hidden" />
                          </td>
                          <td width="20"><img <? if( $u->info['lider'] != $u->info['battle'] || $u->stats['hpNow']<1 ) {?>style="display:none;cursor:pointer;"<? }else{ ?>style="cursor:pointer;"<? } ?> onclick="top.leaderFight();" id="btn_down_img3" style="cursor:pointer;" title="Передать флаг" src="//img.testcombats.ru/i/ico_change_leader1.gif" width="16" height="19" /></td>
                          <td width="20"><img <? if( $u->info['lider'] != $u->info['battle'] || $u->stats['hpNow']<1 ) { ?>style="display:none;cursor:pointer;"<? }else{ ?>style="cursor:pointer;"<? } ?> onclick="top.leaderFight2();" id="btn_down_img4" style="cursor:pointer;" title="Убить" src="//img.testcombats.ru/i/ico_kill_member1.gif" width="16" height="19" /></td>
                          <td width="40"><div align="right"><img onclick="top.smena1();" id="btn_down_img2" style="cursor:pointer;" title="Смена противника (3)" src="//img.testcombats.ru/i/ico_change.gif" width="16" height="19" />&nbsp;<img src="//img.testcombats.ru/i/ico_refresh.gif" name="btn_down_img1" id="btn_down_img1" onclick="reflesh();" width="16" height="19" style="cursor:pointer;" title="Обновить"  /></div></td>
                        </tr>
                        <tr>
                          <td height="1"></td>
                          <td height="1"></td>
                          <td height="1"></td>
                          <td height="1"></td>
                          <td height="1"><img style="display:block" src="//<?=$c['img'];?>/1x1.gif" width="200" height="1" /></td>
                          <td height="1"></td>
                          <td height="1"></td>
                          <td height="1"></td>
                        </tr>
                      </table>
                    </div>
                    <? if($u->info['level'] < 4) { ?><hr />
                    <center><font color="#333333"><small>Нажмите <b>Вперед!!!</b> чтобы сделать случайный удар.</small></font></center><hr />
                    <? } ?>
                    </td>
                  </tr>
              </table>			  </td>
            </tr>
            <tr>
              <td id="mainpanel2" style="height:118px; display:none;" align="center"></td>
            </tr>
             <tr>
              <td><div align="center">
                  <table <? if($u->info['level'] < 4) { echo ' style="display:none;" '; } ?> border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><span title="Нанесенный удар" style="margin-right:11px; font-size:9px;"><img onclick="startHintPriemsBattle()" width="8" height="8" src="//img.testcombats.ru/i/micro/hit.gif" /> <font id="tac1"><? echo 0+$u->info['tactic1']; ?></font></span></td>
                      <td><span title="Критический удар" style="margin-right:11px; font-size:9px;"><img width="8" height="8" src="//img.testcombats.ru/i/micro/krit.gif" /> <font id="tac2"><? echo 0+$u->info['tactic2']; ?></font></span></td>
                      <td><span title="Проведенный контрудар" style="margin-right:11px; font-size:9px;"><img width="8" height="8" src="//img.testcombats.ru/i/micro/counter.gif" /> <font id="tac3"><? echo 0+$u->info['tactic3']; ?></font></span></td>
                      <td><span title="Успешный блок" style="margin-right:11px; font-size:9px;"><img width="8" height="8" src="//img.testcombats.ru/i/micro/block.gif" /> <font id="tac4"><? echo 0+$u->info['tactic4']; ?></font></span></td>
                      <td><span title="Успешное парирование" style="margin-right:11px; font-size:9px;"><img width="8" height="8" src="//img.testcombats.ru/i/micro/parry.gif" /> <font id="tac5"><? echo 0+$u->info['tactic5']; ?></font></span></td>
                      <td><span title="Нанесенный урон" style="margin-right:11px; font-size:9px;"><img width="8" height="8" src="//img.testcombats.ru/i/micro/hp.gif" /> <font id="tac6"><? echo 0+floor($u->info['tactic6']); ?></font></span></td>
                      <td><span title="Уровень духа" style="margin-right:11px; font-size:9px;"><img width="7" height="8" src="//img.testcombats.ru/i/micro/spirit.gif" /> <font id="tac7"><? if($u->info['tactic7']<0){ $u->info['tactic7'] = 0; } echo 0+$u->info['tactic7']; ?></font></span></td>
                    </tr>
                  </table>
              </div>
              </td>
              </tr>
          </table>
          <table border="0" align="center" cellpadding="0" cellspacing="1">
				<tr align="center">
				<td><div id="priems" style="width:440px;"></div></td>
			</tr>
            <tr>
              <td><div style="display:none;" id="pers_priem" align="center"></div></td>
            </tr>
          </table>
        </div></td>	
        <td valign="top" width="260" align="right"><div id="player2">
          <div align="left"></div>
        </div></td>
    </tr>
    </table>
  <div id="allTeams0" align="center"><font id="teams"></font></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" valign="top">&nbsp;</td>
        <td valign="top">
        <div align="left">
        <font color="black"><br>На данный момент вами нанесено урона:</font><b>&nbsp;<span id="nabito"><? echo floor($u->info['battle_yron']); ?></span>HP&nbsp;</b>.<br /><br />
		<span style="display:">
        <small style="display:none">(Опыт: +<b><span id="expmaybe"><? echo floor($u->info['battle_exp']); ?></span> ед.</b>, Без учета процентов)</small>
        </span>
        </div>
        </td>
        <td width="260" valign="top"><div align="right"><a href="/logs.php?log=<? echo $u->info['battle']; ?>" target="blank_">лог боя »»</a><br />
        </div></td>
      </tr>
    </table>
    <div class="st1222" id="volna"></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10">&nbsp;</td>
        <td><div id="battle_logg" align="left" style="font-size:9pt;"></div><div align="left">Полную версию лога боя смотрите <a href="/logs.php?log=<? echo $u->info['battle']; ?>" target="blank_">здесь »»</a><br>(Бой идет с таймаутом <strong id="timer_out">NaN</strong> мин.)</div><br /></td>
        <td width="10">&nbsp;</td>
      </tr>
    </table>
</div>
<script>
    g_iCount = 0;
    //reflesh();
    setInterval('reflesh();console.log("battle works");',10 * 1000);
    startCountdown();
    genZoneAtack();
    genZoneBlock();
    refleshPoints();
 
</script>
<?
//include('_incl_data/class/_cron_.php');
//include('_incl_data/class/__battle.php');	
//include('jx/battle/refresh.php'); ?>
</div>
<?

}

?>