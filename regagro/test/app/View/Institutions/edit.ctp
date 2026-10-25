
<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Учреждения ветеринарии', '/institutions'); ?>

<?php echo $this->Form->create('Institution', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?></legend>

<?php 
		echo $this->Form->input('region_id', array(
			'label' => 'Регион',
			'empty' => array(0 => '- Не выбрано -')
		));
		echo $this->Form->input('district_id', array(
			'label' => 'Район',
			'empty' => array(0 => '- Не выбрано -')
		));
	echo $this->Form->input('organ_id', array('label'=>'Орган управления'));
	echo $this->Form->input('name', array('label'=>'Название'));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>