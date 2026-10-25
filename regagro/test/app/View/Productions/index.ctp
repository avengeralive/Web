<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Продукция', '/productions'); ?>


<div class="row">
	<div class="col-md-12">
		<h2>Продукция
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('Production', array(
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
			echo $this->Form->input('production_type_id', array(
				'label' => 'Вид продкции',
				'div' => 'form-group'
			));
			echo $this->Form->input('report_production_id', array(
				'label' => 'Вид продкции (для отчета)',
				'div' => 'form-group'
			));
			echo $this->Form->input('measure', array(
				'label' => 'Единица измерения',
				'div' => 'form-group',
				'options' => array('партия/т.м.'=>'партия/т.м.', 
				   'туша'=>'туша', 
				   'тушка'=>'тушка'
				)
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
		<th>Вид продкции</th>
		<th>Для отчета</th>
		<th>Ед. измерения</th>
		<th></th>
	</tr>
	<?php
	foreach ($productions as $production) {
		echo '
		<tr>
			<td>'.$this->Html->link($production['Production']['name'], array(
					'action' => 'edit', $production['Production']['id'])).'
			</td>
			<td>
			'.$production['ProductionType']['name'].'
			</td>
			<td>
			'.$production['ReportProduction']['name'].'
			</td>
			<td>
			'.$production['Production']['measure'].'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $production['Production']['id']),
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