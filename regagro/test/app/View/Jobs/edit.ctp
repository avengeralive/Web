<?php echo $this->Form->create('Job', array(
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
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-default'
	));
	echo $this->Form->end(); 
?>