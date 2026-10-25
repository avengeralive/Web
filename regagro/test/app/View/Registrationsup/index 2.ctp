
<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<div class="row">
	<div class="col-md-12">
		<h2>Журнал<span class="pull-right">
		    <?php echo $this->Form->create('Registration', array(
    			'action'=>'overviewByCode',
    			'type'=>'get',
    			'inputDefaults' => array(
    				'wrapInput' => false,
    				'label' => false,
    				'class' => 'form-control'
    			),
    			'class' => 'inline-flex'
    		));
    		echo $this->Form->input('code', array(
    			'placeholder' => 'Поиск по коду записи',
    			'class' => 'white-flex',
    			'required' => true
    		));
    		echo $this->Form->submit('Перейти', array(
    			'class' => 'btn btn-primary',
    			'id'=>'overviewByCode'
    		));
    		echo $this->Form->end(); ?>
    
			<a class="collapsed btn btn-primary" data-toggle="collapse" href="#addf" aria-expanded="false" aria-controls="addf">Экспорт</a>
			<a class="collapsed btn btn-primary" data-toggle="collapse" href="#addr" aria-expanded="false" aria-controls="addr">Форма поиска</a>
			<a class="btn btn-primary" href="/registrations/add"><span class="glyphicon glyphicon-plus"></span> Новая запись</a>
			</span>
		</h2>
	</div>
</div>

<div id="addf" class="panel-collapse collapse" role="tabpanel" style="background: #ffcc00;">
	<?php
	echo $this->Html->link('<span class="glyphicon glyphicon-floppy-open"></span> Журнал',
					array('controller'=>'registrations', 'action'=>'daily_registrations_xml', date('Y-m-d'), 0),
					array('escape'=>false, 'class'=>'btn btn-primary', 'id'=>'daily_registrations_link'));
	echo $this->Html->link('<span class="glyphicon glyphicon-floppy-open"></span> Журнал (мал.шрифт)',
					array('controller'=>'registrations', 'action'=>'daily_registrations_xml', date('Y-m-d'), 1),
					array('escape'=>false, 'class'=>'btn btn-primary', 'id'=>'daily_registrations_link_smallfont'));
	echo $this->Html->link('<span class="glyphicon glyphicon-floppy-open"></span> Акт денатурации (мясо, рыба)',
					array('controller'=>'registrations', 'action'=>'denaturation_doc', 'meat_fish'),
					array('escape'=>false, 'class'=>'btn btn-primary', 'id'=>'denaturation_meat_fish_link'));
	echo $this->Html->link('<span class="glyphicon glyphicon-floppy-open"></span> Акт денатурации (пищевые продукты)',
					array('controller'=>'registrations', 'action'=>'denaturation_doc', 'other'),
					array('escape'=>false, 'class'=>'btn btn-primary', 'id'=>'denaturation_other_link'));
	?>
</div>

<div id="addr" class="panel-collapse collapse" role="tabpanel">
<?php echo $this->Form->create('Registration', array( 'type' => 'get',
		'inputDefaults' => array(
			'div' => 'form-group',
			'wrapInput' => false,
			'label' => false,
			'class' => 'form-control'
		),
		'class' => 'well'
	));
		echo $this->Form->input('owner', array(
			'placeholder' => 'Не указан',
			'label' => 'Владелец',
			'div' => 'form-group col-sm-4',
			'value' => nvl($this->request->query['owner']),
			'required'=>false
		));
		echo $this->Form->input('doc_num', array(
			'placeholder' => '0',
			'label' => 'Номер документа',
			'div' => 'form-group col-sm-4',
			'value' => nvl($this->request->query['doc_num']),
			'required'=>false
		));
			?>

	<div class="form-group col-sm-4">
		<label>Дата</label>
		<div class='input-group'>
			<input type="text" data-date-format="YYYY-MM-DD" id="pick_doc_date" class="form-control small">
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
	</div>
	
	<?php
		echo $this->Form->input('region_id', array(
			'empty' => '- Регион -',
			'div' => 'form-group col-sm-4',
			'value' =>  nvl($this->request->query['region_id']),
			'required'=>false
		));

		echo $this->Form->input('production_type_id', array(
			'empty' => '- Тип продукции -',
			'div' => 'form-group col-sm-5',
			'value' =>  nvl($this->request->query['production_type_id']),
			'required'=>false
		));
	echo $this->Form->submit('Поиск', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary '
	));
	echo $this->Form->end(); ?>
