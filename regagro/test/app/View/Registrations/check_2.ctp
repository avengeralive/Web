<?php
	$prevPage = $curPage>0?$curPage-1:$curPage;
	$nextPage = $curPage+1;
?>

<?=$institution_name?><br/>
<?=$org_type?><br/>
<?=$org_name?><br/>

<h2><?=$title_for_layout?></h2>
<p>за период с <u><?=date_format(date_create($date_from),'d.m.Y')?></u> по <u><?=date_format(date_create($date_to),'d.m.Y')?></u></p>
<div class="row">
	<div class="col-xs-6">
		<ul class="pagination pagination-sm">
			<li <?=($curPage<=0?'class="disabled"':'')?>><a href="<?=$this->here.'?page='.$prevPage?>">&lt; Назад</a></li>
			<li><a href="<?=$this->here.'?page='.$nextPage?>" rel="next">Вперед &gt;</a></li>
		</ul>
	</div>
</div>
<table class="table table-hover">
<tr><th>Код</th><th>Дата экспертизы</th><th>Продукция</th><th>Кол-во эуспертиз</th><th>Выявлено</th><th>Жур.запись</th></tr>
<?php
foreach ($data as $index => $row) {
	?>
	<tr>
		<td><?=$row['Registration']['code']?></td>
		<td><?=date_format(date_create($row['Registration']['date']),'d.m.Y')?></td>
		<td><?=$row['Production']['name']?></td>
		<td><?=$row['Expertise']['count']?></td>
		<td><?=$row['Expertise']['detections']?></td>
		<td><?=$this->Html->link('перейти',
			array('controller'=>'registrations',
				  'action'=>'overview',
				  $row['Registration']['id']));?>
	  	</td>
	</tr>
	<?
}
?>
</table>