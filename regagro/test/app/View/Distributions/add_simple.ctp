<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<?php $this->Html->addCrumb('Просмотр записи39 ', ''); ?>

<?php echo $this->Form->create('Distribution', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>
	<fieldset>
		<legend><?php echo $title_for_layout ?></legend>
		<?php 
		echo $this->Form->input('distributor', array('label'=>'Торгующему'));
		echo $this->Form->input('production_id', array('label'=>'Продукция ('.$registration['ProductionType']['name'].')'));
		echo $this->Form->input('count', array('label'=>'Количество туш (тушек, партий, т/мест)'));
		echo $this->Form->input('weight', array('label'=>'Вес', 'step'=>0.01));
		echo $this->Form->input('places', array('label'=>'Количество мест'));
		echo $this->Form->submit('Сохранить', array(
			'div' => 'form-group',
			'class' => 'btn btn-default'
		));?>
	</fieldset>
<?php echo $this->Form->end(); ?>