</div>





<table class="table table-hover table-bordered small super journal">
	<tr>
		<th colspan="3">Общие данные</th>
		<th colspan="3">Сопроводительный документ</th>
		<th colspan="5">Данные о происхождении продукции</th>
		<th rowspan="2">Копировать</th>
		<th rowspan="2">Удалить</th>
	</tr>
	<tr>
		<th>Код</th>
		<th>Дата экспертизы</th>
		<th>Сотрудник</th>
		<th>Название</th>
		<th>Номер</th>
		<th>Дата</th>
		<th>Владелец</th>
		<th>Вид продукции</th>
		<th>Регион</th>
		<th>Район</th>
		<th>Нас. пункт</th>
	</tr>
	<?php
	foreach ($registrations as $reg)
	{
		$delete = '';
		if(AuthComponent::user('role')!='Администратор' && $reg['Registration']['date']<date('Y-m-d'))
		{
			$delete = '<span class="glyphicon glyphicon-remove"></span>';
		} else {
			$delete = $this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'registrations',
					'action' => 'delete', $reg['Registration']['id']),
					array(
						'escape'=>false
					));
		}

		$copy = $this->Html->link('<span class="glyphicon glyphicon-plus"></span>', array('controller' => 'registrations',
					'action' => 'copy', $reg['Registration']['id']),
					array(
						'escape'=>false
					));
		echo '
		<tr>
			<td>'.$this->Html->link($reg['Registration']['code'], array('controller' => 'registrations',
					'action' => 'overview', $reg['Registration']['id'])).'
			</td>
			<td>'.date_format(date_create($reg['Registration']['date']), 'd.m.Y').'</td>
			<td>'.$reg['User']['displayname'].'</td>
			<td>'.$reg['Registration']['doc_form'].'</td>
			<td>'.$reg['Registration']['doc_num'].'</td>
			<td>'.date_format(date_create($reg['Registration']['doc_date']), 'd.m.Y').'</td>
			<td>'.$reg['Registration']['owner'].'</td>
			<td>'.$reg['ProductionType']['name'].'</td>
			<td>'.$reg['Region']['name'].'</td>
			<td>'.$reg['District']['name'].'</td>
			<td>'.$reg['Registration']['locality'].'</td>
			<td>'.$copy.'</td>
			<td>'.$delete.'</td>
		</tr>';
	}
	?>
</table>
<?php echo $this->Paginator->pagination(array(
	'ul' => 'pagination pagination-sm'
)); ?>


<?php
$this->start('css');?>
<link rel="stylesheet" href="/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
<?php $this->end(); ?>

<?php
$this->start('script');?>
<script src="/js/moment.min.js"></script>
<script src="/js/moment.ru.js"></script>
<script src="/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$(function () {

	$('select').selectize({
		selectOnTab: true,
		plugins: ['restore_on_backspace']
	});

	$('#pick_doc_date').datetimepicker({
		language: 'ru',
		pickTime: false,
		defaultDate: new Date()
	});

	$('#pick_doc_date').on('dp.change',function (e) {
		$('#daily_registrations_link').attr('href', '<?php echo $this->Html->url(array('controller'=>'registrations', 'action'=>'daily_registrations_xml'))?>/'+$('#pick_doc_date').val());
		$('#daily_registrations_link_smallfont').attr('href', '<?php echo $this->Html->url(array('controller'=>'registrations', 'action'=>'daily_registrations_xml'))?>/'+$('#pick_doc_date').val()+'/1');
		$('#denaturation_meat_fish_link').attr('href', '<?php echo $this->Html->url(array('controller'=>'registrations', 'action'=>'denaturation_doc', 'meat_fish'))?>/'+$('#pick_doc_date').val());
		$('#denaturation_other_link').attr('href', '<?php echo $this->Html->url(array('controller'=>'registrations', 'action'=>'denaturation_doc', 'other'))?>/'+$('#pick_doc_date').val());
	});
});
</script>

<?php $this->end(); ?>
