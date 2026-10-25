<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Продукция (отчет)', '/report_productions'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Продукция (отчет)
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('ReportProduction', array(
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
				'placeholder' => 'Название...',
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
		<th>Вид продукции</th>
		<th></th>
	</tr>
	<?php foreach ($reportProductions as $reportProduction) {
		echo '<tr>
			<td>'.$this->Html->link($reportProduction['ReportProduction']['name'], array(
					'action' => 'edit', $reportProduction['ReportProduction']['id'])).'
			</td>
			<td>
			'.implode(', ', array_map(function ($entry) {
				  return $entry['name'];
				}, $reportProduction['ProductionType'])).'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $reportProduction['ReportProduction']['id']),
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