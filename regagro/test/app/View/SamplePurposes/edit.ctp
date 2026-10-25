<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Цели отбора проб', '/sample_purposes'); ?>

<?php echo $this->Form->create('SamplePurpose', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?></legend>

<?php 
	echo $this->Form->input('name', array('label'=>'Название','placeholder'=>'Не указано'));
	echo $this->Form->input('category', array('label'=>'Категория исследования', 
		'options'=>array(
			'Госуслуга'=>'Госуслуга',
			'Показания'=>'Показания'
		), 
		'default' => 'Показания'
	));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>