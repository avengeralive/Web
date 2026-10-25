<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Снято с реализации', '/ban_types'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Снято с реализации
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('BanType', array(
				'action'=> 'add',
				'inputDefaults' => array(
					'div' => 'form-group',
					'wrapInput' => false,
					'class' => 'form-control'
				),
				'class' => 'well'
			));
			echo $this->Form->input('name', array(
				'label' => 'Название',
				'placeholder' => 'Введите название',
				'div' => 'form-group'
			));
			echo $this->Form->input('report_ban_type_id', array(
				'label' => 'Название (отчет)'
			));
			echo $this->Form->input('ProductionType', array(
				'label'=>'Виды продукции',
				'type' => 'select',
				'multiple' => 'checkbox'));
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
		<th>Виды продукции</th>
		<th></th>
	</tr>
	<?php
		foreach ($banTypes as $banType) {
		echo '<tr>
			<td>'.$this->Html->link($banType['BanType']['name'], array(
					'action' => 'edit', $banType['BanType']['id'])).'
					<strong>В отчете: '.$banType['ReportBanType']['name'].'</srtong>
			</td>
			<td>
			'.implode(', ', array_map(function ($entry) {
				  return $entry['name'];
				}, $banType['ProductionType'])).'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $banType['BanType']['id']),
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