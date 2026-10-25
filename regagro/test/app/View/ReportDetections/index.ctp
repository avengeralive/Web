<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Выявления (отчет)', '/report_detections'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Выявления (отчет)
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('ReportDetection', array(
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
			echo $this->Form->input('detection_type_id', array(
				'label' => 'Вид выявления',
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
		<th>Вид выявления</th>
		<th></th>
	</tr>
	<?php foreach ($reportDetections as $reportDetection) {
		echo '<tr>
			<td>'.$this->Html->link($reportDetection['ReportDetection']['name'], array(
					'action' => 'edit', $reportDetection['ReportDetection']['id'])).'
			</td>
			<td>'.$reportDetection['DetectionType']['name'].'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $reportDetection['ReportDetection']['id']),
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