
<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Регионы', '/regions'); ?>
<?php $this->Html->addCrumb('Добавление региона', '/regions/add'); ?>


<?php echo $this->Form->create('Region', array(
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
		'placeholder' => 'Введите название',
		'label' => 'Название региона'
	));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));?>


<?php echo $this->Form->end(); ?>