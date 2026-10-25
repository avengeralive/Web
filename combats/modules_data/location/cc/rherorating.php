<?php
if(!defined('GAME'))
{
	die();
}
if($u->room['file']=='cc/rherorating')
?>
<script>
function openTab(evt, tabName)
{
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<p align="right"><?php echo '<b style="color:red">'.$error.'</b>'; ?></p>
<div class="tabcontent" style="display: block; text-align: right;">
		<span style="padding-right: 10px;"><?=$u->microLogin($u->info['id'],1)?></span>
		<input type="button" class="btn-ss1" value="Обновить" onclick="location='main.php?rherorating';" />
        <input class="btn-ss1" type="button" value="Вернуться" onClick="location='main.php?loc=1.180.0.472&rnd=<? echo $code; ?>';"/>
		<div id="textgo" style="visibility:hidden;"></div>
</div>
<div id="newbattle" class="tabcontent" style="display: block;">
            <center><h3>Рейтинг Героев</h3></center>
			<hr />
			<table width="100%">
				<tr>
					<td align="center">
						<table style="margin: auto; text-align: left;">
							<?php
							$i =1;
				            $sp3 = mysql_query('SELECT * FROM `aligns_reting` ORDER BY `points` DESC');
							while( $pl = mysql_fetch_array($sp3) )
							{
								echo '<tr>
								<td>'.$i.'. <img src="https://img.testcombats.ru/i/align/align'.$pl['align'].'.gif" > <b>'.$pl['name'].'</b></td>
								<td>- очки: '.$pl['points'].'</td>
								</tr>';
								$i++;
							}
							?>
				        </table>
					</td>
				</tr>
			</table>
            <br /><hr />

</div>
<div id="arhiv" class="tabcontent">
	<center><h3>Логи последних 10 боев</h3></center>
	<hr />
	<table style="margin: auto; text-align: left;">
		<tbody style="padding: 10px 10px;">
		<?
		$i = 1;
		$aligns = array(1=>'Силы Света', 3=>'Силы Тьмы', 7=>'Нейтралитет');

		$sp3 = mysql_query('SELECT * FROM `battle_aligns` ORDER BY `id` DESC LIMIT 10');
		while( $pl = mysql_fetch_array($sp3) )
		{
			echo '<tr>';
			echo '<td style="font-size:13px;">'.$i.'. Победитель: <img src="https://img.testcombats.ru/i/align/align'.$pl['win_align'].'.gif" >
			<b>'.$aligns[$pl['win_align']].'</b>. <a href="/logs.php?log='.$pl['battle'].'" target="_blank">лог боя</a></td>';
			echo '</tr>';
		}
		?>
		</tbody>
	</table>
</div>