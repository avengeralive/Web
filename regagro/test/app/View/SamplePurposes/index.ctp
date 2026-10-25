<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Цели отбора проб', '/sample_purposes'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Цели отбора проб
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('SamplePurpose', array(
				'action'=> 'add',
				'inputDefaults' => array(
					'div' => 'form-group',
					'label' => false,
					'wrapInput' => false,
					'class' => 'form-control'
				),
				'class' => 'well'
			)); 
			echo $this->Form->input('name', array(
				'label' => 'Название',
				'placeholder' => 'Не указано',
				'div' => 'form-group'
			));
			echo $this->Form->input('category', array(
				'label' => 'Категория исследования',
				'options'=>array('Госуслуга'=>'Госуслуга','Показания'=>'Показания'),
				'default' => 'Показания',
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
		<th>Категория исследования</th>
		<th></th>
	</tr>
	<?php foreach ($samplePurposes as $item) {
		echo '<tr>
			<td>'.$this->Html->link($item['SamplePurpose']['name'], array(
					'action' => 'edit', $item['SamplePurpose']['id'])).'
			</td>
			<td>'.$item['SamplePurpose']['category'].'</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $item['SamplePurpose']['id']),
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