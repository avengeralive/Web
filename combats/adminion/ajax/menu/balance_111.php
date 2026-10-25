<?
if( $u->info['admin'] != 1) die('Нет прав доступа.');

$noobs = '';

$mm = date('m');
$yy = date('Y');
if(isset($_GET['mm'])) $mm = $_GET['mm'];//strtotime
$mf = array(
'01' => 'January',
'02' => 'February',
'03' => 'March',
'04' => 'April',
'05' => 'May',
'06' => 'June',
'07' => 'July',
'08' => 'August',
'09' => 'September',
'10' => 'October',
'11' => 'November',
'12' => 'December'
);
$mf2 = array(
'12' => 'January',
'01' => 'February',
'02' => 'March',
'03' => 'April',
'04' => 'May',
'05' => 'June',
'06' => 'July',
'07' => 'August',
'08' => 'September',
'09' => 'October',
'10' => 'November',
'11' => 'December'
);
if(!isset($mf[$mm])) $mm = date('m');
$yy2 = $yy;
if($mm=='12') $yy2++;
$time_start = strtotime("1 ".$mf[$mm]." ".$yy."");
$time_finish = strtotime("1 ".$mf2[$mm]." ".$yy2."");

$balance = mysql_fetch_array(mysql_query('SELECT SUM(`money`) FROM `balance_money` WHERE `cancel` = 0'.$noobs.''));
$balance = $balance[0];
$plus = mysql_fetch_array(mysql_query('SELECT SUM(`money`) FROM `balance_money` WHERE '.$noobs.' `time` >= '.$time_start.' AND `time` < '.$time_finish.' AND `cancel` = "0"'));
$plus = $plus[0];
?>
<div id="List" style="width:100%;">
<h3>Отчетность проекта</h3>
<style type="text/css">
.txt1 {color: #707a88;}
</style>
<script>
function Load(targ,selObj,restore)
{
	$.ajax({
		url: "?mod=context&menu=balance_111&ajax=1&mm="+selObj.options[selObj.selectedIndex].value,
		type: "GET",
		success: function(data)
		{
            $('#List').html("");
			$('#List').append(data);
		}
	});
}
</script>
<table width="1000" bgcolor="#fefefe" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" align="center"><form name="form1" method="post" action="">
      Период: 
        <select name="mm" id="mm" onChange="Load('parent',this,0)">
            <option <? if($mm=='01'){ echo 'selected'; } ?> value="01">январь</option>
            <option <? if($mm=='02'){ echo 'selected'; } ?> value="02">февраль</option>
            <option <? if($mm=='03'){ echo 'selected'; } ?> value="03">март</option>
            <option <? if($mm=='04'){ echo 'selected'; } ?> value="04">апрель</option>
            <option <? if($mm=='05'){ echo 'selected'; } ?> value="05">май</option>
            <option <? if($mm=='06'){ echo 'selected'; } ?> value="06">июнь</option>
            <option <? if($mm=='07'){ echo 'selected'; } ?> value="07">июль</option>
            <option <? if($mm=='08'){ echo 'selected'; } ?> value="08">август</option>
            <option <? if($mm=='09'){ echo 'selected'; } ?> value="09">сентябрь</option>
            <option <? if($mm=='10'){ echo 'selected'; } ?> value="10">октябрь</option>
            <option <? if($mm=='11'){ echo 'selected'; } ?> value="11">ноябрь</option>
            <option <? if($mm=='12'){ echo 'selected'; } ?> value="12">декабрь</option>
          </select>
    , <?=$yy;?>
     года.
    Доступные средства:
     <span style="font-weight: bold"><?=number_format($balance, 0, ",", " ");?></span> RUB | Прибыль за этот месяц: <span style="font-weight: bold"><?=number_format($plus, 0, ",", " ");?></span> RUB | Дата отчета:
<?=date('d.m.Y H:i:s');?>
    </form></td>
  </tr>
  <tr>
    <td>
    <? 
	$i = 1;
	$days = ($time_finish-$time_start)/86400;
	while($i<=$days)
	{
	$dt = $time_start+(86400*($i-1));
	if($dt<time())
	{
		$lim = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `balance_money` WHERE `time` >= '.$dt.''.$noobs.' AND `time` < '.($dt+86400).''));
		$lim = $lim[0];
		$mst = mysql_fetch_array(mysql_query('SELECT `money`,`balance` FROM `balance_money` WHERE `time` < '.$dt.''.$noobs.' AND `cancel` = "0" ORDER BY `id` DESC LIMIT 1'));
		$mst = $mst['balance'];
		$mft = mysql_fetch_array(mysql_query('SELECT `money`,`balance` FROM `balance_money` WHERE `time` >= '.$dt.''.$noobs.' AND `time` < '.($dt+86400).' AND `cancel` = "0" ORDER BY `id` DESC LIMIT 1'));
		$mft = $mft['balance'];
	?>
    <!-- day -->
	<div style="background-color:#cad3e0;color:#8591a2;border:1px solid #cdd5e2;">
	  <div style="padding:10px;">Дата: <b><?=date('d.m.Y',$dt);?></b>, Операций за этот день: <?=$lim;?>, средств в начале дня: <b><?=number_format($mst, 0, ",", " ");?></b> RUB, средств в конце дня: <b><?=number_format($mft, 0, ",", " ");?></b> RUB</div>
 		<!-- -->
        <? 
		$sp = mysql_query('SELECT * FROM `balance_money` WHERE `time` >= '.$dt.''.$noobs.' AND `time` < '.($dt+86400).' ORDER BY `time` ASC LIMIT '.$lim);
		while($pl = mysql_fetch_array($sp))
		{
			if($pl['money']>0 && $pl['cancel']==0)
			{
		?>
        <table width="998" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="499" align="center" valign="top" bgcolor="#f5f7fa" class="txt1">
            <table bgcolor="#e6f8ea" width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td width="100" align="center"><?=date('d.m.Y H:i:s',$pl['time']);?></td>
                <td width="75" align="center"><?=number_format($pl['money'], 0, ",", " ");?> RUB</td>
                <td>Остаток: <span style="font-weight: bold"><?=number_format($pl['balance'], 0, ",", " ");?></span> RUB</td>
                </tr>
            </table>
            </td>
            <td width="499" align="left" valign="top" bgcolor="#f5f7fa" class="txt1">
              <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td width="30" align="left" valign="top">&larr;</td>
                  <td valign="top">&nbsp;<?=$pl['comment2'];?></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <? }else{ ?>
        <table width="998" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="599" align="right" valign="top" bgcolor="#f5f7fa" class="txt1">
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>            
                <td valign="top" bgcolor="#F5F7FA">&nbsp;<?=$pl['comment2'];?></td>
                <td width="30" align="right" valign="top">&rarr;</td>
              </tr>
            </table>
            </td>
            <td width="399" align="center" valign="top" bgcolor="<? if($pl['money']<0){ echo '#f8e6ef'; }else{ echo '#F5F7FA'; } ?>" class="txt1">
            <table bgcolor="<? if($pl['money']<0 && $pl['cancel']==0){ echo '#f8e6ef'; }else{ echo '#F5F7FA'; } ?>" width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td width="100" align="center"><?=date('d.m.Y H:i:s',$pl['time']);?></td>
                <td width="75" align="center"><?=number_format($pl['money'], 0, ",", " ");?> RUB</td>
                <td>Остаток: <span style="font-weight: bold"><?=number_format($pl['balance'], 0, ",", " ");?></span> RUB</td>
                </tr>
            </table>
            </td>
          </tr>
        </table>
        <? } } ?>
        <!-- -->
      </div>
    <? } $i++; } ?>
    <? if($mm==date('m') && $fggf==999){ ?>
    <br><br><br>
    <div style="background-color:#F5F7FA;">
    <form name="form1" method="post" action="?mm=<?=$mm;?>#addline">
      <table width="100%" border="0" align="center" cellpadding="5" style="border:1px solid #8591a2;" cellspacing="0">
        <tr>
          <td bgcolor="#CAD3E0">Сумма: <input name="money" type="text" size="21" maxlength="7" /> 
            RUB</td>
        </tr>
        <tr>
          <td bgcolor="#CAD3E0"><p class="txt1">Комментарий (500 символов максимум):</p>
            <p>
              <textarea style="width:980px;" name="text" id="text" cols="45" rows="5"></textarea>
            </p></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#CAD3E0"><input type="submit" name="button" id="button" value="Прикрепить к отчету за <?=date('d.m.Y');?>"></td>
        </tr>
      </table>
     </form>
    </div>
    <? } ?>
    <!-- day -->
    </td>
  </tr>
</table>
</div>
