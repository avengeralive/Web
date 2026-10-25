<?php
	$slist = mysql_fetch_array(mysql_query('SELECT `data` FROM `spam_word` WHERE `id`="1" LIMIT 1;'));
	$sword = explode("|", $slist['data']);
if(isset($_GET['action']) && $_GET['action']!=''){

	if($_GET['action']=='showList'){

		$aa='
			<div class="divTable" style="max-width:500px; margin: 0 auto;">
				<div class="divTableBody" style="text-align:center;">
					<div class="divTableRow">
						<div class="divTableCell">№</div>
						<div class="divTableCell">Слово</div>
						<div class="divTableCell">Действие</div>
					</div>		
		';
		foreach ($sword as $key => $value) {
				$aa.='
					<div class="divTableRow">
						<div class="divTableCell">'.$key.'</div>
						<div class="divTableCell" style="text-align:left;">'.$value.'</div>
						<div class="divTableCell"><button onclick="spamDelWord('.$key.');" class="btn btn-danger">Удалить</button></div>
					</div>
				';
		}
		$aa.='
				</div>
			</div>	
		';
		echo $aa;
	}

	elseif($_GET['action']=='delWord') {
		unset($sword[$_GET['id']]);
		foreach ($sword as $key => $value) {
			$newList .= ''.$value.'|';
		}
		$newList = trim($newList,'|');
		mysql_query('UPDATE `spam_word` SET `data`="'.$newList.'" WHERE `id`="1" LIMIT 1;');
		echo 'Спам слово успешно удалено';
	}
	elseif($_GET['action']=='addWord'){
		$_POST['word'] = iconv("UTF-8", "windows-1251", $_POST['word']);
		foreach ($sword as $key => $value) {
			$newList .= ''.$value.'|';
		}
		$newList = trim($newList,'|');
		$newList .='|'.$_POST['word'].'';
		mysql_query('UPDATE `spam_word` SET `data`="'.$newList.'" WHERE `id`="1" LIMIT 1;');
		echo 'Спам слово успешно добавлено';
	}
	die();
}
?>
<style>
.spamMsg {
    font-weight: bold;
    color: red;
    text-align: center;
}
</style>
<script>
	spamShowList();
</script>
<div class="workHeader">
	<div class="workHeaderL">
		<h3>Спам лист</h3>
	</div>
	<div class="workHeaderR">
		<button onclick="spamAddHideShow('spamAdd');" class="btn btn-success">Добавить <i class="fa fa-plus" aria-hidden="true"></i></button>
		<button onclick="spamShowList();" class="btn">Обновить <i class="fa fa-refresh" aria-hidden="true"></i></button>

	</div>	
</div>
<div class="spamAdd" id="spamAdd" style="display:none;">
	<fieldset>
		<legend><b>Добавить новое спам слово</b> </legend>
		<textarea name="spamWord" style="width:100%;height:100px;" id="spamWord"></textarea><br/>
		<small style="color:red;">Убедительная просьба добавлять по 1 слову (без пробелов в начале и в конце)!</small><br/><br/>
		<button onclick="spamAddWord();" class="btn btn-success">Добавить <i class="fa fa-plus" aria-hidden="true"></i></button>
	</fieldset>
</div>
<div class="spamMsg" id="spamMsg"></div>
<div class="spamList" id="spamList"></div>
