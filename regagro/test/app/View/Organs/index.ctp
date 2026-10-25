<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Органы управления ветеринарии', '/organs'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Органы управления ветеринарии<span class="pull-right">
			<a class="collapsed btn btn-primary" data-toggle="collapse" href="#addorgan" aria-expanded="false" aria-controls="findusers">Добавить</a>
		</h2>
		<!-- Добавить запись -->
		<div id="addorgan" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('Organ', array(
				'action'=> 'add',
				'inputDefaults' => array(
					'div' => 'form-group',
					'wrapInput' => false,
					'class' => 'form-control'
				),
				'class' => 'well'
			));
			echo $this->Form->input('region_id', array(
				'label' => 'Регион',
				'div' => 'form-group',
				'empty' => array(0 => '- Не выбрано -')
			));
			echo $this->Form->input('name', array(
			'label' => 'Название',
				'placeholder' => 'Введите название',
				'div' => 'form-group'
			));
			echo $this->Form->input('order_type', array(
				'label' => 'Распорядительный документ',
				'empty' => array(0 => '- Не выбрано -'),
				'options'=>array('приказ'=>'приказ','распоряжение'=>'распоряжение'),
				'div' => 'form-group'
			));
			echo $this->Form->input('order_date', array(
				'placeholder' => '00-00-0000',
				'label' => 'Дата распорядительного документа',
				'id'=> 'datetimepicker_order_date',
				'type'=>'text',
				'data-date-format'=>'YYYY-MM-DD',
				'readonly'=>false,
				'beforeInput' => '<div class="input-group">',
				'afterInput' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>',
				'div' => 'form-group'
			));
			echo $this->Form->input('order_num', array(
				'label' => 'Номер распорядительного документа',
				'placeholder' => '0',
				'div' => 'form-group'
			));
			echo $this->Form->submit('Добавить', array(
				'div' => 'form-group',
				'class' => 'btn btn-primary'
			));
			echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<table class="table super">
	<tr>
		<th>Название</th>
		<th>Документ</th>
		<th>Дата</th>
		<th>Регион</th>
		<th>Номер</th>
		<th></th>
	</tr>
	<?php foreach ($organs as $organ) {
		echo '<tr>
			<td>'.$this->Html->link($organ['Organ']['name'], array(
					'action' => 'edit', $organ['Organ']['id'])).'
			</td>
			<td>'.$organ['Organ']['order_type'].'</td>
			<td>'.$organ['Organ']['order_date'].'</td>
			<td>'.$organ['Region']['name'].'</td>
			<td>'.$organ['Organ']['order_num'].'</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $organ['Organ']['id']),
					array(
						'escape'=>false
					)).'
			</td>
		</tr>';
	}?>
</table>

<?php echo $this->Paginator->pagination(array(
	'ul' => 'pagination pagination-sm'
)); ?>