<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Исследования', '/research_types'); ?>

<?php echo $this->Form->create('ResearchType', array(
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
	echo $this->Form->input('report_research_id', array('label' => 'Название в отчете'));
	echo $this->Form->input('ProductionType', array('label'=>'Виды продукции',
		'type' => 'select',
		'multiple' => 'checkbox'
	));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>