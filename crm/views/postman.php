<?php namespace lib;
	if (!in_array('post', $RoleGroup) && !in_array('admin', $RoleGroup)) die();	
?>
<form action="" method="post">
<input type="text" name="postTrack" placeholder="Введите Трэк номер">
<input type="submit" name="button" value="Поиск">
</form>
<style>
.wi {
	width: 300px;
}
</style>
<?php
if(isset($_POST['button'])){
	$postTrack = (!empty($_POST['postTrack'])) ? $_POST['postTrack'] : NULL;
	foreach ([18,19] as $list) {
		$con = JBase::Query("SELECT * FROM list".$list." WHERE `dop10` LIKE '%$postTrack'");
		while($res = $con->fetch_assoc()){
			if($res['dop10'] && $res['russianpostTrack']){
				echo '
				<br>
				<table border="1">
					<tr>
						<th class="wi">Старый Трэк</th>
						<th class="wi">Новый Трэк</th>
					</tr>
					<tr>
						<td>&nbsp;'.$res['dop10'].'</td>
						<td>&nbsp;'.$res['russianpostTrack'];
						if($res['status'] == 56){
							echo '&nbsp;&nbsp;<input type="submit" onclick="pdf('.$res['id'].',1,'.$res['status'].','.$list.',1)" value="Накладная">';
						}elseif($res['status'] == 55){
							echo '&nbsp;&nbsp;<input type="submit" onclick="pdf('.$res['id'].',1,'.$res['status'].','.$list.',2)" value="Накладная">';
						}
						
					echo	'</td>
					</tr>
				</table>';
			}
		}
	}
}
?>
<script>

function pdf(id,count,status,list,param){
	var change = 1;
	var account = 8;
	var $ids = [];
	$ids.push(id);
	if (change > 0) confirm({
				text: "Вы уверены, что хотите произвести выгрузку ?",
				ok: function() {
					var json = {func:'RussianPosts', domain:JSCat.domain, token:JSCat.token};
					json["action"] 	= "blanks";
					json["list"] 		= list;
					json["ids"] 		= $ids;
					json["status"] 		= status;
					json["param"]		= param
					json["account"]		= account
					$.post("/json/", json, function(a) {
						if (a.length > 0) {
							$.ajax({
									type: 'post',
									url: 'lib/pdfAlert.php',
									data: {
										ids:id,
										list:list,
										param:param
									  }
								});
							var element = document.createElement('a')
							element.setAttribute('href', a)
							element.setAttribute('target', '_blank')
							element.style.display = 'none';
							document.body.appendChild(element)
							element.click()
							document.body.removeChild(element)
						}
						//location.reload()
					});
				},
				cancel: function() {
					 $('select[data-select="blanks"]').find('option:first').prop('selected',true);
				}
			});
}

if (JSCat.bl == '1') { 
		$('select[data-select="blanks"]').change(function() {
			var $ids = [];
			$ids.push($(this).attr('data-array'));
			var item = $(this).find('option:selected');	
			var count = $(this).attr('data-count');	
			var status = $(this).attr('data-status');
			var list = $(this).attr('data-list');
			// if ($('tr.request.whitesmoke').length == 0) {
			// 	$ids = $("#list2").attr('allids').split(',');
			// }
			if (item.attr('data-change') > 0) confirm({
				text: "Вы уверены, что хотите произвести выгрузку «"+ item.text() +"»?",
				ok: function() {
					var json = {func:'RussianPosts', domain:JSCat.domain, token:JSCat.token};
					json["action"] 	= "blanks";
					json["list"] 		= list;
					json["ids"] 		= $ids;
					json["status"] 	= status //
					json["param"]		= item.attr('data-change')
					json["account"]	= item.attr('account')
					$.post("/json/", json, function(a) {
						if (a.length > 0) {
							var element = document.createElement('a')
							element.setAttribute('href', a)
							element.setAttribute('target', '_blank')
							element.style.display = 'none';
							document.body.appendChild(element)
							element.click()
							document.body.removeChild(element)
						}
						//location.reload()
					});
				},
				cancel: function() {
					 $('select[data-select="blanks"]').find('option:first').prop('selected',true);
				}
			});
		});
	}
</script>
