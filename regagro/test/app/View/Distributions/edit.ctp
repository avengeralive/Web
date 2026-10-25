<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<?php $this->Html->addCrumb('Редактирование распределения продукции по точкам', ''); ?>


<?php 
echo $this->Form->create('Distribution', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
));?>

<legend><?php echo $title_for_layout ?></legend>

<?php 
	echo $this->Form->input('registration_id', array('type'=>'hidden'));
	echo $this->Form->input('distributor', array('label'=>'Торгующему', 'placeholder'=>'Не указано'));
	echo $this->Form->input('expertise_id', array('label'=>'Экспертиза'));
	//echo $this->Form->input('production_id', array('label'=>'Продукция'));
	echo $this->Form->input('count', array('label'=>'Количество туш (тушек, партий, т/мест)', 'placeholder'=>'0'));
	echo $this->Form->input('weight', array('label'=>'Вес в кг (объем в л, яйцо в шт.) (доступно '.(round(($totals?$totals['conclusion_weight']:0)-($distributed?$distributed['weight']:0),2)).')', 'step' => 0.01, 'placeholder'=>'0'));
	echo $this->Form->input('places', array('label'=>'Количество мест', 'placeholder'=>'0'));
	echo $this->Form->input('note', array('label'=>'Примечание', 'type'=>'textarea', 'placeholder'=>'Не указано'));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>