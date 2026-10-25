<?
if(!defined('GAME'))
{
	die();
}
?>
<SCRIPT>
var nlevel=0;
var from = Array('+', ' ', '#');
var to = Array('%2B', '+', '%23');

function w(login,id,align,klan,level,online,city,battle){
	var s='';
	if (online!="") {
		if (city!="") {
			s+='<IMG SRC="//img.testcombats.ru/1x1.gif" WIDTH=20 HEIGHT=15 ALT="В другом городе">';
		} else {
			s+='<a href="javascript:top.chat.addto(\''+login+'\',\'private\');"><IMG SRC=https://img.testcombats.ru/i/lock.gif WIDTH=20 HEIGHT=15 ALT="Приватно"></a>';
		}
		if (city!="") {
			s+='<img title="'+city+'" src="//img.testcombats.ru/i/city_ico/'+city+'.gif" width=17 height=15>';
		}
		s+=' <IMG SRC="//img.testcombats.ru/i/align/align'+align+'.gif" WIDTH=12 HEIGHT=15>';

		if (klan!='') {s+='<A HREF="/encicl/klan/'+klan+'.html" target=_blank><IMG SRC="//img.testcombats.ru/i/clan/'+klan+'.gif" WIDTH=24 HEIGHT=15 ALT=""></A>'}
		s+='<a href="javascript:top.chat.addto(\''+login+'\',\'to\');">'+login+'</a>['+level+']<a href=/inf.php?'+id+' target=_blank><IMG SRC="//img.testcombats.ru/i/inf_capitalcity.gif" WIDTH=12 HEIGHT=11 ALT="Информация о персонаже"></a>';
		if (city!="") {
			s+=" - нет в этом городе";
		} else {
			s+=' - '+online;
		}
	}
	else {
		s+='<IMG SRC="//img.testcombats.ru/i/offline.gif" WIDTH=20 HEIGHT=15 BORDER=0 ALT="Нет в клубе">';
		if (city!="") {
			s+='<img title="'+city+'" src="//img.testcombats.ru/i/city_ico/'+city+'.gif" width=17 height=15>';
		}
		if (align == "") align="0";
		s+=' <IMG SRC="//img.testcombats.ru/i/align/align'+align+'.gif" WIDTH=12 HEIGHT=15>';
		if (klan!='') {s+='<A HREF="//<? echo $c['host']; ?>/encicl/clan/'+klan+'.html" target=_blank><IMG SRC="//img.testcombats.ru/i/klan/'+klan+'.gif" WIDTH=24 HEIGHT=15 ALT=""></A>'}
		if (level) {
			if (nlevel==0) {
				nlevel=1; s="<BR>"+s;
			}
			s+='<FONT color=gray><b>'+login+'</b>['+level+']<a href=/inf.php?'+id+' target=_blank><IMG SRC="//img.testcombats.ru/i/inf.gif" WIDTH=12 HEIGHT=11 ALT="Информация о персонаже"></a> - Нет в клубе';
		} else {
			if (nlevel==1) {
				nlevel=2; s="<BR>"+s;
			}
			mlogin = login;
			for(var i=0;i<from.length;++i) while(mlogin.indexOf(from[i])>=0)  mlogin= mlogin.replace(from[i],to[i]);
			s+='<FONT color=gray><i>'+login+'</i> <a href=/inf.php?login='+mlogin+' target=_blank><IMG SRC="//img.testcombats.ru/i/inf_.gif" WIDTH=12 HEIGHT=11 ALT="Информация о персонаже"></a> - нет в этом городе';
		}
		s+='</FONT>';

	}
	document.write(s+'<BR>');
}
</SCRIPT>
	<div id=hint4 class=ahint></div>
	<TABLE cellspacing=0 cellpadding=2 width=100%>
<TR>
<TD style="width: 40%; vertical-align: top; "><br />
<TABLE cellspacing=0 cellpadding=2 style="width: 100%; ">
  <TR>
<TD align=center><h4>Официальный представитель Нашего Бойцовского Клуба</h4></TD>
</TR>
<TR>
<TD bgcolor=efeded nowrap><SCRIPT>
<?
$data = mysql_query("SELECT `id`, `login`, `align`, `level`, `battle`, `online`, `city`, (select `name` from `room` WHERE `id` = users.`room`) as `room` FROM `users` WHERE `align` = '50' order by online DESC, login asc;");
$i = 0;
while($a = mysql_fetch_array($data))
{
	if ($a['online']>(time()-120))
	{
		$online = $a['room'];
		$id = $a['id'];
		$level = $a['level'];
		$battle = $a['battle'];
	}elseif($a['online']<(time()-120))
	{
		$online = '';
		$id = '';
		$level = '';
		$battle = '';
	}
	//w(       login,          id,       align,        klan,   level,     online,   city,    battle){
	$citya = $a['city']; 
	if($a['city']==$u->info['city'])
	{
		$citya = '';
	}
	echo 'w("'.$a['login'].'","'.$id.'","'.$a['align'].'","","'.$level.'","'.$online.'","'.$citya.'","'.$battle.'");';
	$i++;
}
/*$pl = mysql_fetch_array(mysql_query('SELECT * FROM `bank_table` ORDER BY `time` DESC LIMIT 1'));*/

?>
</SCRIPT>
<TR>
<TD style="text-align: left; "><small>Курс покупки Еврокредитов: <b>1</b> Евро. = <b>50 </b>екр.<br>
  Курс обмена ЕвроКредитов: <b>1</b> екр = <b>10</b> кр.<br>Продают Еврокредиты и прочие платные услуги сервиса<BR>Вы можете отправить им личное сообщение, даже если Вы и Алхимик находитесь в разных городах</small></div></TD>
</TR>
</TABLE>

<br /><br />

<table style="font-size: 9pt;">
      <tr>
        <td valign="top"><fieldset>
          <legend><b>Курс Евро к мировой валюте</b> </legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
              <td><small>Данные без учета комиссий</small></td>
            </tr>
            
    <tr>
              <td><span>1 Евро. = <b>1.00</b></span>&nbsp;<span>евро, ЕUR</span><br>
		<span>1 Евро. = <b>1.18</b></span>&nbsp;&nbsp;<span>доллар, CША</span><br>
		<span>1 Евро. = <b>86.26</b></span>&nbsp;<span>рубль, Россия</span></span><br>
		<span>1 Евро. = <b>32.37</b></span>&nbsp;<span>гривна, Украина</span>
		</td>
            </tr>
          </table>
	</fieldset></td>
  </tr>
</table>

</TD>
<TD style="width: 5%; vertical-align: top; ">&nbsp;</TD>
<TD style="width: 25%; vertical-align: top; text-align: right; "><INPUT type='button' value='Обновить' style='width: 75px' onclick='location="/main.php?alh&rnd=<?=$code?>"';'>
&nbsp;<INPUT TYPE=button value="Вернуться" style='width: 75px' onclick='location="/main.php"'></TD>
</TR>
</TABLE>
<DIV>
<? echo $c['counters']; ?>
</DIV>

