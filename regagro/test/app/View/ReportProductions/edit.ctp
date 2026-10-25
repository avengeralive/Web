<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Продукция (отчет)', '/report_productions'); ?>

<?php echo $this->Form->create('ReportProduction', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?></legend>

<?php 
	echo $this->Form->input('name', array(
		'label' => 'Название',
		'placeholder' => 'Не указано'
	));
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