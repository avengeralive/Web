<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Причины обезвреживания', '/ban_reasons'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Причины обезвреживания
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('BanReason', array(
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
				'placeholder' => 'Введите название',
				'div' => 'form-group'
			));
			echo $this->Form->input('report_ban_reason_id', array(
				'label' => 'Причины обезвреживания (отчет)',
				'placeholder' => 'Введите название',
				'div' => 'form-group'
			));
			echo $this->Form->input('ProductionType', array('label'=>'Виды продукции',
				'type' => 'select',
				'multiple' => 'checkbox'
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
		<th>Виды продукции</th>
		<th></th>
	</tr>
	<?php
	foreach ($banReasons as $banReason) {
		echo '
		<tr>
			<td>'.$this->Html->link($banReason['BanReason']['name'], array('action' => 'edit', $banReason['BanReason']['id'])).'
				<strong>В отчете: '.$banReason['ReportBanReason']['name'].'</strong>
			</td>
			<td>
			'.implode(', ', array_map(function ($entry) {
				  return $entry['name'];
				}, $banReason['ProductionType'])).'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $banReason['BanReason']['id']),
					array(
						'escape'=>false
					)).'
			</td>
		</tr>';
	}
	?>
</table>
<?php echo $this->Paginator->pagination(array(
	'ul' => 'pagination pagination-sm'
)); ?>