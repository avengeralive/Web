<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Исследования', '/research_types'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Исследования
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('ResearchType', array(
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
				'placeholder' => 'Не указано',
				'div' => 'form-group'
			));
			echo $this->Form->input('report_research_id', array(
				'label' => 'Название в отчете',
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
		<th>Отчет</th>
		<th>Виды продукции</th>
		<th></th>
	</tr>
	<?php foreach ($researchTypes as $researchType) {
		echo '<tr>
			<td>'.$this->Html->link($researchType['ResearchType']['name'], array(
					'action' => 'edit', $researchType['ResearchType']['id'])).'
			</td>
			<td>'.$researchType['ReportResearch']['name'].'
			</td>
			<td>
			'.implode(', ', array_map(function ($entry) {
				  return $entry['name'];
				}, $researchType['ProductionType'])).'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $researchType['ResearchType']['id']),
					array(
						'escape'=>false
					)).'
			</td>
		</tr>';
	} ?>
</table>

<?php echo $this->Paginator->pagination(array(
	'ul' => 'pagination pagination-sm'
)); ?>