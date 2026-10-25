<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<?php $this->Html->addCrumb('Редактирование исследования', ''); ?>

<?php echo $this->Form->create('Research', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?></legend>

<?php 
	echo $this->Form->input('registration_id', array('type'=>'hidden'));
	echo $this->Form->input('expertise_id', array('label'=>'Экспертиза'));
	//echo $this->Form->input('production_id', array('label'=>'Продукция'));
	echo $this->Form->input('research_type_id', array('label'=>'Вид исследований'));
	echo $this->Form->input('count', array('label'=>'Количество исследований'));
	echo $this->Form->input('research_result', array('type'=>'radio','legend'=>'Результат исследований',
		'options' => array(/*'"Отрицательный"'=>'"Отрицательный"', 
		'"Положительный"'=>'"Положительный"', */
		'Удовлетворительный'=>'Удовлетворительный',
		'Неудовлетворительный'=>'Неудовлетворительный')
	));
	echo $this->Form->input('indicators', array('label'=>'Показатели/Примечание'));
	echo $this->Form->input('confirmed', array('label'=>'Подтверждение лаборатории','div'=>'checkbox', 'class'=>'checkbox'));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>

<script type="text/javascript">
	$(function () {
		$('select').selectize({
			plugins: ['restore_on_backspace'],
			create: false,
			selectOnTab: true,
			onInitialize: function() {this.selected_value = this.getValue();},
			onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
			onDropdownClose: function($dropdown) { 
				if(this.getValue()==0) {
					this.setValue(this.selected_value ); 
				}
			}
		});
	});
</script>