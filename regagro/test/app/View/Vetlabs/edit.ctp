<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Ветеринарные лаборатории', '/vetlabs'); ?>

<?php echo $this->Form->create('Vetlab', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?></legend>

<?php
	echo $this->Form->input('region_id', array('label' => 'Регион','empty' => array(0 => '- Не выбрано -')));
	echo $this->Form->input('district_id', array('label' => 'Район','empty' => array(0 => '- Не выбрано -')));
	echo $this->Form->input('organ_id', array('label'=>'Орган управления'));
	echo $this->Form->input('name', array('label'=>'Название','placeholder' => 'Не указано'));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>

<?php 
	$this->start('script');

	$this->Js->get('#VetlabRegionId')->event('change',
		$this->Js->request(array(
 			'controller'=>'Vetlabs',
 			'action' =>'getByRegion',
 		), array(
 			'update' =>'#VetlabDistrictId',
 			'async' => true,
 			'method' => 'Post',
 			'dataExpression'=>true,
 			'data'=> $this->Js->serializeForm(array(
 				'isForm' => true,
 				'inline' => true
 			))
 		))
	);

	$this->Js->get('#VetlabRegionId')->event('change',
		$this->Js->request(array(
			'controller'=>'Vetlabs',
			'action' =>'getOrganByRegion',
		), array(
			'update' =>'#VetlabOrganId',
 			'async' => true,
 			'method' => 'Post',
 			'dataExpression'=>true,
 			'data'=> $this->Js->serializeForm(array(
 				'isForm' => true,
 				'inline' => true
 			))
 		))
	);

	$this->end(); 
?>