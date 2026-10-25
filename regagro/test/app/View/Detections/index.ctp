
<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Выявления', '/detections'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Выявления
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('Detection', array(
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
			echo $this->Form->input('detection_type_id', array(
				'label' => 'Вид выявления',
				'div' => 'form-group'
			));
			echo $this->Form->input('report_detection_id', array(
				'label' => 'Выявление (отчет)',
				'div' => 'form-group'
			));	
			echo $this->Form->input('ProductionType', array('label'=>'Виды продукции',
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
		<th>Вид выявления</th>
		<th>Виды продукции</th>
		<th></th>
	</tr>
	<?php
		foreach ($detections as $detection) {
			echo '<tr>
				<td>'.$this->Html->link($detection['Detection']['name'], array(
						'action' => 'edit', $detection['Detection']['id'])).'
				</td>
				<td>'.$detection['DetectionType']['name'].'
				<strong>В отчете: '.$detection['ReportDetection']['name'].'</strong>
				</td>
				<td>
				'.implode(', ', array_map(function ($entry) {
					  return $entry['name'];
					}, $detection['ProductionType'])).'
				</td>
				<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
						'action' => 'delete', $detection['Detection']['id']),
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

<?php $this->start('script');?>
<script type="text/javascript">

<?php $this->Js->get('#DetectionDetectionTypeId');
	$data = $this->Js->serializeForm(array(
		'isForm' => true,
		'inline' => true
	));
	$request = $this->Js->request(array(
		'controller'=>'report_detections',
		'action'=>'getByDetectionType'
	), array(
		'update'=>'#DetectionReportDetectionId',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $data.'.replace(\'%5BDetection%5D\',\'\')'
	));
	$this->Js->event('change', $request);
		
	echo $request; //first request
?>
</script>
<?php $this->end(); ?>