<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Лаборатории ЛВСЭ', '/labs'); ?>

<?php echo $this->Form->create('Lab', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>
<legend><?php echo $title_for_layout ?><a class="btn btn-default" href="/labs"style="float: right;">Назад</a></legend>
<?php
	echo $this->Form->input('name', array('label'=>'Название','placeholder'=>'Не указано'));
	echo $this->Form->input('region_id', array('label'=>'Регион', 'empty' => array(0 => '- Не выбрано -')));
	echo $this->Form->input('district_id', array(
		'label' => 'Район',
		'empty' => array(0 => '- Не выбрано -')
	));	
	echo $this->Form->input('organ_id', array(
		'label' => 'Орган управления ветеринарии',
		'empty' => array(0 => '- Не выбрано -')
	));
	echo $this->Form->input('institution_id', array('label'=>'Учреждение ветеринарии', 'empty' => array(0 => '- Не выбрано -')));
	echo $this->Form->input('market_name', array('label'=>'Имя рынка','placeholder'=>'Не указано'));
	echo $this->Form->input('market_address', array('label'=>'Адрес рынка','placeholder'=>'Не указано'));
	echo $this->Form->input('phone', array('label'=>'Телефон','placeholder'=>'Не указано'));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>

<?php $this->start('script');?>
<?php

		$this->Js->get('#LabRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Labs',
 				'action' =>'getByRegion',
 			), array(
 				'update' =>'#LabDistrictId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);

		$this->Js->get('#LabRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Labs',
 				'action' =>'getOrganByRegion',
 			), array(
 				'update' =>'#LabOrganId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);

		$this->Js->get('#LabOrganId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Labs',
 				'action' =>'getByOrgan',
 			), array(
 				'update' =>'#LabInstitutionId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);
?>
<?php $this->end(); ?>