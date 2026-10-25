<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Виды продукции', '/production_types'); ?>

<?php echo $this->Form->create('ProductionType', array(
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
		'label' => 'Вид продукции',
		'placeholder' => 'Не указано'
	));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>