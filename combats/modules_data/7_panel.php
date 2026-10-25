<?
if(!defined('GAME'))
{
	die();
}
if($u->info['align']==7) {
if($u->error!='')
{
	echo '<font color="red"><b>'.$u->error.'</b></font><br>';
}
$vu = array(0,0,0,0,0,0,0);
//Абилки $item_neytral
$item_neytral = array(
"" => array(
   //array(4804,3,0,0,0,'noremont=1|usefromfile=1|musor=1|battleUseZd=300|srok=86400|nosale=1|sudba=1',1)
	//array(4412,1,0,0,0,'useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),
	//array(4413,1,0,0,0,'useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5),
	//array(4414,1,0,0,0,'useOnLogin=1|noremont=1|musor=1|sudba='.$u->info['login'].'|srok=86400|nosale=1',5)
    ),
);
$vi = array(
);
?>
<link href="https://img.testcombats.ru/css/main.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/clu0b.css" />
<link rel="stylesheet" type="text/css" href="css/windows.css" />
<?

?>
<table width="100%">
    <tr>
        <center><h3>Нейтральная Сила с нами, собрат <?=$u->microLogin($u->info['id'],1)?></center></h3>
        <td width="150" align="right"><input type="button" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;"
 value="Обновить" onclick="location='main.php?7_panel=1';" />   </div>   <input type="button" style="border: 1px double #9a9996; font-size: 12px; color:#dfdfdf; background-color:#504F4C;"
 value="Вернуться" onclick="location='main.php';" /></td>

            </table>
            <center><p><b>Абилки:</b><br /><small>(Чтобы забрать предмет просто нажмите на его изображение)</small></p>
            <p>
                <?
                $i = 0; $seet = '';
                $vnr = array(0 => 'на сегодня',1 => ' всего');
                while($i < count($item_neytral[$neytral_panel])) {
                    if($item_neytral[$neytral_panel][$i][1]>0) {
                        $itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$item_neytral[$neytral_panel][$i][0].'" LIMIT 1'));
                        if(isset($itm['id'])) {
                            $vix = 0;
                            if($item_neytral[$neytral_panel][$i][4] == 0) {
                                $vix = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "dark_itm'.$itm['id'].'"',2);
                                $vix = $vix[0];
                            }else{
                                $vix = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.$vt['timeUse'].' AND `vars` = "dark_itm'.$itm['id'].'" ',2);
                                $vix = $vix[0];
                            }
                            if($item_neytral[$neytral_panel][$i][1]-$vix > 0) {
                                if(isset($_GET['take_item_neytral_panel']) && $_GET['take_item_neytral_panel'] == $itm['id']) {
                                    $nitm = $u->addItem($itm['id'],$u->info['id'],$item_neytral[$neytral_panel][$i][5]);
                                    if($item_neytral[$neytral_panel][6]>0) {
                                    }
                                    $u->addAction(time(),'dark_itm'.$itm['id'],'');
                                    echo '<font color="red">Предмет &quot;<b>'.$itm['name'].'</b>&quot; перемещен к Вам в инвентарь!</font><br><br>';
                                }
                            }
                            $seet0 = '';
							//Вывод предметов
                            $seet0 .= '<img '.$vix.' title="'.$itm['name'].'
(Осталось '.$vnr[$item_neytral[$i][4]].': '.($item_neytral[$neytral_panel][$i][1]-$vix).' шт.)" src="https://'.$c['img'].'/i/items/'.$itm['img'].'"> ';
                            if($item_neytral[$neytral_panel][$i][1]-$vix > 0) {
                                $seet0 = '<a href="main.php?7_panel=1&take_item_neytral_panel='.$itm['id'].'">'.$seet0.'</a>';
                            }else{
                                $seet0 = '<span style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;">'.$seet0.'</span>';
                            }
                            $seet .= $seet0;
                        }
                    }
                    $i++;
                }
}
                echo $seet;
                ?>
            </p></td></center>
    </tr>
</table>