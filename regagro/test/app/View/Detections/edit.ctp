
<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Выявления', '/detections'); ?>

<?php echo $this->Form->create('Detection', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>
<legend><?php echo $title_for_layout ?></legend>
<?php 
	echo $this->Form->input('name', array('label'=>'Название'));
	echo $this->Form->input('detection_type_id', array('label'=>'Вид выявления'));
	echo $this->Form->input('report_detection_id', array('label'=>'Выявление (отчет)'));
	echo $this->Form->input('ProductionType', array('label'=>'Виды продукции',
		'type' => 'select',
		'multiple' => 'checkbox'));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); ?>

<?php
$this->start('script');?>
<script type="text/javascript">
<?php

$this->Js->get('#DetectionDetectionTypeId');
$data = $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			));
$request = $this->Js->request(
			array(
				'controller'=>'report_detections',
				'action'=>'getByDetectionType'
			),
			array(
				'update'=>'#DetectionReportDetectionId',
				'async' => true,
				'method' => 'post',
				'dataExpression'=>true,
				'data'=> $data.'.replace(\'%5BDetection%5D\',\'\')'
			)
		);
$this->Js->event('change', $request);
	
//echo $request; //first request
?>
</script>
<?php $this->end(); ?>