
<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Продукция', '/productions'); ?>


<?php echo $this->Form->create('Production', array(
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
		'label' => 'Название'
	));
	echo $this->Form->input('production_type_id', array(
		'label' => 'Вид продкции',
		'div' => 'form-group'
	));
	echo $this->Form->input('report_production_id', array(
		'label' => 'Вид продкции (для отчета)',
		'div' => 'form-group'
	));
	echo $this->Form->input('measure', array(
		'label' => 'Единица измерения',
		'div' => 'form-group',
		'label' => 'Ед. измерения',
		'options' => array('партия/т.м.'=>'партия/т.м.', 
		   'туша'=>'туша', 
		   'тушка'=>'тушка'
		)
	));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>